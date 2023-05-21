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
					<h4 class="text-capitalize breadcrumb-title">Parents Information</h4>
					<div class="breadcrumb-action justify-content-center flex-wrap">
						<div class="action-btn">

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
</div>
<div class="container-fluid">
	<div class=" checkout wizard7 global-shadow border px-sm-50 px-20 pt-sm-50 py-30 mb-30 bg-white radius-xl w-100">
		<div class="row justify-content-center">
			<div class="col-xl-8 col-12">
				<div class="checkout-progress-indicator content-center">
					<div class="checkout-progress justify-content-center">
					<div class="step completed " id="1">
							<span class="las la-check"></span>
							<span>Personal</span>
						</div>
						<div class="current"><img src="{{ URL::asset('assets/img/svg/checkoutin.svg')}}" alt="img" class="svg"></div>
						<div class="step current" id="2">
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
				</div><!-- ends: .checkout-progress-indicator -->


				<div class="row justify-content-center">
				<div class="col-lg-12">
                        <div class="card checkout-shipping-form px-30 pt-2 pb-30 border-color">
                            <div class="card-header">
                                <h6>Parents Information </h6>
                            </div>
                            <div class="card-body py-md-30">
                                <form method="post" action="{{url('application/address/1')}}">
								@csrf
                                    <div class="row">
                                        <div class="col-md-6 mb-25">
										<div class="form-group">
										<label>Father’s Name <span style="color:red;">*</span></label>
										  <input type="text" value="{{isset($formData[0]->f_name) ? $formData[0]->f_name : old('f_name')}}" class="form-control ih-medium ip-gray radius-xs b-light" name="f_name" id="f_name"  required>
										</div>
                                        </div>
                                        <div class="col-md-6 mb-25">
										<div class="form-group">
										<label>Mother’s Name  <span style="color:red;">*</span></label>
										<input type="text" value="{{isset($formData[0]->m_name) ? $formData[0]->m_name : old('m_name')}}" class="form-control ih-medium ip-gray radius-xs b-light" name="m_name" id="m_name" required >
										</div>
                                        </div>
                                        <div class="col-md-6 mb-25">
										<div class="form-group">                              
										<label>Father's Phone No <span style="color:red;">*</span></label>
											<input type="number" onblur="checkLengthMobile(this)" maxlength="10" value="{{isset($formData[0]->p_phone) ? $formData[0]->p_phone : old('p_phone')}}" class="form-control ih-medium ip-gray radius-xs b-light" name="p_phone" id="p_phone"   required>
                               			 </div>
										</div>
										<div class="col-md-6 mb-25">
										<div class="form-group">                              
										<label>Father's Educational Qualification<span style="color:red;">*</span></label>
											<input type="text" value="{{isset($formData[0]->f_qualification) ? $formData[0]->f_qualification : old('f_qualification')}}" class="form-control ih-medium ip-gray radius-xs b-light" name="f_qualification" id="f_qualification"   required>
                               			 </div>
										</div>
										<div class="col-md-6 mb-25">
										<div class="form-group">                              
										<label>Father Email<span style="color:red;">*</span></label>
											<input type="email" value="{{isset($formData[0]->p_phone) ? $formData[0]->f_email : old('f_email')}}" class="form-control ih-medium ip-gray radius-xs b-light" name="f_email" id="f_email"   required>
                               			 </div>
										</div>
                                       
                                        <div class="col-md-6 mb-25">
										<div class="form-group">
                            				<label class="control-label">Can Speak English ?</label> <br>
                            				<label class="radio-inline"> <input type="radio" name="f_speak" @if((isset($formData[0]->f_speak)  ? $formData[0]->f_speak : '') == 'Yes') { checked } @endif  id="f_speak_1" value="Yes" style="margin-bottom: 10px" checked="">Yes</label>
                            				<label class="radio-inline"> <input type="radio" name="f_speak" id="f_speak_2" value="No" style="margin-bottom: 10px"  @if((isset($formData[0]->f_speak)  ? $formData[0]->f_speak : '') == 'No') { checked } @endif>No </label>
                       					 </div>
                                        </div>
										<div class="col-md-6 mb-25">
										<div class="form-group">
                            <label class="control-label">Service (if any) ?</label><br>
                            <label class="radio-inline"> <input type="radio" name="occupation" id="id_gender_1" value="Goverment"  @if((isset($formData[0]->occupation)  ? $formData[0]->occupation : '') == 'Goverment') { checked } @endif style="margin-bottom: 10px" checked="">Goverment</label>
                            <label class="radio-inline"> <input type="radio" name="occupation" id="id_gender_2" value="Private"  @if((isset($formData[0]->occupation)  ? $formData[0]->occupation : '') == 'Private') { checked } @endif style="margin-bottom: 10px">Private </label>
                      </div>
                                        </div>
										<div class="col-md-6 mb-25">
										<div class="form-group">
                        <label class="control-label">Single Parent ?</label> <br>
                        <label class="radio-inline"> <input type="radio" name="s_parent" id="id_gender_1"  @if((isset($formData[0]->s_parent)  ? $formData[0]->s_parent : '') == 'Yes') { checked } @endif value="Yes" style="margin-bottom: 10px">Yes</label>
                        <label class="radio-inline"> <input type="radio" name="s_parent" id="id_gender_2" value="No" style="margin-bottom: 10px"  @if((isset($formData[0]->s_parent)  ? $formData[0]->s_parent : '') == 'No') { checked } @endif>No </label>
          </div>
                                        </div>
                                    </div>
									<div class="button-group d-flex pt-3 justify-content-between flex-wrap" style="float: right;">																	
											<button href="{{url('application/address/1')}}" class="btn text-white btn-primary btn-default btn-squared text-capitalize m-1">Save & Next<i class="ml-10 mr-0 las la-arrow-right"></i></button>
										</div>
                                </form>
								<div class="button-group d-flex pt-3 justify-content-between flex-wrap" style="float: left;margin-top:-7px;">
										<form method="get" action="{{url('/application')}}">
										
										<button class="btn btn-warning btn-default btn-squared btn-transparent-warning  text-capitalize m-1"><i class="las la-arrow-left mr-10"></i>Previous</button>
										</form>
							  </div>
                            </div>
                        </div>
                        <!-- ends: .card -->

                    </div>
				
				</div>				
			</div><!-- ends: col -->
		</div>
	</div><!-- ends: .global-shadow -->
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
