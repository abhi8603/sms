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
    <li @if(Request::path()=='studentwelcome') class="treeview active" @endif class="treeview">
      <a href="#">
        <i class="fa fa-dashboard"></i>
        <span>Dashboard</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
    </li>
      <li >
       <a href="{{url('student/announcement')}}">
         <i class="fa fa-bullhorn"></i> <span>Announcement</span>
       </a>
     </li>
    <li class="treeview">
      <a href="#">
        <i class="fa fa-dashboard"></i>
        <span>Academic</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li @if(Request::path()== 'student/lesson/lesson_plan')class="active" @endif><a href="{{url('student/lesson/lesson_plan')}}"><i class="fa fa-circle-o"></i>Lession Plan</a></li>
         <li style="display:none;" @if(Request::path()== 'student/exam/exam_hall_arrangement')class="active" @endif><a href="{{url('student/exam/exam_hall_arrangement')}}"><i class="fa fa-circle-o"></i>Exams Hall arrengment</a></li>
        <li style="display:none;" @if(Request::path()== 'Academic-Details')class="active" @endif><a href="{{url('')}}"><i class="fa fa-circle-o"></i>Exams</a></li>
        <li style="display:none;" @if(Request::path()== 'student/timetable/daily_timetable')class="active" @endif><a href="{{url('student/timetable/daily_timetable')}}"><i class="fa fa-circle-o"></i>Time Table</a></li>
    <li @if(Request::path()== 'student/online/classes')class="active" @endif><a href="{{url('student/online/classes')}}"><i class="fa fa-circle-o"></i>Online Classes</a></li>

       </ul>
    </li>
   <li style="display:none;" @if(Request::path()== 'student/attendance/report')class="active" @endif>
    <a href="{{url('student/attendance/report')}}">
      <i class="fa fa-calendar" aria-hidden="true"></i> <span>Attendance</span>
    </a>
  </li>
  <li @if(Request::path()=='student/homework/homework') class="treeview active" @endif class="treeview">
      <a href="#">
        <i class="fa fa-book" aria-hidden="true"></i>
        <span>HomeWork</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li @if(Request::path()== 'student/homework/homework')class="active" @endif><a href="{{url('student/homework/homework')}}"><i class="fa fa-circle-o"></i>HomeWork</a></li>
     </ul>
    </li>
    <li style="display:none;" @if(Request::path()== 'student/leave/apply')class="active" @endif class="treeview" >
      <a href="#">
        <i class="fa fa-comment" aria-hidden="true"></i>
        <span>Leave Management</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li style="display:none;" @if(Request::path()== 'student/leave/apply')class="active" @endif><a href="{{url('student/leave/apply')}}"><i class="fa fa-circle-o"></i>Leave Application</a></li>
       </ul>
    </li>
    <li style="display:none;" @if(Request::path()== 'student/feedback')class="active" @endif class="treeview" >
      <a href="#">
        <i class="fa fa-rss" aria-hidden="true"></i>
        <span>Complaint/Feedback</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul style="display:none;" class="treeview-menu">
        <li  @if(Request::path()== 'student/feedback')class="active" @endif><a href="{{url('student/feedback')}}"><i class="fa fa-circle-o"></i>Complaint/Feedback</a></li>
       </ul>
    </li>
    <ul>
   </section>
   <!-- /.sidebar -->
 </aside>


   {{--Content File Start Here--}}

   @yield('content')
   </div>
@include('stu_panel.theam')

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
