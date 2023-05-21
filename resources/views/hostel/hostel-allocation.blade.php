@extends('header')
@section('style')
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/buttons.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/rowReorder.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/responsive.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/select2/dist/css/select2.min.css') }}">
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
        <li><a href="#"><i class="fa fa-dashboard"></i>Hostel </a></li>
        <li class="active">Hostel Registration</li>
      </ol>
    </section>
    <section class="content">
        @include('notification.notify')
  <div class="box box-default">
    <!-- Main content -->
    <div class="box-header with-border">
      <h3 class="box-title">Hostel Registration </h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        <button style="display:none;" type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
      </div>
    </div>

        <div class="row">
          <div class="col-md-12">
            <!-- Custom Tabs -->
            <div class="nav-tabs-custom">
              <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1" data-toggle="tab">Hostel Registration </a></li>
                <li><a href="#tab_2" data-toggle="tab">Allocated List</a></li>

                <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                  <div class="box-body">
                    <div class="row">
                      <div class="col-md-15">

                        <!-- /.form-group -->
                        <div class="box box-primary">
                                 <div class="box-header with-border">
                                   <h3 class="box-title">Hostel Registration</h3>
                                 </div>
                                 <!-- /.box-header -->
                                 <!-- form start -->
                                 <form role="form" method="post" enctype="multipart/form-data" action="{{url('hostel/room/savenew')}}">
                                   <div class="box-body">
                                     <div class="col-md-12">
                                     <div class="form-group col-md-6">
                              <label for="exampleInputEmail1">User Type<span style="color:red;"> *</span></label>
                              <select id="utype" name="utype" class="form-control select2" style="width: 100%;">
                              <option selected="selected">Please Select</option>
                              <option value="student">Student</option>
                              <option value="employee">Employee</option>
                              </select>
                              </div>
										<div id="stdnt" class="form-group col-md-6">
                      <label for="exampleInputEmail1">Student<span style="color:red;"> *</span></label>
                      <select id="reg_no" name="reg_no" class="form-control select2" style="width: 100%;">
                        <option value="0" selected="selected">Please Select</option>
                      <?php foreach ($students as $students): ?>
                          <option value="{{$students->reg_no}}">{{$students->stu_name}} - {{$students->reg_no}}</option>
                      <?php endforeach; ?>
                      </select>
                    </div>
                    <div id="emp" class="form-group col-md-6">
                      <label for="exampleInputEmail1">Employee <span style="color:red;"> *</span></label>

                      <select id="utype" name="emp_code" class="form-control select2" style="width: 100%;">
                        <option value="0" selected="selected">Please Select</option>
                      <?php foreach ($employess as $employess): ?>
                          <option value="{{$employess->empcode}}">{{$employess->fname}} {{$employess->mname}} {{$employess->lname}} - {{$employess->empcode}}</option>
                      <?php endforeach; ?>
                      </select>
                    </div>
                    <div   class="form-group col-md-6">
                       <label for="exampleInputEmail1">Hostel Type<span style="color:red;"> *</span></label>
                       <select class="form-control select2" name="hosteltype" id="hosteltype" style="width: 100%;">
                          <option selected="selected">Please Select</option>
                          <?php foreach ($hosteltype as $hosteltype): ?>
                              <option value="{{$hosteltype->id}}">{{$hosteltype->hotel_type}}</option>
                          <?php endforeach; ?>
                       </select>
                    </div>
                   <div   class="form-group col-md-6 ">
                    <label for="exampleInputEmail1">Hostel Name<span style="color:red;"> *</span></label>
                    <select class="form-control select2" name="hostelname" id="hostelname" style="width: 100%;">
                      <option selected="selected">Please Select</option>

                   </select>
                  </div>

					        <div class="form-group col-md-6">
                     <label for="exampleInputEmail1">Hostel Room<span style="color:red;"> *</span></label>
                     <select id="tblopen" class="form-control select2" name="hostelroom" style="width: 100%;">
                      <option value="" selected="selected">Please Select</option>

                       </select>
                  </div>
					   <div id="tbl" style="margin-top:10px;" class="form-group col-md-12 callout callout-info">
			            <div style="margin-left:86px;">
                  <div class="form-group col-md-6" style="margin-top:10px;">
                  <label for="exampleInputEmail1">Hostel Type :  </label>
						      <label for="exampleInputEmail1" id="hostel_type"></label>
                </div>
            <div class="form-group col-md-6" style="margin-top:10px;">
                 <label for="exampleInputEmail1">Hostel name :  </label>
						     <label for="exampleInputEmail1" id="hostelnames"></label>
            </div>
            <div class="form-group col-md-6" style="margin-top:10px;">
                  <label for="exampleInputEmail1">Floor Name :  </label>
						      <label for="exampleInputEmail1" id="floorname"></label>
            </div>
            <div class="form-group col-md-6" style="margin-top:10px;">
              <label for="exampleInputEmail1">Room No :  </label>
						  <label for="exampleInputEmail1" id="roomno"></label>
            </div>
            <div class="form-group col-md-6" style="margin-top:10px;">
              <label for="exampleInputEmail1">No of Beds :  </label>
						  <label for="exampleInputEmail1" id="noofbed"></label>
            </div>
            <div class="form-group col-md-6" style="margin-top:10px;">
              <label for="exampleInputEmail1">Rent Amount :  </label>
						  <label for="exampleInputEmail1" id="rent_amt"></label>
              <input type="hidden" value="" id="rent_amt1" name="rent_amt1">
            </div>
            <div class="form-group col-md-6" style="margin-top:10px;">
              <label for="exampleInputEmail1">Available Beds :  </label>
						  <label for="exampleInputEmail1" id="availableroom"></label>
            </div>
            <div class="form-group col-md-6" style="margin-top:10px;">
              <label for="exampleInputEmail1">Requested Beds :  </label>
						  <label for="exampleInputEmail1" id="req_bed">0</label>
            </div>
            <div class="form-group col-md-6" style="margin-top:10px;">
              <label for="exampleInputEmail1">Accepted Beds :  </label>
						  <label for="exampleInputEmail1" id="accepted_bed">0</label>
            </div>
            <div class="form-group col-md-6" style="margin-top:10px;">
              <label for="exampleInputEmail1">	Allocated Beds :  </label>
						  <label for="exampleInputEmail1" id="allocate_bed">1</label>
            </div>
          </div>
        </div>
        <div class="form-group col-md-4">
                <label for="exampleInputEmail1">Hostel Registration Date<span style="color:red;"> *</span></label>
                <div class="input-group date">
                <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
                </div>
                <input type="text" class="form-control pull-right dob" id="startdate" name="startdate" autocomplete="off">
                </div>
                </div>
								<div class="form-group col-md-4">
                <label for="exampleInputEmail1">Hostel Vacating Date<span style="color:red;"> *</span></label>
                <div class="input-group date">
                <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
                </div>
                <input type="text" class="form-control pull-right dob" id="startdate" name="vacatdate" autocomplete="off">
                </div>
              </div>
            </div>
            </div>
      <div class="box-footer">
       <button type="submit" id="savedata" class="btn btn-primary">Save</button>
      </div>
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
     </form>
    </div>
  </div>
