@extends('layouts.backend.app')

@section('title', 'Add New Subject')

@section('main_content')

<div class="row">
	<div class="col-sm-12">

		<div class="card">
			<div class="card-header">
				<h3 class="card-title">Add New Subject</h3>
			</div>
			<div class="card-body">

				<form action="{{ route('admin.subject.store') }}" method="post">
					@csrf


					<div class="form-group row align-items-center">
						<label class="col-md-2 col-sm-3 form-label mb-2 m-md-0 text-md-right text-start">Subject</label>
						<div class="col-md-1 text-center d-none d-md-block">:</div>
						<div class="col-md-9 col-12"><input type="text" name="subject" placeholder="Enter Subject" class="form-control"></div>
					</div>

					<div class="form-group row align-items-center">
						<label class="col-md-2 col-3 form-label m-0 text-md-right text-start">Status</label>
						<div class="col-1 text-center">:</div>
						<div class="col-md-9 col-8">
							<div class="custom-control custom-checkbox">
								<input class="custom-control-input custom-control-input-danger" type="checkbox" id="customCheckbox4" name="status">
								<label for="customCheckbox4" class="custom-control-label">Published</label>
							</div>
						</div>
					</div>

					<div class="form-group row">
						<div class="offset-sm-2 col-sm-10">
							<button class="btn btn-danger waves-effect float-right" type="submit"><i class="fas fa-plus-circle mr-1"></i> Add Now</button>
							<a href="{{ route('admin.subject.index') }}" class="btn btn-success waves-effect float-right mr-2"> <i class="fas fa-arrow-left mr-1"></i> Back</a>
						</div>
					</div>

				</form>

			</div>
		</div>

	</div>
</div>

@endsection