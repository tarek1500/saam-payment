<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
	use HasFactory;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array<int, string>
	 */
	protected $fillable = [
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
	];
}