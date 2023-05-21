@extends('header')
@section('style')

@endsection

@section('content')
<div class="contents">
					<div class="container-fluid">

                        <div class="row">
                    <div class="col-lg-12">

                        <div class="breadcrumb-main">
                            <h4 class="text-capitalize breadcrumb-title">Select Stream</h4>
                            <div class="breadcrumb-action justify-content-center flex-wrap">
                            <ul class="atbd-breadcrumb nav">
                                        <li class="atbd-breadcrumb__item">

                                            <a href="#">

                                                <span class="la la-home"></span>
                                            </a>
                                            <span class="breadcrumb__seperator">
                                                <span class="la la-slash"></span>
                                            </span>


                                        </li>
                                        <li class="atbd-breadcrumb__item">
                                            <a href="#">Apply</a>
                                            <span class="breadcrumb__seperator">
                                                <span class="la la-slash"></span>
                                            </span>
                                        </li>


                                        <li class="atbd-breadcrumb__item">
                                            <span>Select Class</span>
                                        </li>
                                    </ul>                     
                            </div>
                        </div>

                    </div>
                </div>

                        <div class="row">
                        <div class="col-md-12">
    							<div class="col-md-6">
    								<div class="card card-horizontal card-default card-md mb-4">
    									<div class="card-header">
    										<h3 class="card-title">Select Class</h3>
    									</div>
                                    	<div class="card-body">
                                        <form method="post" action="{{url('/application')}}">
                                        @csrf
                                        <div class="form-group">
    						<label>Session : <span style="color:red;"><?php echo app_config('Session'); ?></span></label>
    	                     	</div>

                                 <div class="form-group">
    						<label>Class <span style="color:red;">*</span></label>
                            <select class="form-control" name="stream" required>
                            <option value="">Please Select</option>
                            <option value="Nursery">Nursery</option>
                            <option value="JR KG">JR KG </option>
                            <option value="KG">KG</option>

                            </select>
                                <input type="hidden" value="<?php echo app_config('Session'); ?> " name="year"  />
    	                     	</div>
                                 <div class="form-group">
                                 <input type="submit" value="Submit" class="btn btn-info"/>
                                 </div>

                                 </form>

                                        </div>

                                        </div>
                                </div>

                             <!--   <div class="col-md-6">
    								<div class="card card-horizontal card-default card-md mb-4">
    									<div class="card-header">
    										<h3 class="card-title">Instructions</h3>
    									</div>
                                    	<div class="card-body">
                                        <div class="form-group">
    						            <ul style="list-style:disc;">
                                            <li>User's can submit multiple form</li>
                                            <li>User's can submit multiple form</li>
                                        </ul>
                            
                              	</div>

                               

                                        </div>

                                        </div>
                                </div>-->
                                </div>
                        </div>


                        </div>
</div>


@endsection