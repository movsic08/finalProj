<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<link href="{{ getShopFavicon() }}" rel="icon" type="image/jpg">

		<title>{{ getShopName() }}</title>
		<!-- Google Font: Source Sans Pro -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
		<!-- Font Awesome -->
		<link rel="stylesheet" href="{{ asset('admin-assets/plugins/fontawesome-free/css/all.min.css') }}">
		<!-- Theme style -->
		<link rel="stylesheet" href="{{ asset('admin-assets/css/adminlte.min.css') }}">

		<link rel="stylesheet" href="{{ asset('admin-assets/plugins/dropzone/min/dropzone.min.css') }}"> <!-- for the dropzone-->

		<link rel="stylesheet" href="{{ asset('admin-assets/plugins/summernote/summernote-bs4.min.css') }}"> <!-- for the summernote-->

		<link rel="stylesheet" href="{{ asset('admin-assets/plugins/select2/css/select2.min.css') }}"> <!-- for the summernote-->

		<link rel="stylesheet" href="{{ asset('admin-assets/css/datetimepicker.css') }}"> <!-- for the datetime picker-->

		
		<link rel="stylesheet" href="{{ asset('admin-assets/css/bootstrap-colorpicker.min.css') }}"> <!-- for the color picker-->


		<link rel="stylesheet" href="{{ asset('admin-assets/css/custom.css') }}">

		<style>
			.addH{ /*for the brand-image*/
				max-height: 74px !important;
			}

			.addL{ /*for the .brand-link*/
				line-height: 3.5 !important;
			}
		</style>


		{{-- csrf token for every form --}}
		<meta name="csrf-token" content="{{ csrf_token() }}">
	</head>
	<body class="hold-transition sidebar-mini">
		<!-- Site wrapper -->
		<div class="wrapper">
			<!-- Navbar -->
			<nav class="main-header navbar navbar-expand navbar-white navbar-light">
				<!-- Right navbar links -->
				<ul class="navbar-nav">
					<li class="nav-item">
					  	<a id="push_menu" class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
					</li>					
				</ul>
				<div class="navbar-nav pl-2">
					<!-- <ol class="breadcrumb p-0 m-0 bg-white">
						<li class="breadcrumb-item active">Dashboard</li>
					</ol> -->
				</div>
				
				<ul class="navbar-nav ml-auto">
					<li class="nav-item">
						<a class="nav-link" data-widget="fullscreen" href="#" role="button">
							<i class="fas fa-expand-arrows-alt"></i>
						</a>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link p-0 pr-3" data-toggle="dropdown" href="#">
							<img src="{{ getShopLogo() }}" class='img-circle elevation-2' width="40" height="40" alt="">
						</a>
						<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-3">
							<h4 class="h4 mb-0"><strong>{{ Auth::guard('admin')->user()->name }}</strong></h4>
							<div class="mb-3">{{ Auth::guard('admin')->user()->email }}</div>
							<div class="dropdown-divider"></div>

							@if(Auth::user()->main_role == 2 )
								<a href="{{ route("admin.settings") }}" class="dropdown-item">
									<i class="fas fa-user-cog mr-2"></i> Settings								
								</a>
							@endif
							
							<div class="dropdown-divider"></div>
							<a href="{{ route("admin.showChangePasswordForm") }}" class="dropdown-item">
								<i class="fas fa-lock mr-2"></i> Change Password
							</a>
							<div class="dropdown-divider"></div>
							<a href="{{ route('admin.logout') }}" class="dropdown-item text-danger">
								<i class="fas fa-sign-out-alt mr-2"></i> Logout							
							</a>							
						</div>
					</li>
				</ul>
			</nav>
			<!-- /.navbar -->
			<!-- Main Sidebar Container -->
      @include('admin.layouts.sidebar')
			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				
        <!-- main content-->
        @yield('content')


			</div>
			<!-- /.content-wrapper -->
			<footer class="main-footer">
				
				<strong>Copyright &copy; 2014-2022 Shoeniverse All rights reserved.
			</footer>
			
		</div>
		<!-- ./wrapper -->
		<!-- jQuery -->
		<script src="{{ asset('admin-assets/plugins/jquery/jquery.min.js') }}"></script>
		<!-- Bootstrap 4 -->
		<script src="{{ asset('admin-assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
		<!-- AdminLTE App -->
		<script src="{{ asset('admin-assets/js/adminlte.min.js') }}"></script>
		<!-- Dropzone  -->
		<script src="{{ asset('admin-assets/plugins/dropzone/min/dropzone.min.js') }}"></script> <!-- for the dropzone-->
		<!-- Summernote-->
		<script src="{{ asset('admin-assets/plugins/summernote/summernote.min.js') }}"></script>
		<!-- Select-->
		<script src="{{ asset('admin-assets/plugins/select2/js/select2.min.js') }}"></script>
		<!-- Datetime picker-->
		<script src="{{ asset('admin-assets/js/datetimepicker.js') }}"></script>
		<!-- Color Picker-->
		<script src="{{ asset('admin-assets/js/bootstrap-colorpicker.min.js') }}"></script>
		<!-- AdminLTE for demo purposes -->
		<script src="{{ asset('admin-assets/js/demo.js') }}"></script>


		<!-- to always provide ajax submission with the csrf token-->
		<script type="text/javascript">
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
			});

			/*for the summernote*/
			$(document).ready(function(){
				$(".summernote").summernote({
					height: 250,
				});

				

			});

			//for the tooltip
			var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
			var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
				return new bootstrap.Tooltip(tooltipTriggerEl)
			});	



			//brank-link is the container
			/*
				original list height:
				line-height:1.5
				change to 3.5
			*/

			//brand-image is the image
			/*
			original 
			max-height:33px;
			change to 74px;
			*/

			//for the push menu
			$("#push_menu").on("click",function(){
				//console.log("clicked");
				$(".brand-link").toggleClass("addL");
				$(".brand-image").toggleClass("addH");

			});



		</script>

    @yield('customJs')
	</body>
</html>