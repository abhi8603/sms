@extends('header')
@section('style')
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/buttons.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/rowReorder.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/responsive.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/select2/dist/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/bootstrap-daterangepicker/daterangepicker.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">

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
          <li><a href="#"><i class="fa fa-dashboard"></i>Accounts</a></li>
        <li class="active">Create Voucher</li>
      </ol>
    </section>

    <!-- Main content -->
      <section class="content">
          @include('notification.notify')
    <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Voucher</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button style="display:none;" type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-5">

                  <!-- /.form-group -->
                  <div class="box box-primary">
                           <div class="box-header with-border">
                             <h3 class="box-title">Create Voucher</h3>
                           </div>
                           <!-- /.box-header -->
                           <!-- form start -->
                           <form role="form" method="post" enctype="multipart/form-data" action="{{url('finance/account/voucher/create')}}">
                          <div class="box-body">
                            <div class="form-group">
                              <label for="exampleInputEmail1">Voucher No : <span style="color:black;"> {{$vouchercnt}}</span></label>
                              <input type="hidden" class="form-control" id="voucher_no" value="{{$vouchercnt}}" name="voucher_no" placeholder="Voucher Head" required>
                            </div>
                            <div class="form-group">
                                            <label>Transaction Date</label>
                                            <div class="input-group date">
                                              <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                              </div>
                                              <input type="text" class="form-control pull-right" value="{{ old('dob') }}" id="dob" name="transcation_date" required>
                                            </div>
                                            <!-- /.input group -->
                                          </div>
                            <div class="form-group">
                              <label for="exampleInputEmail1">Voucher Head<span style="color:red;"> *</span></label>
                              <select class="form-control select2" id="voucherhead" name="voucher_head" style="width: 100%;" required>
                                  <option value="" selected="selected">Select Voucher Head</option>
                                  <?php foreach ($voucher_heads as $voucher_heads): ?>
                                      <option value="{{$voucher_heads->id}}">{{$voucher_heads->voucher_head}}</option>
                                  <?php endforeach; ?>
                            </select>
                          </div>
                          <div class="form-group">
                            <label for="exampleInputEmail1">Ledger Account<span style="color:red;"> *</span></label>
                            <select class="form-control select2" id="ledger_acc" name="ledger_acc" style="width: 100%;">
                                <option value="0" selected="selected">Select Ledger Account</option>

                          </select>
                        </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">Cr./Dr.<span style="color:red;"> *</span></label>
                          <select class="form-control select2" id="crdr" name="crdr" style="width: 100%;" required>
                              <option value="" selected="selected">Please Select</option>
                              <option value="Cr" selected="selected">Cr</option>
                              <option value="Dr" selected="selected">Dr</option>

                        </select>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Payment Mode<span style="color:red;"> *</span></label>
                        <select class="form-control select2" id="paymode" name="paymode" style="width: 100%;" required>
                            <option value="" selected="selected">Please Select</option>
                            <option value="Cash">Cash</option>
                            <option value="Bank">Bank</option>

                      </select>
                    </div>
                          <div class="form-group">
                            <label for="exampleInputEmail1">Amount<span style="color:red;"> *</span></label>
                            <input type="text" class="form-control" id="amt" onkeypress="return isNumber(event)" name="amt" placeholder="Amount" required>
                          </div>
                          <div class="form-group">
                            <label for="exampleInputEmail1">Narration<span style="color:red;"> *</span></label>
                            <textarea class="form-control" name="narration" placeholder="Narration"></textarea>
                          </div>
                           </div>
                             <!-- /.box-body -->

                             <div class="box-footer">
                               <button type="submit" id="save" class="btn btn-primary">Create</button>
                             </div>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                           </form>
                         </div>

                  <!-- /.form-group -->
                </div>

                <div class="col-md-7">
                  <div class="box box-info">
                    <div class="box-header">
                      <h3 class="box-title">Voucher List</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                      <table id="example" class="table table-striped table-bordered display " style="width:100%">
                        <thead>
                        <tr>
                          <th>Sl.No</th>
                          <th>Voucher No</th>
                          <th>Transaction Date</th>
                          <th>Voucher Head</th>
                          <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                          @php $i=0; @endphp
                          @foreach($voucherlist as $voucherlist)
                            @php $i++; @endphp
                          <tr>
                            <td>@php echo $i; @endphp</td>
                            <td>{{$voucherlist->voucher_no}}</td>
                            <td>{{$voucherlist->transaction_date}}</td>
                            <td>{{$voucherlist->voucher_head}}</td>
                            <td>
                          <div class="btn-group">
                            <button type="button" class="btn btn-default  btn-flat dropdown-toggle" data-toggle="dropdown">
                              <span class="caret"></span>
                              <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu" role="menu" title="Action">
                              <li><a href="{{url('finance/account/voucher/view/'.$voucherlist->voucher_no)}}" title="Edit"><i  class="fa fa-eye" style="color: #897df8e6";></i></a></li>
                              <li><a href="#" class="tFileDelete" id="{{$voucherlist->voucher_no}}" title="Delete"><i class="fa fa-trash" style="color: red";></i></a></li>
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
        $(document).ready(function () {
            /*For Delete Application Info*/
            $(".tFileDelete").click(function (e) {
                e.preventDefault();
                var id = this.id;
                bootbox.confirm("Are you sure?", function (result) {
                    if (result) {
                        var _url = $("#_url").val();
                        window.location.href = _url + "/finance/account/voucher/delete/" + id;
                    }
                });
            });

        });
    </script>
<script>
        $(document).ready(function () {

                     /*For Details Loading*/
                     $("#voucherhead").change(function(){
                         var id = $(this).val();
                    //  alert(id);
                         var _url = $("#_url").val();
                         var dataString = 'eid=' + id;
                         $.ajax
                         ({
                             type: "POST",
                             url: _url + '/finance/feeheadlist',
                             data: dataString,
                             cache: false,
                             success: function ( data ) {
                               data=JSON.parse(data);
                          //    data=data.split("|")
                            //       alert(data);
                                   var list = $("#ledger_acc");
                                $(list).empty().append('<option selected="selected" value=""> Please Select Ledger Account </option>');

                               $(data).empty();
                                var emptycarno="No Ledger Account available for this Voucher head.";
                       if(data.length==""){
                         alert('No Ledger Account available for this Voucher head. Please Add Ledger Account For this Fee Head.');
                                  $("#ledger_acc").append('<option value="' +emptycarno +'">' + emptycarno + '</option>');
                       }
                         else{
                                  var enab=0;
                                  for (var i in data) {
                                    var v=data[i]['id'];
                                    var v1=data[i]['account_name'];
                                    var enab=data[i]['enable_voucher'];
                                    $(list).append('<option value="' +v1 +'">' + v1 + '</option>');

                                 }
                     }
                     if(enab=="0"){
                        $("#save").attr("disabled", true);
                        alert("Voucher Creation is disabled for this Voucher Head.Pleae Enable It.");
                     }else{
                        $("#save").removeAttr('disabled');
                     }

                             },
                             error: function (jqXHR, exception) {
                  var msg = '';
                  if (jqXHR.status === 0) {
                      msg = 'Not connect.\n Verify Network.';
                  } else if (jqXHR.status == 404) {
                      msg = 'Requested page not found. [404]';
                  } else if (jqXHR.status == 500) {
                      msg = 'Please select Valid Fee Head.';
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
       responsive: true


   } );
   } );

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
    $('.select2').select2();
    $('#dob').datepicker({
      autoclose: true,
      format:'dd-mm-yyyy'
    });
  });
</script>
@endsection
<!-- ./wrapper -->
