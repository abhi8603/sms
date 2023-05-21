<aside class="main-sidebar">
   <!-- sidebar: style can be found in sidebar.less -->
   <section class="sidebar">
     <!-- Sidebar user panel -->
     <div class="user-panel">
       <div class="pull-left image">
       <span class="logo-mini"><img src="<?php echo asset(app_config('AppLogo',Auth::user()->school_id)); ?>" style="height: 39px;" /></span>
       </div>
       <div class="pull-left info">
         <p>{{ Auth::user()->school_name }} </p>
         <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
       </div>
     </div>
     <!-- search form -->

     <!-- /.search form -->
     <!-- sidebar menu: : style can be found in sidebar.less -->
     <ul class="sidebar-menu" data-widget="tree">
       <li class="header">MAIN NAVIGATION</li>
       @if(menuAccess(Auth::user()->user_role,'1000')===true || menuAccess(Auth::user()->user_role,'1')===true)
       <li>
       <a href="{{url('welcome')}}">
         <i class="fa fa-dashboard"></i> <span>Dashboard</span>
       </a>
     </li>
     @endif
     @if(menuAccess(Auth::user()->user_role,'1002')== true || menuAccess(Auth::user()->user_role,'5')==true 
     || menuAccess(Auth::user()->user_role,'69')==true)

        <li @if(Request::path()=='create-Institution' OR Request::path()=='Academic-session' OR Request::path()=='setting/branch' OR Request::path()=='user/password/update'
    OR Request::path()=='userlist')class="treeview active" @endif class="treeview">
         <a href="#">
           <i class="fa fa-fw fa-bars"></i>
           <span>Setting</span>
           <span class="pull-right-container">
             <i class="fa fa-angle-left pull-right"></i>
           </span>
         </a>
         <ul class="treeview-menu">
         @if(menuAccess(Auth::user()->user_role,'5')==true)
           <li @if(Request::path()== 'create-Institution')class="active" @endif><a href="{{url('create-Institution')}}"><i class="fa fa-circle-o"></i> Institution Details</a></li>
          @endif
          @if(menuAccess(Auth::user()->user_role,'69')==true)
           <li @if(Request::path()== 'Academic-session')class="active" @endif><a href="{{url('Academic-session')}}"><i class="fa fa-circle-o"></i>Academic Session</a></li>
                   <li @if(Request::path()== 'create-Institution')class="active" @endif><a href="{{url('user/password/update')}}"><i class="fa fa-circle-o"></i> Password Update</a></li>
          @endif
          </ul>
       </li>
       @endif
       <!-- Announcement -->
     @if(menuAccess(Auth::user()->user_role,'1003')== true || menuAccess(Auth::user()->user_role,'70')==true
     || menuAccess(Auth::user()->user_role,'71')==true)

     <li @if(Request::path()=='announcement/teacher' OR Request::path()=='announcement/parents'
    )class="treeview active" @endif class="treeview">
         <a href="#">
           <i class="fa fa-bullhorn"></i>
           <span>Announcement</span>
           <span class="pull-right-container">
             <i class="fa fa-angle-left pull-right"></i>
           </span>
         </a>
         <ul class="treeview-menu">
          @if(menuAccess(Auth::user()->user_role,'70')== true)
           <li @if(Request::path()== 'announcement/teacher') class="active" @endif><a href="{{url('announcement/teacher')}}"><i class="fa fa-circle-o"></i>Teacher</a></li>
          @endif
          @if(menuAccess(Auth::user()->user_role,'71')== true)
           <li @if(Request::path()== 'announcement/parents') class="active" @endif><a href="{{url('announcement/parents')}}"><i class="fa fa-circle-o"></i>Parents</a></li>
          @endif
          </ul>
       </li>
       @endif
       <!-- End Announcement -->
       @if(menuAccess(Auth::user()->user_role,'150')==true || menuAccess(Auth::user()->user_role,'150')==true)
         <li @if(Request::path()=='event/event_type' OR Request::path()==''
    OR Request::path()=='')class="treeview active" @endif class="treeview" style="display: none;">
         <a href="#">
           <i class="fa fa-star"></i>
           <span>Event</span>
           <span class="pull-right-container">
             <i class="fa fa-angle-left pull-right"></i>
           </span>
         </a>
         <ul class="treeview-menu">
           <li @if(Request::path()== 'event/event_type') class="active" @endif><a href="{{url('event/event_type')}}"><i class="fa fa-circle-o"></i> Event Types</a></li>
           <li @if(Request::path()== '') class="active" @endif><a href="{{url('')}}"><i class="fa fa-circle-o"></i>Add Events </a></li>
            <li @if(Request::path()== '') class="active" @endif><a href="{{url('')}}"><i class="fa fa-circle-o"></i>Event Reports </a></li>
           </ul>
       </li>
       @endif
       @if(menuAccess(Auth::user()->user_role,'1004')== true || menuAccess(Auth::user()->user_role,'72')==true
     || menuAccess(Auth::user()->user_role,'73')==true || menuAccess(Auth::user()->user_role,'74')==true
     || menuAccess(Auth::user()->user_role,'75')==true || menuAccess(Auth::user()->user_role,'76')==true
     || menuAccess(Auth::user()->user_role,'77')==true || menuAccess(Auth::user()->user_role,'78')==true)

        <li @if(Request::path()=='FrontOffice/admission_enquiry' OR Request::path()=='FrontOffice/visitor_book' OR Request::path()=='FrontOffice/phone_call' OR Request::path()=='FrontOffice/postal_dispatch' OR Request::path()=='FrontOffice/postal_recieve' OR Request::path()=='FrontOffice/complain'  OR Request::path()=='FrontOffice/office_setup'
    OR Request::path()=='userlist')class="treeview active" @endif class="treeview">
         <a href="#">
           <i class="fa fa-ioxhost"></i>
           <span>Front Office</span>
           <span class="pull-right-container">
             <i class="fa fa-angle-left pull-right"></i>
           </span>
         </a>

         <ul class="treeview-menu">
         @if(menuAccess(Auth::user()->user_role,'72')== true)
          <li @if(Request::path()== 'FrontOffice/office_setup')class="active" @endif><a href="{{url('FrontOffice/office_setup')}}"><i class="fa fa-circle-o"></i> Office Setup</a></li>
         @endif
         @if(menuAccess(Auth::user()->user_role,'73')== true)
           <li @if(Request::path()== 'FrontOffice/admission_enquiry')class="active" @endif><a href="{{url('FrontOffice/admission_enquiry')}}"><i class="fa fa-circle-o"></i> Admission Enquiry</a></li>
         @endif
         @if(menuAccess(Auth::user()->user_role,'74')== true)
          <li @if(Request::path()== 'FrontOffice/visitor_book')class="active" @endif><a href="{{url('FrontOffice/visitor_book')}}"><i class="fa fa-circle-o"></i>Visitor Book</a></li>
         @endif
         @if(menuAccess(Auth::user()->user_role,'75')== true)
         <li @if(Request::path()== 'FrontOffice/phone_call') class="active" @endif><a href="{{url('FrontOffice/phone_call')}}"><i class="fa fa-circle-o"></i>Phone Call log</a></li>
         @endif
         @if(menuAccess(Auth::user()->user_role,'76')== true)
         <li @if(Request::path()== 'FrontOffice/postal_dispatch') class="active" @endif><a href="{{url('FrontOffice/postal_dispatch')}}"><i class="fa fa-circle-o"></i>Postal Dispatch</a></li>
        @endif
        @if(menuAccess(Auth::user()->user_role,'77')== true)
         <li @if(Request::path()== 'FrontOffice/postal_recieve') class="active" @endif><a href="{{url('FrontOffice/postal_recieve')}}"><i class="fa fa-circle-o"></i>Postal Receive</a></li>
        @endif
        @if(menuAccess(Auth::user()->user_role,'78')== true)
        <li @if(Request::path()== 'FrontOffice/complain') class="active" @endif><a href="{{url('FrontOffice/complain')}}"><i class="fa fa-circle-o"></i>Complain</a></li>
        @endif
          </ul>
       </li>
      @endif
     @if(menuAccess(Auth::user()->user_role,'1005')== true || menuAccess(Auth::user()->user_role,'1006')==true
     || menuAccess(Auth::user()->user_role,'1007')==true || menuAccess(Auth::user()->user_role,'1008')==true
     || menuAccess(Auth::user()->user_role,'1009')==true || menuAccess(Auth::user()->user_role,'1010')==true
     || menuAccess(Auth::user()->user_role,'11')==true || menuAccess(Auth::user()->user_role,'12')==true
     || menuAccess(Auth::user()->user_role,'13')==true || menuAccess(Auth::user()->user_role,'14')==true
     || menuAccess(Auth::user()->user_role,'15')==true || menuAccess(Auth::user()->user_role,'80')==true
     || menuAccess(Auth::user()->user_role,'79')==true || menuAccess(Auth::user()->user_role,'10')==true )


       <li @if(Request::path()=='add-course' OR Request::path()=='add-batch' OR Request::path()=='classTeacher-Allocation' OR Request::path()=='subject/create' OR Request::path()=='subject/assign-subject' OR Request::path()=='subject/subject-allocation' OR Request::path()=='subject/lession-planning' OR Request::path()=='classTeacher-Allocation' OR Request::path()=='subject/lession-planning') class="treeview active" @endif class="treeview">
         <a href="#">
           <i class="fa fa-fw fa-group"></i> <span>Academic</span>
           <span class="pull-right-container">
             <i class="fa fa-angle-left pull-right"></i>
           </span>
         </a>
         <ul class="treeview-menu">
         @if(menuAccess(Auth::user()->user_role,'1006')== true || menuAccess(Auth::user()->user_role,'10')==true
     || menuAccess(Auth::user()->user_role,'11')==true || menuAccess(Auth::user()->user_role,'12')==true)
          <li @if(Request::path()=='add-course' OR Request::path()=='add-batch' OR Request::path()=='classTeacher-Allocation')class="treeview active" @endif class="treeview">
             <a href="#"><i class="fa fa-fw fa-book"></i> Class & Section
               <span class="pull-right-container">
                 <i class="fa fa-angle-left pull-right"></i>
               </span>
             </a>
             <ul class="treeview-menu">
             @if(menuAccess(Auth::user()->user_role,'10')== true )
               <li @if(Request::path()== 'add-course')class="active" @endif><a href="{{url('add-course')}}"><i class="fa fa-circle-o"></i>Class</a></li>
             @endif
             @if(menuAccess(Auth::user()->user_role,'11')== true )
               <li @if(Request::path()== 'add-batch')class="active" @endif><a href="{{url('add-batch')}}"><i class="fa fa-circle-o"></i>Section</a></li>
             @endif
             @if(menuAccess(Auth::user()->user_role,'12')== true )
               <li @if(Request::path()== 'classTeacher-Allocation') class="active" @endif><a href="{{url('classTeacher-Allocation')}}"><i class="fa fa-circle-o"></i>Class Teacher Allocation</a></li>
             @endif
             </ul>
           </li>
         @endif
         @if(menuAccess(Auth::user()->user_role,'1007')== true || menuAccess(Auth::user()->user_role,'13')==true
     || menuAccess(Auth::user()->user_role,'14')==true || menuAccess(Auth::user()->user_role,'15')==true)
           <li @if(Request::path()=='subject/create' OR Request::path()=='subject/assign-subject' OR Request::path()=='subject/subject-allocation' OR Request::path()=='subject/lession-planning' OR Request::path()=='classTeacher-Allocation')class="treeview active" @endif class="treeview">

             <a href="#"><i class="fa fa-fw fa-book"></i>Subject
               <span class="pull-right-container">
                 <i class="fa fa-angle-left pull-right"></i>
               </span>
             </a>
             <ul class="treeview-menu">
             @if(menuAccess(Auth::user()->user_role,'13')== true )
               <li @if(Request::path()== 'subject/create')class="active" @endif><a href="{{url('subject/create')}}"><i class="fa fa-circle-o"></i>Subject</a></li>
             @endif
             @if(menuAccess(Auth::user()->user_role,'14')== true )
               <li @if(Request::path()== 'subject/assign-subject')class="active" @endif><a href="{{url('subject/assign-subject')}}"><i class="fa fa-circle-o"></i>Assign Class Subject</a></li>
            @endif
            @if(menuAccess(Auth::user()->user_role,'15')== true )
               <li @if(Request::path()== 'subject/subject-allocation')class="active" @endif ><a href="{{url('subject/subject-allocation')}}"><i class="fa fa-circle-o"></i>Subject Teacher Allocation</a></li>
             @endif
              </ul>
           </li>
           @endif
           @if(menuAccess(Auth::user()->user_role,'1009')== true || menuAccess(Auth::user()->user_role,'1010' )
           || menuAccess(Auth::user()->user_role,'79'))
           <li @if(Request::path()=='subject/lession-planning') class="treeview active" @endif class="treeview">
             <a href="#"><i class="fa fa-fw fa-book"></i> Lession Planning
               <span class="pull-right-container">
                 <i class="fa fa-angle-left pull-right"></i>
               </span>
             </a>
             <ul class="treeview-menu">
             @if(menuAccess(Auth::user()->user_role,'79')== true )
               <li @if(Request::path()== 'subject/lession-planning') class="active" @endif ><a href="{{url('subject/lession-planning')}}"><i class="fa fa-circle-o"></i>Lession Planning</a></li>
             @endif
             </ul>
           </li>
           @endif


         </ul>
       </li>
   @endif

       <!-- timetavble -->
       @if(menuAccess(Auth::user()->user_role,'1011')== true || menuAccess(Auth::user()->user_role,'81')==true
     || menuAccess(Auth::user()->user_role,'82')==true || menuAccess(Auth::user()->user_role,'83')==true
     || menuAccess(Auth::user()->user_role,'84')==true || menuAccess(Auth::user()->user_role,'85')==true)

        <li @if(Request::path()=='create_timetable' OR Request::path()=='add-room' OR Request::path()=='period_master' OR Request::path()=='view_timetable' OR Request::path()=='batch_timetable' OR Request::path()=='teacher_timetable'
    OR Request::path()=='userlist')class="treeview active" @endif class="treeview">
         <a href="#">
           <i class="fa fa-calendar"></i>
           <span>Time Table</span>
           <span class="pull-right-container">
             <i class="fa fa-angle-left pull-right"></i>
           </span>
         </a>
         <ul class="treeview-menu">
         @if(menuAccess(Auth::user()->user_role,'81')== true)
         <li @if(Request::path()== 'add-room') class="active" @endif><a href="{{url('add-room')}}"><i class="fa fa-circle-o"></i>Add Room</a></li>
         <li @if(Request::path()== 'period_master') class="active" @endif><a href="{{url('period_master')}}"><i class="fa fa-circle-o"></i>Period Master</a></li>
          @endif
          @if(menuAccess(Auth::user()->user_role,'82')== true)
          <li @if(Request::path()== 'create_timetable') class="active" @endif><a href="{{url('create_timetable')}}"><i class="fa fa-circle-o"></i>Set Time Table</a></li>
          @endif
          @if(menuAccess(Auth::user()->user_role,'83')== true)
          <li @if(Request::path()== 'view_timetable') class="active" @endif><a href="{{url('view_timetable')}}"><i class="fa fa-circle-o"></i>Time Table Report</a></li>
          @endif
          @if(menuAccess(Auth::user()->user_role,'84')== true)
          <li @if(Request::path()== 'batch_timetable') class="active" @endif><a href="{{url('batch_timetable')}}"><i class="fa fa-circle-o"></i>View Batch Time Table</a></li>
         @endif
         @if(menuAccess(Auth::user()->user_role,'85')== true)
          <li style="display:none;" @if(Request::path()== 'teacher_timetable') class="active" @endif><a href="{{url('teacher_timetable')}}"><i class="fa fa-circle-o"></i>View Teacher Time Table</a></li>
          @endif
          </ul>
       </li>
