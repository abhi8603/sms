@extends('header')
@section('style')
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/buttons.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/rowReorder.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/responsive.dataTables.min.css') }}">
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
        <li class="active">Fee Master</li>
      </ol>
    </section>
    <section class="content">
        @include('notification.notify')
  <div class="box box-default">
    <!-- Main content -->
    <div class="box-header with-border">
      <h3 class="box-title">Fee Master</h3>

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
                <li class="active"><a href="#tab_1" data-toggle="tab">Fee Master  </a></li>
                <li><a href="#tab_2" data-toggle="tab">List</a></li>

                <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                  <div class="box-body">
                    <div class="row">
                      <div class="col-md-8">

                        <!-- /.form-group -->
                        <div class="box box-primary">
                                 <div class="box-header with-border">
                                   <h3 class="box-title">New Fee Master</h3>
                                 </div>
                                 <!-- /.box-header -->
                                 <!-- form start -->
                                 <form role="form" method="post" enctype="multipart/form-data" action="{{url('finance/Fee-master/add')}}">
                                   <div class="box-body">
                                     <div class="col-md-12">
                                     <div class="form-group">
                                       <label for="exampleInputEmail1">Fee Category<span style="color:red;"> *</span></label>
                                       <select class="form-control select2" name="feecategory" style="width: 100%;" required>
                                           <option value="" selected="selected">Select Fee Category</option>
                                      <?php foreach ($fee_category as $fee_category): ?>
                                          <option value="{{ $fee_category->id }}">{{ $fee_category->fee_category}}</option>
                                      <?php endforeach; ?>

                                    </select>
                                        </div>
                                        <div class="form-group">
                                          <label for="exampleInputEmail1">Fee Sub Category Name<span style="color:red;"> *</span></label>
                                          <select class="form-control select2" name="fee_subcategory" style="width: 100%;" required>
                                              <option value="" selected="selected">Select Fee Category</option>
                                         <?php foreach ($fee_subcategory as $fee_subcategory): ?>
                                             <option value="{{ $fee_subcategory->id }}">{{ $fee_subcategory->sub_category}}</option>
                                         <?php endforeach; ?>

                                         </select>
                                       </div>
                                       <div class="form-group">
                                         <label for="exampleInputEmail1">Months</label>
                                         <select class="form-control select2" multiple="multiple" id="month" name="month[]" style="width: 100%;">
                                            <option value="">Please Select Months</option>
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
                                    <div class="form-group">
                                      <label for="exampleInputEmail1">Class/Course</label>
                                      <select class="form-control select2" id="course" name="course" style="width: 100%;">
                                          <option value="" selected="selected">Please Select Course/Class</option>
                                          <?php foreach ($course as $course): ?>
                                              <option value="{{$course->id}}" >{{$course->course_name}}</option>                                     <?php endforeach; ?>
                                   </select>
                                 </div>
                                 <div class="form-group">
                                   <label for="exampleInputEmail1" id="typechn">Amount<span style="color:red;"> *</span></label>
                                   <input type="text" class="form-control" id="Amount" name="amount" placeholder="Amount" onkeypress="return isNumber(event)" >
                                 </div>
                                  <div class="box-footer">
                                         <!-- <button type="submit" class="btn btn-primary">Save</button>-->
                                         <input type="submit" class="btn btn-primary" name="submit" value="Save">
                                        </div>
                                         <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                   </div>

                                 </div>

                               </div>
                      </div>
            </div>
          </div>
        </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="tab_2">
                  <form role="form" method="post" enctype="multipart/form-data" action="">
                  <div class="box-body">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="box box-info">
                          <div class="box-header">
                            <h3 class="box-title">Fee Master List</h3>
                          </div>
                          <!-- /.box-header -->
                          <div class="box-body">
                            <table id="example" class="table table-striped table-bordered display nowrap" style="width:100%">
                              <thead>
                              <tr>
                                <th>Sl.No</th>
                                <th>Fee Category</th>
                                <th>Fee Sub Category</th>
                                <th>Month</th>
                                <th>Course/Class</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Action</th>

                              </tr>
                              </thead>
                              <tbody>
                                @php $i=0; @endphp
                              @foreach($fee_master as $fee_master)
                              @php $i++ @endphp
                              <tr>
                                <td><?php echo $i; ?></td>
                                <td>{{$fee_master->fee_category}}</td>
                                <td>{{$fee_master->sub_category}}</td>
                                @if($fee_master->month=="1")
                                <td>January</td>
                              @elseif($fee_master->month=="2")
                                  <td>February</td>

                              @elseif($fee_master->month=="3")
                                  <td>March</td>

                              @elseif($fee_master->month=="4")
                                  <td>April</td>

                              @elseif($fee_master->month=="5")
                                  <td>May</td>

                              @elseif($fee_master->month=="6")
                                  <td>June</td>

                              @elseif($fee_master->month=="7")
                                  <td>July</td>

                              @elseif($fee_master->month=="8")
                                  <td>August</td>

                              @elseif($fee_master->month=="9")
                                  <td>September</td>

                              @elseif($fee_master->month=="10")
                                  <td>October</td>

                              @elseif($fee_master->month=="11")
                                  <td>November</td>

                              @elseif($fee_master->month=="12")
                                  <td>December</td>
                              @else
                              @endif
                                <td>{{$fee_master->course_name}}</td>
                                <td>{{$fee_master->amount}}</td>
                                @if($fee_master->status==1)
                                <td><span style="color:green;">Active</span></td>
                                @else
                                <td><span style="color:red;">Inactive</span></td>
                                @endif
                                <td>
                              <div class="btn-group">
                                <button type="button" class="btn btn-default  btn-flat dropdown-toggle" data-toggle="dropdown">
                                  <span class="caret"></span>
                                  <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <ul class="dropdown-menu" role="menu" title="Action">
                                  <li><a href="{{url('finance/Fee-master/view/'.Crypt::encrypt($fee_master->id))}}" title="Edit"><i  class="fa fa-eye" style="color: #897df8e6";></i></a></li>
                                  <li><a class="tFileDelete" href="" id="{{$fee_master->id}}"  title="Delete"><i class="fa fa-trash" style="color: red";></i></a></li>
                                  <li><a href="{{url('finance/Fee-master/update-status/'.$fee_master->status.'/'.Crypt::encrypt($fee_master->id))}}" title="delete"><i class="<?php if($fee_master->status==1) echo "fa fa-thumbs-down"; else echo "fa fa-thumbs-up"; ?>" style="color: red";></i></a></li>

                                </ul>
                              </div>
                              </td>

                              </tr>

                            <?php endforeach; ?>
                              </tbody>

                            </table>
                          </div>
                          <!-- /.box-body -->
                        </div>
              </div>
                        </div>
                        </div>
                      </form>
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
              //  alert(id);
                bootbox.confirm("Are you sure?", function (result) {
                    if (result) {
                        var _url = $("#_url").val();
                        window.location.href = _url + "/finance/Fee-master/delete/" + id;
                    }
                });
            });

        $("#viewedit").click(function () {
            $("#editview").show();
            $(this).hide();
            $("#edit").show();
            $("#view").hide();
        });
        $("#editview").click(function () {
            $("#viewedit").show();
            $(this).hide();
            $("#view").show();
            $("#edit").hide();
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
       responsive: true,
       pageLength: 50,
   } );
   } );

</script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2();
    $('#startdate').datepicker({
      autoclose: true,
      format:'dd-mm-yyyy'
    });
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
