@extends('stu_panel.main-header')
@section('style')
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/buttons.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/rowReorder.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/responsive.dataTables.min.css') }}">

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
        <li><a href="#"><i class="fa fa-dashboard"></i> Home Work & Assignment</a></li>
        <li class="active">HomeWork Upload</li>
      </ol>
    </section>
    <section class="content">
        @include('notification.notify')
  <div class="box box-default">
    <!-- Main content -->
    <div class="box-header with-border">
      <h3 class="box-title">HomeWork Upload</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        <button style="display:none;" type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
      </div>
    </div>

        <div class="row">
          <form role="form" method="post" enctype="multipart/form-data" action="{{url('student/homework/upload_homework')}}">

          <div class="col-md-12">

                  <div class="box-body">
                  <div class="row">
                      <div class="col-md-12">
                        <div class="box box-info">
                          <div class="box-header">
                            <h3 class="box-title">HomeWork Details</h3>
                          </div>
                            <div class="box-body">
                              <div class="col-md-12">

                                    <div class="form-group col-md-3">
                                      <label for="exampleInputEmail1">Accadmic year<span style="color:red;"> *</span></label>
                                      <select class="form-control select2" name="accadmicyear" id="accadmicyear" style="width: 100%;" required>
                                          <option value="{{app_config('Session',Auth::user()->school_id)}}" selected="selected">{{app_config('Session',Auth::user()->school_id)}}</option>
                                    </select>
                                       </div>
                                       <div class="form-group col-md-3">
                                         <label for="exampleInputEmail1">Subject</label>
                                         <input type="text" value="{{ $HomeWork[0]->subject_name }}" class="form-control" readonly/>
                                         <input type="hidden" value="{{ $HomeWork[0]->id }}" class="form-control" readonly/>

                                        </div>
                                        <div class="form-group col-md-3">
                                          <label for="exampleInputEmail1">Assign Date</label>
                                          <input type="text" value="{{ $HomeWork[0]->homework_date }}" class="form-control" readonly/>
                                         </div>
                                         <div class="form-group col-md-3">
                                           <label for="exampleInputEmail1">Submission Date</label>
                                           <input type="text" value="{{ $HomeWork[0]->date_of_submission }}" class="form-control" readonly/>
                                           <input type="hidden" value="{{ $HomeWork[0]->id }}" name="id" class="form-control" readonly/>

                                        </div>
                                        <div class="form-group col-md-10">
                                          <label for="exampleInputEmail1">Discription</label>
                                          <div>
                                            {!!$HomeWork[0]->description!!}
                                          </div>
                                       </div>
                                       <div class="form-group col-md-2">
                                         <label for="exampleInputEmail1">View Document</label>
                                         <div>
                                           <a target="_blank" href="{{ URL::asset($HomeWork[0]->document) }}" class="btn btn-info">View<a/>
                                         </div>
                                      </div>

                            </div>

                        </div>
                        </div>
              </div>
                        </div>
                        </div>

                        <div class="box-body" id="reports">
                          <div class="row">
                            <div class="col-md-12">
                              <div class="box box-info">
                                <div class="box-header">
                                  <h3 class="box-title">Start Writing </h3>
                                </div>
                                  <div class="box-body">
                                    <div class="col-md-12">
                                      <div id="content-row">

                                        <div class="form-group">

                                          <div class="col-md-12">
                                            <textarea class="form-control" name="description" id="editor1" name="editor1" style="height: 300px; width: 100%;">{!! $HomeWork[0]->answer !!}</textarea>
                                            <input type="hidden" value="{{$HomeWork[0]->ans_id}}" name="ans_id"/>
                                          </div>
                                        </div><br>
                                        <div class="form-group">

                                          <div class="col-md-4">
                                            <label for="exampleInputEmail1">Upload File (if any)</label>
                                            <input type="file" class="form-control" name="file">
                                            @if($HomeWork[0]->ans_file!="0")
                                          <br><br>  <p style="color:red;">Don't Select File,if you have already Uploaded HomeWork File OR you Don't Want To.</p>
                                            @else
                                            <p></p>
                                            @endif
                                          </div>
                                        </div>
                                      </div>
                                  </div>
                              </div>
                              </div>
                              <div class="box-footer">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                @if($HomeWork[0]->date_of_submission >= date('d-m-Y'))
                                <input type="submit" name="save" value="Submit" class="btn btn-primary">
                                @else
                                <p style="color:red;">HomeWork Submission Date Over.</p>
                                @endif
                              </div>
                             </div>


                              </div>
                              </div>

    </div>
  </form>
  </div>
</div>
    </section>
  </div>

@endsection
{{--External Style Section--}}
@section('script')
<script src="https://cdn.ckeditor.com/4.4.3/standard/ckeditor.js"></script>
<script src="{{ URL::asset('assets/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/datatables.net-bs/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/datatables.net-bs/js/jszip.min.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/datatables.net-bs/js/pdfmake.min.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/datatables.net-bs/js/vfs_fonts.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/datatables.net-bs/js/buttons.html5.min.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/datatables.net-bs/js/buttons.print.min.js') }}"></script>
<script src="{{ URL::asset('assets\bower_components\datatables.net-bs\js\dataTables.responsive.min.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/datatables.net-bs/js/dataTables.rowReorder.min.js') }}"></script>
<script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor1')
    //bootstrap WYSIHTML5 - text editor
    $('.textarea').wysihtml5()
  })
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

<script type="text/javascript">
  function search()
  {
     var table =$('#example').DataTable();
    var accadmicyear=$("#accadmicyear").val();
    var date=$("#date").val();
    var _url = $("#_url").val();

    var datastring='accadmicyear='+accadmicyear+'&date='+date;
    //alert(datastring);
    $.ajax({
      type: "POST",
         url: _url + '/parents/ward/homework/assignmentlist',
        data: datastring,
        cache: false,
        success:function(data)
        {
          //alert(data);
          data=JSON.parse(data);
                table.clear().draw();
               //alert(data);
                for(var i in data)
                  {
                    table.row.add( [
                    data[i]['course_name'],
                    data[i]['batch_name'],

                    data[i]['assignment_date'],
                    data[i]['date_of_submission'],
                     data[i]['description'],
                      data[i]['created_by'],
                    '<a href="">View</a>'

                    ] ).draw( false );
                  }
        }
    });
  }
</script>

@endsection
<!-- ./wrapper -->
