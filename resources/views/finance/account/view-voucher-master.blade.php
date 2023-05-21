@extends('header')
@section('style')
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
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
          <li><a href="#"><i class="fa fa-dashboard"></i>Accounts</a></li>
        <li class="active">Voucher Master</li>
      </ol>
    </section>

    <!-- Main content -->
      <section class="content">
          @include('notification.notify')
    <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Voucher Master</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button style="display:none;" type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-5">

                  <!-- /.form-group -->
                  <div class="box box-primary">
                           <div class="box-header with-border">
                             <h3 class="box-title">View Voucher Master</h3>
                           </div>
                           <!-- /.box-header -->
                           <!-- form start -->
                           <form role="form" method="post" enctype="multipart/form-data" action="{{url('finance/account/voucher-master/update')}}">
                          <div class="box-body">
                            <div class="form-group">
                              <label for="exampleInputEmail1">Voucher Master<span style="color:red;"> *</span></label>
                              <input type="text" class="form-control" id="voucher_master" value="{{$voucher_master OR ''}}" name="voucher_master" placeholder="Voucher Master" required>
                              <input type="hidden" class="form-control" id="voucher_master" value="{{$id OR ''}}" name="id" placeholder="Voucher Master" required>
                            </div>
                            <div class="form-group">
                              <label for="exampleInputEmail1">Credit/Debit<span style="color:red;"> *</span></label>
                              <select class="form-control select2" name="crdr" style="width: 100%;" required>
                                  <option value="" selected="selected">Please select</option>
                                  <option value="Cr" @if($crdr=='Cr') selected @endif>Cr.</option>
                                  <option value="Dr" @if($crdr=='Dr') selected @endif>Dr.</option>
                           </select>
                         </div>
                          </div>
                             <!-- /.box-body -->

                             <div class="box-footer">
                               <button type="submit" class="btn btn-primary">Update</button>
                             </div>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                           </form>
                         </div>

                  <!-- /.form-group -->
                </div>


              </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection
{{--External Style Section--}}
@section('script')
@endsection
<!-- ./wrapper -->
