@extends('header')
@section('style')
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/buttons.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/rowReorder.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/responsive.dataTables.min.css') }}">
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
        <li class="active">Subject-Allocation</li>
      </ol>
    </section>
    <section class="content">
        @include('notification.notify')
  <div class="box box-default">
    <!-- Main content -->
    <div class="box-header with-border">
      <h3 class="box-title">Subjects</h3>
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
                <li class="active"><a href="#tab_1" data-toggle="tab">Subject Allocation</a></li>
                <li style="display:none;"><a href="#tab_2" data-toggle="tab">Report</a></li>
               <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                  <div class="box-body">
                    <div class="row">
                      <div class="col-md-5">

                        <!-- /.form-group -->
                        <div class="box box-primary">
                                 <div class="box-header with-border">
                                   <h3 class="box-title">Subject Allocation</h3>
                                 </div>
                                 <!-- /.box-header -->
                                 <!-- form start -->
                                 <form role="form" method="post" enctype="multipart/form-data" action="{{url('subject/subject-assign')}}">
                                   <div class="box-body">
                                     <div class="col-md-12">
                                     <div class="form-group">
                                       <label for="exampleInputEmail1">Acadmic Year<span style="color:red;"> *</span></label>
                                       <select class="form-control select2" name="addacadmicyear" style="width: 100%;" required>
                                         <?php foreach ($Acadmicyear as $Acadmicyear): ?>
                                             <option value="{{$Acadmicyear->startyear}}-{{$Acadmicyear->endyear}}" @if($Acadmicyear->status=='1') selected @endif >{{$Acadmicyear->startyear}} - {{$Acadmicyear->endyear}}</option>
                                         <?php endforeach; ?>

                                    </select>
                                  </div>
                                      <div class="form-group">
                                       <label for="exampleInputEmail1">Employee Name<span style="color:red;"> *</span></label>
                                       <select class="form-control select2" id="emp" name="emp_id" style="width: 100%;" required>
                                           <option value="" selected="selected">Select Employee</option>
                                          @foreach($emp as $emp)
                                          <option value="{{$emp->empcode}}">{{$emp->fname}} {{$emp->mname}}  {{$emp->lname}} - {{$emp->empcode}}</option>
                                          @endforeach

                                    </select>
                                   </div>

                                     <div class="form-group">
                                       <label for="exampleInputEmail1">Class<span style="color:red;"> *</span></label>
                                       <select class="form-control select2" id="course" name="course" style="width: 100%;" required>
                                           <option value="" selected="selected">Select Class</option>
                                           <?php foreach ($course as $course): ?>
                                                <option value="{{$course->id}}">{{$course->course_name}}</option>
                                           <?php endforeach; ?>

                                    </select>
                                    </div>
                                     <div class="form-group">
                                       <label for="exampleInputEmail1">Section<span style="color:red;"> *</span></label>
                                       <select class="form-control select2" id="batch" name="batch" style="width: 100%;" required>
                                          <option  value="" selected="selected">Select Section</option>

                                    </select>
                                     </div>
                                    
                                     <div class="form-group">
                                       <label for="exampleInputEmail1">Subject<span style="color:red;"> *</span></label>
                                       <select class="form-control select2" multiple name="subject[]" id="subject" style="width: 100%;" required>
                                           <option value="">Select Subject</option>
                                        <!--   <?php foreach ($subject as $subject): ?>
                                                <option value="{{$subject->id}}">{{$subject->subject_name}} - {{$subject->subject_code}}</option>
                                           <?php endforeach; ?>-->

                                    </select>
                                    </div>

                                   </div>

                                 </div>
                                   <div class="box-footer">
                                     <button type="submit" class="btn btn-primary">Save</button>
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                   </div>
                                 </form>
                               </div>

                        <!-- /.form-group -->
                      </div>
                      <div class="col-md-7">
                        <div class="box box-info">
                          <div class="box-header">
                            <h3 class="box-title">Assigned Subjects List</h3>
                          </div>
                          <!-- /.box-header -->
                          <div class="box-body">
                            <table id="example" class="table table-striped table-bordered display" style="width:100%;">
                              <thead>
                              <tr>
                                <th>Sl.No</th>
                                <th>Session Year</th>
                                <th>Employee Name</th>
                                <th>Class</th>
                                <th>Section</th>
                                <th>Subject</th>
                                <th>Action</th>

                              </tr>
                              </thead>
                              <tbody>
                                @php $i=0 @endphp
                                @foreach($subsallocation as $subsallocation)
                                  @php $i++; @endphp
                              <tr>
                                <td><?php echo $i; ?></td>
                                <td>{{$subsallocation->acadmic_year }}</td>
                                <td>{{$subsallocation->fname }} {{$subsallocation->mname }} {{$subsallocation->lname }} - {{$subsallocation->empcode }}</td>
                                  <td>{{$subsallocation->course_name }}</td>
                                    <td>{{$subsallocation->batch_name }}</td>
                                      <td>{{$subsallocation->subject_name }} - {{$subsallocation->subject_code }}</td>
                                <td>
                              <div class="btn-group">
                                <button type="button" class="btn btn-default  btn-flat dropdown-toggle" data-toggle="dropdown">
                                  <span class="caret"></span>
                                  <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <ul class="dropdown-menu" role="menu" title="Action">
                                  <li style="display:none;"><a href="#" title="Edit"><i  class="fa fa-eye" style="color: #897df8e6";></i></a></li>
                                  <li><a  class="tFileDelete" id="{{$subsallocation->id}}" title="Delete"><i class="fa fa-trash" style="color: red";></i></a></li>
                                </ul>
                              </div>
                              </td>

                              </tr>
                              @endforeach
                              </tbody>

                            </table>
                          </div>
                          <!-- /.box-body -->
                        </div>
              </div>
            </div>
          </div>
        </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="tab_2">
                  <form role="form" method="post" enctype="multipart/form-data" action="{{url('subject/subject-assign/postsearch')}}">
                  <div class="box-body">
                    <div class="row">
                      <div class="col-md-5">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Class<span style="color:red;"> *</span></label>
                          <select class="form-control select2" id="courses" name="courses" style="width: 100%;" required>
                              <option value="" selected="selected">Please Select</option>
                              <?php foreach ($courses as $courses): ?>
                                   <option value="{{$courses->id}}">{{$courses->course_name}}</option>
                              <?php endforeach; ?>
                       </select>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Section<span style="color:red;"> *</span></label>
                        <select class="form-control select2" id="batchs" name="batches" style="width: 100%;" required>
                            <option value="" selected="selected">Please Select</option>

                     </select>
                    </div>

                        </div>
                        </div>
                        </div>
                        <div class="col-md-12">
                          <div class="box box-info">
                            <div class="box-header">
                              <h3 class="box-title">Report</h3>

                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                  <a id="print" class="btn btn-primary" style="float: right;" >Print</a><br>
                              <table id="examples" class="table table-striped table-bordered display price" style="width:100%;">
                                <thead>
                                <tr>
                                <!--  <th>Sl.No</th> -->
                                  <th>Department</th>
                                  <th>Employee Name</th>
                                  <th>Course/Class</th>
                                  <th>Batch/Section</th>
                                  <th>Subject</th>

                                </tr>
                                </thead>
                                <tbody>

                                </tbody>

                              </table>
                            </div>
                            <!-- /.box-body -->
                          </div>
                </div>
                      </form>
                </div>
              
              <!-- /.tab-content -->
            </div>
            <!-- nav-tabs-custom -->
          </div>
          </div>

        </div>
        </div>
        </div>
        </div>
          </div>
    </section>
    <!-- /.content -->
