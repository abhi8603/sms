@extends('header')
@section('style')
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/bootstrap/dist/css/buttons.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/bootstrap/dist/css/rowReorder.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/bootstrap/dist/css/responsive.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/bootstrap-daterangepicker/daterangepicker.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
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
        <li><a href="#"><i class="fa fa-dashboard"></i> Academic</a></li>
          <li><a href="#"><i class="fa fa-dashboard"></i>  Subject</a></li>
        <li class="active">Online Classes</li>
      </ol>
    </section>
    <section class="content">
    @include('notification.notify')
  <div class="box box-default">
    <!-- Main content -->
    <div class="box-header with-border">
      <h3 class="box-title">Online Classes</h3>

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
                <li style="<?php if(Auth::user()->user_role==1){ echo "display:none;"; } ?>" class="<?php if(Auth::user()->user_role!=1){ echo "active"; } ?>"><a href="#tab_1" data-toggle="tab">Schedule Class</a></li>
                <li class="<?php if(Auth::user()->user_role==1){ echo "active"; } ?>" ><a href="#tab_2" data-toggle="tab">Report/List</a></li>
                <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane <?php if(Auth::user()->user_role!=1){ echo "active"; } ?>" id="tab_1">
                  <div class="box-body">
                    <div class="row">
                      <div class="col-md-12">

                        <!-- /.form-group -->
                        <div class="box box-primary">
                                 <div class="box-header with-border">
                                   <h3 class="box-title">Lession Planning</h3>
                                 </div>
                                 <!-- /.box-header -->
                                 <!-- form start -->
                                 <form role="form" method="post" enctype="multipart/form-data" action="{{url('online/classes/create')}}">
                                   <div class="box-body">
                                     <div class="col-md-6">
                                     <div class="form-group">
                                <label for="exampleInputEmail1">Acadmic Year<span style="color:red;"> *</span></label>
                                    <select class="form-control select2" name="addacadmicyear" id="addacadmicyear" style="width: 100%;">
                                    <?php foreach ($Acadmicyear as $Acadmicyear): ?>
                                      <option value="{{$Acadmicyear->startyear}}-{{$Acadmicyear->endyear}}" @if($Acadmicyear->status=='1') selected @endif >{{$Acadmicyear->startyear}}-{{$Acadmicyear->endyear}}</option>
                                    <?php endforeach; ?>

                                   </select>
                                 </div>
                                     <div class="form-group">
                                       <label for="exampleInputEmail1">Class<span style="color:red;"> *</span></label>
                                       <select id="course" name="course" class="form-control select2" style="width: 100%;">
                                           <option value="">Select Class</option>
                                          <?php foreach ($course as $course): ?>
                                            <option value="{{$course->id}}">{{$course->course_name}}</option>
                                          <?php endforeach; ?>

                                    </select>
                                        </div>
                                     <div class="form-group">
                                       <label for="exampleInputEmail1">Section<span style="color:red;"> *</span></label>
                                       <select id="batch" name="batch" class="form-control select2" style="width: 100%;">
                                           <option value="" selected="selected">Select Section</option>

                                    </select>
                                   </div>

                                     <div class="form-group">
                                       <label for="exampleInputEmail1">Subject<span style="color:red;"> *</span></label>
                                       <select id="subject" name="subject" class="form-control select2" style="width: 100%;">
                                           <option value="" selected="selected">Select Subject</option>

                                    </select>
                                    </div>
                                    <div class="form-group">
                                      <label for="exampleInputEmail1">URL<span style="color:red;"> *</span></label>
                                      <input type="text" name="url" class="form-control"/>
                                       </div>
                                    <div class="form-group">
                                      <label for="exampleInputEmail1">Date<span style="color:red;"> *</span></label>
                                      <input type="text" name="cdate" class="form-control startdate"/>
                                       </div>

                                       <div class="form-group">
                                         <label for="exampleInputEmail1">Time<span style="color:red;"> *</span></label>
                                         <input type="time" name="ctime" class="form-control"/>
                                        </div>
                                        <div class="form-group">
                                          <label for="exampleInputEmail1">Discripton</label>
                                          <textarea type="text" name="discription" class="form-control"></textarea>
                                           </div>
                                   </div>
                                 </div>
                                   <div class="box-footer">
                                     <input type="submit" class="btn btn-primary" value="Create"/>
                                         <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                   </div>
                                 </form>
                               </div>

                        <!-- /.form-group -->
                      </div>

                  </div>
                </div>
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane <?php if(Auth::user()->user_role==1){ echo "active"; } ?>" id="tab_2">
                  <div class="box-body">
                    <div class="row">
                    <div class="col-md-12" style="display:none;">
                    <div class="box box-info">
                                 <div class="box-header with-border">
                                   <h3 class="box-title">Online Classes Report</h3>
                                 </div>
                       <div class="col-md-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Acadmic Year<span style="color:red;"> *</span></label>
                          <select class="form-control select2" id="addacadmicyear_r" style="width: 100%;">
                              <option selected="selected">Please Select</option>
                              <?php foreach ($Acadmic_year as $Acadmicyear): ?>
                                      <option value="{{$Acadmicyear->startyear}}-{{$Acadmicyear->endyear}}" @if($Acadmicyear->status=='1') selected @endif >{{$Acadmicyear->startyear}}-{{$Acadmicyear->endyear}}</option>
                                    <?php endforeach; ?>
                       </select>
                      </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Class<span style="color:red;"> *</span></label>
                          <select class="form-control select2" id="course_r" style="width: 100%;">
                          <option value="">Select Class</option>
                              <?php foreach ($courses as $course): ?>
                              <option value="{{$course->id}}">{{$course->course_name}}</option>
                              <?php endforeach; ?>
                     </select>
                      </div>
                      </div>
                      <div class="col-md-3">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Section<span style="color:red;"> *</span></label>
                        <select class="form-control select2" id="batch_r" style="width: 100%;">
                            <option selected="selected">Please Select</option>

                     </select>
                    </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Subject<span style="color:red;"> *</span></label>
                        <select class="form-control select2" id="subject_r" style="width: 100%;">
                            <option selected="selected">Please Select</option>

                     </select>
                    </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                      <div class="box-footer">
                        <button type="submit" id="view" class="btn btn-primary">View</button>
                      </div>
                       </div>
                       </div>
                        </div>
                        </div>



                        <div  class="col-md-12">
                          <div class="box box-success">
                                       <div class="box-header with-border">
                                         <h3 class="box-title">Online Classes Report</h3>
                                       </div>

                                       <table id="example" style="width: 100%;" class="table table-striped table-bordered ">
                                         <thead>
                                           <tr>
                                             <th>Sl. No</th>
                                             <th>Subject</th>
                                             <th>Teacher</th>
                                             <th>Date</th>
                                             <th>Time</th>
                                             <th>Discripton</th>
                                             <th>Status</th>
                                             <th>Action</th>
                                           </tr>
                                         </thead>
                                         <tbody>
                                           <?php $i=0; ?>
                                           @foreach($onlineClasses as $key=>$value)
                                           <?php $i++; ?>
                                         <tr>
                                           <td>{{$i}}</td>
                                           <td>{{$value->subject_name}}</td>
                                           <td>{{$value->name}}</td>
                                           <td>{{$value->date}}</td>
                                           <td>{{$value->time}}</td>
                                           <td>{{$value->discription}}</td>
                                           <td>@if($value->status==1)
                                             <span>Active</span>
                                           @else
                                           <span>In-Active</span>
                                           @endif</td>

                                           <td>
                                              <a id="cancel" href="{{url('online/classes/cancel/'.$value->id)}}" class="btn btn-danger">Cancel</a>
                                             </td>
                                         </tr>
                                         @endforeach
                                       </tbody>

                                       </table>

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
<script src="{{ URL::asset('assets/bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
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
<script type="text/javascript">
   $(document).ready(function() {
     $("#cancel").click(function(){
      if(confirm("Are you sure?")){

      }else{
        return false;
      }
     })

            $('#basic-datatables').DataTable({
            });
            $('#user_role').select2({
                theme: "bootstrap"
            });
            $('#designation').select2({
                theme: "bootstrap"
            });

        });
