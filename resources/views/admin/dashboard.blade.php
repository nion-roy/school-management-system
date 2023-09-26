@extends('layouts.backend.app')

@section('title', 'Dashboard')

@section('main_content')

@push('css')
<style>
	@media only screen and (max-width: 767px) {
		.table {
			width: 767px;
		}
	}
</style>
@endpush

{{-- <div class="row">
	<div class="col-12 col-sm-6 col-md-3">
		<div class="info-box">
			<span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>
			<div class="info-box-content">
				<span class="info-box-text">Total Class</span>
				<span class="info-box-number"> {{ $departments }} </span>
			</div>
		</div>
	</div>

	<div class="col-12 col-sm-6 col-md-3">
		<div class="info-box mb-3">
			<span class="info-box-icon bg-danger elevation-1"><i class="fas fa-cog"></i></span>
			<div class="info-box-content">
				<span class="info-box-text">Total Subject</span>
				<span class="info-box-number">{{ $subjects }}</span>
			</div>
		</div>
	</div>

	<div class="col-12 col-sm-6 col-md-3">
		<div class="info-box mb-3">
			<span class="info-box-icon bg-success elevation-1"><i class="fas fa-cog"></i></span>
			<div class="info-box-content">
				<span class="info-box-text">Total Students</span>
				<span class="info-box-number">{{ $students }}</span>
			</div>
		</div>
	</div>

	<div class="col-12 col-sm-6 col-md-3">
		<div class="info-box mb-3">
			<span class="info-box-icon bg-pink elevation-1"><i class="fas fa-cog"></i></span>
			<div class="info-box-content">
				<span class="info-box-text">Achievement Student's</span>
				<span class="info-box-number">{{ $achievement }}</span>
			</div>
		</div>
	</div>

</div>

<div class="row">
	<div class="col-12 col-sm-6 col-md-3">
		<div class="col-12">
			<div class="info-box mb-3">
				<span class="info-box-icon bg-warning elevation-1"><i class="fas fa-cog text-white"></i></span>
				<div class="info-box-content">
					<span class="info-box-text">Former Student's</span>
					<span class="info-box-number">{{ $former }}</span>
				</div>
			</div>
		</div>

		<div class="col-12">
			<div class="info-box mb-3">
				<span class="info-box-icon bg-blue elevation-1"><i class="fas fa-cog"></i></span>
				<div class="info-box-content">
					<span class="info-box-text">Total Staffs</span>
					<span class="info-box-number">{{ $teachers }}</span>
				</div>
			</div>
		</div>
	</div>

	<div class="col-12 col-lg-9">
		<div class="card overflow-hidden" style="overflow-x: scroll !important">
			<div class="card-header">
				<div class="card-title mb-2"> Recent Notices Published</div>


				<table class="table table-striped border table-hover">
					<thead>
						<tr>
							<th>SL</th>
							<th>Title</th>
							<th>Notice</th>
							<th>Published</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>

					<tfoot>
						<tr>
							<th>SL</th>
							<th>Title</th>
							<th>Notice</th>
							<th>Published</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</tfoot>

					<tbody>

						@if ($notices->count() > 0)
						@foreach ($notices as $key=> $notice)
						<tr>
							<td>{{ $key + 1 }}</td>
							<td>{{ Str::limit($notice->title, 36, '...') }}</td>
							<td>
								@if (file_exists(public_path("storage/notice/$notice->notice")))
								<a class="btn btn-sm btn-primary waves-effect" href="{{ route('admin.notice.download', $notice->id) }}" data-toggle="tooltip" data-placement="top" title="Download"><i class="fas fa-download"></i></a>
								@else
								<span class="badge badge-danger">Not Found</span>
								@endif
							</td>
							<td>{{ $notice->created_at->format('d-M-Y') }}</td>
							<td>
								@if ($notice->status == true)
								<span class="badge badge-success">Active</span>
								@else
								<span class="badge badge-danger">Inactive</span>
								@endif
							</td>
							<td>
								<a href="{{ route('admin.notice.edit', $notice->id) }}" class="btn btn-sm btn-success waves-effect" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></a>
								<a href="{{ route('admin.notice.delete', $notice->id) }}" id="delete" class="btn btn-sm btn-danger waves-effect" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash"></i></a>
							</td>
						</tr>
						@endforeach
						@else
						<td colspan="12" class="text-center">No Data Found.</td>
						@endif
					</tbody>

				</table>


			</div>
		</div>

	</div>

</div> --}}
@endsection