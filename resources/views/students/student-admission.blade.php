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
        <li><a href="#"><i class="fa fa-dashboard"></i> Student</a></li>
        <li class="active">Student Admission</li>
      </ol>
    </section>

    <!-- Main content -->
      <section class="content">
          @include('notification.notify')
    <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Student Admission</h3>

              <div class="box-tools pull-right">
              <a href="{{url('student/import')}}" class="btn btn-info">Import</a>
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

                           <!-- /.box-header -->
                           <!-- form start -->
                           <form role="form" method="post" enctype="multipart/form-data" action="{{url('student/admission/Registration')}}">
                             <div class="box-header with-border">
                               <h3 class="box-title">OFFICIAL DETAILS:-</h3>
                             </div>
                             <div class="box-body">
              <div class="row">
                  <div class="form-group col-md-4">
                    <label for="exampleInputEmail1">Academic Year<span style="color:red;"> *</span></label>
                    <select class="form-control select2" name="accdmic_year" style="width: 100%;">
                        <option value="" selected="selected">Please select</option>
                        @foreach($accadmicyear as $accadmicyear)
                        <option value="{{$accadmicyear->startyear}}-{{$accadmicyear->endyear}}">{{$accadmicyear->startyear}} - {{$accadmicyear->endyear}}</option>
                      @endforeach
                 </select>
               </div>
               <div class="form-group col-md-4">
                 <label for="exampleInputEmail1">Register Number<span style="color:red;"> *</span></label>
                 <input type="text" class="form-control" name="reg_no" id="reg_no" onkeypress="return RestrictSpace()" placeholder="Register Number" autocomplete="off" required>
               </div>
               <div class="form-group col-md-4">
                               <label>Admission Date <span style="color:red;"> *</span></label>
                               <div class="input-group date">
                                 <div class="input-group-addon">
                                   <i class="fa fa-calendar"></i>
                                 </div>
                                 <input type="text" class="form-control pull-right" id="startdate" value="{{ old('joining_date') }}" name="joining_date" required>
                               </div>
                               <!-- /.input group -->
                             </div>
               <div class="form-group col-md-4">
                 <label for="exampleInputEmail1">Class<span style="color:red;"> *</span></label>
                 <select class="form-control select2" name="course" id="course" style="width: 100%;" required>
                     <option value="" selected="selected">Please select</option>
                  @<?php foreach ($course as $course): ?>
                    <option value="{{$course->id}}">{{$course->course_name}}</option>
                  <?php endforeach; ?>

              </select>
            </div>

                  <div class="form-group col-md-4">
                    <label for="exampleInputEmail1">Section</label>
                    <select class="form-control select2" name="batch" id="batch" style="width: 100%;">
                      <option value="" selected="selected">Please select</option>
                 </select>
               </div>

                  <div class="form-group col-md-4">
                    <label for="exampleInputEmail1">Roll No.</label>
                    <input type="text" class="form-control" id="rollno"  value="{{ old('roll_no') }}" name="roll_no" placeholder="Roll No.">
                  </div>

              </div>
              <div class="row" id="stuinfo">
                <div class="form-group col-md-12">
              <div class="callout callout-info">
              <h4>Number of students allocated : <span id="current">0</span> / <span id="total">0</span></h4>
            </div>
            </div>
            </div>
              <div class="box-header with-border">
                <h3 class="box-title">PERSONAL DETAILS:-</h3>
              </div>
              <div class="row">
                <div class="form-group col-md-4">
                  <label for="exampleInputEmail1">Student Name<span style="color:red;"> *</span></label>
                  <input type="text" class="form-control" id="fname" value="{{ old('fname') }}" name="fname" placeholder="Student Name">
                </div>

                <div class="form-group col-md-4">
                                <label>Date of Birth</label>
                                <div class="input-group date">
                                  <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                  </div>
                                  <input type="text" class="form-control pull-right" value="{{ old('dob') }}" id="dob" name="dob">
                                </div>
                                <!-- /.input group -->
                              </div>

                  <div class="form-group col-md-4">
                    <label for="exampleInputEmail1">Gender</label>
                    <select class="form-control select2" name="gender" style="width: 100%;">
                        <option selected="selected">Please select</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female </option>
                 </select>
               </div>

               <div class="form-group col-md-4">
                 <label for="exampleInputEmail1">Blood Group</label>
                 <select class="form-control select2" name="blood_group" style="width: 100%;">
                     <option value="" selected="selected">Please select</option>
                     <option value="A+">A+</option>
                     <option value="A-">A-</option>
                     <option value="B+">B+</option>
                     <option value="B-">B-</option>
                     <option value="O+">O+</option>
                     <option value="O-">O-</option>
                     <option value="AB+">AB+</option>
                     <option value="AB-">AB-</option>
              </select>
            </div>
            <div class="form-group col-md-4">
              <label for="exampleInputEmail1">Birth Place</label>
              <input type="text" class="form-control" id="birth_place" value="{{ old('birth_place') }}" name="birth_place" placeholder="Birth Place">
            </div>
            <div class="form-group col-md-4">
              <label for="exampleInputEmail1">Nationality</label>
              <select class="form-control select2" name="nationaliy" style="width: 100%;">
                  <option>Please select</option>
                  <option value="Indian" selected="selected">Indian</option>
                  <option value="Other">Other</option>
           </select>
         </div>

         <div class="form-group col-md-4">
           <label for="exampleInputEmail1">Category</label>
           <select class="form-control select2" name="category" style="width: 100%;">
               <option value="" selected="selected">Please select</option>
               @foreach($category as $category){
               <option value="{{$category->stu_category}}" >{{$category->stu_category}}</option>
             }
            @endforeach
        </select>
      </div>
      <div class="form-group col-md-4">
        <label for="exampleInputEmail1">Religion</label>
        <select class="form-control select2" name="religion" style="width: 100%;">
            <option>Please Religion</option>
            <option value="Hindu" selected="selected">Hindu</option>
            <option value="Islam">Islam</option>
            <option value="Sikh">Sikh</option>
            <option value="Christian">Christian</option>
            <option value="Buddhism">Buddhism</option>
            <option value="Sarna">Sarna</option>
            <option value="Other">Other</option>
     </select>
   </div>
   <div class="form-group col-md-4">
     <label for="exampleInputEmail1">Aadhar Number</label>
     <input type="text" class="form-control" id="aadhar_no" value="{{ old('aadhar_no') }}" name="aadhar_no" placeholder="Aadhar Number">
   </div>
              </div>
              <div class="box-header with-border">
                <h3 class="box-title">CONTACT DETAILS:-</h3>
              </div>
              <div class="box-body">
