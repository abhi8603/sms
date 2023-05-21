@extends('header')
@section('style')
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/select2/dist/css/select2.min.css') }}">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

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
      <h3 class="box-title">Event report </h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        <button style="display:none;" type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
      </div>
    </div>
        <div class="row">
          <div class="col-md-12">
            <div class="box box-info">
              <div class="box-body">
                <form role="form" method="post" enctype="multipart/form-data" action="{{url('event/report/detail')}}">
                  <div class="box-body">
                    <div clas="row">
                      <div class="col-md-4"> 
                        <div class="form-group ">
                          <label for="Event Type">Event Type<span style="color:red;"> *</span></label>
                          <select class="form-control" id="event_mstr_id" name="event_mstr_id" style="width: 100%;">
                          <option value="">All</option>
                            <?php foreach ($eventTypeList as $event): ?>
                              <option value="<?=$event['id']?>"<?=(isset($event_mstr_id))?$event_mstr_id==$event["id"]?"SELECTED":"":"";?>><?=$event['event_name']?></option>
                            <?php endforeach; ?>
                           </select>
                        </div>
                        </div>
                        <div class="col-md-4"> 
                          <div class="form-group">
                            <label for="from_date">From Date<span style="color:red;"> *</span></label>
                              <input type="date" class="form-control" name="from_date" id="from_date" value="<?=(isset($from_date))?$from_date:date('Y-m-d');?>">
                          </div>
                        </div>
                        <div class="col-md-4"> 
                          <div class="form-group">
                            <label for="to_date">To Date<span style="color:red;"> *</span></label>
                            <input type="date" class="form-control" name="to_date" id="to_date" value="<?=(isset($to_date))?$to_date:date('Y-m-d');?>">
                          </div>
                        </div>
                    </div>
                  </div>
                  <div class="box-footer">
                     <button type="submit" id="event_report" name="event_report" class="btn btn-primary">View Report</button>
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
                <table id="example" class="table table-striped table-bordered display nowrap" style="width:100%">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>From Date</th>
                    <th>To Date</th>
                    <th>Event Type</th>
                    <th>Event Name</th>
                    <th>Discription</th>
                    <th>Event Status</th>
                  </tr>
                  </thead>
                  <tbody>
                    @if(empty($eventListData))
                      <tr style="text-align:center; color: red;">
                         <td colspan="7">Data Not Available!!!</td>
                      </tr>
                    @else
                      @php $i=0; @endphp
                      @foreach($eventListData as $value)
                      <tr>
                        <td><?=++$i;?></td>
                        <td><?=$value['from_date']!=""?date('d-m-Y',strtotime($value['from_date'])):"N/A";?></td>
                        <td><?=$value['to_date']!=""?date('d-m-Y',strtotime($value['to_date'])):"N/A";?></td>
                        <td><?=$value['event_type']!=""?$value['event_type']:"N/A";?></td>
                        <td><?=$value['event_name']!=""?$value['event_name']:"N/A";?></td>
                        <td><?=$value['discription']!=""?$value['discription']:"N/A";?></td>
                        <td><?=$value['event_status']=="1"?"Active":"Deactive";?></td>
                      </tr>
                      @endforeach
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
<script>
  $(document).ready(function(){
    $('#event_report').click(function(){
      var process =true;
      var from_date = $('#from_date').val();
      var to_date = $('#to_date').val();
      if(from_date==""){
        $("#from_date").css({"border-color":"red"});
        $("#from_date").focus();
        process =false;
      }
      if(to_date==""){
        $("#to_date").css({"border-color":"red"});
        $("#to_date").focus();
        process =false;
      }
      if(from_date>to_date){
        alert("To Date Should Be Greater Than Or Equal To From Date!!");
        $("#to_date").css({"border-color":"red"});
        $("#to_date").focus();
        process =false;
      }
      return process;
    });
    $("#from_date").change(function(){$(this).css('border-color','');});
    $("#to_date").change(function(){$(this).css('border-color','');});
  });
</script>>
@endsection
<!-- ./wrapper -->
