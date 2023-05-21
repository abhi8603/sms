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
        <li><a href="#"><i class="fa fa-dashboard"></i>Student</a></li>

        <li class="active">Student List</li>
      </ol>
    </section>

    <!-- Main content -->
      <section class="content">
          @include('notification.notify')
    <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Search Student</h3>

              <div class="box-tools pull-right">
              <a href="{{ URL::asset('assets/import/import_students.csv') }}" class="btn btn-warning">Download Sample<a/>
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button style="display:none;" type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="box box-primary">
                           <form role="form" method="post" enctype="multipart/form-data" action="{{url('student/student_bulk_upload')}}">
                          <div class="box-body">
                             <div class="col-md-4">
                            <div class="form-group">
                              <label for="exampleInputEmail1">Class <span style="color:red;"> *</span></label>
                              <select class="form-control select2" id="course" name="class" style="width: 100%;">
                                  <option value="" selected="selected">Please select Class</option>
                                <?php foreach ($course as $course): ?>
                                      <option value="{{$course->id}}">{{$course->course_name}}</option>
                                <?php endforeach; ?>
                           </select>
                         </div>
                       </div>
                       <div class="col-md-4">
                         <div class="form-group">                          
                             <label for="exampleInputEmail1">Section<span style="color:red;"> *</span></label>
                             <select class="form-control select2" name="section" id="batch" style="width: 100%;" required>
                               <option value="" selected="selected">Please select Section</option>
                          </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                    <div class="form-group">                      
                      <label for="exampleInputEmail1">Academic Year <span style="color:red;"> *</span></label>
                      <select class="form-control select2" name="accadmicyear" style="width: 100%;" required>
                          <option value="" selected="selected">Please select</option>
                          <?php foreach ($accadmicyear as $accadmicyear): ?>
                                <option value="{{$accadmicyear->startyear}}-{{$accadmicyear->endyear}}">{{$accadmicyear->startyear}} - {{$accadmicyear->endyear}}</option>
                          <?php endforeach; ?>
                   </select>
                 </div>
               </div>
               <div class="col-md-12">
               <div class="form-group"> 
               <label>Upload CSV File <span style="color:red;"> *</span></label>
               <input type="file" name="file" class="form-control" required>
               </div>
               </div>
               <div class="col-md-4">
               <div class="form-group">
                 
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
                      <h3 class="box-title">Instruction</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                    <ul>
                    <li>Fill all the columns.</li>
                    <li><span style="color:red;">*</span> marks are mendatory fields.</li>
                    <li>Student Data will be uploaded Class/section wise.</li>
                    <li>Select Class,section and adacmic year to upload student data</li>
                    <li>Admission date,DoB will be in the format of dd-mm-yyyy. ex- 25-01-1993.</li>
                    <li>For Gender fill Male for Male,Female for Female.</li>
                    <li>For students,Student Admission No will be his username and password for login in Student Portal</li>
                    <li>For Parents,Parents Mobile No will be his username and password for login in Parent Portal</li>
                    </ul>

                    </div>
                    </div>
                    </div>



                <div class="col-md-12">
                  <div class="box box-info">
                    <div class="box-header">
                      <h3 class="box-title">Sample</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                    
                      <table id="example" class="table table-striped table-bordered" >
                        <thead>
                  <tr>
                  <th>Admission No. <span style="color:red;"> * </span></th>
                  <th>Joining Date</th>      
                  <th>Roll No.</th>   
                  <th>Student Full Name <span style="color:red;"> * </span></th>                        
                  <th>Admission Date <span style="color:red;"> * </span></th>                 
			      <th>Gender <span style="color:red;"> * </span></th>
                  <th>DoB <span style="color:red;"> * </span></th>
                  <th>Blood group</th> 
                  <th>Birth Place</th> 
                  <th>Nationality</th> 
                  <th>Category <span style="color:red;"> * </span></th>
                  <th>Religion <span style="color:red;"> * </span></th>
                  <th>Addhar No</th> 
                  <th>Previous School</th> 
                  <th>Previous School Address</th>
                  <th>Previous Qualifications</th> 
                  <th>Permanent Address <span style="color:red;"> * </span></th>
                  <th>Present Address <span style="color:red;"> * </span></th>
                  <th>City <span style="color:red;"> * </span></th>
                  <th>Pin <span style="color:red;"> * </span></th>
                  <th>Country <span style="color:red;"> * </span></th>
                  <th>State <span style="color:red;"> * </span></th>
                  <th>Phone <span style="color:red;"> * </span></th>
                  <th>Father Name <span style="color:red;"> * </span></th>
                  <th>father Phone <span style="color:red;"> * </span></th>
                  <th>Father Aadhar</th>
                  </tr>
                </thead>
                        <tbody>
                         
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
$(document).ready(function() {
   $.extend($.fn.dataTable.defaults, {
 dom: 'Bfrtip'
});
   $('#example').DataTable( {

       buttons: [
           'copy', 'csv', 'excel', 'pdf', 'print'
       ],
       pageLength: 100,
      
       "scrollX": true


   } );
   } );

</script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
  })
</script>

@endsection
<!-- ./wrapper -->