<div class="row">
  <div class="form-group col-md-5">
    <label for="exampleInputPassword1">Permanent Address</label>
    <textarea class="form-control" rows="3" id="permanentaddress" name="permanent_address" placeholder="Permanent Address">{{ old('permanent_address') }}</textarea>
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
    <textarea class="form-control" rows="3" id="presentaddress" name="present_address" placeholder="Present Address">{{ old('present_address') }}</textarea>
  </div>
<div class="form-group col-md-4">
  <label for="exampleInputEmail1">City</label>
  <input type="text" class="form-control" id="InstitutionName" value="{{ old('city') }}" name="city" placeholder="City">
</div>
<div class="form-group col-md-4">
  <label for="exampleInputEmail1">Pin</label>
  <input type="text" class="form-control" id="Pin" maxlength="6" value="{{ old('pin') }}" name="pin" placeholder="Pin">
</div>

   <div class="form-group col-md-4">
     <label for="exampleInputEmail1">Country</label>
     <select class="form-control select2" name="country" style="width: 100%;">
         <option >Please select</option>
         <option value="India" selected="selected">India</option>
         <option value="Other">Other </option>
  </select>
</div>

<div class="form-group col-md-4">
  <label for="exampleInputEmail1">State</label>
  <select class="form-control select2" name="state" style="width: 100%;">
      <option selected="selected">Please select</option>
      <option value="Jharkhand" selected="selected">Jharkhand</option>
      <option value="Bihar">Bihar </option>
      <option value="Delhi" selected="selected">Delhi</option>
      <option value="Panjab">Panjab </option>
