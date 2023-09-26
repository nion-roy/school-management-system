@extends('layouts.backend.app')

@section('title', 'Teacher Assign')

@section('main_content')

<!-- Modal -->
<div class="modal fade" id="exampleModal">
	<div class="modal-dialog" role="document">
		<form action="{{ route('admin.teacher-assign.store') }}" method="post">
			@csrf

			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">New Teacher Assign</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">

					<div class="form-group row align-items-center">
						<label class="col-2 text-right m-0">Section</label>
						<div class="col-1 text-center">:</div>
						<div class="col-9">
							<select name="section_id" class="form-control select2 w-100">
								<option disabled selected>-- Selected Section --</option>
								@foreach ($sections as $section)
								<option value="{{ $section->id }}">{{ $section->section }}</option>
								@endforeach
							</select>
						</div>
					</div>

					<div class="form-group row align-items-center">
						<label class="col-2 text-right m-0">Class</label>
						<div class="col-1 text-center">:</div>
						<div class="col-9">
							<select name="class_id" class="form-control select2 w-100">
								<option disabled selected>-- Selected Class --</option>
								@foreach ($classes as $class)
								<option value="{{ $class->id }}">{{ $class->batch }}</option>
								@endforeach
							</select>
						</div>
					</div>

					<div class="form-group row align-items-center">
						<label class="col-2 text-right m-0">Subject</label>
						<div class="col-1 text-center">:</div>
						<div class="col-9">
							<select name="subject_id" class="form-control select2 w-100">
								<option disabled selected>-- Selected Subject --</option>
								@foreach ($subjects as $subject)
								<option value="{{ $subject->id }}">{{ $subject->subject }}</option>
								@endforeach
							</select>
						</div>
					</div>

					<div class="form-group row align-items-center">
						<label class="col-2 text-right m-0">Teacher</label>
						<div class="col-1 text-center">:</div>
						<div class="col-9">
							<select name="teacher_id" class="form-control select2 w-100">
								<option disabled selected>-- Selected Teacher --</option>
								@foreach ($teachers as $teacher)
								<option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
								@endforeach
							</select>
						</div>
					</div>

				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times mr-1"></i> Close</button>
					<button type="submit" class="btn btn-success"><i class="fas fa-plus mr-1"></i> Add Now</button>
				</div>
			</div>
		</form>
	</div>
</div>


<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<div class="d-flex align-items-center justify-content-between">
					<h3 class="card-title">Teacher Assign <span class="badge badge-danger">{{ $assignTeachers->count() }}</span></h3>
					<a href="javascript:void(0)" class="btn btn-success waves-effect" data-toggle="modal" data-target="#exampleModal"> <i class="fas fa-plus mr-1"></i> New Teacher Assign</a>
				</div>
			</div>
			<!-- /.card-header -->
			<div class="card-body">
				<table id="example1" class="table table-bordered table-striped table-hover">
					<thead>
						<tr>
							<th>SL</th>
							<th>Name</th>
							<th>Email</th>
							<th>Section</th>
							<th>Class</th>
							<th>Subject</th>
							<th>Create</th>
							<th>Action</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th>SL</th>
							<th>Name</th>
							<th>Email</th>
							<th>Section</th>
							<th>Class</th>
							<th>Subject</th>
							<th>Create</th>
							<th>Action</th>
						</tr>
					</tfoot>
					<tbody>

						@foreach ($assignTeachers as $key => $assign)
						<tr>
							<td>{{ $key + 1 }}</td>
							<td>{{ $assign->teacher->name ?? null }}</td>
							<td>{{ $assign->teacher->email ?? null }}</td>
							<td>{{ $assign->section->section ?? null }}</td>
							<td>{{ $assign->class->batch ?? null }}</td>
							<td>{{ $assign->subject->subject ?? null }}</td>
							<td>{{ $assign->created_at->format('d-M-Y') }}</td>
							<td>
								<a href="{{ route('admin.section.delete', $assign->id) }}" id="delete" class="btn btn-sm btn-danger waves-effect" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash"></i></a>
							</td>
						</tr>
						@endforeach

					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

@endsection

{{-- @push('js')
<script>
	$(document).ready(function () {
		$(document).on('click', '#edit_btn', function(){
				var id = $(this).val();
				// alert(id);

				$.ajaxSetup({
						headers: {
								'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						}
				});


				$.ajax({
					type: "get",
					url: "/admin/teacher-assign/edit/" + id ,
					dataType: "json",
					success: function (response) {
						// console.log(response);

						$('#id').val(response.allTeacher.id);
						$.each(response.class, function (key, val)){

						}
					}
				});


			});
	});
</script>
@endpush --}}