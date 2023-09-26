<!-- Brand Logo -->
<a href="{{ route('admin.dashboard') }}" class="brand-link">
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
				<a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->is('admin/dashboard*') ? 'active' : '' }}">
					<i class="nav-icon fas fa-home"></i>
					<p> Dashboard </p>
				</a>
			</li>

			<li class="nav-item {{ request()->is('admin/class*') || request()->is('admin/section*') || request()->is('admin/subject*') || request()->is('admin/teacher-assign*') ? 'menu-open' : '' }}">
				<a href="#" class="nav-link {{ request()->is('admin/class*') || request()->is('admin/section*') || request()->is('admin/subject*') || request()->is('admin/teacher-assign*') ? 'active' : '' }}">
					<i class="nav-icon fas fa-cog"></i>
					<p>
						Academics
						<i class="fas fa-angle-left right"></i>
					</p>
				</a>
				<ul class="nav nav-treeview">
					<li class="nav-item ">
						<a href="{{ route('admin.section.index') }}" class="nav-link {{ request()->is('admin/section*') ? 'active' : '' }}">
							<i class="far fa-circle nav-icon"></i>
							<p>Section</p>
						</a>
					</li>
					<li class="nav-item ">
						<a href="{{ route('admin.subject.index') }}" class="nav-link {{ request()->is('admin/subject*') ? 'active' : '' }}">
							<i class="far fa-circle nav-icon"></i>
							<p>Subject</p>
						</a>
					</li>
					<li class="nav-item ">
						<a href="{{ route('admin.class.index') }}" class="nav-link {{ request()->is('admin/class*') ? 'active' : '' }}">
							<i class="far fa-circle nav-icon"></i>
							<p>Class</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="{{ route('admin.teacher-assign.index') }}" class="nav-link {{ request()->is('admin/teacher-assign*') ? 'active' : '' }}">
							<i class="far fa-circle nav-icon"></i>
							<p>Assign Class Teacher</p>
						</a>
					</li>
				</ul>
			</li>


			<li class="nav-item {{ request()->is('admin/all-student*') || request()->is('admin/student-result*') ? 'menu-open' : '' }} ">
				<a href="#" class="nav-link {{ request()->is('admin/all-student*') || request()->is('admin/student-result*') ? 'active' : '' }}">
					<i class="nav-icon fas fa-cog"></i>
					<p>
						Students Info
						<i class="fas fa-angle-left right"></i>
					</p>
				</a>
				<ul class="nav nav-treeview">
					<li class="nav-item ">
						<a href="{{ route('admin.all-student.index') }}" class="nav-link {{ request()->is('admin/all-student*') ? 'active' : '' }}">
							<i class="far fa-circle nav-icon"></i>
							<p>Add Students</p>
						</a>
					</li>
					<li class="nav-item ">
						<a href="{{ route('admin.student-result.index') }}" class="nav-link {{ request()->is('admin/student-result*') ? 'active' : '' }}">
							<i class="far fa-circle nav-icon"></i>
							<p>Results</p>
						</a>
					</li>

				</ul>
			</li>


			<li class="nav-item {{ request()->is('admin/user') || request()->is('admin/user/*') || request()->is('admin/users/teachers') || request()->is('admin/users/students') ? 'menu-open' : '' }}">
				<a href="javascript:void(0)" class="nav-link {{ request()->is('admin/user') || request()->is('admin/user/*') || request()->is('admin/users/teachers') || request()->is('admin/users/students') ? 'active' : '' }}">
					<i class="nav-icon fas fa-cog"></i>
					<p>
						Users
						<i class="fas fa-angle-left right"></i>
					</p>
				</a>
				<ul class="nav nav-treeview">
					<li class="nav-item">
						<a href="{{ route('admin.user.index') }}" class="nav-link {{ request()->is('admin/user')  || request()->is('admin/user/*') ? 'active' : '' }}">
							<i class="far fa-circle nav-icon"></i>
							<p>Admin</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="{{ route('admin.user.teacher') }}" class="nav-link {{ request()->is('admin/users/teachers') ? 'active' : '' }}">
							<i class="far fa-circle nav-icon"></i>
							<p>Teacher's</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="{{ route('admin.user.student') }}" class="nav-link {{ request()->is('admin/users/students') ? 'active' : '' }}">
							<i class="far fa-circle nav-icon"></i>
							<p>Student's</p>
						</a>
					</li>
				</ul>
			</li>

			<li class="nav-item {{ request()->is('admin/result*') || request()->is('admin/exam-routine*') || request()->is('admin/class-routine*') || request()->is('admin/notice*') || request()->is('admin/announcement*')? 'menu-open' : '' }}">
				<a href="#" class="nav-link {{ request()->is('admin/result*') || request()->is('admin/exam-routine*') || request()->is('admin/class-routine*') || request()->is('admin/notice*') || request()->is('admin/announcement*')? 'active' : '' }}">
					<i class="nav-icon fas fa-cog"></i>
					<p>
						Academic
						<i class="fas fa-angle-left right"></i>
					</p>
				</a>
				<ul class="nav nav-treeview">
					<li class="nav-item ">
						<a href="{{ route('admin.result.index') }}" class="nav-link {{ request()->is('admin/result*') ? 'active' : '' }}">
							<i class="far fa-circle nav-icon"></i>
							<p>Results</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="{{ route('admin.exam-routine.index') }}" class="nav-link {{ request()->is('admin/exam-routine*') ? 'active' : '' }}">
							<i class="far fa-circle nav-icon"></i>
							<p>Exam Routine</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="{{ route('admin.class-routine.index') }}" class="nav-link {{ request()->is('admin/class-routine*') ? 'active' : '' }}">
							<i class="far fa-circle nav-icon"></i>
							<p>Class Routine</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="{{ route('admin.notice.index') }}" class="nav-link {{ request()->is('admin/notice*') ? 'active' : '' }}">
							<i class="far fa-circle nav-icon"></i>
							<p>Notice</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="{{ route('admin.announcement.index') }}" class="nav-link {{ request()->is('admin/announcement*') ? 'active' : '' }}">
							<i class="far fa-circle nav-icon"></i>
							<p>Announcement</p>
						</a>
					</li>
				</ul>
			</li>

			<li class="nav-item {{ request()->is('admin/type-of-academic') || request()->is('admin/academic-information*') ? 'menu-open' : '' }}">
				<a href="#" class="nav-link {{ request()->is('admin/type-of-academic') || request()->is('admin/academic-information*') ? 'active' : '' }}">
					<i class="nav-icon fas fa-cog"></i>
					<p>
						Academic Information
						<i class="fas fa-angle-left right"></i>
					</p>
				</a>
				<ul class="nav nav-treeview">
					<li class="nav-item ">
						<a href="{{ route('admin.type-of-academic.index') }}" class="nav-link {{ request()->is('admin/type-of-academic') ? 'active' : '' }}">
							<i class="far fa-circle nav-icon"></i>
							<p>Type of Academic</p>
						</a>
					</li>
					<li class="nav-item ">
						<a href="{{ route('admin.academic-information.index') }}" class="nav-link {{ request()->is('admin/academic-information*') ? 'active' : '' }}">
							<i class="far fa-circle nav-icon"></i>
							<p>Academic Information</p>
						</a>
					</li>
				</ul>
			</li>

			<li class="nav-item {{ request()->is('admin/news*') || request()->is('admin/important-news*') || request()->is('admin/update-news*') || request()->is('admin/notice*') ? 'menu-open' : '' }}">
				<a href="javascript:void(0)" class="nav-link {{ request()->is('admin/news*') || request()->is('admin/important-news*') || request()->is('admin/update-news*') ? 'active' : '' }}">
					<i class="nav-icon fas fa-cog"></i>
					<p>
						News
						<i class="fas fa-angle-left right"></i>
					</p>
				</a>
				<ul class="nav nav-treeview">
					<li class="nav-item">
						<a href="{{ route('admin.news.index') }}" class="nav-link {{ request()->is('admin/news*') ? 'active' : '' }}">
							<i class="far fa-circle nav-icon"></i>
							<p> News </p>
						</a>
					</li>
					<li class="nav-item">
						<a href="{{ route('admin.important-news.index') }}" class="nav-link {{ request()->is('admin/important-news*') ? 'active' : '' }}">
							<i class="far fa-circle nav-icon"></i>
							<p> Important News </p>
						</a>
					</li>

					<li class="nav-item">
						<a href="{{ route('admin.update-news.index') }}" class="nav-link {{ request()->is('admin/update-news*') ? 'active' : '' }}">
							<i class="far fa-circle nav-icon"></i>
							<p> Update News </p>
						</a>
					</li>
				</ul>
			</li>

			<li class="nav-item">
				<a href="{{ route('admin.slider.index') }}" class="nav-link {{ request()->is('admin/slider*') ? 'active' : '' }}">
					<i class="nav-icon fas fa-cog"></i>
					<p> Slider </p>
				</a>
			</li>


			<li class="nav-item {{ request()->is('admin/about*') || request()->is('admin/mission*') || request()->is('admin/vision*') || request()->is('admin/speech*') ? 'menu-open' : '' }}">
				<a href="#" class="nav-link {{ request()->is('admin/about*') || request()->is('admin/mission*') || request()->is('admin/vision*') || request()->is('admin/speech*') ? 'active' : '' }}">
					<i class="nav-icon fas fa-cog"></i>
					<p>
						About
						<i class="fas fa-angle-left right"></i>
					</p>
				</a>
				<ul class="nav nav-treeview">
					<li class="nav-item">
						<a href="{{ route('admin.about.index') }}" class="nav-link {{ request()->is('admin/about*') ? 'active' : '' }}">
							<i class="far fa-circle nav-icon"></i>
							<p>About Us</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="{{ route('admin.mission.index') }}" class="nav-link {{ request()->is('admin/mission*') ? 'active' : '' }}">
							<i class="far fa-circle nav-icon"></i>
							<p>Our Mission</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="{{ route('admin.vision.index') }}" class="nav-link {{ request()->is('admin/vision*') ? 'active' : '' }}">
							<i class="far fa-circle nav-icon"></i>
							<p>Our Vision</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="{{ route('admin.speech.index') }}" class="nav-link {{ request()->is('admin/speech*') ? 'active' : '' }}">
							<i class="far fa-circle nav-icon"></i>
							<p> Speech </p>
						</a>
					</li>
				</ul>
			</li>

			<li class="nav-item {{ request()->is('admin/image-gallery*') || request()->is('admin/video-gallery*') ? 'menu-open' : '' }}">
				<a href="javascript:void(0)" class="nav-link {{ request()->is('admin/image-gallery*') || request()->is('admin/video-gallery*') ? 'active' : '' }}">
					<i class="nav-icon fas fa-cog"></i>
					<p>
						Gallery
						<i class="fas fa-angle-left right"></i>
					</p>
				</a>
				<ul class="nav nav-treeview">
					<li class="nav-item">
						<a href="{{ route('admin.image-gallery.index') }}" class="nav-link {{ request()->is('admin/image-gallery*') ? 'active' : '' }}">
							<i class="far fa-circle nav-icon"></i>
							<p>Image Gallery</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="{{ route('admin.video-gallery.index') }}" class="nav-link {{ request()->is('admin/video-gallery*') ? 'active' : '' }}">
							<i class="far fa-circle nav-icon"></i>
							<p>Video Gallery</p>
						</a>
					</li>
				</ul>
			</li>

			<li class="nav-item">
				<a href="{{ route('admin.facts.index') }}" class="nav-link {{ request()->is('admin/facts*') ? 'active' : '' }}">
					<i class="nav-icon fas fa-cog"></i>
					<p> Facts </p>
				</a>
			</li>

			<li class="nav-header">SETTINGS</li>
			<li class="nav-item">
				<a href="{{ route('admin.settings.index') }}" class="nav-link {{ request()->is('admin/setting*') ? 'active' : '' }}">
					<i class="nav-icon far fa-circle text-danger"></i>
					<p class="text">Web Site Setting</p>
				</a>
			</li>

			<li class="nav-item">
				<a href="{{ route('admin.destroy') }}" class="nav-link">
					<i class="nav-icon far fa-circle text-danger"></i>
					<p class="text">Log Out</p>
				</a>
			</li>

		</ul>
	</nav>
	<!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->