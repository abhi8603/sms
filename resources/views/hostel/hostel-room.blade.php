@extends('header')
@section('style')
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/bootstrap/dist/css/buttons.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/bootstrap/dist/css/rowReorder.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/bootstrap/dist/css/responsive.dataTables.min.css') }}">
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
        <li class="active">Add Hostel Room</li>
      </ol>
    </section>
    <section class="content">
        @include('notification.notify')
  <div class="box box-default">
    <!-- Main content -->
    <div class="box-header with-border">
      <h3 class="box-title">Add Hostel Room</h3>

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
                <li class="active"><a href="#tab_1" data-toggle="tab">Hostel Room </a></li>
                <li><a href="#tab_2" data-toggle="tab">Hostel List</a></li>

                <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                  <div class="box-body">
                    <div class="row">
                      <div class="col-md-12">
                        <!-- /.form-group -->
                        <div class="box box-primary">
                                 <div class="box-header with-border">
                                   <h3 class="box-title">Add Hostel Type</h3>
                                 </div>
                                 <form role="form" method="post" enctype="multipart/form-data" action="{{url('hostel/hostel/addRoom')}}">
                                   <div class="box-body">
                                     <div class="col-md-7">
                                     <div class="form-group ">
                                       <label for="exampleInputEmail1">Hostel Type<span style="color:red;"> *</span></label>
                                      <select class="form-control select2" id="hostel_type" name="hostel_type" style="width: 100%;">
                              <option value="" selected="selected">Please Select</option>
                            <?php foreach ($room_type as $room_type): ?>
                                <option value="{{$room_type->id}}">{{$room_type->hotel_type}}</option>
                            <?php endforeach; ?>
                       </select>

                                        </div>
										 <div class="form-group">
                          <label for="exampleInputEmail1">Hostel Name <span style="color:red;"> *</span></label>
                          <select class="form-control select2" id="hostel_name" name="hostel_name" style="width: 100%;">
                              <option selected="selected">Please Select</option>

                       </select>          </div>
	 <div class="form-group">
  <label for="exampleInputEmail1">Floor Name <span style="color:red;"> *</span></label>
       <input type="text" class="form-control" name="floor_name" id="reg_no" >
 </div>
 <div class="form-group" >
     <label for="exampleInputEmail1">Room No<span style="color:red;"> *</span></label>
    <input type="text" class="form-control" name="room_no" id="name" placeholder="Room No." required>
 </div>
 <div class="form-group">
    <label for="exampleInputEmail1">No. Of Beds<span style="color:red;"> *</span></label>
  <input type="text" class="form-control" onkeypress="return isNumber(event)" name="no_of_bed"  placeholder="No. Of Beds" required>
 </div>
 <div class="form-group">
  <label for="exampleInputEmail1">Amount<span style="color:red;"> *</span></label>
     <input type="text" class="form-control" onkeypress="return isNumber(event)" name="amount" id="email1" placeholder="Amount" required>
 </div>
 <!--<div class="form-group">
      <label for="exampleInputEmail1">Fee Type<span style="color:red;"> *</span></label>
    <select class="form-control select2" style="width: 100%;">
          <option selected="selected">Please Select</option>
          <option value="1">Annual</option>
          <option value="2">Monthly</option>
          <option value="3">Tri-anual</option>
          <option value="4">Bi-Annaul</option>
    </select>
  </div>-->
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
                   <div class="box-body">
                    <div class="row">
						                <div class="col-md-12">
                          <div class="box-body col-md-12">
                            <table id="example" class="table table-striped table-bordered display" style="width:100%">
                              <thead>
                              <tr>
                                <th>Sl.No</th>
                                <th>Hostel Type </th>
                                <th>Hostel Name </th>
                                <th>Floor Name</th>
                                <th>Room No</th>
                                <th>No. Of Bed</th>
                                <th>Amount</th>
                                <th>Manage</th>
                              </tr>
                              </thead>
                              <tbody>
                                @php $i=0; @endphp
                                @foreach($rooms as $rooms)
                                @php $i++; @endphp
                              <tr>
                                <td><?php echo $i; ?></td>
                                <td>{{$rooms->hotel_type}}</td>
                                <td>{{$rooms->hostelname}}</td>
                                <td>{{$rooms->floor_name}}</td>
                                <td>{{$rooms->room_no}}</td>
                                <td>{{$rooms->no_of_bed}}</td>
                                <td>{{$rooms->amount}}</td>
                                <td>
                                  <div class="btn-group">
                                    <button type="button" class="btn btn-default  btn-flat dropdown-toggle" data-toggle="dropdown">
                                      <span class="caret"></span>
                                      <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu" title="Action">
                                      <li><a href="{{url('hostel/room/view/'.$rooms->id)}}" title="Edit"><i  class="fa fa-eye" style="color: #897df8e6";></i></a></li>
                                      <li><a class="tFileDelete" href="" id="{{$rooms->id}}" title="Delete"><i class="fa fa-trash" style="color: red";></i></a></li>

                                    </ul>
                                  </div>
                                </td>
                              </tr>
                              @endforeach
                              </tbody>

                            </table>

                          </div>
                        </div>

                        </div>
                        </div>

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
           $("#hostel_type").change(function () {
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
                      var list = $("#hostel_name");
                      $(list).empty().append('<option selected="selected" value=""> Please Select </option>');

                     $(data).empty();
                      var emptycarno="Hostel details not available for this Room Type.";
             if(data.length==""){
                        $("#hostel_name").append('<option value="' +emptycarno +'">' + emptycarno + '</option>');
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
                        window.location.href = _url + "/hostel/deleteroom/" + id;
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
@endsection
<!-- ./wrapper -->
