@extends('header')
@section('style')
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/bootstrap/dist/css/buttons.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/bootstrap/dist/css/rowReorder.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/bootstrap/dist/css/responsive.dataTables.min.css') }}">
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
        <li><a href="#"><i class="fa fa-dashboard"></i>Hostel </a></li>
        <li class="active">Room Occupied Report</li>
      </ol>
    </section>
    <section class="content">
        @include('notification.notify')
  <div class="box box-default">
    <!-- Main content -->
    <div class="box-header with-border">
      <h3 class="box-title"> </h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        <button style="display:none;" type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
      </div>
    </div>

        <div class="row">
          <div class="col-md-12">
            <!-- Custom Tabs -->
            <div class="nav-tabs-custom">
               
              <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                  <div class="box-body">
                    <div class="row">
                      <div class="col-md-15">

                        <!-- /.form-group -->
                        <div  >
                                 <div class="box-header with-border">
                                   <h3 class="box-title">Available Room Wise Occupied Report</h3>
                                 </div>
                                 <!-- /.box-header -->
                                 <!-- form start -->
                                 <form onSubmit="return validateForm()" role="form" method="post" enctype="multipart/form-data" action="{{url('Academic-Details/add')}}">
                                   <div class="box-body">
                                     <div class="col-md-12">
                                     <div id="uname" class="form-group col-md-6">
                                       <label for="exampleInputEmail1">Hostel Type  <span style="color:red;"> *</span></label>
                                      <select id="uname" id="utype" class="form-control select2" style="width: 100%;">
                              <option selected="selected">Please Select</option>
                              <option id="uname" value="student">Student</option>
                              <option id="uname" value="employee">Employee</option>
                              
                       </select>     

                                        </div>
										 <div  id="uname"  class="form-group col-md-6">
                                       <label for="exampleInputEmail1">Hostel Name<span style="color:red;"> *</span></label>
                                      <select id="uname" id="openh" class="form-control select2" style="width: 100%;">
                              <option selected="selected">Please Select</option>
                              <option value=" 1">Hostel1</option>
                              <option value="1">Hostel2</option>
                               
                       </select>     

                                        </div>
										 
										
										  
 <div class="box-footer"><div   class="form-group col-md-4">
                        	<input type="button" class="btn btn-danger" onclick="printDiv('print')" value="Print" report="">
						</div>
						  
                      </div>
					   <div   class="box-footer">
                                     
                                   </div>
								   <html>
 
 
<body onload="javascript:hideTable()">
 
 
</body>
</html>
  
										   
										 
					   
					   
										 
					   
  
  
  
 
                                    
      
                      
                                    
                                     
  
                                   </div>
								   

                                 </div>
                                    
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                 </form>
                               </div>

                        <!-- /.form-group -->
                      </div>
                      
            </div>
          </div>
        </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="tab_2">
                  <form role="form" method="post" enctype="multipart/form-data" action="">
                  <div class="box-body">
                    <div class="row">
                      
						<div class="col-md-16">
                         
                          
                          <!-- /.box-header -->
                          <div class="box-body col-md-16">
                            <table id="example1" class="table table-striped table-bordered display nowrap" style="width:100%">
                              <thead>
                              <tr>
                                <th>Sl.No</th>
								<th>User Type</th>
                                <th>User</th>
                                <th>From Hostel</th>
								<th>To Hostel</th>
								 
                                <th>Date</th>
								 
                                 
                                 

                              </tr>
                              </thead>
                              <tbody>
                            
                              <tr>
                                <td></td>
								 <td></td>
                                <td></td>
                                <td></td>
								<td></td>
								 <td></td>
                                 
                                
                                
                                
                               
                                

                              </tr>
                           
                              </tbody>

                            </table>
							  
                      <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                      </div>
                          </div>
                          <!-- /.box-body -->
                        </div>
                      
                        </div>
                        </div>
						</form>
                        </div>
						 
                       
                </div>

              </div>
              <!-- /.tab-content -->
            </div>
            <!-- nav-tabs-custom -->

    </section>
    <!-- /.content -->
  </div>
  </div>
  </div>
  <!-- /.content-wrapper -->

