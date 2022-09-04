<?php

namespace App\Http\Controllers;

use App\Models\Country;

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
}