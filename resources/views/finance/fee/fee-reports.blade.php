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
        <li><a href="#"><i class="fa fa-dashboard"></i> Finance</a></li>
        <li><a href="#"><i class="fa fa-dashboard"></i> Fees </a></li>
        <li class="active">Fee Reports</li>
      </ol>
    </section>
    <section class="content">
        @include('notification.notify')
  <div class="box box-default">
    <!-- Main content -->
    <div class="box-header with-border">
      <h3 class="box-title">Fee Reports</h3>

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
                <li class="active"><a href="#tab_1" data-toggle="tab">Fee Collection Reports </a></li>
            <!--    <li><a href="#tab_2" data-toggle="tab">List</a></li>-->

                <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                  <div class="box-body">
                    <div class="row">
                      <div class="col-md-12">
                        <!-- /.form-group -->
                        <div class="box box-primary">
                                 <div class="box-header with-border">
                                   <h3 class="box-title">Search Fee Reports</h3>
                                 </div>
                                 <!-- /.box-header -->
                                 <!-- form start -->
                                 <form role="form" method="post" enctype="multipart/form-data" action="#">
                                   <div class="box-body">
                                     <div class="col-md-12">
                                     <div class="form-group col-md-4">
                                       <label for="exampleInputEmail1">Class<span style="color:red;"> *</span></label>
                                       <select class="form-control select2" id="course" name="course" style="width: 100%;" required>
                                           <option value="0" selected="selected">Select Class</option>
                                            <?php foreach ($course as $course): ?>
                                              <option value="{{$course->id}}">{{$course->course_name}}</option>
                                            <?php endforeach; ?>

                                    </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                          <label for="exampleInputEmail1">Section<span style="color:red;"> *</span></label>
                                          <select class="form-control select2" id="batch" name="batch" style="width: 100%;" required>
                                              <option value="" selected="selected">Select Section</option>


                                       </select>
                                           </div>
                                           <div class="form-group col-md-4">
                                             <label for="exampleInputEmail1">Fees Category<span style="color:red;"> *</span></label>
                                             <select class="form-control select2" name="feecat" id="feecat" style="width: 100%;" required>
                                                 <option value="" >Please Select</option>
                                                 <?php foreach ($feecategory as $feecategory): ?>
                                                  <option value="{{$feecategory->fee_category}}">{{$feecategory->fee_category}}</option>
                                                 <?php endforeach; ?>
                                             </select>
                                              </div>

                                              <div class="form-group col-md-4">
                                                <label for="exampleInputEmail1">Month<span style="color:red;"> *</span></label>
                                                <select class="form-control select2" id="month" name="month" style="width: 100%;" required>

                                                    <option value="" selected="selected">Please Select</option>
                                                    <option value="01">January</option>
                                                    <option value="02">February</option>
                                                    <option value="03">March</option>
                                                    <option value="04">April</option>
                                                    <option value="05">May</option>
                                                    <option value="06">June</option>
                                                    <option value="07">July</option>
                                                    <option value="08">August</option>
                                                    <option value="09">September</option>
                                                    <option value="10">October</option>
                                                    <option value="11">November</option>
                                                    <option value="12">December</option>
                                                </select>
                                                 </div>
                                   </div>
                                 </div>
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                 </form>
                               </div>
                             <div id="feereport" style="display:none">
                                <div class="box-header with-border">
                               <h3>Fee Report For Class : <span id="classs"></span> , Month : <span id="months"></span><h3>
                               </div>
                               <div class="box-body">
                                 <table id="example" class="table table-striped table-bordered display" style="width:100%">
                                   <thead>
                                   <tr>
                                     <th>Sl.No</th>
                                     <th>Addmission No</th>
                                     <th>Name</th>
                                     <th>Class/Course</th>
                                     <th>Amount</th>
                                     <th>Paid Date</th>
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
        </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="tab_2">
                  <form role="form" method="post" enctype="multipart/form-data" action="">
                  <div class="box-body">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="box box-info">
                          <div class="box-header">
                            <h3 class="box-title">Fee Sub Category Fine List</h3>
                          </div>
                          <!-- /.box-header -->
                          <div class="box-body">
                            <table id="examples" class="table table-striped table-bordered display" style="width:100%">
                              <thead>
                              <tr>
                                <th>Sl.No</th>
                                <th>Fee Sub Category</th>
                                <th>Amount In</th>
                                <th>Fine Amount</th>
                                <th>Fine Type</th>
                                <th>Fine Increment In</th>
                                <th>Days</th>
                                <th>Max Fine Percentage</th>
                                <th>Action</th>

                              </tr>
                              </thead>
                              <tbody>


                              </tbody>

                            </table>
                          </div>
                          <!-- /.box-body -->
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

           /*For Details Loading*/
           $("#month").change(function () {

             $("#feereport").show();

             var t = $('#example').DataTable({

               buttons: [
                   'copy', 'csv', 'excel', 'pdf', 'print'
               ],
                 rowReorder: {
                   selector: 'td:nth-child(2)'
               },
            responsive: true,
            bDestroy: true,
           });
               var month = $(this).val();
               var course = $("#course").val();
               var batch = $("#batch").val();
               var feecat = $("#feecat").val();
               var _url = $("#_url").val();

               $("#months").text(month);
               t.clear().draw();
               $.ajax
               ({
                   type: "POST",
                   url: _url + '/finance/feesubcollectionlist',
                   data: {month:month,course:course,batch:batch,feecat:feecat},
                   cache: false,
                   success: function ( data ) {
                     data=JSON.parse(data);
                      //   alert(data);
                      var j=0;
                            for (var i in data) {
                              j++;
                               var stu_name=data[i]['stu_name'];
                               var amt=data[i]['amt'];
                               var stu_reg_no=data[i]['stu_reg_no'];
                               var classs=data[i]['course_name'];
                               var section=data[i]['section'];
                               var created_date=data[i]['created_datecreated_date'];
                               $("#classs").text(classs);
                               t.row.add( [
                                    j,
                                    stu_reg_no,
                                    stu_name,
                                    classs,
                                    section,
                                    amt,
                                    created_date
                                      ] ).draw( false );

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
       $(document).ready(function () {
           /*For Details Loading*/
           $("#fee_category").change(function () {
               var id = $(this).val();
               var _url = $("#_url").val();
               var dataString = 'eid=' + id;
               $.ajax
               ({
                   type: "POST",
                   url: _url + '/finance/Fee-SubCategory/getsubcategory',
                   data: dataString,
                   cache: false,
                   success: function ( data ) {
                     data=JSON.parse(data);
                      //   alert(data);
                         var list = $("#fee_subcategory");
                      $(list).empty().append('<option selected="selected" value=""> Please Select </option>');
                     $(data).empty();
                      var emptycarno="No Fee Sub Category available for this Fee Category";
             if(data.length==""){
                        $("#fee_subcategory").append('<option value="' +emptycarno +'">' + emptycarno + '</option>');
             }
               else{
                        for (var i in data) {
                          var v=data[i]['id'];
                          var v1=data[i]['sub_category'];
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
          $(document).ready(function () {

              /*For Details Loading*/
              $("#course").change(function () {
                  var id = $(this).val();
                  var _url = $("#_url").val();
                  var dataString = 'eid=' + id;
                  $.ajax
                  ({
                      type: "POST",
                      url: _url + '/student/batchlist',
                      data: dataString,
                      cache: false,
                      success: function ( data ) {
                        data=JSON.parse(data);

                           // alert(data);
                            var list = $("#batch");
                         $(list).empty().append('<option selected="selected" value=""> Please Select </option>');

                        $(data).empty();
                         var emptycarno="No batch available for this course";
                if(data.length==""){
                           $("#batch").append('<option value="' +emptycarno +'">' + emptycarno + '</option>');
                }
                  else{
                           for (var i in data) {
                             var v=data[i]['id'];
                             var v1=data[i]['batch_name'];
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
$(document).ready(function() {
   $.extend($.fn.dataTable.defaults, {
 dom: 'Bfrtip'
});

   } );

</script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2();
    $('#startdate').datepicker({
      autoclose: true,
      format:'dd-mm-yyyy'
    });
    $('.dob').datepicker({
      autoclose: true,
      format:'dd-mm-yyyy'
    });
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
