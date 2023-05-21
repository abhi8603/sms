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
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#"><i class="fa fa-dashboard"></i> Student</a></li>
        <li class="active">Attendance</li>
      </ol>
    </section>
    <section class="content">
        @include('notification.notify')
  <div class="box box-default">
    <!-- Main content -->
    <div class="box-header with-border">
      <h3 class="box-title">Student Attendance Report</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        <button style="display:none;" type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
      </div>
    </div>

        <div class="row">
          <div class="col-md-12">

                  <div class="box-body">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="box box-info">
                          <div class="box-header">
                            <h3 class="box-title">Attendance</h3>
                          </div>
                            <div class="box-body">
                              <div class="col-md-12">
                            
                                    <div class="form-group col-md-3">
                                      <label for="exampleInputEmail1">Accadmic year<span style="color:red;"> *</span></label>
                                      <select class="form-control select2" name="accadmicyear" id="accadmicyear" style="width: 100%;" required>
                                          <option value="{{app_config('Session',Auth::user()->school_id)}}" selected="selected">{{app_config('Session',Auth::user()->school_id)}}</option>
                                    </select>
                                       </div>
                                       <div class="form-group col-md-3">
                                                       <label>Date</label>
                                                       <div class="input-group date">
                                                         <div class="input-group-addon">
                                                           <i class="fa fa-calendar"></i>
                                                         </div>
                                                         <input type="text" class="form-control pull-right dob" id="date" value="" name="date" required>
                                                       </div>
                                                       <!-- /.input group -->
                                                     </div>
                                          <div class="box-footer">
                                          <button type="button" onclick="search()" class="btn btn-primary">Search</button>

                                          </div>
                              
                            </div>

                        </div>
                        </div>
              </div>
                        </div>
                        </div>

                        <div class="box-body" id="reports">
                          <div class="row">
                            <div class="col-md-12">
                              <div class="box box-info">
                                <div class="box-header">
                                  <h3 class="box-title">Attendance Report For </h3>
                                </div>
                                  <div class="box-body">
                                    <div class="col-md-12">

                                      <table id="example" class="table table-striped table-bordered display" style="width:100%">
                                        <thead>
                                  <tr>
                                  
                                    <th>Date</th>
                                    <th>Student Name</th>
                                    <th>Status</th>

                                    </tr>
                                </thead>
                                        <tbody>
                                          <tr>

                                          </tr>

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

<script type="text/javascript">
  function search()
  {
     var table =$('#example').DataTable();
    var accadmicyear=$("#accadmicyear").val();
    var date=$("#date").val();
    var _url = $("#_url").val();

    var datastring='accadmicyear='+accadmicyear+'&date='+date;

    $.ajax({
      type: "POST",
         url: _url + '/parents/ward/attendance/show_att_report',
        data: datastring,
        cache: false,
        success:function(data)
        {
          //alert(data);
          data=JSON.parse(data);
                table.clear().draw();
               //alert(data);
                for(var i in data)
                  {
                    table.row.add( [
                      data[i]['att_date'],
                    data[i]['name'],
                    
                    data[i]['status']
                     
                    ] ).draw( false );                  
                  }
        }
    });
  }
</script>

@endsection
<!-- ./wrapper -->
