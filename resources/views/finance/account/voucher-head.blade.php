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
        <li class="active">Voucher Head</li>
      </ol>
    </section>

    <!-- Main content -->
      <section class="content">
          @include('notification.notify')
    <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Voucher Head</h3>

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
                             <h3 class="box-title">Add Voucher Head</h3>
                           </div>
                           <!-- /.box-header -->
                           <!-- form start -->
                           <form role="form" method="post" enctype="multipart/form-data" action="{{url('finance/account/voucher-head/add')}}">
                          <div class="box-body">
                            <div class="form-group">
                              <label for="exampleInputEmail1">Voucher Head<span style="color:red;"> *</span></label>
                              <input type="text" class="form-control" id="voucher_head" name="voucher_head" placeholder="Voucher Head" required>
                            </div>                          
                            <div class="form-group">
                              <label for="exampleInputEmail1">Account Group<span style="color:red;"> *</span></label>
                              <select class="form-control select2" name="account_group" style="width: 100%;">
                                  <option value="0" selected="selected">Select Ledger Account</option>
                                  <?php foreach ($accountgroup as $accountgroup): ?>
                                      <option value="{{$accountgroup->id}}">{{$accountgroup->account_name}}</option>
                                  <?php endforeach; ?>
                            </select>
                          </div>
                          <div class="form-group">
                            <label for="exampleInputEmail1">Number<span style="color:red;"> *</span></label>
                            <input type="text" class="form-control" id="num" onkeypress="return isNumber(event)" name="num" placeholder="Number" required>
                          </div>
                          <div class="checkbox">
                                          <label>
                                            <input type="checkbox" name="enable" value="1">Enable Voucher Creation ?
                                          </label>
                                        </div>
                           </div>
                             <!-- /.box-body -->

                             <div class="box-footer">
                               <button type="submit" class="btn btn-primary">Create</button>
                             </div>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                           </form>
                         </div>

                  <!-- /.form-group -->
                </div>

                <div class="col-md-7">
                  <div class="box box-info">
                    <div class="box-header">
                      <h3 class="box-title">Voucher Head List</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                      <table id="example" class="table table-striped table-bordered display " style="width:100%">
                        <thead>
                        <tr>
                          <th>Sl.No</th>
                          <th>Voucher Head</th>
                          <th>Ledger Account</th>
                          <th>Number</th>
                          <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @php $i=0; @endphp
                            @foreach($voucher_heads as $voucher_heads)
                              @php $i++; @endphp
                            <tr>
                              <td>@php echo $i; @endphp</td>
                              <td>{{$voucher_heads->voucher_head}}</td>
                              <td>{{$voucher_heads->account_name}}</td>
                              <td>{{$voucher_heads->num}}</td>
                              <td>
                                <div class="btn-group">
                                  <button type="button" class="btn btn-default  btn-flat dropdown-toggle" data-toggle="dropdown">
                                    <span class="caret"></span>
                                    <span class="sr-only">Toggle Dropdown</span>
                                  </button>
                                  <ul class="dropdown-menu" role="menu" title="Action">
                                    <li><a href="{{url('finance/account/voucher-head/view/'.$voucher_heads->id)}}" title="Edit"><i  class="fa fa-eye" style="color: #897df8e6";></i></a></li>
                                    <li><a href="#" class="tFileDelete" id="{{$voucher_heads->id}}" title="Delete"><i class="fa fa-trash" style="color: red";></i></a></li>
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
                        window.location.href = _url + "/finance/account/voucher-head/delete/" + id;
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
    $('.select2').select2()
  })
</script>
@endsection
<!-- ./wrapper -->
