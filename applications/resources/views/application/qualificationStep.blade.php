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
					<h4 class="text-capitalize breadcrumb-title">Qualification</h4>
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
						<div class="step completed" id="3">
							<span class="las la-check"></span>
							<span>Address</span>
						</div>
						<div class="current"><img src="{{ URL::asset('assets/img/svg/checkoutin.svg')}}" alt="img" class="svg"></div>
						<div class="step current" id="4">
							<span >4</span>
							<span>Qualification</span>
						</div>
						<div class="current"><img src="{{ URL::asset('assets/img/svg/checkout.svg')}}" alt="img" class="svg"></div>
						<div class="step" id="5">
							<span>5</span>
							<span>Documents</span>
						</div>
						<div class="current"><img src="{{ URL::asset('assets/img/svg/checkout.svg')}}" alt="img" class="svg"></div>
						<div class="step" id="6">
							<span>6</span>
							<span>Subjects</span>
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
                                <h6>Qualification Information </h6>
                            </div>
                            <div class="card-body py-md-30">
                                <form method="post" action="{{url('application/document/1')}}">
								@csrf
                                    <div class="row">
                                        <div class="col-md-6 mb-25">
										<div class="form-group">
										<label>From (School) <span style="color:red;">*</span></label>
										<input type="text" class="form-control ih-medium ip-gray radius-xs b-light px-15" value="{{isset($formData[0]->from_school) ? $formData[0]->from_school : old('from_school')}}" name="from_school" value="" id="from_school" required>
										</div>
                                        </div>
                                        <div class="col-md-6 mb-25">
										<div class="form-group">
										<label>Total Marks Obtained  <span style="color:red;">*</span></label>
										<input type="number" maxlength="3" class="form-control ih-medium ip-gray radius-xs b-light px-15" value="{{isset($formData[0]->tmo) ? $formData[0]->tmo : old('tmo')}}" name="tmo" value="" id="tmo" required>
										</div>
                                        </div>
                                        <div class="col-md-6 mb-25">
										<div class="form-group">
										<label>Max Marks <span style="color:red;">*</span></label>
											<input type="number" maxlength="3" onblur="CalculatePercentage(this)" class="form-control ih-medium ip-gray radius-xs b-light px-15"  value="{{isset($formData[0]->max_marks) ? $formData[0]->max_marks : old('max_marks')}}" name="max_marks" value="" id="max_marks" required>
                       			        </div>
										</div>
                                        <div class="col-md-6 mb-25">
										<div class="form-group form-group-calender mb-20">
										<label>Percentage Secured <span style="color:red;">*</span></label>
										<input type="text" class="form-control ih-medium ip-gray radius-xs b-light px-15" name="percentage_secured"value="{{isset($formData[0]->percentage_secured) ? $formData[0]->percentage_secured : old('percentage_secured')}}" id="percentage_secured" required>
                           			      </div>
                                        </div>
                                        <div class="col-md-6 mb-25">
										<label>Jharkhand Academic Council Registration No (If Any)  : </label>
										<input type="text" class="form-control ih-medium ip-gray radius-xs b-light px-15" name="jac_reg_no" value="{{isset($formData[0]->jac_reg_no) ? $formData[0]->jac_reg_no : old('jac_reg_no')}}" id="jac_reg_no" >
                                        </div>                                    
                                    </div>
									<div class="button-group d-flex pt-3 justify-content-between flex-wrap" style="float: right;">																	
											<button class="btn text-white btn-primary btn-default btn-squared text-capitalize m-1">Save & Next<i class="ml-10 mr-0 las la-arrow-right"></i></button>
										</div>
                                </form>
								<div class="button-group d-flex pt-3 justify-content-between flex-wrap" style="float: left;margin-top:-7px;">
										<form method="post" action="{{url('application/address/1')}}">
										@csrf
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

