@extends('header')
@section('style')
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/bootstrap/dist/css/responsive.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/bootstrap-daterangepicker/daterangepicker.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/select2/dist/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/plugins/timepicker/bootstrap-timepicker.min.css') }}">



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

        <li class="active">Add Exam Schedule</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        @include('notification.notify')
  <div class="box box-default">
          <div class="box-header with-border">
           <h3 class="box-title">Add Exam Schedule</h3>

            <div class="box-tools pull-right">
                 <a href="{{url('Exam/exam_schedule_list')}}" class="btn btn-primary">
                <i class="fa fa-arrow-left" aria-hidden="true">  Back</i></button>
              </a>
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              <button style="display:none;" type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
            </div>
          </div>
          <!-- /.box-header -->
     <form method="post" action="{{url('#')}}">

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
                                <select class="form-control select2" id="exam_name"   name="exam_name" style="width: 100%;" required>
                                    <option value="" selected="selected">--Please Select Exam--</option>
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
                            <select class="form-control select2" id="batch" name="batch" style="width: 100%;" required>
                                          <option  value="" selected="selected">Select Batch</option>

                                    </select>                        </div>
                          </div>
                           <div class="col-md-3">

                          </div>

                           <div class="col-md-2">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                           </div>
                          </div>
  </div>

                <!-- /.form-group -->
</div>
</div>
</div>
      <div class="box-body" id="exam_schedule" style="display: none;">
      <div class="row">
        <div class="col-md-12">


               <table id="example" class="table table-striped table-bordered display" style="width:100%">
               <thead>
               <tr>
               <th>Subject ID</th>
               <th>Subject</th>
               <th>Date</th>
               <th>Start Time</th>
               <th>End Time</th>
               <th>Room</th>
               </tr>
             </thead>
                     <tbody>

                     </tbody>

                   </table>
        </div>

      </div>
    </div>
       <div id="sv" class="box-footer col-md-12 form-group" style="display:none;">
           <input id="save" type="button" name="sub" value="Create" class="btn btn-primary">
           </div>
    </div>


</section>
</div>
  <!-- /.content-wrapper -->

@endsection
{{--External Style Section--}}
@section('script')

<script src="{{ URL::asset('assets/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/datatables.net-bs/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/jquery/dist/bootbox.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>


