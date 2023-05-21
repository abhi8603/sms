@extends('header')
@section('style')
<link rel="stylesheet" href="{{ URL::asset('assets/plugins/forn-wizard/css/forn-wizard.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/plugins/formwizard/smart_wizard.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/plugins/formwizard/smart_wizard_theme_dots.css') }}">

@endsection
@section('content')
<div class="contents">
					<div class="container-fluid">

						<!--Page header-->
						<div class="page-header">
							<div class="page-leftheader">
								<h4 class="page-title">Dashboard</h4>
								<ol class="breadcrumb pl-0">
									<li class="breadcrumb-item"><a href="#">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Application Form</li>
								</ol>
							</div>

						</div>
						<!--End Page header-->

            <div class="row">
    							<div class="col-12">
    								<div class="card">
    									<div class="card-header">
    										<h3 class="card-title">Application Form</h3>
    									</div>
    									<div class="card-body">
    										<div id="smartwizard-3">
    											<ul>
    												<li><a href="#step-10">Application</a></li>
													<li><a href="#step-12">Uploads Documents</a></li>
    												<li><a href="#step-11">Payment</a></li>
    											</ul>
    											<div>
    												<div id="step-10" >
    													<form id="applicationForm" name="applicationForm" enctype="multipart/form-data" method="post">
																<input type="hidden" id="sub_status" value="<?php echo $submitted; ?>"/>
    														<div class="form-group">
                                  	<label>I desire to join <span style="color:red;">*</span></label>
                                    <div style="display: flex;flex-wrap: nowrap;">
                                							<input type="text" class="form-control" id="course" name="stream" value="{{$stream}}" required  readonly style="
    border: transparent;
    font-weight: bolder;
    color: #000;
