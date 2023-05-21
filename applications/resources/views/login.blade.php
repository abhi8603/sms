<!doctype html>
<html lang="en" dir="ltr">


<!-- Mirrored from demo.jsnorm.com/html/strikingdash/strikingdash/ltr/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 02 Sep 2021 03:31:56 GMT -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo app_config('AppName') ?></title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;display=swap" rel="stylesheet">

    <!-- inject:css-->

    <link rel="stylesheet" href="{{ URL::asset('assets/css/plugin.min.css')}}">

    <link rel="stylesheet" href="{{ URL::asset('assets/css/style.css')}}">

    <!-- endinject -->

    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo asset(app_config('AppFav')); ?>">
</head>

<body>
    <main class="main-content">

        <div class="signUP-admin">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-xl-4 col-lg-5 col-md-5 p-0">
                        <div class="signUP-admin-left signIn-admin-left position-relative">
                            <div class="signUP-overlay">
                                <img class="svg signupTop" src="img/svg/signuptop.html" alt="img" />
                                <img class="svg signupBottom" src="img/svg/signupbottom.svg" alt="img" />
                            </div><!-- End: .signUP-overlay  -->
                            <div class="signUP-admin-left__content">
                                <div class="text-capitalize mb-md-30 mb-15 d-flex align-items-center justify-content-md-start justify-content-center">
                                    <a style="width: 82px;" class="wh-36 bg-primary text-white radius-md mr-10 content-center" href="{{url('/')}}">Online</a>
                                    <span class="text-dark">Application</span>
                                </div>
                                <h3>Metas Adventist School</h3>
                            </div><!-- End: .signUP-admin-left__content  -->
                            <div class="signUP-admin-left__img">
                                <img class="img-fluid svg" src="img/svg/signupIllustration.svg" alt="img" />
                            </div><!-- End: .signUP-admin-left__img  -->
                        </div><!-- End: .signUP-admin-left  -->
                    </div><!-- End: .col-xl-4  -->
                    <div class="col-xl-8 col-lg-7 col-md-7 col-sm-8">
                        <div class="signUp-admin-right signIn-admin-right  p-md-40 p-10">
                            <div class="signUp-topbar d-flex align-items-center justify-content-md-end justify-content-center mt-md-0 mb-md-0 mt-20 mb-1">
                                <p class="mb-0">
                                    Don't have an account?
                                    <a href="{{url('register')}}" class="color-primary">
                                        Register
                                    </a>
                                </p>
                            </div><!-- End: .signUp-topbar  -->
                            <div class="row justify-content-center">
                                <div class="col-xl-7 col-lg-8 col-md-12">
                                    <div class="edit-profile mt-md-25 mt-0">
                                        <div class="card border-0">
                                            <div class="card-header border-0  pb-md-15 pb-10 pt-md-20 pt-10 ">
                                                <div class="edit-profile__title">
                                                    <h6>Sign in as <span class="color-primary">Applicant</span></h6>
                                                </div>
                                            </div>
                                            <div class="card-body">
											<form action="{{ route('login') }}" method="post">
											@include('notification.notify')
                                                <div class="edit-profile__body">
                                                    <div class="form-group mb-20">
                                                        <label for="username">Email</label>
                                                        <input type="email" class="form-control  @error('email') is-invalid @enderror" value="{{ old('email') }}" name="email" id="username" placeholder="Email">
														@error('email')
                                   						  <span class="invalid-feedback" role="alert">
                                  					       <strong>{{ $message }}</strong>
                                  						   </span>
                              						    @enderror
													</div>
                                                    <div class="form-group mb-15">
                                                        <label for="password-field">password</label>
                                                        <div class="position-relative">
                                                            <input id="password-field" type="password" class="form-control @error('password') is-invalid @enderror" name="password">
                                                            <div class="fa fa-fw fa-eye-slash text-light fs-16 field-icon toggle-password2"></div>
                                                        </div>
                                                    </div>
                                                    <div style="display: none;" class="signUp-condition signIn-condition">                                                       
                                                        <a href="{{url('forgot-password')}}">forget password</a>
                                                    </div>
                                                    <div class="button-group d-flex pt-1 justify-content-md-start justify-content-center">
                                                        <button class="btn btn-primary btn-default btn-squared mr-15 text-capitalize lh-normal px-50 py-15 signIn-createBtn ">
                                                            sign in
                                                        </button>
                                            
                                                    </div><br>
                                                    <h6 style="text-decoration:underline;color:#5f63f2;">Power your Digital Transformation with BSPL CollegeEdu</h6>
  											        
                                                </div>
												@csrf
											</form>
                                            </div><!-- End: .card-body -->
                                        </div><!-- End: .card -->
                                    </div><!-- End: .edit-profile -->
                                </div><!-- End: .col-xl-5 -->
                            </div>
                        </div><!-- End: .signUp-admin-right  -->
                    </div><!-- End: .col-xl-8  -->
                </div>
            </div>
        </div><!-- End: .signUP-admin  -->

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

    <!-- inject:js-->

    <script src="{{ URL::asset('assets/js/plugins.min.js')}}"></script>

    <script src="{{ URL::asset('assets/js/script.min.js')}}"></script>

    <!-- endinject-->
</body>

</html>