<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('registrations', function (Blueprint $table) {
			$table->id();
			$table->string('title');
			$table->string('first_name');
			$table->string('last_name');
			$table->string('mobile_code');
			$table->string('mobile_number');
			$table->string('email');
			$table->string('scfhs')->nullable();
			$table->string('organization')->nullable();
			$table->string('country');
			$table->string('post_code')->nullable();
			$table->float('registration_type');
			$table->string('payment_option');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('registrations');
	}
};