</div>
</div>
</div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="tab_2">
                  <form role="form" method="post" enctype="multipart/form-data" action="">
                  <div class="box-body">
                    <div class="row">

						<div class="col-md-16">


                          <!-- /.box-header -->
                          <div class="box-body col-md-16">
                            <table id="example1" class="table table-striped table-bordered display" style="width:100%">
                              <thead>
                              <tr>
                                <th>Sl.No</th>
								                <th>User Type</th>
                                <th>User Id</th>
                                <th>Hostel Type</th>
                                  <th>Floor Name</th>
								                <th>Hostel Room </th>
                                <th>Hostel Registration Date</th>
								                <th>Vacating Date</th>
                              </tr>
                              </thead>
                              <tbody>
                                @php $i=0; @endphp
                                @foreach($hotelallocationlist as $hotelallocationlist)
                                @php $i++; @endphp
                              <tr>
                                <td>@php echo $i; @endphp</td>
                                    <td>{{$hotelallocationlist->usertype}}</td>
                                    <td>{{$hotelallocationlist->user_name}}</td>
                                    <td>{{$hotelallocationlist->hotel_type}}</td>
                                    <td>{{$hotelallocationlist->hostel_name}}</td>
                                    <td>{{$hotelallocationlist->room_no}}</td>
                                    <td>{{$hotelallocationlist->hostel_reg_date}}</td>
                                    <td>{{$hotelallocationlist->hostel_vacating_date}}</td>
                              </tr>
                              @endforeach
                              </tbody>

                            </table>

                      <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                      </div>
                          </div>
                          <!-- /.box-body -->
                        </div>

                        </div>
                        </div>
						</form>
                        </div>

                </div>

              </div>
              <!-- /.tab-content -->
            </div>
            <!-- nav-tabs-custom -->

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
<script src="{{ URL::asset('assets/bower_components/chart.js/Chart.js') }}"></script>
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
           /*For Details Loading*/
           $("#reg_no").change(function(){
               var id = $(this).val();
               //alert(id);
               var _url = $("#_url").val();
               var dataString = 'eid=' + id;
               $.ajax
               ({
                   type: "POST",
                   url: _url + '/hostel/hostelroom/check',
                   data: dataString,
                   cache: false,
                   success: function ( data ) {
                    data=JSON.parse(data);
                      if(data=="1"){
                         $(":submit").attr("disabled", true);
                       alert("Hostel is already allocated to this Registration No. for this Accadmic Year.");
                      }else{
                        $(":submit").removeAttr("disabled");
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
           $("#hostelname").change(function(){
               var id = $(this).val();
              // alert(id);
               var _url = $("#_url").val();
               var dataString = 'eid=' + id;
               $.ajax
               ({
                   type: "POST",
                   url: _url + '/hostel/hostelroom',
                   data: dataString,
                   cache: false,
                   success: function ( data ) {
                    data=JSON.parse(data);

                    //   alert(data);
                         var list = $("#tblopen");
                      $(list).empty().append('<option selected="selected" value=""> Please Select </option>');

                     $(data).empty();
                      var emptycarno="No Hostel room available for this Hostel";
             if(data.length==""){
                        $("#tblopen").append('<option value="' +emptycarno +'">' + emptycarno + '</option>');
             }
               else{
                        for (var i in data) {
                          var v=data[i]['id'];
                          var v1=data[i]['floor_name'];
                          var v2=data[i]['room_no'];
                          $(list).append('<option value="' +v +'">' + v1 +' - '+ v2 + '</option>');

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
              $("#tblopen").change(function(){
                  var id = $(this).val();
                  var hosteltype=$("#hosteltype").val();
                  var hostelname=$("#hostelname").val();
                 // alert(id);
                  var _url = $("#_url").val();

                  $.ajax
                  ({
                      type: "POST",
                      url: _url + '/hostel/hostelroomdetails',
                      data: {eid:id,hostelname:hostelname,hosteltype:hosteltype},
                      cache: false,
                      success: function ( data ) {
                      //   data=JSON.parse(data);

                        //  alert(data);
                          data=data.split('|');
                          var hosteltype=data[0];
                          var roomcnt=data[1];
                          var hostelname=data[2];
                          var floor_name=data[3];
                          var roomno=data[4];
                          var no_of_bed=data[5];
                          var amt=data[6];
                        //  alert(roomcnt);

                        $("#hostel_type").html(hosteltype);
                        $("#hostelnames").html(hostelname);
                        $("#floorname").html(floor_name);
                        $("#roomno").html(roomno);
                        $("#noofbed").html(no_of_bed);
                        $("#rent_amt").html(amt);
                        var avilrooms=parseInt(no_of_bed)-parseInt(roomcnt);
                        $("#availableroom").html(avilrooms);
                        $("#req_bed").html("1");
                        $("#accepted_bed").html("1");
                        $("#allocate_bed").html("1");
                        $('#rent_amt1').val(amt)
                        if(avilrooms=='0'){
                          alert('Bed Not Available In this room.Please Select another Room.');
                          $("#savedata").attr('disabled','disabled');
                        }else{
                          $("#savedata").removeAttr('disabled');
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
           $("#hosteltype").change(function(){
               var id = $(this).val();
          //     alert(id);
               var _url = $("#_url").val();
               var dataString = 'eid=' + id;
               $.ajax
               ({
                   type: "POST",
                   url: _url + '/hostel/hostelname',
                   data: dataString,
                   cache: false,
                   success: function ( data ) {
                     data=JSON.parse(data);

                      //   alert(data);
                         var list = $("#hostelname");
                      $(list).empty().append('<option selected="selected" value=""> Please Select </option>');

                     $(data).empty();
                      var emptycarno="No Hostel available for this Hostel Type";
             if(data.length==""){
                        $("#hostelname").append('<option value="' +emptycarno +'">' + emptycarno + '</option>');
             }
               else{
                        for (var i in data) {
                          var v=data[i]['id'];
                          var v1=data[i]['hostel_name'];
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
            /*For Delete Application Info*/
            $(".tFileDelete").click(function (e) {
                e.preventDefault();
                var id = this.id;
                bootbox.confirm("Are you sure?", function (result) {
                    if (result) {
                        var _url = $("#_url").val();
                        window.location.href = _url + "/Academic-Details/delete/" + id;
                    }
                });
            });

        $("#viewedit").click(function () {
            $("#editview").show();
            $(this).hide();
            $("#edit").show();
            $("#view").hide();
        });
        $("#editview").click(function () {
            $("#viewedit").show();
            $(this).hide();
            $("#view").show();
            $("#edit").hide();
        });

        });
    </script>
	<script>
$(document).ready(function(){
$("#stdnt").hide();
$("#emp").hide();
$("#utype").change(function(){
       var types = $(this).val();
       if(types=='student'){
          $("#stdnt").show();
          $("#stdnt").fadeIn('slow');
        }else{
          $("#stdnt").hide();
          $("#dell").fadeOut('slow');
		  $("#emp").show();
          $("#emp").fadeIn('slow');

        }
    });
});
</script>
<script>
$(document).ready(function(){
$("#tbl").hide();


$("#tblopen").change(function(){
       var types = $(this).val();
       if(types!='0'){
          $("#tbl").show();
          $("#tbl").fadeIn('slow');
        }else{
          $("#tbl").hide();
          $("#tbl").fadeOut('slow');


        }
    });
$
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
    $('.dob').datepicker({
      autoclose: true,
      format:'dd-mm-yyyy'
    });
    });
</script>
@endsection
<!-- ./wrapper -->
