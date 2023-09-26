@extends('layouts.frontend.app')

@if (isset($imageGallery))
@section('title', 'Photo Gallery')
@else
@section('title', 'Video Gallery')
@endif

@section('main_content')

@push('css')
		<style>
			video{
				display: block;
				width: 100%;
				height: 100%;
			}
		</style>
@endpush

<!-- Page Header Start -->
<div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s" style="background-image: linear-gradient(rgba(15, 66, 41, 0.6), rgba(15, 66, 41, 0.6)), url( {{ Storage::disk('public')->url('setting/'.$f_settings->banner) }})">
	<div class="container text-center py-5">
		@if (isset($imageGallery))
		<h1 class="display-3 text-white mb-4 animated slideInDown">Our Photo Gallery</h1>
		<nav aria-label="breadcrumb animated slideInDown">
			<ol class="breadcrumb justify-content-center mb-0">
				<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
				<li class="breadcrumb-item active" aria-current="page">Photo Gallery</li>
			</ol>
		</nav>
		@else
		<h1 class="display-3 text-white mb-4 animated slideInDown">Our Video Gallery</h1>
		<nav aria-label="breadcrumb animated slideInDown">
			<ol class="breadcrumb justify-content-center mb-0">
				<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
				<li class="breadcrumb-item active" aria-current="page">Video Gallery</li>
			</ol>
		</nav>
		@endif

	</div>
</div>
<!-- Page Header End -->

<!-- Projects Start -->
<div class="container-xxl py-5">
	<div class="container">
		<div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s">
			@if (isset($imageGallery))
			<p class="fs-5 fw-bold text-primary">Our Photo Gallery</p>
			@else
			<p class="fs-5 fw-bold text-primary">Our Video Gallery</p>
			@endif
			<h1 class="display-5 mb-5">Some Of Our valuable Moments</h1>
		</div>

		<div class="row g-4">

			@if (isset($imageGallery))
			@foreach ($imageGallery as $gallery)
			<div class="col-lg-4 col-md-6 portfolio-item wow fadeInUp" data-wow-delay="0.1s">
				<div class="portfolio-inner rounded">
					<img class="img-fluid" src="{{ Storage::disk('public')->url('gallery/image/' . $gallery->gallery) }}" alt="{{ $gallery->title }}">
					<div class="portfolio-text">
						<h4 class="text-white mb-4">{{ $gallery->title }}</h4>
						<div class="d-flex">
							<a class="btn btn-lg-square rounded-circle mx-2" href="{{ Storage::disk('public')->url('gallery/image/' . $gallery->gallery) }}" data-lightbox="portfolio"><i class="fa fa-eye"></i></a>
							<a class="btn btn-lg-square rounded-circle mx-2" href="{{ route('image-details', $gallery->slug) }}"><i class="fa fa-link"></i></a>
						</div>
					</div>
				</div>
			</div>
			@endforeach

			{{ $imageGallery->onEachSide(1)->links('pagination::bootstrap-5') }}

			@endif


			@if (isset($imageVideo))
			@foreach ($imageVideo as $gallery)
			<div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
				<div class="rounded">
					<video controls style="w-100 d-block">
						<source src="{{ Storage::disk('public')->url('gallery/video/' . $gallery->gallery ) }}" type="video/mp4">
						Your browser does not support the video tag.
					</video>
				</div>
			</div>
			@endforeach

			{{ $imageVideo->onEachSide(1)->links('pagination::bootstrap-5') }}

			@endif

		</div>
	</div>
</div>
<!-- Projects End -->


@endsection