<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>{{ $f_settings->wb_name }} - @yield('title') </title>

	<!-- Favicon -->
	<link href="{{ Storage::disk('public')->url('setting/' . $f_settings->wb_favicon) }}" rel="icon">

	<!-- Google Web Fonts -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Jost:wght@500;600;700&family=Open+Sans:wght@400;500&display=swap" rel="stylesheet">


	<!-- Toastr Css -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />

	<!-- Link Swiper's CSS -->
	<link rel="stylesheet" href="{{ asset('frontend') }}/css/swiper-bundle.min.css">

	<!-- Libraries Stylesheet -->
	<link href="{{ asset('frontend') }}/lib/animate/animate.min.css" rel="stylesheet">
	<link href="{{ asset('frontend') }}/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
	<link href="{{ asset('frontend') }}/lib/lightbox/css/lightbox.min.css" rel="stylesheet">

	<!-- Select2 -->
	{{-- <link rel="stylesheet" href="{{ asset('frontend') }}/lib/select2/css/select2.min.css">
	<link rel="stylesheet" href="{{ asset('frontend') }}/lib/select2-bootstrap4-theme/select2-bootstrap4.min.css"> --}}
	<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css'>

	<!-- Customized Bootstrap Stylesheet -->
	<link href="{{ asset('frontend') }}/css/bootstrap.min.css" rel="stylesheet">

	<!-- Template Stylesheet -->
	<link href="{{ asset('frontend') }}/css/style.css" rel="stylesheet">

	<!-- Icon Font Stylesheet -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
	@stack('css')

</head>



<body>
	<!-- Spinner Start -->
	<div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
		<div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;"></div>
	</div>
	<!-- Spinner End -->

	<div class="main">
		<!-- Topbar Start -->
		<div class="container bg-dark text-light px-0 py-2">
			<div class="row gx-0 ">
				<div class="col-lg-7 px-5 d-lg-flex text-center text-lg-start">
					<div class="me-3">
						<span class="fa fa-phone-alt me-2"></span>
						<span>+88{{ $f_settings->number_1 }}</span>
					</div>
					<div class="">
						<span class="far fa-envelope me-2"></span>
						<span>{{ $f_settings->email }}</span>
					</div>
				</div>
				<div class="col-lg-5 px-5 text-center text-lg-end">
					<div class="h-100 d-inline-flex align-items-center mx-n2">
						<span>Follow Us:</span>
						<a class="btn btn-link text-light" target="_blank" href="{{ $f_settings->facebook }}"><i class="fab fa-facebook-f"></i></a>
						<a class="btn btn-link text-light" target="_blank" href="{{ $f_settings->twiter }}"><i class="fab fa-twitter"></i></a>
						<a class="btn btn-link text-light" target="_blank" href="{{ $f_settings->linkedin }}"><i class="fab fa-linkedin-in"></i></a>
						<a class="btn btn-link text-light" target="_blank" href="{{ $f_settings->instagram }}"><i class="fab fa-instagram"></i></a>
					</div>
				</div>
			</div>
		</div>
		<!-- Topbar End -->

		<!-- Navbar Start -->
		@include('layouts.frontend.layouts.header')
		<!-- Navbar End -->

		@yield('main_content')

		@include('layouts.frontend.layouts.footer')
	</div>

	<!-- Back to Top -->
	<a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i class="bi bi-arrow-up"></i></a>

	<!-- JavaScript Libraries -->
	<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>

	<!-- Swiper JS -->
	<script src="{{ asset('frontend') }}/js/swiper-bundle.min.js"></script>
	<script src="{{ asset('frontend') }}/lib/wow/wow.min.js"></script>
	<script src="{{ asset('frontend') }}/lib/easing/easing.min.js"></script>
	<script src="{{ asset('frontend') }}/lib/waypoints/waypoints.min.js"></script>
	<script src="{{ asset('frontend') }}/lib/owlcarousel/owl.carousel.min.js"></script>
	<script src="{{ asset('frontend') }}/lib/counterup/counterup.min.js"></script>
	<script src="{{ asset('frontend') }}/lib/parallax/parallax.min.js"></script>
	<script src="{{ asset('frontend') }}/lib/isotope/isotope.pkgd.min.js"></script>
	<script src="{{ asset('frontend') }}/lib/lightbox/js/lightbox.min.js"></script>
	<!-- Select2 -->
	{{-- <script src="{{ asset('frontend') }}/lib/select2/js/select2.full.min.js"></script> --}}
	<script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js'></script>

	<!-- Template Javascript -->
	<script src="{{ asset('frontend') }}/js/main.js"></script>

	<!-- Initialize Swiper -->
	<script>
		var swiper = new Swiper(".partners", {
				slidesPerView: 3,
				spaceBetween: 20,
				loop: true,
				// Enabled autoplay mode
				autoplay: {
					delay: 5000,
					disableOnInteraction: false
				},

				// Responsive breakpoints
				breakpoints: {
					0: {
						slidesPerView: 2
					},
					460: {
						slidesPerView: 3
					},
					576: {
						slidesPerView: 4
					},
					768: {
						slidesPerView: 5
					},
					992: {
						slidesPerView: 6
					},
				},
				pagination: {
					el: ".swiper-pagination",
					clickable: true,
				},
				navigation: {
					nextEl: ".swiper-button-next",
					prevEl: ".swiper-button-prev",
				},
			});
	</script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
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

	<script>
		$(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
	});
	</script>

	@stack('js')

</body>

</html>