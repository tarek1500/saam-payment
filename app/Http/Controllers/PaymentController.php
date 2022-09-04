<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutRequest;
use App\Models\Country;
use App\Models\User;
use Devinweb\LaravelHyperpay\Facades\LaravelHyperpay;

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

		return LaravelHyperpay::checkout($data, $user, $amount, $brand, $request);
	}
}