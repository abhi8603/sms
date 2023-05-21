@extends('header')
@section('style')
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
        <li><a href="#"><i class="fa fa-dashboard"></i>Student</a></li>

        <li class="active">Transport Allocation</li>
      </ol>
    </section>

    <!-- Main content -->
      <section class="content">
          @include('notification.notify')
    <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Student Transport Allocation</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button style="display:none;" type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="box box-primary">
                           <form role="form" method="post" enctype="multipart/form-data" action="{{url('student/postsearch')}}">
                          <div class="box-body">
                            <div class="form-group col-md-4">
                              <label for="exampleInputEmail1">Academic Year<span style="color:red;"> *</span></label>
                              <select class="form-control select2" id="academic_year" name="accdmic_year" style="width: 100%;">
                                  @foreach($accadmicyear as $accadmicyear)
                                  <option value="{{$accadmicyear->startyear}}-{{$accadmicyear->endyear}}">{{$accadmicyear->startyear}}-{{$accadmicyear->endyear}}</option>
                                @endforeach
                           </select>
                         </div>
                             <div class="col-md-5">
                            <div class="form-group">
                              <label for="exampleInputEmail1">Name Or Registration No</label>
                              <select class="form-control select2" id="name" name="stu_reg_no" style="width: 100%;">
                                  <option value="0" selected="selected">Select or type Student Name or Registration No</option>
                                <?php foreach ($students as $students): ?>
                                      <option value="{{Crypt::encrypt($students->reg_no)}}">{{$students->stu_name}} ({{$students->reg_no}})</option>
                                <?php endforeach; ?>
                           </select>
                         </div>
                       </div>
             </div>

   </form>
   </div>                  <!-- /.form-group -->
        </div>
                <div class="col-md-12" id="stuinfo" style="display:none;">
                   <form role="form" method="post" enctype="multipart/form-data" action="{{url('transport/transport/allocate')}}">
                  <div class="box-header with-border">
                    <h3 class="box-title">Student details:-</h3>
                  </div>
                <div class="form-group col-md-4">
                 <label for="exampleInputEmail1">Student Name<span style="color:red;"> *</span></label>
                 <input type="text" class="form-control" id="student_name" name="stu_name" value="" readonly>
                </div>
                <div class="form-group col-md-4">
                 <label for="exampleInputEmail1">Registration No.<span style="color:red;"> *</span></label>
                 <input type="text" class="form-control" id="reg_no" name="reg_no" value="" readonly>
                </div>
                <div class="form-group col-md-4">
                 <label for="exampleInputEmail1">Class/Course<span style="color:red;"> *</span></label>
                 <input type="text" class="form-control" id="class" name="course" value="" readonly>
                </div>
                <div class="form-group col-md-4">
                 <label for="exampleInputEmail1">Section/Batch<span style="color:red;"> *</span></label>
                 <input type="text" class="form-control" id="batch" name="batch" value="" maxlength="10" readonly>
                </div>
                <div class="form-group col-md-4">
                 <label for="exampleInputEmail1">Name of Guardian</label>
                 <input type="text" class="form-control" id="parents" name="parent_name" maxlength="10" value="" readonly>
                </div>
                <div class="form-group col-md-4">
                 <label for="exampleInputEmail1">Contact No.<span style="color:red;"> *</span></label>
                 <input type="text" class="form-control" id="contact" name="contact_no" value="" readonly>
                </div>
                <div class="form-group col-md-4">
                 <label for="exampleInputEmail1">Address<span style="color:red;"> *</span></label>
                 <textarea type="text" rows="3" class="form-control" id="address" name="father_aadhar" value="" readonly></textarea>
                </div>
                <div class="col-md-12">
                <div class="box-header with-border">
                  <h3 class="box-title">Transport details:-</h3>
                </div>
                <div class="form-group col-md-3">
                  <label for="exampleInputEmail1">Route</label>
                  <select class="form-control select2" id="routes" name="route" style="width: 100%;">
                      <option value="0" selected="selected">Please Select Route</option>
                      <?php foreach ($route as $route): ?>
                          <option value="{{$route->id}}" >{{$route->routecode}}</option>
                      <?php endforeach; ?>

               </select>
             </div>
             <div class="form-group col-md-3">
               <label for="exampleInputEmail1">Destination</label>
               <select class="form-control select2" id="destination" name="destination" style="width: 100%;">
                   <option value="0" selected="selected">Please Select Destination</option>

            </select>
          </div>
          <div class="form-group col-md-3">
                          <label>Start Date</label>
                          <div class="input-group date">
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control pull-right" value="{{ old('dob') }}" id="dob" name="start_date" required>
                          </div>
                          <!-- /.input group -->
                        </div>
          <div class="form-group col-md-3">
              <label>End Date</label>
              <div class="input-group date">
              <div class="input-group-addon">
              <i class="fa fa-calendar"></i>
            </div>
          <input type="text" class="form-control pull-right" value="{{ old('dob') }}" id="startdate" name="end_date" required>
        </div>
                                        <!-- /.input group -->
        </div>
      <div class="box-footer">
      <button type="submit" class="btn btn-primary">Save</button>
      </div>
      </div>

    <input type="hidden" name="_token" value="{{ csrf_token() }}">
