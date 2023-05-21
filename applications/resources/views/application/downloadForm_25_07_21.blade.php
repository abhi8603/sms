<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>

		<!-- Meta data -->
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta content="Clont - Bootstrap Webapp Responsive Dashboard Simple Admin Panel Premium HTML5 Template" name="description">
		<meta content="Spruko Technologies Private Limited" name="author">
		<meta name="keywords" content="Admin, Admin Template, Dashboard, Responsive, Admin Dashboard, Bootstrap, Bootstrap 4, Clean, Backend, Jquery, Modern, Web App, Admin Panel, Ui, Premium Admin Templates, Flat, Admin Theme, Ui Kit, Bootstrap Admin, Responsive Admin, Application, Template, Admin Themes, Dashboard Template"/>
		<link href="{{ URL::asset('assets/css/style.css')}}" rel="stylesheet" />
		<link href="{{ URL::asset('assets/css/skin-modes.css')}}" rel="stylesheet" />

		<!--Horizontal css -->
        <link id="effect" href="{{ URL::asset('assets/plugins/horizontal-menu/dropdown-effects/fade-up.css')}}" rel="stylesheet" />
        <link href="{{ URL::asset('assets/plugins/horizontal-menu/horizontal.css')}}" rel="stylesheet" />

		<!-- P-scroll bar css-->
		<link href="{{ URL::asset('assets/plugins/p-scrollbar/p-scrollbar.css')}}" rel="stylesheet" />

		<!---Icons css-->
		<link href="{{ URL::asset('assets/plugins/web-fonts/icons.css')}}" rel="stylesheet" />
		<link href="{{ URL::asset('assets/plugins/web-fonts/font-awesome/font-awesome.min.css')}}" rel="stylesheet">
		<link href="{{ URL::asset('assets/plugins/web-fonts/plugin.css')}}" rel="stylesheet" />

		<!-- Switcher css -->
		<link  href="{{ URL::asset('assets/switcher/css/switcher.css')}}" rel="stylesheet" id="switcher-css" type="text/css" media="all"/>
		<link  href="{{ URL::asset('assets/plugins/date-picker/date-picker.css')}}" rel="stylesheet" id="switcher-css" type="text/css" media="all"/>

		<!-- Skin css-->
	<!--	<link id="theme" rel="stylesheet" type="text/css" media="all" href="{{ URL::asset('assets/skins/hor-skin/skin.css')}}" />-->
		<link id="theme" rel="stylesheet" type="text/css" media="all" href="{{ URL::asset('assets/skins/hor-skin/hor-skin2.css')}}" />
		<link id="theme" rel="stylesheet" type="text/css" media="all" href="{{ URL::asset('assets/skins/hor-skin/main2.css')}}" />

		<link rel="stylesheet" href="{{ URL::asset('assets/skins/demo.css')}}"/>
	
	<style>
	.form-control {
	border: none;
	display: block;
	width: 100%;
	padding: 0.375rem 0.75rem;
	font-size: 0.9375rem;
	line-height: 1.6;
	color: #6b6f80;
	background-color: #fff;
	background-clip: padding-box;
	border: 1px solid rgba(67, 87, 133, .2);
	border-radius: 3px;
	transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}
	</style>
	</head>

	<body class="app">

		<div class="page">
			<div class="page-main">


				<div class="app-content">
					<div class="container">
						<div class="row">
							<div class="col-md-12">

								<div class="card" style="margin-top:30px;">
									<div class="card-header">
                    <div class="col-md-5">
                      <img src="<?php echo asset(app_config('AppLogo')); ?>" class="header-brand-img desktop-lgo" alt="<?php echo app_config('AppName') ?>">
                  </div>
                    <div class="col-md-6">
                      <h4>
                    <?php echo app_config('AppName') ?></h4>
                  </div>
									</div>
									<div class="card-body">
                  <div class="row col-md-12">
                    <div class="col-md-8">
											<h4 class="mb-1">Hi <strong><?php echo $formData[0]->name."(".$formData[0]->email .")"; ?></strong>,</h4>
											This is the receipt for a payment of <strong><?php echo $pay_info[0]->orgTxnAmount; ?></strong> (INR) for your Application Fee
										</div>
                    <div class="col-md-4" style="text-align:end;">
                      <span>Payment Status : </span>
                      <strong><?php echo $pay_info[0]->pgRespCode=="000" ? "<span style='color: red;
    font-weight: 400;'>Success</span>" : "<span style='color: green;
