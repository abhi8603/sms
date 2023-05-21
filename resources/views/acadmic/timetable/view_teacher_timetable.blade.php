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
        <li class="active">Teacher Time Table</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        @include('notification.notify')
  <div class="box box-default">
          <div class="box-header with-border">
           <h3 class="box-title">View Teacher Schedule</h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              <button style="display:none;" type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
            </div>
          </div>
          <!-- /.box-header -->
          <form method="POST" action="{{url('create_cls_time')}}">

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
                                <label>Select Teacher</label>
                               <select class="form-control select2" id="teacher"   name="course" style="width: 100%;" required>
                                    <option value="" selected="selected">Please select Teacher</option>
                                      <?php
                                      foreach($emp as $row)
                                      {
                                        ?>
                                        <option value="<?php echo $row->id ?>"><?php echo $row->fname; ?></option>

                                        <?php
                                      }
                                      ?>
                             </select>
                           </div>
                         </div>
                         
                           <div class="col-md-3">
                               <input type="hidden" name="_token" value="{{ csrf_token() }}">
                          </div>

                          </div>
                               </div>

                <!-- /.form-group -->
              </div>
</div>
    </div>
      <div class="box-body"   >
      <div class="row">
        <div class="col-md-12">
          <table class="table table-striped table-bordered display" id="cls">
              <thead>
                <tr>
                  <th>Subject</th>
                  <th>Monday</th>
                  <th>Tuesday</th>
                  <th>Wednesday</th>
                  <th>Thrusday</th>
                  <th>&nbsp &nbsp Friday</th>
                  <th>Saterday</th>
                  <th>&nbsp &nbsp Sunday</th>
                </tr>
              </thead>
            <tbody >
      
            </tbody>
            
          </table>             
        
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

  
     <script>
       $(document).ready(function () {
           /*For Details Loading*/
           $("#teacher").change(function(){
               var eid=$("#teacher").val();
              
               
          //     alert(id);
               var _url = $("#_url").val();
              var ds="eid="+eid;
            alert(ds);
               $.ajax
               ({
                   type: "POST",
                   url: _url + '/student/teachertimetablelist',
                   data: ds,
                   cache: false,
                   success: function ( data ) {
                  alert(data);
                   //data=JSON.parse(data);
                  var sp = data.split("|");
                   var sp1=JSON.parse(sp[0]);
                   alert(data);
                   var sp2=JSON.parse(sp[1]);
                    var cnt="";
                    for (var i = 0; i < sp1.length; i++) {
                      cnt += '<tr>';
                      cnt +='<td>' +sp1[i].period_name +'<br>('+sp1[i].start_time+' - '+sp1[i].end_time+')</td>';
                      for(var j=0;j<sp2.length;j++)
                      {
                        if(sp1[i].period == sp2[j].period)
                        {
                          cnt +='<td><b style="color:#00a672;">'+sp2[j].subject_name +'</b><br>';
                          cnt +='<div style="color:#e5b439;">Room No: '+sp2[j].room+'</div>';
                          
                          cnt +='</td>';
                        }
                      }
                     
                      cnt += '</tr>';  
                  }
                    $('#cls').find('tbody').empty().append(cnt);
           }

       });
     }); 
         });

   </script>

      @endsection
<!-- ./wrapper -->
