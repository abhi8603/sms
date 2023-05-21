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
@if($type == "Participation") 
<div style="background-image: url('{{ URL::asset('assets/co.jpg') }}');background-repeat: no-repeat;background-position: center;
    background-size: cover;height:95%">
@elseif($type == "Activity") <div style="background-image: url('{{ URL::asset('assets/coc.jpg') }}');background-repeat: no-repeat;background-position: center;
    background-size: cover;height:95%"> 
@else	
<div style="background-image: url('{{ URL::asset('assets/merit.jpg') }}');background-repeat: no-repeat;background-position: center;
    background-size: cover;height:95%"> 
  @endif
	<div class="row invoice-info" style="text-align:center">

              <!-- /.col -->
              <div class="col-sm-8 offset-4 invoice-col" style="padding-top: 410px;font-family:'serif';padding-left: 90px;padding-right: 100px;">
                <h4>
				 
                  <span style="font-style:oblique;font-size:larger">Awarded</span><br><br>
					<span style="font-style:oblique;font-size:larger">To</span><br><br>
					<p style="text-decoration: underline;font-size:large"> {{$stu_name}}</p>
               
                </h4>
				  <div style="font-style:oblique;font-size:larger"> of class 
					  <span style="text-decoration: underline;font-size:large;margin-left:10px;margin-right:10px;"><b>{{$class}}</b></span> for participating in</div><br>


              <p style="font-style:oblique;font-size:larger"><span style="text-decoration: underline;;font-size:large"> 
				 <b> {{$participating_in}}</b> </span> Competition,
              </p>
				  <p  style="font-style:oblique;font-size:larger">Conducted during academic year 
					  <span style="text-decoration: underline;;font-size:large"><b>{{$accdmic_year}}</b></span></p>
            
            </div>

            </div>
</div>

