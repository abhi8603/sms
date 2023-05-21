<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>

		<!-- Meta data -->
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta content="St Paul College" name="description">
		<meta content="St Paul College" name="author">
		<meta name="keywords" content="Admin, Admin Template, Dashboard, Responsive, Admin Dashboard, Bootstrap, Bootstrap 4, Clean, Backend, Jquery, Modern, Web App, Admin Panel, Ui, Premium Admin Templates, Flat, Admin Theme, Ui Kit, Bootstrap Admin, Responsive Admin, Application, Template, Admin Themes, Dashboard Template"/>
		<link href="{{ URL::asset('assets/css/style.css')}}" rel="stylesheet" />
		<link href="{{ URL::asset('assets/css/skin-modes.css')}}" rel="stylesheet" />
	<!--	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
-->	<!--Horizontal css -->
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
		@media print {
     /*print css here*/
			font-size:initial;
			font-family:sans-serif;
			button:{
				display:none;
			}
			.no-print, .no-print *
    {
        display: none !important;
		 visibility: hidden;
    }
			
}
		.form-group{
			margin-bottom:1px;
		}
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

	<body class="app" style="font-size: initial;">

		<div class="page" style="font-family:sans-serif">
			<div class="page-main" >


				<div class="app-content" >
					<div class="container">
						<div class="row">
						<form id="applicationForm" name="applicationForm" enctype="multipart/form-data" method="post">
	
							<div class="col-md-12" style="background-image: url('{{ URL::asset('assets/stlogo.png') }}');background-repeat: no-repeat;background-position: center;
    background-size: contain;">

								<div class="card" style="margin-top:30px;">
								
								<!--	<div class="card-body" style="background-image: url('{{ URL::asset('assets/stlogo.png') }}');background-repeat: no-repeat;background-position: center;
    background-size: contain;-webkit-print-color-adjust: exact !important;color-adjust: exact !important;"> -->
										<div class="card-body">
    		<div class="row">
	                 <div class="col-md-12" style="text-align:center">
					 
                   
                  
				<!--	<img src="<?php echo asset(app_config('AppLogo')); ?>" class="header-brand-img desktop-lgo" alt="<?php echo app_config('AppName') ?>">
-->
<h4 style="font-weight:bolder;text-decoration:underline;font-size:xx-large">St. Paul's College, Ranchi</h4>
                      <h4 style="margin-left:6px;text-decoration:underline">
                    Application Form</h4>
                 
				
				</div><div class="dropdown-divider"></div>
									</div>
                    										<div class="card-body pl-0 pr-0">
											<div class="row">
												<div class="col-sm-6">
													<span>Application No.</span><br>
													<strong><?php echo isset($formData[0]->form_id) ? $formData[0]->form_id :0 ; ?></strong>
												</div>
												<div class="col-sm-6 text-right">
													<span>Payment Date :</span><br>
													<strong><?php echo isset($pay_info[0]->created_date) ? $pay_info[0]->created_date :  "NA" ; ?></strong>
												</div>
											</div>
										</div><br>
    													<div class="col-md-12" style="display:flex;">
															
    														<div class="form-group col-md-4" style="margin-left:-24px;">
                                  	<label>1. I desire to join </label>
                                    <div style="display: flex;flex-wrap: nowrap;">
                                							<input type="text" class="form-control" id="course" name="course" value="{{$formData[0]->stream}}" required  readonly style="
    border: transparent;
    font-weight: bolder;
    color: #000;
" />
  						  
                        </div>
                    						</div>
											<div class="col-md-8" style="padding-left:490px;" >
<div style="border:2px solid;width:135px;height:125px;">
	@if(isset($formDoc[0]->photo))
<img src="{{ URL::asset($formDoc[0]->photo)}}" style="width:130px;height:120px;" />
@else
@endif
</div>
<div style="border:2px solid;width:135px;height:55px;margin-top:5px">
@if(isset($formDoc[0]->signature))
	<img src="{{ URL::asset($formDoc[0]->signature)}}" height:20px; style="width:130px;height:50px;"/>
	@else
	@endif
