@extends('layouts.backend.app')

@section('title', 'Edit Result')

@section('main_content')

<div class="row">
	<div class="col-sm-12">

		<div class="card">
			<div class="card-header">
				<h5>Edit Result</h5>
			</div>
			<div class="card-body">

				<form action="{{ route('admin.result.update', $results->id) }}" method="post" enctype="multipart/form-data">
					@csrf
					@method('PUT')

					<div class="form-group row">
						<label class="col-sm-2 form-label">Title</label>
						<div class="col-sm-10">
							<input type="text" name="title" class="form-control" placeholder="Enter Header Title" value="{{ $results->title }}">
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-2 form-label">Department</label>
						<div class="col-sm-10">
							<select name="class_id" class="form-control">
								<option disabled>-- selected --</option>

								@foreach ($departments as $department)
								<option value="{{ $department->id }}" {{ $results->class_id == $department->id ? 'selected' : '' }}>{{ $department->batch }}</option>
								@endforeach

							</select>
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-2 form-label">Result Type</label>
						<div class="col-sm-10">
							<select name="type" class="form-control">
								<option disabled>-- selected --</option>
								<option value="Academic" {{ $results->type == 'Academic' ? 'selected' : '' }}>Academic</option>
								<option value="Exam Schedule" {{ $results->type == 'Exam Schedule' ? 'selected' : '' }}>Exam Schedule</option>
								<option value="Class Schedule" {{ $results->type == 'Class Schedule' ? 'selected' : '' }}>Class Schedule</option>
								<option value="Others" {{ $results->type == 'Others' ? 'selected' : '' }}>Others</option>
							</select>
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-2 form-label">Image</label>
						<div class="col-sm-10">
							<input type="file" name="pdf" accept="application/pdf" value="{{ $results->pdf }}">
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-2 form-label">Status</label>
						<div class="col-sm-10">
							<div class="custom-control custom-checkbox">
								<input class="custom-control-input custom-control-input-danger" type="checkbox" id="customCheckbox4" name="status" @if ($results->status) checked @endif>
								<label for="customCheckbox4" class="custom-control-label">Published</label>
							</div>
						</div>
					</div>

					<div class="form-group row">
						<div class="offset-sm-2 col-sm-10">
							<button class="btn btn-danger waves-effect float-right" type="submit">Update Now</button>
							<a href="{{ route('admin.result.index') }}" class="btn btn-success waves-effect float-right mr-2"> <i class="fas fa-arrow-left mr-1"></i> Back</a>
						</div>
					</div>
				</form>

			</div>
		</div>

	</div>
</div>

@endsection