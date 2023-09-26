@extends('layouts.backend.app')

@section('title', 'Edit Achievement Students')

@section('main_content')

<div class="row">
	<div class="col-sm-12">

		<div class="card">
			<div class="card-header">
				<h5>Edit Achievement Students</h5>
			</div>
			<div class="card-body">

				<form action="{{ route('admin.achievement-student.update', $oldStudent->id) }}" method="post" enctype="multipart/form-data">
					@csrf
					@method('PUT')

					<div class="form-group row">
						<label class="col-xl-2 col-sm-3 form-label mb-2 m-sm-0 text-sm-right text-start">Student Type</label>
						<div class="col-sm-1 text-center d-none d-sm-block">:</div>
						<div class="col-xl-9 col-sm-8">
							<select name="student_type" class="form-control">
								<option disabled selected> -- Students Type -- </option>
								<option value="Achievement Student" {{ $oldStudent->student_type == 'Achievement Student' ? 'selected' : '' }}>Achievement Student</option>
								<option value="Former Student" {{ $oldStudent->student_type == 'Former Student' ? 'selected' : '' }}>Former Student</option>
							</select>
						</div>
					</div>

					<div class="form-group row">
						<label class="col-xl-2 col-sm-3 form-label mb-2 m-sm-0 text-sm-right text-start">Student Name</label>
						<div class="col-sm-1 text-center d-none d-sm-block">:</div>
						<div class="col-xl-9 col-sm-8">
							<input type="text" name="name" class="form-control" placeholder="Enter Student Name" value="{{ $oldStudent->name }}">
						</div>
					</div>

					<div class="form-group row">
						<label class="col-xl-2 col-sm-3 form-label mb-2 m-sm-0 text-sm-right text-start">Student Title</label>
						<div class="col-sm-1 text-center d-none d-sm-block">:</div>
						<div class="col-xl-9 col-sm-8">
							<input type="text" name="title" class="form-control" placeholder="Enter Student Title" value="{{ $oldStudent->title }}">
						</div>
					</div>

					<div class="form-group row">
						<label class="col-xl-2 col-sm-3 form-label mb-2 m-sm-0 text-sm-right text-start">Image</label>
						<div class="col-sm-1 text-center d-none d-sm-block">:</div>
						<div class="col-xl-9 col-sm-8">
							<div id="imageContainer" class="border rounded mb-3 @if (!empty($oldStudent->image)) d-block @endif">
								<img src="{{ Storage::disk('public')->url('students/achievement/' . $oldStudent->image ) }}" alt="{{ $oldStudent->name }}" class="img-fluid img-thumbnail">
							</div>
							<input type="file" name="image" id="imageFile">
						</div>
					</div>

					<div class="form-group row">
						<label class="col-xl-2 col-sm-3 form-label mb-2 m-sm-0 text-sm-right text-start">Status</label>
						<div class="col-sm-1 text-center d-none d-sm-block">:</div>
						<div class="col-xl-9 col-sm-8">
							<div class="custom-control custom-checkbox">
								<input class="custom-control-input custom-control-input-danger" type="checkbox" id="customCheckbox4" name="status" {{ $oldStudent->status == true ? 'checked' : '' }}>
								<label for="customCheckbox4" class="custom-control-label">Published</label>
							</div>
						</div>
					</div>

					<div class="form-group row align-items-center">
						<div class="offset-sm-2 col-sm-10">
							<button class="btn btn-danger waves-effect float-right" type="submit">Update Now</button>
							<a href="{{ route('admin.achievement-student.index') }}" class="btn btn-success waves-effect float-right mr-2"> <i class="fas fa-arrow-left mr-1"></i> Back</a>
						</div>
					</div>

				</form>

			</div>
		</div>
	</div>
</div>

@endsection