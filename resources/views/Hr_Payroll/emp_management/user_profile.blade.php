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
        <li><a href="#"><i class="fa fa-dashboard"></i> HR/Payroll </a></li>
        <li><a href="#"><i class="fa fa-dashboard"></i> Employee Management  </a></li>
        <li class="active">User Profile</li>
      </ol>
    </section>

    <!-- Main content -->
      <section class="content">
          @include('notification.notify')
    <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">User Details Update</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button style="display:none;" type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
               <div class="nav-tabs-custom">
              <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1" data-toggle="tab">User Information </a></li>
                <li ><a href="#tab_2" data-toggle="tab">Update Profile Image</a></li>
                 <li ><a href="#tab_3" data-toggle="tab">Update Password</a></li>

                <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
              </ul>
               <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
           <div class="box box-primary">

           <form role="form" method="post" enctype="multipart/form-data" action="{{url('hr/employee/update_profile')}}">
                             <div class="box-header with-border">
                               <h3 class="box-title">Employee Details</h3>
                             </div>
                             <div class="box-body">
              <div class="row">
                <div class="form-group col-md-4">
                 <label for="exampleInputEmail1">Employee Code<span style="color:red;"> *</span></label>
                 <input type="text" class="form-control" id="empcode" value="{{$users->empcode OR ''}}" name="empcode" placeholder="Employee Code" readonly>
                 <input type="hidden" class="form-control" id="user_id" value="{{$users->user_id OR ''}}" name="user_id" placeholder="Employee Code">
            
               </div>
               <div class="form-group col-md-4">
                               <label>Joining Date</label>
                               <div class="input-group date">
                                 <div class="input-group-addon">
                                   <i class="fa fa-calendar"></i>
                                 </div>
                                 <input type="text" class="form-control pull-right" value="{{$users->joiningdate OR ''}}" id="startdate" name="joiningdate">
                               </div>
                               <!-- /.input group -->
                             </div>
               <div class="form-group col-md-4">
                 <label for="exampleInputEmail1">Department<span style="color:red;"> *</span></label>
                 <select class="form-control select2" name="department" style="width: 100%;" required>
                     <option value="" selected="selected">Please select</option>
                     @foreach($department as $department)
                     <option <?php if($users->department==$department->department_name) {echo "selected";}  ?> value="{{$department->department_name}}">{{$department->department_name}}</option>
                     @endforeach

              </select>
            </div>

                  <div class="form-group col-md-4">
                    <label for="exampleInputEmail1">Designation<span style="color:red;"> *</span></label>
                    <select class="form-control select2" name="designation" style="width: 100%;" required>
                        <option value="" selected="selected">Please select</option>
                        @foreach($designation as $designation)
                        <option <?php if($users->designation==$designation->degination) {echo "selected";}  ?> value="{{$designation->degination}}">{{$designation->degination}}</option>
                        @endforeach
                 </select>
               </div>

                  <div class="form-group col-md-4">
                    <label for="exampleInputEmail1">Qualification<span style="color:red;"> *</span></label>
                    <input type="text" class="form-control" value="{{$users->qualification OR ''}}" id="qualification" name="qualification" placeholder="Qualification" required>
                  </div>
                  <div class="form-group col-md-4">
                    <label for="exampleInputEmail1">Total Experience<span style="color:red;"> *</span></label>
                    <input type="text" class="form-control" value="{{$users->tot_exp OR ''}}"  id="totalexperience" name="totalexperience" placeholder="Total Experience" required>
                  </div>

                  <div class="form-group col-md-4">
                    <label for="exampleInputEmail1">User Type<span style="color:red;"> *</span></label>
                    <select class="form-control select2" name="usertype" style="width: 100%;" required>
                        <option value="" selected="selected">Please select</option>
                        @foreach($userList as $userList)
                        <option <?php if($users->user_type==$userList->id) {echo "selected";}  ?> value="{{$userList->id}}">{{$userList->usertype}}</option>
                        @endforeach
                 </select>
               </div>
              
              </div>
              <div class="box-header box box-primary with-border">
                <h3 class="box-title">PERSONAL DETAILS:-</h3>
              </div>
              <div class="row">
                <div class="form-group col-md-4">
                  <label for="exampleInputEmail1">First Name<span style="color:red;"> *</span></label>
                  <input type="text" value="{{$users->fname OR ''}}" class="form-control" id="fname" name="fname" placeholder="First Name" required>
                </div>
                <div class="form-group col-md-4">
                  <label for="exampleInputEmail1">Middle Name</label>
                  <input type="text" class="form-control" value="{{$users->mname OR ''}}"  id="mname" name="mname" placeholder="Middle Name">
                </div>
                <div class="form-group col-md-4">
                  <label for="exampleInputEmail1">Last Name<span style="color:red;"> *</span></label>
                  <input type="text" class="form-control" value="{{$users->lname OR ''}}"  id="lname" name="lname" placeholder="Last Name" required>
                </div>
                <div class="form-group col-md-4">
                                <label>Date of Birth</label>
                                <div class="input-group date">
                                  <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                  </div>
                                  <input type="text" value="{{$users->dob OR ''}}"  class="form-control pull-right" id="dob" name="dob" required>
                                </div>
                                <!-- /.input group -->
                              </div>

                  <div class="form-group col-md-4">
                    <label for="exampleInputEmail1">Gender<span style="color:red;"> *</span></label>
                    <select class="form-control select2" name="gender" style="width: 100%;" required>
                        <option selected="selected">Please select</option>
                        <option <?php if($users->gender=="Male") {echo "selected";}  ?> value="Male">Male</option>
                        <option <?php if($users->gender=="Female") {echo "selected";}  ?> value="Female">Female </option>
                 </select>
               </div>
               <div class="form-group col-md-4">
                 <label for="exampleInputEmail1">PAN Number</label>
                 <input type="text" class="form-control" value="{{$users->pan_no OR ''}}" name="panno" placeholder="PAN Number">
               </div>


            <div class="form-group col-md-4">
              <label for="exampleInputEmail1">PF Number</label>
              <input type="text" class="form-control" value="{{$users->pf_no OR ''}}"  name="pf" placeholder="PF Number">
            </div>
            <div class="form-group col-md-4">
              <label for="exampleInputEmail1">ESI</label>
              <input type="text" class="form-control" value="{{$users->esi OR ''}}"  name="esi" placeholder="ESI">
            </div>
            <div class="form-group col-md-4">
              <label for="exampleInputEmail1">Nationality<span style="color:red;"> *</span></label>
              <select class="form-control select2" name="nationality" style="width: 100%;">
                  <option>Please select</option>
                  <option value="Indian" selected="selected">Indian</option>
                  <option value="Other">Other</option>
           </select>
         </div>
         <div class="form-group col-md-4">
           <label for="exampleInputEmail1">Category<span style="color:red;"> *</span></label>
           <select class="form-control select2" name="category" style="width: 100%;">
               <option value="" selected="selected">Please select</option>
               @foreach($category as $category)
               <option <?php if($users->category==$category->stu_category) {echo "selected";}  ?> value="{{$category->stu_category}}" >{{$category->stu_category}}</option>
              @endforeach
        </select>
      </div>
      <div class="form-group col-md-4">
        <label for="exampleInputEmail1">Religion<span style="color:red;"> *</span></label>
        <select class="form-control select2" name="religion" style="width: 100%;">
            <option>Please Religion</option>
            <option <?php if($users->gender=="Hindu") {echo "selected";}  ?> value="Hindu" selected="selected">Hindu</option>
            <option <?php if($users->gender=="Muslim") {echo "selected";}  ?> value="Muslim">Muslim</option>
            <option <?php if($users->gender=="Sikh") {echo "selected";}  ?> value="Sikh">Sikh</option>
            <option <?php if($users->gender=="Christianity") {echo "selected";}  ?> value="Christianity">Christianity</option>
            <option <?php if($users->gender=="Buddhism") {echo "selected";}  ?> value="Buddhism">Buddhism</option>
            <option <?php if($users->gender=="Other") {echo "selected";}  ?> value="Other">Other</option>
     </select>
   </div>
   <div class="form-group col-md-4">
     <label for="exampleInputEmail1">Aadhar Number</label>
     <input type="text" class="form-control" value="{{$users->aadhar_number OR ''}}"  id="Aadharno" name="aadharno" placeholder="Aadhar Number">
   </div>
     </div>
              </div>
              <div class="box-header with-border">
                <h3 class="box-title">CONTACT DETAILS:-</h3>
              </div>
              <div class="box-body">
