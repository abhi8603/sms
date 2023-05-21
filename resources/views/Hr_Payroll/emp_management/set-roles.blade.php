@extends('header')
@section('style')
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/bootstrap/dist/css/buttons.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/bootstrap/dist/css/rowReorder.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/bootstrap/dist/css/responsive.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/select2/dist/css/select2.min.css') }}">

@endsection
@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#"><i class="fa fa-dashboard"></i>Hr</a></li>
        <li class="active">Set Roles</li>
      </ol>
    </section>
    <section class="content">
        @include('notification.notify')
  <div class="box box-default">
    <!-- Main content -->
    <div class="box-header with-border">
      <h3 class="box-title">Set Roles</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        <button style="display:none;" type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
      </div>
    </div>

        <div class="row">
          <div class="col-md-12">
            <form class="" role="form" action="{{url('hr/employee/update-employee-set-roles')}}" method="post">
          <div class="row">
              <div class="col-lg-12">
              	 <div class="nav-tabs-custom">
              <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1" data-toggle="tab">Options</a></li>
                <li style="display: none;"><a href="#tab_2" data-toggle="tab">Module</a></li>

                <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
              </ul>
               <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                  <div class="box-body">
                    <div class="row">
                      <div class="col-md-12">

                  <div class="panel">
                      <div class="panel-body">
                              <div class="panel-heading">
                                  <h3 class="panel-title"> Settings</h3>
                              </div>
                              <div class="form-group col-md-3">
                                  <div class="coder-checkbox">

                                      <input type="checkbox" @if(permission($emp_roles->id,1)) checked @endif name="perms[]" value="1">
                                      <span class="co-check-ui"></span>
                                      <label>Dashboard</label>
                                  </div>
                              </div>
                              <div class="form-group col-md-3">
                                  <div class="coder-checkbox">
                                      <input type="checkbox"  @if(permission($emp_roles->id,5)) checked @endif name="perms[]" value="5">
                                      <span class="co-check-ui"></span>
                                      <label>Institution Details</label>
                                  </div>
                              </div>
                              <div class="form-group col-md-3">
                                  <div class="coder-checkbox">
                                      <input type="checkbox"  @if(permission($emp_roles->id,69)) checked @endif name="perms[]" value="69">
                                      <span class="co-check-ui"></span>
                                      <label>Academic Session</label>
                                  </div>
                              </div>
                              </div>
                              </div>

                    <div class="panel">
                      <div class="panel-body">
                              <div class="panel-heading">
                                  <h3 class="panel-title"> Announcment</h3>
                              </div>
                              <div class="form-group col-md-3">
                                  <div class="coder-checkbox">

                                      <input type="checkbox" @if(permission($emp_roles->id,70)) checked @endif name="perms[]" value="70">
                                      <span class="co-check-ui"></span>
                                      <label>Teacher</label>
                                  </div>
                              </div>
                              <div class="form-group col-md-3">
                                  <div class="coder-checkbox">
                                      <input type="checkbox"  @if(permission($emp_roles->id,71)) checked @endif name="perms[]" value="71">
                                      <span class="co-check-ui"></span>
                                      <label>Parents</label>
                                  </div>
                              </div>
                            </div>
                          </div>
                    <div class="panel">
                      <div class="panel-body">
                              <div class="panel-heading">
                                  <h3 class="panel-title"> Event</h3>
                              </div>
                              <div class="form-group col-md-3">
                                  <div class="coder-checkbox">

                                      <input type="checkbox" @if(permission($emp_roles->id,150)) checked @endif name="perms[]" value="150">
                                      <span class="co-check-ui"></span>
                                      <label>Add Event</label>
                                  </div>
                              </div>
                              <div class="form-group col-md-3">
                                  <div class="coder-checkbox">
                                      <input type="checkbox"  @if(permission($emp_roles->id,151)) checked @endif name="perms[]" value="151">
                                      <span class="co-check-ui"></span>
                                      <label>Event Report</label>
                                  </div>
                              </div>
                            </div>
                          </div>

                  <div class="panel">
                      <div class="panel-body">
                              <div class="panel-heading">
                                  <h3 class="panel-title"> Front Office</h3>
                              </div>
                              <div class="form-group col-md-3">
                                  <div class="coder-checkbox">

                                      <input type="checkbox" @if(permission($emp_roles->id,72)) checked @endif name="perms[]" value="72">
                                      <span class="co-check-ui"></span>
                                      <label>Office Setup</label>
                                  </div>
                              </div>
                              <div class="form-group col-md-3">
                                  <div class="coder-checkbox">
                                      <input type="checkbox"  @if(permission($emp_roles->id,73)) checked @endif name="perms[]" value="73">
                                      <span class="co-check-ui"></span>
                                      <label>Admission Enquiry</label>
                                  </div>
                              </div>
                              <div class="form-group col-md-3">
                                  <div class="coder-checkbox">
                                      <input type="checkbox"  @if(permission($emp_roles->id,74)) checked @endif name="perms[]" value="74">
                                      <span class="co-check-ui"></span>
                                      <label>Visitor Book</label>
                                  </div>
                              </div>

                               <div class="form-group col-md-3">
                                  <div class="coder-checkbox">
                                      <input type="checkbox"  @if(permission($emp_roles->id,75)) checked @endif name="perms[]" value="75">
                                      <span class="co-check-ui"></span>
                                      <label>Phone Call log</label>
                                  </div>
                              </div>

                               <div class="form-group col-md-3">
                                  <div class="coder-checkbox">
                                      <input type="checkbox"  @if(permission($emp_roles->id,76)) checked @endif name="perms[]" value="76">
                                      <span class="co-check-ui"></span>
                                      <label>Postal Dispatch</label>
                                  </div>
                              </div>

                               <div class="form-group col-md-3">
                                  <div class="coder-checkbox">
                                      <input type="checkbox"  @if(permission($emp_roles->id,77)) checked @endif name="perms[]" value="77">
                                      <span class="co-check-ui"></span>
                                      <label>Postal Receive</label>
                                  </div>
                              </div>

                               <div class="form-group col-md-3">
                                  <div class="coder-checkbox">
                                      <input type="checkbox"  @if(permission($emp_roles->id,78)) checked @endif name="perms[]" value="78">
                                      <span class="co-check-ui"></span>
                                      <label>Complain</label>
                                  </div>
                              </div>



                              </div>
                        </div>


                              <div class="panel">
                                  <div class="panel-body">
                                          <div class="panel-heading">
                                              <h3 class="panel-title"> Acadmics</h3>
                                          </div>

                                          <div class="form-group col-md-3">
                                              <div class="coder-checkbox">
                                                  <input type="checkbox"  @if(permission($emp_roles->id,10)) checked @endif name="perms[]" value="10">
                                                  <span class="co-check-ui"></span>
                                                  <label>Class</label>
                                              </div>
                                          </div>
                                          <div class="form-group col-md-3">
                                              <div class="coder-checkbox">
                                                  <input type="checkbox"  @if(permission($emp_roles->id,11)) checked @endif name="perms[]" value="11">
                                                  <span class="co-check-ui"></span>
                                                  <label>Section</label>
                                              </div>
                                          </div>
                                          <div class="form-group col-md-3">
                                              <div class="coder-checkbox">
                                                  <input type="checkbox"  @if(permission($emp_roles->id,12)) checked @endif name="perms[]" value="12">
                                                  <span class="co-check-ui"></span>
                                                  <label>Class Teacher Allocation</label>
                                              </div>
                                          </div>
                                          <div class="form-group col-md-3">
                                              <div class="coder-checkbox">
                                                  <input type="checkbox"  @if(permission($emp_roles->id,13)) checked @endif name="perms[]" value="13">
                                                  <span class="co-check-ui"></span>
                                                  <label>Subjects</label>
                                              </div>
                                          </div>
                                          <div class="form-group col-md-3">
                                              <div class="coder-checkbox">
                                                  <input type="checkbox"  @if(permission($emp_roles->id,14)) checked @endif name="perms[]" value="14">
                                                  <span class="co-check-ui"></span>
                                                  <label>Assign Class Subject</label>
                                              </div>
                                          </div>
                                          <div class="form-group col-md-3">
                                              <div class="coder-checkbox">
                                                  <input type="checkbox"  @if(permission($emp_roles->id,15)) checked @endif name="perms[]" value="15">
                                                  <span class="co-check-ui"></span>
                                                  <label>Subject Teacher Allocation</label>
                                              </div>
                                          </div>
                                         <div class="form-group col-md-3">
                                              <div class="coder-checkbox">
                                                  <input type="checkbox"  @if(permission($emp_roles->id,79)) checked @endif name="perms[]" value="79">
                                                  <span class="co-check-ui"></span>
                                                  <label>Lession Planning</label>
                                              </div>
                                          </div>
                                        </div>
                                      </div>
                  <div class="panel">
                      <div class="panel-body">
                              <div class="panel-heading">
                                  <h3 class="panel-title">Time Table</h3>
                              </div>
                              <div class="form-group col-md-3">
                                  <div class="coder-checkbox">

                                      <input type="checkbox" @if(permission($emp_roles->id,81)) checked @endif name="perms[]" value="81">
                                      <span class="co-check-ui"></span>
                                      <label>Period Master</label>
                                  </div>
                              </div>
                              <div class="form-group col-md-3">
                                  <div class="coder-checkbox">
                                      <input type="checkbox"  @if(permission($emp_roles->id,82)) checked @endif name="perms[]" value="82">
                                      <span class="co-check-ui"></span>
                                      <label>Set Time Table</label>
                                  </div>
                              </div>
                              <div class="form-group col-md-3">
                                  <div class="coder-checkbox">
                                      <input type="checkbox"  @if(permission($emp_roles->id,83)) checked @endif name="perms[]" value="83">
                                      <span class="co-check-ui"></span>
                                      <label>Active Timee Table</label>
                                  </div>
                              </div>

                               <div class="form-group col-md-3">
                                  <div class="coder-checkbox">
                                      <input type="checkbox"  @if(permission($emp_roles->id,84)) checked @endif name="perms[]" value="84">
                                      <span class="co-check-ui"></span>
                                      <label>View Batch Timetable</label>
                                  </div>
                              </div>

                               <div class="form-group col-md-3">
                                  <div class="coder-checkbox">
                                      <input type="checkbox"  @if(permission($emp_roles->id,85)) checked @endif name="perms[]" value="85">
                                      <span class="co-check-ui"></span>
                                      <label>View Teacher Timetable</label>
                                  </div>
                              </div>
                              </div>
                        </div>
                  <div class="panel">
                      <div class="panel-body">
                              <div class="panel-heading">
                                  <h3 class="panel-title"> Homework & Assignment</h3>
                              </div>
                              <div class="form-group col-md-3">
                                  <div class="coder-checkbox">

                                      <input type="checkbox" @if(permission($emp_roles->id,86)) checked @endif name="perms[]" value="86">
                                      <span class="co-check-ui"></span>
                                      <label>Homework</label>
                                  </div>
                              </div>
                              <div class="form-group col-md-3">
                                  <div class="coder-checkbox">
                                      <input type="checkbox"  @if(permission($emp_roles->id,87)) checked @endif name="perms[]" value="87">
                                      <span class="co-check-ui"></span>
                                      <label>Assignement</label>
                                  </div>
                              </div>
                            </div>
                          </div>


                    <div class="panel">
                                              <div class="panel-body">
                                                      <div class="panel-heading">
                                                          <h3 class="panel-title"> HR/Payroll</h3>
                                                      </div>
                                                      <div class="form-group col-md-3">
                                                          <div class="coder-checkbox">
                                                              <input type="checkbox"  @if(permission($emp_roles->id,88)) checked @endif name="perms[]" value="88">
                                                              <span class="co-check-ui"></span>
                                                              <label>Add Departments</label>
                                                          </div>
                                                      </div>
                                                      <div class="form-group col-md-3">
                                                          <div class="coder-checkbox">
                                                              <input type="checkbox"  @if(permission($emp_roles->id,89)) checked @endif name="perms[]" value="89">
                                                              <span class="co-check-ui"></span>
                                                              <label>Add Designations</label>
                                                          </div>
                                                      </div>
                                                      <div class="form-group col-md-3">
                                                          <div class="coder-checkbox">
                                                              <input type="checkbox"  @if(permission($emp_roles->id,90)) checked @endif name="perms[]" value="90">
                                                              <span class="co-check-ui"></span>
                                                              <label>Add Category</label>
                                                          </div>
                                                      </div>
                                                      <div class="form-group col-md-3">
                                                          <div class="coder-checkbox">
                                                              <input type="checkbox"  @if(permission($emp_roles->id,16)) checked @endif name="perms[]" value="16">
                                                              <span class="co-check-ui"></span>
                                                              <label>Employees</label>
                                                          </div>
                                                      </div>

                                                      <div class="form-group col-md-3">
                                                          <div class="coder-checkbox">
                                                              <input type="checkbox"  @if(permission($emp_roles->id,17)) checked @endif name="perms[]" value="17">
                                                              <span class="co-check-ui"></span>
                                                              <label>Add Employee</label>
                                                          </div>
                                                      </div>
                                                      <div class="form-group col-md-3">
                                                          <div class="coder-checkbox">
                                                              <input type="checkbox"  @if(permission($emp_roles->id,18)) checked @endif name="perms[]" value="18">
                                                              <span class="co-check-ui"></span>
                                                              <label>Employee List</label>
                                                          </div>
                                                      </div>
                                                      <div class="form-group col-md-3">
                                                          <div class="coder-checkbox">
                                                              <input type="checkbox"  @if(permission($emp_roles->id,19)) checked @endif name="perms[]" value="19">
                                                              <span class="co-check-ui"></span>
                                                              <label>Update Employee</label>
                                                          </div>
                                                      </div>


                                                      <div class="form-group col-md-3">
                                                          <div class="coder-checkbox">
                                                              <input type="checkbox"  @if(permission($emp_roles->id,20)) checked @endif name="perms[]" value="20">
                                                              <span class="co-check-ui"></span>
                                                              <label>Delete Employee</label>
                                                          </div>
                                                      </div>


                                                      <div class="form-group col-md-3">
                                                          <div class="coder-checkbox">
                                                              <input type="checkbox"  @if(permission($emp_roles->id,21)) checked @endif name="perms[]" value="21">
                                                              <span class="co-check-ui"></span>
                                                              <label>User Type</label>
                                                          </div>
                                                      </div>
                                                      <div class="form-group col-md-3">
                                                          <div class="coder-checkbox">
                                                              <input type="checkbox"  @if(permission($emp_roles->id,22)) checked @endif name="perms[]" value="22">
                                                              <span class="co-check-ui"></span>
                                                              <label>Add User Type</label>
                                                          </div>
                                                      </div>
                                                      <div class="form-group col-md-3">
                                                          <div class="coder-checkbox">
                                                              <input type="checkbox"  @if(permission($emp_roles->id,59)) checked @endif name="perms[]" value="59">
                                                              <span class="co-check-ui"></span>
                                                              <label>Set User Role</label>
                                                          </div>
                                                      </div>
                                                      <div class="form-group col-md-3">
                                                          <div class="coder-checkbox">
                                                              <input type="checkbox"  @if(permission($emp_roles->id,23)) checked @endif name="perms[]" value="23">
                                                              <span class="co-check-ui"></span>
                                                              <label>Add Employees Bank details</label>
                                                          </div>
                                                      </div>
                                                      <div class="form-group col-md-3">
                                                          <div class="coder-checkbox">
                                                              <input type="checkbox"  @if(permission($emp_roles->id,24)) checked @endif name="perms[]" value="24">
                                                              <span class="co-check-ui"></span>
                                                              <label>Employee Attendance Import</label>
                                                          </div>
                                                      </div>
                                                      <div class="form-group col-md-3">
                                                          <div class="coder-checkbox">
                                                              <input type="checkbox"  @if(permission($emp_roles->id,152)) checked @endif name="perms[]" value="152">
                                                              <span class="co-check-ui"></span>
                                                              <label>Leave Management</label>
                                                          </div>
                                                      </div>
                                                    </div>
                                                  </div>


                                                  <div class="panel">
                                                      <div class="panel-body">
                                                              <div class="panel-heading">
                                                                  <h3 class="panel-title"> Student</h3>
                                                              </div>

                                                              <div class="form-group col-md-3">
                                                                  <div class="coder-checkbox">
                                                                      <input type="checkbox"  @if(permission($emp_roles->id,26)) checked @endif name="perms[]" value="26">
                                                                      <span class="co-check-ui"></span>
                                                                      <label>Student Admission</label>
                                                                  </div>
                                                              </div>
                                                              <div class="form-group col-md-3">
                                                                  <div class="coder-checkbox">
                                                                      <input type="checkbox"  @if(permission($emp_roles->id,27)) checked @endif name="perms[]" value="27">
                                                                      <span class="co-check-ui"></span>
                                                                      <label>Student List</label>
                                                                  </div>
                                                              </div>
                                                              <div class="form-group col-md-3">
                                                                  <div class="coder-checkbox">
                                                                      <input type="checkbox"  @if(permission($emp_roles->id,91)) checked @endif name="perms[]" value="91">
                                                                      <span class="co-check-ui"></span>
                                                                      <label>Assign Roll No & Section</label>
                                                                  </div>
                                                              </div>


                                                              <div class="form-group col-md-3">
                                                                  <div class="coder-checkbox">
                                                                      <input type="checkbox"  @if(permission($emp_roles->id,28)) checked @endif name="perms[]" value="28">
                                                                      <span class="co-check-ui"></span>
                                                                      <label>Student Attendance</label>
                                                                  </div>
                                                              </div>
                                                               <div class="form-group col-md-3">
                                                                  <div class="coder-checkbox">
                                                                      <input type="checkbox"  @if(permission($emp_roles->id,92)) checked @endif name="perms[]" value="92">
                                                                      <span class="co-check-ui"></span>
                                                                      <label>Attendance Report</label>
                                                                  </div>
                                                              </div>
                                                               <div class="form-group col-md-3">
                                                                  <div class="coder-checkbox">
                                                                      <input type="checkbox"  @if(permission($emp_roles->id,29)) checked @endif name="perms[]" value="29">
                                                                      <span class="co-check-ui"></span>
                                                                      <label>Tranport Allocation</label>
                                                                  </div>
                                                              </div>
                                                              <div class="form-group col-md-3">
                                                                  <div class="coder-checkbox">
                                                                      <input type="checkbox"  @if(permission($emp_roles->id,93)) checked @endif name="perms[]" value="93">
                                                                      <span class="co-check-ui"></span>
                                                                      <label>Gaurdian List</label>
                                                                  </div>
                                                              </div>
                                                               <div class="form-group col-md-3">
                                                                  <div class="coder-checkbox">
                                                                      <input type="checkbox"  @if(permission($emp_roles->id,94)) checked @endif name="perms[]" value="94">
                                                                      <span class="co-check-ui"></span>
                                                                      <label>Student Gate Pass</label>
                                                                  </div>
                                                              </div>
                                                              <div class="form-group col-md-3">
                                                                  <div class="coder-checkbox">
                                                                      <input type="checkbox"  @if(permission($emp_roles->id,95)) checked @endif name="perms[]" value="95">
                                                                      <span class="co-check-ui"></span>
                                                                      <label>Student Gate Pass List</label>
                                                                  </div>
                                                              </div>
                                                               <div class="form-group col-md-3">
                                                                  <div class="coder-checkbox">
                                                                      <input type="checkbox"  @if(permission($emp_roles->id,96)) checked @endif name="perms[]" value="96">
                                                                      <span class="co-check-ui"></span>
                                                                      <label>Domicile Certificate</label>
                                                                  </div>
                                                              </div>
                                                               <div class="form-group col-md-3">
                                                                  <div class="coder-checkbox">
                                                                      <input type="checkbox"  @if(permission($emp_roles->id,97)) checked @endif name="perms[]" value="97">
                                                                      <span class="co-check-ui"></span>
                                                                      <label>ICSE/ISC Trial Certificate</label>
                                                                  </div>
                                                              </div>
                                                               <div class="form-group col-md-3">
                                                                  <div class="coder-checkbox">
                                                                      <input type="checkbox"  @if(permission($emp_roles->id,98)) checked @endif name="perms[]" value="98">
                                                                      <span class="co-check-ui"></span>
                                                                      <label>Character Certificate</label>
                                                                  </div>
                                                              </div>
                                                              <div class="form-group col-md-3">
                                                                  <div class="coder-checkbox">
                                                                      <input type="checkbox"  @if(permission($emp_roles->id,99)) checked @endif name="perms[]" value="99">
                                                                      <span class="co-check-ui"></span>
                                                                      <label>Bonafide Certificate</label>
                                                                  </div>
                                                              </div>
                                                               <div class="form-group col-md-3">
                                                                  <div class="coder-checkbox">
                                                                      <input type="checkbox"  @if(permission($emp_roles->id,100)) checked @endif name="perms[]" value="100">
                                                                      <span class="co-check-ui"></span>
                                                                      <label>Leaving Certificate</label>
                                                                  </div>
                                                              </div>
                                                              <div class="form-group col-md-3">
                                                                  <div class="coder-checkbox">
                                                                      <input type="checkbox"  @if(permission($emp_roles->id,61)) checked @endif name="perms[]" value="61">
                                                                      <span class="co-check-ui"></span>
                                                                      <label>View Student</label>
                                                                  </div>
                                                              </div>
                                                              <div class="form-group col-md-3">
                                                                  <div class="coder-checkbox">
                                                                      <input type="checkbox"  @if(permission($emp_roles->id,62)) checked @endif name="perms[]" value="62">
                                                                      <span class="co-check-ui"></span>
                                                                      <label>Update Student</label>
                                                                  </div>
                                                              </div>
                                                              <div class="form-group col-md-3">
                                                                  <div class="coder-checkbox">
                                                                      <input type="checkbox"  @if(permission($emp_roles->id,60)) checked @endif name="perms[]" value="60">
                                                                      <span class="co-check-ui"></span>
                                                                      <label>Delete Student</label>
                                                                  </div>
                                                              </div>
                                                              <div class="form-group col-md-3">
                                                                  <div class="coder-checkbox">
                                                                      <input type="checkbox"  @if(permission($emp_roles->id,30)) checked @endif name="perms[]" value="30">
                                                                      <span class="co-check-ui"></span>
                                                                      <label>Hostel Allocation</label>
                                                                  </div>
                                                              </div>

                                                            </div>
                                                          </div>

                                                          <div class="panel">
                                                              <div class="panel-body">
                                                                      <div class="panel-heading">
                                                                          <h3 class="panel-title"> Finance</h3>
                                                                      </div>
                                                                      <h3 style="margin-left: 16px;    text-decoration: underline;" class="panel-title"> Fee</h3>
                                                                      <br>
                                                                      <div class="form-group col-md-3">
                                                                          <div class="coder-checkbox">
                                                                              <input type="checkbox"  @if(permission($emp_roles->id,32)) checked @endif name="perms[]" value="32">
                                                                              <span class="co-check-ui"></span>
                                                                              <label>Fee Category</label>
                                                                          </div>
                                                                      </div>
                                                                      <div class="form-group col-md-3">
                                                                          <div class="coder-checkbox">
                                                                              <input type="checkbox"  @if(permission($emp_roles->id,33)) checked @endif name="perms[]" value="33">
                                                                              <span class="co-check-ui"></span>
                                                                              <label>Fee Subcategory</label>
                                                                          </div>
                                                                      </div>
                                                                      <div class="form-group col-md-3">
                                                                          <div class="coder-checkbox">
                                                                              <input type="checkbox"  @if(permission($emp_roles->id,34)) checked @endif name="perms[]" value="34">
                                                                              <span class="co-check-ui"></span>
                                                                              <label>Fee SubCategory Fine</label>
                                                                          </div>
                                                                      </div>
                                                                 <div class="form-group col-md-3">
                                                                          <div class="coder-checkbox">
                                                                              <input type="checkbox"  @if(permission($emp_roles->id,101)) checked @endif name="perms[]" value="101">
                                                                              <span class="co-check-ui"></span>
                                                                              <label>Fee Master</label>
                                                                          </div>
                                                                      </div>
                                                                      <div class="form-group col-md-3">
                                                                          <div class="coder-checkbox">
                                                                              <input type="checkbox"  @if(permission($emp_roles->id,102)) checked @endif name="perms[]" value="102">
                                                                              <span class="co-check-ui"></span>
                                                                              <label>Fee Wavier</label>
                                                                          </div>
                                                                      </div>
                                                                      <div class="form-group col-md-3">
                                                                          <div class="coder-checkbox">
                                                                              <input type="checkbox"  @if(permission($emp_roles->id,36)) checked @endif name="perms[]" value="36">
                                                                              <span class="co-check-ui"></span>
                                                                              <label>Fee template</label>
                                                                          </div>
                                                                      </div>
                                                                      <div class="form-group col-md-3">
                                                                          <div class="coder-checkbox">
                                                                              <input type="checkbox"  @if(permission($emp_roles->id,37)) checked @endif name="perms[]" value="37">
                                                                              <span class="co-check-ui"></span>
                                                                              <label>Fee Allocation</label>
                                                                          </div>
                                                                      </div>
                                                                      <div class="form-group col-md-3">
                                                                          <div class="coder-checkbox">
                                                                              <input type="checkbox"  @if(permission($emp_roles->id,103)) checked @endif name="perms[]" value="103">
                                                                              <span class="co-check-ui"></span>
                                                                              <label>Fee Collection</label>
                                                                          </div>
                                                                      </div>
                                                                       <div class="form-group col-md-3">
                                                                          <div class="coder-checkbox">
                                                                              <input type="checkbox"  @if(permission($emp_roles->id,104)) checked @endif name="perms[]" value="104">
                                                                              <span class="co-check-ui"></span>
                                                                              <label>Fee Collection List</label>
                                                                          </div>
                                                                      </div>
                                                                      <div class="form-group col-md-3">
                                                                          <div class="coder-checkbox">
                                                                              <input type="checkbox"  @if(permission($emp_roles->id,105)) checked @endif name="perms[]" value="105">
                                                                              <span class="co-check-ui"></span>
                                                                              <label>Report</label>
                                                                          </div>
                                                                      </div>
                                                                      <div class="form-group col-md-6">
                                                                          <div class="coder-checkbox">
                                                                              <input type="checkbox"  @if(permission($emp_roles->id,106)) checked @endif name="perms[]" value="106">
                                                                              <span class="co-check-ui"></span>
                                                                              <label>Fee Due Report</label>
                                                                          </div>
                                                                      </div>
                                                                      <br/>
            <h3 style="margin-left: 16px;    text-decoration: underline;" class="panel-title"> Accounting</h3>
                                                                     <br>
                                                                     <div class="form-group col-md-3">
                                                                          <div class="coder-checkbox">
                                                                              <input type="checkbox"  @if(permission($emp_roles->id,107)) checked @endif name="perms[]" value="107">
                                                                              <span class="co-check-ui"></span>
                                                                              <label>Account Group</label>
                                                                          </div>
                                                                      </div>

                                                                      <div class="form-group col-md-3">
                                                                          <div class="coder-checkbox">
                                                                              <input type="checkbox"  @if(permission($emp_roles->id,109)) checked @endif name="perms[]" value="109">
                                                                              <span class="co-check-ui"></span>
                                                                              <label>Voucher Head</label>
                                                                          </div>
                                                                      </div>
                                                                      <div class="form-group col-md-3">
                                                                          <div class="coder-checkbox">
                                                                              <input type="checkbox"  @if(permission($emp_roles->id,110)) checked @endif name="perms[]" value="110">
                                                                              <span class="co-check-ui"></span>
                                                                              <label>Create Voucher</label>
                                                                          </div>
                                                                      </div>
                                                                      <div class="form-group col-md-3">
                                                                          <div class="coder-checkbox">
                                                                              <input type="checkbox"  @if(permission($emp_roles->id,111)) checked @endif name="perms[]" value="111">
                                                                              <span class="co-check-ui"></span>
                                                                              <label>Voucher List</label>
                                                                          </div>
                                                                      </div>
                                                                       <div class="form-group col-md-3">
                                                                          <div class="coder-checkbox">
                                                                              <input type="checkbox"  @if(permission($emp_roles->id,112)) checked @endif name="perms[]" value="112">
                                                                              <span class="co-check-ui"></span>
                                                                              <label>Day Book</label>
                                                                          </div>
                                                                      </div>
                                                                      <div class="form-group col-md-3">
                                                                          <div class="coder-checkbox">
                                                                              <input type="checkbox"  @if(permission($emp_roles->id,113)) checked @endif name="perms[]" value="113">
                                                                              <span class="co-check-ui"></span>
                                                                              <label>Cash Book</label>
                                                                          </div>
                                                                      </div>
                                                                      <div class="form-group col-md-3">
                                                                          <div class="coder-checkbox">
                                                                              <input type="checkbox"  @if(permission($emp_roles->id,113)) checked @endif name="perms[]" value="113">
                                                                              <span class="co-check-ui"></span>
                                                                              <label>Bank Book</label>
                                                                          </div>
                                                                      </div>
                                                                      <div class="form-group col-md-3">
                                                                          <div class="coder-checkbox">
                                                                              <input type="checkbox"  @if(permission($emp_roles->id,113)) checked @endif name="perms[]" value="113">
                                                                              <span class="co-check-ui"></span>
                                                                              <label>Ledger Account</label>
                                                                          </div>
                                                                      </div>
                                                                      <div class="form-group col-md-3">
                                                                          <div class="coder-checkbox">
                                                                              <input type="checkbox"  @if(permission($emp_roles->id,114)) checked @endif name="perms[]" value="114">
                                                                              <span class="co-check-ui"></span>
                                                                              <label>Trial Balance</label>
                                                                          </div>
                                                                      </div>


                                                                    </div>
                  <div class="panel">
                      <div class="panel-body">
                              <div class="panel-heading">
                                  <h3 class="panel-title">Examination</h3>
                              </div>
                              <div class="form-group col-md-3">
                                  <div class="coder-checkbox">

                                      <input type="checkbox" @if(permission($emp_roles->id,115)) checked @endif name="perms[]" value="115">
                                      <span class="co-check-ui"></span>
                                      <label>Exam List</label>
                                  </div>
                              </div>
                              <div class="form-group col-md-3">
                                  <div class="coder-checkbox">
                                      <input type="checkbox"  @if(permission($emp_roles->id,116)) checked @endif name="perms[]" value="116">
                                      <span class="co-check-ui"></span>
                                      <label>Exam Schedule</label>
                                  </div>
                              </div>
                              <div class="form-group col-md-3">
                                  <div class="coder-checkbox">
                                      <input type="checkbox"  @if(permission($emp_roles->id,117)) checked @endif name="perms[]" value="117">
                                      <span class="co-check-ui"></span>
                                      <label>Mark Register</label>
                                  </div>
                              </div>

                               <div class="form-group col-md-3">
                                  <div class="coder-checkbox">
                                      <input type="checkbox"  @if(permission($emp_roles->id,118)) checked @endif name="perms[]" value="118">
                                      <span class="co-check-ui"></span>
                                      <label>Personality Traits</label>
                                  </div>
                              </div>

                               <div class="form-group col-md-3">
                                  <div class="coder-checkbox">
                                      <input type="checkbox"  @if(permission($emp_roles->id,119)) checked @endif name="perms[]" value="119">
                                      <span class="co-check-ui"></span>
                                      <label>Monthly Mark Register</label>
                                  </div>
                              </div>

                               <div class="form-group col-md-3">
                                  <div class="coder-checkbox">
                                      <input type="checkbox"  @if(permission($emp_roles->id,120)) checked @endif name="perms[]" value="120">
                                      <span class="co-check-ui"></span>
                                      <label>Marks Grade</label>
                                  </div>
                              </div>

                               <div class="form-group col-md-3">
                                  <div class="coder-checkbox">
                                      <input type="checkbox"  @if(permission($emp_roles->id,121)) checked @endif name="perms[]" value="121">
                                      <span class="co-check-ui"></span>
                                      <label>Search By Student</label>
                                  </div>
                              </div>
                            <div class="form-group col-md-3">
                                  <div class="coder-checkbox">
                                      <input type="checkbox"  @if(permission($emp_roles->id,122)) checked @endif name="perms[]" value="122">
                                      <span class="co-check-ui"></span>
                                      <label>Final Result</label>
                                  </div>
                              </div>



                              </div>
                        </div>

                  <div class="panel">
                      <div class="panel-body">
                              <div class="panel-heading">
                                  <h3 class="panel-title">Library</h3>
                              </div>
                              <div class="form-group col-md-3">
                                  <div class="coder-checkbox">

                                      <input type="checkbox" @if(permission($emp_roles->id,123)) checked @endif name="perms[]" value="123">
                                      <span class="co-check-ui"></span>
                                      <label>Add Category</label>
                                  </div>
                              </div>
                              <div class="form-group col-md-3">
                                  <div class="coder-checkbox">
                                      <input type="checkbox"  @if(permission($emp_roles->id,124)) checked @endif name="perms[]" value="124">
                                      <span class="co-check-ui"></span>
                                      <label>Add Book</label>
                                  </div>
                              </div>
                              <div class="form-group col-md-3">
                                  <div class="coder-checkbox">
                                      <input type="checkbox"  @if(permission($emp_roles->id,125)) checked @endif name="perms[]" value="125">
                                      <span class="co-check-ui"></span>
                                      <label>Issue book</label>
                                  </div>
                              </div>

                               <div class="form-group col-md-3">
                                  <div class="coder-checkbox">
                                      <input type="checkbox"  @if(permission($emp_roles->id,126)) checked @endif name="perms[]" value="126">
                                      <span class="co-check-ui"></span>
                                      <label>Request Details</label>
                                  </div>
                              </div>

                               <div class="form-group col-md-3">
                                  <div class="coder-checkbox">
                                      <input type="checkbox"  @if(permission($emp_roles->id,127)) checked @endif name="perms[]" value="127">
                                      <span class="co-check-ui"></span>
                                      <label>Book Return</label>
                                  </div>
                              </div>

                               <div class="form-group col-md-3">
                                  <div class="coder-checkbox">
                                      <input type="checkbox"  @if(permission($emp_roles->id,128)) checked @endif name="perms[]" value="128">
                                      <span class="co-check-ui"></span>
                                      <label>Report</label>
                                  </div>
                              </div>
                              </div>
                        </div>




                                                                  </div>
                                                                  <div class="panel">
                                                                      <div class="panel-body">
                                                                              <div class="panel-heading">
                                                                                  <h3 class="panel-title"> Transport</h3>
                                                                              </div>


                                                                              <div class="form-group col-md-3">
                                                                                  <div class="coder-checkbox">
                                                                                      <input type="checkbox"  @if(permission($emp_roles->id,40)) checked @endif name="perms[]" value="40">
                                                                                      <span class="co-check-ui"></span>
                                                                                      <label>Add Vechicle</label>
                                                                                  </div>
                                                                              </div>
                                                                              <div class="form-group col-md-3">
                                                                                  <div class="coder-checkbox">
                                                                                      <input type="checkbox"  @if(permission($emp_roles->id,42)) checked @endif name="perms[]" value="42">
                                                                                      <span class="co-check-ui"></span>
                                                                                      <label>Update Vechicle</label>
                                                                                  </div>
                                                                              </div>
                                                                              <div class="form-group col-md-3">
                                                                                  <div class="coder-checkbox">
                                                                                      <input type="checkbox"  @if(permission($emp_roles->id,43)) checked @endif name="perms[]" value="43">
                                                                                      <span class="co-check-ui"></span>
                                                                                      <label>Delete Vechicle</label>
                                                                                  </div>
                                                                              </div>


                                                                              <div class="form-group col-md-3">
                                                                                  <div class="coder-checkbox">
                                                                                      <input type="checkbox"  @if(permission($emp_roles->id,44)) checked @endif name="perms[]" value="44">
                                                                                      <span class="co-check-ui"></span>
                                                                                      <label>Add Driver</label>
                                                                                  </div>
                                                                              </div>
                                                                              <div class="form-group col-md-3">
                                                                                  <div class="coder-checkbox">
                                                                                      <input type="checkbox"  @if(permission($emp_roles->id,46)) checked @endif name="perms[]" value="46">
                                                                                      <span class="co-check-ui"></span>
                                                                                      <label>Delete Driver</label>
                                                                                  </div>
                                                                              </div>
                                                                              <div class="form-group col-md-3">
                                                                                  <div class="coder-checkbox">
                                                                                      <input type="checkbox"  @if(permission($emp_roles->id,47)) checked @endif name="perms[]" value="47">
                                                                                      <span class="co-check-ui"></span>
                                                                                      <label>View Driver</label>
                                                                                  </div>
                                                                              </div>
                                                                              <div class="form-group col-md-3">
                                                                                  <div class="coder-checkbox">
                                                                                      <input type="checkbox"  @if(permission($emp_roles->id,48)) checked @endif name="perms[]" value="48">
                                                                                      <span class="co-check-ui"></span>
                                                                                      <label>Update Driver</label>
                                                                                  </div>
                                                                              </div>

                                                                              <div class="form-group col-md-3">
                                                                                  <div class="coder-checkbox">
                                                                                      <input type="checkbox"  @if(permission($emp_roles->id,49)) checked @endif name="perms[]" value="49">
                                                                                      <span class="co-check-ui"></span>
                                                                                      <label>Add Route</label>
                                                                                  </div>
                                                                              </div>
                                                                              <div class="form-group col-md-3">
                                                                                  <div class="coder-checkbox">
                                                                                      <input type="checkbox"  @if(permission($emp_roles->id,51)) checked @endif name="perms[]" value="51">
                                                                                      <span class="co-check-ui"></span>
                                                                                      <label>View Route</label>
                                                                                  </div>
                                                                              </div>
                                                                              <div class="form-group col-md-3">
                                                                                  <div class="coder-checkbox">
                                                                                      <input type="checkbox"  @if(permission($emp_roles->id,52)) checked @endif name="perms[]" value="52">
                                                                                      <span class="co-check-ui"></span>
                                                                                      <label>Update Route</label>
                                                                                  </div>
                                                                              </div>
                                                                              <div class="form-group col-md-3">
                                                                                  <div class="coder-checkbox">
                                                                                      <input type="checkbox"  @if(permission($emp_roles->id,53)) checked @endif name="perms[]" value="53">
                                                                                      <span class="co-check-ui"></span>
                                                                                      <label>Delete Route</label>
                                                                                  </div>
                                                                              </div>
                                                                              <div class="form-group col-md-3">
                                                                                  <div class="coder-checkbox">
                                                                                      <input type="checkbox"  @if(permission($emp_roles->id,54)) checked @endif name="perms[]" value="54">
                                                                                      <span class="co-check-ui"></span>
                                                                                      <label>Add Destination</label>
                                                                                  </div>
                                                                              </div>

                                                                              <div class="form-group col-md-3">
                                                                                  <div class="coder-checkbox">
                                                                                      <input type="checkbox"  @if(permission($emp_roles->id,56)) checked @endif name="perms[]" value="56">
                                                                                      <span class="co-check-ui"></span>
                                                                                      <label>View Destination</label>
                                                                                  </div>
                                                                              </div>
                                                                              <div class="form-group col-md-3">
                                                                                  <div class="coder-checkbox">
                                                                                      <input type="checkbox"  @if(permission($emp_roles->id,57)) checked @endif name="perms[]" value="57">
                                                                                      <span class="co-check-ui"></span>
                                                                                      <label>Update Destination</label>
                                                                                  </div>
                                                                              </div>
                                                                              <div class="form-group col-md-3">
                                                                                  <div class="coder-checkbox">
                                                                                      <input type="checkbox"  @if(permission($emp_roles->id,58)) checked @endif name="perms[]" value="58">
                                                                                      <span class="co-check-ui"></span>
                                                                                      <label>Delete Destination</label>
                                                                                  </div>
                                                                              </div>

                                                           <div class="form-group col-md-3">
                                                                                  <div class="coder-checkbox">
                                                                                      <input type="checkbox"  @if(permission($emp_roles->id,129)) checked @endif name="perms[]" value="129">
                                                                                      <span class="co-check-ui"></span>
                                                                                      <label>Tranport Allocation List</label>
                                                                                  </div>
                                                                              </div>






                                                                            </div>
                                                                          </div>

                          <div class="panel">
                          <div class="panel-body">
                          <div class="panel-heading">
                          <h3 class="panel-title"> Hostel</h3>
                          </div>
                          <div class="form-group col-md-3">
                          <div class="coder-checkbox">
                          <input type="checkbox"  @if(permission($emp_roles->id,130)) checked @endif name="perms[]" value="130">
                          <span class="co-check-ui"></span>
                          <label>Hostel details</label>
                          </div>
                        </div>
                        <div class="form-group col-md-3">
                        <div class="coder-checkbox">
                        <input type="checkbox"  @if(permission($emp_roles->id,131)) checked @endif name="perms[]" value="131">
                        <span class="co-check-ui"></span>
                        <label>Hostel Room</label>
                        </div>
                        </div>
                        <div class="form-group col-md-3">
                        <div class="coder-checkbox">
                        <input type="checkbox"  @if(permission($emp_roles->id,132)) checked @endif name="perms[]" value="132">
                        <span class="co-check-ui"></span>
                        <label>Hostel Allocation</label>
                        </div>
                        </div>
                        <div class="form-group col-md-3">
                        <div class="coder-checkbox">
                        <input type="checkbox"  @if(permission($emp_roles->id,134)) checked @endif name="perms[]" value="134">
                        <span class="co-check-ui"></span>
                        <label>Request Details</label>
                        </div>
                        </div>

                         <div class="form-group col-md-3">
                        <div class="coder-checkbox">
                        <input type="checkbox"  @if(permission($emp_roles->id,135)) checked @endif name="perms[]" value="135">
                        <span class="co-check-ui"></span>
                        <label>Hostel Transfer/Vacate</label>
                        </div>
                        </div>



                        <div class="form-group col-md-3">
                        <div class="coder-checkbox">
                        <input type="checkbox"  @if(permission($emp_roles->id,136)) checked @endif name="perms[]" value="136">
                        <span class="co-check-ui"></span>
                        <label>Hostel Register</label>
                        </div>
                        </div>
                        <div class="form-group col-md-3">
                        <div class="coder-checkbox">
                        <input type="checkbox"  @if(permission($emp_roles->id,137)) checked @endif name="perms[]" value="137">
                        <span class="co-check-ui"></span>
                        <label>Hostel Visitors </label>
                        </div>
                        </div>
                        <div class="form-group col-md-3">
                        <div class="coder-checkbox">
                        <input type="checkbox"  @if(permission($emp_roles->id,140)) checked @endif name="perms[]" value="137">
                        <span class="co-check-ui"></span>
                        <label>Hostel Avaliability Report</label>
                        </div>
                        </div>

                        <div class="form-group col-md-3">
                        <div class="coder-checkbox">
                        <input type="checkbox"  @if(permission($emp_roles->id,141)) checked @endif name="perms[]" value="141">
                        <span class="co-check-ui"></span>
                        <label> Room Request Report</label>
                        </div>
                        </div>

                        <div class="form-group col-md-3">
                        <div class="coder-checkbox">
                        <input type="checkbox"  @if(permission($emp_roles->id,142)) checked @endif name="perms[]" value="142">
                        <span class="co-check-ui"></span>
                        <label>Room Occupancy Report</label>
                        </div>
                        </div>
                        </div>
                        </div>

   <div class="panel">
                      <div class="panel-body">
                              <div class="panel-heading">
                                  <h3 class="panel-title">Stock</h3>
                              </div>
                              <div class="form-group col-md-3">
                                  <div class="coder-checkbox">

                                      <input type="checkbox" @if(permission($emp_roles->id,144)) checked @endif name="perms[]" value="144">
                                      <span class="co-check-ui"></span>
                                      <label>Issue Item</label>
                                  </div>
                              </div>
                              <div class="form-group col-md-3">
                                  <div class="coder-checkbox">
                                      <input type="checkbox"  @if(permission($emp_roles->id,145)) checked @endif name="perms[]" value="145">
                                      <span class="co-check-ui"></span>
                                      <label>Add Item Stock</label>
                                  </div>
                              </div>
                              <div class="form-group col-md-3">
                                  <div class="coder-checkbox">
                                      <input type="checkbox"  @if(permission($emp_roles->id,146)) checked @endif name="perms[]" value="146">
                                      <span class="co-check-ui"></span>
                                      <label> Add  Item </label>
                                  </div>
                              </div>

                               <div class="form-group col-md-3">
                                  <div class="coder-checkbox">
                                      <input type="checkbox"  @if(permission($emp_roles->id,147)) checked @endif name="perms[]" value="147">
                                      <span class="co-check-ui"></span>
                                      <label>Item Category</label>
                                  </div>
                              </div>

                               <div class="form-group col-md-3">
                                  <div class="coder-checkbox">
                                      <input type="checkbox"  @if(permission($emp_roles->id,148)) checked @endif name="perms[]" value="148">
                                      <span class="co-check-ui"></span>
                                      <label>Item Store</label>
                                  </div>
                              </div>

                            <div class="form-group col-md-3">
                                  <div class="coder-checkbox">
                                      <input type="checkbox"  @if(permission($emp_roles->id,149)) checked @endif name="perms[]" value="149">
                                      <span class="co-check-ui"></span>
                                      <label>Item Supplier</label>
                                  </div>
                              </div>
                              <div class="form-group col-md-3">
                                  <div class="coder-checkbox">
                                      <input type="checkbox"  @if(permission($emp_roles->id,148)) checked @endif name="perms[]" value="148">
                                      <span class="co-check-ui"></span>
                                      <label>Item Store</label>
                                  </div>
                              </div>

                              </div>
                        </div>


                        <div class="panel">
                      <div class="panel-body">
                              <div class="panel-heading">
                                  <h3 class="panel-title">Complaint/Feedback</h3>
                              </div>
                              <div class="form-group col-md-3">
                                  <div class="coder-checkbox">

                                      <input type="checkbox" @if(permission($emp_roles->id,1024)) checked @endif name="perms[]" value="1024">
                                      <span class="co-check-ui"></span>
                                      <label>Complaint/Feedback</label>
                                  </div>
                              </div>


                              </div>
                        </div>




                    </div>

