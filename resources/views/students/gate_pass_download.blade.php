<h3></h3>
<link href="http://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!-- Services section -->
	<section id="what-we-do" class="form-inline">
		<div class="container-fluid">
			<h2 style="text-align: center;" class="section-title mb-2 h1"><img src="<?php echo asset(app_config('AppLogo',Auth::user()->school_id)); ?>" /></h2>
			<p style="text-decoration: underline;text-align:center;" class="text-center text-muted h5">{{ Auth::user()->school_name }}</p>	
            <p  style="text-align:center;" class="text-center text-muted h6">{{$title}}</p>		
			<div class="row offset-2 col-8">
				<div style="text-align: center;" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
					<div class="card">
						<div class="card-block block-4">
							<h3 class="card-title">{{$person_name}} - {{$contact_number}}</h3>
							<div class="row">
                            <div class=" row col-md-12">
                            <div class="col-md-6" style="padding-top: 3px;padding-bottom: 3px;">
                            <div class="form-group">
                            <lable>Student :</lable>
                            <lable>{{$stu_name}}</lable>
                            </div>
                            </div>
                            <div class="row col-md-6" style="padding-top: 3px;padding-bottom: 3px;">
                            <div class="form-group">
                            <lable>Class/Section :</lable>
                            <lable>{{$class}} {{$section}}</lable>
                            </div>
                            </div>
                            
                            <div class="col-md-6" style="padding-top: 3px;padding-bottom: 3px;">
                            <lable>ID Proof :</lable>
                            <lable>{{$id_proof}}</lable>
                            </div>
                            <div class="col-md-6" style="padding-top: 3px;padding-bottom: 3px;">
                            <lable>ID Proof No :</lable>
                            <lable>{{$id_proof_no}}</lable>
                            </div>

                            <div class="col-md-6" style="padding-top: 3px;padding-bottom: 3px;">
                            <lable>Issue Date :</lable>
                            <lable>{{$pass_date}}</lable>
                            </div>
                            <div class="col-md-6" style="padding-top: 3px;padding-bottom: 3px;">
                            <lable>Authorize Signature :</lable>
                            <lable></lable>
                            </div>
                            <div class="col-md-12" style="margin-top: 36px;padding-bottom: 3px;">
                                                   <p class="card-text">Note : <span>Only Valid with Authorize Signature.</span></p>
                       				

                       
                          </div>

                            </div>
                            </div>
                		</div>
					</div>
				</div>			
				
			</div>
		</div>	
	</section>
	<!-- /Services section -->