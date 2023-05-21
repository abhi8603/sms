@extends('header')
@section('style')
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/select2/dist/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/bootstrap-daterangepicker/daterangepicker.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/plugins/timepicker/bootstrap-timepicker.min.css') }}">


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

          <li><a href="#"><i class="fa fa-dashboard"></i> Stock</a></li>
        <li class="active">Isuue Item</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        @include('notification.notify')
  <div class="box box-default">
            <div class="box-header with-border">
           <h3 class="box-title">Issue Item</h3>
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
                 <div class="box-header with-border">
                   <form role="form" method="post" enctype="multipart/form-data" action="{{url('stock/insert_issue_item')}}">
                          <div class="row">
                            <div class="col-sm-4">
                              <label>User Type</label>
                                  <select id="utype" name="user_type" class="form-control select2" style="width: 100%;">
                                <option selected="selected">Please Select</option>
                                <option value="student">Student</option>
                                <option value="employee">Employee</option>
                                </select>
                            </div>
                            <div id="stdnt" class="form-group col-sm-4">
                                  <label >Student<span style="color:red;"> *</span></label>
                                  <select id="student" name="issue_by_student" class="form-control select2" style="width: 100%;">
                                    <option value="0" selected="selected">Please Select</option>
                                  <?php foreach ($students as $students): ?>
                                      <option value="{{$students->reg_no}}">{{$students->stu_name}} - {{$students->reg_no}}</option>
                                  <?php endforeach; ?>
                                  </select>
                                </div>
                                    <div id="emp" class="form-group col-sm-4">
                                  <label >Employee <span style="color:red;"> *</span></label>

                          <select id="reg_emp" name="issue_by_emp" class="form-control select2" style="width: 100%;">
                                 <option value="0" selected="selected">Please Select</option>
                                  <?php foreach ($employess as $employess): ?>
                                      <option value="{{$employess->empcode}}">{{$employess->fname}} {{$employess->mname}} {{$employess->lname}} - {{$employess->empcode}}</option>
                                  <?php endforeach; ?>
                                  </select>
                                </div>                            
                            <div class="col-sm-4">
                              <label>Issue By</label>
                              <input type="text" name="issue_by" value="{{Auth::user()->emp_code}}" class="form-control" readonly>
                            </div>
                          </div>



                          <div class="row">
                            <div class="col-sm-4">
                              <label>Issue Date</label>
                              <div class="input-group date">
                                 <div class="input-group-addon">
                                   <i class="fa fa-calendar"></i>
                                 </div>
                                 <input type="text" class="form-control pull-right dob" value="{{ old('dob') }}" id="dob" name="issue_date" required>
                               </div>
                            </div>
                            <div class="col-sm-4">
                              <label>Return Date</label>
                              <div class="input-group date">
                                 <div class="input-group-addon">
                                   <i class="fa fa-calendar"></i>
                                 </div>
                                 <input type="text" class="form-control pull-right dob" value="{{ old('dob') }}" id="dob1" name="return_date" required>
                               </div>
                            </div>
                            <div class="col-sm-4">
                              <label>Note</label>
                              <textarea name="note" class="form-control"></textarea>
                            </div>
                          </div>
                           <div class="row">
                            <div class="col-sm-4">
                              <label>Item category</label>
                              <select name="category" id="category"  class="form-control select2" required>
                                <option>Plase Select</option>
                                @foreach($category as $cat)
                                <option value="{{$cat->id}}">{{$cat->category_name}}</option>
                                @endforeach
                              </select>
                            </div>
                            <div class="col-sm-4">
                              <label>Item</label>
                              <select name="item" id="item"  class="form-control select2" required>
                                <option>Plase Select</option>

                              </select>
                            </div>
                            <div class="col-sm-4">
                              <label>Qty</label>
                           <input type="number" name="qty" value="1" class="form-control">
                            </div>
                          </div><br>
                          <div class="row">
                             <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="col-sm-3">
                              <input type="submit" name="" value="Issue" class="btn btn-primary">
                            </div>
                          </div>
                           </form>
                         </div>
                  </div>
  </div>
</div>
</section>
  </div>

@endsection
{{--External Style Section--}}
@section('script')
<script src="{{ URL::asset('assets/bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/jquery/dist/bootbox.min.js') }}"></script>
 <script src="{{ URL::asset('assets/plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>

 <script>
       $(document).ready(function () {
           /*For Details Loading*/
           $("#category").change(function(){
             //alert(id);
             var eid=$("#category").val();
               var _url = $("#_url").val();
               var dataString = 'eid=' + eid;
              // alert(dataString);
               $.ajax
               ({
                   type: "POST",
                   url: _url + '/stock/itemlist',
                   data: dataString,
                   cache: false,
                   success: function ( data ) {
                     data=JSON.parse(data);

                      //   alert(data);
                         var list = $("#item");
                      $(list).empty().append('<option selected="selected" value=""> Please Select </option>');

                     $(data).empty();
                      var emptycarno="No batch available for this course";
             if(data.length==""){
                        $("#item").append('<option value="' +emptycarno +'">' + emptycarno + '</option>');
             }
               else{
                        for (var i in data) {
                          var v=data[i]['id'];
                          var v1=data[i]['item_name'];
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
            /*For Delete Application Info*/
            $(".tFileDelete").click(function (e) {
                e.preventDefault();
                var id = this.id;
                bootbox.confirm("Are you sure?", function (result) {
                    if (result) {
                        var _url = $("#_url").val();
                        window.location.href = _url + "/add-course/delete/" + id;
                    }
                });
            });

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
   $('#enq').DataTable( {

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
function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}
</script>

<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()


  })
</script>
<script>
function myday() {
  var x = document.getElementById("days").value;
  document.getElementById("demo").innerHTML = x;
}
</script>

<script>
      $(function () {
        //Initialize Select2 Elements
        $('.select2').select2();
        $('#startdate').datepicker({
          autoclose: true,
          format:'dd-mm-yyyy'
        });
        $('#dob').datepicker({
          autoclose: true,
          format:'dd-mm-yyyy'
        });
         $('#dob1').datepicker({
          autoclose: true,
          format:'dd-mm-yyyy'
        });
         $('#dob1').datepicker({
          autoclose: true,
          format:'dd-mm-yyyy'
        });
          $('#date1').datepicker({
          autoclose: true,
          format:'dd-mm-yyyy'
        });
           $('#date2').datepicker({
          autoclose: true,
          format:'dd-mm-yyyy'
        });
        $('.timepicker').timepicker({
              showInputs: false
            })
        //Datemask dd/mm/yyyy

      });
    </script>


<!--   Form vallidation -->
<script type="text/javascript">
  function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}
</script>

<script>
$(document).ready(function(){
$("#stdnt").hide();
$("#emp").hide();
$("#utype").change(function(){
     var types = $(this).val();
     if(types=='student'){
        $("#stdnt").show();
        $("#stdnt").fadeIn('slow');
        $("#emp").hide();
        $("#emp").fadeOut('slow');
        $("#stuinfo").hide();
        $("#stuinfo").fadeOut('slow');
        $("#empinfo").hide();
        $("#empinfo").fadeOut('slow');
      }else{
        $("#stdnt").hide();
        $("#dell").fadeOut('slow');
        $("#emp").show();
        $("#emp").fadeIn('slow');
        $("#stuinfo").hide();
        $("#stuinfo").fadeOut('slow');
        $("#empinfo").hide();
        $("#empinfo").fadeOut('slow');
      }
  });
});
</script>



@endsection
<!-- ./wrapper -->