@endsection
{{--External Style Section--}}
@section('script')
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script>
        $(document).ready(function () {
            /*For Delete Application Info*/
            $(".tFileDelete").click(function (e) {
                e.preventDefault();
                var id = this.id;
                bootbox.confirm("Are you sure?", function (result) {
                    if (result) {
                        var _url = $("#_url").val();
                        window.location.href = _url + "/Academic-Details/delete/" + id;
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
  function validateForm() {
      var uname=document.getElementById("uname").value;
      if (uname==""){
          alert("Username is obligatory");
          return false;
      }
  }
</script>
	<script>
function showTable(){
document.getElementById('table').style.visibility = "visible";
}
function hideTable(){
document.getElementById('table').style.visibility = "hidden";
}
</script>
	<script>
function myFunction() {
    var x = document.getElementById("myDIV1");
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
}
</script>
	<script>
$(document).ready(function(){
$("#stdnt").hide();
$("#emp").hide();
    $("#type").change(function(){
       var type = $(this).val();
      if(type=='rs'){
        $("#typechn").html("Fine Amount<span style='color:red;'> *</span>");
      }else{
        $("#typechn").html("Fine Percentage<span style='color:red;'> *</span>");
      }
    });
$("#utype").change(function(){
       var types = $(this).val();
       if(types=='student'){
          $("#stdnt").show();
          $("#stdnt").fadeIn('slow');
        }else{
          $("#stdnt").hide();
          $("#dell").fadeOut('slow');
		  $("#emp").show();
          $("#emp").fadeIn('slow');
		  
        }
    });
$("#finetype").change(function(){
       var types = $(this).val();
      if(types=='Incremental'){
          $("#fineincrement").show();
          $("#fineincrement").fadeIn('slow');
        }else{
          $("#fineincrement").hide();
          $("#fineincrement").fadeOut('slow');
        }
    });
});
</script>
<script>
$(document).ready(function(){
$("#tbl2").hide();
$("#emp").hide();
    $("#type").change(function(){
       var type = $(this).val();
      if(type=='rs'){
        $("#typechn").html("Fine Amount<span style='color:red;'> *</span>");
      }else{
        $("#typechn").html("Fine Percentage<span style='color:red;'> *</span>");
      }
    });
$("#tblopen1").change(function(){
       var types = $(this).val();
       if(types=='1'){
          $("#tbl2").show();
          $("#stdnt").fadeIn('slow');
        }else{
          $("#tbl2").hide();
          $("#dell").fadeOut('slow');
		  $("#emp").show();
          $("#emp").fadeIn('slow');
		  
        }
    });
$("#finetype").change(function(){
       var types = $(this).val();
      if(types=='Incremental'){
          $("#fineincrement").show();
          $("#fineincrement").fadeIn('slow');
        }else{
          $("#fineincrement").hide();
          $("#fineincrement").fadeOut('slow');
        }
    });
});
</script>
<script>
$(document).ready(function(){
$("#ht").hide();
$("#hn").hide();
$("#hr").hide();
    $("#type").change(function(){
       var type = $(this).val();
      if(type=='rs'){
        $("#typechn").html("Fine Amount<span style='color:red;'> *</span>");
      }else{
        $("#typechn").html("Fine Percentage<span style='color:red;'> *</span>");
      }
    });
$("#openh").change(function(){
       var types = $(this).val();
       if(types=='transfer'){
          $("#ht").show();
		  $("#hn").show();
		  $("#hr").show();
          $("#ht").fadeIn('slow');
        }else{
          $("#ht").hide();
		  $("#hn").hide();
		  $("#hr").hide();
           
		  
        }
    });
$("#finetype").change(function(){
       var types = $(this).val();
      if(types=='Incremental'){
          $("#fineincrement").show();
          $("#fineincrement").fadeIn('slow');
        }else{
          $("#fineincrement").hide();
          $("#fineincrement").fadeOut('slow');
        }
    });
});
</script>
<script>
$(document).ready(function(){
$("#tbl").hide();
 
    
$("#tblopen").change(function(){
       var types = $(this).val();
       if(types=='1'){
          $("#tbl").show();
          $("#tbl").fadeIn('slow');
        }else{
          $("#tbl").hide();
          $("#tbl").fadeOut('slow');
		  
		  
        }
    });
$ 
});
</script>
<script>
$(document).ready(function(){
$("#tbl1").hide();
 
    
$("#tblopen1").change(function(){
       var types = $(this).val();
       if(types=='1'){
          $("#tbl").show();
          $("#tbl").fadeIn('slow');
        }else{
          $("#tbl").hide();
          $("#tbl").fadeOut('slow');
		  
		  
        }
    });
$ 
});
</script>
	<script>
    // jQuery ".Class" SELECTOR.
    $(document).ready(function() {
        $('.groupOfTexbox').keypress(function (event) {
            return isNumber(event, this)
        });
    });
    // THE SCRIPT THAT CHECKS IF THE KEY PRESSED IS A NUMERIC OR DECIMAL VALUE.
    function isNumber(evt, element) {

        var charCode = (evt.which) ? evt.which : event.keyCode

        if (
            (charCode != 45 || $(element).val().indexOf('-') != -1) &&      // “-” CHECK MINUS, AND ONLY ONE.
            (charCode != 46 || $(element).val().indexOf('.') != -1) &&      // “.” CHECK DOT, AND ONLY ONE.
            (charCode < 48 || charCode > 57))
            return false;

        return true;
    }    
</script>
	<script>
	function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}</script>
<SCRIPT language=Javascript>
       <!--
       function isNumberKey(evt)
       {
          var charCode = (evt.which) ? evt.which : evt.keyCode;
          if (charCode != 46 && charCode > 31 
            && (charCode < 48 || charCode > 57))
             return false;

          return true;
       }
       //-->
    </SCRIPT>
	<script>
	function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}</script>
<script>
$(document).ready(function() {
   $.extend($.fn.dataTable.defaults, {
 dom: 'Bfrtip'
});
   $('#example').DataTable( {

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
$(document).ready(function() {
   $.extend($.fn.dataTable.defaults, {
 dom: 'Bfrtip'
});
   $('#example1').DataTable( {

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
@endsection
<!-- ./wrapper -->
