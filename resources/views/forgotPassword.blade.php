<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin | Reset Password</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->

  <link rel="stylesheet" href="{{ URL::asset('assets/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ URL::asset('assets/bower_components/font-awesome/css/font-awesome.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ URL::asset('assets/bower_components/Ionicons/css/ionicons.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ URL::asset('assets/dist/css/AdminLTE.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ URL::asset('assets/plugins/iCheck/square/blue.css') }}">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<style media="screen">
  .logingb{
    background-image: url('assets/images/back2.png');
  }
</style>
</head>
<body class="hold-transition login-page logingb" style="overflow: hidden;">
<div class="login-box">
  <div class="login-logo">
    <a href="{{url('/')}}"><img src="assets/images/logo_light.png" style="height: 60px;" /></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body" style="opacity: 50;border-radius: 9px 2px;">
    <p class="login-box-msg">Reset password</p>

    <form>

      <div class="form-group has-feedback">
        <input id="username" type="text" class="form-control {{ $errors->has('username') ? ' is-invalid' : '' }}" placeholder="User Name" value="{{ old('username') }}" required autofocus name="username">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" id="_url" value="{{url('/')}}">
        <!-- /.col -->
        <div class="col-xs-12">
          <button type="submit" id="change" class="btn btn-primary btn-block btn-flat">Update Password</button>
            <br>
            <br>
          <span style="color:red;">Steps :</span>
          <ul>
          <li>Enter Valid User Name</li>
          <li>Click on Update Password Button</li>
          <li>You wil get new password in your registered Mobile No.</li>
          <li>If you don't have registered Mobile No., Please Contact Admin.</li>
          </ul>
        </div>
        <!-- /.col -->

      </div>
    </form>

    <!-- /.social-auth-links -->

    <a href="{{url('/')}}">Login</a><br><br>
     @include('notification.notify')
   </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="{{ URL::asset('assets/bower_components/jquery/dist/jquery.min.js') }}"></script>
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>-->
<!-- Bootstrap 3.3.7 -->
<script src="{{ URL::asset('assets/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- iCheck -->
<script src="{{ URL::asset('assets/plugins/iCheck/icheck.min.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/jquery/dist/bootbox.min.js') }}"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
<script>
  $(document).ready(function () {
   
            /*For Delete Application Info*/
            $("#change").prop('disabled', true);
            $("#username").blur(function (e) {
                e.preventDefault();
              //  alert(this.value);
                var id = this.id;
                var dataString = 'username=' + this.value;
                //alert($('input[name="_token"]').attr('value'));
               var _url = $("#_url").val();
                // alert(_url);
               $.ajax
               ({
                   type: "POST",
                   url: _url + '/checkuserhas',
                   data: dataString,
                   headers: {
                "X-CSRF-TOKEN": $('input[name="_token"]').attr('value')
            },
                   cache: false,
                   success: function ( data ) {
                       if(data=="0"){
                        bootbox.alert("User-name not exits.Please enter valid user-name.");                       
                       }else{
                        $("#change").prop('disabled', false);
                       }
                   }
               });
               
            });

            $("#change").click(function (e) {
                e.preventDefault();
              //  alert(this.value);
                var id = this.id;
                var dataString = 'username=' + $("#username").val();
                //alert($('input[name="_token"]').attr('value'));
               var _url = $("#_url").val();
                // alert(_url);
               $.ajax
               ({
                   type: "POST",
                   url: _url + '/update_password',
                   data: dataString,
                   headers: {
                "X-CSRF-TOKEN": $('input[name="_token"]').attr('value')
            },
                   cache: false,
                   success: function ( data ) {
                      // alert(data);
                       if(data=="1"){
                        bootbox.alert("Updated password send to your Registered Mobile No.Please Check."); 
                       }else if(data=="3"){
                        bootbox.alert("Something went worng.Please try again.");
                       }else if(data=="2"){
                        bootbox.alert("Not Found Registered Mobile No.Please Contact Admin.");                       
                       }else{
                        $("#change").prop('disabled', false);
                       }
                   }
               });
               
            });

        });

</script>
</body>

</html>
