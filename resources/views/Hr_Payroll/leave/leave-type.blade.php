@extends('../header')
@section('style')
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
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
        <li><a href="#"><i class="fa fa-dashboard"></i> HR/Payroll</a></li>
          <li><a href="#"><i class="fa fa-dashboard"></i>Leave Management</a></li>
        <li class="active">Add Leave Type</li>
      </ol>
    </section>

    <!-- Main content -->
      <section class="content">
        @include('notification.notify')
    <div class="box box-default">
            <div class="box-header with-border">
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
                             <h3 class="box-title">Add Leave Type</h3>
                           </div>
                           <!-- /.box-header -->
                           <!-- form start -->
                           <form role="form" method="post" enctype="multipart/form-data" action="{{url('employee/leave/leave-type/add')}}">
                          <div class="box-body">
                            <div class="form-group">
                              <label for="exampleInputEmail1">Leave Name<span style="color:red;"> *</span></label>
                              <input type="text" class="form-control" id="name" name="name" placeholder="Leave Name" required>
                            </div>
                            <div class="form-group">
                              <label for="exampleInputEmail1">No. Of Days<span style="color:red;"> *</span></label>
                              <input type="text" class="form-control" onkeypress="return isNumber(event)" id="no_of_days" name="no_of_days" placeholder="No. Of Days" required>
                            </div>
         </div>
         <div class="box-footer">
       <button type="submit" class="btn btn-primary">Create</button>
     </div>
       <input type="hidden" name="_token" value="{{ csrf_token() }}">
   </form>
   </div>

                  <!-- /.form-group -->
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-6">
                  <div class="box box-info">
                    <div class="box-header">
                      <h3 class="box-title">Leave Type List</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                      <table id="example" class="table table-striped table-bordered display nowrap" style="width:100%">
                        <thead>
                        <tr>
                          <th >Sl.No</th>
                          <th>Name</th>
                          <th>No. Of Days</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                          <?php $i=0; ?>
                          @foreach($leave_types as $leave_types)
                          <?php $i++; ?>
                          <tr>
                            <td>{{$i}}</td>
                            <td>{{$leave_types->name}}</td>
                            <td>{{$leave_types->no_of_days}}</td>
                            <td>
                              @if($leave_types->is_active=="1")
                              <span style="color:green;">Active</span>
                              @else
                              <span style="color:red;">In-Active</span>
                              @endif
                            </td>
                            <td>
                              <div class="btn-group">
                                <button type="button" class="btn btn-default  btn-flat dropdown-toggle" data-toggle="dropdown">
                                  <span class="caret"></span>
                                  <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <ul class="dropdown-menu" role="menu" title="Action">
                                  <li style="display:none;"><a href="{{url('hr/employee/set-roles/'.$leave_types->id)}}" title="Edit"><i  class="fa fa-eye" style="color: #897df8e6";></i>Edit</a></li>
                                    <li><a href="#"class="status" id="{{$leave_types->id}}/{{$leave_types->is_active}}" title="<?php if($leave_types->is_active=="1"){echo "In-acative";}else{echo "Active";} ?>">
                                      <i class="<?php if($leave_types->is_active=="1"){echo "fa fa-thumbs-down";}else{echo "fa fa-thumbs-up";} ?>" style="color: red";></i>
<?php if($leave_types->is_active=="1"){echo "In-acative";}else{echo "Active";} ?>
                                    </a></li>
                                    <li><a href="#" class="delete" id="{{$leave_types->id}}" title="delete"><i class="fa fa-trash" style="color: red";></i>Delete</a></li>
                                <!--  <li><a href="#" title="Delete"><i class="fa fa-trash" style="color: red";></i></a>Delete</li>-->
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

<script>
$(document).ready(function() {
  $(".status").click(function (e) {
                e.preventDefault();
                var id = this.id;
                bootbox.confirm("Are you sure?", function (result) {
                    if (result) {
                        var _url = $("#_url").val();
                        window.location.href = _url + "/employee/leave/leave-type/set-status/" + id;
                    }
                });
            });

            $(".delete").click(function (e) {
                          e.preventDefault();
                          var id = this.id;
                          bootbox.confirm("Are you sure?", function (result) {
                              if (result) {
                                  var _url = $("#_url").val();
                                  window.location.href = _url + "/employee/leave/leave-type/delete/" + id;
                              }
                          });
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