<div class="row">
  <div class="form-group col-md-5">
    <label for="exampleInputPassword1">Permanent Address<span style="color:red;"> *</span></label>
    <textarea class="form-control" id="permanentaddress" rows="3" name="permanentsddress" placeholder="Permanent Address" required>{{$users->permanent_address OR ''}}</textarea>
  </div>
    <div class="form-group col-md-2">
    <br><be>  <div class="checkbox">
          <label>
            <input type="checkbox" id="same">
                    </label>
                    <br>  <p>  same as Permanent Address</p>
                  </div>
    </div>
  <div class="form-group col-md-5">
    <label for="exampleInputPassword1">Present Address<span style="color:red;"> *</span></label>
    <textarea class="form-control" rows="3" id="presentaddress" name="persentddress" placeholder="Present Address" required>{{$users->present_address OR ''}}</textarea>
  </div>
<div class="form-group col-md-4">
  <label for="exampleInputEmail1">City<span style="color:red;"> *</span></label>
  <input type="text" class="form-control" id="city" value="{{$users->city OR ''}}" name="city" placeholder="City" required>
</div>
<div class="form-group col-md-4">
  <label for="exampleInputEmail1">Pin<span style="color:red;"> *</span></label>
  <input type="text" class="form-control" id="Pin" value="{{$users->pin OR ''}}" placeholder="Pin" name="pin" onkeypress="return isNumber(event)"  required>
