@extends('layouts.frontend.app')

@section('title', 'Class Routine')

@section('main_content')

<!-- Page Header Start -->
<div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s" style="background-image: linear-gradient(rgba(15, 66, 41, 0.6), rgba(15, 66, 41, 0.6)), url( {{ Storage::disk('public')->url('setting/'.$f_settings->banner) }})">
	<div class="container text-center py-5">
		<h1 class="display-3 text-white mb-4 animated slideInDown">Latest Class Routine</h1>
		<nav aria-label="breadcrumb animated slideInDown">
			<ol class="breadcrumb justify-content-center mb-0">
				<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
				<li class="breadcrumb-item active" aria-current="page">Class Routine</li>
			</ol>
		</nav>
	</div>
</div>
<!-- Page Header End -->

<!-- Class Routine Start -->
<div class="container-xxl py-5">
	<div class="container">
		<div class="row">
			<div class="col-md-12">

				@foreach ($classRoutines as $class)
				<div class="full-notice mb-3 rounded">
					<div class="notice-btn"><strong><i class="fas fa-hand-point-right"></i></strong>
						@if (file_exists(public_path("storage/class/$class->pdf")))
						<a class="yourlink2116" href="{{ route('class-routines/download', $class->id) }}"><strong> {{ $class->title }} </strong></a>
						@endif
					</div>
					<div class="row">
						<div class="col-md-6" style="font-size: 14px;"><i class="fas fa-dungeon"></i> {{ $class->class->batch }}</div>
						<div class="col-md-2" style="font-size: 14px;"> <i class="fas fa-user-graduate"></i> {{ $class->type }} </div>
						<div class="col-md-3" style="font-size: 14px;"><i class="fas fa-calendar-alt"></i> {{ $class->created_at->format('d M Y') }}</div>
						<div class="col-md-1" style="font-size: 14px;"><i class="fas fa-eye"></i> {{ $class->view_count }}</div>
					</div>
				</div>
				@endforeach

			</div>

			{{ $classRoutines->onEachSide(1)->links('pagination::bootstrap-5') }}

		</div>
	</div>
</div>
<!-- Class Routine  End -->

@endsection