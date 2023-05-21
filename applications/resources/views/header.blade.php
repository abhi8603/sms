<!doctype html>
<html lang="en" dir="ltr">


<!-- Mirrored from demo.jsnorm.com/html/strikingdash/strikingdash/ltr/inbox.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 02 Sep 2021 03:31:10 GMT -->
<head>
<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
		<meta http-equiv="Pragma" content="no-cache" />
  		<meta http-equiv="Expires" content="0" />
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta content="Bucksofttech pvt. ltd,abhijeet,online application" name="description">
		<meta content="Spruko Technologies Private Limited" name="author">
		<meta name="keywords" content="Bucksofttech pvt. ltd,abhijeet,online application"/>
    <title><?php echo app_config('AppName') ?></title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;display=swap" rel="stylesheet">

    <!-- inject:css-->

	<link rel="stylesheet" href="{{ URL::asset('assets/css/plugin.min.css')}}">

<link rel="stylesheet" href="{{ URL::asset('assets/css/style.css')}}">

    <!-- endinject -->

    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo asset(app_config('AppFav')); ?>">
	{{--Custom StyleSheet Start--}}

@yield('style')
{{--Global StyleSheet End--}}
</head>

<body class="layout-dark side-menu overlayScroll">
    <div class="mobile-search"></div>

    <div class="mobile-author-actions"></div>
    <header class="header-top">
        <nav class="navbar navbar-light">
            <div class="navbar-left">
                <a href="#" class="sidebar-toggle">
                    <img class="svg" src="{{ URL::asset('assets/img/svg/bars.svg')}}" alt="img"></a>
                <a class="navbar-brand" href="#"><img style="height: 64.5px;" class="svg dark" src="<?php echo "https://soft.metassdaschool.com/".app_config('AppLogo'); ?>" alt="st pauls college">
                <img class="light" style="height: 64.5px;" src="<?php echo "https://soft.metassdaschool.com/".app_config('AppLogo'); ?>" alt="img"></a>
               
              
            </div>
            <!-- ends: navbar-left -->

            <div class="navbar-right">
                <ul class="navbar-right__menu">         
                <li class="nav-author">
                        <div class="dropdown-custom">
                            <a href="javascript:;" class="nav-item-toggle">                            
                                @if(Auth::user()->profile_img == null)
												<img src="<?php echo "https://soft.metassdaschool.com/".app_config('AppLogo'); ?>" alt="img" class="rounded-circle">
												@else
												<img src="../assets/images/users/16.jpg" alt="img" class="rounded-circle">
												@endif	
                            
                            </a>
                            <div class="dropdown-wrapper">
                                <div class="nav-author__info">
                                    <div class="author-img">
                                    @if(Auth::user()->profile_img == null)
												<img src="<?php echo "https://soft.metassdaschool.com/".app_config('AppLogo'); ?>" alt="img" class="rounded-circle">
												@else
												<img src="../assets/images/users/16.jpg" alt="img" class="rounded-circle">
												@endif
                                            </div>
                                    <div>
                                        <h6>{{Auth::user()->name}}</h6>
                                        <span>Applicant</span>
                                    </div>
                                </div>
                                <div class="nav-author__options">
                                    
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-author__signout">
                                        <span data-feather="log-out"></span> Sign Out</a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                         <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    </form>
                                </div>
                            </div>
                            <!-- ends: .dropdown-wrapper -->
                        </div>
                    </li>
                    <!-- ends: .nav-author -->
                </ul>
                <!-- ends: .navbar-right__menu -->
                <div class="navbar-right__mobileAction d-md-none">
                    <a href="#" class="btn-search">
                        <span data-feather="search"></span>
                        <span data-feather="x"></span></a>
                    <a href="#" class="btn-author-action">
                        <span data-feather="more-vertical"></span></a>
                </div>
            </div>
            <!-- ends: .navbar-right -->
        </nav>
    </header>
    <main class="main-content">
	<aside class="sidebar">
            <div class="sidebar__menu-group">
                <ul class="sidebar_nav">
                    <li class="menu-title">
                        <span>Main menu</span>
                    </li>
                    <li>
                        <a href="{{url('/home')}}"
                        @if(Request::path()=='home')class="active" @endif class="">
                            <span data-feather="home" class="nav-icon"></span>
                            <span class="menu-text">Dashboard</span>                           
                        </a>
                    </li>
                    <li>
                        <a href="{{url('/application/instructions')}}" @if(Request::path()=='application/instructions')class="active" @endif class="">
                            <span data-feather="book" class="nav-icon"></span>
                            <span class="menu-text">Instructions</span>                           
                        </a>
                    </li>
                    <li class="has-child">
                        <a href="#" @if(Request::path()=='application/select')class="active" @endif class="">
                            <span data-feather="activity" class="nav-icon"></span>
                            <span class="menu-text">Application</span>
                            <span class="toggle-icon"></span>
                        </a>
                        <ul>
                            <li>
                                <a @if(Request::path()=='application/select')class="active" @endif class="" href="{{url('/application/select')}}">Apply</a>
                            </li>
                            <li>
                                <a class="" href="{{url('/home')}}">My Application Status</a>
                            </li>                           
                        </ul>
                    </li>
				</ul>
			</div>
	</aside>
		@yield('content')
        <footer class="footer-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <div class="footer-copyright">
                            <p>2021 @<a href="#">Bucksofttech</a>
                            </p>
                        </div>
                    </div>
                   
                </div>
            </div>
        </footer>
    </main>
    <div id="overlayer">
        <span class="loader-overlay">
            <div class="atbd-spin-dots spin-lg">
                <span class="spin-dot badge-dot dot-primary"></span>
                <span class="spin-dot badge-dot dot-primary"></span>
                <span class="spin-dot badge-dot dot-primary"></span>
                <span class="spin-dot badge-dot dot-primary"></span>
            </div>
        </span>
    </div>
    <a href="#" style="display: none;" class="customizer-trigger">
        <span data-feather="settings"></span></a>
    <div class="customizer-wrapper" style="display: none;">
        <div class="customizer">
            <div class="customizer__head">
                <h4 class="customizer__title">Customizer</h4>
                <span class="customizer__sub-title">Customize your overview page layout</span>
                <a href="#" class="customizer-close">
                    <span data-feather="x"></span></a>
            </div>
            <div class="customizer__body">               
                <!-- ends: .customizer__single -->

                <div class="customizer__single">
                    <h4>Sidebar Type</h4>
                    <ul class="customizer-list d-flex l_sidebar">
                        <li class="customizer-list__item">
                            <a href="#" data-layout="light" class="active">
                                <img src="img/light.png" alt="">
                                <i class="fa fa-check-circle"></i>
                            </a>
                        </li>
                        <li class="customizer-list__item">
                            <a href="#" data-layout="dark">
                                <img src="img/dark.png" alt="">
                                <i class="fa fa-check-circle"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- ends: .customizer__single -->

                <div class="customizer__single">
                    <h4>Navbar Type</h4>
                    <ul class="customizer-list d-flex l_navbar">
                        <li class="customizer-list__item">
                            <a href="#" data-layout="side" class="">
                                <img src="img/side.png" alt="">
                                <i class="fa fa-check-circle"></i>
                            </a>
                        </li>
                        <li class="customizer-list__item top">
                            <a href="#" data-layout="top" class="active">
                                <img src="img/top.png" alt="">
                                <i class="fa fa-check-circle"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- ends: .customizer__single -->
            </div>
        </div>
    </div>
    <div class="overlay-dark-sidebar"></div>
    <div class="customizer-overlay"></div>
	<input type="hidden" id="_url" value="{{url('/')}}">   
    <!-- inject:js-->
	<script src="{{ URL::asset('assets/js/plugins.min.js')}}"></script>

<script src="{{ URL::asset('assets/js/script.min.js')}}"></script>
<script>
     $.ajaxSetup({
         headers: {
             'X-CSRF-Token': $('input[name="_token"]').val()
         }
     });
  </script>
   {{--Custom JavaScript Start--}}

@yield('script')
    <!-- endinject-->
</body>


</html>