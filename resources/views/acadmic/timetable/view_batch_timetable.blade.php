<div class="box-body">
            <div class="row">
                <div class="box box-info">
                         <div class="box-header with-border">
                            <h3 class="box-title">View Time Table</h3>
                         </div>

                          <div class="box-body">
                            <table id="example" class="table table-striped table-bordered display">
                              <thead>
                                <tr>
                                  <th>Period</th>
                                  <th style="width:250px;text-align:center;">Monday</th>
                                  <th style="width:250px;text-align:center;">Tuesday</th>
                                  <th style="width:250px;text-align:center;">Wednesday</th>
                                  <th style="width:250px;text-align:center;">Thursday</th>
                                  <th style="width:250px;text-align:center;">Friday</th>
                                  <th style="width:250px;text-align:center;">Saturday</th>
                                </tr>
                              </thead>
                              <tbody>
                                  @foreach($period  as $period)
                                <tr>
                                @php  $i=$period->period_name; @endphp
                                  <td>{{$period->period_name}}</td>
                                  <td>
                                    @foreach($timetable as $key=>$value)
                                    @php $j=0; @endphp
                                    @if($value->day==1 && $value->period==$i)
                                      @php $j++; @endphp
                                    <div style="width:100%;" class="col-md-4">
                                      <div class="callout callout-danger">
                                      <h4>{{$value->course_name}}/{{$value->batch_name}}</h4>
                                      <p><span>Day/Period : </span>  {{date('l', strtotime("Sunday + $value->day Days"))}} / {{$value->period}} </p>
                                      <p><span>Subject : </span>{{$value->subject_name}}</p>
                                      <p><span>Room No : </span>{{$value->room_no}}</p>
                                      <p><span>Teacher : </span>
                                        @if($value->emp_name !="")
                                        {{$value->emp_name}} ({{$value->emp_code}})
                                        @else
                                        Subject Teacher Not Assigned.
                                        @endif
                                      </p>
                                       </div>
                                   </div>
                                    @else
                                    @if($j>=1)
                                    <span>Time table Not Assigned</span>
                                    @endif
                                    @endif

                                    @endforeach
                                  </td>
                                  <td>
                                    @foreach($timetable as $key=>$value)
                                    @if($value->day==2 && $value->period==$i)
                                    <div style="width:100%;" class="col-md-4">
                                      <div class="callout callout-danger">
                                      <h4>{{$value->course_name}}/{{$value->batch_name}}</h4>
                                      <p><span>Day/Period : </span>  {{date('l', strtotime("Sunday + $value->day Days"))}} / {{$value->period}} </p>
                                      <p><span>Subject : </span>{{$value->subject_name}}</p>
                                      <p><span>Room No : </span>{{$value->room_no}}</p>
                                      <p><span>Teacher : </span>
                                        @if($value->emp_name !="")
                                        {{$value->emp_name}} ({{$value->emp_code}})
                                        @else
                                        Subject Teacher Not Assigned.
                                        @endif
                                      </p>
                                       </div>
                                   </div>
                                    @else

                                        @if($value->day==2 && $value->period==$i)
                                        <span>Time Table Not Assigned</span>
                                        @endif
                                    @endif
                                    @endforeach
                                  </td>
                                  <td>
                                    @foreach($timetable as $key=>$value)
                                    @if($value->day==3 && $value->period==$i)
                                    <div style="width:100%;" class="col-md-4">
                                      <div class="callout callout-danger">
                                      <h4>{{$value->course_name}}/{{$value->batch_name}}</h4>
                                      <p><span>Day/Period : </span>  {{date('l', strtotime("Sunday + $value->day Days"))}} / {{$value->period}} </p>
                                      <p><span>Subject : </span>{{$value->subject_name}}</p>
                                      <p><span>Room No : </span>{{$value->room_no}}</p>
                                      <p><span>Teacher : </span>
                                        @if($value->emp_name !="")
                                        {{$value->emp_name}} ({{$value->emp_code}})
                                        @else
                                        Subject Teacher Not Assigned.
                                        @endif
                                      </p>
                                       </div>
                                   </div>
                                    @else
                                    @endif
                                    @endforeach
                                  </td>
                                  <td>
                                    @foreach($timetable as $key=>$value)
                                    @if($value->day==4 && $value->period==$i)
                                    <div style="width:100%;" class="col-md-4">
                                      <div class="callout callout-danger">
                                      <h4>{{$value->course_name}}/{{$value->batch_name}}</h4>
                                      <p><span>Day/Period : </span>  {{date('l', strtotime("Sunday + $value->day Days"))}} / {{$value->period}} </p>
                                      <p><span>Subject : </span>{{$value->subject_name}}</p>
                                      <p><span>Room No : </span>{{$value->room_no}}</p>
                                      <p><span>Teacher : </span>
                                        @if($value->emp_name !="")
                                        {{$value->emp_name}} ({{$value->emp_code}})
                                        @else
                                        Subject Teacher Not Assigned.
                                        @endif
                                      </p>
                                       </div>
                                   </div>
                                    @else
                                    @endif
                                    @endforeach
                                  </td>
                                  <td>
                                    @foreach($timetable as $key=>$value)
                                    @if($value->day==5 && $value->period==$i)
                                    <div style="width:100%;" class="col-md-4">
                                      <div class="callout callout-danger">
                                      <h4>{{$value->course_name}}/{{$value->batch_name}}</h4>
                                      <p><span>Day/Period : </span>  {{date('l', strtotime("Sunday + $value->day Days"))}} / {{$value->period}} </p>
                                      <p><span>Subject : </span>{{$value->subject_name}}</p>
                                      <p><span>Room No : </span>{{$value->room_no}}</p>
                                      <p><span>Teacher : </span>
                                        @if($value->emp_name !="")
                                        {{$value->emp_name}} ({{$value->emp_code}})
                                        @else
                                        Subject Teacher Not Assigned.
                                        @endif
                                      </p>
                                       </div>
                                   </div>
                                    @else
                                    @endif
                                    @endforeach
                                  </td>
                                  <td>
                                    @foreach($timetable as $key=>$value)
                                    @if($value->day==6 && $value->period==$i)
                                    <div style="width:100%;" class="col-md-4">
                                      <div class="callout callout-danger">
                                      <h4>{{$value->course_name}}/{{$value->batch_name}}</h4>
                                      <p><span>Day/Period : </span>  {{date('l', strtotime("Sunday + $value->day Days"))}} / {{$value->period}} </p>
                                      <p><span>Subject : </span>{{$value->subject_name}}</p>
                                      <p><span>Room No : </span>{{$value->room_no}}</p>
                                      <p><span>Teacher : </span>
                                        @if($value->emp_name !="")
                                        {{$value->emp_name}} ({{$value->emp_code}})
                                        @else
                                        Subject Teacher Not Assigned.
                                        @endif
                                      </p>
                                       </div>
                                   </div>
                                    @else
                                    @endif
                                    @endforeach
                                  </td>
                                </tr>
                                 @endforeach
                              </tbody>
                            </table>
                          </div>


  </div>

</div>
</div>
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
       "scrollX": true
   } );
   } );

</script>
