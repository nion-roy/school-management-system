<!-- Brand Logo -->
<a href="{{ route('user.dashboard') }}" class="brand-link">
	<img src="{{ Storage::disk('public')->url('setting/' . $f_settings->wb_logo) }}" alt="{{ $f_settings->wb_name }}" class="img-thumbnail brand-image img-circle elevation-3" style="opacity: .8">
	<span class="brand-text font-weight-light">{{ $f_settings->wb_name }}</span>
</a>

<!-- Sidebar -->
<div class="sidebar">
	<!-- Sidebar user panel (optional) -->
	<div class="user-panel mt-3 pb-3 mb-3 d-flex">
		<div class="image">
			<img src="{{ Storage::disk('public')->url('setting/' . $f_settings->wb_logo) }}" class="img-circle elevation-2 img-thumbnail" alt="{{ $f_settings->wb_name }}">
		</div>
		<div class="info">
			<a href="{{ route('home') }}" class="d-block">Website</a>
		</div>
	</div>

	<!-- Sidebar Menu -->
	<nav class="mt-2">
		<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
			<!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
			<li class="nav-header">INTERFACE</li>
			<li class="nav-item">
				<a href="" class="nav-link">
					<i class="nav-icon fas fa-cog"></i>
					<p class="text">Profile</p>
				</a>
			</li>

			<li class="nav-header">SETTINGS</li>
			<li class="nav-item">
				<a href="{{ route('user.destroy') }}" class="nav-link">
					<i class="nav-icon far fa-circle text-danger"></i>
					<p class="text">Log Out</p>
				</a>
			</li>

		</ul>
	</nav>
	<!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->