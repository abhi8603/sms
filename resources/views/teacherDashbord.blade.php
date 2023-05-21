<div class="row">
<div class="col-md-4">
  <div class="box box-widget widget-user-2">
    <div class="widget-user-header bg-aqua-active">
      <div class="widget-user-image">
        @if(isset(Auth::user()->profile_img))
        <img class="img-circle" src="{{ URL::asset(Auth::user()->profile_img) }}" alt="User Avatar">
        @else
        <img class="img-circle" src="<?php echo asset(app_config('AppLogo',Auth::user()->school_id)); ?>" alt="User Avatar">
        @endif
      </div>

    <h4 class="widget-user-username">{{Auth::user()->name}}</h4>
     <h5 class="widget-user-desc">{{Auth::user()->emp_code}}</h5>
    </div>
    <div class="box-footer no-padding">
      <ul class="nav nav-stacked">
        <li><a href="#">Class Teacher <span class="pull-right badge bg-red"><?php if(isset($classTeacher[0]->course_name)){echo $classTeacher[0]->course_name." / ".$classTeacher[0]->batch_name; }else {echo "";} ?></span></a></li>
        <li><a href="#">Acadmic Year<span class="pull-right badge bg-green">{{app_config('Session',Auth::user()->school_id)}}</span>  </a></li>
      </ul>
    </div>
  </div>
  </div>
  <div class="col-md-8">
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Notice Board</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
        </button>
      </div>
      <!-- /.box-tools -->
    </div>

    <div class="box-body">
    <ul>
      @if(isset($notice))
      @foreach($notice as $notice)
    <li>
      <h4>{{$notice->subject}}</h4>
      <hr>
    <p>{{$notice->discription}}</p>
    <hr>
    <p>From : {{$notice->name}}</p>
    </li>
    @endforeach
    @else
    <p>Nothing to show.</p>
    @endif
    </ul>


    </div>
  </div>
    </div>
  </div>
  <div class="row">
      <div class="col-md-12">

        <div class="col-md-8">
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Subject Assigned</h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>
            </div>
            <!-- /.box-tools -->
          </div>

          <div class="box-body" style="min-height: 222px;">
        <table class="table">
          <thead>
            <tr>
              <td>Sl.No</td>
              <td>Session</td>
              <td>Subject</td>
              <td>Class</td>
              <td>Section</td>
            </tr>
          </thead>
          <tbody>
            @php $i=0; @endphp
            @foreach($assigned_subejcts as $assigned_subejcts)
            @php $i++; @endphp
            <tr>
              <td>{{$i}}</td>
              <td>{{$assigned_subejcts->acadmic_year}}</td>
              <td>{{$assigned_subejcts->subject_name}}</td>
              <td>{{$assigned_subejcts->course_name}}</td>
              <td>{{$assigned_subejcts->batch_name}}</td>
            </tr>

            @endforeach
          </tbody>
        </table>

          </div>
        </div>
        </div>
          </div>
  </div>
