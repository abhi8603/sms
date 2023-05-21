@extends('header')
@section('style')
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/buttons.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/rowReorder.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/responsive.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/bootstrap-daterangepicker/daterangepicker.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/select2/dist/css/select2.min.css') }}">
@endsection
@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Main content -->
      <section class="content">
          @include('notification.notify')
    <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Search Fee Collection</h3>

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
                      <form role="form" method="post" enctype="multipart/form-data" action="{{url('fee/collection/month')}}">
                        <div class="box-body">
                             <div class="col-md-3">
                              <div class="form-group">
                                <label for="exampleInputEmail1">Acadmic Year<span style="color: red;"> *</span></label>
                                <select class="form-control" name="acadmic_year" id="acadmic_year" style="width: 100%;">
                                    <option value="" selected="selected">==SELECT==</option>
                                    <?php foreach ($sessionList as $value): ?>
                                    <option value="<?=$value['startyear']?>-<?=$value['endyear']?>" <?=(isset($acadmic_year))?$acadmic_year==$value['startyear'].'-'.$value['endyear']?"SELECTED":"":"";?>><?=$value['startyear'].'-'.$value['endyear']?></option>
                                  <?php endforeach; ?>
                                </select>
                             </div>
                          </div>
                        <div class="form-group">
                             <div class="col-md-3">
                             <label for="exampleInputEmail1">Course/Class <span style="color: red;"> *</span></label>
                             <select class="form-control select2" name="course" id="course" style="width: 100%;">
                                <option value="" selected="selected">==SELECT==</option>
                                <?php foreach ($batch as $value): ?>
                                <option value="<?=$value['id']?>"<?=(isset($course))?$course==$value["id"]?"SELECTED":"":"";?>><?=$value['course_name'].'('.$value['batch_name'].')';?></option>
                              <?php endforeach; ?>
                          </select>
                        </div>
                      </div>
                   <div class="form-group">
                     <div class="col-md-3"  style="margin-top: 10px;">
                     <button type="submit" class="btn btn-primary" id="search" name="search">Search</button>
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
            <h3 class="box-title">Month Wise Fee Collection List</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="example" class="table table-striped table-bordered display" style="width:100%">
            <thead>
            <tr>
              <th>#</th>
              <th>Acadmic Year</th>
              <th>Registration No</th>
              <th>Roll No</th>
              <th>Student Name</th>
              <th>Class/Section</th>
              <th>April</th>
              <th>May</th>
              <th>June</th>
              <th>July</th>
              <th>August</th>
              <th>September</th>
              <th>October</th>
              <th>November</th>
              <th>December</th>
              <th>January</th>
              <th>February </th>
              <th>March</th>
            </tr>
          </thead>
              <tbody>
                @if(empty($data))
                  <tr style="text-align:center; color: red;">
                    <td colspan="16">Data Not Available!!!</td>
                  </tr>
                @else
                  @php $i=0; @endphp
                  @foreach($data as $value)
                  <tr>
                    <td><?=++$i;?></td>
                    <td><?=$value['acadmic_year']!=""?$value['acadmic_year']:"N/A";?></td>
                    <td><?=$value['stu_reg_no']!=""?$value['stu_reg_no']:"N/A";?></td>
                    <td><?=$value['roll_no']!=""?$value['roll_no']:"N/A";?></td>
                    <td><?=$value['stu_name']!=""?$value['stu_name']:"N/A";?></td>
                    <td><?=$value['course_name']!=""?$value['course_name'].'/'.$value['batch_name']:"N/A";?></td>
                    <td><?=$value['april']!=""?$value['april']:"0";?></td>
                    <td><?=$value['may']!=""?$value['may']:"0";?></td>
                    <td><?=$value['june']!=""?$value['june']:"0";?></td>
                    <td><?=$value['july']!=""?$value['july']:"0";?></td>
                    <td><?=$value['aug']!=""?$value['aug']:"0";?></td>
                    <td><?=$value['sept']!=""?$value['sept']:"0";?></td>
                    <td><?=$value['oct']!=""?$value['oct']:"0";?></td>
                    <td><?=$value['nov']!=""?$value['nov']:"0";?></td>
                    <td><?=$value['dec']!=""?$value['dec']:"0";?></td>
                    <td><?=$value['jan']!=""?$value['jan']:"0";?></td>
                    <td><?=$value['feb']!=""?$value['feb']:"0";?></td>
                    <td><?=$value['march']!=""?$value['march']:"0";?></td>
                  </tr>
                  @endforeach
                @endif
              </tbody>
            </table>
          </div>
          <!-- /.box-body -->
        </div>
      </div>
    </section>
@endsection

@section('script')
<script src="{{ URL::asset('assets/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/chart.js/Chart.js') }}"></script>
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
<script src="{{ URL::asset('assets/bower_components/jquery/dist/bootbox.min.js') }}"></script>
<script>
$(document).ready(function() {
   $.extend($.fn.dataTable.defaults, {
 dom: 'Bfrtip'
});
   $('#example').DataTable( {

       buttons: [
           'excel', 'print'
       ],

        responsive: false,
       "scrollX": true
   } );
} );
</script>
<script type="text/javascript">
  $(document).ready(function(){
    $('#search').click(function(){
        var process=true;
        var acadmic_year = $("#acadmic_year").val();
        var course = $("#course").val();
        if(acadmic_year==""){
          $("#acadmic_year").css({"border-color":"red"});
          $("#acadmic_year").focus();
          process =false;
        }
        if(course==""){
          $("#course").css({"border-color":"red"});
          $("#course").focus();
          process =false;
        }
        return process;
    });
    $("#acadmic_year").change(function(){$(this).css('border-color','');});
    $("#course").change(function(){$(this).css('border-color','');});
  });
</script>
@endsection
<!-- ./wrapper -->
