<!DOCTYPE html>
<style>
	body{
			font-family:'verdana';
		}
		.id-card-holder {
			width:295px;
			height: 471px;
		    padding: 4px;
		    margin: 15px;
		    background: url("image/id-bg.png");
			background-size:cover;
		    position: relative;
            float:left; 
		}
		.id-card {
			padding: 10px 35px;
			border-radius: 10px;
			text-align: center;
		}
		.id-card img {
			margin: 0 auto;
		}
		.header img {
			width: 150px;
    		margin-top: 5px;
		}
		.photo img {
			width: 112px;
    		margin-top: 15px;
    		height: 116px;
    		border-radius:4px;
    		border: 2px solid #ddd;
		}
		h2 {
			font-size: 20px;
			margin: 8px 0 3px 0px;
			color: #272727;
			text-transform: uppercase;
		}
		h3 {
			font-size: 16px;
			margin: 0px 0 2.5px 0;
			font-weight: 600;
			color: #2c5a98;
		}
		.id-card .qr-code  {
			position: absolute;
			bottom:45px;
			right:40px;
		}
		.id-card .qr-code img {
			width: 80px;
		}
		p {
			font-size: 14px;
			margin: 2px;
			font-weight: 600;
			text-align: left;
			color:#444444;
		}

table {}
table td{ 
			font-size: 13px;
			font-weight: 600;
			text-align: left;
			vertical-align: top;
			padding-top:0px;
			padding-bottom:0px; 
			color:#444444;
		}
		.id-card-hook {
			background-color: #000;
		    width: 70px;
		    margin: 0 auto;
		    height: 15px;
		    border-radius: 5px 5px 0 0;
		}
strong{ color: #2c5a98; font-size: 14px;}
		.id-card-hook:after {
			content: '';
		    background-color: #d7d6d3;
		    width: 47px;
		    height: 6px;
		    display: block;
		    margin: 0px auto;
		    position: relative;
		    top: 6px;
		    border-radius: 4px;
		}
		.id-card-tag-strip {
			width: 45px;
		    height: 40px;
		    background-color: #0950ef;
		    margin: 0 auto;
		    border-radius: 5px;
		    position: relative;
		    top: 9px;
		    z-index: 1;
		    border: 1px solid #0041ad;
		}
		.id-card-tag-strip:after {
			content: '';
		    display: block;
		    width: 100%;
		    height: 1px;
		    background-color: #c1c1c1;
		    position: relative;
		    top: 10px;
		}
		.id-card-tag {
			width: 0;
			height: 0;
			border-left: 100px solid transparent;
			border-right: 100px solid transparent;
			border-top: 100px solid #0958db;
			margin: -10px auto -30px auto;
		}
		.id-card-tag:after {
			content: '';
		    display: block;
		    width: 0;
		    height: 0;
		    border-left: 50px solid transparent;
		    border-right: 50px solid transparent;
		    border-top: 100px solid #d7d6d3;
		    margin: -10px auto -30px auto;
		    position: relative;
		    top: -130px;
		    left: -50px;
		}
</style>
<style>
	@media print {
		#content-container {padding-top: 0px;}
		#student_details {
	     display: none;
	    }
	}
	@media print {
		.page-break	{ display: block; page-break-before: always; }
	}
</style>
<html lang="en" >
<div style="height:40px;width:60px;">
 	<button class="btn btn-mint btn-icon" id="student_details" onclick="print()">PRINT</button>
</div>
<head>
  <meta charset="UTF-8">
  <title>Id card design</title>
</head>
<body onload="noBack();" >
	 @php $i=0;$j=0; @endphp 
      @foreach ($studentList as $val)
      @php $i=++$i; @endphp 
	<div class="id-card-holder">
		<div class="id-card">
			<div class="header">
				<img src="{{ URL::asset('image/logo.jpg')}}" style="width:55%;">
			</div>
			<div class="photo">
			    @if($val['photo_path']=="")
					<img src="{{ URL::asset('image/photo.png')}}" style="width:55%;">
                @else
                	<img src="{{ URL::asset($val['photo_path'])}}" style="width:55%;">
                @endif
			</div>
			<h3><?=$val['student_name']!=""?$val['student_name']:"N/A";?></h3>
			<?=$val['acadmic_year']!=""?$val['acadmic_year']:"N/A";?>
			<hr>
	
			<table cellpadding="0" cellspacing="0" border="0" width="100%">
			<tr>
				<td width="80px"><strong>Roll No</strong></td>
				<td width="10px"><strong>:</strong></td>
				<td><?=$val['roll_no']!=""?$val['roll_no']:"N/A";?></td>	
			</tr>
			
			<tr>
				<td width="80px"><strong>Course </strong></td>
				<td width="10px"><strong>:</strong></td>
				<td><?=$val['course_name']!=""?$val['course_name']:"N/A";?> ,<?=$val['batch_name']!=""?$val['batch_name']:"N/A";?></td>	
			</tr>
			<tr>
				<td width="80px"><strong>D.O.B </strong></td>
				<td width="10px"><strong>:</strong></td>
				<td><?=$val['dob']!=""?$val['dob']:"N/A";?></td>	
			</tr>
			<tr>
				<td width="80px"><strong>Gender</strong></td>
				<td width="10px"><strong>:</strong></td>
				<td><?=$val['gender']!=""?$val['gender']:"N/A";?></td>	
			</tr>
			<tr>
				<td width="80px"><strong>Blood </strong></td>
				<td width="10px"><strong>:</strong></td>
				<td><?=$val['blood_group']!=""?$val['blood_group']:"N/A";?></td>	
			</tr>
			<tr>
				<td width="80px"><strong>Address </strong></td>
				<td width="10px"><strong>:</strong></td>
				<td><?=$val['permanent_address']!=""?$val['permanent_address']:"N/A";?></td>	
			</tr>
			</table>
		</div>
		
	</div>
	 @endforeach
  <div class="page-break"></div>
</body>
</html>
<script>
	window.onbeforeunload = function() { return "You work will be lost."; };
</script>