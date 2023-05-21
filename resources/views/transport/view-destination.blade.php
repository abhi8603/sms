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
        <li><a href="#"><i class="fa fa-dashboard"></i> Transport </a></li>
        <li class="active">Add Destination</li>
      </ol>
    </section>

    <!-- Main content -->
      <section class="content">
          @include('notification.notify')
    <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Destination Details</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button style="display:none;" type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-6">
                  <!-- /.form-group -->
                  <div class="box box-primary">
                           <div class="box-header with-border">
                             <h3 class="box-title">Update Destination and Fee</h3>
                           </div>
                           <!-- /.box-header -->
                           <!-- form start -->
                           <form role="form" method="post" enctype="multipart/form-data" action="{{url('transport/destination/update')}}">
                          <div class="box-body">
                            @foreach($destination as $destination)
                            <div class="form-group">
                              <label for="exampleInputEmail1">Route Code<span style="color:red;"> *</span></label>
                              <select class="form-control select2" name="route_code"  style="width: 100%;" required>
                                  <option value="" selected="selected">Please select</option>
                              @foreach($routes as $vehicles)
                                  <option value="{{$vehicles->id}}" @if($destination->route_code==$vehicles->id) selected @endif>{{$vehicles->routecode}} ({{$vehicles->vehicleno}})</option>
                                  @endforeach
                           </select>
                         </div>

                          <div class="form-group">
                              <label for="exampleInputEmail1">Pick up & Drop<span style="color:red;"> *</span></label>
                              <input type="text" class="form-control" id="ad1"  name="pickanddrop" value="{{ $destination->pickanddrop }}" placeholder="Pick up & Drop" required>
                          </div>
                          <div class="bootstrap-timepicker">
                <div class="form-group">
                  <label>Stop Time<span style="color:red;"> *</span></label>

                  <div class="input-group">
                    <input type="text" class="form-control timepicker" name="stoptime" value="{{ $destination->stoptime }}">

                    <div class="input-group-addon">
                      <i class="fa fa-clock-o"></i>
                    </div>
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->
              </div>
                          <div class="form-group">
                              <label for="exampleInputEmail1">Amount<span style="color:red;"> *</span></label>
                              <input type="text" class="form-control" id="amount"  name="amount" value="{{$destination->amount }}" placeholder="Amount" required>
                              <input type="hidden" class="form-control"   name="id" value="{{$destination->id }}" placeholder="id" required>

                          </div>
                          <div class="form-group">
                            <label for="exampleInputEmail1">Fee Type<span style="color:red;"> *</span></label>
                            <select class="form-control select2" name="feetype"  style="width: 100%;" required>
                                <option value="" selected="selected">Please select</option>
                                <option value="Annual" @if($destination->feetype="Annual") selected @endif>Annual</option>
                                <option value="Bi-Annual"@if($destination->feetype="Bi-Annual") selected @endif>Bi-Annual</option>
                                <option value="Tri-Annual" @if($destination->feetype="Tri-Annual") selected @endif>Tri-Annual</option>
                                <option value="Quarterly" @if($destination->feetype="Quarterly") selected @endif>Quarterly</option>
                                <option value="Monthly" @if($destination->feetype="Monthly") selected @endif>Monthly</option>

                         </select>
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
<script src="{{ URL::asset('assets/bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>

<script>
        $(document).ready(function () {
          $("#amount").keyup(function() {
    var $this = $(this);
    $this.val($this.val().replace(/[^\d.]/g, ''));
});

        });
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
<script>
  var placeSearch, autocomplete;
  var componentForm = {
    street_number: 'short_name',
    route: 'long_name',
    locality: 'long_name',
    administrative_area_level_1: 'short_name',
    country: 'long_name',
    postal_code: 'short_name'
  };

  function initAutocomplete() {
    // Create the autocomplete object, restricting the search to geographical
    // location types.
            autocomplete = new google.maps.places.Autocomplete(
            /** @type {!HTMLInputElement} */(document.getElementById('ad1')),
            {types: ['geocode']});

    // When the user selects an address from the dropdown, populate the address
    // fields in the form.
    autocomplete.addListener('place_changed', fillInAddress);
  }

  function fillInAddress() {
    // Get the place details from the autocomplete object.
    var place = autocomplete.getPlace();

    for (var component in componentForm) {
      document.getElementById(component).value = '';
      document.getElementById(component).disabled = false;
    }

    // Get each component of the address from the place details
    // and fill the corresponding field on the form.
    for (var i = 0; i < place.address_components.length; i++) {
      var addressType = place.address_components[i].types[0];
      if (componentForm[addressType]) {
        var val = place.address_components[i][componentForm[addressType]];
        document.getElementById(addressType).value = val;
      }
    }
  }

  // Bias the autocomplete object to the user's geographical location,
  // as supplied by the browser's 'navigator.geolocation' object.
  function geolocate() {
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(function(position) {
        var geolocation = {
          lat: position.coords.latitude,
          lng: position.coords.longitude
        };
        var circle = new google.maps.Circle({
          center: geolocation,
          radius: position.coords.accuracy
        });
        autocomplete.setBounds(circle.getBounds());
      });
    }
  }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAMtsOugMpddkKZ8tx9hPxmwIdGKjAONLo&libraries=places&callback=initAutocomplete" async defer></script>

@endsection
<!-- ./wrapper -->
