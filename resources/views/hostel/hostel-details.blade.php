@extends('header')
@section('style')
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/buttons.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/rowReorder.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/responsive.dataTables.min.css') }}">
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
        <li class="active">Hostel Details</li>
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
                <li class="active"><a href="#tab_1" data-toggle="tab">Hostel Type </a></li>
                <li><a href="#tab_2" data-toggle="tab">Hostel Details</a></li>

                <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                  <div class="box-body">
                    <div class="row">
                      <div class="col-md-4">
                        <!-- /.form-group -->
                        <div class="box box-primary">
                                 <div class="box-header with-border">
                                   <h3 class="box-title">Add Hostel Type</h3>
                                 </div>
                                 <!-- /.box-header -->
                                 <!-- form start -->
                                 <form role="form" method="post" enctype="multipart/form-data" action="{{url('hostel/hosteltype')}}">
                                   <div class="box-body">
                                     <div class="col-md-12">
                                     <div class="form-group col-md-12">
                                       <label for="exampleInputEmail1">Hostel Type<span style="color:red;"> *</span></label>
                                       <input type="text"  class="form-control" name="type" value="">

                                        </div>
                                     </div>

                                 </div>
                                   <div class="box-footer">
                                     <button type="submit" class="btn btn-primary">Save</button>
                                   </div>
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                 </form>
                               </div>

                        <!-- /.form-group -->
                      </div>
                      <div class="col-md-8">
                        <div class="box box-info">
                          <div class="box-header">

                          </div>
                          <!-- /.box-header -->
                          <div class="box-body">
                            <table id="example" class="table table-striped table-bordered display nowrap" style="width:100%">
                              <thead>
                              <tr>
                                <th>Sl.No</th>
                                <th>Hostel Type </th>
                                <th>Manage</th>
                              </tr>
                              </thead>
                              <tbody>
                                @php $i=0; @endphp
                                @foreach($hosteltype as $hosteltype)
                                @php $i++ @endphp
                              <tr>
                                <td><?php echo $i; ?></td>
                                <td>{{$hosteltype->hotel_type}}</td>
                                <td>
                                  <div class="btn-group">
                                    <button type="button" class="btn btn-default  btn-flat dropdown-toggle" data-toggle="dropdown">
                                      <span class="caret"></span>
                                      <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu" title="Action">
                                      <li><a href="{{url('transport/destination/view/'.$hosteltype->id)}}" title="Edit"><i  class="fa fa-eye" style="color: #897df8e6";></i></a></li>
                                      <li><a class="tFileDelete" href="" id="{{$hosteltype->id}}" title="Delete"><i class="fa fa-trash" style="color: red";></i></a></li>

                                    </ul>
                                  </div>
                                </td>
                              </tr>
                              @endforeach
                              </tbody>

                            </table>
                          </div>
                          <!-- /.box-body -->
                        </div>
              </div>
            </div>
          </div>
        </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="tab_2">

                  <div class="box-body">
                    <div class="row">
                        <form role="form" method="post" enctype="multipart/form-data" action="{{url('hostel/hosteldetails')}}">
                      <div class="col-md-5">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Hostel Type<span style="color:red;"> *</span></label>
                          <select class="form-control select2" name="hostel_type"  style="width: 100%;">
                              <option selected="selected">Please Select</option>
                            <?php foreach ($hosteltypes as $hosteltypes): ?>
                                <option value="{{$hosteltypes->id}}">{{$hosteltypes->hotel_type}}</option>
                            <?php endforeach; ?>
                       </select>
                      </div>
					       <div class="form-group">
                <label for="exampleInputEmail1">Hostel Name <span style="color:red;"> *</span></label>
                <input type="text" class="form-control" name="hostel_name" id="reg_no" required>
                </div>
					  <div class="form-group">
            <label for="exampleInputEmail1">Hostel Address<span style="color:red;"> *</span></label>
            <textarea type="text" class="form-control" name="hostel_address" id="reg_no" required></textarea>
            </div>
					  <div class="form-group">
                          <label for="exampleInputEmail1">Hostel Phone Number<span style="color:red;"> *</span></label>
                           <input type="text" class="form-control" name="hostel_phone"  value="" id="extra7" name="extra7" onkeypress="return isNumber(event)" maxlength="10" required>

                      </div>
					  <div class="form-group">
                          <label for="exampleInputEmail1">Warden Name<span style="color:red;"> *</span></label>
                        <input type="text" class="form-control" name="warden_name"  required>

                      </div>
					  <div class="form-group">
                          <label for="exampleInputEmail1">Warden Address<span style="color:red;"> *</span></label>
                          <textarea type="text" class="form-control" name="warden_address" id="reg_no" required></textarea>

                      </div>
					  <div class="form-group">
                          <label for="exampleInputEmail1">Warden Phone Number<span style="color:red;"> *</span></label>
                          <input type="text" class="form-control" name="warden_phone"  value="" id="extra7" name="extra7" onkeypress="return isNumber(event)" maxlength="10" required>

                      </div>
                      <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      </div>
                        </div>
                          </form>
						                    <div class="col-md-7">
                          <div class="">
                          <!-- /.box-header -->
                          <div class="box-body">
                            <table id="example1" class="table table-striped table-bordered display" style="width:100%">
                              <thead>
                              <tr>
                                <th>Sl.No</th>
								                <th>Hostel Type </th>
                                <th>Hostel Name </th>
                                <th>Hostel Phone </th>
                                <th>Warden Name </th>
                                <th>Manage</th>
                              </tr>
                              </thead>
                              <tbody>
                                @php $i=0; @endphp
                                @foreach($hosteldetails as $hosteldetails)
                                @php $i++; @endphp
                              <tr>
                                <td><?php echo $i; ?></td>
								                <td>{{$hosteldetails->hostel_type}}</td>
                                <td>{{$hosteldetails->hostel_name}}</td>
                                <td>{{$hosteldetails->hostel_phone}}</td>
                                <td>{{$hosteldetails->warden_name}}</td>
                                <td>
                                  <div class="btn-group">
                                    <button type="button" class="btn btn-default  btn-flat dropdown-toggle" data-toggle="dropdown">
                                      <span class="caret"></span>
                                      <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu" title="Action">
                                      <li><a href="{{url('hostel/hosteldetails/view/'.$hosteldetails->id)}}" title="Edit"><i  class="fa fa-eye" style="color: #897df8e6";></i></a></li>
                                      <li><a class="hFileDelete" href="" id="{{$hosteldetails->id}}" title="Delete"><i class="fa fa-trash" style="color: red";></i></a></li>

                                    </ul>
                                  </div>
                                </td>
                              </tr>
                              @endforeach
                              </tbody>

                            </table>
                          </div>
                          <!-- /.box-body -->
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
            /*For Delete Application Info*/
            $(".tFileDelete").click(function (e) {
                e.preventDefault();
                var id = this.id;
                bootbox.confirm("Are you sure?", function (result) {
                    if (result) {
                        var _url = $("#_url").val();
                        window.location.href = _url + "/hostel/hosteltype/delete/" + id;
                    }
                });
            });
        });
    </script>
    <script>
            $(document).ready(function () {
                /*For Delete Application Info*/
                $(".hFileDelete").click(function (e) {
                    e.preventDefault();
                    var id = this.id;
                    bootbox.confirm("Are you sure?", function (result) {
                        if (result) {
                            var _url = $("#_url").val();
                            window.location.href = _url + "/hostel/hosteldetails/delete/" + id;
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
@endsection
<!-- ./wrapper -->
