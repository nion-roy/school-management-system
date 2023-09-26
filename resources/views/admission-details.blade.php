@extends('layouts.frontend.app')

@section('title')
{{ $details->subject }}
@endsection

@section('main_content')


<div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s" style="background-image: linear-gradient(rgba(15, 66, 41, 0.6), rgba(15, 66, 41, 0.6)), url( {{ Storage::disk('public')->url('setting/'.$f_settings->banner) }})">
	<div class="container text-center py-5">
		<h1 class="display-3 text-white mb-4  slideInDown">{{ $admissions->name }}</h1>
		<nav aria-label="breadcrumb animated slideInDown">
			<ol class="breadcrumb justify-content-center mb-0">
				<li class="breadcrumb-item"><a href="index">Home</a></li>
				<li class="breadcrumb-item active" aria-current="page">{{ $admissions->name }}</li>
			</ol>
		</nav>
	</div>
</div>


<!-- Projects Start -->
<div class="container-xxl py-5">
	<div class="container">
		<div class="row">
			<div class="col-lg-4 col-md-4 m-md-0 mb-5 wow fadeInUp" data-wow-delay="0.1s">
				<div class="portfolio-header p-3 border rounded position-relative">
					<img class="img-fluid rounded mb-3" src="{{ Storage::disk('public')->url('admission/thumbnail/' . $details->image) }}" alt="{{ $details->admission->name }}">
					<div class="portfolio-text">
						<ul class="nav">
							<li class="nav-item border-bottom py-2 d-flex justify-content-between align-items-center w-100">
								<span><i class="fas fa-clock text-primary"></i> Duration</span>
								<span>{{ $details->duration }} Years</span>
							</li>
							<li class="nav-item py-2 pb-3 d-flex justify-content-between align-items-center w-100">
								<span><i class="fas fa-book text-primary"></i> Total Semester</span>
								<span>{{ $details->semester }} Semesters</span>
							</li>
						</ul>
					</div>
					<div class="apply_btn">
						<a href="online-admin" class="btn btn-primary text-white mx-auto px-4">Apply Now</a>
					</div>
				</div>
			</div>

			<div class="col-lg-8 col-md-8">
				<div class="mb-4">
					<h2 class="mb-3 wow fadeInUp" data-wow-delay="0.1s">{{ $details->admission->name }}</h2>
					<p class="mb-5 wow fadeInUp" data-wow-delay="0.1s">{{ $details->header }}</p>
					<img class="img-fluid rounded d-block mx-auto wow fadeInUp" data-wow-delay="0.1s" src="{{ Storage::disk('public')->url('admission/' . $details->image) }}" alt="{{ $details->admission->name }}">
				</div>
				<div class="portfolio-content wow fadeInUp" data-wow-delay="0.1s">
					<ul class="nav mb-3">
						<li class="nav-item w-50 text-center"><a href="#overview" data-bs-toggle="tab" class="nav-link bg-danger text-white rounded-start">Overview</a></li>
						<li class="nav-item w-50 text-center"><a href="#curriculum" data-bs-toggle="tab" class="nav-link bg-primary text-white rounded-end">Curriculum</a></li>
					</ul>
					<div class="tab-content wow fadeInUp" data-wow-delay="0.1s">
						<div id="overview" class="tab-pane active"> {!! $details->overview !!} </div>
						<div id="curriculum" class="tab-pane fade">
							<div class="accordion accordion-flush" id="accordionFlushExample">


								@foreach ($semesters as $semester)
								@if ($semester->admission_details_id == $details->id)

								<div class="accordion-item">
									<h2 class="accordion-header" id="flush-headingOne">
										<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#semesert_{{ $semester->id }}" aria-expanded="false" aria-controls="semesert_{{ $semester->id }}">
											{{ $semester->semester }}
										</button>
									</h2>
									<div id="semesert_{{ $semester->id }}" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
										<div class="accordion-body p-0 mt-3">
											<table class="table table-bordered">
												<thead>
													<tr>
														<th>SL.</th>
														<th>Code No.</th>
														<th>Course Title</th>
														<th>Credit</th>
													</tr>
												</thead>
												<tbody>

													@foreach ($semestersDetails as $key => $detials)
													@if ($detials->semester_id == $semester->id)
													<tr>
														<td>{{ $key + 1 }}</td>
														<td>{{ $detials->code_no }}</td>
														<td>{{ $detials->crouse_title }}</td>
														<td>{{ $detials->credit }}</td>
													</tr>
													@endif
													@endforeach

												</tbody>
											</table>
										</div>
									</div>
								</div>

								@endif
								@endforeach


							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>
</div>
<!-- Projects End -->


@endsection