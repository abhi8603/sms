@extends('header')
@section('style')
<link rel="stylesheet" href="{{ URL::asset('assets/plugins/forn-wizard/css/forn-wizard.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/plugins/formwizard/smart_wizard.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/plugins/formwizard/smart_wizard_theme_dots.css') }}">

@endsection
@section('content')
<div class="app-content page-body">
					<div class="container">

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
    												<li><a href="#step-11">Payment</a></li>
    												<li><a href="#step-12">Finish</a></li>
    											</ul>
    											<div>
    												<div id="step-10" class="">
    													<form >
    														<div class="form-group">
                                  	<label>I desire to join</label>
                                    <div style="display: flex;flex-wrap: nowrap;">
                                  <label class="custom-control custom-radio">
  															<input type="radio" class="custom-control-input" name="course" value="Arts"/>
  															<span class="custom-control-label">Arts</span>
  														</label>
                              <label class="custom-control custom-radio" style="margin-left: 25px;">
                            <input type="radio" class="custom-control-input" name="course" value="Science"/>
                            <span class="custom-control-label">Science</span>
                          </label>
                          <label class="custom-control custom-radio" style="margin-left: 25px;">
                        <input type="radio" class="custom-control-input" name="course" value="Commerce"/>
                        <span class="custom-control-label">Commerce</span>
                      </label>
                        </div>
                    						</div>
    														<div class="form-group">
    															<label>Name of the applicant </label>
    															<input type="text" onblur="myFunction()" class="form-control" name="name" value="" id="name" placeholder="Name">
                              	</div>
                                <div class="form-group">
                                  <label>Name in Hindi  </label> <a id="t" target="_blank" href="https://translate.google.co.in/?sl=en&tl=hi&text=avhijeet&op=translate">(Translate)</a>
                                  <input type="text" class="form-control" name="name" value="" id="google_translate_element" placeholder="Name">
                                </div>
                                <div class="form-group">
    															<label>Date of Birth ( As recorded on Matriculation Record)</label>
																	<div class="input-group">
													<div class="input-group-prepend">
														<div class="input-group-text">
															<i class="fa fa-calendar tx-16 lh-0 op-6"></i>
														</div>
													</div><input class="form-control fc-datepicker" data-date-format="DD-MM-YYYY" placeholder="DD-MM-YYYY" type="date">
												</div>
    														</div>
																<div class="form-group">
																	<label>Gender  </label>
																<div style="display: flex;flex-wrap: nowrap;">
																<label class="custom-control custom-radio">
																<input type="radio" class="custom-control-input" name="gender" value="Male"/>
																<span class="custom-control-label">Male</span>
																</label>
																<label class="custom-control custom-radio" style="margin-left: 25px;">
																<input type="radio" class="custom-control-input" name="gender" value="Female"/>
																<span class="custom-control-label">Female</span>
																</label>

																</div>
																</div>

																<div class="form-group">
																	<label>5.	State whether you belong to one of the following  </label>
																<div style="display: flex;flex-wrap: nowrap;">
																<label class="custom-control custom-radio">
																<input type="radio" class="custom-control-input" name="cast" value="Schedule Tribe"/>
																<span class="custom-control-label">Schedule Tribe</span>
																</label>
																<label class="custom-control custom-radio" style="margin-left: 25px;">
																<input type="radio" class="custom-control-input" name="cast" value="Schedule Cast"/>
																<span class="custom-control-label">Schedule Cast</span>
																</label>
																<label class="custom-control custom-radio" style="margin-left: 25px;">
																<input type="radio" class="custom-control-input" name="cast" value="Other Backward Class "/>
																<span class="custom-control-label">Other Backward Class </span>
																</label>
																<label class="custom-control" style="width: 10%;">
																	Sub-Caste :
																</label>
																<input style="width: 45%;" type="text" class="form-control" name="subcast" value=""/>
																</div>
																</div>
																<div class="form-group" style="display: flex;">
																	<div class="col-md-6">
																	<label>Religion</label>
																	<input type="text" class="form-control" name="religion" id="religion" placeholder="Religion">
																</div>
																	<div class="col-md-6">
																	<label>Denomination (If Christian)</label>
																	<input type="text" class="form-control" name="denomination" id="Denomination" placeholder="Denomination (If Christian)">
																</div>
															</div>
																<div class="form-group">
																	<label>Student Aadhar No. </label>
																	<input type="text" class="form-control" name="aadhar" id="aadhar." placeholder="Student Aadhar No.">
															</div>

															<div class="form-group" style="display: flex;">
																<div class="col-md-6">
																<label>Father’s Name </label>
																<input type="text" class="form-control" name="f_name" id="f_name" placeholder="8.	Father’s Name ">
															</div>
																<div class="col-md-6">
																<label>Mother’s Name </label>
																<input type="text" class="form-control" name="m_name" id="m_name" placeholder="Mother’s Name ">
															</div>
														</div>
														<div class="form-group" style="display: flex;">
														<div class="col-md-6">
															<label>Guardian Name (If father is dead)</label>
															<input type="text" class="form-control" name="g_name" id="g_name" placeholder="Guardian Name (If father is dead)">
														</div>
														<div class="col-md-6">
															<label>Occupation of (Father / Mother / Guardian)</label>
															<input type="text" class="form-control" name="occupation" id="Occupation" placeholder="Occupation of (Father / Mother / Guardian)">
														</div>
													</div>
													<div class="form-group" style="display: flex;">
													<div class="col-md-6">
														<label>Present Address of Father / Guardians (Village / At)</label>
														<textarea class="form-control" name="present_address" id="Present Address" placeholder="Present Address of Father / Guardians (Village / At)"></textarea>
													</div>
													<div class="col-md-6">
														<label>Permanent Address  Address of Father / Guardians (Village / At)</label>
														<textarea class="form-control" name="permanent_address" id="Permanent Address" placeholder="Permanent Address of Father / Guardians (Village / At)"></textarea>
													</div>
												</div>
												<div class="form-group" style="display: flex;">
												<div class="col-md-6">
													<label>Phone No (Student)</label>
													<input type="number" class="form-control" name="s_phone_no" id="s_phone_no" placeholder="Phone No (Student)">
												</div>
												<div class="col-md-6">
													<label>Email-ID</label>
													<input type="email" class="form-control" name="email" id="email" placeholder="Email-ID">
												</div>
											</div>
											<div class="form-group" style="display: flex;">
											<div class="col-md-6">
												<label>Blood Group</label>
												<input type="text" class="form-control" name="blood_group" id="blood_group" placeholder="Blood Group">
											</div>
											<div class="col-md-6">
												<label>Mark of Identification</label>
												<input type="text" class="form-control" name="identification_mark" id="identification_mark" placeholder="Mark of Identification">
											</div>
										</div>

										<div class="form-group">
											<label>Brother/Sister Studying in this College  </label>
										<div style="display: flex;flex-wrap: nowrap;">
										<label class="custom-control custom-radio">
										<input type="radio" class="custom-control-input" name="o_study" value="Yes"/>
										<span class="custom-control-label">Yes</span>
										</label>
										<label class="custom-control custom-radio" style="margin-left: 25px;">
										<input type="radio" class="custom-control-input" name="o_study" value="No"/>
										<span class="custom-control-label">No</span>
										</label>
										</div>
										</div>
										<label>If yes kindly provide the following details</label>

										<div class="form-group" style="display: flex;">
										<div class="col-md-5">
											<label>Name</label>
											<input type="text" class="form-control" name="o_name" id="o_Name" placeholder="Name">
										</div>
										<div class="col-md-4">
											<label>Course & Session</label>
											<input type="text" class="form-control" name="course_session" id="Course_Session" placeholder="Course & Session">
										</div>
										<div class="col-md-3">
											<label>Mobile No</label>
											<input type="number" class="form-control" name="o_mobile" id="Mobile_No" placeholder="Mobile No">
										</div>
										</div>
