<div class="container">
	<nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top p-0">
		<a href="{{ route('home') }}" class="navbar-brand d-flex align-items-center ms-4 ms-lg-5">
			{{-- <h2 class="m-0"> <img src="{{ asset('frontend') }}/img/prince-logo.png" width="90px" alt="Prince Education"> Prince Education</h2> --}}
			<h2 class="m-0"> <img src="{{ Storage::disk('public')->url('setting/' . $f_settings->wb_logo) }}" width="90px" alt="{{ $f_settings->wb_name }}"></h2>
		</a>
		<button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarCollapse">
			<div class="navbar-nav ms-auto p-4 p-lg-0">
				<a href="{{ route('home') }}" class="nav-item nav-link {{ request()->is('/') ? 'active' : '' }}">প্রচ্ছদ</a>

				<div class="nav-item dropdown">
					<a href="javascript:void(0)" class="nav-link dropdown-toggle {{ request()->is('about-us') || request()->is('teacher*') ? 'active' : '' }}" data-bs-toggle="dropdown">প্রশাসন</a>
					<div class="dropdown-menu bg-light m-0">
						<a href="{{ route('about') }}" class="dropdown-item {{ request()->is('about-us') ? 'active' : '' }}">আমাদের সম্পর্কে</a>
						<a href="" class="dropdown-item">বর্তমান শিক্ষক </a>
						<a href="" class="dropdown-item">প্রাক্তন শিক্ষক </a>
						{{-- @foreach ($f_teacherType as $type)
						<a href="{{ route('all.teachers', $type->id) }}" class="dropdown-item {{ request()->is('teachers/' . $type->id) ? 'active' : '' }}">{{ $type->title }}</a>
						@endforeach --}}
					</div>
				</div>

				<div class="nav-item dropdown">
					<a href="javascript:void(0)" class="nav-link dropdown-toggle {{ request()->is('results') || request()->is('exam-routines') || request()->is('class-routines') || request()->is('all-notice') ? 'active' : '' }}" data-bs-toggle="dropdown">একাডেমিক</a>
					<div class="dropdown-menu bg-light m-0">
						<a href="{{ route('result') }}" class="dropdown-item {{ request()->is('results') ? 'active' : '' }}">সকল ফলাফল</a>
						<a href="{{ route('exam-routines') }}" class="dropdown-item {{ request()->is('exam-routines') ? 'active' : '' }}">পরীক্ষার রুটিন</a>
						<a href="{{ route('class-routines') }}" class="dropdown-item {{ request()->is('class-routines') ? 'active' : '' }}">ক্লাস রুটিন</a>
						<a href="{{ route('all-notice') }}" class="dropdown-item {{ request()->is('all-notice') ? 'active' : '' }}">নোটিশ</a>
					</div>
				</div>

				<a href="{{ route('student-results') }}" class="nav-item nav-link {{ request()->is('student-results*') ? 'active' : '' }}">ফলাফল</a>

				<div class="nav-item dropdown">
					<a href="javascript:void(0)" class="nav-link dropdown-toggle {{ request()->is('image-gallery') || request()->is('video-gallery') ? 'active' : '' }}" data-bs-toggle="dropdown">গ্যালারি</a>
					<div class="dropdown-menu bg-light m-0">
						<a href="{{ route('image-gallery') }}" class="dropdown-item {{ request()->is('image-gallery') ? 'active' : '' }}">ফটো গ্যালারি</a>
						<a href="{{ route('video-gallery') }}" class="dropdown-item {{ request()->is('video-gallery') ? 'active' : '' }}">ভিডিও গ্যালারি</a>
					</div>
				</div>

				<a href="{{ route('news') }}" class="nav-item nav-link {{ request()->is('news*') ? 'active' : '' }}">খবর</a>
				<a href="{{ route('contact-us.index') }}" class="nav-item nav-link {{ request()->is('contact-us') ? 'active' : '' }}">যোগাযোগ</a>

			</div>

		</div>
	</nav>
</div>