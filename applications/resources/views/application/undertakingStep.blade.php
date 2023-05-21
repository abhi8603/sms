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
						<div class="current"><img src="{{ URL::asset('assets/img/svg/checkout.svg')}}" alt="img" class="svg"></div>
						<div class="step current" id="8">
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
                                <h6>Undertaking Information </h6>
                            </div>
                            <div class="card-body py-md-30">
                                <form method="post" action="{{url('application/payment/1')}}">
								@csrf
                                    <div class="row">
                                       
                                        
										<div class="form-group" style="text-align: center;text-decoration: underline;">
	<b>Declarations :</b>
</div>
<div class="form-group">
	<b style="color: red;">I certify that the answer and other infomation given in this application are correct and complete.If my application is accepted, I undertake to observe the school's rules and regulations, in letter and spirit and to ensure prompt patment of fees and other liablities. </b>
</div>


	<div class="form-group">
		<label><b>Commitments :</b></label>
		<b>I understand, and am in harmony, with the purpose, aim and objectives of the METAS Seventh - day Adventist Higher Secondary School, Ranchi. I desire that my child be given the full benefits of education at your school including instructions in Moral Science, Ethics and Value, as may be prescribed by the management and that my child should attend regular worship. If the conduct and bearing of my child is not upto expectation and standard, the administration has the authority to expel him/her from the school any time.</b>
</div>
<div class="col-md-12" style="display:flex;">
<div class="col-md-6">
	Date : <?php echo date('d-m-Y'); ?>
</div>
<div class="col-md-6">
</div>
</div>
                                    </div>
									<div class="button-group d-flex pt-3 justify-content-between flex-wrap" style="float: right;">																	
											<button class="btn text-white btn-primary btn-default btn-squared text-capitalize m-1">Save & Next<i class="ml-10 mr-0 las la-arrow-right"></i></button>
										</div>
                                </form>
								<div class="button-group d-flex pt-3 justify-content-between flex-wrap" style="float: left;margin-top:-7px;">
										<form method="get" action="{{url('/application/photo/1')}}">
									
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

