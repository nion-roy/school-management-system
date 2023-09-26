@extends('layouts.frontend.app')

@section('title')
{{ $teacherType->title }}
@endsection

@section('main_content')


<!-- Page Header Start -->
<div class="container-fluid page-header py-5 wow fadeIn" data-wow-delay="0.1s" style="background-image: linear-gradient(rgba(15, 66, 41, 0.6), rgba(15, 66, 41, 0.6)), url( {{ Storage::disk('public')->url('setting/'.$f_settings->banner) }})">
	<div class="container text-center py-5">
		<h1 class="display-3 text-white mb-4 animated slideInDown">{{ $teacherType->title }}</h1>
		<nav aria-label="breadcrumb animated slideInDown">
			<ol class="breadcrumb justify-content-center mb-0">
				<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
				<li class="breadcrumb-item active" aria-current="page">{{ $teacherType->title }}</li>
			</ol>
		</nav>
	</div>
</div>
<!-- Page Header End -->


<!-- Teacher Start -->
<div class="container-xxl pt-5 px-0">
	<div class="container">

		<div class="row g-4 mb-5">

			@foreach ($teachers as $teacher)
			@if ($teacher->tab_id == $teacherType->id)

			<div class="col-lg-3 col-md-4 wow fadeInUp" data-wow-delay="0.1s">
				<div class="team-item border rounded">
					<img class="img-fluid" src="{{ Storage::disk('public')->url('teacher/'.$teacher->image) }}" alt="{{ $teacher->name }}">
					<div class="team-text">
						<h4 class="mb-0">{{ $teacher->name }}</h4>
						<p class="text-primary m-0">{{ $teacher->title }}</p>
					</div>
					<div class="team-text team-text-hover">
						<div class="team-content">
							<h4 class="mb-0">{{ $teacher->name }}</h4>
							<p class="text-primary">{{ $teacher->title }}</p>
							<div class="team-social d-flex align-items-center justify-content-center">
								<a class="btn btn-square rounded-circle me-2" target="_blank" href="{{ $teacher->facebook }}"><i class="fab fa-facebook-f"></i></a>
								<a class="btn btn-square rounded-circle me-2" target="_blank" href="{{ $teacher->twitter }}"><i class="fab fa-twitter"></i></a>
								<a class="btn btn-square rounded-circle me-2" target="_blank" href="{{ $teacher->instagram }}"><i class="fab fa-instagram"></i></a>
							</div>
						</div>
					</div>
				</div>
			</div>

			@endif
			@endforeach


		</div>
	</div>
	<!-- Teacher End -->

	@endsection