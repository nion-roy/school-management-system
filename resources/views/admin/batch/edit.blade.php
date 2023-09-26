@extends('layouts.backend.app')

@section('title', 'Edit Class')

@section('main_content')

<div class="row">
	<div class="col-sm-12">

		<div class="card">
			<div class="card-header">
				<h3 class="card-title">Edit Class</h3>
			</div>
			<div class="card-body">

				<form action="{{ route('admin.class.update', $class->id) }}" method="post">
					@csrf
					@method('PUT')

					<div class="form-group row align-items-center">
						<label class="col-2 text-right m-0">Class</label>
						<div class="col-1 text-center">:</div>
						<div class="col-9"><input type="text" name="batch" placeholder="Enter Class" class="form-control" value="{{ $class->batch }}"></div>
					</div>

					<div class="form-group row align-items-center">
						<label class="col-2 text-right m-0">Section</label>
						<div class="col-1 text-center">:</div>
						<div class="col-9">
							<select name="section_id" class="form-control select2 w-100">
								<option disabled selected>-- Selected Section --</option>
								@foreach ($sections as $section)
								<option value="{{ $section->id }}" {{ $class->section_id == $section->id ? 'selected' : '' }}>{{ $section->section }}</option>
								@endforeach
							</select>
						</div>
					</div>

					<div class="form-group row align-items-center">
						<label class="col-xl-2 col-sm-3 form-label mb-2 m-sm-0 text-sm-right text-start">Status</label>
						<div class="col-sm-1 text-center d-none d-sm-block">:</div>
						<div class="col-xl-9 col-sm-8">
							<div class="custom-control custom-checkbox">
								<input class="custom-control-input custom-control-input-danger" type="checkbox" id="customCheckbox4" name="status" {{ $class->status == true ? 'checked' : '' }}>
								<label for="customCheckbox4" class="custom-control-label">Published</label>
							</div>
						</div>
					</div>

					<div class="form-group row">
						<div class="offset-sm-2 col-sm-10">
							<button class="btn btn-danger waves-effect float-right" type="submit"><i class="fas fa-upload mr-1"></i> Update Now</button>
							<a href="{{ route('admin.class.index') }}" class="btn btn-success waves-effect float-right mr-2"> <i class="fas fa-arrow-left mr-1"></i> Back</a>
						</div>
					</div>

				</form>

			</div>
		</div>

	</div>
</div>

@endsection