@endif
      <!--  timetabekl end -->
      @if(menuAccess(Auth::user()->user_role,'1012')== true || menuAccess(Auth::user()->user_role,'86')==true
     || menuAccess(Auth::user()->user_role,'87')==true)

      <li @if(Request::path()=='homework/homeworklist' OR Request::path()=='homework/evaluation_report'
    OR Request::path()=='userlist')class="treeview active" @endif class="treeview">
         <a href="#">
           <i class="fa fa-book"></i>
           <span>Home Work</span>
           <span class="pull-right-container">
             <i class="fa fa-angle-left pull-right"></i>
           </span>
         </a>
         <ul class="treeview-menu">
         @if(menuAccess(Auth::user()->user_role,'86')== true )
           <li @if(Request::path()== 'homework/homeworklist') class="active" @endif><a href="{{url('homework/homeworklist')}}"><i class="fa fa-circle-o"></i> Homework</a></li>
         @endif
         @if(menuAccess(Auth::user()->user_role,'87')== true )
           <li style="display:none;" @if(Request::path()== 'homework/evaluation_report') class="active" @endif><a href="{{url('homework/evaluation_report')}}"><i class="fa fa-circle-o"></i>Assignement</a></li>
         @endif
        </ul>
    </li>
@endif
    @if(menuAccess(Auth::user()->user_role,'1013')== true || menuAccess(Auth::user()->user_role,'1014')==true
     || menuAccess(Auth::user()->user_role,'16')==true || menuAccess(Auth::user()->user_role,'17')==true
     || menuAccess(Auth::user()->user_role,'18')==true || menuAccess(Auth::user()->user_role,'19')==true
     || menuAccess(Auth::user()->user_role,'20')==true || menuAccess(Auth::user()->user_role,'21')==true
     || menuAccess(Auth::user()->user_role,'22')==true || menuAccess(Auth::user()->user_role,'23')==true
     || menuAccess(Auth::user()->user_role,'24')==true || menuAccess(Auth::user()->user_role,'88')==true
     || menuAccess(Auth::user()->user_role,'89')==true || menuAccess(Auth::user()->user_role,'90')==true)

       <li @if(Request::path()=='hr/add-userType' OR Request::path()=='hr/employee/leave/all' OR Request::path()=='employee/leave/Leave-view' OR Request::path()=='employee/leave/leave-type' OR Request::path()=='hr/category' OR Request::path()=='hr/department' OR Request::path()=='hr/designation' OR Request::path()=='hr/employee' OR Request::path()=='hr/employee/list' OR Request::path()=='hr1/aadd-userType')class="treeview active" @endif class="treeview">

         <a href="#">
           <i class="fa fa-fw fa-child"></i> <span>HR/Payroll</span>
           <span class="pull-right-container">
             <i class="fa fa-angle-left pull-right"></i>
           </span>
         </a>
         @if(menuAccess(Auth::user()->user_role,'1014')==true || menuAccess(Auth::user()->user_role,'152')==true
     || menuAccess(Auth::user()->user_role,'16')==true || menuAccess(Auth::user()->user_role,'17')==true
     || menuAccess(Auth::user()->user_role,'18')==true || menuAccess(Auth::user()->user_role,'19')==true
     || menuAccess(Auth::user()->user_role,'20')==true || menuAccess(Auth::user()->user_role,'21')==true
     || menuAccess(Auth::user()->user_role,'22')==true || menuAccess(Auth::user()->user_role,'23')==true
     || menuAccess(Auth::user()->user_role,'24')==true || menuAccess(Auth::user()->user_role,'88')==true
     || menuAccess(Auth::user()->user_role,'89')==true || menuAccess(Auth::user()->user_role,'90')==true)
         <ul class="treeview-menu">
           <li @if(Request::path()=='hr/add-userType' OR Request::path()=='hr/category' OR Request::path()=='hr/department' OR Request::path()=='hr/designation' OR Request::path()=='hr/employee' OR Request::path()=='hr/employee/list' OR Request::path()=='hr1/add-userType')class="treeview active" @endif class="treeview">

             <a href="#"><i class="fa fa-fw fa-group"></i> Employee Management
               <span class="pull-right-container">
                 <i class="fa fa-angle-left pull-right"></i>
               </span>
             </a>
             <ul class="treeview-menu">
             @if(menuAccess(Auth::user()->user_role,'21')==true)
               <li @if(Request::path()== 'hr/add-userType')class="active" @endif><a href="{{url('hr/add-userType')}}"><i class="fa fa-circle-o"></i>Add User Type</a></li>
             @endif
             @if(menuAccess(Auth::user()->user_role,'88')==true)
               <li @if(Request::path()== 'hr/department')class="active" @endif><a href="{{url('hr/department')}}"><i class="fa fa-circle-o"></i>Add Department</a></li>
             @endif
             @if(menuAccess(Auth::user()->user_role,'89')==true)
               <li @if(Request::path()== 'hr/designation')class="active" @endif><a href="{{url('hr/designation')}}"><i class="fa fa-circle-o"></i>Add Designation</a></li>
             @endif
             @if(menuAccess(Auth::user()->user_role,'90')==true)
               <li @if(Request::path()== 'hr/category')class="active" @endif><a href="{{url('hr/category')}}"><i class="fa fa-circle-o"></i> Add Category</a></li>
             @endif
             @if(menuAccess(Auth::user()->user_role,'17')==true)
               <li @if(Request::path()== 'hr/employee')class="active" @endif><a href="{{url('hr/employee')}}"><i class="fa fa-circle-o"></i>Add Employee</a></li>
             @endif
             @if(menuAccess(Auth::user()->user_role,'18')==true)
               <li @if(Request::path()== 'hr/employee/list')class="active" @endif><a href="{{url('hr/employee/list')}}"><i class="fa fa-circle-o"></i>Employee List</a></li>
             @endif
             @if(menuAccess(Auth::user()->user_role,'89')==true)
               <li @if(Request::path()== 'hr/designation')class="active" @endif><a href="{{url('emp/doc/mstr/list')}}"><i class="fa fa-circle-o"></i>Add Employee Doc Type</a></li>
             @endif
              @if(menuAccess(Auth::user()->user_role,'89')==true)
               <li @if(Request::path()== 'hr/designation')class="active" @endif><a href="{{url('employee/upload/document')}}"><i class="fa fa-circle-o"></i>Upload Employee Document</a></li>
             @endif
             </ul>
           </li>
           <li class="treeview" style="display:none;">
             <a href="#"><i class="fa fa-fw fa-rupee"></i>Payroll
               <span class="pull-right-container">
                 <i class="fa fa-angle-left pull-right"></i>
               </span>
             </a>
             <ul class="treeview-menu">
               <li><a href="#"><i class="fa fa-circle-o"></i>Pay Head</a></li>
               <li><a href="#"><i class="fa fa-circle-o"></i>Payment Types </a></li>
               <li><a href="#"><i class="fa fa-circle-o"></i>Sallary Setting</a></li>
               <li><a href="#"><i class="fa fa-circle-o"></i>Employee Salary</a></li>
               <li><a href="#"><i class="fa fa-circle-o"></i>Salary Statement</a></li>
             </ul>
           </li>
           @if(menuAccess(Auth::user()->user_role,'152')== true)

           <li  @if (Request::path()=='employee/leave/leave-type' OR Request::path()=='hr/employee/leave/all' OR Request::path()=='employee/leave/Leave-view')class="treeview active" @endif class="treeview">
             <a href="#"><i class="fa fa-fw fa-refresh"></i> Leave Management
               <span class="pull-right-container">
                 <i class="fa fa-angle-left pull-right"></i>
               </span>
             </a>
             <ul class="treeview-menu">
               <li @if(Request::path()== 'employee/leave/leave-type')class="active" @endif><a href="{{url('employee/leave/leave-type')}}"><i class="fa fa-circle-o"></i>Leave Type</a></li>
               <li @if(Request::path()== 'employee/leave/Leave-view')class="active" @endif><a href="{{url('employee/leave/Leave-view')}}"><i class="fa fa-circle-o"></i>Leave Applications</a></li>
               <li @if(Request::path()== 'hr/employee/leave/all')class="active" @endif><a href="{{url('hr/employee/leave/all')}}"><i class="fa fa-circle-o"></i>All Leaves</a></li>
             </ul>
           </li>
           @endif

           <li class="active treeview" style="display:none;">
            <a href="{{url('home')}}">
              <i class="fa fa-dashboard"></i> <span>Attendance</span>

            </a>
          </li>

         </ul>
         @endif
       </li>
        @endif
        <li @if (Request::path()=='employee/leave/apply' OR Request::path()=='employee/leave/Leave-applied-view') class="treeview active" @endif class="treeview">
          <a href="#"><i class="fa fa-fw fa-refresh"></i> Leave
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li @if(Request::path()== 'employee/leave/apply')class="active" @endif ><a href="{{url('employee/leave/apply')}}"><i class="fa fa-circle-o"></i>Apply Leave</a></li>
            <li @if(Request::path()== 'employee/leave/Leave-applied-view')class="active" @endif ><a href="{{url('employee/leave/Leave-applied-view')}}"><i class="fa fa-circle-o"></i>View Leave Application</a></li>
          </ul>
        </li>

    @if(menuAccess(Auth::user()->user_role,'1015')== true || menuAccess(Auth::user()->user_role,'26')==true
     || menuAccess(Auth::user()->user_role,'27')==true || menuAccess(Auth::user()->user_role,'91')==true
     || menuAccess(Auth::user()->user_role,'28')==true || menuAccess(Auth::user()->user_role,'92')==true
     || menuAccess(Auth::user()->user_role,'29')==true || menuAccess(Auth::user()->user_role,'93')==true
     || menuAccess(Auth::user()->user_role,'94')==true || menuAccess(Auth::user()->user_role,'95')==true
     || menuAccess(Auth::user()->user_role,'96')==true || menuAccess(Auth::user()->user_role,'97')==true
     || menuAccess(Auth::user()->user_role,'98')==true || menuAccess(Auth::user()->user_role,'99')==true
     || menuAccess(Auth::user()->user_role,'100')==true)

       <li @if(Request::path()=='student/category' OR Request::path()=='student/admission' OR Request::path()=='student/studentlist'
          OR Request::path()=='student/list' OR Request::path()=='student/attendance' OR Request::path()=='student/student_get_pass_list'
          OR Request::path()=='student/attendance/attendancereport' OR Request::path()=='student/transport' OR Request::path()== 'student/BonafideCertificate' OR Request::path()== 'online/admission-form/list'
          OR Request::path()=='student/DomicileCertificate' OR Request::path()=='student/LeavingCertificate'
          OR Request::path()== 'student/CharacterCertificate'  OR Request::path()==  'student/trialCertificate')
    class="treeview active" @endif class="treeview">
        <a href="#">
          <i class="fa fa-fw fa-user"></i>
          <span>Student</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
        @if(menuAccess(Auth::user()->user_role,'26')== true)
          <li @if(Request::path()== 'student/admission')class="active" @endif><a href="{{url('student/admission')}}"><i class="fa fa-circle-o"></i>Student Admission</a></li>
        @endif
  @if(menuAccess(Auth::user()->user_role,'26')== true)
         <li @if(Request::path()== 'online/admission-form/list')class="active" @endif><a href="{{url('online/admission-form/list')}}"><i class="fa fa-circle-o"></i>Online Applications</a></li>
       @endif
        @if(menuAccess(Auth::user()->user_role,'27')== true)
          <li @if(Request::path()== 'student/list')class="active" @endif><a href="{{url('student/list')}}"><i class="fa fa-circle-o"></i> Student List</a></li>
        @endif
        @if(menuAccess(Auth::user()->user_role,'91')== true)
          <li @if(Request::path()== 'student/roll_section')class="active" @endif><a href="{{url('student/roll_section')}}"><i class="fa fa-circle-o"></i>Assign Roll No & Section</a></li>
        @endif
        @if(menuAccess(Auth::user()->user_role,'28')== true)
          <li @if(Request::path()== 'student/attendance')class="active" @endif><a href="{{url('student/attendance')}}"><i class="fa fa-circle-o"></i>Attendance</a></li>
        @endif
        @if(menuAccess(Auth::user()->user_role,'92')== true)
          <li @if(Request::path()== 'student/attendance/attendancereport')class="active" @endif><a href="{{url('student/attendance/attendancereport')}}"><i class="fa fa-circle-o"></i>Attendance Report</a></li>
        @endif
        @if(menuAccess(Auth::user()->user_role,'29')== true)
          <li style="display:none;" @if(Request::path()== 'student/transport')class="active" @endif><a href="{{url('student/transport')}}"><i class="fa fa-circle-o"></i>Tranport Allocation</a></li>
        @endif
        @if(menuAccess(Auth::user()->user_role,'93')== true)
         <li style="display:none;" @if(Request::path()== 'student/gaurdian_list')class="active" @endif><a href="{{url('student/gaurdian_list')}}"><i class="fa fa-circle-o"></i>Gaurdian List</a></li>
        @endif
        @if(menuAccess(Auth::user()->user_role,'26')== true)
         <li @if(Request::path()== 'hr/add-userType')class="active" @endif><a href="{{url('userlist')}}"><i class="fa fa-circle-o"></i>Roll Number</a></li>
        @endif
        @if(menuAccess(Auth::user()->user_role,'94')== true)
        <li @if(Request::path()== 'student/student_get_pass') class="active" @endif><a href="{{url('student/student_get_pass')}}"><i class="fa fa-circle-o"></i>Student Gate Pass</a></li>
        @endif
        @if(menuAccess(Auth::user()->user_role,'95')== true)
        <li @if(Request::path()== 'student/student_get_pass_list')class="active" @endif><a href="{{url('student/student_get_pass_list')}}"><i class="fa fa-circle-o"></i>Student Gate Pass List</a></li>
        @endif
        @if(menuAccess(Auth::user()->user_role,'96')== true)
        <li @if(Request::path()== 'student/DomicileCertificate')class="active" @endif><a href="{{url('student/DomicileCertificate')}}"><i class="fa fa-circle-o"></i>Domicile Certificate</a></li>
        @endif
        @if(menuAccess(Auth::user()->user_role,'97')== true)
        <li @if(Request::path()== 'student/trialCertificate')class="active" @endif><a href="{{url('student/trialCertificate')}}"><i class="fa fa-circle-o"></i>ICSE/ISC Trial Certificate</a></li>
        @endif
        @if(menuAccess(Auth::user()->user_role,'98')== true)
        <li @if(Request::path()== 'student/CharacterCertificate')class="active" @endif><a href="{{url('student/CharacterCertificate')}}"><i class="fa fa-circle-o"></i>Character Certificate</a></li>
        @endif
        @if(menuAccess(Auth::user()->user_role,'99')== true)
        <li @if(Request::path()== 'student/BonafideCertificate')class="active" @endif><a href="{{url('student/BonafideCertificate')}}"><i class="fa fa-circle-o"></i>Bonafide Certificate</a></li>
        @endif
        @if(menuAccess(Auth::user()->user_role,'100')== true)
        <li @if(Request::path()== 'student/LeavingCertificate')class="active" @endif><a href="{{url('student/LeavingCertificate')}}"><i class="fa fa-circle-o"></i>Leaving Certificate</a></li>
        @endif
        @if(menuAccess(Auth::user()->user_role,'26')== true)
         <li @if(Request::path()== 'hr/add-userType')class="active" @endif><a href="{{url('attendance/report')}}"><i class="fa fa-circle-o"></i>Attendance Report Details</a></li>
        @endif
        @if(menuAccess(Auth::user()->user_role,'72')== true)
          <li class="active"><a href="{{url('category')}}"><i class="fa fa-circle-o"></i>Student Summary1</a></li>
          <li class="active"><a href="{{url('cast')}}"><i class="fa fa-circle-o"></i>Student Summary2</a></li>
         @endif
         </ul>
      </li>
        @endif

        @if(menuAccess(Auth::user()->user_role,'1016')== true || menuAccess(Auth::user()->user_role,'1017')==true
     || menuAccess(Auth::user()->user_role,'1018')==true || menuAccess(Auth::user()->user_role,'33')==true
     || menuAccess(Auth::user()->user_role,'34')==true || menuAccess(Auth::user()->user_role,'101')==true
     || menuAccess(Auth::user()->user_role,'102')==true || menuAccess(Auth::user()->user_role,'103')==true
     || menuAccess(Auth::user()->user_role,'104')==true || menuAccess(Auth::user()->user_role,'105')==true
     || menuAccess(Auth::user()->user_role,'106')==true || menuAccess(Auth::user()->user_role,'107')==true
     || menuAccess(Auth::user()->user_role,'108')==true || menuAccess(Auth::user()->user_role,'109')==true
     || menuAccess(Auth::user()->user_role,'110')==true || menuAccess(Auth::user()->user_role,'111')==true
     || menuAccess(Auth::user()->user_role,'112')==true || menuAccess(Auth::user()->user_role,'113')==true
     || menuAccess(Auth::user()->user_role,'114')==true)


       <li @if(Request::path()=='finance/Fee-Category' OR Request::path()=='finance/Fee-SubCategory'
   OR Request::path()=='finance/Fee-SubCategory/fine' OR Request::path()=='finance/Fee-master'
   OR Request::path()=='finance/Fee/fee-Collection' OR Request::path()=='finance/Fee/feeCollection/list'
    OR Request::path()=='finance/Fee-collection/reports' OR Request::path()=='finance/Fee/duereport'
    OR Request::path()=='finance/account/account-group' OR Request::path()=='finance/account/voucher-head'
   OR Request::path()=='finance/account/voucher' OR Request::path()=='finance/account/voucher/list' OR Request::path()=='finance/Fee/onlinefeeCollection/list'
   OR Request::path()=='finance/Fee/fee-Collection' OR Request::path()=='finance/Fee/feeCollection/list' OR Request::path()=='finance/fee/waiver'
    OR Request::path()=='finance/account/voucher/daybook' OR Request::path()=='finance/fee-report/individual'  OR Request::path()=='finance/account/voucher/legder-account' OR Request::path()=='finance/account/voucher/trial-account'
       OR Request::path()=='finance/Fee/dailyCashRegister' OR Request::path()=='finance/Fee/dailyCashRegister/report')
      class="treeview active" @endif class="treeview">
        <a href="#">
          <i class="fa fa-fw fa-child"></i> <span>Finance</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">

    @if(menuAccess(Auth::user()->user_role,'32')== true || menuAccess(Auth::user()->user_role,'1017')==true
     || menuAccess(Auth::user()->user_role,'33')==true || menuAccess(Auth::user()->user_role,'34')==true
     || menuAccess(Auth::user()->user_role,'101')==true || menuAccess(Auth::user()->user_role,'102')==true
     || menuAccess(Auth::user()->user_role,'103')==true || menuAccess(Auth::user()->user_role,'104')==true
     || menuAccess(Auth::user()->user_role,'105')==true || menuAccess(Auth::user()->user_role,'106')==true)
          <li @if(Request::path()=='finance/Fee-Category' OR Request::path()=='finance/Fee-SubCategory'
   OR Request::path()=='finance/Fee-SubCategory/fine' OR Request::path()=='finance/Fee-master'
   OR Request::path()=='finance/Fee/fee-Collection' OR Request::path()=='finance/Fee/feeCollection/list' OR Request::path()=='finance/Fee/onlinefeeCollection/list' OR Request::path()=='finance/fee-report/individual'
    OR Request::path()=='finance/Fee-collection/reports' OR Request::path()=='finance/Fee/duereport' 
        OR Request::path()=='finance/fee/waiver' )
     class="treeview active" @endif class="treeview">
            <a href="#"><i class="fa fa-fw fa-rupee"></i>Fee
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
            @if(menuAccess(Auth::user()->user_role,'32')== true)
              <li @if(Request::path()== 'finance/Fee-Category') class="active" @endif><a href="{{url('finance/Fee-Category')}}"><i class="fa fa-circle-o"></i>Fee Category</a></li>
            @endif
            @if(menuAccess(Auth::user()->user_role,'33')== true)
             <li @if(Request::path()== 'finance/Fee-SubCategory') class="active" @endif><a href="{{url('finance/Fee-SubCategory')}}"><i class="fa fa-circle-o"></i>Fee Sub-Category </a></li>
            @endif
            @if(menuAccess(Auth::user()->user_role,'34')== true)
              <li @if(Request::path()== 'finance/Fee-SubCategory/fine')class="active" @endif><a href="{{url('finance/Fee-SubCategory/fine')}}"><i class="fa fa-circle-o"></i>Fee Sub-Category Fine</a></li>
            @endif
            @if(menuAccess(Auth::user()->user_role,'101')== true)
            <li @if(Request::path()== 'finance/Fee-master')class="active" @endif><a href="{{url('finance/Fee-master')}}"><i class="fa fa-circle-o"></i>Fee Master</a></li>
            @endif
            @if(menuAccess(Auth::user()->user_role,'102')== true)
            <li  @if(Request::path()== 'finance/fee/waiver')class="active" @endif><a href="{{url('finance/fee/waiver')}}"><i class="fa fa-circle-o"></i>Fee Wavier</a></li>
            @endif
            @if(menuAccess(Auth::user()->user_role,'32')== true)
              <li style="display:none;"><a href="#"><i class="fa fa-circle-o"></i>Fee Template</a></li>
            @endif
            @if(menuAccess(Auth::user()->user_role,'32')== true)
              <li style="display:none;"><a href="#"><i class="fa fa-circle-o"></i>Fee Allocation</a></li>
            @endif
            @if(menuAccess(Auth::user()->user_role,'103')== true)
              <li @if(Request::path()== 'finance/Fee/fee-Collection')class="active" @endif><a href="{{url('finance/Fee/fee-Collection')}}"><i class="fa fa-circle-o"></i>Fee Collection</a></li>
            @endif
           
            @if(menuAccess(Auth::user()->user_role,'32')== true)
              <li style="display:none;"><a href="#"><i class="fa fa-circle-o"></i>Fee Import</a></li>
            @endif
            @if(menuAccess(Auth::user()->user_role,'32')== true)
              <li style="display:none;"><a href="#"><i class="fa fa-circle-o"></i>Fee Import</a></li>
            @endif
            </ul>
          </li>
        @endif
      
                              <li @if(Request::path()=='finance/Fee/feeCollection/list' OR Request::path()=='finance/Fee/onlinefeeCollection/list'
                        OR Request::path()=='finance/Fee/duereport' OR Request::path()=='finance/Fee-collection/reports' OR Request::path()=='finance/fee-report/individual'
                        OR Request::path()=='finance/Fee/dailyCashRegister' OR Request::path()=='finance/Fee/dailyCashRegister/report'
                   )
                   class="treeview active" @endif class="treeview">
                          <a href="#"><i class="fa fa-fw fa-book"></i> Fee Reports
                            <span class="pull-right-container">
                              <i class="fa fa-angle-left pull-right"></i>
                            </span>
                          </a>
                          <ul class="treeview-menu">
                            @if(menuAccess(Auth::user()->user_role,'104')== true)
                              <li @if(Request::path()== 'finance/Fee/feeCollection/list')class="active" @endif><a href="{{url('finance/Fee/feeCollection/list')}}"><i class="fa fa-circle-o"></i>Fee Collection List</a></li>
                            @endif
                            @if(menuAccess(Auth::user()->user_role,'104')== true)
                              <li @if(Request::path()== 'finance/Fee/onlinefeeCollection/list')class="active" @endif><a href="{{url('finance/Fee/onlinefeeCollection/list')}}"><i class="fa fa-circle-o"></i>Online Fee Collection List</a></li>
                            @endif
                            @if(menuAccess(Auth::user()->user_role,'104')== true)
                              <li @if(Request::path()== 'finance/Fee/dailyCashRegister')class="active" @endif><a href="{{url('finance/Fee/dailyCashRegister')}}"><i class="fa fa-circle-o"></i>Daily Cash Register</a></li>
                            @endif
                            @if(menuAccess(Auth::user()->user_role,'32')== true)
                              <li style="display:none;"><a href="#"><i class="fa fa-circle-o"></i>Quick Payment</a></li>
                            @endif
                          @if(menuAccess(Auth::user()->user_role,'105')== true)
                              <li @if(Request::path()== 'finance/fee-report/individual')class="active" @endif><a href="{{url('finance/fee-report/individual')}}"><i class="fa fa-circle-o"></i>Individual Report</a></li>
                            @endif
                            @if(menuAccess(Auth::user()->user_role,'105')== true)
                              <li @if(Request::path()== 'finance/Fee-collection/reports')class="active" @endif><a href="{{url('finance/Fee-collection/reports')}}"><i class="fa fa-circle-o"></i>Report</a></li>
                            @endif
                            @if(menuAccess(Auth::user()->user_role,'106')== true)
                              <li @if(Request::path()== 'finance/Fee/duereport')class="active" @endif><a href="{{url('finance/Fee/duereport')}}"><i class="fa fa-circle-o"></i>Fee Due Report</a></li>
                            @endif
                             @if(menuAccess(Auth::user()->user_role,'104')== true)
                              <li @if(Request::path()== 'finance/Fee/feeCollection/list')class="active" @endif><a href="{{url('fee/collection/month')}}"><i class="fa fa-circle-o"></i>Fee Collection Month Wise</a></li>
                            @endif
                          </ul>
                        </li>

        @if(menuAccess(Auth::user()->user_role,'107')== true || menuAccess(Auth::user()->user_role,'1018')==true
     || menuAccess(Auth::user()->user_role,'108')==true || menuAccess(Auth::user()->user_role,'109')==true
     || menuAccess(Auth::user()->user_role,'110')==true || menuAccess(Auth::user()->user_role,'110')==true
     || menuAccess(Auth::user()->user_role,'111')==true || menuAccess(Auth::user()->user_role,'112')==true
     || menuAccess(Auth::user()->user_role,'113')==true || menuAccess(Auth::user()->user_role,'114')==true)

          <li @if(Request::path()=='finance/account/account-group' OR Request::path()=='finance/account/voucher-head'
   OR Request::path()=='finance/account/voucher' OR Request::path()=='finance/account/voucher/list'
  
    OR Request::path()=='finance/account/voucher/daybook'
     OR Request::path()=='finance/account/voucher/legder-account' OR Request::path()=='finance/account/voucher/trial-account' )
     class="treeview active" @endif class="treeview">
            <a href="#"><i class="fa fa-fw fa-refresh"></i> Accounting
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
            @if(menuAccess(Auth::user()->user_role,'107')== true)
              <li @if(Request::path()== 'finance/account/account-group') class="active" @endif><a href="{{url('finance/account/account-group')}}"><i class="fa fa-circle-o"></i>Account Group</a></li>
            @endif
            @if(menuAccess(Auth::user()->user_role,'108')== true)
              <li style="display:none;"><a href="{{url('finance/account/voucher-master')}}"><i class="fa fa-circle-o"></i>Voucher Master</a></li>
            @endif
            @if(menuAccess(Auth::user()->user_role,'109')== true)
              <li @if(Request::path()== 'finance/account/voucher-head') class="active" @endif><a href="{{url('finance/account/voucher-head')}}"><i class="fa fa-circle-o"></i>Voucher Head</a></li>
            @endif
            @if(menuAccess(Auth::user()->user_role,'110')== true)
              <li @if(Request::path()== 'finance/account/voucher') class="active" @endif><a href="{{url('finance/account/voucher')}}"><i class="fa fa-circle-o"></i>Create Voucher</a></li>
            @endif
            @if(menuAccess(Auth::user()->user_role,'111')== true)
               <li @if(Request::path()== 'finance/account/voucher/list') class="active" @endif><a href="{{url('finance/account/voucher/list')}}"><i class="fa fa-circle-o"></i>Voucher List</a></li>
            @endif
            @if(menuAccess(Auth::user()->user_role,'112')== true)
              <li @if(Request::path()== 'finance/account/voucher/daybook') class="active" @endif><a href="{{url('finance/account/voucher/daybook')}}"><i class="fa fa-circle-o"></i>Day Book</a></li>
            @endif
            @if(menuAccess(Auth::user()->user_role,'32')== true)
              <li @if(Request::path()== 'finance/Fee-Category') class="active" @endif><a href="#"><i class="fa fa-circle-o"></i>Cash Book</a></li>
            @endif
            @if(menuAccess(Auth::user()->user_role,'107')== true)
              <li><a href="#"><i class="fa fa-circle-o"></i>Bank Book</a></li>
            @endif
            @if(menuAccess(Auth::user()->user_role,'113')== true || menuAccess(Auth::user()->user_role,'114')== true)
             <li @if(Request::path()=='finance/account/voucher/legder-account' OR Request::path()=='finance/account/voucher/trial-account' ) class="treeview active" @endif class="treeview">
                <a href="#"><i class="fa fa-circle-o"></i> Report
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                @if(menuAccess(Auth::user()->user_role,'113')== true)
                  <li @if(Request::path()== 'finance/account/voucher/legder-account') class="active" @endif><a href="{{url('finance/account/voucher/legder-account')}}"><i class="fa fa-circle-o"></i> Ledger Account</a></li>
                @endif
                @if(menuAccess(Auth::user()->user_role,'114')== true)
                  <li @if(Request::path()== 'finance/account/voucher/trial-account') class="active" @endif><a href="{{url('finance/account/voucher/trial-account')}}"><i class="fa fa-circle-o"></i> Trial Balance</a></li>
                @endif
                </ul>
              </li>
               @endif
            </ul>
          </li>

          @endif
        </ul>
      </li>
  @endif

  @if(menuAccess(Auth::user()->user_role,'1019')== true || menuAccess(Auth::user()->user_role,'115')==true
     || menuAccess(Auth::user()->user_role,'116')==true || menuAccess(Auth::user()->user_role,'117')==true
     || menuAccess(Auth::user()->user_role,'118')==true || menuAccess(Auth::user()->user_role,'119')==true
     || menuAccess(Auth::user()->user_role,'120')==true || menuAccess(Auth::user()->user_role,'121')==true
     || menuAccess(Auth::user()->user_role,'122')==true)
         <li @if(Request::path()=='Exam/exam_list' OR Request::path()=='Exam/exam_schedule_list' OR Request::path()=='Exam/mark_grade' OR Request::path()=='Exam/mark_register'
    OR Request::path()=='Exam/student_exam_report' OR Request::path()=='Exam/report' OR Request::path()=='Exam/bunch/report' OR Request::path()=='Exam/Finalreport' OR Request::path()=='Exam/final_result' OR Request::path()=='Exam/add_exam_schedule' OR Request::path()=='Exam/monthly/mark/save' OR Request::path()=='Exam/personality_traits' OR Request::path()=='Exam/monthly/mark/register' OR Request::path()=='Exam/annual/Finalreport' OR Request::path()=='Exam/create_mark_register')class="treeview active" @endif class="treeview">
         <a href="#">
           <i class="fa fa-graduation-cap"></i>
           <span>Examination</span>
           <span class="pull-right-container">
             <i class="fa fa-angle-left pull-right"></i>
           </span>
         </a>
         <ul class="treeview-menu">
         @if(menuAccess(Auth::user()->user_role,'115')== true)
           <li @if(Request::path()== 'Exam/exam_list')class="active" @endif><a href="{{url('Exam/exam_list')}}"><i class="fa fa-circle-o"></i> Exam List</a></li>
         @endif
         @if(menuAccess(Auth::user()->user_role,'116')== true)
           <li @if(Request::path()== 'Exam/exam_schedule_list')class="active" @endif><a href="{{url('Exam/exam_schedule_list')}}"><i class="fa fa-circle-o"></i>Exam Schedule</a></li>
         @endif
         @if(menuAccess(Auth::user()->user_role,'117')== true)
           <li @if(Request::path()== 'Exam/mark_register' OR Request::path()== 'Exam/create_mark_register')class="active" @endif><a href="{{url('Exam/mark_register')}}"><i class="fa fa-circle-o"></i> Mark Register</a></li>
         @endif
         @if(menuAccess(Auth::user()->user_role,'118')== true)
           <li @if(Request::path()== 'Exam/personality_traits')class="active" @endif><a href="{{url('Exam/personality_traits')}}"><i class="fa fa-circle-o"></i>Personality Traits</a></li>
         @endif
         @if(menuAccess(Auth::user()->user_role,'119')== true)
           <li @if(Request::path()== 'Exam/monthly/mark/register')class="active" @endif><a href="{{url('Exam/monthly/mark/register')}}"><i class="fa fa-circle-o"></i>Monthly Mark Register</a></li>
         @endif
         @if(menuAccess(Auth::user()->user_role,'120')== true)
           <li @if(Request::path()== 'Exam/mark_grade')class="active" @endif><a href="{{url('Exam/mark_grade')}}"><i class="fa fa-circle-o"></i>Marks Grade</a></li>
         @endif
         <li @if(Request::path()=='Exam/report' OR Request::path()=='Exam/bunch/report'
         OR Request::path()=='Exam/Finalreport' OR Request::path()=='Exam/annual/Finalreport' OR Request::path()=='Exam/student_exam_report'
         )class="treeview active" @endif class="treeview">
           <a href="#"><i class="fa fa-file"></i> Exam Reports
             <span class="pull-right-container">
               <i class="fa fa-angle-left pull-right"></i>
             </span>
           </a>
           <ul class="treeview-menu"> 

            @if(menuAccess(Auth::user()->user_role,'115')== true)
               <li @if(Request::path()== 'Exam/report')class="active" @endif><a href="{{url('Exam/report')}}"><i class="fa fa-circle-o"></i> Exam Report</a></li>
             @endif
             @if(menuAccess(Auth::user()->user_role,'115')== true)
                <li @if(Request::path()== 'Exam/bunch/report')class="active" @endif><a href="{{url('Exam/bunch/report')}}"><i class="fa fa-circle-o"></i>Marks Report (Subject Wise)</a></li>
              @endif
             @if(menuAccess(Auth::user()->user_role,'115')== true)
                <li @if(Request::path()== 'Exam/Finalreport')class="active" @endif><a href="{{url('Exam/Finalreport')}}"><i class="fa fa-circle-o"></i>Exam Report (Terminal)</a></li>
              @endif
              @if(menuAccess(Auth::user()->user_role,'115')== true)
                 <li @if(Request::path()== 'Exam/annual/Finalreport')class="active" @endif><a href="{{url('Exam/annual/Finalreport')}}"><i class="fa fa-circle-o"></i>Jumbo Sheet</a></li>
              @endif
             @if(menuAccess(Auth::user()->user_role,'121')== true)
              <li @if(Request::path()== 'Exam/student_exam_report')class="active" @endif><a href="{{url('Exam/student_exam_report')}}"><i class="fa fa-circle-o"></i>Search By Student</a></li>
            @endif
           </ul>
         </li>

         <li @if(Request::path()=='Exam/final_result'
         )class="treeview active" @endif class="treeview">
           <a href="#"><i class="fa fa-list-alt"></i> Results
             <span class="pull-right-container">
               <i class="fa fa-angle-left pull-right"></i>
             </span>
           </a>
           <ul class="treeview-menu">

        @if(menuAccess(Auth::user()->user_role,'122')== true)
        <li @if(Request::path()== 'Exam/final_result')class="active" @endif><a href="{{url('Exam/final_result')}}"><i class="fa fa-circle-o"></i>Final Result</a></li>
        @endif
      </ul>
    </li>
          </ul>
       </li>
      @endif
      @if(menuAccess(Auth::user()->user_role,'1020')== true || menuAccess(Auth::user()->user_role,'123')==true
     || menuAccess(Auth::user()->user_role,'124')==true || menuAccess(Auth::user()->user_role,'125')==true
     || menuAccess(Auth::user()->user_role,'126')==true || menuAccess(Auth::user()->user_role,'127')==true
     || menuAccess(Auth::user()->user_role,'128')==true)

      <li  @if(Request::path()=='library/category' OR Request::path()=='library/books'OR Request::path()=='library/books/issue'
    OR Request::path()=='library/bookissue/return')class="treeview active" @endif class="treeview">
       <a href="#">
         <i class="fa fa-fw fa-book"></i>
         <span>Library</span>
         <span class="pull-right-container">
           <i class="fa fa-angle-left pull-right"></i>
         </span>
       </a>
       <ul class="treeview-menu">
       @if(menuAccess(Auth::user()->user_role,'123')== true)
         <li @if(Request::path()=='library/category') class="active" @endif><a href="{{url('library/category')}}"><i class="fa fa-circle-o"></i>Add Category</a></li>
       @endif
       @if(menuAccess(Auth::user()->user_role,'124')== true)
         <li @if(Request::path()=='library/books') class="active" @endif><a href="{{url('library/books')}}"><i class="fa fa-circle-o"></i>Add Book</a></li>
       @endif
       @if(menuAccess(Auth::user()->user_role,'125')== true)
          <li @if(Request::path()=='library/books/issue') class="active" @endif><a href="{{url('library/books/issue')}}"><i class="fa fa-circle-o"></i>Issue book</a></li>
       @endif
       @if(menuAccess(Auth::user()->user_role,'126')== true)
         <li><a href="library/books/book_request"><i class="fa fa-circle-o"></i>Request Details</a></li>
       @endif
       @if(menuAccess(Auth::user()->user_role,'127')== true)
         <li @if(Request::path()=='library/bookissue/return') class="active" @endif><a href="{{url('library/bookissue/return')}}"><i class="fa fa-circle-o"></i>Book Return</a></li>
      @endif
      @if(menuAccess(Auth::user()->user_role,'128')== true)
           <li><a href=""><i class="fa fa-circle-o"></i>Report</a></li>
      @endif

        </ul>
     </li>

