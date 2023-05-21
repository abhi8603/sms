@extends('header')
@section('style')
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/buttons.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/rowReorder.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/responsive.dataTables.min.css') }}">
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
        <li class="active">View Fee Master</li>
      </ol>
    </section>
    <section class="content">
        @include('notification.notify')
  <div class="box box-default">
    <!-- Main content -->
    <div class="box-header with-border">
      <h3 class="box-title">View Fee Master</h3>

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
                <li class="active"><a href="#tab_1" data-toggle="tab">Fee Master  </a></li>
                <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                  <div class="box-body">
                    <div class="row">
                      <div class="col-md-8">

                        <!-- /.form-group -->
                        <div class="box box-primary">
                              <form role="form" method="post" enctype="multipart/form-data" action="{{url('finance/Fee-master/update')}}">
                                   <div class="box-body">
                                     <div class="col-md-12">
                                     <div class="form-group">
                                       <label for="exampleInputEmail1">Fee Category<span style="color:red;"> *</span></label>
                                       <select class="form-control select2" name="feecategory" style="width: 100%;" required>
                                           <option value="" selected="selected">Select Fee Category</option>
                                      <?php foreach ($fee_category as $fee_category): ?>
                                          <option <?php if($data->feecategory==$fee_category->id) {echo "selected"; } ?> value="{{ $fee_category->id }}">{{ $fee_category->fee_category}}</option>
                                      <?php endforeach; ?>

                                    </select>
                                        </div>
                                        <div class="form-group">
                                          <label for="exampleInputEmail1">Fee Sub Category Name<span style="color:red;"> *</span></label>
                                          <select class="form-control select2" name="fee_subcategory" style="width: 100%;" required>
                                              <option value="" selected="selected">Select Fee Category</option>
                                         <?php foreach ($fee_subcategory as $fee_subcategory): ?>
                                             <option <?php if($data->fee_subcategory==$fee_subcategory->id) {echo "selected"; } ?> value="{{ $fee_subcategory->id }}">{{ $fee_subcategory->sub_category}}</option>
                                         <?php endforeach; ?>

                                         </select>
                                       </div>
                                       <div class="form-group">
                                         <label for="exampleInputEmail1">Months</label>
                                         <select class="form-control select2" id="month" name="month" style="width: 100%;">
                                            <option value="">Please Select Months</option>
                                             <option <?php if($data->month=="01") {echo "selected"; } ?> value="01" >January</option>
                                             <option  <?php if($data->month=="02") {echo "selected"; } ?> value="02" >February</option>
                                             <option  <?php if($data->month=="03") {echo "selected"; } ?> value="03" >March</option>
                                             <option  <?php if($data->month=="04") {echo "selected"; } ?> value="04" >April</option>
                                             <option  <?php if($data->month=="05") {echo "selected"; } ?> value="05" >May</option>
                                             <option  <?php if($data->month=="06") {echo "selected"; } ?> value="06" >June</option>
                                             <option  <?php if($data->month=="07") {echo "selected"; } ?> value="07" >July</option>
                                             <option  <?php if($data->month=="08") {echo "selected"; } ?> value="08" >August</option>
                                             <option  <?php if($data->month=="09") {echo "selected"; } ?> value="09" >September</option>
                                             <option  <?php if($data->month=="10") {echo "selected"; } ?> value="10" >October</option>
                                             <option  <?php if($data->month=="11") {echo "selected"; } ?> value="11" >November</option>
                                             <option  <?php if($data->month=="12") {echo "selected"; } ?> value="12" >December</option>
                                      </select>
                                    </div>
                                    <div class="form-group">
                                      <label for="exampleInputEmail1">Class/Course</label>
                                      <select class="form-control select2" id="course" name="course" style="width: 100%;">
                                          <option value="" selected="selected">Please Select Course/Class</option>
                                          <?php foreach ($course as $course): ?>
                                              <option <?php if($data->course==$course->id) {echo "selected"; } ?> value="{{$course->id}}" >{{$course->course_name}}</option>                                     <?php endforeach; ?>
                                   </select>
                                 </div>
                                 <div class="form-group">
                                   <label for="exampleInputEmail1" id="typechn">Amount<span style="color:red;"> *</span></label>
                                   <input type="text" class="form-control" id="Amount" value="{{$data->amount OR ''}}" name="amount" placeholder="Amount" onkeypress="return isNumber(event)" />
                                   <input type="hidden" class="form-control" id="id" value="{{$data->id OR ''}}" name="id" placeholder="id" onkeypress="return isNumber(event)" />

                                 </div>
                                  <div class="box-footer">
                                         <!-- <button type="submit" class="btn btn-primary">Save</button>-->
                                         <input type="submit" class="btn btn-primary" name="submit" value="Update">
                                        </div>
                                         <input type="hidden" name="_token" value="{{ csrf_token() }}">

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
                </div>
                  </section>
            </div>

@endsection
{{--External Style Section--}}
@section('script')
<script src="{{ URL::asset('assets/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
<script>
        $(document).ready(function () {


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
@endsection
<!-- ./wrapper -->
