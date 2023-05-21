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
      <h3 class="box-title">Class Promotion</h3>
      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        <button style="display:none;" type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
      </div>
    </div>
        <div class="row">
          <div class="col-md-12">
            <div class="box box-info">
              <div class="box-body">
                <form role="form" method="post" enctype="multipart/form-data" action="{{url('search/student/promotion')}}">
                  <div class="box-body">
                    <div clas="row">
                        <div class="col-md-3">
                        <div class="form-group ">
                          <label for="Event Type">Session<span style="color:red;"> *</span></label>
                          <select class="form-control select2" id="acadmic_year" name="acadmic_year" style="width: 100%;">
                          <option value="">Please select </option>
                           <?php foreach ($sessionList as $value): ?>
                              <option value="<?=$value['startyear']?>-<?=$value['endyear']?>" <?=(isset($acadmic_year))?$acadmic_year==$value['startyear'].'-'.$value['endyear']?"SELECTED":"":"";?>><?=$value['startyear'].'-'.$value['endyear']?></option>
                            <?php endforeach; ?>
                           </select>
                        </div>
                        </div>
                        <div class="col-md-3">
                        <div class="form-group ">
                          <label for="Event Type">Course Name<span style="color:red;"> *</span></label>
                          <select class="form-control select2" id="course" name="course" style="width: 100%;">
                          <option value="">Please select</option>
                           <?php foreach ($courseList as $val): ?>
                              <option value="<?=$val['id']?>"<?=(isset($course))?$course==$val['id']?"SELECTED":"":"";?>><?=$val['course_name']?></option>
                            <?php endforeach; ?>
                           </select>
                        </div>
                        </div>
                        <div class="col-md-3">
                        <div class="form-group ">
                          <label for="Event Type">Section<span style="color:red;"> *</span></label>
                          <select class="form-control select2" id="batch" name="batch" style="width: 100%;">
                           </select>
                        </div>
                        </div>
                        <div class="col-md-3">
                        <div class="form-group ">
                        <button type="submit" id="btn_search" name="btn_search" class="btn btn-primary" style="margin-top: 25px;">Search</button>
                        </div>
                        </div>
                    </div>
                  </div>
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
              </form>
              </div>
            </div>
            </div>
            <div class="col-md-12">
            <div class="box box-info">
              <form role="form" method="post" enctype="multipart/form-data" action="{{url('promote/student')}}">
              <div class="box-header">
              </div>
              <div class="box-body">
                <table id="example" class="table table-striped table-bordered display nowrap" style="width:100%">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Status</th>
                    <th>Student Name</th>
                    <th>Gr No</th>
                    <th>Class</th>
                    <th>Section</th>
                    <th>Roll No</th>
                    <th>Sex</th>
                  </tr>
                  </thead>
                  <tbody>
                    @if(empty($data))
                      <tr style="text-align:center; color: red;">
                         <td colspan="8">Data Not Available!!!</td>
                      </tr>
                    @else
                    <tr><p style="color: red;"><input type="checkbox" name="checkall" id="checkall">&nbsp;&nbsp;&nbsp;&nbsp;Checked All</p></tr>
                      @php $i=0; @endphp
                      @foreach($data as $value)
                      <tr>
                        <td><?=++$i;?></td>
                        <td><input type="checkbox" name="status[]" id="checkboxes" value="<?=$value['id']."|".$value['reg_no'];?>"></td>
                        <td><?=$value['stu_name']!=""?$value['stu_name']:"N/A";?></td>
                        <td><?=$value['reg_no']!=""?$value['reg_no']:"N/A";?></td>
                        <td><?=$course_name!=""?$course_name:"N/A";?></td>
                        <td><?=$batch_name!=""?$batch_name:"N/A";?></td>
                        <td><?=$value['roll_no']!=""?$value['roll_no']:"N/A";?></td>
                        <td><?=$value['gender']!=""?$value['gender']:"N/A";?></td>
                      </tr>
                      @endforeach
                    @endif
                  </tbody>
                </table>
              </div>
            </div>
            @if(!empty($data))
            <div class="row">
              <div class="col-md-12">
                <p style="text-align: center;font-size: 20px;color: blue;"><u>Promote To</u></p>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                 <div clas="row">
                    <div class="col-md-3">
                      <div class="form-group ">
                        <label for="Event Type">Session<span style="color:red;"> *</span></label>
                        <select class="form-control" id="acadmic_year_data" name="acadmic_year_data" style="width: 100%;">
                        <option value="">Please select</option>
                         <?php foreach ($sessionList as $value): ?>
                            <option value="<?=$value['startyear']?>-<?=$value['endyear']?>"><?=$value['startyear'].'-'.$value['endyear']?></option>
                          <?php endforeach; ?>
                         </select>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group ">
                        <label for="Event Type">Course Name<span style="color:red;"> *</span></label>
                        <select class="form-control" id="course_data" name="course_data" style="width: 100%;">
                          <option value="">Please select</option>
                          <?php foreach ($courseList as $val): ?>
                            <option value="<?=$val['id']?>"><?=$val['course_name']?></option>
                            <?php endforeach; ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group ">
                        <label for="Event Type">Section<span style="color:red;"> *</span></label>
                        <select class="form-control" id="batch_details" name="batch_details" style="width: 100%;">
                          <option value="">Please select</option>
                         </select>
                      </div>
                    </div>
                    <div class="col-md-3">
                     <div class="form-group ">
                     <button type="submit" id="btn_promote" name="btn_promote" class="btn btn-primary" style="margin-top: 25px;">Promote</button>
                      </div>
                    </div>
                  </div>
              </div>
            </div>
            @endif
              <input type="hidden" name="batch_data" id="batch_data" value="<?=(isset($batch))?$batch:"";?>">
              <input type="hidden" name="prev_acadmic_year" id="prev_acadmic_year" value="<?=(isset($acadmic_year))?$acadmic_year:"";?>">
