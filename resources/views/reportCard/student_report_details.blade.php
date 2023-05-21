<!DOCTYPE html>
<style>
  body{
      font-family:'verdana';
    }
    .trheight{
      line-height: 22px;
    }  
    .tdtitle{
      width:80px;
    }
    .tddata{
      border-bottom: 1px solid #000; 
      line-height: 22px;
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
    .page-break { display: block; page-break-before: always; }
  }
</style>
<html lang="en" >
<div style="height:40px;width:60px;">
  <button class="btn btn-mint btn-icon" id="student_details" onclick="print()">PRINT</button>
</div>
<head>
  <meta charset="UTF-8">
  <title>Student Report Card</title>
</head>
<body>
   @if(empty($data))
      <tr style="text-align:center; color: red;">
        <td colspan="7">Data Not Available!!!</td>
      </tr>
    @else
      @php $i=0; @endphp
        @foreach($data as $value)
        <table cellpadding="0" cellspacing="0" border="0" width="90%" style="margin-left: 30px;">
         <!--   <div style="text-align: center; width: 100%;"><strong> : </strong></div> -->

         <tr><td style="text-align: center; height: 740px" colspan="9"></strong></td></tr>
            <tr><td td style="text-align: center;" colspan="9"><strong>Session:<?=(isset($acadmic_year))?$acadmic_year:"N/A";?></strong></td>
            </tr>
            <tr>
              <td style="text-align: center; height: 110px" colspan="9"></td>
            </tr>
            <tr class="trheight">
              <td class="tdtitle"><strong>Gr No</strong></td>
              <td width="8px"><strong>:</strong></td>
              <td><p class="tddata"><?=$value['reg_no']!=""?$value['reg_no']:"N/A";?></p></td>  
              <td class="tdtitle"><strong>Name</strong></td>
              <td width="8px"><strong>:</strong></td>
              <td><p class="tddata"><?=$value['stu_name']!=""?$value['stu_name']:"N/A";?></p></td>  
              <td class="tdtitle"><strong>DOB</strong></td>
              <td width="8px"><strong>:</strong></td>
              <td><p class="tddata"><?=$value['dob']!=""?$value['dob']:"N/A";?></p></td>  
            </tr>
            <tr class="trheight">
              <td class="tdtitle"><strong>Roll No</strong></td>
              <td width="8px"><strong>:</strong></td>
              <td><p class="tddata"><?=$value['roll_no']!=""?$value['roll_no']:"N/A";?></p></td>  
              <td class="tdtitle"><strong>Class</strong></td>
              <td width="8px"><strong>:</strong></td>
              <td><p class="tddata"><?=$course_name!=""?$course_name:"N/A";?></p></td>  
              <td class="tdtitle"><strong>Section</strong></td>
              <td width="8px"><strong>:</strong></td>
              <td><p class="tddata"><?=$batch_name!=""?$batch_name:"N/A";?></p></td>  
            </tr>
            <div class="page-break"></div>
          @endforeach
      @endif
    </table>
</body>
</html>
<script>
  window.onbeforeunload = function() { return "You work will be lost."; };
</script>