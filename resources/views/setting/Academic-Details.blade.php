@extends('header')
@section('style')
 <script type="text/javascript">
        function OnSelectionChange (select) {
            var selectedOption = select.options[select.selectedIndex];
            alert ("The selected option is " + selectedOption.value);
        }
    </script>
</head>
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
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#"><i class="fa fa-dashboard"></i> Setting</a></li>
        <li class="active">Academic-Session</li>
      </ol>
    </section>
    <section class="content">
        @include('notification.notify')
  <div class="box box-default">
    <!-- Main content -->
    <div class="box-header with-border">
      <h3 class="box-title">Session Year Details</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        <button style="display:none;" type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
      </div>
    </div>

        <div class="row">
          <div class="col-md-12">
            <!-- Custom Tabs -->
            <div class="nav-tabs-custom">
              <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1" data-toggle="tab">Session Year </a></li>
                <li style="display:none;"><a href="#tab_2" data-toggle="tab">Data Migration</a></li>

                <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                  <div class="box-body">
                    <div class="row">
                      <div class="col-md-4">

                        <!-- /.form-group -->
                        <div class="box box-primary">
                                 <div class="box-header with-border">
                                   <h3 class="box-title">Create Session Year</h3>
                                 </div>
                                 <!-- /.box-header -->
                                 <!-- form start -->
                                 <form role="form" method="post" enctype="multipart/form-data" action="{{url('Academic-session/add')}}">
                                   <div class="box-body">
                                     <div class="col-md-12">
                                     <div class="form-group">
									 
									 		
<!--{{--
<select class="form-control select2" id="mySelect" onchange="myFunction()" name="startyear" style="width: 100%;" required>
                                           <option value="" selected="selected">Select Year</option>
                                         @for ($i = 2010; $i <= 2030; $i++)
                                          <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                    </select>--}}!-->

