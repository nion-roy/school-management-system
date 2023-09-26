@extends('layouts.backend.app')

@section('title', 'Profile')

@section('main_content')

@push('css')
<style>
	#user_img {
		width: 160px;
		height: 160px;
	}
</style>
@endpush

<div class="row">
	<div class="col-xl-5 col-lg-4 col-12 text-center">
		<div class="card border-top border-primary">
			<div class="card-body">
				<div id="user_img" class="mx-auto mb-2">
					<img src="{{ Storage::disk('public')->url('user/' . $student->student->image) }}" class="img-fluid rounded-circle border-primary shadow img-thumbnail" alt="{{ $student->student->name }}">
				</div>
				<h4><strong>{{ $student->student->name ?? null }}</strong></h4>
				<p class="text-primary m-0"><strong> <span class="far fa-envelope me-2"></span> {{ $student->student->email }}</strong> </p>
				<p class="text-primary"><strong> <i class="fas fa-phone"></i> +88{{ $student->student->contact }}</strong> </p>
				<hr>
				<p>{{ $student->about ?? null }}</p>
			</div>
		</div>

		<div class="card border-top border-primary">
			<div class="card-header">
				<h5 class="card-title">Address Inforamtion</h5>
			</div>
			<div class="card-body">

			</div>
		</div>

	</div>

	<div class="col-xl-7 col-lg-8 col-12">

		<div class="card border-top border-primary">
			<div class="card-header">
				<h5 class="card-title">Academic Inforamtion</h5>
			</div>
			<div class="card-body">

			</div>
		</div>

		<div class="card border-top border-primary">
			<div class="card-header">
				<h5 class="card-title">Guardian Inforamtion</h5>
			</div>
			<div class="card-body">
				<div class="row mb-2">
					<div class="col-lg-3">
						<spam>Father's Name</span>
					</div>
					<div class="col-lg-1 text-center">:</div>
					<div class="col-lg-8">
						<spam>{{ $student->father_name ?? null }}</span>
					</div>
				</div>
				<div class="row mb-2">
					<div class="col-lg-3">
						<span>Father's Contact</span>
					</div>
					<div class="col-lg-1 text-center">:</div>
					<div class="col-lg-8">
						<span>{{ $student->father_contact ?? null }}</span>
					</div>
				</div>
				<div class="row mb-2">
					<div class="col-lg-3">
						<span>Mother's Name</span>
					</div>
					<div class="col-lg-1 text-center">:</div>
					<div class="col-lg-8">
						<span>{{ $student->mother_name ?? null }}</span>
					</div>
				</div>
				<div class="row mb-2">
					<div class="col-lg-3">
						<span>Mother's Contact</span>
					</div>
					<div class="col-lg-1 text-center">:</div>
					<div class="col-lg-8">
						<span>{{ $student->mother_contact ?? null }}</span>
					</div>
				</div>
			</div>
		</div>



	</div>

</div>

@endsection