<script>
     $(document).ready(function () {
   $("#save").click(function(){
        var examscedule = new Array();

          var exam_name=$("#exam_name").val();
      var courses=$("#courses").val();
      var batch=$("#batch").val();


       $("#example tbody tr").each(function () {

                var row = $(this);
                var examdetails = {};
                examdetails.sub_id = row.find('td:eq(0)').html();
                examdetails.name = row.find('td:eq(1) input').val();
                examdetails.dates = row.find('td:eq(2) input').val();
                examdetails.starttime = row.find('td:eq(3) input').val();
                examdetails.endtime = row.find('td:eq(4) input').val();
                examdetails.room = row.find('td:eq(5) input').val();
                examscedule.push(examdetails);
               // console.log(cnt);
            });
       //   alert(JSON.stringify(examscedule));exit;
            var dataa =JSON.stringify(examscedule)
            var _url = $("#_url").val();

                   $.ajax({
              type: "POST",
              url: _url + "/create_exam_schedule",
              data: {date: dataa,exam_name:exam_name,courses:courses,batch:batch},
              success: function (data) {
                  alert(data);
                    if ($('#down').is(':checked')) {
                      var _url = $("#_url").val();
                    //  window.location.href = _url + "/finance/feeCollection/receipt/" + receipt_no;
                  }else{
                    location.reload();
                    table.clear().draw();
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

<!--<script>
       $(document).ready(function () {
           $("#batch").change(function(){
      var tt = $(".tables").DataTable({
       fixedColumns: true,
    scrollY:        "300px",
     scrollX:        true,
     scrollCollapse: true,
     paging:         false,
     columnDefs: [
         { width: 200, targets: 0 }
     ],
     fixedColumns: true,
     destroy: true,

        });

               var cid=$("#courses").val();
               var bid=$("#batch").val();

          //     alert(id);
               var _url = $("#_url").val();
             var dataString = 'cid=' + cid+'&bid='+bid;
              //alert(dataString);
               $.ajax
               ({
                   type: "POST",
                   url: _url + '/student/subjectlist',
                   data: dataString,
                   cache: false,
                   success: function ( data ) {
                   alert(data);
                    var sp = data.split("|");
                   var sp1=JSON.parse(sp[0]);

                    for (var i = 0; i < sp1.length; i++) {
                              tt.row.add( [
                                '<td><input type="text" class="form-control "  name="discount" value="" required></td>',
                                '<td><input type="text" class="form-control "  name="discount" value="" required></td>',
                                '<td><input type="text" class="form-control "  name="discount" value="" required></td>',
                                '<td><input type="text" class="form-control "  name="discount" value="" required></td>',
                                '<td><input type="text" class="form-control "  name="discount" value="" required></td>',
                                '<td><input type="text" class="form-control "  name="discount" value="" required></td>',
                                '<td><input type="text" class="form-control "  name="discount" value="" required></td>'
                              ] ).draw( false);
                    }
          }

            });
           });

       });

   </script>-->
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
       //   alert();
        //Initialize Select2 Elements
        $('.select2').select2();

        $('.dates').datepicker({
          autoclose: true,
          format:'dd-mm-yyyy',
            todayBtn: true,
            language: "fr",
            forceParse: false,
            autoclose: true,
            todayHighlight: true,
            onRender: function(date) {
                return date.valueOf() < now.valueOf() ? 'disabled' : '';
            }
        });
        $('.timepicker').timepicker({
              showInputs: false
            })
        //Datemask dd/mm/yyyy

      });
    </script>

<script>
function myday() {
  var x = document.getElementById("days").value;
  document.getElementById("demo").innerHTML = x;
}
</script>



    <script>
       $(document).ready(function () {
             $('table').on('focus', 'input.dates:not(.hasDatepicker)', function () {
    $('.dates').datepicker({
         autoclose: true,
          format:'dd-mm-yyyy'
    });
});

             $('table').on('focus', 'input.timepicker:not(.hasTimepicker)', function () {
    $('.timepicker').timepicker();
});


           /*For Details Loading*/
           $("#batch").change(function(){
               var cid=$("#courses").val();
               var bid=$("#batch").val();
           var table = $('#example').DataTable();
           table.clear().draw();

                   var ts = $('#example').DataTable({
    fixedColumns: true,
    bDestroy: true,
     scrollCollapse: true,
     paging:         false,
     fixedColumns: false,
     autoWidth: false,
     bDestroy: true
     });
          //     alert(id);
               var _url = $("#_url").val();
             var dataString = 'cid=' + cid+'&bid='+bid;
              //alert(dataString);
               $.ajax
               ({
                   type: "POST",
                   url: _url + '/Exam/createschedule',
                   data: dataString,
                   cache: false,
                   success: function ( data ) {
                    $("#exam_schedule").show();
                    $("#sv").show();
                   //alert(data);
                 //  console.log(data);
                     var sp = data.split("|");
                   var sp1=JSON.parse(sp[0]);
                  //console.log(sp1);

                 /*    var cnt="";
                   for (var i = 0; i < sp1.length; i++) {
                      cnt += '<tr>';
                      cnt +='<td><input type="text" name="subject_name[]" value=' +sp1[i].subject_name +' style="border:0;background-color:transparent;" readonly></td>';
                      cnt +='<td> <div class="input-group date"><div class="input-group-addon"><i class="fa fa-calendar"></i></div><input type="text" class="form-control date" name="exam_date[]" style="background-color:transparent;"></td>';
                      cnt +='<td> <div class="form-group col-md-12"><div class="bootstrap-timepicker"><div class="form-group"><div class="input-group"><input type="text" class="form-control timepicker" name="start_time[]" value="{{ old('stoptime') }}"><div class="input-group-addon"><i class="fa fa-clock-o"></i></div></div></div></div></div></td>';
                      cnt +='<td> <div class="form-group col-md-12"><div class="bootstrap-timepicker"><div class="form-group"><div class="input-group"><input type="text" class="form-control timepicker" name="end_time[]" value="{{ old('stoptime') }}"><div class="input-group-addon"><i class="fa fa-clock-o"></i></div></div></div></div></div></td>';
                      cnt +='<td><input type="number" name="room_no[]" style="width:50px;" style="background-color:transparent;"></td>';
                      cnt +='<td><input type="number" name="full_marks[]" style="width:80px;" style="background-color:transparent;"></td>';
                      cnt +='<td><input type="number" name="passing_marks[]" style="width:70px;" style="background-color:transparent;"></td>';
                      cnt += '</tr>';

                  }
                    $('#cls').find('tbody').empty().append(cnt);*/
                  // ts.columns([0]).visible(false);

                      for (var i = 0; i < sp1.length; i++) {
                     ts.row.add( [
                                 sp1[i].id,
                                '<input type="text" name="subject_name[]" value="' +sp1[i].subject_name +'" style="border:0;background-color:transparent;" readonly/>',
                                '<div class="input-group "><div class="input-group-addon"><i class="fa fa-calendar"></i></div><input type="text" class="form-control dates" name="exam_date[]" style="background-color:transparent;"/>',
                                '<div class="form-group"><div class="input-group"><input type="text" class="form-control timepicker" name="start_time[]" value=""/><div class="input-group-addon"><i class="fa fa-clock-o"></i></div></div></div>',
                                '<div class="form-group"><div class="input-group"><input type="text" class="form-control timepicker" name="end_time[]" value=""/><div class="input-group-addon"><i class="fa fa-clock-o"></i></div></div></div>',
                                '<input type="text" name="room_no[]" style="width:80px;" style="background-color:transparent;"/>',
                            ] ).draw( false);

                  }

           }

       });
     });
         });

   </script>

</form>


@endsection
<!-- ./wrapper -->
