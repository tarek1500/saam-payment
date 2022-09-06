<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Payment</title>

	<style>
		@font-face {
			font-family: 'Roboto-Flex';
			src: url('{{ asset("fonts/roboto_flex/RobotoFlex-Regular.ttf") }}');
			font-weight: 400;
		}
	</style>
	<link rel="stylesheet" href="{{ asset('css/bootstrap/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('css/payment/index.css') }}">
</head>
<body>
	<div class="container">
		<div class="text-center logo"><img src="{{ asset('imgs/logo.jpeg') }}" alt="Logo"></div>
		<h1 class="text-center heading">Conference Registration</h1>

		@if (session('status'))
			<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<strong>Payment response</strong> {{ session('status') }}
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>
		@endif

		<div class="row content">
			<div class="col-md-7 col-lg-6">
				<form id="payment-form" action="{{ route('payment.checkout') }}" method="POST">
					@csrf

					<h2 class="subheading mb-4">* Mandatory fields</h2>
					<div class="mb-4">
						<label for="title" class="form-label">Title <span class="mandatory ms-2">*</span></label>
						<select class="form-select" id="title" name="title" required>
							<option value="dr">Dr</option>
							<option value="prof">Prof</option>
							<option value="mr">Mr</option>
							<option value="mrs">Mrs</option>
							<option value="ms">Ms</option>
						</select>
					</div>
					<div class="mb-4">
						<label for="first-name" class="form-label">First Name <span class="mandatory ms-2">*</span></label>
						<input type="text" class="form-control" id="first-name" name="first_name" required>
					</div>
					<div class="mb-4">
						<label for="last-name" class="form-label">Last Name <span class="mandatory ms-2">*</span></label>
						<input type="text" class="form-control" id="last-name" name="last_name" required>
					</div>
					<div class="mb-4">
						<label for="mobile-code" class="form-label">Mobile Number <span class="mandatory ms-2">*</span></label>
						<div class="row">
							<div class="col-5 col-md-3">
								<select class="form-select" id="mobile-code" name="mobile_code" required>
									@foreach ($countries as $country)
										<option value="{{ $country->e164_code }}">{{ $country->e164_code }}</option>
									@endforeach
								</select>
							</div>
							<div class="col-7 col-md-9">
								<input type="number" class="form-control" id="mobile-number" name="mobile_number" required>
							</div>
						</div>
					</div>
					<div class="mb-4">
						<label for="email" class="form-label">Email <span class="mandatory ms-2">*</span></label>
						<input type="email" class="form-control" id="email" name="email" required>
					</div>
					<div class="mb-4">
						<label for="scfhs" class="form-label">SCFHS No <span class="optional">(optional)</span></label>
						<input type="text" class="form-control" id="scfhs" name="scfhs">
						<div class="form-text text-end" id="scfhs-help">(e.g. 00RM0000 or 1900001) Type 0 if you don’t have a SCFHS No.</div>
					</div>
					<div class="mb-4">
						<label for="organization" class="form-label">Organization <span class="optional">(optional)</span></label>
						<input type="text" class="form-control" id="organization" name="organization">
					</div>
					<div class="mb-4">
						<label for="country" class="form-label">Country <span class="mandatory ms-2">*</span></label>
						<select class="form-select" id="country" name="country" required>
							@foreach ($countries as $country)
								<option value="{{ $country->code }}">{{ $country->name }}</option>
							@endforeach
						</select>
					</div>
					<div class="mb-4">
						<label for="post-code" class="form-label">Post Code <span class="optional">(optional)</span></label>
						<input type="number" class="form-control" id="post-code" name="post_code">
					</div>
					<div class="mb-4">
						<label for="registration-type" class="form-label">Registration Type <span class="mandatory ms-2">*</span></label>
						<select class="form-select" id="registration-type" name="registration_type">
							<option value="300">SAAM Conference Registration - Student 300 SAR</option>
							<option value="500">SAAM Conference Resident - Student 500 SAR</option>
							<option value="1000">SAAM Conference Registration - Physician 1000 SAR</option>
						</select>
						<div id="registration-type-help" class="form-text text-end">Prices include VAT</div>
					</div>
					<div class="mb-4">
						<label for="payment-option" class="form-label">Payment Option <span class="mandatory ms-2">*</span></label>
						<select class="form-select" id="payment-option" name="payment_option">
							<option value="MADA">Pay With MADA Card</option>
							<option value="MASTER">Pay With Master Card</option>
							<option value="VISA">Pay With Visa Card</option>
						</select>
					</div>
					<div class="register">
						<button class="btn btn-primary w-100" type="submit">Register Now</button>
					</div>
				</form>
			</div>
			<div class="col-md-5 col-lg-6 payment-form">
				<form class="paymentWidgets"></form>
			</div>
		</div>
	</div>

	<script src="{{ asset('js/bootstrap/bootstrap.min.js') }}"></script>
	<script src="{{ asset('js/payment/index.js') }}"></script>
</body>
</html>