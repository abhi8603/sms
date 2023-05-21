@extends('header')
@section('style')
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/select2/dist/css/select2.min.css') }}">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

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
        <li><a href="#"><i class="fa fa-dashboard"></i>Hostel </a></li>
        <li class="active">Hostel Details Report</li>
      </ol>
    </section>
    <section class="content">
        @include('notification.notify')
  <div class="box box-default">
    <!-- Main content -->
    <div class="box-header with-border">
      <h3 class="box-title">Room availability report </h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        <button style="display:none;" type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
      </div>
    </div>

        <div class="row">
          <div class="col-md-12">
            <div class="box box-info">
              <div class="box-header">
                <h3 class="box-title">Please select</h3>
              </div>
              <div class="box-body">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="exampleInputEmail1">Hostel Type</label>
                  <select class="form-control select2" id="hostel_type" name="hostel_type" style="width: 100%;" required>
                      <option value="" selected="selected">Please select</option>
                      @foreach($hosteltype as $hosteltype)
                      <option value="{{$hosteltype->id}}">{{$hosteltype->hotel_type}}</option>
                      @endforeach

               </select>
              </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="exampleInputEmail1">Hostel Name</label>
                  <select class="form-control select2" id="hostelname" name="hostelname" style="width: 100%;" required>
                      <option value="0" selected="selected">Please select</option>
               </select>
              </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                <a style="margin-top: 23px;" href="#" class="btn btn-primary" id="showview">View</a>
              </div>
              </div>

              </div>

            </div>

            </div>
            <div id="viewroom" class="col-md-12">
            </div>


    </section>
    <!-- /.content -->
  </div>
  </div>
  </div>

@endsection
{{--External Style Section--}}
@section('script')
<script src="{{ URL::asset('assets/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
<script>
       $(document).ready(function () {
         $("#showview").click(function(){
           var hostel_type=$("#hostel_type").val();
           if(hostel_type==""){
             alert("Please Select Hostel Type");
             return false;
           }
           var hostelname=$("#hostelname").val();
           if(hostelname==""){
             alert("Please Select Hostel");
             return false;
           }
             var _url = $("#_url").val();
        //   alert(hostel_type+"|"+hostelname);
      //  alert(_url);
        $.ajax
        ({
            type: "POST",
            url: _url + '/hostel/report/getHostelOccupancyView',
            data: {hostel_type:hostel_type,hostelname:hostelname},
            cache: false,
            success: function ( data ) {

              $("#viewroom").html(data);


            },
            error: function (jqXHR, exception) {
 var msg = '';
 if (jqXHR.status === 0) {
     msg = 'Not connect.\n Verify Network.';
 } else if (jqXHR.status == 404) {
     msg = 'Requested page not found. [404]';
 } else if (jqXHR.status == 500) {
     msg = 'Internal Server Error [500].';
 } else if (exception === 'parsererror') {
     msg = 'Requested JSON parse failed.';
 } else if (exception === 'timeout') {
     msg = 'Time out error.';
 } else if (exception === 'abort') {
     msg = 'Ajax request aborted.';
 } else {
     msg = 'Uncaught Error.\n' + jqXHR.responseText;
 }
 alert(msg);
},
        });
         });





           /*For Details Loading*/
           $("#hostel_type").change(function(){
               var id = $(this).val();
          //     alert(id);
               var _url = $("#_url").val();
               var dataString = 'id=' + id;
               $.ajax
               ({
                   type: "POST",
                   url: _url + '/hostel/getrommbytype',
                   data: dataString,
                   cache: false,
                   success: function ( data ) {
                     data=JSON.parse(data);

                      //   alert(data);
                         var list = $("#hostelname");
                      $(list).empty().append('<option selected="selected" value=""> Please Select </option>');

                     $(data).empty();
                      var emptycarno="No Hostel available for this Hostel Type";
             if(data.length==""){
                        $("#hostelname").append('<option value="' +emptycarno +'">' + emptycarno + '</option>');
             }
               else{
                        for (var i in data) {
                          var v=data[i]['id'];
                          var v1=data[i]['hostel_name'];
                          $(list).append('<option value="' +v +'">' + v1 + '</option>');

                       }
           }

                   },
                   error: function (jqXHR, exception) {
        var msg = '';
        if (jqXHR.status === 0) {
            msg = 'Not connect.\n Verify Network.';
        } else if (jqXHR.status == 404) {
            msg = 'Requested page not found. [404]';
        } else if (jqXHR.status == 500) {
            msg = 'Internal Server Error [500].';
        } else if (exception === 'parsererror') {
            msg = 'Requested JSON parse failed.';
        } else if (exception === 'timeout') {
            msg = 'Time out error.';
        } else if (exception === 'abort') {
            msg = 'Ajax request aborted.';
        } else {
            msg = 'Uncaught Error.\n' + jqXHR.responseText;
        }
        alert(msg);
    },
               });
           });

       });
   </script>
<script>
  $(function () {
        $('.select2').select2();
    });
</script>
<script>
        $(document).ready(function () {
            /*For Delete Application Info*/
            $(".tFileDelete").click(function (e) {
                e.preventDefault();
                var id = this.id;
                bootbox.confirm("Are you sure?", function (result) {
                    if (result) {
                        var _url = $("#_url").val();
                        window.location.href = _url + "/Academic-Details/delete/" + id;
                    }
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
