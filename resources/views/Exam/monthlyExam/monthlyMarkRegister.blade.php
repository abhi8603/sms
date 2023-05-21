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

        <li class="active">Mark register</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        @include('notification.notify')
  <div class="box box-default">
           <div class="box-header with-border">
           <h3 class="box-title">Monthly Mark Register</h3>

            <div class="box-tools pull-right">

              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              <button style="display:none;" type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
            </div>
          </div>
          <!-- /.box-header -->
     <form method="post" action="{{url('Exam/monthly/mark/save')}}">
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
                             <label for="exampleInputEmail1">Session<span style="color:red;"> *</span></label>
                             <select class="form-control select2" name="session" id="session" style="width: 100%;" required>
                                 <option value="0" selected="selected">Please select</option>
                                 <?php foreach ($academic_year as $acadmic_year): ?>
                                   <option value="{{$acadmic_year->startyear}}-{{$acadmic_year->endyear}}" @if($acadmic_year->status==app_config('Session',Auth::user()->school_id)) selected @endif >{{$acadmic_year->startyear}}-{{$acadmic_year->endyear}}</option>
                                 <?php endforeach; ?>
                          </select>
                        </div>
                      </div>
                               <div class="col-md-3">
                                <div class="form-group">
                                <label>Month</label>
                                <select class="form-control select2" id="month"   name="month" style="width: 100%;" required>
                                    <option value="" selected="selected">Please select Exam Month</option>
                                             <option value="01" @if(date('m')=='01') selected @endif>January</option>
                                             <option value="02" @if(date('m')=='02') selected @endif>February</option>
                                             <option value="03" @if(date('m')=='03') selected @endif>March</option>
                                             <option value="04" @if(date('m')=='04') selected @endif>April</option>
                                             <option value="05" @if(date('m')=='05') selected @endif>May</option>
                                             <option value="06" @if(date('m')=='06') selected @endif>June</option>
                                             <option value="07" @if(date('m')=='07') selected @endif>July</option>
                                             <option value="08" @if(date('m')=='08') selected @endif>August</option>
                                             <option value="09" @if(date('m')=='09') selected @endif>September</option>
                                             <option value="10" @if(date('m')=='10') selected @endif >October</option>
                                             <option value="11" @if(date('m')=='11') selected @endif>November</option>
                                             <option value="12" @if(date('m')=='12') selected @endif>December</option>

                             </select>
                           </div>
                                </div>
                            <div class="col-md-3" style="display:none;">
                                <div class="form-group">
                                <label>Exam Name</label>
                                <select class="form-control select2" id="exam_id"   name="exam_id" style="width: 100%;" required>
                                    <option value="" >Please select Exam</option>
                                      <?php
                                      foreach($exam as $row)
                                      {
                                        ?>
                                        <option value="<?php echo $row->id ?>" selected="selected"><?php echo $row->exam_name; ?></option>

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
                          </div>
  </div>
  <div id="sublist">
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
               //var id = $(this).val();
          //     alert(id);

          var cid=$("#courses").val();
          var bid=$("#batch").val();
          var exam_id=$("#exam_id").val();
          var session=$("#session").val();
          var _url = $("#_url").val();
            //   alert(session);
               $.ajax
               ({
                   type: "POST",
                   url: _url + '/Exam/student/subjectlist',
                   data: {cid:cid,bid:bid,exam_id:exam_id,session:session,type:2},
                   cache: false,
                   success: function ( data ) {
                     $("#sublist").html(data);
                    // alert(data);
                     data=JSON.parse(data);

                       // alert(data);
                         var list = $("#subject");
                      $(list).empty().append('<option selected="selected" value=""> Please Select </option>');

                     $(data).empty();
                      var emptycarno="No subject available";
             if(data.length==""){
                        $("#subject").append('<option value="' +emptycarno +'">' + emptycarno + '</option>');
             }
               else{
                        for (var i in data) {
                          var v=data[i]['subject'];
                          var v1=data[i]['subject_name'];
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
        <script>
       $(document).ready(function () {

           /*For Details Loading*/
           $("#subject").change(function(){
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
           var month=$("#month").val();
        // alert(subject);
           var _url = $("#_url").val();
           var dataString = 'cid='+cid+"&bid="+bid+"&examid="+examname+"&subject="+subject+"&month="+month;
       //    alert(dataString);
           $.ajax({
            type:"post",
            url: _url + '/Exam/student_details/monthly',
            data: dataString,
            cache: false,
             success: function ( data )
             {
               //  alert(data);

              var array = data.split("|");
               data=JSON.parse(array[0]);
               exam_details=JSON.parse(array[1]);
                exam_cnt=JSON.parse(array[2]);
                //console.log(exam_details);


                table.clear().draw();
                var fm;
                var pm;
               // alert(array[1]);
            //   if(exam_cnt=='0'){
              for (var e in exam_details){
                  fm=exam_details[e]['fullmarks'];
                  pm=exam_details[e]['passmarks'];
                //  alert(fm);
              }
                for(var i in data)
                  {

                    table.row.add( [
                    '<input type="text" name="reg_no[]" style="border:0;background: transparent;text-align: left;"  value='+ data[i]['reg_no']+' readonly>',
						  '<input type="text" name="roll_no[]" style="border:0;background: transparent;text-align: left;"  value='+ data[i]['roll_no']+' readonly>',
                    '<input type="text" style="border:0;background: transparent;text-align: left;"  value="'+ data[i]['stu_name']+'" name="stu_name[]" readonly><br><input type="hidden" name="stu_id[]" value='+ data[i]['id']+' >',
                    '<input type="text" style="border:0;background: transparent;text-align: left;" name="full_marks[]"  value="'+ fm +'" readonly>',
                    '<input type="text" style="border:0;background: transparent;text-align: left;" name="pass_marks[]" value="'+ pm +'" readonly>',
                    '<input class="mark" type="text" style="background: transparent;text-align: left;" max="'+ fm +'" id="m_grade" onkeypress="return isNumberKey(event)"  value="'+ data[i]['marks']+'" name="marks[]" >',
                    '<span class="changeButton" style="color:green;cursor:pointer;text-align: left;">Present </span>'
                    ] ).draw( false );
                  }
                $('#overlay').hide();
              /*}else{
                 alert("Marks for given subject is already Given.");
                  $('#overlay').hide();
             } */
             }

//  '<input class="mark" type="text" style="background: transparent;text-align: center;" id="m_grade" oninput="search_grade()" Value="0" name="marks[]" required >',
           });
         });
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

   <!--<script type="text/javascript">
      function show()
      {
       var cid=$("#courses").val();
        var bid=$("#batch").val();
        var _url = $("#_url").val();
        var dataString = 'cid=' + cid+'&bid='+bid;
           //alert(dataString);
            $.ajax
               ({
                   type: "POST",
                   url: _url + '/Exam/createmarkregister',
                   data: dataString,
                   cache: false,
                   success: function ( data )
                   {
                      //alert(data);
                   var sp = data.split("|");
                   var sp1=JSON.parse(sp[0]);
                   var sp2=JSON.parse(sp[1]);
                   var sp3=JSON.parse(sp[2]);

                   //alert(sp[1]);
                    var cnt="";
                    var cnt1="";
                      cnt +='<th>Reg No</th>';
                    cnt +='<th>Roll </th>';
                    cnt +='<th>Student</th>';
                    var s=0;
                    for (var i = 0; i < sp1.length; i++) {
                     //cnt +='<tr>';
                      s++;

                     cnt +='<th>'+sp1[i].subject_name +'<br><input type="text" name="subject_id[]" value='+sp1[i].id +'></th>';


                  }
                  //alert(sub);
                  //alert(s);


                   $('#exm').find('thead').empty().append(cnt);

                      for(var j=0;j<sp2.length; j++)
                   {
                    cnt1 +='<tr>';
                    cnt1 +='<td><input type="text" name="reg_no[]" value='+sp2[j].reg_no+'></td>';
                    cnt1 +='<td><input type="text" name="roll_no[]" value="2"></td>';
                    cnt1 +='<td><input type="text" name="stud_name[]" value='+sp2[j].stu_name+'></td>';
                    for(var k=1; k<=s; k++)
                    {
                       cnt1 +='<td><input type="checkbox" name="abs[]" value="A">ABS<br><input type="text" name="marks[]"><br></td>';
                       //alert(sp1[0].subject_name);
                    }

                  }
                   $('#exm').find('tbody').empty().append(cnt1);

                 }
                 });
      }
    </script> -->
  </form>

@endsection
<!-- ./wrapper -->
