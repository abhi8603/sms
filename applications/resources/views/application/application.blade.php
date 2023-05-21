@extends('header')
@section('style')
<link rel="stylesheet" href="{{ URL::asset('assets/plugins/forn-wizard/css/forn-wizard.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/plugins/formwizard/smart_wizard.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/plugins/formwizard/smart_wizard_theme_dots.css') }}">

@endsection
@section('content')
<div class="contents">

<div class="container-fluid">
	<div class="row">
		<div class="col-lg-12">
			<div class="shop-breadcrumb">

				<div class="breadcrumb-main">
					<h4 class="text-capitalize breadcrumb-title">Fill Your Personal Information</h4>
					<div class="breadcrumb-action justify-content-center flex-wrap">
					<div class="form-group mb-0">
								<div class="input-container icon-left position-relative">
									<span class="input-icon icon-left">
										<span data-feather="calendar"></span>
									</span>
									<input type="text" class="form-control" value="<?php echo date('d M Y'); ?>" placeholder="<?php echo date('d M Y'); ?>" readonly>
									<span class="input-icon icon-right">
										<span data-feather="chevron-down"></span>
									</span>
								</div>
							</div>
						
						
						
					</div>
				</div>

			</div>
		</div>
	</div>
</div>
<div class="container-fluid">
	<div class=" checkout wizard1 wizard7 global-shadow px-sm-50 px-20 py-sm-50 py-30 mb-30 bg-white radius-xl w-100">
		<div class="row justify-content-center">
			<div class="col-xl-8">
				<div class="checkout-progress-indicator content-center">
					<div class="checkout-progress">
						<div class="step current" id="1">
							<span>1</span>
							<span>Personal</span>
						</div>
						<div class="current"><img src="{{ URL::asset('assets/img/svg/checkout.svg')}}" alt="img" class="svg"></div>
						<div class="step" id="2">
							<span>2</span>
							<span>Parents Information</span>
						</div>
						<div class="current"><img src="{{ URL::asset('assets/img/svg/checkout.svg')}}" alt="img" class="svg"></div>
						<div class="step" id="3">
							<span>3</span>
							<span>Address</span>
						</div>						
						<div class="current"><img src="{{ URL::asset('assets/img/svg/checkout.svg')}}" alt="img" class="svg"></div>
						<div class="step" id="5">
							<span>5</span>
							<span>Documents</span>
						</div>						
						<div class="current"><img src="{{ URL::asset('assets/img/svg/checkout.svg')}}" alt="img" class="svg"></div>
						<div class="step" id="7">
							<span>7</span>
							<span>Photo & Signature</span>
						</div>
						<div class="current"><img src="{{ URL::asset('assets/img/svg/checkout.svg')}}" alt="img" class="svg"></div>
						<div class="step" id="8">
							<span>8</span>
							<span>Undertaking</span>
						</div>
						<div class="current"><img src="{{ URL::asset('assets/img/svg/checkout.svg')}}" alt="img" class="svg"></div>
						<div class="step" id="9">
							<span>9</span>
							<span>Payment</span>
						</div>
					</div>
				</div><!-- checkout -->
				<div class="row justify-content-center">
				<div class="col-lg-12">
                        <div class="card checkout-shipping-form px-30 pt-2 pb-30 border-color">
                            <div class="card-header">
                                <h6>Personal Information </h6>
                            </div>
                            <div class="card-body py-md-30">
                                <form method="post" action="{{url('application/parents/1')}}">
								@csrf
                                    <div class="row">
                                        <div class="col-md-6 mb-25">
										<div class="form-group">
											<label class=" col-form-label color-dark fs-14 fw-500 align-center">Seeking Admission in Class <span style="color: red;">*</span></label>
											<p>{{$stream}} </p>
											<input type="hidden" class="form-control" name="stream" value="{{$stream}}" id="stream" placeholder="Usename">
										</div>
                                        </div>
                                        <div class="col-md-6 mb-25">
										<div class="form-group">
											<label class=" col-form-label color-dark fs-14 fw-500 align-center">Pupil's Full Name <span style="color:red;">*</span></label>
											<input type="text" onblur="myFunction()" class="form-control" name="name" value="{{Auth::user()->name}}" id="name"  readonly>
										</div>
                                        </div>
										<div class="col-md-6 mb-25">
										<div class="form-group form-group-calender mb-20">
                                	  <label for="datepicker8" class=" color-dark fs-14 fw-500 align-center">Date of Birth<span style="color:red;">*</span></label>
                                     <div class="position-relative">
                                        <input type="text" class="form-control  ih-medium ip-gray radius-xs b-light" name="dob" value="{{isset($formData[0]->dob) ? $formData[0]->dob : old('dob')}}" id="datepicker8" required="Please ">
                                        <a href="#"><span data-feather="calendar"></span></a>
                                      </div>
                                 </div>
                                        </div>   
										
										<div class="col-md-6 mb-25">
										<div class="form-group">
										
                         				   <label class="col-form-label color-dark fs-14 fw-500 align-center">Place of Birth</label>
                          					  <input class="form-control ih-medium ip-gray radius-xs b-light" id="birthpalce" name="birthpalce" value="{{isset($formData[0]->birth_place) ? $formData[0]->birth_place : old('birth_place')}}" placeholder="Town Taluka Distict" style="margin-bottom: 10px" type="text">

                        					 
											</div>
                                        </div>
										
										<div class="col-md-6 mb-25">
										<div class="form-group">
										   <label class="col-form-label color-dark fs-14 fw-500 align-center">Gender  <span style="color:red;">*</span></label>
											<div style="display: flex;flex-wrap: nowrap;">
											<label class="custom-control custom-radio">
											<input type="radio" class="custom-control-input" id="gender" @if((isset($formData[0]->gender)  ? $formData[0]->gender : '') == 'Male') { checked } @endif  name="gender" value="Male"  required checked/>
											<span class="custom-control-label">Male</span>
											</label>
											<label class="custom-control custom-radio" style="margin-left: 25px;">
											<input type="radio" class="custom-control-input" name="gender" @if((isset($formData[0]->gender)  ? $formData[0]->gender : '') == 'Female') { checked } @endif  id="gender" value="Female" required/>
											<span class="custom-control-label">Female</span>
						  				</label>
									</div>
									</div>
									</div>
									

									<div class="col-md-8 mb-25">
									   <label class="col-form-label color-dark fs-14 fw-500 align-center">State whether you belong to one of the following  <span style="color:red;">*</span></label>
										<div style="display: flex;flex-wrap: nowrap;">
										<label class="custom-control custom-radio" style="margin-right: 45px;">
										<input type="radio" class="custom-control-input cast" id="cast" name="cast" value="General"  @if((isset($formData[0]->cast)  ? $formData[0]->cast : '') == 'General') { checked } @endif required/>
										<span class="custom-control-label">General</span>
										</label>
										<label class="custom-control custom-radio">
										<input type="radio" class="custom-control-input cast" id="cast" name="cast" value="Schedule Tribe"  @if((isset($formData[0]->cast)  ? $formData[0]->cast : '') == 'Schedule Tribe') { checked } @endif required/>
										<span class="custom-control-label">Schedule Tribe</span>
										</label>
									     <label class="custom-control custom-radio" style="margin-left: 25px;">
										<input type="radio" class="custom-control-input cast" id="cast" name="cast" value="Schedule Cast" @if((isset($formData[0]->cast)  ? $formData[0]->cast : '') == 'Schedule Cast') { checked } @endif required/>
										<span class="custom-control-label">Schedule Cast</span>
										</label>
										<label class="custom-control custom-radio" style="margin-left: 25px;">
										<input type="radio" class="custom-control-input cast" id="cast" name="cast" value="Other Backward Class" @if((isset($formData[0]->cast)  ? $formData[0]->cast : '') == 'Other Backward Class') { checked } @endif required/>
										<span class="custom-control-label">Other Backward Class </span>
										</label>
										</div>
										</div>
										<div class="col-md-4 mb-25">
										<label class="col-form-label color-dark fs-14 fw-500 align-center">Sub-Caste :</label>
										<input type="text" class="form-control ih-medium ip-gray radius-xs b-light px-15" name="subcast" value="{{isset($formData[0]->subcast) ? $formData[0]->subcast : old('subcast')}}"/>

										</div>
										<div class="col-md-6  mb-25">
										<label class="col-form-label color-dark fs-14 fw-500 align-center">Religion <span style="color:red;">*</span></label>
										<select class="form-control ih-medium ip-gray radius-xs b-light px-15" name="religion" id="religion" required>
										<option value="">Please select</option>
										<option @if(isset($formData[0]->religion)=='Hindu') selected @endif value="Hindu">Hindu</option>
										<option @if(isset($formData[0]->religion)=='Islam') selected @endif value="Muslim">Muslim</option>
										<option @if(isset($formData[0]->religion)=='Christian') selected @endif value="Christian">Christian</option>
										<option @if(isset($formData[0]->religion)=='Sikh') selected @endif value="Sikh">Sikh</option>
										<option @if(isset($formData[0]->religion)=='Other') selected @endif value="Other">Other</option>
						
   									</select>
																
																</div>
																<div class="col-md-6 mb-25">
																	<label class="col-form-label color-dark fs-14 fw-500 align-center">Religion (If other kindly Specify)</label>
																	<input type="text" value="{{isset($formData[0]->denomination) ? $formData[0]->denomination : old('denomination')}}" class="form-control ih-medium ip-gray radius-xs b-light px-15" name="denomination" id="Denomination" >
																</div>
																<div class="col-md-6 mb-25">
																<div class="form-group">
                            <label class="col-form-label color-dark fs-14 fw-500 align-center">Physically Challenged ?</label> <br>
                            <label style="margin-right: 20px;" class="radio-inline"> <input type="radio" name="handicap" @if((isset($formData[0]->handicap)  ? $formData[0]->handicap : '') == 'Yes') { checked } @endif id="id_gender_1" value="Yes" style="margin-bottom: 10px">Yes</label>
                            <label class="radio-inline"> <input type="radio" name="handicap" id="id_gender_2" value="No" style="margin-bottom: 10px" @if((isset($formData[0]->handicap)  ? $formData[0]->handicap : '') == 'No') { checked } @endif >No </label>

                        </div>
																</div>
								
                                    </div>
									<div class="d-flex pt-15 justify-content-md-end justify-content-center">
											<button class="btn btn-primary btn-default btn-squared text-capitalize text-white">Save & Next<i class="ml-10 mr-0 las la-arrow-right"></i></button>
										</div>
                                </form>
                            </div>
                        </div>
                        <!-- ends: .card -->

                    </div>
				
				</div>
			</div><!-- ends: col -->
		</div>
	</div><!-- End: .global-shadow-->