font-weight: 400;'>Failed</span>"; ?></strong>
                    </div>
                  </div>

										<div class="card-body pl-0 pr-0">
											<div class="row">
												<div class="col-sm-6">
													<span>Payment No.</span><br>
													<strong><?php echo $pay_info[0]->PGTxnNo; ?></strong>
												</div>
												<div class="col-sm-6 text-right">
													<span>Payment Date</span><br>
													<strong><?php echo $pay_info[0]->created_date  ; ?></strong>
												</div>
											</div>
										</div>
										<div class="dropdown-divider"></div>
										<div class="row pt-4">
	                 <div class="table-responsive push">
                    										
    													<form id="applicationForm" name="applicationForm" enctype="multipart/form-data" method="post">
														
    														<div class="form-group">
                                  	<label>I desire to join <span style="color:red;">*</span></label>
                                    <div style="display: flex;flex-wrap: nowrap;">
                                							<input type="text" class="form-control" id="course" name="course" value="{{$formData[0]->course}}" required  readonly style="
    border: transparent;
    font-weight: bolder;
    color: #000;
" />
  						  
                        </div>
                    						</div>
    														<div class="form-group">
    															<label>Name of the applicant <span style="color:red;">*</span></label>
															
    															<input type="text" style="border: none;" class="form-control" name="name" value="{{Auth::user()->name}}" id="name" placeholder="Name" readonly>
                              	</div>
                                <div class="form-group">
                                  <label>Name in Hindi  <span style="color:red;">*</span></label> <a id="t" onclick="myFunction()"  target="_blank" href="">(Translate)</a>
                                  <input type="text" class="form-control" style="border: none;" name="name_hindi" value="{{isset($formData[0]->name_hindi) ? $formData[0]->name_hindi : old('name_hindi')}}" id="name_hindi" placeholder="Name in hindi" required>
                                </div>
                                <div class="form-group">
    															<label>Date of Birth ( As recorded on Matriculation Record) <span style="color:red;">*</span></label>
																	<div class="input-group">
								<p>	{{isset($formData[0]->dob) ? $formData[0]->dob : old('dob')}}	</p>											</div>
    														</div>
																<div class="form-group">
																	<label>Gender  <span style="color:red;">*</span></label>
																<div style="display: flex;flex-wrap: nowrap;">
																{{$formData[0]->gender}}

																</div>
																</div>

																<div class="form-group">
																	<label>State whether you belong to one of the following  <span style="color:red;">*</span></label>
																<div style="display: flex;flex-wrap: nowrap;">
																 {{$formData[0]->cast}}
																<label class="custom-control" style="width: 10%;">
																	Sub-Caste :
																	<input style="width: 45%;border: none;" type="text" class="form-control" name="subcast" value="{{isset($formData[0]->subcast) ? $formData[0]->subcast : 'NA'}}"/>
																</label>
																
																</div>
																</div>
																<div class="form-group" style="display: flex;">
																	<div class="col-md-6">
																	<label>Religion <span style="color:red;">*</span></label>
																	<input type="text" style="border: none;" class="form-control" value="{{isset($formData[0]->religion) ? $formData[0]->religion : old('religion')}}" name="religion" id="religion" placeholder="Religion" required readonly>
																	
																
																</div>
																	<div class="col-md-6">
																	<label>Denomination (If Christian)</label>
																	<input type="text" style="border: none;" value="{{isset($formData[0]->denomination) ? $formData[0]->denomination : old('denomination')}}" class="form-control" name="denomination" id="Denomination" placeholder="Denomination (If Christian)" readonly>
																</div>
															</div>
																<div class="form-group">
																	<label>Student Aadhar No. </label>
																	<input type="number" style="border: none;" maxlength="12" value="{{isset($formData[0]->stu_aadhar) ? $formData[0]->stu_aadhar : old('stu_aadhar')}}" onkeypress="checkLengthAadhar(this)" class="form-control" name="stu_aadhar" id="aadhar." placeholder="Student Aadhar No.">
															</div>

															<div class="form-group" style="display: flex;">
																<div class="col-md-6">
																<label>Father’s Name <span style="color:red;">*</span></label>
																<input type="text" value="{{isset($formData[0]->f_name) ? $formData[0]->f_name : old('f_name')}}" class="form-control" name="f_name" id="f_name" placeholder="Father’s Name " required>
															</div>
																<div class="col-md-6">
																<label>Mother’s Name </label>
																<input type="text" value="{{isset($formData[0]->m_name) ? $formData[0]->m_name : old('m_name')}}" class="form-control" name="m_name" id="m_name" placeholder="Mother’s Name ">
															</div>
														</div>
														<div class="form-group" style="display: flex;">
														<div class="col-md-6">
															<label>Guardian Name (If father is dead)</label>
															<input type="text" value="{{isset($formData[0]->g_name) ? $formData[0]->g_name : old('g_name')}}" class="form-control" name="g_name" id="g_name" placeholder="Guardian Name (If father is dead)">
														</div>
														<div class="col-md-6">
															<label>Occupation of (Father / Mother / Guardian)</label>
															<input type="text" value="{{isset($formData[0]->occupation) ? $formData[0]->occupation : old('occupation')}}" class="form-control" name="occupation" id="Occupation" placeholder="Occupation of (Father / Mother / Guardian)">
														</div>
													</div>
													<div class="form-group" style="display: flex;">
													<div class="col-md-6">
														<label>Present Address of Father / Guardians (Village / At) <span style="color:red;">*</span></label>
														<textarea class="form-control" name="present_address" id="present_address" placeholder="Village, Po , PS, District, Pin, State" required> {{isset($formData[0]->present_address) ? $formData[0]->present_address : old('present_address')}}</textarea>
													</div>
													<div class="col-md-6">
														<label>Permanent Address  Address of Father / Guardians (Village / At) <span style="color:red;">*</span></label>
														<textarea class="form-control" name="permanent_address" id="permanent_address" placeholder="Village, Po , PS, District, Pin, State" required> {{isset($formData[0]->permanent_address) ? $formData[0]->permanent_address : old('permanent_address')}}</textarea>
													</div>
												</div>
												<div class="form-group" style="display: flex;">
												<div class="col-md-6">
													<label>Phone No (Student) <span style="color:red;">*</span></label>
													<input type="number" maxlength="10" class="form-control" value="{{Auth::user()->mobile}}" name="s_phone_no" id="s_phone_no" placeholder="Phone No (Student)" readonly>
												</div>
												<div class="col-md-6">
													<label>Email-ID <span style="color:red;">*</span></label>
													<input type="email" class="form-control" value="{{Auth::user()->email}}" name="email" id="email" placeholder="Email-ID" readonly>
												</div>
											</div>
											<div class="form-group" style="display: flex;">
											<div class="col-md-6">
												<label>Blood Group</label>
												<input type="text" value="{{isset($formData[0]->blood_group) ? $formData[0]->blood_group : old('blood_group')}}" class="form-control" name="blood_group" id="blood_group" placeholder="Blood Group">
											</div>
											<div class="col-md-6">
												<label>Mark of Identification</label>
												<input type="text" class="form-control" value="{{isset($formData[0]->identification_mark) ? $formData[0]->identification_mark : old('identification_mark')}}" name="identification_mark" id="identification_mark" placeholder="Mark of Identification">
											</div>
										</div>

										<div class="form-group">
											<label>Brother/Sister Studying in this College  </label>
										<div style="display: flex;flex-wrap: nowrap;">
										<label class="custom-control custom-radio">
										<input type="radio" class="custom-control-input" name="o_study" @if((isset($formData[0]->o_study)  ? $formData[0]->o_study : '') == 'Yes') { checked } @endif  value="Yes"/>
										<span class="custom-control-label">Yes</span>
										</label>
										<label class="custom-control custom-radio" style="margin-left: 25px;">
										<input type="radio" checked class="custom-control-input" name="o_study" @if((isset($formData[0]->o_study)  ? $formData[0]->o_study : '') == 'No') { checked } @endif value="No"/>
										<span class="custom-control-label">No</span>
										</label>
										</div>
										</div>
										<label>If yes kindly provide the following details</label>

										<div class="form-group" style="display: flex;">
										<div class="col-md-5">
											<label>Name</label>
											<input type="text" value="{{isset($formData[0]->o_name) ? $formData[0]->o_name : old('o_name')}}" class="form-control" name="o_name" id="o_Name" placeholder="Name">
										</div>
										<div class="col-md-4">
											<label>Course & Session</label>
											<input type="text" value="{{isset($formData[0]->course_session) ? $formData[0]->course_session : old('course_session')}}" class="form-control" name="course_session" id="Course_Session" placeholder="Course & Session">
										</div>
										<div class="col-md-3">
											<label>Mobile No</label>
											<input type="number" maxlength="10" onkeypress="checkLengthMobile(this)" value="{{isset($formData[0]->o_mobile) ? $formData[0]->o_mobile : old('o_mobile')}}" class="form-control" value="" name="o_mobile" id="Mobile_No" placeholder="Mobile No">
										</div>
										</div>
