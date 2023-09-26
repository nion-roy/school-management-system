@extends('layouts.frontend.app')

@section('title','Home')

@section('main_content')

<!-- Carousel Start -->
<div class="container">
	<div id="header-carousel" class="carousel slide" data-bs-ride="carousel">
		<div class="carousel-inner">

			@foreach ($f_sliders as $key => $slider)
			<div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
				<img class="w-100" src="{{ Storage::disk('public')->url('slider/' . $slider->image) }}" alt="{{ $slider->title }}">
				<div class="carousel-caption">
					<div class="container">
						<div class="row justify-content-center">
							<div class="col-lg-12">
								{{-- <h2 class="display-3 text-white mb-5 animated slideInDown"> {{ $slider->title }} </h2> --}}
								{{-- <a href="{{ route('about') }}" class="btn btn-primary py-sm-3 px-sm-4">Explore More</a> --}}
							</div>
						</div>
					</div>
				</div>
			</div>
			@endforeach

		</div>
		<button class="carousel-control-prev" type="button" data-bs-target="#header-carousel" data-bs-slide="prev">
			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			<span class="visually-hidden">Previous</span>
		</button>
		<button class="carousel-control-next" type="button" data-bs-target="#header-carousel" data-bs-slide="next">
			<span class="carousel-control-next-icon" aria-hidden="true"></span>
			<span class="visually-hidden">Next</span>
		</button>
	</div>
</div>
<!-- Carousel End -->

<div class="pt-3 pb-5">
	<div class="container">
		<div class="bg-light px-0">
			<div class="update_news">
				<div class="row  p-0 m-0 align-items-center">
					<div class="col-xl-1 col-md-2 col-3 p-3 bg-success">
						<h5 class="m-0 text-white">ঘোষনা </h5>
					</div>
					<div class="col-xl-11 col-md-10 col-9 p-3">
						<marquee direction="left" scrollamount="4px" onmouseover="this.stop()" onmouseout="this.start()">
							@foreach ($announcement as $announcement)
							<a href="{{ route('announcement', $announcement->slug) }}" class="me-3"><i class="fas fa-dot-circle mr-2"></i> নগরবাড়ি মেরিটাইম স্কুল ও কলেজে ২০২৩ শিক্ষাবর্ষে ভর্তি চলছে</a>
							@endforeach
						</marquee>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- About Start -->
