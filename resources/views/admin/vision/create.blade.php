@extends('layouts.backend.app')

@section('title', 'Create Vision Information')

@section('main_content')

<div class="row">
	<div class="col-sm-12">

		<div class="card">
			<div class="card-header">
				<h5>Add Vision Information</h5>
			</div>
			<div class="card-body">

				<form action="{{ route('admin.vision.store') }}" method="post" enctype="multipart/form-data">
					@csrf


					<div class="form-group row">
						<label class="col-xl-2 col-sm-3 form-label mb-2 m-sm-0 text-sm-right text-start">Vision Title</label>
						<div class="col-sm-1 text-center d-none d-sm-block">:</div>
						<div class="col-xl-9 col-sm-8">
							<input type="text" name="title" class="form-control" placeholder="Enter Title" value="{{ old('title') }}">
						</div>
					</div>

					<div class="form-group row">
						<label class="col-xl-2 col-sm-3 form-label mb-2 m-sm-0 text-sm-right text-start">Description</label>
						<div class="col-sm-1 text-center d-none d-sm-block">:</div>
						<div class="col-xl-9 col-sm-8">
							<textarea id="summernote" class="form-control" name="description"></textarea>
						</div>
					</div>

					<div class="form-group row">
						<label class="col-xl-2 col-sm-3 form-label mb-2 m-sm-0 text-sm-right text-start">Image</label>
						<div class="col-sm-1 text-center d-none d-sm-block">:</div>
						<div class="col-xl-9 col-sm-8">
							<div id="imageContainer" class="border rounded mb-3"></div>
							<input type="file" name="image" id="imageFile">
						</div>
					</div>

					<div class="form-group row">
						<label class="col-xl-2 col-sm-3 form-label mb-2 m-sm-0 text-sm-right text-start">Status</label>
						<div class="col-sm-1 text-center d-none d-sm-block">:</div>
						<div class="col-xl-9 col-sm-8">
							<div class="custom-control custom-checkbox">
								<input class="custom-control-input custom-control-input-danger" type="checkbox" id="customCheckbox4" name="status">
								<label for="customCheckbox4" class="custom-control-label">Published</label>
							</div>
						</div>
					</div>

					<div class="form-group row">
						<div class="offset-sm-2 col-sm-10">
							<button class="btn btn-danger waves-effect float-right" type="submit">Add Now</button>
							<a href="{{ route('admin.vision.index') }}" class="btn btn-success waves-effect float-right mr-2"> <i class="fas fa-arrow-left mr-1"></i> Back</a>
						</div>
					</div>
				</form>


			</div>
		</div>

	</div>
</div>

@endsection