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
        <li><a href="#"><i class="fa fa-dashboard"></i> Academic</a></li>
          <li><a href="#"><i class="fa fa-dashboard"></i>  Course/Class & Batch/Section</a></li>
        <li class="active">add-Class/Course/subject</li>
      </ol>
    </section>

    <!-- Main content -->
      <section class="content">
          @include('notification.notify')
    <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Class</h3>

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
                             <h3 class="box-title">Add Class</h3>
                           </div>
                           <!-- /.box-header -->
                           <!-- form start -->
                           <form role="form" method="post" enctype="multipart/form-data" action="{{url('course/new')}}">
                          <div class="box-body">
                            <div class="form-group">
                              <label for="exampleInputEmail1">Class Name<span style="color:red;"> *</span></label>
                              <input type="text" class="form-control" id="coursename" name="coursename" placeholder="Class Name" required>
                            </div>
                            <div class="form-group">
                              <label for="exampleInputEmail1">Description<span style="color:red;"> *</span></label>
                              <input type="text" class="form-control" id="description" name="description" placeholder="Description" required>
                            </div>
                            <div class="form-group">
                              <label for="exampleInputEmail1">Code<span style="color:red;"> *</span></label>
                              <input type="text" class="form-control" id="code" name="code" placeholder="Code" required>
                            </div>
                            <div class="form-group">
                              <label for="exampleInputEmail1">Minimum Attendance Percentage<span style="color:red;"> *</span></label>
                              <input type="text" class="form-control" id="map" onkeypress="return isNumber(event)" name="map" placeholder="Minimum Attendance Percentage" required>
                            </div>
                            <div class="form-group">
                              <label for="exampleInputEmail1">Attendance Type<span style="color:red;"> *</span></label>
                              <select class="form-control select2" name="atttype" style="width: 100%;" required>
                                  <option value="" selected="selected">Please select</option>
                                  <option value="Daily">Daily</option>
                                  <option value="Subject Wise">Subject Wise</option>
                           </select>
                         </div>
                         <div class="form-group">
                           <label for="exampleInputEmail1">Total Working Days<span style="color:red;"> *</span></label>
                           <input type="text" class="form-control" id="twd" onkeypress="return isNumber(event)" name="twd" placeholder="Total Working Days" required>
                         </div>
                         <div class="form-group">
                           <label for="exampleInputEmail1">Syllabus Name<span style="color:red;"> *</span></label>
                           <select class="form-control select2" name="gt" style="width: 100%;" required>
                               <option value="" selected="selected">Please select</option>
                               <option value="GPA">GPA</option>
                               <option value="CCA">CCA</option>
                                <option value="CISCE">CISCE</option>
                        </select>
                         </div>
                         <div class="form-group">
                           <label for="exampleInputEmail1">Precedence<span style="color:red;"> *</span></label>
                           <select class="form-control select2" name="precedence" style="width: 100%;" required>
                               @for($i=1;$i<=20;$i++)
                               <option value="{{$i}}">{{$i}}</option>                              
                              @endfor
                        </select>
                         </div>
                           </div>
                             <!-- /.box-body -->

                             <div class="box-footer">
                               <button type="submit" class="btn btn-primary">Save</button>
                             </div>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                           </form>
                         </div>

                  <!-- /.form-group -->
                </div>

                <div class="col-md-7">
                  <div class="box box-info">
                    <div class="box-header">
                      <h3 class="box-title">Course OR Class List</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                      <table id="example" class="table table-striped table-bordered display " style="width:100%">
                        <thead>
                        <tr>
                          <th>Sl.No</th>
                          <th>Course/Class</th>
                          <th>Attendance Type</th>
                          <th>Minimum Attendance</th>
                          <th>Total Working Days</th>
                          <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                          @php $i=0; @endphp
                          @foreach($courses as $courses)
                            @php $i++ @endphp
                        <tr>
                          <td>@php echo $i @endphp</td>
                          <td>{{$courses->course_name}}</td>
                          <td>{{$courses->attendancetype}}</td>
                          <td>{{$courses->min_atten_percent}}</td>
                          <td>{{$courses->tot_work_day}}</td>
                          <td>
                        <div class="btn-group">
                          <button type="button" class="btn btn-default  btn-flat dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                          </button>
                          <ul class="dropdown-menu" role="menu" title="Action">
                            <li><a href="{{url('add-course/view/'.$courses->id)}}" title="Edit"><i  class="fa fa-eye" style="color: #897df8e6";></i></a></li>
                            <li><a class="tFileDelete" href="" id="{{$courses->id}}" title="Delete"><i class="fa fa-trash" style="color: red";></i></a></li>

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
                        window.location.href = _url + "/add-course/delete/" + id;
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
