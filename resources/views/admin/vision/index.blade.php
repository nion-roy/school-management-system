@extends('layouts.backend.app')

@section('title', 'Vision')

@section('main_content')

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<div class="d-flex align-items-center justify-content-between">
					<h3 class="card-title">Vision Information <span class="badge badge-success"></span></h3>
					<a href="{{ route('admin.vision.create') }}" class="btn btn-success waves-effect">
						<i class="fas fa-plus mr-1"></i> Add Vision Info</a>
				</div>
			</div>
			<!-- /.card-header -->
			<div class="card-body">
				<table id="example2" class="table table-bordered table-striped table-hover">
					<thead>
						<tr>
							<th>SL</th>
							<th>Title</th>
							<th>Slug</th>
							<th>Image</th>
							<th>Create</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th>SL</th>
							<th>Title</th>
							<th>Slug</th>
							<th>Image</th>
							<th>Create</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</tfoot>
					<tbody>

						@foreach ($vision as $key => $vision)
						<tr>
							<td>{{ $key + 1 }}</td>
							<td>{{ Str::limit($vision->title, 14, '...') }}</td>
							<td>{{ Str::limit($vision->slug, 14, '...') }}</td>
							<td><img src="{{ Storage::disk('public')->url('about/'. $vision->image) }}" class="img-fluid img-thumbnail" style="width: 50px; height: 50px;" alt="{{ $vision->title }}"></td>
							<td>{{ $vision->created_at->format('d M Y') }}</td>
							<td>
								@if ($vision->status == true)
								<span class="badge badge-success">Active</span>
								@else
								<span class="badge badge-danger">Inactive</span>
								@endif
							</td>
							<td>
								<a href="{{ route('admin.vision.edit', $vision->id) }}" class="btn btn-sm btn-success waves-effect" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></a>
								<a href="{{ route('admin.vision.show', $vision->id) }}" class="btn btn-sm btn-info waves-effect" data-toggle="tooltip" data-placement="top" title="Show"><i class="fas fa-eye"></i></a>
								<a href="{{ route('admin.vision.delete', $vision->id) }}" id="delete" class="btn btn-sm btn-danger waves-effect" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash"></i></a>
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