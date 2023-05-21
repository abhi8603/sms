@extends('Teacher.main-header')
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
        <li class="active">lession-planning</li>
      </ol>
    </section>
    <section class="content">
  <div class="box box-default">
    <!-- Main content -->
    <div class="box-header with-border">
      <h3 class="box-title">Lession Planning</h3>

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
                <li class="active"><a href="#tab_1" data-toggle="tab">Lession Planning</a></li>
                <li><a href="#tab_2" data-toggle="tab">Report</a></li>
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
                                   <h3 class="box-title">Lession Planning</h3>
                                 </div>
                                 <!-- /.box-header -->
                                 <!-- form start -->
                                 <form role="form" method="post" enctype="multipart/form-data" action="">
                                   <div class="box-body">
                                     <div class="col-md-12">
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
                                       <select id="subject" class="form-control select2" style="width: 100%;">
                                           <option value="" selected="selected">Select Subject</option>
                                        <!--   <?php foreach ($subject as $subject): ?>
                                             <option selected="{{$subject->id}}">{{$subject->subject_name}}</option>
                                           <?php endforeach; ?>-->
                                    </select>
                                    </div>
                   
                  <div class="form-group">
                  
                  </div>
                                    <div class="box-body">
                                      <div class="row">
                                        <div class="col-xs-3">
                                              <label>From Date</label>
                                              <div class="input-group date">
                                                <div class="input-group-addon">
                                                  <i class="fa fa-calendar"></i>
                                                </div>
                                                <input type="text" class="form-control pull-right startdate" id="fromdate" name="fromdate">
                                              </div>
                                              <!-- /.input group -->
                                            </div>
                                            <div class="col-xs-3">
                                              <label>To Date</label>
                                              <div class="input-group date">
                                                <div class="input-group-addon">
                                                  <i class="fa fa-calendar"></i>
                                                </div>
                                                <input type="text" class="form-control pull-right startdate" id="todate" name="totdate">
                                              </div>
                                              <!-- /.input group -->
                                            </div>
                                        <div class="col-xs-3">
                                        <label>Topic</label>
                                            
                                          <textarea type="text" class="form-control" id="topic" placeholder="Topic"></textarea>
                                        </div>
                                        <div class="col-xs-3">
                                        <label>Objective</label>
                                            
                                          <textarea type="text" class="form-control" id="objective" placeholder="Objective"></textarea>
                                        </div>
                                        <div class="col-xs-3">
                                        <label>Hours/Class</label>
                                          <input type="text" class="form-control" id="hours" placeholder="Hours/Class">
                                        </div>
                                        <div class="col-xs-3">

                                         <a  style="margin-top: 25px;" id="addtopic" class="btn btn-primary"><i class="fa fa-fw fa-plus"></i></a>
                                        </div>
                                      </div>
                                    </div>
                                   </div>
                                   <table id="lessionlist" class="table table-striped table-bordered display" style="width:100%">
                                  <thead>
                               <tr>
                               <th>From Date</th>
                               <th>To Date</th>
                               <th>Topic</th>
                               <th>Objective</th>
                               <th>Hours/Class</th>
                               <th></th>
                               </tr>
                             </thead>
                                     <tbody>

                                     </tbody>
                                   </table>

                                 </div>
                                   <div class="box-footer">
                                     <a id="save" class="btn btn-primary">Save</a>
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
                <div class="tab-pane" id="tab_2">
                  <form role="form" method="post" enctype="multipart/form-data" action="">
                  <div class="box-body">
                    <div class="row">
                      <div class="col-md-5">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Course/Class<span style="color:red;"> *</span></label>
                          <select class="form-control select2" style="width: 100%;">
                              <option selected="selected">Please Select</option>
                              <option value="1">January</option>
                              <option value="2">February</option>
                              <option value="3">March</option>
                              <option value="4">April</option>
                              <option value="5">May</option>
                       </select>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Batch/Section<span style="color:red;"> *</span></label>
                        <select class="form-control select2" style="width: 100%;">
                            <option selected="selected">Please Select</option>
                            <option value="1">January</option>
                            <option value="2">February</option>
                            <option value="3">March</option>
                            <option value="4">April</option>
                            <option value="5">May</option>
                     </select>
                    </div>
                      <div class="box-footer">
                        <button type="submit" class="btn btn-primary">OK</button>
                      </div>
                        </div>
                        </div>
                        </div>
                      </form>
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
   $("#save").click(function(){
   // alert("hlo");
       var lessionplanning = new Array();
     var table=$('#lessionlist').DataTable();
     var course=$("#course").val();
     var batch=$("#batch").val();
     var subject=$("#subject").val();
     var acadmic_year=$("#addacadmicyear").val();
     var semester=$("#semester").val();
     if( table.data().count() > 0 && course !="" && batch != "" && subject != "" && semester != ""){
      var customers = new Array();

  //  alert(pay_mode);
  var cnt=0;
      $("#lessionlist tbody tr").each(function () {
        cnt++;
                var row = $(this);
                var topic = {};
                topic.fromdate = row.find('td:eq(0) input').val();
                topic.todate = row.find('td:eq(1) input').val();
                topic.topic = row.find('td:eq(2) input').val();
                topic.objective = row.find('td:eq(3) input').val();
                topic.hours_class = row.find('td:eq(4) input').val();
                lessionplanning.push(topic);

            });
         //   alert(JSON.stringify(lessionplanning));
            var dataa =JSON.stringify(lessionplanning)
            var _url = $("#_url").val();
            $.ajax({
              type: "POST",
              url: _url + "/subject/lession-planning/save",
              data: {data: dataa,acadmic_year:acadmic_year,course:course,batch:batch,subject:subject,semester:semester},
              success: function (data) {
                 // alert(data); exit;
                if(data=="1"){
                    alert("Lession Planning Saved Successfully.");
                  }else{
                    alert("Unable to save lession planning.try again.");
                  }
                  location.reload();
                  table.clear().draw();
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
        }else{
          alert('Please fill the all details.');
        }
       });
 });
</script>

<script>
$(function()
   {
     $("#addtopic").click(function(){
    var fromdate=$("#fromdate").val();
    var todate=$("#todate").val();
    var topic=$("#topic").val();
    var objective=$("#objective").val();
    var hours=$("#hours").val();
      var tt = $('#lessionlist').DataTable();
      if(fromdate !="" && topic != ""){
       tt.row.add( [
             '<input type="text" class="form-control"  name="fromdate" value="'+fromdate+'" required></td>',
             '<input type="text" class="form-control"  name="todate" value="'+todate+'" required></td>',
             '<input type="text" class="form-control"  name="topic" value="'+topic+'" required></td>',
             '<input type="text" class="form-control"  name="objective" value="'+objective+'" required></td>',           
             '<input type="text" class="form-control"  name="hours" value="'+hours+'" required></td>',
             '<a class="btn"><i class="fa fa-trash" style="color: red";></i></a>',
           ] ).draw(false);
         }else{
           alert("Please enter Lession Code and Topic.");
         }
         });

         $("#fromdate").val("");
         $("#todate").val("");
         $("#objective").val("");
         $("#topic").val("");
         $("#hours").val("");
         $('#lessionlist').on("click", ".btn", function(){
           var ts = $('#lessionlist').DataTable({
          fixedColumns: true,
          bDestroy: true,
           scrollCollapse: true,
           paging:         true,
           fixedColumns: true,
           bDestroy: true
           });
      //  console.log($(this).parent());
        ts.row($(this).parents('tr')).remove().draw(false);
        });
     });
</script>

<script>
       $(document).ready(function () {
           /*For Details Loading*/

           $("#batch").change(function(){
               var section = $(this).val();
               var class_id = $("#course").val();
               var acadmic_year = $("#acadmic_year").val();
             //  alert(class_id); exit;
               var _url = $("#_url").val();
             //  var dataString = 'eid=' + id;
               $.ajax
               ({
                   type: "POST",
                   url: _url + '/teacher/getSubjectbyclass',
                   data: {class_id:class_id,section:section},
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
