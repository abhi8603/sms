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
        <li class="active">Fee Sub Category</li>
      </ol>
    </section>
    <section class="content">
        @include('notification.notify')
  <div class="box box-default">
    <!-- Main content -->
    <div class="box-header with-border">
      <h3 class="box-title">Fee Sub Category</h3>

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
                <li class="active"><a href="#tab_1" data-toggle="tab">Fee Sub Category </a></li>
                <li><a href="#tab_2" data-toggle="tab">List</a></li>

                <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                  <div class="box-body">
                    <div class="row">
                      <div class="col-md-8">

                        <!-- /.form-group -->
                        <div class="box box-primary">
                                 <div class="box-header with-border">
                                   <h3 class="box-title">New Fee Sub Category</h3>
                                 </div>
                                 <!-- /.box-header -->
                                 <!-- form start -->
                                 <form role="form" method="post" enctype="multipart/form-data" action="{{url('finance/Fee-SubCategory/add')}}">
                                   <div class="box-body">
                                     <div class="col-md-12">
                                     <div class="form-group">
                                       <label for="exampleInputEmail1">Fee Category<span style="color:red;"> *</span></label>
                                       <select class="form-control select2" name="startyear" style="width: 100%;" required>
                                           <option value="" selected="selected">Select Fee Category</option>
                                      <?php foreach ($fee_category as $fee_category): ?>
                                          <option value="{{ $fee_category->id }}">{{ $fee_category->fee_category}}</option>
                                      <?php endforeach; ?>

                                    </select>
                                        </div>
                                        <div class="form-group">
                                          <label for="exampleInputEmail1">Fee Sub Category Name<span style="color:red;"> *</span></label>
                                          <input type="text" class="form-control" id="subjectname" name="subcategoryname" placeholder="Fee Sub Category Name">
                                        </div>
                                    <!--    <div class="form-group">
                                          <label for="exampleInputEmail1">Amount<span style="color:red;"> *</span></label>
                                          <input type="text" class="form-control" id="subjectname" name="amount" placeholder="Amount">
                                        </div>-->
                                        <div class="form-group">
                                          <label for="exampleInputEmail1">Fee Type<span style="color:red;"> *</span></label>
                                          <select class="form-control select2" name="feetype" id="feetype" style="width: 100%;">
                                              <option selected="selected" value="" >Please select</option>
                                              <option value="Annual">Annual</option>
                                              <option value="Bi-Annual" >Bi-Annual</option>
                                                <option value="Tri-Annual">Tri-Annual</option>
                                                  <option value="Quaterly">Quaterly</option>
                                                    <option value="Monthly">Monthly</option>
                                                      <option value="One-Time">One-Time</option>
                                       </select>
                                     </div>


                                   </div>

                                 </div>

                                 <div class="box box-primary" id="fee">
                                          <div class="box-header with-border">
                                            <h3 class="box-title">Fee Dates</h3>
                                          </div>
                                          <div class="box-body">
                                            <div class="col-md-12">
                                              <div id="onetime">
                                                <div class="form-group col-md-4">
                                                                <label>Start Date</label>
                                                                <div class="input-group date">
                                                                  <div class="input-group-addon">
                                                                    <i class="fa fa-calendar"></i>
                                                                  </div>
                                                                  <input type="text" class="form-control pull-right dob" id="dob" name="dob[]" required>
                                                                </div>
                                                                <!-- /.input group -->
                                                              </div>
                                                              <div class="form-group col-md-4">
                                                                              <label>Due Date</label>
                                                                              <div class="input-group date">
                                                                                <div class="input-group-addon">
                                                                                  <i class="fa fa-calendar"></i>
                                                                                </div>
                                                                                <input type="text" class="form-control pull-right dob" id="dob" name="dob[]" required>
                                                                              </div>
                                                                              <!-- /.input group -->
                                                              </div>
                                                              <div class="form-group col-md-4">
                                                                              <label>End Date</label>
                                                                              <div class="input-group date">
                                                                                <div class="input-group-addon">
                                                                                  <i class="fa fa-calendar"></i>
                                                                                </div>
                                                                                <input type="text" class="form-control pull-right dob" id="dob" name="dob[]" required>
                                                                              </div>
                                                                              <!-- /.input group -->
                                                              </div>
                                              </div>
                                              <div id="annual">
                                                <div class="form-group col-md-4">
                                                                <label>Start Date</label>
                                                                <div class="input-group date">
                                                                  <div class="input-group-addon">
                                                                    <i class="fa fa-calendar"></i>
                                                                  </div>
                                                                  <input type="text" class="form-control pull-right dob" id="dob" name="dob[]" required>
                                                                </div>
                                                                <!-- /.input group -->
                                                              </div>
                                                              <div class="form-group col-md-4">
                                                                              <label>Due Date</label>
                                                                              <div class="input-group date">
                                                                                <div class="input-group-addon">
                                                                                  <i class="fa fa-calendar"></i>
                                                                                </div>
                                                                                <input type="text" class="form-control pull-right dob" id="dob" name="dob[]" required>
                                                                              </div>
                                                                              <!-- /.input group -->
                                                              </div>
                                                              <div class="form-group col-md-4">
                                                                              <label>End Date</label>
                                                                              <div class="input-group date">
                                                                                <div class="input-group-addon">
                                                                                  <i class="fa fa-calendar"></i>
                                                                                </div>
                                                                                <input type="text" class="form-control pull-right dob" id="dob" name="dob[]" required>
                                                                              </div>
                                                                              <!-- /.input group -->
                                                              </div>
                                              </div>
                                              <div id="biannual">
                                                  <div class="form-group col-md-4">
                                                                  <label>Start Date</label>
                                                                  <div class="input-group date">
                                                                    <div class="input-group-addon">
                                                                      <i class="fa fa-calendar"></i>
                                                                    </div>
                                                                    <input type="text" class="form-control pull-right dob" id="dob" name="dob[]" required>
                                                                  </div>
                                                                  <!-- /.input group -->
                                                  </div>
                                                  <div class="form-group col-md-4">
                                                                  <label>Due Date</label>
                                                                  <div class="input-group date">
                                                                    <div class="input-group-addon">
                                                                      <i class="fa fa-calendar"></i>
                                                                    </div>
                                                                    <input type="text" class="form-control pull-right dob" id="dob" name="dob[]" required>
                                                                  </div>
                                                                  <!-- /.input group -->
                                                  </div>
                                                  <div class="form-group col-md-4">
                                                                  <label>End Date</label>
                                                                  <div class="input-group date">
                                                                    <div class="input-group-addon">
                                                                      <i class="fa fa-calendar"></i>
                                                                    </div>
                                                                    <input type="text" class="form-control pull-right dob" id="dob" name="dob[]" required>
                                                                  </div>
                                                                  <!-- /.input group -->
                                                  </div>
                                                  <div class="form-group col-md-4">
                                                                  <label>Start Date</label>
                                                                  <div class="input-group date">
                                                                    <div class="input-group-addon">
                                                                      <i class="fa fa-calendar"></i>
                                                                    </div>
                                                                    <input type="text" class="form-control pull-right dob" id="dob" name="dob[]" required>
                                                                  </div>
                                                                  <!-- /.input group -->
                                                  </div>
                                                  <div class="form-group col-md-4">
                                                                  <label>Du Date</label>
                                                                  <div class="input-group date">
                                                                    <div class="input-group-addon">
                                                                      <i class="fa fa-calendar"></i>
                                                                    </div>
                                                                    <input type="text" class="form-control pull-right dob" id="dob" name="dob[]" required>
                                                                  </div>
                                                                  <!-- /.input group -->
                                                  </div>
                                                  <div class="form-group col-md-4">
                                                                  <label>End Date</label>
                                                                  <div class="input-group date">
                                                                    <div class="input-group-addon">
                                                                      <i class="fa fa-calendar"></i>
                                                                    </div>
                                                                    <input type="text" class="form-control pull-right dob" id="dob" name="dob[]" required>
                                                                  </div>
                                                                  <!-- /.input group -->
                                                  </div>
                                                </div>
                                              <div id="triannual">
                                                  <div class="form-group col-md-4">
                                                                  <label>Start Date</label>
                                                                  <div class="input-group date">
                                                                    <div class="input-group-addon">
                                                                      <i class="fa fa-calendar"></i>
                                                                    </div>
                                                                    <input type="text" class="form-control pull-right dob" id="dob" name="dob[]" required>
                                                                  </div>
                                                                  <!-- /.input group -->
                                                  </div>
                                                  <div class="form-group col-md-4">
                                                                  <label>Due Date</label>
                                                                  <div class="input-group date">
                                                                    <div class="input-group-addon">
                                                                      <i class="fa fa-calendar"></i>
                                                                    </div>
                                                                    <input type="text" class="form-control pull-right dob" id="dob" name="dob[]" required>
                                                                  </div>
                                                                  <!-- /.input group -->
                                                  </div>
                                                  <div class="form-group col-md-4">
                                                                  <label>End Date</label>
                                                                  <div class="input-group date">
                                                                    <div class="input-group-addon">
                                                                      <i class="fa fa-calendar"></i>
                                                                    </div>
                                                                    <input type="text" class="form-control pull-right dob" id="dob" name="dob[]" required>
                                                                  </div>
                                                                  <!-- /.input group -->
                                                  </div>
                                                  <div class="form-group col-md-4">
                                                                  <label>Start Date</label>
                                                                  <div class="input-group date">
                                                                    <div class="input-group-addon">
                                                                      <i class="fa fa-calendar"></i>
                                                                    </div>
                                                                    <input type="text" class="form-control pull-right dob" id="dob" name="dob[]" required>
                                                                  </div>
                                                                  <!-- /.input group -->
                                                  </div>
                                                  <div class="form-group col-md-4">
                                                                  <label>Du Date</label>
                                                                  <div class="input-group date">
                                                                    <div class="input-group-addon">
                                                                      <i class="fa fa-calendar"></i>
                                                                    </div>
                                                                    <input type="text" class="form-control pull-right dob" id="dob" name="dob[]" required>
                                                                  </div>
                                                                  <!-- /.input group -->
                                                  </div>
                                                  <div class="form-group col-md-4">
                                                                  <label>End Date</label>
                                                                  <div class="input-group date">
                                                                    <div class="input-group-addon">
                                                                      <i class="fa fa-calendar"></i>
                                                                    </div>
                                                                    <input type="text" class="form-control pull-right dob" id="dob" name="dob[]" required>
                                                                  </div>
                                                                  <!-- /.input group -->
                                                  </div>
                                                  <div class="form-group col-md-4">
                                                                  <label>Start Date</label>
                                                                  <div class="input-group date">
                                                                    <div class="input-group-addon">
                                                                      <i class="fa fa-calendar"></i>
                                                                    </div>
                                                                    <input type="text" class="form-control pull-right dob" id="dob" name="dob[]" required>
                                                                  </div>
                                                                  <!-- /.input group -->
                                                  </div>
                                                  <div class="form-group col-md-4">
                                                                  <label>Du Date</label>
                                                                  <div class="input-group date">
                                                                    <div class="input-group-addon">
                                                                      <i class="fa fa-calendar"></i>
                                                                    </div>
                                                                    <input type="text" class="form-control pull-right dob" id="dob" name="dob[]" required>
                                                                  </div>
                                                                  <!-- /.input group -->
                                                  </div>
                                                  <div class="form-group col-md-4">
                                                                  <label>End Date</label>
                                                                  <div class="input-group date">
                                                                    <div class="input-group-addon">
                                                                      <i class="fa fa-calendar"></i>
                                                                    </div>
                                                                    <input type="text" class="form-control pull-right dob" id="dob" name="dob[]" required>
                                                                  </div>
                                                                  <!-- /.input group -->
                                                  </div>
                                                </div>
                                              <div id="quaterly">
                                                  <div class="form-group col-md-4">
                                                                  <label>Start Date</label>
                                                                  <div class="input-group date">
                                                                    <div class="input-group-addon">
                                                                      <i class="fa fa-calendar"></i>
                                                                    </div>
                                                                    <input type="text" class="form-control pull-right dob" id="dob" name="dob[]" required>
                                                                  </div>
                                                                  <!-- /.input group -->
                                                  </div>
                                                  <div class="form-group col-md-4">
                                                                  <label>Due Date</label>
                                                                  <div class="input-group date">
                                                                    <div class="input-group-addon">
                                                                      <i class="fa fa-calendar"></i>
                                                                    </div>
                                                                    <input type="text" class="form-control pull-right dob" id="dob" name="dob[]" required>
                                                                  </div>
                                                                  <!-- /.input group -->
                                                  </div>
                                                  <div class="form-group col-md-4">
                                                                  <label>End Date</label>
                                                                  <div class="input-group date">
                                                                    <div class="input-group-addon">
                                                                      <i class="fa fa-calendar"></i>
                                                                    </div>
                                                                    <input type="text" class="form-control pull-right dob" id="dob" name="dob[]" required>
                                                                  </div>
                                                                  <!-- /.input group -->
                                                  </div>
                                                  <div class="form-group col-md-4">
                                                                  <label>Start Date</label>
                                                                  <div class="input-group date">
                                                                    <div class="input-group-addon">
                                                                      <i class="fa fa-calendar"></i>
                                                                    </div>
                                                                    <input type="text" class="form-control pull-right dob" id="dob" name="dob[]" required>
                                                                  </div>
                                                                  <!-- /.input group -->
                                                  </div>
                                                  <div class="form-group col-md-4">
                                                                  <label>Du Date</label>
                                                                  <div class="input-group date">
                                                                    <div class="input-group-addon">
                                                                      <i class="fa fa-calendar"></i>
                                                                    </div>
                                                                    <input type="text" class="form-control pull-right dob" id="dob" name="dob[]" required>
                                                                  </div>
                                                                  <!-- /.input group -->
                                                  </div>
                                                  <div class="form-group col-md-4">
                                                                  <label>End Date</label>
                                                                  <div class="input-group date">
                                                                    <div class="input-group-addon">
                                                                      <i class="fa fa-calendar"></i>
                                                                    </div>
                                                                    <input type="text" class="form-control pull-right dob" id="dob" name="dob[]" required>
                                                                  </div>
                                                                  <!-- /.input group -->
                                                  </div>
                                                  <div class="form-group col-md-4">
                                                                  <label>Start Date</label>
                                                                  <div class="input-group date">
                                                                    <div class="input-group-addon">
                                                                      <i class="fa fa-calendar"></i>
                                                                    </div>
                                                                    <input type="text" class="form-control pull-right dob" id="dob" name="dob[]" required>
                                                                  </div>
                                                                  <!-- /.input group -->
                                                  </div>
                                                  <div class="form-group col-md-4">
                                                                  <label>Du Date</label>
                                                                  <div class="input-group date">
                                                                    <div class="input-group-addon">
                                                                      <i class="fa fa-calendar"></i>
                                                                    </div>
                                                                    <input type="text" class="form-control pull-right dob" id="dob" name="dob[]" required>
                                                                  </div>
                                                                  <!-- /.input group -->
                                                  </div>
                                                  <div class="form-group col-md-4">
                                                                  <label>End Date</label>
                                                                  <div class="input-group date">
                                                                    <div class="input-group-addon">
                                                                      <i class="fa fa-calendar"></i>
                                                                    </div>
                                                                    <input type="text" class="form-control pull-right dob" id="dob" name="dob[]" required>
                                                                  </div>
                                                                  <!-- /.input group -->
                                                  </div>
                                                  <div class="form-group col-md-4">
                                                                  <label>Start Date</label>
                                                                  <div class="input-group date">
                                                                    <div class="input-group-addon">
                                                                      <i class="fa fa-calendar"></i>
                                                                    </div>
                                                                    <input type="text" class="form-control pull-right dob" id="dob" name="dob[]" required>
                                                                  </div>
                                                                  <!-- /.input group -->
                                                  </div>
                                                  <div class="form-group col-md-4">
                                                                  <label>Du Date</label>
                                                                  <div class="input-group date">
                                                                    <div class="input-group-addon">
                                                                      <i class="fa fa-calendar"></i>
                                                                    </div>
                                                                    <input type="text" class="form-control pull-right dob" id="dob" name="dob[]" required>
                                                                  </div>
                                                                  <!-- /.input group -->
                                                  </div>
                                                  <div class="form-group col-md-4">
                                                                  <label>End Date</label>
                                                                  <div class="input-group date">
                                                                    <div class="input-group-addon">
                                                                      <i class="fa fa-calendar"></i>
                                                                    </div>
                                                                    <input type="text" class="form-control pull-right dob" id="dob" name="dob[]" required>
                                                                  </div>
                                                                  <!-- /.input group -->
                                                  </div>
                                                </div>
                                              <div id="Monthly">
                                                  <div class="form-group col-md-4">
                                                                  <label>Start Date</label>
                                                                  <div class="input-group date">
                                                                    <div class="input-group-addon">
                                                                      <i class="fa fa-calendar"></i>
                                                                    </div>
                                                                    <input type="text" class="form-control pull-right dob" id="dob" name="dob[]" required>
                                                                  </div>
                                                                  <!-- /.input group -->
                                                  </div>
                                                  <div class="form-group col-md-4">
                                                                  <label>Due Date</label>
                                                                  <div class="input-group date">
                                                                    <div class="input-group-addon">
                                                                      <i class="fa fa-calendar"></i>
                                                                    </div>
                                                                    <input type="text" class="form-control pull-right dob" id="dob" name="dob[]" required>
                                                                  </div>
                                                                  <!-- /.input group -->
                                                  </div>
                                                  <div class="form-group col-md-4">
                                                                  <label>End Date</label>
                                                                  <div class="input-group date">
                                                                    <div class="input-group-addon">
                                                                      <i class="fa fa-calendar"></i>
                                                                    </div>
                                                                    <input type="text" class="form-control pull-right dob" id="dob" name="dob[]" required>
                                                                  </div>
                                                                  <!-- /.input group -->
                                                  </div>
                                                  <div class="form-group col-md-4">
                                                                  <label>Start Date</label>
                                                                  <div class="input-group date">
                                                                    <div class="input-group-addon">
                                                                      <i class="fa fa-calendar"></i>
                                                                    </div>
                                                                    <input type="text" class="form-control pull-right dob" id="dob" name="dob[]" required>
                                                                  </div>
                                                                  <!-- /.input group -->
                                                  </div>
                                                  <div class="form-group col-md-4">
                                                                  <label>Du Date</label>
                                                                  <div class="input-group date">
                                                                    <div class="input-group-addon">
                                                                      <i class="fa fa-calendar"></i>
                                                                    </div>
                                                                    <input type="text" class="form-control pull-right dob" id="dob" name="dob[]" required>
                                                                  </div>
                                                                  <!-- /.input group -->
                                                  </div>
                                                  <div class="form-group col-md-4">
                                                                  <label>End Date</label>
                                                                  <div class="input-group date">
                                                                    <div class="input-group-addon">
                                                                      <i class="fa fa-calendar"></i>
                                                                    </div>
                                                                    <input type="text" class="form-control pull-right dob" id="dob" name="dob[]" required>
                                                                  </div>
                                                                  <!-- /.input group -->
                                                  </div>
                                                  <div class="form-group col-md-4">
                                                                  <label>Start Date</label>
                                                                  <div class="input-group date">
                                                                    <div class="input-group-addon">
                                                                      <i class="fa fa-calendar"></i>
                                                                    </div>
                                                                    <input type="text" class="form-control pull-right dob" id="dob" name="dob[]" required>
                                                                  </div>
                                                                  <!-- /.input group -->
                                                  </div>
                                                  <div class="form-group col-md-4">
                                                                  <label>Du Date</label>
                                                                  <div class="input-group date">
                                                                    <div class="input-group-addon">
                                                                      <i class="fa fa-calendar"></i>
                                                                    </div>
                                                                    <input type="text" class="form-control pull-right dob" id="dob" name="dob[]" required>
                                                                  </div>
                                                                  <!-- /.input group -->
                                                  </div>
                                                  <div class="form-group col-md-4">
                                                                  <label>End Date</label>
                                                                  <div class="input-group date">
                                                                    <div class="input-group-addon">
                                                                      <i class="fa fa-calendar"></i>
                                                                    </div>
                                                                    <input type="text" class="form-control pull-right dob" id="dob" name="dob[]" required>
                                                                  </div>
                                                                  <!-- /.input group -->
                                                  </div>
                                                  <div class="form-group col-md-4">
                                                                  <label>Start Date</label>
                                                                  <div class="input-group date">
                                                                    <div class="input-group-addon">
                                                                      <i class="fa fa-calendar"></i>
                                                                    </div>
                                                                    <input type="text" class="form-control pull-right dob" id="dob" name="dob[]" required>
                                                                  </div>
                                                                  <!-- /.input group -->
                                                  </div>
                                                  <div class="form-group col-md-4">
                                                                  <label>Du Date</label>
                                                                  <div class="input-group date">
                                                                    <div class="input-group-addon">
                                                                      <i class="fa fa-calendar"></i>
                                                                    </div>
                                                                    <input type="text" class="form-control pull-right dob" id="dob" name="dob[]" required>
                                                                  </div>
                                                                  <!-- /.input group -->
                                                  </div>
                                                  <div class="form-group col-md-4">
                                                                  <label>End Date</label>
                                                                  <div class="input-group date">
                                                                    <div class="input-group-addon">
                                                                      <i class="fa fa-calendar"></i>
                                                                    </div>
                                                                    <input type="text" class="form-control pull-right dob" id="dob" name="dob[]" required>
                                                                  </div>
                                                                  <!-- /.input group -->
                                                  </div>
                                                  <div class="form-group col-md-4">
                                                                  <label>Start Date</label>
                                                                  <div class="input-group date">
                                                                    <div class="input-group-addon">
                                                                      <i class="fa fa-calendar"></i>
                                                                    </div>
                                                                    <input type="text" class="form-control pull-right dob" id="dob" name="dob[]" required>
                                                                  </div>
                                                                  <!-- /.input group -->
                                                  </div>
                                                  <div class="form-group col-md-4">
                                                                  <label>Du Date</label>
                                                                  <div class="input-group date">
                                                                    <div class="input-group-addon">
                                                                      <i class="fa fa-calendar"></i>
                                                                    </div>
                                                                    <input type="text" class="form-control pull-right dob" id="dob" name="dob[]" required>
                                                                  </div>
                                                                  <!-- /.input group -->
                                                  </div>
                                                  <div class="form-group col-md-4">
                                                                  <label>End Date</label>
                                                                  <div class="input-group date">
                                                                    <div class="input-group-addon">
                                                                      <i class="fa fa-calendar"></i>
                                                                    </div>
                                                                    <input type="text" class="form-control pull-right dob" id="dob" name="dob[]" required>
                                                                  </div>
                                                                  <!-- /.input group -->
                                                  </div>
                                                  <div class="form-group col-md-4">
                                                                  <label>Start Date</label>
                                                                  <div class="input-group date">
                                                                    <div class="input-group-addon">
                                                                      <i class="fa fa-calendar"></i>
                                                                    </div>
                                                                    <input type="text" class="form-control pull-right dob" id="dob" name="dob[]" required>
                                                                  </div>
                                                                  <!-- /.input group -->
                                                  </div>
                                                  <div class="form-group col-md-4">
                                                                  <label>Du Date</label>
                                                                  <div class="input-group date">
                                                                    <div class="input-group-addon">
                                                                      <i class="fa fa-calendar"></i>
                                                                    </div>
                                                                    <input type="text" class="form-control pull-right dob" id="dob" name="dob[]" required>
                                                                  </div>
                                                                  <!-- /.input group -->
                                                  </div>
                                                  <div class="form-group col-md-4">
                                                                  <label>End Date</label>
                                                                  <div class="input-group date">
                                                                    <div class="input-group-addon">
                                                                      <i class="fa fa-calendar"></i>
                                                                    </div>
                                                                    <input type="text" class="form-control pull-right dob" id="dob" name="dob[]" required>
                                                                  </div>
                                                                  <!-- /.input group -->
                                                  </div>
                                                  <div class="form-group col-md-4">
                                                                  <label>Start Date</label>
                                                                  <div class="input-group date">
                                                                    <div class="input-group-addon">
                                                                      <i class="fa fa-calendar"></i>
                                                                    </div>
                                                                    <input type="text" class="form-control pull-right dob" id="dob" name="dob[]" required>
                                                                  </div>
                                                                  <!-- /.input group -->
                                                  </div>
                                                  <div class="form-group col-md-4">
                                                                  <label>Du Date</label>
                                                                  <div class="input-group date">
                                                                    <div class="input-group-addon">
                                                                      <i class="fa fa-calendar"></i>
                                                                    </div>
                                                                    <input type="text" class="form-control pull-right dob" id="dob" name="dob[]" required>
                                                                  </div>
                                                                  <!-- /.input group -->
                                                  </div>
                                                  <div class="form-group col-md-4">
                                                                  <label>End Date</label>
                                                                  <div class="input-group date">
                                                                    <div class="input-group-addon">
                                                                      <i class="fa fa-calendar"></i>
                                                                    </div>
                                                                    <input type="text" class="form-control pull-right dob" id="dob" name="dob[]" required>
                                                                  </div>
                                                                  <!-- /.input group -->
                                                  </div>
                                                  <div class="form-group col-md-4">
                                                                  <label>Start Date</label>
                                                                  <div class="input-group date">
                                                                    <div class="input-group-addon">
                                                                      <i class="fa fa-calendar"></i>
                                                                    </div>
                                                                    <input type="text" class="form-control pull-right dob" id="dob" name="dob[]" required>
                                                                  </div>
                                                                  <!-- /.input group -->
                                                  </div>
                                                  <div class="form-group col-md-4">
                                                                  <label>Du Date</label>
                                                                  <div class="input-group date">
                                                                    <div class="input-group-addon">
                                                                      <i class="fa fa-calendar"></i>
                                                                    </div>
                                                                    <input type="text" class="form-control pull-right dob" id="dob" name="dob[]" required>
                                                                  </div>
                                                                  <!-- /.input group -->
                                                  </div>
                                                  <div class="form-group col-md-4">
                                                                  <label>End Date</label>
                                                                  <div class="input-group date">
                                                                    <div class="input-group-addon">
                                                                      <i class="fa fa-calendar"></i>
                                                                    </div>
                                                                    <input type="text" class="form-control pull-right dob" id="dob" name="dob[]" required>
                                                                  </div>
                                                                  <!-- /.input group -->
                                                  </div>
                                                  <div class="form-group col-md-4">
                                                                  <label>Start Date</label>
                                                                  <div class="input-group date">
                                                                    <div class="input-group-addon">
                                                                      <i class="fa fa-calendar"></i>
                                                                    </div>
                                                                    <input type="text" class="form-control pull-right dob" id="dob" name="dob[]" required>
                                                                  </div>
                                                                  <!-- /.input group -->
                                                  </div>
                                                  <div class="form-group col-md-4">
                                                                  <label>Du Date</label>
                                                                  <div class="input-group date">
                                                                    <div class="input-group-addon">
                                                                      <i class="fa fa-calendar"></i>
                                                                    </div>
                                                                    <input type="text" class="form-control pull-right dob" id="dob" name="dob[]" required>
                                                                  </div>
                                                                  <!-- /.input group -->
                                                  </div>
                                                  <div class="form-group col-md-4">
                                                                  <label>End Date</label>
                                                                  <div class="input-group date">
                                                                    <div class="input-group-addon">
                                                                      <i class="fa fa-calendar"></i>
                                                                    </div>
                                                                    <input type="text" class="form-control pull-right dob" id="dob" name="dob[]" required>
                                                                  </div>
                                                                  <!-- /.input group -->
                                                  </div>
                                                  <div class="form-group col-md-4">
                                                                  <label>Start Date</label>
                                                                  <div class="input-group date">
                                                                    <div class="input-group-addon">
                                                                      <i class="fa fa-calendar"></i>
                                                                    </div>
                                                                    <input type="text" class="form-control pull-right dob" id="dob" name="dob[]" required>
                                                                  </div>
                                                                  <!-- /.input group -->
                                                  </div>
                                                  <div class="form-group col-md-4">
                                                                  <label>Du Date</label>
                                                                  <div class="input-group date">
                                                                    <div class="input-group-addon">
                                                                      <i class="fa fa-calendar"></i>
                                                                    </div>
                                                                    <input type="text" class="form-control pull-right dob" id="dob" name="dob[]" required>
                                                                  </div>
                                                                  <!-- /.input group -->
                                                  </div>
                                                  <div class="form-group col-md-4">
                                                                  <label>End Date</label>
                                                                  <div class="input-group date">
                                                                    <div class="input-group-addon">
                                                                      <i class="fa fa-calendar"></i>
                                                                    </div>
                                                                    <input type="text" class="form-control pull-right dob" id="dob" name="dob[]" required>
                                                                  </div>
                                                                  <!-- /.input group -->
                                                  </div>
                                                  <div class="form-group col-md-4">
                                                                  <label>Start Date</label>
                                                                  <div class="input-group date">
                                                                    <div class="input-group-addon">
                                                                      <i class="fa fa-calendar"></i>
                                                                    </div>
                                                                    <input type="text" class="form-control pull-right dob" id="dob" name="dob[]" required>
                                                                  </div>
                                                                  <!-- /.input group -->
                                                  </div>
                                                  <div class="form-group col-md-4">
                                                                  <label>Du Date</label>
                                                                  <div class="input-group date">
                                                                    <div class="input-group-addon">
                                                                      <i class="fa fa-calendar"></i>
                                                                    </div>
                                                                    <input type="text" class="form-control pull-right dob" id="dob" name="dob[]" required>
                                                                  </div>
                                                                  <!-- /.input group -->
                                                  </div>
                                                  <div class="form-group col-md-4">
                                                                  <label>End Date</label>
                                                                  <div class="input-group date">
                                                                    <div class="input-group-addon">
                                                                      <i class="fa fa-calendar"></i>
                                                                    </div>
                                                                    <input type="text" class="form-control pull-right dob" id="dob" name="dob[]" required>
                                                                  </div>
                                                                  <!-- /.input group -->
                                                  </div>
                                                  <div class="form-group col-md-4">
                                                                  <label>Start Date</label>
                                                                  <div class="input-group date">
                                                                    <div class="input-group-addon">
                                                                      <i class="fa fa-calendar"></i>
                                                                    </div>
                                                                    <input type="text" class="form-control pull-right dob" id="dob" name="dob[]" required>
                                                                  </div>
                                                                  <!-- /.input group -->
                                                  </div>
                                                  <div class="form-group col-md-4">
                                                                  <label>Du Date</label>
                                                                  <div class="input-group date">
                                                                    <div class="input-group-addon">
                                                                      <i class="fa fa-calendar"></i>
                                                                    </div>
                                                                    <input type="text" class="form-control pull-right dob" id="dob" name="dob[]" required>
                                                                  </div>
                                                                  <!-- /.input group -->
                                                  </div>
                                                  <div class="form-group col-md-4">
                                                                  <label>End Date</label>
                                                                  <div class="input-group date">
                                                                    <div class="input-group-addon">
                                                                      <i class="fa fa-calendar"></i>
                                                                    </div>
                                                                    <input type="text" class="form-control pull-right dob" id="dob" name="dob[]" required>
                                                                  </div>
                                                                  <!-- /.input group -->
                                                  </div>
                                                </div>
                                        </div>
                                          </div>
                                         </div>
                                         <div class="box-footer">
                                          <!-- <button type="submit" class="btn btn-primary">Save</button>-->
                                          <input type="submit" name="submit" value="submit">
                                         </div>
                                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                       </form>
                               </div>
                      </div>
            </div>
          </div>
        </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="tab_2">
                  <form role="form" method="post" enctype="multipart/form-data" action="">
                  <div class="box-body">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="box box-info">
                          <div class="box-header">
                            <h3 class="box-title">Fee Sub Category List</h3>
                          </div>
                          <!-- /.box-header -->
                          <div class="box-body">
                            <table id="example" class="table table-striped table-bordered display nowrap" style="width:100%">
                              <thead>
                              <tr>
                                <th>Sl.No</th>
                                <th>Start Year</th>
                                <th>Start Month</th>
                                <th>End Year</th>
                                <th>End Month</th>
                                <th>Status</th>
                                <th>Action</th>

                              </tr>
                              </thead>
                              <tbody>

                              <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>

                                <td><span class="text-green">Active<span></td>

                                <td>
                              <div class="btn-group">
                                <button type="button" class="btn btn-default  btn-flat dropdown-toggle" data-toggle="dropdown">
                                  <span class="caret"></span>
                                  <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <ul class="dropdown-menu" role="menu" title="Action">
                                  <li><a href="#" title="Edit"><i  class="fa fa-eye" style="color: #897df8e6";></i></a></li>
                                  <li><a class="tFileDelete" href=""  title="Delete"><i class="fa fa-trash" style="color: red";></i></a></li>
                                </ul>
                              </div>
                              </td>

                              </tr>

                              </tbody>

                            </table>
                          </div>
                          <!-- /.box-body -->
                        </div>
              </div>
                        </div>
                        </div>
                      </form>
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
<script src="{{ URL::asset('assets/bower_components/chart.js/Chart.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/datatables.net-bs/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/datatables.net-bs/js/jszip.min.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/datatables.net-bs/js/pdfmake.min.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/datatables.net-bs/js/vfs_fonts.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/datatables.net-bs/js/buttons.html5.min.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/datatables.net-bs/js/buttons.print.min.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/datatables.net-bs/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/datatables.net-bs/js/dataTables.rowReorder.min.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/jquery/dist/bootbox.min.js') }}"></script>
<script>
       $(document).ready(function () {
           /*For Details Loading*/
           var i=0;
             $("#fee").hide();
           $("#feetype").change(function () {
               var id = $(this).val();

               if(id=='Annual'){
                  $("#fee").show();
                    $("#annual").fadeIn("slow");
                    $("#annual").show();
               }else{
                     $("#annual").hide();
                       $("#fee").hide();
                         $("#annual").fadeOut("slow");
               }
               if(id=='Bi-Annual'){
   $("#biannual").show();
      $("#fee").show();
      $("#biannual").fadeIn("slow");
              }else{
                //  $("#biannual").append("");
                $("#biannual").hide();

                    $("#biannual").fadeOut("slow");
              }

               if(id=='Tri-Annual'){
                   $("#fee").fadeIn("slow");
                 $("#fee").show();
                   $("#triannual").show();
               }else{
                     $("#triannual").hide();
                       $("#triannual").fadeOut("slow");

               }

               if(id=='Quaterly'){
                   $("#quaterly").fadeIn("slow");
                 $("#fee").show();
                   $("#quaterly").show();
               }else{
                     $("#quaterly").hide();
                        $("#quaterly").fadeOut("slow");

               }
               if(id=='Monthly'){
                   $("#Monthly").fadeIn("slow");
                 $("#fee").show();
                   $("#Monthly").show();
               }else{
                     $("#Monthly").hide();
                        $("#Monthly").fadeOut("slow");

               }
               if(id=='One-Time'){
                   $("#onetime").fadeIn("slow");
                 $("#fee").show();
                   $("#onetime").show();
               }else{
                     $("#onetime").hide();
                        $("#onetime").fadeOut("slow");

               }

           });

       });
   </script>
