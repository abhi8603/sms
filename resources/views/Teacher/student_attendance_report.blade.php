@extends('Teacher.main-header')
@section('style')
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/buttons.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/rowReorder.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/responsive.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/select2/dist/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/bootstrap/dist/css/select.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/dataTables.checkboxes.css') }}">
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
        <li><a href="#"><i class="fa fa-dashboard"></i> Student</a></li>
        <li class="active">Attendance</li>
      </ol>
    </section>
    <section class="content">
        @include('notification.notify')
  <div class="box box-default">
    <!-- Main content -->
    <div class="box-header with-border">
      <h3 class="box-title">Student Attendance Report</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        <button style="display:none;" type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
      </div>
    </div>

        <div class="row">
          <div class="col-md-12">

                  <div class="box-body">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="box box-info">
                          <div class="box-header">
                            <h3 class="box-title">Attendance</h3>
                          </div>
                            <div class="box-body">
                              <div class="col-md-12">
                                

                              <div class="form-group col-md-3">
                                <label for="exampleInputEmail1">Course/Class<span style="color:red;"> *</span></label>
                                <select class="form-control select2" name="courses" id="courses" style="width: 100%;" required>
                                    <option value="" selected="selected">Please Select Class/Course</option>
                                    <?php foreach ($courses as $course): ?>
                                         <option value="{{$course->id}}">{{$course->course_name}}</option>
                                    <?php endforeach; ?>
                              </select>
                                 </div>

                                 <div class="form-group col-md-3">
                                   <label for="exampleInputEmail1">Batch/Section<span style="color:red;"> *</span></label>
                                   <select class="form-control select2" name="batchs" id="batchs" style="width: 100%;" required>
                                       <option value="" selected="selected">Please Select</option>
                                 </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                      <label for="exampleInputEmail1">Accadmic year<span style="color:red;"> *</span></label>
                                      <select class="form-control select2" name="accadmicyear" id="accadmicyear" style="width: 100%;" required>
                                          <option value="" selected="selected">Please Select</option>
                                          <?php foreach ($accadmicyear as $accadmicyear): ?>
                                               <option value="{{$accadmicyear->startyear}}-{{$accadmicyear->endyear}}">{{$accadmicyear->startyear}}-{{$accadmicyear->endyear}}</option>
                                          <?php endforeach; ?>
                                    </select>
                                       </div>
                                       <div class="form-group col-md-3">
                                                       <label>Date</label>
                                                       <div class="input-group date">
                                                         <div class="input-group-addon">
                                                           <i class="fa fa-calendar"></i>
                                                         </div>
                                                         <input type="text" class="form-control pull-right dob" id="date" value="" name="date" required>
                                                       </div>
                                                       <!-- /.input group -->
                                                     </div>
                                          <div class="box-footer">
                                          <button type="button" onclick="search()" class="btn btn-primary">Search</button>

                                          </div>
                                        
                            </div>

                        </div>
                        </div>
              </div>
                        </div>
                        </div>

                        <div class="box-body" id="reports">
                          <div class="row">
                            <div class="col-md-12">
                              <div class="box box-info">
                                <div class="box-header">
                                  <h3 class="box-title">Attendance Report For </h3>
                                </div>
                                  <div class="box-body">
                                    <div class="col-md-12">

                                      <table id="example" class="table table-striped table-bordered display" style="width:100%">
                                        <thead>
                                  <tr>
                                  <th>Sl. No.</th>
                                    <th>Date</th>
                                    <th>Student Name</th>
                                    <th>Status</th>

                                    </tr>
                                </thead>
                                        <tbody>
                                          <tr>

                                          </tr>

                                        </tbody>

                                      </table>



                                  </div>
                                <!-- /.box-header -->


                              </div>
                                <!-- /.box-body -->
                              </div>
                    </div>
                              </div>
                              </div>



    </section>
    </div>
  </div>
  </div>