<div class="form-group" id="subs">
	<table id="example" class="table card-table table-vcenter  table-warning">
		<thead>
			<tr>
			<th>Sl.No</th>
				<th>Subject</th>
				<th class="arts">{{isset($formData[0]->course) ? $formData[0]->course : ''}}</th>
				</tr>
		</thead>
	<tbody>
	<tbody>
                            @php $i=0; @endphp
                            @foreach($formData as $key=>$value)
                            @php $i++; @endphp
                            <tr>
                              <td class="text-center">{{$i}}</td>
                              <td class="text-center">{{$value->sub_type}}</td>
                              <td class="text-center">{{$value->sub_name}}</td>
                            </tr>
                            @endforeach
                          </tbody>
	</tbody>
</table>



</div>
<div class="form-group">
	<label>I have Passed the Matriculation Examination (or Equivalent) :</label>
</div>
<div class="form-group" style="display:flex;">
	<div class="col-md-5">
	<label>From (School) <span style="color:red;">*</span></label>
	<input type="text" class="form-control" value="{{isset($formData[0]->from_school) ? $formData[0]->from_school : old('from_school')}}" name="from_school" value="" id="from_school" placeholder="From (School)">
</div>
<div class="col-md-2">
<label>Total Marks Obtained  <span style="color:red;">*</span></label>
<input type="number" maxlength="3" class="form-control" value="{{isset($formData[0]->tmo) ? $formData[0]->tmo : old('tmo')}}" name="tmo" value="" id="tmo" placeholder="Total Marks Obtained">
</div>
<div class="col-md-2">
<label>Max Marks <span style="color:red;">*</span></label>
<input type="number" maxlength="3" class="form-control"  value="{{isset($formData[0]->max_marks) ? $formData[0]->max_marks : old('max_marks')}}" name="max_marks" value="" id="max_marks" placeholder="Max Marks">
</div>
<div class="col-md-2">
<label>Percentage Secured <span style="color:red;">*</span></label>
<input type="text" class="form-control" name="percentage_secured"value="{{isset($formData[0]->percentage_secured) ? $formData[0]->percentage_secured : old('percentage_secured')}}" id="percentage_secured" placeholder="Percentage Secured">
</div>
</div>
<div class="form-group">
	<label>Jharkhand Academic Council Registration No (If Any)  : <span style="color:red;">*</span></label>
	<input type="text" class="form-control" name="jac_reg_no" value="{{isset($formData[0]->jac_reg_no) ? $formData[0]->jac_reg_no : old('jac_reg_no')}}" id="jac_reg_no" placeholder="JAC Registration No">
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
	<img src="{{ URL::asset('assets/psign.jpeg')}}" style="height: 50px;width:130px;float:right;"/>
