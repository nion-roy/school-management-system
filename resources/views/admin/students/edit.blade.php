@extends('layouts.backend.app')

@section('title', 'Edit Students')

@section('main_content')

<div class="row">
	<div class="col-sm-12">

		<div class="card">
			<div class="card-header">
				<h5>Edit Students Details</h5>
			</div>
			<div class="card-body">

				<form action="{{ route('admin.all-student.update', $student->id) }}" method="post" enctype="multipart/form-data">
					@csrf
					@method('PUT')

					<div class="form-group row align-items-center">
						<label class="col-xl-2 col-sm-3 form-label mb-2 m-sm-0 text-sm-right text-start">Student Type</label>
						<div class="col-sm-1 text-center d-none d-sm-block">:</div>
						<div class="col-xl-9 col-sm-8">
							<select name="class_id" class="form-control select2 w-100">
								<option disabled selected> -- Selected Class -- </option>
								@foreach ($batches as $class)
								<option value="{{ $class->id }}" {{ $student->class_id == $class->id ? 'selected' : '' }}>{{ $class->batch }}</option>
								@endforeach
							</select>
						</div>
					</div>

					<div class="form-group row align-items-center">
						<label class="col-xl-2 col-sm-3 form-label mb-2 m-sm-0 text-sm-right text-start">Student Name</label>
						<div class="col-sm-1 text-center d-none d-sm-block">:</div>
						<div class="col-xl-9 col-sm-8">
							<select name="student_id" class="form-control select2 w-100">
								<option disabled selected> -- Selected Class -- </option>
								@foreach ($students as $user)
								<option value="{{ $user->id }}" {{ $student->student_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
								@endforeach
							</select>
						</div>
					</div>

					<div class="form-group row align-items-center">
						<label class="col-xl-2 col-sm-3 form-label mb-2 m-sm-0 text-sm-right text-start">Session</label>
						<div class="col-sm-1 text-center d-none d-sm-block">:</div>
						<div class="col-xl-9 col-sm-8">
							<input type="text" name="session" class="form-control" placeholder="Enter Session" value="{{ $student->session }}">
						</div>
					</div>

					<div class="form-group row align-items-center">
						<label class="col-xl-2 col-sm-3 form-label mb-2 m-sm-0 text-sm-right text-start">Roll No.</label>
						<div class="col-sm-1 text-center d-none d-sm-block">:</div>
						<div class="col-xl-9 col-sm-8">
							<input type="text" name="roll" class="form-control" placeholder="Enter Student Roll No." value="{{ $student->roll }}">
						</div>
					</div>

					<div class="form-group row align-items-center">
						<label class="col-xl-2 col-sm-3 form-label mb-2 m-sm-0 text-sm-right text-start">Register No.</label>
						<div class="col-sm-1 text-center d-none d-sm-block">:</div>
						<div class="col-xl-9 col-sm-8">
							<input type="text" name="register" class="form-control" placeholder="Enter Register No." value="{{ $student->register }}">
						</div>
					</div>

					<div class="form-group row align-items-center">
						<div class="offset-sm-2 col-sm-10">
							<button class="btn btn-danger waves-effect float-right" type="submit">Update Now</button>
							<a href="{{ route('admin.all-student.index') }}" class="btn btn-success waves-effect float-right mr-2"> <i class="fas fa-arrow-left mr-1"></i> Back</a>
						</div>
					</div>

				</form>

			</div>
		</div>
	</div>
</div>

@endsection