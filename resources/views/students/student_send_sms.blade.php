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
.multiselect1 {
  width: 280px;
}
.selectBox1 {
  position: relative;
}

.selectBox1 select {
  width: 100%;
  font-weight: bold;
}

#checkboxes1 {
  display: none;
  border: 1px #dadada solid;
}

#checkboxes1 label {
  display: block;
}
.overSelect {
  position: absolute;
  left: 0;
  right: 0;
  top: 0;
  bottom: 0;
}


.multiselect2 {
  width: 200px;
}
.selectBox2 {
  position: relative;
}
.selectBox2 select {
  width: 100%;
  font-weight: bold;
}
#checkboxes2 {
  display: none;
  border: 1px #dadada solid;
}
#checkboxes2 label {
  display: block;
}



.multiselect3 {
  width: 200px;
}
.selectBox3 {
  position: relative;
}
.selectBox3 select {
  width: 100%;
  font-weight: bold;
}
#checkboxes3 {
  display: none;
  border: 1px #dadada solid;
}
#checkboxes3 label {
  display: block;
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




.multiselect5 {
  width: 200px;
}
.selectBox5 {
  position: relative;
}
.selectBox5 select {
  width: 100%;
  font-weight: bold;
}
#checkboxes5 {
  display: none;
  border: 1px #dadada solid;
}
#checkboxes5 label {
  display: block;
}


.multiselect6 {
  width: 200px;
}
.selectBox6 {
  position: relative;
}
.selectBox6 select {
  width: 100%;
  font-weight: bold;
}
#checkboxes6 {
  display: none;
  border: 1px #dadada solid;
}
#checkboxes6 label {
  display: block;
}



.multiselect7 {
  width: 200px;
}
.selectBox7 {
  position: relative;
}
.selectBox7 select {
  width: 100%;
  font-weight: bold;
}
#checkboxes7 {
  display: none;
  border: 1px #dadada solid;
}
#checkboxes7 label {
  display: block;
}


.multiselect8 {
  width: 200px;
}
.selectBox8 {
  position: relative;
}
.selectBox8 select {
  width: 100%;
  font-weight: bold;
}
#checkboxes8 {
  display: none;
  border: 1px #dadada solid;
}
#checkboxes8 label {
  display: block;
}



.multiselect9 {
  width: 200px;
}
.selectBox9 {
  position: relative;
}
.selectBox9 select {
  width: 100%;
  font-weight: bold;
}
#checkboxes9 {
  display: none;
  border: 1px #dadada solid;
}
#checkboxes9 label {
  display: block;
}


.multiselect10 {
  width: 200px;
}
.selectBox10 {
  position: relative;
}
.selectBox10 select {
  width: 100%;
  font-weight: bold;
}
#checkboxes10 {
  display: none;
  border: 1px #dadada solid;
}
#checkboxes10 label {
  display: block;
}



.multiselect11 {
  width: 200px;
}
.selectBox11 {
  position: relative;
}
.selectBox11 select {
  width: 100%;
  font-weight: bold;
}
#checkboxes11 {
  display: none;
  border: 1px #dadada solid;
}
#checkboxes11 label {
  display: block;
}


.multiselect12 {
  width: 200px;
}
.selectBox12 {
  position: relative;
}
.selectBox12 select {
  width: 100%;
  font-weight: bold;
}
#checkboxes12 {
  display: none;
  border: 1px #dadada solid;
}
#checkboxes12 label {
  display: block;
}



.multiselect13 {
  width: 200px;
}
.selectBox13 {
  position: relative;
}
.selectBox13 select {
  width: 100%;
  font-weight: bold;
}
#checkboxes13 {
  display: none;
  border: 1px #dadada solid;
}
#checkboxes13 label {
  display: block;
}



.multiselect14 {
  width: 200px;
}
.selectBox14 {
  position: relative;
}
.selectBox14 select {
  width: 100%;
  font-weight: bold;
}
#checkboxes14 {
  display: none;
  border: 1px #dadada solid;
}
#checkboxes14 label {
  display: block;
}


