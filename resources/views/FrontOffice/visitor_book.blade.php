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

<link rel="stylesheet" href="{{ URL::asset('assets/plugins/timepicker/bootstrap-timepicker.min.css') }}">

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
        <li><a href="#"><i class="fa fa-dashboard"></i> Exam</a></li>

        <li class="active">Exam List</li>
      </ol>
    </section>

    <!-- Main content -->
      <section class="content">
          @include('notification.notify')
    <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Add Visitor</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button style="display:none;" type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-3">

                  <!-- /.form-group -->
                  <div class="box box-primary">
                           <div class="box-header with-border">
                             <h3 class="box-title"></h3>
                           </div>
                           <!-- /.box-header -->
                           <!-- form start -->
                           <form role="form" method="post" enctype="multipart/form-data" action="{{url('FrontOffice/insert_visitor_book')}}">
                          <div class="box-body">
                                <div class="col-md-12 form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                          <label for="name" class="control-label">Purpose<span style="color:red;"> *</span></label>
                             <select name="purpose" class="form-control">
                                <option>Select</option>
                                @foreach($purpose as $pu)
                                  <option value="{{$pu->id}}">{{$pu->purpose}}</option>
                                @endforeach
                               

                             </select>
                      </div>
                            <div class="col-md-12 form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                          <label for="name" class="control-label">Name<span style="color:red;"> *</span></label>
                             <input type="text" name="name" class="form-control" required="">
                      </div>
                       <div class="col-md-12 form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                          <label for="name" class="control-label">Phone<span style="color:red;"> *</span></label>
                             <input type="text" name="phone" class="form-control" required="">
                      </div>
                           <div class="col-md-12 form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                          <label for="name" class="control-label">ID Card</label>
                             <input type="text" name="id_card" class="form-control">
                      </div>
                               <div class="col-md-12 form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                          <label for="name" class="control-label">Number Of Person</label>
                             <input type="text" name="number_of_person" class="form-control">
                      </div>
                             <div class="form-group col-md-12">
                               <label>Date</label>
                               <div class="input-group date">
                                 <div class="input-group-addon">
                                   <i class="fa fa-calendar"></i>
                                 </div>
                                 <input type="text" class="form-control pull-right dob" value="{{ old('dob') }}" id="dob" name="date" required readonly>
                               </div>
                               <!-- /.input group -->
                             </div>

                       <div class="form-group col-md-12">
                       <div class="bootstrap-timepicker">
             <div class="form-group">
               <label>In Time<span style="color:red;"> *</span></label>

               <div class="input-group">
                 <input type="text" class="form-control timepicker" name="in_time" value="{{ old('stoptime') }}">

                 <div class="input-group-addon">
                   <i class="fa fa-clock-o"></i>
                 </div>
               </div>
               <!-- /.input group -->
             </div>
             <!-- /.form group -->
           </div>
          </div>
                        <div class="form-group col-md-12">
                       <div class="bootstrap-timepicker">
             <div class="form-group">
               <label>Out Time<span style="color:red;"> *</span></label>

               <div class="input-group">
                 <input type="text" class="form-control timepicker" name="out_time" value="{{ old('stoptime') }}">

                 <div class="input-group-addon">
                   <i class="fa fa-clock-o"></i>
                 </div>
               </div>
               <!-- /.input group -->
             </div>
             <!-- /.form group -->
           </div>
          </div>
                       <div class="col-md-12 form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                          <label for="name" class="control-label">Note</label>
                            <textarea name="note" class="form-control"></textarea>
                      </div>
                       
                        
            </div>
         <div class="box-footer">
       <button type="submit" class="btn btn-primary">Save</button>
     </div>
       <input type="hidden" name="_token" value="{{ csrf_token() }}">
   </form>
   </div>
                </div>

                <div class="col-md-9">
                  <div class="box box-info">
                    <div class="box-header">
                      <h3 class="box-title">Visitor List</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                      <table id="example" class="table table-striped table-bordered display" style="width:100%">
                        <thead>
                        <tr>
                          <th>Sl.No</th>
                          <th>Purpose</th>
                        
                          <th>Name</th>
                          <th>Phone</th>
                          <th>Date</th>
                          <th>In Time</th>
                          <th>Out Time</th>
                          <th>Action</th>

                        </tr>
                        </thead>
                        <tbody>
                          @php $i=0; @endphp
                          @foreach($visitor as $p)
                          @php $i++ @endphp
                          <tr>
                            <td>@php echo $i; @endphp</td>
                            <td>{{$p->purpose}}</td>
                            <td>{{$p->name}}</td>
                            <td>{{$p->phone}}</td>
                            <td>{{$p->date}}</td>
                            <td>{{$p->in_time}}</td>
                            <td>{{$p->out_time}}</td>
                            <td>{{$p->id}}</td>
                            <td data-label="Action">
                        <div class="btn-group">
                          <button type="button" class="btn btn-default  btn-flat dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                          </button>
                          <ul class="dropdown-menu" role="menu" title="Action">
                            <li><a href="" title="Edit"><i  class="fa fa-eye" style="color: #897df8e6";></i></a></li>
                            <li><a href="" class="tFileDelete" id="{{$p->id}}" title="Delete"><i class="fa fa-trash" style="color: red";></i></a></li>
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
<script src="{{ URL::asset('assets/bower_components/jquery/dist/bootbox.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/jquery/dist/bootbox.min.js') }}"></script>
<script>
        $(document).ready(function () {
            /*For Delete Application Info*/
            $(".tFileDelete").click(function (e) {
                e.preventDefault();
                var id = this.id;
                //alert(id);
                bootbox.confirm("Are you sure?", function (result) {
                    if (result) {
                        var _url = $("#_url").val();
                        window.location.href = _url + "/FrontOffice/visitor_delete/" + id;
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
      $(function () {
        //Initialize Select2 Elements
        $('.select2').select2();
        
        $('#dob').datepicker({
          autoclose: true,
          format:'dd-mm-yyyy'
        });
        $('.timepicker').timepicker({
              showInputs: false
            })
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
@endsection
<!-- ./wrapper -->