</div>

   <div class="form-group col-md-4">
     <label for="exampleInputEmail1">Country<span style="color:red;"> *</span></label>
     <select class="form-control select2"  name="country" style="width: 100%;" required>
         <option >Please select</option>
         <option value="India" selected="selected">India</option>
         <option value="Other">Other </option>
  </select>
</div>

<div class="form-group col-md-4">
  <label for="exampleInputEmail1">State<span style="color:red;"> *</span></label>

  <input type="text" class="form-control" value="{{$users->state OR ''}}" id="state" name="state" placeholder="State" required>
</div>
<div class="form-group col-md-4">
  <label for="exampleInputEmail1">Phone<span style="color:red;"> *</span></label>
  <input type="text" class="form-control" id="Pin" value="{{$users->phone OR ''}}" placeholder="Phone" name="phone" onkeypress="return isNumber(event)"  required>
</div>
<div class="form-group col-md-4">
  <label for="exampleInputEmail1">Email<span style="color:red;"> *</span></label>
  <input type="email" class="form-control" id="Pin" value="{{$users->email OR ''}}" placeholder="Email" name="email" required>
</div>
</div>
  </div>
      <div class="box-footer">
       <button type="submit" class="btn btn-primary">Update</button>
     </div>
     <input type="hidden" name="_token" value="{{ csrf_token() }}">
   </form>
</div>
</div>

 <div class="tab-pane" id="tab_2">
  <div class="box box-info">
                             <div class="box-header with-border">
                               <h3 class="box-title">Profile Image</h3>
                             </div>
                             <div class="box-body">
              <div class="row">
          <div class="col-md-12">
        <div class="col-md-6"> 
           <form role="form" method="post" enctype="multipart/form-data" action="{{url('user/update_profile_image')}}">
         
              <div class="form-group">
                 <label for="exampleInputEmail1">Profile Image</label>
                 <input type="file" id="file" class="form-control" name="image" placeholder="Profile Image" required="">
               </div>
      <div class="box-footer">
       <button type="submit" class="btn btn-primary">Update</button>
     </div>
     <input type="hidden" name="_token" value="{{ csrf_token() }}">

         </form>
       </div> 
 <div class="col-md-6"> 
   @if($users->profile_img == null)
  <div id='kk' style="display:none">
                          <h4>Profile Preview</h4>
                          <img style="height: 200px;" id="img1" src="#" alt="your image" />                    
                         </div>
                         @else
                          <div >
                          <h4>Profile Preview</h4>
                         
        <img style="height: 200px;" id="img1" src="{{ URL::asset($users->profile_img) }}" alt="your image" />
                         
                        </div>
                          @endif
</div>
        </div>
      </div>
      </div> 


</div>
</div>

 <div class="tab-pane" id="tab_3">
  <div class="box box-warning">
                   <div class="box-header with-border">
                               <h3 class="box-title">Update Password</h3>
                             </div>
                             <div class="box-body">
              <div class="row">
          <div class="col-md-12">
        <div class="col-md-6"> 
           <form role="form" method="post" enctype="multipart/form-data" action="{{url('user/update_password')}}">
             <div class="form-group">
              <label for="exampleInputEmail1">New Password</label>
              <input type="password" class="form-control" id="npassword" name="npassword" placeholder="New Password">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Confirm Password</label>
              <input type="password" class="form-control" id="cpassword"  name="cpassword" placeholder="Confirm Password">
            </div>
            <div class="box-footer">
              <button type="submit" id="up" class="btn btn-primary">Update Password</button>
            </div>
           <input type="hidden" name="_token" value="{{ csrf_token() }}">
         </form>
       </div>   
        </div>
      </div>
      </div> 


</div>
</div>


</div>





</div>





  </div>

          </div>
     
   </div>
   </div>
    

              </section>
              </div>
    <!-- /.content -->
 
  <!-- /.content-wrapper -->

@endsection
{{--External Style Section--}}
@section('script')
<script src="{{ URL::asset('assets/bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/select2/dist/js/select2.full.min.js') }}"></script>

<script>
  $(document).ready(function () {
    $("#up").click(function (e){
      if($("#npassword").val()==$("#cpassword").val()){
        return true;
      }else{
        alert("Password not matched");
        return false;
      }
    });
  });
</script>


<script>
$("#same").change(function() {
    if(this.checked) {
      $('#presentaddress').val($('#permanentaddress').val());
    }else{
  $('#presentaddress').val("");
    }
});
</script>
<script>
    function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function(e) {
        $('#img1').attr('src', e.target.result);
      }

      reader.readAsDataURL(input.files[0]);
    }
    $("#kk").removeAttr( "style" )
  }

    $("#file").change(function() {
    readURL(this);
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
$("#totalexperience").keyup(function() {
    var $this = $(this);
    $this.val($this.val().replace(/[^\d.]/g, ''));
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
            /** @type {!HTMLInputElement} */(document.getElementById('state')),
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
