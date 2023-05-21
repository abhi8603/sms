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
        <li class="active"> Hostel Room View</li>
      </ol>
    </section>
    <section class="content">
        @include('notification.notify')
  <div class="box box-default">
    <!-- Main content -->

    <div class="box-header with-border">
      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        <button style="display:none;" type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
      </div>
    </div>

        <div class="row">
          <div class="col-md-12">
                  <div class="box-body">
                    <div class="row">
                      <div class="col-md-12">
                        <!-- /.form-group -->
                        <div class="box box-primary">
                                 <div class="box-header with-border">
                                   <h3 class="box-title">Update Hostel Room</h3>
                                 </div>
                                 <form role="form" method="post" enctype="multipart/form-data" action="{{url('hostel/room/update')}}">
                                   <div class="box-body">
                                     <div class="col-md-7">
                                     <div class="form-group ">
                                       <label for="exampleInputEmail1">Hostel Type<span style="color:red;"> *</span></label>
                                      <select class="form-control select2" id="hostel_type" name="hostel_type" style="width: 100%;">
                              <option value="" selected="selected">Please Select</option>
                            <?php foreach ($room_type as $room_type): ?>
                                <option value="{{$room_type->id}}" @if($hosteltype==$room_type->id) selected @endif>{{$room_type->hotel_type}}</option>
                            <?php endforeach; ?>
                       </select>

                                        </div>
										 <div class="form-group">
                          <label for="exampleInputEmail1">Hostel Name <span style="color:red;"> *</span></label>
                          <select class="form-control select2" id="hostel_name" name="hostel_name" style="width: 100%;">
                              <option selected="selected">Please Select</option>
                              @if($hostelname){
                                  <option value="{{$hostelname}}" selected="selected">{{$hostelname}}</option>
                              }
                              @endif
                       </select>
                     </div>
	 <div class="form-group">
  <label for="exampleInputEmail1">Floor Name <span style="color:red;"> *</span></label>
       <input type="text" class="form-control" value="{{$floor_name OR ''}}" name="floor_name"/>
          <input type="hidden" class="form-control" value="{{$id OR ''}}" name="id"/>
 </div>
 <div class="form-group" >
     <label for="exampleInputEmail1">Room No<span style="color:red;"> *</span></label>
    <input type="text" class="form-control" name="room_no" value="{{$room_no OR ''}}" placeholder="Room No." required/>
 </div>
 <div class="form-group">
    <label for="exampleInputEmail1">No. Of Beds<span style="color:red;"> *</span></label>
  <input type="text" class="form-control" onkeypress="return isNumber(event)" value="{{$no_of_bed OR ''}}" name="no_of_bed"  placeholder="No. Of Beds" required>
 </div>
 <div class="form-group">
  <label for="exampleInputEmail1">Amount<span style="color:red;"> *</span></label>
     <input type="text" class="form-control" onkeypress="return isNumber(event)" name="amount" value="{{$amount OR ''}}" placeholder="Amount" required>
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
       <button type="submit" class="btn btn-primary">Update</button>
    </div>
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    </form>
  </div>
</div>
</div>
</div>
</div>
        </div>
    </section>
    <!-- /.content -->
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
