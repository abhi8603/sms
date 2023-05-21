@extends('header')
@section('style')
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/bootstrap/dist/css/buttons.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/bootstrap/dist/css/rowReorder.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/bootstrap/dist/css/responsive.dataTables.min.css') }}">
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
        <li><a href="#"><i class="fa fa-dashboard"></i> Academic</a></li>
          <li><a href="#"><i class="fa fa-dashboard"></i> Time Table</a></li>
        <li class="active">Add Room</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        @include('notification.notify')
  <div class="box box-default">
          <div class="box-header with-border">
           <h3 class="box-title">Add Room</h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              <button style="display:none;" type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
            </div>
          </div>
          <div class="box-body">
            <div class="row">
              <div class="col-md-5">
                <div class="box box-primary">
                         <div class="box-header with-border">
                           <h3 class="box-title">Add Room</h3>
                         </div>
                          <div class="box-body">
                            <form method="POST" action="{{url('add-room/add')}}">
                              <div class="form-group">
                                <label>Room No</label>
                              <input type="text" name="room_no" class="form-control" autocomplete="off">
                            </div>
                                 <div class="form-group">
                                 <input type="submit" name="sub" id="create" value="Create" class="btn btn-primary">                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                 <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                 </div>
                                </div>
                         </div>
                 </div>

                 <div class="col-md-7">
                   <div class="box box-info">
                            <div class="box-header with-border">
                              <h3 class="box-title">Room List</h3>

                            </div>
                             <div class="box-body">
                               <table id="example" class="table table-striped table-bordered display">
                                 <thead>
                                   <th>Sl No.</th>
                                   <th>Room No</th>
                                   <th>Action</th>
                                 </thead>
                                 <tbody>
                                   @php $i=0; @endphp
                                   @foreach($room as $room)
                                   @php $i++; @endphp
                                   <tr>
                                     <td>{{$i}}</td>
                                     <td>{{$room->room_no}}</td>
                                     <td>
                                       <div class="btn-group">
                                         <button type="button" class="btn btn-default  btn-flat dropdown-toggle" data-toggle="dropdown">
                                           <span class="caret"></span>
                                           <span class="sr-only">Toggle Dropdown</span>
                                         </button>
                                         <ul class="dropdown-menu" role="menu" title="Action">
                                           <li><a href="#" class="tFileDelete" title="Delete" id="{{$room->id}}"><i class="fa fa-trash" style="color: red";></i></a></li>
                                         </ul>
                                       </div>
                                     </td>
                                   </tr>
                                   @endforeach
                                 </tbody>
                               </table>

                             </div>
                           </div>
                         </div>



  </div>

                <!-- /.form-group -->
</div>
</div>
</div>

</section>
</div>

@endsection
{{--External Style Section--}}
@section('script')
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
                bootbox.confirm("Are you sure?", function (result) {
                    if (result) {
                        var _url = $("#_url").val();
                        window.location.href = _url + "/add-room/delete/" + id;
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
       responsive: true


   } );
   } );

</script>




@endsection
<!-- ./wrapper -->
