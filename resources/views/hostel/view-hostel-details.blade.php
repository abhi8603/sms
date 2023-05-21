@extends('header')
@section('style')
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/buttons.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/rowReorder.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/responsive.dataTables.min.css') }}">
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
        <li><a href="#"><i class="fa fa-dashboard"></i>Hostel </a></li>
        <li class="active">Hostel Details View</li>
      </ol>
    </section>
    <section class="content">
        @include('notification.notify')
  <div class="box box-default">
    <!-- Main content -->
    <div class="box-header with-border">
      <h3 class="box-title">Hostel Details Update </h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        <button style="display:none;" type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
      </div>
    </div>

        <div class="row">
          <div class="col-md-12">
                  <div class="box-body">
                    <div class="row">
                        <form role="form" method="post" enctype="multipart/form-data" action="{{url('hostel/hosteldetails/update')}}">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Hostel Type<span style="color:red;"> *</span></label>
                          <select class="form-control select2" name="hostel_type"  style="width: 100%;">
                              <option selected="selected">Please Select</option>
                            <?php foreach ($hosteltype as $hosteltypes): ?>
                                <option value="{{$hosteltypes->id}}" @if($hosteltypess==$hosteltypes->id) selected @endif>{{$hosteltypes->hotel_type}}</option>
                            <?php endforeach; ?>
                       </select>
                      </div>
					       <div class="form-group">
                <label for="exampleInputEmail1">Hostel Name <span style="color:red;"> *</span></label>
                <input type="text" class="form-control" value="{{$hostel_name OR ''}}" name="hostel_name" required>
                  <input type="hidden" class="form-control" value="{{$id OR ''}}" name="id" id="id">
                </div>
					  <div class="form-group">
            <label for="exampleInputEmail1">Hostel Address<span style="color:red;"> *</span></label>
            <textarea type="text" class="form-control" name="hostel_address" id="reg_no" required>{{$hostel_address OR ''}}</textarea>
            </div>
					  <div class="form-group">
                          <label for="exampleInputEmail1">Hostel Phone Number<span style="color:red;"> *</span></label>
                           <input type="text" class="form-control" value="{{$hostel_phone OR ''}}" name="hostel_phone"  value="" id="extra7" name="extra7" onkeypress="return isNumber(event)" maxlength="10" required>

                      </div>
					  <div class="form-group">
                          <label for="exampleInputEmail1">Warden Name<span style="color:red;"> *</span></label>
                        <input type="text" class="form-control" value="{{$warden_name OR ''}}" name="warden_name"  required>

                      </div>
					  <div class="form-group">
                          <label for="exampleInputEmail1">Warden Address<span style="color:red;"> *</span></label>
                          <textarea type="text" class="form-control" name="warden_address" id="reg_no" required>{{$warden_address OR ''}}</textarea>

                      </div>
					  <div class="form-group">
                          <label for="exampleInputEmail1">Warden Phone Number<span style="color:red;"> *</span></label>
                          <input type="text" class="form-control" name="warden_phone"  value="{{$warden_phone OR ''}}" onkeypress="return isNumber(event)" maxlength="10" required>

                      </div>
                      <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Update</button>
                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      </div>
                        </div>
                          </form>

                        </div>
                        </div>
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
        $(document).ready(function () {
            /*For Delete Application Info*/
            $(".tFileDelete").click(function (e) {
                e.preventDefault();
                var id = this.id;
                bootbox.confirm("Are you sure?", function (result) {
                    if (result) {
                        var _url = $("#_url").val();
                        window.location.href = _url + "/hostel/hosteltype/delete/" + id;
                    }
                });
            });
        });
    </script>
    <script>
            $(document).ready(function () {
                /*For Delete Application Info*/
                $(".hFileDelete").click(function (e) {
                    e.preventDefault();
                    var id = this.id;
                    bootbox.confirm("Are you sure?", function (result) {
                        if (result) {
                            var _url = $("#_url").val();
                            window.location.href = _url + "/hostel/hosteldetails/delete/" + id;
                        }
                    });
                });
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
}</script>
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
       responsive: true
   } );
   } );

</script>
<script>
$(document).ready(function() {
   $.extend($.fn.dataTable.defaults, {
 dom: 'Bfrtip'
});
   $('#example1').DataTable( {

       buttons: [
           'copy', 'csv', 'excel', 'pdf', 'print'
       ],
         rowReorder: {
           selector: 'td:nth-child(2)'
       },
       responsive: true
   } );
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
@endsection
<!-- ./wrapper -->