</div>

</div>	
</div>
    														<div class="form-group">
    															<label>2. Name of the applicant :  {{Auth::user()->name}}</label>																
								<br>								<label>(Name in Hindi ) : {{isset($formData[0]->name_hindi) ? $formData[0]->name_hindi : old('name_hindi')}}</label>
                                  
                         
															</div>
                              
                                <div class="form-group">
    								<label>3. Date of Birth ( As recorded on Matriculation Record) Date : <?php echo date('d',strtotime($formData[0]->dob)); ?> 
									Month :<?php echo date('m',strtotime($formData[0]->dob)); ?> 
									Year :<?php echo date('Y',strtotime($formData[0]->dob)); ?> </label>
																	<div class="input-group">
										</div>
    														</div>
																<div class="form-group">
																	<label>4 . Gender  : {{$formData[0]->gender}}</label>
																</div>

																<div class="form-group">
																	<label>5. State whether you belong to one of the following : </label>
																<div style="display: flex;flex-wrap: nowrap;">
																<ul style="margin-left:20px" >
																<li>- General <input style="margin-left:200px" <?php if($formData[0]->cast=="General"){echo "checked";} ?> class="" type="checkbox"/></li>
																
																<li>- Schedule Tribe <input style="margin-left:151px"  <?php if($formData[0]->cast=="Schedule Tribe"){echo "checked";} ?> class="" type="checkbox"/></li>
																	<li>- Schedule Cast <input style="margin-left:154px"  <?php if($formData[0]->cast=="Schedule Cast"){echo "checked";} ?> class="" type="checkbox"/></li>
																	<li>- Other Backward Class <input style="margin-left:99px"  <?php if($formData[0]->cast=="Other Backward Class"){echo "checked";} ?> class="" type="checkbox"/></li>

																</ul>
																 
																<label class="custom-control" style="width: 10%;margin-left:60px;">
																	Sub-Caste : {{isset($formData[0]->subcast) ? $formData[0]->subcast : 'NA'}}

																</label>
																
																</div>
																</div>
																<div class="form-group" style="display: flex;margin-left:-12px;">
																	<div class="col-md-6">
																	<label>6. Religion : {{isset($formData[0]->religion) ? $formData[0]->religion : old('religion')}} </label>																												
																
																</div>
																	<div class="col-md-6">
																	<label>7. Denomination (If Christian) : {{isset($formData[0]->denomination) ? $formData[0]->denomination : old('denomination')}}</label>
																</div>
															</div>
																<div class="form-group">
																	<label>8 .Student Aadhar No. : {{isset($formData[0]->stu_aadhar) ? $formData[0]->stu_aadhar : old('stu_aadhar')}} </label>
																</div>

															<div class="form-group" style="display: flex;margin-left:-12px;">
																<div class="col-md-6">
																<label> 9. Father’s Name : {{isset($formData[0]->f_name) ? $formData[0]->f_name : old('f_name')}}</label>
															</div>
																<div class="col-md-6">
																<label>10. Mother’s Name : {{isset($formData[0]->m_name) ? $formData[0]->m_name : old('m_name')}} </label>
															</div>
														</div>
														<div class="form-group" style="display: flex;margin-left:-12px;">
														<div class="col-md-6">
															<label>11. Guardian Name (If father is dead) : {{isset($formData[0]->g_name) ? $formData[0]->g_name : old('g_name')}}</label>
														</div>
														<div class="col-md-6">
															<label>12. Occupation of (Father / Mother / Guardian) : {{isset($formData[0]->occupation) ? $formData[0]->occupation : old('occupation')}}</label>
														</div>
													</div>
													<div class="form-group">
													<label>13. Present Address of Father / Guardians (Village / At) : {{isset($formData[0]->present_address) ? $formData[0]->present_address : old('present_address')}}</label>
													<div class="col-md-12" style="display: flex;">														
														<div class="col-md-4">
															(PO) : {{isset($formData[0]->po) ? $formData[0]->po : old('po')}}
														</div>
														<div class="col-md-4">
															(PS) : {{isset($formData[0]->ps) ? $formData[0]->ps : old('ps')}}
														</div>
														<div class="col-md-4">
															(Dist.) : {{isset($formData[0]->district) ? $formData[0]->district : old('district')}}
														</div>											

													</div><br>
													<div class="col-md-12" style="display: flex;">														
														<div class="col-md-4">
															(PIN) : {{isset($formData[0]->pin) ? $formData[0]->pin : old('pin')}}
														</div>
														<div class="col-md-8">
															Ph./Mobile No. (Guardian) : {{isset($formData[0]->g_phone) ? $formData[0]->g_phone : old('g_phone')}}
														</div>																					

													</div><br>
													<div class="col-md-12" style="margin-left:-12px">
														<label>14 .Permanent Address  Address of Father / Guardians (Village / At) :  {{isset($formData[0]->permanent_address) ? $formData[0]->permanent_address : old('permanent_address')}}</label>
														<div class="col-md-12" style="display: flex;">														
														<div class="col-md-4">
															(PO) : {{isset($formData[0]->p_po) ? $formData[0]->p_po : old('p_po')}}
														</div>
														<div class="col-md-4">
															(PS) : {{isset($formData[0]->p_ps) ? $formData[0]->p_ps : old('p_ps')}} 
														</div>
														<div class="col-md-4">
															(Dist.) : {{isset($formData[0]->p_district) ? $formData[0]->p_district : old('p_district')}} 
														</div>											

													</div><br>
													<div class="col-md-12" style="display: flex;">														
														<div class="col-md-4">
															(PIN) : {{isset($formData[0]->p_pin) ? $formData[0]->p_pin : old('p_pin')}} 
														</div>
																																			

													</div>
													</div>
												</div>
												<div class="form-group" style="display: flex;margin-left:-12px;">
												<div class="col-md-6">
													<label>15. Phone No (Student) : {{Auth::user()->mobile}}</label>
												</div>
												<div class="col-md-6">
													<label>Email-ID : {{Auth::user()->email}}</label>
												</div>
											</div>
											<div class="form-group" style="display: flex;margin-left:-12px;">
											<div class="col-md-6">
												<label>16. Blood Group : {{isset($formData[0]->blood_group) ? $formData[0]->blood_group : old('blood_group')}}</label>
												</div>
											<div class="col-md-6">
												<label>17. Mark of Identification : {{isset($formData[0]->identification_mark) ? $formData[0]->identification_mark : old('identification_mark')}}</label>
											</div>
										</div>

										<div class="form-group">
										
										<div style="display: flex;flex-wrap: nowrap;">
										<label> 18 .Brother/Sister Studying in this College :  </label>
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
											<label>Name : {{isset($formData[0]->o_name) ? $formData[0]->o_name : old('o_name')}}</label>
										</div>
										<div class="col-md-4">
											<label>Course & Session : {{isset($formData[0]->course_session) ? $formData[0]->course_session : old('course_session')}}</label>
										</div>
										<div class="col-md-3">
											<label>Mobile No : {{isset($formData[0]->o_mobile) ? $formData[0]->o_mobile : old('o_mobile')}}</label>
										</div>
										</div>
