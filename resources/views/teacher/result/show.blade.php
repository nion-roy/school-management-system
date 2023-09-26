@extends('layouts.backend.app')

@section('title', 'Students Results')

@section('main_content')

<a href="{{ route('teacher.result.index') }}" class="btn btn-success waves-effect mb-4"> <i class="fas fa-arrow-left mr-1"></i> Back</a>

<div class="row">
	<div class="col-sm-12">

		<div class="card">
			<div class="card-header">
				<h5>Students Results</h5>
			</div>
			<div class="card-body">

				<div class="row mb-4">
					<div class="col-12 text-center">
						<h4>School Name</h4>
						<h6>Result Published 2023</h6>
						<h4>{{ $result->student->name }}</h4>
					</div>
				</div>

				<div class="row">
					<div class="col-md-6 mx-auto">
						<table class="table table-striped table-hover table-bordered">
							<thead>
								<tr>
									<th>Subject</th>
									<th>Mark</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($allResults as $key => $results)
								@if ($result->student_id == $results->student_id)
								<tr>
									<td>{{ $results->subject->subject ?? null }}</td>
									<td>{{ $results->mark ?? null }}</td>
								</tr>
								@endif
								@endforeach
							</tbody>
						</table>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>

@endsection