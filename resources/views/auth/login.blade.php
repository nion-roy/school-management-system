<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>{{ config('app.name') }} - Sign In</title>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

	<!-- Toastr Css -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css">


	<style>
		body {
			color: #000;
			overflow-x: hidden;
			height: 100%;
			background-color: #B0BEC5;
			background-repeat: no-repeat;
		}

		.card0 {
			box-shadow: 0px 4px 8px 0px #757575;
			border-radius: 0px;
		}

		.card2 {
			margin: 0px 40px;
		}

		.logo {
			width: 200px;
			height: 100px;
			margin-top: 20px;
			margin-left: 35px;
		}

		.image {
			width: 360px;
			height: 280px;
		}

		.border-line {
			border-right: 1px solid #EEEEEE;
		}

		.facebook {
			background-color: #3b5998;
			color: #fff;
			font-size: 18px;
			padding-top: 5px;
			border-radius: 50%;
			width: 35px;
			height: 35px;
			cursor: pointer;
		}

		.twitter {
			background-color: #1DA1F2;
			color: #fff;
			font-size: 18px;
			padding-top: 5px;
			border-radius: 50%;
			width: 35px;
			height: 35px;
			cursor: pointer;
		}

		.linkedin {
			background-color: #2867B2;
			color: #fff;
			font-size: 18px;
			padding-top: 5px;
			border-radius: 50%;
			width: 35px;
			height: 35px;
			cursor: pointer;
		}

		.line {
			height: 1px;
			width: 45%;
			background-color: #E0E0E0;
			margin-top: 10px;
		}

		.or {
			width: 10%;
			font-weight: bold;
		}

		.text-sm {
			font-size: 14px !important;
		}

		::placeholder {
			color: #BDBDBD;
			opacity: 1;
			font-weight: 300
		}

		:-ms-input-placeholder {
			color: #BDBDBD;
			font-weight: 300
		}

		::-ms-input-placeholder {
			color: #BDBDBD;
			font-weight: 300
		}

		input,
		textarea {
			padding: 10px 12px 10px 12px;
			border: 1px solid lightgrey;
			border-radius: 2px;
			margin-bottom: 5px;
			margin-top: 2px;
			width: 100%;
			box-sizing: border-box;
			color: #2C3E50;
			font-size: 14px;
			letter-spacing: 1px;
		}

		input:focus,
		textarea:focus {
			-moz-box-shadow: none !important;
			-webkit-box-shadow: none !important;
			box-shadow: none !important;
			border: 1px solid #304FFE;
			outline-width: 0;
		}

		button:focus {
			-moz-box-shadow: none !important;
			-webkit-box-shadow: none !important;
			box-shadow: none !important;
			outline-width: 0;
		}

		a {
			color: inherit;
			cursor: pointer;
		}

		.btn-blue {
			background-color: #1A237E;
			width: 150px;
			color: #fff;
			border-radius: 2px;
		}

		.btn-blue:hover {
			background-color: #000;
			color: #fff;
			cursor: pointer;
		}

		.bg-blue {
			color: #fff;
			background-color: #1A237E;
		}

		@media screen and (max-width: 991px) {
			.logo {
				margin-left: 0px;
			}

			.image {
				width: 300px;
				height: 220px;
			}

			.border-line {
				border-right: none;
			}

			.card2 {
				border-top: 1px solid #EEEEEE !important;
				margin: 0px 15px;
			}
		}
	</style>

</head>

<body>
	<div class="container-fluid px-1 px-md-5 px-lg-1 px-xl-5 py-5 mx-auto">
		<div class="card card0 border-0">
			<div class="row d-flex align-items-center justify-content-center">
				<div class="col-lg-6">
					<div class="card1 pb-5">\
						<div class="row px-3 justify-content-center mt-4 mb-5 border-line">
							<img src="https://bootstrapious.com/i/snippets/sn-registeration/illustration.svg" class="image">
							<p class="px-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquid molestias pariatur
								distinctio. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Iure quo ipsa doloremque in iste.
								Quisquam possimus a culpa quibusdam praesentium voluptate ipsam quasi?</p>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="card2 card border-0 px-4 py-5">
						{{-- <div class="row mb-4 px-3">
							<h6 class="mb-0 mr-4 mt-2">Sign in with</h6>
							<div class="facebook text-center mr-3">
								<div class="fa fa-facebook"></div>
							</div>
							<div class="twitter text-center mr-3">
								<div class="fa fa-twitter"></div>
							</div>
							<div class="linkedin text-center mr-3">
								<div class="fa fa-linkedin"></div>
							</div>
						</div>
						<div class="row px-3 mb-4">
							<div class="line"></div>
							<small class="or text-center">Or</small>
							<div class="line"></div>
						</div>--}}
						<div class="row px-3">
							<h2>LOGIN PANEL</h2>
						</div>
						<div class="row px-3 mb-4">
							<div class="line"></div>
							<div class="line"></div>
						</div>
						<form action="{{ route('login') }}" method="post">
							@csrf

							<div class="row px-3">
								<label class="mb-1">
									<h6 class="mb-0 text-sm">Email Address</h6>
								</label>
								<input class="mb-4" type="email" name="email" placeholder="Enter a valid email address" value="{{ old('email') }}">
							</div>

							<div class="row px-3">
								<label class="mb-1">
									<h6 class="mb-0 text-sm">Password</h6>
								</label>
								<input type="password" name="password" placeholder="Enter password">
							</div>

							<div class="row px-3 mb-4">
								<div class="custom-control custom-checkbox custom-control-inline">
									<input type="checkbox" name="remember" id="remember" class="custom-control-input">
									<label for="remember" class="custom-control-label text-sm">{{ __('Remember Me') }}</label>
								</div>
								<a href="" class="ml-auto mb-0 text-sm">Forgot Password?</a>
							</div>

							<div class="row mb-3 px-3">
								<button type="submit" class="btn btn-blue text-center">Login</button>
							</div>

							<div class="row mb-4 px-3">
								<small class="font-weight-bold">Don't have an account?
									<a href="{{ route('register') }}" class="text-danger ">Register</a>
								</small>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>


	<!-- Jquery Core Js -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
	<!-- Toastr Js -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>

	<!-- Sweet alert js files -->
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

	@include('sweetalert::alert')

	{!! Toastr::message() !!}

	<script>
		@if($errors->any())
			@foreach($errors->all() as $error)
				toastr.error('{{ $error }}','Error',{
					progressBar:'true',
					positionClass: 'toast-top-right',
				});
			@endforeach
    @endif
	</script>

</body>

</html>