@extends('layouts.backend.app')

@section('title', 'Profile')

@section('main_content')

<h2>Profile Setting</h2>

<div class="row">
	<div class="col-xl-5 col-lg-4 col-12 text-center">
		<div class="card">
			<div class="card-body">
				<div id="user_img" class="mx-auto mb-2">
					<img src="{{ Storage::disk('public')->url('profile/' . Auth::user()->image) }}" class="img-fluid rounded-circle shadow img-thumbnail" alt="{{ Auth::user()->name }}">
				</div>
				<h4><strong>{{ Str::ucfirst(Auth::user()->name ?? null ) }}</strong></h4>
				<hr>
				<p>{{ Auth::user()->about }}</p>
			</div>
		</div>
	</div>

	<div class="col-xl-7 col-lg-8 col-12">
		<form action="{{ route('teacher.updateProfile') }}" method="post" enctype="multipart/form-data">
			@csrf

			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Change Your Inforamtion</h5>
				</div>
				<div class="card-body">
					<div class="form-group row align-items-center">
						<label class="col-sm-3 form-label m-0 text-sm-right">Full Name</label>
						<div class="col-sm-1 text-center d-none d-sm-block">:</div>
						<div class="col-sm-8">
							<input type="text" name="name" class="form-control" placeholder="Enter Full Name" value="{{ Auth::user()->name }}">
						</div>
					</div>


					<div class="form-group row align-items-center">
						<label class="col-sm-3 form-label m-0 text-sm-right">Email</label>
						<div class="col-sm-1 text-center d-none d-sm-block">:</div>
						<div class="col-sm-8">
							<input type="text" name="email" class="form-control" placeholder="Enter Email" value="{{ Auth::user()->email }}">
						</div>
					</div>

					<div class="form-group row align-items-center">
						<label class="col-sm-3 form-label m-0 text-sm-right">About Us</label>
						<div class="col-sm-1 text-center d-none d-sm-block">:</div>
						<div class="col-sm-8">
							<textarea name="about" id="" cols="30" rows="4" class="form-control" placeholder="Enter About Us....">{{ Auth::user()->about }}</textarea>
						</div>
					</div>

					<div class="form-group row align-items-center">
						<label class="col-sm-3 form-label m-0 text-sm-right">Photo</label>
						<div class="col-sm-1 text-center d-none d-sm-block">:</div>
						<div class="col-sm-8">
							<input type="file" id="image" name="image">
						</div>
					</div>

					<button class="btn btn-success waves-effect float-right">Update Now</button>

				</div>
			</div>
		</form>

		<form action="{{ route('teacher.updatePassword') }}" method="post">
			@csrf

			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Change Your Password</h5>
				</div>
				<div class="card-body">
					<div class="form-group row align-items-center">
						<label class="col-sm-3 form-label m-0 text-sm-right">Old Password</label>
						<div class="col-sm-1 text-center d-none d-sm-block">:</div>
						<div class="col-sm-8">
							<input type="password" name="old_password" class="form-control" placeholder="Enter Old Password">
						</div>
					</div>

					<div class="form-group row align-items-center">
						<label class="col-sm-3 form-label m-0 text-sm-right">New Password</label>
						<div class="col-sm-1 text-center d-none d-sm-block">:</div>
						<div class="col-sm-8">
							<input type="password" name="password" class="form-control" placeholder="Enter New Password">
						</div>
					</div>

					<div class="form-group row align-items-center">
						<label class="col-sm-3 form-label m-0 text-sm-right">Confrome Password</label>
						<div class="col-sm-1 text-center d-none d-sm-block">:</div>
						<div class="col-sm-8">
							<input type="password" name="password_confirmation" class="form-control" placeholder="Enter Your Confrom Password">
						</div>
					</div>

					<button class="btn btn-success waves-effect float-right">Update Now</button>

				</div>
			</div>
		</form>
	</div>

</div>

@endsection