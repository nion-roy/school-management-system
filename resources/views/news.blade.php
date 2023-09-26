@extends('layouts.frontend.app')

@section('title', 'Latest News')

@section('main_content')

<!-- Page Header Start -->
<div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s" style="background-image: linear-gradient(rgba(15, 66, 41, 0.6), rgba(15, 66, 41, 0.6)), url( {{ Storage::disk('public')->url('setting/'.$f_settings->banner) }})">
	<div class="container text-center py-5">
		<h1 class="display-3 text-white mb-4 animated slideInDown">Latest News</h1>
		<nav aria-label="breadcrumb animated slideInDown">
			<ol class="breadcrumb justify-content-center mb-0">
				<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
				<li class="breadcrumb-item active" aria-current="page">Latest News</li>
			</ol>
		</nav>
	</div>
</div>
<!-- Page Header End -->

<!-- Projects Start -->
<div class="container-xxl py-5">
	<div class="container">
		{{-- <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s">
			<p class="fs-5 fw-bold text-primary">Our Photo Gallery</p>
			<h1 class="display-5 mb-5">Some Of Our valuable Moments</h1>
		</div> --}}

		<div class="row g-4">

			@foreach ($newses as $news)
			<div class="col-lg-4 col-md-6 portfolio-item wow fadeInUp" data-wow-delay="0.1s">
				<div class="portfolio-inner rounded">
					<img class="img-fluid" src="{{ Storage::disk('public')->url('news/' . $news->image) }}" alt="{{ $news->title }}">
					<div class="portfolio-text">
						<h4 class="text-white mb-4">{{ $news->title }}</h4>
						<div class="d-flex">
							<a class="btn btn-lg-square rounded-circle mx-2" href="{{ Storage::disk('public')->url('news/' . $news->image) }}" data-lightbox="portfolio"><i class="fa fa-eye"></i></a>
							<a class="btn btn-lg-square rounded-circle mx-2" href="{{ route('news-details' , $news->slug) }}"><i class="fa fa-link"></i></a>
						</div>
					</div>
				</div>
			</div>
			@endforeach

			{{ $newses->onEachSide(1)->links('pagination::bootstrap-5') }}

		</div>
	</div>
</div>
<!-- Projects End -->


@endsection