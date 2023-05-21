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
        <li class="active">View Fee Sub Category Fine</li>
      </ol>
    </section>
    <section class="content">
        @include('notification.notify')
  <div class="box box-default">
    <!-- Main content -->
    <div class="box-header with-border">
      <h3 class="box-title">View Fee Sub Category Fine</h3>

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
                <li class="active"><a href="#tab_1" data-toggle="tab">View Fee Sub Category Fine </a></li>

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
                                   <h3 class="box-title">Fee Sub Category Fine</h3>
                                 </div>
                                 <!-- /.box-header -->
                                 <!-- form start -->
                                 <form role="form" method="post" enctype="multipart/form-data" action="{{url('finance/Fee-SubCategory/fine/add')}}">
                                   <div class="box-body">
                                     <div class="col-md-12">
                                     <div class="form-group col-md-4">
                                       <label for="exampleInputEmail1">Fee Category<span style="color:red;"> *</span></label>
                                       <select class="form-control select2" id="fee_category" name="fee_category" style="width: 100%;" required>
                                           <option value="" selected="selected">Please Select</option>
                                      <?php foreach ($fee_category as $fee_category): ?>
                                          <option value="{{ $fee_category->id }}">{{ $fee_category->fee_category}}</option>
                                      <?php endforeach; ?>

                                    </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                          <label for="exampleInputEmail1">Fees Sub Category<span style="color:red;"> *</span></label>
                                          <select class="form-control select2" id="fee_subcategory" name="fee_subcategory" style="width: 100%;" required>
                                              <option value="" selected="selected">Please Select</option>


                                       </select>
                                           </div>
                                           <div class="form-group col-md-4">
                                             <label for="exampleInputEmail1">Type<span style="color:red;"> *</span></label>
                                             <select class="form-control select2" name="type" id="type" style="width: 100%;" required>
                                                 <option value="" >Please Select</option>
                                                 <option value="%" selected="selected">Percentage</option>
                                                 <option value="rs">Amount</option>
                                             </select>
                                              </div>
                                              <div class="form-group col-md-4">
                                                <label for="exampleInputEmail1" id="typechn">Fine Percentage<span style="color:red;"> *</span></label>
                                                <input type="text" class="form-control" id="subjectname" name="fine_amt" placeholder="Fine Percentage" onkeypress="return isNumber(event)" >
                                              </div>
                                              <div class="form-group col-md-4">
                                                <label for="exampleInputEmail1">Fine Type<span style="color:red;"> *</span></label>
                                                <select class="form-control select2" id="finetype" name="fine_type" style="width: 100%;" required>
                                                    <option value="" >Please Select</option>
                                                    <option value="Fixed" selected="selected">Fixed</option>
                                                    <option value="Incremental">Incremental</option>
                                                </select>
                                                 </div>
                                                 <div class="form-group col-md-4">
                                                       <label>Fine Date</label>
                                                       <div class="input-group date">
                                                         <div class="input-group-addon">
                                                           <i class="fa fa-calendar"></i>
                                                         </div>
                                                         <input type="text" class="form-control pull-right" id="finedate" value="{{ old('joining_date') }}" name="finedate" required>
                                                       </div>
                                                                 <!-- /.input group -->
                                                   </div>
                                                   <div class="form-group">
                                                     <div class="col-md-3" style="top: -15px;">
                                                     <label for="exampleInputEmail1">Months</label>
                                                     <select class="form-control select2"  multiple="multiple" id="month" name="month[]" style="width: 100%;" required>
                                                        <option value="" >Please Select Months</option>
                                                         <option value="01" >January</option>
                                                         <option value="02" >February</option>
                                                         <option value="03" >March</option>
                                                         <option value="04" >April</option>
                                                         <option value="05" >May</option>
                                                         <option value="06" >June</option>
                                                         <option value="07" >July</option>
                                                         <option value="08" >August</option>
                                                         <option value="09" >September</option>
                                                         <option value="10" >October</option>
                                                         <option value="11" >November</option>
                                                         <option value="12" >December</option>
                                                  </select>
                                                </div>
                                                </div>
                                                 <div class="form-group col-md-4" id="fineincrement">
                                                   <label for="exampleInputEmail1">Fine Increment in<span style="color:red;"> *</span></label>
                                                   <select class="form-control select2" id="fineincrementin" name="fineincrementin" style="width: 100%;" required>
                                                       <option value="">Please Select</option>
                                                       <option value="Monthly" selected="selected">Monthly</option>
                                                       <option value="Daily" >Daily</option>
                                                   </select>
                                                    </div>
                                                    <div id="dell">
                                        <div class="form-group col-md-4">
                                          <label for="exampleInputEmail1">Days<span style="color:red;"> *</span></label>
                                          <input type="text" class="form-control" id="days" name="days" placeholder="Days" value="" onkeypress="return isNumber(event)">
                                        </div>
                                        <div class="form-group col-md-4">
                                          <label for="exampleInputEmail1">Maximum Fine Percentage<span style="color:red;"> *</span></label>
                                          <input type="text" class="form-control" id="maxfinepercent" name="maxfinepercent" value="" placeholder="Maximum Fine Percentage" onkeypress="return isNumber(event)" >
                                        </div>
                                      </div>

                                   </div>

                                 </div>


                                   <div class="box-footer">
                                    <!-- <button type="submit" class="btn btn-primary">Save</button>-->
                                    <input type="submit" class="btn btn-primary" name="submit" value="Save">
                                   </div>
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                 </form>
                               </div>
                      </div>
            </div>
          </div>
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
$(document).ready(function(){
$("#dell").hide();
$("#fineincrement").hide();
    $("#type").change(function(){
       var type = $(this).val();
      if(type=='rs'){
        $("#typechn").html("Fine Amount<span style='color:red;'> *</span>");
      }else{
        $("#typechn").html("Fine Percentage<span style='color:red;'> *</span>");
      }
    });
$("#fineincrementin").change(function(){
       var types = $(this).val();
       if(types=='Daily'){
          $("#dell").show();
          $("#dell").fadeIn('slow');
        }else{
          $("#dell").hide();
          $("#dell").fadeOut('slow');
        }
    });
$("#finetype").change(function(){
       var types = $(this).val();
      if(types=='Incremental'){
          $("#fineincrement").show();
          $("#fineincrement").fadeIn('slow');
        }else{
          $("#fineincrement").hide();
          $("#fineincrement").fadeOut('slow');
        }
    });
});
</script>
<script>
        $(document).ready(function () {
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
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2();
    $('#finedate').datepicker({
      autoclose: true,
      format:'dd'
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
