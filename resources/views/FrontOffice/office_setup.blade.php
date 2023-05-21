
@extends('header')
@section('style')
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/bootstrap/dist/css/buttons.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/bootstrap/dist/css/rowReorder.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/bootstrap/dist/css/responsive.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/bootstrap-daterangepicker/daterangepicker.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
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
        <li><a href="#"><i class="fa fa-dashboard"></i> Front Office</a></li>

        <li class="active">Office Setup</li>
      </ol>
    </section>

    <!-- Main content -->
      <section class="content">
          @include('notification.notify')
    <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Front Office Setup</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button style="display:none;" type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-3">
                  <div class="panel">
                    <div class="panel-body">
                     
                     <form >

                       <input type="radio" onclick="Purpose()" value="Purpose">Purpose
                       <hr>
                       <input  type="radio" onclick="complain()" value="Complain">Complain
                      <hr>
                       <input type="radio" onclick="source()" value="Source">Source
                      <hr>
                       <input  type="radio" onclick="reference()" value="Reference">Reference
                     </form>
                    </div>
                  </div>
                </div>
                <div class="col-md-4"  id="p" style="display: none;">
                <form method="post" action="{{url('FrontOffice/purpose')}}">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <label>Purpose</label>
                  <input type="text" name="purpose" class="form-control" required>
                  <label>Description</label>
                  <textarea name="description" class="form-control"></textarea>
                  <br>
                  <input type="submit" name="save" class="btn btn-primary" value="Save">
                </form>
                </div>
                <div class="col-md-4" style="display: none;"  id="c">
                <form method="post" action="{{url('FrontOffice/complain_type')}}">
                   <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <label>Complain  Type</label>
                  <input type="text" name="complain_type" class="form-control" required>
                  <label>Description</label>
                <textarea name="description" class="form-control"></textarea>
                  <br>
                  <input type="submit" name="save" class="btn btn-primary" value="Save">
                </form>
                </div>
                <div class="col-md-4" style="display: none;"  id="s">
                <form method="post" action="{{url('FrontOffice/insert_source')}}">
                   <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <label>Source</label>
                  <input type="text" name="source" class="form-control" required>
                  <label>Description</label>
                <textarea name="description" class="form-control"></textarea>
                  <br>
                  <input type="submit" name="save" class="btn btn-primary" value="Save">
                </form>
                </div>
                <div class="col-md-4" style="display: none;" id="r">
                <form method="post" action="{{url('FrontOffice/insert_reference')}}">
                   <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <label>Reference</label>
                  <input type="text" name="reference" class="form-control" required>
                  <label>Description</label>
                <textarea name="description" class="form-control" ></textarea>
                  <br>
                  <input type="submit" name="save" class="btn btn-primary" value="Save">
                </form>
                </div>

                <div class="col-md-4">
                  <div class="box box-info">
                    <div class="box-header">
                      
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body" id="t1" style="display: none;">
                       <label>Purpose List</label>
                      <table id="example" class="table table-striped table-bordered display" style="width:100%">
                        <thead>
                        <tr>
                          <th>Sl.No</th>
                          
                        
                          <th>Purpose</th>
                          
                          
                          <th>Action</th>

                        </tr>
                        </thead>
                        <tbody>
                            @php $i=0; @endphp
                             @foreach($purpose as $p)
                             @php $i++ @endphp
                             <tr>
                               <td>@php echo $i; @endphp</td>
                               <td>{{$p->purpose}}</td>
                                   <td data-label="Action">
                        <div class="btn-group">
                          <button type="button" class="btn btn-default  btn-flat dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                          </button>
                          <ul class="dropdown-menu" role="menu" title="Action">
                         
                            <li><a href="" class="purposeDelete" id="{{$p->id}}" title="Delete"><i class="fa fa-trash" style="color: red";></i></a></li>
                          </ul>
                        </div>
                        </td>
                             </tr>
                             @endforeach
                        </tbody>
                      </table>

                    </div>
                    <div class="box-body" id="t2" style="display: none;">
                       <label>Complaion List</label>
                      <table id="example1" class="table table-striped table-bordered display" style="width:100%">
                        <thead>
                        <tr>
                          <th>Sl.No</th>
                          
                        
                          <th>Complain Type</th>
                          
                          
                          <th>Action</th>

                        </tr>
                        </thead>
                        <tbody>
                            @php $i=0; @endphp
                             @foreach($complain as $c)
                             @php $i++ @endphp
                             <tr>
                              <td>@php echo $i; @endphp</td>
                               <td>{{$c->complain_type}}</td>
                                      <td data-label="Action">
                        <div class="btn-group">
                          <button type="button" class="btn btn-default  btn-flat dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                          </button>
                          <ul class="dropdown-menu" role="menu" title="Action">
                         
                            <li><a href="" class="complainDelete" id="{{$c->id}}" title="Delete"><i class="fa fa-trash" style="color: red";></i></a></li>
                          </ul>
                        </div>
                        </td>
                             </tr>
                             @endforeach
                        </tbody>
                      </table>
                      
                    </div>
                    <div class="box-body" id="t3" style="display: none;">
                       <label>Source List</label>
                      <table id="example2" class="table table-striped table-bordered display" style="width:100%">
                        <thead>
                        <tr>
                          <th>Sl.No</th>
                          
                        
                          <th>Source</th>
                          
                          
                          <th>Action</th>

                        </tr>
                        </thead>
                        <tbody>
                          @php $i=0; @endphp
                             @foreach($source as $s)
                              @php $i++ @endphp
                             <tr>
                              <td>@php echo $i; @endphp</td>
                               <td>{{$s->source}}</td>
                                      <td data-label="Action">
                        <div class="btn-group">
                          <button type="button" class="btn btn-default  btn-flat dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                          </button>
                          <ul class="dropdown-menu" role="menu" title="Action">
                         
                            <li><a href="" class="sourceDelete" id="{{$s->id}}" title="Delete"><i class="fa fa-trash" style="color: red";></i></a></li>
                          </ul>
                        </div>
                        </td>
                             </tr>
                             @endforeach
                        </tbody>
                      </table>
                      
                    </div>
                    <div class="box-body" id="t4" style="display: none;">
                      <label>Reference List</label>
                      <table id="example3" class="table table-striped table-bordered display" style="width:100%">
                        <thead>
                        <tr>
                          <th>Sl.No</th>
                          
                        
                          <th>Reference</th>
                          
                          
                          <th>Action</th>

                        </tr>
                        </thead>
                        <tbody>
                          @php $i=0; @endphp
                             @foreach($reference as $r)
                             @php $i++ @endphp
                             <tr>
                              <td>@php echo $i; @endphp</td>
                               <td>{{$r->reference}}</td>
                                      <td data-label="Action">
                        <div class="btn-group">
                          <button type="button" class="btn btn-default  btn-flat dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                          </button>
                          <ul class="dropdown-menu" role="menu" title="Action">
                         
                            <li><a href="" class="referenceDelete" id="{{$r->id}}" title="Delete"><i class="fa fa-trash" style="color: red";></i></a></li>
                          </ul>
                        </div>
                        </td>
                             </tr>
                             @endforeach
                        </tbody>
                      </table>
                      
                    </div>
                    <!-- /.box-body -->
                  </div>
                </div>
              </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection
{{--External Style Section--}}
@section('script')
<script src="{{ URL::asset('assets/bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
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
        $(document).ready(function () {
            /*For Delete Application Info*/
            $(".purposeDelete").click(function (e) {
                e.preventDefault();
                var id = this.id;
                //alert(id);
                bootbox.confirm("Are you sure?", function (result) {
                    if (result) {
                        var _url = $("#_url").val();
                        window.location.href = _url + "/FrontOffice/delete_purpose/" + id;
                    }
                });
            });

        });
    </script>
    <script>
        $(document).ready(function () {
            /*For Delete Application Info*/
            $(".complainDelete").click(function (e) {
                e.preventDefault();
                var id = this.id;
                //alert(id);
                bootbox.confirm("Are you sure?", function (result) {
                    if (result) {
                        var _url = $("#_url").val();
                        window.location.href = _url + "/FrontOffice/delete_complain/" + id;
                    }
                });
            });

        });
    </script>
    <script>
        $(document).ready(function () {
            /*For Delete Application Info*/
            $(".sourceDelete").click(function (e) {
                e.preventDefault();
                var id = this.id;
                //alert(id);
                bootbox.confirm("Are you sure?", function (result) {
                    if (result) {
                        var _url = $("#_url").val();
                        window.location.href = _url + "/FrontOffice/delete_sources/" + id;
                    }
                });
            });

        });
    </script>
    <script>
        $(document).ready(function () {
            /*For Delete Application Info*/
            $(".referenceDelete").click(function (e) {
                e.preventDefault();
                var id = this.id;
                //alert(id);
                bootbox.confirm("Are you sure?", function (result) {
                    if (result) {
                        var _url = $("#_url").val();
                        window.location.href = _url + "/FrontOffice/delete_references/" + id;
                    }
                });
            });

        });
    </script>
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
<script>
$(document).ready(function() {
   $.extend($.fn.dataTable.defaults, {
 dom: 'Bfrtip'
});
   $('#example1').DataTable( {

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
<script>
$(document).ready(function() {
   $.extend($.fn.dataTable.defaults, {
 dom: 'Bfrtip'
});
   $('#example2').DataTable( {

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
<script>
$(document).ready(function() {
   $.extend($.fn.dataTable.defaults, {
 dom: 'Bfrtip'
});
   $('#example3').DataTable( {

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
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2();
    $('#dob').datepicker({
      autoclose: true,
      format:'dd-mm-yyyy'
    });
    $('#enddate').datepicker({
      autoclose: true,
        format:'dd-mm-yyyy'
    });
    //Datemask dd/mm/yyyy

  });
</script>
<script>
function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}
</script>

<script type="text/javascript">
  function Purpose()
  {
    $("#p").show();
    $("#c").hide();
    $("#s").hide();
    $("#r").hide();
    $("#t1").show();
    $("#t2").hide();
    $("#t3").hide();
    $("#t4").hide();
  }
</script>

<script type="text/javascript">
  function complain()
  {
    $("#c").show();
    $("#p").hide();
    $("#s").hide();
    $("#r").hide();
    $("#t2").show();
    $("#t1").hide();
    $("#t3").hide();
    $("#t4").hide();
  }
</script>

<script type="text/javascript">
  function source()
  {
    $("#s").show();
    $("#p").hide();
    $("#c").hide();
    $("#r").hide();
    $("#t3").show();
    $("#t2").hide();
    $("#t1").hide();
    $("#t4").hide();
  }
</script>

<script type="text/javascript">
  function reference()
  {
    $("#r").show();
    $("#p").hide();
    $("#s").hide();
    $("#c").hide();
    $("#t4").show();
    $("#t2").hide();
    $("#t3").hide();
    $("#t1").hide();
  }
</script>
@endsection
<!-- ./wrapper -->
