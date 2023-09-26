@extends('layouts.backend.app')

@section('title', 'News')

@section('main_content')

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<div class="d-flex align-items-center justify-content-between">
					<h3 class="card-title">Important News <span class="badge badge-success"></span></h3>
					<a href="{{ route('admin.important-news.create') }}" class="btn btn-success waves-effect"> <i class="fas fa-plus mr-1"></i> Add Important News</a>
				</div>
			</div>
			<!-- /.card-header -->
			<div class="card-body">
				<table id="example2" class="table table-bordered table-striped table-hover">
					<thead>
						<tr>
							<th>SL</th>
							<th>Title</th>
							<th>Links</th>
							<th>Action</th>
							<th>Action</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th>SL</th>
							<th>Title</th>
							<th>Links</th>
							<th>Action</th>
							<th>Action</th>
						</tr>
					</tfoot>
					<tbody>

						@foreach ($importantNews as $key => $news)
						<tr>
							<td>{{ $key + 1 }}</td>
							<td>{{ Str::limit($news->title, 18, '...') }}</td>
							<td> <a target="blank" href="{{ $news->links }}"><i class="fab fa-firefox-browser btn btn-success btn-sm waves-effect" data-toggle="tooltip" data-placement="top" title="{{ $news->title }}"></i></a> </td>
							<td>
								@if ($news->status == true)
								<span class="badge badge-success">Active</span>
								@else
								<span class="badge badge-danger">Inactive</span>
								@endif
							</td>
							<td>
								<a href="{{ route('admin.important-news.edit', $news->id) }}" class="btn btn-sm btn-success waves-effect" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></a>
								{{-- <a href="{{ route('admin.important-news.show', $news->id) }}" class="btn btn-sm btn-info waves-effect" data-toggle="tooltip" data-placement="top" title="Show"><i class="fas fa-eye"></i></a> --}}
								<a href="{{ route('admin.important-news.delete', $news->id) }}" id="delete" class="btn btn-sm btn-danger waves-effect" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash"></i></a>
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