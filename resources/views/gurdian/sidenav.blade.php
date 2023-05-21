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
       <a href="{{url('parentwelcome')}}">
         <i class="fa fa-dashboard"></i> <span>Dashboard </span>
       </a>
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
