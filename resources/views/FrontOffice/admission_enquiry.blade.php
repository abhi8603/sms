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
        
          <li><a href="#"><i class="fa fa-dashboard"></i>  Front Office</a></li>
        <li class="active">Admission Enquiry</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        @include('notification.notify')
  <div class="box box-default">
            <div class="box-header with-border">
           <h3 class="box-title">Exam Schedule</h3>

            <div class="box-tools pull-right">
          
                <button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-primary"><i class="fa fa-plus">Addd</i></button>
         
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              <button style="display:none;" type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
            </div>
          </div>
          <!-- /.box-header -->
 

          <div class="box-body">
            <div class="row">
              <div class="col-md-12">

                <!-- /.form-group -->
                <div class="box box-primary">
                         <div class="box-header with-border">
                           
                         </div>
                
                          <div class="box-body">
                             <div class="form-group col-md-3">
                               <label>Start Enquiry Date</label>
                               <div class="input-group date">
                                 <div class="input-group-addon">
                                   <i class="fa fa-calendar"></i>
                                 </div>
                                 <input type="text" class="form-control pull-right dob" value="{{ old('dob') }}" id="dob" name="start_date" required readonly>
                               </div>
                               <!-- /.input group -->
                             </div>
                           <div class="form-group col-md-3">
                               <label>End Enquiry Date</label>
                               <div class="input-group date">
                                 <div class="input-group-addon">
                                   <i class="fa fa-calendar"></i>
                                 </div>
                                 <input type="text" class="form-control pull-right dob" value="{{ old('dob') }}" id="dob1" name="end_date" required readonly>
                               </div>
                               <!-- /.input group -->
                             </div>
                          <div class="col-md-3">
                             <div class="form-group">
                              <label>Source</label>
                        <select class="form-control select2" onchange="source()" id="source" name="source" style="width: 100%;" required>
                              <option>Select</option>
                              @foreach($source as $s)
                              <option value="{{$s->id}}">{{$s->source}}</option>
                              @endforeach

                        </select>  
                        
                      </div>
                          </div>
                           <div class="col-md-3">
                             <div class="form-group">
                              <label>Status</label>
                               <select class="form-control select2" id="period" name="period" style="width: 100%;" required>
                                   <option  value="" selected="selected">Select Period</option>

                                    </select>   
                                        </div>
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                          </div>

                          </div>
                      
 
  </div>
  <div class="container">

  <!-- Trigger the modal with a button -->
  

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog"  style="width:1000px;">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="background-color:#0885b6; color:white;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Addmission Enquiry</h4>
        </div>
        <div class="modal-body">
          <form method="post" action="{{url('FrontOffice/insert_admission_enquiry')}}">
         <div class="row">
         
            <div class="col-md-4 form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                          <label for="name" class="control-label"> Name<span style="color:red;"> *</span></label>
                              <input id="school_name" type="text" class="form-control" name="name"  required autofocus>
         </div>
          <div class="col-md-4 form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                          <label for="name" class="control-label">Phone<span style="color:red;"> *</span></label>
                              <input id="school_name" type="text" class="form-control" name="phone" onkeypress="return isNumber(event)" max="10"  required autofocus>
              </div>
        <div class="col-md-4 form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                          <label for="name" class="control-label">Email<span style="color:red;"> </span></label>
                              <input id="school_name" type="email" class="form-control" name="email" >
         </div>
   
            
          </div>
           <div class="row">
         
            <div class="col-md-4 form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                          <label for="name" class="control-label"> Address<span style="color:red;"> </span></label>
                            <textarea class="form-control" name="address"></textarea>
         </div>
          <div class="col-md-4 form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                          <label for="name" class="control-label">Description<span style="color:red;"> </span></label>
                              <textarea class="form-control" name="description"></textarea>
              </div>
        <div class="col-md-4 form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                          <label for="name" class="control-label">Note<span style="color:red;"> </span></label>
                              <textarea class="form-control" name="note"></textarea>
         </div>
   
            
          </div>
              <div class="row">
         
            <div class="col-md-4 form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                          <label for="name" class="control-label"> Date<span style="color:red;"> </span></label>
                             <div class="input-group date">
                                 <div class="input-group-addon">
                                   <i class="fa fa-calendar"></i>
                                 </div>
                                 <input type="text" class="form-control pull-right dob" value="{{ old('dob') }}" id="date1" name="date" required readonly>
                               </div>
         </div>
          <div class="col-md-4 form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                          <label for="name" class="control-label">Next Follow Date<span style="color:red;"> </span></label>
                               <div class="input-group date">
                                 <div class="input-group-addon">
                                   <i class="fa fa-calendar"></i>
                                 </div>
                                 <input type="text" class="form-control pull-right dob" value="{{ old('dob') }}" id="date2" name="next_allow_date" required readonly>
                               </div>
              </div>
        <div class="col-md-4 form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                          <label for="name" class="control-label">Assigned<span style="color:red;"> </span></label>
                              <input type="text" name="assigned" class="form-control">
         </div>
   
            
          </div>

    
     <div class="row">
         
            <div class="col-md-3 form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                          <label for="name" class="control-label"> Reference<span style="color:red;"> </span></label>
                            <select name="reference" class="form-control">
                              <option>Select</option>
                             @foreach($reference as $r)
                             <option value="{{$r->id}}">{{$r->reference}}</option>
                             @endforeach
                            </select>
         </div>
          <div class="col-md-3 form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                          <label for="name" class="control-label">Resourse<span style="color:red;"> *</span></label>
                               <select name="resourse" class="form-control" required="">
                               <option>Select</option>
                              @foreach($source as $s)
                              <option value="{{$s->id}}">{{$s->source}}</option>
                              @endforeach
                            </select>
              </div>
        <div class="col-md-3 form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                          <label for="name" class="control-label">Class<span style="color:red;"> </span></label>
                             <select name="course" class="form-control">
                              <option>Select Class</option>
                              @foreach($course as $c)
                              <option value="{{$c->id}}">{{$c->course_name}}</option>
                              @endforeach
                             </select>
         </div>

         <div class="col-md-3 form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                          <label for="name" class="control-label">Number Of Child<span style="color:red;"> </span></label>
                              <input type="number" name="number_of_child" class="form-control">
         </div>
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="submit" name="save" value="Save" style="margin-right: 50px; float: right;" class="btn btn-primary">
            </form>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>

                <!-- /.form-group -->
              </div>
              </div>
  </div>
    <div class="box-body" >
      <div class="row">
        <div class="col-md-12" >
        <table class="table" id="enq">
          <thead>
            <tr>
              <th>Name</th>
              <th>Phone</th>
              <th>Source</th>
              <th>Enquiry Date</th>
             
              <th>Next Follow Up Date</th>
              
              <th>Action</th>
          
            </tr>
          </thead>
          <tbody>
            <tr></tr>
          </tbody>
        </table>


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
   $('#enq').DataTable( {

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
         $('#dob1').datepicker({
          autoclose: true,
          format:'dd-mm-yyyy'
        });
         $('#dob1').datepicker({
          autoclose: true,
          format:'dd-mm-yyyy'
        });
          $('#date1').datepicker({
          autoclose: true,
          format:'dd-mm-yyyy'
        });
           $('#date2').datepicker({
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
      function source()
      {
        //alert("hi");
        var start_date=$("#dob").val();
                var end_date=$("#dob1").val();
                 var source=$("#source").val();
                 //alert(start_date);
           var _url = $("#_url").val();
              var ds="start_date="+start_date+"&end_date="+end_date+"&source="+source;
           //alert(ds);
           $.ajax({
                  type: "POST",
                   url: _url + '/FrontOffice/show_admission_enquiry',
                   data: ds,
                   cache: false,
                   success:function(data)
                   {
                      //alert(data);
                       var sp = data.split("|");
                       var sp1=JSON.parse(sp[0]);
                    var cnt="";
                    for (var i = 0; i < sp1.length; i++) {
                      cnt += '<tr>';
                      cnt +='<td>'+sp1[i].name +'</td>';
                      cnt +='<td>'+sp1[i].phone +'</td>';
                      cnt +='<td>'+sp1[i].resourse +'</td>';
                      cnt +='<td>'+sp1[i].date +'</td>';
                      
                      cnt +='<td>'+sp1[i].next_follow_date +'</td>';
                      
                      
                      cnt += '</tr>';  
                  }
                    $('#enq').find('tbody').empty().append(cnt);
                   }
           });
      }
    </script>

<!--   Form vallidation -->
<script type="text/javascript">
  function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}
</script>


   <!--   <script>
       $(document).ready(function () {
       
           /*For Details Loading*/
           $("#source").change(function(){
             alert("hello");
               var start_date=$("#dob").val();
                var end_date=$("#dob1").val();
                 var source=$("#source").val();
              
          // alert(id);
               var _url = $("#_url").val();
              var ds="start_date="+start_date+"&end_date="+end_date+"&source="+source+;
           alert(ds);
               $.ajax
               ({
                   type: "POST",
                   url: _url + '/FrontOffice/show_admission_enquiry',
                   data: ds,
                   cache: false,
                   success: function ( data ) {
                  //alert(data);
                   //data=JSON.parse(data);
                   var sp = data.split("|");
                   var sp1=JSON.parse(sp[0]);
                   
                   
                    var cnt="";
                    
                      for (var j = 0; j < sp2.length; j++) {
                       
                       
                           cnt +='<td><'+sp2[j].start_time +'-'+ sp2[j].end_time+'<br>';
                          
                          cnt +='</td>';
                        }
                      
                      cnt += '</tr>';  
                  
                    $('#cls').find('tbody').empty().append(cnt);
           }

       });
     }); 
         });

   </script> -->

@endsection
<!-- ./wrapper -->