@endsection
{{--External Style Section--}}
@section('script')
<script src="{{ URL::asset('assets/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
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
<script src="{{ URL::asset('assets/bower_components/datatables.net-bs/js/dataTables.select.min.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/datatables.net-bs/js/dataTables.checkboxes.min.js') }}"></script>
<script>
$(document).ready(function () {
    /*For Details Loading*/
    $("#date").change(function () {
      $.extend($.fn.dataTable.defaults, {
         dom: 'Bfrtip'
        });

      var t = $('#example').DataTable({
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        pageLength: 100,
        responsive: true,
         bDestroy: true
      });
        var id = $(this).val();
        var batch=$("#batchs").val();
        var course=$("#courses").val();
        var accadmicyear=$("#accadmicyear").val();
        var _url = $("#_url").val();
        //  alert(accadmicyear);
       $.ajax
       ({
           type: "POST",
           url: _url + '/student/attendance/postattendancereport',
           data:  {date:id,course:course,batch:batch,accadmicyear:accadmicyear},
           cache: false,
           success: function ( data ) {

             data=JSON.parse(data);
             var j=0;
             for (var i in data) {
              j++;
              var name=data[i]['name'];
              var date=data[i]['att_date'];
              var status=data[i]['status'];
              t.row.add( [
                     j,
                     date,
                     name,
                     status
                     ] ).draw( false );
            }
           },
           error: function (jqXHR, exception) {
var msg = '';
if (jqXHR.status === 0) {
     $("#stuinfo").hide();
     $("#rollno").val('');
    msg = 'Not connect.\n Verify Network.';

} else if (jqXHR.status == 404) {
     $("#stuinfo").hide();
     $("#rollno").val('');
    msg = 'Requested page not found. [404]';

} else if (jqXHR.status == 500) {
     $("#stuinfo").hide();
     $("#rollno").val('');
    msg = 'Internal Server Error [500].';


} else if (exception === 'parsererror') {
   $("#stuinfo").hide();
   $("#rollno").val('');
    msg = 'Requested JSON parse failed.';

} else if (exception === 'timeout') {
   $("#stuinfo").hide();
   $("#rollno").val('');
    msg = 'Time out error.';
} else if (exception === 'abort') {
   $("#stuinfo").hide();
   $("#rollno").val('');
    msg = 'Ajax request aborted.';
} else {
   $("#stuinfo").hide();
   $("#rollno").val('');
    msg = 'Uncaught Error.\n' + jqXHR.responseText;
}
alert(msg);
},
       });




    });

   });

</script>

<script>
 $(document).ready(function () {

           /*For Details Loading*/
           $("#courses").change(function () {
              $("#att").hide();
             $("#att").toggle();
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

                        // alert(data);
                         var list = $("#batchs");
                      $(list).empty().append('<option selected="selected" value=""> Please Select </option>');

                     $(data).empty();
                      var emptycarno="No batch available for this course";
             if(data.length==""){
                        $("#batchs").append('<option value="' +emptycarno +'">' + emptycarno + '</option>');
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
    $('.select2').select2();
    $('#startdate').datepicker({
      autoclose: true,
      format:'dd-mm-yyyy'
    });
    $('.dob').datepicker({
      autoclose: true,
      format:'dd-mm-yyyy',
      maxDate: 0
    });
  });
</script>
<script type="text/javascript">
  function search()
  {
    var batch=$("#batchs").val();
        var course=$("#courses").val();
        var accadmicyear=$("#accadmicyear").val();
        var date=$("#date").val();
        var _url = $("#_url").val();
        var ds='batch='+batch+'&course='+course+'&accadmicyear='+accadmicyear+'&date='+date;
        alert(ds);
        $.ajax({
           type: "POST",
           url: _url + '/student/attendance/postattendancereport',
           data: ds,
           cache: false,
           success: function ( data )
           {
            alert(data);
              data=JSON.parse(data);
             var j=0;

             for (var i in data) {
              j++;
              var name=data[i]['name'];
              var date=data[i]['att_date'];
              var status=data[i]['status'];
              t.row.add( [
                     j,
                     date,
                     name,
                     status
                     ] ).draw( false );
            }
           }
        });

  }
</script>
@endsection
<!-- ./wrapper -->
