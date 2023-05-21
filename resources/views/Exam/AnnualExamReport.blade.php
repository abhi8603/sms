@extends('header')
@section('style')
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/bootstrap/dist/css/buttons.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/bootstrap/dist/css/rowReorder.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/bootstrap/dist/css/responsive.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/select2/dist/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/bootstrap-daterangepicker/daterangepicker.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/plugins/timepicker/bootstrap-timepicker.min.css') }}">

<style>
#overlay
{
    display:none;
    position: fixed;
    top: 0px;
    bottom: 0;
    left: 0;
    right: 0;
    margin: auto;
    width: 100%;
    height: 100%;
    z-index: 999;
    background-color: rgba(0,0,0,0.85);
}

#overlay #loading {
    z-index: 9999;
    position: fixed;
    top: 0px;
    bottom: 0;
    left: 0;
    right: 0;
    margin: auto;
    width: 300px;
    height: 300px;
    background-size: 100% 100%;
    opacity: 1;
}
</style>

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
        <li><a href="#"><i class="fa fa-dashboard"></i> Examination</a></li>

        <li class="active">Result</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        @include('notification.notify')
        <div class="box box-default">
               <div class="box-header with-border">
               <h3 class="box-title">Exam Report</h3>

                <div class="box-tools pull-right">

                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  <button style="display:none;" type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                </div>
              </div>
          <!-- /.box-header -->
     <form method="post" action="{{url('exam/annual/report/generate')}}">

          <div class="box-body">
            <div class="row">
              <div class="col-md-12">

                <!-- /.form-group -->
                <div class="box box-primary">
                         <div class="box-header with-border">

                         </div>

                          <div class="box-body">
                             <div class="col-md-3">

                              <div class="form-group">
                                <label>Session</label>
                                <select class="form-control select2" name="academicyear" id="accadmicyear" style="width: 100%;" required>
                                    <option value="" selected="selected">Please Select</option>
                                    <?php foreach ($accadmicyear as $accadmicyear): ?>
                                         <option value="{{$accadmicyear->startyear}}-{{$accadmicyear->endyear}}">{{$accadmicyear->startyear}}-{{$accadmicyear->endyear}}</option>
                                    <?php endforeach; ?>
                              </select>
                           </div>
                         </div>

                            <div class="col-md-3">
                              <div class="form-group">
                                <label>Class</label>
                                <select class="form-control select2" id="courses"   name="course" style="width: 100%;" required>
                                    <option value="" selected="selected">Please select Course</option>
                                      <?php
                                      foreach($course as $row)
                                      {
                                        ?>
                                        <option value="<?php echo $row->id ?>"><?php echo $row->course_name; ?></option>

                                        <?php
                                      }
                                      ?>
                             </select>
                           </div>
                         </div>
                         <div class="col-md-3">
                            <div class="form-group">
                             <label>Section</label>
                           <select class="form-control select2" id="batch"  name="batch" style="width: 100%;" required>
                                         <option  value="" selected="selected">Select Batch</option>

                                   </select>                        </div>
                         </div>
                         <div class="col-md-3">
                            <div class="form-group" style="margin-top: 24px;">
                            <input type="submit" class="btn btn-info" value="Generate Report" name="reportg"/>
                         </div>
                        </div>


                           <div class="col-md-2">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                           </div>
                          </div>
  </div>


                <!-- /.form-group -->
</div>
</div>
</div>
</form>
    </div>


</section>
</div>
  <!-- /.content-wrapper -->
<div id="overlay">
  <br><br><br><br>
    <div id="loading" class="text-center" style="color:white;">
     <i class="fa fa-spinner fa-spin" style="font-size: 70px;"></i>
     <br><h3>Please wait...</h3>
    </div>
</div>

@endsection
{{--External Style Section--}}
@section('script')
<script src="{{ URL::asset('assets/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/datatables.net-bs/js/dataTables.select.min.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/datatables.net-bs/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/datatables.net-bs/js/dataTables.checkboxes.min.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/datatables.net-bs/js/dataTableSum.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/jquery/dist/bootbox.min.js') }}"></script>
 <script src="{{ URL::asset('assets/plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>
 <script src="{{ URL::asset('assets/bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/select2/dist/js/select2.full.min.js') }}"></script>

<script>
     $(document).ready(function () {
         /*For Details Loading*/
         $("#courses").change(function(){
             var id = $(this).val();
        //     alert(id);
             var _url = $("#_url").val();
             var dataString = 'eid=' + id;
             $.ajax
             ({
                 type: "POST",
                 url: _url + '/student/batchlist',
                 data: dataString,
                 cache: false,
                 success: function ( data ) {
                   data=JSON.parse(data);

                    //   alert(data);
                       var list = $("#batch");
                    $(list).empty().append('<option selected="selected" value=""> Please Select </option>');

                   $(data).empty();
                    var emptycarno="No batch available for this course";
           if(data.length==""){
                      $("#batch").append('<option value="' +emptycarno +'">' + emptycarno + '</option>');
           }
             else{
                      for (var i in data) {
                        var v=data[i]['id'];
                        var v1=data[i]['batch_name'];
                        $(list).append('<option value="' +v +'">' + v1 + '</option>');

                     }
         }

                 },
                 error: function (jqXHR, exception) {
      var msg = '';
      if (jqXHR.status === 0) {
          msg = 'Not connect.\n Verify Network.';
      } else if (jqXHR.status == 404) {
          msg = 'Requested page not found. [404]';
      } else if (jqXHR.status == 500) {
          msg = 'Internal Server Error [500].';
      } else if (exception === 'parsererror') {
          msg = 'Requested JSON parse failed.';
      } else if (exception === 'timeout') {
          msg = 'Time out error.';
      } else if (exception === 'abort') {
          msg = 'Ajax request aborted.';
      } else {
          msg = 'Uncaught Error.\n' + jqXHR.responseText;
      }
      alert(msg);
  },
             });
         });

     });
 </script>

<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()


  })
</script>

@endsection
<!-- ./wrapper -->
