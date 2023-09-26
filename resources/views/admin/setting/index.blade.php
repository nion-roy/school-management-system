@extends('layouts.backend.app')

@section('title', 'Website Settings')

@section('main_content')

@push('css')
<style>
	#imagePreview1,
	#imagePreview2 {
		display: none;
		width: 180px;
		height: 120px;
	}

	#imagePreview1 img,
	#imagePreview2 img {
		width: 180px;
		height: 120px;
	}

	.nav-pills .nav-link.active,
	.nav-pills .show>.nav-link {
		background-color: #28a745;
	}
</style>
@endpush

<div class="row">
	<div class="col-lg-3">
		<div class="card">
			<div class="card-body">
				<ul class="nav nav-pills" id="myTab" role="tablist">
					<li class="nav-item w-100">
						<a class="nav-link active" id="home-tab" data-toggle="tab" href="#website">Website's Settings</a>
					</li>
					{{-- <li class="nav-item w-100">
						<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile">Profile Settings</a>
					</li> --}}
					<li class="nav-item w-100">
						<a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact">Contact's Settings</a>
					</li>
					<li class="nav-item w-100">
						<a class="nav-link" id="contact-tab" data-toggle="tab" href="#social">Social's Settings</a>
					</li>
					<li class="nav-item w-100">
						<a class="nav-link" id="contact-tab" data-toggle="tab" href="#breadcrumb">Breadcrumb Settings</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<div class="col-lg-9">
		<form action="{{ route('admin.settings.update', $settings->id) }}" method="post" enctype="multipart/form-data">
			@csrf
			@method('PUT')

			<div class="tab-content" id="myTabContent">
				<div class="tab-pane fade show active" id="website">
					<div class="card">
						<div class="card-header">
							<h3 class="card-title">Website's Settings</h3>
						</div>
						<div class="card-body">

							<div class="form-group row align-items-center">
								<label class="col-sm-3 form-label mb-2 m-sm-0 text-sm-right text-start">Website's Name</label>
								<div class="col-sm-1 text-center d-none d-sm-block">:</div>
								<div class="col-sm-8">
									<input type="text" name="wb_name" class="form-control" placeholder="Enter Website Name" value="{{ $settings->wb_name }}">
								</div>
							</div>

							<div class="form-group row align-items-center">
								<label class="col-sm-3 form-label mb-2 m-sm-0 text-sm-right text-start">Website's Logo</label>
								<div class="col-sm-1 text-center">:</div>
								<div class="col-sm-8">
									<div id="imagePreview1" class="border rounded mb-3 @if (!empty($settings->wb_name)) d-block @endif">
										<img src="{{ Storage::disk('public')->url('setting/' . $settings->wb_logo ) }}" alt="{{ $settings->wb_name }}" class="img-fluid img-thumbnail">
									</div>
									<input type="file" name="wb_logo" id="imageInput1">
								</div>
							</div>

							<div class="form-group row align-items-center">
								<label class="col-sm-3 form-label mb-2 m-sm-0 text-sm-right text-start">Website's Favicon</label>
								<div class="col-sm-1 text-center">:</div>
								<div class="col-sm-8">
									<div id="imagePreview2" class="border rounded mb-3 @if (!empty($settings->wb_favicon)) d-block @endif">
										<img src="{{ Storage::disk('public')->url('setting/' . $settings->wb_favicon ) }}" alt="{{ $settings->wb_name }}" class="img-fluid img-thumbnail">
									</div>
									<input type="file" name="wb_favicon" id="imageInput2">
								</div>
							</div>

							<div class="form-group row">
								<div class="offset-sm-2 col-sm-10">
									<button class="btn btn-success waves-effect float-right" type="submit">Update Now</button>
								</div>
							</div>

						</div>
					</div>
				</div>

				<div class="tab-pane fade" id="contact">
					<div class="card">
						<div class="card-header">
							<h3 class="card-title">Contact's Settings</h3>
						</div>
						<div class="card-body">

							<div class="form-group row align-items-center">
								<label class="col-sm-3 form-label mb-2 m-sm-0 text-sm-right text-start">Conatact Number 01</label>
								<div class="col-sm-1 text-center d-none d-sm-block">:</div>
								<div class="col-sm-8">
									<input type="text" name="number_1" class="form-control" placeholder="Enter Contact Number 01" value="{{ $settings->number_1 }}">
								</div>
							</div>

							<div class="form-group row align-items-center">
								<label class="col-sm-3 form-label mb-2 m-sm-0 text-sm-right text-start">Conatact Number 02</label>
								<div class="col-sm-1 text-center d-none d-sm-block">:</div>
								<div class="col-sm-8">
									<input type="text" name="number_2" class="form-control" placeholder="Enter Contact Number 02" value="{{ $settings->number_2 }}">
								</div>
							</div>

							<div class="form-group row align-items-center">
								<label class="col-sm-3 form-label mb-2 m-sm-0 text-sm-right text-start">Conatact Number 03</label>
								<div class="col-sm-1 text-center d-none d-sm-block">:</div>
								<div class="col-sm-8">
									<input type="text" name="number_3" class="form-control" placeholder="Enter Contact Number 03" value="{{ $settings->number_3 }}">
								</div>
							</div>

							<div class="form-group row align-items-center">
								<label class="col-sm-3 form-label mb-2 m-sm-0 text-sm-right text-start">Email Address</label>
								<div class="col-sm-1 text-center d-none d-sm-block">:</div>
								<div class="col-sm-8">
									<input type="text" name="email" class="form-control" placeholder="Enter Email" value="{{ $settings->email }}">
								</div>
							</div>

							<div class="form-group row align-items-center">
								<label class="col-sm-3 form-label mb-2 m-sm-0 text-sm-right text-start">Google Maps</label>
								<div class="col-sm-1 text-center d-none d-sm-block">:</div>
								<div class="col-sm-8">
									<input type="text" name="iframe" class="form-control" placeholder="Enter Google Map at Iframe" value="{{ $settings->iframe }}">
								</div>
							</div>

							<div class="form-group row">
								<div class="offset-sm-2 col-sm-10">
									<button class="btn btn-success waves-effect float-right" type="submit">Update Now</button>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="tab-pane fade" id="social">
					<div class="card">
						<div class="card-header">
							<h3 class="card-title">Social's Settings</h3>
						</div>
						<div class="card-body">

							<div class="form-group row align-items-center">
								<label class="col-sm-3 form-label mb-2 m-sm-0 text-sm-right text-start">Facebook Link</label>
								<div class="col-sm-1 text-center d-none d-sm-block">:</div>
								<div class="col-sm-8">
									<input type="text" name="facebook" class="form-control" placeholder="Enter Facebook Link" value="{{ $settings->facebook }}">
								</div>
							</div>

							<div class="form-group row align-items-center">
								<label class="col-sm-3 form-label mb-2 m-sm-0 text-sm-right text-start">Twiter Link</label>
								<div class="col-sm-1 text-center d-none d-sm-block">:</div>
								<div class="col-sm-8">
									<input type="text" name="twiter" class="form-control" placeholder="Enter Twiter Link" value="{{ $settings->twiter }}">
								</div>
							</div>

							<div class="form-group row align-items-center">
								<label class="col-sm-3 form-label mb-2 m-sm-0 text-sm-right text-start">Linkedin Link</label>
								<div class="col-sm-1 text-center d-none d-sm-block">:</div>
								<div class="col-sm-8">
									<input type="text" name="linkedin" class="form-control" placeholder="Enter Linkedin Link" value="{{ $settings->linkedin }}">
								</div>
							</div>

							<div class="form-group row align-items-center">
								<label class="col-sm-3 form-label mb-2 m-sm-0 text-sm-right text-start">Instagram Link</label>
								<div class="col-sm-1 text-center d-none d-sm-block">:</div>
								<div class="col-sm-8">
									<input type="text" name="instagram" class="form-control" placeholder="Enter Instagram Link" value="{{ $settings->instagram }}">
								</div>
							</div>

							<div class="form-group row">
								<div class="offset-sm-2 col-sm-10">
									<button class="btn btn-success waves-effect float-right" type="submit">Update Now</button>
								</div>
							</div>

						</div>
					</div>
				</div>

				<div class="tab-pane fade" id="breadcrumb">
					<div class="card">
						<div class="card-header">
							<h3 class="card-title">Breadcrumb's Banner Settings</h3>
						</div>
						<div class="card-body">

							<div class="form-group row align-items-center">
								<label class="col-sm-3 form-label mb-2 m-sm-0 text-sm-right text-start">Breadcrumb Banner</label>
								<div class="col-sm-1 text-center">:</div>
								<div class="col-sm-8">
									<div id="imagePreview1" class="border rounded mb-3 @if (!empty($settings->banner)) d-block @endif">
										<img src="{{ Storage::disk('public')->url('setting/' . $settings->banner ) }}" alt="{{ $settings->wb_name }}" class="img-fluid img-thumbnail">
									</div>
									<input type="file" name="banner" id="imageInput1">
								</div>
							</div>

							<div class="form-group row">
								<div class="offset-sm-2 col-sm-10">
									<button class="btn btn-success waves-effect float-right" type="submit">Update Now</button>
								</div>
							</div>

						</div>
					</div>
				</div>

			</div>

		</form>
	</div>
</div>



</div>

@endsection


@push('js')
<script>
	$(document).ready(function() {
		    function handleImagePreview(input, preview, error) {
		        var file = input.files[0];

		        if (file) {
		            var reader = new FileReader();

		            if (file.type.match('image.*')) {
		                reader.onload = function(e) {
		                    preview.html('<img class="p-1" src="' + e.target.result + '" alt="Image Preview">');
		                    error.html('');
		                }

		                reader.readAsDataURL(file);
		            }else {
								alert("Please select an image file (jpg, jpeg, png).");
								$('#imagePreview1, #imagePreview2').hidden();
								return;
								}
		        }
		    }

		    $('#imageInput1').change(function() {
		        handleImagePreview(this, $('#imagePreview1'));
						$('#imagePreview1').show();
		    });

		    $('#imageInput2').change(function() {
		        handleImagePreview(this, $('#imagePreview2'));
						$('#imagePreview2').show();
		    });
		});
</script>
@endpush