@extends('gurdian.main-header')
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
        Welcome
        <small>Parents</small>
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
            <section class="content">
              <div class="row">
                   <div class="col-md-8">
                     <!-- AREA CHART -->
                     <div class="box box-success">
                       <div class="box-header with-border">
                         <h3 class="box-title">Attendance % ({{date('F - Y')}})</h3>

                         <div class="box-tools pull-right">
                           <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                           </button>
                           <button style="display:none;" type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                         </div>
                       </div>
                       <div class="box-body">
                         <div class="col-md-12">
                              <div id="picchartorders" class="mt-3 chartjs-legend"></div>
                         </div>
                       </div>
                       <!-- /.box-body -->
                     </div>
                   </div>
                    <div class="col-md-4">
                        <?php foreach ($wards as $wards): ?>
                      <div class="box box-widget widget-user-2">

                        <div class="widget-user-header bg-aqua-active">
                          <div class="widget-user-image">
                            <img class="img-circle" src="{{ URL::asset('assets/images/students/student.png') }}" alt="User Avatar">
                          </div>

                        <h3 class="widget-user-username">{{$wards->stu_name}}</h3>
                         <h5 class="widget-user-desc">{{$wards->reg_no}}</h5>
                        </div>
                        <div class="box-footer no-padding">
                          <ul class="nav nav-stacked">
                            <li><a href="#">Roll No <span class="pull-right badge bg-red">{{$wards->roll_no}}</span></a></li>
                            <li><a href="#">Class <span class="pull-right badge bg-blue">{{$wards->course_name}}</span></a></li>
                            <li><a href="#">Section <span class="pull-right badge bg-aqua">{{$wards->batch_name}}</span></a></li>
                            <li><a href="#">Academic Year<span class="pull-right badge bg-green">{{$wards->accdmic_year}}</span></a></li>
                          </ul>
                        </div>
                      </div>
                      <?php endforeach; ?>
                    </div>
                    <div class="col-md-4">
                      <div class="box box-success box-solid collapsed-box">
                        <div class="box-header with-border">
                          <h3 class="box-title">Class Subjects</h3>

                          <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                          </div>
                          <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                          @php $i=0; @endphp
                          <?php foreach ($classsubject as $classsubject): ?>
                            @php $i++; @endphp
                            <p style="padding-left: 10px;"> {{ $i }}. {{$classsubject->subject_name}} - {{$classsubject->subject_code}} [ {{$classsubject->emp_name}} ]</p>
                          <?php endforeach; ?>
                        </div>
                        <!-- /.box-body -->
                      </div>
                    </div>
                    <div class="col-md-4">
                    <div class="box box-warning box-solid">
                        <div class="box-header with-border">
                          <h3 class="box-title">Class Teacher</h3>
                            <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                            </div>
                            </div>
                            <div class="box-body">
                            <?php foreach ($classteacher as $classteacher): ?>
                            <p style="padding-left: 10px;">{{$classteacher->fname}} {{$classteacher->mname}}  {{$classteacher->lname}} ({{$classteacher->phone}})</p>
                            <?php endforeach; ?>
                            </div>
                    </div>
                    </div>
                    <div class="col-md-4">
                      <div class="box bg-aqua box-solid collapsed-box">
                        <div class="box-header with-border">
                          <h3 class="box-title">Last Fee Paid</h3>

                          <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                          </div>

                        </div>

                        <div class="box-body">

<?php foreach ($lastfeepaid as $lastfeepaid): ?>
    @if($lastfeepaid->totalfee!="")
  <p>Date : <span>{{$lastfeepaid->created_date}}</span></p>
  <p>For month : <span><?php echo date("F", mktime(null, null, null, (int)$lastfeepaid->month, 1)); ?></span>
  <p>Total Amount : <span style="color: black;">&#x20B9; {{$lastfeepaid->totalfee}}<span></p>
    @else
      <p><span style="color: red;">Fee record not found.<span></p>
    @endif
<?php endforeach; ?>

                        </div>

                      </div>
                    </div>
                   </div>
              </section>
              </div>

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
(function($) {
  'use strict';
  $(function() {

    Highcharts.chart('picchartorders', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Ward attendance upto current date of month <?php echo date(' F - Y'); ?>'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                }
            }
        },
        series: [{
            name: 'Brands',
            colorByPoint: true,
           data: [             { name: 'Present', y:<?php echo $attendance; ?> }
                               ,{ name: 'Absent', y:<?php echo $absentdays; ?> }

                              ]
        }]
    });

$('.highcharts-credits').css({"display":"none !important"});
});
})(jQuery);
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
