<!DOCTYPE html>
<html lang="en">
<head>

		<!-- Meta data -->
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta content="application form,Bucksoftech,abhijeet" name="description">
		<meta content="Spruko Technologies Private Limited" name="author">
		<meta name="keywords" content="application form,Bucksoftech,abhijeet"/>

		<!-- Title -->
		<title><?php echo app_config('AppName') ?></title>

		<!--Favicon -->
		<link rel="icon" href="<?php echo asset(app_config('AppFav')); ?>" type="image/x-icon"/>

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
											<img src="<?php echo "https://cloud.stpaulscollege.co.in/".app_config('AppLogo'); ?>" class="header-brand-img desktop-lgo" alt="<?php echo app_config('AppName') ?>" class="header-brand-img desktop-lgo" alt="<?php echo app_config('AppName') ?>">
      							</div>
      							<div class="row justify-content-center">
      								<div class="col-md-8">
      									<div class="card-group mb-0">
      										<div class="card p-4">
      											<div class="card-body">
      												<h1>Register</h1>
      												<p class="text-muted">Create New Account</p>
      												<div class="input-group mb-3">
      													<span class="input-group-addon"><i class="fa fa-user w-4"></i></span>
      													<input type="text" class="form-control" placeholder="Entername">
      												</div>
      												<div class="input-group mb-4">
      													<span class="input-group-addon"><i class="fa fa-envelope  w-4"></i></span>
      													<input type="text" class="form-control" placeholder="Enetr Email">
      												</div>
      												<div class="input-group mb-4">
      													<span class="input-group-addon"><i class="fa fa-lock  w-4"></i></span>
      													<input type="password" class="form-control" placeholder="Password">
      												</div>
      												<div class="form-group">
      													<label class="custom-control custom-checkbox">
      														<input type="checkbox" class="custom-control-input" />
      														<span class="custom-control-label">Agree the <a href="terms.html">terms and policy</a></span>
      													</label>
      												</div>
      												<div class="row">
      													<div class="col-12">
      														<button type="button" class="btn btn-primary btn-block px-4">create a new account</button>
      													</div>

      												</div>
      											</div>
      										</div>
      										<div class="card text-white bg-primary py-5 d-md-down-none">
      											<div class="card-body text-center">
      												<div>
      													<h2>Already have account?</h2>
      													<p>Please Sign in from here</p>
      													<a href="login.html" class="btn btn-secondary mt-3">Sign in</a>
      												</div>
      											</div>
      										</div>
      									</div>
      								</div>
      							</div>
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
