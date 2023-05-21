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
      <h3 class="box-title">Employee Document Type</h3>
      <div class="box-tools pull-right">
         <a href="{{url('emp/doc/mstr/list')}}" class="btn btn-info" role="button"><i class="far fa-arrow-to-left"></i>Back</a>
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
                            <h3 class="box-title">Add/Update Employee Document Type</h3>
                          </div>
                          <form role="form" method="post" enctype="multipart/form-data" action="{{url('add/emp/doc')}}">
                            <div class="box-body">
                              <div class="col-md-6"> 
                                <div class="form-group">
                                  <label for="doc_name">Document Type<span style="color:red;"> *</span></label>
                                    <input type="text" class="form-control" name="doc_name" id="doc_name" value="<?=(isset($doc_name))?$doc_name:"";?>">
                               </div>
                            </div>
                            </div>
                        <div class="box-footer">
                           <button type="submit" id="submit_event" name="submit_event" class="btn btn-primary"><?=(isset($id))?"Update Document":"Add Document"?></button>
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
        var doc_name = $.trim($("#doc_name").val());
        if(doc_name =="") {
          $("#doc_name").css({"border-color":"red"});
          $("#doc_name").focus();
          process=false;
        }else{
          var exp = /^[a-zA-Z\s]+$/
          if(!doc_name.test(exp)){
            $("#doc_name").css({"border-color":"red"});
            $("#doc_name").focus();
            process= false;
          }
        }
        return process;
    });
    $("#doc_name").keyup(function(){$(this).css('border-color','');});
  });
</script>
@endsection
<!-- ./wrapper -->
