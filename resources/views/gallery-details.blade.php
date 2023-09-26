@extends('layouts.frontend.app')

@section('title')
{{ $imageGalleryDetails->title }}
@endsection

@section('main_content')

<!-- Page Header Start -->
<div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s" style="background-image: linear-gradient(rgba(15, 66, 41, 0.6), rgba(15, 66, 41, 0.6)), url( {{ Storage::disk('public')->url('setting/'.$f_settings->banner) }})">
	<div class="container text-center py-5">
		<h1 class="display-3 text-white mb-4 animated slideInDown">Gallery</h1>
		<nav aria-label="breadcrumb animated slideInDown">
			<ol class="breadcrumb justify-content-center mb-0">
				<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
				<li class="breadcrumb-item active" aria-current="page">Gallery Detials</li>
			</ol>
		</nav>
	</div>
</div>
<!-- Page Header End -->

<!-- Projects Start -->
<div class="container-xxl py-5">
	<div class="container">
		<div class="row">
			<div class="col-md-5 mx-auto mb-3">
				<img src="{{ Storage::disk('public')->url('gallery/image/' . $imageGalleryDetails->gallery) }}" class="img-fluid rounded shadow" alt="{{ $imageGalleryDetails->title }}">
			</div>
			<div class="col-12">
				<div class="mb-4">
					<h4 class="mt-4">{{ $imageGalleryDetails->title }}</h4>
					<span class="me-3"> <strong><i class="fas fa-user text-success"></i> Posted by:</strong> {{ Auth::user()->name }}</span>
					<span> <strong><i class="far fa-clock text-success"></i> Published:</strong> {{ $imageGalleryDetails->created_at->format('d M, Y') }}</span>

				</div>
				{!! $imageGalleryDetails->description !!}
			</div>
		</div>
	</div>
</div>
<!-- Projects End -->


@endsection