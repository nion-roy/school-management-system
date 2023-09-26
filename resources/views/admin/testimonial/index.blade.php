@extends('layouts.backend.app')

@section('title', 'Testimonial')

@section('main_content')

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<div class="d-flex align-items-center justify-content-between">
					<h3 class="card-title">All Testimonial <span class="badge badge-success"> {{ $testimonials->count() }} </span></h3>
					<a href="{{ route('admin.testimonial.create') }}" class="btn btn-success waves-effect"><i class="fas fa-plus mr-1"></i> Add Comments</a>
				</div>
			</div>
			<!-- /.card-header -->
			<div class="card-body">
				<table id="example2" class="table table-bordered table-striped table-hover">
					<thead>
						<tr>
							<th>SL</th>
							<th>Name</th>
							<th>Designation</th>
							<th>Location</th>
							<th>Image</th>
							<th>Status</th>
							<th>Create</th>
							<th>Action</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th>SL</th>
							<th>Name</th>
							<th>Designation</th>
							<th>Location</th>
							<th>Image</th>
							<th>Status</th>
							<th>Create</th>
							<th>Action</th>
						</tr>
					</tfoot>
					<tbody>

						@foreach ($testimonials as $key => $testimonial)
						<tr>
							<td>{{ $key + 1 }}</td>
							<td>{{ $testimonial->name }}</td>
							<td>{{ $testimonial->designation }}</td>
							<td>{{ $testimonial->location }}</td>
							<td><img src="{{ Storage::disk('public')->url('testimonial/'. $testimonial->image) }}" class="img-fluid img-thumbnail" style="width: 50px; height: 50px;" alt="{{ $testimonial->name }}"></td>
							<td>
								@if ($testimonial->status == true)
								<span class="badge badge-success">Active</span>
								@else
								<span class="badge badge-danger">Inactive</span>
								@endif
							</td>
							<td>{{ $testimonial->created_at->format('d M Y') }}</td>

							<td>
								<a href="{{ route('admin.testimonial.edit', $testimonial->id) }}" class="btn btn-sm btn-success waves-effect" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></a>
								{{-- <a href="{{ route('admin.testimonial.show', $testimonial->id) }}" class="btn btn-sm btn-info waves-effect" data-toggle="tooltip" data-placement="top" title="Show"><i class="fas fa-eye"></i></a> --}}
								<a href="{{ route('admin.testimonial.delete', $testimonial->id) }}" id="delete" class="btn btn-sm btn-danger waves-effect" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash"></i></a>
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