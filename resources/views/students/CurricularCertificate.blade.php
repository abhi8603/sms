@extends('header')
@section('style')
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/buttons.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/rowReorder.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/responsive.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/select2/dist/css/select2.min.css') }}">
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

        <li class="active">Co-Curricular Certificate</li>
      </ol>
    </section>

    <!-- Main content -->
      <section class="content">
          @include('notification.notify')
    <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Co-Curricular Certificate</h3>

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
                           <form role="form" method="post" action="{{url('student/downloadCurricularCertificate')}}">
                          <div class="box-body">
                              <div class="col-md-4">
                            <div class="form-group ">
                              <label for="exampleInputEmail1">Awarded To<span style="color:red;"> *</span></label>
                             <select class="form-control select2" name="stu_name" style="width: 100%;" required>
                             <option value="">Please Select</option>
                             @foreach($stuList as $key=>$value)
                                <option value="{{$value->stu_name.'|'.$value->reg_no}}">{{$value->stu_name}}</option>
                             @endforeach
                             </select>
                            </div>
                              </div>
                              <div class="col-md-4">
                            <div class="form-group ">
                              <label for="exampleInputEmail1">Class<span style="color:red;"> *</span></label>
                              <select class="form-control select2" name="class" style="width: 100%;" required>
                             <option value="">Please Select</option>
                             @foreach($class as $key=>$value)
                                <option value="{{$value->course_name}}">{{$value->course_name}}</option>
                             @endforeach
                             </select>
                            </div>
                              </div>

                              <div class="col-md-4">
                            <div class="form-group ">
                              <label for="exampleInputEmail1">Participating in<span style="color:red;"> *</span></label>
                              <input type="text" class="form-control" id="participating_in" value="{{ old('participating_in') }}" name="participating_in" placeholder="Participating in">
                            </div>
                            </div>
                            <div class="col-md-4">
                            <div class="form-group ">
                              <label for="exampleInputEmail1">Academic Year<span style="color:red;"> *</span></label>
                              <select class="form-control select2" name="accdmic_year" style="width: 100%;" required>
                             <option value="">Please Select</option>
                             @foreach($acadmic_year as $key=>$value)
                                <option value="{{$value->startyear}}-{{$value->endyear}}">{{$value->startyear}}-{{$value->endyear}}</option>
                             @endforeach
                             </select>
                            </div>
                              </div>

                              <div class="col-md-4">
                            <div class="form-group ">
                              <label for="exampleInputEmail1">Certificate Type<span style="color:red;"> *</span></label>
                              <select class="form-control select2" name="type" style="width: 100%;" required>
                             <option value="">Please Select</option>
                              <option value="Participation">Participation Certificate</option>
                              <option value="Activity">Activity Certificate</option>
                              <option value="Merit">Merit Certificate</option>
                             </select>
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
                      <h3 class="box-title">Co-Curricular Certificate Issue List</h3>
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
                  <th>Certificate Type</th>
				  <th>Participating in</th>
				   <th>Academic Year</th>
                  <th>Issue By</th>
                  <th>Issue Date</th>
                  <th>Action</th>
                  </tr>
                </thead>
                        <tbody>
							@php $i=0; @endphp
                         @foreach($list as $key=>$value)
							@php $i++; @endphp
						<tr>
							<td>{{$i}}</td>
							<td>{{$value->reg_no}}</td>
							<td>{{$value->stu_name}}</td>
							<td>{{$value->class}}</td>
							<td>{{$value->type}}</td>
							<td>{{$value->participating_in}}</td>
							<td>{{$value->accdmic_year}}</td>
							<td>{{$value->created_by}}</td>
							<td>{{$value->created_at}}</td>
							<td>
							<form method="post" action="{{url('student/downloadCurricularCertificate')}}">
								         
												   <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
                          
                 <input type="hidden" class="form-control" value="{{$value->stu_name.'|'.$value->reg_no}}" name="stu_name" placeholder="class in">
                                              
                            
                             <input type="hidden" class="form-control" value="{{$value->class}}" name="class" placeholder="class in">
                          

                              
                             
                              <input type="hidden" class="form-control" value="{{$value->participating_in}}" name="participating_in" placeholder="Participating in">
                          
                          
                          		
								<input type="hidden" class="form-control" value="{{$value->accdmic_year}}" name="accdmic_year" placeholder="Participating in">
                           

                                               					
								<input type="hidden" class="form-control" value="{{$value->type}}" name="type" placeholder="Participating in">
                           
								
								
								<input type="submit" class="btn btn-info" value="Re-issue" />
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
<script src="{{ URL::asset('assets/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2();
  });
</script>

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
