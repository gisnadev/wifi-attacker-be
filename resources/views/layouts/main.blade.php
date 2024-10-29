<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
	<title> @yield('title') | Wifighter </title>
	<link rel="icon" type="image/x-icon" href="{{ asset('img/intek.png') }}" />
	<link href="{{ asset('modern-dark-menu/assets/css/loader.css') }}" rel="stylesheet" type="text/css" />
	<script src="{{ asset('modern-dark-menu/assets/js/loader.js') }}"></script>

	<!-- BEGIN GLOBAL MANDATORY STYLES -->
	<link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet">
	<link href="{{ asset('modern-dark-menu/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('modern-dark-menu/assets/css/plugins.css') }}" rel="stylesheet" type="text/css" />
	<!-- END GLOBAL MANDATORY STYLES -->

	<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
	<link rel="stylesheet" type="text/css" href="{{ asset('modern-dark-menu/plugins/table/datatable/datatables.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('modern-dark-menu/plugins/table/datatable/dt-global_style.css') }}">
	 <link rel="stylesheet" type="text/css" href="{{ asset('modern-dark-menu/assets/css/forms/theme-checkbox-radio.css') }}">
	 <link href="{{ asset('modern-dark-menu/assets/css/components/tabs-accordian/custom-tabs.css') }}" rel="stylesheet" type="text/css" />
	 <link rel="stylesheet" href="{{ asset('modern-dark-menu/plugins/font-icons/fontawesome/css/regular.css') }}" >
    <link rel="stylesheet" href="{{ asset('modern-dark-menu/plugins/font-icons/fontawesome/css/fontawesome.css') }}" >
	<link href="{{ asset('modern-dark-menu/plugins/notification/snackbar/snackbar.min.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('modern-dark-menu/plugins/loaders/custom-loader.css')}}" rel="stylesheet" type="text/css" />
	<meta name="csrf-token" content="{{ csrf_token() }}">
	@stack('head')

	<!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->

</head>