<div class="form-group">
	<table class="table card-table table-vcenter  table-warning">
		<thead>
			<tr>
				<th>Subject</th>
				<th>Arts</th>
				<th>Commerce</th>
				<th>Science</th>
			</tr>
		</thead>
	<tbody>
		<tr>
			<td><input style="background: transparent;border: navajowhite;" type="text" value="Core" class="form-control" readonly/></td>
			<td><input type="text" value="" class="form-control"/></td>
			<td><input type="text" value="" class="form-control"/></td>
			<td><input type="text" value="" class="form-control"/></td>
		</tr>
		<tr>
			<td><input style="background: transparent;border: navajowhite;" type="text" value="Elective" class="form-control" readonly/></td>
			<td><input type="text" value="" class="form-control"/></td>
			<td><input type="text" value="NA" class="form-control" readonly/></td>
			<td><input type="text" value="NA" class="form-control" readonly/></td>
		</tr>
		<tr>
			<td><input style="background: transparent;border: navajowhite;" type="text" value="Compulsory-1" class="form-control" readonly/> </td>
			<td><input type="text" value="NA" class="form-control" readonly/></td>
			<td><input type="text" value="Accountancy (ACT)" class="form-control" readonly/></td>
			<td><input type="text" value="Physics (PHY)" class="form-control" readonly/></td>
		</tr>
		<tr>
			<td><input style="background: transparent;border: navajowhite;" type="text" value="Compulsory-2" class="form-control" readonly/> </td>
			<td><input type="text" value="NA" class="form-control"/></td>
			<td><input type="text" value="Business Studies (BST)" class="form-control" readonly/></td>
			<td><input type="text" value="Chemistry (CHE)" class="form-control" readonly/></td>
		</tr>
		<tr>
			<td><input style="background: transparent;border: navajowhite;" type="text" value="Optional – 1" class="form-control" readonly/> </td>
			<td><input type="text" value="" class="form-control"/></td>
			<td><input type="text" value="" class="form-control"/></td>
			<td><input type="text" value="" class="form-control"/></td>
		</tr>
		<tr>
			<td><input style="background: transparent;border: navajowhite;" type="text" value="Optional – 2" class="form-control" readonly/></td>
			<td><input type="text" value="" class="form-control"/></td>
			<td><input type="text" value="" class="form-control"/></td>
			<td><input type="text" value="" class="form-control"/></td>
		</tr>
		<tr>
			<td> <input style="background: transparent;border: navajowhite;" type="text" value="Optional – 3" class="form-control" readonly/></td>
			<td><input type="text" value="" class="form-control"/></td>
			<td><input type="text" value="NA" class="form-control" readonly/></td>
			<td><input type="text" value="NA" class="form-control" readonly/></td>
		</tr>
		<tr>
			<td><input style="background: transparent;border: navajowhite;" type="text" value="Additional" class="form-control" readonly/> </td>
			<td><input type="text" value="" class="form-control"/></td>
			<td><input type="text" value="" class="form-control"/></td>
			<td><input type="text" value="" class="form-control"/></td>
		</tr>
