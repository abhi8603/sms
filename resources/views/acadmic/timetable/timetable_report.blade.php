<div class="box-body">
            <div class="row">
                <div class="box box-primary">
                         <div class="box-header with-border">
                            <h3 class="box-title">View Time Table {{$type}}</h3>
                         </div>
                          <div class="box-body">
                            @foreach($timetable as $key=>$value)
                            <div class="col-md-3">
                              <div style="padding: 0px;" class="callout callout-danger">
                              <h4>{{$value->course_name}}/{{$value->batch_name}}</h4>
                              <p style="padding: 0px;"><span>Day/Period : </span>  {{date('l', strtotime("Sunday + $value->day Days"))}} / {{$value->period}} </p>
                              <p style="padding: 0px;"><span>Subject : </span>{{$value->subject_name}}</p>
                              <p style="padding: 0px;"><span>Room No : </span>{{$value->room_no}}</p>
                              <p style="padding: 0px;"><span>Time : </span>{{$value->time}}</p>
                              <p style="padding: 0px;"><span>Teacher : </span>
                                @if($value->emp_name !="")
                                {{$value->emp_name}} ({{$value->emp_code}})
                                @else
                                Subject Teacher Not Assigned.
                                @endif
                              </p>
                              </div>
                           </div>
                           @endforeach
                          </div>


  </div>

</div>
</div>
