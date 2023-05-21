@extends('header')
@section('style')
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/bootstrap/dist/css/buttons.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/bootstrap/dist/css/rowReorder.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/bootstrap/dist/css/responsive.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/bootstrap-daterangepicker/daterangepicker.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/select2/dist/css/select2.min.css') }}">

@endsection
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Dashboard
      <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="#"><i class="fa fa-dashboard"></i> Setting </a></li>
      <li><a href="#"><i class="fa fa-dashboard"></i> User Password Update  </a></li>

    </ol>
  </section>
  <section class="content">
      @include('notification.notify')
<div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">User Password</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button style="display:none;" type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>

   <div class="box box-warning">
                    <div class="box-header with-border">
                                <h3 class="box-title">Update Password</h3>
                              </div>
                              <div class="box-body">
               <div class="row">
           <div class="col-md-12">
         <div class="col-md-6">
            <form role="form" method="post" enctype="multipart/form-data" action="{{url('user/password/update/updating')}}">
              <div class="form-group">
               <label for="exampleInputEmail1">User Name</label>
               <input type="text" class="form-control" id="username" value="" name="username" placeholder="User Id" required autocomplete="off">


             </div>
              <div class="form-group">
               <label for="exampleInputEmail1">New Password</label>
               <input type="password" class="form-control" id="npassword" name="npassword" placeholder="New Password" required autocomplete="off">
             </div>
             <div class="form-group">
               <label for="exampleInputEmail1">Confirm Password</label>
               <input type="password" class="form-control" id="cpassword"  name="cpassword" placeholder="Confirm Password" required autocomplete="off">
             </div>
             <div class="box-footer">
               <button type="submit" id="up" class="btn btn-primary">Update Password</button>
             </div>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
          </form>
        </div>
         </div>
       </div>
       </div>


 </div>
 </div>
</section>
</div>
  @endsection
  {{--External Style Section--}}
  @section('script')
  <script src="{{ URL::asset('assets/bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
  <script src="{{ URL::asset('assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
  <script src="{{ URL::asset('assets/bower_components/select2/dist/js/select2.full.min.js') }}"></script>

  <script>
    $(document).ready(function () {
      $("#up").click(function (e){
        if($("#npassword").val()==$("#cpassword").val()){
          return true;
        }else{
          alert("Password not matched");
          return false;
        }
      });
    });
  </script>
@endsection
