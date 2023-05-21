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

        <li class="active">Download Bunch Report</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        @include('notification.notify')
  <div class="box box-default">
           <div class="box-header with-border">
           <h3 class="box-title">Download Bunch Report</h3>

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

                         </div>
                          <div class="box-body">
                         <div class="col-md-3">
                           <div class="form-group">
                             <label for="exampleInputEmail1">Session<span style="color:red;"> *</span></label>
                              <select class="form-control select2" name="session" id="session" style="width: 100%;" required>
                                 <option value="" selected="selected">Please select</option>
                                 <?php foreach ($academic_year as $acadmic_year): ?>
                                   <option value="{{$acadmic_year->startyear}}-{{$acadmic_year->endyear}}" @if($acadmic_year->status==app_config('Session',Auth::user()->school_id)) selected @endif >{{$acadmic_year->startyear}}-{{$acadmic_year->endyear}}</option>
                                 <?php endforeach; ?>
                          </select>
                        </div>
                      </div>

                            <div class="col-md-3">
                              <div class="form-group">
                                <label>Class</label>
                                <select class="form-control select2" id="course" name="course" style="width: 100%;" required>
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
                                          <option  value="" selected="selected">Select section</option>

                                    </select>                        </div>
                          </div>

                          <div class="col-md-3">
                            <div class="form-group">
                              <label for="exampleInputEmail1">Teacher<span style="color:red;"> *</span></label>
                               <select class="form-control select2" name="teacher" id="teacher" style="width: 100%;" required>
                                  <option value="0" selected="selected">Please select</option>
                                <!--  <?php foreach ($teacher as $teacher): ?>
                                    <option value="{{$teacher->username}}">{{$teacher->name}} ({{$teacher->username}})</option>
                                  <?php endforeach; ?> -->
                           </select>
                          </div>
                          </div>
                          </div>
                        </div>
                        <div id="subjectlist"></div>



</div>
</div>

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
<script src="{{ URL::asset('assets/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
  <script>
       $(document).ready(function () {

         $("#teacher").change(function(){
            var teacher=this.value;
            //alert(teacher);
            var course=$("#course").val();
            var section=$("#batch").val();
            var academicyear=$("#session").val();
            if(academicyear==""){
              alert("Please select session.");
              return false;
            }
            if(course==""){
              alert("Please select class.");
              return false;
            }
            if(section==""){
              alert("Please select section.");
              return false;
            }
            var _url = $("#_url").val();
            $.ajax
            ({
                type: "POST",
                url: _url + '/subjectlist/bunch',
                data: {academicyear:academicyear,course:course,section:section,teacher:teacher},
                cache: false,
                success: function ( data ) {
                    $("#subjectlist").html(data);
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

$("#batch").change(function(){
  var section = $(this).val();
  var course=$("#course").val();
  var academicyear=$("#session").val();
  var _url = $("#_url").val();
  $.ajax
  ({
      type: "POST",
      url: _url + '/Exam/teacher/byclass',
      data: {section:section,course:course,academicyear:academicyear},
      cache: false,
      success: function ( data ) {
        data=JSON.parse(data);

         //   alert(data);
            var list = $("#teacher");
         $(list).empty().append('<option selected="selected" value=""> Please Select </option>');

        $(data).empty();
         var emptycarno="No Teacher available in this course";
if(data.length==""){
           $("#teacher").append('<option value="' +emptycarno +'">' + emptycarno + '</option>');
}
  else{
           for (var i in data) {
             var v=data[i]['emp_id'];
             var v1=data[i]['name'] + '('+ data[i]['emp_id'] +')';
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

           /*For Details Loading*/
           $("#course").change(function(){
               var id = $(this).val();
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
