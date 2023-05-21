@extends('header')
@section('style')
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/buttons.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/rowReorder.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/responsive.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/select2/dist/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/plugins/timepicker/bootstrap-timepicker.min.css') }}">

@endsection
@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    
    <section class="content">
        @include('notification.notify')
  <div class="box box-default">
    <!-- Main content -->
    <div class="box-header">
      <h3 class="box-title">Employee Document Type List </h3><br><br>
       <a href="{{url('emp/doc/add')}}" class="btn btn-info" role="button">Add Document Type</a><br>
    <div class="col-md-12">
<div class="card">
  <div class="card-body">
    <div class="table-responsive">
        <div id="basic-datatables_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
         <div class="row">
          <div class="col-sm-12" style="overflow-y:scroll;height:450px;">
             <table id="basic-datatables" class="table-bordered  t table-hover dataTable no-footer" role="grid" aria-describedby="basic-datatables_info">
              <thead class="theadcolor">
               <tr role="row">
                <th>#</th>
                <th>Document Name</th>
                <th>Edit</th>
                <th>Delete</th>
              </tr>
              </thead>
              <tbody>
			  @if(empty($docList))
  				<tr style="text-align:center; color: red;">
					<td colspan="4">Data Not Available!!!</td>
				</tr>
			  @else
				   @php $i=0; @endphp 
				   @foreach ($docList as $value)
  				<tr role="row" class="odd">
  					<td><?=++$i;?></td>
  					<td><?=$value['doc_name']!=""?$value['doc_name']:"N/A";?></td>
  					<td>
  						<a href="{{url('add/emp/doc/'.md5($value['id']))}}" class="btn btn-info" role="button">Update</a>
  					</td> 
  					<td>
  					<a href="" class="btn btn-info complainDelete" id="<?=md5($value['id'])?>" role="button">Delete</a>
  					</td>
  				</tr>
				@endforeach
			  @endif
            </tbody>
           </table>
        </div>
       </div>
          </div>
         </div>
      </div>
     </div>
    </div>
    </div>
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
<script src="{{ URL::asset('assets/bower_components/jquery/dist/bootbox.min.js') }}"></script> <script>
        $(document).ready(function () {
            /*For Delete Application Info*/
            $(".complainDelete").click(function (e) {
                e.preventDefault();
                var id = this.id;
                //alert(id);
                bootbox.confirm("Do You Want To Delete Document Type ?", function (result) {
                    if (result) {
                        var _url = $("#_url").val();
                        window.location.href = _url + "/delete/emp/doc/" +id;
                    }
                });
            });

        });
    </script>
@endsection
<!-- ./wrapper -->
