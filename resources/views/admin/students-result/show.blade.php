@extends('layouts.backend.app')

@section('title', 'Students Results')

@section('main_content')

<a href="{{ route('admin.student-result.index') }}" class="btn btn-success waves-effect mb-4"> <i class="fas fa-arrow-left mr-1"></i> Back</a>

<div class="row">
	<div class="col-sm-12">

		<div class="card">
			<div class="card-header">
				<h5>Students Results</h5>
			</div>
			<div class="card-body">

				<div class="row mb-4">
					<div class="col-md-10 mx-auto text-center">

						@if ($result->user_id == $studentInfo->user_id)

						<table class="table">
							<thead>
								<tr>
									<th colspan="12" class="bg-success py-2">
										<h4>{{ $result->class->batch ?? null }}</h4>
									</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td class="border text-left bg-light border-white w-25">Roll</td>
									<td class="border text-left bg-light border-white w-25">{{ $result->students->roll ?? null }}</td>
									<td class="border text-left bg-light border-white w-25">Name</td>
									<td class="border text-left bg-light border-white w-25">{{ $result->user->name ?? null }}</td>
								</tr>

								<tr>
									<td class="border text-left bg-light border-white w-25">Register</td>
									<td class="border text-left bg-light border-white w-25">{{ $result->students->register ?? null }}</td>
									<td class="border text-left bg-light border-white w-25">Father's Name</td>
									<td class="border text-left bg-light border-white w-25">{{ $studentInfo->father_name ?? null }}</td>
								</tr>

								<tr>
									<td class="border text-left bg-light border-white w-25">Session</td>
									<td class="border text-left bg-light border-white w-25">{{ $result->students->session ?? null }}</td>
									<td class="border text-left bg-light border-white w-25">Mother's Name</td>
									<td class="border text-left bg-light border-white w-25">{{ $studentInfo->mother_name ?? null }}</td>
								</tr>

							</tbody>
						</table>

						@endif

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
								@foreach ($allResults as $results)
								@if ($result->student_roll == $results->students->id)
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