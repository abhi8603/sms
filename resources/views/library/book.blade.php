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
            <!-- Custom Tabs -->
            <div class="nav-tabs-custom">
              <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1" data-toggle="tab">Add Book</a></li>
                <li><a href="#tab_2" data-toggle="tab">List</a></li>

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
                                   <h3 class="box-title">Add New Book</h3>
                                 </div>
                                 <!-- /.box-header -->
                                 <!-- form start -->
                                 <form role="form" method="post" enctype="multipart/form-data" action="{{url('library/books/add')}}">
                                   <div class="box-body">
                                     <div class="col-md-12">
                                     <div class="form-group col-md-4">
                                       <label for="exampleInputEmail1">Purchase Date<span style="color:red;"> *</span></label>
                                       <div class="input-group date">
                                         <div class="input-group-addon">
                                           <i class="fa fa-calendar"></i>
                                         </div>
                                         <input type="text" class="form-control pull-right dob" value="{{ old('dob') }}" id="puchase_date" name="puchase_date" required>
                                       </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                                <label for="Bill No" id="typechn">Bill No<span style="color:red;"> *</span></label>
                                                <input type="text" class="form-control" id="bill_no" name="bill_no" placeholder="Bill No">
                                              </div>
                                              <div class="form-group col-md-4">
                                                <label for="bookisbn_no">Book ISBN No.<span style="color:red;"> *</span></label>
                                                <input type="text" class="form-control" id="bookisbn_no" name="bookisbn_no" placeholder="Book ISBN No" required>
                                                 </div>
                                                 <div class="form-group col-md-4">
                                                   <label for="book_no">Book No.<span style="color:red;"> *</span></label>
                                                    <input type="text" class="form-control" id="book_no" name="book_no" placeholder="Book No." required>
                                                    </div>
                                                    <div id="dell">
                                        <div class="form-group col-md-4">
                                          <label for="title">Title<span style="color:red;"> *</span></label>
                                          <input type="text" class="form-control" id="title" name="title" placeholder="Title"  required>
                                        </div>
                                        <div class="form-group col-md-4">
                                          <label for="exampleInputEmail1">Author</span></label>
                                          <input type="text" class="form-control" id="auther" name="auther" value=""  placeholder="Auther">
                                        </div>
                                        <div class="form-group col-md-4">
                                          <label for="edition">Edition</label>
                                          <input type="text" class="form-control" id="edition" name="edition" value="" placeholder="Edition">
                                        </div>
                                        <div class="form-group col-md-4">
                                          <label for="edition">Book Category<span style="color:red;"> *</span></label>
                                          <select class="form-control select2" name="bookcategory" style="width: 100%;" required>
                                              <option value="" selected="selected">Please select</option>
                                              @foreach($library_category as $library_category){
                                              <option value="{{$library_category->id}}" >{{$library_category->category_name}}</option>
                                            }
                                           @endforeach
                                       </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                          <label for="Publisher">Publisher<span style="color:red;"> *</span></label>
                                          <input type="text" class="form-control" id="publisher" name="publisher" value="" placeholder="Publisher">
                                        </div>
                                        <div class="form-group col-md-4">
                                          <label for="No.of Copies">No.of Copies<span style="color:red;"> *</span></label>
                                          <input type="text" class="form-control" name="no_of_copy" value="" placeholder="No.of Copies" onkeypress="return isNumber(event)" required>
                                        </div>
                                        <div class="form-group col-md-4">
                                          <label for="Shelf No.">Shelf No.</label>
                                          <input type="text" class="form-control" name="shelf_no" value="" placeholder="Shelf No." onkeypress="return isNumber(event)">
                                        </div>
                                        <div class="form-group col-md-4">
                                          <label for="book_position">Book Position</label>
                                          <input type="text" class="form-control" name="book_position" value="" placeholder="Book Position">
                                        </div>
                                        <div class="form-group col-md-4">
                                          <label for="Book Cost">Book Cost<span style="color:red;"> *</span></label>
                                          <input type="text" class="form-control" name="book_cost" value="" placeholder="Book Cost" onkeypress="return isNumber(event)" required>
                                        </div>
                                        <div class="form-group col-md-4">
                                          <label for="Book Cost">Language<span style="color:red;"> *</span></label>
                                          <input type="text" class="form-control" name="language" value="" placeholder="Language" required>
                                        </div>
                                        <div class="form-group col-md-4">
                                          <label for="Book Cost">Book Condition<span style="color:red;"> *</span></label>
                                          <select class="form-control select2" name="book_condition" style="width: 100%;" required>
                                              <option value="" selected="selected">Please select</option>
                                              <option value="As New">As New</option>
                                              <option value="Fine">Fine</option>
                                              <option value="Very Good">Very Good</option>
                                              <option value="Good">Good</option>
                                              <option value="Fair">Fair</option>
                                              <option value="Poor">Poor</option>
                                              <option value="Missing">Missing</option>
                                              <option value="Lost">Lost</option>
                                       </select>
                                        </div>
                                      </div>
                                   </div>
                                 </div>
                                   <div class="box-footer">
                                    <!-- <button type="submit" class="btn btn-primary">Save</button>-->
                                    <input type="submit" class="btn btn-primary" name="submit" value="Save">
                                   </div>
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                 </form>
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
                            <h3 class="box-title">Book List</h3>
                          </div>
                          <!-- /.box-header -->
                          <div class="box-body">
                            <table id="example" class="table table-striped table-bordered display" style="width:100%">
                              <thead>
                              <tr>
                                <th>Sl.No</th>
                                <th>Book ISBN No</th>
                                <th>Book No</th>
                                <th>Title</th>
                                <th>Edition</th>
                                <th>Issue Status</th>
                                <th>Action</th>
                              </tr>
                              </thead>
                              <tbody>
                                @php $i=0; @endphp
                                @foreach($booklist as $booklist)
                                @php $i++ @endphp
                              <tr>
                                <td>@php echo $i @endphp</td>
                                <td>{{$booklist->bookisbn_no}}</td>
                                <td>{{$booklist->book_no}}</td>
                                <td>{{$booklist->title}}</td>
                                <td>{{$booklist->edition}}</td>
                                @if($booklist->issue_status=="0")
                                <td style="color:green;">Available</td>
                                @else
                                <td style="color:red;">Issued</td>
                                @endif
                              <td>
                              <div class="btn-group">
                                <button type="button" class="btn btn-default  btn-flat dropdown-toggle" data-toggle="dropdown">
                                  <span class="caret"></span>
                                  <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <ul class="dropdown-menu" role="menu" title="Action">
                                  <li><a href="{{url('library/books/view/'.$booklist->id)}}" title="Edit"><i  class="fa fa-eye" style="color: #897df8e6";></i></a></li>
                                  <li><a class="tFileDelete" id="{{$booklist->id}}"  title="Delete"><i class="fa fa-trash" style="color: red";></i></a></li>
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
                        </div>
                        </div>
                      </form>
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
                bootbox.confirm("Are you sure?", function (result) {
                    if (result) {
                        var _url = $("#_url").val();
                        window.location.href = _url + "/library/books/delete/" + id;
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
       responsive: true
   } );
   } );

</script>
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
