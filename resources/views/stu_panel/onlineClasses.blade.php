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
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Welcome
      <small>Student</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Online Classes</li>
    </ol>
  </section>
  <section class="content">
      @include('notification.notify')
      <div class="box box-default">
        <!-- Main content -->
        <div class="box-header with-border">
          <h3 class="box-title">Online Class Schedules  </h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button style="display:none;" type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>


        <div class="row">
          <div class="col-md-12">
                        <div class="box-body" id="reports">
        <div class="col-md-12">
          <table id="example" class="table table-striped table-bordered display">
            <thead>
              <tr>
                <th>Sl. No</th>
                <th>Subject</th>
                <th>Teacher</th>
                <th>Date</th>
                <th>Time</th>
                <th>Discripton</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php $i=0; ?>
              @foreach($onlineClasses as $key=>$value)
              <?php $i++; ?>
            <tr>
              <td>{{$i}}</td>
              <td>{{$value->subject_name}}</td>
              <td>{{$value->name}}</td>
              <td>{{$value->date}}</td>
              <td>{{$value->time}}</td>
              <td>{{$value->discription}}</td>
              <td>@if($value->status==1)
                <span>Active</span>
              @else
              <span>In-Active</span>
              @endif</td>
        <!--      <td><a href="{{url('student/online/classes/start/'.Crypt::encrypt($value->url))}}" target="_parent" class="btn btn-info">Start</a></td>-->

              <td><?php
               if(($value->date==date('d-m-Y')) && ($value->status==1)){ ?>
                <a href="{{$value->url}}" target="_blank" class="btn btn-info">Start Class</a>
              <?php } elseif($value->date < date('d-m-Y')){
                echo $value->status==1 ? "<span>NA</span>" :"Class Cancel";
              }else{
              echo $value->status==1 ? "<span>NA</span>" :"Class Cancel";
              }
                ?>
                </td>
            </tr>
            @endforeach
          </tbody>

          </table>
        </div>
</div>
</div>
      </div>
      </div>
</section>
</div>
</div>
@endsection

@section('script')
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
