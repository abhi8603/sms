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
          <li><a href="#"><i class="fa fa-dashboard"></i>  Course & Batch</a></li>
        <li class="active">add-course</li>
      </ol>
    </section>

    <!-- Main content -->
      <section class="content">
          @include('notification.notify')
    <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Course</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button style="display:none;" type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-8 offset-md-3">

                  <!-- /.form-group -->
                  <div class="box box-primary">
                           <div class="box-header with-border">
                             <h3 class="box-title">View Course</h3>
                           </div>
                           <!-- /.box-header -->
                           <!-- form start -->
                           <form role="form" method="post" enctype="multipart/form-data" action="{{url('course/update')}}">
                          <div class="box-body">
                            @foreach($viewcourse as $viewcourse)
                            <div class="form-group">
                              <label for="exampleInputEmail1">Course Name<span style="color:red;"> *</span></label>
                              <input type="text" class="form-control" id="coursename" value="{{$viewcourse->course_name}}" name="coursename" placeholder="Course Name" required>
                                <input type="hidden" class="form-control" id="coursename" value="{{$viewcourse->id}}" name="id" placeholder="id">
                            </div>
                            <div class="form-group">
                              <label for="exampleInputEmail1">Description<span style="color:red;"> *</span></label>
                              <input type="text" class="form-control" id="description" value="{{$viewcourse->description}}" name="description" placeholder="Description" required>
                            </div>
                            <div class="form-group">
                              <label for="exampleInputEmail1">Code<span style="color:red;"> *</span></label>
                              <input type="text" class="form-control" id="code" name="code" value="{{$viewcourse->code}}" placeholder="Code" required>
                            </div>
                            <div class="form-group">
                              <label for="exampleInputEmail1">Minimum Attendance Percentage<span style="color:red;"> *</span></label>
                              <input type="text" class="form-control" id="map" onkeypress="return isNumber(event)" value="{{$viewcourse->min_atten_percent}}" name="map" placeholder="Minimum Attendance Percentage" required>
                            </div>
                            <div class="form-group">
                              <label for="exampleInputEmail1">Attendance Type<span style="color:red;"> *</span></label>
                              <select class="form-control select2" name="atttype" style="width: 100%;" required>
                                  <option value="">Please select</option>
                                  <option value="Daily" @if($viewcourse->attendancetype=="Daily") selected @endif>Daily</option>
                                  <option value="Subject Wise" @if($viewcourse->attendancetype=="Subject Wise") selected @endif>Subject Wise</option>
                           </select>
                         </div>
                         <div class="form-group">
                           <label for="exampleInputEmail1">Total Working Days<span style="color:red;"> *</span></label>
                           <input type="text" class="form-control" id="twd" value="{{$viewcourse->tot_work_day}}" onkeypress="return isNumber(event)" name="twd" placeholder="Total Working Days" required>
                         </div>
                         <div class="form-group">
                           <label for="exampleInputEmail1">Syllabus Name<span style="color:red;"> *</span></label>
                           <select class="form-control select2" name="gt" style="width: 100%;" required>
                               <option value="" >Please select</option>
                               <option value="GPA"  @if($viewcourse->syllabus_name=="GPA") selected @endif>GPA</option>
                               <option value="CCA"  @if($viewcourse->syllabus_name=="CCA") selected @endif>CCA</option>
                               <option value="CCA"  @if($viewcourse->syllabus_name=="CISCE") selected @endif>CISCE</option>
                        </select>
                         </div>
@endforeach
                           </div>
                           <div class="form-group">
                           <label for="exampleInputEmail1">Precedence<span style="color:red;"> *</span></label>
                           <select class="form-control select2" name="gt" style="width: 100%;" required>
                               @for($i=1;$i<=20;$i++)
                               <option value="{{$i}}" @if($viewcourse->precedence== $i) selected @endif>{{$i}}</option>                              
                              @endfor
                        </select>
                         </div>
                             <!-- /.box-body -->

                             <div class="box-footer">
                               <button type="submit" class="btn btn-primary">Update</button>
                             </div>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                           </form>
                         </div>

                  <!-- /.form-group -->
                </div>
              </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection
{{--External Style Section--}}
@section('script')
<script src="{{ URL::asset('assets/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
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
