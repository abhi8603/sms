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
          <li><a href="#"><i class="fa fa-dashboard"></i>Library</a></li>
        <li class="active">Category</li>
      </ol>
    </section>

    <!-- Main content -->
      <section class="content">
          @include('notification.notify')
    <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Library Category</h3>

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
                             <h3 class="box-title">Add Library Category</h3>
                           </div>
                           <!-- /.box-header -->
                           <!-- form start -->
                           <form role="form" method="post" enctype="multipart/form-data" action="{{url('library/bookissue/bookreturn')}}">
                          <div class="box-body">
                            <div class="form-group">
                              <label for="exampleInputEmail1">Book<span style="color:red;"> *</span></label>
                              <select class="form-control select2" id="book" name="book" style="width: 100%;" required>
                                  <option value="" selected="selected">Search book by Book No,Name,Auther,ISBN No</option>
                               <?php foreach ($issuebooklist as $issuebooklist): ?>
                                   <option value="{{$issuebooklist->id}}">{{$issuebooklist->book_name}} - {{$issuebooklist->book_id}} - {{$issuebooklist->auther}} - {{$issuebooklist->bookisbn_no}}</option>
                               <?php endforeach; ?>
                           </select>
                            </div>
                            <div class="col-md-12 callout callout-info" id="bookinfo" style="display:none;">
                              <div class="form-group col-md-6">
                               <label>ISBN No.</label>
                               <input type="text" class="form-control" id="isbn_no" name="isbn_no" value="" readonly>
                                <input type="hidden" class="form-control" id="id" name="id" value="" readonly>
                              </div>
                              <div class="form-group col-md-6">
                               <label >Book No.	</label>
                               <input type="text" class="form-control" id="book_no" name="book_no" value="" readonly>
                               </div>
                              <div class="form-group col-md-6">
                               <label >Title:</label>
                               <input type="text" class="form-control" id="title" name="title" value="" readonly>
                              </div>
                              <div class="form-group col-md-6">
                               <label >Author</label>
                               <input type="text" class="form-control" id="auther" name="auther" value="" maxlength="10" readonly>
                              </div>
                              <div class="form-group col-md-6">
                               <label >User Type</label>
                               <input type="text" class="form-control" id="userType" name="userType" value="" maxlength="10" readonly>
                              </div>
                              <div class="form-group col-md-6">
                               <label >User</label>
                               <input type="text" class="form-control" id="user" name="user" value="" maxlength="10" readonly>
                              </div>
                              <div class="form-group col-md-6">
                               <label >Issue Date</label>
                               <input type="text" class="form-control" id="issuedate" name="issuedate" value="" maxlength="10" readonly>
                              </div>
                              <div class="form-group col-md-6">
                               <label >Due</label>
                               <input type="text" class="form-control" id="duedate" name="duedate" value="" maxlength="10" readonly>
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="exampleInputEmail1">Return / Renewal<span style="color:red;"> *</span></label>
                              <select class="form-control select2" id="return" name="retun" style="width: 100%;" required>
                                  <option value="" selected="selected">Please select</option>
                                  <option value="Return">Return</option>
                                  <option value="Renewal">Renewal</option>

                           </select>
                            </div>
                            <div class="col-md-12" id="returninfo" style="display:none;">
                              <div class="form-group">
                               <label>Return Date</label>
                               <div class="input-group date">
                                 <div class="input-group-addon">
                                   <i class="fa fa-calendar"></i>
                                 </div>
                                 <input type="text" class="form-control pull-right dob" value="{{ old('dob') }}" name="returndate">
                               </div>
                              </div>
                              <div class="form-group">
                               <label >Fine Amount</label>
                               <input type="text" class="form-control" id="fineamt" name="fineamt" value="0.00">
                               </div>
                               <div class="form-group">
                                <label >Remarks</label>
                                <textarea class="form-control" id="review" name="review" value="0.00"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12" id="renewinfo" style="display:none;">
                              <div class="form-group">
                               <label>Due Date</label>
                               <div class="input-group date">
                                 <div class="input-group-addon">
                                   <i class="fa fa-calendar"></i>
                                 </div>
                                 <input type="text" class="form-control pull-right dob" value="{{ old('dob') }}" name="duedate">
                               </div>
                              </div>
                            </div>
                          </div>
                             <!-- /.box-body -->

                             <div class="box-footer">
                               <button type="submit" id="submit" class="btn btn-primary">Save</button>
                             </div>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                           </form>
                         </div>

                  <!-- /.form-group -->
                </div>

                <div class="col-md-6">
                  <div class="box box-info">
                    <div class="box-header">
                      <h3 class="box-title">Return Book List</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                      <table id="example" class="table table-striped table-bordered display" style="width:100%">
                        <thead>
                        <tr>
                          <th>Sl.No</th>
                          <th>User</th>
                          <th>Course/Class</th>
                          <th>Batch/Section</th>
                          <th>Book/ID</th>
                          <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                              @php $i=0; @endphp
                          <?php foreach ($returnbooklist as $returnbooklist): ?>
                              @php $i++; @endphp
                            <tr>
                              <td>@php echo $i; @endphp</td>
                              <td>{{$issuebooklist->name}} - {{$issuebooklist->reg_no}}</td>
                              <td>{{$issuebooklist->course_department}}</td>
                              <td>{{$issuebooklist->batch_designation}}</td>
                              <td>{{$issuebooklist->book_name}} - {{$issuebooklist->book_id}}</td>
                              <td><a href="{{url('library/returnbooks/view/'.$issuebooklist->id)}}" title="View"><i  class="fa fa-eye" style="color: #897df8e6";></i></a></td>
                            </tr>
                          <?php endforeach; ?>

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
           /*For Details Loading*/
              $("#return").change(function(){
                var bookid =$("#book").val();
                if(bookid==''){
                  alert('Please Select Book details first.');
                   $("#submit").attr("disabled", true);
                }else{
                    $("#submit").removeAttr("disabled");
                var value = $(this).val();
                if(value=='Return'){
                  $("#returninfo").show();

                  $("#renewinfo").hide();

                }else{
                  $("#returninfo").hide();

                  $("#renewinfo").show();

                }
                if(value==""){
                  $("#returninfo").hide();
                  $("#returninfo").fadeOut('slow');
                  $("#renewinfo").hide();
                  $("#renewinfo").fadeOut('slow');
                }
              }
              });


           $("#book").change(function(){
             $("#bookinfo").hide();
               var id = $(this).val();
               var _url = $("#_url").val();
               var dataString = 'eid=' + id;
               $.ajax
               ({
                   type: "POST",
                   url: _url + '/library/bookissue/bookdetails',
                   data: dataString,
                   cache: false,
                   success: function ( data ) {
                  //  alert(data);
                  // $("#stuinfo").show();
                       $("#bookinfo").slideToggle("slow");
                     var array = data.split("|");
                     $("#isbn_no").val(array[0]);
                     $("#book_no").val(array[1]);
                      $("#title").val(array[2]);
                     $("#auther").val(array[3]);
                     $("#userType").val(array[4]);
                     $("#user").val(array[5]);
                      $("#issuedate").val(array[6]);
                     $("#duedate").val(array[7]);
                     $("#id").val(array[8]);
                     if(data==''){
                        $("#bookinfo").hide();
                        alert("Please Select Valid Book Details.");
                     }
                   },
                   error: function (jqXHR, exception) {
        var msg = '';
        if (jqXHR.status === 0) {
             $("#bookinfo").hide();
            msg = 'Not connect.\n Verify Network.';
        } else if (jqXHR.status == 404) {
             $("#bookinfo").hide();
            msg = 'Requested page not found. [404]';
        } else if (jqXHR.status == 500) {
             $("#bookinfo").hide();
          //  msg = 'Internal Server Error [500].';
              msg = 'Please Select Employee.';
        } else if (exception === 'parsererror') {
           $("#bookinfo").hide();
            msg = 'Requested JSON parse failed.';
        } else if (exception === 'timeout') {
           $("#bookinfo").hide();
            msg = 'Time out error.';
        } else if (exception === 'abort') {
           $("#bookinfo").hide();
            msg = 'Ajax request aborted.';
        } else {
           $("#bookinfo").hide();
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
                        window.location.href = _url + "/library/category/delete/" + id;
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
    $('.select2').select2();
    $('.dob').datepicker({
      autoclose: true,
      format:'dd-mm-yyyy'
    });
  });
</script>
@endsection
<!-- ./wrapper -->
