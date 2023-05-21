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
        <li><a href="#"><i class="fa fa-dashboard"></i> Leave</a></li>
        <li class="active">View Leave</li>
      </ol>
    </section>
    <section class="content">
    @include('notification.notify')
  <div class="box box-default">
    <!-- Main content -->
    <div class="box-header with-border">
      <h3 class="box-title">Leave View (Status Wise)</h3>

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
                <li class="active"><a href="#tab_1" data-toggle="tab">Pending</a></li>
                <li><a href="#tab_2" data-toggle="tab">Accepted</a></li>
                <li><a href="#tab_3" data-toggle="tab">Rejected</a></li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                  <div class="box-body">
                    <div class="row">
                      <div class="col-md-12">

                        <!-- /.form-group -->
                        <div class="box box-info">
                                 <div class="box-header with-border">
                                   <h3 class="box-title">Pending Leave</h3>
                                 </div>
                                   <div class="box-body">
                                  <table id="example" class="table table-striped table-bordered display" style="width:100%">
                                  <thead>
                               <tr>
                               <th>Sl No</th>
                               <th>Leave type</th>
                               <th>From Date</th>
                               <th>To Date</th>
                               <th>No Of Days</th>
                               <th>Reason</th>
                               <th>Document</th>
                               <th>Leave Status</th>
                               </tr>
                             </thead>
                                     <tbody>
                                       @php $i=0; @endphp
                                       @foreach($leave as $leave)
                                       @php $i++; @endphp
                                        @if($leave->status==0)
                                        <tr>
                                          <td>{{$i}}</td>
                                          <td>{{$leave->name}}</td>
                                          <td>{{$leave->from_date}}</td>
                                          <td>{{$leave->to_date}}</td>
                                          <td>{{$leave->no_of_days}}</td>
                                          <td>{!!$leave->leave_reason!!}</td>
                                          <td>
                                            <a target="_blank" href="{{ URL::asset($leave->leave_file) }}" class="btn btn-info">View</a>
                                          </td>
                                          <td><span style="color:#0008ff;">Pending</span></td>
                                        </tr>

                                        @endif
                                       @endforeach
                                     </tbody>
                                   </table>
                                 </div>
                               </div>

                        <!-- /.form-group -->
                      </div>

                  </div>
                </div>
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="tab_2">
                  <div class="box-body">
                    <div class="row">
                    <div class="col-md-12">
                    <div class="box box-primary">
                                 <div class="box-header with-border">
                                   <h3 class="box-title">Accepted Leave</h3>
                                 </div>
                                 <div class="box-body">
                                <table id="example" class="table table-striped table-bordered display" style="width:100%">
                                <thead>
                             <tr>
                             <th>Sl No</th>
                             <th>Leave type</th>
                             <th>From Date</th>
                             <th>To Date</th>
                             <th>No Of Days</th>
                             <th>Reason</th>
                             <th>Document</th>
                             <th>Leave Status</th>
                             <th>Status Remark</th>
                             <th>Accepted By</th>
                             </tr>
                           </thead>
                                   <tbody>
                                     @php $i=0; @endphp
                                     @foreach($accepted as $accepted )
                                     @php $i++; @endphp
                                      <tr>
                                        <td>{{$i}}</td>
                                        <td>{{$accepted->name}}</td>
                                        <td>{{$accepted->from_date}}</td>
                                        <td>{{$accepted->to_date}}</td>
                                        <td>{{$accepted->no_of_days}}</td>
                                        <td>{!!$accepted->leave_reason!!}</td>
                                        <td>
                                          <a target="_blank" href="{{ URL::asset($accepted->leave_file) }}" class="btn btn-info">View</a>
                                        </td>
                                        <td><span style="color:green;">Accepted</span></td>
                                        <td>{!!$accepted->status_remark!!}</td>
                                        <td>{{$accepted->approved_by}}</td>
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

              <div class="tab-pane" id="tab_3">
                <div class="box-body">
                  <div class="row">
                  <div class="col-md-12">
                  <div class="box box-danger">
                               <div class="box-header with-border">
                                 <h3 class="box-title">Rejected Leave</h3>
                               </div>
                               <div class="box-body">
                              <table id="example" class="table table-striped table-bordered display" style="width:100%">
                              <thead>
                           <tr>
                           <th>Sl No</th>
                           <th>Leave type</th>
                           <th>From Date</th>
                           <th>To Date</th>
                           <th>No Of Days</th>
                           <th>Reason</th>
                           <th>Document</th>
                           <th>Leave Status</th>
                           <th>Status Remark</th>
                           <th>Rejected By</th>
                           </tr>
                         </thead>
                                 <tbody>
                                   @php $i=0; @endphp
                                   @foreach($rejected as $rejected )
                                   @php $i++; @endphp
                                    <tr>
                                      <td>{{$i}}</td>
                                      <td>{{$rejected->name}}</td>
                                      <td>{{$rejected->from_date}}</td>
                                      <td>{{$rejected->to_date}}</td>
                                      <td>{{$rejected->no_of_days}}</td>
                                      <td>{!!$rejected->leave_reason!!}</td>
                                      <td>
                                        <a target="_blank" href="{{ URL::asset($rejected->leave_file) }}" class="btn btn-info">View</a>
                                      </td>
                                      <td><span style="color:green;">Accepted</span></td>
                                      <td>{!!$rejected->status_remark!!}</td>
                                      <td>{{$rejected->approved_by}}</td>
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
    </section>
  </div>


@endsection
{{--External Style Section--}}
@section('script')
<script src="{{ URL::asset('assets/bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
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
<script>
   $(document).ready(function() {
      $.extend($.fn.dataTable.defaults, {
    dom: 'Bfrtip'
   });
      $('.table').DataTable( {

          buttons: [
              'copy', 'csv', 'excel', 'pdf', 'print'
          ],
          responsive: true,
          pageLength: 50,
      } );
      } );

   </script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2();
    $('.startdate').datepicker({
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
