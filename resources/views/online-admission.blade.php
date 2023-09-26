@extends('layouts.frontend.app')

@section('title', 'Admission')

@section('main_content')

@push('css')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css" />

<!-- Jquery -->
<link rel="stylesheet" href="https://jqueryvalidation.org/files/demo/site-demos.css" />

<!-- Main Style Css -->
<link rel="stylesheet" href="{{ asset('frontend') }}/wizard/css/style.css" />

<style>
	@import url(https://fonts.googleapis.com/icon?family=Material+Icons);

	div.progress-icon {
		border: 1px solid #198754;
		width: 50px;
		height: 50px;
		border-radius: 50%;
		background-color: white;
		color: black;
		position: absolute;
		display: flex;
		align-items: center;
		justify-content: center;
	}

	div.progress-icon.active {
		transition: all 0.25s ease;
		background: #198754;
		color: #fff;
	}

	div.progress-icon:hover {
		background: #198754;
		color: #fff;
	}

	.multi-step-form .progress {
		overflow: visible;
	}

	.multi-step-form .progress.seen {
		transition: all 0ms ease 300ms;
		background-color: #8fb4dd;
	}

	#imagePreview1,
	#imagePreview2,
	#imagePreview3 {
		display: none;
		width: 180px;
		height: 120px;
	}

	#imagePreview1 img,
	#imagePreview2 img,
	#imagePreview3 img {
		width: 180px;
		height: 120px;
	}

	#imageInput1,
	#imageInput2,
	#imageInput3 {
		border: none;
	}

	.form-label {
		margin: 7px 0 0 0 !important;
	}

	label.error {
		color: red;
		font-size: 14px;
	}

	fieldset.active {
		display: block !important;
	}
</style>
@endpush

