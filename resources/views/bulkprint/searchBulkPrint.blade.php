@extends('header')
@section('style')
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/select2/dist/css/select2.min.css') }}">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

@endsection
@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content">
        @include('notification.notify')
  <div class="box box-default">
    <!-- Main content -->
    <div class="box-header with-border">
      <h3 class="box-title">Search Id Card Data </h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        <button style="display:none;" type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
      </div>
    </div>
        <div class="row">
          <div class="col-md-12">
            <div class="box box-info">
              <div class="box-body">
                <form role="form" method="post" enctype="multipart/form-data" action="{{url('search')}}">
                  <div class="box-body">
                    <div clas="row">
                        <div class="col-md-4"> 
                        <div class="form-group ">
                          <label for="Event Type">Session<span style="color:red;"> *</span></label>
                          <select class="form-control" id="acadmic_year" name="acadmic_year" style="width: 100%;">
                          <option value="">==SELECT==</option>
                           <?php foreach ($sessionList as $value): ?>
                              <option value="<?=$value['startyear']?>-<?=$value['endyear']?>"><?=$value['startyear'].'-'.$value['endyear']?></option>
                            <?php endforeach; ?>
                           </select>
                        </div>
                        </div>
                        <div class="col-md-4"> 
                        <div class="form-group ">
                          <label for="Event Type">Course Name<span style="color:red;"> *</span></label>
                          <select class="form-control" id="course" name="course" style="width: 100%;">
                          <option value="">==SELECT==</option>
                           <?php foreach ($courseList as $course): ?>
                              <option value="<?=$course['id']?>"><?=$course['course_name']?></option>
                            <?php endforeach; ?>
                           </select>
                        </div>
                        </div>
                        <div class="col-md-4"> 
                        <div class="form-group ">
                          <label for="Event Type">Section<span style="color:red;"> *</span></label>
                          <select class="form-control" id="batch" name="batch" style="width: 100%;">
                          <option value="">==SELECT==</option>
                           </select>
                        </div>
                        </div>
                    </div>
                  </div>
                  <div class="box-footer">
                     <button type="submit" id="btn_search" name="btn_search" class="btn btn-primary">Search</button>
                  </div>
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
              </form>
              </div>
            </div>
            </div>
    </section>
    <!-- /.content -->
  </div>
  </div>
  </div>

@endsection
{{--External Style Section--}}
@section('script')
<script src="{{ URL::asset('assets/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
<script>
  $(document).ready(function(){
    $('#btn_search').click(function(){
      var process =true;
      var acadmic_year = $('#acadmic_year').val();
      var course= $('#course').val();
      var batch =$('#batch').val();
      if(course==""){
        $("#course").css({"border-color":"red"});
        $("#course").focus();
        process =false;
      }
      if(acadmic_year==""){
        $("#acadmic_year").css({"border-color":"red"});
        $("#acadmic_year").focus();
        process =false;
      }
      if(batch==""){
        $("#batch").css({"border-color":"red"});
        $("#batch").focus();
        process =false;
      }
      return process;
    });
    $("#course").change(function(){$(this).css('border-color','');});
    $("#acadmic_year").change(function(){$(this).css('border-color','');});
    $("#batch").change(function(){$(this).css('border-color','');});
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
                      $(list).empty().append('<option value="">==SELECT== </option>');

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

@endsection
<!-- ./wrapper -->
