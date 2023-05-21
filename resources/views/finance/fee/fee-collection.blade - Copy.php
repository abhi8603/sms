@extends('header')
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
        <li><a href="#"><i class="fa fa-dashboard"></i>Student</a></li>

        <li class="active">Student List</li>
      </ol>
    </section>

    <!-- Main content -->
      <section class="content">
          @include('notification.notify')
    <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">search Student</h3>

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
                           <form role="form" method="post"  enctype="multipart/form-data" action="{{url('finance/Fee/fee-Collection/get')}}">
                          <div class="box-body">
                             <div class="col-md-5">
                            <div class="form-group">
                              <label for="exampleInputEmail1">Name Or Registration No</label>
                              <select class="form-control select2" id="name" name="stu_reg_no" style="width: 100%;">
                                  <option value="0" selected="selected">Select or type Student Name or Registration No</option>
                                <?php foreach ($students as $students): ?>
                                      <option value="{{$students->reg_no}}">{{$students->fname}} {{$students->mname}} {{$students->lname}} ({{$students->reg_no}})</option>
                                <?php endforeach; ?>
                           </select>
                         </div>
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
                <div class="form-group col-md-4">
                 <label for="exampleInputEmail1">Student Name<span style="color:red;"> *</span></label>
                 <input type="text" class="form-control" id="student_name" name="stu_name" value="" readonly>
                </div>
                <div class="form-group col-md-4">
                 <label for="exampleInputEmail1">Registration No.<span style="color:red;"> *</span></label>
                 <input type="text" class="form-control" id="reg_no" name="courses" value="" readonly>
                </div>
                <div class="form-group col-md-4">
                 <label for="exampleInputEmail1">Class/Course<span style="color:red;"> *</span></label>
                 <input type="text" class="form-control" id="class" name="course" value="" readonly>
                </div>
                <div class="form-group col-md-4">
                 <label for="exampleInputEmail1">Section/Batch<span style="color:red;"> *</span></label>
                 <input type="text" class="form-control" id="batch" name="batch" value="" maxlength="10" readonly>
                </div>
                <div class="form-group col-md-4">
                 <label for="exampleInputEmail1">Name of Guardian</label>
                 <input type="text" class="form-control" id="parents" name="parent_name" maxlength="10" value="" readonly>
                </div>
                <div class="form-group col-md-4">
                 <label for="exampleInputEmail1">Contact No.<span style="color:red;"> *</span></label>
                 <input type="text" class="form-control" id="contact" name="contact_no" value="" readonly>
                </div>
                <div class="form-group col-md-4">
                 <label for="exampleInputEmail1">Address<span style="color:red;"> *</span></label>
                 <textarea type="text" rows="3" class="form-control" id="address" name="father_aadhar" value="" readonly></textarea>
                </div>
                <div class="col-md-12">
                <div class="box-header with-border">
                  <h3 class="box-title">Fee details:-</h3>
                </div>
                <div class="form-group col-md-3">
                  <label for="exampleInputEmail1">Months</label>
                  <select class="form-control select2" multiple="multiple" id="month" name="month" style="width: 100%;">
                      <option value="1" >January</option>
                      <option value="2" >February</option>
                      <option value="3" >March</option>
                      <option value="4" >April</option>
                      <option value="5" >May</option>
                      <option value="6" >June</option>
                      <option value="7" >July</option>
                      <option value="8" >August</option>
                      <option value="9" >September</option>
                      <option value="10" >October</option>
                      <option value="11" >November</option>
                      <option value="12" >December</option>
               </select>
             </div>

          <div class="form-group col-md-3">
                          <label>Date</label>
                          <div class="input-group date">
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control pull-right" value="{{ old('dob') }}" id="dob" name="start_date" required>
                          </div>
                          <!-- /.input group -->
                        </div>


                        <div class="box-body">
                          <table id="example" class="table table-striped table-bordered display nowrap" style="width:100%">
                            <thead>
                      <tr>
                        <th></th>
                      <th>Fee Head</th>
                        <th>Fee Name</th>
                      <th>Total</th>

                        </tr>
                    </thead>
                            <tbody>
                              <?php foreach ($fee_name as $fee_name): ?>
                                <tr>
                                  <td></td>
                                  <td>{{$fee_name->fee_category}}</td>
                                  <td>{{$fee_name->sub_category}}</td>
                                  <td>{{$fee_name->amount}}</td>

                                </tr>
                              <?php endforeach; ?>

                            </tbody>

                          </table>
                        </div>
                        <div class="optionBox box-body">
                          <div class="form-group col-md-3"  style="text-align: center;">
                            <label for="exampleInputEmail1">Mode of Payment</label>
                        </div>
                        <div class="form-group col-md-3"  style="text-align: center;">
                          <label for="exampleInputEmail1">Mode of Payment</label>
                      </div>
                      <div class="form-group col-md-3"  style="text-align: center;">
                        <label for="exampleInputEmail1">Mode of Payment</label>
                    </div>
        <div class="block col-md-9">
          <!--  <span class="add">Add Option</span>-->
        </div>
    </div>
                        <div class="form-group col-md-3">
                          <label for="exampleInputEmail1">Mode of Payment</label>
                          <select class="form-control select2" id="paymode" name="paymode" style="width: 100%;">
                              <option value="Cash" >Cash</option>
                              <option value="Check" >Check</option>

                       </select>
                      </div>
                      <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">Remark</label>
                      <textarea class="form-control" name="remark" placeholder="Remark"></textarea>
                    </div>
                    <div class="form-group col-md-3">
                     <label for="exampleInputEmail1">Total Amount<span style="color:red;"> *</span></label>
                     <input type="text" class="form-control" id="totamt" name="totamt" value="0">
                    </div>


      <div class="box-footer">
      <button type="submit" class="btn btn-primary">Save</button>
      <h3 class="customerIDCell"></h3>
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
<script>
       $(document).ready(function () {
         //#example tbody tr
  /*      $("#example tbody tr").on('click', function (event)
    {
    //  var table = $('#example').DataTable();

          var customerId = $(this).find("td").eq(3).html();
          alert(customerId);
          /*    if(v3=="1"){
              v3="January";
              }
              if(v3=="2"){
                v3="February";
              }
              if(v3=="3"){
                v3="March";
              }
              if(v3=="4"){
                v3="April";
              }
              if(v3=="5"){
                  v3="May";
              }
              if(v3=="6"){
                  v3="June";
              }
              if(v3=="7"){
                  v3="July";
              }
              if(v3=="8"){
                  v3="August";
              }
              if(v3=="9"){
                  v3="September";
              }
              if(v3=="10"){
                  v3="October";
              }
              if(v3=="11"){
                  v3="November";
              }
              if(v3=="12"){
                  v3="December";
              }
    });*/

           /*For Details Loading*/
           $("#routes").change(function(){
               var id = $(this).val();
              // alert(id);
               var _url = $("#_url").val();
            //    alert(_url);
               var dataString = 'eid=' + id;
               $.ajax
               ({
                   type: "POST",
                   url: _url + '/transport/routedestination',
                   data: dataString,
                   cache: false,
                   success: function ( data ) {
                     data=JSON.parse(data);
                      //  alert(data);
                         var list = $("#destination");
                      $(list).empty().append('<option selected="selected" value=""> Please Select </option>');

                     $(data).empty();
                      var emptycarno="No Destination available for this Route";
             if(data.length==""){
                        $("#destination").append('<option value="' +emptycarno +'" selected="selected">' + emptycarno + '</option>');
                        alert(emptycarno);
             }
               else{
                        for (var i in data) {
                          var v=data[i]['id'];
                          var v1=data[i]['pickanddrop'];
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
      //   $("#stuinfo").hide();
           /*For Details Loading*/
           $("#name").change(function(){
              $("#stuinfo").hide();
               var id = $(this).val();
               var _url = $("#_url").val();
               var dataString = 'eid=' + id;
               $.ajax
               ({
                   type: "POST",
                   url: _url + '/student/stuinfo',
                   data: dataString,
                   cache: false,
                   success: function ( data ) {
                  //   alert(data);
                  // $("#stuinfo").show();
                       $("#stuinfo").slideToggle("slow");
                  //  $("#stuinfo").fadeIn('slow');
                    var preamt= $("#totamt").val('0');
                      $( "#feediv" ).empty();
                     var array = data.split("|");

                     $("#reg_no").val(array[0]);
                     $("#student_name").val(array[1]);
                     $("#class").val(array[2]);
                     $("#batch").val(array[3]);
                     $("#parents").val(array[4]);
                     $("#contact").val(array[5]);
                     $("#address").val(array[6]);
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
            msg = 'Internal Server Error [500].';

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
$(document).ready(function() {
  var mytable = $("#example").DataTable({
           columnDefs: [
               {
            orderable: false,
            className: 'select-checkbox',
            targets:   0,
               }
           ],
           select:{
              style: 'multi',
              selector: 'td:first-child'
           },
           order: [[1, 'asc']]
       });
       var rowsel = mytable.column(0).checkboxes.selected();

     $("#example tbody tr").on('click', function (event){
       var count = $('#month option:selected').length;
       if(count=='0'){
         alert("Please Select Months.");
         $("#totamt").val("0");
         $(this).removeClass( "selected" )

       }else{
       if($(this).hasClass("selected")){
        //alert("unchecked");
            var amt = $(this).find("td").eq(3).html();
            var preamt= $("#totamt").val();
            if(preamt==0){

            }else{
            var newamt=parseInt(preamt)-parseInt(amt*count);
            $("#totamt").val(parseInt(newamt));
          }
       }else{

          var amt = $(this).find("td").eq(3).html();
          var feename = $(this).find("td").eq(2).html();
            var feecat = $(this).find("td").eq(1).html();
            alert(feename);
          var preamt= $("#totamt").val();
          var newamt=parseInt(preamt)+parseInt(amt*count);

             $('.block:last').before('<div class="block"><div class="form-group col-md-12"><input style="margin:10px" type="text" class="col-md-3" name="feename[]" value=' + feename + ' /><input type="text" style="margin:10px" class="col-md-3" name="feecat[]" value=' + feecat + ' /><input type="text" style="margin:10px" class="col-md-3 amtt" name="amt[]" value=' + amt + ' /><a style="margin-top:3px" class="btn btn-primary remove"><i class="fa fa-trash" style="color: red" ;=""></i></a></div>');
          $("#totamt").val(parseInt(newamt));
          $('.optionBox').on('click','.remove',function() {
 	          $(this).parent().remove();
        var aa=  $( this).chilre('.block').find('.form-grou').find('.amtt').val();

        alert(aa);
          });
       }
     }

 } );

   } );

</script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
    $('#startdate').datepicker({
      autoclose: true,
      format:'dd-mm-yyyy'
    });
    $('#dob').datepicker({
      autoclose: true,
      format:'dd-mm-yyyy'
    });
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
