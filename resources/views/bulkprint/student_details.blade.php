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
    
    <section class="content">
        @include('notification.notify')
  <div class="box box-default">
    <!-- Main content -->
    <div class="box-header with-border">
      <h3 class="box-title">Photo Upload</h3>
      <div class="box-tools pull-right">
        <a href="{{url('search/upload')}}" class="btn btn-info" role="button"><i class="far fa-arrow-to-left"></i>Back</a>
      </div>
    </div>
        <div class="row">
          <div class="col-md-12">
            <!-- Custom Tabs -->
            <div class="nav-tabs-custom">
              <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                  <div class="box-body">
                    <div class="row">
                      <div class="col-md-12">
                        <!-- /.form-group -->
                        <div class="box box-primary">
                          <div class="box-header with-border">
                            <h3 class="box-title">Student Details</h3>
                          </div>
                          <form role="form" method="post" enctype="multipart/form-data" action="{{url('upload/photo')}}">
                            <div class="box-body">
                              <div class="row">
                                <div class="col-md-6"> 
                                <div class="form-group ">
                                  <label for="acadmic_year">Session<span style="color:red;"> *</span></label>
                                  <select class="form-control" id="acadmic_year" name="acadmic_year" style="width: 100%;">
                                  <option value="">==SELECT==</option>
                                   <?php foreach ($sessionList as $value): ?>
                                      <option value="<?=$value['startyear']?>-<?=$value['endyear']?>" <?=(isset($studentDetails['acadmic_year']))?$studentDetails['acadmic_year']==$value['startyear'].'-'.$value['endyear']?"SELECTED":"":"";?>><?=$value['startyear'].'-'.$value['endyear']?></option>
                                    <?php endforeach; ?>
                                   </select>
                                </div>
                                </div>
                                <div class="col-md-6"> 
                                <div class="form-group ">
                                  <label for="course">Course Name<span style="color:red;"> *</span></label>
                                  <select class="form-control" id="course" name="course" style="width: 100%;">
                                  <option value="">==SELECT==</option>
                                   <?php foreach ($courseList as $val): ?>
                                      <option value="<?=$val['id']?>" <?=(isset($studentDetails['course']))?$studentDetails['course']==$val["id"]?"SELECTED":"":"";?>><?=$val['course_name']?></option>
                                    <?php endforeach; ?>
                                   </select>
                                </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6"> 
                                  <div class="form-group">
                                    <label for="registration no">Registration No<span style="color:red;"> *</span></label>
                                      <input type="text" class="form-control" name="reg_no" id="reg_no" value="<?=(isset($studentDetails['reg_no']))?$studentDetails['reg_no']:"";?>">
                                  </div>
                                </div>
                                <div class="col-md-6"> 
                                  <div class="form-group">
                                    <label for="roll_no">Roll No<span style="color:red;"> *</span></label>
                                      <input type="text" class="form-control" name="roll_no" id="roll_no" value="<?=(isset($studentDetails['roll_no']))?$studentDetails['roll_no']:"";?>">
                                  </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6"> 
                                  <div class="form-group">
                                    <label for="stu_name">Student Name<span style="color:red;"> *</span></label>
                                      <input type="text" class="form-control" name="stu_name" id="stu_name" value="<?=(isset($studentDetails['stu_name']))?$studentDetails['stu_name']:"";?>">
                                  </div>
                                </div>
                                <div class="col-md-6"> 
                                  <div class="form-group">
                                    <label for="gender">Gender<span style="color:red;"> *</span></label>
                                      <input type="text" class="form-control" name="gender" id="gender" value="<?=(isset($studentDetails['gender']))?$studentDetails['gender']:"";?>">
                                  </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6"> 
                                  <div class="form-group">
                                    <label for="stu_name">Upload Photo(Only JPEG ,JPG File)<span style="color:red;"> *</span></label>
                                      <input type="file" id="photo_path" name="photo_path" class="form-control" value="" >
                                  </div>
                                </div> 
                            </div>
                            <div class="row">
                                <div class="col-md-6"> 
                                  <div class="form-group">
                                    <label for="stu_name">&nbsp;&nbsp;</label>
                                    <button type="submit" id="upload_photo" name="upload_photo" class="btn btn-primary">Upload Photo</button>
                                  </div>
                                </div>
                            </div>
                        <input type="hidden" name="batch" id="batch" value="<?=(isset($studentDetails['batch']))?$studentDetails['batch']:"";?>" >
                         <input type="hidden" name="student_photo_id" id="student_photo_id" value="<?=(isset($student_photo['student_photo_id']))?$student_photo['student_photo_id']:"";?>" >
                        <input type="hidden" name="id" id="id" value="<?=(isset($studentDetails['id']))?$studentDetails['id']:"";?>" >
                        <input type="hidden" name="reg_no" id="reg_no" value="<?=(isset($studentDetails['reg_no']))?$studentDetails['reg_no']:"";?>" >
    
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    </form>
                  </div>
                </div>
                </div>
                </div>
                </div>
                                <!-- /.tab-pane -->
                <div class="tab-pane" id="tab_2">
                   <div class="box-body">
                    <div class="row">
                        </div>
                        </div>

                        </div>
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
<script type="text/javascript">
  $(document).ready(function(){
    $("#photo_path").change(function() {
      var input = this;
      var ext = $(this).val().split('.').pop().toLowerCase();
      if($.inArray(ext, ['jpeg','jpg']) == -1) {
          $("#photo_path").val("");
          alert('invalid Document type');
      }if (input.files[0].size > 1048576) { // 1MD = 1048576
          $("#photo_path").val("");
          alert("Try to upload file less than 1MB!"); 
      }
    });
    $('#upload_photo').click(function(){
       var process=true;
       var photo_path = $('#photo_path').val();
       if(photo_path==""){
          $("#photo_path").css({"border-color":"red"});
          $("#photo_path").focus();
          return false;
       }
       return process;
      });
    $("#photo_path").change(function(){$(this).css('border-color','');});
  });
</script>
@endsection
<!-- ./wrapper -->
