@extends('header')
@section('style')
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/bootstrap/dist/css/buttons.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/bootstrap/dist/css/rowReorder.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/bootstrap/dist/css/responsive.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/select2/dist/css/select2.min.css') }}">

@endsection
@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    
    <section class="content">
        @include('notification.notify')
  <div class="box box-default">
    <!-- Main content -->
    <div class="box-header with-border">
      <h3 class="box-title">Event</h3>

      <div class="box-tools pull-right">
         <a href="{{url('event')}}" class="btn btn-info" role="button"><i class="far fa-arrow-to-left"></i>Back</a>
      </div>
    </div>
        <div class="row">
          <div class="col-md-12">
            <!-- Custom Tabs -->
            <div class="nav-tabs-custom">
              <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                  <div class="box-body">
                    <div class="row">
                      <div class="col-md-12">
                        <!-- /.form-group -->
                        <div class="box box-primary">
                          <div class="box-header with-border">
                            <h3 class="box-title">Add/Update Event Type</h3>
                          </div>
                          <form role="form" method="post" enctype="multipart/form-data" action="{{url('addevent')}}">
                            <div class="box-body">
                              <div class="col-md-7"> 
                                <div class="form-group">
                                  <label for="event_name">Event Type<span style="color:red;"> *</span></label>
                                    <input type="text" class="form-control" name="event_name" id="event_name" value="<?=(isset($event_name))?$event_name:"";?>" required>
                               </div>
                            </div>
                            </div>
                        <div class="box-footer">
                           <button type="submit" id="submit_event" name="submit_event" class="btn btn-primary"><?=(isset($id))?"Update Event":"Add Event"?></button>
                        </div>
                        <input type="hidden" name="id"  id="id" value="<?=(isset($id))?md5($id):"";?>" >
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    </form>
                  </div>
                </div>
                </div>
                </div>
                </div>
                                <!-- /.tab-pane -->
                <div class="tab-pane" id="tab_2">
                   <div class="box-body">
                    <div class="row">
                        </div>
                        </div>

                        </div>
                </div>
              </div>
              <!-- /.tab-content -->
            </div>
            <!-- nav-tabs-custom -->

    </section>
    <!-- /.content -->
  </div>
  </div>
  </div>
  <!-- /.content-wrapper -->

@endsection
{{--External Style Section--}}
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
<script type="text/javascript">
  $(document).ready(function(){
    $('#submit_event').click(function(){
      var process=true; 
        var event_name = $.trim($("#event_name").val());
        if(event_name =="") {
          $("#event_name").css({"border-color":"red"});
          $("#event_name").focus();
          process=false;
        }/*else{
          var exp = /^[A-Za-z]+$/;
          if(!event_name.test(exp)){
            $("#event_name").css({"border-color":"red"});
            $("#event_name").focus();
            process= false;
          }
        }*/
        return process;
    });
    $("#event_name").keyup(function(){$(this).css('border-color','');});
  });
</script>
@endsection
<!-- ./wrapper -->
