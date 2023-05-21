@extends('header')
@section('style')
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/buttons.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/rowReorder.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/responsive.dataTables.min.css') }}">
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
        <li class="active">Fee Wavier </li>
      </ol>
    </section>
    <section class="content">
        @include('notification.notify')
  <div class="box box-default">
    <!-- Main content -->
    <div class="box-header with-border">
      <h3 class="box-title">Fee Wavier </h3>

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
                <li class="active"><a href="#tab_1" data-toggle="tab">Fee Wavier  </a></li>
                <li><a href="#tab_2" data-toggle="tab">List</a></li>

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
                                   <h3 class="box-title">New Fee Wavier</h3>
                                 </div>
                                 <!-- /.box-header -->
                                 <!-- form start -->
                                 <form role="form" method="post" enctype="multipart/form-data" action="{{url('finance/fee/fee-waiver')}}">
                                   <div class="box-body">
                                     <div class="col-md-12">
                                       <div class="form-group">
                                         <label for="exampleInputEmail1">Fee Wavier By</label>
                                         <select id="wby" class="form-control select2" name="wby" style="width: 100%;" required>
                                             <option value="" selected="selected">Please Select Fee Wavier By</option>
                                             <option value="student">Student</option>
                                             <option value="category">Category</option>
                                        </select>
                                    </div>
                                    <div class="form-group" id="ct" style="display:none;">
                                      <label for="exampleInputEmail1">Category</label>
                                      <select class="form-control select2" id="category" name="category" style="width: 100%;">
                                          <option value="" selected="selected">Please Select Student Category</option>
                                          <?php foreach ($category as $category): ?>
                                            <option value="{{$category->stu_category}}" >{{$category->stu_category}}</option>
                                            <?php endforeach; ?>
                                   </select>
                                 </div>
                                       <div class="form-group" id="st" style="display:none;">
                                         <label for="exampleInputEmail1">Student</label>
                                         <select class="form-control select2" id="student" name="student" style="width: 100%;">
                                             <option value="" selected="selected">Please Select Student</option>
                                             <?php foreach ($stu_info as $stu_info): ?>
                                               <option value="{{$stu_info->reg_no}}" >{{$stu_info->stu_name}} - ({{$stu_info->reg_no}})</option>
                                               <?php endforeach; ?>
                                      </select>
                                    </div>
                                     <div class="form-group">
                                       <label for="exampleInputEmail1">Fee Category<span style="color:red;"> *</span></label>
                                       <select class="form-control select2" id="feecategory" name="feecategory" style="width: 100%;" required>
                                           <option value="" selected="selected">Select Fee Category</option>
                                      <?php foreach ($fee_category as $fee_category): ?>
                                          <option value="{{ $fee_category->id }}">{{ $fee_category->fee_category}}</option>
                                      <?php endforeach; ?>

                                    </select>
                                        </div>
                                        <div class="form-group">
                                          <label for="exampleInputEmail1">Fee Sub Category Name<span style="color:red;"> *</span></label>
                                          <select class="form-control select2" id="fee_subcategory" name="fee_subcategory" style="width: 100%;" required>
                                              <option value="" selected="selected">Select Fee Category</option>

                                         </select>
                                       </div>

                                 <div class="form-group">
                                   <label for="exampleInputEmail1">Excemption or Deduction</label>
                                   <select class="form-control select2" id="type" name="type" style="width: 100%;">
                                       <option value="" selected="selected">Please Select Excemption or Deduction</option>
                                           <option value="Deduction" selected >Deduction</option>
                                           <option value="Excemption" >Excemption</option>
                                </select>
                              </div>
                              <div class="form-group">
                                <label for="exampleInputEmail1">Deduction Type<span style="color:red;"> *</span></label>
                                <select class="form-control select2" id="deduction_type" name="deduction_type" style="width: 100%;" required>
                                    <option value="amount">Amount</option>
                                    <option value="%">%</option>
                               </select>
                             </div>
                                 <div class="form-group">
                                   <label for="exampleInputEmail1" id="typechn">Deduction Value (In <span id="tp">₹</span>)<span style="color:red;"> *</span></label>
                                   <input type="text" class="form-control" id="Amount" name="amount" placeholder="Amount" onkeypress="return isNumber(event)" >
                                 </div>
                                  <div class="box-footer">
                                         <!-- <button type="submit" class="btn btn-primary">Save</button>-->
                                         <input type="submit" class="btn btn-primary" name="submit" value="Save">
                                        </div>
                                         <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                   </div>

                                 </div>

                               </div>
                      </div>

                      <div class="col-md-6">
                        <div id="tbl" style="margin-top:10px;display:none;" class="form-group col-md-12 callout callout-info">
                             <div>
                               <div class="form-group col-md-12" style="margin-top:10px;">
                               <label for="exampleInputEmail1">Note :  </label>
                               <label><span style="color: #fffc00e6;">Fee waiver amount can't be grater than actual fee.</span></label>
                             </div>
                             <div class="form-group col-md-6" style="margin-top:10px;">
                             <label for="exampleInputEmail1">Name :  </label>
                             <label for="exampleInputEmail1" id="stname"></label>
                           </div>
                       <div class="form-group col-md-6" style="margin-top:10px;">
                            <label for="exampleInputEmail1">Class :  </label>
                            <label for="exampleInputEmail1" id="class"></label>
                       </div>
                       <div class="form-group col-md-6" style="margin-top:10px;">
                             <label for="exampleInputEmail1">Section :  </label>
                             <label for="exampleInputEmail1" id="section"></label>
                       </div>
                       <div class="form-group col-md-6" style="margin-top:10px;">
                         <label for="exampleInputEmail1">Acadmic Year :  </label>
                         <label for="exampleInputEmail1" id="accyear"></label>
                       </div>
                       <div class="form-group col-md-6" style="margin-top:10px;">
                         <label for="exampleInputEmail1">Current Tution Fee :  </label>
                         <label for="exampleInputEmail1" id="fee"></label>
                       </div>

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
                            <h3 class="box-title">Fee Wavier List</h3>
                          </div>
                          <!-- /.box-header -->
                          <div class="box-body">
                            <table id="example" class="table table-striped table-bordered display" style="width:100%">
                              <thead>
                              <tr>
                                <th>Sl.No</th>
                                <th>Student Name</th>
                                <th>Fee Category</th>
                                <th>Deduction Amount</th>
                                <th>Acadmic Year</th>
                                <th>Status</th>
                                <th>Action</th>
                              </tr>
                              </thead>
                              <tbody>
                                  @php $i=0; @endphp
