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
      <h3 class="box-title">Search Student Report Card</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        <button style="display:none;" type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
      </div>
    </div>
        <div class="row">
          <div class="col-md-12">
            <div class="box box-info">
              <div class="box-body">
                <form role="form" method="post" enctype="multipart/form-data" action="{{url('search/student/card/one')}}">
                  <div class="box-body">
                    <div clas="row">
                        <div class="col-md-4"> 
                        <div class="form-group ">
                          <label for="Event Type">Session<span style="color:red;"> *</span></label>
                          <select class="form-control" id="acadmic_year" name="acadmic_year" style="width: 100%;">
                          <option value="">==SELECT==</option>
                           <?php foreach ($sessionList as $value): ?>
                              <option value="<?=$value['startyear']?>-<?=$value['endyear']?>" <?=(isset($acadmic_year))?$acadmic_year==$value['startyear'].'-'.$value['endyear']?"SELECTED":"":"";?>><?=$value['startyear'].'-'.$value['endyear']?></option>
                            <?php endforeach; ?>
                           </select>
                        </div>
                        </div>
                        <div class="col-md-4"> 
                        <div class="form-group ">
                          <label for="Event Type">Course Name<span style="color:red;"> *</span></label>
                          <select class="form-control" id="course" name="course" style="width: 100%;">
                          <option value="">==SELECT==</option>
                           <?php foreach ($courseList as $val): ?>
                              <option value="<?=$val['id']?>"<?=(isset($course))?$course==$val['id']?"SELECTED":"":"";?>><?=$val['course_name']?></option>
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
            <div class="col-md-12">
            <div class="box box-info">
              <form role="form" method="post" enctype="multipart/form-data" action="{{url('generate/report')}}">
              <div class="box-header">
              </div>
              <div class="box-body">
                <table id="example" class="table table-striped table-bordered display nowrap" style="width:100%">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Status</th>
                    <th>Student Name</th>
                    <th>Reg No</th>
                    <th>Class</th>
                    <th>Section</th>
                    <th>Roll No</th>
                  </tr>
                  </thead>
                  <tbody>
                    @if(empty($data))
                      <tr style="text-align:center; color: red;">
                         <td colspan="9">Data Not Available!!!</td>
                      </tr>
                    @else
                    <tr><p style="color: red;"><input type="checkbox" name="checkall" id="checkall">&nbsp;&nbsp;&nbsp;&nbsp;Checked All</p></tr>
                      @php $i=0; @endphp
                      @foreach($data as $value)
                      <tr>
                        <td><?=++$i;?></td>
                        <td><input type="checkbox" name="status[]" id="checkboxes" value="<?=$value['id'];?>"></td>
                        <td><?=$value['stu_name']!=""?$value['stu_name']:"N/A";?></td>
                        <td><?=$value['reg_no']!=""?$value['reg_no']:"N/A";?></td>
                        <td><?=$course_name!=""?$course_name:"N/A";?></td>
                        <td><?=$batch_name!=""?$batch_name:"N/A";?></td>
                        <td><?=$value['roll_no']!=""?$value['roll_no']:"N/A";?></td>
                      </tr>
                      @endforeach
                    @endif
                  </tbody>
                </table>
              </div>
            </div>
            <div class="box-footer">
              @if(!empty($data))
              <button type="submit" id="btn_gen" name="btn_gen" class="btn btn-primary">Print Front Page</button>
              @endif
              </div>
              <input type="hidden" name="course" id="batch" value="<?=(isset($course))?$course:"";?>">
              <input type="hidden" name="batch" id="batch" value="<?=(isset($batch))?$batch:"";?>">
              <input type="hidden" name="acadmic_year" id="acadmic_year" value="<?=(isset($acadmic_year))?$acadmic_year:"";?>">
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
    $('#checkall').click(function() {
      var checked = $(this).prop('checked');
      $('input:checkbox').not(this).prop('checked', this.checked);
    });
    $('#btn_gen').click(function(){
      var process =true;
       var checkedLen = $("input[name='status[]']:checked").length;
        if(!checkedLen) {
            alert("You must check at least one Status!!");
            process = false;
        }
        return process;
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
 <script>
        $(document).ready(function () {
            /*For Delete Application Info*/
            $(".complainDelete").click(function (e) {
                e.preventDefault();
                var id = this.id;
                //alert(id);
                bootbox.confirm("Do You Want To Delete Event!!?", function (result) {
                    if (result) {
                        var _url = $("#_url").val();
                        window.location.href = _url + "/report/generate/" + id;
                    }
                });
            });

        });
    </script>
@endsection
<!-- ./wrapper -->