</div>
</div>
<div class="form-group" style="display:flex;">
<div class="col-md-6">
<img src="{{ URL::asset($formDoc[0]->photo)}}" style="height: 50px;width:130px;float:left;"/>
</div>
<div class="col-md-6">
	<img src="{{ URL::asset($formDoc[0]->signature)}}" style="height: 50px;width:130px;float:right;"/>
</div>
</div>	




									</form>
                    </div>


										<div class="table-responsive push">



											<table class="table table-bordered table-hover">


												<tr>
													<td colspan="4" class="font-w600 text-right">Application Fee</td>
													<td class="text-right"><?php echo "INR ". $pay_info[0]->orgTxnAmount; ?></td>
												</tr>
												<tr>
													<td colspan="4" class="font-weight-bold text-uppercase text-right">Total</td>
													<td class="font-weight-bold text-right"><strong><?php echo "INR ". $pay_info[0]->orgTxnAmount; ?></strong></td>
												</tr>
                        <tr>
                      													<td colspan="5" class="text-right">
                      														<button type="button" class="btn btn-info" onClick="javascript:window.print();"><i class="si si-printer"></i> Print Form</button>
                      													</td>
                      												</tr>
											</table>
										</div>
										<p class="text-muted text-center">Thank you !</p>
									</div>
								</div>
							</div>
						</div>
						<!-- End row-->

					</div>
				</div><!-- end app-content-->
			</div>
			<!-- End Footer-->

		</div>

    <!-- Jquery js-->
    <script src="{{ URL::asset('assets/js/vendors/jquery-3.4.0.min.js')}}"></script>

    <!-- Bootstrap4 js-->
    <script src="{{ URL::asset('assets/plugins/bootstrap/popper.min.js')}}"></script>
    <script src="{{ URL::asset('assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>

    <!--Othercharts js-->
    <script src="{{ URL::asset('assets/plugins/othercharts/jquery.sparkline.min.js')}}"></script>

    <!-- Circle-progress js-->
    <script src="{{ URL::asset('assets/js/vendors/circle-progress.min.js')}}"></script>

    <!-- Jquery-rating js-->
    <script src="{{ URL::asset('assets/plugins/rating/jquery.rating-stars.js')}}"></script>

    <!--Horizontal js-->
    <script src="{{ URL::asset('assets/plugins/horizontal-menu/horizontal.js')}}"></script>

    <!-- P-scroll js-->
    <script src="{{ URL::asset('assets/plugins/p-scrollbar/p-scrollbar.js')}}"></script>
    <script src="{{ URL::asset('assets/plugins/p-scrollbar/p-scroll.js')}}"></script>
    <!-- Switcher js -->
    <script src="{{ URL::asset('assets/switcher/js/switcher.js')}}"></script>
  	<script src="{{ URL::asset('assets/plugins/date-picker/date-picker.js')}}"></script>
  	<script src="{{ URL::asset('assets/plugins/date-picker/jquery-ui.js')}}"></script>
<script>
//	alert();
$("#applicationForm input").prop("disabled", true);
$("#applicationForm input").prop("placeholder", 'NA');
$("#applicationForm textarea").prop("placeholder", 'NA');
$("#applicationForm textarea").prop("disabled", true);
$("#applicationForm input").css("border", 'none');
$('.form-control').css("border", 'none');
</script>


	</body>
</html>
