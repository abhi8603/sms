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
        <li><a href="#"><i class="fa fa-dashboard"></i>Student</a></li>

        <li class="active">Domicile Certificate</li>
      </ol>
    </section>

    <!-- Main content -->
      <section class="content">
          @include('notification.notify')
    <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Domicile Certificate</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button style="display:none;" type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="box box-primary">
                           <form role="form" method="post" enctype="multipart/form-data" action="{{url('student/downloadDomicile')}}">
                          <div class="box-body">
                              <div class="col-md-4">
                            <div class="form-group ">
                              <label for="exampleInputEmail1">Gr No<span style="color:red;"> *</span></label>
                              <input type="text" class="form-control" id="studentCategor" name="grno" placeholder="Gr No" required>
                            </div>
                              </div>

               <div class="form-group">
                 <div class="col-md-3" style="margin-top:20px">
                 <button type="submit" class="btn btn-warning">Generate</button>
                 <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
            </div>
          </div>
             </div>
   </form>
   </div>

                  <!-- /.form-group -->
                </div>

                <div class="col-md-12">
                  <div class="box box-info">
                    <div class="box-header">
                      <h3 class="box-title">Domicile Certificate Issue List</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                      <table id="example" class="table table-striped table-bordered display" style="width:100%">
                        <thead>
                  <tr>
                    <th>Sl.No</th>
                  <th>Admission No.</th>
                  <th>Name</th>
                  <th>Class</th>
                  <th>Issue By</th>
                  <th>Issue Date</th>
                  <th>Action</th>
                  </tr>
                </thead>
                        <tbody>
                          @php $i=0; @endphp
                          @foreach($students as $students)
                            @php $i++; @endphp
                          <tr>
                            <td>{{$i}}</td>
                            <td>{{$students->reg_no}}</td>
                            <td>{{$students->name}}</td>
                            <td>{{$students->course_name}}</td>
                            <td>{{$students->issue_by}}</td>
                            <td>{{$students->created_at}}</td>
                            <td>
                              <form role="form" method="post" enctype="multipart/form-data" action="{{url('student/downloadDomicile')}}">
                                <input type="hidden" class="form-control" value="{{$students->reg_no}}" name="grno" placeholder="Gr No" required>
                                <input type="hidden" class="form-control" value="{{$students->id}}" name="downloadID" required/>
                                <button type="submit" class="btn btn-warning">Re-Generate</button>
                                <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
                            </form>
                            </td>

                          </tr>
                          @endforeach
                        </tbody>

                      </table>

                    </div>
                  </div>
                </div>
              </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection
{{--External Style Section--}}
@section('script')
<script src="{{ URL::asset('assets/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/datatables.net-bs/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/datatables.net-bs/js/jszip.min.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/datatables.net-bs/js/pdfmake.min.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/datatables.net-bs/js/vfs_fonts.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/datatables.net-bs/js/buttons.html5.min.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/datatables.net-bs/js/buttons.print.min.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/datatables.net-bs/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/datatables.net-bs/js/dataTables.rowReorder.min.js') }}"></script>


<script>
$(document).ready(function() {
   $.extend($.fn.dataTable.defaults, {
 dom: 'Bfrtip'
});
   $('#example').dataTable( {

       buttons: [
           'copy', 'csv', 'excel', 'pdf', 'print'
       ],
       pageLength: 20,
       responsive: true


   } );
   } );

</script>

@endsection
<!-- ./wrapper -->
