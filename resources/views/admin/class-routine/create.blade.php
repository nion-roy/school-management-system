@extends('layouts.backend.app')

@section('title', 'Add Class Routine')

@section('main_content')

<div class="row">
	<div class="col-sm-12">

		<div class="card">
			<div class="card-header">
				<h5>Add Class Routine</h5>
			</div>
			<div class="card-body">

				<form action="{{ route('admin.class-routine.store') }}" method="post" enctype="multipart/form-data">
					@csrf

					<div class="form-group row">
						<label class="col-sm-2 form-label">Title</label>
						<div class="col-sm-10">
							<input type="text" name="title" class="form-control" placeholder="Enter Header Title" value="{{ old('title') }}">
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-2 form-label">Class</label>
						<div class="col-sm-10">
							<select name="class_id" class="form-control">
								<option disabled selected>-- Selected Class --</option>

								@foreach ($departments as $department)
								<option value="{{ $department->id }}">{{ $department->batch }}</option>
								@endforeach

							</select>
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-2 form-label">Result Type</label>
						<div class="col-sm-10">
							<select name="type" class="form-control">
								<option disabled>-- selected --</option>
								<option value="Academic">Academic</option>
								<option value="Exam Schedule">Exam Schedule</option>
								<option value="Class Schedule">Class Schedule</option>
								<option value="Others">Others</option>
							</select>
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-2 form-label">Image</label>
						<div class="col-sm-10">
							<input type="file" name="pdf" accept="application/pdf">
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-2 form-label">Status</label>
						<div class="col-sm-10">
							<div class="custom-control custom-checkbox">
								<input class="custom-control-input custom-control-input-danger" type="checkbox" id="customCheckbox4" name="status">
								<label for="customCheckbox4" class="custom-control-label">Published</label>
							</div>
						</div>
					</div>

					<div class="form-group row">
						<div class="offset-sm-2 col-sm-10">
							<button class="btn btn-danger waves-effect float-right" type="submit">Add Now</button>
							<a href="{{ route('admin.class-routine.index') }}" class="btn btn-success waves-effect float-right mr-2"> <i class="fas fa-arrow-left mr-1"></i> Back</a>
						</div>
					</div>
				</form>

			</div>
		</div>

	</div>
</div>

@endsection