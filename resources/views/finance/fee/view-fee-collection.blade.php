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


    <!-- Main content -->
      <section class="content">
          @include('notification.notify')
    <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Fee Receipt</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button style="display:none;" type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-6 col-md-offset-3" style="width: 432px;">
                  <div class="box box-primary">
                           <form role="form" method="post" enctype="multipart/form-data" action="{{url('student/postsearch')}}">
                           <div id="printdiv" style="max-width:400px;">
                               <h4 style="text-align: center;font-style: oblique;width:400px;">Fee Receipt</h4>
                          <div class="" style="display:inline-flex;">

                             <div class="col-md-3" style="width:89px;">
                            <div class="form-group">
                              <span class="logo-mini"><img src="<?php echo asset(app_config('AppLogo',Auth::user()->school_id)); ?>" style="height: 65px;" /></span>
                         </div>
                       </div>

                       <div class="col-md-6" style="text-align: center;width:232px;">
                      <div class="form-group" >
                      <h5>{{institute_details(Auth::user()->school_id,'insitute_name')}}</h5>
                      <h6>{{institute_details(Auth::user()->school_id,'insitute_address')}}</h6>
                      <h6>phone : {{institute_details(Auth::user()->school_id,'insitute_mobile')}}</h6>

                      </div>

                   </div>
                <!--   <div class="col-md-3" style="position: inherit;width:180px;">
                  <div class="form-group" >
                <small>{{date('dS F - Y')}}</small>
                  </div>
               </div>-->
                 </div>
                 <div class="form-group" style="width:400px;padding-bottom: 0px;" >
                     <h6 style="text-align: center;padding: 0px;text-decoration-line: underline;">An English Medium ICSE School from Class Nursury to XIIth.</h6>
                 </div>
                 <div class="box-body box box-info" style="width:400px;padding-bottom: 0px;">
                  @if(count($pg_data) > 0)
                   <div class="col-md-12" style="display:inline-flex;margin-left: 15px;">
                   <div class="form-group col-md-12" style="width:550px;" >
                   <label>Bank Ref. No. : {{$pg_data[0]->bank_ref_no}}</label>

                   </div>
                   </div>
                   @endif
                   <div class="col-md-12" style="display:inline-flex;margin-left: 15px;">
                   <div class="form-group col-md-6" style="width:225px;" >
                   <label>Receipt No. : </label>
                   <label>{{$id}}</label>
                   </div>
                   <div class="form-group  col-md-6" style="width:220px;" >
                   <label>Date : </label>
                   <label>{{$date}} </label>
                   </div>
                   </div>
                    <div class="col-md-12" style="display:inline-flex;margin-left: 15px;">
                   <div class="form-group col-md-6" style="width:225px;">
                  <label>Name : </label>
                    <label>{{$stu_name}}</label>
                </div>
                <div class="form-group col-md-6" style="width:220px;">
               <label>Class : </label>
                 <label> {{$class}}</label>
             </div>
              </div>

        <div class="col-md-12"  style="display:inline-flex;margin-left: 15px;">
       <div class="form-group col-md-6" style="width:225px;" >
      <label>Admission No : </label>
        <label>{{$stu_reg_no}}</label>
    </div>
    <div class="form-group  col-md-6" style="width:220px;">
   <label>Section : </label>
     <label>{{$section}}</label>
   </div>
  </div>
    <div class="col-md-12"  style="display:inline-flex;margin-left: 15px;">
  <div class="col-md-6" >
  <div class="form-group">
  <label>Pay Mode : </label>
  <label>{{$pay_mode}} </label>
  </div>
  </div>

  <div class="col-md-6">
  <div class="form-group" style="width: 154px;">
  <label>Receipt Status : </label>
 <label>@if($receipt_status=='1')<span style="color:green;">{{Paid}}</span> @else <span style="color:red;"><?php echo $receipt_status <> 'Partial Paid' ? 'Canceled' : $receipt_status ?></span>  @endif</label>
  
  </div>
  </div>
    </div>
<div class="col-md-12" style="width:400px;margin-left: 30px;">
<div class="form-group" >
<label>Paid Months : </label>
<label><?php $i=0; foreach ($month as $month) {
  // code...
  $i++;
  if($i=='1')
  echo $month;
  else {
    echo ",".$month;
  }
} ?></label>
</div>
</div>

</div>

<div class="box-body col-md-12" style="padding:0px;">
  <table id="example" class="table table-striped table-bordered display nowrap" style="width:350px;margin-left: 34px;">
    <thead>
<tr>
<th style="text-align: center;">Fee Head</th>
<th style="text-align: center;">Fee Amount</th>
<th style="text-align: center;">Discount</th>
<th style="text-align: center;">Paid Amount</th>
</tr>
</thead>
    <tbody>

@foreach($receipts as $receipt)
      <tr>
        <td style="text-align: center;">{{$receipt->fee_head}}</td>
        <td style="text-align: center;">{{$receipt->totamount}}</td>
        <td style="text-align: center;">{{$receipt->discount}}</td>
        <td class="price" style="text-align: center;">{{$receipt->final_amt}}</td>
      </tr>
      @endforeach
    </tbody>

  </table>
</div>
<div class="col-md-12" style="margin-top:10px;width:400px;display: inline-flex;">
  <div class="col-md-6" style="width:318px;">
<div class="form-group" style="margin-bottom: -2px;">
</div>
</div>
<div class="col-md-6" style="width:200px;">
<div class="form-group" style="margin-bottom: -2px;margin-left: -7px;padding: 10px;">
  <label >Total  : </label>

    <label id="totamt"> </label>
</div>
</div>
</div>
<div class="col-md-12" >
  <div class="col-md-12">
 <div class="form-group " style="width:400px;">
   <label >Signature  : </label>

 </div>
 </div>
  <div class="col-md-12" style="display:none;">
<div class="form-group " style="width:400px;">
  <label >Note  : </label>
  <p style="font-size: 10px;">(1) Please Pay your fee wihin fee date. Otherwise you will have to pay late fine.</p>
  <p style="font-size: 10px;">(2) Go Cashless to save Rs. 20.</p>
</div>
 </div>

</div>
   </div>

<div class="form-group" style="margin-top: 10px;">
  <div class="col-md-3" style="margin-top: 40px;">
  <a  class="btn btn-primary" onclick="javascript:printDiv('printdiv')">Print Receipt</a>


</div>
<div class="col-md-3" style="margin-top: 40px;width:180px;display:none;">
<a  href="{{url('finance/feeCollection/receipt/download/4')}}" class="btn btn-primary">Download Receipt</a>
<input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
</div>
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
   $('#example').DataTable( {
     paging: false.
       responsive: true

   } );


   } );

</script>
@endsection
<!-- ./wrapper -->
