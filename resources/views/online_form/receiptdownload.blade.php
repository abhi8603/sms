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
<div class="container mt-5" style="text-align:center;">
  <div class="row justify-content-center" >
       
      <div class="col-6">
      <div class="card mx-auto" style="border-radius:20px;background:#dee2e6;">
      <div class="card-header"><h6 class="card-title">Fill the details to download receipt/Application Form</h6></div>
    <div class="card-body">     
    <form method="post" action="{{url('online/receipt/download/view')}}">
    @include('notification.notify')
  <div class="mb-3 mt-3">
    <label for="email" class="form-label">Email:</label>
    <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" required>
  </div>
  <div class="mb-3">
    <label for="pwd" class="form-label">Mobile:</label>
    <input type="number" onkeypress="return isNumber(event)" class="form-control" id="mobile" placeholder="Enter Mobile" name="mobile" required>
  </div>
  <div class="mb-3">
    <label for="pwd" class="form-label">Date of Birth of  Pupil's:</label>
    <input type="date" class="form-control" id="pwd" placeholder="Date of Birth of  Pupil's" name="dob" required>
  </div>
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  <input type="submit" class="btn btn-primary" onclick="ValidateNo();" value="Submit">
</form>
    </div>
  </div>
      </div>
  </div>
</div>

  <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.js"></script>

<script>
function isNumber(evt) {
  evt = (evt) ? evt : window.event;
  var charCode = (evt.which) ? evt.which : evt.keyCode;
  if (charCode > 31 && (charCode < 48 || charCode > 57)) {
    alert("Please enter only Numbers.");
    return false;
  }

  return true;
}
function ValidateNo() {
  var phoneNo = document.getElementById('mobile');

  if (phoneNo.value == "" || phoneNo.value == null) {
    alert("Please enter your Mobile No.");
    return false;
  }
  if (phoneNo.value.length < 10 || phoneNo.value.length > 10) {
    alert("Mobile No. is not valid, Please Enter 10 Digit Mobile No.");
    return false;
  } 
  return true;
}

    </script>
</body>
</html>