<div class="container pb-5">
	<div class="row">
		<div class="col-md-8">
			<div class="row" id="left_artical">

				<div class="col-12 mb-3">
					<div class="border">
						<div class="col-12 px-4 py-2 bg-success">
							<h5 class="m-0 fw-bold text-white">নোটিশ বোর্ড</h5>
						</div>
						<div class="col-12 px-4 py-2">
							<marquee direction="up" scrollamount="3px" onmouseover="this.stop()" onmouseout="this.start()">
								<ul class="navbar-nav">
									@foreach ($notice as $notice)
									<li class="nav-item"><a class="nav-link py-1" href="{{ route('notice.details', $notice->slug) }}"><i class="fas fa-download me-2"></i> {{ $notice->title }}<span class="float-end">তারিখ: {{ $notice->created_at->format('d-M-Y') }}</span></a></li>
									@endforeach
								</ul>
							</marquee>
						</div>
						<div class="col-12 text-end">
							<a href="{{ route('all-notice') }}" class="px-3 py-2 d-inline-block"><i class="fas fa-hand-point-right mr-2"></i> সকল নোটিশ</a>
						</div>
					</div>
				</div>

				<div class="col-xl-6 col-12 mb-3">

					<div class="border">
						<div class="col-12 px-4 py-2 bg-success">
							<h5 class="m-0 fw-bold text-white">ছাত্র-ছাত্রীদের তথ্য</h5>
						</div>
						<div class="col-12">
							<div class="row p-3">
								<div class="col-4">
									<img src="https://www.nmscbd.com/wp-content/themes/educational/images/menu01.jpg" alt="">
								</div>
								<div class="col-8">
									<ul class="navbar-nav">
										<li class="nav-item"><a class="nav-link py-0" href=""><i class="fas fa-check-square"></i> ছাত্র-ছাত্রীর আসন সংখ্যা</a></li>
										<li class="nav-item"><a class="nav-link py-0" href="{{ route('student') }}"><i class="fas fa-check-square"></i> কৃতি শিক্ষার্থী</a></li>
									</ul>
								</div>
							</div>
						</div>
					</div>

				</div>

				<div class="col-xl-6 col-12 mb-3">
					<div class="border">
						<div class="col-12 px-4 py-2 bg-success">
							<h5 class="m-0 fw-bold text-white">শিক্ষকদের তথ্য</h5>
						</div>
						<div class="col-12">
							<div class="row p-3">
								<div class="col-4">
									<img src="https://www.nmscbd.com/wp-content/themes/educational/images/menu02.jpg" alt="">
								</div>
								<div class="col-8">
									<ul class="navbar-nav"> 

										{{-- @foreach ($f_teacherType as $type)
										<li class="nav-item"><a class="nav-link py-0" href="{{ route('all.teachers', $type->id) }}"><i class="fas fa-check-square"></i> {{ $type->title }} </a></li>
										@endforeach --}}
										<li class="nav-item"><a class="nav-link py-0" href=""><i class="fas fa-check-square"></i> বর্তমান শিক্ষক </li>
										<li class="nav-item"><a class="nav-link py-0" href=""><i class="fas fa-check-square"></i> প্রাক্তন শিক্ষক </li>
										<li class="nav-item"><a class="nav-link py-0" href=""><i class="fas fa-check-square"></i> শুন্য পদের তালিকা </a></li>
										{{-- <li class="nav-item"><a class="nav-link py-0" href=""><i class="fas fa-check-square"></i> কর্মকর্তা কর্মচারী</a></li> --}}
										{{-- <li class="nav-item"><a class="nav-link py-0" href=""><i class="fas fa-check-square"></i> পরিচালনা পরিষদ</a></li> --}}
										{{-- <li class="nav-item"><a class="nav-link py-0" href=""><i class="fas fa-check-square"></i> প্রাক্তন শিক্ষক</a></li> --}}
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-xl-6 col-12 mb-3">
					<div class="border">
						<div class="col-12 px-4 py-2 bg-success">
							<h5 class="m-0 fw-bold text-white">একাডেমীক তথ্য</h5>
						</div>
						<div class="col-12">
							<div class="row p-3">
								<div class="col-4">
									<img src="https://www.nmscbd.com/wp-content/themes/educational/images/menu04.jpg" alt="">
								</div>
								<div class="col-8">
									<ul class="navbar-nav">
										@foreach ($academicInfo as $info)
										<li class="nav-item"><a class="nav-link py-0" href="{{ Storage::disk('public')->url('academic-information/' . $info->pdf) }}"><i class="fas fa-check-square"></i> {{ $info->typeAcademic->type }}</a></li>
										@endforeach
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-xl-6 col-12 mb-3">
					<div class="border">
						<div class="col-12 px-4 py-2 bg-success">
							<h5 class="m-0 fw-bold text-white">ডাউনলোড</h5>
						</div>
						<div class="col-12">
							<div class="row p-3">
								<div class="col-4">
									<img src="https://www.nmscbd.com/wp-content/themes/educational/images/menu03.jpg" alt="">
								</div>
								<div class="col-8">
									<ul class="navbar-nav">
										@foreach ($f_udpdateNews as $udpdateNews)
										<li class="nav-item"><a class="nav-link py-0" href="{{  Storage::disk('public')->url('news/update/' . $udpdateNews->file)  }}"><i class="fas fa-check-square"></i> {{ $udpdateNews->title }} </a></li>
										@endforeach
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>

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
						<a href="{{ route('image-gallery') }}" class="text-white bg-danger d-block py-2 px-2 mb-2"><i class="fas fa-hand-point-right me-2"></i> ফটোগ্যালারি</a>
						<a href="{{ route('video-gallery') }}" class="text-white bg-danger d-block py-2 px-2"><i class="fas fa-hand-point-right me-2"></i> ভিডিও গ্যালারি</a>
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
<!-- About End -->



@endsection