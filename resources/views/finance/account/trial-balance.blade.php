@extends('header')
@section('style')
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/buttons.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/rowReorder.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/responsive.dataTables.min.css') }}">
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
        <li><a href="#"><i class="fa fa-dashboard"></i>Accounts</a></li>
        <li class="active">Trial Balance</li>
      </ol>
    </section>

    <!-- Main content -->
      <section class="content">
          @include('notification.notify')
    <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title"></h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button style="display:none;" type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="box box-primary">
                           <form role="form" method="post" enctype="multipart/form-data" action="{{url('finance/account/voucher/trial-account/postsearch')}}">
                          <div class="box-body">

                          <div class="form-group col-md-3">
                            <label>From Date</label>
                            <div class="input-group date">
                             <div class="input-group-addon">
                               <i class="fa fa-calendar"></i>
                             </div>
                             <input type="text" class="form-control pull-right dob" value="{{ old('dob') }}" id="dob" name="from" required>
                            </div>                                               <!-- /.input group -->
                          </div>

                       <div class="form-group col-md-3">
                                       <label>To Date</label>
                                       <div class="input-group date">
                                         <div class="input-group-addon">
                                           <i class="fa fa-calendar"></i>
                                         </div>
                                         <input type="text" class="form-control pull-right dob" value="{{ old('dob') }}" id="dob" name="to" required>
                                       </div>
                                       <!-- /.input group -->
                                     </div>
               <div class="form-group">
                 <div class="col-md-3" style="margin-top: 25px;">
                 <button type="submit" class="btn btn-primary">Search</button>
                 <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
            </div>
          </div>
             </div>
   </form>
   </div>

                  <!-- /.form-group -->
                </div>

                <div class="col-md-12">
                  <div class="box box-info">
                    <div class="box-header">
                      <h3 class="box-title">Trial Balance</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                      <table id="example" class="table table-striped table-bordered display" style="width:100%">
                        <thead>
                  <tr>
                  <th>Sl. No.</th>
                  <th>Account</th>
                  <th>Credit</th>
                  <th>Debit</th>
                  </tr>
                </thead>
                <tbody>
                  @php $i=0; @endphp
                  @foreach($voucherlist as $voucherlist)
                    @php $i++; @endphp
                  <tr>
                    <td>@php echo $i; @endphp</td>
                    <td>{{$voucherlist->voucher_head}}</td>
                    <td>{{$voucherlist->cr}}</td>
                    <td>{{$voucherlist->dr}}</td>
                  </tr>
                  @endforeach
                </tbody>
                <tfoot align="right">
                		<tr>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th></th>
                    </tr>
                	</tfoot>
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
$(document).ready(function() {
   $.extend($.fn.dataTable.defaults, {
 dom: 'Bfrtip'
});
   $('#example').DataTable( {
     footerCallback: function ( row, data, start, end, display ) {
          var api = this.api(), data;

          // converting to interger to find total
          var intVal = function ( i ) {
              return typeof i === 'string' ?
                  i.replace(/[\$,]/g, '')*1 :
                  typeof i === 'number' ?
                      i : 0;
          };
          // computing column Total of the complete result
          var monTotal = api
              .column( 2 )
              .data()
              .reduce( function (a, b) {
                  return intVal(a) + intVal(b);
              }, 0 );
    var tueTotal = api
              .column( 3 )
              .data()
              .reduce( function (a, b) {
                  return intVal(a) + intVal(b);
              }, 0 );
   // Update footer by showing the total with the reference of the column index
          $( api.column( 1 ).footer() ).html('Total');
          $( api.column( 2 ).footer() ).html(monTotal);
          $( api.column( 3 ).footer() ).html(tueTotal);
      },
       buttons: [
           'copy', 'csv', 'excel', 'pdf', 'print'
       ],
       pageLength: 100,
       responsive: true

   } );
   } );

</script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2();
    $('.dob').datepicker({
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
@endsection
<!-- ./wrapper -->
