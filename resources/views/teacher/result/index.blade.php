@extends('layouts.backend.app')

@section('title', 'Students')

@section('main_content')

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<div class="d-flex align-items-center justify-content-between">
					<h3 class="card-title">All Students <span class="badge badge-success"></span></h3>
					<a href="{{ route('teacher.result.create') }}" class="btn btn-success waves-effect">
						<i class="fas fa-plus mr-1"></i> Add Resutls</a>
				</div>
			</div>
			<!-- /.card-header -->
			<div class="card-body">
				<table id="example1" class="table table-bordered table-striped table-hover">
					<thead>
						<tr>
							<th>SL</th>
							<th>Name</th>
							<th>Class</th>
							<th>Roll</th>
							<th>Subject</th>
							<th>Mark</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th>SL</th>
							<th>Name</th>
							<th>Class</th>
							<th>Roll</th>
							<th>Subject</th>
							<th>Mark</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</tfoot>
					<tbody>

						@foreach ($results as $key => $student)
						<tr>
							<td>{{ $key + 1 }}</td>
							<td>{{ $student->student->name ?? null }}</td>
							<td>{{ $student->class->batch ?? null }}</td>
							<td>{{ $student->student->roll?? null }}</td>
							<td>{{ $student->subject->subject?? null }}</td>
							<td>{{ $student->mark?? null }}</td>
							<td>
								@if ($student->status == true)
								<span class="badge badge-success">Active</span>
								@else
								<span class="badge badge-danger">Inactive</span>
								@endif
							</td>
							<td>
								<a href="{{ route('teacher.result.edit', $student->id) }}" class="btn btn-sm btn-success waves-effect" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></a>
								<a href="{{ route('teacher.result.show', $student->id) }}" class="btn btn-sm btn-info waves-effect" data-toggle="tooltip" data-placement="top" title="Show"><i class="fas fa-eye"></i></a>
								<a href="{{ route('teacher.result.delete', $student->id) }}" id="delete" class="btn btn-sm btn-danger waves-effect" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash"></i></a>
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