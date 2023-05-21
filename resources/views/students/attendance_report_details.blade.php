@extends('header')
@section('style')
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/buttons.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/rowReorder.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/responsive.dataTables.min.css') }}">
<style>
  .centerData{
    text-align: center;
    font-size: 18px;
  }
  .headclass{
    background-color:blue;
    color:  #ADD8E6;
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
      <h3 class="box-title">Student Attendance Details</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        <button style="display:none;" type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
      </div>
    </div>
        <div class="row">
          <div class="col-md-12">
            <div class="box box-info">
              <div class="box-body">
                <form role="form" method="post" enctype="multipart/form-data" action="{{url('attendance/report')}}">
                  <div class="box-body">
                    <div clas="row">
                        <div class="col-md-3"> 
                          <div class="form-group ">
                            <label for="Event Type">Session<span style="color:red;"> *</span></label>
                            <select class="form-control" id="acadmic_year" name="acadmic_year" style="width: 100%;">
                              <option value="">==SELECT==</option>
                              @if(isset($sessionList))
                               <?php foreach ($sessionList as $value): ?>
                                  <option value="<?=$value['startyear']?>-<?=$value['endyear']?>" <?=(isset($acadmic_year))?$acadmic_year==$value['startyear'].'-'.$value['endyear']?"SELECTED":"":"";?>><?=$value['startyear'].'-'.$value['endyear']?></option>
                                <?php endforeach; ?>
                              @endif
                             </select>
                          </div>
                        </div>
                        <div class="col-md-3"> 
                          <div class="form-group ">
                            <label for="Event Type">Month<span style="color:red;"> *</span></label>
                            <select class="form-control" id="month" name="month" style="width: 100%;">
                              <option value="">==SELECT==</option>
                              <option value="1" <?=(isset($month))?$month==1?"SELECTED":"":"";?>>January</option>
                              <option value="2" <?=(isset($month))?$month==2?"SELECTED":"":"";?>>February</option>
                              <option value="3" <?=(isset($month))?$month==3?"SELECTED":"":"";?>>March</option>
                              <option value="4" <?=(isset($month))?$month==4?"SELECTED":"":"";?>>April</option>
                              <option value="5" <?=(isset($month))?$month==5?"SELECTED":"":"";?>>May</option>
                              <option value="6" <?=(isset($month))?$month==6?"SELECTED":"":"";?>>June</option>
                              <option value="7" <?=(isset($month))?$month==7?"SELECTED":"":"";?>>July</option>
                              <option value="8" <?=(isset($month))?$month==8?"SELECTED":"":"";?>>August</option>
                              <option value="9" <?=(isset($month))?$month==9?"SELECTED":"":"";?>>September</option>
                              <option value="10"<?=(isset($month))?$month==10?"SELECTED":"":"";?>>October</option>
                              <option value="11" <?=(isset($month))?$month==11?"SELECTED":"":"";?>>November</option>
                              <option value="12" <?=(isset($month))?$month==12?"SELECTED":"":"";?>>December</option>
                             </select>
                          </div>
                        </div>
                         <div class="col-md-3">
                             <label for="exampleInputEmail1">Course/Class <span style="color: red;"> *</span></label>
                             <select class="form-control" name="course" id="course" style="width: 100%;">
                                <option value="" selected="selected">==SELECT==</option>
                                @if(isset($batchList))
                                  <?php foreach ($batchList as $value): ?>
                                  <option value="<?=$value['id']?>"<?=(isset($course))?$course==$value["id"]?"SELECTED":"":"";?>><?=$value['course_name'].'('.$value['batch_name'].')';?></option>
                                <?php endforeach; ?>
                              @endif
                          </select>
                        </div>          
                       <div class="col-md-1" style="margin-top: 25px;"> 
                        <button type="submit" id="btn_search" name="btn_search" class="btn btn-primary">Search</button> 
                       </div>
                        <div class="col-md-2" style="margin-top: 25px; display: none;" > 
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
                      <th >#</th>
                      <th>Roll No</th>
                      <th >Name</th>
                      <th>Total Class</th>
                      @for($k=1;$k<= $no_of_days;$k++)
                        <th style="background-color:green; color: white;">{{$k}}</th>
                      @endfor
                    </tr>
                  </thead>
                   <tbody>
                    @php $i=0; @endphp
                    @if(empty($data))
                      <tr style="text-align:center; color: red;">
                        <td colspan="5">Data Not Available!!!</td>
                      </tr>
                    @else
                      @if($studentSize>0)
                        @for($j=0;$j<$studentSize;$j++)
                          <tr class="centerData">
                            <td><?=++$i;?></td>
                            <td><?=$data[$j]['roll_no']!=""?$data[$j]['roll_no']:"N/A";?></td>
                            <td style="text-align: left;"><?=$data[$j]['stu_name']!=""?$data[$j]['stu_name']:"N/A";?></td>
                            <td><?=$data[$j]['totalClass']!=""?$data[$j]['totalClass']:"0";?></td>
                            @for($k=1;$k<=$no_of_days;$k++)
                                <?php
                                  if ($data[$j]['allDays'][$k]['status']=='P') {?>
                                    <td style="background-color:green; color: white;"><?=$data[$j]['allDays'][$k]['status'];?></td>
                                 <?php }elseif($data[$j]['allDays'][$k]['status']=='A'){?> 

                                  <td style="background-color:red; color: white;"><?=$data[$j]['allDays'][$k]['status'];?></td>
                                 <?php }elseif($data[$j]['allDays'][$k]['status']=='L'){?> 
                                  <td style="background-color:yellow; color: white;"><?=$data[$j]['allDays'][$k]['status'];?></td>
                                 <?php }else{?>
                                  <td style="background-color:#eee; color:#ddd;"><?=$k;?></td>
                                 <?php }
                                ?>
  
                            @endfor
                          </tr>
                        @endfor
                      @else
                       <tr style="text-align:center; color: red;">
                         <td colspan="5">Data Not Available!!!</td>
                      </tr>
                      @endif
                    @endif
                    </tbody>
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
      var month = $('#month').val();
      var course = $('#course').val();
      if(acadmic_year==""){
        $("#acadmic_year").css({"border-color":"red"});
        $("#acadmic_year").focus();
        process =false;
      }
      if(month==""){
        $("#month").css({"border-color":"red"});
        $("#month").focus();
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
    $("#month").change(function(){$(this).css('border-color','');}); 
    $("#course").change(function(){$(this).css('border-color','');});     
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

