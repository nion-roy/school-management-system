@extends('layouts.backend.app')

@section('title', 'Edit User')

@section('main_content')

<div class="row">
	<div class="col-sm-12">

		<div class="card">
			<div class="card-header">
				<h5>Edit User</h5>
			</div>
			<div class="card-body">

				<form action="{{ route('admin.user.update', $user->id) }}" method="post" enctype="multipart/form-data">
					@csrf
					@method('PUT')

					<div class="form-group row align-items-center">
						<label class="col-xl-2 col-sm-3 form-label mb-2 m-sm-0 text-sm-right text-start">Account Type</label>
						<div class="col-sm-1 text-center d-none d-sm-block">:</div>
						<div class="col-xl-9 col-sm-8">
							<select name="role" class="form-control" onchange="showForm(this)">
								<option disabled selected>-- Selected Account Type --</option>
								<option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
								<option value="sub-admin" {{ $user->role == 'sub-admin' ? 'selected' : '' }}>Sub Admin</option>
								<option value="teacher" {{ $user->role == 'teacher' ? 'selected' : '' }}>Teacher's</option>
								<option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>Student's</option>
							</select>
						</div>
					</div>

					<div class="form-group row align-items-center">
						<label class="col-xl-2 col-sm-3 form-label mb-2 m-sm-0 text-sm-right text-start">Full Name</label>
						<div class="col-sm-1 text-center d-none d-sm-block">:</div>
						<div class="col-xl-9 col-sm-8">
							<input type="text" name="name" class="form-control" placeholder="Enter Full Name" value="{{ $user->name }}">
						</div>
					</div>

					<div class="form-group row align-items-center">
						<label class="col-xl-2 col-sm-3 form-label mb-2 m-sm-0 text-sm-right text-start">Email Address</label>
						<div class="col-sm-1 text-center d-none d-sm-block">:</div>
						<div class="col-xl-9 col-sm-8">
							<input type="text" name="email" class="form-control" placeholder="Enter Email Address" value="{{ $user->email }}">
						</div>
					</div>

					<div class="form-group row align-items-center">
						<label class="col-xl-2 col-sm-3 form-label mb-2 m-sm-0 text-sm-right text-start">Contact Number</label>
						<div class="col-sm-1 text-center d-none d-sm-block">:</div>
						<div class="col-xl-9 col-sm-8">
							<input type="number" min="0" name="contact" class="form-control" placeholder="Enter Contact Number" value="{{ $user->contact}}">
						</div>
					</div>

					<!-- teacher form start -->
					<div id="teacher_form" style="display: none" class="{{ $user->role == 'teacher' ? 'd-block' : '' }}">

						<div class="form-group row align-items-center">
							<label class="col-xl-2 col-sm-3 form-label mb-2 m-sm-0 text-sm-right text-start">Teacher Type</label>
							<div class="col-sm-1 text-center d-none d-sm-block">:</div>
							<div class="col-xl-9 col-sm-8">
								<select name="teacher_type" class="form-control select2 w-100">
									<option disabled selected>-- Selected Teacher Type --</option>
									<option value="runing" @if ($teacher) {{ $teacher->teacher_type == 'runing' ? 'selected' : '' }} @endif>Runing Teacher</option>
									<option value="former" @if ($teacher) {{ $teacher->teacher_type == 'former' ? 'selected' : '' }} @endif> Former Teacher </option>
								</select>
							</div>
						</div>

						<div class="form-group row align-items-center">
							<label class="col-xl-2 col-sm-3 form-label mb-2 m-sm-0 text-sm-right text-start">Teacher Title</label>
							<div class="col-sm-1 text-center d-none d-sm-block">:</div>
							<div class="col-xl-9 col-sm-8">
								<input type="text" name="title" class="form-control" placeholder="Enter Teacher Title" value="{{ $teacher->title ?? null }}">
							</div>
						</div>

						<div class="form-group row align-items-center">
							<label class="col-xl-2 col-sm-3 form-label mb-2 m-sm-0 text-sm-right text-start">Facebook</label>
							<div class="col-sm-1 text-center d-none d-sm-block">:</div>
							<div class="col-xl-9 col-sm-8">
								<input type="text" name="facebook" class="form-control" placeholder="Enter Facebook Link https://" value="{{ $teacher->facebook ?? null }}">
							</div>
						</div>

						<div class="form-group row align-items-center">
							<label class="col-xl-2 col-sm-3 form-label mb-2 m-sm-0 text-sm-right text-start">Twitter</label>
							<div class="col-sm-1 text-center d-none d-sm-block">:</div>
							<div class="col-xl-9 col-sm-8">
								<input type="text" name="twitter" class="form-control" placeholder="Enter Twitter Link https://" value="{{ $teacher->twitter ?? null }}">
							</div>
						</div>

						<div class="form-group row align-items-center">
							<label class="col-xl-2 col-sm-3 form-label mb-2 m-sm-0 text-sm-right text-start">Instagram</label>
							<div class="col-sm-1 text-center d-none d-sm-block">:</div>
							<div class="col-xl-9 col-sm-8">
								<input type="text" name="instagram" class="form-control" placeholder="Enter Instagram Link https://" value="{{ $teacher->instagram ?? null }}">
							</div>
						</div>
					</div>
					<!-- teacher form end -->

					<!-- student form start -->
					<div id="student_form" style="display: none" class="{{ $user->role == 'user' ? 'd-block' : '' }}">

						<div class="form-group row align-items-center">
							<label class="col-xl-2 col-sm-3 form-label mb-2 m-sm-0 text-sm-right text-start">Student Type</label>
							<div class="col-sm-1 text-center d-none d-sm-block">:</div>
							<div class="col-xl-9 col-sm-8">
								<select name="student_type" class="form-control select2 w-100">
									<option disabled selected>-- Selected Student Type --</option>
									<option value="runing" @if ($student) {{ $student->student_type == 'runing' ? 'selected' : '' }} @endif>Runing Student</option>
									<option value="former" @if ($student) {{ $student->student_type == 'former' ? 'selected' : '' }} @endif> Former Student </option>
									<option value="achievement" @if ($student) {{ $student->student_type == 'achievement' ? 'selected' : '' }} @endif> Achievement Student </option>
								</select>
							</div>
						</div>

						<div class="form-group row align-items-center">
							<label class="col-xl-2 col-sm-3 form-label mb-2 m-sm-0 text-sm-right text-start">Father's Name</label>
							<div class="col-sm-1 text-center d-none d-sm-block">:</div>
							<div class="col-xl-9 col-sm-8">
								<input type="text" name="father_name" class="form-control" placeholder="Enter Father's Name" value="{{ $student->father_name ?? null }}">
							</div>
						</div>

						<div class="form-group row align-items-center">
							<label class="col-xl-2 col-sm-3 form-label mb-2 m-sm-0 text-sm-right text-start">Mother's Name</label>
							<div class="col-sm-1 text-center d-none d-sm-block">:</div>
							<div class="col-xl-9 col-sm-8">
								<input type="text" name="mother_name" class="form-control" placeholder="Enter Mother's Name" value="{{ $student->mother_name ?? null }}">
							</div>
						</div>

						<div class="form-group row align-items-center">
							<label class="col-xl-2 col-sm-3 form-label mb-2 m-sm-0 text-sm-right text-start">Guardian Contact</label>
							<div class="col-sm-1 text-center d-none d-sm-block">:</div>
							<div class="col-xl-9 col-sm-8">
								<input type="text" name="guardian_contact" class="form-control" placeholder="Enter Guardian Contact Number" value="{{ $student->guardian_contact ?? null }}">
							</div>
						</div>

						<div class="form-group row align-items-center">
							<label class="col-xl-2 col-sm-3 form-label mb-2 m-sm-0 text-sm-right text-start">Present Address</label>
							<div class="col-sm-1 text-center d-none d-sm-block">:</div>
							<div class="col-xl-9 col-sm-8">
								<input type="text" name="present_address" class="form-control" placeholder="Enter Present Address" value="{{ $student->present_address ?? null }}">
							</div>
						</div>

						<div class="form-group row align-items-center">
							<label class="col-xl-2 col-sm-3 form-label mb-2 m-sm-0 text-sm-right text-start">Parament Address</label>
							<div class="col-sm-1 text-center d-none d-sm-block">:</div>
							<div class="col-xl-9 col-sm-8">
								<input type="text" name="parament_address" class="form-control" placeholder="Enter Parament Address" value="{{ $student->parament_address ?? null }}">
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
									<input class="d-none form-check-input custom-control-input custom-control-input-danger" type="radio" name="gender" id="male" value="Male" {{ $user->gender == 'Male' ? 'checked' : '' }}>
									<label class="form-check-label custom-control-label" for="male">Male</label>
								</div>
								<div class="form-check custom-control custom-radio mr-3">
									<input class="d-none form-check-input custom-control-input custom-control-input-danger" type="radio" name="gender" id="female" value="Female" {{ $user->gender == 'Female' ? 'checked' : '' }}>
									<label class="form-check-label custom-control-label" for="female">Female</label>
								</div>
								<div class="form-check custom-control custom-radio">
									<input class="d-none form-check-input custom-control-input custom-control-input-danger" type="radio" name="gender" id="other" value="Other" {{ $user->gender == 'Other' ? 'checked' : '' }}>
									<label class="form-check-label custom-control-label" for="other">Other</label>
								</div>
							</div>
						</div>
					</div>

					<div class="form-group row align-items-center">
						<label class="col-xl-2 col-sm-3 form-label mb-2 m-sm-0 text-sm-right text-start">Image</label>
						<div class="col-sm-1 text-center d-none d-sm-block">:</div>
						<div class="col-xl-9 col-sm-8">
							<div id="imageContainer" class="border rounded mb-3 @if (isset($user->image)) d-block @endif"">
								<img src=" {{ Storage::disk('public')->url('user/'.$user->image) }}" alt="{{ $user->name }}">
							</div>
							<input type="file" name="image" id="imageFile">
						</div>
					</div>

					<div class="form-group row align-items-center">
						<label class="col-xl-2 col-sm-3 form-label mb-2 m-sm-0 text-sm-right text-start">Status</label>
						<div class="col-sm-1 text-center d-none d-sm-block">:</div>
						<div class="col-xl-9 col-sm-8">
							<div class="custom-control custom-checkbox">
								<input class="custom-control-input custom-control-input-danger" type="checkbox" id="customCheckbox4" name="status" {{ $user->status == true ? 'checked' : '' }}>
								<label for="customCheckbox4" class="custom-control-label">Published</label>
							</div>
						</div>
					</div>

					<div class="form-group row align-items-center">
						<div class="offset-sm-2 col-sm-10">
							<button class="btn btn-danger waves-effect float-right" type="submit">Update Now</button>
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