" />
  						  
                          <label class="custom-control custom-radio" style="margin-left: 25px;display: none;">
                        <input type="radio" class="custom-control-input" name="course" id="course" value="Commerce" @if((isset($formData[0]->course)  ? $formData[0]->course : '') || $stream  == 'Commerce')) { checked }  @endif required/>
                        <span class="custom-control-label">Commerce</span>
                      </label>
                        </div>
                    						</div>
    														<div class="form-group">
    															<label>Name of the applicant <span style="color:red;">*</span></label>
																<input type="hidden" value="{{$stream}}" name="stream" id="stream"/>
    															<input type="text" onblur="myFunction()" class="form-control" name="name" value="{{Auth::user()->name}}" id="name"  readonly>
                              	</div>
                                <div class="form-group">
                                  <label>Name in Hindi </label> <a id="t" onclick="myFunction()"  target="_blank" href="">(Translate)</a>
                                  <input type="text" class="form-control" name="name_hindi" value="{{isset($formData[0]->name_hindi) ? $formData[0]->name_hindi : old('name_hindi')}}" id="name_hindi"  required>
                                </div>
                                <div class="form-group">
    															<label>Date of Birth ( As recorded on Matriculation Record) <span style="color:red;">*</span></label>
																	<div class="input-group">
													<div class="input-group-prepend">
														<div class="input-group-text">
															<i class="fa fa-calendar tx-16 lh-0 op-6"></i>
														</div>
													</div><input class="form-control fc-datepicker" value="{{isset($formData[0]->dob) ? $formData[0]->dob : old('dob')}}" id="dob" name="dob" data-date-format="DD-MM-YYYY" placeholder="DD-MM-YYYY" type="date" required>
												</div>
    														</div>
																<div class="form-group">
																	<label>Gender  <span style="color:red;">*</span></label>
																<div style="display: flex;flex-wrap: nowrap;">
																<label class="custom-control custom-radio">
																<input type="radio" @if((isset($formData[0]->gender)  ? $formData[0]->gender : '') == 'Male') { checked }) @endif  class="custom-control-input" id="gender" name="gender" value="Male"  required checked/>
																<span class="custom-control-label">Male</span>
																</label>
																<label class="custom-control custom-radio" style="margin-left: 25px;">
																<input type="radio" class="custom-control-input" name="gender" id="gender" value="Female" @if((isset($formData[0]->gender)  ? $formData[0]->gender : '') == 'Female') { checked } @endif required/>
																<span class="custom-control-label">Female</span>
																</label>

																</div>
																</div>

																<div class="form-group">
																	<label>State whether you belong to one of the following  <span style="color:red;">*</span></label>
																<div style="display: flex;flex-wrap: nowrap;">
																<label class="custom-control custom-radio" style="margin-right: 45px;">
																<input type="radio" class="custom-control-input cast" id="cast" name="cast" value="General"  @if((isset($formData[0]->cast)  ? $formData[0]->cast : '') == 'General') { checked } @endif required/>
																<span class="custom-control-label">General</span>
																</label>
																<label class="custom-control custom-radio">
																<input type="radio" class="custom-control-input cast" id="cast" name="cast" value="Schedule Tribe"  @if((isset($formData[0]->cast)  ? $formData[0]->cast : '') == 'Schedule Tribe') { checked } @endif required/>
																<span class="custom-control-label">Schedule Tribe</span>
																</label>
																<label class="custom-control custom-radio" style="margin-left: 25px;">
																<input type="radio" class="custom-control-input cast" id="cast" name="cast" value="Schedule Cast" @if((isset($formData[0]->cast)  ? $formData[0]->cast : '') == 'Schedule Cast') { checked } @endif required/>
																<span class="custom-control-label">Schedule Cast</span>
																</label>
																<label class="custom-control custom-radio" style="margin-left: 25px;">
																<input type="radio" class="custom-control-input cast" id="cast" name="cast" value="Other Backward Class" @if((isset($formData[0]->cast)  ? $formData[0]->cast : '') == 'Other Backward Class') { checked } @endif required/>
																<span class="custom-control-label">Other Backward Class </span>
																</label>
																<label class="custom-control" style="width: 10%;">
																	Sub-Caste :
																</label>
																<input style="width: 45%;" type="text" class="form-control" name="subcast" value="{{isset($formData[0]->subcast) ? $formData[0]->subcast : old('subcast')}}"/>
																</div>
																</div>
																<div class="form-group" style="display: flex;">
																	<div class="col-md-6">
																	<label>Religion <span style="color:red;">*</span></label>
																<!--	<input type="text" class="form-control" value="{{isset($formData[0]->religion) ? $formData[0]->religion : old('religion')}}" name="religion" id="religion" placeholder="Religion" required> -->
																	<select class="form-control" name="religion" id="religion" required>
																	<option value="">Please select</option>
																	<option @if(isset($formData[0]->religion)=='Hindu') selected @endif value="Hindu">Hindu</option>
																	<option @if(isset($formData[0]->religion)=='Islam') selected @endif value="Muslim">Muslim</option>
																	<option @if(isset($formData[0]->religion)=='Christian') selected @endif value="Christian">Christian</option>
																	<option @if(isset($formData[0]->religion)=='Sikh') selected @endif value="Sikh">Sikh</option>
																	<option @if(isset($formData[0]->religion)=='Other') selected @endif value="Other">Other</option>
																	
																	</select>
																
																</div>
																	<div class="col-md-6">
																	<label>Religion (If other kindly Specify)</label>
																	<input type="text" value="{{isset($formData[0]->denomination) ? $formData[0]->denomination : old('denomination')}}" class="form-control" name="denomination" id="Denomination" >
																</div>
															</div>
																<div class="form-group">
																	<label>Student Aadhar No.  <span style="color:red;">*</span></label>
																	<input type="number" minlength="12" maxlength="12" value="{{isset($formData[0]->stu_aadhar) ? $formData[0]->stu_aadhar : old('stu_aadhar')}}" onblur="checkLengthAadhar(this)" class="form-control" name="stu_aadhar" id="aadhar" placeholder="Student Aadhar No." required>
															</div>

															<div class="form-group" style="display: flex;">
																<div class="col-md-4">
																<label>Father’s Name <span style="color:red;">*</span></label>
																<input type="text" value="{{isset($formData[0]->f_name) ? $formData[0]->f_name : old('f_name')}}" class="form-control" name="f_name" id="f_name"  required>
															</div>
																<div class="col-md-4">
																<label>Mother’s Name  <span style="color:red;">*</span></label>
																<input type="text" value="{{isset($formData[0]->m_name) ? $formData[0]->m_name : old('m_name')}}" class="form-control" name="m_name" id="m_name" required >
															</div>
																<div class="col-md-4">
															<label>Parent's Phone No <span style="color:red;">*</span></label>
															<input type="number" onblur="checkLengthMobile(this)" maxlength="10" value="{{isset($formData[0]->p_phone) ? $formData[0]->p_phone : old('p_phone')}}" class="form-control" name="p_phone" id="p_phone"   required>
														</div>
																
														</div>
														<div class="form-group" style="display: flex;">
														<div class="col-md-4">
															<label>Guardian Name (If father is dead)</label>
															<input type="text" value="{{isset($formData[0]->g_name) ? $formData[0]->g_name : old('g_name')}}" class="form-control" name="g_name" id="g_name" >
														</div>
														<div class="col-md-4">
															<label>Guardian Phone No</label>
															<input type="number" maxlength="10" onblur="checkLengthMobile(this)" value="{{isset($formData[0]->g_phone) ? $formData[0]->g_phone : old('g_phone')}}" class="form-control" name="g_phone" id="g_phone" >
														</div>
														<div class="col-md-4">
															<label>Occupation of (Father / Mother / Guardian) <span style="color:red;">*</span></label>
															<input type="text" value="{{isset($formData[0]->occupation) ? $formData[0]->occupation : old('occupation')}}" class="form-control" name="occupation" id="occupation"  required>
														</div>
													</div>
													<span>Present Address of Father / Guardians <span style="color:red;">*</span></span>
													<div class="form-group" style="display: flex;">													
													<div class="col-md-12 row">													
													<div class="col-md-4">
														<label>Village/At <span style="color:red;">*</span></label>
														<textarea class="form-control" name="present_address" id="present_address" placeholder="Present Address of Father / Guardians (Village/At)" required> {{isset($formData[0]->present_address) ? $formData[0]->present_address : old('present_address')}}</textarea>
													</div>
													<div class="col-md-4">
														<label>PO<span style="color:red;">*</span></label>
														<input type="text" class="form-control" value="{{isset($formData[0]->po) ? $formData[0]->po : old('po')}}" name="po" id="po" required/> 
													</div>
													<div class="col-md-4">
														<label>PS<span style="color:red;">*</span></label>
														<input type="text" class="form-control" value="{{isset($formData[0]->ps) ? $formData[0]->ps : old('ps')}}" name="ps" id="ps"  required/> 
													</div>
													<div class="col-md-4">
														<label>District<span style="color:red;">*</span></label>
														<input type="text" class="form-control" value="{{isset($formData[0]->district) ? $formData[0]->district : old('district')}}" name="district" id="district"  required/> 
													</div>
													<div class="col-md-4">
														<label>State<span style="color:red;">*</span></label>
														<input type="text" class="form-control" value="{{isset($formData[0]->state) ? $formData[0]->state : old('state')}}" name="state" id="state"  required/> 
													</div>
													<div class="col-md-4">
														<label>PIN<span style="color:red;">*</span></label>
														<input type="number" class="form-control" value="{{isset($formData[0]->pin) ? $formData[0]->pin : old('pin')}}" name="pin" id="pin"  required/> 
													</div>
													</div>
												</div>
												<span>Parmanent Address of Father / Guardians <span style="color:red;">*</span></span>
													<div class="form-group" style="display: flex;">													
													<div class="col-md-12 row">													
													<div class="col-md-4">
														<label>Village/At <span style="color:red;">*</span></label>
														<textarea class="form-control" name="permanent_address" id="permanent_address" placeholder="Parmanent Address of Father / Guardians (Village/At)" required> {{isset($formData[0]->permanent_address) ? $formData[0]->permanent_address : old('permanent_address')}}</textarea>
													</div>
													<div class="col-md-4">
														<label>PO<span style="color:red;">*</span></label>
														<input type="text" class="form-control" value="{{isset($formData[0]->p_po) ? $formData[0]->p_po : old('p_po')}}" name="po" id="p_po"  required/> 
													</div>
													<div class="col-md-4">
														<label>PS<span style="color:red;">*</span></label>
														<input type="text" class="form-control" value="{{isset($formData[0]->p_ps) ? $formData[0]->p_ps : old('p_ps')}}" name="p_ps" id="p_ps"  required/> 
													</div>
													<div class="col-md-4">
														<label>District<span style="color:red;">*</span></label>
														<input type="text" class="form-control" value="{{isset($formData[0]->p_district) ? $formData[0]->p_district : old('p_district')}}" name="p_district" id="p_district"  required/> 
													</div>
													<div class="col-md-4">
														<label>State<span style="color:red;">*</span></label>
														<input type="text" class="form-control" value="{{isset($formData[0]->p_state) ? $formData[0]->p_state : old('p_state')}}" name="p_state" id="p_state" required/> 
													</div>
													<div class="col-md-4">
														<label>PIN<span style="color:red;">*</span></label>
														<input type="number" class="form-control" value="{{isset($formData[0]->p_pin) ? $formData[0]->p_pin : old('p_pin')}}" name="p_pin" id="p_pin"  required/> 
													</div>
													</div>
												</div>

												<div class="form-group" style="display: flex;">
												<div class="col-md-6">
													<label>Phone No (Student) <span style="color:red;">*</span></label>
													<input type="number" maxlength="10" class="form-control" value="{{Auth::user()->mobile}}" name="s_phone_no" id="s_phone_no"  readonly>
												</div>
												<div class="col-md-6">
													<label>Email-ID <span style="color:red;">*</span></label>
													<input type="email" class="form-control" value="{{Auth::user()->email}}" name="email" id="email"  readonly>
												</div>
											</div>
											<div class="form-group" style="display: flex;">
											<div class="col-md-6">
												<label>Blood Group</label>
												<select class="form-control" name="blood_group" id="blood_group" >
													<option value="">Please Select</option>
													<option  @if(isset($formData[0]->blood_group)=='A+') selected @endif value="A+">A+</option>
													<option @if(isset($formData[0]->blood_group)=='A-') selected @endif value="A-">A-</option>
													<option @if(isset($formData[0]->blood_group)=='B+') selected @endif value="B+">B+</option>
													<option @if(isset($formData[0]->blood_group)=='B-') selected @endif value="B-">B-</option>
													<option @if(isset($formData[0]->blood_group)=='AB+') selected @endif value="AB+">AB+</option>
													<option @if(isset($formData[0]->blood_group)=='AB-') selected @endif value="AB-">AB-</option>
													<option @if(isset($formData[0]->blood_group)=='O+') selected @endif value="O+">O+</option>
													<option @if(isset($formData[0]->blood_group)=='O-') selected @endif value="O-">O-</option>
												</select>
											</div>
											<div class="col-md-6">
												<label>Mark of Identification</label>
												<input type="text" class="form-control" value="{{isset($formData[0]->identification_mark) ? $formData[0]->identification_mark : old('identification_mark')}}" name="identification_mark" id="identification_mark" >
											</div>
										</div>

										<div class="form-group">
											<label>Brother/Sister Studying in this College  </label>
										<div style="display: flex;flex-wrap: nowrap;">
										<label class="custom-control custom-radio">
										<input type="radio" class="custom-control-input o_study" id="o_study" name="o_study" @if((isset($formData[0]->o_study)  ? $formData[0]->o_study : '') == 'Yes') { checked } @endif  value="Yes"/>
										<span class="custom-control-label">Yes</span>
										</label>
										<label class="custom-control custom-radio" style="margin-left: 25px;">
										<input type="radio" checked class="custom-control-input o_study" id="o_study" name="o_study" @if((isset($formData[0]->o_study)  ? $formData[0]->o_study : '') == 'No') { checked } @endif value="No"/>
										<span class="custom-control-label">No</span>
										</label>
										</div>
										</div>
										<label>If yes kindly provide the following details</label>

										<div class="form-group" style="display: flex;">
										<div class="col-md-5">
											<label>Name</label> <span class="sp" style="color:red;">*</span>
											<input type="text" value="{{isset($formData[0]->o_name) ? $formData[0]->o_name : old('o_name')}}" class="form-control" name="o_name" id="o_Name" >
										</div>
										<div class="col-md-4">
											<label>Course & Session</label><span class="sp" style="color:red;">*</span>
											<input type="text" value="{{isset($formData[0]->course_session) ? $formData[0]->course_session : old('course_session')}}" class="form-control" name="course_session" id="Course_Session" >
										</div>
										<div class="col-md-3">
											<label>Mobile No</label><span class="sp" style="color:red;">*</span>
											<input type="number" maxlength="10" onblur="checkLengthMobile(this)" value="{{isset($formData[0]->o_mobile) ? $formData[0]->o_mobile : old('o_mobile')}}" class="form-control" value="" name="o_mobile" id="o_mobile" >
										</div>
										</div>
