@extends('layouts.frontend.app')

@if (isset($notice))
@section('title')
{{ $notice->title }}
@endsection
@endif

@if (isset($notices))
@section('title', 'All Notices')
@endif

@section('main_content')


<!-- Page Header Start -->
@if (isset($notice))
<div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s" style="background-image: linear-gradient(rgba(15, 66, 41, 0.6), rgba(15, 66, 41, 0.6)), url( {{ Storage::disk('public')->url('setting/'.$f_settings->banner) }})">
	<div class="container text-center py-5">
		<h1 class="display-3 text-white mb-4 animated slideInDown">{{ Str::words($notice->title, 3) }}</h1>
		<nav aria-label="breadcrumb animated slideInDown">
			<ol class="breadcrumb justify-content-center mb-0">
				<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
				<li class="breadcrumb-item active" aria-current="page">Notice</li>
			</ol>
		</nav>
	</div>
</div>
@endif


@if (isset($notices))
<div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
	<div class="container text-center py-5">
		<h1 class="display-3 text-white mb-4 animated slideInDown">All Notices</h1>
		<nav aria-label="breadcrumb animated slideInDown">
			<ol class="breadcrumb justify-content-center mb-0">
				<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
				<li class="breadcrumb-item active" aria-current="page">All Notices</li>
			</ol>
		</nav>
	</div>
</div>
@endif
<!-- Page Header End -->


<!-- Notice Start -->
<div class="container pb-5">
	<div class="row">
		<div class="col-md-8">
			<div class="row" id="left_artical">


				@if (isset($notice))

				<div class="col-12 mb-3">
					<div class="border">
						<div class="col-12 px-4 py-2 bg-success">
							<h5 class="m-0 fw-bold text-white">নোটিশ</h5>
						</div>
					</div>

				</div>

				<div class="col-12">
					<div class="border p-2">
						<ul class="navbar-nav">
							<li class="nav-item"><a class="nav-link py-1" href="{{ Storage::disk('public')->url('notice/' . $notice->notice) }}"><i class="fas fa-download me-2"></i> {{ Str::words($notice->title, 8, '...') }} <span class="float-end">তারিখ: {{ $notice->created_at->format('d-M-Y') }}</span></a></li>
						</ul>
					</div>
				</div>

				@endif


				@if (isset($notices))
				<div class="col-12 mb-3">
					<div class="border">
						<div class="col-12 px-4 py-2 bg-success">
							<h5 class="m-0 fw-bold text-white">নোটিশ বোর্ড</h5>
						</div>
					</div>
				</div>

				<div class="col-12">
					<div class="border p-2">
						<ul class="navbar-nav">
							@foreach ($notices as $notice)
							<li class="nav-item"><a class="nav-link py-1" href="{{ Storage::disk('public')->url('notice/' . $notice->notice) }}"><i class="fas fa-download me-2"></i> {{ Str::words($notice->title, 8, '...') }} <span class="float-end">তারিখ: {{ $notice->created_at->format('d-M-Y') }}</span></a></li>
							@endforeach
						</ul>
					</div>

					<div class="mt-3">
						{{ $notices->links('pagination::bootstrap-5') }}
					</div>

				</div>
				@endif

			</div>
		</div>

		<div class="col-md-4 col-12" id="right_artical">

			<div class="speech_row">
				@foreach ($f_speeches as $speech)
				<div class="row speech_content">
					<div class="col-12">
						<h5 class="m-0 fw-bold text-white px-4 py-2 bg-success">{{ $speech->title }}</h5>
					</div>
					<div class="col-12">
						<div class="bg-light p-3">
							<img class="img-fluid img-thumbnail mb-3 mx-auto d-block" src="{{ Storage::disk('public')->url('about/'.$speech->image) }}" alt="{{ $speech->title }}" style="width: 120px; height: 120px;">
							<p>{!! Str::limit(strip_tags($speech->speech), 130) !!}<a href="{{ route('speech', $speech->slug) }}">Read More</a> </p>
						</div>
					</div>
				</div>
				<hr>
				@endforeach
			</div>

			<hr>

			<div class="more_info">
				<div class="row">
					<div class="col-12">
						@foreach ($f_udpdateNews as $udpdateNews)
						<a href="{{ Storage::disk('public')->url('news/update/' . $udpdateNews->file) }}" class="text-white bg-danger d-block py-2 px-2 mb-2"><i class="fas fa-hand-point-right me-2"></i> {{ $udpdateNews->title }} </a>
						@endforeach
						<a href="" class="text-white bg-danger d-block py-2 px-2 mb-2"><i class="fas fa-hand-point-right me-2"></i> ফটোগ্যালারি</a>
						<a href="" class="text-white bg-danger d-block py-2 px-2"><i class="fas fa-hand-point-right me-2"></i> ভিডিও গ্যালারি</a>
					</div>
				</div>
			</div>

			<hr>

			<div class="more_info_two">
				<div class="row">
					<div class="col-12">
						<h5 class="m-0 fw-bold text-white px-4 py-2 bg-success">গুরুত্বপূর্ণ তথ্য</h5>
					</div>
					<div class="col-12">
						<div class="bg-light p-3">
							<ul class="navbar-nav">

								@foreach ($f_inportantNews as $importantNews)
								<li class="nav-item"><a class="nav-link py-0" href="{{ $importantNews->links }}"><i class="fas fa-check-square me-2"></i> {{ $importantNews->title }} </a></li>
								@endforeach
							</ul>
						</div>
					</div>
				</div>
			</div>



			{{-- <div class="more_info_two">
				<div class="row">
					<div class="col-12">
						<h5 class="m-0 fw-bold text-white px-4 py-2 bg-success">অফিসিয়াল লিংক</h5>
					</div>
					<div class="col-12">
						<div class="bg-light p-3">
							<ul class="navbar-nav">
								<li class="nav-item"><a class="nav-link py-0" href=""><i class="fas fa-check-square me-2"></i> ই-বুক</a></li>
								<li class="nav-item"><a class="nav-link py-0" href=""><i class="fas fa-check-square me-2"></i> শিক্ষক বাতায়ন</a></li>
								<li class="nav-item"><a class="nav-link py-0" href=""><i class="fas fa-check-square me-2"></i> কর্মকর্তা কর্মচারী</a></li>
								<li class="nav-item"><a class="nav-link py-0" href=""><i class="fas fa-check-square me-2"></i> মাল্টিমিডিয়া ক্লাসরুম ম্যানেজমেন্ট</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div> --}}

		</div>
	</div>
</div>
<!-- Notice End -->



@endsection