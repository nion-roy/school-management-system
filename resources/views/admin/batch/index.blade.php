@extends('layouts.backend.app')

@section('title', 'Class')

@section('main_content')

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<div class="d-flex align-items-center justify-content-between">
					<h3 class="card-title">All Class -: <span class="badge bg-success">{{ $batches->count() }}</span></h3>
					<a href="{{ route('admin.class.create') }}" class="btn btn-success waves-effect"> <i class="fas fa-plus-circle mr-1"></i> Add New Class</a>
				</div>
			</div>
			<!-- /.card-header -->
			<div class="card-body">
				<table id="example2" class="table table-bordered table-striped table-hover">
					<thead>
						<tr>
							<th>SL</th>
							<th>Class</th>
							<th>Section</th>
							<th>Status</th>
							<th>Create</th>
							<th>Action</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th>SL</th>
							<th>Class</th>
							<th>Section</th>
							<th>Status</th>
							<th>Create</th>
							<th>Action</th>
						</tr>
					</tfoot>
					<tbody>

						@foreach ($batches as $key => $class)
						<tr>
							<td>{{ $key + 1 }}</td>
							<td>{{ $class->batch }}</td>
							<td>{{ $class->section->section ?? null }}</td>
							<td>
								@if ($class->status == true)
								<span class="badge badge-success">Active</span>
								@else
								<span class="badge badge-danger">Inactive</span>
								@endif
							</td>
							<td>{{ $class->created_at->format('d-M-Y') }}</td>
							<td>
								<a href="{{ route('admin.class.edit', $class->id) }}" class="btn btn-sm btn-success waves-effect" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></a>
								{{-- <a href="{{ route('admin.class.show', $class->id) }}" class="btn btn-sm btn-info waves-effect" data-toggle="tooltip" data-placement="top" title="Show"><i class="fas fa-eye"></i></a> --}}
								<a href="{{ route('admin.class.delete', $class->id) }}" id="delete" class="btn btn-sm btn-danger waves-effect" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash"></i></a>
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