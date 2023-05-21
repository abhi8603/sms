@extends('header')

@section('content')
<div class="contents">
					<div class="container-fluid">
					<div class="row">
                    <div class="col-lg-12">

                        <div class="breadcrumb-main">
                            <h4 class="text-capitalize breadcrumb-title">Dashboard</h4>
                            <div class="breadcrumb-action justify-content-center flex-wrap">
                                                               
                            </div>
                        </div>

                    </div>
                </div>
						<!--End Page header-->
 @include('notification.notify')
						<div class="row">
							
						<div class="col-xl-12 col-md-12 col-lg-12">	
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">General Instructions : </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
		  <p>Welcome to Metas Adventist School, Ranchi Online <b> Admission Process</b>. We thank you for choosing 
		<b>  Metas Adventist School, Ranchi  </b> as one of the preferred institute for your Education. We urge you to either go through 
		  the program details available in the Admissions Brochure or on the 
		  website to decide upon the program for which you wish to apply for. 
		  You may also contact our <b> admission co-ordinator </b> to have better understanding of the programs offered. 
		  Please fill up all the mandatory fields accurately as may be required to complete the <b> Admission Process </b>. 
		  Once you have filled in all required fields you have to choose to pay the <b> Application Fee of Rs. 500/- </b> 
		  by using any of the following payment options:-
</p>
		  <p> <b style="text-decoration:underline">Pay online through debit / credit cards OR Net Banking.</b></p>
		  <ul>
			  <li>A. Admission fee through this mode can be paid using either debit / credit card or net banking facility.</li>
			   <li>B. Admission through this mode shall be subject to realization / confirmation of payment.</li>
			  <li>C. Please keep the debit / credit card / net banking details handy before proceeding.</li>
		  </ul>
		  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
     
      </div>
    </div>
  </div>
</div>
							
						</div>
							
							

											<div class="col-xl-5 col-md-12 col-lg-12">

												<div class="card">
													<div class="card-header">
														<h3 class="card-title">Profile Status</h3>
														<div class="card-options ">
															<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
															<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
														</div>
													</div>
													<div class="card-body">
														<div class="row">
															<div style="text-align: center;" class="col-xl-12 col-lg-12 col-md-12 mb-12 table-responsive">
															@if(Auth::user()->profile_img != null)
																<img style="height: 150px; width: 140px;" class="avatar-lg rounded-circle mr-3" src="{{Auth::user()->profile_img}}"/>
																@else
																<img src="<?php echo "https://soft.metassdaschool.com/".app_config('AppLogo'); ?>" alt="img" class="rounded-circle">
																@endif
																<p></p>
																<table class="table card-table table-vcenter table mb-0">
																	<tr>
	 																<td>Name :</td>
	 																<td>{{Auth::user()->name}}</td>
 																</tr>
																<tr>
																<td>Email :</td>
																<td>{{Auth::user()->email}}</td>
															</tr>
															<tr>
															<td>Mobile :</td>
															<td>{{Auth::user()->mobile}}</td>
														</tr>
																</table>
															</div>


														</div>

													</div>
												</div>
											</div>
											<div class="col-xl-7 col-md-12 col-lg-12">
												<div class="card">
													<div class="card-header">
														<h3 class="card-title">Application status</h3>
														<div class="card-options ">
															<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
															<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
														</div>
													</div>
													<div class="card-body">
														<div class="row">
															<div class="col-md-12 table4 table5 p-25 bg-white table-responsive">
																<table class="table card-table table mb-0 table-warning">
																	<thead>
																		<tr>
																			<th>Sl. No</th>
																			<th>Application No.</th>
																			<th>Class</th>
																			<th>Payment Status</th>																			
																			<th>Application Status</th>
																			<th>Action</th>
																		</tr>
																	</thead>
																<tbody>
																	@php $i=0; @endphp
																	@foreach($formData as $key=>$value)
																		@php $i++; @endphp
																	<tr>
																		<td>{{$i}}</td>
																		<td>{{$value->form_id}}</td>
																		<td>{{$value->stream}}</td>
																		<td><?php echo $value->pay_status=="0000" ? "<span>Paid</span>": "<span>Not Paid</span>" ?></td>
																		
																		<td><?php echo $value->submit_status==0 ? "<span>Not Completed</span>": "<span>Submitted</span>" ?></td>
																		<td><?php if($value->submit_status==1){ ?> <a target="_blank" href="{{url('application/Download/'.$value->id.'/'.Crypt::encrypt(Auth::user()->email))}}" class="btn btn-primary">Download</a> <?php }else{echo "N/A";} ?></td>
																	</tr>
																	@endforeach
															</tbody>
																</table>
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
<script>
$(document).ready(function(){
	 $('#exampleModal').modal('show');
	
});
</script>
@endsection