<div class="form-group" id="subs">
<p style="color: red;">Note : Other than additional paper all subject are mandatory and subject once opted should not be repeated.</p>
	<?php if( empty($subjects || $subjects->isEmpty()) || count($subjects)==0 || !$submitted) { ?>

	@if($stream=="Commerce")
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
<div class="form-group">
	<label>I have Passed the Matriculation Examination (or Equivalent) :</label>
</div>
<div class="form-group" style="display:flex;">
	<div class="col-md-5">
	<label>From (School) <span style="color:red;">*</span></label>
	<input type="text" class="form-control" value="{{isset($formData[0]->from_school) ? $formData[0]->from_school : old('from_school')}}" name="from_school" value="" id="from_school" required>
</div>
<div class="col-md-2">
<label>Total Marks Obtained  <span style="color:red;">*</span></label>
<input type="number" maxlength="3" class="form-control" value="{{isset($formData[0]->tmo) ? $formData[0]->tmo : old('tmo')}}" name="tmo" value="" id="tmo" required>
</div>
<div class="col-md-2">
<label>Max Marks <span style="color:red;">*</span></label>
<input type="number" maxlength="3" onblur="CalculatePercentage(this)" class="form-control"  value="{{isset($formData[0]->max_marks) ? $formData[0]->max_marks : old('max_marks')}}" name="max_marks" value="" id="max_marks" required>
</div>
<div class="col-md-2">
<label>Percentage Secured <span style="color:red;">*</span></label>
<input type="text" class="form-control" name="percentage_secured"value="{{isset($formData[0]->percentage_secured) ? $formData[0]->percentage_secured : old('percentage_secured')}}" id="percentage_secured" required>
</div>
</div>
<div class="form-group">
	<label>Jharkhand Academic Council Registration No (If Any)  : </label>
	<input type="text" class="form-control" name="jac_reg_no" value="{{isset($formData[0]->jac_reg_no) ? $formData[0]->jac_reg_no : old('jac_reg_no')}}" id="jac_reg_no" >
</div>
<div class="form-group">
	<label>If admitted, will reside <span style="color:red;">*</span></label>
<div style="display: flex;flex-wrap: nowrap;">
<label class="custom-control custom-radio">
<input type="radio" class="custom-control-input" name="reside_with" id="reside_with" value="With Parents or Natural Guardians" @if((isset($formData[0]->reside_with)  ? $formData[0]->reside_with : '') == 'With Parents or Natural Guardians') { checked } @endif required/>
<span class="custom-control-label">With Parents or Natural Guardians </span>
</label>
<label class="custom-control custom-radio" style="margin-left: 25px;">
<input type="radio" class="custom-control-input" name="reside_with" id="reside_with" value="With Recognized Local Guardian" @if((isset($formData[0]->reside_with)  ? $formData[0]->reside_with : '') == 'With Recognized Local Guardian') { checked } @endif required/>
<span class="custom-control-label">With Recognized Local Guardian </span>
</label>
</div>
</div>
<div class="form-group" style="text-align: center;text-decoration: underline;">
	<b>PLEDGE :</b>
</div>
<div class="form-group">
	<b>Knowing that the aim of St. Paul’s College is character building with physical, mental development of student focusing on their physical education and cultural orientation.
Knowing that the religious feeling of  all students and their freedom of conscience will be respected in St. Paul’s College, Ranchi. Which is minority institution established and administered by the Diocese of Chotanagpur (CNI) Ranchi.
Knowing also that this institution aims at motivating students for service with Missionary Zeal and helping them to cultivate gentlemanly manners and habits of systematic work with a sense of vacation. </b>
</div>

<div class="form-group" style="display:flex;">
	<b>I </b><div class="col-md-3"> <input id="pname" type="text" class="form-control" name="" value="{{Auth::user()->name}}" readonly/></div>
	<b>hereby pledge myself in any activities that will go against the interest of the College in general and against my own interest in particular.
		Failing which will be subject to any disciplinary action deemed and  proper by the College Authorities.</b>
	</div>
	<div class="form-group">
		<label><b>Note :</b></label>
		<ul style="list-style: inside;">
			<li>
					No application will be considered unless all particulars asked for are furnished and the required documents submitted.
			</li>
			<li>
					Admission once taken, no transfer certificate is allowed between the session, if college leaving Certificate is necessary required the whole session fee will be charged.
			</li>
		</ul>
</div>
<div class="form-group" style="display:flex;">
<div class="col-md-6">
	Date : <?php echo date('d-m-Y'); ?>
</div>
<div class="col-md-6">
</div>
</div>




									</form>

													</div>

													<div id="step-12" class="">
    													<form>
																<div class="row">
																<div class="col-md-12 row">
															<div class="col-md-6">
    														<div class="form-group">
    															<label>Photo</label>
																	<input type="file" accept="image/" onchange="loadImg_p(this)" class="form-control" name="photo" id="photo" required/>
    																<input type="hidden" value="@if(isset($docs[0]->photo)) {{ $docs[0]->photo }} @endif"  class="form-control" name="photo_path" id="photop" required/>
    											
															</div>
															</div>
															<div class="col-md-6">
															<div class="form-group">
															<img @if(isset($docs[0]->photo)) src="{{ URL::asset($docs[0]->photo)}}"  @endif id="photo_p"  width="100px" height="100px"/>
															</div>
															</div>

															</div>
															<div class="col-md-12 row">
															<div class="col-md-6">
																<div class="form-group">
																	<label>Signature</label>
																	<input type="file" accept="image/" onchange="loadImg_s(this)" class="form-control" name="signature"  id="signature" required/>
																	<input type="hidden" value="@if(isset($docs[0]->signature)) {{ $docs[0]->signature }} @endif"  class="form-control" name="s_path"  id="sp" required/>
    											
																</div>
															</div>
																<div class="col-md-6">
																<div class="form-group">
															<img @if(isset($docs[0]->signature)) src="{{ URL::asset($docs[0]->signature)}}"  @endif  id="signature_p"  width="100px" height="100px"/>
															</div>
																</div>														
																													
															</div>


															<div class="col-md-12 row" id="ct_cast">
															<div class="col-md-6">
																<div class="form-group">
																	<label>Cast Certificate (pdf only)</label>
																	<input type="file" onchange="loadImg_cast(this)" class="form-control" name="cast_certi"  id="cast_certi" required/>
																	<input type="hidden" value="@if(isset($docs[0]->cast_doc)) {{ $docs[0]->cast_doc }} @endif"  class="form-control" name="c_path" id="cp" required/>
    											
																</div>
															</div>
																<div class="col-md-6">
																<div class="form-group">
																<embed type="application/pdf" @if(isset($docs[0]->cast_doc)) src="{{ URL::asset($docs[0]->cast_doc)}}"  @endif id="cast_certi_p" src="" width="800px" height="400px" />															
															</div>
																</div>														
																													
															</div>

															<div class="form-group" style="display:none;">
																	<input type="submit" id="file_upload" class="btn btn-primary" name="Upload" value="Upload"/>
																</div>
															</div>

    													</form>
    												</div>

    												<div id="step-11" class="">
    													<form method="post" action="{{url('/application/paymentRequest')}}" >
																<div class="form-group">
																		<label><span style="color:red;">Payment Information : </span></label>
																		<p> Application Fee  <b><?php echo $pay_status=="0000" ? "Received." :"Not Received."; ?></b></p>
																	</div>
																<div class="row">
																<div class="col-md-12">
																<div class="form-group">
																<label>Fee Paid For </label>
																	<input type="text" class="form-control" id="course" name="course" value="{{$stream}}" required  readonly style="
    border: transparent;
    font-weight: bolder;
    color: #000;
" />
																</div>
    														<div class="form-group">
    															<label>Name</label>
																	<input type="text" class="form-control" name="name" value="{{Auth::user()->name}}" id="inputtext" readonly>
    														</div>
																<div class="form-group">
																	<label>Email</label>
																	<input type="text" class="form-control" name="email" value="{{Auth::user()->email}}" id="inputtext" readonly>
																</div>
																<div class="form-group">
																	<label>Mobile</label>
																	<input type="text" class="form-control" name="mobile" value="{{Auth::user()->mobile}}" id="inputtext" readonly>
																</div>
																<div class="form-group">
    															<label>Amount Payable : </label>
																	<span>INR {{ env('FEE') }}</span>
    															<input type="hidden" id="pay_status" class="form-control" name="pay_status" value="<?php echo $pay_status ?>"  readonly>
																	<br><span style="color:red;">Note :</span>
																	<ul style="list-style-type:disc;margin-left:20px;">
																		<li>
																			<span style="color:red;">Transaction charges Extra.</span>
																		</li>
																		<li>
																			<span style="color:red;">In case your fee gets deducted from Bank account but does not reflect in your application then kindly wait for 48 hr to get the same updated (Do not pay again).</span>
																		</li>
																	</ul>
    														</div>
																<div class="form-group">
																	<input type="submit" id="pay" class="btn btn-primary" name="Pay" value="Pay"/>
																</div>
															</div>
															</div>

    													</form>
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

function CalculatePercentage(el){
	var tmo=$("#tmo").val();
//	alert(el.value);
	$("#percentage_secured").val(parseFloat((tmo/el.value)*100).toFixed(2));
}

function myFunction() {
	var name=document.getElementById('name').value;
	document.getElementById("pname").value=name;
	document.getElementById("t").href = "https://translate.google.co.in/?sl=en&tl=hi&text="+name+"&op=translate";
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
	var o_study_o=$(".o_study:checked").val()
	if(o_study_o=="Yes"){
		$(".sp").show();
	}else{
		$(".sp").hide();
	}
	$(".o_study").on("change",function(){
		var o_study_o=$(".o_study:checked").val()
		//alert(o_study_o);
		if(o_study_o=="Yes"){
		$(".sp").show();
	}else{ //alert();
		$(".sp").hide();
	}
	})

	var castname=$("input:radio.cast:checked").val();//alert(castname);
	if(castname=="Schedule Tribe" || castname=="Schedule Cast" || castname=="Other Backward Class"){
			$("#ct_cast").show();
		}else{
			$("#ct_cast").hide();
		}
	$(".cast").change(function(){
		if(this.value=="Schedule Tribe" || this.value=="Schedule Cast" || this.value=="Other Backward Class"){
			$("#ct_cast").show();
		}else{
			$("#ct_cast").hide();
		}
	});

	$("#file_upload").click(function(evt){
		evt.preventDefault();
	//	alert();exit;
		var fd = new FormData();
        var photo = $('#photo')[0].files;
		if(photo[0]=="" || photo[0]===null || photo[0]==undefined){
			$.notify("Please select Valid Photo File.", "error");
			return false;
		}
		var signature = $('#signature')[0].files;
		if(signature[0]=="" || signature[0]==null || signature[0]==undefined){
			$.notify("Please select Valid Signature File.", "error");
			return false;
		}
			var castname=$("input:radio.cast:checked").val();

			/*if( $('#ct_cast').css('display') != 'none' )*/ 
			if(castname=="Schedule Tribe" || castname=="Schedule Cast" || castname=="Other Backward Class") {
			var cast_certi = $('#cast_certi')[0].files;
			if(cast_certi[0]=="" || cast_certi[0]==null || cast_certi[0]==undefined){
				$.notify("Please select Valid Cast Certificate File.", "error");
				return false;
			}else{
			fd.append('cast_certi',cast_certi[0]);
			}
		}else{
		var cast_certi = $('#cast_certi')[0].files;
			fd.append('cast_certi',null);
		}
		fd.append('photo',photo[0]);
		fd.append('signature',signature[0]);
		
		fd.append('course',$("#course").val());
		//console.log(fd);exit;
		var _url = $("#_url").val();
		/*alert(_url);*/
		$.ajax({
		type: "POST",
			 url: _url + '/application/save/upload',
			 data: fd,
			 cache: false,
			 enctype: 'multipart/form-data',
       	     processData: false,
             contentType: false,	
      		 
			 success: function ( data ) {
			 	
				$.notify(data, "error");
			},
			 error: function (jqXHR, exception) {
				 	return false;
var msg = '';
if (jqXHR.status === 0) {
msg = 'Not connect.\n Verify Network.';
} else if (jqXHR.status == 404) {
msg = 'Requested page not found. [404]';
} else if (jqXHR.status == 500) {
msg = 'Internal Server Error [500].';
} else if (exception === 'parsererror') {
msg = 'Requested JSON parse failed.';
} else if (exception === 'timeout') {
msg = 'Time out error.';
} else if (exception === 'abort') {
msg = 'Ajax request aborted.';
} else {
msg = 'Uncaught Error.\n' + jqXHR.responseText;
}
alert(msg);
},

	 });
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

	$("input[name='course']").change(function() {
	//	alert();
  //  var index = $(this).attr('name').substr(2);
		var classname=this.value;

		if(classname=='Commerce'){
				$("#subs").empty();
				$("#subs").append('<table id="example" class="table card-table table-vcenter  table-warning">\
				<thead>\
				<tr>\
					<th>Subject</th>\
					<th class="Commerce">Commerce</th>\
				</tr>\
			</thead>\
			<tbody>\
			<tr>\
				<td><input style="background: transparent;border: navajowhite;" name="sub_type" type="text" value="Core" class="sub_type form-control" readonly/></td>\
				<td><input type="text" value="" name="subject" class="subject form-control"/></td>\
			</tr></tbody>\
			<tr>\
				<td><input style="background: transparent;border: navajowhite;" name="sub_type" type="text" value="Elective" class="sub_type form-control" readonly/></td>\
				<td><input type="text" value="NA" name="subject" class="subject form-control"/></td>\
			</tr>\
			<tr>\
				<td><input style="background: transparent;border: navajowhite;" name="sub_type" type="text" value="Compulsory-1" class="sub_type form-control" readonly/> </td>\
				<td><input type="text" name="subject" value="Accountancy (ACT)" class="subject form-control" readonly/></td>\
			</tr>\
			<tr>\
				<td><input style="background: transparent;border: navajowhite;" name="sub_type" type="text" value="Compulsory-2" class="sub_type form-control" readonly/> </td>\
				<td><input type="text" name="subject" value="Business Studies (BST)" class="subject form-control"/></td>\
			</tr>\
			<tr>\
				<td><input style="background: transparent;border: navajowhite;" name="sub_type" type="text" value="Optional – 1" class="sub_type form-control" readonly/> </td>\
				<td><input type="text" value="" name="subject" class="subject form-control"/></td>\
			</tr>\
			<tr>\
				<td><input style="background: transparent;border: navajowhite;" name="sub_type" type="text" value="Optional – 2" class="sub_type form-control" readonly/></td>\
				<td><input type="text" value="" name="subject" class="subject form-control"/></td>\
			</tr>\
			<tr>\
				<td> <input style="background: transparent;border: navajowhite;" name="sub_type" type="text" value="Optional – 3" class="sub_type form-control" readonly/></td>\
				<td><input type="text" value="NA" name="subject" class="subject form-control"/></td>\
			</tr>\
			<tr>\
				<td><input style="background: transparent;border: navajowhite;" name="sub_type" type="text" value="Additional" class="sub_type form-control" readonly/> </td>\
				<td><input type="text" name="subject" value="" class="subject form-control"/></td>\
			</tr>\
			</table>');
			}

		if(classname=='Science'){
				$("#subs").empty();
				$("#subs").append('<table id="example"  class="table card-table table-vcenter  table-warning">\
				<thead>\
				<tr>\
					<th>Subject</th>\
					<th class="Science">Science</th>\
				</tr>\
			</thead>\
			<tbody>\
			<tr>\
				<td><input style="background: transparent;border: navajowhite;" name="sub_type" type="text" value="Core" class="sub_type form-control" readonly/></td>\
				<td><input type="text" value="" name="subject" class="subject form-control"/></td>\
			</tr></tbody>\
			<tr>\
				<td><input style="background: transparent;border: navajowhite;" name="sub_type" type="text" value="Elective" class="sub_type form-control" readonly/></td>\
				<td><input type="text" value="NA" name="subject" class="subject form-control"/></td>\
			</tr>\
			<tr>\
				<td><input style="background: transparent;border: navajowhite;" name="sub_type" type="text" value="Compulsory-1" class="sub_type form-control" readonly/> </td>\
				<td><input type="text" name="subject" value="Physics (PHY)" class="subject form-control" readonly/></td>\
			</tr>\
			<tr>\
				<td><input style="background: transparent;border: navajowhite;" name="sub_type" type="text" value="Compulsory-2" class="sub_type form-control" readonly/> </td>\
				<td><input type="text" name="subject" value="Chemistry (CHE)" class="subject form-control"/></td>\
			</tr>\
			<tr>\
				<td><input style="background: transparent;border: navajowhite;" name="sub_type" type="text" value="Optional – 1" class="sub_type form-control" readonly/> </td>\
				<td><input type="text" value="" name="subject" class="subject form-control"/></td>\
			</tr>\
			<tr>\
				<td><input style="background: transparent;border: navajowhite;" name="sub_type" type="text" value="Optional – 2" class="sub_type form-control" readonly/></td>\
				<td><input type="text" value="" name="subject" class="subject form-control"/></td>\
			</tr>\
			<tr>\
				<td> <input style="background: transparent;border: navajowhite;" name="sub_type" type="text" value="Optional – 3" class="sub_type form-control" readonly/></td>\
				<td><input type="text" value="NA" name="subject" class="subject form-control"/></td>\
			</tr>\
			<tr>\
				<td><input style="background: transparent;border: navajowhite;" name="sub_type" type="text" value="Additional" class="sub_type form-control" readonly/> </td>\
				<td><input type="text"  name="subject" value="" class="subject form-control"/></td>\
			</tr>\
			</table>');
			}

	if(classname=='Arts'){
			$("#subs").empty();
			$("#subs").append('<table id="example"  class="table card-table table-vcenter  table-warning">\
			<thead>\
			<tr>\
				<th>Subject</th>\
				<th class="arts">Arts</th>\
			</tr>\
		</thead>\
		<tbody>\
		<tr>\
			<td><input style="background: transparent;border: navajowhite;" name="sub_type" type="text" value="Core" class="sub_type form-control" readonly/></td>\
			<td><input type="text" value="" name="subject" class="subject form-control"/></td>\
		</tr></tbody>\
		<tr>\
			<td><input style="background: transparent;border: navajowhite;" name="sub_type" type="text" value="Elective" class="sub_type form-control" readonly/></td>\
			<td><input type="text" value="" name="subject" class="subject form-control"/></td>\
		</tr>\
		<tr>\
			<td><input style="background: transparent;border: navajowhite;" name="sub_type" type="text" value="Compulsory-1" class="sub_type form-control" readonly/> </td>\
			<td><input type="text" value="NA" name="subject" class="subject form-control" readonly/></td>\
		</tr>\
		<tr>\
			<td><input style="background: transparent;border: navajowhite;" name="sub_type" type="text" value="Compulsory-2" class="sub_type form-control" readonly/> </td>\
			<td><input type="text" value="NA" name="subject" class="subject form-control"/></td>\
		</tr>\
		<tr>\
			<td><input style="background: transparent;border: navajowhite;" name="sub_type" type="text" value="Optional – 1" class="sub_type form-control" readonly/> </td>\
			<td><input type="text" value="" name="subject" class="subject form-control"/></td>\
		</tr>\
		<tr>\
			<td><input style="background: transparent;border: navajowhite;" name="sub_type" type="text" value="Optional – 2" class="sub_type form-control" readonly/></td>\
			<td><input type="text" value="" name="subject" class="subject form-control"/></td>\
		</tr>\
		<tr>\
			<td> <input style="background: transparent;border: navajowhite;" name="sub_type" type="text" value="Optional – 3" class="sub_type form-control" readonly/></td>\
			<td><input type="text" value="" name="subject" class="subject form-control"/></td>\
		</tr>\
		<tr>\
			<td><input style="background: transparent;border: navajowhite;" name="sub_type" type="text" value="Additional" class="sub_type form-control" readonly/> </td>\
			<td><input type="text" name="subject" value="" class="subject form-control"/></td>\
		</tr>\
		</table>');
		}
});
});
</script>
@endsection
