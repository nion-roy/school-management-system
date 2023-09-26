@extends('layouts.backend.app')

@section('title', 'Students')

@section('main_content')

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<div class="d-flex align-items-center justify-content-between">
					<h3 class="card-title">All Students <span class="badge badge-success"></span></h3>
					<a href="{{ route('admin.achievement-student.create') }}" class="btn btn-success waves-effect">
						<i class="fas fa-plus mr-1"></i> Add Students</a>
				</div>
			</div>
			<!-- /.card-header -->
			<div class="card-body">
				<table id="example1" class="table table-bordered table-striped table-hover">
					<thead>
						<tr>
							<th>SL</th>
							<th>Name</th>
							<th>Type</th>
							<th>Title</th>
							<th>Image</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th>SL</th>
							<th>Name</th>
							<th>Type</th>
							<th>Title</th>
							<th>Image</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</tfoot>
					<tbody>

						@foreach ($oldStudents as $key => $student)
						<tr>
							<td>{{ $key + 1 }}</td>
							<td>{{ $student->name }}</td>
							<td>{{ $student->student_type }}</td>
							<td>{{ $student->title }}</td>
							<td><img src="{{ Storage::disk('public')->url('students/achievement/' . $student->image ) }}" class="img-fluid img-thumbnail" style="width: 50px; height: 50px;" alt="{{ $student->name }}"></td>
							<td>
								@if ($student->status == true)
								<span class="badge badge-success">Active</span>
								@else
								<span class="badge badge-danger">Inactive</span>
								@endif
							</td>
							<td>
								<a href="{{ route('admin.achievement-student.edit', $student->id) }}" class="btn btn-sm btn-success waves-effect" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></a>
								{{-- <a href="{{ route('admin.achievement-student.show', $student->id) }}" class="btn btn-sm btn-info waves-effect" data-toggle="tooltip" data-placement="top" title="Show"><i class="fas fa-eye"></i></a> --}}
								<a href="{{ route('admin.achievement-student.delete', $student->id) }}" id="delete" class="btn btn-sm btn-danger waves-effect" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash"></i></a>
							</td>
						</tr>
						@endforeach

					</tbody>
				</table>
			</div>
			<!-- /.card-body -->
		</div>
		<!-- /.card -->

		<!-- /.card -->
	</div>
	<!-- /.col -->
</div>

@endsection