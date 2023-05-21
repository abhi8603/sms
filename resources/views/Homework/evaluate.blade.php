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
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#"><i class="fa fa-dashboard"></i> HomeWork</a></li>

        <li class="active">Submitted Home Work List</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        @include('notification.notify')

  <div class="box box-default">
           <div class="box-header with-border">
           <h3 class="box-title">Submitted Home Work List</h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              <button style="display:none;" type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
            </div>
          </div>

   <div class="box-body">
            <div class="row">
              <div class="col-md-12">

                                 <table id="example" class="table table-striped table-bordered display">
                                 <thead>
                                   <tr>
                                     <th>Sl. No</th>
                                     <th>Student</th>
                                     <th style="width: 55%;">Answer</th>
                                     <th>File</th>
                                     <th>Action</th>
                                   </tr>
                                 </thead>
                                 <tbody>
                                   @php $i=0; @endphp
                                 @foreach($result as $stu)
                                 @php $i++; @endphp
                                  <tr>
                                    <td>{{$i}}</td>
                                    <td>{{$stu->stu_name}} - {{$stu->student}}</td>
                                    <td>{!!$stu->answer!!}</td>
                                    <td>@if($stu->ans_file==null || $stu->ans_file=="")
                                      <span>NA</span>
                                      @else
                                      <a href="{{ URL::asset($stu->ans_file) }}" class="btn btn-info" target="_blank">View</a>
                                      @endif
                                    </td>
                                      <td>
                                        <a href="#" id="{{$stu->id}}/{{$stu->status}}/{{$cid}}" value="{{$stu->status}}" class="eval btn <?php if($stu->status==0){
                                          echo "btn-warning";
                                        }else{
                                          echo "btn-info";
                                        }
                                          ?>">
                                          <?php if($stu->status==0){
                                          echo "<span>Not Checked</sapn>";
                                        }else{
                                          echo "<span>Checked</sapn>";
                                        }
                                          ?>
                                        </a>
                                      </td>
                                 </tr>
                                 @endforeach
                                 </tbody>
                               </table>

                </div>
              </div>
    </div>
    </div>
  </section>
</div>
@endsection

@section('script')
<script src="{{ URL::asset('assets/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/datatables.net-bs/js/dataTables.select.min.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/datatables.net-bs/js/dataTables.responsive.min.js') }}"></script>

<script>
$(document).ready(function() {

  $(".eval").click(function (e) {
      e.preventDefault();
      var id = this.id;
    //  var status=this.attr('value');
  //    alert(status);
      bootbox.confirm("Are you sure?", function (result) {
          if (result) {
              var _url = $("#_url").val();
              window.location.href = _url + "/homework/evaluate_homework/" + id;
          }
      });
      });

   $('#example').dataTable();
    });
</script>





 @endsection

<!-- ./wrapper -->
