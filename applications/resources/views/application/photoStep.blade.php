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
					<h4 class="text-capitalize breadcrumb-title">Photo & Signature</h4>
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
						
						<div class="current"><img src="{{ URL::asset('assets/img/svg/checkout.svg')}}" alt="img" class="svg"></div>
						<div class="step current" id="7">
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
                                <h6>Photo & Signature</h6>
                            </div>
                            <div class="card-body py-md-30">
                                <form method="post" action="{{url('application/undertaking/1')}}" enctype="multipart/form-data">
								@csrf
                                    <div class="row">
                                        <div class="col-md-6 mb-25">
										<div class="form-group">
										<label>Applicant Photo</label>
							<input type="file" accept="image/" onchange="loadImg_p(this)" class="form-control ih-medium ip-gray radius-xs b-light" name="sign_a" id="sign_a" />
    						<input type="hidden" value="@if(isset($formData[0]->sign_a)) {{ $formData[0]->sign_a }} @endif"  class="form-control" name="sign_a_path" id="sign_a_path" />
										</div>
                                        </div>
                                        <div class="col-md-6 mb-25">
										<div class="form-group">
										<div class="form-group">
										<img @if(isset($formData[0]->sign_a)) src="{{ URL::asset($formData[0]->sign_a)}}"  @endif id="photo_p"  width="100px" height="100px"/>
									</div>
									</div>
                                        </div>
                                                                             
                                    </div>


									<div class="row">
                                        <div class="col-md-6 mb-25">
										<div class="form-group">
										<label>Father Photograph</label>
							<input type="file" accept="image/" onchange="loadImg_p(this)" class="form-control ih-medium ip-gray radius-xs b-light" name="photo_f" id="photo_f" />
    						<input type="hidden" value="@if(isset($formData[0]->photo_f)) {{ $formData[0]->photo_f }} @endif"  class="form-control" name="photo_f_path" id="photo_f_path" />
										</div>
                                        </div>
                                        <div class="col-md-6 mb-25">
										<div class="form-group">
										<div class="form-group">
										<img @if(isset($formData[0]->photo_f)) src="{{ URL::asset($formData[0]->photo_f)}}"  @endif id="photo_pp"  width="100px" height="100px"/>
									</div>
									</div>
                                        </div>
                                        <div class="col-md-6 mb-25">
										<div class="form-group">
										<label>Mother Photograph</label>
										<input type="file" accept="image/" onchange="loadImg_s(this)" class="form-control ih-medium ip-gray radius-xs b-light" name="photo_m"  id="photo_m" />
										<input type="hidden" value="@if(isset($formData[0]->photo_m)) {{ $formData[0]->photo_m }} @endif"  class="form-control" name="photo_m_path"  id="photo_m_path" />
    	                                </div>
										</div>
                                        <div class="col-md-6 mb-25">
										<div class="form-group form-group-calender mb-20">
										<img @if(isset($formData[0]->photo_m)) src="{{ URL::asset($formData[0]->photo_m)}}"  @endif  id="photo_m_p"  width="100px" height="100px"/>
									      </div>
                                        </div>                                        
                                    </div>
									<div class="row">
                                        <div class="col-md-6 mb-25">
										<div class="form-group">
										<label>Parent's/Guadian's Signature</label>
							<input type="file" accept="image/" onchange="loadImg_p(this)" class="form-control ih-medium ip-gray radius-xs b-light" name="sign_p" id="sign_p" />
    						<input type="hidden" value="@if(isset($formData[0]->sign_p)) {{ $formData[0]->sign_p }} @endif"  class="form-control" name="sign_p_path" id="photop" />
										</div>
                                        </div>
                                        <div class="col-md-6 mb-25">
										<div class="form-group">
										<div class="form-group">
										<img @if(isset($formData[0]->sign_p)) src="{{ URL::asset($formData[0]->sign_p)}}"  @endif id="sign_p_p"  width="100px" height="100px"/>
									</div>
									</div>
                                        </div>
                                                                             
                                    </div>

									<div class="button-group d-flex pt-3 justify-content-between flex-wrap" style="float: right;">																	
											<button href="{{url('application/undertaking/1')}}" class="btn text-white btn-primary btn-default btn-squared text-capitalize m-1">Save & Next<i class="ml-10 mr-0 las la-arrow-right"></i></button>
										</div>
                                </form>
								<div class="button-group d-flex pt-3 justify-content-between flex-wrap" style="float: left;margin-top:-7px;">
										<form method="get" action="{{url('application/document/1')}}">
										
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

