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
        <li><a href="#"><i class="fa fa-dashboard"></i> Academic</a></li>
          <li><a href="#"><i class="fa fa-dashboard"></i> Time Table</a></li>
        <li class="active">Period Master</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        @include('notification.notify')
  <div class="box box-default">
          <div class="box-header with-border">
           <h3 class="box-title">Period Master</h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              <button style="display:none;" type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
            </div>
          </div>
          <div class="box-body">
            <div class="row">
              <div class="col-md-5">
                <div class="box box-primary">
                         <div class="box-header with-border">
                           <h3 class="box-title">Create Period</h3>
                         </div>
                          <div class="box-body">
                            <form method="POST" action="{{url('add_period')}}">
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

                              <div class="form-group">
                                  <label>Section</label>
                            <select class="form-control select2" id="batch" name="batch" style="width: 100%;" required>
                              <option  value="" selected="selected">Select Section</option>
                            </select>
                             </div>
                              <div class="form-group">
                                <label>Period</label>
                              <input type="text" name="period" class="form-control" autocomplete="off">
                            </div>
                             <div class="form-group">
                               <label>Start Time</label>
                               <div class="bootstrap-timepicker">
                                     <input type="text" class="form-control timepicker" id="start_time" name="start_time" value="{{ old('stoptime') }}">
                                </div>
                              </div>
                              <div class="form-group">
                               <label>End Time</label>
                              <div class="bootstrap-timepicker">
                                  <input type="text" class="form-control timepicker" id="end_time" name="end_time" value="{{ old('stoptime') }}">
                               </div>
                                 </div>
                                 <div class="form-group">
                                 <input type="submit" name="sub" id="create" value="Create" class="btn btn-primary">                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                 <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                 </div>
                                </div>
                         </div>
                 </div>

                 <div class="col-md-7">
                   <div class="box box-info">
                            <div class="box-header with-border">
                              <h3 class="box-title">Period List</h3>

                            </div>
                             <div class="box-body">
                               <table id="example" class="table table-striped table-bordered display">
                                 <thead>
                                   <th>Sl No.</th>
                                   <th>Class/Section</th>
                                   <th>Period</th>
                                   <th>Start-Time</th>
                                   <th>End-Time</th>
                                   <th>Action</th>
                                 </thead>
                                 <tbody>
                                   @php $i=0; @endphp
                                   @foreach($period as $period)
                                    @php $i++; @endphp
                                    <tr>
                                      <td>{{$i}}</td>
                                      <td>{{$period->course_name}} / {{$period->batch_name}}</td>
                                      <td>{{$period->period_name}}</td>
                                      <td>{{$period->start_time}}</td>
                                      <td>{{$period->end_time}}</td>
                                      <td>
                                        <div class="btn-group">
                                          <button type="button" class="btn btn-default  btn-flat dropdown-toggle" data-toggle="dropdown">
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                          </button>
                                          <ul class="dropdown-menu" role="menu" title="Action">
                                            <li><a href="{{url('subject/view/'.$period->id)}}" title="Edit"><i  class="fa fa-eye" style="color: #887fdbe6;";></i></a></li>
                                            <li><a href="#" class="tFileDelete" title="Delete" id="{{$period->id}}"><i class="fa fa-trash" style="color: red";></i></a></li>
                                          </ul>
                                        </div>
                                      </td>
                                    </tr>
                                   @endforeach
                                 </tbody>
                               </table>

                             </div>
                           </div>
                         </div>



  </div>

                <!-- /.form-group -->
</div>
</div>
</div>

</section>
</div>

@endsection
{{--External Style Section--}}
@section('script')
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
<script src="{{ URL::asset('assets/bower_components/jquery/dist/bootbox.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>
 <script>
       $(document).ready(function () {

         $("#create").click(function(){
           if($("#end_time").val()==$("#start_time").val()){
           alert("Start Time and End Time can't be same.");
           return false
         }
         })
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
                      var emptycarno="No Section available for this Class";
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
            $(".tFileDelete").click(function (e) {
                e.preventDefault();
                var id = this.id;
                bootbox.confirm("Are you sure?", function (result) {
                    if (result) {
                        var _url = $("#_url").val();
                        window.location.href = _url + "/add-course/delete/" + id;
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
      $(function () {
        $('.timepicker').timepicker({
              showInputs: false
            })
      });
    </script>

@endsection
<!-- ./wrapper -->
