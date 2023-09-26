@extends('layouts.frontend.app')

@section('title', 'Achievement Students')

@section('main_content')


<!-- Page Header Start -->
<div class="container-fluid page-header py-5 wow fadeIn" data-wow-delay="0.1s" style="background-image: linear-gradient(rgba(15, 66, 41, 0.6), rgba(15, 66, 41, 0.6)), url( {{ Storage::disk('public')->url('setting/'.$f_settings->banner) }})">
	<div class="container text-center py-5">
		<h1 class="display-3 text-white mb-4 animated slideInDown">Achievement Student's</h1>
		<nav aria-label="breadcrumb animated slideInDown">
			<ol class="breadcrumb justify-content-center mb-0">
				<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
				<li class="breadcrumb-item active" aria-current="page">Achievement Student's</li>
			</ol>
		</nav>
	</div>
</div>
<!-- Page Header End -->


<!-- Student Start -->
<div class="container-xxl pt-5 px-0">
	<div class="container">

		<div class="row g-4 mb-5">

			@foreach ($students as $student)

			<div class="col-lg-3 col-md-4 wow fadeInUp" data-wow-delay="0.1s">
				<div class="team-item border rounded">
					<img class="img-fluid" src="{{ Storage::disk('public')->url('students/achievement/' . $student->image ) }}" alt="{{ $student->name }}">
					<div class="team-text">
						<h4 class="mb-0">{{ $student->name }}</h4>
						<p class="text-primary m-0">{{ $student->title }}</p>
					</div>
				</div>
			</div>

			@endforeach


		</div>
	</div>
	<!-- Student End -->

	@endsection