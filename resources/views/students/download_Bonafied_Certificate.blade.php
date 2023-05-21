<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/font-awesome/css/font-awesome.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/Ionicons/css/ionicons.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/dist/css/AdminLTE.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/dist/css/skins/_all-skins.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/morris.js/morris.css') }}">   <!-- Morris chart -->
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/jvectormap/jquery-jvectormap.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/font-awesome/css/font-awesome.min.css') }}">    <!-- Ionicons -->
 <link rel="stylesheet" href="{{ URL::asset('assets/bower_components/Ionicons/css/ionicons.min.css') }}">  <!-- jvectormap -->
<div style="border: 2px solid red;
padding: 10px;
border-radius: 7px">
      <div class="row" style=" text-align: center;">
        <div class="col-xs-12">
          <p style="float:left;margin-left:15px;">Sl.No. : {{$stucnt}}</p>
          <h2 class="page-header">
          <img src="{{ URL::asset('assets/images/school/logo3.png') }}" style="height: 80px;" />
          </h2>
        </div>

      </div>
<div style="background-image: url('{{ URL::asset('assets/back.jpeg') }}');background-repeat: no-repeat;background-position: center;
    background-size: contain;">
            <div class="row invoice-info" style="text-align:center">

              <!-- /.col -->
              <div class="col-sm-8 offset-4 invoice-col" style="padding-left: 90px;padding-right: 100px;">
                <address>
                  <strong>{{Auth::user()->school_name }}</strong><br>
                  Bariyatu Road,Baragain,Ranchi-834009<br>
                    (Affiliate to the Council for the Indian School Certificate Examinations - New Delhi) <br>
                  School Code : JH076
                </address>
                <h4 style="color:#a01818;text-decoration: underline;">Bonafide Certificate</h4>


              <p>G.R No  <b>{{$stu[0]->reg_no}}</b> Of <b>{{$stu[0]->stu_name}}</b></p><br>
              <p>This is to certify that <span> Master/Kum <span>  <b>{{$stu[0]->stu_name}} </b>
              is Son/Daughter  of Mr.<b> {{$stu[0]->father_name}}</b> is/was a Bonafide student of this school.
              His/Her birth date as recorded in general register of the school is <b>{{$stu[0]->dob}}.</b>
              </p>
              <p><span>Std. {{$stu[0]->course_name}}</span>                      <span>Div. {{$stu[0]->batch_name}}</span></p>
              <div>
                <label><span style="float:left;margin-left:15px;">Date : {{date('d-m-Y')}}</span>
                  <span style="float:right;margin-right:15px;">Principal/Head Master</span></label>
              </div>
            </div><br><br>

            </div>
</div>
</div>
</div>
