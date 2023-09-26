@extends('layouts.backend.app')

@section('title', 'Video Gallery')

@section('main_content')

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<div class="d-flex align-items-center justify-content-between">
					<h3 class="card-title">Video Gallery <span class="badge badge-success">{{ $galleries->count() }}</span></h3>
					<a href="{{ route('admin.video-gallery.create') }}" class="btn btn-success waves-effect"> <i class="fas fa-plus mr-1"></i> Add Video</a>
				</div>
			</div>
			<!-- /.card-header -->
			<div class="card-body">
				<table id="example2" class="table table-bordered table-striped table-hover">
					<thead>
						<tr>
							<th>SL</th>
							<th>Title</th>
							<th>Video</th>
							<th>Status</th>
							<th>Create</th>
							<th>Action</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th>SL</th>
							<th>Title</th>
							<th>Video</th>
							<th>Status</th>
							<th>Create</th>
							<th>Action</th>
						</tr>
					</tfoot>
					<tbody>

						@foreach ($galleries as $key => $gallery)
						<tr>
							<td>{{ $key + 1 }}</td>
							<td>{{ Str::limit($gallery->title, 18, '...') }}</td>
							<td>
								<video controls autoplay style="width: 120px; height: 120px;" class="img-thumbnail">
									<source src="{{ Storage::disk('public')->url('gallery/video/' . $gallery->gallery ) }}" type="video/mp4">
									Your browser does not support the video tag.
								</video>
							</td>
							<td>
								@if ($gallery->status == true)
								<span class="badge badge-success">Active</span>
								@else
								<span class="badge badge-danger">Inactive</span>
								@endif
							</td>
							<td>{{ $gallery->created_at->format('d M, Y') }}</td>
							<td>
								<a href="{{ route('admin.video-gallery.edit', $gallery->id) }}" class="btn btn-sm btn-success waves-effect" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></a>
								<a href="{{ route('admin.video-gallery.show', $gallery->id) }}" class="btn btn-sm btn-info waves-effect" data-toggle="tooltip" data-placement="top" title="Show"><i class="fas fa-eye"></i></a>
								<a href="{{ route('admin.video-gallery.delete', $gallery->id) }}" id="delete" class="btn btn-sm btn-danger waves-effect" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash"></i></a>
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