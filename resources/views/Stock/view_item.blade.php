@extends('header')
@section('style')
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
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
        <li><a href="#"><i class="fa fa-dashboard"></i> Stock</a></li>

        <li class="active">View Item</li>
      </ol>
    </section>

    <!-- Main content -->
      <section class="content">
          @include('notification.notify')
    <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">View Item </h3>

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
                             <h3 class="box-title"></h3>
                           </div>
                           <!-- /.box-header -->
                           <!-- form start -->
                           <form role="form" method="post" enctype="multipart/form-data" action="{{url('stock/update_item')}}">
                          <div class="box-body">
                                <div class="col-md-12 form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                          <label for="name" class="control-label">Item  <span style="color:red;"> *</span></label>
                              <input id="item_name" value="{{$item->item_name OR ''}}" type="text" class="form-control" name="item"  required autofocus>
                              <input id="id" value="{{$item->id OR ''}}" type="hidden" class="form-control" name="id"   autofocus>

                      </div>
                      <div class="col-md-12 form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                          <label for="name" class="control-label">Item Category <span style="color:red;"> *</span></label>
                             <select name="category" class="form-control">
                               <option>Select</option>
                               @foreach($category as $cat)
                               <option <?php if($item->category==$cat->id){echo "selected"; } ?> value="{{$cat->id}}">{{$cat->category_name}}</option>
                               @endforeach
                             </select>
                      </div>
                          <div class="col-md-12 form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                          <label for="name" class="control-label">Description</label>
                        <textarea class="form-control" name="description">{{$item->description}}</textarea>
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
  </div>
@endsection
{{--External Style Section--}}
@section('script')
<script src="{{ URL::asset('assets/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2();
    });
</script>

@endsection
<!-- ./wrapper -->
