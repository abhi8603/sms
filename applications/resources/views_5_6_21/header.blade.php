<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>

		<!-- Meta data -->
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta content="Clont - Bootstrap Webapp Responsive Dashboard Simple Admin Panel Premium HTML5 Template" name="description">
		<meta content="Spruko Technologies Private Limited" name="author">
		<meta name="keywords" content="Admin, Admin Template, Dashboard, Responsive, Admin Dashboard, Bootstrap, Bootstrap 4, Clean, Backend, Jquery, Modern, Web App, Admin Panel, Ui, Premium Admin Templates, Flat, Admin Theme, Ui Kit, Bootstrap Admin, Responsive Admin, Application, Template, Admin Themes, Dashboard Template"/>

		<!-- Title -->
		<title><?php echo app_config('AppName') ?></title>

		<!--Favicon -->
		<link rel="icon" href="<?php echo asset(app_config('AppFav')); ?>" type="image/x-icon"/>

		<!-- Style css -->
		<link href="{{ URL::asset('assets/css/style.css')}}" rel="stylesheet" />
		<link href="{{ URL::asset('assets/css/skin-modes.css')}}" rel="stylesheet" />

		<!--Horizontal css -->
        <link id="effect" href="{{ URL::asset('assets/plugins/horizontal-menu/dropdown-effects/fade-up.css')}}" rel="stylesheet" />
        <link href="{{ URL::asset('assets/plugins/horizontal-menu/horizontal.css')}}" rel="stylesheet" />

		<!-- P-scroll bar css-->
		<link href="{{ URL::asset('assets/plugins/p-scrollbar/p-scrollbar.css')}}" rel="stylesheet" />

		<!---Icons css-->
		<link href="{{ URL::asset('assets/plugins/web-fonts/icons.css')}}" rel="stylesheet" />
		<link href="{{ URL::asset('assets/plugins/web-fonts/font-awesome/font-awesome.min.css')}}" rel="stylesheet">
		<link href="{{ URL::asset('assets/plugins/web-fonts/plugin.css')}}" rel="stylesheet" />

		<!-- Switcher css -->
		<link  href="{{ URL::asset('assets/switcher/css/switcher.css')}}" rel="stylesheet" id="switcher-css" type="text/css" media="all"/>
		<link  href="{{ URL::asset('assets/plugins/date-picker/date-picker.css')}}" rel="stylesheet" id="switcher-css" type="text/css" media="all"/>

		<!-- Skin css-->
	<!--	<link id="theme" rel="stylesheet" type="text/css" media="all" href="{{ URL::asset('assets/skins/hor-skin/skin.css')}}" />-->
		<link id="theme" rel="stylesheet" type="text/css" media="all" href="{{ URL::asset('assets/skins/hor-skin/hor-skin2.css')}}" />
		<link id="theme" rel="stylesheet" type="text/css" media="all" href="{{ URL::asset('assets/skins/hor-skin/main2.css')}}" />

		<link rel="stylesheet" href="{{ URL::asset('assets/skins/demo.css')}}"/>
    {{--Custom StyleSheet Start--}}

       @yield('style')
      {{--Global StyleSheet End--}}
	</head>

	<body class="app">
    <!-- Start Switcher -->
    <!--		<div class="switcher-wrapper ">
    			<div class="demo_changer">
    				<div class="demo-icon bg_dark"><i class="fa fa-cog fa-spin  text_primary"></i></div>
    				<div class="form_holder sidebar-right">
    					<div class="row">
    						<div class="predefined_styles">
    							<div class="skin-theme-switcher">
    								<div class="swichermainleft">
    									<h4>Horizontal-menu Skin & styles Mode</h4>
    									<div class="skin-body">
    										<a class="wscolorcode blackborder hor-skin1 navstyle1 active"  data-theme="{{ URL::asset('assets/skins/hor-skin/hor-skin1.css')}}">
    											<span class="wsnamecode">Default</span>
    										</a>
    										<a class="wscolorcode blackborder hor-skin2 navstyle1" href="#" data-theme="{{ URL::asset('assets/skins/hor-skin/hor-skin2.css')}}">
    											<span class="wsnamecode">Color</span>
    										</a>
    										<a class="wscolorcode blackborder hor-skin3 navstyle1" href="#" data-theme="{{ URL::asset('assets/skins/hor-skin/hor-skin3.css')}}">
    											<span class="wsnamecode">Dark</span>
    										</a>
    										<a class="wscolorcode blackborder menu-1  navstyle1" href="#" data-theme="{{ URL::asset('assets/skins/hor-skin/menu1.css')}}">
    											<span class="wsnamecode">Style1</span>
    										</a>
    										<a class="wscolorcode blackborder menu-2  navstyle1" href="#" data-theme="{{ URL::asset('assets/skins/hor-skin/menu2.css')}}">
    											<span class="wsnamecode">Style2</span>
    										</a>
    									</div>
    								</div>
    								<div class="swichermainleft">
    									<h4>Body Skins Mode</h4>
    									<div class="skin-body">
    										<a class="wscolorcode blackborder main1 navstyle1 active" href="#" data-theme="{{ URL::asset('assets/skins/hor-skin/main1.css')}}">
    											<span class="wsnamecode">Default</span>
    										</a>
    										<a class="wscolorcode blackborder main2 navstyle1" href="#" data-theme="{{ URL::asset('assets/skins/hor-skin/main2.css')}}">
    											<span class="wsnamecode">Style1</span>
    										</a>
    										<a class="wscolorcode blackborder main3 navstyle1" href="#" data-theme="{{ URL::asset('assets/skins/hor-skin/main3.css')}}">
    											<span class="wsnamecode">Style2</span>
    										</a>
    									</div>
    								</div>
    								<div class="swichermainleft">
    									<h4>Skin Modes</h4>
    									<div class="switch_section">
    										<div class="switch-toggle d-flex">
    											<span class="mr-auto">Light Mode</span>
    											<div class="onoffswitch2"><input type="radio" name="onoffswitch2" id="myonoffswitch1" class="onoffswitch2-checkbox" checked>
    												<label for="myonoffswitch1" class="onoffswitch2-label"></label>
    											</div>
    										</div>
    										<div class="switch-toggle d-flex">
    											<span class="mr-auto">Dark Mode</span>
    											<div class="onoffswitch2"><input type="radio" name="onoffswitch2" id="myonoffswitch2" class="onoffswitch2-checkbox">
    												<label for="myonoffswitch2" class="onoffswitch2-label"></label>
    											</div>
    										</div>
    									</div>
    								</div>
    								<div class="swichermainleft">
    									<h4>Versions</h4>
    									<div class="switch_section">
    										<div class="switch-toggle d-flex">
    											<span class="mr-auto">Default</span>
    											<div class="onoffswitch2"><input type="radio" name="onoffswitch2" id="myonoffswitch3" class="onoffswitch2-checkbox">
    												<label for="myonoffswitch3" class="onoffswitch2-label"></label>
    											</div>
    										</div>
    										<div class="switch-toggle d-flex">
    											<span class="mr-auto">Boxed</span>
    											<div class="onoffswitch2"><input type="radio" name="onoffswitch2" id="myonoffswitch4" class="onoffswitch2-checkbox">
    												<label for="myonoffswitch4" class="onoffswitch2-label"></label>
    											</div>
    										</div>
    									</div>
    								</div>
    								<div class="swichermainleft">
    									<h4>Font-Family</h4>
    									<div class="skin-body">
    										<a class="wscolorcode blackborder font-1  navstyle1 active" href="#" data-theme="{{ URL::asset('assets/skins/hor-skin/font1.css')}}">
    											<span class="wsnamecode">Roboto</span>
    										</a>
    										<a class="wscolorcode blackborder font-2 navstyle1" href="#" data-theme="{{ URL::asset('assets/skins/hor-skin/font2.css')}}">
    											<span class="wsnamecode">Nunito</span>
    										</a>
    										<a class="wscolorcode blackborder font-3  navstyle1" href="#" data-theme="{{ URL::asset('assets/skins/hor-skin/font3.css')}}">
    											<span class="wsnamecode">Open Sans</span>
    										</a>
    										<a class="wscolorcode blackborder font-4  navstyle1" href="#" data-theme="{{ URL::asset('assets/skins/hor-skin/font4.css')}}">
    											<span class="wsnamecode">Lato</span>
    										</a>
    									</div>
    								</div>


    							</div>
    						</div>
    					</div>
    				</div>
    			</div>
    		</div>-->
    		<!-- End Switcher -->

    		<!---Global-loader-->
    		<div id="global-loader" >
    			<img src="{{ URL::asset('assets/images/svgs/loader.svg')}}" alt="loader">
    		</div>
        <div class="page">
        			<div class="page-main">
                <div class="header top-header">
  					<div class="container">
  						<div class="d-flex">
  							<a id="horizontal-navtoggle" class="animated-arrow hor-toggle"><span></span></a><!-- sidebar-toggle-->
  							<a class="header-brand" href="index.html">
  								<img src="<?php echo asset(app_config('AppLogo')); ?>" class="header-brand-img desktop-lgo" alt="<?php echo app_config('AppName') ?>">
  							</a>

  							<div class="d-flex order-lg-2 ml-auto">

  								<div class="dropdown   header-fullscreen" >
  									<a  class="nav-link icon full-screen-link"  id="fullscreen-button">
  										<i class="fe fe-minimize"></i>
  									</a>
  								</div>

  								<div class="dropdown ">
  									<a href="#" class="nav-link pr-0 leading-none" data-toggle="dropdown">
  										<span>
												@if(Auth::user()->profile_img == null)
												<img src="<?php echo asset(app_config('AppLogo')); ?>" alt="img" class="avatar avatar-md brround">
												@else
												<img src="../assets/images/users/16.jpg" alt="img" class="avatar avatar-md brround">
												@endif
  										</span>
  									</a>
  									<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow ">
  										<div class="text-center">
  											<a href="#" class="dropdown-item text-center user pb-0">{{Auth::user()->name}}</a>
  										<!--	<span class="text-center user-semi-title text-dark">App Developer</span>-->
  											<div class="dropdown-divider"></div>
  										</div>
  										<a class="dropdown-item" href="#">
  											<i class="dropdown-icon mdi mdi-account-outline "></i> Profile
  										</a>
											<a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item">
												<i class="dropdown-icon mdi  mdi-logout-variant"></i> Sign out</a>
								 <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
																			 @csrf
																				<input type="hidden" name="_token" value="{{ csrf_token() }}">
																	 </form>
  									</div>
  								</div>
  							</div>
  						</div>
  					</div>
  				</div>
          <!-- Horizontal-menu -->
      <div class="horizontal-main hor-menu clearfix">
        <div class="horizontal-mainwrapper container clearfix">
          <nav class="horizontalMenu clearfix">
            <ul class="horizontalMenu-list">
							<li aria-haspopup="true"><a href="{{url('/home')}}" class="active"><i class="fe fe-monitor hor-icon"></i>Dashboard</a></li>

              <li aria-haspopup="true"><a href="#" class="sub-icon"><i class="fe fe-grid"></i>  <i class="fa fa-angle-down horizontal-icon"></i>Application</a>
                <ul class="sub-menu">
                  <li aria-haspopup="true"><a href="">Instructions</a></li>
                  <li aria-haspopup="true"><a href="{{url('/application')}}">Apply</a></li>
                  <li aria-haspopup="true"><a href="">My Application Status</a></li>
                </ul>
              </li>

          </ul>
          </nav>
          <!--Nav end -->
        </div>
      </div>
      <!-- Horizontal-menu end -->

  @yield('content')
  <footer class="footer">
				<div class="container">
					<div class="row align-items-center flex-row-reverse">
						<div class="col-md-12 col-sm-12 mt-3 mt-lg-0 text-center">
							Copyright © 2019 <a href="#">Bucksoftech Pvt. Ltd.</a>. Designed by <a href="#">Bucksoftech Pvt. Ltd.</a> All rights reserved.
						</div>
					</div>
				</div>
			</footer>