</form>
                </div>
</div>
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
       $(document).ready(function () {
           /*For Details Loading*/
           $("#routes").change(function(){
               var id = $(this).val();
              // alert(id);
               var _url = $("#_url").val();
            //    alert(_url);
               var dataString = 'eid=' + id;
               $.ajax
               ({
                   type: "POST",
                   url: _url + '/transport/routedestination',
                   data: dataString,
                   cache: false,
                   success: function ( data ) {
                     data=JSON.parse(data);
                      //  alert(data);
                         var list = $("#destination");
                      $(list).empty().append('<option selected="selected" value=""> Please Select </option>');

                     $(data).empty();
                      var emptycarno="No Destination available for this Route";
             if(data.length==""){
                        $("#destination").append('<option value="' +emptycarno +'" selected="selected">' + emptycarno + '</option>');
                        alert(emptycarno);
             }
               else{
                        for (var i in data) {
                          var v=data[i]['id'];
                          var v1=data[i]['pickanddrop'];
                          $(list).append('<option value="' +v1 +'">' + v1 + '</option>');
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
      //   $("#stuinfo").hide();
           /*For Details Loading*/
           $("#name").change(function(){
              $("#stuinfo").hide();
               var id = $(this).val();
               var acadmic_year = $("#academic_year").val();
               var _url = $("#_url").val();
               var dataString = 'eid=' + id;
               $.ajax
               ({
                   type: "POST",
                   url: _url + '/student/stuinfo',
                   data: {eid:id,acadmic_year:acadmic_year},
                   cache: false,
                   success: function ( data ) {
                  //   alert(data);
                  // $("#stuinfo").show();
                       $("#stuinfo").slideToggle("slow");
                  //  $("#stuinfo").fadeIn('slow');
                     var array = data.split("|");
                  //   alert();
                     if(array[9]=='1'){
                       $("#routes").attr('disabled','disabled');
                        $("button").attr('disabled','disabled');
                        alert('Transport is already allocated.');
                     }else{
                       $("#routes").removeAttr('disabled');
                       $("button").removeAttr('disabled');
                     }
                     $("#reg_no").val(array[0]);
                     $("#student_name").val(array[1]);
                     $("#class").val(array[3]);
                     $("#batch").val(array[2]);
                     $("#parents").val(array[4]);
                     $("#contact").val(array[5]);
                     $("#address").val(array[6]);
                   },
                   error: function (jqXHR, exception) {
        var msg = '';
        if (jqXHR.status === 0) {
             $("#stuinfo").hide();
             $("#rollno").val('');
            msg = 'Not connect.\n Verify Network.';

        } else if (jqXHR.status == 404) {
             $("#stuinfo").hide();
             $("#rollno").val('');
            msg = 'Requested page not found. [404]';

        } else if (jqXHR.status == 500) {
             $("#stuinfo").hide();
             $("#rollno").val('');
            msg = 'Internal Server Error [500].';

        } else if (exception === 'parsererror') {
           $("#stuinfo").hide();
           $("#rollno").val('');
            msg = 'Requested JSON parse failed.';

        } else if (exception === 'timeout') {
           $("#stuinfo").hide();
           $("#rollno").val('');
            msg = 'Time out error.';
        } else if (exception === 'abort') {
           $("#stuinfo").hide();
           $("#rollno").val('');
            msg = 'Ajax request aborted.';
        } else {
           $("#stuinfo").hide();
           $("#rollno").val('');
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
            $(".tFileDelete").click(function (e) {
                e.preventDefault();
                var id = this.id;
                bootbox.confirm("Are you sure?", function (result) {
                    if (result) {
                        var _url = $("#_url").val();
                        window.location.href = _url + "/student/delete/" + id;
                    }
                });
            });

        });
    </script>
<script>
$(document).ready(function() {
   $.extend($.fn.dataTable.defaults, {
 dom: 'Bfrtip'
});
   $('#example').DataTable( {

       buttons: [
           'copy', 'csv', 'excel', 'pdf', 'print'
       ],
       responsive: true
   } );
   } );

</script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
    $('#startdate').datepicker({
      autoclose: true,
      format:'dd-mm-yyyy'
    });
    $('#dob').datepicker({
      autoclose: true,
      format:'dd-mm-yyyy'
    });
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