</tbody>
	</table>
</div>
<div class="form-group">
	<label>I have Passed the Matriculation Examination (or Equivalent) :</label>
</div>
<div class="form-group" style="display:flex;">
	<div class="col-md-5">
	<label>From (School) </label>
	<input type="text" class="form-control" name="from_school" value="" id="School" placeholder="From (School)">
</div>
<div class="col-md-2">
<label>Total Marks Obtained  </label>
<input type="text" class="form-control" name="tmo" value="" id="tmo" placeholder="Total Marks Obtained">
</div>
<div class="col-md-2">
<label>Max Marks</label>
<input type="text" class="form-control" name="max_marks" value="" id="max_marks" placeholder="Max Marks">
</div>
<div class="col-md-2">
<label>Percentage Secured</label>
<input type="text" class="form-control" name="percentage_secured" value="" id="percentage_secured" placeholder="Percentage Secured">
</div>
</div>
<div class="form-group">
	<label>Jharkhand Academic Council Registration No (If Any)  :</label>
	<input type="text" class="form-control" name="jac_reg_no" value="" id="jac_reg_no" placeholder="JAC Registration No">
</div>
<div class="form-group">
	<label>If admitted, will reside </label>
<div style="display: flex;flex-wrap: nowrap;">
<label class="custom-control custom-radio">
<input type="radio" class="custom-control-input" name="parents" value="With Parents or Natural Guardians "/>
<span class="custom-control-label">With Parents or Natural Guardians </span>
</label>
<label class="custom-control custom-radio" style="margin-left: 25px;">
<input type="radio" class="custom-control-input" name="parents" value="With Recognized Local Guardian "/>
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
	<b>I </b><div class="col-md-3"> <input id="pname" type="text" class="form-control" name="" value="" readonly/></div>
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
    												<div id="step-11" class="">
    													<form >
    														<div class="form-group">
    															<label>Amount Payable</label>
																	<span>1000</span>
    															<input type="hidden" class="form-control" value="1000" id="inputtext" readonly>
    														</div>
																<div class="form-group">
																	<input type="submit" class="btn btn-primary" name="Pay" value="Pay"/>
																</div>


    													</form>
    												</div>
    												<div id="step-12" class="">
    													<div class="checkbox">
    														<div class="custom-checkbox custom-control">
    															<input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" id="checkbox2">
    															<label for="checkbox2" class="custom-control-label">I agree terms & Conditions</label>
    														</div>
    													</div>
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
function myFunction() {
	var name=document.getElementById('name').value;
	document.getElementById("pname").value=name;
	document.getElementById("t").href = "https://translate.google.co.in/?sl=en&tl=hi&text="+name+"&op=translate";
}
</script>
@endsection
