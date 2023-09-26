@extends('layouts.backend.app')

@section('title', 'Show Speech')

@section('main_content')

@push('css')
<style>
	.card-header {
		border-top: 3px solid red;
	}
</style>
@endpush


<div class="row">
	<div class="col-sm-12">
		<a href="{{ route('admin.speech.index') }}" class="btn btn-success waves-effect mr-2 mb-3"> <i class="fas fa-arrow-left mr-1"></i> Back</a>
		<div class="card">
			<div class="card-header">
				<h2>{{ $speech->title }}</h2>
				<a href="javascript:void(0)">{{ Auth::user()->name }}</a>
				<span>Create {{ $speech->created_at->format('d M Y') }} on {{ $speech->created_at->format('h:i A') }}</span>
			</div>
			<div class="card-body">

				<div class="row">
					<div class="col-md-8 mb-3 m-md-0">
						<h2>{{ $speech->name }}</h2>
						<p>{!! $speech->speech !!}</p>
					</div>
					<div class="col-md-4">
						<img src="{{ Storage::disk('public')->url('about/'. $speech->image) }}" class="img-fluid border shadow round mx-auto d-block" style="width: 600px; height:300px" alt="{{ $speech->title }}">
					</div>
				</div>

			</div>
		</div>

	</div>
</div>

@endsection