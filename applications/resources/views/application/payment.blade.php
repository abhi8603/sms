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
					<h4 class="text-capitalize breadcrumb-title">Undertaking</h4>
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
						<div class="step completed " id="5">
							<span class="las la-check"></span>
							<span>Documents</span>
						</div>						
						<div class="current"><img src="{{ URL::asset('assets/img/svg/checkoutin.svg')}}" alt="img" class="svg"></div>
						<div class="step completed" id="7">
							<span class="las la-check"></span>
							<span>Photo & Signature</span>
						</div>
						<div class="current"><img src="{{ URL::asset('assets/img/svg/checkoutin.svg')}}" alt="img" class="svg"></div>
						<div class="step completed" id="8">
							<span class="las la-check"></span>
							<span>Undertaking</span>
						</div>
						<div class="current"><img src="{{ URL::asset('assets/img/svg/checkout.svg')}}" alt="img" class="svg"></div>
						<div class="step current" id="9">
							<span>9</span>
							<span>Payment</span>
						</div>
					</div>
				</div><!-- ends: .checkout-progress-indicator -->
				<div class="row justify-content-center">
				<div class="col-lg-12">
                        <div class="card checkout-shipping-form px-30 pt-2 pb-30 border-color">
                            <div class="card-header">
                                <h6>Payment Information </h6>
                            </div>
                            <div class="card-body py-md-30">
                                <form method="post" action="{{url('payonline/pay')}}">
								@csrf
                                    <div class="row">
									<div class="col-md-12">
									<label><span style="color:red;">Payment Information : </span></label>
									<p> Application Fee  <b><?php echo $pay_status=="0000" ? "Received." :"Not Received."; ?></b></p>
									</div>
                                        <div class="col-md-6 mb-25">
										<div class="form-group">
										<label>Fee Paid For </label>
																	<input type="text" class="form-control" id="course" name="course" value="<?php echo Session::get('selected_stream'); ?>" required  readonly style="
    border: transparent;
    font-weight: bolder;
    color: #000;
" />										</div>
                                        </div>
                                        <div class="col-md-6 mb-25">
										<div class="form-group">
										<label>Name</label>
											<input type="text" class="form-control" name="name" value="{{Auth::user()->name}}" id="inputtext" readonly>
    									</div>
                                        </div>
                                        <div class="col-md-6 mb-25">
										<div class="form-group">
										<label>Email</label>
		         							<input type="text" class="form-control" name="email" value="{{Auth::user()->email}}" id="inputtext" readonly>
		                                </div>
										</div>
                                        <div class="col-md-6 mb-25">
										<div class="form-group form-group-calender mb-20">
										<label>Mobile</label>
										<input type="text" class="form-control" name="mobile" value="{{Auth::user()->mobile}}" id="inputtext" readonly>

                           			      </div>
                                        </div>
                                        <div class="col-md-6 mb-25">
										<label>Amount Payable : </label>
										<span>INR {{ env('FEE') }}</span>
    								<input type="hidden" id="pay_status" class="form-control" name="pay_status" value="<?php echo $pay_status ?>"  readonly>
							<br><span style="color:red;">Note : Transaction charges Extra.</span>

                                        </div>
                                        
                                    </div>
									<div class="button-group d-flex pt-3 justify-content-between flex-wrap" style="float: right;">																	
											<button href="{{url('application/address/1')}}" class="btn text-white btn-primary btn-default btn-squared text-capitalize m-1">Pay<i class="ml-10 mr-0 las la-arrow-right"></i></button>
										</div>
                                </form>
								<div class="button-group d-flex pt-3 justify-content-between flex-wrap" style="float: left;margin-top:-7px;">
										<form method="get" action="{{url('application/undertaking/1')}}">
										
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

