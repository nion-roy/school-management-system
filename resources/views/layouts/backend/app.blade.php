<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<meta charset="utf-8">
	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>{{ $f_settings->wb_name }} - @yield('title')</title>

	<!-- Favicon -->
	<link href="{{ Storage::disk('public')->url('setting/' . $f_settings->wb_favicon) }}" rel="icon">


	<!-- Google Font: Source Sans Pro -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="{{ asset('backend') }}/plugins/fontawesome-free/css/all.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<!-- Tempusdominus Bootstrap 4 -->
	<link rel="stylesheet" href="{{ asset('backend') }}/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
	<!--  Waves Effect  -->
	<link href="{{ asset('backend') }}/plugins/node-waves/waves.min.css" rel="stylesheet" />
	<!-- iCheck -->
	<link rel="stylesheet" href="{{ asset('backend') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
	<!-- JQVMap -->
	<link rel="stylesheet" href="{{ asset('backend') }}/plugins/jqvmap/jqvmap.min.css">
	<!-- overlayScrollbars -->
	<link rel="stylesheet" href="{{ asset('backend') }}/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
	<!-- Daterange picker -->
	<link rel="stylesheet" href="{{ asset('backend') }}/plugins/daterangepicker/daterangepicker.css">
	<!-- Toastr Css -->
	<link rel="stylesheet" href="{{ asset('backend') }}/plugins/toastr/toastr.min.css">
	<!-- Select2 -->
	<link rel="stylesheet" href="{{ asset('backend') }}/plugins/select2/css/select2.min.css">
	<link rel="stylesheet" href="{{ asset('backend') }}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
	<!-- summernote -->
	<link rel="stylesheet" href="{{ asset('backend') }}/plugins/summernote/summernote-bs4.min.css">
	<!-- DataTables -->
	<link rel="stylesheet" href="{{ asset('backend') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="{{ asset('backend') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
	<link rel="stylesheet" href="{{ asset('backend') }}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="{{ asset('backend') }}/dist/css/adminlte.min.css">

	<style>

		li.paginate_button.page-item.active a {
			background-color: #28a745 !important;
			border-color: #28a745;
		}

		.modal-content {
			border: none;
			border-top: 5px solid #28a745;
		}
	</style>

	@stack('css')

</head>

<body class="hold-transition sidebar_toggle layout-fixed">
	<div class="wrapper">

		<!-- Preloader -->
		{{-- <div class="preloader flex-column justify-content-center align-items-center">
			<img class="animation__shake" src="{{ asset('backend') }}/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
		</div> --}}

		<!-- Navbar -->
		@include('layouts.backend.layouts.header')
		<!-- /.navbar -->

		<!-- Main Sidebar Container -->
		@include('layouts.backend.layouts.sidebar')

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper pt-4">
			<!-- Main content -->
			<section class="content">
				<div class="container-fluid">
					<!-- row -->
					@yield('main_content')
					<!-- row -->
				</div>
			</section>
			<!-- /.content -->
		</div>

		<!-- /.content-wrapper -->
		@include('layouts.backend.layouts.footer')

		<!-- Control Sidebar -->
		<aside class="control-sidebar control-sidebar-dark"></aside>
		<!-- /.control-sidebar -->
	</div>
	<!-- ./wrapper -->

	<!-- jQuery -->
	<script src="{{ asset('backend') }}/plugins/jquery/jquery.min.js"></script>
	<!-- jQuery UI 1.11.4 -->
	<script src="{{ asset('backend') }}/plugins/jquery-ui/jquery-ui.min.js"></script>
	<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
	<script>
		$.widget.bridge('uibutton', $.ui.button)
	</script>
	<!-- Bootstrap 4 -->
	<script src="{{ asset('backend') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	<!-- Select2 -->
	<script src="{{ asset('backend') }}/plugins/select2/js/select2.full.min.js"></script>
	<!-- JQVMap -->
	<script src="{{ asset('backend') }}/plugins/jqvmap/jquery.vmap.min.js"></script>
	<script src="{{ asset('backend') }}/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
	<!--  Waves Effect Css  -->
	<script src="{{ asset('backend') }}/plugins/node-waves/waves.min.js"></script>
	<!-- jQuery Knob Chart -->
	<script src="{{ asset('backend') }}/plugins/jquery-knob/jquery.knob.min.js"></script>
	<!-- daterangepicker -->
	<script src="{{ asset('backend') }}/plugins/moment/moment.min.js"></script>
	<script src="{{ asset('backend') }}/plugins/daterangepicker/daterangepicker.js"></script>
	<!-- Tempusdominus Bootstrap 4 -->
	<script src="{{ asset('backend') }}/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
	<!-- Summernote -->
	<script src="{{ asset('backend') }}/plugins/summernote/summernote-bs4.min.js"></script>
	<!-- overlayScrollbars -->
	<script src="{{ asset('backend') }}/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
	<!-- DataTables  & Plugins -->
	<script src="{{ asset('backend') }}/plugins/datatables/jquery.dataTables.min.js"></script>
	<script src="{{ asset('backend') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
	{{-- <script src="{{ asset('backend') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script> --}}
	{{-- <script src="{{ asset('backend') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script> --}}
	<script src="{{ asset('backend') }}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
	<script src="{{ asset('backend') }}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>

	<!-- AdminLTE App -->
	<script src="{{ asset('backend') }}/dist/js/adminlte.js"></script>
	<!-- AdminLTE for demo purposes -->
	<script src="{{ asset('backend') }}/dist/js/demo.js"></script>
	<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
	<script src="{{ asset('backend') }}/dist/js/pages/dashboard.js"></script>

	<!-- Toastr Js -->
	<script src="{{ asset('backend') }}/plugins/toastr/toastr.min.js"></script>

	<!-- Sweet alert js files -->
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

	@include('sweetalert::alert')

	{!! Toastr::message() !!}

	<!-- Toastr error handel -->
	<script>
		@if($errors->any())
			@foreach($errors->all() as $error)
				toastr.error('{{ $error }}','Error',{
					progressBar:'true',
					positionClass: 'toast-top-right',
				});
			@endforeach
    @endif
	</script>

	<!-- Sweet alert conformaction message with delete -->
	<script>
		$(document).on('click', '#delete', function(e){
			e.preventDefault();
			var urlToRedirect = $(this).attr('href');

			swal({
				title: "Are you sure?",
				text: "You won't be able to revert this delete",
				icon: "warning",
				buttons: true,
				dangerMode: true,
			})
			.then((willDelete) => {
				if (willDelete) {
					window.location = urlToRedirect;
					swal("Poof! Your imaginary file has been deleted!", {
						icon: "success",
					});
				} else {
					swal("Now! Your imaginary file is safe!", {
						icon: "success",
					});
				}
			});
		});
	</script>
	<!-- Sweet alert conformaction message with delete -->

	<!-- Selecte JS -->
	<script>
		//Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
	</script>
	<!-- Selecte JS -->

	<!-- Data Table -->
	<script>
		$(function () {
			$("#example1").DataTable({
				"responsive": true, "lengthChange": false, "autoWidth": false,
				"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
			}).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
			$('#example2,#example3,#example4 ').DataTable({
				"paging": true,
				"lengthChange": false,
				"searching": false,
				"ordering": true,
				"info": true,
				"autoWidth": false,
				"responsive": true,
			});
		});
	</script>

	<script>
		$(function () {
			$('[data-toggle="tooltip"]').tooltip()
		})
	</script>
	<!-- Data Table -->



	<!-- Image View On Upload -->
	<script>
		$(document).ready(function () {
			$("#imageFile").change(function (e) {
				const file = e.target.files[0];

				if (!file) {
					alert("Please select an image.");
					return;
				}

				if (!file.type.match("image.*")) {
					alert("Please select an image file (jpg, jpeg, png).");
					return;
				}

				const reader = new FileReader();

				reader.onload = function (event) {
					const imageUrl = event.target.result;

					// Display the chosen image
					$("#imageContainer").html(`<img class="p-1" src="${imageUrl}" alt="Chosen Image" />`);
					$('#imageContainer').show();
				};

				reader.readAsDataURL(file);
			});
		});
	</script>
	<!-- Image View On Upload -->

	<!--Waves Button Clikc Effect -->
	<script>
		Waves.attach('.menu .list a', ['waves-block']);
		Waves.init();
	</script>
	<!--Waves Button Clikc Effect -->

	<!--Summer Note Textarea -->
	<script>
		$('#summernote').summernote({
		placeholder: 'Enter Overview Information....',
		height: 200,
		toolbar: [
		['font', ['bold', 'italic', 'underline']],
		['style', ['style']],
		['fontname', ['fontname']],
		['fontsize', ['fontsize']],
		['color', ['color']],
		['para', ['ol', 'ul', 'paragraph', 'height']],
		['table', ['table']],
		['insert', ['link']],
		['view', ['undo', 'redo', 'fullscreen', 'codeview', 'help']]
		]
	});
	</script>
	<!--Summer Note Textarea -->


	@stack('js')

</body>

</html>