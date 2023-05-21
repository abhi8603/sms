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
<link rel="stylesheet" href="//code.jquery.com/mobile/1.5.0-alpha.1/jquery.mobile-1.5.0-alpha.1.min.css">

<!--<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/dataTables.checkboxes.css') }}">-->
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
      <h3 class="box-title">Student Attendance</h3>

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
                <li class="active"><a href="#tab_1" data-toggle="tab">Attendance(Daily)</a></li>
                <li><a href="#tab_2" data-toggle="tab">View Attendance</a></li>

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
                                   <h3 class="box-title">Attendance</h3>
                                 </div>
                                 <!-- /.box-header -->
                                 <!-- form start -->
                                 <form role="form" method="post" enctype="multipart/form-data" action="#">
                                   <div class="box-body">
                                     <div class="col-md-12">
                                     <div class="form-group col-md-3">
                                       <label for="exampleInputEmail1">Class<span style="color:red;"> *</span></label>
                                       <select class="form-control select2" name="fee_category" id="course" style="width: 100%;" required>
                                           <option value="" selected="selected">Please Select Class</option>
                                           <?php foreach ($course as $course): ?>
                                                <option value="{{$course->id}}">{{$course->course_name}}</option>
                                           <?php endforeach; ?>
                                     </select>
                                        </div>
                                        <div id="att" style="display:none;">
                                        <div class="form-group col-md-3">
                                          <label for="exampleInputEmail1">Section<span style="color:red;"> *</span></label>
                                          <select class="form-control select2" name="fee_category" id="batch" style="width: 100%;" required>
                                              <option value="" selected="selected">Please Select</option>
                                        </select>
                                           </div>
                                           <div style="display:none" class="form-group col-md-3">
                                             <label for="exampleInputEmail1">Subject<span style="color:red;"> *</span></label>
                                             <select class="form-control select2" name="fee_category" id="subject" style="width: 100%;">
                                                 <option value="" selected="selected">Please Select</option>
                                           </select>
                                              </div>
                                              <div class="form-group">
                                              <label>Date</label>
                                              <div class="input-group date">
                                                <div class="input-group-addon">
                                                  <i class="fa fa-calendar"></i>
                                                </div>
                                                <input type="text" class="form-control pull-right" id="startdate" name="startdate">
                                              </div>
                                              <!-- /.input group -->
                                            </div>

                                        </div>

                                   </div>

                                 </div>
