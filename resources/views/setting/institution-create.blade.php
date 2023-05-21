@extends('header')
@section('style')
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

<style>
.imgs{
  width: 300px;
  border: 1px solid #cccc !important;
  padding: 5px;
}
</style>
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
        <li><a href="#"><i class="fa fa-dashboard"></i> Setting</a></li>
        <li class="active">Create-Institution</li>
      </ol>
    </section>

    <!-- Main content -->
      <section class="content">
          @include('notification.notify')
    <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Institution Details</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button style="display:none;" type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-8">

                  <!-- /.form-group -->
                  <div class="box box-primary">
                           <div class="box-header with-border">
                             <h3 class="box-title">Profile information</h3>
                           </div>
                           <!-- /.box-header -->
                           <!-- form start -->
                           <form role="form" method="post" name="createInstitution" enctype="multipart/form-data" action="{{url('InstitutionDetails')}}">
                             <div class="box-body">
                               <div class="col-md-6">
                               <div class="form-group">
                                 <label for="exampleInputEmail1">Institution Name<span style="color:red;"> *</span></label>

                                 <input type="text" class="form-control" id="InstitutionName" value="{{$InstitutionName or ''}}" name="InstitutionName" placeholder="Institution Name" required>
                               </div><br><br>
                               <div class="form-group">
                                 <label for="exampleInputEmail1">Institution Email<span style="color:red;"> *</span></label>
                                 <input type="email" class="form-control" id="InstitutionEmail" value="{{$InstitutionEmail or ''}}" name="InstitutionEmail" placeholder="Institution Email" required>
                               </div>
                               <div class="form-group">
                                 <label for="exampleInputEmail1">Institution Mobile<span style="color:red;"> *</span></label>
                                 <input type="text" class="form-control" id="InstitutionMobile" value="{{$InstitutionMobile or ''}}" name="InstitutionMobile" placeholder="Institution Mobile" onkeypress="return isNumber(event)" required>
                               </div>
                               <div class="form-group">
                                 <label for="exampleInputEmail1">Admin Contact Person<span style="color:red;"> *</span></label>
                                 <input type="text" class="form-control" id="contactperson" name="contactperson" value="{{$contactperson or ''}}" placeholder="Admin Contact Person" required>
                               </div>
                               <div class="form-group">
                                 <label for="exampleInputEmail1">Language<span style="color:red;"> *</span></label>
                                 <input type="text" class="form-control" id="language" value="{{$language or ''}}" name="language" placeholder="Language" required>
                               </div>
                               <div class="form-group">
                                 <label for="exampleInputFile">Institution Logo</label>
                                 <input type="file" id="exampleInputFile" name="logo" required>

                                 <p class="help-block">Institution Logo Here</p>
                               </div>
                             </div>
                             <div class="col-md-6">
                               <div class="form-group">
                                 <label for="exampleInputPassword1">Institution Address<span style="color:red;"> *</span></label>

                                 <textarea class="form-control" rows="3" id="address" name="address" placeholder="Institution Address" required> {{ $address or ''}}</textarea>
                               </div>
                               <div class="form-group">
                                 <label for="exampleInputEmail1">Institution Phone<span style="color:red;"> *</span></label>
                                 <input type="text" class="form-control" id="Institutionphone" value="{{$Institutionphone or ''}}" name="Institutionphone" placeholder="Institution Phone" onkeypress="return isNumber(event)" required>
                               </div>
                               <div class="form-group">
                                 <label for="exampleInputEmail1">Institution Fax<span style="color:red;"> *</span></label>
                                 <input type="text" class="form-control" id="Institutionfax" value="{{$Institutionfax or ''}}" name="Institutionfax" placeholder="Institution Fax" required>
                               </div>
                               <div class="form-group">
                                 <label for="exampleInputEmail1">Country<span style="color:red;"> *</span></label>
                                 <input type="text" class="form-control" id="autocomplete" value="{{$country or ''}}" onFocus="geolocate()" name="country" placeholder="Country" required>
                               </div>
                               <div class="form-group">
                                 <label for="exampleInputEmail1">Institution Code<span style="color:red;"> *</span></label>
                                 <input type="text" class="form-control" id="InstitutionCode" value="{{$InstitutionCode or ''}}"  name="InstitutionCode"  placeholder="Institution Code" required>
                               </div>
                               <div class="form-group">
                                  <div class="checkbox">
                                      <label>
                                        <input type="checkbox" required>
                                            Institution code(This code will be used as the prefix for student admission number)
                                                </label>
                                              </div>
                                            </div>
                             </div>
                           </div>
                             <!-- /.box-body -->

                             <div class="box-footer">
                               <button type="submit" class="btn btn-primary">Submit</button>
                             </div>
                               <input type="hidden" name="_token" value="{{ csrf_token() }}">
                           </form>
                         </div>

                  <!-- /.form-group -->
                </div>
                <div class="col-md-4">

                  <div class="form-group">
                    <label for="exampleInputEmail1">Logo Preview</label>
                    @if($logo)
                      <img class="imgs" id="imglogo"src="{{$logo}}"/>
                    @endif
                <div id="dvPreview">
                  </div>

             <!-- /.form-group -->

             <!-- /.form-group -->
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

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script>

jQuery.validator.setDefaults({
  debug: true,
  success: "valid"
});
$("#createInstitution").validate({
  rules: {
    InstitutionName: {
      required: true
    }
  }
});

</script>
<script language="javascript" type="text/javascript">
$(function () {
    $("#exampleInputFile").change(function () {
        $("#imglogo").hide();
        $("#dvPreview").html("");
        var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
        if (regex.test($(this).val().toLowerCase())) {
            if ($.browser.msie && parseFloat(jQuery.browser.version) <= 9.0) {

                $("#dvPreview").show();
                $("#dvPreview")[0].filters.item("DXImageTransform.Microsoft.AlphaImageLoader").src = $(this).val();
            }
            else {
                if (typeof (FileReader) != "undefined") {
                    $("#dvPreview").show();
                    $("#dvPreview").append("<img />");
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $("#dvPreview img").attr("src", e.target.result);
                    }
                    reader.readAsDataURL($(this)[0].files[0]);
                } else {
                    alert("This browser does not support FileReader.");
                }
            }
        } else {
            alert("Please upload a valid image file.");
        }
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
}
</script>
<script>
  // This example displays an address form, using the autocomplete feature
  // of the Google Places API to help users fill in the information.

  // This example requires the Places library. Include the libraries=places
  // parameter when you first load the API. For example:
  // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

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
        /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
        {types: ['geocode']});
        autocomplete = new google.maps.places.Autocomplete(
            /** @type {!HTMLInputElement} */(document.getElementById('address')),
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
