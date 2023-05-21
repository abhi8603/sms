@extends('header')

@section('content')
<div class="contents">
					<div class="container-fluid">
					<div class="row">
                    <div class="col-lg-12">

                        <div class="breadcrumb-main">
                            <h4 class="text-capitalize breadcrumb-title">Instructions</h4>
                            <div class="breadcrumb-action justify-content-center flex-wrap">
                                                               
                            </div>
                        </div>

                    </div>
                </div>
						<!--End Page header-->
 @include('notification.notify')
						<div class="row">
					
							
							

											<div class="col-xl-12 col-md-12 col-lg-12">

												<div class="card">
													<div class="card-header">
														<h3 class="card-title">General Instructions</h3>
														<div class="card-options ">
															<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
															<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
														</div>
													</div>
													<div class="card-body">
														<div class="row">
															<div style="text-align: center;" class="col-xl-12 col-lg-12 col-md-12 mb-12 table-responsive">
                                                            <embed type="application/pdf" src="{{ URL::asset('assets/abhijeet.pdf')}}"  id="cast_certi_p" height="1000px" width="1000px" />
															</div>


														</div>

													</div>
												</div>
											</div>
										
										</div>

				 </div>
				</div><!-- end app-content-->
@endsection

@section('script')

@endsection