<script>
function myFunction() {
  var x = document.getElementById("mySelect").value;
  var z = +x + +1;
  document.getElementById("demo").value =z;
}
</script>
									 
									 
									 
									 
									 
                                       <label for="exampleInputEmail1">Start Year<span style="color:red;"> *</span></label>
                                       <select class="form-control select2" name="startyear" id="mySelect" onchange="myFunction()"style="width: 100%;" required>
                                           <option value="" selected="selected">Select Year</option>
                                         @for ($i = 2010; $i <= 2030; $i++)
                                          <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                    </select>
                                        </div>
                                     <div class="form-group">
                                       <label for="exampleInputEmail1">Start Month<span style="color:red;"> *</span></label>
                                       <select class="form-control select2" name="startmonth" style="width: 100%;" required>
                                           <option value="" selected="selected">Select Month</option>
                                           <option value="January">January</option>
                                           <option value="February">February</option>
                                           <option value="March">March</option>
                                           <option value="April">April</option>
                                           <option value="May">May</option>
                                           <option value="June">June</option>
                                           <option value="July">July</option>
                                           <option value="Augest">Augest</option>
                                           <option value="september">september</option>
                                           <option value="October">October</option>
                                           <option value="November">November</option>
                                           <option value="December">December</option>
                                    </select>
                                   </div>
                                     <div class="form-group">
                                       <label for="exampleInputEmail1">End Year<span style="color:red;"> *</span></label>
                                      <!--{{-- <select class="form-control select2" name="endyear" style="width: 100%;" required >
                                           <option value="" id="demo"selected="selected">Select Year</option>
                                        
                                    </select>--}}!--><br>
									<input type="text" id="demo" name="endyear" readonly class="form-group">
                                    </div>
                                     <div class="form-group">
                                       <label for="exampleInputEmail1">End Month<span style="color:red;"> *</span></label>
                                       <select class="form-control select2" style="width: 100%;" name="endmonth" required>
                                           <option value="" selected="selected">Select Month</option>
                                           <option value="January">January</option>
                                           <option value="February">February</option>
                                           <option value="March">March</option>
                                           <option value="April">April</option>
                                           <option value="May">May</option>
                                           <option value="June">June</option>
                                           <option value="July">July</option>
                                           <option value="Augest">Augest</option>
                                           <option value="september">september</option>
                                           <option value="October">October</option>
                                           <option value="November">November</option>
                                           <option value="December">December</option>
                                    </select>
                                    </div>
                                     <div class="form-group">
                                       <label for="exampleInputEmail1">Active / Deactive<span style="color:red;"> *</span></label>
                                       <select class="form-control select2" style="width: 100%;" name="status" required>
                                           <option value="1">Active</option>
                                           <option value="0">Deactive</option>

                                    </select>
                                     </div>

                                   </div>

                                 </div>
                                   <div class="box-footer">
                                     <button type="submit" class="btn btn-primary">Save</button>
                                   </div>
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                 </form>
                               </div>

                        <!-- /.form-group -->
                      </div>
                      <div class="col-md-8">
                        <div class="box box-info">
                          <div class="box-header">
                            <h3 class="box-title">Academic Year List</h3>
							
					
                          </div>
                          <!-- /.box-header -->
                          <div class="box-body">
                            <table id="example" class="table table-striped table-bordered display nowrap" style="width:100%">
                              <thead>
                              <tr>
                                <th>Sl.No</th>
                                <th>Start Year</th>
                                <th>Start Month</th>
                                <th>End Year</th>
                                <th>End Month</th>
                                <th>Status</th>
                                <th>Action</th>

                              </tr>
                              </thead>
                              <tbody>
                                @php $i = 0 @endphp
                                @foreach($acadmic as $acadmic)
                                  @php $i++ @endphp
                              <tr>
                                <td>@php echo $i @endphp</td>
                                <td>{{$acadmic->startyear}}</td>
                                <td>{{$acadmic->startmonth}}</td>
                                <td>{{$acadmic->endyear}}</td>
                                <td>{{$acadmic->endmonth}}</td>
                                @if($acadmic->status=='0')
                                <td><span class="text-red">Inactive<span></td>
                                @else
                                <td><span class="text-green">Active<span></td>
                                @endif
                                <td>
                              <div class="btn-group">
                                <button type="button" class="btn btn-default  btn-flat dropdown-toggle" data-toggle="dropdown">
                                  <span class="caret"></span>
                                  <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <ul class="dropdown-menu" role="menu" title="Action">
                                  <li><a href="{{url('Academic-session/view/'.$acadmic->startyear)}}" title="Edit"><i  class="fa fa-eye" style="color: #897df8e6";></i></a></li>

                                <!-- Delete ka option hidden kiye huwa hai.!--->
								<!--{{-- <li><a class="tFileDelete" href="" id="{{$acadmic->startyear}}" title="Delete"><i class="fa fa-trash" style="color: red";></i></a></li>
								  --}}!-->
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
            </div>
          </div>
        </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="tab_2">
                  <form role="form" method="post" enctype="multipart/form-data" action="">
                  <div class="box-body">
                    <div class="row">
                      <div class="col-md-5">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Data Migration<span style="color:red;"> *</span></label>
                          <select class="form-control select2" style="width: 100%;">
                              <option selected="selected">Please Select</option>
                              <option value="1">January</option>
                              <option value="2">February</option>
                              <option value="3">March</option>
                              <option value="4">April</option>
                              <option value="5">May</option>
                       </select>
                      </div>
                      <div class="box-footer">
                        <button type="submit" class="btn btn-primary">OK</button>
                      </div>
                        </div>
                        </div>
                        </div>
                      </form>
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
<script>
        $(document).ready(function () {
            /*For Delete Application Info*/
            $(".tFileDelete").click(function (e) {
                e.preventDefault();
                var id = this.id;
               // alert();
                bootbox.confirm("Are you sure?", function (result) {
                    if (result) {
                        var _url = $("#_url").val();
                        window.location.href = _url + "/Academic-session/delete/" + id;
                    }
                });
            });

        $("#viewedit").click(function () {
            $("#editview").show();
            $(this).hide();
            $("#edit").show();
            $("#view").hide();
        });
        $("#editview").click(function () {
            $("#viewedit").show();
            $(this).hide();
            $("#view").show();
            $("#edit").hide();
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
@endsection
<!-- ./wrapper -->
