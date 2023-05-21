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
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>

          <li><a href="#"><i class="fa fa-dashboard"></i>  Front Office</a></li>
        <li class="active">Issue Item</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        @include('notification.notify')
  <div class="box box-default">
          <div class="box-header with-border">
           <h3 class="box-title">Issue Item</h3>

            <div class="box-tools pull-right">

                <a href="{{url('stock/add_issue_item')}}"><button type="button" class="btn btn-primary"><i class="fa fa-plus"> Add</i></button></a>

              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              <button style="display:none;" type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
            </div>
          </div>
    <div class="box-body" >
      <div class="row">
        <div class="col-md-12" >
          <div class="col-sm-4">
            <label>User Type</label>
              <select id="utype" name="user_type" onchange="utype()" class="form-control select2" style="width: 100%;">
              <option selected="selected">Please Select</option>
              <option value="student">Student</option>
              <option value="employee">Employee</option>
              </select>
          </div>
        </div>
      </div>
    </div>
      <div class="box-body" >
      <div class="row">
        <div class="col-md-12" >
        <table class="table" id="stock">
          <thead>
            <tr>
              <th>Sl. No</th>
              <th>Item</th>
              <th>category</th>
              <th>Issue To</th>
              <th>Return Date</th>
              <th>Issue Date</th>
              <th>Issue By</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>

          </tbody>

        </table>
      </div>
    </div>
  </div>
</div>

</div>
</section>
</div>


    <!-- /.content -->

  <!-- /.content-wrapper -->

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
<script src="{{ URL::asset('assets/bower_components/select2/dist/js/select2.full.min.js') }}"></script>



<script>

$(document).ready(function() {
   $.extend($.fn.dataTable.defaults, {
 dom: 'Bfrtip'
});
   $('#stock').DataTable( {

       buttons: [
           'copy', 'csv', 'excel', 'pdf', 'print'
       ],
      responsive: true
   } );
   } );

</script>

<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
  })
</script>

<script type="text/javascript">

  function utype()
  {
    var table =$('#stock').DataTable();
    var user_type=$("#utype").val();
      var _url = $("#_url").val();
      $.ajax({
      type:"post",
       url: _url + '/stock/all_issue',
       data: {user_type:user_type},
       cache: false,
       success: function ( data )
       {

               data=JSON.parse(data);
                table.clear().draw();
            //   alert(data);
                var k=0;
                for(var i in data)
                  { k++;
                    var idd=data[i]['id'];
                    table.row.add( [
                    k,
                    data[i]['item_name'],
                    data[i]['category_name'],
                    data[i]['stu_name'],
                    data[i]['return_date'],
                    data[i]['issue_date'],
                    data[i]['issue_by'],
                    (data[i]['status']==1)? "Issued": "Return",

                     '<div class="btn-group"><button type="button" class="btn btn-default  btn-flat dropdown-toggle" data-toggle="dropdown">\
                     <span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button>\
                     <ul class="dropdown-menu" role="menu" title="Action">\
                     <li>\
                     <a href="{{url("/stock/update_stock_status/' +idd +'")}}" id="'+data[i]['id']+'" class="return" title="Return"><i  class="fa fa-undo" style="color: #897df8e6";></i></a>\
                     </li>\
                     </ul></div>'
                    ] ).draw( false );
                  }
       }
    });
  }
</script>
<script>
        $(document).ready(function () {

              $("table .return").click(function (e) {
                //  alert();
                e.preventDefault();
                var id = this.id;
                alert(id);
                bootbox.confirm("Are you sure?", function (result) {
                    if (result) {
                        var _url = $("#_url").val();
                        window.location.href = _url + "/stock/update_stock_status/" + id;
                    }
                });
            });

        });
    </script>



@endsection
<!-- ./wrapper -->
