@extends('layouts.backend.app')

@section('title', 'Gallery View')

@section('main_content')

<div class="row">
	<div class="col-12">
		<a href="{{ route('admin.video-gallery.index') }}" class="btn btn-danger waves-effect mb-3"><i class="fas fa-arrow-left mr-1"></i> Back</a>
	</div>
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">{{ $galleries->title }} <span class="badge badge-success"></span></h3><br>
				<span>Posted by: <a class="mr-3" href="{{ route('admin.dashboard') }}"><strong>{{ Auth::user()->name }}</strong></a> <i class="far fa-calendar-alt"></i> {{ $galleries->created_at->format('M d, Y') }} <i class="ml-3 far fa-clock"></i> {{ $galleries->created_at->diffForHumans() }}</span>
			</div>
			<!-- /.card-header -->
			<div class="card-body">
				<div class="row">
					<div class="col-md-8">
						<p>{!! $galleries->description !!}</p>
					</div>
					<div class="col-md-4 mx-auto">
						<video controls autoplay class="img-thumbnail d-block w-100" style="height: 360px">
							<source src="{{ Storage::disk('public')->url('gallery/video/' . $galleries->gallery ) }}" type="video/mp4">
							Your browser does not support the video tag.
						</video>
					</div>
				</div>
			</div>
			<!-- /.card-body -->
		</div>
		<!-- /.card -->

		<!-- /.card -->
	</div>
	<!-- /.col -->
</div>

@endsection