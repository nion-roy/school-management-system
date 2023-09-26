@extends('layouts.frontend.app')

@section('title')
{{ $admissions->name }}
@endsection

@section('main_content')


<div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s" style="background-image: linear-gradient(rgba(15, 66, 41, 0.6), rgba(15, 66, 41, 0.6)), url( {{ Storage::disk('public')->url('setting/'.$f_settings->banner) }})">
	<div class="container text-center py-5">
		<h1 class="display-3 text-white mb-4  slideInDown">{{ $admissions->name }}</h1>
		<nav aria-label="breadcrumb animated slideInDown">
			<ol class="breadcrumb justify-content-center mb-0">
				<li class="breadcrumb-item"><a href="">Home</a></li>
				<li class="breadcrumb-item active" aria-current="page">{{ $admissions->name }}</li>
			</ol>
		</nav>
	</div>
</div>


<!-- Projects Start -->
<div class="container-xxl py-5">
	<div class="container">
		<div class="row g-4">

			@foreach ($admissionDetails as $item)
			@if ($admissions->id == $item->admission_id)

			<div class="col-lg-4 col-md-6 portfolio-item wow fadeInUp" data-wow-delay="0.1s">
				<div class="portfolio-inner rounded">
					<img class="img-fluid" src="{{ Storage::disk('public')->url('admission/' . $item->image) }}" alt="{{ $item->subject }}">
					<div class="portfolio-info">
						<h4 class="m-0">{{ $item->subject }}</h4>
					</div>
					<div class="portfolio-text">
						<h4 class="text-white mb-4">{{ $item->subject }}</h4>
						<div class="d-flex">
							<a class="btn btn-lg-square rounded-circle mx-2" href="{{ route('admission.details', $item->id) }}"><i class="fa fa-eye"></i></a>
						</div>
					</div>
				</div>
			</div>

			@endif
			@endforeach


		</div>
	</div>
</div>
<!-- Projects End -->


@endsection