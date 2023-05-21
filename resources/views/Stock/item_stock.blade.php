@extends('header')
@section('style')
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/bootstrap/dist/css/buttons.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/bootstrap/dist/css/rowReorder.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/bootstrap/dist/css/responsive.dataTables.min.css') }}">
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
        <li><a href="#"><i class="fa fa-dashboard"></i> Stock</a></li>

        <li class="active">Item Category</li>
      </ol>
    </section>

    <!-- Main content -->
      <section class="content">
          @include('notification.notify')
    <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Add Item Category</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button style="display:none;" type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-4">

                  <!-- /.form-group -->
                  <div class="box box-primary">
                           <div class="box-header with-border">
                             <h3 class="box-title"></h3>
                           </div>
                           <!-- /.box-header -->
                           <!-- form start -->
                           <form role="form" method="post" enctype="multipart/form-data" action="{{url('stock/insert_item_stock')}}">
                          <div class="box-body">
                          <div class="col-md-12 form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                          <label for="name" class="control-label">Item Category<span style="color:red;"> *</span></label>
                          <select name="category" class="form-control">
                               <option>Select</option>
                               @foreach($category as $cat)
                               <option value="{{$cat->id}}">{{$cat->category_name}}</option>
                               @endforeach
                             </select>

                      </div>
                       <div class="col-md-12 form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                          <label for="name" class="control-label">Item <span style="color:red;"> *</span></label>
                           <select name="item" class="form-control">
                               <option>Select</option>
                               @foreach($item as $i)
                               <option value="{{$i->id}}">{{$i->item_name}}</option>
                               @endforeach
                             </select>

                      </div>
                          <div class="col-md-12 form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                          <label for="name" class="control-label">Supplier</label>
                           <select name="supplier" class="form-control">
                               <option>Select</option>
                               @foreach($supplier as $sup)
                               <option value="{{$sup->id}}">{{$sup->supplier_name}}</option>
                               @endforeach
                             </select>
                     </div>
                     <div class="col-md-12 form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                          <label for="name" class="control-label">Store</label>
                          <select name="store" class="form-control">
                               <option>Select</option>
                               @foreach($store as $st)
                               <option value="{{$st->id}}">{{$st->item_store_name}}</option>
                               @endforeach
                             </select>


                     </div>
                     <div class="col-md-12 form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                          <label for="name" class="control-label">Quantity</label>
                          <input type="text" name="qty" class="form-control">
                        </div>
                     <div class="col-md-12 form-group{{ $errors->has('name') ? ' has-error' : '' }}">

                               <label> Date</label>
                               <div class="input-group date">
                                 <div class="input-group-addon">
                                   <i class="fa fa-calendar"></i>
                                 </div>
                                 <input type="text" class="form-control pull-right dob" value="{{ old('dob') }}" id="date" name="date" required readonly>
                               </div>
                               <!-- /.input group -->


                     </div>
                     <div class="col-md-12 form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                          <label for="name" class="control-label">Attach Document</label>
                          <input type="file" name="file"  class="form-control" required>
                        </div>
                        <div class="col-md-12 form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                          <label for="name" class="control-label">Description</label>
                          <textarea name="description" class="form-control"></textarea>
                        </div>

            </div>
         <div class="box-footer">
       <button type="submit" class="btn btn-primary">Save</button>
     </div>
       <input type="hidden" name="_token" value="{{ csrf_token() }}">
   </form>
   </div>
                </div>

                <div class="col-md-8">
                  <div class="box box-info">
                    <div class="box-header">
                      <h3 class="box-title">Item Stock</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                      <table id="example" class="table table-striped table-bordered ">
                        <thead>
                        <tr>
                          <th>Sl.No</th>
                          <th>Name</th>
                          <th>Supplier</th>
                          <th>Store</th>
                          <th>Quantity</th>
                          <th>Document</th>
                          <th>Date</th>
                          <th>Action</th>
                        </tr>
                        </thead>
                      <tbody>
                         @php $i=0; @endphp
                        @foreach($stock as  $stc)
                       @php $i++ @endphp
                          <tr>
                          <td>@php echo $i @endphp</td>
                          <td>{{$stc->item_name}}</td>
                          <td>{{$stc->supplier_name}}</td>
                          <td>{{$stc->item_store_name}}</td>
                          <td>{{$stc->qty}}</td>
                          <td><a href="{{ URL::asset($stc->document) }}" target="_blank" class="btn btn-info"> View </a></td>
                          <td>{{$stc->date}}</td>
                           <td data-label="Action">
                        <div class="btn-group">
                          <button type="button" class="btn btn-default  btn-flat dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                          </button>
                          <ul class="dropdown-menu" role="menu" title="Action">
                            <li><a href="{{url('stock/item_stock/view/'.Crypt::encrypt($stc->id))}}" title="Edit"><i  class="fa fa-eye" style="color: #897df8e6";></i></a></li>
                            <li><a href="" class="tFileDelete" id="{{$stc->id}}" title="Delete"><i class="fa fa-trash" style="color: red";></i></a></li>
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
                        window.location.href = _url + "/stock/item_stock/delete/" + id;
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
         responsive: true


   } );
   } );

</script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2();
    $('#date').datepicker({
      autoclose: true,
      format:'dd-mm-yyyy'
    });
    $('#enddate').datepicker({
      autoclose: true,
        format:'dd-mm-yyyy'
    });
    //Datemask dd/mm/yyyy

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
