@extends('layouts.backend.app')

@section('title', 'Result')

@section('main_content')

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<div class="d-flex align-items-center justify-content-between">
					<h3 class="card-title">All Result <span class="badge badge-success">{{ $results->count() }}</span></h3>
					<a href="{{ route('admin.result.create') }}" class="btn btn-success waves-effect">
						<i class="fas fa-plus mr-1"></i> Add Result</a>
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
							<th>Result</th>
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
							<th>Result</th>
							<th>View</th>
							<th>Create</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</tfoot>
					<tbody>

						@foreach ($results as $key => $result)
						<tr>
							<td>{{ $key + 1 }}</td>
							<td>{{ $result->title }}</td>
							<td>{{ $result->class->batch }}</td>
							<td>{{ $result->type }}</td>
							<td>
								@if (file_exists(public_path("storage/result/$result->pdf")))
								<a class="btn btn-sm btn-primary waves-effect" href="{{ route('admin.result.download', $result->id) }}" data-toggle="tooltip" data-placement="top" title="Download"><i class="fas fa-download"></i></a>
								@else
								<span class="badge badge-danger">Not Found</span>
								@endif
							</td>
							<td>{{ $result->view_count }}</td>
							<td>{{ $result->created_at->format('d M Y') }}</td>
							<td>
								@if ($result->status == true)
								<span class="badge badge-success">Active</span>
								@else
								<span class="badge badge-danger">Inactive</span>
								@endif
							</td>
							<td>
								<a href="{{ route('admin.result.edit', $result->id) }}" class="btn btn-sm btn-success waves-effect" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></a>
								{{-- <a href="{{ route('admin.result.show', $result->id) }}" class="btn btn-sm btn-info waves-effect" data-toggle="tooltip" data-placement="top" title="Show"><i class="fas fa-eye"></i></a> --}}
								<a href="{{ route('admin.result.delete', $result->id) }}" id="delete" class="btn btn-sm btn-danger waves-effect" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash"></i></a>
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