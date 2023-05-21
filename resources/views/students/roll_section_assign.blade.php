
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

        <li class="active">Roll and Section Allocation</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        @include('notification.notify')

  <div class="box box-default">
           <div class="box-header with-border">
           <h3 class="box-title">Roll and Section Allocation</h3>

            <div class="box-tools pull-right">
              <a href="{{url('student/update_roll_section')}}"> <button style="" type="button" class="btn btn-primary">Update Class and Section</button></a>
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
             
            </div>
          </div>
          <!-- /.box-header -->

          <form role="form" method="post" enctype="multipart/form-data" action="{{url('student/assign_roll_section')}}">

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
                                <label>Class/Course</label>
                                <select class="form-control select2" id="courses"   name="course" style="width: 100%;" required>
                                    <option value="" selected="selected">Please select Course/Class</option>
                                     <?php
                                      foreach($courses as $row)
                                      {
                                        ?>
                                        <option value="<?php echo $row->id ?>"><?php echo $row->course_name; ?></option>

                                        <?php
                                      }
                                      ?>


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
                    <th>Student</th>
                   <th>Class</th>
                   <th>Section</th>
                   <th>Roll No</th>

             </thead>

                  <tbody>

                  </tbody>

                </table>

               </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-3">
                  <input type="submit" name="sub" value="Submit" class="btn btn-primary">
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
               var academicyear=$("#accadmicyear").val();
               var dataString = 'eid=' + id+'&academicyear='+academicyear;
               //alert(dataString);
               $.ajax
               ({
                   type: "POST",
                   url: _url + '/student/studenlist',
                   data: dataString,
                   cache: false,
                   success: function ( data ) {
                     //alert(data);
                      var sp = data.split("|");
                   var sp1=JSON.parse(sp[0]);
                   //alert(data);
                   var sp2=JSON.parse(sp[1]);
                    //alert(data);


                    var cnt="";
                    for (var i = 0; i < sp1.length; i++) {
                      cnt += '<tr>';
                      cnt +='<td>'+sp1[i].stu_name +'<input type="hidden" name="reg_no[]" value="'+sp1[i].reg_no+'"></td>';
                      cnt +='<td>'+sp1[i].course_name +'<input type="hidden"  value="'+sp1[i].course+'"></td>';
                      cnt +='<td><select name="batch[]">';
                      for(var j=0;j<sp2.length;j++)
                      {
                        
                            cnt +='<option value="'+sp2[j].id+'">'+sp2[j].batch_name+'</option>';
                      }
                      cnt +='</select></td>';
                      cnt +='<td><input class="mark" type="text" style="width:70px;"  name="roll_no[]" required ></td>';
                      cnt += '</tr>';
                  }
                    $('#wrk').find('tbody').empty().append(cnt);

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
