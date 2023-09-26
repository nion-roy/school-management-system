@extends('layouts.backend.app')

@section('title', 'Facts')

@section('main_content')

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<div class="d-flex align-items-center justify-content-between">
					<h3 class="card-title">All Facts <span class="badge badge-success"> {{ $facts->count() }} </span></h3>
					<a href="{{ route('admin.facts.create') }}" class="btn btn-success waves-effect"><i class="fas fa-plus mr-1"></i> Add Facts</a>
				</div>
			</div>
			<!-- /.card-header -->
			<div class="card-body">
				<table id="example2" class="table table-bordered table-striped table-hover">
					<thead>
						<tr>
							<th>SL</th>
							<th>Header</th>
							<th>Counter</th>
							<th>Create</th>
							<th>Action</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th>SL</th>
							<th>Header</th>
							<th>Counter</th>
							<th>Create</th>
							<th>Action</th>
						</tr>
					</tfoot>
					<tbody>

						@foreach ($facts as $key => $facts)
						<tr>
							<td>{{ $key + 1 }}</td>
							<td>{{ $facts->header }}</td>
							<td>{{ $facts->counter }}</td>
							<td>{{ $facts->created_at->format('d M Y') }}</td>

							<td>
								<a href="{{ route('admin.facts.edit', $facts->id) }}" class="btn btn-sm btn-success waves-effect" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></a>
								{{-- <a href="{{ route('admin.facts.show', $facts->id) }}" class="btn btn-sm btn-info waves-effect" data-toggle="tooltip" data-placement="top" title="Show"><i class="fas fa-eye"></i></a> --}}
								<a href="{{ route('admin.facts.delete', $facts->id) }}" id="delete" class="btn btn-sm btn-danger waves-effect" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash"></i></a>
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