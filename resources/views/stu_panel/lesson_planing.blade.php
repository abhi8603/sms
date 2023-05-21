@extends('stu_panel.main-header')
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
        <li><a href="#"><i class="fa fa-dashboard"></i>Lesson Planning</a></li>
        <li class="active">Lesson Planning</li>
      </ol>
    </section>
    <section class="content">
        @include('notification.notify')
  <div class="box box-default">
    <!-- Main content -->
    <div class="box-header with-border">
      <h3 class="box-title">Lesson Plan View  </h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        <button style="display:none;" type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
      </div>
    </div>

        <div class="row">
          <div class="col-md-12">
                        <div class="box-body" id="reports">
                          <div class="row">
                            <div class="col-md-12">
                              <div class="box box-info">
                                <div class="box-header">
                                  <h3 class="box-title">Lesson Planing</h3>
                                </div>
                                  <div class="box-body">
                                    <div class="col-md-12">

                                      <table id="example" class="table table-striped table-bordered display" style="width:100%">
                                        <thead>
                                  <tr>
                                   <th>S.No</th>
                                    <th style="text-align:center;">Subject</th>
                                    <th style="text-align:center;">Lession Plan</th>
                                </tr>
                                </thead>
                                        <tbody>
                                          @php $i=0;  @endphp
                                          @foreach($lesson as $l)
                                          @php $i++ @endphp
                                          <tr>
                                            <td>@php echo $i; @endphp</td>
                                            <td style="text-align:center;">{{$l->subject_name}}</td>
                                            <td style="text-align:center;">
                                                <?php $plan= explode(",",$l->topics) ?>

                                                <table  class="table table-striped table-bordered">
                                                  <thead>
                                                    <tr>
                                                      <td>Topic</td>
                                                      <td>Objective</td>
                                                      <td>Duration</td>
                                                      <td>Status</td>
                                                    </tr>
                                                  </thead>
                                                  <tbody>
                                                    <?php foreach ($plan as $plan) {
                                                      $data=explode("|",$plan);
                                                      ?>
                                                      <tr>
                                                        <td><?php echo $data[0]; ?></td>
                                                        <td><?php echo $data[1]; ?></td>
                                                        <td><?php echo $data[3]." - ".$data[4]; ?></td>
                                                        <td><?php echo (($data[5]=="0") ? "Pending":"Completed"); ?></td>
                                                      </tr>
                                                    <?php  } ?>
                                                  </tbody>
                                                </table>

                                            </td>
                                          </tr>
                                          @endforeach
                                      </tbody>

                                      </table>
                                  </div>
                                <!-- /.box-header -->
                              </div>
                                <!-- /.box-body -->
                              </div>
                    </div>
                              </div>
                              </div>
                  </section>
    </div>
  </div>
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
