@extends('header')
@section('style')
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/buttons.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/rowReorder.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/responsive.dataTables.min.css') }}">

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
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <!-- Main content -->
      <section class="content">
          @include('notification.notify')
    <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Welcome Employee</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button style="display:none;" type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
              <div class="box-body">
              <div class="row">
                <?php foreach ($detail as $detail): ?>

                <div class="col-md-4">
            <div class="box box-widget widget-user-2">

              <div class="widget-user-header bg-yellow">
                <div class="widget-user-image">
                  <img class="img-circle" src="{{ URL::asset('assets/images/students/student.png') }}" alt="User Avatar">
                </div>

              <h3 class="widget-user-username">{{$detail->fname}} {{$detail->mname}} {{$detail->lname}}</h3>
               <h5 class="widget-user-desc">{{$detail->empcode}}</h5>
              </div>
              <div class="box-footer no-padding">
                <ul class="nav nav-stacked">
                  <li><a href="#">Qualification <span class="pull-right badge bg-red">{{$detail->qualification}}</span></a></li>
                  <li><a href="#">Designation <span class="pull-right badge bg-blue">{{$detail->designation}}</span></a></li>
                  <li><a href="#">Department <span class="pull-right badge bg-aqua">{{$detail->department}}</span></a></li>
                  <li><a href="#">Joining Date<span class="pull-right badge bg-green">{{$detail->joiningdate}}</span></a></li>
                </ul>
              </div>
            </div>

          </div>

<?php endforeach; ?></div>

    <div class="row">
          <div class="col-md-12">
            <!-- Custom Tabs -->
            <div class="nav-tabs-custom">
              <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1" data-toggle="tab">Personal</a></li>
                <li><a href="#tab_2" data-toggle="tab">Contact</a></li>
                
   

                <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                  <div class="box-body">
                    <div class="row">
                    <div class="col-sm-4">
                       <table class="table">
                       @foreach($emp_detail as $det)
                        <tr>
                          <th>Name</th>
                        <td>{{$det->fname}} {{$det->lname}} {{$det->mname}}</td>
                      </tr>
                      <tr>
                         <th>Gender</th>
                        <td>{{$det->gender}}</td>
                      </tr>
                      <tr>
                         <th>DOB</th>
                        <td>{{$det->dob}}</td>
                      </tr>
                      <tr>
                        <th>Nationality</th>
                        <td>{{$det->nationality}}</td>
                      </tr>
                      <tr>
                        <th>Religion</th>
                        <td>{{$det->religion}}</td>
                      </tr>
                      <tr>
                         <th>Category</th>
                        <td>{{$det->category}}</td>
                      </tr>
                      <tr>
                        <th>Adhar NO</th>
                        <td>{{$det->aadhar_number}}</td>
                      </tr>
                      <tr>
                        <th>PAN NO</th>
                        <td>{{$det->pan_no}}</td>
                      </tr>
                      <tr>
                        <th>PF NO</th>
                        <td>{{$det->pf_no}}</td>
                      </tr>
                      <tr>
                        <th>ESI</th>
                        <td>{{$det-> esi}}</td>
                      </tr>
                  
                       @endforeach
                     </table>
                    </div>
                  
            </div>
          </div>
        </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="tab_2">
                
                  <div class="box-body">
                    <div class="row">
                      <div class="col-md-5">
                        <table class="table">
                          @foreach($emp_education as $educ)
                          <table class="table">
                            <tr>
                              <th>Nationality</th>
                              <td>{{$educ->country}}</td>
                            </tr>
                            <tr>
                              <th>State</th>
                              <td>{{$educ->state}}</td>
                            </tr>
                            <tr>
                              <th>City</th>
                              <td>{{$educ->city}}</td>
                            </tr>
                             <tr>
                              <th>Present Address</th>
                              <td>{{$educ->present_address}}</td>
                            </tr>
                              <tr>
                              <th>Permanent Address</th>
                              <td>{{$educ->permanent_address}}</td>
                            </tr>
                             <tr>
                              <th>Pin Code</th>
                              <td>{{$educ->pin}}</td>
                            </tr>
                            <tr>
                              <th>Phone</th>
                              <td>{{$educ->phone}}</td>
                            </tr>
                            <tr>
                              <th>Email</th>
                              <td>{{$educ->email}}</td>
                            </tr>
                          </table>
                          @endforeach
                          
                        </table>
                      </div>
                    
                        </div>
                        </div>
                        </div>
              
                </div>

              </div>
              <!-- /.tab-content -->
            </div>

 



              </section>
      </div>
  <!-- /.content-wrapper -->

@endsection
{{--External Style Section--}}
@section('script')
<!--<script src="http://code.jquery.com/jquery-1.10.2.min.js" integrity="sha256-C6CB9UYIS9UJeqinPHWTHVqh/E1uhG5Twh+Y5qFQmYg="
			  crossorigin="anonymous"></script>-->
<script src="{{ URL::asset('assets/dist/js/highcharts.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/datatables.net-bs/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/datatables.net-bs/js/jszip.min.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/datatables.net-bs/js/pdfmake.min.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/datatables.net-bs/js/vfs_fonts.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/datatables.net-bs/js/buttons.html5.min.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/datatables.net-bs/js/buttons.print.min.js') }}"></script>
<script src="{{ URL::asset('assets\bower_components\datatables.net-bs\js\dataTables.responsive.min.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/datatables.net-bs/js/dataTables.rowReorder.min.js') }}"></script>

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
