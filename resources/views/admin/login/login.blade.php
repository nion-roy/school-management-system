<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<meta charset="utf-8">
	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>{{ config('app.name') }} - Admin Login</title>
	<!-- Toastr Css -->
	<link rel="stylesheet" href="{{ asset('backend') }}/plugins/toastr/toastr.min.css">

	<!-- Bootstrap 3.3.6 -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">

	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta/css/bootstrap.min.css'>
	<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css'>
	<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto'>

	<style>
		body {
			background: #222D32;
			font-family: 'Roboto', sans-serif;
		}

		.login-box {
			margin-top: 75px;
			height: auto;
			background: #1A2226;
			text-align: center;
			box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);
		}

		.login-key {
			height: 100px;
			font-size: 80px;
			line-height: 100px;
			background: -webkit-linear-gradient(#27EF9F, #0DB8DE);
			-webkit-background-clip: text;
			-webkit-text-fill-color: transparent;
		}

		.login-title {
			margin-top: 15px;
			text-align: center;
			font-size: 30px;
			letter-spacing: 2px;
			margin-top: 15px;
			font-weight: bold;
			color: #ECF0F5;
		}

		.login-form {
			margin-top: 25px;
			text-align: left;
		}

		input[type=text] {
			background-color: #1A2226;
			border: none;
			border-bottom: 2px solid #0DB8DE;
			border-top: 0px;
			border-radius: 0px;
			font-weight: bold;
			outline: 0;
			margin-bottom: 20px;
			padding-left: 0px;
			color: #ECF0F5;
		}

		input[type=password] {
			background-color: #1A2226;
			border: none;
			border-bottom: 2px solid #0DB8DE;
			border-top: 0px;
			border-radius: 0px;
			font-weight: bold;
			outline: 0;
			padding-left: 0px;
			margin-bottom: 20px;
			color: #ECF0F5;
		}

		.form-group {
			margin-bottom: 40px;
			outline: 0px;
		}

		.form-control:focus {
			border-color: inherit;
			-webkit-box-shadow: none;
			box-shadow: none;
			border-bottom: 2px solid #0DB8DE;
			outline: 0;
			background-color: #1A2226;
			color: #ECF0F5;
		}

		input:focus {
			outline: none;
			box-shadow: 0 0 0;
		}

		label {
			margin-bottom: 0px;
		}

		.form-control-label {
			font-size: 10px;
			color: #6C6C6C;
			font-weight: bold;
			letter-spacing: 1px;
		}

		.btn-outline-primary {
			border-color: #0DB8DE;
			color: #0DB8DE;
			border-radius: 0px;
			font-weight: bold;
			letter-spacing: 1px;
			box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
		}

		.btn-outline-primary:hover {
			background-color: #0DB8DE;
			right: 0px;
		}

		.login-btm {
			float: left;
		}

		.login-button {
			padding-right: 0px;
			text-align: right;
			margin-bottom: 25px;
		}

		.login-text {
			text-align: left;
			padding-left: 0px;
			color: #A2A4A4;
		}

		.loginbttm {
			padding: 0px;
		}

		#remember,
		.form-label {
			color: #0DB8DE;
			cursor: pointer;
		}
	</style>

</head>

<body>

	<div class="container">
		<div class="row">
			<div class="col-lg-3 col-md-2"></div>
			<div class="col-lg-6 col-md-8 login-box">
				<div class="col-lg-12 login-key">
					<img src="{{ Storage::disk('public')->url('setting/' . $f_settings->wb_logo) }}" class="img-fluid rounded-circle" style="width: 90px; height: 90px;" alt="{{ $f_settings->wb_name }}">
				</div>
				<div class="col-lg-12 login-title">
					ADMIN PANEL
				</div>

				<div class="col-lg-12 login-form">
					<div class="col-lg-12 login-form">
						<form action="{{ route('admin.login') }}" method="post">
							@csrf
							<div class="form-group">
								<label class="form-control-label">EMAIL</label>
								<input type="text" name="email" class="form-control" value="{{ old('email') }}">
							</div>
							<div class="form-group">
								<label class="form-control-label">PASSWORD</label>
								<input type="password" name="password" class="form-control">
							</div>
							<div class="form-group">
								<input type="checkbox" class="mr-2" id="remember" name="remember">
								<label class="form-label" for="remember">Remember Me</label>
							</div>

							<div class="col-lg-12 loginbttm">
								<div class="col-lg-6 login-btm login-text">
									<!-- Error Message -->
								</div>
								<div class="col-lg-6 login-btm login-button">
									<button type="submit" class="btn btn-outline-primary">LOGIN</button>
								</div>
							</div>
						</form>
					</div>
				</div>
				<div class="col-lg-3 col-md-2"></div>
			</div>
		</div>
	</div>

	<!-- partial -->


	<!-- jQuery -->
	<script src="{{ asset('backend') }}/plugins/jquery/jquery.min.js"></script>

	<!-- Toastr Js -->
	<script src="{{ asset('backend') }}/plugins/toastr/toastr.min.js"></script>

	<!-- Sweet alert js files -->
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

	@include('sweetalert::alert')

	{!! Toastr::message() !!}

	<!-- Toastr error handel -->
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