<!-- Projects Start -->
<div class="container-xxl py-5">
	<div class="container">
		<div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s">
			<p class="fs-5 fw-bold text-primary">Online Admission</p>
			<h1 class="display-5 mb-5">Some Of Our valuable Moments</h1>
		</div>

		<div class="row" style="margin-top: 5rem">
			<div class="col-md-9 mx-auto">

				<div class="multi-step-form">

					<div class="progress-container row w-100">
						<div class="progress col-4 p-0" style="height: 5px;">
							<div class="progress-bar" data-index=1>
								<div data-index=1 class="progress-icon shadow-sm active">
									<i class="material-icons"> people </i>
								</div>
							</div>
						</div>
						<div class="progress col-4 p-0" style="height: 5px;">
							<div class="progress-bar" data-index=2>
								<div data-index=2 class="progress-icon shadow-sm">
									<i class="material-icons"> business </i>
								</div>
							</div>
						</div>
						<div class="progress col-4 p-0" style="height: 5px;">
							<div class="progress-bar" data-index=3>
								<div data-index=3 class="progress-icon shadow-sm">
									<i class="material-icons"> call </i>
								</div>
							</div>
						</div>
						<div class="progress col p-0" style="height: 5px;">
							<div class="progress-bar" data-index=4>
								<div class="progress-icon shadow-sm">
									<i class="material-icons"> check </i>
								</div>
							</div>
						</div>
					</div>

					<div class="form-container" style="margin-top: 4rem">

						<div class="row mb-4">
							<div class="col-12">
								@if(Session::has('flash_message'))
								<div class="alert alert-success">
									{{ Session::get('flash_message') }}
								</div>
								@endif
							</div>
						</div>

						<form id="wizardForm" class="needs-validation" novalidate action="{{ route('online-admission.store') }}" method="post" enctype="multipart/form-data">
							@csrf

							<fieldset data-index=1 class="ms-step-1 active seen">

								<div class="form-group row mb-3">
									<div class="col-md-3 col-12 mb-2 m-md-0 text-start text-md-end">
										<label for="name" class="form-label">Full name :</label>
									</div>
									<div class="col-md-9">
										<input class="form-control" value="{{ old('name') }}" name="name" id="name" type="text" placeholder="Enter Full Name" required />
									</div>
								</div>

								<div class="form-group row mb-3">
									<div class="col-md-3 col-12 mb-2 m-md-0 text-start text-md-end">
										<label for="nid" class="form-label">NID Number :</label>
									</div>
									<div class="col-md-9">
										<input class="form-control" value="{{ old('nid') }}" type="number" name="nid" id="nid" placeholder="Enter NID or Birth Certificate Number" required />
									</div>
								</div>

								<div class="form-group row mb-3">
									<div class="col-md-3 col-12 mb-2 m-md-0 text-start text-md-end">
										<label for="number" class="form-label">Your Contact :</label>
									</div>
									<div class="col-md-9">
										<input class="form-control" type="number" name="number" id="number" min="0" value="{{ old('number') }}" placeholder="+8801XXXXXXXXX" required />
									</div>
								</div>

								<div class="form-group row mb-3">
									<div class="col-md-3 col-12 mb-2 m-md-0 text-start text-md-end">
										<label for="optional_number" class="form-label">Your Contact (optional) :</label>
									</div>
									<div class="col-md-9">
										<input class="form-control" type="number" name="optional_number" id="optional_number" min="0" value="{{ old('optional_number') }}" placeholder="+8801XXXXXXXXX" />
									</div>
								</div>

								<div class="form-group row mb-3">
									<div class="col-md-3 col-12 mb-2 m-md-0 text-start text-md-end">
										<label for="email" class="form-label">Email Address :</label>
									</div>
									<div class="col-md-9">
										<input class="form-control" type="email" name="email" value="{{ old('email') }}" placeholder="Enter Valid Email" required />
									</div>
								</div>

								<div class="form-group row mb-3">
									<div class="col-md-3 col-12 mb-2 m-md-0 text-start text-md-end">
										<label for="gender" class="form-label" style="margin: 0 !important; ">Gander :</label>
									</div>
									<div class="col-md-9">
										<div class="d-flex">
											<input class="form-check-input" type="radio" value="male" name="gender" id="male" checked />
											<label class="form-check-label ms-1 me-3" for="male"> Male </label>
											<input class="form-check-input" type="radio" value="female" name="gender" id="female" />
											<label class="form-check-label ms-1 me-3" for="female">Female</label>
											<input class="form-check-input" type="radio" value="other" name="gender" id="other" />
											<label class="form-check-label ms-1 me-3" for="other">Other</label>
										</div>
									</div>
								</div>

								<div class="form-group row mb-3">
									<div class="col-md-3 col-12 mb-2 m-md-0 text-start text-md-end">
										<label class="form-label">SSC Result :</label>
									</div>
									<div class="col-md-9">
										<input type="number" min="1" max="5" step=".01" name="ssc_result" class="form-control" placeholder="Enter SSC Results" value="{{ old('ssc_result') }}" required />
									</div>
								</div>

								<div class="form-group row mb-3">
									<div class="col-md-3 col-12 mb-2 m-md-0 text-start text-md-end">
										<label class="form-label">HSC or Diploma Result :</label>
									</div>
									<div class="col-md-9">
										<input type="number" min="1" max="5" step=".01" name="hsc_result" class="form-control" placeholder="Enter HSC Results" value="{{ old('hsc_result') }}" required />
									</div>
								</div>

								<div class="form-group row mb-3">
									<div class="col-md-3 col-12 mb-2 m-md-0 text-start text-md-end">
										<label class="form-label">Religion :</label>
									</div>
									<div class="col-md-9">
										<input type="text" name="religion" class="form-control" placeholder="Enter Religion" value="{{ old('religion') }}" required />
									</div>
								</div>

								<div class="form-group row mb-3">
									<div class="col-md-3 col-12 mb-2 m-md-0 text-start text-md-end">
										<label class="form-label">Certificate or Marksheet :</label>
									</div>
									<div class="col-md-9 col-12">
										<div id="imagePreview1" class="border rounded mb-3"></div>
										<input type="file" name="certificate" id="imageInput1" class="w-100" />
									</div>
								</div>

								<button type="submit" class="next btn btn-success btn-next float-end px-5">Next </button>
							</fieldset>

							<fieldset data-index=2 class="ms-step-2">

								<div class="form-group row mb-3">
									<div class="col-md-3 col-12 mb-2 m-md-0 text-start text-md-end">
										<label class="form-label">Admission :</label>
									</div>
									<div class="col-md-9 col-12">
										<select name="subject_id" id="subject_id" class="form-select">
											<option disabled> -- selected admission type --
											</option>
											@foreach ($f_department as $department)
											<option value="{{ $department->id }}"> {{ $department->subject }} </option>
											@endforeach
										</select>
									</div>
								</div>

								<button type="submit" class="next btn btn-success btn-next float-end px-5">Next </button>
							</fieldset>

							<fieldset data-index=3 class="ms-step-3">

								<div class="form-group row mb-3">
									<div class="col-md-3 col-12 mb-2 m-md-0 text-start text-md-end">
										<label class="form-label">Payment Type :</label>
									</div>
									<div class="col-md-9 col-12">
										<select name="payment_id" id="payment_id" class="form-select">
											<option disabled> -- selected payment type -- </option>
											@foreach ($f_payment as $payment)
											<option value="{{ $payment->id }}"> {{ $payment->payment_name }} </option>
											@endforeach
										</select>
									</div>
								</div>

								<div class="form-group row mb-3">
									<div class="col-md-3 col-12 mb-2 m-md-0 text-start text-md-end">
										<label class="form-label">Payemnt Screenshot :</label>
									</div>
									<div class="col-md-9 col-12">
										<div id="imagePreview3" class="border rounded mb-3"></div>
										<input type="file" name="transaction_number" id="imageInput3" />
									</div>
								</div>

								<button type="submit" class="next btn btn-success btn-next float-end px-5">Next </button>
							</fieldset>

							<fieldset data-index=4 class="ms-step-4 text-center">
								<p>
									Are all your changes correct? Please confirm that these changes are correct then proceed to submit the form.
								</p>
								<button type="submit" class="btn btn-success btn-submit px-5"> Confirm </button>
							</fieldset>

						</form>
					</div>

				</div>
			</div>
		</div>

	</div>
