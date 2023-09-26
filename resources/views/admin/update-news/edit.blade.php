@extends('layouts.backend.app')

@section('title', 'Edit Update News')

@section('main_content')

<div class="row">
	<div class="col-sm-12">

		<div class="card">
			<div class="card-header">
				<h5>Edit Update News</h5>
			</div>
			<div class="card-body">

				<form action="{{ route('admin.update-news.update', $updateNews->id) }}" method="post" enctype="multipart/form-data">
					@csrf
					@method('PUT')

					<div class="form-group row">
						<label class="col-xl-1 col-sm-3 form-label mb-2 m-sm-0 text-sm-right text-start">Title</label>
						<div class="col-sm-1 text-center d-none d-sm-block">:</div>
						<div class="col-xl-10 col-sm-8">
							<input type="text" name="title" class="form-control" placeholder="Enter Title" value="{{ $updateNews->title }}">
						</div>
					</div>

					<div class="form-group row">
						<label class="col-xl-1 col-sm-3 form-label mb-2 m-sm-0 text-sm-right text-start">New Type</label>
						<div class="col-sm-1 text-center d-none d-sm-block">:</div>
						<div class="col-xl-10 col-sm-8">
							<select name="news_type" class="form-control">
								<option disabled selected> -- Selected News Type -- </option>
								<option value="Admission News" {{ $updateNews->news_type == 'Admission News' ? 'selected' : '' }}>Admission News</option>
								<option value="Admission Form" {{ $updateNews->news_type == 'Admission Form' ? 'selected' : '' }}>Admission Form</option>
							</select>
						</div>
					</div>

					<div class="form-group row">
						<label class="col-xl-1 col-sm-3 form-label mb-2 m-sm-0 text-sm-right text-start">PDF File</label>
						<div class="col-sm-1 text-center d-none d-sm-block">:</div>
						<div class="col-xl-10 col-sm-8">
							<input type="file" name="file" placeholder="Enter PDF File">
						</div>
					</div>

					<div class="form-group row">
						<label class="col-xl-1 col-sm-3 form-label mb-2 m-sm-0 text-sm-right text-start">Status</label>
						<div class="col-sm-1 text-center d-none d-sm-block">:</div>
						<div class="col-xl-10 col-sm-8">
							<div class="custom-control custom-checkbox">
								<input class="custom-control-input custom-control-input-danger" type="checkbox" id="customCheckbox4" name="status" {{ $updateNews->status == true ? 'checked' : '' }}>
								<label for="customCheckbox4" class="custom-control-label">Published</label>
							</div>
						</div>
					</div>

					<div class="form-group row">
						<div class="offset-sm-2 col-sm-10">
							<button class="btn btn-danger waves-effect float-right" type="submit">Update Now</button>
							<a href="{{ route('admin.update-news.index') }}" class="btn btn-success waves-effect float-right mr-2"> <i class="fas fa-arrow-left mr-1"></i> Back</a>
						</div>
					</div>
				</form>

			</div>
		</div>

	</div>
</div>

@endsection