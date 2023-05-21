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
        <a href="{{url('welcome')}}">
          <i class="fa fa-dashboard"></i> <span>Dashboard</span>
        </a>
      </li>
         <li @if(Request::path()== 'create-Institution' OR Request::path()== 'Academic-Details' OR Request::path()== 'setting/branch') class="treeview active" @endif class="treeview ">
          <a href="#">
            <i class="fa fa-fw fa-bars"></i>
            <span>Setting</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li @if(Request::path()== 'create-Institution') class="active" @endif><a href="{{url('create-Institution')}}"><i class="fa fa-circle-o"></i> Institution Details</a></li>
            <li @if(Request::path()== 'Academic-Details') class="active" @endif><a href="{{url('Academic-Details')}}"><i class="fa fa-circle-o"></i>Academic Details</a></li>
              <li @if(Request::path()== 'setting/branch') class="active" @endif><a href="{{url('setting/branch')}}"><i class="fa fa-circle-o"></i>Add Branch</a></li>
            <li style="display:none;"><a href="{{url('userlist')}}"><i class="fa fa-circle-o"></i> Student Import</a></li>
           </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-fw fa-group"></i> <span>Academic</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">

            <li class="treeview">
              <a href="#"><i class="fa fa-fw fa-book"></i> Course & Batch
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{url('add-course')}}"><i class="fa fa-circle-o"></i>Course</a></li>
                <li><a href="{{url('add-batch')}}"><i class="fa fa-circle-o"></i>Batch</a></li>
                <li><a href="{{url('classTeacher-Allocation')}}"><i class="fa fa-circle-o"></i>Class Teacher Allocation</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#"><i class="fa fa-fw fa-book"></i>Subject
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{url('subject/create')}}"><i class="fa fa-circle-o"></i>Subject</a></li>
                <li><a href="{{url('subject/assign-subject')}}"><i class="fa fa-circle-o"></i>Assign Subject</a></li>
                <li><a href="{{url('subject/subject-allocation')}}"><i class="fa fa-circle-o"></i>Subject Allocation</a></li>
                <li><a href="{{url('subject/lession-planning')}}"><i class="fa fa-circle-o"></i>Elective Subject</a></li>
                <li><a href="{{url('classTeacher-Allocation')}}"><i class="fa fa-circle-o"></i>Subject Allocation Import</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#"><i class="fa fa-fw fa-book"></i> Lession Planning
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{url('subject/lession-planning')}}"><i class="fa fa-circle-o"></i>Lession Planning</a></li>
              </ul>
            </li>
            <li class="treeview" style="display:none;">
              <a href="#"><i class="fa fa-fw fa-calendar-times-o"></i>Time Table
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="#"><i class="fa fa-circle-o"></i>Set Time Table</a></li>
                <li><a href="#"><i class="fa fa-circle-o"></i>Active Timee Table</a></li>
                <li><a href="#"><i class="fa fa-circle-o"></i>View Batch Timetable</a></li>
                <li><a href="#"><i class="fa fa-circle-o"></i>View Teacher Timetable</a></li>
                <li><a href="#"><i class="fa fa-circle-o"></i>Teachers Working Hours</a></li>
                <li><a href="#"><i class="fa fa-circle-o"></i>Time Table Export</a></li>
                <li><a href="#"><i class="fa fa-circle-o"></i>Time Table Import</a></li>
              </ul>
            </li>
            <li class="treeview" style="display:none;">
              <a href="#"><i class="fa fa-fw fa-book"></i>Assignment & Notes
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="#"><i class="fa fa-circle-o"></i>Add Assignment</a></li>
                <li><a href="#"><i class="fa fa-circle-o"></i>Add Notes</a></li>
                <li><a href="#"><i class="fa fa-circle-o"></i>Assignment Import</a></li>

              </ul>
            </li>
            <li class="treeview" style="display:none;">
              <a href="#"><i class="fa fa-fw fa-certificate"></i>Certification
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="#"><i class="fa fa-circle-o"></i>Certification Type</a></li>
                <li><a href="#"><i class="fa fa-circle-o"></i>Custom Certification</a></li>
                <li><a href="#"><i class="fa fa-circle-o"></i>Generate Certification</a></li>

              </ul>
            </li>
            <li class="treeview" style="display:none;">
              <a href="#"><i class="fa fa-fw fa-check-circle"></i>Circular
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="#"><i class="fa fa-circle-o"></i>Circular</a></li>
              </ul>
            </li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-fw fa-child"></i> <span>HR/Payroll</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="treeview">
              <a href="#"><i class="fa fa-fw fa-group"></i> Employee Management
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{url('hr/add-userType')}}"><i class="fa fa-circle-o"></i>Add User Type</a></li>
                <li><a href="{{url('hr/department')}}"><i class="fa fa-circle-o"></i>Add Department</a></li>
                <li><a href="{{url('hr/designation')}}"><i class="fa fa-circle-o"></i>Add Designation</a></li>
                <li><a href="{{url('hr/employee')}}"><i class="fa fa-circle-o"></i>Add Employee</a></li>
                <li><a href="{{url('hr/employee/list')}}"><i class="fa fa-circle-o"></i>Employee List</a></li>
                <li><a href="{{url('hr/add-userType')}}"><i class="fa fa-circle-o"></i>Add Bank Details</a></li>
                <li><a href="{{url('hr/add-userType')}}"><i class="fa fa-circle-o"></i>Print List</a></li>
                <li><a href="{{url('hr/add-userType')}}"><i class="fa fa-circle-o"></i>Employee Attendance import</a></li>
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
            <li class="treeview" style="display:none;">
              <a href="#"><i class="fa fa-fw fa-refresh"></i> Leave Management
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="#"><i class="fa fa-circle-o"></i>Leave Category</a></li>
                <li><a href="#"><i class="fa fa-circle-o"></i>Leave Details</a></li>
                <li><a href="#"><i class="fa fa-circle-o"></i>Leave Application</a></li>
                <li><a href="#"><i class="fa fa-circle-o"></i>Leave Approvels</a></li>
                <li><a href="#"><i class="fa fa-circle-o"></i>OD Approvels</a></li>
              </ul>
            </li>


            <li class="active treeview" style="display:none;">
             <a href="{{url('home')}}">
               <i class="fa fa-dashboard"></i> <span>Attendance</span>

             </a>
           </li>

          </ul>
        </li>
        <li class="treeview">
         <a href="#">
           <i class="fa fa-fw fa-user"></i>
           <span>Student</span>
           <span class="pull-right-container">
             <i class="fa fa-angle-left pull-right"></i>
           </span>
         </a>
         <ul class="treeview-menu">
           <li><a href="{{url('student/category')}}"><i class="fa fa-circle-o"></i> Student Category</a></li>
           <li><a href="{{url('student/admission')}}"><i class="fa fa-circle-o"></i>Student Admission</a></li>
           <li><a href="{{url('student/list')}}"><i class="fa fa-circle-o"></i> Student List</a></li>
           <li><a href="{{url('student/attendance')}}"><i class="fa fa-circle-o"></i>Attendance</a></li>
           <li><a href="{{url('student/attendance/attendancereport')}}"><i class="fa fa-circle-o"></i>Attendance Report</a></li>
           <li><a href="{{url('student/transport')}}"><i class="fa fa-circle-o"></i>Tranport Allocation</a></li>
           <li><a href="{{url('')}}"><i class="fa fa-circle-o"></i>Hostel Allocation</a></li>
           <li><a href="{{url('userlist')}}"><i class="fa fa-circle-o"></i>Print List</a></li>
            <li><a href="{{url('userlist')}}"><i class="fa fa-circle-o"></i>Gaurdian List</a></li>
            <li><a href="{{url('userlist')}}"><i class="fa fa-circle-o"></i>Roll Number</a></li>
            <li><a href="{{url('userlist')}}"><i class="fa fa-circle-o"></i>Student Attendance import</a></li>
            <li><a href="{{url('userlist')}}"><i class="fa fa-circle-o"></i>Student Gate Pass</a></li>
            <li><a href="{{url('userlist')}}"><i class="fa fa-circle-o"></i>Student ID Card</a></li>

          </ul>
       </li>

       <li class="treeview">
         <a href="#">
           <i class="fa fa-fw fa-child"></i> <span>Finance</span>
           <span class="pull-right-container">
             <i class="fa fa-angle-left pull-right"></i>
           </span>
         </a>
         <ul class="treeview-menu">


           <li class="treeview">
             <a href="#"><i class="fa fa-fw fa-rupee"></i>Fee
               <span class="pull-right-container">
                 <i class="fa fa-angle-left pull-right"></i>
               </span>
             </a>
             <ul class="treeview-menu">
               <li><a href="{{url('finance/Fee-Category')}}"><i class="fa fa-circle-o"></i>Fee Category</a></li>
               <li><a href="{{url('finance/Fee-SubCategory')}}"><i class="fa fa-circle-o"></i>Fee Sub-Category </a></li>
               <li><a href="{{url('finance/Fee-SubCategory/fine')}}"><i class="fa fa-circle-o"></i>Fee Sub-Category Fine</a></li>
                <li><a href="{{url('finance/Fee-master')}}"><i class="fa fa-circle-o"></i>Fee Master</a></li>
               <li style="display:none;"><a href="#"><i class="fa fa-circle-o"></i>Fee Wavier</a></li>
               <li style="display:none;"><a href="#"><i class="fa fa-circle-o"></i>Fee Template</a></li>
               <li style="display:none;"><a href="#"><i class="fa fa-circle-o"></i>Fee Allocation</a></li>
               <li><a href="{{url('finance/Fee/fee-Collection')}}"><i class="fa fa-circle-o"></i>Fee Collection</a></li>
               <li><a href="{{url('finance/Fee/feeCollection/list')}}"><i class="fa fa-circle-o"></i>Fee Collection List</a></li>
               <li style="display:none;"><a href="#"><i class="fa fa-circle-o"></i>Quick Payment</a></li>
               <li><a href="{{url('finance/Fee-collection/reports')}}"><i class="fa fa-circle-o"></i>Report</a></li>
                              <li><a href="{{url('finance/Fee/duereport')}}"><i class="fa fa-circle-o"></i>Fee Due Report</a></li>
               <li style="display:none;"><a href="#"><i class="fa fa-circle-o"></i>Fee Import</a></li>
               <li style="display:none;"><a href="#"><i class="fa fa-circle-o"></i>Fee Import</a></li>
             </ul>
           </li>
           <li class="treeview" >
             <a href="#"><i class="fa fa-fw fa-refresh"></i> Accounting
               <span class="pull-right-container">
                 <i class="fa fa-angle-left pull-right"></i>
               </span>
             </a>
             <ul class="treeview-menu">
               <li><a href="{{url('finance/account/account-group')}}"><i class="fa fa-circle-o"></i>Account Group</a></li>
               <li style="display:none;"><a href="{{url('finance/account/voucher-master')}}"><i class="fa fa-circle-o"></i>Voucher Master</a></li>
               <li><a href="{{url('finance/account/voucher-head')}}"><i class="fa fa-circle-o"></i>Voucher Head</a></li>
               <li><a href="{{url('finance/account/voucher')}}"><i class="fa fa-circle-o"></i>Create Voucher</a></li>
                <li><a href="{{url('finance/account/voucher/list')}}"><i class="fa fa-circle-o"></i>Voucher List</a></li>
               <li><a href="{{url('finance/account/voucher/daybook')}}"><i class="fa fa-circle-o"></i>Day Book</a></li>
               <li><a href="#"><i class="fa fa-circle-o"></i>Cash Book</a></li>
               <li><a href="#"><i class="fa fa-circle-o"></i>Bank Book</a></li>
               <li class="treeview">
                 <a href="#"><i class="fa fa-circle-o"></i> Report
                   <span class="pull-right-container">
                     <i class="fa fa-angle-left pull-right"></i>
                   </span>
                 </a>
                 <ul class="treeview-menu">
                   <li><a href="{{url('finance/account/voucher/legder-account')}}"><i class="fa fa-circle-o"></i> Ledger Account</a></li>
                   <li><a href="{{url('finance/account/voucher/trial-account')}}"><i class="fa fa-circle-o"></i> Trial Balance</a></li>
                 </ul>
               </li>
             </ul>
           </li>
         </ul>
       </li>
       <li class="treeview">
        <a href="#">
          <i class="fa fa-fw fa-book"></i>
          <span>Library</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="{{url('library/category')}}"><i class="fa fa-circle-o"></i>Add Category</a></li>
          <li><a href="{{url('library/books')}}"><i class="fa fa-circle-o"></i>Add Book</a></li>
           <li><a href="{{url('library/books/issue')}}"><i class="fa fa-circle-o"></i>Issue book</a></li>
          <li><a href=""><i class="fa fa-circle-o"></i>Request Details</a></li>
           <li><a href="{{url('library/bookissue/return')}}"><i class="fa fa-circle-o"></i>Book Return</a></li>
            <li><a href=""><i class="fa fa-circle-o"></i>Report</a></li>
           <li><a href=""><i class="fa fa-circle-o"></i>Import</a></li>
           <li><a href=""><i class="fa fa-circle-o"></i>Export</a></li>

         </ul>
      </li>
       <li class="treeview">
        <a href="#">
          <i class="fa fa-fw fa-bus"></i>
          <span>Transport</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="{{url('transport/vehicle')}}"><i class="fa fa-circle-o"></i>Add Vechicle</a></li>
          <li><a href="{{url('transport/driver')}}"><i class="fa fa-circle-o"></i>Add Driver</a></li>
           <li><a href="{{url('transport/route')}}"><i class="fa fa-circle-o"></i>Add Route</a></li>
          <li><a href="{{url('transport/destination')}}"><i class="fa fa-circle-o"></i>Add Destination</a></li>
           <li><a href="{{url('student/transport')}}"><i class="fa fa-circle-o"></i>Tranport Allocation</a></li>
            <li><a href="{{url('transport/allocation/list')}}"><i class="fa fa-circle-o"></i>Tranport Allocation List</a></li>
           <li><a href="{{url('userlist')}}"><i class="fa fa-circle-o"></i>Fee Collection</a></li>
           <li><a href="{{url('userlist')}}"><i class="fa fa-circle-o"></i>Import</a></li>
           <li><a href="{{url('userlist')}}"><i class="fa fa-circle-o"></i>SMS Alert</a></li>
           <li><a href="{{url('userlist')}}"><i class="fa fa-circle-o"></i>Report</a></li>

         </ul>
      </li>
      <li class="treeview">
       <a href="#">
         <i class="fa fa-fw fa-home"></i>
         <span>Hostel</span>
         <span class="pull-right-container">
           <i class="fa fa-angle-left pull-right"></i>
         </span>
       </a>
       <ul class="treeview-menu">
         <li><a href="{{url('hostel/details')}}"><i class="fa fa-circle-o"></i> Hostel Details</a></li>
         <li><a href="{{url('hostel/room')}}"><i class="fa fa-circle-o"></i>Hostel Room </a></li>
         <li><a href="{{url('hostel/allocation')}}"><i class="fa fa-circle-o"></i> Hostel Allocation</a></li>
         <li><a href="{{url('hostel/request/details')}}"><i class="fa fa-circle-o"></i>Request Details</a></li>
         <li><a href="{{url('hostel/transfer/vacate')}}"><i class="fa fa-circle-o"></i>Hostel Transfer/Vacate</a></li>
         <li><a href="{{url('hostel/register')}}"><i class="fa fa-circle-o"></i>Hostel Register</a></li>
         <li><a href="{{url('hostel/visitors')}}"><i class="fa fa-circle-o"></i>Hostel Visitors</a></li>
          <li><a href="{{url('hostel/fee/collection')}}"><i class="fa fa-circle-o"></i>Hostel Fee Collection</a></li>
          <li     class="treeview">
            <a href="#"><i class="fa fa-circle-o"></i> Report
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href=" {{url('hostel/details/report')}}"><i class="fa fa-circle-o"></i> Hostel Details Report</a></li>
              <li><a href="{{url('hostel/room/availability/report')}}"><i class="fa fa-circle-o"></i> Room Availibility Report</a></li>
              <li><a href="{{url('hostel/room/request/report')}}"><i class="fa fa-circle-o"></i> Room Request Report</a></li>
              <li><a href="{{url('hostel/room/occupancy/report')}}"><i class="fa fa-circle-o"></i> Room Occupancy Report</a></li>
              <li><a href="{{url('hostel/fee/reports')}}"><i class="fa fa-circle-o"></i> Fee Reports</a></li>

            </ul>
          </li>
        </ul>
     </li>
     <ul>
    </section>
    <!-- /.sidebar -->
  </aside>


    {{--Content File Start Here--}}

    @yield('content')
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