</div>

  <!-- /.content-wrapper -->

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
<script src="{{ URL::asset('assets/bower_components/jquery/dist/bootbox.min.js') }}"></script>
<script>
function printData()
{
   var divToPrint=document.getElementById("examples");
   newWin= window.open("");
   newWin.document.write(divToPrint.outerHTML);
   newWin.print();
   newWin.close();
}
</script>
<script>
     $(document).ready(function () {
       $('#print').on('click',function(){
       printData();
       })
       $("#batchs").change(function ()
      {
           // Do something...
            var batch=($(this).val());
           var courses=$("#courses").val();

            var _url = $("#_url").val();
          //  var dataString = 'eid=' + month,'course='+course;
            $.ajax
            ({
                type: "POST",
                url: _url + '/subject/subject-assign/postsearch',
                data: {batch:batch,course:course},
                cache: false,
                success: function ( data ) {
                  //alert(data);
                $('.price tbody > tr').remove();
                  data=JSON.parse(data);
                     if(data==""){
                       alert("Please Configure Fee Master for this Class/Section for this month");
                     }
                     for (var i in data) {
                       var v1=data[i]['department'];
                       var v2=data[i]['fname'];
                       var v3=data[i]['mname'];
                       var v4=data[i]['lname'];
                       var v5=data[i]['empcode'];
                       var v6=data[i]['subject_name'];
                       var v7=data[i]['subject_code'];
                       var v8=data[i]['batch_name'];
                       var v9=data[i]['course_name'];

                       var markup = "<tr><td>"+v1+"</td><td>" + v2 +  " " + v3 +  " " + v4 +  " - " + v5 +  "</td><td class='price'>" + v9 + "</td><td>" + v8 + "</td><td>" + v6 + " - " + v7 + "</td></tr>";
                    //   alert(markup);
                       $('.price tbody').append(markup);
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
 }


      });
    });
  });
</script>
<script>
       $(document).ready(function () {
       // alert();
        $(".tFileDelete").click(function (e) {
          alert();
                e.preventDefault();
                var id = this.id;
                bootbox.confirm("Are you sure?", function (result) {
                    if (result) {
                        var _url = $("#_url").val();
                        window.location.href = _url + "/subject/subject-assign/delete/" + id;
                    }
                });
            });


           /*For Details Loading*/
           $("#courses").change(function () {
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
                      $(list).empty().append('<option value=""> Please Select </option>');

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
                      $(list).empty().append('<option  value=""> Please Select </option>');

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

           /*For Details Loading*/
           $("#batch").change(function () {
               var course = $("#course").val();
            //   alert(course);exit;
               var _url = $("#_url").val();
               $.ajax
               ({
                   type: "POST",
                   url: _url + '/subject/getSubject',
                   data: {class_id:course},
                   cache: false,
                   success: function ( data ) {
                     data=JSON.parse(data);

                        // alert(data);exit;
                         var list = $("#subject");
                      $(list).empty().append('<option  value="">-- Please Select Subject -- </option>');

                     $(data).empty();
                      var emptycarno="Subject Not Found";
             if(data.length==""){
                        $("#subject").append('<option value="' +emptycarno +'">' + emptycarno + '</option>');
             }
               else{
                        for (var i in data) {
                          var v=data[i]['subject'];
                          var v1=data[i]['subject_name'];
                           $(list).append('<option value="' +v +'">' + v1 +  '</option>');

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
  $('#example').DataTable();
/*    $.extend($.fn.dataTable.defaults, {
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

*/

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
  });
</script>
@endsection
<!-- ./wrapper -->