<body class="alt-menu sidebar-noneoverflow">
	<!-- BEGIN LOADER -->
	{{-- <div id="load_screen">
		<div class="loader">
			<div class="loader-content">
				<div class="spinner-grow align-self-center"></div>
			</div>
		</div>
	</div> --}}
	<!--  END LOADER -->

	<!--  BEGIN NAVBAR  -->


	<div class="header-container">
		<header class="header navbar navbar-expand-sm">

			<a href="javascript:void(0);" class="sidebarCollapse" data-placement="bottom"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu">
					<line x1="3" y1="12" x2="21" y2="12"></line>
					<line x1="3" y1="6" x2="21" y2="6"></line>
					<line x1="3" y1="18" x2="21" y2="18"></line>
				</svg></a>

			<div class="nav-logo align-self-center d-flex align-items-center">
				<a class="navbar-brand" href="{{route('dashboard')}}"><img alt="logo" src="{{ asset('img/intek.png') }}" style="width: auto;"></a>
				<p class="ml-1 mt-2 font-weight-bold">INTEK</p>
			</div>

			<ul class="navbar-item flex-row mr-auto">
				<li class="nav-item align-self-center search-animated">

				</li>
			</ul>

			<ul class="navbar-item flex-row nav-dropdowns">


				<!-- <li class="nav-item dropdown notification-dropdown">
					<a href="javascript:void(0);" class="nav-link dropdown-toggle" id="notificationDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell">
							<path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
							<path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
						</svg><span class="badge badge-success"></span>
					</a>
					<div class="dropdown-menu position-absolute animated fadeInUp" aria-labelledby="notificationDropdown">
						<div class="notification-scroll">

							<div class="dropdown-item">
								<div class="media server-log">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-server">
										<rect x="2" y="2" width="20" height="8" rx="2" ry="2"></rect>
										<rect x="2" y="14" width="20" height="8" rx="2" ry="2"></rect>
										<line x1="6" y1="6" x2="6" y2="6"></line>
										<line x1="6" y1="18" x2="6" y2="18"></line>
									</svg>
									<div class="media-body">
										<div class="data-info">
											<h6 class="">Server Rebooted</h6>
											<p class="">45 min ago</p>
										</div>

										<div class="icon-status">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
												<line x1="18" y1="6" x2="6" y2="18"></line>
												<line x1="6" y1="6" x2="18" y2="18"></line>
											</svg>
										</div>
									</div>
								</div>
							</div>

							<div class="dropdown-item">
								<div class="media ">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart">
										<path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
									</svg>
									<div class="media-body">
										<div class="data-info">
											<h6 class="">Licence Expiring Soon</h6>
											<p class="">8 hrs ago</p>
										</div>

										<div class="icon-status">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
												<line x1="18" y1="6" x2="6" y2="18"></line>
												<line x1="6" y1="6" x2="18" y2="18"></line>
											</svg>
										</div>
									</div>
								</div>
							</div>

							<div class="dropdown-item">
								<div class="media file-upload">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text">
										<path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
										<polyline points="14 2 14 8 20 8"></polyline>
										<line x1="16" y1="13" x2="8" y2="13"></line>
										<line x1="16" y1="17" x2="8" y2="17"></line>
										<polyline points="10 9 9 9 8 9"></polyline>
									</svg>
									<div class="media-body">
										<div class="data-info">
											<h6 class="">Kelly Portfolio.pdf</h6>
											<p class="">670 kb</p>
										</div>

										<div class="icon-status">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check">
												<polyline points="20 6 9 17 4 12"></polyline>
											</svg>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</li> -->

				<li class="nav-item dropdown user-profile-dropdown order-lg-0 order-1">
					<a href="javascript:void(0);" class="nav-link dropdown-toggle user" id="user-profile-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<div class="media">
							<img src="{{ Avatar::create(Auth::user()->name)->toBase64() }}">
							<div class="media-body align-self-center">
								<h6><span>Hi,</span> {{Auth::user()->name}}</h6>
							</div>
						</div>
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down">
							<polyline points="6 9 12 15 18 9"></polyline>
						</svg>
					</a>
					<div class="dropdown-menu position-absolute animated fadeInUp" aria-labelledby="user-profile-dropdown">
						<div class="">
							<div class="dropdown-item">
								<a class="" href="user_profile.html"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
										<path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
										<circle cx="12" cy="7" r="4"></circle>
									</svg> My Profile</a>
							</div>
							<div class="dropdown-item">
								<a class="" href="auth_login.html"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out">
										<path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
										<polyline points="16 17 21 12 16 7"></polyline>
										<line x1="21" y1="12" x2="9" y2="12"></line>
									</svg> Sign Out</a>
							</div>
						</div>
					</div>

				</li>
			</ul>
		</header>
	</div>
	<!--  END NAVBAR  -->

	<!--  BEGIN MAIN CONTAINER  -->
	<div class="main-container mb-4" id="container">

		<div class="overlay"></div>
		<div class="search-overlay"></div>

		<!--  BEGIN TOPBAR  -->
		<div class="topbar-nav header navbar" role="banner">
			@include('include.topnav')
		</div>
		<!--  END TOPBAR  -->
	</div>
	<div class="main-content">
		<div class="layout-px-spacing">
		<div class="row layout-top-spacing">
			@yield('content')
		</div>
		</div>
		<div class="footer-wrapper d-flex justify-content-center my-4">
			<div class="footer-section f-section-1">
				<p class="text-center">Copyright © {{date('Y')}} Solusi Intek Indonesia</a> </p>
				<p class="text-center">All rights reserved.</p>
			</div>
		</div>
	</div>

	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
	<script src="{{ asset('modern-dark-menu/assets/js/libs/jquery-3.1.1.min.js') }}"></script>
	<script src="{{ asset('plugins/moment/moment.js') }}"></script>
	<script src="{{ asset('modern-dark-menu/bootstrap/js/popper.min.js') }}"></script>
	<script src="{{ asset('modern-dark-menu/bootstrap/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('modern-dark-menu/plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
	<script src="{{ asset('modern-dark-menu/assets/js/app.js') }}"></script>
	<script>
		$(document).ready(function() {
			App.init();
		});
	</script>
	<script src="{{ asset('modern-dark-menu/assets/js/custom.js') }}"></script>
	<!-- END GLOBAL MANDATORY SCRIPTS -->

	<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
	<script src="{{ asset('modern-dark-menu/plugins/apex/apexcharts.min.js') }}"></script>
	<script src="{{ asset('modern-dark-menu/assets/js/dashboard/dash_2.js') }}"></script>
	<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->

	<script src="{{ asset('modern-dark-menu/assets/js/scrollspyNav.js') }}"></script>
	<script src="{{ asset('modern-dark-menu/plugins/font-icons/feather/feather.min.js') }}"></script>
	<script type="text/javascript">
		feather.replace();
	</script>
	<script src="{{ asset('modern-dark-menu/plugins/highlight/highlight.pack.js') }}"></script>
	<script src="{{ asset('modern-dark-menu/plugins/notification/snackbar/snackbar.min.js')}}"></script>
	<script src="{{ asset('modern-dark-menu/assets/js/custom.js') }}"></script>
	@include('include.script')

</body>

</html>