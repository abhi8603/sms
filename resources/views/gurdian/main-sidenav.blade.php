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
    <li @if(Request::path()=='parentwelcome' OR Request::path()=='parents/ward/view/.session()->get("wardregno")') class="treeview active" @endif class="treeview">
      <a href="#">
        <i class="fa fa-dashboard"></i>
        <span>Dashboard</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li @if(Request::path()== 'create-Institution')class="active" @endif><a href="{{url('parentwelcome')}}"><i class="fa fa-circle-o"></i>Home</a></li>
        <li @if(Request::path()== 'Academic-Details')class="active" @endif><a href="{{url('parents/ward/view/'.Crypt::encrypt(session()->get('wardregno')))}}"><i class="fa fa-circle-o"></i>Dashboard</a></li>
             </ul>
    </li>
      <li>
       <a href="{{url('parents/ward/exam/announcement')}}">
         <i class="fa fa-bullhorn"></i> <span>Announcement</span>
       </a>
     </li>
    <li  @if(Request::path()=='parents/ward/lesson/lesson_plane') class="treeview active" @endif class="treeview">
      <a href="#">
        <i class="fa fa-dashboard"></i>
        <span>Academic</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li  @if(Request::path()== 'parents/ward/lesson/lesson_plane')class="active" @endif><a href="{{url('parents/ward/lesson/lesson_plane')}}"><i class="fa fa-circle-o"></i>Lession Plan</a></li>
         <li style="display:none;" @if(Request::path()== 'parents/ward/exam/exam_hall_arrangement')class="active" @endif><a href="{{url('parents/ward/exam/exam_hall_arrangement')}}"><i class="fa fa-circle-o"></i>Exams Hall arrengment</a></li>
        <li style="display:none;" @if(Request::path()== 'Academic-Details')class="active" @endif><a href="{{url('')}}"><i class="fa fa-circle-o"></i>Exams</a></li>
        <li style="display:none;" @if(Request::path()== 'parents/ward/timetable/daily_timetable')class="active" @endif><a href="{{url('parents/ward/timetable/daily_timetable')}}"><i class="fa fa-circle-o"></i>Time Table</a></li>

       </ul>
    </li>
    <li @if(Request::path()=='parents/ward/feepaid/list' OR Request::path()=='parents/ward/fee/payonline') class="treeview active" @endif class="treeview">
      <a href="#">
        <i class="fa fa-inr" aria-hidden="true"></i>
        <span>Fee</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li @if(Request::path()== 'parents/ward/feepaid/list')class="active" @endif><a href="{{url('parents/ward/feepaid/list')}}"><i class="fa fa-circle-o"></i>Fee Details</a></li>
                <li @if(Request::path()== 'parents/ward/fee/payonline')class="active" @endif><a href="{{url('parents/ward/fee/payonline')}}"><i class="fa fa-circle-o"></i>Pay Online</a></li>
       </ul>
    </li>
    <li @if(Request::path()== 'parents/ward/attendance/report')class="active" @endif>
    <a href="{{url('parents/ward/attendance/report')}}">
      <i class="fa fa-calendar" aria-hidden="true"></i> <span>Attendance</span>
    </a>
  </li>
		 
		   <li @if(Request::path()== 'parents/ward/CurricularCertificate')class="active" @endif>
    <a href="{{url('parents/ward/CurricularCertificate')}}">
      <i class="fa fa-certificate" aria-hidden="true"></i> <span>Curricular Certificate</span>
    </a>
  </li>
  <li  @if(Request::path()== 'parents/ward/exam/result')class="active" @endif>
    <a href="{{url('parents/ward/exam/result')}}">
      <i class="fa fa-user" aria-hidden="true"></i> <span>Exam Result</span>
    </a>
  </li>
  <li @if(Request::path()=='parents/ward/homework/homework') class="treeview active" @endif class="treeview">
      <a href="#">
        <i class="fa fa-book" aria-hidden="true"></i>
        <span>Home Work</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li @if(Request::path()== 'parents/ward/homework/homework')class="active" @endif><a href="{{url('parents/ward/homework/homework')}}"><i class="fa fa-circle-o"></i>Home Work</a></li>
    <!--    <li @if(Request::path()== 'parents/ward/homework/homework_report')class="active" @endif><a href="{{url('parents/ward/homework/homework_report')}}"><i class="fa fa-circle-o"></i>Home Work Report</a></li>
        <li @if(Request::path()== 'parents/ward/homework/assignment')class="active" @endif><a href="{{url('parents/ward/homework/assignment')}}"><i class="fa fa-circle-o"></i>Assignment</a></li>
        <li @if(Request::path()== 'parents/ward/homework/assignment_report')class="active" @endif><a href="{{url('parents/ward/homework/assignment_report')}}"><i class="fa fa-circle-o"></i>Assignment Report</a></li>
-->
       </ul>
    </li>
    <li @if(Request::path()== 'parents/ward/leave/apply')class="active" @endif class="treeview" >
      <a href="#">
        <i class="fa fa-comment" aria-hidden="true"></i>
        <span>Leave Management</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li @if(Request::path()== 'parents/ward/leave/apply')class="active" @endif><a href="{{url('parents/ward/leave/apply')}}"><i class="fa fa-circle-o"></i>Leave Application</a></li>
       </ul>
    </li>
    <li @if(Request::path()== 'parents/ward/feedback')class="active" @endif class="treeview" >
      <a href="#">
        <i class="fa fa-rss" aria-hidden="true"></i>
        <span>Complaint/Feedback</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li @if(Request::path()== 'parents/ward/feedback')class="active" @endif><a href="{{url('parents/ward/feedback')}}"><i class="fa fa-circle-o"></i>Complaint/Feedback</a></li>
       </ul>
    </li>
    <ul>
   </section>
   <!-- /.sidebar -->
 </aside>


   {{--Content File Start Here--}}

   @yield('content')
   </div>
@include('gurdian.theam')

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
