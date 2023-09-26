@extends('layouts.backend.app')

@section('title', 'Add Facts')

@section('main_content')

<div class="row">
	<div class="col-sm-12">

		<div class="card">
			<div class="card-header">
				<h5>Add New Facts</h5>
			</div>
			<div class="card-body">

				<form action="{{ route('admin.facts.store') }}" method="post" enctype="multipart/form-data">
					@csrf

					<div class="form-group row">
						<label class="col-sm-2 form-label">Header</label>
						<div class="col-sm-10">
							<input type="text" name="header" class="form-control" placeholder="Enter Header Title" value="{{ old('header') }}">
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-2 form-label">Counter's</label>
						<div class="col-sm-10">
							<input type="number" name="counter" class="form-control" placeholder="Enter Counter" value="{{ old('counter') }}">
						</div>
					</div>

					<div class="form-group row">
						<div class="offset-sm-2 col-sm-10">
							<button class="btn btn-danger waves-effect float-right" type="submit">Add Now</button>
							<a href="{{ route('admin.facts.index') }}" class="btn btn-success waves-effect float-right mr-2"> <i class="fas fa-arrow-left mr-1"></i> Back</a>
						</div>
					</div>
				</form>

			</div>
		</div>

	</div>
</div>

@endsection