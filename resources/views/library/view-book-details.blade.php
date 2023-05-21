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
        <li><a href="#"><i class="fa fa-dashboard"></i> Library</a></li>
        <li class="active">Add Books</li>
      </ol>
    </section>
    <section class="content">
        @include('notification.notify')
  <div class="box box-default">
    <!-- Main content -->
    <div class="box-header with-border">
      <h3 class="box-title">Library Book</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        <button style="display:none;" type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
      </div>
    </div>

        <div class="row">
          <div class="col-md-12">
                  <div class="box-body">
                    <div class="row">
                      <div class="col-md-12">

                        <!-- /.form-group -->
                        <div class="box box-primary">
                                 <div class="box-header with-border">
                                   <h3 class="box-title">View Book Details</h3>
                                 </div>
                                 <!-- /.box-header -->
                                 <!-- form start -->
                                 <form role="form" method="post" enctype="multipart/form-data" action="{{url('library/books/update')}}">
                                   @foreach($bookdetails as $bookdetails)
                                   <div class="box-body">
                                     <div class="col-md-12">
                                     <div class="form-group col-md-4">
                                       <label for="exampleInputEmail1">Purchase Date<span style="color:red;"> *</span></label>
                                       <div class="input-group date">
                                         <div class="input-group-addon">
                                           <i class="fa fa-calendar"></i>
                                         </div>
                                         <input type="text" class="form-control pull-right dob" value="{{ $bookdetails->puchase_date }}" id="puchase_date" name="puchase_date" required>
                                       </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                                <label for="Bill No" id="typechn">Bill No<span style="color:red;"> *</span></label>
                                                <input type="text" class="form-control" value="{{ $bookdetails->bill_no }}" id="bill_no" name="bill_no" placeholder="Bill No">
                                              </div>
                                              <div class="form-group col-md-4">
                                                <label for="bookisbn_no">Book ISBN No.<span style="color:red;"> *</span></label>
                                                <input type="text" class="form-control" value="{{ $bookdetails->bookisbn_no }}" id="bookisbn_no" name="bookisbn_no" placeholder="Book ISBN No" required>
                                                 </div>
                                                 <div class="form-group col-md-4">
                                                   <label for="book_no">Book No.<span style="color:red;"> *</span></label>
                                                    <input type="text" class="form-control" id="book_no" value="{{ $bookdetails->book_no }}" name="book_no" placeholder="Book No." required readonly>
                                                    </div>
                                                    <div id="dell">
                                        <div class="form-group col-md-4">
                                          <label for="title">Title<span style="color:red;"> *</span></label>
                                          <input type="text" class="form-control" id="title" value="{{ $bookdetails->title }}" name="title" placeholder="Title"  required>
                                        </div>
                                        <div class="form-group col-md-4">
                                          <label for="exampleInputEmail1">Author</span></label>
                                          <input type="text" class="form-control" id="auther" value="{{ $bookdetails->auther }}" name="auther"  placeholder="Auther">
                                        </div>
                                        <div class="form-group col-md-4">
                                          <label for="edition">Edition</label>
                                          <input type="text" class="form-control" id="edition" value="{{ $bookdetails->edition }}" name="edition" value="" placeholder="Edition">
                                        </div>
                                        <div class="form-group col-md-4">
                                          <label for="edition">Book Category<span style="color:red;"> *</span></label>
                                          <select class="form-control select2" name="bookcategory" style="width: 100%;" required>
                                              <option value="" selected="selected">Please select</option>
                                              @foreach($library_category as $library_category){
                                              <option value="{{$library_category->id}}" @if($library_category->id == $bookdetails->bookcategory) selected @endif >{{$library_category->category_name}}</option>
                                            }
                                           @endforeach
                                       </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                          <label for="Publisher">Publisher<span style="color:red;"> *</span></label>
                                          <input type="text" class="form-control" value="{{ $bookdetails->publisher }}" id="publisher" name="publisher" value="" placeholder="Publisher">
                                        </div>
                                        <div class="form-group col-md-4">
                                          <label for="No.of Copies">No.of Copies<span style="color:red;"> *</span></label>
                                          <input type="text" class="form-control" value="{{ $bookdetails->no_of_copy }}" name="no_of_copy"  placeholder="No.of Copies" onkeypress="return isNumber(event)" required>
                                        </div>
                                        <div class="form-group col-md-4">
                                          <label for="Shelf No.">Shelf No.</label>
                                          <input type="text" class="form-control" name="shelf_no" value="{{ $bookdetails->shelf_no }}" placeholder="Shelf No." onkeypress="return isNumber(event)">
                                        </div>
                                        <div class="form-group col-md-4">
                                          <label for="book_position">Book Position</label>
                                          <input type="text" class="form-control" name="book_position" value="{{ $bookdetails->book_position }}" placeholder="Book Position">
                                        </div>
                                        <div class="form-group col-md-4">
                                          <label for="Book Cost">Book Cost<span style="color:red;"> *</span></label>
                                          <input type="text" class="form-control" name="book_cost" value="{{ $bookdetails->book_cost }}" placeholder="Book Cost" onkeypress="return isNumber(event)" required>
                                        </div>
                                        <div class="form-group col-md-4">
                                          <label for="Book Cost">Language<span style="color:red;"> *</span></label>
                                          <input type="text" class="form-control" name="language" value="{{ $bookdetails->language }}" placeholder="Language" required>
                                        </div>
                                        <div class="form-group col-md-4">
                                          <label for="Book Cost">Book Condition<span style="color:red;"> *</span></label>
                                          <select class="form-control select2" name="book_condition" style="width: 100%;" required>
                                              <option value="" selected="selected">Please select</option>
                                              <option value="As New" @if($bookdetails->book_condition=='As New') selected @endif>As New</option>
                                              <option value="Fine" @if($bookdetails->book_condition=='Fine') selected @endif>Fine</option>
                                              <option value="Very Good" @if($bookdetails->book_condition=='Very Good') selected @endif>Very Good</option>
                                              <option value="Good" @if($bookdetails->book_condition=='Good') selected @endif>Good</option>
                                              <option value="Fair" @if($bookdetails->book_condition=='Fair') selected @endif>Fair</option>
                                              <option value="Poor" @if($bookdetails->book_condition=='Poor') selected @endif>Poor</option>
                                              <option value="Missing" @if($bookdetails->book_condition=='Missing') selected @endif>Missing</option>
                                              <option value="Lost" @if($bookdetails->book_condition=='Lost') selected @endif>Lost</option>
                                       </select>
                                        </div>
                                      </div>
                                   </div>
                                 </div>
                                 @endforeach
                                   <div class="box-footer">
                                    <!-- <button type="submit" class="btn btn-primary">Save</button>-->
                                    <input type="submit" class="btn btn-primary" name="submit" value="Update">
                                   </div>
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                 </form>
                               </div>
                      </div>
            </div>
          </div>

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
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2();
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