<div class="form-group" id="subs">
<label>19. Subject Applied For :</label>

	<table id="example" class="table card-table table-vcenter  table-warning">
		<thead>
			<tr>
			<th class="text-center">Sl.No</th>
				<th class="text-center">Subject</th>
				<th class="arts text-center">{{isset($formData[0]->course) ? $formData[0]->course : ''}}</th>
				</tr>
		</thead>
	
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
</table>



										</div><br><br><br>
<div class="form-group">
	<label>19. I have Passed the Matriculation Examination (or Equivalent) :</label>
</div>
<div class="form-group" style="display:flex;">
	<div class="col-md-4">
	<label>From (School) : {{isset($formData[0]->from_school) ? $formData[0]->from_school : old('from_school')}} </label>
</div>
<div class="col-md-2">
<label>Total Marks Obtained : {{isset($formData[0]->tmo) ? $formData[0]->tmo : old('tmo')}}  </label>
</div>
<div class="col-md-2">
<label>Max Marks : {{isset($formData[0]->max_marks) ? $formData[0]->max_marks : old('max_marks')}}</label>
</div>
<div class="col-md-">
<label>Percentage Secured : {{isset($formData[0]->percentage_secured) ? $formData[0]->percentage_secured : old('percentage_secured')}}</label>

</div>
</div>
<div class="form-group">
	<label>20. Jharkhand Academic Council Registration No (If Any)  : {{isset($formData[0]->jac_reg_no) ? $formData[0]->jac_reg_no : old('jac_reg_no')}}</label>
