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
        <li><a href="#"><i class="fa fa-dashboard"></i>Student</a></li>

        <li class="active">Update Student Transport</li>
      </ol>
    </section>

    <!-- Main content -->
      <section class="content">
          @include('notification.notify')
    <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Update Student Transport</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button style="display:none;" type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                  <div class="col-md-12" id="stuinfo">
                   <form role="form" method="post" enctype="multipart/form-data" action="{{url('transport/allocation/update')}}">
                  <div class="box-header with-border">
                    <h3 class="box-title">Student details:-</h3>
                  </div>
                <div class="form-group col-md-4">
                 <label for="exampleInputEmail1">Student Name<span style="color:red;"> *</span></label>
                 <input type="text" class="form-control" id="student_name" name="stu_name" value="{{$stu_name OR ''}}" readonly>
                </div>
                <div class="form-group col-md-4">
                 <label for="exampleInputEmail1">Registration No.<span style="color:red;"> *</span></label>
                 <input type="text" class="form-control" id="reg_no" name="reg_no" value="{{$reg_no OR ''}}" readonly>
                </div>
                <div class="form-group col-md-4">
                 <label for="exampleInputEmail1">Class/Course<span style="color:red;"> *</span></label>
                 <input type="text" class="form-control" id="class" name="course" value="{{$course OR ''}}" readonly>
                </div>
                <div class="form-group col-md-4">
                 <label for="exampleInputEmail1">Section/Batch<span style="color:red;"> *</span></label>
                 <input type="text" class="form-control" id="batch" name="batch" value="{{$batch OR ''}}" maxlength="10" readonly>
                </div>
                <div class="form-group col-md-4">
                 <label for="exampleInputEmail1">Name of Guardian</label>
                 <input type="text" class="form-control" id="parents" name="parent_name" maxlength="10" value="{{$parent_name OR ''}}" readonly>
                </div>
                <div class="form-group col-md-4">
                 <label for="exampleInputEmail1">Contact No.<span style="color:red;"> *</span></label>
                 <input type="text" class="form-control" id="contact" name="contact_no" value="{{$contact_no OR ''}}" readonly>
                </div>
                <div class="form-group col-md-4">
                  <label for="exampleInputEmail1">Status</label>
                  <select class="form-control select2" name="status" style="width: 100%;">
                      <option value="1" @if($status=='1') selected @endif >Active</option>
                      <option value="0" @if($status=='0') selected @endif>Inactive</option>
               </select>
             </div>
                <div class="col-md-12">
                <div class="box-header with-border">
                  <h3 class="box-title">Transport details:-</h3>
                </div>
                <div class="form-group col-md-3">
                  <label for="exampleInputEmail1">Route</label>
                  <select class="form-control select2" id="routes" name="route" style="width: 100%;">
                      <option value="0" selected="selected">Please Select Route</option>
                      <?php foreach ($route as $route): ?>
                          <option value="{{$route->id}}" @if($routes==$route->id) selected  @endif >{{$route->routecode}}</option>
                      <?php endforeach; ?>

               </select>
             </div>
             <div class="form-group col-md-3">
               <label for="exampleInputEmail1">Destination</label>
               <select class="form-control select2" id="destination" name="destination" style="width: 100%;">
                   <option value="0" selected="selected">Please Select Destination</option>
                   @if($destination){
                      <option value="{{$destination}}" selected="selected">{{$destination}}</option>
                   }
                   @endif
            </select>
          </div>
          <div class="form-group col-md-3">
                          <label>Start Date</label>
                          <div class="input-group date">
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control pull-right" value="{{ $startdate OR '' }}" id="dob" name="start_date" required>
                          </div>
                          <!-- /.input group -->
                        </div>
          <div class="form-group col-md-3">
              <label>End Date</label>
              <div class="input-group date">
              <div class="input-group-addon">
              <i class="fa fa-calendar"></i>
            </div>
          <input type="text" class="form-control pull-right" value="{{ $enddate OR '' }}" id="startdate" name="end_date" required>
        </div>
                                        <!-- /.input group -->
        </div>
      <div class="box-footer">
      <button type="submit" class="btn btn-primary">Update</button>
      </div>
      </div>

    <input type="hidden" name="_token" value="{{ csrf_token() }}">
</form>
                </div>

              </section>
    <!-- /.content -->
  </div>

</div>
  <!-- /.content-wrapper -->

@endsection
{{--External Style Section--}}
@section('script')
<script src="{{ URL::asset('assets/bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
<script>
       $(document).ready(function () {
           /*For Details Loading*/
           $("#routes").change(function(){
               var id = $(this).val();
              // alert(id);
               var _url = $("#_url").val();
            //    alert(_url);
               var dataString = 'eid=' + id;
               $.ajax
               ({
                   type: "POST",
                   url: _url + '/transport/routedestination',
                   data: dataString,
                   cache: false,
                   success: function ( data ) {
                     data=JSON.parse(data);
                      //  alert(data);
                         var list = $("#destination");
                      $(list).empty().append('<option selected="selected" value=""> Please Select </option>');

                     $(data).empty();
                      var emptycarno="No Destination available for this Route";
             if(data.length==""){
                        $("#destination").append('<option value="' +emptycarno +'" selected="selected">' + emptycarno + '</option>');
                        alert(emptycarno);
             }
               else{
                        for (var i in data) {
                          var v=data[i]['id'];
                          var v1=data[i]['pickanddrop'];
                          $(list).append('<option value="' +v1 +'">' + v1 + '</option>');
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
       responsive: true
   } );
   } );

</script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
    $('#startdate').datepicker({
      autoclose: true,
      format:'dd-mm-yyyy'
    });
    $('#dob').datepicker({
      autoclose: true,
      format:'dd-mm-yyyy'
    });
  })
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
@endsection
<!-- ./wrapper -->
