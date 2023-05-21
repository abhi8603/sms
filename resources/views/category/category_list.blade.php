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
  <div class="box box-default">
    <!-- Main content -->
    <div class="box-header with-border">
      <h3 class="box-title">Category Wise Student Details</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        <button style="display:none;" type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
      </div>
    </div>
        <div class="row">
          <div class="col-md-12">
            <div class="box box-info">
              <div class="box-body">
                <form role="form" method="post" enctype="multipart/form-data" action="{{url('search/student/category')}}">
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
                      <td rowspan="2" style="text-align: center;">Total Student</td>
                      <td rowspan="2" style="text-align: center;">Total Boy's</td>
                      <td rowspan="2" style="text-align: center;">Total Girl's</td>
                      <td colspan="3" style="text-align: center;">Total GEN</td>
                      <td colspan="3" style="text-align: center;">Total OBC</td>
                      <td colspan="3" style="text-align: center;">Total SC</td>
                      <td colspan="3" style="text-align: center;">Total ST</td>
                      <td colspan="3" style="text-align: center;">Other's</td>
                    </tr>
                    <tr class="subheadclass">
                      <td>Boy's</td>
                      <td>Girl's</td>
                      <td>Total</td>
                      <td>Boy's</td>
                      <td>Girl's</td>
                      <td>Total</td>
                      <td>Boy's</td>
                      <td>Girl's</td>
                      <td>Total</td>
                      <td>Boy's</td>
                      <td>Girl's</td>
                      <td>Total</td>
                      <td>Boy's</td>
                      <td>Girl's</td>
                      <td>Total</td>
                    </tr>
                  </thead>
                  <tbody>
                     @php $i=0; @endphp
                     @foreach($data as $value)
                      <tr class="tabledata">
                        <td><?=++$i;?></td>
                        <td><?=$value['course_dt']!=""?$value['course_dt']:"0";?></td>

                        <td><?=$value['totalStudentNursery']!=""?$value['totalStudentNursery']:"0";?></td>
                        <td><?=$value['totalBoysNursery']!=""?$value['totalBoysNursery']:"0";?></td>
                        <td><?=$value['totalGirlsNursery']!=""?$value['totalGirlsNursery']:"0";?></td>
                        <td><?=$value['totalBoysGeneralNursery']!=""?$value['totalBoysGeneralNursery']:"0";?></td>
                        <td><?=$value['totalGirlsGeneralNursery']!=""?$value['totalGirlsGeneralNursery']:"0";?></td>
                        <td><?=$value['totalGeneralNursery']!=""?$value['totalGeneralNursery']:"0";?></td>
                        <td><?=$value['totalBoysObcNursery']!=""?$value['totalBoysObcNursery']:"0";?></td>
                        <td><?=$value['totalGirlsObcNursery']!=""?$value['totalGirlsObcNursery']:"0";?></td>
                        <td><?=$value['totalObcNursery']!=""?$value['totalObcNursery']:"0";?></td>
                        <td><?=$value['totalBoysScNursery']!=""?$value['totalBoysScNursery']:"0";?></td>
                        <td><?=$value['totalGirlScNursery']!=""?$value['totalGirlScNursery']:"0";?></td>
                        <td><?=$value['totalScNursery']!=""?$value['totalScNursery']:"0";?></td>
                        <td><?=$value['totalBoysStNursery']!=""?$value['totalBoysStNursery']:"0";?></td>
                        <td><?=$value['totalGirlsStNursery']!=""?$value['totalGirlsStNursery']:"0";?></td>
                        <td><?=$value['totalStNursery']!=""?$value['totalStNursery']:"0";?></td>
                        <td><?=$value['totalBoysOthersNursery']!=""?$value['totalBoysOthersNursery']:"0";?></td>
                        <td><?=$value['totalGirlsOthersNursery']!=""?$value['totalGirlsOthersNursery']:"0";?></td>
                        <td><?=$value['totalOthersNursery']!=""?$value['totalOthersNursery']:"0";?></td>
                      </tr>
                    @endforeach
                  </tbody> 
                   <tfoot>
                      <tr class="tablefooterdata">
                        
                        <td colspan="2">All Class</td>
                        <td><?=(isset($totalStudent))?$totalStudent:"0";?></td>
                        <td><?=(isset($totalBoys))?$totalBoys:"0";?></td>
                        <td><?=(isset($totalGirls))?$totalGirls:"0";?></td>
                        <td><?=(isset($totalBoysGen))?$totalBoysGen:"0";?></td>
                        <td><?=(isset($totalGirlsGen))?$totalGirlsGen:"0";?></td>
                        <td><?=(isset($totalGen))?$totalGen:"0";?></td>
                        <td><?=(isset($totalBoysObc))?$totalBoysObc:"0";?></td>
                        <td><?=(isset($totalGirlsObc))?$totalGirlsObc:"0";?></td>
                        <td><?=(isset($totalObc))?$totalObc:"0";?></td>
                        <td><?=(isset($totalBoysSc))?$totalBoysSc:"0";?></td>
                        <td><?=(isset($totalGirlsSc))?$totalGirlsSc:"0";?></td>
                        <td><?=(isset($totalSc))?$totalSc:"0";?></td>
                        <td><?=(isset($totalBoysSt))?$totalBoysSt:"0";?></td>
                        <td><?=(isset($totalGirlsSt))?$totalGirlsSt:"0";?></td>
                        <td><?=(isset($totalSt))?$totalSt:"0";?></td>
                        <td><?=(isset($totalBoysOthers))?$totalBoysOthers:"0";?></td>
                        <td><?=(isset($totalGirlsOthers))?$totalGirlsOthers:"0";?></td>
                        <td><?=(isset($totalOthers))?$totalOthers:"0";?></td>
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

