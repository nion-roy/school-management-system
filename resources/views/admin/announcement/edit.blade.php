@extends('layouts.backend.app')

@section('title', 'Edit Announcement')

@section('main_content')

<div class="row">
	<div class="col-sm-12">

		<div class="card">
			<div class="card-header">
				<h5>Edit Announcement</h5>
			</div>
			<div class="card-body">

				<form action="{{ route('admin.announcement.update', $announcement->id) }}" method="post" enctype="multipart/form-data">
					@csrf
					@method('PUT')

					<div class="form-group row">
						<label class="col-sm-2 form-label">Title</label>
						<div class="col-sm-10">
							<input type="text" name="title" class="form-control" placeholder="Enter Header Title" value="{{ $announcement->title }}">
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-2 form-label">Announcement with PDF File</label>
						<div class="col-sm-10">
							<input type="file" name="pdf" accept="application/pdf" value="{{ $announcement->notice }}">
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-2 form-label">Status</label>
						<div class="col-sm-10">
							<div class="custom-control custom-checkbox">
								<input class="custom-control-input custom-control-input-danger" type="checkbox" id="customCheckbox4" name="status" @if ($announcement->status) checked @endif>
								<label for="customCheckbox4" class="custom-control-label">Published</label>
							</div>
						</div>
					</div>

					<div class="form-group row">
						<div class="offset-sm-2 col-sm-10">
							<button class="btn btn-success waves-effect float-right" type="submit">Update Now</button>
							<a href="{{ route('admin.announcement.index') }}" class="btn btn-danger waves-effect float-right mr-2"> <i class="fas fa-arrow-left mr-1"></i> Back</a>
						</div>
					</div>
				</form>

			</div>
		</div>

	</div>
</div>

@endsection