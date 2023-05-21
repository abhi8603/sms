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
        <li><a href="#"><i class="fa fa-dashboard"></i>Leave Management</a></li>
        <li class="active">Apply Leave</li>
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
                             <h3 class="box-title">Apply Leave</h3>
                           </div>
                           <!-- /.box-header -->
                           <!-- form start -->
                           <form role="form" method="post" enctype="multipart/form-data" action="{{url('employee/leave/apply/submit')}}">
                          <div class="box-body">
                            <div class="form-group">
                              <label for="exampleInputEmail1">Leave Type<span style="color:red;"> *</span></label>
                              <select class="form-control select2" name="leave_type">
                                <option>--Please select--</option>
                                @foreach($leave_types as $leave_types)
                                  <option value="{{$leave_types->id}}">{{$leave_types->name}}</option>
                                @endforeach
                              </select>
                            </div>
                            <div class="form-group">
                              <label>From Date</label>
                              <div class="input-group date">
                              <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                              </div>
                              <input type="text" class="date form-control pull-right" id="fromdate" name="from_date" autocomplete="off">
                              </div>
                            </div>
                            <div class="form-group">
                              <label>To Date</label>
                              <div class="input-group date">
                              <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                              </div>
                              <input type="text" class="date form-control pull-right" id="todate" name="to_date" autocomplete="off">
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="exampleInputEmail1">No. Of Days<span style="color:red;"> *</span></label>
                              <input type="text" class="form-control" onkeypress="return isNumber(event)" id="no_of_days" name="no_of_days" placeholder="No. Of Days" required>
                            </div>

                            <div class="form-group">
                              <label for="exampleInputEmail1">Reason<span style="color:red;"> *</span></label>
                              <textarea class="form-control" name="leave_reason" id="editor1"  style="height: 300px; width: 100%;"></textarea>
                            </div>
                            <div class="form-group">
                              <label for="exampleInputEmail1">Document<span style="color:red;"> *</span></label>
                              <input type="file" class="form-control"  name="file"/>
                            </div>


         </div>
         <div class="box-footer">
       <button type="submit" class="btn btn-primary">Apply</button>
     </div>
       <input type="hidden" name="_token" value="{{ csrf_token() }}">
   </form>
   </div>

                  <!-- /.form-group -->
                </div>
                <div class="col-md-6">
                  <div class="box box-info">
                    <div class="box-header">
                      <h3 class="box-title">Leave Status</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                      <table id="example" class="table table-striped table-bordered" >
                        <thead>
                        <tr>
                          <th>Sl.No</th>
                          <th>Leave Type</th>
                          <th>Total Leave</th>
                          <th>Taken Leave</th>
                          <th>Remaining Leave</th>
                        </tr>
                        </thead>
                        <tbody>
                          <?php $i=0; ?>
                            @foreach($leavecnt as $leavecnt)
                              <?php $i++; ?>
                              <tr>
                                <td>{{$i}}</td>
                                <td>{{$leavecnt->name}}</td>
                                <td>{{$leavecnt->no_of_days}}</td>
                                <td>{{$leavecnt->leave_taken}}</td>
                                <td>{{$leavecnt->avilable_leave}}</td>
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
<script src="https://cdn.ckeditor.com/4.4.3/standard/ckeditor.js"></script>
<script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor1')
    //bootstrap WYSIHTML5 - text editor
    $('.textarea').wysihtml5()
  })
</script>
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
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2();
    $('#fromdate').datepicker({
      autoclose: true,
      format:'dd-mm-yyyy'
    });
    $('#todate').datepicker({
      autoclose: true,
      format:'dd-mm-yyyy'
    });

    //Datemask dd/mm/yyyy

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
