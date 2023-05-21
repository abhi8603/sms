@extends('header')

@section('content')
<div class="app-content page-body">
					<div class="container">

						<!--Page header-->
						<div class="page-header">
							<div class="page-leftheader">
								<h4 class="page-title">Dashboard</h4>
								<ol class="breadcrumb pl-0">
									<li class="breadcrumb-item"><a href="#">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Dashboard</li>
								</ol>
							</div>

						</div>
						<!--End Page header-->

						<div class="row">
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
															<div style="text-align: center;" class="col-xl-12 col-lg-12 col-md-12 mb-12">
																<img style="height: 150px; width: 140px;" class="avatar-lg rounded-circle mr-3" src=""/>
																<p></p>
																<table class="table card-table table-vcenter">
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
															<div class="col-md-12">
																<table class="table card-table table-vcenter  table-warning">
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
																	<tr>
																		<td></td>
																		<td></td>
																		<td></td>
																		<td></td>
																		<td></td>
																		<td></td>
																	</tr>

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