</div>

  <input type="hidden" id="_url" value="{{url('/')}}">
        <!-- Back to top -->
  <a href="#top" id="back-to-top" style="display: inline;"><i class="fa fa-angle-up"></i></a>

  <!-- Jquery js-->
  <script src="{{ URL::asset('assets/js/vendors/jquery-3.4.0.min.js')}}"></script>

  <!-- Bootstrap4 js-->
  <script src="{{ URL::asset('assets/plugins/bootstrap/popper.min.js')}}"></script>
  <script src="{{ URL::asset('assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>

  <!--Othercharts js-->
  <script src="{{ URL::asset('assets/plugins/othercharts/jquery.sparkline.min.js')}}"></script>

  <!-- Circle-progress js-->
  <script src="{{ URL::asset('assets/js/vendors/circle-progress.min.js')}}"></script>

  <!-- Jquery-rating js-->
  <script src="{{ URL::asset('assets/plugins/rating/jquery.rating-stars.js')}}"></script>

  <!--Horizontal js-->
  <script src="{{ URL::asset('assets/plugins/horizontal-menu/horizontal.js')}}"></script>

  <!-- P-scroll js-->
  <script src="{{ URL::asset('assets/plugins/p-scrollbar/p-scrollbar.js')}}"></script>
  <script src="{{ URL::asset('assets/plugins/p-scrollbar/p-scroll.js')}}"></script>
  <!-- Switcher js -->
  <script src="{{ URL::asset('assets/switcher/js/switcher.js')}}"></script>
	<script src="{{ URL::asset('assets/plugins/date-picker/date-picker.js')}}"></script>
	<script src="{{ URL::asset('assets/plugins/date-picker/jquery-ui.js')}}"></script>


  <!-- Custom js-->
  <script src="{{ URL::asset('assets/js/custom.js')}}"></script>
  <script>
     $.ajaxSetup({
         headers: {
             'X-CSRF-Token': $('input[name="_token"]').val()
         }
     });
  </script>
  <!--live chat script here-->
  {{--Custom JavaScript Start--}}

  @yield('script')

</body>
</html>
