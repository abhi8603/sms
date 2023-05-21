
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

        <li class="active">Student Get Pass</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        @include('notification.notify')

  <div class="box box-default">
           <div class="box-header with-border">
           <h3 class="box-title">Student Get Pass</h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              <button style="display:none;" type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
            </div>
          </div>
          <!-- /.box-header -->

          <form role="form" method="post" enctype="multipart/form-data" action="{{url('student/insert_get_pass_student')}}">

          <div class="box-body">
            <div class="row">
              <div class="col-md-12">

                <!-- /.form-group -->
                <div class="box box-primary">
                      <div class="row"> 
                        <div class="col-sm-4">
                          <label>Class</label>
                          <div class="form-group">
                            <select name="course" id="courses"   class="form-control select2" required="">
                              <option value="">Please Select</option>
                              @foreach($courses as $course)
                                <option value="{{$course->id}}">{{$course->course_name}}</option>
                              @endforeach
                            </select>
                          </div>

                        </div>
                     <div class="col-md-4">
                             <div class="form-group">
                              <label>Section</label>
                            <select class="form-control select2" id="batch"  name="batch" style="width: 100%;" required>
                                          <option  value="" selected="selected">Select Section</option>

                                    </select>     
                            </div>
                      </div>
                          <div class="col-md-3">
                             <div class="form-group">
                              <label>Student</label>
                            <select class="form-control select2" id="student"  name="student" style="width: 100%;" required>
                                          <option  value="" selected="selected">Select Student</option>

                                    </select>                        </div>
                          </div>
                        </div><hr>
                        <div class="row">
                        <div class="col-md-12">
                        <div class="callout callout-info">
                                 <span class="pull-left-container">
                                   <i class="fa fa-info-circle pull-left"></i>
                                 </span>
                                 <p> Details of Person coming to take student.</p>
                               </div>
                          
                        </div><br>
                          <div class="col-sm-4">
                           
                            <div class="form-group">
                              <label>Person Name <span style="color:red;">*</span></label>
                              <input type="text" name="person_name" class="form-control" required="">
                            </div>
                          </div>
                          <div class="col-sm-4">                          
                            <div class="form-group">
                              <label>Contact Number <span style="color:red;">*</span></label>
                              <input type="text" name="contact_number" class="form-control" required="">
                            </div>
                          </div>
                          <div class="col-sm-4">                          
                          <div class="form-group">
                           <label>Date</label>
                               <div class="input-group date">
                               <div class="input-group-addon">
                               <i class="fa fa-calendar"></i>
                               </div>
                               <input type="text" class="form-control pull-right" id="startdate" name="pass_date">
                              </div>
                                              <!-- /.input group -->
                            </div>
                          </div>
                          <div class="col-sm-4">
                          
                          <div class="form-group">
                            <label>ID Proof <span style="color:red;">*</span></label>
                            <select class="form-control select2" id="idproff"  name="idproof" style="width: 100%;" required>
                            <option  value="" selected="selected">Select Section</option>
                            <option  value="Addhar Card" selected="selected">Addhar Card</option>
                            <option  value="PAN Card" selected="selected">PAN Card</option>
                            <option  value="Voter Card" selected="selected">Voter Card</option>
                            <option  value="Driving Licence" selected="selected">Driving Licence</option>
                           </select> 
                          </div>
                        </div>
                        <div class="col-sm-4">                          
                          <div class="form-group">
                            <label>ID Proof Number <span style="color:red;">*</span></label>
                            <input type="text" name="idproofno" class="form-control" required="">
                          </div>
                        </div>

                        </div>
                        <div class="row">
                          <div class="col-sm-12">
                            <div class="form-group">
                              <label>Reason <span style="color: red;">*</span></label>
                              <textarea name="reason" class="form-control" required=""></textarea>
                            </div>
                          </div>
                        </div>
                  <div class="col-md-2">
                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                          <input type="submit" name="" class="btn btn-primary" value="Submit">
                           </div>
                          </div>
               </div>
             </div>
    </div>
    </form>
    </div>
     

    </div>


  </section>
</div>
  <!-- /.content-wrapper -->

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
  $(function () {
    var date = new Date();
    date.setDate(date.getDate()-1);
    //Initialize Select2 Elements
    $('.select2').select2();
    $('#startdate').datepicker({
      autoclose: true,
    //  startDate: date,
      endDate: '+0d',
      format:'dd-mm-yyyy'
    });
   
  });
</script>
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
       $(document).ready(function () {
           /*For Details Loading*/
           $("#batch").change(function(){
               
               var cid=$("#courses").val();
               var bid=$("#batch").val();

          //     alert(id);
               var _url = $("#_url").val();
               var dataString = 'cid=' + cid+ '&bid='+bid;
               $.ajax
               ({
                   type: "POST",
                   url: _url + '/student/studentlist',
                   data: dataString,
                   cache: false,
                   success: function ( data ) {
                     data=JSON.parse(data);

                      //   alert(data);
                         var list = $("#student");
                      $(list).empty().append('<option selected="selected" value=""> Please Select </option>');

                     $(data).empty();
                      var emptycarno="No batch available for this course";
             if(data.length==""){
                        $("#student").append('<option value="' +emptycarno +'">' + emptycarno + '</option>');
             }
               else{
                        for (var i in data) {
                          var v=data[i]['reg_no'];
                          var v1=data[i]['stu_name'];
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

   $('#wrk').dataTable({
            bDestroy: true
        }).fnDestroy();
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

<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()


  })
</script>
<script>
function myday() {
  var x = document.getElementById("days").value;
  document.getElementById("demo").innerHTML = x;
}
</script>

<script>
      $(function () {
        //Initialize Select2 Elements
        $('.select2').select2();
        $('#startdate').datepicker({
          autoclose: true,
          format:'dd-mm-yyyy'
        });
        $('#dob').datepicker({
          autoclose: true,
          format:'dd-mm-yyyy'
        });
        $('.timepicker').timepicker({
              showInputs: false
            })
        //Datemask dd/mm/yyyy

      });
    </script>
</form>



 @endsection

<!-- ./wrapper -->
