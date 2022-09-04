<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Payment Completed</title>

	<style>
		@font-face {
			font-family: 'Roboto-Flex';
			src: url('{{ asset("fonts/roboto_flex/RobotoFlex-Regular.ttf") }}');
			font-weight: 400;
		}
	</style>
	<link rel="stylesheet" href="{{ asset('css/bootstrap/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('css/payment/complete.css') }}">
</head>
<body>
	<div class="container">
		<div class="text-center logo"><img src="{{ asset('imgs/logo.jpeg') }}" alt="Logo"></div>
		<h1 class="text-center heading">Conference Registration</h1>

		<h2 class="text-center subheading">Thank you! Your registration was submitted successfully, You will receive a confirmation email shortly</h2>
	</div>

	<script src="{{ asset('js/bootstrap/bootstrap.min.js') }}"></script>
</body>
</html>