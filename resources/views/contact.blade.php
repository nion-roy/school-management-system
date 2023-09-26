@extends('layouts.frontend.app')

@section('title', 'Contact Us')

@section('main_content')

@push('css')
<style>
	iframe {
		display: block;
		width: 100%;
		height: 100%;
	}
</style>
@endpush

<!-- Page Header Start -->
<div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s" style="background-image: linear-gradient(rgba(15, 66, 41, 0.6), rgba(15, 66, 41, 0.6)), url( {{ Storage::disk('public')->url('setting/'.$f_settings->banner) }})">
	<div class="container text-center py-5">
		<h1 class="display-3 text-white mb-4 animated slideInDown">Contact Us</h1>
		<nav aria-label="breadcrumb animated slideInDown">
			<ol class="breadcrumb justify-content-center mb-0">
				<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
				<li class="breadcrumb-item active" aria-current="page">Contact</li>
			</ol>
		</nav>
	</div>
</div>
<!-- Page Header End -->


<!-- Contact Start -->
<div class="container-xxl py-5">
	<div class="container">
		<div class="row g-5">
			<div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
				<p class="fs-5 fw-bold text-primary">Contact Us</p>
				<h1 class="display-5 mb-5">If You Have Any Query, Please Contact Us</h1>
				<p class="mb-4">The contact form is currently inactive. Get a functional and working contact form with Ajax & PHP in a few minutes. Just copy and paste the files, add a little code and you're done.</p>
				<form action="{{ route('contact-us.store') }}" method="post">
					@csrf

					<div class="row">
						<div class="col-12">
							@if(Session::has('flash_message'))
							<div class="alert alert-success">
								{{ Session::get('flash_message') }}
							</div>
							@endif
						</div>
					</div>

					<div class="row g-3">
						<div class="col-md-6">
							<div class="form-floating">
								<input type="text" class="form-control" id="name" name="name" placeholder="Your Name" value="{{ old('name') }}">
								<label for="name">Your Name</label>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-floating">
								<input type="email" class="form-control" id="email" name="email" placeholder="Your Email" value="{{ old('email') }}">
								<label for="email">Your Email</label>
							</div>
						</div>
						<div class="col-12">
							<div class="form-floating">
								<input type="text" class="form-control" id="subject" name="subject" placeholder="Subject" value="{{ old('subject') }}">
								<label for="subject">Subject</label>
							</div>
						</div>
						<div class="col-12">
							<div class="form-floating">
								<textarea class="form-control" name="message" placeholder="Leave a message here" id="message" style="height: 100px"></textarea>
								<label for="message">Message</label>
							</div>
						</div>
						<div class="col-12">
							<button class="btn btn-primary py-3 px-4" type="submit">Send Message</button>
						</div>
					</div>
				</form>
			</div>
			<div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s" style="min-height: 450px;">
				<div class="position-relative rounded overflow-hidden h-100">
					{!! $f_settings->iframe ?? null !!}
					<!-- <iframe class="position-relative w-100 h-100" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3001156.4288297426!2d-78.01371936852176!3d42.72876761954724!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4ccc4bf0f123a5a9%3A0xddcfc6c1de189567!2sNew%20York%2C%20USA!5e0!3m2!1sen!2sbd!4v1603794290143!5m2!1sen!2sbd" frameborder="0" style="min-height: 450px; border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe> -->
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Contact End -->

@endsection