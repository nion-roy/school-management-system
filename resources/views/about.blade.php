@extends('layouts.frontend.app')

@section('title', 'About Us')

@section('main_content')


@push('css')
<style>
	.facts {
		background-position: center !important;
		background-size: cover !important;
		background-attachment: fixed !important;
	}
</style>
@endpush

<!-- Page Header Start -->
{{-- <div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s" style="background: url()"> --}}
	<div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s" style="background-image: linear-gradient(rgba(15, 66, 41, 0.6), rgba(15, 66, 41, 0.6)), url( {{ Storage::disk('public')->url('setting/'.$f_settings->banner) }})">
		<div class="container text-center py-5">
			<h1 class="display-3 text-white mb-4 animated slideInDown">About Us</h1>
			<nav aria-label="breadcrumb animated slideInDown">
				<ol class="breadcrumb justify-content-center mb-0">
					<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
					<li class="breadcrumb-item active" aria-current="page">About</li>
				</ol>
			</nav>
		</div>
	</div>
	<!-- Page Header End -->

	<!-- About Start -->
	<div class="container-xxl py-5">
		<div class="container">
			<div class="row g-5">
				<div class="col-lg-8 col-md-8 wow fadeInUp" data-wow-delay="0.3s">
					<h1 class="display-5 mb-4">{{ $f_about->title ?? null }}</h1>
					<p class="mb-4 text-justify">{!! $f_about->description ?? null !!}</p>
				</div>

				<div class="col-lg-4 col-md-4 wow fadeInUp" data-wow-delay="0.1s">
					<img class="img-fluid rounded" data-wow-delay="0.1s" src="{{ Storage::disk('public')->url('about/' . $f_about->image ) }}" alt="{{ $f_about->title ?? null }}">
				</div>

			</div>
		</div>
	</div>
	<!-- About End -->

	<!-- Facts Start -->
	<div class="container-fluid facts my-5 py-5" style="background-image: linear-gradient(rgba(15, 66, 41, 0.6), rgba(15, 66, 41, 0.6)), url( {{ Storage::disk('public')->url('setting/'.$f_settings->banner) }})">
		<div class="container py-5">
			<div class="row g-5">

				@foreach ($f_facts as $facts)
				<div class="col-sm-6 col-lg-3 text-center wow fadeIn" data-wow-delay="0.1s">
					<h1 class="display-4 text-white" data-toggle="counter-up">{{ $facts->counter }}</h1>
					<span class="fs-5 fw-semi-bold text-light">{{ $facts->header }}</span>
				</div>
				@endforeach

			</div>
		</div>
	</div>
	<!-- Facts End -->

	<!-- Chairman Message Start -->
	{{-- <div class="container-xxl py-5">
		<div class="container">
			<div class="row g-5">
				<div class="col-lg-4 col-md-4 wow fadeInUp" data-wow-delay="0.1s">
					<img class="img-fluid rounded" data-wow-delay="0.1s" src="{{ Storage::disk('public')->url('about/' . $f_chairman->image) }}" alt="{{ $f_chairman->title }}">
				</div>
				<div class="col-lg-8 col-md-8 wow fadeInUp" data-wow-delay="0.3s">
					<h1 class="display-5 mb-4">{{ $f_chairman->title }}</h1>
					<p class="mb-4 text-justify"> {{ $f_chairman->description }}</p>
				</div>
			</div>
		</div>
	</div> --}}
	<!-- Chairman Message End -->

	<!-- Mission Start -->
	<div class="container-xxl py-5">
		<div class="container">
			<div class="row g-5">
				<div class="col-lg-4 col-md-4 wow fadeInUp" data-wow-delay="0.1s">
					<img class="img-fluid rounded" data-wow-delay="0.1s" src="{{ Storage::disk('public')->url('about/' . $missions->image) }}" alt="{{ $missions->title }}">
				</div>
				<div class="col-lg-8 col-md-8 wow fadeInUp" data-wow-delay="0.3s">
					<h1 class="display-5 mb-4">{{ $missions->title }}</h1>
					<p class="mb-4 text-justify">{!! $missions->description !!}</p>
				</div>
			</div>
		</div>
	</div>
	<!-- Mission End -->

	<!-- Chairman Message Start -->
	<div class="container-xxl py-5">
		<div class="container">
			<div class="row g-5">
				<div class="col-lg-8 col-md-8 wow fadeInUp" data-wow-delay="0.3s">
					<h1 class="display-5 mb-4">{{ $visions->title }}</h1>
					<p class="mb-4 text-justify"> {!! $visions->description !!} </p>
				</div>
				<div class="col-lg-4 col-md-4 wow fadeInUp" data-wow-delay="0.1s">
					<img class="img-fluid rounded" data-wow-delay="0.1s" src="{{ Storage::disk('public')->url('about/' . $visions->image) }}" alt="{{ $visions->title }}">
				</div>
			</div>
		</div>
	</div>
	<!-- Chairman Message  End -->

	@endsection