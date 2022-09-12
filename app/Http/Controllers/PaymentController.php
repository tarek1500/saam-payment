<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutRequest;
use App\Models\Country;
use App\Models\Registration;
use App\Models\User;
use App\Notifications\PaymentCompletedNotification;
use Devinweb\LaravelHyperpay\Facades\LaravelHyperpay;
use Devinweb\LaravelHyperpay\Support\TransactionBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
	/**
	 * Show payment view.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$countries = Country::all();

		return view('payment.index', [
			'countries' => $countries
		]);
	}

	/**
	 * Checkout through HyperPay.
	 *
	 * @param \App\Http\Requests\CheckoutRequest $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function checkout(CheckoutRequest $request)
	{
		$data = $request->only([
			'title',
			'first_name',
			'last_name',
			'mobile_code',
			'mobile_number',
			'email',
			'scfhs',
			'organization',
			'country',
			'post_code',
			'registration_type',
			'payment_option'
		]);

		$user = User::firstOrCreate([
			'email' => $data['email'],
			'mobile' => $data['mobile_code'] . $data['mobile_number']
		], [
			'name' => $data['first_name'] . ' ' . $data['last_name']
		]);
		$amount = $data['registration_type'];
		$brand = $data['payment_option'];

		$merchantTransactionId = Str::random(40);

		return LaravelHyperpay::addMerchantTransactionId($merchantTransactionId)->checkout($data, $user, $amount, $brand, $request);
	}

	/**
	 * Update payment status through HyperPay.
	 *
	 * @param \Illuminate\Http\Request $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function finalize(Request $request)
	{
		$resourcePath = $request->input('resourcePath');
		$id = $request->input('id');

		if ($resourcePath && $id)
		{
			$response = LaravelHyperpay::paymentStatus($resourcePath, $id);
			$responseData = json_decode($response->content(), true);

			if ($response->status() === 200)
			{
				$transaction = (new TransactionBuilder)->findByIdOrCheckoutId($id);

				Registration::create(Arr::only($transaction->trackable_data, [
					'title',
					'first_name',
					'last_name',
					'mobile_code',
					'mobile_number',
					'email',
					'scfhs',
					'organization',
					'country',
					'post_code',
					'registration_type',
					'payment_option'
				]));

				if ($user = $transaction->user)
				{
					$user->notify(new PaymentCompletedNotification);
				}

				return redirect()->route('payment.complete');
			}
		}

		return redirect()->route('payment.index')->with('status', $responseData['message'] ?? null);
	}

	/**
	 * Show complete payment view.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function complete()
	{
		return view('payment.complete');
	}
}