</script>
<script>
       $(document).ready(function () {

           $("#batch").change(function(){
               var section = $(this).val();
               var class_id = $("#course").val();
               var acadmic_year = $("#addacadmicyear").val();
             //  alert(class_id); exit;
               var _url = $("#_url").val();
             //  var dataString = 'eid=' + id;
               $.ajax
               ({
                   type: "POST",
                   url: _url + '/subject/getSubjectbyclass_teacher',
                   data: {class_id:class_id,section:section,acadmic_year:acadmic_year},
                   cache: false,
                   success: function ( data ) {
                     data=JSON.parse(data);
                      //    console.log(data);
                      //   alert(data);exit;
                         var list = $("#subject");
                      $(list).empty().append('<option selected="selected" value=""> Please Select </option>');

                     $(data).empty();
                      var emptycarno="No Subject assigned in this class.";
             if(data.length==""){
                        $("#subject").append('<option value="' +emptycarno +'">' + emptycarno + '</option>');
             }
               else{
                        for (var i in data) {
                          var v=data[i]['subject'];
                          var v1=data[i]['subject_name'];
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


           $("#batch_r").change(function(){
               var section = $(this).val();
               var class_id = $("#course_r").val();
               var acadmic_year = $("#addacadmicyear_r").val();
             //  alert(class_id); exit;
               var _url = $("#_url").val();
             //  var dataString = 'eid=' + id;
               $.ajax
               ({
                   type: "POST",
                   url: _url + '/subject/getSubjectbyclass_teacher',
                   data: {class_id:class_id,section:section,acadmic_year:acadmic_year},
                   cache: false,
                   success: function ( data ) {
                     data=JSON.parse(data);
                      //    console.log(data);
                      //   alert(data);exit;
                         var list = $("#subject_r");
                      $(list).empty().append('<option selected="selected" value=""> Please Select </option>');

                     $(data).empty();
                      var emptycarno="No Subject assigned in this class.";
             if(data.length==""){
                        $("#subject_r").append('<option value="' +emptycarno +'">' + emptycarno + '</option>');
             }
               else{
                        for (var i in data) {
                          var v=data[i]['subject'];
                          var v1=data[i]['subject_name'];
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


           $("#course_r").change(function(){
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
                         var list = $("#batch_r");
                      $(list).empty().append('<option selected="selected" value=""> Please Select </option>');

                     $(data).empty();
                      var emptycarno="No batch available for this course";
             if(data.length==""){
                        $("#batch_r").append('<option value="' +emptycarno +'">' + emptycarno + '</option>');
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



           $("#course").change(function(){
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
          responsive: true,
          pageLength: 50,
      } );
      } );

   </script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2();
    $('.startdate').datepicker({
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
