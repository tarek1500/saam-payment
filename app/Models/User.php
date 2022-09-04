<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Devinweb\LaravelHyperpay\Traits\ManageUserTransactions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
	use HasApiTokens, HasFactory, Notifiable, ManageUserTransactions;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array<int, string>
	 */
	protected $fillable = [
		'name',
		'email',
		'mobile'
	];
}