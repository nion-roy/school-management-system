@extends('layouts.backend.app')

@section('title', 'Add Teacher')

@section('main_content')

<div class="row">
	<div class="col-sm-12">

		<div class="card">
			<div class="card-header">
				<h5>Add Teacher</h5>
			</div>
			<div class="card-body">

				<form action="{{ route('admin.user.store') }}" method="post" enctype="multipart/form-data">
					@csrf

					<div class="form-group row align-items-center">
						<label class="col-xl-2 col-sm-3 form-label mb-2 m-sm-0 text-sm-right text-start">Account Type</label>
						<div class="col-sm-1 text-center d-none d-sm-block">:</div>
						<div class="col-xl-9 col-sm-8">
							<select name="role" class="form-control" onchange="showForm(this)">
								<option disabled selected>-- Selected Account Type --</option>
								<option value="admin" @if (old('role')=="admin" ) {{ 'selected' }} @endif>Admin</option>
								<option value="sub-admin" @if (old('role')=="sub-admin" ) {{ 'selected' }} @endif>Sub Admin</option>
								<option value="teacher" @if (old('role')=="teacher" ) {{ 'selected' }} @endif>Teacher's</option>
								<option value="user" @if (old('role')=="user" ) {{ 'selected' }} @endif>Student's</option>
							</select>
						</div>
					</div>

					<div class="form-group row align-items-center">
						<label class="col-xl-2 col-sm-3 form-label mb-2 m-sm-0 text-sm-right text-start">Full Name</label>
						<div class="col-sm-1 text-center d-none d-sm-block">:</div>
						<div class="col-xl-9 col-sm-8">
							<input type="text" name="name" class="form-control" placeholder="Enter Full Name" value="{{ old('name') }}">
						</div>
					</div>

					<div class="form-group row align-items-center">
						<label class="col-xl-2 col-sm-3 form-label mb-2 m-sm-0 text-sm-right text-start">Email Address</label>
						<div class="col-sm-1 text-center d-none d-sm-block">:</div>
						<div class="col-xl-9 col-sm-8">
							<input type="text" name="email" class="form-control" placeholder="Enter Email Address" value="{{ old('email') }}">
						</div>
					</div>

					<div class="form-group row align-items-center">
						<label class="col-xl-2 col-sm-3 form-label mb-2 m-sm-0 text-sm-right text-start">Contact Number</label>
						<div class="col-sm-1 text-center d-none d-sm-block">:</div>
						<div class="col-xl-9 col-sm-8">
							<input type="number" min="0" name="contact" class="form-control" placeholder="Enter Contact Number" value="{{ old('contact') }}">
						</div>
					</div>

					<!-- teacher form start -->
					<div id="teacher_form" style="display: none" class="@if (old('role')=='teacher') {{ 'd-block' }} @endif">

						<div class="form-group row align-items-center">
							<label class="col-xl-2 col-sm-3 form-label mb-2 m-sm-0 text-sm-right text-start">Teacher Title</label>
							<div class="col-sm-1 text-center d-none d-sm-block">:</div>
							<div class="col-xl-9 col-sm-8">
								<input type="text" name="title" class="form-control" placeholder="Enter Teacher Title" value="{{ old('title') }}">
							</div>
						</div>

						<div class="form-group row align-items-center">
							<label class="col-xl-2 col-sm-3 form-label mb-2 m-sm-0 text-sm-right text-start">Facebook</label>
							<div class="col-sm-1 text-center d-none d-sm-block">:</div>
							<div class="col-xl-9 col-sm-8">
								<input type="text" name="facebook" class="form-control" placeholder="Enter Facebook Link https://" value="{{ old('facebook') }}">
							</div>
						</div>

						<div class="form-group row align-items-center">
							<label class="col-xl-2 col-sm-3 form-label mb-2 m-sm-0 text-sm-right text-start">Twitter</label>
							<div class="col-sm-1 text-center d-none d-sm-block">:</div>
							<div class="col-xl-9 col-sm-8">
								<input type="text" name="twitter" class="form-control" placeholder="Enter Twitter Link https://" value="{{ old('twitter') }}">
							</div>
						</div>

						<div class="form-group row align-items-center">
							<label class="col-xl-2 col-sm-3 form-label mb-2 m-sm-0 text-sm-right text-start">Instagram</label>
							<div class="col-sm-1 text-center d-none d-sm-block">:</div>
							<div class="col-xl-9 col-sm-8">
								<input type="text" name="instagram" class="form-control" placeholder="Enter Instagram Link https://" value="{{ old('instagram') }}">
							</div>
						</div>

					</div>
					<!-- teacher form end -->

					<!-- student form start -->
					<div id="student_form" style="display: none" class="@if (old('role')=='user') {{ 'd-block' }} @endif">
						<div class="form-group row align-items-center">
							<label class="col-xl-2 col-sm-3 form-label mb-2 m-sm-0 text-sm-right text-start">Father's Name</label>
							<div class="col-sm-1 text-center d-none d-sm-block">:</div>
							<div class="col-xl-9 col-sm-8">
								<input type="text" name="father_name" class="form-control" placeholder="Enter Father's Name" value="{{ old('father_name') }}">
							</div>
						</div>

						<div class="form-group row align-items-center">
							<label class="col-xl-2 col-sm-3 form-label mb-2 m-sm-0 text-sm-right text-start">Mother's Name</label>
							<div class="col-sm-1 text-center d-none d-sm-block">:</div>
							<div class="col-xl-9 col-sm-8">
								<input type="text" name="mother_name" class="form-control" placeholder="Enter Mother's Name" value="{{ old('mother_name') }}">
							</div>
						</div>

						<div class="form-group row align-items-center">
							<label class="col-xl-2 col-sm-3 form-label mb-2 m-sm-0 text-sm-right text-start">Guardian Contact</label>
							<div class="col-sm-1 text-center d-none d-sm-block">:</div>
							<div class="col-xl-9 col-sm-8">
								<input type="number" min="0" name="guardian_contact" class="form-control" placeholder="Enter Guardian Contact Number" value="{{ old('guardian_contact') }}">
							</div>
						</div>

						<div class="form-group row align-items-center">
							<label class="col-xl-2 col-sm-3 form-label mb-2 m-sm-0 text-sm-right text-start">Present Address</label>
							<div class="col-sm-1 text-center d-none d-sm-block">:</div>
							<div class="col-xl-9 col-sm-8">
								<input type="text" name="present_address" class="form-control" placeholder="Enter Present Address" value="{{ old('present_address') }}">
							</div>
						</div>

						<div class="form-group row align-items-center">
							<label class="col-xl-2 col-sm-3 form-label mb-2 m-sm-0 text-sm-right text-start">Parament Address</label>
							<div class="col-sm-1 text-center d-none d-sm-block">:</div>
							<div class="col-xl-9 col-sm-8">
								<input type="text" name="parament_address" class="form-control" placeholder="Enter Parament Address" value="{{ old('parament_address') }}">
							</div>
						</div>
					</div>
					<!-- student form end -->

					<div class="form-group row align-items-center">
						<label class="col-xl-2 col-sm-3 form-label mb-2 m-sm-0 text-sm-right text-start">Gender</label>
						<div class="col-sm-1 text-center d-none d-sm-block">:</div>
						<div class="col-xl-9 col-sm-8">
							<div class="d-flex">
								<div class="form-check custom-control custom-radio mr-3">
									<input class="d-none form-check-input custom-control-input custom-control-input-danger" type="radio" name="gender" id="male" value="Male" checked>
									<label class="form-check-label custom-control-label" for="male">Male</label>
								</div>
								<div class="form-check custom-control custom-radio mr-3">
									<input class="d-none form-check-input custom-control-input custom-control-input-danger" type="radio" name="gender" id="female" value="Female">
									<label class="form-check-label custom-control-label" for="female">Female</label>
								</div>
								<div class="form-check custom-control custom-radio">
									<input class="d-none form-check-input custom-control-input custom-control-input-danger" type="radio" name="gender" id="other" value="Other">
									<label class="form-check-label custom-control-label" for="other">Other</label>
								</div>
							</div>
						</div>
					</div>

					<div class="form-group row align-items-center">
						<label class="col-xl-2 col-sm-3 form-label mb-2 m-sm-0 text-sm-right text-start">Image</label>
						<div class="col-sm-1 text-center d-none d-sm-block">:</div>
						<div class="col-xl-9 col-sm-8">
							<div id="imageContainer" class="border rounded mb-3"></div>
							<input type="file" name="image" id="imageFile">
						</div>
					</div>

					<div class="form-group row align-items-center">
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
							<a href="{{ route('admin.user.index') }}" class="btn btn-success waves-effect float-right mr-2"> <i class="fas fa-arrow-left mr-1"></i> Back</a>
						</div>
					</div>

				</form>

			</div>
		</div>

	</div>
</div>

@endsection

@push('js')
<script type="text/javascript">
	function showForm(select){
		if(select.value=='teacher'){
			document.getElementById("teacher_form").style="display:block";
			document.getElementById("student_form").style="display:none !important";
		}else if(select.value=='user'){
			document.getElementById("teacher_form").style="display:none !important";
			document.getElementById("student_form").style="display:block";
		} else{
			document.getElementById("teacher_form").style="display:none !important";
			document.getElementById("student_form").style="display:none !important";
		}
}
</script>
@endpush