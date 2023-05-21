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
        <li><a href="#"><i class="fa fa-dashboard"></i> Transport </a></li>
        <li class="active">Vehicle</li>
      </ol>
    </section>

    <!-- Main content -->
      <section class="content">
          @include('notification.notify')
    <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Vehicle Details</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button style="display:none;" type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-7">

                  <!-- /.form-group -->
                  <div class="box box-primary">
                           <div class="box-header with-border">
                             <h3 class="box-title">Add Vehicle</h3>
                           </div>
                           <!-- /.box-header -->
                           <!-- form start -->
                           <form role="form" method="post" enctype="multipart/form-data" action="{{url('transport/vehicle/update')}}">
                          <div class="box-body">
                            @foreach($vechicle as $vechicle)
                            <div class="form-group">
                              <label for="exampleInputEmail1">Vehicle No.<span style="color:red;"> *</span></label>
                              <input type="text" class="form-control" id="vehicleno" value="{{ $vechicle->vehicleno }}" name="vehicleno" placeholder="Vehicle No." required>
                                <input type="hidden" class="form-control" id="id" value="{{ $vechicle->id }}" name="id" required>
                            </div>
                            <div class="form-group">
                              <label for="exampleInputEmail1">No. of Seats<span style="color:red;"> *</span></label>
                              <input type="text" class="form-control" id="noofseats" name="noofseats" value="{{ $vechicle->noofseats }}" onkeypress="return isNumber(event)" placeholder="No. of Seats" required>
                            </div>
                            <div class="form-group">
                              <label for="exampleInputEmail1">Maximum Allowed<span style="color:red;"> *</span></label>
                              <input type="text" class="form-control" id="maximumallowed" value="{{$vechicle->maximumallowed}}" onkeypress="return isNumber(event)" name="maximumallowed" placeholder="Maximum Allowed" required>
                            </div>
                            <div class="form-group">
                              <label for="exampleInputEmail1">Vehicle Type<span style="color:red;"> *</span></label>
                              <select class="form-control select2" name="vehicletype"  style="width: 100%;" required>
                                  <option value="">Please select</option>
                                  <option value="Contact" @if($vechicle->vehicletype=="Contact") selected @endif>Contact</option>
                                  <option value="Ownership" @if($vechicle->vehicletype=="Ownership") selected @endif>Ownership</option>
                           </select>
                         </div>
                         <div class="form-group">
                           <label for="exampleInputEmail1">Contact Person<span style="color:red;"> *</span></label>
                           <input type="text" class="form-control" id="twd"  name="contactperson" value="{{ $vechicle->contactperson }}" placeholder="Contact Person" required>
                         </div>
                         <div class="form-group">
                                         <label>Insurance Renewal Date</label>
                                         <div class="input-group date">
                                           <div class="input-group-addon">
                                             <i class="fa fa-calendar"></i>
                                           </div>
                                           <input type="text" class="form-control pull-right" id="startdate" value="{{ $vechicle->insurancerenewaldate }}" name="insurancerenewaldate">
                                         </div>
                                         <!-- /.input group -->
                                       </div>
                                       <div class="form-group">
                                         <label for="exampleInputEmail1">Track ID<span style="color:red;"> *</span></label>
                                         <input type="text" class="form-control" id="twd"  name="trackid" value="{{$vechicle->trackid}}" placeholder="Track ID" required>
                                       </div>
                                       @endforeach
                       </div>
                             <!-- /.box-body -->

                             <div class="box-footer">
                               <button type="submit" class="btn btn-primary">Update</button>
                             </div>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                           </form>
                         </div>

                  <!-- /.form-group -->
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

        //Datemask dd/mm/yyyy

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
       responsive: true


   } );
   } );

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
