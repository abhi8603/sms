@extends('gurdian.main-header')
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
          <li><a href="#"><i class="fa fa-dashboard"></i>  Exam </a></li>
     
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        @include('notification.notify')
  <div class="box box-default">
          <div class="box-header with-border">
           <h3 class="box-title">Exam </h3>

            <div class="box-tools pull-right">
            
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              <button style="display:none;" type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
            </div>
          </div>
          <!-- /.box-header -->
          <form method="POST" action="">

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
                              <label>Exam</label>
                            <select class="form-control select2" id="exam" style="width: 100%;" required>
                                          <option  value="" selected="selected">Select Exam</option>
                                          @foreach($exam as $exam)
                                          <option value="{{$exam->id}}">{{$exam->exam_name}}</option>
                                          @endforeach

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
                 <div class="col-md-12">
                   
               <table class="table" id="cls">
                <thead>
              <tr>
                <th>Subject</th>
                <th>Date</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Room No</th>
                <th>Full Marks</th>
                <th>Passing Marks</th>
              </tr>
            </thead>
            <tbody>
           <tr>

           </tr>
            </tbody>
            
          </table> 
                 </div>
               </div>

</div>


    </div>
      <div class="box-body">
      <div class="row">
        <div class="col-md-12">
                      
        
<form>

        </div>
      </div>
    </div>
  </div>
  </div>
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
<script src="{{ URL::asset('assets/bower_components/chart.js/Chart.js') }}"></script>
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
           /*For Details Loading*/
           $("#exam").change(function(){
            var table =$('#cls').DataTable();
               var id = $(this).val();
          //     alert(id);
               var _url = $("#_url").val();
               var dataString = 'exam=' + id;
               //alert(dataString);
               $.ajax
               ({
                   type: "POST",
                   url: _url + '/parents/ward/exam/view_exam_hall_arrangement',
                   data: dataString,
                   cache: false,
                   success: function ( data ) {
                      //alert(data);
                            data=JSON.parse(data);
                table.clear().draw();
              //alert(data);
                for(var i in data)
                  {
                    table.row.add( [
                    data[i]['subject'],
                    data[i]['exam_date'],
                    
                    data[i]['start_time'],
                    data[i]['end_time'],
                    data[i]['room_no'],
                    data[i]['full_marks'],
                    data[i]['pass_marks']
                    
                     
                    ] ).draw( false );                  
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

        $("#viewedit").click(function () {
            $("#editview").show();
            $(this).hide();
            $("#edit").show();
            $("#view").hide();
        });
        $("#editview").click(function () {
            $("#viewedit").show();
            $(this).hide();
            $("#view").show();
            $("#edit").hide();
        });

        });
    </script>
<script>

$(document).ready(function() {
   $.extend($.fn.dataTable.defaults, {
 dom: 'Bfrtip'
});
   $('#cls').DataTable( {

       buttons: [
           'copy', 'csv', 'excel', 'pdf', 'print'
       ],
         rowReorder: {
           selector: 'td:nth-child(2)'
       },
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
      function exam_center()
      {
        var exam=$("#exam").val();
        var ds='exam='+exam;
        alert(ds);
        $.ajax({
            type: "POST",
            url: _url + '/parents/ward/exam/view_exam_hall_arrangement',
            data: dataString,
            cache: false,
            success: function ( data ) 
            {
                alert(data);
            }
        });
      }
    </script>
@endsection
<!-- ./wrapper -->
