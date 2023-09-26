@extends('layouts.backend.app')

@section('title', 'Class Routine')

@section('main_content')

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<div class="d-flex align-items-center justify-content-between">
					<h3 class="card-title">All Class Routine <span class="badge badge-success">{{ $class->count() }}</span></h3>
					<a href="{{ route('admin.class-routine.create') }}" class="btn btn-success waves-effect"> <i class="fas fa-plus mr-1"></i> Add Class Routine</a>
				</div>
			</div>
			<!-- /.card-header -->
			<div class="card-body">
				<table id="example2" class="table table-bordered table-striped table-hover">
					<thead>
						<tr>
							<th>SL</th>
							<th>Title</th>
							<th>Class</th>
							<th>Type</th>
							<th>Routine</th>
							<th>View</th>
							<th>Create</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th>SL</th>
							<th>Title</th>
							<th>Class</th>
							<th>Type</th>
							<th>Routine</th>
							<th>View</th>
							<th>Create</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</tfoot>
					<tbody>

						@foreach ($class as $key => $class)
						<tr>
							<td>{{ $key + 1 }}</td>
							<td>{{ $class->title }}</td>
							<td>{{ $class->class->batch }}</td>
							<td>{{ $class->type }}</td>
							<td>
								@if (file_exists(public_path("storage/class/$class->pdf")))
								<a class="btn btn-sm btn-primary waves-effect" href="{{ route('admin.class-routine.download', $class->id) }}" data-toggle="tooltip" data-placement="top" title="Download"><i class="fas fa-download"></i></a>
								@else
								<span class="badge badge-danger">Not Found</span>
								@endif
							</td>
							<td>{{ $class->view_count }}</td>
							<td>{{ $class->created_at->format('d M Y') }}</td>
							<td>
								@if ($class->status == true)
								<span class="badge badge-success">Active</span>
								@else
								<span class="badge badge-danger">Inactive</span>
								@endif
							</td>
							<td>
								<a href="{{ route('admin.class-routine.edit', $class->id) }}" class="btn btn-sm btn-success waves-effect" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></a>
								{{-- <a href="{{ route('admin.class-routine.show', $result->id) }}" class="btn btn-sm btn-info waves-effect" data-toggle="tooltip" data-placement="top" title="Show"><i class="fas fa-eye"></i></a> --}}
								<a href="{{ route('admin.class-routine.delete', $class->id) }}" id="delete" class="btn btn-sm btn-danger waves-effect" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash"></i></a>
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