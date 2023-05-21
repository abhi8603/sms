<!DOCTYPE html>

<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="icon" href="<?php echo asset(app_config('AppLogo',Auth::user()->school_id)); ?>" type="image/png" sizes="16x16">
  <title>Admin | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  {{--Custom StyleSheet Start--}}

    @yield('style')
   {{--Global StyleSheet End--}}
    <link rel="stylesheet" href="{{ URL::asset('assets/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
   <link rel="stylesheet" href="{{ URL::asset('assets/bower_components/font-awesome/css/font-awesome.min.css') }}">
   <link rel="stylesheet" href="{{ URL::asset('assets/bower_components/Ionicons/css/ionicons.min.css') }}">
   <link rel="stylesheet" href="{{ URL::asset('assets/dist/css/AdminLTE.min.css') }}">
   <link rel="stylesheet" href="{{ URL::asset('assets/dist/css/skins/_all-skins.min.css') }}">
   <link rel="stylesheet" href="{{ URL::asset('assets/bower_components/morris.js/morris.css') }}">   <!-- Morris chart -->
   <link rel="stylesheet" href="{{ URL::asset('assets/bower_components/jvectormap/jquery-jvectormap.css') }}">
   <link rel="stylesheet" href="{{ URL::asset('assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
   <link rel="stylesheet" href="{{ URL::asset('assets/bower_components/font-awesome/css/font-awesome.min.css') }}">    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ URL::asset('assets/bower_components/Ionicons/css/ionicons.min.css') }}">  <!-- jvectormap -->
  <style>
      /* FROM HTTP://WWW.GETBOOTSTRAP.COM
       * Glyphicons
       *
       * Special styles for displaying the icons and their classes in the docs.
       */

      .bs-glyphicons {
        padding-left: 0;
        padding-bottom: 1px;
        margin-bottom: 20px;
        list-style: none;
        overflow: hidden;
      }

      .bs-glyphicons li {
        float: left;
        width: 25%;
        height: 115px;
        padding: 10px;
        margin: 0 -1px -1px 0;
        font-size: 12px;
        line-height: 1.4;
        text-align: center;
        border: 1px solid #ddd;
      }

      .bs-glyphicons .glyphicon {
        margin-top: 5px;
        margin-bottom: 10px;
        font-size: 24px;
      }

      .bs-glyphicons .glyphicon-class {
        display: block;
        text-align: center;
        word-wrap: break-word; /* Help out IE10+ with class names */
      }

      .bs-glyphicons li:hover {
        background-color: rgba(86, 61, 124, .1);
      }

      @media (min-width: 768px) {
        .bs-glyphicons li {
          width: 12.5%;
        }
      }
    </style>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="{{url('welcome')}}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <!--<span class="logo-mini"><img src="assets/images/logo_sm.png" style="height: 39px;" /></span>-->
      <span class="logo-mini"><img src="<?php echo asset(app_config('AppLogo',Auth::user()->school_id)); ?>" style="height: 39px;" /></span>

      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><img src="<?php echo asset(app_config('AppLogo',Auth::user()->school_id)); ?>" style="height: 41px;" /></span>
      </a>
    <!-- Header Navbar: style can be found in header.less -->

    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>

      </a>

      <div class="navbar-custom-menu">

        <ul class="nav navbar-nav">
          <li class="dropdown user user-menu">
                @if (Auth::user()->name)
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">

            @if(Auth::user()->profile_img==null || Auth::user()->profile_img=="")
              <img src="<?php echo asset(app_config('AppLogo',Auth::user()->school_id)); ?>" class="user-image" alt="User Image">
              @else
              <img src="{{ URL::asset(Auth::user()->profile_img) }}" class="user-image" alt="User Image">
              @endif
             <span class="hidden-xs"> {{ Auth::user()->name }}</span>
            </a>

            @else
         <script type="text/javascript">
    window.location = "{{ url('/') }}";//here double curly bracket
</script>
            @endif
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
              @if(Auth::user()->profile_img==null || Auth::user()->profile_img=="")
              <img src="<?php echo asset(app_config('AppLogo',Auth::user()->school_id)); ?>" class="user-image" alt="User Image">
              @else
              <img src="{{ URL::asset(Auth::user()->profile_img) }}" class="user-image" alt="User Image">
              @endif
                <p>
                  {{ Auth::user()->name }}
                <small>Today is {{date('l dS F - Y')}}</small>

                  </p>
              </li>
              <!-- Menu Body -->

              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="{{ url('user_profile') }}" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-default btn-flat">Sign out</a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                         <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    </form>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
        @include('Teacher.main-sidenav')
         </div>
         </body>

</html>
