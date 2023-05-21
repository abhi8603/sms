@extends('../header')
@section('style')
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/bootstrap/dist/css/buttons.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/bootstrap/dist/css/rowReorder.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/bootstrap/dist/css/responsive.dataTables.min.css') }}">
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
          <li><a href="#"><i class="fa fa-dashboard"></i>Subject</a></li>
        <li class="active">View-Subject</li>
      </ol>
    </section>

    <!-- Main content -->
      <section class="content">
          @include('notification.notify')
    <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Subject</h3>

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
                             <h3 class="box-title">View Subject</h3>
                           </div>
                           <!-- /.box-header -->
                           <!-- form start -->
                           <form role="form" method="post" enctype="multipart/form-data" action="{{url('subject/update')}}">
                          <div class="box-body">
                            @foreach($subject as $subject)
                            <div class="form-group">
                              <label for="exampleInputEmail1">Subject Name<span style="color:red;"> *</span></label>
                              <input type="text" class="form-control" id="subjectname" value="{{$subject->subject_name}}" name="subject_name" placeholder="Subject Name">
                              <input type="hidden" class="form-control" id="id" value="{{$subject->id}}" name="id" placeholder="id">

                            </div>
                            <div class="form-group">
                              <label for="exampleInputEmail1">Subject Code<span style="color:red;"> *</span></label>
                              <input type="text" class="form-control" id="subjectcode" value="{{$subject->subject_code}}" name="subject_code" placeholder="Subject Code">
                            </div>
                            <div class="form-group">
                              <label for="exampleInputEmail1">Graded Subject<span style="color:red;"> *</span></label>
                              <select class="form-control select2" name="elective" style="width: 100%;">
                                  <option  value="">Please select</option>
                                  <option value="Yes" @if($subject->elective=='Yes') selected @endif>Yes</option>
                                  <option value="No" @if($subject->elective=='No') selected @endif>No</option>
                           </select>
                         </div>
                         <div class="form-group">
                           <label for="exampleInputPassword1">Description</label>
                           <textarea class="form-control" rows="3" name="description" placeholder="Description">{{$subject->discripton}}</textarea>
                         </div>
                         @endforeach
       </div>
         <div class="box-footer">
       <button type="submit" class="btn btn-primary">Update</button>
         <input type="hidden" name="_token" value="{{ csrf_token() }}">
     </div>
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
<script src="{{ URL::asset('assets/bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/select2/dist/js/select2.full.min.js') }}"></script>

<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
  })
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
