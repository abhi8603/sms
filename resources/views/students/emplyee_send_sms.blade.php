@extends('header')
@section('style')
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/buttons.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/rowReorder.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/responsive.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/bootstrap-daterangepicker/daterangepicker.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/select2/dist/css/select2.min.css') }}">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>	
<style>
.selected {
  color: red;
  
}

.multiselect4 {
  width: 200px;
}
.selectBox4 {
  position: relative;
}
.selectBox4 select {
  width: 100%;
  font-weight: bold;
}
#checkboxes4 {
  display: none;
  border: 1px #dadada solid;
}
#checkboxes4 label {
  display: block;
}



#checkboxes1 label:hover {
  background-color: ;
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
        <li><a href="#"><i class="fa fa-dashboard"></i>Employee</a></li>

        <li class="active"> <a href="{{url('sms/emplyee/list/send/sms')}}">Employee Sms</a></li>
      </ol>
    </section>

    <!-- Main content -->
      <section class="content">
          @include('notification.notify')
    <div class="box box-default">
            <div class="box-header with-border">
             

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button style="display:none;" type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
              </div>
			  
			
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                
 <!-- /.box-header -->
                    <div class="box-body">
  <!---{{--
  <a href="{{url('student/boylist')}}"><button class="dt-button buttons-copy buttons-html5" type="button"><span>Boy's List</span></button></a>
  <a href="{{url('student/girllist')}}"><button class="dt-button buttons-copy buttons-html5" type="button"><span>Girl's List</span></button></a>
  <a href="{{url('sms/student/list/send/sms')}}"><button class="dt-button buttons-copy buttons-html5" type="button"><span>Send Sms Students</span></button></a>
  
  <a href="{{url('sms/emplyee/list/send/sms')}}"><button class="dt-button buttons-copy buttons-html5" type="button"><span> Employee Sms</span></button></a>--}}!-->

	 
                    </div>
                    <!-- /.box-body -->
                <div class="col-md-12">
                  <div class="box box-info">
                    <div class="box-header">
                     <!-- <h3 class="box-title">Search Employee Mobile No and Send some text messages.</h3> !-->
			        </div>
					
				
	
	
			<div class="col-md-12">
				
				<form role="form" method="post" enctype="multipart/form-data" action="{{url('employee/postsearch/send')}}">
				<!--{{--<div class="col-md-2">
						<label for="Sub Category">Academic Year</label>
							   <select class="form-control select2" name="accadmicyear" style="width: 100%;">
                          <option value="0" selected="selected">Please select</option>
                          <?php foreach ($accadmicyear as $accadmicyear): ?>
                                <option value="{{$accadmicyear->startyear}}-{{$accadmicyear->endyear}}">{{$accadmicyear->startyear}} - {{$accadmicyear->endyear}}</option>
                          <?php endforeach; ?>
                   </select>
						</div>
						--}}!-->
						<div class="col-md-4">
						<label for="Sub Category">Select Degignation</label>
							  <select class="form-control select2" name="category" id="category">
								 <option>Select Degignation </option>
								  @foreach($deg as $d)
                              <option value="{{$d->degination}}">{{$d->degination}}</option>
                              @endforeach
							  </select>
						</div>
						<!--{{--<div class="col-md-3">
								<label for="Sub Category">Select Name</label>
								<select  class="form-control select2" name="subcategory" id="subcategory">
								</select>
						</div>--}}!-->
						<!--{{--
						<div class="col-md-3">
								<label for="Sub Category">Select Mobile No: </label>
								<select  class="form-control select2" name="subcategory" id="subcategory">
								</select>
						</div>
						--}}!-->
						
						<!--{{--
						<div class="col-md-4">
						<label for="Sub Category">Select Mobile No:</label>
								 <select class="form-control select2" id="course" name="course" style="width: 100%;">
                                  <option value="0" selected="selected">Select Mobile No:</option>
								 <?php foreach ($batch_wise as $course): ?>
                                      <option value="{{$course->id}}">{{$course->batch_name}}</option>
								  <?php endforeach; ?>
                           </select>
							</div>
						--}}!--->
							
                <div class="col-md-4"><br>
					 <button type="submit" class="btn btn-primary btn-md">Search</button>
					 <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
                </div>
                </form>
			</div>
						<br>
				</div>
				
				
				
				
				
				
				
				
				
				
				<br><br>
				<!--{{--<div class="col-md-6">
				
				<!--{{---
				@foreach ($companies as $com)
				<div class="col-md-12">
					<div class="form-check">
						<input class="form-check-input" type="checkbox" name="" value="{{$com->phone}}"> &nbsp; &nbsp;{{$com->phone}} ({{$com->fname}})
						</div>
				</div>
				@endforeach
				--}}!-->
			
				
				<!--{{--
				<form>
				<div class="multiselect4" style="width:300px;">
					
					<div class="selectBox4" onclick="showCheckboxes4()">
					
					<select style="height:35px;border-top-left-radius:10px;
                        border-top-right-radius:10px;
                        border-bottom-right-radius:10px;
                        border-bottom-left-radius:10px;">
					<option> Select Mobile No: </option>
					</select>
					<div class="overSelect"></div>
					</div>
						<div id="checkboxes4" style="overflow-y:scroll;height:150px;width:300px;">
						<input class="form-check-input" type="checkbox" name="Select_All" value="" onclick="toggle(this);">
						<span class="form-check-sign" style="color:red;">Select All</span><br>
							@foreach ($companies as $com) 
							<!--{{--<table id="uploads_approval4">
								<tbody>
								<tr>
								<td><input class="form-check-input" type="checkbox">{{$com->phone}}</td>
								<th>({{$com->fname}})</th>
								</tr>
								</tbody>
							</table>--}}!-->
							
                        <!--{{-- <input type="text" id="bk" name="vehicle" onClick="checkbox();" value="{{$com->mb}}">{{$com->mb}} 
   
							@endforeach
							
						</div>
				</div>
				</form>
				
				</div> --}}!-->
				<br><br><br><br>
				<div class="col-md-12">
				
					
					
					<div class="col-md-5" style="overflow-y:scroll;height:250px;">
					<form method="post" enctype="multipart/form-data" action="{{url('employee/post/send/sms/insert')}}">
					<!--<input type="text" id="selectedRows11" placeholder="Enter Mobile No:" name="mobile" class="form-control" required style="height:150px;">
                   
						<!--<textarea type="text" placeholder=" Enter message here..."rows="4" cols="80" name="sms" form="usrform">
						</textarea>!-->
						@foreach ($companies as $com) 
							<!--{{--<table id="uploads_approval4">
								<tbody>
								<tr>
								<td><input class="form-check-input" type="checkbox">{{$com->phone}}</td>
								<th>({{$com->fname}})</th>
								</tr>
								</tbody>
							</table>--}}!-->
							
						
				<table>
				  <tr>
					  <th> <input type="text" id="bk" name="vehicle[]"  value="{{$com->phone}}" required >{{$com->fname}}</th>
					  
					  <td> <input type="hidden" id="bk" name="stu_id[]"value="{{$com->empcode}}" required></td>
					  
					  <td> <input type="hidden" id="bk" name="designation[]" value="{{$com->designation}}" required></td>
					  
					  <td> <input type="hidden" id="bk" name="fname[]"  value="{{$com->fname}}"></td>
					  
					  <td> <input type="hidden" id="bk" name="mname[]"  value="{{$com->mname}}"></td>
					  
					  <td> <input type="hidden" id="bk" name="lname[]"  value="{{$com->lname}}"></td>
					  <td> <input type="hidden" id="bk" name="status[]" value="Successfull" ></td>
				  </tr>
				</table>
                        
   
							@endforeach
						
				</div>
				
							
						<!--- <input type="text" id="show" class="form-control" required  name="vehicle" style="height:100px;width:;"><br>
						
						---!--->
						
						
						
						<div class="col-md-5">
						<!--<input type="text" name="sms" class="form-control"required style="height:150px;" placeholder="Enter Some message">!-->
						<textarea name="sms" class="form-control"required style="height:150px;" placeholder="Enter Some message to Emplyoee"></textarea>
						<br><br><br>
						
						<button type="submit" class="btn btn-primary">Submit</button>
					<input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
						</form>
						</div>
						<div class="col-md-12">
					
				
				
				
				
				
				
				</div>
				
				
				</div>
				
				
				
				<p id="demo"> </p>
				
				
				
					
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
<!-- Category!-->
<!--
 
!-->
<script>
function checkbox(){
  
  var checkboxes = document.getElementsByName('vehicle');
  var checkboxesChecked = [];
  // loop over them all
  for (var i=0; i<checkboxes.length; i++) {
     // And stick the checked ones onto an array...
     if (checkboxes[i].checked) {
        checkboxesChecked.push(checkboxes[i].value);
     }
  }
  document.getElementById("show").value = checkboxesChecked;

}

</script>
 <script>
		$(document).ready(function() {
	   $('#category').on('change', function() {
		   var category = $(this).val();
		   //alert(category);
		   var _url = $("#_url").val();
		   if(category) {
			   $.ajax({
				   url: _url +'/Member/Getsubcategoryss/'+ category,
				   type: "GET",
				   data : {"_token":"{{ csrf_token() }}"},
				   dataType: "json",
				   success:function(data) {
					   console.log(data);
					 if(data){
					   $('#subcategory').empty();
					   $('#subcategory').focus;
					   $('#subcategory').append('<option value="">-- SelectSection --</option>'); 
					   $.each(data, function(key, value){
					   $('select[name="subcategory"]').append('<option value="'+ value.id +'">' + value.fname+ '</option>');
				   });
				 }else{
				   $('#subcategory').empty();
				 }
				 }
			   });
		   }else{
			 $('#subcategory').empty();
		   }
	   });
   });
   </script>
<!-- Category!-->

<!--Select class get section AND select section and get mobile number!-->
     <script>
           $(document).ready(function () {
               /*For Details Loading*/
               $("#course").change(function(){
                   var id = $(this).val();
              //     alert(id);
                   var _url = $("#_url").val();
                   var dataString = 'eid=' + id;
                   $.ajax
                   ({
                       type: "POST",
                       url: _url + '/student/batchlist/wise',
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
<!--//Select class get section AND select section and get mobile number!-->

<!--<script>
$('#checkAll').click(function () {    
     $('input:checkbox').prop('checked', this.checked);  
var selected = [];
$('#checkboxes input:checked').each(function() {
    selected.push($(this).val(selected));
	$('#selectedRows11').val(selected);
});	
 
 });
</script>
!-->
<script>
$('#uploads_approval4 td').click(function(){
 $(this).toggleClass('selected');
 var row =[];
 $('.selected').each(function(i,key){
     row.push($(key).text());
  });
  $('#selectedRows11').val(row);
 });
</script>
<script>
var expanded = false;

function showCheckboxes4() {
  var checkboxes4 = document.getElementById("checkboxes4");
  if (!expanded) {
    checkboxes4.style.display = "block";
    expanded = true;
  } else {
    checkboxes4.style.display = "none";
    expanded = false;
  }
}
</script>

<script>
	function toggle(source) {
   var checkboxes = document.querySelectorAll('input[type="checkbox"]');
   //document.getElementById("test").innerHTML = "You selected:check " + checkboxes;
   for (var i = 0; i < checkboxes.length; i++) {
	   if (checkboxes[i] != source)
		   checkboxes[i].checked = source.checked;
   }
}
</script>

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
                        window.location.href = _url + "/student/delete/" + id;
                    }
                });
            });

        });
    </script>
    <script>
           $(document).ready(function () {
               /*For Details Loading*/
               $("#course").change(function(){
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
$(document).ready(function() {
   $.extend($.fn.dataTable.defaults, {
 dom: 'Bfrtip'
});
   $('#example').DataTable( {

       buttons: [
           'copy', 'csv', 'excel', 'pdf', 'print'
       ],
       pageLength: 100,
       responsive: true


   } );
   } );

</script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
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
