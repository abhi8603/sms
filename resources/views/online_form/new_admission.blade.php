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
      <div class="col-12">
      <marquee style="color:#fdf59a;font-size:larger" width="100%" direction="left" height="100px" onmouseover="this.stop();" onmouseout="this.start();">
Welcome to Seventh Day Adventist School Online admission Portal.
</marquee>
      </div>
      <div class="col-6">
      <div class="card mx-auto" style="border-radius:20px;background:#dee2e6;">
      <div class="card-header"><h4 class="card-title">Home</h4></div>
    <div class="card-body">     
      <a href="<?php echo url('/')."/admission-form" ?>" class="btn btn-primary">Fill Online Form</a><br><br>
      <a href="<?php echo url('/')."/online/receipt/download" ?>" target="_blank" style="color:#fff" class="btn btn-warning">Download Receipt</a>
    </div>
  </div>
      </div>
  </div>
</div>

  <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.js"></script>

</body>
</html>
