@extends('header')
@section('style')
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/buttons.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/rowReorder.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/responsive.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/select2/dist/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/bootstrap-daterangepicker/daterangepicker.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">

@endsection
@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#"><i class="fa fa-dashboard"></i> Finance</a></li>
          <li><a href="#"><i class="fa fa-dashboard"></i>Library</a></li>
        <li class="active">Return Book</li>
      </ol>
    </section>

    <!-- Main content -->
      <section class="content">
          @include('notification.notify')
    <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title"></h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button style="display:none;" type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">

                  <!-- /.form-group -->
                  <div class="box box-primary">
                           <div class="box-header with-border">
                             <h3 class="box-title">Book Return Details</h3>
                           </div>
                           <div class="box-body">
                <div class="form-group col-md-6">
                  <label  class="col-sm-4 control-label">User Type:</label>
                  <span id="utype">{{$usertype OR ''}}</span>
                </div>
                <div class="form-group col-md-6">
                  <label  class="col-sm-4 control-label">Book Title:</label>
                  <span id="utype" id="booktitle">{{$title OR ''}}</span>
                </div>
                <div class="form-group col-md-6">
                  <label  class="col-sm-4 control-label">User:</label>
                  <span id="utype">{{$name OR ''}} - {{$reg_no OR ''}}</span>
                </div>
                <div class="form-group col-md-6">
                  <label  class="col-sm-4 control-label">Author:</label>
                  <span id="utype">{{$auther OR ''}}</span>
                </div>
                <div class="form-group col-md-6">
                  <label  class="col-sm-4 control-label">Course:</label>
                  <span id="utype">{{$course OR ''}}</span>
                </div>
                <div class="form-group col-md-6">
                  <label  class="col-sm-4 control-label">Batch:</label>
                    <span id="utype">{{$batch OR ''}}</span>
                </div>
                <div class="form-group col-md-6">
                  <label  class="col-sm-4 control-label">Book No:</label>
                    <span id="utype">{{$bookno OR ''}}</span>
                </div>
                <div class="form-group col-md-6">
                  <label  class="col-sm-4 control-label">Return Date:</label>
                    <span id="utype">{{$returndate OR ''}}</span>
                </div>
                <div class="form-group col-md-6">
                  <label  class="col-sm-4 control-label">Fine:</label>
                  <span id="utype">{{$fineamt OR ''}}</span>
                </div>
                <div class="form-group col-md-6">
                  <label  class="col-sm-4 control-label">Remark:</label>
                  <span id="utype">{{$remark OR ''}}</span>
                </div>
                  </div>
                 </div>

                  <!-- /.form-group -->
                </div>

              </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection
