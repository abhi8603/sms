@extends('gurdian.main-header')
<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
<META HTTP-EQUIV="Expires" CONTENT="-1">

@section('style')
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/responsive.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/select.dataTables.min.css') }}">

<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/select2/dist/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/dataTables.checkboxes.css') }}">

@endsection

@section('content')
<style type="text/css">
input {
  border: none;
  background: transparent;
}
</style>
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
        <li><a href="#"><i class="fa fa-dashboard"></i>Finance</a></li>

        <li class="active">Pay Fee Online</li>
      </ol>
    </section>

    <!-- Main content -->
      <section class="content">
          @include('notification.notify')
    <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Search Student</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button style="display:none;" type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="box box-primary">
                           <form role="form" method="post"  enctype="multipart/form-data" action="{{url('finance/Fee/fee-details')}}">
                          <div class="box-body">
                            <div class="col-md-3">
                           <div class="form-group">
                             <label for="exampleInputEmail1">Academic Year</label>
                               <select class="form-control select2" name="acadmic_year" id="acadmic_year" style="width: 100%;">
                                 <option value="{{app_config('Session',Auth::user()->school_id)}}" selected="selected">{{app_config('Session',Auth::user()->school_id)}}</option>
                               </select>
                          </select>
                        </div>

                      </div>
                             <div class="col-md-4">
                            <div class="form-group">
                              <label for="exampleInputEmail1">Name Or Registration No</label>
                              <select class="form-control select2" id="name" name="stu_reg_no" style="width: 100%;" required>
                                  <option value="0" selected="selected">Select or type Ward Name or Registration No</option>
                                      <option value="{{Crypt::encrypt(session()->get('wardregno'))}}">{{session()->get('wardregno')}}</option>
                           </select>
                         </div>

                       </div>
                       <div class="form-group col-md-3">
                               <label style="display:none;">Date</label>
                               <div class="input-group date">
                                 <div class="input-group-addon" style="display:none;">
                                   <i class="fa fa-calendar"></i>
                                 </div>
                                 <input type="hidden" class="form-control pull-right dob" value="{{ old('dob') }}" id="dob" name="start_date" required readonly>
                               </div>
                               <!-- /.input group -->
                             </div>
                             <div class="form-group col-md-3">
                              <label style="display:none;" for="exampleInputEmail1">Receipt No.<span style="color:red;"> *</span></label>
                              <input type="hidden" class="form-control" id="receipt_no" name="receipt_no" value="{{ $receipt_no }}" required readonly>
                             </div>
             </div>

   </form>
   </div>                  <!-- /.form-group -->
        </div>
                <div class="col-md-12" id="stuinfo" style="display:none;">
                   <form role="form" id="myform" method="post" enctype="multipart/form-data" action="{{url('finance/Fee/fee-Collection/get')}}">
                  <div class="box-header with-border">
                    <h3 class="box-title">Student details:-</h3>
                  </div>
                <div class="form-group col-md-3">
                 <label for="exampleInputEmail1">Student Name<span style="color:red;"> *</span></label>
                 <input type="text" class="form-control" id="student_name" name="stu_name" value="" readonly>
                   <input type="hidden" class="form-control" id="receipt_no" name="receipt_no" value="{{ $receipt_no }}" required>
                </div>
                <div class="form-group col-md-3">
                 <label for="exampleInputEmail1">Registration No.<span style="color:red;"> *</span></label>
                 <input type="text" class="form-control" id="reg_no" name="reg_no" value="" readonly>
                </div>
                <div class="form-group col-md-3">
                 <label for="exampleInputEmail1">Class/Course<span style="color:red;"> *</span></label>
                 <input type="text" class="form-control" id="classs" name="course" value="" readonly>
                 <input type="hidden" class="form-control" id="course_code" name="course_code" value="" readonly>
                </div>
                <div class="form-group col-md-3">
                 <label for="exampleInputEmail1">Section/Batch<span style="color:red;"> *</span></label>
                 <input type="text" class="form-control" id="batch" name="batch" value="" maxlength="10" readonly>
                 <input type="hidden" class="form-control" id="batch_code" name="batch_code" value="" maxlength="10" readonly>
                </div>
                <div class="form-group col-md-4">
                 <label for="exampleInputEmail1" style="display:none;">Name of Guardian</label>
                 <input type="hidden" class="form-control" id="parents" name="parent_name" maxlength="10" value="" readonly>
                </div>
                <div class="form-group col-md-4">
                 <label for="exampleInputEmail1" style="display:none;">Contact No.<span style="color:red;"> *</span></label>
                 <input type="hidden" class="form-control" id="contact" name="contact_no" value="" readonly>
                </div>
                <div class="form-group col-md-4" style="display:none;">
                 <label for="exampleInputEmail1">Address<span style="color:red;"> *</span></label>
                 <textarea type="hidden" rows="3" class="form-control" id="address" name="father_aadhar" value="" readonly></textarea>
                </div>

                <div class="form-group col-md-12">

                                    <div class="checkbox col-md-2" style="margin-top: -5px;">
                                      <label>
                                        <input type="checkbox" class="months" name="months[]" id="April" value="04">
                                        April
                                      </label>
                                    </div>

                    <div class="checkbox col-md-2" style="margin-top: 0px;">
                      <label>
                        <input type="checkbox" class="months" name="months[]" id="May" value="05">
                        May
                      </label>
                    </div>
                    <div class="checkbox col-md-2" style="margin-top: 0px;">
                      <label>
                        <input type="checkbox" class="months" name="months[]" id="June" value="06">
                        June
                      </label>
                    </div>
                    <div class="checkbox col-md-2" style="margin-top: 0px;">
                      <label>
                        <input type="checkbox" class="months" name="months[]" id="July" value="07">
                        July
                      </label>
                    </div>
                    <div class="checkbox col-md-2" style="margin-top: 0px;">
                      <label>
                        <input type="checkbox" class="months" name="months[]" id="August" value="08">
                        August
                      </label>
                    </div>
                       <div class="checkbox col-md-2" style="margin-top: 0px;">
                           <label>
                             <input type="checkbox" class="months" name="months[]" id="September" value="09">
                             September
                           </label>
                         </div>
                         <div class="checkbox col-md-2" style="margin-top: 0px;">
                           <label>
                             <input type="checkbox" class="months" name="months[]" id="October" value="10">
                             October
                           </label>
                         </div>
                         <div class="checkbox col-md-2" style="margin-top: 0px;">
                           <label>
                             <input type="checkbox" class="months" name="months[]" id="November" value="11">
                             November
                           </label>
                         </div>
                         <div class="checkbox col-md-2" style="margin-top: 0px;">
                           <label>
                             <input type="checkbox" class="months" name="months[]" id="December" value="12">
                             December
                           </label>
                         </div>
                         <div class="checkbox col-md-2 form-group" >
                           <label>
                             <input type="checkbox" class="months" name="months[]" id="January" value="01">
                             January
                           </label>
                         </div>
                         <div class="checkbox col-md-2 form-group">
                           <label>
                             <input type="checkbox" class="months" name="months[]" id="February" value="02">
                             February
                           </label>
                         </div>
                         <div class="checkbox col-md-2">
                           <label>
                             <input type="checkbox" class="months" name="months[]" id="March" value="03">
                             March
                           </label>
                         </div>

                          </div>
                <div class="col-md-12">
                <div class="box-header with-border">
                  <h3 class="box-title">Payment Window</h3>
                </div>

                          <div class="form-group col-md-4" style="display: none">
                               <button type="button" class="add-row" class="btn btn-primary">Add New Fee</button>
                          </div>
                          <div class="form-group col-md-4">
                               <button type="button" class="cal" id="cal" class="btn btn-primary">Calculate Fee</button>
                          </div>
                          <div class="form-group col-md-4" style="display: none">
                               <button type="button" class="reset" id="reset" class="btn btn-primary">Reset Fee Amount</button>
                          </div>
                          <div id="feedisp">

                   <table id="example" class="table table-striped table-bordered display" style="width:100%">
                     <thead>
               <tr>
               <th>Fee Head</th>
               <th>Fee Name</th>
               <th>Actual Amount</th>
               <th style="display: none !important;">Amount due to be paid</th>
               <th>Discount</th>
               <th>Month</th>
               <th></th>
               <th></th>
               </tr>
             </thead>
                     <tbody>
<tr>
</tr>
                     </tbody>

                   </table>
                          </div>
                        <div class="form-group col-md-3">
                          <label for="exampleInputEmail1">Mode of Payment</label>
                          <select class="form-control select2" id="paymode" name="paymode" style="width: 100%;">
                              <option value="Online" selected>Online</option>
                       </select>
                      </div>
                      <div id="bank" style="display:none">
                        <div class="form-group col-md-3">
                          <label for="exampleInputEmail1">Bank Name</label>
                          <select class="form-control select2" id="bankname" name="bankname" style="width: 100%;">
                              <option value="" >Select Bank Name</option>
                              <option value="SBI" >SBI</option>
                              <option value="UBI" >UBI</option>
                              <option value="HDFC" >HDFC</option>
                              <option value="ICICI" >ICICI</option>
                              <option value="AXIS" >AXIS</option>

                       </select>
                      </div>
                      <div class="form-group col-md-3">
                       <label for="exampleInputEmail1">Cheque No<span style="color:red;"> *</span></label>
                       <input type="text" class="form-control" id="chequeno" name="chequeno" value="0">
                      </div>
                      <div class="form-group col-md-3">
                              <label>Cheque Date</label>
                              <div class="input-group date">
                                <div class="input-group-addon">
                                  <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control pull-right dob" value="{{ old('dob') }}" id="chekdate" name="chequedate">
                              </div>
                              <!-- /.input group -->
                            </div>
                    </div>

                      <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">Remark</label>
                      <input type="text" class="form-control pull-right" id="remark" name="remark" placeholder="Remark"/>
                    </div>
                    <div class="form-group col-md-3">
                     <label for="exampleInputEmail1">Total Amount<span style="color:red;"> *</span></label>
                     <input type="text" class="form-control" id="totamt" name="totamt" value="0" readonly>
                    </div>

                    <div class="form-group col-md-3 checkbox" style="display:none;">
                      <label>
                        <input type="checkbox" id="down">
                        Do you want receipt?
                      </label>
                    </div>