</div>


</div>
@endsection
@section('script')

<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
<script src="{{ URL::asset('assets/plugins/formwizard/jquery.smartWizard.js') }}"></script>

<script src="{{ URL::asset('assets/plugins/formwizard/fromwizard.js') }}"></script>
<script type="text/javascript">
function checkLengthAadhar(el) {
  if (el.value.length > 12) {
	$.notify("Please Enter Valid 12 digit Aadhar No.", "error");
	el.value="";
	return false;
   
  }
  if (el.value.length < 12) {
	$.notify("Please Enter Valid 12 digit Aadhar No.", "error");
	el.value="";
	return false;
   
  }
}
function checkLengthMobile(el) {
  if (el.value.length != 10) {
	 // alert(el.value.length);
	$.notify("Please Enter Valid 10 digit Mobile No.", "error");
	el.value="";
	return false;
   
  }
}

function CalculatePercentage(el){
	var tmo=$("#tmo").val();
//	alert(el.value);
	$("#percentage_secured").val(parseFloat((tmo/el.value)*100).toFixed(2));
}

function myFunction() {
	var name=document.getElementById('name').value;
	document.getElementById("pname").value=name;
	document.getElementById("t").href = "https://translate.google.co.in/?sl=en&tl=hi&text="+name+"&op=translate";
}
</script>
<script>
function validateSize(input) {
  const fileSize = input.files[0].size / 1024 / 1024; // in MiB
  if (fileSize > 2) {
    alert('File size exceeds 2 MiB');
    // $(file).val(''); //for clearing with Jquery
  } else {
    // Proceed further
  }
}
function loadImg_cast(input){
//	alert(input.files[0].type);application/pdf
//	if(file.type.match('video.*'))
if(input.files[0].type=="application/pdf"){

}else{
	$.notify("Please select Valid PDF File.", "error");
	document.getElementById('cast_certi_p').src = "";
	return false
}
	const fileSize = input.files[0].size / 1024 / 1024; // in MiB
  if (fileSize > 2) {
	$("#cast_certi").val(''); 
	$.notify("File size exceeds 2 MiB.", "error");
	document.getElementById('cast_certi_p').src = "";
	return false
    // $(file).val(''); //for clearing with Jquery
  } else {
    // Proceed further
	$('#cast_certi_p').attr('src', URL.createObjectURL(event.target.files[0]));
  }
	
}
function loadImg_p(input){
	if(input.files[0].type=="image/png" || input.files[0].type=="image/jpeg" || input.files[0].type=="image/jpg"){

}else{
	$.notify("Please select Valid Image File.", "error");
	document.getElementById('photo_p').src = "";
	return false
}
	const fileSize = input.files[0].size / 1024 / 1024; // in MiB
  if (fileSize > 2) {
	$("#photo").val(''); 
	$.notify("File size exceeds 2 MiB.", "error");
	document.getElementById('photo_p').src = "";
	return false
    // $(file).val(''); //for clearing with Jquery
  } else {
    // Proceed further
	$('#photo_p').attr('src', URL.createObjectURL(event.target.files[0]));
  }
	
   
}

