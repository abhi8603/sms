
@extends('header')

@section('style')
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/bootstrap/dist/css/buttons.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/bootstrap/dist/css/rowReorder.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/bootstrap/dist/css/responsive.dataTables.min.css') }}">
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
        <li><a href="#"><i class="fa fa-dashboard"></i> HomeWork</a></li>

        <li class="active">Home Work List</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        @include('notification.notify')

  <div class="box box-default">
           <div class="box-header with-border">
           <h3 class="box-title">Home Work List</h3>

            <div class="box-tools pull-right">
             <a href="{{url('homework/createhomework')}}">
                <button type="button" class="btn btn-primary"><i class="fa fa-plus"> Add</i></button>
              </a>
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
                                <label>Class</label>
                                <select class="form-control select2" id="courses"   name="course" style="width: 100%;" required>
                                    <option value="" selected="selected">Please select Class</option>
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
                                          <option  value="" selected="selected">Select Batch/Section</option>

                                    </select>                        </div>
                          </div>
                           <div class="col-md-3">
                              <div class="form-group">
                              <label>Subject</label>
                            <select class="form-control select2" id="subject" onchange="homeworklist()" name="subject" style="width: 100%;" required>
                                          <option  value="" selected="selected">Select Subject</option>

                                    </select>

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
   <div class="box-body">
            <div class="row">
              <div class="col-md-12">
               <div class="table-responsive">
                 <table class="table table-striped table-bordered display" id="wrk">
                  <thead>
                   <th>Sl.No</th>
                   <th>Class</th>
                   <th>Section</th>
                   <th>Subject</th>
                   <th>HomeWork Date</th>
                   <th>Submission Date</th>
                   <th>Evaluate</th>
             </thead>

                  <tbody>


                  </tbody>

                </table>
               </div>
                </div>
              </div>
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

$(document).ready(function() {

   $('#cls').dataTable({
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
       <script>
       $(document).ready(function () {
           /*For Details Loading*/
           $("#batch").change(function(){
               //var id = $(this).val();
          //     alert(id);

          var cid=$("#courses").val();
          var bid=$("#batch").val();
               var _url = $("#_url").val();
               var dataString = 'cid='+cid+"&bid="+bid;
              // alert(dataString);
               $.ajax
               ({
                   type: "POST",
                   url: _url + '/homework/getSubjectbyclass',
                   data: dataString,
                   cache: false,
                   success: function ( data ) {
                     data=JSON.parse(data);

                    // alert(data);
                         var list = $("#subject");
                      $(list).empty().append('<option selected="selected" value=""> Please Select </option>');

                     $(data).empty();
                      var emptycarno="No Subject Assigned for this Class";
             if(data.length==""){
                        $("#subject").append('<option value="' +emptycarno +'">' + emptycarno + '</option>');
             }
               else{
                        for (var i in data) {
                          var v=data[i]['id'];
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

       });
   </script>
      <script type="text/javascript">
     function homeworklist()
     {
      var table =$('#wrk').DataTable();
      var cid=$("#courses").val();
      var bid=$("#batch").val();
      var sub=$("#subject").val();
       var _url = $("#_url").val();
      var dataString='cid='+cid+'&bid='+bid+'&sub='+sub;
      //alert(dataString);

      $.ajax({
         type: "POST",
         url: _url + '/homework/homework',
        data: dataString,
        cache: false,
        success:function(data)
        {
          data=JSON.parse(data);
          table.clear().draw();
               //alert(data);
               var j=0;
          for(var i in data)
          {
            j=i+1;
            table.row.add( [
                    j,
                    data[i]['course_name'],
                    data[i]['batch_name'],
                    data[i]['subject_name'],
                    data[i]['homework_date'],
                    data[i]['date_of_submission'],
                    '<div><input type="hidden" id="crs" value="'+data[i]['id']+'">\
                    <button type="button" id="ev" data-toggle="modal" data-target="#myModal" onclick="eval()" value="'+data[i]['id']+'">\
                    <i class="fa fa-bars"></i></button>\
                    </div>'

                    ] ).draw( false );
          }
          //alert(data);
        }

     });
    }
   </script>
 <script type="text/javascript">
   function eval()
   {

      var cid=$("#crs").val();
      var _url = $("#_url").val();
    //  alert(cid);exit;
      var ds=cid;


    window.location.href = _url + "/homework/evaluate/"+ds;

   }
 </script>
 @endsection

<!-- ./wrapper -->
