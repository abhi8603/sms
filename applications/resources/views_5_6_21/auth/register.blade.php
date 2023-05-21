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
                    <form method="post" action="{{url('user/register')}}">
                                            @csrf

      							<div class="row justify-content-center">

      								<div class="col-md-8">
                        @include('notification.notify')
      									<div class="card-group mb-0">
      										<div class="card p-4">
      											<div class="card-body">
      												<h1>Register</h1>
      												<p class="text-muted">Create New Account</p>
      												<div class="input-group mb-3">
      													<span class="input-group-addon"><i class="fa fa-user w-4"></i></span>
      													<input type="text" name="name" class="form-control" placeholder="Enter name" autocomplete="off" required>
      												</div>
      												<div class="input-group mb-4">
      													<span class="input-group-addon"><i class="fa fa-envelope  w-4"></i></span>
      													<input type="email" name="email" class="form-control" placeholder="Enetr Email" autocomplete="off" required>
      												</div>
                              <div class="input-group mb-4">
      													<span class="input-group-addon"><i class="fa fa-envelope  w-4"></i></span>
      													<input type="text" name="mobile" class="form-control" maxlength="10" onkeypress="return isNumber(event)" placeholder="Enetr Mobile No" autocomplete="off" required>
      												</div>
      												<div class="input-group mb-4">
      													<span class="input-group-addon"><i class="fa fa-lock  w-4"></i></span>
      													<input type="password" name="password" class="form-control" placeholder="Password" autocomplete="off" required>
      												</div>
      												<div class="form-group">
      													<label class="custom-control custom-checkbox">
      														<input type="checkbox" class="custom-control-input" required/>
      														<span class="custom-control-label">Agree the <a href="terms.html">terms and policy</a></span>
      													</label>
      												</div>
      												<div class="row">
      													<div class="col-12">
      														<input type="submit" class="btn btn-primary btn-block px-4" value="create a new account" name="register">
      													</div>

      												</div>
      											</div>
      										</div>
      										<div class="card text-white bg-primary py-5 d-md-down-none">
      											<div class="card-body text-center">
      												<div>
      													<h2>Already have account?</h2>
      													<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search</p>
      													<a href="{{url('/')}}" class="btn btn-secondary mt-3">Sign in</a>
      												</div>
      											</div>
      										</div>
      									</div>
      								</div>
      							</div>
                  </from>
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
<script>
function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}
</script>
</body>
</html>
