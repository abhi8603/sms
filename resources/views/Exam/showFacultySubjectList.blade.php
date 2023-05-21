<div class="box box-info">
         <div class="box-header with-border">
           <h3 class="box-title">Subject List</h3>
         </div>
          <div class="box-body">
            <div class="row">
            <?php if(count($s) > 0){
                foreach ($s as $key => $value) { ?>
                <div class="col-md-3">
              <!--    <a class="subject btn btn-primary"
                  id="<?php echo $value->subject_name."|".$value->subject."|".$value->course."|".$value->batch."|".$value->acadmic_year;  ?>"><?php echo $value->subject_name;?></a>
                -->
                <a class="subject btn <?php if($value->status==1){echo "btn-success";}else{echo "btn-primary";} ?>"
                id="<?php echo $value->subject."|".$value->course."|".$value->batch."|".$value->acadmic_year;  ?>"><?php echo $value->subject_name;?></a>
                </div>

              <?php  }
            }else{ ?>
              <div class="col-md-12">
              <h5 style="text-align: center;color:red">Subject Not Found.</h5>
            </div>
          <?php  } ?>
            </div>
          </div>
        </div>

<?php if(count($s) > 0){ ?>
  <div id="stu_list">
  </div>
  <?php } ?>

<script>
$(document).ready(function(){
  $(".subject").on("click",function(){
  //  alert($("#exam_id").val());
  $('#overlay').show();
   var _url = $("#_url").val();
  $.ajax
  ({
      type: "POST",
      url: _url + '/Exam/student_details',
      data: {data:this.id,exam_id:$("#exam_id").val()},
      cache: false,
      success: function ( data ) {
        $("#stu_list").html(data);
        $('#overlay').hide();

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
