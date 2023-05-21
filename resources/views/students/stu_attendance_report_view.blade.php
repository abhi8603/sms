<table id="reporttable" class="table table-striped table-bordered">
                                        <thead>
                                  <tr>
                                  <th>Sl. No.</th>
                                  <th>Student Name</th>
                                  <th>Total Class</th>
                                  <th>Month</th>
                                  @for($k=1;$k<= $no_of_days;$k++)
                                  <th>{{$k}}</th>
                                  @endfor
                                    </tr>
                                </thead>
                                        <tbody>
                                       @php $i=0; @endphp
                                    @foreach($attendance as $value) @php $i=$i+1; @endphp
                                    <tr>
                                    <td>{{$i}}</td>
                                    <td>{{$value->name}}</td>
                                    <td>{{$value->total_class}}</td>
                                    <td>{{$value->month}}</td>
                                  <?php  $dt=explode(",",$value->attendance);  ?>
                                  <?php //print_r($dt);  ?>
                                    @for($k=1;$k <= $no_of_days;$k++)
                                    <?php 
                                  //  echo count($dt);
                                    for($j=0 ;$j < count($dt) ;$j++){                                           
                                            $dtt=explode("-",$dt[$j]);
                                            //echo"<br>".$dtt[0];
                                           $days= $dtt[0];
                                            if(intval($k)==intval($days)){
                                                $value=$dtt[1]; ?>                                               
                                         <?php   }else{
                                                $value=""; ?>
                                              
                                         <?php   }
                                    }
                                    
                                   // exit;
                                    ?>
                                    <td> {{$value}} </td>  
                                    @endfor  
                                                    
                                    </tr>
                                    @endforeach

                                        </tbody>

                                      </table>



<script>
  $(document).ready(function () {
    var tb = $('#reporttable').DataTable({
            scrollY:        "300px",
            scrollX:        true,
            scrollCollapse: true,
            paging:         false,           
            fixedColumns: true,

            bDestroy: true,
          //  responsive: true
            });
  });
</script>