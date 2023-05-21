@extends('header')
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
        <li class="active">Attendance Report</li>
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
                            <h3 class="box-title">Attendance Report</h3>
                          </div>
                       
                            <div class="box-body">
                            <form role="form" method="post" enctype="multipart/form-data" action="{{url('student/attendance/getAttendancereport')}}">
                     
                              <div class="col-md-12">
                              <div class="col-md-4">
                              <div class="form-group">
                                <label for="exampleInputEmail1">Acadmic Year<span style="color:red;"> *</span></label>
                                <select class="form-control select2" name="acadmic_year" id="acadmic_year" style="width: 100%;" required>
                                    <option value="" selected="selected">Please Select Acadmic Year</option>
                                    <?php foreach ($accadmicyear as $accadmicyear): ?>
                                               <option value="{{$accadmicyear->startyear}}-{{$accadmicyear->endyear}}">{{$accadmicyear->startyear}}-{{$accadmicyear->endyear}}</option>
                                          <?php endforeach; ?>
                              </select>
                                 </div>
                                 </div>
                              <div class="col-md-4">
                              <div class="form-group">
                                <label for="exampleInputEmail1">Student Name<span style="color:red;"> *</span></label>
                                <select class="form-control select2" name="student" id="student" style="width: 100%;" required>
                                    <option value="" selected="selected">Please Select Student</option>
                                    <?php foreach ($student as $s): ?>
                                         <option value="{{$s->reg_no}}">{{$s->stu_name}}-{{$s->reg_no}}</option>
                                    <?php endforeach; ?>
                              </select>
                                 </div>
                                 </div>
                                 <div class="col-md-3">
                              <div class="form-group">
                                          <button style="margin-top: 24px;" type="submit" class="btn btn-primary">Search</button>
                                          <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
               
                               </div>
                               </div>
                           </div>
                           </form>
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
                                  <h3 class="box-title">Attendance Report </h3>
                                </div>
                                  <div class="box-body">
                                    <div class="col-md-12">

                                      <table id="reporttable" class="table table-striped table-bordered display" style="width:100%">
                                        <thead>
                                  <tr>
                                  
                                    <th>Sl.No</th>
                                    <th>Registration No </th>
                                    <th>Name</th>
                                    <th>Roll No</th>
                                    <th>Class</th>
                                    <th>Section</th>
                                    <th>Month</th>
                                    <th>Total Class</th>
                                    <th>Present</th>
                                    <th>Absent</th>
                                    <th>Attendance %</th>
                                    </tr>
                                </thead>
                                        <tbody>
                                        @php $i=0; @endphp
                                        @foreach($attendance as $attendance)
                                        @php $i++; @endphp
                                          <tr>
                                        <td>{{$i}}</td>
                                        <td>{{$attendance->reg_no}}</td>
                                        <td>{{$attendance->name}}</td>
                                        <td>{{$attendance->roll_no}}</td>
                                        <td>{{$attendance->class}}</td>
                                        <td>{{$attendance->section}}</td>
                                        <td>{{$attendance->month}}</td>
                                        <td>{{$attendance->totalcls}}</td>
                                        <td>{{$attendance->present}}</td>
                                        <td>{{$attendance->absent}}</td>
                                        <td>{{($attendance->present/$attendance->totalcls)*100}}</td>
                                          </tr>

                                      @endforeach
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

<script>
  $(document).ready(function () {
    var tb = $('#reporttable').DataTable({
            scrollY:        "300px",
            scrollX:        true,
            scrollCollapse: true,
            paging:         false,           
            fixedColumns: true,

            bDestroy: true,
          //  responsive: true
            });
  });
</script>
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

@endsection
<!-- ./wrapper -->
