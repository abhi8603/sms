<div class="row">
  <div class="col-md-12">
    <div class="box box-info">
      <div class="box-header">
        <h3 class="box-title">Hostel Occupancy/Availability View</h3>
      </div>
      <div class="box-body">
        <div class="col-md-4"><i style="color:red" class="fa fa-bed" aria-hidden="true"></i> Available</div>
        <div class="col-md-4"><i style="color:green" class="fa fa-bed" aria-hidden="true"></i> Occupied</div><br><br>
        <?php foreach ($data as $value): ?>
        <div class="col-md-4">
          <div class="callout callout-info">
                <h4>{{$value->hostel_name}}-{{$value->hotel_type}}</h4>
                <p><span>Room No/Floor : </span>{{$value->room_no}}/{{$value->floor_name}}</p>
                <p><span>No of Beds : </span>{{$value->no_of_bed}}</p>
                <?php $allocateinfo=explode(',',$value->allocateinfo); ?>
                @for($i=0; $i < $value->no_of_bed;$i++)
                <?php //echo count($allocateinfo); ?>
                <a data-toggle="modal" data-target="#myModal" class="hostelinfo" id="<?php if(isset($allocateinfo[$i])){echo $allocateinfo[$i]; }else{ echo "0"; } ?>" style="cursor: pointer;font-size: 30px;padding-right: 15px;"><i style="<?php
                if($value->useroom <= $i){
                  echo "color:red";
                  }else{
                    echo "color:green";
                  }

                 ?>" class="fa fa-bed" aria-hidden="true"></i></a>
                @endfor
              </div>
        </div>
      <?php endforeach; ?>


      </div>

    </div>

    </div>
    <div class="col-md-12">
      <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Hostel Allocation Info</h4>
        </div>
        <div class="modal-body">
        <div id="hinfo">
        </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>
  </div>

</div>

<script>

 $(document).ready(function () {
   $(".hostelinfo").click(function(){
     var id=this.id;
     if(id==0){
       alert("This Bed Not Allocated.");
       return false;
     }
      var _url = $("#_url").val();
    //   alert(_url);
       $.ajax
       ({
           type: "POST",
           url: _url + '/hostel/report/hostel_allocation_info',
           data: {id:id},
           cache: false,
           success: function ( data ) {

             $("#hinfo").html(data);


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

   })
 });
</script>
