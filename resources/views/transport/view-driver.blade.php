@extends('header')
@section('style')
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
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
        <li class="active">Driver</li>
      </ol>
    </section>

    <!-- Main content -->
      <section class="content">
          @include('notification.notify')
    <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Driver Details</h3>

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
                             <h3 class="box-title">View Driver</h3>
                           </div>
                           <!-- /.box-header -->
                           <!-- form start -->
                           <form role="form" method="post" enctype="multipart/form-data" action="{{url('transport/driver/update')}}">
                          <div class="box-body">
                            @foreach($driver as $driver)
                            <div class="form-group">
                              <label for="exampleInputEmail1">Vehicle No<span style="color:red;"> *</span></label>
                              <select class="form-control select2" name="vehicleno"  style="width: 100%;" required>
                                  <option value="" selected="selected">Please select</option>
                              @foreach($vehicle as $vehicles)
                                  <option value="{{$vehicles->id}}" @if($driver->vehicleno == $vehicles->id) selected @endif>{{$vehicles->vehicleno}}</option>
                                  @endforeach
                           </select>
                         </div>
                            <div class="form-group">
                              <label for="exampleInputEmail1">Name<span style="color:red;"> *</span></label>
                              <input type="text" class="form-control" id="name" name="name" value="{{ $driver->name }}" placeholder="Driver Name" required>
                                  <input type="text" class="form-control" id="id" name="id" value="{{ $driver->id }}" placeholder="Driver Name" required>
                            </div>
                            <div class="form-group">
                              <label for="exampleInputEmail1">Present Address<span style="color:red;"> *</span></label>
                              <textarea type="text" rows="3" class="form-control"  name="presentaddress" placeholder="Present Address" required>{{ $driver->presentaddress }} </textarea>
                            </div>
                            <div class="form-group">
                              <label for="exampleInputEmail1">Permanent Address<span style="color:red;"> *</span></label>
                              <textarea type="text" rows="3" class="form-control"  name="permanentaddress" placeholder="Permanent Address" required>{{ $driver->permanentaddress }} </textarea>
                            </div>

                         <div class="form-group">
                             <label>Date of Birth</label>
                             <div class="input-group date">
                             <div class="input-group-addon">
                             <i class="fa fa-calendar"></i>
                             </div>
                             <input type="text" class="form-control pull-right" id="startdate" value="{{ $driver->dob }}" name="dob">
                            </div>
                                         <!-- /.input group -->
                          </div>
                          <div class="form-group">
                              <label for="exampleInputEmail1">Phone<span style="color:red;"> *</span></label>
                              <input type="text" class="form-control" id="twd" maxlength="10" onkeypress="return isNumber(event)"  name="phone" value="{{ $driver->phone }}" placeholder="Phone" required>
                          </div>
                          <div class="form-group">
                              <label for="exampleInputEmail1">License Number<span style="color:red;"> *</span></label>
                              <input type="text" class="form-control" id="twd"  name="licensenumber" value="{{ $driver->licensenumber }}" placeholder="License Number" required>
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
<script src="{{ URL::asset('assets/bower_components/jquery/dist/bootbox.min.js') }}"></script>

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
