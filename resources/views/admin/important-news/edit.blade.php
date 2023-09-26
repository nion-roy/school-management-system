@extends('layouts.backend.app')

@section('title', 'Edit Important News')

@section('main_content')

<div class="row">
	<div class="col-sm-12">

		<div class="card">
			<div class="card-header">
				<h5>Edit Important News</h5>
			</div>
			<div class="card-body">

				<form action="{{ route('admin.important-news.update', $importantNews->id) }}" method="post" enctype="multipart/form-data">
					@csrf
					@method('PUT')

					<div class="form-group row">
						<label class="col-xl-1 col-sm-3 form-label mb-2 m-sm-0 text-sm-right text-start">Title</label>
						<div class="col-sm-1 text-center d-none d-sm-block">:</div>
						<div class="col-xl-10 col-sm-8">
							<input type="text" name="title" class="form-control" placeholder="Enter Title" value="{{ $importantNews->title }}">
						</div>
					</div>

					<div class="form-group row">
						<label class="col-xl-1 col-sm-3 form-label mb-2 m-sm-0 text-sm-right text-start">Links</label>
						<div class="col-sm-1 text-center d-none d-sm-block">:</div>
						<div class="col-xl-10 col-sm-8">
							<input type="text" name="links" class="form-control" placeholder="Enter Links" value="{{ $importantNews->links }}">
						</div>
					</div>

					<div class="form-group row">
						<label class="col-xl-1 col-sm-3 form-label mb-2 m-sm-0 text-sm-right text-start">Status</label>
						<div class="col-sm-1 text-center d-none d-sm-block">:</div>
						<div class="col-xl-10 col-sm-8">
							<div class="custom-control custom-checkbox">
								<input class="custom-control-input custom-control-input-danger" type="checkbox" id="customCheckbox4" name="status" {{ $importantNews->status == true ? 'checked' : '' }}>
								<label for="customCheckbox4" class="custom-control-label">Published</label>
							</div>
						</div>
					</div>

					<div class="form-group row">
						<div class="offset-sm-2 col-sm-10">
							<button class="btn btn-danger waves-effect float-right" type="submit">Update Now</button>
							<a href="{{ route('admin.important-news.index') }}" class="btn btn-success waves-effect float-right mr-2"> <i class="fas fa-arrow-left mr-1"></i> Back</a>
						</div>
					</div>
				</form>

			</div>
		</div>

	</div>
</div>

@endsection