function loadImg_s(input){
	if(input.files[0].type=="image/png" || input.files[0].type=="image/jpeg" || input.files[0].type=="image/jpg"){

}else{
	$.notify("Please select Valid Image File.", "error");
	document.getElementById('signature_p').src = "";
	return false
}
	const fileSize = input.files[0].size / 1024 / 1024; // in MiB
  if (fileSize > 2) {
	$("#signature").val(''); 
	$.notify("File size exceeds 2 MiB.", "error");
	document.getElementById('signature_p').src = "";
	return false
  
  } else {
	$('#signature_p').attr('src', URL.createObjectURL(event.target.files[0]));
    // Proceed further
  }
  
}
$(document).ready(function(){
	var o_study_o=$(".o_study:checked").val()
	if(o_study_o=="Yes"){
		$(".sp").show();
	}else{
		$(".sp").hide();
	}
	$(".o_study").on("change",function(){
		var o_study_o=$(".o_study:checked").val()
		//alert(o_study_o);
		if(o_study_o=="Yes"){
		$(".sp").show();
	}else{ //alert();
		$(".sp").hide();
	}
	})

	var castname=$("input:radio.cast:checked").val();//alert(castname);
	if(castname=="Schedule Tribe" || castname=="Schedule Cast" || castname=="Other Backward Class"){
			$("#ct_cast").show();
		}else{
			$("#ct_cast").hide();
		}
	$(".cast").change(function(){
		if(this.value=="Schedule Tribe" || this.value=="Schedule Cast" || this.value=="Other Backward Class"){
			$("#ct_cast").show();
		}else{
			$("#ct_cast").hide();
		}
	});

	$("#file_upload").click(function(evt){
		evt.preventDefault();
	//	alert();exit;
		var fd = new FormData();
        var photo = $('#photo')[0].files;
		if(photo[0]=="" || photo[0]===null || photo[0]==undefined){
			$.notify("Please select Valid Photo File.", "error");
			return false;
		}
		var signature = $('#signature')[0].files;
		if(signature[0]=="" || signature[0]==null || signature[0]==undefined){
			$.notify("Please select Valid Signature File.", "error");
			return false;
		}
			var castname=$("input:radio.cast:checked").val();

			/*if( $('#ct_cast').css('display') != 'none' )*/ 
			if(castname=="Schedule Tribe" || castname=="Schedule Cast" || castname=="Other Backward Class") {
			var cast_certi = $('#cast_certi')[0].files;
			if(cast_certi[0]=="" || cast_certi[0]==null || cast_certi[0]==undefined){
				$.notify("Please select Valid Cast Certificate File.", "error");
				return false;
			}else{
			fd.append('cast_certi',cast_certi[0]);
			}
		}else{
		var cast_certi = $('#cast_certi')[0].files;
			fd.append('cast_certi',null);
		}
		fd.append('photo',photo[0]);
		fd.append('signature',signature[0]);
		
		fd.append('course',$("#course").val());
		//console.log(fd);exit;
		var _url = $("#_url").val();
		/*alert(_url);*/
		$.ajax({
		type: "POST",
			 url: _url + '/application/save/upload',
			 data: fd,
			 cache: false,
			 enctype: 'multipart/form-data',
       	     processData: false,
             contentType: false,	
      		 
			 success: function ( data ) {
			 	
				$.notify(data, "error");
			},
			 error: function (jqXHR, exception) {
				 	return false;
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

	var stream=$("#stream").val();
//	$('input:radio[name="course"][value="'+stream+'"]').attr('checked',true);
	var pay_status=$("#pay_status").val();
//	alert(pay_status);
	if(pay_status=="0000"){
		$("#pay").prop("disabled", true);
	}
	var sub_status=$("#sub_status").val();
	if(sub_status==1){
		$("#applicationForm input").prop("disabled", true);
	}


});
</script>
@endsection
