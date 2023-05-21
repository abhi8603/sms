<html>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
  <meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link rel="icon" href="" type="image/png" sizes="16x16">
<title>Metas SDA | Admission Form</title>
<!-- Tell the browser to be responsive to screen width -->
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
</head>
<body style="background:#986c27e3">

  <nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top" style="background-color:#fff !important">
    <!-- Brand/logo -->
    <div class="container-fluid">
    <a class="navbar-brand" href="#">
      <img src="{{ URL::asset('assets/logo3.png')}}" alt="logo" style="width:40px;">
    </a>
    <div class="collapse navbar-collapse" id="mynavbar">
   
    <!-- Links -->
    <ul class="navbar-nav me-auto" style="width: 100%;">
      <li class="nav-item" style="width: 100%;text-align:center;">
        <h3 style="color: #000;">Seventh Day Adventist School</h3>
      </li>
    </ul>
</div>
    </div>
  </nav>
<br><br>
<div class="container">
  <div style="text-align:center;margin-top:2%;">
    <h2 >Seventh Day Adventist School</h2>
    <span>(Manage by Metas of SDA) Affiliated by CISCE,New Delhi(JH076)</span>
    <p>Bariyatu Road, Ranchi-834009| Ph.:0651-2541829,(+91) 9199440352</p>
  </div>
<div id="accordion">
    <div class="row">
        <div class="col-lg-12">
            <div class="text-center">
                <h3>Admission Form 2021-2022</h3>
            </div>
        </div>
    </div>
       @include('notification.notify')
    <form method="post" action="{{url('submitfrom')}}" enctype="multipart/form-data">
    <div class="card" style="border-radius:5px;">
        <div class="card-header bg-primary text-white">
            <h4 class="card-title">
                <h4 data-toggle="collapse" data-parent="#accordion" href="#collapse1">
                    <i class="glyphicon glyphicon-search text-gold"></i>
                    <b>Please Fill the Form</b>
                    (<span style="color:red;">*</span> marked fileds are mandatory)
