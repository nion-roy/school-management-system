<!-- Footer Start -->
{{-- <div class="text-light bg-dark footer py-5">
	<div class="container py-5">
		<div class="row g-5">

			<div class="col-lg-3 col-md-6">
				<h4 class="text-white mb-4">Courses</h4>
				@foreach ($f_admission as $admission)
				<a href="{{ route('admission', $admission->slug) }}" class="btn btn-link">{{ $admission->name }}</a>
				@endforeach
			</div>
			<div class="col-lg-3 col-md-6">
				<h4 class="text-white mb-4">Quick Links</h4>
				<a class="btn btn-link" href="{{ route('about') }}">About Us</a>
				<a class="btn btn-link" href="{{ route('contact-us.index') }}">Contact Us</a>
				<a class="btn btn-link" href="">Our Services</a>
				<a class="btn btn-link" href="">Terms & Condition</a>
				<a class="btn btn-link" href="">Support</a>
			</div>

			<div class="col-lg-3 col-md-6">
				<h4 class="text-white mb-4">Our Location On Map</h4>

				<div class="position-relative w-100 p-2">
					{!! $contactMap->iframe ?? null !!}
				</div>
			</div>

			<div class="col-lg-3 col-md-6">
				<h4 class="text-white mb-4">Hot Line</h4>

				<p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+8801724632416 </p>
				<p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+8801990033716 </p>
			</div>
		</div>
	</div>
</div> --}}
<!-- Footer End -->

<!-- Copyright Start -->
<div class="copyright py-4">
	<div class="container">
		<div class="row">
			<div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
				Copyright &copy; {{ date('Y') }} <a href="{{ route('home') }}">{{ $f_settings->wb_name }}</a> | All Right Reserved.
			</div>
			<div class="col-md-6 text-center text-md-end">
				Design Modify & Developed By <a class="border-bottom" href="https://www.facebook.com/nion.roy22">NION ROY</a>
			</div>
		</div>
	</div>
</div>
<!-- Copyright End -->