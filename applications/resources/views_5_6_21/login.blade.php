<!DOCTYPE html>
<html lang="en">
<head>

		<!-- Meta data -->
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta content="Clont - Bootstrap Webapp Responsive Dashboard Simple Admin Panel Premium HTML5 Template" name="description">
		<meta content="Spruko Technologies Private Limited" name="author">
		<meta name="keywords" content="Admin, Admin Template, Dashboard, Responsive, Admin Dashboard, Bootstrap, Bootstrap 4, Clean, Backend, Jquery, Modern, Web App, Admin Panel, Ui, Premium Admin Templates, Flat, Admin Theme, Ui Kit, Bootstrap Admin, Responsive Admin, Application, Template, Admin Themes, Dashboard Template"/>

		<!-- Title -->
		<title>Clont - Bootstrap Webapp Responsive Dashboard Simple Admin Panel Premium HTML5 Template</title>

		<!--Favicon -->
		<link rel="icon" href="{{ URL::asset('assets/images/brand/favicon.ico')}}" type="image/x-icon"/>

		<!-- Style css -->
		<link href="{{ URL::asset('assets/css/style.css')}}" rel="stylesheet" />
		<link href="{{ URL::asset('assets/css/skin-modes.css')}}" rel="stylesheet" />

		<!---Icons css-->
		<link href="{{ URL::asset('assets/plugins/web-fonts/icons.css')}}" rel="stylesheet" />
		<link href="{{ URL::asset('assets/plugins/web-fonts/font-awesome/font-awesome.min.css')}}" rel="stylesheet">
		<link href="{{ URL::asset('assets/plugins/web-fonts/plugin.css')}}" rel="stylesheet" />

		<!-- Switcher css -->
		<link  href="{{ URL::asset('assets/switcher/css/switcher.css')}}" rel="stylesheet" id="switcher-css" type="text/css" media="all"/>

		<!-- Skin css-->
		<link id="theme" rel="stylesheet" type="text/css" media="all" href="{{ URL::asset('assets/skins/hor-skin/skin.css')}}" />
		<link rel="stylesheet" href="{{ URL::asset('assets/skins/demo.css')}}"/>

	</head>

  	<body class="h-100vh">
  		<div class="page">
  			<div class="page-single">
  				<div class="container">
  					<div class="row">
  						<div class="col mx-auto">
  							<div class="text-center mb-6">
  								<img src="../assets/images/brand/logo.png" class="header-brand-img desktop-lgo" alt="Clont logo">
  								<img src="../assets/images/brand/logo1.png" class="header-brand-img dark-logo" alt="Clont logo">
  							</div>
                <form action="{{ route('login') }}" method="post">
  							<div class="row justify-content-center">
  								<div class="col-md-8">
                    @include('notification.notify')
  									<div class="card-group mb-0">
                			<div class="card p-4">
  											<div class="card-body">
  												<h1>Login</h1>
  												<p class="text-muted">Sign In to your account</p>
  												<div class="input-group mb-3">
  													<span class="input-group-addon"><i class="fa fa-user"></i></span>
  													<input type="email" name="email" class="form-control  @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Username">
                            @error('email')
                                     <span class="invalid-feedback" role="alert">
                                         <strong>{{ $message }}</strong>
                                     </span>
                                 @enderror
                        	</div>
  												<div class="input-group mb-4">
  													<span class="input-group-addon"><i class="fa fa-lock"></i></span>
  													<input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Password">
  												</div>
  												<div class="row">
  													<div class="col-12">
                              @csrf
    														<input type="submit" class="btn btn-primary btn-block" name="login" value="Login"/>
  													</div>
  													<div class="col-12">
  														<a href="forgot-password.html" class="btn btn-link box-shadow-0 px-0">Forgot password?</a>
  													</div>
  												</div>
  											</div>
  										</div>
                			<div class="card text-white bg-primary py-5 d-md-down-none ">
  											<div class="card-body text-center justify-content-center ">
  												<h2>Sign up</h2>
  												<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.ed ut perspiciatis unde omnis iste natus error sit voluptatem  </p>
  												<a href="{{url('register')}}" class="btn btn-secondary mt-3">Register Now!</a>
  											</div>
  										</div>
  									</div>
  								</div>
  							</div>
              </form>

  						</div>
  					</div>
  				</div>
  			</div>
  		</div>

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

  <!-- Switcher js -->

  <!-- Custom js-->
  <script src="{{ URL::asset('assets/js/custom.js')}}"></script>
</body>
</html>
