@extends('layouts.backend.app')

@section('title', 'Edit Chairman Information')

@section('main_content')

<div class="row">
	<div class="col-sm-12">

		<div class="card">
			<div class="card-header">
				<h5>Edit Chairman Information</h5>
			</div>
			<div class="card-body">

				<form action="{{ route('admin.chairman.update', $chairman->id) }}" method="post" enctype="multipart/form-data">
					@csrf
					@method('PUT')

					<div class="form-group row">
						<label class="col-sm-2 form-label">About Title</label>
						<div class="col-sm-10">
							<input type="text" name="title" class="form-control" placeholder="Enter About Title"
								value="{{ $chairman->title }}">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 form-label">Description</label>
						<div class="col-sm-10">
							<textarea class="form-control" name="description" id="" cols="30" rows="4"
								placeholder="Enter About Description">{{ $chairman->description }}</textarea>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 form-label">Image</label>
						<div class="col-sm-10">
							<div id="imageContainer" class="border rounded mb-3">
								<img src="{{ Storage::disk('public')->url('about/'.$chairman->image) }}" alt="{{ $chairman->title }}">
							</div>
							<input type="file" name="image" id="imageFile">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 form-label">Status</label>
						<div class="col-sm-10">
							<div class="custom-control custom-checkbox">
								<input class="custom-control-input custom-control-input-danger" type="checkbox" id="customCheckbox4" name="status" @if ($chairman->status) checked @endif>
								<label for="customCheckbox4" class="custom-control-label">Published</label>
							</div>
						</div>
					</div>
					<div class="form-group row">
						<div class="offset-sm-2 col-sm-10">
							<button class="btn btn-danger waves-effect float-right" type="submit">Update Now</button>
							<a href="{{ route('admin.chairman.index') }}" class="btn btn-success waves-effect float-right mr-2"> <i class="fas fa-arrow-left mr-1"></i> Back</a>
						</div>
					</div>
				</form>


			</div>
		</div>

	</div>
</div>

@endsection