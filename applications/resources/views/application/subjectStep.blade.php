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
						<div class="step completed" id="4">
							<span class="las la-check"> </span>
							<span>Qualification</span>
						</div>
						<div class="current"><img src="{{ URL::asset('assets/img/svg/checkoutin.svg')}}" alt="img" class="svg"></div>
						<div class="step completed " id="5">
							<span class="las la-check"></span>
							<span>Documents</span>
						</div>
						<div class="current"><img src="{{ URL::asset('assets/img/svg/checkout.svg')}}" alt="img" class="svg"></div>
						<div class="step current" id="6">
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
                                <h6>Personal Information </h6>
                            </div>
                            <div class="card-body py-md-30">
                                <form method="post" action="{{url('application/photo/1')}}">
								@csrf
                                    <div class="row">
									<div class="col-md-12" id="subs">
<p style="color: red;">Note : Other than additional paper all subject are mandatory and subject once opted should not be repeated.</p>
	<?php if( empty($subjects) || count($subjects)==0 || !$submitted) { ?>

	@if($stream=="Commerce")
		<table id="example" class="table card-table table-vcenter table mb-0 table-warning">
				<thead>
				<tr>
					<th>Subject</th>
					<th class="{{$stream}}">{{$stream}}</th>
				</tr>
			</thead>
			<tbody>
			<tr>
				<td><input style="background: transparent;border: navajowhite;" name="sub_type" type="text" value="Core" class="sub_type form-control" readonly/></td>
				<td>
				<?php
					foreach($subjects as $key=>$value){
						if($value->sub_type=='Core'){
							$coreValues=$value->sub_name;
						}
					}
					$coreValue=isset($coreValues) ? $coreValues : "";
				?>
				<select class="form-control subject" name="subject" id="core" required>
					<option value="">Please select</option>
					<option @if($coreValue=="English (ENA)") selected @endif value="English (ENA)">English (ENA)</option>
					<option @if($coreValue=="Hindi 'A' (HNA)") selected @endif value="Hindi 'A' (HNA)">Hindi "A" (HNA)</option>
					<option @if($coreValue=="Hindi 'B' (MB+NH)") selected @endif value="Hindi 'B' (MB+NH)">Hindi "B" (MB+NH)</option>
				</select>
			</td>
			</tr></tbody>
			<tr>
				<td><input style="background: transparent;border: navajowhite;" name="sub_type" type="text" value="Elective" class="sub_type form-control" readonly/></td>
				<td><input type="text" value="NA" id="elective_sub" name="subject" class="subject form-control" required/></td>
			</tr>
			<tr>
				<td><input style="background: transparent;border: navajowhite;" name="sub_type" type="text" value="Compulsory-1" class="sub_type form-control" readonly/> </td>
				<td><input type="text" name="subject" id="c1_sub" value="Accountancy (ACT)" class="subject form-control" readonly required/></td>
			</tr>
			<tr>
				<td><input style="background: transparent;border: navajowhite;" name="sub_type" type="text" value="Compulsory-2" class="sub_type form-control" readonly/> </td>
				<td><input type="text" name="subject" id="c2_sub" value="Business Studies (BST)" class="subject form-control" readonly required/></td>
			</tr>
			<tr>
				<td><input style="background: transparent;border: navajowhite;" name="sub_type" type="text" value="Optional – 1" class="sub_type form-control" readonly/> </td>
				<td>
				<?php
					foreach($subjects as $key=>$value){
						if($value->sub_type=='Optional – 1'){
							$Optional1Values=$value->sub_name;
						}
					}
					$Optional1Value=isset($Optional1Values) ? $Optional1Values : "";
				?>
				<select class="form-control subject" name="subject" id="o1_sub" required>
					<option value="">Please select</option>
					<option  @if($Optional1Value=="Economics (ECO)") selected @endif value="Economics (ECO)">Economics (ECO)</option>
					<option  @if($Optional1Value=="Entrepreneurship (ETP)") selected @endif value="Entrepreneurship (ETP)">Entrepreneurship (ETP)</option>
					<option  @if($Optional1Value=="Commercial Arithmetic’s (CA)") selected @endif value="Commercial Arithmetic’s (CA)">Commercial Arithmetic’s (CA)</option>
				</select>
				</td>
			</tr>
			<tr>
				<td><input style="background: transparent;border: navajowhite;" name="sub_type" type="text" value="Optional – 2" class="sub_type form-control" readonly/></td>
				<td>
				<?php
					foreach($subjects as $key=>$value){
						if($value->sub_type=='Optional – 2'){
							$Optional2Values=$value->sub_name;
						}
					}
					$Optional2Value=isset($Optional2Values) ? $Optional2Values : "";
				?>
				<select class="form-control subject" name="subject" id="o2_sub" required>
					<option value="">Please select</option>
					<option @if($Optional2Value=="Economics (ECO)") selected @endif value="Economics (ECO)">Economics (ECO)</option>
					<option @if($Optional2Value=="Entrepreneurship (ETP)") selected @endif  value="Entrepreneurship (ETP)">Entrepreneurship (ETP)</option>
					<option @if($Optional2Value=="Commercial Arithmetic’s (CA)") selected @endif  value="Commercial Arithmetic’s (CA)">Commercial Arithmetic’s (CA)</option>
				</select>
			</td>
			</tr>
			<tr>
				<td> <input style="background: transparent;border: navajowhite;" name="sub_type" type="text" value="Optional – 3" class="sub_type form-control" readonly/></td>
				<td><input type="text" value="NA" name="subject" id="o3_sub" class="subject form-control" required/>
			 </td>
			</tr>
			<tr>
				<td><input style="background: transparent;border: navajowhite;" name="sub_type" type="text" value="Additional" class="sub_type form-control" readonly/> </td>
				<td>
				<?php
					foreach($subjects as $key=>$value){
						if($value->sub_type=='Additional'){
							$AdditionalValues=$value->sub_name;
						}
					}
					$AdditionalValue=isset($AdditionalValues) ? $AdditionalValues : "";
				?>
				<select class="form-control subject" name="subject" required>
					<option value="">Please select</option>
					<option @if($AdditionalValue=="Commercial Arithmetic’s (CA)") selected @endif value="Commercial Arithmetic’s (CA)">Commercial Arithmetic’s (CA)</option>
					<option @if($AdditionalValue=="Entrepreneurship (ETP)") selected @endif value="Entrepreneurship (ETP)">Entrepreneurship (ETP)</option>				
				</select>
				</td>
			</tr>
			</table>
	
	@endif
	@if($stream=="Science")
	<table id="example" class="table card-table table-vcenter  table-warning">
				<thead>
				<tr>
					<th>Subject</th>
					<th class="{{$stream}}">{{$stream}}</th>
				</tr>
			</thead>
			<tbody>
			<tr>
				<td><input style="background: transparent;border: navajowhite;" name="sub_type" type="text" value="Core" class="sub_type form-control" readonly/></td>
				<td><input type="text" value="English" name="subject" id="core" class="subject form-control" readonly required/></td>
				</td>
			</tr></tbody>
			<tr>
				<td><input style="background: transparent;border: navajowhite;" name="sub_type" type="text" value="Elective" class="sub_type form-control" readonly/></td>
				<td><input type="text" value="NA" name="subject" id="elective_sub" class="subject form-control" required/></td>
			</tr>
			<tr>
				<td><input style="background: transparent;border: navajowhite;" name="sub_type" type="text" value="Compulsory-1" class="sub_type form-control" readonly/> </td>
				<td><input type="text" name="subject" value="Physics (PHY)" id="c1_sub" class="subject form-control" readonly/></td>
			</tr>
			<tr>
				<td><input style="background: transparent;border: navajowhite;" name="sub_type" type="text" value="Compulsory-2" class="sub_type form-control" readonly/> </td>
				<td><input type="text" name="subject" value="Chemistry (CHE)" id="c2_sub" class="subject form-control" readonly required/></td>
			</tr>
			<tr>
				<td><input style="background: transparent;border: navajowhite;" name="sub_type" type="text" value="Optional – 1" class="sub_type form-control" readonly/> </td>
				<td>
				<?php
					foreach($subjects as $key=>$value){
						if($value->sub_type=='Optional – 1'){
							$Optional1Values=$value->sub_name;
						}
					}
					$Optional1Value=isset($Optional1Values) ? $Optional1Values : "";
				?>
				<select class="form-control subject" name="subject" id="o1_sub" required>
					<option value="">Please select</option>
					<option @if($Optional1Value=="Mathematics (MAT)") selected @endif value="Mathematics (MAT)">Mathematics (MAT)</option>
					<option @if($Optional1Value=="Biology (BIO)") selected @endif value="Biology (BIO)">Biology (BIO)</option>
					<option @if($Optional1Value=="Computer Science (CMS)") selected @endif value="Computer Science (CMS)">Computer Science (CMS)</option>
					<option @if($Optional1Value=="Economics (ECO)") selected @endif value="Economics (ECO)">Economics (ECO)</option>
					</select>
				</td>
			</tr>
			<tr>
				<td><input style="background: transparent;border: navajowhite;" name="sub_type" type="text" value="Optional – 2" class="sub_type form-control" readonly/></td>
				<td>
				<?php
					foreach($subjects as $key=>$value){
						if($value->sub_type=='Optional – 2'){
							$Optional2Values=$value->sub_name;
						}
					}
					$Optional2Value=isset($Optional2Values) ? $Optional2Values : "";
				?>
					<select class="form-control subject" name="subject" id="o2_sub" required>
					<option value="">Please select</option>
					<option @if($Optional2Value=="Mathematics (MAT)") selected @endif  value="Mathematics (MAT)">Mathematics (MAT)</option>
					<option @if($Optional2Value=="Biology (BIO)") selected @endif value="Biology (BIO)">Biology (BIO)</option>
					<option @if($Optional2Value=="Computer Science (CMS)") selected @endif value="Computer Science (CMS)">Computer Science (CMS)</option>
					<option @if($Optional2Value=="Economics (ECO)") selected @endif value="Economics (ECO)">Economics (ECO)</option>
					</select>
				
				</td>
			</tr>
			<tr>
				<td> <input style="background: transparent;border: navajowhite;" name="sub_type" type="text" value="Optional – 3" class="sub_type form-control" readonly/></td>
				<td><input type="text" value="NA" name="subject" id="o3_sub" class="subject form-control" required/></td>
				</td>
			</tr>
			<tr>
				<td><input style="background: transparent;border: navajowhite;" name="sub_type" type="text" value="Additional" class="sub_type form-control" readonly/> </td>
				<td>
				<?php
					foreach($subjects as $key=>$value){
						if($value->sub_type=='Optional – 2'){
							$Additional=$value->sub_name;
						}
					}
					$Additionals=isset($Additional) ? $Additional : "";
				?>
				<select class="form-control subject" name="subject" required>
					<option value="">Please select</option>
					<option  @if($Additionals=="Mathematics (MAT)") selected @endif value="Mathematics (MAT)">Mathematics (MAT)</option>				
					<option  @if($Additionals=="Economics (ECO)") selected @endif value="Economics (ECO)">Economics (ECO)</option>
					</select>
				
			</tr>
			</table>
	
	@endif

	@if($stream=="Arts")
	<table id="example" class="table card-table table-vcenter  table-warning">
				<thead>
				<tr>
					<th>Subject</th>
					<th class="{{$stream}}">{{$stream}}</th>
				</tr>
			</thead>
			<tbody>
			<tr>
				<td><input style="background: transparent;border: navajowhite;" name="sub_type" type="text" value="Core" class="sub_type form-control" readonly/></td>
				<td>
				<?php
					foreach($subjects as $key=>$value){
						if($value->sub_type=='Core'){
							$Core=$value->sub_name;
						}
					}
					$Cores=isset($Core) ? $Core : "";
				?>
				<select class="form-control subject" name="subject" id="core" required>
					<option value="">Please select</option>
					<option  @if($Cores=="English (ENA)") selected @endif value="English (ENA)">English (ENA)</option>
					<option @if($Cores=="Hindi 'A' (HNA)") selected @endif value="Hindi 'A' (HNA)">Hindi "A" (HNA)</option>
					<option @if($Cores=="Hindi 'B' (MB+NH)") selected @endif value="Hindi 'B' (MB+NH)">Hindi "B" (MB+NH)</option>
				</select>
				</td>
			</tr></tbody>
			<tr>
				<td><input style="background: transparent;border: navajowhite;" name="sub_type" type="text" value="Elective" class="sub_type form-control" readonly/></td>
				<td>
				<?php
					foreach($subjects as $key=>$value){
						if($value->sub_type=='Elective'){
							$Elective=$value->sub_name;
						}
					}
					$Electives=isset($Elective) ? $Elective : "";
				?>
				<select class="form-control subject" name="subject" id="elective_sub" required>
					<option value="">Please select</option>
					<option @if($Electives=="Hindi (HIN)") selected @endif value="Hindi (HIN)">Hindi (HIN)</option>
					<option @if($Electives=="English (ENG)") selected @endif value="English (ENG)">English (ENG)</option>
					<option @if($Electives=="Mundari (MUN)") selected @endif value="Mundari (MUN)">Mundari (MUN)</option>
					<option @if($Electives=="Kurukh (KUX)") selected @endif value="Kurukh (KUX)">Kurukh (KUX)</option>
				</select>
			</td>
			</tr>
			<tr>
				<td><input style="background: transparent;border: navajowhite;" name="sub_type" type="text" value="Compulsory-1" class="sub_type form-control" readonly/> </td>
				<td><input type="text" name="subject" value="NA" class="subject form-control" id="c1_sub" readonly required></td>
			</tr>
			<tr>
				<td><input style="background: transparent;border: navajowhite;" name="sub_type" type="text" value="Compulsory-2" class="sub_type form-control" readonly/> </td>
				<td><input type="text" name="subject" value="NA" class="subject form-control" id="c2_sub" readonly required/></td>
			</tr>
			<tr>
				<td><input style="background: transparent;border: navajowhite;" name="sub_type" type="text" value="Optional – 1" class="sub_type form-control" readonly/> </td>
				<td>
				<?php
					foreach($subjects as $key=>$value){
						if($value->sub_type=='Optional – 1'){
							$Optional1=$value->sub_name;
						}
					}
					$Optional1s=isset($Optional1) ? $Optional1 : "";
				?>
				<select class="form-control subject" name="subject" id="o1_sub" required>
					<option value="">Please select</option>
					<option  @if($Optional1s=="History (HIS)") selected @endif  value="History (HIS)">History (HIS)</option>
					<option  @if($Optional1s=="Economics (ECO)") selected @endif value="Economics (ECO)">Economics (ECO)</option>
					<option  @if($Optional1s=="Geography (GEO)") selected @endif value="Geography (GEO)">Geography (GEO)</option>
					<option  @if($Optional1s=="Anthropology (ANT)") selected @endif value="Anthropology (ANT)">Anthropology (ANT)</option>
					<option  @if($Optional1s=="Political Science. (POL)") selected @endif value="Political Science. (POL)">Political Science. (POL)</option>
				</select>
				</td>
			</tr>
			<tr>
				<td><input style="background: transparent;border: navajowhite;" name="sub_type" type="text" value="Optional – 2" class="sub_type form-control" readonly/></td>
				<td>
				<?php
					foreach($subjects as $key=>$value){
						if($value->sub_type=='Optional – 2'){
							$Optional2=$value->sub_name;
						}
					}
					$Optional2s=isset($Optional2) ? $Optional2 : "";
				?>
				<select class="form-control subject" name="subject" id="o2_sub" required>
					<option value="">Please select</option>
					<option  @if($Optional2s=="History (HIS)") selected @endif  value="History (HIS)">History (HIS)</option>
					<option  @if($Optional2s=="Economics (ECO)") selected @endif value="Economics (ECO)">Economics (ECO)</option>
					<option  @if($Optional2s=="Geography (GEO)") selected @endif value="Geography (GEO)">Geography (GEO)</option>
					<option  @if($Optional2s=="Anthropology (ANT)") selected @endif value="Anthropology (ANT)">Anthropology (ANT)</option>
					<option  @if($Optional2s=="Political Science. (POL)") selected @endif value="Political Science. (POL)">Political Science. (POL)</option>
				</select>
				</td>
			</tr>
			<tr>
				<td> <input style="background: transparent;border: navajowhite;" name="sub_type" type="text" value="Optional – 3" class="sub_type form-control" readonly/></td>
				<td>
				<?php
					foreach($subjects as $key=>$value){
						if($value->sub_type=='Optional – 3'){
							$Optional3=$value->sub_name;
						}
					}
					$Optional3s=isset($Optional3) ? $Optional3 : "";
				?>
				<select class="form-control subject" name="subject" id="o3_sub" required>
					<option value="">Please select</option>
					<option  @if($Optional3s=="History (HIS)") selected @endif  value="History (HIS)">History (HIS)</option>
					<option  @if($Optional3s=="Economics (ECO)") selected @endif value="Economics (ECO)">Economics (ECO)</option>
					<option  @if($Optional3s=="Geography (GEO)") selected @endif value="Geography (GEO)">Geography (GEO)</option>
					<option  @if($Optional3s=="Anthropology (ANT)") selected @endif value="Anthropology (ANT)">Anthropology (ANT)</option>
					<option  @if($Optional3s=="Political Science. (POL)") selected @endif value="Political Science. (POL)">Political Science. (POL)</option>
				</select>
				</td>
			</tr>
			<tr>
				<td><input style="background: transparent;border: navajowhite;" name="sub_type" type="text" value="Additional" class="sub_type form-control" readonly/> </td>
				<td>
				<?php
					foreach($subjects as $key=>$value){
						if($value->sub_type=='Additional'){
							$Additional=$value->sub_name;
						}
					}
					$Additionals=isset($Additional) ? $Additional : "";
				?>
				<select class="form-control subject" name="subject" required>
					<option value="">Please select</option>
					<option @if($Additionals=="English (ENG)") selected @endif  value="English (ENG)">English (ENG)</option>
					<option @if($Additionals=="Hindi (HIN)") selected @endif value="Hindi (HIN)">Hindi (HIN)</option>
					<option @if($Additionals=="History (HIS)") selected @endif value="History (HIS)">History (HIS)</option>
					<option @if($Additionals=="Economics (ECO)") selected @endif value="Economics (ECO)">Economics (ECO)</option>
					<option @if($Additionals=="Anthropology (ANT)") selected @endif value="Anthropology (ANT)">Anthropology (ANT)</option>
					<option @if($Additionals=="Political Science. (POL)") selected @endif value="Political Science. (POL)">Political Science. (POL)</option>
				</select>
				</td>
			</tr>
			</table>
	
	@endif

<?php }else { ?>

	<table id="example" class="table card-table table-vcenter  table-warning">
		<thead>
			<tr>
				<th>Subject</th>
				<th class="arts">{{isset($formData[0]->course) ? $formData[0]->course : ''}}</th>
				</tr>
		</thead>
	<tbody>
		@foreach($subjects as $key=>$value)
		<tr>
			<td><input style="background: transparent;border: navajowhite;" name="sub_type" type="text" value="{{isset($value->sub_type) ? $value->sub_type : ''}}" class="form-control sub_type" readonly/></td>
			<td><input type="text" value="{{isset($value->sub_name) ? $value->sub_name : ''}}" name="subject" class="form-control subject"/></td>
		</tr>
		@endforeach
	</tbody>
</table>


<?php } ?>
</div>
                                    </div>
									<div class="button-group d-flex pt-3 justify-content-between flex-wrap" style="float: right;">																	
											<button href="{{url('application/address/1')}}" class="btn text-white btn-primary btn-default btn-squared text-capitalize m-1">Save & Next<i class="ml-10 mr-0 las la-arrow-right"></i></button>
										</div>
                                </form>
								<div class="button-group d-flex pt-3 justify-content-between flex-wrap" style="float: left;margin-top:-7px;">
										<form method="post" action="{{url('application/document/1')}}">
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

