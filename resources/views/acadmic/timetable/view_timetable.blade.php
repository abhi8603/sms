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
        <li><a href="#"><i class="fa fa-dashboard"></i> Time Table</a></li>
        <li class="active">View Time Table</li>
      </ol>
    </section>
    <section class="content">
    @include('notification.notify')
  <div class="box box-default">
    <!-- Main content -->
    <div class="box-header with-border">
      <h3 class="box-title">View Time Table</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        <button style="display:none;" type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
      </div>
    </div>

        <div class="row">
          <div class="col-md-12">
            <!-- Custom Tabs -->
            <div class="nav-tabs-custom">
              <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1" data-toggle="tab">By Room No</a></li>
                <li><a href="#tab_2" data-toggle="tab">By Teacher</a></li>
                <li><a href="#tab_3" data-toggle="tab">By Subject</a></li>
                <li><a href="#tab_4" data-toggle="tab">By Class & Subject</a></li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                  <div class="box-body">
                    <div class="row">
                      <div class="col-md-12">

                        <!-- /.form-group -->
                        <div class="box box-info">
                                 <div class="box-header with-border">
                          <!--         <h3 class="box-title">By Room No</h3>-->
                                 </div>
                                   <div class="box-body">
                                     <div class="col-md-4">
                                       <label>Room No</label>
                                       <div class="form-group">
                                 <select class="form-control select2" id="room_no"   name="room_no" style="width: 100%;" required>
                                   <option value="">Please Select</option>
                                   @foreach($room_no as $room_no)
                                   <option value="{{$room_no->room_no}}">{{$room_no->room_no}}</option>
                                   @endforeach
                                </select>
                                    </div>
                                  </div>
                                 </div>
                                 <div style="text-align: center;" id="byroomno">
                                 </div>
                               </div>

                        <!-- /.form-group -->
                      </div>

                  </div>
                </div>
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="tab_2">
                  <div class="box-body">
                    <div class="row">
                    <div class="col-md-12">
                    <div class="box box-primary">
                                 <div class="box-header with-border">
                                <!--   <h3 class="box-title">Accepted Leave</h3> -->
                                 </div>
                                 <div class="box-body">
                                   <div class="col-md-4">
                                     <label>Teacher</label>
                                     <div class="form-group">
                               <select class="form-control select2" id="teacher" name="teacher" style="width: 100%;" required>
                                 <option value="">Please Select</option>
                                 @foreach($teacher as $teacher)
                                 <option value="{{$teacher->emp_code}}">{{$teacher->name}} ({{$teacher->emp_code}})</option>
                                 @endforeach
                              </select>
                                  </div>
                                </div>
                               </div>
                        </div>
                        <div style="text-align: center;" id="byteacher">
                        </div>
                        </div>

                        </div>
                </div>
              </div>

              <div class="tab-pane" id="tab_3">
                <div class="box-body">
                  <div class="row">
                  <div class="col-md-12">
                  <div class="box box-warning">
                               <div class="box-header with-border">
                              <!--   <h3 class="box-title">Accepted Leave</h3> -->
                               </div>
                               <div class="box-body">
                                 <div class="col-md-4">
                                   <label>Subject</label>
                                   <div class="form-group">
                             <select class="form-control select2" id="subject" name="subject" style="width: 100%;" required>
                               <option value="">Please Select</option>
                                @foreach($subject as $subject)
                                <option value="{{$subject->id}}">{{$subject->subject_name}}</option>
                                @endforeach
                            </select>
                                </div>
                              </div>
                             </div>
                      </div>
                      <div style="text-align: center;" id="bysubject">
                      </div>
                      </div>

                      </div>
              </div>
            </div>

            <div class="tab-pane" id="tab_4">
              <div class="box-body">
                <div class="row">
                <div class="col-md-12">
                <div class="box box-danger">
                             <div class="box-header with-border">
                            <!--   <h3 class="box-title">Accepted Leave</h3> -->
                             </div>
                             <div class="box-body">
                               <div class="col-md-4">
                                 <label>Class</label>
                                 <div class="form-group">
                           <select class="form-control select2" id="class" name="class" style="width: 100%;" required>
                             <option value="">Please Select</option>
                             @foreach($class as $class)
                             <option value="{{$class->id}}">{{$class->course_name}}</option>
                             @endforeach
                          </select>
                              </div>
                            </div>
                               <div class="col-md-4">
                                 <label>Subject</label>
                                 <div class="form-group">
                           <select class="form-control select2" id="sub" name="sub" style="width: 100%;" required>
                             <option value="">Please Select</option>

                          </select>
                              </div>
                            </div>
                           </div>
                    </div>
                    <div style="text-align: center;" id="byclasssubject">
                    </div>
                    </div>

                    </div>
            </div>
          </div>

            </div>
    </section>
  </div>


