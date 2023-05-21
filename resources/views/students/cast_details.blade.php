@extends('header')
@section('style')
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/buttons.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/rowReorder.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/responsive.dataTables.min.css') }}">
<style>
  .tabledata{
    text-align: center;
    font-size: 17px;
  }
  .tablefooterdata{
    text-align: center;
    font-size: 18px;
  }
  .headclass{
    font-size: 20px;
  }
  .subheadclass{
    font-size: 18px;
  }
</style>
@endsection
@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content">
        @include('notification.notify')
  <div class="box box-default" style="overflow-x: auto;">
    <!-- Main content -->
    <div class="box-header with-border">
      <h3 class="box-title">Student Cast Details</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        <button style="display:none;" type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
      </div>
    </div>
        <div class="row">
          <div class="col-md-12">
            <div class="box box-info">
              <div class="box-body">
                <form role="form" method="post" enctype="multipart/form-data" action="{{url('cast/details')}}">
                  <div class="box-body">
                    <div clas="row">
                        <div class="col-md-4"> 
                          <div class="form-group ">
                            <label for="Event Type">Session<span style="color:red;"> *</span></label>
                            <select class="form-control" id="acadmic_year" name="acadmic_year" style="width: 100%;">
                            <option value="">==SELECT==</option>
                             <?php foreach ($sessionList as $value): ?>
                                <option value="<?=$value['startyear']?>-<?=$value['endyear']?>" <?=(isset($acadmic_year))?$acadmic_year==$value['startyear'].'-'.$value['endyear']?"SELECTED":"":"";?>><?=$value['startyear'].'-'.$value['endyear']?></option>
                              <?php endforeach; ?>
                             </select>
                          </div>
                        </div>
                       <div class="col-md-1" style="margin-top: 25px;"> 
                        <button type="submit" id="btn_search" name="btn_search" class="btn btn-primary">Search</button>
                       </div>
                        <div class="col-md-3" style="margin-top: 25px;"> 
                          <a class="btn btn-primary" id="export-btn">Export To Excel</a>
                       </div>
                    </div>
                  </div>
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
              </form>
              </div>
            </div>
            </div>
            <div class="col-md-12">
            <div class="box box-info">
              <div class="box-header">
              </div>
              <div class="box-body">
                 <table width="100%" border="1" id="resultsTable">
                  <thead>
                    <tr class="headclass">
                      <td rowspan="2" style="text-align: center;">Serial No</td>
                      <td rowspan="2" style="text-align: center;">Class</td>
                      <td rowspan="2" style="text-align: center;">Total Boy's</td>
                      <td rowspan="2" style="text-align: center;">Total Girl's</td>
                      <td rowspan="2" style="text-align: center;">Total Student</td>
                      @foreach($totalCategory as $val)
                        <td colspan="3" style="text-align: center;">Total <?=$val['stu_category']!=""?$val['stu_category']:"";?></td>
                       @endforeach
                    </tr>
                    <tr class="subheadclass">
                      @foreach($totalCategory as $val)
                        <td>Boy's</td>
                        <td>Girl's</td>
                        <td>Total</td>
                      @endforeach
                    </tr>
                  </thead>
                  <tbody>
                     @php $i=0; @endphp
                     @for($j=0;$j<$dataLength;$j++)  
                      <tr class="tabledata">
                        <td><?=++$i;?></td>
                        <td><?=$data[$j]['course']!=""?$data[$j]['course']:"N/A";?></td>
                        <td><?=$data[$j]['totalMale']!=""?$data[$j]['totalMale']:"0";?></td>
                        <td><?=$data[$j]['totalFemale']!=""?$data[$j]['totalFemale']:"0";?></td>
                        <td><?=$data[$j]['totalStudent']!=""?$data[$j]['totalStudent']:"0";?></td>
                        @for($k=0;$k<$categoryLength;$k++)
                          <td><?=$data[$j]['category'][$k]['male']!=""?$data[$j]['category'][$k]['male']:"0";?></td>
                          <td><?=$data[$j]['category'][$k]['female']!=""?$data[$j]['category'][$k]['female']:"0";?></td>
                          <td><?=$data[$j]['category'][$k]['total']!=""?$data[$j]['category'][$k]['total']:"0";?></td>
                        @endfor
                      </tr>
                    @endfor
                  </tbody> 
                  <tfoot>
                    <tr class="tablefooterdata">
                      <td colspan="2">All Student</td>
                      <td><?=(isset($allMale))?$allMale:"0";?></td>
                      <td><?=(isset($allFemale))?$allFemale:"0";?></td>
                      <td><?=(isset($all))?$all:"0";?></td>
                    </tr>
                  </tfoot>
                </table>
              </div>

            </div>

            </div>
    </section>
    <!-- /.content -->
  </div>
  </div>
  </div>

@endsection
{{--External Style Section--}}
@section('script')
<script src="{{ URL::asset('assets/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/datatables.net-bs/js/jquery.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/datatables.net-bs/js/boostrap.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/datatables.net-bs/js/table2excel.js') }}"></script>

<script>
  $(document).ready(function(){
    $('#btn_search').click(function(){
      var process =true;
      var acadmic_year = $('#acadmic_year').val();
      if(acadmic_year==""){
        $("#acadmic_year").css({"border-color":"red"});
        $("#acadmic_year").focus();
        process =false;
      }
      return process;
    });
    $("#acadmic_year").change(function(){$(this).css('border-color','');});    
  });
</script>
<script>  
  $(document).ready(function() {
    $('#export-btn').on('click', function(e){
        e.preventDefault();
        ResultsToTable();
    });
    function ResultsToTable(){    
        $("#resultsTable").table2excel({
            exclude: ".noExl",
            name: "Results"
        });
    }
});
</script>  
@endsection