@endif

@if(menuAccess(Auth::user()->user_role,'1021')== true || menuAccess(Auth::user()->user_role,'40')==true
     || menuAccess(Auth::user()->user_role,'44')==true || menuAccess(Auth::user()->user_role,'49')==true
     || menuAccess(Auth::user()->user_role,'54')==true || menuAccess(Auth::user()->user_role,'29')==true
     || menuAccess(Auth::user()->user_role,'129')==true)

     <li  @if(Request::path()=='transport/vehicle' OR Request::path()=='transport/driver'OR Request::path()=='transport/route'
    OR Request::path()=='transport/destinatio'  OR Request::path()=='student/transport'  OR Request::path()=='transport/allocation/list' )class="treeview active" @endif class="treeview">

       <a href="#">
         <i class="fa fa-fw fa-bus"></i>
         <span>Transport</span>
         <span class="pull-right-container">
           <i class="fa fa-angle-left pull-right"></i>
         </span>
       </a>
       <ul class="treeview-menu">
       @if(menuAccess(Auth::user()->user_role,'40')== true)
         <li @if(Request::path()=='transport/vehicle') class="active" @endif><a href="{{url('transport/vehicle')}}"><i class="fa fa-circle-o"></i>Add Vechicle</a></li>
        @endif
        @if(menuAccess(Auth::user()->user_role,'44')== true)
         <li @if(Request::path()=='transport/driver') class="active" @endif><a href="{{url('transport/driver')}}"><i class="fa fa-circle-o"></i>Add Driver</a></li>
        @endif
        @if(menuAccess(Auth::user()->user_role,'49')== true)
          <li @if(Request::path()=='transport/route') class="active" @endif><a href="{{url('transport/route')}}"><i class="fa fa-circle-o"></i>Add Route</a></li>
        @endif
        @if(menuAccess(Auth::user()->user_role,'54')== true)
         <li @if(Request::path()=='transport/destination') class="active" @endif><a href="{{url('transport/destination')}}"><i class="fa fa-circle-o"></i>Add Destination</a></li>
        @endif
        @if(menuAccess(Auth::user()->user_role,'29')== true)
          <li @if(Request::path()=='student/transport') class="active" @endif><a href="{{url('student/transport')}}"><i class="fa fa-circle-o"></i>Tranport Allocation</a></li>
        @endif
        @if(menuAccess(Auth::user()->user_role,'129')== true)
           <li @if(Request::path()=='transport/allocation/list') class="active" @endif><a href="{{url('transport/allocation/list')}}"><i class="fa fa-circle-o"></i>Tranport Allocation List</a></li>
        @endif
        @if(menuAccess(Auth::user()->user_role,'129')== true)
          <li style="display:none;"><a href="{{url('userlist')}}"><i class="fa fa-circle-o"></i>Fee Collection</a></li>
        @endif
        @if(menuAccess(Auth::user()->user_role,'129')== true)
          <li style="display:none;"><a href="{{url('userlist')}}"><i class="fa fa-circle-o"></i>Import</a></li>
        @endif
        @if(menuAccess(Auth::user()->user_role,'129')== true)
          <li style="display:none;"><a href="{{url('userlist')}}"><i class="fa fa-circle-o"></i>SMS Alert</a></li>
        @endif
        @if(menuAccess(Auth::user()->user_role,'129')== true)
          <li style="display:none;"><a href="{{url('userlist')}}"><i class="fa fa-circle-o"></i>Report</a></li>
        @endif
        </ul>
     </li>

