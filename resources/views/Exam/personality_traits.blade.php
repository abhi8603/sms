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
<link rel="stylesheet" href="{{ URL::asset('assets/plugins/timepicker/bootstrap-timepicker.min.css') }}">

<style>
#overlay
{
    display:none;
    position: fixed;
    top: 0px;
    bottom: 0;
    left: 0;
    right: 0;
    margin: auto;
    width: 100%;
    height: 100%;
    z-index: 999;
    background-color: rgba(0,0,0,0.85);
}

#overlay #loading {
    z-index: 9999;
    position: fixed;
    top: 0px;
    bottom: 0;
    left: 0;
    right: 0;
    margin: auto;
    width: 300px;
    height: 300px;
    background-size: 100% 100%;
    opacity: 1;
}
</style>

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

        <li class="active">Personality Traits Mark register</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        @include('notification.notify')
  <div class="box box-default">
           <div class="box-header with-border">
           <h3 class="box-title">Personality Traits Mark Register</h3>

            <div class="box-tools pull-right">

              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              <button style="display:none;" type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
            </div>
          </div>
          <!-- /.box-header -->
     <form method="post" action="{{url('Exam/personality_traits/save')}}">

          <div class="box-body">
            <div class="row">
              <div class="col-md-12">

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
                                <label>Exam Name</label>
                                <select class="form-control select2" id="exam_id"   name="exam" style="width: 100%;" required>
                                    <option value="" selected="selected">Please select Exam</option>
                                      <?php
                                      foreach($exam as $row)
                                      {
                                        ?>
                                        <option value="<?php echo $row->id ?>"><?php echo $row->exam_name; ?></option>

                                        <?php
                                      }
                                      ?>
                             </select>
                           </div>
                                </div>
                            <div class="col-md-3">

                              <div class="form-group">
                                <label>Class</label>
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
                             <div class="form-group">
                              <label>Section</label>
                            <select class="form-control select2" id="batch"  name="batch" style="width: 100%;" required>
                                          <option  value="" selected="selected">Select Batch</option>

                                    </select>                        </div>
                          </div>


                           <div class="col-md-2">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                           </div>
                          </div>
  </div>

 <div class="box box-primary" id="save_list" style="display:none;">
                         <div class="box-header with-border">

                         </div>

                          <div class="box-body">
                            <div class="table-responsive">
                            <table class="table table-striped table-bordered" id="exm">
                              <thead>
                                <tr>
                              <th>Reg No.</th>
                              <th>Student</th>
                              <th>CLEANLINESS</th>
                              <th>HONESTY</th>
                              <th>CO-OPERATIVE</th>
                              <th>OBEDIENCE</th>
                              <th>COURTESY</th>
                              <th>PERSISTENCE</th>
                              <th>INDUSTRY</th>
                              <th>PROMPTNESS</th>
                                </tr>
                              </thead>
                              <tbody>

                              </tbody>
                            </table>
                          </div>
                            <input type="submit" name="" class="btn btn-primary" value="Save">

                          </div>
                        </div>
                <!-- /.form-group -->
</div>
</div>
</div>

    </div>


</section>
</div>
  <!-- /.content-wrapper -->
<div id="overlay">
  <br><br><br><br>
    <div id="loading" class="text-center" style="color:white;">
     <i class="fa fa-spinner fa-spin" style="font-size: 70px;"></i>
     <br><h3>Please wait...</h3>
    </div>
</div>

