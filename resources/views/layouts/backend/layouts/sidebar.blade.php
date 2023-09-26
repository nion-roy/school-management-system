<aside class="main-sidebar sidebar-dark-primary elevation-4">

	@if (Auth::check())
	@if (Auth::user()->role == 'admin')
	@include('layouts.backend.layouts.admin')
	@elseif(Auth::user()->role == 'teacher')
	@include('layouts.backend.layouts.teacher')
	@elseif(Auth::user()->role == 'user')
	@include('layouts.backend.layouts.user')
	@endif
	@endif

</aside>