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
        <li><a href="#"><i class="fa fa-dashboard"></i>Fee</a></li>

        <li class="active">Due Fee List</li>
      </ol>
    </section>

    <!-- Main content -->
      <section class="content">
          @include('notification.notify')
    <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Daily Cash Report</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button style="display:none;" type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                      <li class="<?php if($tab==1) echo "active"; ?>"><a href="#tab_1" data-toggle="tab">Head Wise</a></li>
                      <li class="<?php if($tab==2) echo "active"; ?>"><a href="#tab_2" data-toggle="tab">Day Wise</a></li>

                      <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
                    </ul>
                    <div class="tab-content">
                    <div class="tab-pane <?php if($tab==1) echo "active"; ?>" id="tab_1">
                  <div class="box box-primary">
                        <form role="form" method="post" enctype="multipart/form-data" action="{{url('finance/Fee/dailyCashRegister/report')}}">
                          <div class="box-body">
                             <div class="col-md-3">
                            <div class="form-group">
                              <label for="exampleInputEmail1">Session<span style="color:red;"> *</span></label>
                              <select class="form-control select2" name="session" id="session" style="width: 100%;" required>
                                  <option value="0" selected="selected">Please select</option>
                                  <?php foreach ($academic_year as $acadmic_year): ?>
                                    <option value="{{$acadmic_year->startyear}}-{{$acadmic_year->endyear}}" @if($acadmic_year->status==app_config('Session',Auth::user()->school_id)) selected @endif >{{$acadmic_year->startyear}}-{{$acadmic_year->endyear}}</option>
                                  <?php endforeach; ?>
                           </select>
                         </div>
                       </div>
                       <div class="col-md-3">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Fee Head<span style="color:red;"> *</span></label>
                        <select class="form-control select2" name="feehead" id="feehead" style="width: 100%;" required>
                            <option value="0" selected="selected">Please select</option>
                            <?php foreach ($fee_category as $fee_category): ?>
                              <option value="{{$fee_category->fee_category}}">{{$fee_category->fee_category}}</option>
                            <?php endforeach; ?>
                     </select>
                   </div>
                  </div>
                    <div class="form-group col-md-3">
                                    <label>Date</label>
                                    <div class="input-group date">
                                      <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                      </div>
                                      <input type="text" class="form-control pull-right from" value="{{ old('date') }}" id="date" name="date" autocomplete="off">
                                    </div>
                                    <!-- /.input group -->
                                  </div>
                                <!--  <div class="form-group col-md-3" style="top: -17px;">
                                                  <label>To Month</label>
                                                  <div class="input-group date">
                                                    <div class="input-group-addon">
                                                      <i class="fa fa-calendar"></i>
                                                    </div>
                                                    <input type="text" class="form-control pull-right to" value="{{ old('dob') }}" id="dob" name="dob" required>
                                                  </div>

                                                </div>-->
               <div class="form-group">
                 <div class="col-md-3" style="margin-top: 24px;">
                 <button type="submit" class="btn btn-primary">Search</button>
                 <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
            </div>
          </div>
             </div>
   </form>
   </div>

                  <!-- /.form-group -->

