@extends('gurdian.main-header')
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
<style type="text/css" media="print">
    @page
    {
        size: auto;   /* auto is the initial value */
        margin: 0mm;  /* this affects the margin in the printer settings */
    }
</style>
@endsection
@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <section class="content">
          @include('notification.notify')
    <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Payment Fail</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button style="display:none;" type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
              </div>
            </div>
              <div class="box-body" id="printdiv">
              <div class="row" style="text-align: center;">
                  <div class="col-md-7 col-md-offset-2">
                  <div class="box box-danger">
                    <form role="form" method="post" enctype="multipart/form-data">
                    <h4>Sorry ,We are unable to collect fee online right now.</h4>
                    <p>If amount is deducted.It will credited on your account in 6-7 working days.</p>
<div class="col-md-12">
  <h3 class="box-title">Transaction Details :</h3>
<table class="table">
  <thead>
    <tr>
      <th></th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <tr>
<td style="float: right;">Transaction-id : </td>
<td>{{ $ipg_txn_id OR ''}}</td>
    </tr>
    <tr>
<td style="float: right;">Receipt-id :</td>
<td>{{ $receipt OR ''}}</td>
    </tr>
    <tr>
<td style="float: right;">Tracking-id :</td>
<td>{{ $tracking_id OR ''}}</td>
    </tr>
    <tr>
<td style="float: right;">Amount :</td>
<td>{{ $amt OR ''}}</td>
    </tr>
    <tr>
<td style="float: right;">Date :</td>
<td>{{ $date OR ''}}</td>
    </tr>
    <tr>
<td style="float: right;">Payment Status :</td>
<td> <span style="color: red;">Fail</span></td>
    </tr>
    <tr>
<td style="float: right;">Bank Response :</td>
<td > <span style="color: red;">{{$error OR ''}}</span></td>
    </tr>
  </tbody>
</table>
<br>
<p>NOTE : <span style="color: red;">Please keep Transaction-id and Receipt No for further reference with School.<span></p>
<a  class="btn btn-primary" onclick="javascript:printDiv('printdiv')">Print Receipt</a>
</div>

                  </form>
                  </div>
              </section>
  </div>
</div>
</div>
</div>
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

<script language="javascript" type="text/javascript">
       function printDiv(divID) {
           //Get the HTML of div
           var divElements = document.getElementById(divID).innerHTML;
           //Get the HTML of whole page
           var oldPage = document.body.innerHTML;

           //Reset the page's HTML with div's HTML only
           document.body.innerHTML =
             "<html><head><title></title></head><body style='position: fixed;max-width: 1000px;width: 1384px;'>" +
             divElements + "</body>";

           //Print Page
           window.print();

           //Restore orignal HTML
           document.body.innerHTML = oldPage;


       }
   </script>

<script>
$(document).ready(function() {
  $(document).keydown(function (event) {
   if (event.keyCode == 123) { // Prevent F12
       alert("Action not allowed.");
       return false;
   } else if (event.ctrlKey && event.shiftKey && event.keyCode == 73) { // Prevent Ctrl+Shift+I
     alert("Action not allowed.");
       return false;
   }
});
$('body').bind('cut copy paste select', function(e) {
 alert("Action not allowed");
   e.preventDefault();

});
  $(document).bind("contextmenu",function(e){
       return false;
    });
   $('#example').DataTable( {
     paging: false.
       responsive: true

   } );


   } );

</script>
@endsection
<!-- ./wrapper -->
