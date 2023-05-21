@extends('header')
@section('style')
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/bootstrap/dist/css/buttons.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/bootstrap/dist/css/rowReorder.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/bootstrap/dist/css/responsive.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/select2/dist/css/select2.min.css') }}">

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
        <li><a href="#"><i class="fa fa-dashboard"></i> Fees </a></li>
        <li class="active">View Fee Sub Category</li>
      </ol>
    </section>
    <section class="content">
        @include('notification.notify')
  <div class="box box-default">
    <!-- Main content -->
    <div class="box-header with-border">
      <h3 class="box-title">View Fee Sub Category</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        <button style="display:none;" type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
      </div>
    </div>

        <div class="row">
          <div class="col-md-12">
            <!-- Custom Tabs -->
            <div class="nav-tabs-custom">
              <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1" data-toggle="tab">View Fee Sub Category </a></li>
                <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                  <div class="box-body">
                    <div class="row">
                      <div class="col-md-12">

                        <!-- /.form-group -->
                        <div class="box box-primary">
                                 <div class="box-header with-border">
                                   <h3 class="box-title">New Fee Sub Category</h3>
                                 </div>
                                 <!-- /.box-header -->
                                 <!-- form start -->
                                 <form role="form" method="post" enctype="multipart/form-data" action="{{url('finance/Fee-subCategory/update')}}">
                                   <div class="box-body">
                                     <div class="col-md-12">
                                     <div class="form-group">
                                       <label for="exampleInputEmail1">Fee Category<span style="color:red;"> *</span></label>
                                       <select class="form-control select2" name="fee_category" style="width: 100%;" required>
                                           <option value="">Select Fee Category</option>
                                      <?php foreach ($fee_category as $fee_category): ?>
                                          <option value="{{ $fee_category->id }}" <?php if($fee_category->id==$data->fee_category) echo "selected"; else""; ?>>{{ $fee_category->fee_category}}</option>
                                      <?php endforeach; ?>

                                    </select>
                                        </div>
                                        <div class="form-group">
                                          <label for="exampleInputEmail1">Fee Sub Category Name<span style="color:red;"> *</span></label>
                                          <input type="text" class="form-control" value="{{$data->sub_category}}" id="subjectname" name="sub_category" placeholder="Fee Sub Category Name" required>
                                          <input type="hidden" class="form-control" value="{{$data->id}}" id="id" name="id" placeholder="id" required>

                                        </div>
                                  <!--      <div class="form-group" style="display:none;">
                                          <label for="exampleInputEmail1">Amount<span style="color:red;"> *</span></label>
                                          <input type="text" class="form-control" id="subjectname" name="amount" placeholder="Amount" required>
                                        </div>-->
                                        <div class="form-group">
                                          <label for="exampleInputEmail1">Fee Type<span style="color:red;"> *</span></label>
                                          <select class="form-control select2" name="fee_type" id="feetype" style="width: 100%;">
                                              <option selected="selected" value="" >Please select</option>
                                              <option value="Annual" <?php if($data->fee_type=="Annual") echo "selected"; else""; ?>>Annual</option>
                                              <option value="Bi-Annual" <?php if($data->fee_type=="Bi-Annual") echo "selected"; else""; ?>>Bi-Annual</option>
                                                <option value="Tri-Annual" <?php if($data->fee_type=="Tri-Annual") echo "selected"; else""; ?>>Tri-Annual</option>
                                                  <option value="Quaterly" <?php if($data->fee_type=="Quaterly") echo "selected"; else""; ?>>Quaterly</option>
                                                    <option value="Monthly" <?php if($data->fee_type=="Monthly") echo "selected"; else""; ?>>Monthly</option>
                                                      <option value="One-Time" <?php if($data->fee_type=="One-Time") echo "selected"; else""; ?>>One-Time</option>
                                       </select>
                                     </div>


                                   </div>

                                 </div>

                                   <div class="box-footer">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                  <!--  <input type="submit" class="btn btn-primary" name="submit" value="Save">-->
                                   </div>
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                 </form>
                               </div>
                      </div>
            </div>
          </div>
        </div>


              </div>
              <!-- /.tab-content -->
            </div>
            <!-- nav-tabs-custom -->

    </section>
    <!-- /.content -->
  </div>
  </div>
  </div>
  <!-- /.content-wrapper -->

@endsection
{{--External Style Section--}}
@section('script')
<script src="{{ URL::asset('assets/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
