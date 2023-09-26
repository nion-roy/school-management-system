@extends('layouts.backend.app')

@section('title', 'announcements')

@section('main_content')

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<div class="d-flex align-items-center justify-content-between">
					<h3 class="card-title">All announcements <span class="badge badge-success"> {{ $announcements->count() }} </span></h3>
					<a href="{{ route('admin.announcement.create') }}" class="btn btn-success waves-effect"><i class="fas fa-plus mr-1"></i> Add New announcements</a>
				</div>
			</div>
			<!-- /.card-header -->
			<div class="card-body">
				<table id="example2" class="table table-bordered table-striped table-hover">
					<thead>
						<tr>
							<th>SL</th>
							<th>Title</th>
							<th>Announcement</th>
							<th>Create</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th>SL</th>
							<th>Title</th>
							<th>Announcement</th>
							<th>Create</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</tfoot>
					<tbody>

						@foreach ($announcements as $key => $announcement)
						<tr>
							<td>{{ $key + 1 }}</td>
							<td>{{ Str::limit($announcement->title, 36, '...') }}</td>
							<td>
								@if (file_exists(public_path("storage/announcement/$announcement->pdf")))
								<a class="btn btn-sm btn-primary waves-effect" href="{{ route('admin.announcement.download', $announcement->id) }}" data-toggle="tooltip" data-placement="top" title="Download"><i class="fas fa-download"></i></a>
								@else
								<span class="badge badge-danger">Not Found</span>
								@endif
							</td>
							{{-- <td>{{ $announcement->download }}</td> --}}
							<td>{{ $announcement->created_at->format('d-M-Y') }}</td>
							<td>
								@if ($announcement->status == true)
								<span class="badge badge-success">Active</span>
								@else
								<span class="badge badge-danger">Inactive</span>
								@endif
							</td>
							<td>
								<a href="{{ route('admin.announcement.edit', $announcement->id) }}" class="btn btn-sm btn-success waves-effect" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></a>
								{{-- <a href="{{ route('admin.announcement.show', $announcement->id) }}" class="btn btn-sm btn-info waves-effect" data-toggle="tooltip" data-placement="top" title="Show"><i class="fas fa-eye"></i></a> --}}
								<a href="{{ route('admin.announcement.delete', $announcement->id) }}" id="delete" class="btn btn-sm btn-danger waves-effect" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash"></i></a>
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