<input type="hidden" name="prev_course" id="prev_course" value="<?=(isset($course))?$course:"";?>">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
          </form>
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
    var id= $('#batch_data').val();
    if(id!=""){
      var _url = $("#_url").val();
      var dataString = 'eid=' + id;
        $.ajax({
                type: "POST",
                url: _url + '/student/batch',
                data: dataString,
                cache: false,
                success: function ( data ) {
                data=JSON.parse(data);
                //alert(data);
                var list = $("#batch");
                  for (var i in data) {
                    var v=data[i]['id'];
                    var v1=data[i]['batch_name'];
                    $(list).append('<option value="' +v +'">' + v1 + '</option>');
                  }
              }
      });
    }else{
      var list = $("#batch");
      $(list).append('<option value="">Please select  </option>');
    }
    $('#checkall').click(function() {
      var checked = $(this).prop('checked');
      $('input:checkbox').not(this).prop('checked', this.checked);
    });
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
                      $(list).empty().append('<option value="">Please select </option>');

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
     $("#course_data").change(function(){
               var id = $(this).val();
             /*alert(id);*/
               var _url = $("#_url").val();
               /*alert(_url);*/
               var dataString = 'eid=' + id;
               $.ajax
               ({
                   type: "POST",
                   url: _url + '/student/batchlist',
                   data: dataString,
                   cache: false,
                   success: function ( data ) {
                    data=JSON.parse(data);
                    var list = $("#batch_details");
                    $(list).empty().append('<option value="">Please select</option>');
                    $(data).empty();
                    var emptycarno="No batch available for this course";
             if(data.length==""){
                        $("#batch_details").append('<option value="' +emptycarno +'">' + emptycarno + '</option>');
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
  $(document).ready(function(){
    $('#btn_promote').click(function(){
      var process =true;
      var course= $('#course').val();
      var acadmic_year = $('#acadmic_year').val();
      var startYear =parseInt(acadmic_year.substring(0,4));
      var endYear = parseInt(acadmic_year.substring(5,9));
      var checkedLen = $("input[name='status[]']:checked").length;
        if(!checkedLen) {
            alert("You must check at least one Status!!");
            process = false;
        }
      var acadmic_year_data = $('#acadmic_year_data').val();
      var course_data= $('#course_data').val();
      var batch_details =$('#batch_details').val();
      if(course_data==""){
        $("#course_data").css({"border-color":"red"});
        $("#course_data").focus();
        process =false;
      }else{
          if(course>=course_data){
        //  alert("Please Select Right Course For Promotion!!");
          //$("#course_data").css({"border-color":"red"});
          //$("#course_data").focus();
          //process =false;
        }
      }
      if(acadmic_year_data==""){
        $("#acadmic_year_data").css({"border-color":"red"});
        $("#acadmic_year_data").focus();
        process =false;
      }else{
        startYearData=parseInt(acadmic_year_data.substring(0,4));
        endYearData=parseInt(acadmic_year_data.substring(5,9));
        if(startYearData<=startYear || endYearData<=endYear){
          alert("Please Select Right Session!!");
          $("#acadmic_year_data").css({"border-color":"red"});
          $("#acadmic_year_data").focus();
          process =false;
        }
      }
      if(batch_details==""){
        $("#batch_details").css({"border-color":"red"});
        $("#batch_details").focus();
        process =false;
      }
      return process;
    });
    $("#acadmic_year_data").change(function(){$(this).css('border-color','');});
    $("#course_data").change(function(){$(this).css('border-color','');});
    $("#batch_details").change(function(){$(this).css('border-color','');});
  });
</script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
  })
</script>
@endsection
<!-- ./wrapper -->
