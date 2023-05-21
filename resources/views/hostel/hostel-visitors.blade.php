@extends('header')
@section('style')
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/bootstrap/dist/css/buttons.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/bootstrap/dist/css/rowReorder.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/bootstrap/dist/css/responsive.dataTables.min.css') }}">
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
        <li class="active">Hostel Visitors</li>
      </ol>
    </section>
    <section class="content">
        @include('notification.notify')
  <div class="box box-default">
    <!-- Main content -->
    <div class="box-header with-border">
      <h3 class="box-title"> </h3>

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
                <li class="active"><a href="#tab_1" data-toggle="tab">Hostel Visitors</a></li>
                <li><a href="#tab_2" data-toggle="tab">List</a></li>

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
                                   <h3 class="box-title">Hostel Visitors</h3>
                                 </div>
                                 <!-- /.box-header -->
                                 <!-- form start -->
                                 <form role="form" method="post" enctype="multipart/form-data" action="{{url('hostel/room/savevisitor')}}">
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
  <select id="student" name="reg_no" class="form-control select2" style="width: 100%;">
    <option value="0" selected="selected">Please Select</option>
  <?php foreach ($students as $students): ?>
      <option value="{{$students->reg_no}}">{{$students->stu_name}}  - {{$students->reg_no}}</option>
  <?php endforeach; ?>
  </select>
 </div>
 <div id="emp" class="form-group col-md-6">
      <label for="exampleInputEmail1">Employee <span style="color:red;"> *</span></label>
      <select id="emp_code" name="emp_code" class="form-control select2" style="width: 100%;">
        <option value="0" selected="selected">Please Select</option>
      <?php foreach ($employess as $employess): ?>
          <option value="{{$employess->empcode}}">{{$employess->fname}} {{$employess->mname}} {{$employess->lname}} - {{$employess->empcode}}</option>
      <?php endforeach; ?>
      </select>
 </div>
 <div id="tbl1" style="margin-top:10px;display:none;" class="form-group col-md-12 callout callout-info">

  <div class="form-group col-md-4" style="margin-top:10px;">
 <label for="exampleInputEmail1">Hostel:  </label>
 <label for="exampleInputEmail1" id="hostel"></label>
       <input type="hidden" class="form-control" id="hostels"  name="hostel" value=""  required>
  </div>
  <div class="form-group col-md-4" style="margin-top:10px;">
   <label for="exampleInputEmail1">Floor-Room No.:  </label>
 	<label for="exampleInputEmail1" id="room"> </label>
     <input type="hidden" class="form-control" id="floor_room"  name="floor_room" value=""  required>
  </div>
  <div class="form-group col-md-4" style="margin-top:10px;">
   <label for="exampleInputEmail1">Hostel Rent:  </label>
 	<label for="exampleInputEmail1" id="rent"></label>
  </div>
  </div>
   <div id="emp" class="form-group col-md-6">
  <label for="exampleInputEmail1">Visitors Name <span style="color:red;"> *</span></label>
  <input type="text" class="form-control" name="visitor_name"  required>
 </div>
<div id="emp" class="form-group col-md-6">
  <label for="exampleInputEmail1">Relation<span style="color:red;"> *</span></label>
  <input type="text" class="form-control" name="relation" required>
 </div>
<div   class="form-group col-md-6">
<label for="exampleInputEmail1">Date<span style="color:red;"> *</span></label>
<div class="input-group date">
  <div class="input-group-addon">
    <i class="fa fa-calendar"></i>
      </div>
  <input type="text" class="form-control pull-right" id="startdate" name="startdate">
  </div>
</div>
										 <div class="form-group col-md-6">
                       <div class="bootstrap-timepicker">
             <div class="form-group">
               <label>Stop Time<span style="color:red;"> *</span></label>

               <div class="input-group">
                 <input type="text" class="form-control timepicker" name="stoptime" value="{{ old('stoptime') }}">

                 <div class="input-group-addon">
                   <i class="fa fa-clock-o"></i>
                 </div>
               </div>
               <!-- /.input group -->
             </div>
             <!-- /.form group -->
           </div>
          </div>
 </div>
   </div>
 <div class="box-footer">
