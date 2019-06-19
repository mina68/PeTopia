<!DOCTYPE html>
<html lang="en">

	<head>

	  <meta charset="utf-8">
	  <meta http-equiv="X-UA-Compatible" content="IE=edge">
	  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	  <meta name="csrf-token" content="{{ csrf_token() }}">
	  <meta name="http-root" content="{{ Request::root() }}">
	  <meta name="description" content="">
	  <meta name="author" content="">

	  <title>Admin Pannel - @yield('title')</title>

	  <!-- Custom fonts for this template-->
	  <link href="{{ asset('backend/css/all.min.css') }}" rel="stylesheet" type="text/css">
	  <link href="{{ asset('backend/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
	  <link href="{{ asset('backend/css/components.min.css') }}" rel="stylesheet" type="text/css">
	  <link href="{{ asset('backend/css/colors.min.css') }}" rel="stylesheet" type="text/css">
	  <link href="{{ asset('backend/css/core.min.css') }}" rel="stylesheet" type="text/css">
	  <link href="{{ asset('backend/css/file-input.css') }}" rel="stylesheet" type="text/css">
	  <link href="{{ asset('backend/css/icomoon/styles.css') }}" rel="stylesheet" type="text/css">
	  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

	  <!-- Custom styles for this template-->
	  <link href="{{ asset('backend/css/sb-admin-2.css') }}" rel="stylesheet">
	  <link href="{{ asset('backend/css/styles.css') }}" rel="stylesheet">

	  @yield('styles')

	</head>

	<body id="page-top">

	    <!-- Page Wrapper -->
	    <div id="wrapper">
	  
	      	<!-- Sidebar -->
	      	@include('admin.partials.sidebar')
	      	<!-- End of Sidebar -->
	  
	      <!-- Content Wrapper -->
	      <div id="content-wrapper" class="d-flex flex-column">
	  
	        <!-- Main Content -->
	        <div id="content">
	  
	          <!-- Topbar -->
	          @include('admin.partials.topbar')
	          <!-- End of Topbar -->
	  
	          <!-- Begin Page Content -->
	          <div class="container-fluid">
	  
	            <!-- Page Heading -->
	            @yield('header')

	            <div class="content">
	            	<?php
						$messagesCount = 0;
						foreach (Session::all() as $key => $value) {
							if(strpos($key, 'message') !== false) $messagesCount ++;
						}
					?>

					@for($i = 0; $i <= $messagesCount ; $i ++)
						<?php $num = $i == 0 ? '' : $i; ?>
						@if(Session::has('message'.$num))
							<div class="alert alert-{{ Session::get('status'.$num) }} alert-styled-left {{ Session::get('status'.$num) == 'success' ? 'alert-arrow-left' : '' }} alert-bordered flash-messages">
								<button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
								<p>{{ Session::get('message'.$num) }}</p>
							</div>
						@endif
					@endfor

					@if ($errors->first() || Session::has('custErrors'))
						<div class="alert alert-danger alert-styled-left alert-bordered flash-messages">
							<button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
							<p>The data you intered is not valid!</p>
						</div>
					@endif

	            	@yield('content')
	            </div>
	  
	          </div>
	          <!-- /.container-fluid -->
	  
	        </div>
	        <!-- End of Main Content -->
	  
	        <!-- Footer -->
	        @include('admin.partials.footer')
	        <!-- End of Footer -->
	  
	      </div>
	      <!-- End of Content Wrapper -->
	  
	    </div>
	    <!-- End of Page Wrapper -->
	  
	    <!-- Scroll to Top Button-->
	    <a class="scroll-to-top rounded" href="#page-top">
	      <i class="fas fa-angle-up"></i>
	    </a>
	  
	    <!-- Logout Modal-->
	    @include('admin.partials.logoutModal')
	  


	  <script src="{{ asset('backend/js/jquery-3.4.0.min.js') }}"></script>
	  <script src="{{ asset('node_modules/popper.js/dist/umd/popper.js') }}"></script>
	  <script src="{{ asset('backend/js/bootstrap.min.js') }}"></script>
	  <script src="{{ asset('backend/js/bootbox.min.js') }}"></script>
	  <script src="{{ asset('backend/js/fontawesome.js') }}"></script>
	  <script src="{{ asset('backend/js/file-input.js') }}"></script>
	  <script src="{{ asset('backend/js/sb-admin-2.js') }}"></script>
	  <script src="{{ asset('backend/js/pnotify.min.js') }}"></script>
	  <script src="{{ asset('backend/js/scripts.js') }}"></script>
	  @yield('scripts')

	</body>

</html>