@endsection
{{--External Style Section--}}
@section('script')
<script src="{{ URL::asset('assets/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/datatables.net-bs/js/dataTables.select.min.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/datatables.net-bs/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/datatables.net-bs/js/dataTables.checkboxes.min.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/datatables.net-bs/js/dataTableSum.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/jquery/dist/bootbox.min.js') }}"></script>
 <script src="{{ URL::asset('assets/plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>
 <script src="{{ URL::asset('assets/bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
  <script>
       $(document).ready(function () {
           /*For Details Loading*/
           $("#courses").change(function(){
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
       $(document).ready(function () {
           /*For Details Loading*/
           $("#batch").change(function(){
            $('#overlay').show();
            var table =$('#exm').DataTable({
                 "pageLength": 100,
                  autoWidth: false,
                    bDestroy: true
            });
            var cid=$("#courses").val();
          var bid=$("#batch").val();
          var examname=$("#exam_id").val();
          var subject=$("#subject").val();
       //  alert(subject);
           var _url = $("#_url").val();
           var dataString = 'cid='+cid+"&bid="+bid+"&examid="+examname;
           //alert(dataString);
           $.ajax({
            type:"post",
            url: _url + '/Exam/p_student_details',
            data: dataString,
            cache: false,
             success: function ( data )
             {
              var array = data.split("|");
               data=JSON.parse(array[0]);
               exam_details=JSON.parse(array[1]);
                exam_cnt=JSON.parse(array[2]);
                $("#save_list").show();
                 table.clear().draw();
                var fm;
                var pm;
               // alert(array[1]);
              // if(exam_cnt=='0'){
              for (var e in exam_details){
                  fm=exam_details[e]['fullmarks'];
                  pm=exam_details[e]['passmarks'];
                //  alert(fm);
              }
                for(var i in data)
                  {
                  if(data[i]['cleanliness']==null || data[i]['cleanliness']==""){
                    var cleanliness="";
                  } else{
                    var cleanliness=data[i]['cleanliness'];
                  }
                  if(data[i]['co_operative']==null || data[i]['co_operative']==""){
                    var co_operative="";
                  } else{
                    var co_operative=data[i]['co_operative'];
                  }
                  if(data[i]['courtesty']==null || data[i]['courtesty']==""){
                    var courtesty="";
                  } else{
                    var courtesty=data[i]['courtesty'];
                  }
                  if(data[i]['industry']==null || data[i]['industry']==""){
                    var industry="";
                  } else{
                    var industry=data[i]['industry'];
                  }
                  if(data[i]['honesty']==null || data[i]['honesty']==""){
                    var honesty="";
                  } else{
                    var honesty=data[i]['honesty'];
                  }
                  if(data[i]['obedience']==null || data[i]['obedience']==""){
                    var obedience="";
                  } else{
                    var obedience=data[i]['obedience'];
                  }
                  if(data[i]['persistence']==null || data[i]['persistence']==""){
                    var persistence="";
                  } else{
                    var persistence=data[i]['persistence'];
                  }
                  if(data[i]['promptness']==null || data[i]['promptness']==""){
                    var promptness="";
                  } else{
                    var promptness=data[i]['promptness'];
                  }
                    table.row.add( [
                    '<input type="text" name="reg_no[]" style="border:0;background: transparent;text-align: left;"  value='+ data[i]['reg_no']+' readonly>',
                    '<input type="text" style="border:0;background: transparent;text-align: left;" value="'+ data[i]['stu_name']+'" name="stu_name[]" readonly><br><input type="hidden" name="stu_id[]" value='+ data[i]['id']+' >',
                     '<input type="text" class="form-control" name="cleanliness[]" value="'+ cleanliness +'"  >',
                     '<input type="text" class="form-control" name="honesty[]" value="'+ honesty +'" >',
                     '<input type="text" class="form-control" name="co_operative[]" value="'+ co_operative +'" >',
                     '<input type="text" class="form-control" name="obedience[]" value="'+ obedience +'" >',
                     '<input type="text" class="form-control" name="courtesty[]" value="'+ courtesty +'" >',
                     '<input type="text" class="form-control" name="persistence[]" value="'+ persistence  +'" >',
                     '<input class="form-control" type="text" name="industry[]" value="'+ industry +'" >',
                     '<input class="form-control" type="text" name="promptness[]" value="'+ promptness +'" >'
           ] ).draw( false );
                  }
                $('#overlay').hide();
            /*  }else{
                 alert("Marks for given subject is already Given.");
                  $('#overlay').hide();
             } */
             }


           });
           });

       });
   </script>
<!-- <script>
$(document).ready(function() {
   $.extend($.fn.dataTable.defaults, {
 dom: 'Bfrtip'
});
   $('#exm').DataTable( {

       buttons: [
           'copy', 'csv', 'excel', 'pdf', 'print'
       ],

       responsive: true


   } );
   } );

</script> -->
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

<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()


  })
</script>
<script>
function myday() {
  var x = document.getElementById("days").value;
  document.getElementById("demo").innerHTML = x;
}
</script>

<script>
      $(function () {
        //Initialize Select2 Elements
        $('.select2').select2();
        $('#startdate').datepicker({
          autoclose: true,
          format:'dd-mm-yyyy'
        });
        $('#dob').datepicker({
          autoclose: true,
          format:'dd-mm-yyyy'
        });
        $('.timepicker').timepicker({
              showInputs: false
            })
        //Datemask dd/mm/yyyy

      });
    </script>

       <script type="text/javascript">
         $('#exm tbody').on('click', '.changeButton', function () {
            // var table =$('#normal_range_dt').DataTable();
            // table.row( $(this).closest('tr') ).remove().draw();
            var t=$(this).html();

           if(t.search('Present') != -1)
           {
            $(this).html('Absent');
            $(this).css("color","red");
            $(this).css("cursor","pointer");
            $(this).closest('tr').children('td').children(".mark").val('AB');
            $(this).closest('tr').children('td').children(".mark").attr( "readonly");
           }
           else
           {
            $(this).html('Present');
            $(this).css("color","green");
            $(this).css("cursor","pointer");
            $(this).closest('tr').children('td').children(".mark").removeAttr( "readonly");
            $(this).closest('tr').children('td').children(".mark").val('0');
           }
          });
       </script>

      <script>
      function search_grade()
      {
        var marks=$("#m_grade").val();
        var _url = $("#_url").val();
        var ds='makrs='+marks;
      //  alert(ds);
        $.ajax({
          type:"post",
          url: _url + '/Exam/search_grade_name',
          data: ds,
          cache: false,
           success: function ( data )
           {
             alert(data);
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
      }
      </script>
<script>
    function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode == 46){
        var inputValue = $("#floor").val();
        var count = (inputValue.match(/'.'/g) || []).length;
        if(count<1){
            if (inputValue.indexOf('.') < 1){
                return true;
            }
            return false;
        }else{
            return false;
        }
    }
    if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57)){
        return false;
    }
    return true;
}

</script>

  </form>

@endsection
<!-- ./wrapper -->