</select>
</div>
<div class="form-group col-md-4">
  <label for="exampleInputEmail1">Phone</label>
  <input type="text" class="form-control" maxlength="10" id="phone" value="{{ old('phone') }}" name="phone" placeholder="Phone">
</div>
<div class="form-group col-md-4">
  <label for="exampleInputEmail1">Email</label>
  <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="Email">
</div>
</div>
             </div>

             <div class="box-header with-border">
               <h3 class="box-title">PARENTS DETAILS:-</h3>
             </div>
             <div class="box-body">
<div class="row">
<div class="form-group col-md-4">
 <label for="exampleInputEmail1">Father Name<span style="color:red;"> *</span></label>
 <input type="text" class="form-control" id="father_name" name="father_name" value="{{ old('father_name') }}" placeholder="Father Name">
</div>
<div class="form-group col-md-4">
 <label for="exampleInputEmail1">Mother Name</label>
 <input type="text" class="form-control" id="mother_name" name="mother_name" value="{{ old('mother_name') }}" placeholder="Mother Name">
</div>
<div class="form-group col-md-4">
 <label for="exampleInputEmail1">Father Occupation</label>
 <input type="text" class="form-control" id="father_job" name="father_job" value="{{ old('father_job') }}" placeholder="Father Occupation">
</div>
<div class="form-group col-md-4">
 <label for="exampleInputEmail1">Father Phone No.<span style="color:red;"> *</span></label>
 <input type="text" class="form-control" id="father_phone" name="father_phone" value="{{ old('father_phone') }}" maxlength="10" placeholder="Father Phone No">
</div>
<div class="form-group col-md-4">
 <label for="exampleInputEmail1">Mother Phone No</label>
 <input type="text" class="form-control" id="Pin" name="mother_phone" maxlength="10" value="{{ old('mother_phone') }}" placeholder="Mother Phone No">
</div>
<div class="form-group col-md-4">
 <label for="exampleInputEmail1">Father Aaadhar number</label>
 <input type="text" class="form-control" id="father_aadhar" name="father_aadhar" value="{{ old('father_aadhar') }}" placeholder="Father Aaadhar number">
</div>
</div>

<div class="box-header with-border">
  <h3 class="box-title">PREVIOUS QUALIFICATION DETAILS:-</h3>
</div>
<div class="box-body">
<div class="row">



<div class="form-group col-md-4">
<label for="exampleInputEmail1">School Name</label>
<input type="text" class="form-control" id="prev_school" value="{{ old('prev_school') }}" name="prev_school" placeholder="School Name">
</div>
<div class="form-group col-md-4">
  <label for="exampleInputPassword1">School Address</label>
  <textarea class="form-control" rows="3" name="prev_school_address" value="{{ old('prev_school_address') }}" placeholder="School Address"></textarea>
</div>
<div class="form-group col-md-4">
<label for="exampleInputEmail1">Qualification</label>
<input type="text" class="form-control" id="prev_qualification" value="{{ old('prev_qualification') }}" name="prev_qualification" placeholder="Father Qualification">
</div>
</div>
</div>
<div class="box-header with-border" style="display:none;">
  <h3 class="box-title">OTHERS:-</h3>
