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
      <h3 class="box-title">Added Event List </h3><br><br>
       <a href="{{url('assign/event')}}" class="btn btn-info" role="button">Add Event</a><br>
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
                  <th>From Date</th>
                  <th>To Date</th>
                  <th>Event Type</th>
                  <th>Event Name</th>
                  <th>Discription</th>
                  <th>Event Status</th>
                  <th>Edit</th>
                  <th>Delete</th>
                </tr>
              </thead>
              <tbody>
              @php $i=0; @endphp 
              @if(!empty($eventList))
                 @foreach ($eventList as $event)
                 <tr role="row" class="odd">
                  <td><?=++$i;?></td>
                  <td><?=$event['from_date']!=""?date('d-m-Y',strtotime($event['from_date'])):"N/A";?></td>
                  <td><?=$event['to_date']!=""?date('d-m-Y',strtotime($event['to_date'])):"N/A";?></td>
                  <td><?=$event['event_type']!=""?$event['event_type']:"N/A";?></td>
                  <td><?=$event['event_name']!=""?$event['event_name']:"N/A";?></td>
                  <td><?=$event['discription']!=""?$event['discription']:"N/A";?></td>
                  <td><?=$event['event_status']=="1"?"Active":"Deactive";?></td>
                  <td>
                      <a href="{{url('update/event/'.md5($event['id']))}}" class="btn btn-info" role="button">Update</a>
                  </td> 
                  <td>
                  <a href="" class="btn btn-info complainDelete" id="<?=md5($event['id'])?>" role="button">Delete</a>
                  </td>
                 </tr>
                @endforeach
            @endif
            </tbody>
           </table>
        </div>
       </div>
           <div class="row">
            <div class="col-sm-12 col-md-5">
               <div class="dataTables_info" id="basic-datatables_info" role="status" aria-live="polite">Showing 1 to 1 of 1 entries</div>
            </div>
            <div class="col-sm-12 col-md-7">
               <div class="dataTables_paginate paging_simple_numbers" id="basic-datatables_paginate">
                <ul class="pagination">
                 <li class="paginate_button page-item previous disabled" id="basic-datatables_previous"><a href="#" aria-controls="basic-datatables" data-dt-idx="0" tabindex="0" class="page-link">Previous</a></li>
                 <li class="paginate_button page-item active"><a href="#" aria-controls="basic-datatables" data-dt-idx="1" tabindex="0" class="page-link">1</a></li>
                 <li class="paginate_button page-item next disabled" id="basic-datatables_next"><a href="#" aria-controls="basic-datatables" data-dt-idx="2" tabindex="0" class="page-link">Next</a></li>
                </ul>
               </div>
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
                bootbox.confirm("Do You Want To Delete Event!!?", function (result) {
                    if (result) {
                        var _url = $("#_url").val();
                        window.location.href = _url + "/delete/event/" + id;
                    }
                });
            });

        });
    </script>
@endsection
<!-- ./wrapper -->
