@extends('header')
@section('style')
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/bootstrap/dist/css/buttons.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/bootstrap/dist/css/rowReorder.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/bootstrap/dist/css/responsive.dataTables.min.css') }}">
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
        <li><a href="#"><i class="fa fa-dashboard"></i> Finance</a></li>
        <li><a href="#"><i class="fa fa-dashboard"></i> Fees </a></li>
        <li class="active">Individual Fee Reports</li>
      </ol>
    </section>
    <section class="content">
        @include('notification.notify')
  <div class="box box-default">
    <!-- Main content -->
    <div class="box-header with-border">
      <h3 class="box-title">Individual Fee Reports</h3>

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
                <li class="active"><a href="#tab_1" data-toggle="tab">Fee Collection Reports </a></li>
            <!--    <li><a href="#tab_2" data-toggle="tab">List</a></li>-->

                <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                  <div class="box-body">
                    <div class="row">
                      <div class="col-md-12">
                        <!-- /.form-group -->
                        <div class="box box-primary">
                                 <div class="box-header with-border">
                                   <h3 class="box-title">Search Fee Reports</h3>
                                 </div>
                                 <!-- /.box-header -->
                                 <!-- form start -->
                                 <form role="form" method="post" enctype="multipart/form-data" action="{{url('finance/fee-report/individual/search')}}">
                                   <div class="box-body">
                                     <div class="col-md-12">
                                     <div class="form-group col-md-4">
                                       <label for="exampleInputEmail1">Student<span style="color:red;"> *</span></label>
                                       <select class="form-control select2" id="course" name="stu_id" style="width: 100%;" required>
                                           <option value="" selected="selected">Select Student</option>
                                            <?php foreach ($stulist as $stulist): ?>
                                              <option value="{{$stulist->reg_no}}">{{$stulist->stu_name}} - {{$stulist->reg_no}}</option>
                                            <?php endforeach; ?>
                                        </select>
                                        </div>
                                              <div class="form-group col-md-4">
                                                <label for="exampleInputEmail1">Fee Collection Type<span style="color:red;"> *</span></label>
                                                <select class="form-control select2" id="collection_type" name="collection_type" style="width: 100%;">
                                                    <option value="" selected="selected">Please Select</option>
                                                    <option value="Cash">Counter</option>
                                                    <option value="Online">Online</option>
                                                </select>
                                                 </div>
                                                 <div class="form-group col-md-4">
                                                   <label for="exampleInputEmail1">Status<span style="color:red;"> *</span></label>
                                                   <select class="form-control select2" id="status" name="status" style="width: 100%;">
                                                       <option value="" selected="selected">Please Select</option>
                                                       <option value="1" selected>Success</option>
                                                       <option value="0">Fail</option>
                                                   </select>
                                                    </div>
                                                 <div class="form-group col-md-4">
                                                   <input style="margin-top: 23px;" type="submit" class="btn btn-info" name="Search" value="Search"/>
                                                 </di>
                                   </div>
                                 </div>
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                 </form>
                               </div>
                             <div id="feereport">
                                <div class="box-header with-border">
                               <h3>Total Fee Collected : ₹ <?php if(!empty($feessum)) echo $feessum[0]->totamount; ?><h3>
                               </div>
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
                             <th>Year</th>
                             <th>Amt</th>
                             <th>Due Amt</th>
                             <th>Discount</th>
                             <th>Paid Amt</th>
                             <th>Receipt Status</th>
                             <th>Date</th>
                             <th>Pay Mode</th>
                             <th>Action</th>
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
                                       <td>{{$feeslist->year}}</td>
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
                                         <a class="btn btn-info" href="{{url('finance/feeCollection/receipt/'.$feeslist->receipt_no)}}" title="View"><i  class="fa fa-eye"></i></a>

                                     </td>

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
    $('.select2').select2();
  });
</script>

@endsection
<!-- ./wrapper -->
