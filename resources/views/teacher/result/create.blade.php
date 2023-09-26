@extends('layouts.backend.app')

@section('title', 'Add Students Results')

@section('main_content')

<div class="row">
	<div class="col-sm-12">

		<div class="card">
			<div class="card-header">
				<h5>Add Students Results</h5>
			</div>
			<div class="card-body">

				<form action="{{ route('teacher.result.store') }}" method="post">
					@csrf

					<div class="form-group row">
						<label class="col-xl-2 col-sm-3 form-label mb-2 m-sm-0 text-sm-right text-start">Class</label>
						<div class="col-sm-1 text-center d-none d-sm-block">:</div>
						<div class="col-xl-9 col-sm-8">
							<select id="class_dropdown" name="class_id" class="form-control select2 w-100">
								<option disabled selected> -- Selected Class -- </option>
								@foreach ($batches as $class)
								<option value="{{ $class->id }}">{{ $class->batch }}</option>
								@endforeach
							</select>
						</div>
					</div>

					<div class="form-group row">
						<label class="col-xl-2 col-sm-3 form-label mb-2 m-sm-0 text-sm-right text-start">Student Roll</label>
						<div class="col-sm-1 text-center d-none d-sm-block">:</div>
						<div class="col-xl-9 col-sm-8">
							<select name="student_id" class="form-control select2" id="roll_dropdown">
								<option disabled selected>-- Selected Roll --</option>
							</select>
						</div>
					</div>

					<div class="form-group row">
						<label class="col-xl-2 col-sm-3 form-label mb-2 m-sm-0 text-sm-right text-start">Student Name</label>
						<div class="col-sm-1 text-center d-none d-sm-block">:</div>
						<div class="col-xl-9 col-sm-8">
							<input type="text" id="name" name="name" class="form-control" placeholder="Enter Student Name">
						</div>
					</div>

					<div class="form-group row">
						<label class="col-xl-2 col-sm-3 form-label mb-2 m-sm-0 text-sm-right text-start">Subject Name</label>
						<div class="col-sm-1 text-center d-none d-sm-block">:</div>
						<div class="col-xl-9 col-sm-8">
							<select id="subject_dropdown" name="subject_id" class="form-control select2 w-100">
								<option disabled selected> -- Selected Subject -- </option>
								@foreach ($subjects as $subject)
								<option value="{{ $subject->id }}">{{ $subject->subject }}</option>
								@endforeach
							</select>
						</div>
					</div>

					{{-- <div class="form-group row">
						<label class="col-xl-2 col-sm-3 form-label mb-2 m-sm-0 text-sm-right text-start">Session</label>
						<div class="col-sm-1 text-center d-none d-sm-block">:</div>
						<div class="col-xl-9 col-sm-8">
							<input type="text" id="session" name="session" class="form-control" placeholder="Enter Session">
						</div>
					</div>

					<div class="form-group row">
						<label class="col-xl-2 col-sm-3 form-label mb-2 m-sm-0 text-sm-right text-start">Register No.</label>
						<div class="col-sm-1 text-center d-none d-sm-block">:</div>
						<div class="col-xl-9 col-sm-8">
							<input type="text" id="register" name="register" class="form-control" placeholder="Enter Register No.">
						</div>
					</div> --}}

					<div class="form-group row">
						<label class="col-xl-2 col-sm-3 form-label mb-2 m-sm-0 text-sm-right text-start">Total Mark</label>
						<div class="col-sm-1 text-center d-none d-sm-block">:</div>
						<div class="col-xl-9 col-sm-8">
							<input type="text" id="mark" name="mark" class="form-control" placeholder="Enter Total Mark">
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

					<div class="form-group row align-items-center">
						<div class="offset-sm-2 col-sm-10">
							<button class="btn btn-danger waves-effect float-right" type="submit">Add Now</button>
							<a href="{{ route('teacher.result.index') }}" class="btn btn-success waves-effect float-right mr-2"> <i class="fas fa-arrow-left mr-1"></i> Back</a>
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
	$.ajaxSetup({
	headers: {
	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	}
	});

		$(document).ready(function () {
			$('#class_dropdown').on('change', function () {
					var class_id = $(this).val();
					// alert(class_id);
					if (class_id) {
							$.ajax({
									type: "GET",
									url: "/teacher/roll/" + class_id,
									beforeSend: function () {
											// Show a loading spinner or perform any other processing
											$('#roll_dropdown').empty();
											$('#roll_dropdown').append('<option value="">Loading...</option>');
									},
									success: function (res) {
											if (res) {
													$('#roll_dropdown').empty();
													$('#roll_dropdown').append('<option disabled selected>-- Select Class Roll --</option>');
													$.each(res, function (id,value) {
															$('#roll_dropdown').append('<option value="' + value.id + '">' + value.roll + '</option>');
													});
											} else {
													$('#roll_dropdown').empty();
											}
									}
							});
					} else {
							$('#roll_dropdown').empty();
					}
			});
		});

		$(document).ready(function () {
			$('#roll_dropdown').on('change', function () {
					var id = $(this).val();
					// alert(id);

					$.ajax({
						type: "get",
						url: "/teacher/information/" + id,
						dataType: "json",
						success: function (response) {
							// consol.log(response);
							if (response) {
									$('#name').val(response.name);
							} else {
									$('#name').empty();
							}
						}
					});


			});
		});
</script>

@endpush