<br>
      <div class="box-footer col-md-12 form-group">
      <a id="save" class="btn btn-primary">Pay</a>

      </div>
      </div>

    <input type="hidden" name="_token" value="{{ csrf_token() }}">
</form>
                </div>

              </section>
    <!-- /.content -->
  </div>

</div>
  <!-- /.content-wrapper -->

@endsection
{{--External Style Section--}}
@section('script')
<script src="{{ URL::asset('assets/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/datatables.net-bs/js/dataTables.select.min.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/datatables.net-bs/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/datatables.net-bs/js/dataTables.checkboxes.min.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/datatables.net-bs/js/dataTableSum.js') }}"></script>
<script type='text/javascript'>

(function()
{
  if( window.localStorage )
  {
    if( !localStorage.getItem('firstLoad') )
    {
      localStorage['firstLoad'] = true;
      window.location.reload();
    }
    else
      localStorage.removeItem('firstLoad');
  }
})();

</script>
<script>
 $(document).ready(function () {
  $(document).keydown(function (event) {
    if (event.keyCode == 123) { // Prevent F12
        alert("Action not allowed.");
        return false;
    } else if (event.ctrlKey && event.shiftKey && event.keyCode == 73) { // Prevent Ctrl+Shift+I
      alert("Action not allowed.");
        return false;
    }
});
$('body').bind('cut copy paste select', function(e) {
  alert("Action not allowed");
    e.preventDefault();

});
   $(document).bind("contextmenu",function(e){
        return false;
     });
   $('#example').on("click", ".btn", function(){
     var ts = $('#example').DataTable({
    fixedColumns: true,
    bDestroy: true,
    scrollY:        "300px",
     scrollX:        true,
     scrollCollapse: true,
     paging:         false,
     columnDefs: [
         { width: 200, targets: 0 }
     ],
     fixedColumns: true,
     bDestroy: true
     });
  console.log($(this).parent());
  ts.row($(this).parents('tr')).remove().draw(false);
});
      $('#feepaid').click(function()
      {
        if ($('#down').is(':checked')) {
           // Do something...
            var month=($('#receipt_no').val());
           var course=$("#reg_no").val();
          //  alert(course);
            var _url = $("#_url").val();
          //  var dataString = 'eid=' + month,'course='+course;
            $.ajax
            ({
                type: "POST",
                url: _url + '/finance/Fee/fee-Collection/getpdf/',
                data: {eid:month,course:course},
                cache: false,
                success: function ( data ) {
                  alert(data);
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
        }else{
            var month=($(this).val());
        //    alert(month);
           $("#example").find("td:contains('"+month+"')").closest('tr').remove();
           var result = [];
              $('.price').each(function(index, val){
                if(!result[index]) result[index] = 0;
                 result[index] += parseInt($(this).val());
               });

             var total=0;
             for (var i = 0; i < result.length; i++) {
               total += result[i];
           }

           $('#totamt').val(total);
        }
      });
    });
</script>
<script type="text/javascript">
function minmax(value, min, max)
{
    if(parseInt(value) < min || isNaN(parseInt(value)))
        return min;
    else if(parseInt(value) > max)
        return max;
    else return value;
}
</script>

<script>
$(document).on("submit", "form", function(e){
  var cnt= $('#example tbody tr').length;
  //alert(cnt);
  if(cnt==0){
    e.preventDefault();
    alert('Please Select Months for fee collecion !');
    return  false;
  }
});
</script>
<script>
 $(document).ready(function () {
   $("#save").click(function(){
     if (confirm('Are you sure?')) {

  }else{
      return false;
  }
     var result = [];
     var results = [];
     var due = [];
     var discount = [];
     $('.price').each(function(index, val){
           var dd=parseInt($(this).val());
        //   alert(dd);
        if(!results[index]) results[index] = 0;
        results[index] += parseInt($(this).val());
      });

      $('.due').each(function(index, val){
            var dd=parseInt($(this).val());
          //  alert(dd);
         if(!due[index]) due[index] = 0;
         due[index] += parseInt($(this).val());
       });

       $('.discount').each(function(index, val){
             var dd=parseInt($(this).val());
           //  alert(dd);
          if(!discount[index]) discount[index] = 0;
          discount[index] += parseInt($(this).val());
        });

    var totals=0;
    for (var i = 0; i < results.length; i++) {

      totals += results[i];
  }

  var dues=0;
  for (var i = 0; i < due.length; i++) {

    dues += due[i];
}
//  alert(dues);
var discounts=0;
for (var i = 0; i < discount.length; i++) {

  discounts += discount[i];
}
 //alert(discounts);
  var finalamt=(parseInt(totals))-(parseInt(discounts));
  //alert(parseInt(totals));
  $('#totamt').val(finalamt);
//  $('#grandtotal').val(finalamt);

results = [];
due = [];
discount = [];


/*     var table = $('#example').DataTable({
    fixedColumns: true,
    bDestroy: true
  }); */
     var grandtotal=$("#totamt").val();
    // alert(alert);exit;
     if(grandtotal!='0'){
      var customers = new Array();
      var reg_no=$("#reg_no").val();
      var receipt_no=$("#receipt_no").val();
      var course_code=$("#course_code").val();
      var batch=$("#batch_code").val();
      var pay_mode=$("#paymode").val();
      var bankname=$("#bankname").val();
      var chequeno=$("#chequeno").val();
      var chekdate=$("#chekdate").val();
      var remark=$("#remark").val();
      var dob=$("#dob").val();
      var student_name=$("#student_name").val();

  //  alert(pay_mode);
  var cnt=0;
      $("#example tbody tr").each(function () {
        cnt++;
                var row = $(this);
                var customer = {};
                customer.feehead = row.find('td:eq(0) input').val();
                customer.feename = row.find('td:eq(1) input').val();
                customer.actualamount = row.find('td:eq(2) input').val();
                customer.discount = row.find('td:eq(3) input').val();
                customer.Month = row.find('td:eq(4) input').val();
                customer.due = "0";
                customers.push(customer);
              //  console.log(cnt);
            });
      //    alert(JSON.stringify(customers));
            var dataa =JSON.stringify(customers)
            var _url = $("#_url").val();
            $.ajax({
              type: "POST",
              url: _url + "/parents/ward/fee/payonline/get",
              data: {date: dataa,reg_no:reg_no,receipt_no:receipt_no,course_code:course_code,batch:batch,pay_mode:pay_mode,bankname:bankname,chequeno:chequeno,remark:remark,dob:dob,student_name:student_name,chekdate:chekdate},
              success: function (data) {
                //  alert(data)
                    if ($('#down').is(':checked')) {


                  }else{
                  //  location.reload();
                  //  table.clear().draw();
                    var _url = $("#_url").val();

                    window.location.href = _url + "/parents/ward/fee/payonline/paymentgatway/"+ btoa(receipt_no)
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
        }else{
          alert('Please Click On Calculate Fee Button. Total Amount Cannot be 0.');
        }
       });



 });
</script>


<script>

$(function()
    {
      $(".add-row").click(function(){
        var tt = $('#example').DataTable({
    //      createdRow: function(row, data, index) {
    //    $('td', row).eq(2).addClass('price'); // 6 is index of column
    //  },
      scrollY:        "300px",
       scrollX:        true,
       scrollCollapse: true,
       paging:         false,
       columnDefs: [
           { width: 200, targets: 0 }
       ],
       fixedColumns: true,
       bDestroy: true
      //  responsive: true
        });
        tt.row.add( [
              '<input type="text" class="form-control "  name="discount" value="" required></td>',
              '<input type="text" class="form-control "  name="discount" value="" required></td>',
              '<input type="text" class="form-control price" id="exprice" mouseout="SetDefault($(this).val());"  value="0" required></td>',
              '<input type="hidden" class="form-control due"  value="0" required></td>',
              '<input type="hidden" class="form-control discount"  value="0" required></td>',
              '<input type="text" class="form-control "  value="" required></td>',
              '<a class="btn"><i class="fa fa-trash" style="color: red";></i></a>',
              ''
               ] ).draw( false);
          });

      $('[name="months[]"]').change(function()
      {

        var t = $('#example').DataTable({
       scrollY:        "800px",
       scrollX:        true,
       scrollCollapse: true,
       paging:         false,
       columnDefs: [
           { width: 200, targets: 0,targets: [ 3 ],visible: false, },

           { width: 200, targets: 0,targets: [ 6 ],visible: false, }

       ],
       fixedColumns: true,
       responsive: true,
       bDestroy: true,
      });
        if ($(this).is(':checked')) {
           // Do something...

            var month=($(this).val());
              var mon=[];
            $(".months").each(function(){

                    // Test if the div element is empty
                    if($(this).is(":checked")){
                      var ch=parseInt($(this).val());
                      mon.push(ch);

                      if(ch <= month){
                      //  alert("ok");
                      }else{
                        //alert("not ok");
                      }
                    }
                });
                var prevmon=month-1;
                if(month !=1){
                if(mon.includes(prevmon)){

                }else{
                    if(month==04){
                    }else{
                   alert("Please Select valid Month.");
                   $(this).prop("checked", false);
                   return false;
                 }
                }
              }
            //    alert(prevmon);
           //console.log(mon);
           var course=$("#course_code").val();
           var reg_no=$("#reg_no").val();
      //      alert(course);
            var _url = $("#_url").val();
          //  var dataString = 'eid=' + month,'course='+course;
            $.ajax
            ({
                type: "POST",
                url: _url + '/finance/Fee/fee-details',
                data: {eid:month,course:course,reg_no:reg_no},
                cache: false,
                success: function ( data ) {
                  var array = data.split("|");
              //   alert(data);
                  data=JSON.parse(array[0]);
                  tranport=JSON.parse(array[1]);
                  hostel=JSON.parse(array[2]);
                    lastm=array[3];
                    fee_waiver=JSON.parse(array[4]);


                     if(data==""){
                       alert("Please Configure Fee Master for this Class/Section for this month");
                     }
                     for (var i in data) {
                       var v=data[i]['amount'];
                    //   sumamt+= parseInt(v);
                       var v1=data[i]['fee_category'];
                       var v2=data[i]['sub_category'];
                       var v3=data[i]['month'];
                       var feecat=data[i]['feecategory'];
                    //   console.log(feecat);
                       var feesubcat=data[i]['fee_subcategory'];
                      // console.log(feesubcat);
                       var cat;
                       var subcat;
                       var disamt;
                       if(v1 !='Admission'){
                       if(fee_waiver!=""){
                         for(var f in fee_waiver){
                            cat=fee_waiver[f]['fee_category'];
                          //  alert(cat);
                            subcat=fee_waiver[f]['fee_subcategory'];
                            disamt=fee_waiver[f]['amt'];
                         }

                    //     console.log(cat);
                    //     console.log(subcat);
                         if(feecat==cat && feesubcat==subcat){

                       t.row.add( [
                              '<input style="border:none;background:transparent;" type="text" class="form-control"   name="discount" value="'+v1+'" readonly></td>',
                              '<input style="border:none;background:transparent;" type="text" class="form-control"   name="discount" value="'+v2+'" readonly></td>',
                              '<input style="border:none;background:transparent;" type="text" class="form-control price"  value="'+v+'" readonly/></td>',
                              '<input style="border:none;background:transparent;" type="text" class="form-control due"  onkeyup="this.value = minmax(this.value, 0, 100000000)" name="discount" value="0" readonly></td>',
                              '<input style="border:none;background:transparent;" type="text" class="form-control discount" onkeyup="this.value = minmax(this.value, 0, 100000000)" name="discount" value="'+disamt+'" readonly></td>',
                              '<input style="border:none;background:transparent;" type="text" class="form-control "  value="'+v3+'" readonly></td>',
                               '',
                               v3
                              ] ).draw( false );
                            }else{
                          //    alert("not matched");
                              t.row.add( [
                                     '<input style="border:none;background:transparent;" type="text" class="form-control"   name="discount" value="'+v1+'" readonly></td>',
                                     '<input style="border:none;background:transparent;" type="text" class="form-control"   name="discount" value="'+v2+'" readonly></td>',
                                     '<input style="border:none;background:transparent;" type="text" class="form-control price"  value="'+v+'" readonly></td>',
                                     '<input style="border:none;background:transparent;" type="text" class="form-control due"  onkeyup="this.value = minmax(this.value, 0, 100000000)" name="discount" value="0" readonly></td>',
                                     '<input style="border:none;background:transparent;" type="text" class="form-control discount" onkeyup="this.value = minmax(this.value, 0, 100000000)" name="discount" value="0" readonly></td>',
                                     '<input style="border:none;background:transparent;" type="text" class="form-control "  value="'+v3+'" readonly></td>',
                                      '',
                                      v3
                                     ] ).draw( false );
                            }
                          }else{
                            t.row.add( [
                                   '<input style="border:none;background:transparent;" type="text" class="form-control"   name="discount" value="'+v1+'" readonly></td>',
                                   '<input style="border:none;background:transparent;" type="text" class="form-control"   name="discount" value="'+v2+'" readonly></td>',
                                   '<input style="border:none;background:transparent;" type="text" class="form-control price"  value="'+v+'" readonly></td>',
                                   '<input style="border:none;background:transparent;" type="text" class="form-control due"  onkeyup="this.value = minmax(this.value, 0, 100000000)" name="discount" value="0" readonly></td>',
                                   '<input style="border:none;background:transparent;" type="text" class="form-control discount" onkeyup="this.value = minmax(this.value, 0, 100000000)" name="discount" value="0" readonly></td>',
                                   '<input style="border:none;background:transparent;" type="text" class="form-control "  value="'+v3+'" readonly></td>',
                                    '',
                                    v3
                                   ] ).draw( false );
                          }
                        }
                              var result = [];
                                                    	$('.price').each(function(index, val){
                                                   //    var dd=parseInt($(this).val());
                                                     //  alert(dd);
                                                      	if(!result[index]) result[index] = 0;
                                                        result[index] += parseInt($(this).val());
                                                      });

                                                    var total=0;
                                                    for (var i = 0; i < result.length; i++) {
                                                      total += result[i];
                                                    }
                     }
                     var set='1';
                     if(set=='1'){
                      if(tranport!=""){
                     for (var j in tranport) {
                       var tt=tranport[j]['amt'];
                    //   sumamt+= parseInt(v);
                       var tt1=tranport[j]['route_code'];
                       var tt2=tranport[j]['pickanddrop'];
                       var tt3=tranport[j]['months'];
                       t.row.add( [
                              '<input style="border:none;background:transparent;" type="text" class="form-control"   name="discount" value="Transport Fee" readonly></td>',
                              '<input style="border:none;background:transparent;" type="text" class="form-control"   name="discount" value="'+tt2+'" readonly></td>',
                              '<input style="border:none;background:transparent;" type="text" class="form-control price"  value="'+tt+'" readonly readonly></td>',
                              '<input style="border:none;background:transparent;" type="hidden" class="form-control due"  onkeyup="this.value = minmax(this.value, 0, 100000000)" name="discount" value="0" readonly></td>',
                              '<input style="border:none;background:transparent;" type="text" class="form-control discount" onkeyup="this.value = minmax(this.value, 0, 100000000)" name="discount" value="0" readonly></td>',
                              '<input style="border:none;background:transparent;" type="text" class="form-control "  value="'+tt3+'" readonly></td>',
                              '',
                              tt3
                              ] ).draw( false );

                     }
                   }
                 }else{
                   t.row.add( [
                          '<input style="border:none;background:transparent;" type="text" class="form-control"   name="discount" value="Transport Fee" readonly></td>',
                          '<input style="border:none;background:transparent;" type="text" class="form-control"   name="discount" value="Transport Fee" readonly></td>',
                          '<input style="border:none;background:transparent;" type="text" class="form-control price"  value="0" readonly></td>',
                          '<input style="border:none;background:transparent;" type="hidden" class="form-control due"  onkeyup="this.value = minmax(this.value, 0, 100000000)" name="discount" value="0" readonly></td>',
                          '<input style="border:none;background:transparent;" type="text" class="form-control discount" onkeyup="this.value = minmax(this.value, 0, 100000000)" name="discount" value="0" readonly></td>',
                          '<input style="border:none;background:transparent;" type="text" class="form-control "  value="'+v3+'" readonly></td>',
                          '',
                          v3
                          ] ).draw( false );
                 }
                   if(hostel!=""){
                  for (var k in hostel) {
                    var hh=hostel[k]['amt'];
                 //   sumamt+= parseInt(v);
                   var hh1=hostel[k]['hostel_name'];
                //    var tt2=hostel[k]['pickanddrop'];
                var hh3=hostel[k]['months'];
                    t.row.add( [
                           '<input style="border:none;background:transparent;" type="text" class="form-control"   name="discount" value="Hotel Fee" readonly></td>',
                           '<input style="border:none;background:transparent;" type="text" class="form-control"   name="discount" value="'+hh1+'" readonly></td>',
                           '<input style="border:none;background:transparent;" type="text" class="form-control price"  value="'+hh+'" readonly></td>',
                           '<input style="border:none;background:transparent;" type="hidden" class="form-control due"  onkeyup="this.value = minmax(this.value, 0, 100000000)" name="discount" value="0" readonly></td>',
                           '<input style="border:none;background:transparent;" type="text" class="form-control discount" onkeyup="this.value = minmax(this.value, 0, 100000000)" name="discount" value="0" readonly></td>',
                           '<input style="border:none;background:transparent;" type="text" class="form-control "  value="'+hh3+'" readonly></td>',
                           '',
                           hh3
                           ] ).draw( false );
                  }
                }
                if(lastm !="0"){
                t.row.add( [
                       '<input style="border:none;background:transparent;" type="text" class="form-control"   name="discount" value="Late Fine" readonly></td>',
                       '<input style="border:none;background:transparent;" type="text" class="form-control"   name="discount" value="Late Fine" readonly></td>',
                       '<input style="border:none;background:transparent;" type="text" class="form-control price"  value="'+lastm+'" readonly></td>',
                        '<input style="border:none;background:transparent;" type="text" class="form-control due"  onkeyup="this.value = minmax(this.value, 0, 100000000)" name="discount" value="0" readonly></td>',
                        '<input style="border:none;background:transparent;" type="text" class="form-control discount" onkeyup="this.value = minmax(this.value, 0, 100000000)" name="discount" value="0" readonly></td>',
                        '<input style="border:none;background:transparent;" type="text" class="form-control "  value="'+v3+'" readonly></td>',
                        '<a class="btn"><i class="fa fa-trash" style="color: red";></i></a></td>',
                        v3
                       ] ).draw( false );

                                   var i=0;
                  /*  to remove late fine on every month select
                    t.rows().nodes().each(function(a,b) {
                       //row.find('td:eq(0) input').val();
                       i++;
             var lf=$(a).find('td:eq(0) input').val();
             //alert(dd);
                  if(lf== "Late Fine"){

                    t.rows(a).remove();
                   //  t.clear().draw();
                  }
                  return false;
                });*/
                     }else{

}
                  //   var result =[];
                     var results = [];
                     var due = [];
                     var discount = [];
                     $('#reset').on("click",function(){
                        $('#totamt').val('0');
                        results = [];
                        due = [];
                        discount = [];
                    });
                     $("#cal").click(function(){
                       $('.price').each(function(index, val){
                             var dd=parseInt($(this).val());
                          //   alert(dd);
                          if(!results[index]) results[index] = 0;
                          results[index] += parseInt($(this).val());
                        });

                        $('.due').each(function(index, val){
                              var dd=parseInt($(this).val());
                            //  alert(dd);
                           if(!due[index]) due[index] = 0;
                           due[index] += parseInt($(this).val());
                         });

                         $('.discount').each(function(index, val){
                               var dd=parseInt($(this).val());
                             //  alert(dd);
                            if(!discount[index]) discount[index] = 0;
                            discount[index] += parseInt($(this).val());
                          });

                      var totals=0;
                      for (var i = 0; i < results.length; i++) {

                        totals += results[i];
                    }

                    var dues=0;
                    for (var i = 0; i < due.length; i++) {

                      dues += due[i];
                  }
                //  alert(dues);
                  var discounts=0;
                  for (var i = 0; i < discount.length; i++) {

                    discounts += discount[i];
                }
                // alert(discounts);
                    var finalamt=(parseInt(totals))-(parseInt(discounts));
                    //alert(parseInt(totals));
                    $('#totamt').val(finalamt);
                  //  $('#grandtotal').val(finalamt);
                  results = [];
                  due = [];
                  discount = [];
                      });

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
        }else{

            var month=($(this).val());

        //   $("#example").find("td:contains('"+month+"')").closest('tr').remove();
        t.rows().nodes().each(function(a,b) {
//alert($(a).children().eq(7).html());
     if($(a).children().eq(5).html() == month){
    //  alert();
       t.rows(a).remove();
      //  t.clear().draw();
     }
     return false;
   }

);
    t.rows().invalidate();
    t.draw();
           var result = [];
              $('.price').each(function(index, val){
                if(!result[index]) result[index] = 0;
                 result[index] += parseInt($(this).val());
               });

             var total=0;
             for (var i = 0; i < result.length; i++) {
               total += result[i];
           }

           $('#totamt').val(total);

        }
      });
    });
</script>
<script>
       $(document).ready(function () {
      //   $("#stuinfo").hide();

      $("#paymode").change(function(){

      var id = $(this).val();
      if(id=='Cheque'){
        $("#bank").show();
      }else{
        $("#bank").hide();
      }
      });
           /*For Details Loading*/
           $("#name").change(function(){
              $("#stuinfo").hide();

               var id = $(this).val();
               var acadmic_year = $("#acadmic_year").val();
            //   alert(id);
               var _url = $("#_url").val();
               var dataString = 'eid=' + id;
               $.ajax
               ({
                   type: "POST",
                   url: _url + '/student/stuinfo',
                   data: {eid:id,acadmic_year:acadmic_year},
                   cache: false,
                   success: function ( data ) {
                  //  alert(data);
                  // $("#stuinfo").show();
                       $("#stuinfo").slideToggle("slow");
                  //  $("#stuinfo").fadeIn('slow');
                     $("#example tbody").find("tr").remove();
                     $('#January').prop('checked', false);
                     $('#January').removeAttr("disabled");
                     $('#February').prop('checked', false);
                     $('#February').removeAttr("disabled");
                     $('#March').prop('checked', false);
                     $('#March').removeAttr("disabled");
                     $('#April').prop('checked', false);
                     $('#April').removeAttr("disabled");
                     $('#May').prop('checked', false);
                     $('#May').removeAttr("disabled");
                     $('#June').prop('checked', false);
                     $('#June').removeAttr("disabled");
                     $('#July').prop('checked', false);
                     $('#July').removeAttr("disabled");
                     $('#August').prop('checked', false);
                     $('#August').removeAttr("disabled");
                     $('#September').prop('checked', false);
                     $('#September').removeAttr("disabled");
                     $('#October').prop('checked', false);
                     $('#October').removeAttr("disabled");
                     $('#November').prop('checked', false);
                     $('#November').removeAttr("disabled");
                     $('#December').prop('checked', false);
                     $('#December').removeAttr("disabled");
                    var preamt= $("#totamt").val('0');
                      $( "#feediv" ).empty();
                      var table = $('.table').DataTable();
                      table.clear().draw();
                     var array = data.split("|");

                     $("#reg_no").val(array[0]);
                     $("#student_name").val(array[1]);
                     $("#classs").val(array[3]);
                     $("#batch").val(array[2]);
                     $("#parents").val(array[4]);
                     $("#contact").val(array[5]);
                     $("#address").val(array[6]);
                        var months=array[7];
                     $("#course_code").val(array[8]);
                      $("#batch_code").val(array[10]);
                      paidmonths=JSON.parse(months);
                         for (var i in paidmonths) {
                           var v=paidmonths[i]['month'];
                           if(v=="01"){
                             $('#January').prop('checked', true);
                             $("#January").attr('disabled','disabled');
                           }
                           else if(v=="02"){
                             $('#February').prop('checked', true);
                             $("#February").attr('disabled','disabled');
                           }
                           else if(v=="03"){
                             $('#March').prop('checked', true);
                             $("#March").attr('disabled','disabled');
                           }
                          else if (v=="04"){
                             $('#April').prop('checked', true);
                             $("#April").attr('disabled','disabled');
                           }
                          else if(v=="05"){
                             $('#May').prop('checked', true);
                             $("#May").attr('disabled','disabled');
                           }
                          else if(v=="06"){
                             $('#June').prop('checked', true);
                             $("#June").attr('disabled','disabled');
                           }
                          else if(v=="07"){
                             $('#July').prop('checked', true);
                             $("#July").attr('disabled','disabled');
                           }
                           else if(v=="08"){
                             $('#August').prop('checked', true);
                             $("#August").attr('disabled','disabled');
                           }
                           else if(v=="09"){
                             $('#September').prop('checked', true);
                             $("#September").attr('disabled','disabled');
                           }
                          else if(v=="10"){
                             $('#October').prop('checked', true);
                             $("#October").attr('disabled','disabled');
                           }
                          else if(v=="11"){
                             $('#November').prop('checked', true);
                             $("#November").attr('disabled','disabled');
                           }
                          else if(v=="12"){
                             $('#December').prop('checked', true);
                             $("#December").attr('disabled','disabled');
                           }


                        }
                   },
                   error: function (jqXHR, exception) {
        var msg = '';
        if (jqXHR.status === 0) {
             $("#stuinfo").hide();
             $("#rollno").val('');
            msg = 'Not connect.\n Verify Network.';

        } else if (jqXHR.status == 404) {
             $("#stuinfo").hide();
             $("#rollno").val('');
            msg = 'Requested page not found. [404]';

        } else if (jqXHR.status == 500) {
             $("#stuinfo").hide();
             $("#rollno").val('');
          //  msg = 'Internal Server Error [500].';
              msg = 'Please Select Student.';

        } else if (exception === 'parsererror') {
           $("#stuinfo").hide();
           $("#rollno").val('');
            msg = 'Requested JSON parse failed.';

        } else if (exception === 'timeout') {
           $("#stuinfo").hide();
           $("#rollno").val('');
            msg = 'Time out error.';
        } else if (exception === 'abort') {
           $("#stuinfo").hide();
           $("#rollno").val('');
            msg = 'Ajax request aborted.';
        } else {
           $("#stuinfo").hide();
           $("#rollno").val('');
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
            /*For Delete Application Info*/
            $(".tFileDelete").click(function (e) {
                e.preventDefault();
                var id = this.id;
                bootbox.confirm("Are you sure?", function (result) {
                    if (result) {
                        var _url = $("#_url").val();
                        window.location.href = _url + "/student/delete/" + id;
                    }
                });
            });

        });
    </script>

<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
    $('.dob').datepicker({
      ignoreReadonly: false,
      autoclose: true,
      format:'dd-mm-yyyy'
    }).datepicker("setDate",'now');
  })
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