</div>
</div>
</div>

 <div class="tab-pane" id="tab_2">
 <div class="box-body">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="box box-info">
                           <div class="box-body">
                              <div class="col-md-12">

                              <div class="panel">
                      <div class="panel-body">
                              <div class="panel-heading">
                                  <h3 class="panel-title"> Modules</h3>
                              </div>
                              <div class="form-group col-md-3">
                                  <div class="coder-checkbox">

                                      <input type="checkbox" @if(permission($emp_roles->id,1000)) checked @endif name="perms[]" value="1000">
                                      <span class="co-check-ui"></span>
                                      <label>Dashboard Admin</label>
                                  </div>
                              </div>
                              <div class="form-group col-md-3">
                                  <div class="coder-checkbox">
                                      <input type="checkbox"  @if(permission($emp_roles->id,1001)) checked @endif name="perms[]" value="1001">
                                      <span class="co-check-ui"></span>
                                      <label>Dashboard Other</label>
                                  </div>
                              </div>
                              <div class="form-group col-md-3">
                                  <div class="coder-checkbox">
                                      <input type="checkbox"  @if(permission($emp_roles->id,1002)) checked @endif name="perms[]" value="1002">
                                      <span class="co-check-ui"></span>
                                      <label>Settings</label>
                                  </div>
                              </div>
                              <div class="form-group col-md-3">
                                  <div class="coder-checkbox">
                                      <input type="checkbox"  @if(permission($emp_roles->id,1003)) checked @endif name="perms[]" value="1003">
                                      <span class="co-check-ui"></span>
                                      <label>Annoncement</label>
                                  </div>
                              </div>
                              <div class="form-group col-md-3">
                                  <div class="coder-checkbox">
                                      <input type="checkbox"  @if(permission($emp_roles->id,1004)) checked @endif name="perms[]" value="1004">
                                      <span class="co-check-ui"></span>
                                      <label>Front Office</label>
                                  </div>
                              </div>
                              <div class="form-group col-md-3">
                                  <div class="coder-checkbox">
                                      <input type="checkbox"  @if(permission($emp_roles->id,1005)) checked @endif name="perms[]" value="1005">
                                      <span class="co-check-ui"></span>
                                      <label>Academic</label>
                                  </div>
                              </div>
                              <div class="form-group col-md-3">
                                  <div class="coder-checkbox">
                                      <input type="checkbox"  @if(permission($emp_roles->id,1006)) checked @endif name="perms[]" value="1006">
                                      <span class="co-check-ui"></span>
                                      <label>Acadmic -> class & section</label>
                                  </div>
                              </div>
                              <div class="form-group col-md-3">
                                  <div class="coder-checkbox">
                                      <input type="checkbox"  @if(permission($emp_roles->id,1007)) checked @endif name="perms[]" value="1007">
                                      <span class="co-check-ui"></span>
                                      <label>Acadmic -> Subject</label>
                                  </div>
                              </div>
                              <div class="form-group col-md-4">
                                  <div class="coder-checkbox">
                                      <input type="checkbox"  @if(permission($emp_roles->id,1008)) checked @endif name="perms[]" value="1008">
                                      <span class="co-check-ui"></span>
                                      <label>Acadmic -> Lession Planning</label>
                                  </div>
                              </div>
                              <div class="form-group col-md-4">
                                  <div class="coder-checkbox">
                                      <input type="checkbox"  @if(permission($emp_roles->id,1009)) checked @endif name="perms[]" value="1009">
                                      <span class="co-check-ui"></span>
                                      <label>Acadmic -> Lession Planning->Lession Planning</label>
                                  </div>
                              </div>
                              <div class="form-group col-md-4">
                                  <div class="coder-checkbox">
                                      <input type="checkbox"  @if(permission($emp_roles->id,1010)) checked @endif name="perms[]" value="1010">
                                      <span class="co-check-ui"></span>
                                      <label>Acadmic -> Lession Planning->View Lession Planning</label>
                                  </div>
                              </div>
                              <div class="form-group col-md-3">
                                  <div class="coder-checkbox">
                                      <input type="checkbox"  @if(permission($emp_roles->id,1011)) checked @endif name="perms[]" value="1011">
                                      <span class="co-check-ui"></span>
                                      <label>Time-Table</label>
                                  </div>
                              </div>
                              <div class="form-group col-md-3">
                                  <div class="coder-checkbox">
                                      <input type="checkbox"  @if(permission($emp_roles->id,1012)) checked @endif name="perms[]" value="1012">
                                      <span class="co-check-ui"></span>
                                      <label>Home Work & Assignments</label>
                                  </div>
                              </div>
                              <div class="form-group col-md-3">
                                  <div class="coder-checkbox">
                                      <input type="checkbox"  @if(permission($emp_roles->id,1013)) checked @endif name="perms[]" value="1013">
                                      <span class="co-check-ui"></span>
                                      <label>HR/Payroll</label>
                                  </div>
                              </div>
                              <div class="form-group col-md-4">
                                  <div class="coder-checkbox">
                                      <input type="checkbox"  @if(permission($emp_roles->id,1014)) checked @endif name="perms[]" value="1014">
                                      <span class="co-check-ui"></span>
                                      <label>HR/Payroll -> Employee management</label>
                                  </div>
                              </div>
                              <div class="form-group col-md-3">
                                  <div class="coder-checkbox">
                                      <input type="checkbox"  @if(permission($emp_roles->id,1015)) checked @endif name="perms[]" value="1015">
                                      <span class="co-check-ui"></span>
                                      <label>Students</label>
                                  </div>
                              </div>
                              <div class="form-group col-md-3">
                                  <div class="coder-checkbox">
                                      <input type="checkbox"  @if(permission($emp_roles->id,1016)) checked @endif name="perms[]" value="1016">
                                      <span class="co-check-ui"></span>
                                      <label>Finance</label>
                                  </div>
                              </div>
                              <div class="form-group col-md-3">
                                  <div class="coder-checkbox">
                                      <input type="checkbox"  @if(permission($emp_roles->id,1017)) checked @endif name="perms[]" value="1017">
                                      <span class="co-check-ui"></span>
                                      <label>Finance->Fee</label>
                                  </div>
                              </div>
                              <div class="form-group col-md-3">
                                  <div class="coder-checkbox">
                                      <input type="checkbox"  @if(permission($emp_roles->id,1018)) checked @endif name="perms[]" value="1018">
                                      <span class="co-check-ui"></span>
                                      <label>Finance->Accounting</label>
                                  </div>
                              </div>
                              <div class="form-group col-md-3">
                                  <div class="coder-checkbox">
                                      <input type="checkbox"  @if(permission($emp_roles->id,1019)) checked @endif name="perms[]" value="1019">
                                      <span class="co-check-ui"></span>
                                      <label>Examination</label>
                                  </div>
                              </div>
                              <div class="form-group col-md-3">
                                  <div class="coder-checkbox">
                                      <input type="checkbox"  @if(permission($emp_roles->id,1020)) checked @endif name="perms[]" value="1020">
                                      <span class="co-check-ui"></span>
                                      <label>Library</label>
                                  </div>
                              </div>
                              <div class="form-group col-md-3">
                                  <div class="coder-checkbox">
                                      <input type="checkbox"  @if(permission($emp_roles->id,1021)) checked @endif name="perms[]" value="1021">
                                      <span class="co-check-ui"></span>
                                      <label>Transport</label>
                                  </div>
                              </div>
                              <div class="form-group col-md-3">
                                  <div class="coder-checkbox">
                                      <input type="checkbox"  @if(permission($emp_roles->id,1022)) checked @endif name="perms[]" value="1022">
                                      <span class="co-check-ui"></span>
                                      <label>Hostel</label>
                                  </div>
                              </div>
                              <div class="form-group col-md-3">
                                  <div class="coder-checkbox">
                                      <input type="checkbox"  @if(permission($emp_roles->id,1023)) checked @endif name="perms[]" value="1023">
                                      <span class="co-check-ui"></span>
                                      <label>Stock</label>
                                  </div>
                              </div>
                              <div class="form-group col-md-3">
                                  <div class="coder-checkbox">
                                      <input type="checkbox"  @if(permission($emp_roles->id,1024)) checked @endif name="perms[]" value="1024">
                                      <span class="co-check-ui"></span>
                                      <label>Feedback</label>
                                  </div>
                              </div>



                              </div>
                              </div>

                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
