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
        <li><a href="#"><i class="fa fa-dashboard"></i> Examination</a></li>

        <li class="active">Result Release</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        @include('notification.notify')
        <div class="box box-default">
               <div class="box-header with-border">
               <h3 class="box-title">Result Release</h3>

                <div class="box-tools pull-right">

                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  <button style="display:none;" type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                </div>
              </div>
          <!-- /.box-header -->
            <div class="box-body">
            <div class="row">
              <div class="col-md-12">
                <form method="post" action="{{url('Exam/result/release/save')}}">

                <!-- /.form-group -->
                <div class="box box-primary">
                         <div class="box-header with-border">
                         </div>
                          <div class="box-body">
                             <div class="col-md-3">

                              <div class="form-group">
                                <label>Session</label>
                                <select class="form-control select2" name="academicyear" id="accadmicyear" style="width: 100%;" required>
                                    <option value="" selected="selected">Please Select</option>
                                    <?php foreach ($accadmicyear as $accadmicyear): ?>
                                         <option value="{{$accadmicyear->startyear}}-{{$accadmicyear->endyear}}">{{$accadmicyear->startyear}}-{{$accadmicyear->endyear}}</option>
                                    <?php endforeach; ?>
                              </select>
                           </div>
                         </div>
                           <div class="col-md-3">
                              <div class="form-group">
                                <label>Exam</label>
                                <select class="form-control select2" name="exam" id="exam" style="width: 100%;" required>
                                    <option value="" selected="selected">Please Select</option>
                                    <?php foreach ($exam as $exam): ?>
                                         <option selected value="{{$exam->id}}">{{$exam->exam_name}}</option>
                                    <?php endforeach; ?>
                              </select>
                           </div>
                         </div>
                            <div class="col-md-3">

                              <div class="form-group">
                                <label>Class/Course</label>
                                <select class="form-control select2" id="courses"   name="course" style="width: 100%;" required>
                                    <option value="" selected="selected">Please select Course</option>
                                      <?php
                                      foreach($course as $row)
                                      {
                                        ?>
                                        <option value="<?php echo $row->id ?>"><?php echo $row->course_name; ?></option>

                                        <?php
                                      }
                                      ?>
                             </select>
                           </div>
                         </div>

                           <div class="col-md-3">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" >
                            <input type="submit" class="btn btn-info" value="Release" style="margin-top:20px;" />
                           </div>


                          </div>
  </div>
  <div class="box box-info">
           <div class="box-header with-border">
             <h3 class="box-title">Result Release List</h3>
           </div>
            <div class="box-body">
              <table id="example" class="table table-striped table-bordered display" style="width:100%">
                <thead>
                  <tr>
                  <th>Sl. No.</th>
                  <th>Session</th>
                  <th>Class</th>
                  <th>Exam</th>
                  <th>Status</th>
                  <th>Released By</th>
                  <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @php $i=0; @endphp
                  @if(!empty($result_release))
                  <?php foreach ($result_release as $key => $value):  $i++; ?>
                    <tr>
                      <td>{{$i}}</td>
                      <td>{{$value->session}}</td>
                      <td>{{$value->course_name}}</td>
                      <td>{{$value->exam_name}}</td>
                      <td>{{$value->status==1 ? "Released" :"Canceled"}}</td>
                      <td>{{$value->release_by}}</td>
                      <td><a href="{{url('Exam/result/release/cancel/'.$value->id.'/'.$value->session)}}" class="btn btn-danger">Cancel</a></td>
                    </tr>
                  <?php endforeach; ?>

                  @endif

                </tbody>
              </table>
            </div>
          </div>


</form>

</div>
</div>
</div>

    </div>


</section>
</div>
</form>

@endsection
{{--External Style Section--}}
@section('script')
<script src="{{ URL::asset('assets/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
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
<script src="{{ URL::asset('assets/bower_components/jquery/dist/bootbox.min.js') }}"></script>
 <script src="{{ URL::asset('assets/plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>
 <script src="{{ URL::asset('assets/bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
<script>
        $(document).ready(function () {
            /*For Delete Application Info*/
            $(".reopen").click(function (e) {
                e.preventDefault();
                var id = this.id;
                //alert(id);
                bootbox.confirm("Are you sure?", function (result) {
                    if (result) {
                        var _url = $("#_url").val();
                        window.location.href = _url + "/exam/marksSubmit/reopen/" + id;
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
  });
</script>
@endsection
<!-- ./wrapper -->