@endif
@if(menuAccess(Auth::user()->user_role,'1022')== true || menuAccess(Auth::user()->user_role,'130')==true
     || menuAccess(Auth::user()->user_role,'131')==true || menuAccess(Auth::user()->user_role,'132')==true
     || menuAccess(Auth::user()->user_role,'133')==true || menuAccess(Auth::user()->user_role,'134')==true
     || menuAccess(Auth::user()->user_role,'135')==true || menuAccess(Auth::user()->user_role,'136')==true
     || menuAccess(Auth::user()->user_role,'137')==true || menuAccess(Auth::user()->user_role,'138')==true
     || menuAccess(Auth::user()->user_role,'139')==true || menuAccess(Auth::user()->user_role,'140')==true
     || menuAccess(Auth::user()->user_role,'141')==true || menuAccess(Auth::user()->user_role,'142')==true
     || menuAccess(Auth::user()->user_role,'143')==true)

      <li  @if(Request::path()=='hostel/details' OR Request::path()=='hostel/room'OR Request::path()=='hostel/allocation'
    OR Request::path()=='hostel/request/details' OR Request::path()=='hostel/transfer/vacate' OR Request::path()=='hostel/register' OR Request::path()=='hostel/visitors'
    OR Request::path()=='hostel/fee/collection' OR Request::path()=='hostel/details/report' OR Request::path()=='hostel/room/availability/repor'OR Request::path()=='hostel/room/request/report'
    OR Request::path()=='hostel/room/occupancy/report'  OR Request::path()=='hostel/room/availability/report'  OR Request::path()=='hostel/fee/reports')class="treeview active" @endif class="treeview">

      <a href="#">
        <i class="fa fa-fw fa-home"></i>
        <span>Hostel</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
      @if(menuAccess(Auth::user()->user_role,'130')== true)
        <li  @if(Request::path()== 'hostel/details') class="active" @endif><a href="{{url('hostel/details')}}"><i class="fa fa-circle-o"></i> Hostel Details</a></li>
      @endif
      @if(menuAccess(Auth::user()->user_role,'131')== true)
        <li  @if(Request::path()== 'hostel/room') class="active" @endif><a href="{{url('hostel/room')}}"><i class="fa fa-circle-o"></i>Hostel Room </a></li>
      @endif
      @if(menuAccess(Auth::user()->user_role,'132')== true)
        <li  @if(Request::path()== 'hostel/allocation') class="active" @endif><a href="{{url('hostel/allocation')}}"><i class="fa fa-circle-o"></i> Hostel Allocation</a></li>
      @endif
      @if(menuAccess(Auth::user()->user_role,'134')== true)
        <li  @if(Request::path()== 'hostel/request/details') class="active" @endif><a href="{{url('hostel/request/details')}}"><i class="fa fa-circle-o"></i>Request Details</a></li>
      @endif
      @if(menuAccess(Auth::user()->user_role,'135')== true)
        <li  @if(Request::path()== 'hostel/transfer/vacate') class="active" @endif><a href="{{url('hostel/transfer/vacate')}}"><i class="fa fa-circle-o"></i>Hostel Transfer/Vacate</a></li>
      @endif
      @if(menuAccess(Auth::user()->user_role,'136')== true)
        <li  @if(Request::path()== 'hostel/register') class="active" @endif><a href="{{url('hostel/register')}}"><i class="fa fa-circle-o"></i>Hostel Register</a></li>
      @endif
      @if(menuAccess(Auth::user()->user_role,'137')== true)
        <li  @if(Request::path()== 'hostel/visitors') class="active" @endif ><a href="{{url('hostel/visitors')}}"><i class="fa fa-circle-o"></i>Hostel Visitors</a></li>
      @endif
      @if(menuAccess(Auth::user()->user_role,'138')== true)
         <li style="display:none;"  @if(Request::path()== 'hostel/fee/collection') class="active" @endif><a href="{{url('hostel/fee/collection')}}"><i class="fa fa-circle-o"></i>Hostel Fee Collection</a></li>
      @endif

      @if(menuAccess(Auth::user()->user_role,'139')== true || menuAccess(Auth::user()->user_role,'140')==true
     || menuAccess(Auth::user()->user_role,'141')==true || menuAccess(Auth::user()->user_role,'142')==true
     || menuAccess(Auth::user()->user_role,'143')==true)

    <li  @if(Request::path()=='hostel/details/report' OR Request::path()=='hostel/room/availability/repor'OR Request::path()=='hostel/room/request/report'
    OR Request::path()=='hostel/room/occupancy/report' OR Request::path()=='hostel/room/availability/report' OR Request::path()=='hostel/fee/reports' )class="treeview active" @endif class="treeview">

           <a href="#"><i class="fa fa-circle-o"></i> Report
             <span class="pull-right-container">
               <i class="fa fa-angle-left pull-right"></i>
             </span>
           </a>
           <ul class="treeview-menu">
           @if(menuAccess(Auth::user()->user_role,'139')== true)
             <li  @if(Request::path()== 'hostel/details/report') class="active" @endif><a href=" {{url('hostel/details/report')}}"><i class="fa fa-circle-o"></i> Hostel Details Report</a></li>
           @endif
           @if(menuAccess(Auth::user()->user_role,'140')== true)
             <li  @if(Request::path()== 'hostel/room/availability/report') class="active" @endif><a href="{{url('hostel/room/availability/report')}}"><i class="fa fa-circle-o"></i> Room Availibility Report</a></li>
           @endif
           @if(menuAccess(Auth::user()->user_role,'141')== true)
             <li style="display:none;"   @if(Request::path()== 'hostel/room/request/report') class="active" @endif><a href="{{url('hostel/room/request/report')}}"><i class="fa fa-circle-o"></i> Room Request Report</a></li>
           @endif
           @if(menuAccess(Auth::user()->user_role,'142')== true)
             <li style="display:none;"  @if(Request::path()== 'hostel/room/occupancy/report') class="active" @endif><a href="{{url('hostel/room/occupancy/report')}}"><i class="fa fa-circle-o"></i> Room Occupancy Report</a></li>
           @endif

           </ul>
         </li>
         @endif
       </ul>
    </li>
  @endif

  @if(menuAccess(Auth::user()->user_role,'1023')== true || menuAccess(Auth::user()->user_role,'144')==true
     || menuAccess(Auth::user()->user_role,'144')==true || menuAccess(Auth::user()->user_role,'146')==true
     || menuAccess(Auth::user()->user_role,'147')==true || menuAccess(Auth::user()->user_role,'148')==true
     || menuAccess(Auth::user()->user_role,'149')==true)

    <li @if(Request::path()=='stock/issue_item' OR Request::path()=='stock/add_issue_item' OR Request::path()=='stock/add_item_stock' OR Request::path()=='stock/add_item' OR Request::path()=='stock/item_category' OR Request::path()=='stock/item_store' OR Request::path()=='stock/item_supplier'
    OR Request::path()=='userlist')class="treeview active" @endif class="treeview">
         <a href="#">
           <i class="fa fa-suitcase"></i>
           <span>Stock</span>
           <span class="pull-right-container">
             <i class="fa fa-angle-left pull-right"></i>
           </span>
         </a>
         <ul class="treeview-menu">
         @if(menuAccess(Auth::user()->user_role,'144')== true)
            <li @if(Request::path()== 'stock/issue_item' OR Request::path()=='stock/add_issue_item')class="active" @endif><a href="{{url('stock/issue_item')}}"><i class="fa fa-circle-o"></i> Issue Item</a></li>
         @endif
         @if(menuAccess(Auth::user()->user_role,'145')== true)
          <li @if(Request::path()== 'stock/add_item_stock')class="active" @endif><a href="{{url('stock/add_item_stock')}}"><i class="fa fa-circle-o"></i>Add Item Stock</a></li>
         @endif
         @if(menuAccess(Auth::user()->user_role,'146')== true)
           <li @if(Request::path()== 'stock/add_item')class="active" @endif><a href="{{url('stock/add_item')}}"><i class="fa fa-circle-o"></i> Add  Item </a></li>
         @endif
         @if(menuAccess(Auth::user()->user_role,'147')== true)
           <li @if(Request::path()== 'stock/item_category')class="active" @endif><a href="{{url('stock/item_category')}}"><i class="fa fa-circle-o"></i>Item Category</a></li>
         @endif
         @if(menuAccess(Auth::user()->user_role,'148')== true)
           <li @if(Request::path()== 'stock/item_store')class="active" @endif><a href="{{url('stock/item_store')}}"><i class="fa fa-circle-o"></i>Item Store</a></li>
         @endif
         @if(menuAccess(Auth::user()->user_role,'149')== true)
           <li @if(Request::path()== 'stock/item_supplier')class="active" @endif><a href="{{url('stock/item_supplier')}}"><i class="fa fa-circle-o"></i>Item Supplier</a></li>
          @endif
          </ul>
       </li>
    @endif
  <!-- Event Menu -->
       @if(menuAccess(Auth::user()->user_role,'1004')== true || menuAccess(Auth::user()->user_role,'72')==true
     || menuAccess(Auth::user()->user_role,'73')==true || menuAccess(Auth::user()->user_role,'74')==true
     || menuAccess(Auth::user()->user_role,'75')==true || menuAccess(Auth::user()->user_role,'76')==true
     || menuAccess(Auth::user()->user_role,'77')==true || menuAccess(Auth::user()->user_role,'78')==true)

        <li @if(Request::path()=='FrontOffice/admission_enquiry' OR Request::path()=='FrontOffice/visitor_book' OR Request::path()=='FrontOffice/phone_call' OR Request::path()=='FrontOffice/postal_dispatch' OR Request::path()=='FrontOffice/postal_recieve' OR Request::path()=='FrontOffice/complain'  OR Request::path()=='FrontOffice/office_setup'
    OR Request::path()=='userlist')class="treeview active" @endif class="treeview">
         <a href="#">
           <i class="fa fa-ioxhost"></i>
           <span>Event</span>
           <span class="pull-right-container">
             <i class="fa fa-angle-left pull-right"></i>
           </span>
         </a>

         <ul class="treeview-menu">
         @if(menuAccess(Auth::user()->user_role,'72')== true)
          <li class="active"><a href="{{url('event/')}}"><i class="fa fa-circle-o"></i>Event Type List</a></li>
          <li class="active"><a href="{{url('assignevent/')}}"><i class="fa fa-circle-o"></i>Event List</a></li>
          <li class="active"><a href="{{url('report/')}}"><i class="fa fa-circle-o"></i>Event Report</a></li>
         @endif
          </ul>
       </li>
      @endif
      
   @if(menuAccess(Auth::user()->user_role,'1024')== true)
    <li @if(Request::path()=='feedback')class="treeview active" @endif class="treeview">
     <a href="#">
       <i class="fa fa-rss"></i>
       <span>Id Card</span>
       <span class="pull-right-container">
         <i class="fa fa-angle-left pull-right"></i>
       </span>
     </a>
     <ul class="treeview-menu">
       <li @if(Request::path()== 'feedback')class="active" @endif><a href="{{url('search/upload')}}"><i class="fa fa-circle-o"></i> Upload Photo</a></li>
     <li @if(Request::path()== 'feedback')class="active" @endif><a href="{{url('search/print')}}"><i class="fa fa-circle-o"></i> Print Id Card</a></li>
     </ul>
   </li>
   @endif
   
   @if(menuAccess(Auth::user()->user_role,'1024')== true)
    <li @if(Request::path()=='feedback')class="treeview active" @endif class="treeview">
     <a href="#">
       <i class="fa fa-rss"></i>
       <span>Student Report Card</span>
       <span class="pull-right-container">
         <i class="fa fa-angle-left pull-right"></i>
       </span>
     </a>
     <ul class="treeview-menu">
       <li @if(Request::path()== 'feedback')class="active" @endif><a href="{{url('search/student/card')}}"><i class="fa fa-circle-o"></i>Print All Report</a></li>
     </ul>
   </li>
   @endif
    @if(menuAccess(Auth::user()->user_role,'1024')== true)
    <li @if(Request::path()=='feedback')class="treeview active" @endif class="treeview">
     <a href="#">
       <i class="fa fa-rss"></i>
       <span>Complaint/Feedback</span>
       <span class="pull-right-container">
         <i class="fa fa-angle-left pull-right"></i>
       </span>
     </a>
     <ul class="treeview-menu">
       <li @if(Request::path()== 'feedback')class="active" @endif><a href="{{url('feedback')}}"><i class="fa fa-circle-o"></i> Complaint/Feedback List</a></li>
     </ul>
   </li>
   @endif
   <li style="display:none;" @if(Request::path()== 'Password/change_password')class="active" @endif><a href="{{url('Password/change_password')}}"><i class="fa fa-circle-o"></i> Change Password</a></li>

    </ul>
   </section>
   <!-- /.sidebar -->
 </aside>


   {{--Content File Start Here--}}

   @yield('content')
   </div>
@include('theam')

   {{--Content File End Here--}}

       <input type="hidden" id="_url" value="{{url('/')}}">
 <input type="hidden" id="_DatePicker" value="">
<script src="{{ URL::asset('assets/bower_components/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/jquery-ui/jquery-ui.min.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/jquery/dist/jquery.validate.min.js') }}"></script>

<script src="{{ URL::asset('assets/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/raphael/raphael.min.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/morris.js/morris.min.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/jquery-knob/dist/jquery.knob.min.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/moment/min/moment.min.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/fastclick/lib/fastclick.js') }}"></script>
<script src="{{ URL::asset('assets/dist/js/adminlte.min.js') }}"></script>
<script src="{{ URL::asset('assets/dist/js/pages/dashboard.js') }}"></script>
<script src="{{ URL::asset('assets/dist/js/demo.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/jquery/dist/bootbox.min.js') }}"></script>

<script>
   $.ajaxSetup({
       headers: {
           'X-CSRF-Token': $('input[name="_token"]').val()
       }
   });
</script>
<!--live chat script here-->
{{--Custom JavaScript Start--}}

@yield('script')

{{--Custom JavaScript End Here--}}
</div>
        </body>

</html>