</div>


</div>


</div>
</div>
                  </div>
                  <input type="hidden" value="{{$emp_roles->id}}" name="role_id">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                     <div class="box-footer col-md-6" style="border-top:none;">
                  <button type="submit" class="btn btn-success btn-sm pull-right"><i class="fa fa-save"></i> Update </button>
  				</div>
  				</form>
              </div>
          </div>
        </div>
 </div>
    </section>


@endsection
{{--External Style Section--}}
@section('script')
<script src="{{ URL::asset('assets/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/chart.js/Chart.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/datatables.net-bs/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/datatables.net-bs/js/jszip.min.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/datatables.net-bs/js/pdfmake.min.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/datatables.net-bs/js/vfs_fonts.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/datatables.net-bs/js/buttons.html5.min.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/datatables.net-bs/js/buttons.print.min.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/datatables.net-bs/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/datatables.net-bs/js/dataTables.rowReorder.min.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/jquery/dist/bootbox.min.js') }}"></script>
<script>
        $(document).ready(function () {
            /*For Delete Application Info*/
            $(".tFileDelete").click(function (e) {
                e.preventDefault();
                var id = this.id;
                bootbox.confirm("Are you sure?", function (result) {
                    if (result) {
                        var _url = $("#_url").val();
                        window.location.href = _url + "/Academic-Details/delete/" + id;
                    }
                });
            });

        $("#viewedit").click(function () {
            $("#editview").show();
            $(this).hide();
            $("#edit").show();
            $("#view").hide();
        });
        $("#editview").click(function () {
            $("#viewedit").show();
            $(this).hide();
            $("#view").show();
            $("#edit").hide();
        });

        });
    </script>
<script>
$(document).ready(function() {
   $.extend($.fn.dataTable.defaults, {
 dom: 'Bfrtip'
});
   $('#example').DataTable( {

       buttons: [
           'copy', 'csv', 'excel', 'pdf', 'print'
       ],
         rowReorder: {
           selector: 'td:nth-child(2)'
       },
       responsive: true
   } );
   } );

</script>
@endsection
<!-- ./wrapper -->
