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
               <h3 class="box-title">View Student Marks</h3>

                <div class="box-tools pull-right">
                 <a href="{{url('Exam/create_mark_register')}}">
                    <button type="button" class="btn btn-primary"><i class="fa fa-plus"> Add</i></button>
                  </a>
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  <button style="display:none;" type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                </div>
              </div>
          <!-- /.box-header -->
     <form method="post" action="{{url('insert_mark_register')}}">

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
                              <label>Exam Name</label>
                              <select class="form-control select2" id="examid"  name="exam_type" style="width: 100%;" required>
                                   <option  value="" selected="selected">Select Exam</option>
                                  @foreach($exam as $exam_type)
                                          <option  value="{{$exam_type->id}}" selected="selected">{{$exam_type->exam_name}}</option>
                                @endforeach
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
                             <div class="form-group">
                              <label>Batch/Section</label>
                            <select class="form-control select2" id="batch"  name="batch" style="width: 100%;" required>
                                          <option  value="" selected="selected">Select Batch</option>

                                    </select>                        </div>
                          </div>
                           

                           <div class="col-md-2">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                           </div>
                          </div>
  </div>

 <div class="box box-primary" id="stu_list" style="display:none;">
                         <div class="box-header with-border">
                             <h3 class="box-title">Student List</h3>
                         </div>

                          <div id="tb" class="box-body">
                           
                        <!--    <table class="table table-striped table-bordered display" id="exm">
                              <thead>
                                <tr>
                              <th>Reg No.</th>
                              <th>Roll No</th>
                              <th>Student</th>

                              <th>View</th>

                                </tr>
                              </thead>
                              <tbody>

                              </tbody>
                            </table>-->
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
               //var id = $(this).val();
          //     alert(id);

          var cid=$("#courses").val();
          var bid=$("#batch").val();
               var _url = $("#_url").val();
               var dataString = 'cid='+cid+"&bid="+bid;
               $.ajax
               ({
                   type: "POST",
                   url: _url + '/student/subjectlist',
                   data: dataString,
                   cache: false,
                   success: function ( data ) {
                     data=JSON.parse(data);

                      //   alert(data);
                         var list = $("#subject");
                      $(list).empty().append('<option selected="selected" value=""> Please Select </option>');

                     $(data).empty();
                      var emptycarno="No batch available for this course";
             if(data.length==""){
                        $("#subject").append('<option value="' +emptycarno +'">' + emptycarno + '</option>');
             }
               else{
                        for (var i in data) {
                          var v=data[i]['id'];
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
           $("#batch").change(function(){
            $('#overlay').show();
           
            var cid=$("#courses").val();
          var bid=$("#batch").val();
           var examid=$("#examid").val();
           //alert(examid);
           var _url = $("#_url").val();
           var dataString = 'cid='+cid+"&bid="+bid+"&examid="+examid;
           //alert(dataString);
           $.ajax({
            type:"post",
            url: _url + '/Exam/result/all',
            data: dataString,
            cache: false,
             success: function ( data )
             {
                 $("#stu_list").show();
                  var array = data.split("|");
               subjects=JSON.parse(array[0]);
              marks=JSON.parse(array[1]); 
          //console.log(JSON.parse(array[1]));
               //alert(data);
               $( "#tb" ).empty();
               var subcol;
               if(subjects!=""){
               for(var s in subjects){
                           subcol+='<th>'+subjects[s]['subject_name']+'</th>'
                           
               }
              // console.log(subcol);
               $( "#tb" ).append( '<table class="table table-striped table-bordered display" id="exm">'+
                              '<thead>'+
                             '  <tr>'+
             
                
                '<th rowspan="2">Reg No.</th>'+
                '<th rowspan="2">Roll No</th>'+
                '<th rowspan="2">Student</th>'+
                '<th style="text-align: center;color: green;" colspan="5">Subjects</th>'+
            '</tr>'+

                               ' <tr>'+
                              "'"+subcol+"'"+
                                '</tr>'+
                             ' </thead>'+
                              '<tbody>'+

                              '</tbody>'+
                            '</table>' );
                             var table =$('#exm').DataTable({
                 "pageLength": 100,
                  autoWidth: false,
                    bDestroy: true
            });
              table.clear().draw();
               }else{
                   alert("Subjects Not Found.");
               }
            /*    for(var e in marks[all_subs]){
                 console.log("tes");  console.log(marks[i][all_subs][e]['marks']);
               }*/
            /*   for(var j in marks){
                    console.log(marks[j]['all_subs']['subjects'][0]['subject']);
               }exit;*/
               var submarks;
               var subcode;
               for(var ss in subjects){
                            for(var j in marks){
                                subcode=subjects[ss]['subject'];
                           //     console.log("sub code" +subcode);
                             //    console.log("sub code 2 : " +marks[j]['all_subs']['subjects'][0]['subject']);
                                var stu_reg= marks[j]['all_subs']['subjects'][0]['register_no'];
                                
                                if(stu_reg==marks[j]['reg_id']){
                   if(subcode==marks[j]['all_subs']['subjects'][0]['subject']){
                   submarks+='<input type="text" style="border:0;background: transparent;"  value="'+marks[j]['all_subs']['subjects'][0]['marks']+'" readonly>'+',';
             //      console.log("mrk"+submarks);
                   }
                                }
               }
                           
               }
              // console.log("all marks :"+submarks);
              for(var i in marks)
                  {
//alert(marks[i]['stu_name']);
                                        //var stu_name=marks[i]['stu_name'];
                    table.row.add( [
                    '<input type="text" name="reg_no[]" id="reg_no" style="border:0;background: transparent;"  value="'+ marks[i]['reg_id']+'" readonly>',
                      '<input type="text" name="reg_no[]" id="reg_no" style="border:0;background: transparent;"  value="'+ marks[i]['roll_no']+'" readonly>',
                     '<input type="text" style="border:0;background: transparent;"  value="'+ marks[i]['stu_name']+'" readonly>',
                      submarks
               

                    ] ).draw( false );
                  }
                $('#overlay').hide();
              }

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
       function get_result(id)
       {
         //alert(id);
        var reg_no=$("#reg_no").val();
        var _url = $("#_url").val();

      window.location.href = _url + "/exam/view_report/"+id;
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
