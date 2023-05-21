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
        <li><a href="#"><i class="fa fa-dashboard"></i> Academic</a></li>
          <li><a href="#"><i class="fa fa-dashboard"></i>  Class & Section</a></li>
        <li class="active">Class-Teacher Allocation</li>
      </ol>
    </section>

    <!-- Main content -->
      <section class="content">
          @include('notification.notify')
    <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Class Teacher Allocation</h3>

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
                             <h3 class="box-title">Class Teacher Allocation</h3>
                           </div>
                           <!-- /.box-header -->
                           <!-- form start -->
                           <form role="form" method="post" enctype="multipart/form-data" action="{{url('classTeacher/Allocation')}}">
                          <div class="box-body">
                            <div class="form-group">
                              <label for="exampleInputEmail1">Class<span style="color:red;"> *</span></label>
                              <select class="form-control select2" id="course" name="course" style="width: 100%;">
                                  <option selected="selected">Please select</option>
                                <?php foreach ($course as $course): ?>
                                    <option value="{{$course->id}}" >{{$course->course_name}}</option>
                                <?php endforeach; ?>
                           </select>
                         </div>
                         <div class="form-group">
                           <label for="exampleInputEmail1">Section<span style="color:red;"> *</span></label>
                           <select class="form-control select2" id="batch" name="batch" style="width: 100%;">
                               <option selected="selected">Please select</option>

                        </select>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Acadmic Year<span style="color:red;"> *</span></label>
                        <select class="form-control select2" name="addacadmicyear" style="width: 100%;">
                          <?php foreach ($Acadmicyear as $Acadmicyear): ?>
                              <option value="{{$Acadmicyear->startyear}}-{{$Acadmicyear->endyear}}" @if($Acadmicyear->status=='1') selected @endif >{{$Acadmicyear->startyear}}-{{$Acadmicyear->endyear}}</option>
                          <?php endforeach; ?>

                     </select>
                   </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Class Teacher<span style="color:red;"> *</span></label>
                        <select class="form-control select2" name="classteacher" style="width: 100%;">
                            <option selected="selected">Please select</option>
                            <?php foreach ($teachers as $teachers): ?>
                                <option value="{{$teachers->empcode}}" >{{$teachers->fname}} {{$teachers->mname}} {{$teachers->lname}} ({{$teachers->empcode}})</option>
                            <?php endforeach; ?>
                     </select>
                   </div>


       </div>
         <div class="box-footer">
       <button type="submit" class="btn btn-primary">Save</button>
        <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
     </div>
   </form>
   </div>

                  <!-- /.form-group -->
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-7">
                  <div class="box box-info">
                    <div class="box-header">
                      <h3 class="box-title">Task manager</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                      <table id="example" class="table table-striped table-bordered display" style="width:100%">
                        <thead>
                        <tr>
                          <th>Sl.No</th>
                          <th>Teacher</th>
                          <th>Course/Class</th>
                          <th>Batch/Section</th>
                          <th>Acadmic year</th>
                          <th>Action</th>

                        </tr>
                        </thead>
                        <tbody>
                          @php $i=0;@endphp
                          @foreach($allocatedTeachers as $allocatedTeachers)
                          @php $i++; @endphp
                        <tr>
                          <td><?php echo $i; ?></td>
                          <td>{{$allocatedTeachers->fname}} {{$allocatedTeachers->mname}} {{$allocatedTeachers->lname}} ({{$allocatedTeachers->empcode}})</td>
                          <td>{{$allocatedTeachers->course_name}}</td>
                          <td>{{$allocatedTeachers->batch_name}}</td>
                          <td>{{$allocatedTeachers->accadmicyear}}</td>
                          <td>
                        <div class="btn-group">
                          <button type="button" class="btn btn-default  btn-flat dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                          </button>
                          <ul class="dropdown-menu" role="menu" title="Action">
                            <li style="display:none;" ><a href="#" title="Edit"><i  class="fa fa-eye" style="color: #897df8e6";></i></a></li>
                            <li><a href="#" class="tFileDelete" id="{{$allocatedTeachers->id}}" title="Delete"><i class="fa fa-trash" style="color: red";></i></a></li>
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
                       //       alert(id);
                bootbox.confirm("Are you sure?", function (result) {
                    if (result) {
                        var _url = $("#_url").val();
                        window.location.href = _url + "/classTeacher/delete/" + id;
                    }
                });
            });

        });
    </script>
<script>
       $(document).ready(function () {

           /*For Details Loading*/
           $("#course").change(function () {
               var id = $(this).val();
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

                        // alert(data);
                         var list = $("#batch");
                      $(list).empty().append('<option selected="selected" value=""> Please Select </option>');

                     $(data).empty();
                      var emptycarno="No batch available for this course";
             if(data.length==""){
                        $("#subcategory").append('<option value="' +emptycarno +'">' + emptycarno + '</option>');
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
    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
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