<button type="submit" class="btn btn-primary">Save</button>
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
                                <th>User</th>
                                <th>Hostel</th>
                                  <th>Floor-Room</th>
							                 	<th>Visitor Name</th>
                                <th>Relation</th>
                                <th>Date-Time</th>
                                <th>Action</th>
                              </tr>
                              </thead>
                              <tbody>
                                @php $i=0; @endphp
                                @foreach($visitor_list as $visitor_list)
                                @php $i++; @endphp
                                <tr>
                                  <td>@php echo $i; @endphp</td>
                                  <td>{{$visitor_list->usertype}}</td>
                                  <td>{{$visitor_list->student_name}}</td>
                                  <td>{{$visitor_list->hostelname}}</td>
                                  <td>{{$visitor_list->floor_room}}</td>
                                  <td>{{$visitor_list->vistor_name}}</td>
                                  <td>{{$visitor_list->relation}}</td>
                                  <td>{{$visitor_list->datee}} {{$visitor_list->time}}</td>
                                  <td>
                                    <div class="btn-group">
                                      <button type="button" class="btn btn-default  btn-flat dropdown-toggle" data-toggle="dropdown">
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                      </button>
                                      <ul class="dropdown-menu" role="menu" title="Action">
                                      <li><a href="#" class="tFileDelete" id="{{$visitor_list->id}}" title="Delete"><i class="fa fa-trash" style="color: red";></i></a></li>
                                      </ul>
                                    </div>
                                </td>
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
<script src="{{ URL::asset('assets/plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/jquery/dist/bootbox.min.js') }}"></script>


<script>
        $(document).ready(function () {

                    $("#student").change(function(){
                           var id = $(this).val();
                           var _url = $("#_url").val();
                           var dataString = 'eid=' + id;
                      //    alert(id);

                              $.ajax
                              ({
                                  type: "POST",
                                  url: _url + '/hostel/room/hostelstudentroomdetails',
                                  data: dataString,
                                  cache: false,
                                  success: function ( data ) {
                                    //alert(data);
                                     $("#tbl1").show();
                                    data=data.split("|");
                                    var hostel=data[0];
                                    var floor=data[1];
                                    var room=data[2];
                                    var rent=data[3];
                                  $('#hostel').html(hostel);
                                  $('#hostels').val(hostel);
                                  $('#room').html(floor +'-'+ room);
                                  $('#floor_room').val(floor +'-'+ room);
                                  $('#rent').html(rent );
                                  $("#tbl1").show();
                                  $("#tbl1").fadeIn('slow');


                                  },
                                  error: function (jqXHR, exception) {
                       var msg = '';
                       if (jqXHR.status === 0) {
                           msg = 'Not connect.\n Verify Network.';
                       } else if (jqXHR.status == 404) {
                           msg = 'Requested page not found. [404]';
                       } else if (jqXHR.status == 500) {
                           msg = 'Room Not Assign to this Registration No.';
                           $("#tbl1").hide();
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
            /*For Delete Application Info*/
            $(".tFileDelete").click(function (e) {
                e.preventDefault();
                var id = this.id;
                bootbox.confirm("Are you sure?", function (result) {
                    if (result) {
                        var _url = $("#_url").val();
                        window.location.href = _url + "/hostel/visitors/delete/" + id;
                    }
                });
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
        //Datemask dd/mm/yyyy

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
          $("#emp").hide();
          $("#emp").fadeOut('slow');
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
$("#ht").hide();
$("#hn").hide();
$("#hr").hide();
    $("#type").change(function(){
       var type = $(this).val();
      if(type=='rs'){
        $("#typechn").html("Fine Amount<span style='color:red;'> *</span>");
      }else{
        $("#typechn").html("Fine Percentage<span style='color:red;'> *</span>");
      }
    });
$("#openh").change(function(){
       var types = $(this).val();
       if(types=='transfer'){
          $("#ht").show();
		  $("#hn").show();
		  $("#hr").show();
          $("#ht").fadeIn('slow');
        }else{
          $("#ht").hide();
		  $("#hn").hide();
		  $("#hr").hide();


        }
    });

});
</script>
<script>
$(document).ready(function(){
$("#tbl").hide();


$("#tblopen").change(function(){
       var types = $(this).val();
       if(types=='1'){
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
@endsection
<!-- ./wrapper -->
