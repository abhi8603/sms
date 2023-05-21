@extends('header')
@section('style')
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/bootstrap/dist/css/buttons.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/bootstrap/dist/css/rowReorder.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/bootstrap/dist/css/responsive.dataTables.min.css') }}">
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
        <li><a href="#"><i class="fa fa-dashboard"></i>Hostel </a></li>
        <li class="active">Fee Collection</li>
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
		<div style="margin-top:10px;" class="col-md-12">
		 
		<div class="box-header with-border">
                                   <h3 class="box-title">Hostel Visitors</h3>
                                 </div>
								 <div class="form-group col-md-6">
                                       <label for="exampleInputEmail1">User Type<span style="color:red;"> *</span></label>
                                      <select id="utype" class="form-control select2" style="width: 100%;">
                              <option selected="selected">Please Select</option>
                              <option value="student">Student</option>
                              <option value="employee">Employee</option>
                              
                       </select>     

                                        </div>
										<div id="stdnt" class="form-group col-md-6">
                          <label for="exampleInputEmail1">Student<span style="color:red;"> *</span></label>
                                           <input type="text" class="form-control" name="reg_no" id="reg_no"   required>
 </div><div id="emp" class="form-group col-md-6">
                          <label for="exampleInputEmail1">Employee <span style="color:red;"> *</span></label>
                                           <input type="text" class="form-control" name="reg_no" id="reg_no"   required>
 </div>
 <div class="form-group col-md-6" class="box-footer">
                        <button type="submit" class="btn btn-primary">Go</button>
                      </div>
										 
										</div>
		
          <div class="col-md-12">
		  
		  
            <!-- Custom Tabs -->
            <div class="nav-tabs-custom">
              <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1" data-toggle="tab">Fee Type</a></li>
                <li><a href="#tab_2" data-toggle="tab">Paid List</a></li>

                <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                  <div class="box-body">
                    <div class="row">
					
                      <div class="col-md-15">

                        <!-- /.form-group -->
                        <div class="box box-primary">
						
                                 <div class="box-header with-border">
                                   <h3 class="box-title">Hostel Visitors</h3>
                                 </div>
                                 <!-- /.box-header -->
                                 <!-- form start -->
                                 <form role="form" method="post" enctype="multipart/form-data" action="{{url('Academic-Details/add')}}">
                                   <div class="box-body">
                                     <div class="col-md-12">
                                     <div class="form-group col-md-6">
									  
                                       <label for="exampleInputEmail1">Fee Type<span style="color:red;"> *</span></label>
                                      <select id="utype" class="form-control select2" style="width: 100%;">
                              <option selected="selected">Please Select</option>
                              <option value="online">Online</option>
                              <option value="cash"> Cash</option>
                              
                       </select>     

                                        </div>
										
										<div   class="form-group col-md-6">
                          <label for="exampleInputEmail1"> Amount<span style="color:red;"> *</span></label>
                                           <input id="txt1" onkeyup="sum();" type="text" class="form-control" name="reg_no" id="reg_no"   required>
 </div>
 <div   class="form-group col-md-4">
                          <label for="exampleInputEmail1">Fine<span style="color:red;"> *</span></label>
                                           <input id="txt2" onkeyup="sum();" type="text" class="form-control" name="reg_no" id="reg_no"   required>
 </div>
 <div   class="form-group col-md-4">
 
                          <label for="exampleInputEmail1">Discount<span style="color:red;"> *</span></label>
                                           <input id="txt4" onkeyup="sum();" type="text" class="form-control" name="reg_no" id="reg_no"   required>
 </div><div id="emp" class="form-group col-md-4">
                          <label for="exampleInputEmail1">Remark <span style="color:red;"> *</span></label>
                                           <textarea type="text" class="form-control" name="reg_no" id="reg_no"   required></textarea>
 </div>
  <div class="form-group col-md-3">
									  
                                       <label for="exampleInputEmail1">Mode of Pay<span style="color:red;"> *</span></label>
                                      <select id="banktype" class="form-control select2" style="width: 100%;">
                              <option selected="selected">Please Select</option>
                              <option value="online">Cash</option>
                              <option value="cheque"> Cheque</option>
							   <option value="cash"> Online Payment</option>
                              
                       </select>     

                                        </div>
										<div id="bn"class="form-group col-md-3">
									  
                                       <label for="exampleInputEmail1">Bank Name<span style="color:red;"> *</span></label>
                                      <select   class="form-control select2" style="width: 100%;">
                              <option selected="selected">Please Select</option>
                              <option value="online">SBI</option>
                              <option value="cash"> BOI</option>
							   <option value="cash"> Canara Bank</option>
                              
                       </select>     

                                        </div>
										<div id="cn" class="form-group col-md-3">
                          <label for="exampleInputEmail1">Cheque No. <span style="color:red;"> *</span></label>
                                           <input type="text" class="form-control" name="reg_no" id="reg_no"   required>
 </div>
  <div id="cd"  class="form-group col-md-3">
                                       <label for="exampleInputEmail1">Cheque Date<span style="color:red;"> *</span></label>
                                      <div class="input-group date">
                                              <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                              </div>
                                              <input type="text" class="form-control pull-right" id="startdate" name="startdate">
                                            </div> 

                                        </div> 
										<div id="emp" class="form-group col-md-3">
                          <label for="exampleInputEmail1">Total Amount <span style="color:red;"> *</span></label>
                                           <input id="txt3"type="text" class="form-control" name="reg_no" id="reg_no"   required>
 </div>
 <div   class="form-group col-md-3">
                          <label for="exampleInputEmail1">Do You Want Receipt<span style="color:red;"> *</span></label>
                                        <input type="checkbox" checked="checked"   ></div>
										<div id="emp" class="form-group col-md-3">
                          <label for="exampleInputEmail1">Receipt No. <span style="color:red;"> *</span></label>
                                           <input type="text" class="form-control" name="reg_no" id="reg_no"   required>
 </div>
 
  
										 
   
   
                                        

                                         
										  
					   
					   
					   
  
  
  
 
                                    
      
                      
                                    
                                     
  
                                   </div>
								   

                                 </div>
								  
 
 
                                   <div class="box-footer">
                                     <button type="submit" class="btn btn-primary">Save</button>
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
                                <th>Receipt No.</th>
								<th>Hostel Room</th>
                                <th>Amount</th>
                                <th>Paid Date</th>
								<th>Fine</th>
								<th>Discount</th>
								<th>Remarks</th>
								 
                                
								 
                                 
                                 

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
<script src="{{ URL::asset('assets/plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/jquery/dist/bootbox.min.js') }}"></script>


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
	function sum() {
       var txtFirstNumberValue = document.getElementById('txt1').value;
       var txtSecondNumberValue = document.getElementById('txt2').value;
	   var txtThirdNumberValue = document.getElementById('txt4').value;
       if (txtFirstNumberValue == "")
           txtFirstNumberValue = 0;
       if (txtSecondNumberValue == "")
           txtSecondNumberValue = 0;
	   if (txtThirdNumberValue == "")
           txtThirdNumberValue = 0;

       var result = parseInt(txtFirstNumberValue) + parseInt(txtSecondNumberValue) -    parseInt(txtThirdNumberValue);
       if (!isNaN(result)) {
           document.getElementById('txt3').value = result;
       }
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
$("#bn").hide();
$("#cn").hide();
$("#cd").hide();
    $("#type").change(function(){
       var type = $(this).val();
      if(type=='rs'){
        $("#typechn").html("Fine Amount<span style='color:red;'> *</span>");
      }else{
        $("#typechn").html("Fine Percentage<span style='color:red;'> *</span>");
      }
    });
$("#banktype").change(function(){
       var types = $(this).val();
       if(types=='cheque'){
          $("#bn").show();
		  $("#cn").show();
		  $("#cd").show();
          $("#ht").fadeIn('slow');
        }else{
           $("#bn").hide();
		  $("#cn").hide();
		  $("#cd").hide();
           
		  
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
