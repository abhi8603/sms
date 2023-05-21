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
					<h4 class="text-capitalize breadcrumb-title">Address</h4>
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
						<div class="step completed" id="2">
							<span class="las la-check"></span>
							<span>Parents</span>
						</div>
						<div class="current"><img src="{{ URL::asset('assets/img/svg/checkoutin.svg')}}" alt="img" class="svg"></div>
						<div class="step current" id="3">
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
				<div class="col-lg-12 row" >
				
                        <div class="card checkout-shipping-form px-30 pt-2 pb-30 border-color">
						<form method="post" action="{{url('application/document/1')}}">
                            <div class="card-header">
                                <h6>Present Address of Father / Guardians * </h6>
                            </div>
                            <div class="card-body py-md-30">
                              
								@csrf
                                    <div class="row">
                                        <div class="col-md-6 mb-25">
										<div class="form-group">
										<label>Village/At <span style="color:red;">*</span></label>
										<textarea class="form-control ih-medium ip-gray radius-xs b-light" name="present_address" id="present_address" placeholder="Present Address of Father / Guardians (Village/At)" required> {{isset($formData[0]->present_address) ? $formData[0]->present_address : old('present_address')}}</textarea>
										</div>
                                        </div>
                                        <div class="col-md-6 mb-25">
										<div class="form-group">
										<label>PO<span style="color:red;">*</span></label>
										<input type="text" class="form-control ih-medium ip-gray radius-xs b-light" value="{{isset($formData[0]->po) ? $formData[0]->po : old('po')}}" name="po" id="po" required/> 
										</div>
                                        </div>
                                        <div class="col-md-6 mb-25">
										<div class="form-group">
                              
										<label>PS<span style="color:red;">*</span></label>
										<input type="text" class="form-control ih-medium ip-gray radius-xs b-light" value="{{isset($formData[0]->ps) ? $formData[0]->ps : old('ps')}}" name="ps" id="ps"  required/> 
                                </div>
										</div>
                                        <div class="col-md-6 mb-25">
										<div class="form-group form-group-calender mb-20">
										<label>District<span style="color:red;">*</span></label>
										<input type="text" class="form-control ih-medium ip-gray radius-xs b-light" value="{{isset($formData[0]->district) ? $formData[0]->district : old('district')}}" name="district" id="district"  required/> 

                           			      </div>
                                        </div>
                                        <div class="col-md-6 mb-25">
										<label>State<span style="color:red;">*</span></label>
										<input type="text" class="form-control ih-medium ip-gray radius-xs b-light" value="{{isset($formData[0]->state) ? $formData[0]->state : old('state')}}" name="state" id="state"  required/> 

                                        </div>
                                        <div class="col-md-6 mb-25">
										<label>PIN<span style="color:red;">*</span></label>
										<input type="number" class="form-control ih-medium ip-gray radius-xs b-light" value="{{isset($formData[0]->pin) ? $formData[0]->pin : old('pin')}}" name="pin" id="pin"  required/> 
							             </div>
                                    </div>
								
                            </div>
							<div><div class="checkbox-theme-default">
                                                            <input style="height:16px;" class="checkbox check_1" type="checkbox" id="check_1"/>
                                                            <label for="check-1">
                                                                <span class="checkbox-text">
                                                                    Same as Present Address                                                              </span>
                                                            </label>
                                                        </div>
									</div>
							<div class="card-header">
                                <h6>Parmanent Address of Father / Guardians <span style="color:red;">*</span></h6>
                            </div>
                            <div class="card-body py-md-30">
							<div class="row">
                                        <div class="col-md-6 mb-25">
										<div class="form-group">
										<label>Village/At <span style="color:red;">*</span></label>
										<textarea class="form-control ih-medium ip-gray radius-xs b-light" name="permanent_address" id="permanent_address" placeholder="Parmanent Address of Father / Guardians (Village/At)" required> {{isset($formData[0]->permanent_address) ? $formData[0]->permanent_address : old('permanent_address')}}</textarea>
									</div>
                                        </div>
                                        <div class="col-md-6 mb-25">
										<div class="form-group">
										<label>PO<span style="color:red;">*</span></label>
										<input type="text" class="form-control ih-medium ip-gray radius-xs b-light" value="{{isset($formData[0]->p_po) ? $formData[0]->p_po : old('p_po')}}" name="p_po" id="p_po"  required/> 
										</div>
                                        </div>
                                        <div class="col-md-6 mb-25">
										<div class="form-group">
										<label>PS<span style="color:red;">*</span></label>
										<input type="text" class="form-control ih-medium ip-gray radius-xs b-light" value="{{isset($formData[0]->p_ps) ? $formData[0]->p_ps : old('p_ps')}}" name="p_ps" id="p_ps"  required/> 
								          </div>
										</div>
                                        <div class="col-md-6 mb-25">
										<div class="form-group form-group-calender mb-20">
										<label>District<span style="color:red;">*</span></label>
										<input type="text" class="form-control ih-medium ip-gray radius-xs b-light" value="{{isset($formData[0]->p_district) ? $formData[0]->p_district : old('p_district')}}" name="p_district" id="p_district"  required/> 
                      			      </div>
                                        </div>
                                        <div class="col-md-6 mb-25">
										<label>State<span style="color:red;">*</span></label>
										<input type="text" class="form-control ih-medium ip-gray radius-xs b-light" value="{{isset($formData[0]->p_state) ? $formData[0]->p_state : old('p_state')}}" name="p_state" id="p_state" required/> 

                                        </div>
                                        <div class="col-md-6 mb-25">
										<label>PIN<span style="color:red;">*</span></label>
										<input type="number" class="form-control ih-medium ip-gray radius-xs b-light" value="{{isset($formData[0]->p_pin) ? $formData[0]->p_pin : old('p_pin')}}" name="p_pin" id="p_pin"  required/> 
							             </div>


                                    </div>
									<div class="button-group d-flex pt-3 justify-content-between flex-wrap" style="float: right;">
							<button href="{{url('application/document/1')}}" class="btn text-white btn-primary btn-default btn-squared text-capitalize m-1">Save & Next<i class="ml-10 mr-0 las la-arrow-right"></i></button>
							</div>
							</form>
							<div class="button-group d-flex pt-3 justify-content-between flex-wrap" style="float: left;margin-top:-7px;">
										<form method="get" action="{{url('/application/parents/1')}}">
										
										<button class="btn btn-warning btn-default btn-squared btn-transparent-warning  text-capitalize m-1"><i class="las la-arrow-left mr-10"></i>Previous</button>
										</form>
							  </div>

							</div>
							
														
                        </div>
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

$(document).ready(function(){
	
	$("#check_1").change(function (){
		if($("#check_1").is(":checked")){
		$("#permanent_address").val($("#present_address").val());
		$("#p_po").val($("#po").val());
		$("#p_ps").val($("#ps").val());
		$("#p_district").val($("#district").val());
		$("#p_state").val($("#state").val());
		$("#p_pin").val($("#pin").val());
	}else{
		$("#permanent_address").val("");
		$("#p_po").val("");
		$("#p_ps").val("");
		$("#p_district").val("");
		$("#p_state").val("");
		$("#p_pin").val("");
	}
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
