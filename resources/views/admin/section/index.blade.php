@extends('layouts.backend.app')

@section('title', 'Section')

@section('main_content')

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<div class="d-flex align-items-center justify-content-between">
					<h3 class="card-title">Section</h3>
					<a href="{{ route('admin.section.create') }}" class="btn btn-success waves-effect"> <i class="fas fa-plus-circle mr-1"></i> Add New Section</a>
				</div>
			</div>
			<!-- /.card-header -->
			<div class="card-body">
				<table id="example2" class="table table-bordered table-striped table-hover">
					<thead>
						<tr>
							<th>SL</th>
							<th>Section</th>
							<th>Status</th>
							<th>Create</th>
							<th>Action</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th>SL</th>
							<th>Section</th>
							<th>Status</th>
							<th>Create</th>
							<th>Action</th>
						</tr>
					</tfoot>
					<tbody>

						@foreach ($sections as $key => $section)
						<tr>
							<td>{{ $key + 1 }}</td>
							<td>{{ $section->section }}</td>
							<td>
								@if ($section->status == true)
								<span class="badge badge-success">Active</span>
								@else
								<span class="badge badge-danger">Inactive</span>
								@endif
							</td>
							<td>{{ $section->created_at->format('d-M-Y') }}</td>
							<td>
								<a href="{{ route('admin.section.edit', $section->id) }}" class="btn btn-sm btn-success waves-effect" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></a>
								{{-- <a href="#update{{ $section->id }}" data-toggle="modal" class="btn btn-sm btn-success waves-effect" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></a> --}}
								<a href="{{ route('admin.section.delete', $section->id) }}" id="delete" class="btn btn-sm btn-danger waves-effect" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash"></i></a>
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