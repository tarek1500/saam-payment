<?php

use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
	return view('welcome');
});

Route::get('payment', [PaymentController::class, 'index'])->name('payment.index');
Route::post('checkout', [PaymentController::class, 'checkout'])->name('payment.checkout');
Route::get('hyperpay/finalize', [PaymentController::class, 'finalize'])->name('payment.finalize');
Route::get('complete', [PaymentController::class, 'complete'])->name('payment.complete');