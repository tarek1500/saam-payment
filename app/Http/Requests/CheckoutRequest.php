<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, mixed>
	 */
	public function rules()
	{
		return [
			'title' => 'required|in:dr,prof,mr,mrs,ms',
			'first_name' => 'required|string',
			'last_name' => 'required|string',
			'mobile_code' => 'required|exists:countries,e164_code',
			'mobile_number' => 'required|regex:/^[0-9]+$/',
			'email' => 'required|email',
			'scfhs' => '',
			'organization' => '',
			'country' => 'required|exists:countries,code',
			'post_code' => 'nullable|regex:/^[0-9]+$/',
			'registration_type' => 'required|numeric|in:300,500,1000',
			'payment_option' => 'required|in:MADA,MASTER,VISA'
		];
	}
}