<script>
        $(document).ready(function () {

            /*For Delete Application Info*/
            $(".tFileDelete").click(function (e) {
                e.preventDefault();
                var id = this.id;
                bootbox.confirm("Are you sure?", function (result) {
                    if (result) {
                        var _url = $("#_url").val();
                        window.location.href = _url + "/Academic-Details/delete/" + id;
                    }
                });
            });

        $("#viewedit").click(function () {
            $("#editview").show();
            $(this).hide();
            $("#edit").show();
            $("#view").hide();
        });
        $("#editview").click(function () {
            $("#viewedit").show();
            $(this).hide();
            $("#view").show();
            $("#edit").hide();
        });

        });
    </script>
<script>
$(document).ready(function() {
   $.extend($.fn.dataTable.defaults, {
 dom: 'Bfrtip'
});
   $('#example').DataTable( {

       buttons: [
           'copy', 'csv', 'excel', 'pdf', 'print'
       ],
         rowReorder: {
           selector: 'td:nth-child(2)'
       },
       responsive: true
   } );
   } );

</script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2();
    $('#startdate').datepicker({
      autoclose: true,
      format:'dd-mm-yyyy'
    });
    $('.dob').datepicker({
      autoclose: true,
      format:'dd-mm-yyyy'
    });
  });
</script>
@endsection
<!-- ./wrapper -->