</div>
<div class="box-body" style="display:none;">
<div class="row">
  <div class="form-group col-md-4">
                  <label>Admission Fee</label>
                 <select class="form-control select2" multiple="multiple" id="feetype" data-placeholder="Please Select" >
                    <option value="" >Please Select</option>
                      @foreach($fees as $fees)
                    <option value="{{$fees->id}}">{{$fees->sub_category}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="callout callout-success col-md-8">
                <h4>Total Fee</h4>
                  <input type="text" value="0" id="texttotal">
                <p>₹ <span id="totalfee">0</span></p>
              </div>

            <br>  <div class="form-group col-md-4" style="display:none;">
             <div class="checkbox">
                    <label>
                      <input type="checkbox" id="tranportchk">
                              </label>
                            <p>Transport</p>

                            </div>
              </div>
              <div class="form-group col-md-4" style="display:none;">
             <div class="checkbox">
                    <label>
                      <input type="checkbox" id="hostelchk">
                              </label>
                            <p>Hostel</p>

                            </div>
              </div>
</div>


<div class="box-body" id="tranport" style="display:none;">
  <div class="box-header with-border">
    <h3 class="box-title">Transport details:-</h3>
  </div>
<div class="row">
  <div class="form-group col-md-3">
                  <label>Route</label>
                 <select class="form-control select2" multiple="multiple" data-placeholder="Select a State">
                    <option selected="selected">Alabama</option>
                    <option>Alaska</option>
                    <option>California</option>
                    <option>Delaware</option>
                    <option>Tennessee</option>
                    <option>Texas</option>
                    <option>Washington</option>
                  </select>
                </div>
                <div class="form-group col-md-3">
                                <label>Destination</label>
                               <select class="form-control select2" multiple="multiple" data-placeholder="Select a State">
                                  <option selected="selected">Alabama</option>
                                  <option>Alaska</option>
                                  <option>California</option>
                                  <option>Delaware</option>
                                  <option>Tennessee</option>
                                  <option>Texas</option>
                                  <option>Washington</option>
                                </select>
                              </div>
<div class="form-group col-md-3">
<label for="exampleInputEmail1">Start Date</label>
<input type="text" class="form-control" id="Pin" placeholder="Father Name">
</div>
<div class="form-group col-md-3">
<label for="exampleInputEmail1">End Date</label>
<input type="text" class="form-control" id="Pin" placeholder="Father Name">
</div>
</div>
</div>

<div class="box-body" id="hostel" style="display:none;">
  <div class="box-header with-border">
    <h3 class="box-title">Hostel details:-</h3>
  </div>
<div class="row">
  <div class="form-group col-md-3">
                  <label>Hostel Name</label>
                 <select class="form-control select2" multiple="multiple" data-placeholder="Select a State">
                    <option selected="selected">Alabama</option>
                    <option>Alaska</option>
                    <option>California</option>
                    <option>Delaware</option>
                    <option>Tennessee</option>
                    <option>Texas</option>
                    <option>Washington</option>
                  </select>
                </div>
                <div class="form-group col-md-3">
                                <label>Hostel Room</label>
                               <select class="form-control select2" multiple="multiple" data-placeholder="Select a State">
                                  <option selected="selected">Alabama</option>
                                  <option>Alaska</option>
                                  <option>California</option>
                                  <option>Delaware</option>
                                  <option>Tennessee</option>
                                  <option>Texas</option>
                                  <option>Washington</option>
                                </select>
                              </div>
<div class="form-group col-md-3">
<label for="exampleInputEmail1">Registration Date</label>
<input type="text" class="form-control" id="Pin" placeholder="Father Name">
</div>
<div class="form-group col-md-3">
<label for="exampleInputEmail1">Vacating Date</label>
<input type="text" class="form-control" id="Pin" placeholder="Father Name">
</div>
</div>
</div>


            </div>
            </div>
            </div>
            <!-- /.box-body -->

          </div>
         <div class="box-footer">
       <button type="submit" class="btn btn-primary">Save</button>
     </div>
          <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
   </form>
   </div>

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
$("#same").change(function() {
    if(this.checked) {
      $('#presentaddress').val($('#permanentaddress').val());
    }else{
  $('#presentaddress').val("");
    }
});
</script>
<script>
       $(document).ready(function () {
         $("#stuinfo").hide();
           /*For Details Loading*/
           $("#batch").change(function(){
               var id = $(this).val();
               var _url = $("#_url").val();
               var dataString = 'eid=' + id;
               $.ajax
               ({
                   type: "POST",
                   url: _url + '/student/countstu',
                   data: dataString,
                   cache: false,
                   success: function ( data ) {
                   $("#stuinfo").show();
                    $("#stuinfo").fadeIn('slow');
                     var array = data.split("|");
                     var rollno=parseInt(array[1])+1;
                     $("#rollno").val(rollno);
                         $("#current").text(array[1]);
                         $("#total").text(array[0]);
                   },
                   error: function (jqXHR, exception) {
        var msg = '';
        if (jqXHR.status === 0) {
             $("#stuinfo").hide();
             $("#rollno").val('');
            msg = 'Not connect.\n Verify Network.';

        } else if (jqXHR.status == 404) {
             $("#stuinfo").hide();
             $("#rollno").val('');
            msg = 'Requested page not found. [404]';

        } else if (jqXHR.status == 500) {
             $("#stuinfo").hide();
             $("#rollno").val('');
            msg = 'Internal Server Error [500].';

        } else if (exception === 'parsererror') {
           $("#stuinfo").hide();
           $("#rollno").val('');
            msg = 'Requested JSON parse failed.';

        } else if (exception === 'timeout') {
           $("#stuinfo").hide();
           $("#rollno").val('');
            msg = 'Time out error.';
        } else if (exception === 'abort') {
           $("#stuinfo").hide();
           $("#rollno").val('');
            msg = 'Ajax request aborted.';
        } else {
           $("#stuinfo").hide();
           $("#rollno").val('');
            msg = 'Uncaught Error.\n' + jqXHR.responseText;
        }
        alert(msg);
    },
               });
           });

       });
   </script>
<script>
       $(document).ready(function () {
           /*For Details Loading*/
           $("#course").change(function(){
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
          $(document).ready(function () {
              /*For Details Loading*/

              $('#texttotal').val('');
              $("#feetype").on("select2:select", function (e) {
                  var id=   e.params.data.id;
              //    var id = $(this).val();
                  var _url = $("#_url").val();
                  var dataString = 'eid=' + id;
                  $.ajax
                  ({
                      type: "POST",
                      url: _url + '/student/feeamt',
                      data: dataString,
                      cache: false,
                      success: function ( data ) {
                        data=JSON.parse(data);
                        var prevamt=$('#totalfee').text();
                        var list = $("#totalfee");

                        for (var i in data) {
                        var v=data[i]['amount'];
                        var totalAmt=parseInt(prevamt)+parseInt(v);
                         $(list).text(totalAmt);
                          $('#texttotal').val(totalAmt);
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
        $(document).ready(function () {
          $("#feetype").on("select2:unselect", function (e) {
                var value=   e.params.data.id;
                var _url = $("#_url").val();
                var dataString = 'eid=' + value;
                $.ajax
                ({
                    type: "POST",
                    url: _url + '/student/feeamt',
                    data: dataString,
                    cache: false,
                    success: function ( data ) {
                      data=JSON.parse(data);
                      var prevamt=$('#totalfee').text();
                      var list = $("#totalfee");

                      for (var i in data) {
                      var v=data[i]['amount'];

                      var totalAmt=parseInt(prevamt)-parseInt(v);
                       $(list).text(totalAmt);
                         $('#texttotal').val(totalAmt);
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
$(document).ready(function(){
        $("#tranport").hide();
        $("#hostel").hide();
        $("#tranportchk").change(function() {
    if(this.checked) {
        //Do stuff
         $("#hostelchk").prop('checked',false);
        $("#tranport").fadeIn("slow");
        $("#tranport").animate({left: '10px'});
          $("#hostel").hide();
    }else{
      $("#tranport").fadeOut("slow");
    }
});

$("#hostelchk").change(function() {
if(this.checked) {
//Do stuff
 $("#tranportchk").prop('checked',false);
$("#tranport").hide();

  $("#hostel").fadeIn("slow");
  $("#hostel").animate({left: '10px'});
}else{
  $("#hostel").fadeOut("slow");
}
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
    function RestrictSpace() {
    if (event.keyCode == 32) {
        return false;
    }
}
</script>
@endsection
<!-- ./wrapper -->