<?php foreach ($fee_waivier as $fee_waivier): ?>
    @php $i++; @endphp
<tr>
  <td><?php echo $i; ?></td>
    <td>{{$fee_waivier->stu_name}} - {{$fee_waivier->reg_no}}</td>
    <td>{{$fee_waivier->fee_category}}</td>
    <td>{{$fee_waivier->amt}}</td>
    <td>{{$fee_waivier->acadmic_year}}</td>
    @if($fee_waivier->status==1)
    <td><span style="color:green;">Active</span></td>
    @else
    <td><span style="color:red;">Inactive</span></td>
    @endif
    <td>
      <div class="btn-group">
        <button type="button" class="btn btn-default  btn-flat dropdown-toggle" data-toggle="dropdown">
          <span class="caret"></span>
          <span class="sr-only">Toggle Dropdown</span>
        </button>
        <ul class="dropdown-menu" role="menu" title="Action">
          <li><a href="{{url('finance/waiver/view/'.Crypt::encrypt($fee_waivier->id))}}" title="Edit"><i  class="fa fa-eye" style="color: #897df8e6";></i></a></li>
          <li style="display:none;"><a class="tFileDelete" href="" id="{{$fee_waivier->id}}"  title="Delete"><i class="fa fa-trash" style="color: red";></i></a></li>
          <li><a href="{{url('finance/waiver/update-status/'.$fee_waivier->status.'/'.Crypt::encrypt($fee_waivier->id))}}" title="delete"><i class="<?php if($fee_waivier->status==1) echo "fa fa-thumbs-down"; else echo "fa fa-thumbs-up"; ?>" style="color: red";></i></a></li>

        </ul>
      </div>
    </td>
  </tr>
<?php endforeach; ?>
                            </tbody>
                            </table>
                          </div>
                        </div>
                          </div>
                        </div>
                        </div>
                      </form>
                </div>
              </div>
            </div>
          </div>
          </div>
            </div>
              </section>
    <!-- /.content -->

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
         $("#deduction_type").change(function(){
           if(this.value=="%"){
             $("#tp").text("%");
           }else{
             $("#tp").text("Amount");
           }
         })
           /*For Details Loading*/
           $("#student").change(function(){
              $("#tbl").hide();
           });

           $("#wby").change(function(){
              //var by=this.value;
              if(this.value==""){
                $("#st").hide();
                $("#ct").hide();
              }
              if(this.value=="student"){
              //  alert();
                $("#st").show();
                $("#ct").hide();
              }else{
                $("#st").hide();
                $("#ct").show();
              }
           });

           $("#fee_subcategory").change(function(){
               var sub_category = $(this).val();
               var category = $("#feecategory").val();
               var reg_no = $("#student").val();
            //  alert(id);
                var wby=$("#wby").val();
                //alert(wby);
               var _url = $("#_url").val();
              if(wby=="student"){
               $.ajax
               ({
                   type: "POST",
                   url: _url + '/finance/fee/waiver/stuinfo',
                   data: {sub_category: sub_category,category:category,reg_no:reg_no},
                   cache: false,
                   success: function ( data ) {
                  //  data=JSON.parse(data);
                      var array = data.split("|");
                      //  alert(array[0]);
                        $('#stname').text(array[0]);
                        $("#class").text(array[1]);
                        $("#section").text(array[2]);
                        $("#accyear").text(array[3]);
                        $("#fee").text(array[4]);
                        $("#tbl").effect( "slide", "slow" );
                   },
                   error: function (jqXHR, exception) {
                     $("#tbl").hide();
        var msg = '';
        if (jqXHR.status === 0) {
            msg = 'Not connect.\n Verify Network.';
        } else if (jqXHR.status == 404) {
            msg = 'Requested page not found. [404]';
        } else if (jqXHR.status == 500) {
          //  msg = 'Internal Server Error [500].';
          msg='Fee Details not found for this fee sub-category.';
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

}

           });

       });
   </script>
<script>
       $(document).ready(function () {
           /*For Details Loading*/
           $("#feecategory").change(function(){
               var id = $(this).val();
            //  alert(id);
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
$(document).ready(function() {
   $.extend($.fn.dataTable.defaults, {
 dom: 'Bfrtip'
});
   $('#example').DataTable( {
       buttons: [
           'copy', 'csv', 'excel', 'pdf', 'print'
       ],
       responsive: true,
       pageLength: 50,
   } );
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