</div>
<div class="form-group">
	<label>21. If admitted, will reside :</label>
<div style="display: flex;flex-wrap: nowrap;">
<label class="">
<input type="checkbox" class="" name="reside_with" id="reside_with" value="With Parents or Natural Guardians" @if((isset($formData[0]->reside_with)  ? $formData[0]->reside_with : '') == 'With Parents or Natural Guardians') { checked } @endif required/>
<span class="custom-control-label">With Parents or Natural Guardians </span>
</label>
<label class="" style="margin-left: 25px;">
<input type="checkbox" class="" name="reside_with" id="reside_with" value="With Recognized Local Guardian" @if((isset($formData[0]->reside_with)  ? $formData[0]->reside_with : '') == 'With Recognized Local Guardian') { checked } @endif required/>
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
	<label for="">Place :</label>
</div>
</div>


<div class="form-group" style="display:flex;">
<div class="col-md-6" style="text-align:center">
<div style="
    border: 1px solid;
    height: 67px;
"></div>
	Signature of Guardian
</div>
<div class="col-md-6" style="text-align:center">

<div style="
    border: 1px solid;
    height: 67px;
"></div>
	<label for="">Full Signature of applicant</label>
</div>
</div>






									</form>
                    </div>


										<div class="table-responsive push">



											<table class="table table-bordered table-hover">

<tr>
													<td colspan="4" class="font-w600 text-right">Receipt No.</td>
								<td class="text-right"> <?php echo  isset($pay_info[0]->issuerRefNo) ? $pay_info[0]->issuerRefNo : 0 ; ?></td>
												</tr>
												<tr>
													<td colspan="4" class="font-w600 text-right">Payment Status</td>
								<td class="text-right">  <strong><?php echo isset($pay_info[0]->pgRespCode)=="0000" ? "<span style='color: red;
    font-weight: 400;'>Success</span>" : "<span style='color: green;
font-weight: 400;'>Failed</span>"; ?></strong></td>
												</tr>
												<tr>
													<td colspan="4" class="font-w600 text-right">Application Fee</td>
													<td class="text-right">INR <?php echo  isset($pay_info[0]->orgTxnAmount) ? $pay_info[0]->orgTxnAmount : 0 ; ?></td>
												</tr>
												<tr>
													<td colspan="4" class="font-weight-bold text-uppercase text-right">Total</td>
													<td class="font-weight-bold text-right"><strong>INR <?php echo isset($pay_info[0]->orgTxnAmount) ? $pay_info[0]->orgTxnAmount :0 ; ?></strong></td>
												</tr>
                        <tr>
                      													<td colspan="5" class="text-right no-print hidden-print">
                      														<button type="button" class="btn btn-info" onClick="javascript:window.print();"><i class="si si-printer"></i> Print Form</button>
                      													</td>
                      												</tr>
											</table>
										</div> 
									
									</div>
								</div>
							</div>
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
function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}

//	alert();
$("#applicationForm input").prop("pointer-events", "none");
$("#applicationForm input").prop("placeholder", 'NA');
$("#applicationForm textarea").prop("placeholder", 'NA');
$("#applicationForm textarea").prop("disabled", true);
$("#applicationForm input").css("border", 'none');
$('.form-control').css("border", 'none');
	$('applicationForm input').css("pointer-events", 'none');
	$('.form-group').css("pointer-events", 'none');
</script>


	</body>
</html>
