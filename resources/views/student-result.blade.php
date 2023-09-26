@extends('layouts.frontend.app')

@section('title', 'Student Result')

@section('main_content')

<!-- Page Header Start -->
<div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s" style="background-image: linear-gradient(rgba(15, 66, 41, 0.6), rgba(15, 66, 41, 0.6)), url( {{ Storage::disk('public')->url('setting/'.$f_settings->banner) }})">
	<div class="container text-center py-5">
		<h1 class="display-3 text-white mb-4 animated slideInDown">Student Result</h1>
		<nav aria-label="breadcrumb animated slideInDown">
			<ol class="breadcrumb justify-content-center mb-0">
				<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
				<li class="breadcrumb-item active" aria-current="page">Result</li>
			</ol>
		</nav>
	</div>
</div>
<!-- Page Header End -->

<!-- Result Start -->
<div class="container-xxl py-5">
	<div class="container">
		<form>
			<div class="row">

				<div class="col-12 mb-4">
					<div class="row justify-content-center">

						<div class="col-12 text-center mb-3">
							<h2>Search Your Results</h2>
						</div>

						<div class="form-group col-md-3">
							<select id="class_dropdown" name="class_id" class="form-select select2">
								<option disabled selected> -- Selected Class -- </option>
								@foreach ($classes as $class)
								<option value="{{ $class->id }}">{{ $class->batch }}</option>
								@endforeach
							</select>
						</div>

						<div class="form-group col-md-3">
							<select name="student_id" class="form-select select2" id="roll_dropdown">
								<option disabled selected>-- Selected Class Roll --</option>
							</select>
						</div>


					</div>
				</div>

				<div class="col-md-8 mx-auto" id="student_results" style="display: none">

					<div class="card">
						<div class="card-body">


							<div class="row">
								<div class="col-md-6">
									<div class="card">
										<div class="card-body text-center">
											<h4 id="name"></h4>
											<p class="mb-1"><strong>Roll:</strong> <span id="roll" class="me-3"></span> <strong>Register:</strong> <span id="register"></span></p>
											<p><strong>Session:</strong> <span id="session" class="me-3"></span> <strong>Class:</strong> <span id="batch"></span></p>
										</div>
									</div>
								</div>

								<div class="col-md-6">

									<table class="table table-striped table-bordered hover">
										<thead>
											<tr>
												<th>#</th>
												<th>Subject Name</th>
												<th>Mark</th>
											</tr>
										</thead>
										<tfoot>
											<tr>
												<th>#</th>
												<th>Subject Name</th>
												<th>Mark</th>
											</tr>
										</tfoot>
										<tbody class="tbody">
										</tbody>
									</table>

								</div>
							</div>
						</div>
					</div>

				</div>

		</form>
	</div>
</div>
<!-- Result  End -->

@endsection

@push('js')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

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
									url: "/student-results/" + class_id,
									beforeSend: function () {
											// Show a loading spinner or perform any other processing
											$('#roll_dropdown').empty();
											$('#roll_dropdown').append('<option value="">Loading...</option>');
									},
									success: function (res) {
											if (res) {
													$('#roll_dropdown').empty();
													$('#roll_dropdown').append('<option disabled selected>-- Selected Class Roll --</option>');
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
				
				$("#student_results").show();
				
				$.ajax({
						type: "get",
						url: "/student-class-result/" + id,
						dataType: "json",
						success: function (response) {
							console.log(response);

							$('#name').html(response[0].student.name)
							$('#roll').html(response[0].student.roll)
							$('#register').html(response[0].student.register)
							$('#session').html(response[0].student.session)
							$('#batch').html(response[0].class.batch)

							// console.log(typeof(response));

							var sl = 1;
							
							$.each(response, function (key, val) { 
								response +='<tr>\
									<td>'+sl+'</td>\
									<td>'+val.subject.subject+'</td>\
									<td>'+val.mark+'</td>\
									</tr>';
									sl++;
								});
								
							jQuery('.tbody').html(response);
							
						}
					});
					
					
					
					
				});
		});
</script>

@endpush