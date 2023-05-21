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
        <li class="active">Issue Books</li>
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
                <li class="active"><a href="#tab_1" data-toggle="tab">Issue Book</a></li>
                <li><a href="#tab_2" data-toggle="tab">Issue List</a></li>

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
                                   <h3 class="box-title">Issue Book</h3>
                                 </div>
                                 <!-- /.box-header -->
                                 <!-- form start -->
                                 <form role="form" method="post" enctype="multipart/form-data" action="{{url('library/bookissue/issue')}}">
                                   <div class="box-body">
                                     <div class="col-md-12">
                                       <div class="form-group col-md-8">
                                         <label for="Book Cost">Book<span style="color:red;"> *</span></label>
                                         <select class="form-control select2" id="book" name="book" style="width: 100%;" required>
                                             <option value="" selected="selected">Search book by Book No,Name,Auther,ISBN No</option>
                                          <?php foreach ($booklist as $booklist): ?>
                                              <option value="{{$booklist->id}}">{{$booklist->book_no}} - {{$booklist->	title}} - {{$booklist->auther}} - {{$booklist->bookisbn_no}}</option>
                                          <?php endforeach; ?>
                                      </select>
                                       </div>
                                       <div class="col-md-12 callout callout-info" id="bookinfo" style="display:none;">
                                         <div class="form-group col-md-3">
                                          <label>ISBN No.</label>
                                          <input type="text" class="form-control" id="isbn_no" name="isbn_no" value="" readonly>
                                         </div>
                                         <div class="form-group col-md-3">
                                          <label >Book No.	</label>
                                          <input type="text" class="form-control" id="book_no" name="book_no" value="" readonly>
                                          </div>
                                         <div class="form-group col-md-3">
                                          <label >Title:</label>
                                          <input type="text" class="form-control" id="title" name="title" value="" readonly>
                                         </div>
                                         <div class="form-group col-md-3">
                                          <label >Author</label>
                                          <input type="text" class="form-control" id="auther" name="auther" value="" maxlength="10" readonly>
                                         </div>
                                         <div class="form-group col-md-3">
                                          <label >Edition</label>
                                          <input type="text" class="form-control" id="edition" name="edition" value="" maxlength="10" readonly>
                                         </div>
                                         <div class="form-group col-md-3">
                                          <label >Category</label>
                                          <input type="text" class="form-control" id="category" name="category" value="" maxlength="10" readonly>
                                         </div>
                                         <div class="form-group col-md-3">
                                          <label >Publisher</label>
                                          <input type="text" class="form-control" id="publisher" name="publisher" value="" maxlength="10" readonly>
                                         </div>
                                         <div class="form-group col-md-3">
                                          <label >No of Copies</label>
                                          <input type="text" class="form-control" id="noofcopy" name="noofcopy" value="" maxlength="10" readonly>
                                         </div>
                                         <div class="form-group col-md-3">
                                          <label >Shelf No</label>
                                          <input type="text" class="form-control" id="shelf_no" name="shelf_no" value="" maxlength="10" readonly>
                                         </div>
                                         <div class="form-group col-md-3">
                                          <label >Book Position</label>
                                          <input type="text" class="form-control" id="book_postion" name="book_postion" value="" maxlength="10" readonly>
                                         </div>
                                         <div class="form-group col-md-3">
                                          <label >Cost</label>
                                          <input type="text" class="form-control" id="cost" name="cost" value="" maxlength="10" readonly>
                                         </div>
                                         <div class="form-group col-md-3">
                                          <label >Language</label>
                                          <input type="text" class="form-control" id="language" name="language" value="" maxlength="10" readonly>
                                         </div>
                                         <div class="form-group col-md-3">
                                          <label >Condition</label>
                                          <input type="text" class="form-control" id="condition" name="condition" value="" maxlength="10" readonly>
                                         </div>
                                         <div class="form-group col-md-3">
                                          <label >Status</label>
                                          <input type="text" class="form-control" id="status" name="status" value="" maxlength="10" readonly>
                                         </div>

                                       </div>
                                <div class="form-group col-md-8">
                                <label >User Type<span style="color:red;"> *</span></label>
                                <select id="utype" name="utype" class="form-control select2" style="width: 100%;">
                                <option selected="selected">Please Select</option>
                                <option value="student">Student</option>
                                <option value="employee">Employee</option>
                                </select>
                                </div>

                                <div id="stdnt" class="form-group col-md-8">
                                  <label >Student<span style="color:red;"> *</span></label>
                                  <select id="student" name="reg_no" class="form-control select2" style="width: 100%;">
                                    <option value="0" selected="selected">Please Select</option>
                                  <?php foreach ($students as $students): ?>
                                      <option value="{{Crypt::encrypt($students->reg_no)}}">{{$students->stu_name}} - {{$students->reg_no}}</option>
                                  <?php endforeach; ?>
                                  </select>
                                </div>
                                <div id="emp" class="form-group col-md-8">
                                  <label >Employee <span style="color:red;"> *</span></label>

                                  <select id="reg_emp" name="emp_code" class="form-control select2" style="width: 100%;">
                                    <option value="0" selected="selected">Please Select</option>
                                  <?php foreach ($employess as $employess): ?>
                                      <option value="{{$employess->empcode}}">{{$employess->fname}} {{$employess->mname}} {{$employess->lname}} - {{$employess->empcode}}</option>
                                  <?php endforeach; ?>
                                  </select>
                                </div>

                                  <div class="col-md-12 callout callout-info" id="stuinfo" style="display:none;">
                                    <div class="form-group col-md-4">
                                     <label >Student Name</label>
                                     <input type="text" class="form-control" id="student_name" name="stu_name" value="" readonly>
                                    </div>
                                    <div class="form-group col-md-4">
                                     <label >Registration No.</label>
                                     <input type="text" class="form-control" id="reg_no" name="reg_no" value="" readonly>
                                    </div>
                                    <div class="form-group col-md-4">
                                     <label >Class/Course</label>
                                     <input type="text" class="form-control" id="classs" name="course" value="" readonly>
                                     <input type="hidden" class="form-control" id="course_code" name="course_code" value="" readonly>
                                    </div>
                                    <div class="form-group col-md-4">
                                     <label >Section/Batch</label>
                                     <input type="text" class="form-control" id="batch" name="batch" value="" maxlength="10" readonly>
                                     <input type="hidden" class="form-control" id="batch_code" name="batch_code" value="" maxlength="10" readonly>
                                    </div>
                                    <div class="form-group col-md-4">
                                     <label >Name of Guardian</label>
                                     <input type="text" class="form-control" id="parents" name="parent_name" maxlength="10" value="" readonly>
                                    </div>
                                    <div class="form-group col-md-4">
                                     <label >Contact No.</label>
                                     <input type="text" class="form-control" id="contact" name="contact_no" value="" readonly>
                                    </div>
                                  </div>
                                  <div class="col-md-12 callout callout-info" id="empinfo" style="display:none;">
                                    <div class="form-group col-md-6">
                                     <label>Name of Employee</label>
                                     <input type="text" class="form-control" id="emp_name" name="emp_name" value="" readonly>
                                    </div>
                                    <div class="form-group col-md-6">
                                     <label >Employee Code	</label>
                                     <input type="text" class="form-control" id="emp_code" name="emp_code" value="" readonly>
                                     </div>
                                    <div class="form-group col-md-6">
                                     <label >Department:</label>
                                     <input type="text" class="form-control" id="department" name="department" value="" readonly>
                                    </div>
                                    <div class="form-group col-md-6">
                                     <label >Designation</label>
                                     <input type="text" class="form-control" id="designation" name="designation" value="" maxlength="10" readonly>
                                    </div>
                                  </div>
                                  <div class="form-group col-md-6">
                                          <label>Issue Date</label>
                                          <div class="input-group date">
                                            <div class="input-group-addon">
                                              <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" class="form-control pull-right dob" value="{{ old('dob') }}" name="issuedate">
                                          </div>
                                          <!-- /.input group -->
                                        </div>
                                        <div class="form-group col-md-6">
                                                <label>Due Date</label>
                                                <div class="input-group date">
                                                  <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                  </div>
                                                  <input type="text" class="form-control pull-right dob" value="{{ old('dob') }}" name="duedate">
                                                </div>
                                                <!-- /.input group -->
                                              </div>
                                   </div>
                                 </div>
                                   <div class="box-footer">
                                    <!-- <button type="submit" class="btn btn-primary">Save</button>-->
                                    <input type="submit" id="submit" class="btn btn-primary" name="submit" value="Issue Book">
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
                            <h3 class="box-title">Book Issued List</h3>
                          </div>
                          <!-- /.box-header -->
                          <div class="box-body">
                            <table id="example" class="table table-striped table-bordered display" style="width:100%">
                              <thead>
                              <tr>
                                <th>Sl.No</th>
                                <th>User Type</th>
                                <th>User</th>
                                <th>Book No</th>
                                <th>Title</th>
                                <th>Issue Date</th>
                                <th>Due Date</th>
                              </tr>
                              </thead>
                              <tbody>
                                @php $i=0; @endphp
                                <?php foreach ($issuebooklist as $issuebooklist): ?>
                                    @php $i++; @endphp
                                  <tr>
                                    <td>@php echo $i; @endphp</td>
                                    <td>{{$issuebooklist->usertype}}</td>
                                    <td>{{$issuebooklist->name}} - {{$issuebooklist->reg_no}}</td>
                                    <td>{{$issuebooklist->book_id}}</td>
                                    <td>{{$issuebooklist->book_name}}</td>
                                    <td>{{$issuebooklist->issue_date}}</td>
                                    <td>{{$issuebooklist->due_date}}</td>
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
           /*For Details Loading*/
           $("#book").change(function(){
             $("#bookinfo").hide();
               var id = $(this).val();
               var _url = $("#_url").val();
               var dataString = 'eid=' + id;
               $.ajax
               ({
                   type: "POST",
                   url: _url + '/library/bookissue/bookinfo',
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
                     $("#edition").val(array[4]);
                     $("#category").val(array[5]);
                      $("#publisher").val(array[6]);
                     $("#noofcopy").val(array[7]);

                     $("#shelf_no").val(array[8]);
                     $("#book_postion").val(array[9]);
                      $("#cost").val(array[10]);
                     $("#language").val(array[11]);
                     $("#condition").val(array[12]);
                     if(array[13]=='0'){
                     $("#status").val("Available");
                   }else {
                      $("#status").val("Issued");
                   }
                   var cnt=array[14];
                  if(array[14]>=array[7]){
                    alert('All Books are Issued.Please Try With another Book No.');
                      $("#status").val("Issued");
                       $("#submit").attr("disabled", true);
                        $("#utype").attr("disabled", true);
                  }else{
                    $("#submit").removeAttr("disabled");
                      $("#utype").removeAttr("disabled");
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
              msg = 'Please Select Book.';
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

           $("#reg_emp").change(function(){
             $("#empinfo").hide();
               var id = $(this).val();
               var _url = $("#_url").val();
               var dataString = 'eid=' + id;
               $.ajax
               ({
                   type: "POST",
                   url: _url + '/hr/employee/empinfo',
                   data: dataString,
                   cache: false,
                   success: function ( data ) {
                //    alert(data);
                  // $("#stuinfo").show();
                       $("#empinfo").slideToggle("slow");
                     var array = data.split("|");
                     $("#emp_code").val(array[0]);
                     $("#emp_name").val(array[1]);
                     $("#designation").val(array[3]);
                     $("#department").val(array[2]);
                   },
                   error: function (jqXHR, exception) {
        var msg = '';
        if (jqXHR.status === 0) {
             $("#empinfo").hide();
             $("#rollno").val('');
            msg = 'Not connect.\n Verify Network.';

        } else if (jqXHR.status == 404) {
             $("#empinfo").hide();
            msg = 'Requested page not found. [404]';

        } else if (jqXHR.status == 500) {
             $("#empinfo").hide();
          //  msg = 'Internal Server Error [500].';
              msg = 'Please Select Employee.';

        } else if (exception === 'parsererror') {
           $("#empinfo").hide();
            msg = 'Requested JSON parse failed.';

        } else if (exception === 'timeout') {
           $("#empinfo").hide();

            msg = 'Time out error.';
        } else if (exception === 'abort') {
           $("#empinfo").hide();

            msg = 'Ajax request aborted.';
        } else {
           $("#empinfo").hide();

            msg = 'Uncaught Error.\n' + jqXHR.responseText;
        }
        alert(msg);
    },
               });
           });

           $("#student").change(function(){
              $("#stuinfo").hide();
               var id = $(this).val();
               var _url = $("#_url").val();
               var dataString = 'eid=' + id;
               $.ajax
               ({
                   type: "POST",
                   url: _url + '/student/stuinfo',
                   data: dataString,
                   cache: false,
                   success: function ( data ) {
                  //  alert(data);
                  // $("#stuinfo").show();
                       $("#stuinfo").slideToggle("slow");


                     var array = data.split("|");

                     $("#reg_no").val(array[0]);
                     $("#student_name").val(array[1]);
                     $("#classs").val(array[3]);
                     $("#batch").val(array[2]);
                     $("#parents").val(array[4]);
                     $("#contact").val(array[5]);
                     $("#course_code").val(array[8]);
                      $("#batch_code").val(array[10]);


                   },
                   error: function (jqXHR, exception) {
        var msg = '';
        if (jqXHR.status === 0) {
             $("#stuinfo").hide();
             $("#rollno").val('');
            msg = 'Not connect.\n Verify Network.';

        } else if (jqXHR.status == 404) {
             $("#stuinfo").hide();
             $("#rollno").val('');
            msg = 'Requested page not found. [404]';

        } else if (jqXHR.status == 500) {
             $("#stuinfo").hide();
             $("#rollno").val('');
          //  msg = 'Internal Server Error [500].';
              msg = 'Please Select Student.';

        } else if (exception === 'parsererror') {
           $("#stuinfo").hide();
           $("#rollno").val('');
            msg = 'Requested JSON parse failed.';

        } else if (exception === 'timeout') {
           $("#stuinfo").hide();
           $("#rollno").val('');
            msg = 'Time out error.';
        } else if (exception === 'abort') {
           $("#stuinfo").hide();
           $("#rollno").val('');
            msg = 'Ajax request aborted.';
        } else {
           $("#stuinfo").hide();
           $("#rollno").val('');
            msg = 'Uncaught Error.\n' + jqXHR.responseText;
        }
        alert(msg);
    },
               });
           });

       });
   </script>
<script>
$(document).ready(function(){
$("#stdnt").hide();
$("#emp").hide();
$("#utype").change(function(){
     var types = $(this).val();
     if(types=='student'){
        $("#stdnt").show();
        $("#stdnt").fadeIn('slow');
        $("#emp").hide();
        $("#emp").fadeOut('slow');
        $("#stuinfo").hide();
        $("#stuinfo").fadeOut('slow');
        $("#empinfo").hide();
        $("#empinfo").fadeOut('slow');
      }else{
        $("#stdnt").hide();
        $("#dell").fadeOut('slow');
        $("#emp").show();
        $("#emp").fadeIn('slow');
        $("#stuinfo").hide();
        $("#stuinfo").fadeOut('slow');
        $("#empinfo").hide();
        $("#empinfo").fadeOut('slow');
      }
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
                        window.location.href = _url + "/library/books/delete/" + id;
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