@endsection
{{--External Style Section--}}
@section('script')
<script src="{{ URL::asset('assets/bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
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
<script>
       $(document).ready(function () {
           /*For Details Loading*/

           $("#sub").change(function(){
             $("#byclasssubject").empty();
             var _url = $("#_url").val();
             var dataString = 'subject_id=' + this.value;
             // alert(dataString);
               $.ajax
               ({
                   type: "POST",
                   url: _url + '/timetable/timetablebyclasssubject',
                   data: {subject_id:this.value,class_id:$("#class").val()},
                   cache: false,
                   success: function ( data ) {
                     $("#byclasssubject").html(data);

           }
       });
      });


 $("#class").change(function(){
  // alert(this.value);
   var _url = $("#_url").val();
   var dataString = 'class_id=' + this.value;
   // alert(dataString);
     $.ajax
     ({
         type: "POST",
         url: _url + '/teacher/getSubjectbyclass',
         data: dataString,
         cache: false,
         success: function ( data ) {
        //   alert(data);
           data=JSON.parse(data);
            var list = $("#sub");
            $(list).empty().append('<option selected="selected" value=""> Please Select </option>');
            $(data).empty();
            var emptycarno="No Subject found for this Class";
            if(data.length==""){
              $("#sub").append('<option value="' +emptycarno +'">' + emptycarno + '</option>');
            }else{
              for (var i in data) {
                var v=data[i]['subject'];
                var v1=data[i]['subject_name'];
                $(list).append('<option value="' +v +'">' + v1 + '</option>');

             }
           }

         }
    });
 });

           $("#subject").change(function(){
             $("#bysubject").empty();
             var _url = $("#_url").val();
             var dataString = 'subject_id=' + this.value;
             // alert(dataString);
               $.ajax
               ({
                   type: "POST",
                   url: _url + '/timetable/timetablebysubject',
                   data: dataString,
                   cache: false,
                   success: function ( data ) {
                     $("#bysubject").html(data);

           }
       });
     });

           $("#teacher").change(function(){
             $("#byteacher").empty();
             var _url = $("#_url").val();
             var dataString = 'teacher_id=' + this.value;
             // alert(dataString);
               $.ajax
               ({
                   type: "POST",
                   url: _url + '/timetable/timetablebyTeacher',
                   data: dataString,
                   cache: false,
                   success: function ( data ) {
                     $("#byteacher").html(data);

           }
       });
     });


           $("#room_no").change(function(){
             $("#byroomno").empty();
             var _url = $("#_url").val();
             var dataString = 'room_no=' + this.value;
             // alert(dataString);
               $.ajax
               ({
                   type: "POST",
                   url: _url + '/timetable/timetablebyRoom',
                   data: dataString,
                   cache: false,
                   success: function ( data ) {
                     $("#byroomno").html(data);

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
      $('.table').DataTable( {

          buttons: [
              'copy', 'csv', 'excel', 'pdf', 'print'
          ],
          responsive: true,
          pageLength: 50,
      } );
      } );

   </script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2();
    $('.startdate').datepicker({
      autoclose: true,
      format:'dd-mm-yyyy'
    });
    $('.dob').datepicker({
      autoclose: true,
      format:'dd-mm-yyyy'
    });
  });
</script>
@endsection
<!-- ./wrapper -->
