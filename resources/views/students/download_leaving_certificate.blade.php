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


      <!-- title row -->

      <div class="col-md-4" style="text-align: center;">
        <b style="font-size: 10px;">No Changes in any entry in this certificate shall be made except by the authority issuing it.
          Any infrigement of the rule is liable to be dealt with by rustication or by other suitable punishment.</b>
      </div>

      <div class="row" style="    text-align: center;">
        <div class="col-xs-12" style="margin-top: -15px;">
          <h2 class="page-header" >
          <img src="{{ URL::asset('assets/images/school/logo3.png') }}" style="height: 80px;" />
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div style="background-image: url('{{ URL::asset('assets/back.jpeg') }}');background-repeat: no-repeat;background-position: center;
          background-size: contain;">
      <div class="row invoice-info" style="text-align:center;margin-top:-20px;">

        <!-- /.col -->
        <div class="col-sm-12 invoice-col" style="margin-top: -20px;">
          <address>
            <strong>{{Auth::user()->school_name }}</strong><br>
            Bariyatu Road,Baragain,Ranchi-834009<br>
              (Affiliate to the Council for the Indian School Certificate Examinations - New Delhi) <br>
            School Code : JH076
          </address>
          <h4 style="margin-top: -15px;">School Transfer / Leaving Certificate</h4>
        <!--  <span>Leaving Certificate</span><span>Higher Secondary (XI-XII)</span>-->
        </div>

      </div>
      <div class="row invoice-info">

        <!-- /.col -->
        <span style="float: left;margin-left:10px;"><b>Certificate No. : {{date('Y')}}/{{$id}}</b></span>
        <span style="float: right;margin-right:10px;"><b>Gen. Registration No. :   {{$stu[0]->reg_no}}</b></span><br><br>
      <!--  <div class="col-sm-6 invoice-col">
           <h5>Certificate No. :   <span>{{date('Y')}}/{{$id}}<span></h5>
        </div>
        <div class="col-sm-6 invoice-col">
           <h5>Gen. Registration No. :   <span>{{$stu[0]->reg_no}}<span></h5>
        </div>-->
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
        <div class="col-md-12 table-responsive">
          <div class="col-md-2"></div>
        <!--  <div class="col-md-8 ">
          <ul class="nav nav-stacked" >
                          <li><h4>1. Name of Pupil : <span class="">{{$stu[0]->stu_name}}</span></h4></li>
                          <li><h4>2. Gender : <span class=" badge">{{$stu[0]->gender}}</span></h4></li>
                          <li><h4>Completed Projects <span class=" badge ">12</span></h4></li>
                          <li><h4>Followers <span class="pull-center ">842</span></h4></li>
                        </ul>
                      </div>-->


          <div class="col-md-8">
          <table class="table" style="font-size: 12px;">
          <tbody>
            <tr>
              <td style="text-align: center;"> Name of Pupil :</td>
              <td style="text-align: left;"> <span>{{$stu[0]->stu_name}}</span></td>
            </tr>
            <tr>
              <td style="text-align: center;"> Gender :</td>
              <td style="text-align: left;"> <span>{{$stu[0]->gender}}</span></td>
            </tr>
            <tr>
              <td style="text-align: center;"> Parents Name (Mother) :</td>
              <td style="text-align: left;"> <span>{{$stu[0]->mother_name}}</span></td>
            </tr>
            <tr>
              <td style="text-align: center;"> Parents Name (Father) :</td>
              <td style="text-align: left;"> <span>{{$stu[0]->father_name}}</span></td>
            </tr>
            <tr>
              <td style="text-align: center;"> Nationality :</td>
              <td style="text-align: left;"> <span>{{$stu[0]->nationaliy}}</span></td>
            </tr>
            <tr>
              <td style="text-align: center;"> Religion :</td>
              <td style="text-align: left;"> <span>{{$stu[0]->religion}}</span></td>
            </tr>
            <tr>
              <td style="text-align: center;"> Caste :</td>
              <td style="text-align: left;"> <span>{{$stu[0]->category}}</span></td>
            </tr>
            <tr>
              <td style="text-align: center;"> Place of Birth :</td>
              <td style="text-align: left;"> <span>{{$stu[0]->birth_place}}</span></td>
            </tr>
            <tr>
              <td style="text-align: center;"> Date of Birth :</td>
              <td style="text-align: left;"> <span>{{$stu[0]->dob}}</span></td>
            </tr>
            <tr>
              <td style="text-align: center;"> Last School Attended :</td>
              <td style="text-align: left;"> <span>{{$stu[0]->prev_school}}</span></td>
            </tr>
            <tr>
              <td style="text-align: center;"> Class on Admission :</td>
              <td style="text-align: left;"> <span>{{$jc}}</span></td>
            </tr>
            <tr>
              <td style="text-align: center;"> Date of Admission :</td>
              <td style="text-align: left;"> <span>{{$joining_date}}</span></td>
            </tr>
            <tr>
              <td style="text-align: center;"> Date of Leaving :</td>
              <td style="text-align: left;"> <span>{{$leaving_date}}</span></td>
            </tr>
            <tr>
              <td style="text-align: center;"> Whether Qualify for promotion or not :</td>
              <td style="text-align: left;"> <span>{{$qualified}}</span></td>
            </tr>
            <tr>
              <td style="text-align: center;"> Conduct :</td>
              <td style="text-align: left;"> <span>{{$conduct}}</span></td>
            </tr>
            <tr>
              <td style="text-align: center;"> Reason for Leaving School :</td>
              <td style="text-align: left;"> <span>{{$reason}}</span></td>
            </tr>
            <tr>
              <td style="text-align: center;"> Remarks :</td>
              <td style="text-align: left;"> <span>{{$remark}}</span></td>
            </tr>
            </tbody>
          </table>
        </div>
        </div>
<div class="col-md-12" style="text-align: center;font-size:10px;">
  <b>Certificate that the above information is in accordance with the school register.This certificate is issued without
  overwriting and eraser.</b>
</div>

<div class="col-md-12" style="text-align: center;margin-top: 52px;">
  <p>

  <label style="margin-left:30px;font-size:15px;">Prepared By</label>


  <label style="margin-left:150px;font-size:15px;">Verifyed By</label>


  <label style="margin-left:150px;font-size:15px;">Principal/Headmaster Sign</label>

</p>
</div>

</div>
</div>
