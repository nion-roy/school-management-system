@extends('layouts.backend.app')

@section('title', 'Update News')

@section('main_content')

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<div class="d-flex align-items-center justify-content-between">
					<h3 class="card-title">Update News <span class="badge badge-success"></span></h3>
					<a href="{{ route('admin.update-news.create') }}" class="btn btn-success waves-effect"> <i class="fas fa-plus mr-1"></i> Add Update News</a>
				</div>
			</div>
			<!-- /.card-header -->
			<div class="card-body">
				<table id="example2" class="table table-bordered table-striped table-hover">
					<thead>
						<tr>
							<th>SL</th>
							<th>Title</th>
							<th>File</th>
							<th>News Type</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th>SL</th>
							<th>Title</th>
							<th>File</th>
							<th>News Type</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</tfoot>
					<tbody>

						@foreach ($updateNews as $key => $news)
						<tr>
							<td>{{ $key + 1 }}</td>
							<td>{{ Str::limit($news->title, 18, '...') }}</td>
							<td>
								@if (file_exists(public_path("storage/news/update/$news->file")))
								<a class="btn btn-sm btn-primary waves-effect" href="{{ $news->file }}" data-toggle="tooltip" data-placement="top" title="Download"><i class="fas fa-download"></i></a>
								@else
								<span class="badge badge-danger">Not Found</span>
								@endif
							</td>
							<td>{{ $news->news_type }}</td>
							<td>
								@if ($news->status == true)
								<span class="badge badge-success">Active</span>
								@else
								<span class="badge badge-danger">Inactive</span>
								@endif
							</td>
							<td>
								<a href="{{ route('admin.update-news.edit', $news->id) }}" class="btn btn-sm btn-success waves-effect" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></a>
								{{-- <a href="{{ route('admin.update-news.show', $news->id) }}" class="btn btn-sm btn-info waves-effect" data-toggle="tooltip" data-placement="top" title="Show"><i class="fas fa-eye"></i></a> --}}
								<a href="{{ route('admin.update-news.delete', $news->id) }}" id="delete" class="btn btn-sm btn-danger waves-effect" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash"></i></a>
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