</h4>
            </h4>
        </div>
        <div id="collapse1" class="collapse show">
            <div class="card-body">
                <div class="row ">
                    <div class="col-md-12 col-lg-12">
                        <div class="form-group mt-3">
                            <label class="control-label">1. Pupil's Full Name <span style="color:red;">*</span></label>
                            <input name="stu_name" placeholder="Surname name father name" type="text" class="form-control" required/>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-12 mt-3">
                        <div class="form-group">
                            <label class="control-label">2. Seeking Admission in Class  <span style="color:red;">*</span></label>
                            <select class="form-control" name="class" required>
                              <option value="">--Please Select--</option>
                            @foreach($class as $class)
                            <option value="{{$class->course_name}}">{{$class->course_name}}</option>
                            @endforeach
                            </select>
                          </div>
                    </div>

                    <div class="col-md-4 col-lg-4">
                        <div class="form-group mt-3">
                            <label class="control-label">3. a) Date Of Birth  <span style="color:red;">*</span></label>
                            <div class="input-group date">
                                <input name="dob" class="form-control dob" type="text" required autocomplete="off"/>
                               <span class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button">
                                        <i class="fa fa-calendar"></i>
                                    </button></span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-8 col-lg-8">
                        <div class="form-group mt-3">
                            <label class="control-label">3. b) Place of Birth</label>
                            <input class="form-control" id="birthpalce" name="birthpalce" placeholder="Town Taluka Distict" style="margin-bottom: 10px" type="text" required/>

                          </div>
                        </div>
                        <div class="col-md-12 col-lg-12">
                            <div class="form-group mt-3">
                                <label class="control-label">4. Gender  <span style="color:red;">*</span></label>
                                <label style="margin-left: 20px;padding-right: 35px;" class="radio-inline"> <input type="radio" name="gender" id="id_gender_1" value="M"  style="margin-bottom: 10px" checked>Male</label>
                                <label class="radio-inline"> <input type="radio" name="gender" id="id_gender_2" value="F"  style="margin-bottom: 10px">Female </label>
                             </div>
                        </div>
                </div>

                <div class="row">
                    <div class="col-md-5 col-lg-5">
                        <div class="form-group mt-3">
                            <label class="control-label">5. Blood Group</label>
                            <input type="text" class="form-control" name="blood_group" placeholder="Blood Group"/>
                        </div>
                    </div>
                    <div class="col-md-5 col-lg-5">
                        <div class="form-group mt-3">
                            <label class="control-label">6. Physically Challenged ?</label> <br>
                            <label style="margin-right: 20px;" class="radio-inline"> <input type="radio" name="handicap" id="id_gender_1" value="Yes"  style="margin-bottom: 10px">Yes</label>
                            <label class="radio-inline"> <input type="radio" name="handicap" id="id_gender_2" value="No"  style="margin-bottom: 10px" checked>No </label>

                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-4 col-lg-4">
                        <div class="form-group mt-3">
                            <label class="control-label">7. Religion  <span style="color:red;">*</span></label>
                            <input type="text" class="form-control" name="religion" placeholder="religion" required/>
                        </div>
                    </div>

                    <div class="col-md-4 col-lg-4">
                        <div class="form-group mt-3">
                            <label class="control-label">Cast  <span style="color:red;">*</span></label>
                            <input type="text" class="form-control" name="cast" placeholder="Cast" required/>
                        </div>
                    </div>

                    <div class="col-md-4 col-lg-4">
                        <div class="form-group mt-3">
                            <label class="control-label">Sub-Cast</label>
                            <input type="text" class="form-control" name="subcast" placeholder="Sub-Cast" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-lg-6">
                        <div class="form-group mt-3">
                            <label class="control-label">8. Father's Full Name  <span style="color:red;">*</span></label>
                            <input type="text" class="form-control" name="f_name" placeholder="Surname Name father name" required/>
                        </div>
                    </div>
                    <div class="col-md-3 col-lg-3">
                        <div class="form-group mt-3">
                            <label class="control-label">Phone</label>
                            <input type="text" class="form-control" name="f_phone" placeholder="Phone"/>
                        </div>
                    </div>
                    <div class="col-md-3 col-lg-3">
                        <div class="form-group mt-3">
                            <label class="control-label">Mobile  <span style="color:red;">*</span></label>
                            <input type="text" class="form-control" name="f_mobile" placeholder="Mobile" onkeypress="return isNumber(event)"  required/>
                        </div>
                    </div>
                    <div class="col-md-3 col-lg-12">
                        <div class="form-group mt-3">
                            <label class="control-label">Father's Educational Qualification <span style="color:red;">*</span></label>
                            <input type="text" class="form-control" name="f_qualification" placeholder="Father's Educational Qualification" required/>
                        </div>
                    </div>
                    <div class="col-md-5 col-lg-6">
                        <div class="form-group mt-3">
                            <label class="control-label">Email</label>
                            <input type="text" class="form-control" name="email" placeholder="Father's Email"/>
                        </div>
                    </div>
                    <div class="col-md-5 col-lg-6">
                        <div class="form-group mt-3">
                            <label class="control-label">Fax</label>
                            <input type="text" class="form-control" name="fax" placeholder="Father's Fax"/>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <div class="form-group mt-3">
                            <label class="control-label">Can Speak English ?</label>
                            <label class="radio-inline"> <input type="radio" name="eng_speak" id="id_gender_1" value="Yes"  style="margin-bottom: 10px" checked>Yes</label>
                            <label class="radio-inline"> <input type="radio" name="eng_speak" id="id_gender_2" value="No"  style="margin-bottom: 10px">No </label>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <div class="form-group mt-3">
                            <label class="control-label">Service (if any) ?</label>
                            <label class="radio-inline"> <input type="radio" name="f_service" id="id_gender_1" value="Goverment"  style="margin-bottom: 10px" checked>Goverment</label>
                            <label class="radio-inline"> <input type="radio" name="f_service" id="id_gender_2" value="Private"  style="margin-bottom: 10px">Private </label>
                      </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 col-lg-6">
                        <div class="form-group mt-3">
                            <label class="control-label">9. Mother's Full Name <span style="color:red;">*</span></label>
                            <input type="text" class="form-control" name="m_name" placeholder="Surname Name father name" required/>
                        </div>
                    </div>
                    <div class="col-md-3 col-lg-3">
                        <div class="form-group mt-3">
                            <label class="control-label">Phone</label>
                            <input type="text" class="form-control" name="m_phone" placeholder="Phone"/>
                        </div>
                    </div>
                    <div class="col-md-3 col-lg-3">
                        <div class="form-group mt-3">
                            <label class="control-label">Mobile</label>
                            <input type="text" class="form-control" name="m_mobile" onkeypress="return isNumber(event)"  placeholder="Mobile"/>
                        </div>
                    </div>
                    <div class="col-md-3 col-lg-12">
                        <div class="form-group mt-3">
                            <label class="control-label">Mother's Educational Qualification</label>
                            <input type="text" class="form-control" name="m_qualification" placeholder="Monther's Educational Qualification" />
                        </div>
                    </div>
                    <div class="col-md-5 col-lg-6">
                        <div class="form-group mt-3">
                            <label class="control-label">Email</label>
                            <input type="text" class="form-control" name="m_email" placeholder="Monther's Email"/>
                        </div>
                    </div>
                    <div class="col-md-5 col-lg-6">
                        <div class="form-group mt-3">
                            <label class="control-label">Fax</label>
                            <input type="text" class="form-control" name="m_fax" placeholder="Monther's Fax"/>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <div class="form-group mt-3">
                            <label class="control-label">Can Speak English ?</label>
                            <label class="radio-inline"> <input type="radio" name="m_speak" id="id_gender_1" value="Yes"  style="margin-bottom: 10px" checked>Yes</label>
                            <label class="radio-inline"> <input type="radio" name="m_speak" id="id_gender_2" value="No"  style="margin-bottom: 10px">No </label>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <div class="form-group mt-3">
                            <label class="control-label">Service (if any) ?</label>
                            <label class="radio-inline"> <input type="radio" name="m_service" id="id_gender_1" value="Goverment"  style="margin-bottom: 10px" checked>Goverment</label>
                            <label class="radio-inline"> <input type="radio" name="m_service" id="id_gender_2" value="Private"  style="margin-bottom: 10px">Private </label>
                      </div>
                    </div>
                </div>
  <div class="row">
                <div class="col-md-6 col-lg-6">
                    <div class="form-group mt-3">
                        <label class="control-label">Single Parent ?</label>
                        <label class="radio-inline"> <input type="radio" name="s_parent" id="id_gender_1" value="Yes"  style="margin-bottom: 10px">Yes</label>
                        <label class="radio-inline"> <input type="radio" name="s_parent" id="id_gender_2" value="No"  style="margin-bottom: 10px" checked>No </label>
          </div>
                </div>
