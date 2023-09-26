@extends('layouts.backend.app')

@section('title', 'Add Testimonial')

@section('main_content')

<div class="row">
	<div class="col-sm-12">

		<div class="card">
			<div class="card-header">
				<h5>Add New Testimonial</h5>
			</div>
			<div class="card-body">

				<form action="{{ route('admin.testimonial.store') }}" method="post" enctype="multipart/form-data">
					@csrf

					<div class="form-group row">
						<label class="col-sm-2 form-label">Name</label>
						<div class="col-sm-10">
							<input type="text" name="name" class="form-control" placeholder="Enter Full Name" value="{{ old('name') }}">
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-2 form-label">Designation</label>
						<div class="col-sm-10">
							<input type="text" name="designation" class="form-control" placeholder="Enter Designation or Title" value="{{ old('designation') }}">
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-2 form-label">Location</label>
						<div class="col-sm-10">
							<input type="text" name="location" class="form-control" placeholder="Enter Job Location" value="{{ old('location') }}">
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-2 form-label">Comment</label>
						<div class="col-sm-10">
							<textarea name="comment" id="" cols="30" rows="6" class="form-control" placeholder="Enter Comment"></textarea>
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-2 form-label">Image</label>
						<div class="col-sm-10">
							<div id="imageContainer" class="border rounded mb-3"></div>
							<input type="file" name="image" id="imageFile">
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
							<a href="{{ route('admin.testimonial.index') }}" class="btn btn-success waves-effect float-right mr-2"> <i class="fas fa-arrow-left mr-1"></i> Back</a>
						</div>
					</div>
				</form>

			</div>
		</div>

	</div>
</div>

@endsection