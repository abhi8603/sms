
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/font-awesome/css/font-awesome.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/Ionicons/css/ionicons.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/dist/css/AdminLTE.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/dist/css/skins/_all-skins.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/font-awesome/css/font-awesome.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/Ionicons/css/ionicons.min.css') }}">

<div class="row" style=" text-align: center;">
  <div class="col-xs-12">
    <h2 class="page-header">
    <img src="{{ URL::asset('assets/images/school/logo3.png') }}" style="height: 80px;" />
    </h2>
  </div>
</div>

<div class="row invoice-info" style="text-align:center">
  <div class="col-sm-8 offset-4 invoice-col" style="padding-left: 90px;padding-right: 100px;">
    <address>
      <strong>{{Auth::user()->school_name }}</strong><br>
      Bariyatu Road,Baragain,Ranchi-834009<br>
      (Affiliate to the Council for the Indian School Certificate Examinations - New Delhi) <br>
      School Code : JH076
    </address>
    <h4 style="color:#a01818;text-decoration: underline;">Marks List</h4>
</div>
</div>
<table class="table table-striped table-bordered">
                <tr width="100%">
                  <td width="350px"><label>Acadmic Year  : </label><span><?php echo $academic_year; ?></span></td>
                  <td width="350px"><label>Exam Name  : </label><span><?php echo $examName[0]->exam_name; ?></span></td>
                </tr>
                <tr width="100%">
                  <td width="350px"><label>Month : </label><span><?php echo date('F', mktime(0, 0, 0, $month, 10));; ?> </span></td>
                  <td width="350px"><label>Subject : </label><span><?php echo $subjectName[0]->subject_name; ?> </span></td>          
                </tr>
                <tr width="100%">
                  <td width="350px"><label>Class  : </label><span><?php echo $className[0]->course_name; ?></span></td>
                  <td width="350px"><label>Section : </label><span><?php echo $sectionName[0]->batch_name; ?> </span></td>
                </tr>
                <tr width="100%">
                  <td width="350px"><label>Teacher  : </label><span><?php echo $teacher; ?></span></td>
                  <td width="350px"><label>Total Students : </label><span><?php echo count($student); ?> </span></td>
                </tr>
      </table>
<table class="table table-striped table-bordered">
      <thead>
      <tr>
      <th>Sl.No</th>
      <th>Reg No.</th>
      <th>Student</th>
      <th>Roll No</th>
    <!--  <th>Max. Marks</th>  --->
      <th>Makrs</th>
      </tr>
      </thead>
      <tbody>
        @php $i=0; @endphp
        @foreach($student as $key=>$value)
        @php $i++; @endphp
        <tr>
          <td>{{$i}}</td>
          <td>{{$value->reg_no}}</td>
          <td>{{$value->stu_name}}</td>
          <td>{{$value->roll_no}}</td>
          <td>{{$value->marks}}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
    <div>
      <label><span style="float:left;margin-left:15px;">Date : {{date('d-m-Y')}}</span>
        <span style="float:right;margin-right:15px;">Teacher Signature</span></label>
    </div>
    <script>
    $(document).ready(function(){
      $("#exm").dataTable();
    });
