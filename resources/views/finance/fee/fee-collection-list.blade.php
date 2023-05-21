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
        <li><a href="#"><i class="fa fa-dashboard"></i>Finance</a></li>
        <li><a href="#"><i class="fa fa-dashboard"></i>Fee-Collection</a></li>
        <li class="active">List</li>
      </ol>
    </section>

    <!-- Main content -->
      <section class="content">
          @include('notification.notify')
    <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Search Fee Collection</h3>

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
                           <form role="form" method="post" enctype="multipart/form-data" action="{{url('finance/feeCollection/search')}}">
                          <div class="box-body">
                             <div class="col-md-3">
                            <div class="form-group">
                              <label for="exampleInputEmail1">Student/Registration No.</label>
                              <select class="form-control select2" name="student" style="width: 100%;">
                                  <option value="0" selected="selected">Please select</option>
                                  <?php foreach ($students as $students): ?>
                                    <option value="{{$students->reg_no}}">{{$students->stu_name}}({{$students->reg_no}})</option>
                                  <?php endforeach; ?>
                           </select>
                         </div>
                       </div>
                         <div class="form-group">
                           <div class="col-md-3">
                           <label for="exampleInputEmail1">Course/Class</label>
                           <select class="form-control select2" name="batch" style="width: 100%;">
                               <option value="0" selected="selected">Please select</option>
                               <?php foreach ($batch as $batch): ?>
                                 <option value="{{$batch->id}}">{{$batch->course_name}} ( {{$batch->batch_name}} )</option>
                               <?php endforeach; ?>
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-md-3" style="top: -15px;">
                      <label for="exampleInputEmail1">Months</label>
                      <select class="form-control select2"  id="month" name="month" style="width: 100%;">
                         <option value="0" selected="selected">Please Select Months</option>
                          <option value="01" >January</option>
                          <option value="02" >February</option>
                          <option value="03" >March</option>
                          <option value="04" >April</option>
                          <option value="05" >May</option>
                          <option value="06" >June</option>
                          <option value="07" >July</option>
                          <option value="08" >August</option>
                          <option value="09" >September</option>
                          <option value="10" >October</option>
                          <option value="11" >November</option>
                          <option value="12" >December</option>
                   </select>
                 </div>
                 </div>
                 <div class="form-group" >
                   <div class="col-md-3" style="top: -16px;">
                   <label for="exampleInputEmail1">Fee Head</label>
                   <select class="form-control select2" name="feehead" style="width: 100%;">
                       <option value="0" selected="selected">Please select</option>
                       <option value="Late Fine">Late Fine</option>
                       <?php foreach ($feeheads as $feeheads): ?>
                         <option value="{{$feeheads->fee_category}}">{{$feeheads->fee_category}}</option>
                       <?php endforeach; ?>
                </select>
              </div>
            </div>
               <div class="form-group">
                 <div class="col-md-3">
                 <button type="submit" class="btn btn-primary">Search</button>
                 <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
            </div>
          </div>
             </div>
   </form>
   </div>

   <div class="">
     <h4 style="text-align: center;font-style: unset;">OR Search By Dates</h4>
            <form role="form" method="post" enctype="multipart/form-data" action="{{url('finance/feeCollection/searchbydate')}}">
           <div class="box-body">

<div class="form-group col-md-3">
     <label>From Date</label>
     <div class="input-group date">
       <div class="input-group-addon">
         <i class="fa fa-calendar"></i>
       </div>
       <input type="text" class="form-control pull-right dob" id="dob" name="todate">
     </div>
     <!-- /.input group -->
   </div>

   <div class="form-group col-md-3">
        <label>To Date</label>
        <div class="input-group date">
          <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
          </div>
          <input type="text" class="form-control pull-right dob" id="dob" name="fromdate">
        </div>
        <!-- /.input group -->
      </div>
<div class="form-group">
  <div class="col-md-3" style="top: 25px;">
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
                      <h3 class="box-title">Task manager</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                      <table id="example" class="table table-striped table-bordered display" style="width:100%">
                        <thead>
                  <tr>
                  <th>Sl. No.</th>
                  <th>Receipt No.</th>
                  <th>Admission No.</th>
                  <th>Student Name</th>
                  <th>Class/Section</th>
                  <th>Months</th>
                  <th>Amt</th>
                  <th>Due Amt</th>
                  <th>Discount</th>
                  <th>Paid Amt</th>
                  <th>Receipt Status</th>
                  <th>Date</th>
                  <th>Pay Mode</th>
                  <th>Manage</th>
                    </tr>
                </thead>
                        <tbody>
                          @php $i=0; @endphp
                          @foreach($feeslist as $feeslist)
                          @php $i++; @endphp
                          <tr>
                            <td>@php echo $i; @endphp</td>
                            <td>{{$feeslist->receipt_no}}</td>
                            <td>{{$feeslist->stu_reg_no}}</td>
                            <td>{{$feeslist->stu_name}}</td>
                            <td>{{$feeslist->course_name}}/{{$feeslist->batch_name}}</td>
                            <td>{{$feeslist->month}}</td>
                            <td>{{$feeslist->totamount}}</td>
                            <td>{{$feeslist->dueamt}}</td>
                            <td>{{$feeslist->discount}}</td>
                            <td>{{($feeslist->totamount+$feeslist->dueamt)-$feeslist->discount}}</td>
                            @if($feeslist->receipt_status=='1')
                            <td style="color:green;">Paid</td>
                            @else
                            <td style="color:red;">Canceled</td>
                            @endif
                            <td>{{$feeslist->created_date}}</td>
                            <td>{{$feeslist->pay_mode}}</td>
                            <td>
                          <div class="btn-group">
                            <button type="button" class="btn btn-default  btn-flat dropdown-toggle" data-toggle="dropdown">
                              <span class="caret"></span>
                              <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu" role="menu" title="Action">
                              <li><a href="{{url('finance/feeCollection/receipt/'.$feeslist->receipt_no)}}" title="View"><i  class="fa fa-eye" style="color: #897df8e6";></i></a></li>
                                <li><a href="" class="tFileDelete" id="{{$feeslist->receipt_no}}" title="Cancel"><i  class="fa fa-close" style="color: red";></i></a></li>
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
<script src="{{ URL::asset('assets/bower_components/jquery/dist/bootbox.min.js') }}"></script>
<script>
        $(document).ready(function () {
            /*For Delete Application Info*/
            $(".tFileDelete").click(function (e) {
                e.preventDefault();
                var id = this.id;
            //    alert(id);
                bootbox.confirm("Are you sure?", function (result) {
                    if (result) {
                        var _url = $("#_url").val();
                        window.location.href = _url + "/finance/account/voucher/receiptupdate/" + id;
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

        responsive: false,
       "scrollX": true


   } );
   } );

</script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()


  })
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
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
    $('.dob').datepicker({
      ignoreReadonly: false,
      autoclose: true,
      format:'yyyy-mm-dd'
    }).datepicker("setDate",'');
  })
</script>
@endsection
<!-- ./wrapper -->
