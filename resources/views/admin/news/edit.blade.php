@extends('layouts.backend.app')

@section('title', 'Edit News Image')

@section('main_content')

<div class="row">
	<div class="col-sm-12">

		<div class="card">
			<div class="card-header">
				<h5>Edit News Image</h5>
			</div>
			<div class="card-body">

				<form action="{{ route('admin.news.update', $news->id) }}" method="post" enctype="multipart/form-data">
					@csrf
					@method('PUT')

					<div class="form-group row">
						<label class="col-sm-2 form-label">Title</label>
						<div class="col-sm-10">
							<input type="text" name="title" class="form-control" placeholder="Enter Header Title" value="{{ $news->title}}">
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-2 form-label">Description</label>
						<div class="col-sm-10">
							<textarea id="summernote" class="form-control" name="description">{!! $news->description !!}</textarea>
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-2 form-label">Image</label>
						<div class="col-sm-10">
							<div id="imageContainer" class="border rounded mb-3 @if (!empty($news->image)) d-block  @endif">
								<img src="{{ Storage::disk('public')->url('news/' . $news->image ) }}" alt="{{ $news->title }}" class="img-fluid img-thumbnail">
							</div>
							<input type="file" name="image" id="imageFile">
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-2 form-label">Status</label>
						<div class="col-sm-10">
							<div class="custom-control custom-checkbox">
								<input class="custom-control-input custom-control-input-danger" type="checkbox" id="customCheckbox4" name="status" {{ $news->status == 1 ? 'checked' : '' }}>
								<label for="customCheckbox4" class="custom-control-label">Published</label>
							</div>
						</div>
					</div>

					<div class="form-group row">
						<div class="offset-sm-2 col-sm-10">
							<button class="btn btn-danger waves-effect float-right" type="submit">Update Now</button>
							<a href="{{ route('admin.news.index') }}" class="btn btn-success waves-effect float-right mr-2"> <i class="fas fa-arrow-left mr-1"></i> Back</a>
						</div>
					</div>
				</form>

			</div>
		</div>

	</div>
</div>

@endsection

@push('js')
<script>
	$('#summernote').summernote({
		placeholder: 'Enter Overview Information....',
		height: 200,
		toolbar: [
		['font', ['bold', 'italic', 'underline']],
		['style', ['style']],
		['fontname', ['fontname']],
		['fontsize', ['fontsize']],
		['color', ['color']],
		['para', ['ol', 'ul', 'paragraph', 'height']],
		['table', ['table']],
		['insert', ['link']],
		['view', ['undo', 'redo', 'fullscreen', 'codeview', 'help']]
		]

	});
</script>
@endpush