<?php if(!empty($fee_details)){ ?>
                <div class="col-md-12">
                  <div class="box box-info">
                    <div class="box-header">
                      <h3 class="box-title">Fee Report</h3>
                        <h3 style="float: right;margin-right: 200px;color: red;" class="box-title">Total Collection : ₹ <span id="totamt">0</span></h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                      <table id="example" class="table table-striped table-bordered display" style="width:100%">
                        <thead>
                  <tr>
                  <th>Sl. No.</th>
                  <th>Admission No.</th>
                  <th>Student Name</th>
                  <th>Class</th>
                  <th>Month/Year</th>
                  <th>Fee Category</th>
                  <th>Receipt No.</th>
                  <th>Pay Mode</th>
                  <th>Amount</th>
                  <th>Collected By</th>
                  <th>Remark</th>
                  <th>Status</th>
                  </tr>
                </thead>
                        <tbody>
                          @php $i=0; @endphp
                            @foreach($fee_details as $fee_details)
                              @php $i++; @endphp
                          <tr>
                            <td>{{$i}}</td>
                            <td>{{$fee_details->stu_reg_no}}</td>
                            <td>{{$fee_details->stu_name}}</td>
                            <td>{{$fee_details->course_name}}</td>
                            <td>{{$fee_details->month}}/{{$fee_details->year}}</td>
                            <td>{{$fee_details->fee_category}}</td>
                            <td>{{$fee_details->receipt_no}}</td>
                            <td>{{$fee_details->pay_mode}}</td>
                            <td>{{$fee_details->final_amt}}</td>
                            <td>{{$fee_details->collected_by}}</td>
                            <td>{{$fee_details->remark}}</td>
                            <td>{{$fee_details->receipt_status==1 ? "Success" : "Fail"}}</td>
                          </tr>
                          @endforeach
                        </tbody>

                      </table>
                    </div>
                    <!-- /.box-body -->
                  </div>
                </div>

              <?php } ?>
              </div>

                <div class="tab-pane <?php if($tab===2) echo "active"; ?>" id="tab_2">
                  <div class="box box-primary">
                    <form role="form" method="post" enctype="multipart/form-data" action="{{url('finance/Fee/dailyCashRegister/reportdaywise')}}">
                      <div class="box-body">
                         <div class="col-md-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Date<span style="color:red;"> *</span></label>
                          <div class="input-group date">
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control pull-right from" value="{{ old('day') }}" id="day" name="day" autocomplete="off" required>
                          </div>
                     </div>
                   </div>
                   <div class="col-md-3">
                  <div class="form-group" style="margin-top:24px;">
                    <input type="submit" class="btn btn-primary" value="Search"/>
                    <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
                  </div>
                </div>
                 </div>
               </form>
                </div>

                <div class="box box-info">
                    <br></br>
                    <?php if(!empty($fee_detailsdays)){ ?>
                  <table id="example" class="table table-striped table-bordered display">
                    <thead>
                      <tr>
                        <th>Session</th>
                        <th>Fee Head</th>
                        <th>Total Amount</th>
                        <th>Date</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach($fee_detailsdays as $fee_detailsdays)
                        <tr>
                          <td>{{$fee_detailsdays->acadmic_year}}</td>
                          <td>{{$fee_detailsdays->fee_head}}</td>
                          <td>{{$fee_detailsdays->head_total}}</td>
                          <td>{{$fee_detailsdays->created_date}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                  </table>
                <?php } ?>
                </div>

              </div>



    <!-- /.content -->

  </div>
  </div>
  </div>
  </div>
</div>
</div>
    </section>
  <!-- /.content-wrapper -->
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
<script src="{{ URL::asset('assets/bower_components/jquery/dist/bootbox.min.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/datatables.net-bs/js/dataTableSum.js') }}"></script>

<script>
$(document).ready(function() {
   $.extend($.fn.dataTable.defaults, {
 dom: 'Bfrtip'
});
var table=  $('.table').DataTable( {

       buttons: [
           'copy', 'csv', 'excel', 'pdf', 'print'
       ],
       pageLength: 50,
       responsive: true


   } );
   var total=table.column( 8 ).data().sum();
  //  alert(total);
    $('#totamt').html(total);
   } );
</script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2();
    $('.from').datepicker({
      ignoreReadonly: false,
      autoclose: true,
      format:'yyyy-mm-dd'
    }).datepicker("setDate",'');

$('.to').datepicker({
    autoclose: true,
    minViewMode: 1,
    format: 'mm-yyyy'
}).on('changeDate', function(selected){
        FromEndDate = new Date(selected.date.valueOf());
        FromEndDate.setDate(FromEndDate.getDate(new Date(selected.date.valueOf())));
        $('.from').datepicker('setEndDate', FromEndDate);
    });

  })
</script>

@endsection
<!-- ./wrapper -->
