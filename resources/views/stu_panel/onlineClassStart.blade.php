@extends('stu_panel.main-header')
@section('style')
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/buttons.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/rowReorder.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/responsive.dataTables.min.css') }}">

@endsection

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Welcome
      <small>Student</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Online Classes</li>
    </ol>
  </section>
  <section class="content">
      @include('notification.notify')
      <div class="box box-default">
        <!-- Main content -->
        <div class="box-header with-border">
          <h3 class="box-title">Online Class Schedules  </h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button style="display:none;" type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>


        <div class="row">
          <div class="col-md-12">
                        <div class="box-body" id="reports">
        <div class="col-md-12">
<iframe referrerpolicy="no-referrer" X-Frame-Options="sameorigin" width="100%" height="100%" src="https://www.google.com?output=embed" title="W3Schools Free Online Web Tutorials"></iframe>

        </div>
</div>
</div>
      </div>
      </div>
</section>
</div>
</div>
@endsection

@section('script')
@endsection