</div>

            <div class="row">
                <div class="col-md-12 col-lg-12">
                  <ul>
                    <li>Photograph's and Signature type will be jpg,png,jpge
                    </li>
                  </ul>
                </div>
                <div class="col-md-6 col-lg-6">
                  <div class="form-group mt-3">
                      <label class="control-label">Date of Birth Certificate <span style="color:red;">*</span></label>
                      <input type="file"class="form-control"  name="dob_c" id="id_gender_1" required/>
                    </div>
              </div>
              <div class="col-md-6 col-lg-6">
                  <div class="form-group mt-3">
                      <label class="control-label">Cast Certificate </label>
                      <input type="file"class="form-control"  name="cast_c" id="id_gender_1" />
                    </div>
              </div>
              <div class="col-md-6 col-lg-6">
                  <div class="form-group mt-3">
                      <label class="control-label">Father Photograph <span style="color:red;">*</span></label>
                      <input type="file"class="form-control"  name="photo_f" id="id_gender_1" required/>
                    </div>
              </div>
              <div class="col-md-6 col-lg-6">
                  <div class="form-group mt-3">
                      <label class="control-label">Mother Photograph <span style="color:red;">*</span></label>
                      <input type="file"class="form-control"  name="photo_m" id="id_gender_1" required/>
                    </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6 col-lg-6">
                  <div class="form-group mt-3">
                      <label class="control-label">Applicant's Signature <span style="color:red;">*</span></label>
                      <input type="file"class="form-control"  name="sign_a" id="id_gender_1"required />
                    </div>
              </div>
              <div class="col-md-6 col-lg-6">
                  <div class="form-group mt-3">
                      <label class="control-label">Parent's/Guadian's Signature  <span style="color:red;">*</span></label>
                      <input type="file"class="form-control"  name="sign_p" id="id_gender_1" required/>
                    </div>
              </div>
            </div>

            </div>`
        </div>
    </div>

    <br />
    <div class="row">
                   <div class="col-lg-12">
                     <b>Declarations :</b>
                       <p style="color:#fff;">
                         I certify that the answer and other infomation given in this application are correct and complete.If my application is
   accepted, I undertake to observe the school's rules and regulations, in letter and spirit and to ensure prompt patment of fees
   and other liablities.</p>
                   </div>
                   <div class="col-lg-12">
                     <b>Commitments :</b>
                       <p style="color:#fff;">
                         I understand, and am in harmony, with the purpose, aim and objectives of the METAS Seventh - day Adventist Higher Secondary
School, Ranchi. I desire that my child be given the full benefits of education at your school including instructions in Moral
Science, Ethics and Value, as may be prescribed by the management and that my child should attend regular worship. If
the conduct and bearing of my child is not upto expectation and standard, the administration has the authority to expel him/her from the school any time.
</p>
                   </div>
               </div>
</div>
<div class="row">
    <div class="col-lg-12">
      <label for="id_terms" class=" requiredField" style="color:#fff;">
           <input class="input-ms checkboxinput" id="id_terms" name="terms" value="accepted" style="margin-bottom: 10px" type="checkbox" />
           Agree with the terms and conditions
      </label>
    </div>
</div>
<div class="row">
    <div class="col-lg-12" style="text-align:center;">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">

      <input type="submit" id="submit" value="Submit" href="#" class="btn btn-success" id="btnSubmit"/>

        <div class="pull-right">
            <a class="btn btn-warning" href="#" id="btnToTop"><i class="fa fa-arrow-up"></i> Top</a>
        </div>
    </div>
</div>
</form>
</div> <br><br><br>

  <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
  <script>
  $(document).ready(function(){
    $('.dob').datepicker({
        'format': 'mm-dd-yyyy',
    });
    $("#submit").click(function(){
      if($('#id_terms').is(':checked')){

      }else{
        alert("Please Accept terms and conditions");
        return false;
      }
    })
  });
  </script>
<script>
function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}

$(function () {
       $(".date").datepicker({
           autoclose: true,
           todayHighlight: true
       });
   });
</script>
</body>
</html>
