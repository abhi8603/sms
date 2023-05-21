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
              <h3 class="box-title">Search Due Report</h3>

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
                           <form role="form" method="post" enctype="multipart/form-data" action="{{url('finance/Fee/postduereport')}}">
                          <div class="box-body">
                             <div class="col-md-3">
                            <div class="form-group">
                              <label for="exampleInputEmail1">Class<span style="color:red;"> *</span></label>
                              <select class="form-control select2" name="course" id="course" style="width: 100%;" required>
                                  <option value="0" selected="selected">Please select</option>
                                <?php foreach ($course as $course): ?>
                                      <option value="{{$course->id}}">{{$course->course_name}}</option>
                                <?php endforeach; ?>
                           </select>
                         </div>
                       </div>
                         <div class="form-group">
                           <div class="col-md-3">
                           <label for="exampleInputEmail1">Section<span style="color:red;"> *</span></label>
                           <select class="form-control select2" name="batch" id="batch" style="width: 100%;">
                               <option value="" selected="selected">Please select</option>

                        </select>
                      </div>
                    </div>
                    <div class="form-group col-md-3" style="top: -17px;">
                                    <label>From Month <span style="color:red;"> *</span></label>
                                    <div class="input-group date">
                                      <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                      </div>
                                      <input type="text" class="form-control pull-right from" value="{{ old('dob') }}" id="dob" name="dob" required autocomplete="off">
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
                 <div class="col-md-3">
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
                      <h3 class="box-title">Fee Due List</h3>
                        <h3 style="float: right;margin-right: 200px;color: red;" class="box-title">Total Due : ₹ <span id="totamt">0</span></h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                      <table id="example" class="table table-striped table-bordered display" style="width:100%">
                        <thead>
                  <tr>
                  <th>Sl. No.</th>
                  <th>Admission No.</th>
                  <th>Student Name</th>
                  <th>Course/Class</th>
                  <th>Batch/Section</th>
                  <th>Due Month</th>
                  <th>Amount</th>
                  <th>Status</th>
                  </tr>
                </thead>
                        <tbody>
                          @php $i=0; @endphp
                          @foreach($fee_due_list as $fee_due_list)
                            @php $i++; @endphp
                          <tr>
                            <td><?php echo $i; ?></td>
                            <td>{{$fee_due_list->reg_no}}</td>
							<td>{{$fee_due_list->stu_name}}</td>
                            {{-- <td>{{$fee_due_list->fname}} {{$fee_due_list->mname}} {{$fee_due_list->lname}}</td> --}}
                            <td>{{$fee_due_list->course_name}}</td>
                            <td>{{$fee_due_list->batch_name}}</td>
                            @if($month=='1')
                              <td>January</td>
                            @endif
                            @if($month=='2')
                              <td>February</td>
                            @endif
                            @if($month=='3')
                              <td>March</td>
                            @endif
                            @if($month=='4')
                              <td>April</td>
                            @endif
                            @if($month=='5')
                              <td>May</td>
                            @endif
                            @if($month=='6')
                              <td>June</td>
                            @endif
                            @if($month=='7')
                              <td>July</td>
                            @endif
                            @if($month=='8')
                              <td>August</td>
                            @endif
                            @if($month=='9')
                              <td>September</td>
                            @endif
                            @if($month=='10')
                              <td>October</td>
                            @endif
                            @if($month=='11')
                              <td>November</td>
                            @endif
                            @if($month=='12')
                              <td>December</td>
                            @endif

                            <td class="price">{{$fee_due_list->amount}}</td>
                            <td style="color:red;">Due</td>

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
       $(document).ready(function () {
           /*For Details Loading*/
           $("#course").change(function(){
               var id = $(this).val();
          //     alert(id);
               var _url = $("#_url").val();
               var dataString = 'eid=' + id;
               $.ajax
               ({
                   type: "POST",
                   url: _url + '/student/batchlist',
                   data: dataString,
                   cache: false,
                   success: function ( data ) {
                     data=JSON.parse(data);

                      //   alert(data);
                         var list = $("#batch");
                      $(list).empty().append('<option selected="selected" value=""> Please Select </option>');

                     $(data).empty();
                      var emptycarno="No batch available for this course";
             if(data.length==""){
                        $("#batch").append('<option value="' +emptycarno +'">' + emptycarno + '</option>');
             }
               else{
                        for (var i in data) {
                          var v=data[i]['id'];
                          var v1=data[i]['batch_name'];
                          $(list).append('<option value="' +v +'">' + v1 + '</option>');

                       }
           }

                   },
                   error: function (jqXHR, exception) {
        var msg = '';
        if (jqXHR.status === 0) {
            msg = 'Not connect.\n Verify Network.';
        } else if (jqXHR.status == 404) {
            msg = 'Requested page not found. [404]';
        } else if (jqXHR.status == 500) {
            msg = 'Internal Server Error [500].';
        } else if (exception === 'parsererror') {
            msg = 'Requested JSON parse failed.';
        } else if (exception === 'timeout') {
            msg = 'Time out error.';
        } else if (exception === 'abort') {
            msg = 'Ajax request aborted.';
        } else {
            msg = 'Uncaught Error.\n' + jqXHR.responseText;
        }
        alert(msg);
    },
               });
           });

       });
   </script>
<script>
        $(document).ready(function () {
            /*For Delete Application Info*/
            $(".tFileDelete").click(function (e) {
                e.preventDefault();
                var id = this.id;
                bootbox.confirm("Are you sure?", function (result) {
                    if (result) {
                        var _url = $("#_url").val();
                        window.location.href = _url + "/student/delete/" + id;
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
var table=  $('#example').DataTable( {

       buttons: [
           'copy', 'csv', 'excel', 'pdf', 'print'
       ],
       pageLength: 100,
       responsive: true


   } );
   var total=table.column( 6 ).data().sum();
  //  alert(total);
    $('#totamt').html(total);
   } );
</script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2();
    var startDate = new Date();
    var fechaFin = new Date();
    var FromEndDate = new Date();
    var ToEndDate = new Date();
    $('.from').datepicker({
    autoclose: true,
    minViewMode: 1,
    format: 'mm-yyyy'
}).on('changeDate', function(selected){
        startDate = new Date(selected.date.valueOf());
        startDate.setDate(startDate.getDate(new Date(selected.date.valueOf())));
        $('.to').datepicker('setStartDate', startDate);
    });

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
