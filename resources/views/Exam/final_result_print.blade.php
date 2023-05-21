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
        <li><a href="#"><i class="fa fa-dashboard"></i> Examination</a></li>

        <li class="active">Result Bunch</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        @include('notification.notify')
        <div class="box box-default">
               <div class="box-header with-border">
               <h3 class="box-title">Exam Result Bunch</h3>

                <div class="box-tools pull-right">

                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  <button style="display:none;" type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                </div>
              </div>
          <!-- /.box-header -->
            <div class="box-body">
            <div class="row">
              <div class="col-md-12">
                <form method="post" action="{{url('Exam/final_result/print/back')}}">

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
                                <label>Exam</label>
                                <select class="form-control select2" name="exam" id="exam" style="width: 100%;" required>
                                    <option value="" selected="selected">Please Select</option>
                                    <?php foreach ($exam as $exam): ?>
                                         <option selected value="{{$exam->id}}">{{$exam->exam_name}}</option>
                                    <?php endforeach; ?>
                              </select>
                           </div>
                         </div>
                            <div class="col-md-3">
                              <div class="form-group">
                                <label>Class/Course</label>
                                <select class="form-control select2" id="courses"   name="course" style="width: 100%;" required>
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
                              <label>Batch/Section</label>
                            <select class="form-control select2" id="batch"  name="batch" style="width: 100%;" required>
                                          <option  value="" selected="selected">Select Batch</option>

                            </select>
                          </div>
                          </div>

                          @if(isset($individual))
                          <div class="col-md-3">
                            <div class="form-group">
                              <label>Admission No.</label>
                             <input type="text" value="" class="form-control" name="reg_no" required/>
                             <input type="hidden" value="{{$individual}}" class="form-control" name="individual"/>
                          </div>
                          </div>
                          @endif

                           <div class="box-footer col-md-12">
                             <div class="col-md-6">
  <input type="submit" class="btn btn-warning"  id="result_downloads" value="Print Back"/>
</div>
<input type="hidden" name="_token" value="{{ csrf_token() }}">
 <div class="col-md-6">
  <input type="submit" class="btn btn-info" value="Print Front"  id="result_downloadss" />
</div>
                           </div>

                          </div>
  </div>
</form>

</div>
</div>
</div>

    </div>


</section>
</div>


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
                      var emptycarno="No Batch found for this Class";
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
   <script>
         $(document).ready(function () {

                 $("#result_download").click(function (e) {
                       var cid=$("#courses").val();
                       var reg_no=$("#student").val();

                       var session=$("#accadmicyear").val();
                       var batch=$("#batch").val();
                       var exam=$("#exam").val();
           if(session!=""){
               if(exam != ""){
                    if(cid != ""){
                         if(batch != ""){

                e.preventDefault();
                var id = this.id;
                 var dataString = 'cid='+cid+'&reg_no='+btoa(reg_no)+'&session='+session+'&batch='+batch+'&exam='+exam;
                bootbox.confirm("Are you sure?", function (result) {

                                  if (result) {
                        var _url = $("#_url").val();
                        window.location.href = _url + "/Exam/download/result/final/bunch/" + cid+"/"+session+"/"+batch+"/"+exam;
                    }

                });

                         }else{
                             alert("Please Select Batch.");
                         }
                    }else{
                        alert("Please Select Course.");
                    }
               }else{
                    alert("Please Select Exam.");
               }
           }else{
               alert("Please Select Session.");
           }


            });


         });
   </script>

   <script>
       function get_result()
       {
         //alert(id);
         var cid=$("#courses").val();
          var id=$("#student").val();
        var _url = $("#_url").val();
      var ds=cid+'&'+id;

      window.location.href = _url + "/Exam/mark_by_student_name/"+ds;
       }
       </script>
  </form>

@endsection
<!-- ./wrapper -->
