@extends('header')
@section('style')
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
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
        <li class="active">View Fee Wavier </li>
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
              </ul>
              <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                  <div class="box-body">
                    <div class="row">
                      <div class="col-md-12">

                        <!-- /.form-group -->
                        <div class="box box-primary">
                               <form role="form" method="post" enctype="multipart/form-data" action="{{url('finance/waiver/update')}}">
                                   <div class="box-body">
                                     <div class="col-md-12">
                                       <div class="form-group">
                                         <label for="exampleInputEmail1">Student</label>
                                         <select class="form-control select2" id="student" name="student" style="width: 100%;" readonly>
                                             <option value="" selected="selected">Please Select Student</option>
                                             <?php foreach ($stu_info as $stu_info): ?>
                                               <option <?php if($data->stu_reg_no==$stu_info->reg_no) {echo "selected";} ?> value="{{$stu_info->reg_no}}" >{{$stu_info->stu_name}} - ({{$stu_info->reg_no}})</option>
                                               <?php endforeach; ?>
                                      </select>
                                    </div>
                                     <div class="form-group">
                                       <label for="exampleInputEmail1">Fee Category<span style="color:red;"> *</span></label>
                                       <select class="form-control select2" id="feecategory" name="feecategory" style="width: 100%;" required>
                                           <option value="" selected="selected">Select Fee Category</option>
                                      <?php foreach ($fee_category as $fee_category): ?>
                                          <option <?php if($data->fee_category==$fee_category->id) {echo "selected";} ?> value="{{ $fee_category->id }}">{{ $fee_category->fee_category}}</option>
                                      <?php endforeach; ?>

                                    </select>
                                        </div>
                                        <div class="form-group">
                                          <label for="exampleInputEmail1">Fee Sub Category Name<span style="color:red;"> *</span></label>
                                          <select class="form-control select2" id="fee_subcategory" name="fee_subcategory" style="width: 100%;" required>
                                              <option value="" selected="selected">Select Fee Category</option>
                                              @if($data->fee_subcategory)
                                              <option value="{{$data->fee_subcategory}}" selected="selected">{{$data->fee_subcategory or ''}}</option>
                                              @endif

                                         </select>
                                       </div>

                                 <div class="form-group">
                                   <label for="exampleInputEmail1">Excemption or Deduction</label>
                                   <select class="form-control select2" id="type" name="type" style="width: 100%;">
                                       <option value="" selected="selected">Please Select Excemption or Deduction</option>
                                           <option <?php if($data->type=="Deduction") {echo "selected";} ?> value="Deduction" >Deduction</option>
                                           <option <?php if($data->type=="Excemption") {echo "selected";} ?> value="Excemption" >Excemption</option>
                                </select>
                              </div>
                                 <div class="form-group">
                                   <label for="exampleInputEmail1" id="typechn">Deduction Amount (In ₹)<span style="color:red;"> *</span></label>
                                   <input type="text" class="form-control" value="{{$data->amt or ''}}" id="Amount" name="amount" placeholder="Amount" onkeypress="return isNumber(event)" >
                                   <input type="hidden" class="form-control" value="{{$data->id or ''}}" id="id" name="id" placeholder="Amount" onkeypress="return isNumber(event)" readonly>

                                 </div>
                                  <div class="box-footer">
                                         <!-- <button type="submit" class="btn btn-primary">Save</button>-->
                                         <input type="submit" class="btn btn-primary" name="submit" value="Update">
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


<script>
       $(document).ready(function () {
           /*For Details Loading*/
           $("#student").change(function(){
              $("#tbl").hide();
           });

           $("#fee_subcategory").change(function(){
               var sub_category = $(this).val();
               var category = $("#feecategory").val();
               var reg_no = $("#student").val();
            //  alert(id);
               var _url = $("#_url").val();

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
