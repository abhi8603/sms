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


    <!-- Main content -->
      <section class="content">
          @include('notification.notify')
    <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Voucher Details</h3>

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
                           <form role="form" method="post" enctype="multipart/form-data" action="{{url('student/postsearch')}}">
                           <div id="printdiv">
                          <div class="box-body">
                             <div class="col-md-3">
                            <div class="form-group">
                              <span class="logo-mini"><img src="<?php echo asset(app_config('AppLogo',Auth::user()->school_id)); ?>" style="height: 50px;" /></span>
                         </div>
                       </div>
                       <div class="col-md-4" style="position: inherit;text-align: center;">
                      <div class="form-group" >
                      <h4 style="text-align: right;text-decoration: underline;" >{{ Auth::user()->school_name }}</h4>
                      </div>
                   </div>
                   <div class="col-md-3" style="position: inherit;text-align: center;float:right">
                  <div class="form-group" >
                <small>{{date('l dS F - Y')}}</small>
                  </div>
               </div>
                 </div>
                 <div class="box-body" style="padding: 0px;">
             <div class="col-md-12" style="text-align: center;right: 33px;">
               <h3>Voucher</h3>
             </div>

        </div>

                 <div class="box-body box box-info" style="top: 0px;">
                     <label>Voucher Number : <span>{{$id}}</span></label>
                      <label style="float: right;margin-right: 131px;">Voucher Date : <span>{{$date}}</span></label>
                   <table id="example" class="table table-striped table-bordered display" style="width:100%">
                     <thead>
               <tr>
               <th>Account Name</th>
               <th>Particulars</th>
               <th>Debit</th>
               <th>Credit</th>
               </tr>
             </thead>
             <tbody>
<?php foreach ($voucherdetails as $voucherdetails): ?>
  <tr>
      <td>{{$voucherdetails->voucher_head}}</td>
      <td>{{$voucherdetails->ledger_acc}}</td>
      <td>{{$voucherdetails->dr}}</td>
      <td>{{$voucherdetails->cr}}</td>
  </tr>
<?php endforeach; ?>
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
    </div>
<div class="form-group" style="margin-top: 10px;">
  <div class="col-md-3" style="margin-top: 40px;">
  <a  class="btn btn-primary" onclick="javascript:printDiv('printdiv')">Print Receipt</a>


</div>
<div  class="col-md-3" style="margin-top: 40px;display:none;">
<a href="{{url('finance/feeCollection/receipt/download/4')}}" class="btn btn-primary">Download Receipt</a>
<input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
</div>
</div>

   </form>


                  <!-- /.form-group -->
                </div>


              </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection
{{--External Style Section--}}
@section('script')


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
var result = [];
   $('.price').each(function(index, val){
     if(!result[index]) result[index] = 0;
      result[index] += parseInt($(this).text());
    });

  var total=0;
  for (var i = 0; i < result.length; i++) {
    total += result[i];
}

$('#totamt').html(total);
</script>
<script language="javascript" type="text/javascript">
       function printDiv(divID) {
           //Get the HTML of div
           var divElements = document.getElementById(divID).innerHTML;
           //Get the HTML of whole page
           var oldPage = document.body.innerHTML;

           //Reset the page's HTML with div's HTML only
           document.body.innerHTML =
             "<html><head><title></title></head><body>" +
             divElements + "</body>";

           //Print Page
           window.print();

           //Restore orignal HTML
           document.body.innerHTML = oldPage;


       }
   </script>

   <script>
   $(document).ready(function() {

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

         paging:   false,
         ordering: false,
        info:     false,
        searching:false,
          responsive: true

      } );
      } );

   </script>
@endsection
<!-- ./wrapper -->
