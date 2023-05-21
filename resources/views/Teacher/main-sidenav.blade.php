<aside class="main-sidebar">
   <!-- sidebar: style can be found in sidebar.less -->
   <section class="sidebar">
     <!-- Sidebar user panel -->
     <div class="user-panel">
       <div class="pull-left image">
       <span class="logo-mini"><img src="<?php echo asset(app_config('AppLogo',Auth::user()->school_id)); ?>" style="height: 39px;" /></span>
       </div>
       <div class="pull-left info">
         <p>{{ Auth::user()->school_name }}</p>
         <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
       </div>
     </div>
     <!-- search form -->

     <!-- /.search form -->
     <!-- sidebar menu: : style can be found in sidebar.less -->
     <ul class="sidebar-menu" data-widget="tree">
       <li class="header">MAIN NAVIGATION</li>
   <li>
       <a href="{{url('teacherwelcome')}}">
         <i class="fa fa-dashboard"></i> <span>Dashboard</span>
       </a>
     </li>
     <li @if(Request::path()=='teacher/student_attendance') class="treeview active" @endif>
       <a href="{{url('teacher/student_attendance')}}">
         <i class="fa fa-calendar"></i> <span>Attendance</span>
       </a>
     </li>
     <li  @if(Request::path()=='teacher/lession-planning') class="treeview active" @endif >
       <a href="{{url('teacher/lession-planning')}}">
         <i class="fa fa-calendar"></i> <span>Lession Planning</span>
       </a>
     </li>

      <li style="display:none;" @if(Request::path()=='teacher/student_attendance' OR Request::path()=='teacher/student_attendance_report' 
    OR Request::path()=='userlist')class="treeview active" @endif class="treeview">
         <a href="#">
           <i class="fa fa-book"></i>
           <span>Attendance</span>
           <span class="pull-right-container">
             <i class="fa fa-angle-left pull-right"></i>
           </span>
         </a>
         <ul class="treeview-menu">
           <li @if(Request::path()== 'teacher/student_attendance') class="active" @endif><a href="{{url('teacher/student_attendance')}}"><i class="fa fa-circle-o"></i>Student Attendance</a></li>
    <li @if(Request::path()== 'teacher/student_attendance_report') class="active" @endif><a href="{{url('teacher/student_attendance_report')}}"><i class="fa fa-circle-o"></i>Attendance Report</a></li>
         
             
          
          </ul>
       </li>
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
           <li @if(Request::path()== 'homework/homeworklist') class="active" @endif><a href="{{url('homework/homeworklist')}}"><i class="fa fa-circle-o"></i>Add Homework</a></li>
    <li @if(Request::path()== 'homework/evaluation_report') class="active" @endif><a href="{{url('homework/evaluation_report')}}"><i class="fa fa-circle-o"></i>Evaluation Report</a></li>
         
             
          
          </ul>
       </li>
            <li @if(Request::path()=='teacher/teacher_subject' OR Request::path()=='teacher/give_assignment' OR Request::path()=='teacher/assignment_report' 
    OR Request::path()=='userlist')class="treeview active" @endif class="treeview">
         <a href="#">
           <i class="fa fa-book"></i>
           <span>Subject</span>
           <span class="pull-right-container">
             <i class="fa fa-angle-left pull-right"></i>
           </span>
         </a>
         <ul class="treeview-menu">
           <li @if(Request::path()== 'teacher/teacher_subject') class="active" @endif><a href="{{url('teacher/teacher_subject')}}"><i class="fa fa-circle-o"></i> Subject</a></li>
    <li @if(Request::path()== 'teacher/give_assignment') class="active" @endif><a href="{{url('teacher/give_assignment')}}"><i class="fa fa-circle-o"></i> Give Assignment </a></li>
     <li @if(Request::path()== 'teacher/assignmentlist') class="active" @endif><a href="{{url('teacher/assignmentlist')}}"><i class="fa fa-circle-o"></i>Evaluate Assignment </a></li>
      <li @if(Request::path()== 'teacher/assignment_report') class="active" @endif><a href="{{url('teacher/assignment_report')}}"><i class="fa fa-circle-o"></i> Assignment Report </a></li>
          </ul>
       </li>
      <!--  <Exam> -->
        <li @if(Request::path()=='teacher/teacher_subject' OR Request::path()=='teacher/give_assignment' OR Request::path()=='teacher/assignment_report' 
    OR Request::path()=='userlist')class="treeview active" @endif class="treeview">
         <a href="#">
           <i class="fa fa-book"></i>
           <span>Exam</span>
           <span class="pull-right-container">
             <i class="fa fa-angle-left pull-right"></i>
           </span>
         </a>
         <ul class="treeview-menu">
           <li @if(Request::path()== 'teacher/set_marks') class="active" @endif><a href="{{url('teacher/set_marks')}}"><i class="fa fa-circle-o"></i> Create Marks</a></li>
  <li @if(Request::path()== 'teacher/view_marks') class="active" @endif><a href="{{url('teacher/view_marks')}}"><i class="fa fa-circle-o"></i> View Marks </a></li>
          </ul>
       </li>
    <ul>
   </section>
   <!-- /.sidebar -->
 </aside>


   {{--Content File Start Here--}}

   @yield('content')
   </div>
@include('Teacher.theam')

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
