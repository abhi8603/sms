@extends('header')
@section('style')
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
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

        <li class="active">View Item Category</li>
      </ol>
    </section>

    <!-- Main content -->
      <section class="content">
          @include('notification.notify')
    <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">View Item Category</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button style="display:none;" type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-6">

                  <!-- /.form-group -->
                  <div class="box box-primary">
                           <div class="box-header with-border">
                             <h3 class="box-title"></h3>
                           </div>
                           <!-- /.box-header -->
                           <!-- form start -->
                           <form role="form" method="post" enctype="multipart/form-data" action="{{url('stock/update_item_stock')}}">
                          <div class="box-body">
                          <div class="col-md-12 form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                          <label for="name" class="control-label">Item Category<span style="color:red;"> *</span></label>
                          <select name="category" class="form-control">
                               <option>Select</option>
                               @foreach($category as $cat)
                               <option <?php if($stock[0]->tb_category_id==$cat->id){echo "selected"; } ?> value="{{$cat->id}}">{{$cat->category_name}}</option>
                               @endforeach
                             </select>

                      </div>
                       <div class="col-md-12 form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                          <label for="name" class="control-label">Item <span style="color:red;"> *</span></label>
                           <select name="item" class="form-control">
                               <option>Select</option>
                               @foreach($item as $i)
                               <option <?php if($stock[0]->tb_item_id==$i->id){echo "selected"; } ?> value="{{$i->id}}">{{$i->item_name}}</option>
                               @endforeach
                             </select>

                      </div>
                          <div class="col-md-12 form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                          <label for="name" class="control-label">Supplier</label>
                           <select name="supplier" class="form-control">
                               <option>Select</option>
                               @foreach($supplier as $sup)
                               <option <?php if($stock[0]->item_supplier_id==$sup->id){echo "selected"; } ?> value="{{$sup->id}}">{{$sup->supplier_name}}</option>
                               @endforeach
                             </select>
                     </div>
                     <div class="col-md-12 form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                          <label for="name" class="control-label">Store</label>
                          <select name="store" class="form-control">
                               <option>Select</option>
                               @foreach($store as $st)
                               <option <?php if($stock[0]->item_store_id==$st->id){echo "selected"; } ?> value="{{$st->id}}">{{$st->item_store_name}}</option>
                               @endforeach
                             </select>


                     </div>
                     <div class="col-md-12 form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                          <label for="name" class="control-label">Quantity</label>
                          <input type="text" value="{{$stock[0]->qty OR ''}}" name="qty" class="form-control">
                          <input type="hidden" value="{{$stock[0]->id OR ''}}" name="id" class="form-control">
                        </div>
                     <div class="col-md-12 form-group{{ $errors->has('name') ? ' has-error' : '' }}">

                               <label> Date</label>
                               <div class="input-group date">
                                 <div class="input-group-addon">
                                   <i class="fa fa-calendar"></i>
                                 </div>
                                 <input type="text" class="form-control pull-right dob" value="{{$stock[0]->date OR ''}}" id="date" name="date" required readonly>
                               </div>
                               <!-- /.input group -->


                     </div>
                     <div class="col-md-12 form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                          <label for="name" class="control-label">Attach Document</label>
                          <input type="file" name="file"  class="form-control">
                        </div>
                        <div class="col-md-12 form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                          <label for="name" class="control-label">Description</label>
                          <textarea name="description" class="form-control">{{$stock[0]->description OR ''}}</textarea>
                        </div>

            </div>
         <div class="box-footer">
       <button type="submit" class="btn btn-primary">Update</button>
     </div>
       <input type="hidden" name="_token" value="{{ csrf_token() }}">
   </form>
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