.studentsnm{display: block;}

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
        <li><a href="#"><i class="fa fa-dashboard"></i>Student</a></li>

        <li class="active"><a href="{{url('sms/student/list/send/sms')}}">Student Sms </a></li>
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
  <!--{{--<a href="{{url('student/boylist')}}"><button class="dt-button buttons-copy buttons-html5" type="button"><span>Boy's List</span></button></a>
  <a href="{{url('student/girllist')}}"><button class="dt-button buttons-copy buttons-html5" type="button"><span>Girl's List</span></button></a>
 
  <a href="{{url('sms/emplyee/list/send/sms')}}"><button class="dt-button buttons-copy buttons-html5" type="button"><span>Send Sms Employee</span></button></a>
   <a href="{{url('sms/student/list/send/sms')}}"><button class="dt-button buttons-copy buttons-html5" type="button"><span>Students Sms</span></button></a>--}}!-->

	 
                    </div>
                    <!-- /.box-body -->
					
					
					
					
				
                <div class="col-md-12">
                  <div class="box box-info">
                    <div class="box-header">
                     <!-- <h3 class="box-title">Search Students Mobile No and Send Some text messages. </h3> !-->
			        </div>
					
				
							
				<div class="col-md-12">
				
				<form role="form" method="post" enctype="multipart/form-data" action="{{url('student/postsearch/sir')}}">
				<div class="col-md-2">
						<label for="Sub Category">Academic Year</label>
							   <select class="form-control select2" name="accadmicyearwise" style="width: 100%;">
                          <option value="0" selected="selected">Please select</option>
                          <?php foreach ($accadmicyear as $accadmicyear): ?>
                                <option value="{{$accadmicyear->startyear}}-{{$accadmicyear->endyear}}">{{$accadmicyear->startyear}} - {{$accadmicyear->endyear}}</option>
                          <?php endforeach; ?>
                   </select>
						</div>
						<div class="col-md-3">
						<label for="Sub Category">Select Class</label>
							  <select class="form-control select2" name="category" id="category">
								 <option>Select Class Wise </option>
								 @foreach($select_class as $cat)
							  <option value="{{$cat->id}}">{{ucfirst($cat->course_name)}}</option>
								  @endforeach
							  </select>
						</div>
						<div class="col-md-3">
								<label for="Sub Category">Select Section</label>
								<select  class="form-control select2" name="subcategory" id="subcategory">
								</select>
						</div>
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
							 
                 <div class="col-md-2"><br>
                 <button type="submit" class="btn btn-primary">Search</button>
                 <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
            </div>
         </form>
					</div>
						<br>
						
				
				</div>
				
				
				
				
				
				
				
				
				
				
				{{--
				<!--- parent or guardian start !--->			 
				<!--- 
				<form>
				<div class="multiselect2" style="width:260px;">
					<div class="selectBox2" onclick="showCheckboxes2()">
					<select style="height:30px;">
					<option >guardian Contact Number</option>
					</select>
					<div class="overSelect"></div>
					</div>
						<div id="checkboxes2" style="overflow-y:scroll;height:150px;width:260px;">
							@foreach($studentss as $students)
							<table id="uploads_approval2">
								<tbody>
								<tr>
								<td><input class="form-check-input" type="checkbox">{{$students->father_phone}}</td>
								<th>({{$students->stu_name}})</th>
								</tr>
								</tbody>
							</table>
							@endforeach
						</div>
				</div>
				</form>
				!--->

				<!--- parent or guardian end !--->
				
				--}}
				<!--- teachers start !--->			 
				{{--
				<!---
				<form>
				<div class="multiselect3" style="width:260px;">
					<div class="selectBox3" onclick="showCheckboxes3()">
					<select style="height:30px;">
					<option>Teachers Contact Number</option>
					</select>
					<div class="overSelect"></div>
					</div>
						<div id="checkboxes3" style="overflow-y:scroll;height:150px;width:260px;">
							@foreach($students_no as $students1)
							<table id="uploads_approval3">
								<tbody>
								<tr>
								<td><input class="form-check-input" type="checkbox">{{$students1->phone}}</td>
								<th>({{$students1->stu_name}})</th>
								</tr>
								</tbody>
							</table>
							@endforeach
						</div>
				</div>
				</form>
				!--->
				--}}
				
				<!--- teacher end !--->
				
				
				<!--- driver start !--->			 
				{{--
				<!---<form>
				<div class="multiselect4" style="width:260px;">
					<div class="selectBox4" onclick="showCheckboxes4()">
					<select style="height:30px;">
					<option >Drivers Contact Number</option>
					</select>
					<div class="overSelect"></div>
					</div>
					<div id="checkboxes4" style="overflow-y:scroll;height:150px;width:260px;">
							@foreach($driver as $driverss)
							<table id="uploads_approval4">
								<tbody>
								<tr>
								<td><input class="form-check-input" type="checkbox">{{$driverss->phone}}</td>
								<th>({{$driverss->name}})</th>
								</tr>
								</tbody>
							</table>
							@endforeach
						</div>
				</div>
				</form>
				!-->

				<!--- driver end !--->
				
				--}}
				<br><br>
				
				<div class="row">
				<br><br>
				<!--{{--<div class="col-md-6">
				<form>
				<div class="multiselect4" style="width:320px;">
				
					<div class="selectBox4" onclick="showCheckboxes4()">
					 &nbsp;&nbsp;&nbsp;
					 
					<select style="height:35px;border-top-left-radius:10px;
                        border-top-right-radius:10px;
                        border-bottom-right-radius:10px;
                        border-bottom-left-radius:10px;">
					<option> Select Mobile No: </option>
					</select>  
					<div class="overSelect"></div>
					</div>
					
					
					
					
					
						<div id="checkboxes4" style="overflow-y:scroll;height:150px;width:320px;">
						<input class="form-check-input" type="checkbox" name="Select_All" value="" onclick="toggle(this);"><span class="form-check-sign" style="color:red;">Select All</span><br>
							@foreach ($companies as $com) 
							<!--{{--<table id="uploads_approval4">
								<tbody>
								<tr>
								<td><input class="form-check-input" type="checkbox">{{$com->phone}}</td>
								<th>({{$com->stu_name}})</th>
								</tr>
								</tbody>
							</table>
							--}}!-->
						<!--{{--	<input type="checkbox" id="bk" name="vehicle" onClick="checkbox();" value="{{$com->student_mobile}}">{{$com->student_mobile}}
						
							@endforeach
							
							
							
						</div>
						<!--
						<button class="btn btn-info">All</button>
						!-->
				<!--</div>
				</form>
				</div>--}}!-->
				</div>
				
				<br><br><br>
				<div class="col-md-12">
				
				<div class="col-md-6" style="overflow-y:scroll;height:250px;">
					<!--<p id="test"></p>!-->
					<form method="post" enctype="multipart/form-data" action="{{url('student/post/send/sms/insert')}}">
						<!--
						<input type="text" id="selectedRowsss" placeholder="Enter Mobile No:" name="mobile" class="form-control" required style="height:100px;width:;">
						!-->
						<!--{{--<input type="text" id="show" class="form-control"required  name="vehicle" style="height:100px;width:;"><br>--}}!-->
						<!--{{--
						<div class="" style="overflow-y:scroll;height:250px;">
						@foreach ($companies as $com)
							<table>
							<tr>
							<td><input type="text" value="{{$com->phone}}" name="mobile"></td><th><label>{{$com->stu_name}}</label></th>
							
							@endforeach
							
								</textarea>
								</tr>
								</table>
								</div>
						--}}!-->
						<h4> Total No of Students : {{$companies_count}} </h4>

						
							<!--{{--<table id="uploads_approval4">
								<tbody>
								<tr>
								<td><input class="form-check-input" type="checkbox">{{$com->phone}}</td>
								<th>({{$com->fname}})</th>
								</tr>
								</tbody>
							</table>--}}!-->
							
						
				<table>
				
				
							@foreach ($companies as $com)
							
				  <tr>
				 
					  <th > <input type="text" id="bk" name="mobile[]" readonly value="{{$com->phone}}"  >{{$com->stu_name}}</th>
					  
					  <td> <input type="hidden" id="bk" name="stu_name[]" readonly value="{{$com->stu_name}}"></td>
					  
					  <td> <input type="hidden" id="bk" name="roll_no[]" readonly value="{{$com->roll_no}}"></td>
					  
					  <td> <input type="hidden" id="bk" name="reg_no[]" readonly  value="{{$com->reg_no}}"></td>
					  
					  <td> <input type="hidden" id="bk" name="accdmic_year[]" readonly value="{{$com->accdmic_year}}"></td>
					  
					  <td> <input type="hidden" id="bk" name="course[]" readonly readonly value="{{$com->course}}"></td>
					  
					  
					  
					  <td> <input type="hidden" id="bk" name="status[]" value="Successfull" ></td>
				  </tr>
				  @endforeach
				  
				</table>
                        
   
							
						
						
						
						
						
						
						
						<!-- END !-->
						</div><br><br>
						
						
						
						<div class="col-md-5">
						<!--<input type="text" name="sms" class="form-control"required style="height:100px;" placeholder="Enter Some message">!-->
						
						<textarea id="Company_des" name="sms" class="form-control"required style="height:200px;" placeholder="Enter Some message to Students"></textarea>
						<br><br>
						<button type="submit" class="btn btn-primary">Submit</button>
					<input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
					</form>
						
						
				</div>
				
				<br><br><br>
								
				</div>
			<!--- Particular message send !--->
			<br>.<hr style="background-color:#00c0ef;height:3px;">
				<div class="col-md-5">
				
				<h3> Send Particular message</h3>
				<form method="post" enctype="multipart/form-data" action="{{url('particular/post/send/sms/insert')}}">
				<label>Enter Mobile No:</label>
				<input type="text" name="mobile" class="form-control" required value="" >
				<input type="hidden"  name="status" value="Successfull" >
				<label>Enter Some Text:</label>
				<textarea id="Company_des" name="sms" class="form-control" required style="height:200px;" placeholder="Enter Some message to Students"></textarea>
						<br><br>
						<button type="submit" class="btn btn-primary">Submit</button>
					<input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
				</div>
				
				<!--- // Particular message send !--->
				<!--{{--
				<div class="col-md-4">
				
				<!--- driver start !--->			 
				<!--
				<form>
				<div class="multiselect4" style="width:260px;">
					<div class="selectBox4" onclick="showCheckboxes4()">
					<select style="height:30px;">
					<option> Contact Number </option>
					</select>
					<div class="overSelect"></div>
					</div>
						<div id="checkboxes4" style="overflow-y:scroll;height:150px;width:260px;">
							 @foreach ($companies as $com) 
							<table id="uploads_approval4">
								<tbody>
								<tr>
								<td><input class="form-check-input" type="checkbox">{{$com->stu_name}}</td>
								<th>({{$com->stu_name}})</th>
								</tr>
								</tbody>
							</table>
							@endforeach
						</div>
				</div>
				</form>
				--}}!-->

				<!--- driver end !--->
				
				<!--
				</div> !-->
				
				
				
				
				
				
				
				
				<!--{{--<div class="col-md-4">
				<table>
				@foreach($driver as $driverss)
				 <tr>
				     <th>{{$driverss->name}} ({{$driverss->phone}})</th>
				 </tr>
				 @endforeach
				</table>
				</div>
				--}}!-->
				
				
				
				
				
				<!---!--->
				
				
				<!---!--->
				
				
				
				
				
				
				
					
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
				   url: _url +'/Member/Getsubcategory/'+ category,
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
					   $('select[name="subcategory"]').append('<option value="'+ value.id +'">' + value.batch_name+ '</option>');
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

<!--- Nursery ( A ) Student contact mobile number fetch!--->
<script>
$('#uploads_approval1 td').click(function(){
 $(this).toggleClass('selected');
 var row =[];
 $('.selected').each(function(i,key){
     row.push($(key).text());
  });
  $('#selectedRows').val(row);
 });
</script>
<script>
var expanded = false;

function showCheckboxes1() {
  var checkboxes1 = document.getElementById("checkboxes1");
  if (!expanded) {
    checkboxes1.style.display = "block";
    expanded = true;
  } else {
    checkboxes1.style.display = "none";
    expanded = false;
  }
}
</script>
<!--- // Nursery Student contact mobile number fetch!--->
<!---  JR KG ( A ) Student contact mobile number fetch!--->
<script>
$('#uploads_approval2 td').click(function(){
 $(this).toggleClass('selected');
 var row =[];
 $('.selected').each(function(i,key){
     row.push($(key).text());
  });
  $('#selectedRows').val(row);
 });
</script>
<script>
var expanded = false;

function showCheckboxes2() {
  var checkboxes2 = document.getElementById("checkboxes2");
  if (!expanded) {
    checkboxes2.style.display = "block";
    expanded = true;
  } else {
    checkboxes2.style.display = "none";
    expanded = false;
  }
}
</script>
<!--- // JR KG ( A ) Student  contact mobile number fetch!--->
<!---  JR KG ( B ) Student  contact mobile number fetch!--->
<script>
$('#uploads_approval3 td').click(function(){
 $(this).toggleClass('selected');
 var row =[];
 $('.selected').each(function(i,key){
     row.push($(key).text());
  });
  $('#selectedRows').val(row);
 });
</script>
<script>
var expanded = false;

function showCheckboxes3() {
  var checkboxes3 = document.getElementById("checkboxes3");
  if (!expanded) {
    checkboxes3.style.display = "block";
    expanded = true;
  } else {
    checkboxes3.style.display = "none";
    expanded = false;
  }
}
</script>
<!--- // JR KG ( B ) Student  contact mobile number fetch!--->
<!---  JR KG ( C ) Student  contact mobile number fetch!--->
<script>
$('#uploads_approval4 td').click(function(){
 $(this).toggleClass('selected');
 var row =[];
 $('.selected').each(function(i,key){
     row.push($(key).text());
  });
  $('#selectedRowsss').val(row);
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
<!--- // JR KG ( C ) Student  contact mobile number fetch!--->
<!--- SR KG ( A ) Student  contact mobile number fetch!--->
<script>
$('#uploads_approval5 td').click(function(){
 $(this).toggleClass('selected');
 var row =[];
 $('.selected').each(function(i,key){
     row.push($(key).text());
  });
  $('#selectedRows').val(row);
 });
</script>
<script>
var expanded = false;

function showCheckboxes5() {
  var checkboxes5 = document.getElementById("checkboxes5");
  if (!expanded) {
    checkboxes5.style.display = "block";
    expanded = true;
  } else {
    checkboxes5.style.display = "none";
    expanded = false;
  }
}
</script>
<!--- // SR KG ( A ) Student  contact mobile number fetch!--->
<!--- SR KG ( B ) Student  contact mobile number fetch!--->
<script>
$('#uploads_approval6 td').click(function(){
 $(this).toggleClass('selected');
 var row =[];
 $('.selected').each(function(i,key){
     row.push($(key).text());
  });
  $('#selectedRows').val(row);
 });
</script>
<script>
var expanded = false;

function showCheckboxes6() {
  var checkboxes6 = document.getElementById("checkboxes6");
  if (!expanded) {
    checkboxes6.style.display = "block";
    expanded = true;
  } else {
    checkboxes6.style.display = "none";
    expanded = false;
  }
}
</script>
<!--- // SR KG ( B ) Student  contact mobile number fetch!--->
<!--- SR KG ( C ) Student  contact mobile number fetch!--->
<script>
$('#uploads_approval7 td').click(function(){
 $(this).toggleClass('selected');
 var row =[];
 $('.selected').each(function(i,key){
     row.push($(key).text());
  });
  $('#selectedRows').val(row);
 });
</script>
<script>
var expanded = false;

function showCheckboxes7() {
  var checkboxes7 = document.getElementById("checkboxes7");
  if (!expanded) {
    checkboxes7.style.display = "block";
    expanded = true;
  } else {
    checkboxes7.style.display = "none";
    expanded = false;
  }
}
</script>
<!--- // SR KG ( C ) Student  contact mobile number fetch!--->
<!--- Class 1  ( A ) Student  contact mobile number fetch!--->
<script>
$('#uploads_approval8 td').click(function(){
 $(this).toggleClass('selected');
 var row =[];
 $('.selected').each(function(i,key){
     row.push($(key).text());
  });
  $('#selectedRows').val(row);
 });
</script>
<script>
var expanded = false;

function showCheckboxes8() {
  var checkboxes8 = document.getElementById("checkboxes8");
  if (!expanded) {
    checkboxes8.style.display = "block";
    expanded = true;
  } else {
    checkboxes8.style.display = "none";
    expanded = false;
  }
}
</script>
<!--- // Class  1 ( A ) Student  contact mobile number fetch!--->
<!--- Class 1  ( B ) Student  contact mobile number fetch!--->
<script>
$('#uploads_approval9 td').click(function(){
 $(this).toggleClass('selected');
 var row =[];
 $('.selected').each(function(i,key){
     row.push($(key).text());
  });
  $('#selectedRows').val(row);
 });
</script>
<script>
var expanded = false;

function showCheckboxes9() {
  var checkboxes9 = document.getElementById("checkboxes9");
  if (!expanded) {
    checkboxes9.style.display = "block";
    expanded = true;
  } else {
    checkboxes9.style.display = "none";
    expanded = false;
  }
}
</script>
<!--- // Class  1 ( B ) Student  contact mobile number fetch!--->
<!--- Class 1  ( C ) Student  contact mobile number fetch!--->
<script>
$('#uploads_approval10 td').click(function(){
 $(this).toggleClass('selected');
 var row =[];
 $('.selected').each(function(i,key){
     row.push($(key).text());
  });
  $('#selectedRows').val(row);
 });
</script>
<script>
var expanded = false;

function showCheckboxes10() {
  var checkboxes10 = document.getElementById("checkboxes10");
  if (!expanded) {
    checkboxes10.style.display = "block";
    expanded = true;
  } else {
    checkboxes10.style.display = "none";
    expanded = false;
  }
}
</script>
<!--- // Class  1 ( C ) Student  contact mobile number fetch!--->
<!--- Class 2  ( A ) Student  contact mobile number fetch!--->
<script>
$('#uploads_approval11 td').click(function(){
 $(this).toggleClass('selected');
 var row =[];
 $('.selected').each(function(i,key){
     row.push($(key).text());
  });
  $('#selectedRows').val(row);
 });
</script>
<script>
var expanded = false;

function showCheckboxes11() {
  var checkboxes11 = document.getElementById("checkboxes11");
  if (!expanded) {
    checkboxes11.style.display = "block";
    expanded = true;
  } else {
    checkboxes11.style.display = "none";
    expanded = false;
  }
}
</script>
<!--- // Class  2 ( A ) Student  contact mobile number fetch!--->
<!--- Class 2  ( B ) Student  contact mobile number fetch!--->
<script>
$('#uploads_approval12 td').click(function(){
 $(this).toggleClass('selected');
 var row =[];
 $('.selected').each(function(i,key){
     row.push($(key).text());
  });
  $('#selectedRows').val(row);
 });
</script>
<script>
var expanded = false;

function showCheckboxes12() {
  var checkboxes9 = document.getElementById("checkboxes12");
  if (!expanded) {
    checkboxes12.style.display = "block";
    expanded = true;
  } else {
    checkboxes12.style.display = "none";
    expanded   = false;
  }
}
</script>
<!--- // Class  2 ( B ) Student  contact mobile number fetch!--->
<!--- Class 2  ( C ) Student  contact mobile number fetch!--->
<script>
$('#uploads_approval13 td').click(function(){
 $(this).toggleClass('selected');
 var row =[];
 $('.selected').each(function(i,key){
     row.push($(key).text());
  });
  $('#selectedRows').val(row);
 });
</script>
<script>
var expanded = false;

function showCheckboxes13() {
  var checkboxes13 = document.getElementById("checkboxes13");
  if (!expanded) {
    checkboxes13.style.display = "block";
    expanded = true;
  } else {
    checkboxes13.style.display = "none";
    expanded = false;
  }
}
</script>
<!--- // Class  2 ( C ) Student  contact mobile number fetch!--->
<!--- Class 2  ( D ) Student  contact mobile number fetch!--->
<script>
$('#uploads_approval14 td').click(function(){
 $(this).toggleClass('selected');
 var row =[];
 $('.selected').each(function(i,key){
     row.push($(key).text());
  });
  $('#selectedRows').val(row);
 });
</script>
<script>
var expanded = false;

function showCheckboxes14() {
  var checkboxes14 = document.getElementById("checkboxes14");
  if (!expanded) {
    checkboxes14.style.display = "block";
    expanded = true;
  } else {
    checkboxes14.style.display = "none";
    expanded = false;
  }
}
</script>
<!--- // Class  2 ( D ) Student  contact mobile number fetch!--->













<script>
function myFunction() {
  var x = document.getElementById("mySelect").value;
  document.getElementById("demo").innerHTML = "You selected: " + x;
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
