<div class="box box-info">
         <div class="box-header with-border">
           <h3 class="box-title">Create Time Table</h3>
         </div>
<div class="box-body" id="cls_time">
  <div class="row">
    <div class="col-md-12">
                  <table id="example" class="table">
                    <thead>
                      <tr>
                        <th>Day</th>
                        <th>Time</th>
                        <th>Subject</th>
                        <th>Room No</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php

               $timestamp = strtotime('next Monday');
              $days = array();
              for ($i = 0; $i < 6; $i++) {
                  $days[] = strftime('%A', $timestamp);
                  $timestamp = strtotime('+1 day', $timestamp);

                  ?><tr>
                      <td style="width:25%">
                        <input type="text" class="form-control" value="<?php echo $days[$i]; ?>" style="background-color: white;border:0; " readonly required>
                        <input type="hidden" class="day form-control" value="<?php echo $i+1; ?>" style="background-color: white;border:0; " name="day[]" readonly>

                      </td>
                      <td>
                        <input type="text" class="time form-control" name="time" value="{{$periodTime[0]->start_time}} - {{$periodTime[0]->end_time}}" style="background-color: white;border:0; " readonly required>
                      </td>
                      <td style="width:35%">
                      <select style="width: 100%;" name="subject"  class="subject form-control select2" required>
                        <?php foreach ($subjects as $key => $value): ?>
                          <option value="{{$value->subject}}">{{$value->subject_name}}</option>

                        <?php endforeach; ?>

                      </select>
                    </td>
                     <td style="width:35%">
                       <select style="width:100%" name="room_no"  class="room_no select2 form-control" required>
                         <?php foreach ($room_no as $key => $value): ?>
                           <option value="{{$value->room_no}}">{{$value->room_no}}</option>
                         <?php endforeach; ?>
                       </select>
                     </td>
                     <td><a class="btn btn-primary save" id="save"><i class="fa fa-save"></i></a></td>
                  </tr>
                  <?php
              }
            ?>
                   </tbody>

                  </table>
            <!--        <button type="submit" name="submit" class="btn btn-primary">Submit</button>-->
    </div>
  </div>
</div>
</div>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
  });
</script>
<script>
$(document).ready(function(){


table=$("#example").DataTable({
  drawCallback: function() {
     $('.dt-select2').select2();
  }
});
  $('#example tbody').on('click', '.save', function (){


   var timetable = new Array();
   var timeslot = {};
   var row = $(this);

   timeslot.day= row.parents('tr').find('td:eq(0) .day').val();
   timeslot.time= row.parents('tr').find('td:eq(1) .time').val();
   timeslot.subject= row.parents('tr').find('td:eq(2) .subject').val();
   timeslot.room_no= row.parents('tr').find('td:eq(3) .room_no').val();
   timeslot.class=$("#courses").val();
   timeslot.section= $("#batch").val();
   timeslot.period= $("#period").val();
   timetable.push(timeslot);
//   alert(JSON.stringify(timetable));
   var data =JSON.stringify(timetable)
   var _url = $("#_url").val();
//   alert(_url);
//   exit;
   $.ajax({
     type: "POST",
     url: _url + "/createtimetable",
     data: {data: data},
     success: function (data) {
         alert(data)

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