</form>
                               </div>
                               <div class="row">
                                 <div class="form-group col-md-12">
                               <div class="callout callout-info">
                                 <span class="pull-left-container">
                                   <i class="fa fa-info-circle pull-left"></i>
                                 </span>
                                 <p>unchecked the students who is not present.</p>
                               </div>
                               </div>
                               </div>
                               <div class="box-body">
                                 <table id="example" class="table table-striped table-bordered display" style="width:100%">
                                   <thead>
                                   <tr>
                                     <th></th>
                                     <th>Roll No</th>
                                     <th>Admission No</th>
                                     <th>Student Name</th>
                                     <th>Remark</th>
                                   </tr>
                                   </thead>
                                   <tbody>


                                   </tbody>

                                 </table>
                               </div>
                               <a class="btn btn-primary" id="save">Save </a>
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
                            <h3 class="box-title">Attendance</h3>
                          </div>
                            <div class="box-body">
                              <div class="col-md-12">
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
                                <label for="exampleInputEmail1">Class<span style="color:red;"> *</span></label>
                                <select class="form-control select2" name="courses" id="courses" style="width: 100%;" required>
                                    <option value="" selected="selected">Please Select</option>
                                    <?php foreach ($courses as $course): ?>
                                         <option value="{{$course->id}}">{{$course->course_name}}</option>
                                    <?php endforeach; ?>
                              </select>
                                 </div>

                                 <div class="form-group col-md-3">
                                   <label for="exampleInputEmail1">Section<span style="color:red;"> *</span></label>
                                   <select class="form-control select2" name="batchs" id="batchs" style="width: 100%;" required>
                                       <option value="" selected="selected">Please Select</option>
                                 </select>
                                    </div>
                                    
                                       <div class="form-group col-md-3">
                                         <label for="exampleInputEmail1">Month<span style="color:red;"> *</span></label>
                                         <select class="form-control select2" name="month" id="months" style="width: 100%;" required>
                                             <option value="" selected="selected">Please Select</option>
                                             <option value="1">January</option>
                                             <option value="2">February</option>
                                             <option value="3">March</option>
                                             <option value="4">April</option>
                                             <option value="5">May</option>
                                             <option value="6">June</option>
                                             <option value="7">July</option>
                                             <option value="8">August</option>
                                             <option value="9">September</option>
                                             <option value="10">October</option>
                                             <option value="11">November</option>
                                             <option value="12">December</option>
                                       </select>
                                          </div>
                            </div>
                          <!-- /.box-header -->


                        </div>
                          <!-- /.box-body -->
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
                                        <div id="rp"></div>                           
                                  </div>
                                <!-- /.box-header -->


                              </div>
                                <!-- /.box-body -->
                              </div>
                    </div>
                              </div>
                              </div>
                      </form>
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
<script src="{{ URL::asset('assets/bower_components/datatables.net-bs/js/dataTables.select.min.js') }}"></script>
<script>
function daysInMonth (month, year) { // Use 1 for January, 2 for February, etc.
  return new Date(year, month, 0).getDate();
}      $.extend($.fn.dataTable.defaults, {
    dom: 'Bfrtip'
   });
  /* var reporttable=   $('#reporttable').DataTable( {

          buttons: [
              'copy', 'csv', 'excel', 'pdf', 'print'
          ],
          pageLength: 100,
          responsive: true,
          scrollY:        "300px",
           scrollX:        true,
           scrollCollapse: true,
           paging:         false,
           columnDefs: [
               { width: 200, targets: 0 }
           ],
           fixedColumns: true,
           bDestroy: true


      } );*/
       $(document).ready(function () {

           /*For Details Loading*/
           $("#months").change(function () {
//alert();

               var id = $(this).val();
               var batch=$("#batchs").val();
               var course=$("#courses").val();
               var accadmicyear=$("#accadmicyear").val();
           //    alert(accadmicyear);
            
              var _url = $("#_url").val();
              $.ajax
              ({
                  type: "POST",
                  url: _url + '/student/attendance/report',
                  data:  {month:id,course:course,batch:batch},
                  cache: false,
                  success: function ( data ) {
                    $('#rp').html(data);

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
       $(document).ready(function () {

           /*For Details Loading*/
           $("#course").change(function () {
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
          $(document).ready(function () {
            var student = [];
            var studentids = [];
             var attendancelist={};

 $.extend($.fn.dataTable.defaults, {
 dom: 'Bfrtip'
});
 var t =  $('#example').DataTable( {

       buttons: [
           'copy', 'csv', 'excel', 'pdf', 'print'
       ],
       pageLength: 100,
       responsive: true


   } );

              /*For Details Loading*/
              $("#startdate").change(function () {
                t.clear();
                  var date = $("#startdate").val();
                  var id = $("#batch").val();
                  var course = $("#course").val();
                  var _url = $("#_url").val();
                  $.ajax
                  ({
                      type: "POST",
                      url: _url + '/student/attendance/getstudent',
                      data: {batch: id, course:course,date:date},
                      cache: false,
                      success: function ( data ) {
                        //  alert(data);
                       // console.log(data);exit;
                         var array = data.split("|");
                         data=JSON.parse(array[0]);
                         subjects=JSON.parse(array[1]);
                       // console.log(array[1]);
                             for (var i in data) {
                                 var reg_no=data[i]['reg_no'];
                                 var stu_name=data[i]['stu_name'];
                                 var roll_no=data[i]['roll_no'];
                                 var subject = $("#subject");
                                 var att_status =data[i]['att_status']; 
                                 var status="";
                                 if(att_status=="P"){
                                  status="checked";
                                 }else if (att_status=="A"){
                                  status="";
                                 }else{
                                  status="checked";
                                 }
                                 var att_remark =data[i]['att_remark']; 
                                 if(att_remark==null){
                                  att_remark="";
                                 }else{
                                  att_remark=att_remark;
                                 }
                              $(subject).empty().append('<option selected="selected" value=""> Please Select </option>');

                             $(subject).empty();
                              var nosubject="No Subject available for this course";
                     if(subjects.length==""){
                                $("#subject").append('<option value="' +nosubject +'">' + nosubject + '</option>');
                     }
                       else{
                                for (var i in subjects) {
                                  var v=subjects[i]['subject'];
                                  var v1=subjects[i]['subject_name'];
                                  $(subject).append('<option value="' +v +'">' + v1 + '</option>');

                               }
                   }
                   if (att_status=="A"){
                    $(this).css('background','red');
                 //   alert();
                                   }
                      var trDOM=  t.row.add( [
                                    '<input class="stt" type="checkbox" name="st"  '+status+'/> '  ,
                                    roll_no,
                                    reg_no,
                                    stu_name,
                                    '<input type="text" class="form-control" value="'+att_remark+'" name="remark"/>'
                                   ] ).draw( false );
                                  

                                 //  $( trDOM ).addClass('selected');
                          //     $('#example').append('<tbody>' + markup + '</tbody>');
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


         /*       $("#example tbody").on('click', 'tr', function (event){
  //alert();
              if(($(this).hasClass("selected")).length!=0){
                  if($(this).hasClass("selected")){
                //  alert("unchecked");
                   var stu_name = $(this).find("td").eq(2).html();
                   var remark = $(this).find('td:eq(4) input').val();
                   student.pop();
                   studentids.pop();
              //     alert(student);
                     }
                  else{
                      var stu_name = $(this).find("td").eq(2).html();
                      var remark = $(this).find('td:eq(4) input').val();
                      student.push(stu_name);
                      studentids.push({'reg_no':stu_name});
                      //attendancelist
                      student.push(remark);
                  //     alert(stu_name);

                  }

              //    alert(studentids);
                     attendancelist = JSON.stringify(studentids);
                    }else{
                      alert("Please Select Student.");
                    }
              });*/
              /*For Details Loading*/
              $("#save").click(function () {
              //  alert(attendancelist);
                 var _url = $("#_url").val();
                 var date=$("#startdate").val();
                 var course=$("#course").val();
                 var batch=$("#batch").val();
                 var subject=$("#subject").val();
                 var subject_name=$("#subject option:selected").text();
                // alert(subject_name);
                // alert(attendancelist);
                 var att_array = new Array();

                      $("#example tbody tr").each(function () {

                var row = $(this);

                var att = {};
               // att.statuss = row.find('td:eq(0) input').val();
                if(row.find('td:eq(0) input'). prop("checked") == true)
                {
                    //console.log("checked");
                    att.statuss = "P";
                }else{
                     att.statuss = "A";
                }
                att.roll = row.find("td").eq(1).html();
                att.reg_no = row.find('td:eq(2)').html();
                att.name = row.find('td:eq(3)').html();
                att.remark = row.find('td:eq(4) input').val();
              //  customer.Month = row.find("td").eq(5).html();

                att_array.push(att);
                //console.log(cnt);
            });

              //        alert(JSON.stringify(att_array));

            var dataa =JSON.stringify(att_array)
              //console.log(dataa);
            //  exit;
                 if(course !=""){
                 if(date!=""){
                  $.ajax
                  ({
                      type: "POST",
                      url: _url + '/student/attendance/save',
                      data:{dates: date,course:course,batch:batch,subject:subject,stu_id:dataa,subject_name:subject_name},
                      cache: false,
                      success: function ( data ) {
                      //  alert(data);
                          table = $("#example").DataTable();
                      if(data=="1"){
                        alert('Attendance Marked Succesfully.');
                        table.clear().draw();
                      }else{
                        //alert(data);
                        alert('Someting Went Worng.Please try again.');
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

            }else{
              alert("Please Select Date First");
            }
            }else{
            alert("Please Select Course First");
            }
              });

             });

      </script>

<script>
  $(function () {
	//  alert();
    var date = new Date();
    date.setDate(date.getDate()-1);
    //Initialize Select2 Elements
    $('.select2').select2();
    $('#startdate').datepicker({
      autoclose: true,
     // startDate: date,
     // endDate: '+0d',
      format:'dd-mm-yyyy'
    });
    $('.dob').datepicker({
      autoclose: true,
    //  startDate: date,
    //  endDate: '+0d',
      format:'dd-mm-yyyy',
    //  maxDate: 0
    });
  });
</script>
@endsection
<!-- ./wrapper -->
