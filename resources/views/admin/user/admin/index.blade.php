@extends('layouts.backend.app')

@section('title', 'All Admin & Sub-Admin')

@section('main_content')



<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<div class="d-flex align-items-center justify-content-between">
					<h3 class="card-title">All Admin & Sub Admin <span class="badge badge-success">Admin {{ $admin }}</span> <span class="badge badge-success">Sub-Admin {{ $subAdmin }}</span></h3>
					<a href="{{ route('admin.user.create') }}" class="btn btn-success waves-effect"> <i class="fas fa-plus mr-1"></i> Add User</a>

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
							<th>Role</th>
							<th>Image</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th>SL</th>
							<th>Name</th>
							<th>Email</th>
							<th>Role</th>
							<th>Image</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</tfoot>
					<tbody>

						@foreach ($admins as $key => $admin)
						<tr>
							<td>{{ $key + 1 }}</td>
							<td>{{ Str::ucfirst($admin->name) }}</td>
							<td>{{ $admin->email }}</td>
							<td>{{ Str::ucfirst($admin->role) }}</td>
							<td><img src="{{ Storage::disk('public')->url('user/'. $admin->image) }}" class="img-fluid img-thumbnail" style="width: 50px; height: 50px;" alt="{{ $admin->title }}"></td>
							<td>
								@if ($admin->status == true)
								<span class="badge badge-success">Active</span>
								@else
								<span class="badge badge-danger">Inactive</span>
								@endif
							</td>
							<td>
								<a href="{{ route('admin.user.edit', $admin->id) }}" class="btn btn-sm btn-success waves-effect" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></a>
								<a href="{{ route('admin.user.show', $admin->id) }}" class="btn btn-sm btn-info waves-effect" data-toggle="tooltip" data-placement="top" title="Show"><i class="fas fa-eye"></i></a>
								<a href="{{ route('admin.user.delete', $admin->id) }}" id="delete" class="btn btn-sm btn-danger waves-effect" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash"></i></a>
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