</div>
<!-- Projects End -->

@endsection

@push('js')
<!-- JS -->
<script src="{{ asset('frontend') }}/js/jquery.validate.min.js"></script>
<script src="{{ asset('frontend') }}/js/validation.js"></script>

{{-- Image preview --}}
<script>
	$(document).ready(function () {
    function handleImagePreview(input, preview, error) {
        var file = input.files[0];
        if (file) {
            var reader = new FileReader();

            if (file.type.match("image.*")) {
                reader.onload = function (e) {
                    preview.html(
                        '<img class="p-1" src="' +
                            e.target.result +
                            '" alt="Image Preview">'
                    );
                    error.html("");
                };

                reader.readAsDataURL(file);
            } else {
                alert("Please select an image file (jpg, jpeg, png).");
                $("#imagePreview1, #imagePreview2, #imagePreview3").hidden();
                return;
            }
        }
    }

    $("#imageInput1").change(function () {
        handleImagePreview(this, $("#imagePreview1"));
        $("#imagePreview1").show();
    });

    $("#imageInput2").change(function () {
        handleImagePreview(this, $("#imagePreview2"));
        $("#imagePreview2").show();
    });

    $("#imageInput3").change(function () {
        handleImagePreview(this, $("#imagePreview3"));
        $("#imagePreview3").show();
    });
	});
</script>
{{-- Image preview --}}

@endpush