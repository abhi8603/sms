<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<style>
.margin{
  margin-left:20px;
}
.table>tbody>tr>td{
  padding: 6px;
 line-height:1.1; */

}
.left{
            float: left;
            flex: 50%;
            width : 50%;
            text-align: left;
            height : 100px;
            display : inline-block;
        }
        .right{
            float: right;
            text-align: right;
            flex: 50%;
            width : 50%;
            height: 100px;

        }
        .table1 {
  border-collapse: collapse;
  border-spacing: 0;
  width: 100%;
  border: 1px solid #ddd;
}
</style>
<div class="col-md-12" style="">
  <?php use App\Http\Controllers\ExamController; ?>
  <?php
  $gradeArray=array(
    "A"=>4,
    "B"=>3,
    "C"=>2,
    "D"=>1,
    "F"=>0,
    "AB"=>0,
  );
  //print_r($gradeArray);exit;
   ?>
<?php foreach ($stu_list as $stu => $stu_value): ?>
  <div style="page-break-after:always;border: 1px solid #000;padding: 5px;">
  <div class="col-md-12" style="">
  <table class="table table-bordered" style="font-size: 8px;">
    <thead>
     <tr>
     <th>Subject</th>
     <th>1st Term 100 Marks</th>
     <th>2nd Term 100 Marks</th>
     <th>Monthly Test 100 Marks</th>
     <th>Annual 100 Marks</th>
     <th>1st Term 15%</th>
     <th>2nd Term 15%</th>
     <th>Monthly Test 20%</th>
     <th>Annual 50%</th>
     <th>Grand Total</th>
   </tr>
   </thead>
   <tbody>
     <?php  $firstTotal=0;$secondTotal=0;$monthlyTotal=0; $annualTotal=0;
$firstTotalP=0;$secondTotalP=0;$monthlyTotalP=0; $annualTotalP=0;$grandTotalP=0;$x=0;
     ?>
  <?php $fr=0; foreach ($subjects as $key => $value): ?>
    <?php if($value->elective!="Yes"){$x=$x+1;} ?>
  <?php $grandTotal=0; $gradepoint=0;$gradesubs=0;$gradesubstotal=0; $acnt=0;$bcnt=0;$ccnt=0;$dcnt=0;$ecnt=0;$fcnt=0; ?>
  <?php  $isGraded=ExamController::getGradingSuject($value->subject) ?>
  <?php $firstTermMarks=ExamController::getFirstTermMarks($value->subject,$stu_value->reg_no,$cid,$batch,$session) ?>
  <?php $secondTermMarks=ExamController::getSecondTermMarks($value->subject,$stu_value->reg_no,$cid,$batch,$session) ?>
  <?php $annualTermMarks=ExamController::getannualTermMarks($value->subject,$stu_value->reg_no,$cid,$batch,$session) ?>
  <?php $monthlyMarks=ExamController::getmonthlyMarks($value->subject,$stu_value->reg_no,$cid,$batch,$session) ?>
  <?php //print_r($firstTermMarks); ?>
    <tr>
      <td>{{$value->subject_name}}</td>
      <td><?php if(isset($firstTermMarks)){
      //  if(!$isGraded){$x=$x+1;}
         echo $firstTermMarks->marks;

         if($firstTermMarks->marks=="AB" || $firstTermMarks->marks=="" || $firstTermMarks->marks==null){
           $firstTotal+=0;
         }else{
         $firstTotal+=(int)$firstTermMarks->marks;
       }
        }else{
           echo "-";
           $firstTotal+=0;
         } ?></td>
      <td><?php if(isset($secondTermMarks)){
         echo $secondTermMarks->marks;
         if($secondTermMarks->marks=="AB" || $secondTermMarks->marks=="" || $secondTermMarks->marks==null){
           $secondTotal+=0;
         }else{
         $secondTotal+=(int)$secondTermMarks->marks;
       }
       }else{
         echo "-";
         $secondTotal+=0;
       } ?></td>
      <td><?php if(isset($monthlyMarks)){
        echo ceil($monthlyMarks[0]->marks);
        if($monthlyMarks[0]->marks=="AB" || $monthlyMarks[0]->marks=="" || $monthlyMarks[0]->marks==null){
          $monthlyTotal+=0;
        }else{
        $monthlyTotal+=$monthlyMarks[0]->marks;
      }
      }else{
        echo "-";
        $monthlyTotal+=0;

      } ?>

      </td>
      <td><?php if(isset($annualTermMarks)){
         echo $annualTermMarks->marks;
         if($annualTermMarks->marks=="AB" || $annualTermMarks->marks=="" || $annualTermMarks->marks==null){
           $annualTotal+=0;
         }else{
         $annualTotal+=(int)$annualTermMarks->marks;
       }
       }else{
         echo "-";
         $annualTotal+=0;
       } ?></td>

      <td><?php if(isset($firstTermMarks)){

        if(!$isGraded){
        echo (int)ceil((int)$firstTermMarks->marks*15/100);
        $grandTotal+=(int)ceil((int)$firstTermMarks->marks*15/100);
        if($firstTermMarks->marks=="AB" || $firstTermMarks->marks=="" || $firstTermMarks->marks==null){
          $firstTotalP+=0;
        }else{
        $firstTotalP+=(int)ceil((int)$firstTermMarks->marks*15/100);
      }


      }else{
      //  echo "grade : ".$firstTermMarks->marks;
      echo $firstTermMarks->marks;
      if($firstTermMarks->marks=="A"){
        $acnt++;
      }elseif ($firstTermMarks->marks=="B") {
        $bcnt++;
      }elseif ($firstTermMarks->marks=="C") {
        // code...
        $ccnt++;
      }elseif ($firstTermMarks->marks=="D") {
        $dcnt++;
      }elseif ($firstTermMarks->marks=="E") {
        $ecnt++;
      }else{
        $fcnt++;
      }
      /*  if(array_key_exists($firstTermMarks->marks,$gradeArray)){
          $gg=$gradeArray[$firstTermMarks->marks];
          $gdpoint=$gg*15/100;
          echo array_search(ceil($gdpoint),$gradeArray);
          $gradesubstotal+=$gg;
          $gradesubs++;
          $firstTotalP+=0;
  //        echo "yy" .$gradesubstotal;
        //  echo"point ". $gg;exit;
      }*/
      }
      }else{echo "-";} ?></td>
      <td><?php if(isset($secondTermMarks)){
        if(!$isGraded){
          if($secondTermMarks->marks=="AB" || $secondTermMarks->marks=="" || $secondTermMarks->marks==null){
            echo 0;
            $grandTotal+=0;
            $secondTotalP+=0;
          }else{
            //echo $secondTermMarks->marks;exit;
            echo ceil((int)$secondTermMarks->marks*15/100);
            $grandTotal+=ceil((int)$secondTermMarks->marks*15/100);
            $secondTotalP+=ceil((int)$secondTermMarks->marks*15/100);
          }
      }else{
        echo $secondTermMarks->marks;
        if($secondTermMarks->marks=="A"){
          $acnt++;
        }elseif ($secondTermMarks->marks=="B") {
          $bcnt++;
        }elseif ($secondTermMarks->marks=="C") {
          // code...
          $ccnt++;
        }elseif ($secondTermMarks->marks=="D") {
          $dcnt++;
        }elseif ($secondTermMarks->marks=="E") {
          $ecnt++;
        }else{
          $fcnt++;
        }
      /*  if(array_key_exists($secondTermMarks->marks,$gradeArray)){
          $gg=$gradeArray[$secondTermMarks->marks];
          $gdpoint=$gg*15/100;
          echo array_search(ceil($gdpoint),$gradeArray);
          $gradesubstotal+=$gg;
          $gradesubs++;
          $secondTotalP+=0;
      //    echo "yy" .$gradesubstotal;
        //  echo"point ". $gg;exit;
      } */
      }
      }else{echo "-";} ?></td>
      <td><?php if(isset($monthlyMarks)){
        if(!$isGraded){
        echo (int)ceil($monthlyMarks[0]->marks*20/100);
        $grandTotal+=(int)ceil($monthlyMarks[0]->marks*20/100);

        if($monthlyMarks[0]->marks=="AB" || $monthlyMarks[0]->marks=="" || $monthlyMarks[0]->marks==null){
          $monthlyTotalP+=0;
        }else{
        $monthlyTotalP+=(int)ceil($monthlyMarks[0]->marks*20/100);
      }

      }else{
        //echo"gg ". $monthly;//exit;
       $monthly=$monthlyMarks[0]->marks=="0" || $monthlyMarks[0]->marks=="" || $monthlyMarks[0]->marks==null ? "F" : $monthlyMarks[0]->marks;
      // echo"fff ". $monthly;

      echo $monthly;
      if($monthly=="A"){
        $acnt++;
      }elseif ($monthly=="B") {
        $bcnt++;
      }elseif ($monthly=="C") {
        // code...
        $ccnt++;
      }elseif ($monthly=="D") {
        $dcnt++;
      }elseif ($monthly=="E") {
        $ecnt++;
      }else{
        $fcnt++;
      }

      /*  if(array_key_exists(strval($monthly),$gradeArray)){
          $gg=$gradeArray[$monthly];
          $gdpoint=$gg*20/100;
          echo array_search(ceil($gdpoint),$gradeArray);
          $gradesubstotal+=$gg;
          $gradesubs++;
          $monthlyTotalP+=0;
        //  echo "yy" .$gradesubstotal;
        //  echo"point ". $gg;exit;
      } */
      }
      }else{echo "-";} ?></td>
      <td><?php if(isset($annualTermMarks)){
        if(!$isGraded){
         echo ceil((int)$annualTermMarks->marks*50/100);
        $grandTotal+=ceil((int)$annualTermMarks->marks*50/100);
        if($annualTermMarks->marks=="AB" || $annualTermMarks->marks=="" || $annualTermMarks->marks==null){
          $annualTotalP+=0;
        }else{
        $annualTotalP+=(int)$annualTermMarks->marks*50/100;
      }
        }else{

          echo $annualTermMarks->marks;
          if($annualTermMarks->marks=="A"){
            $acnt++;
          }elseif ($annualTermMarks->marks=="B") {
            $bcnt++;
          }elseif ($annualTermMarks->marks=="C") {
            // code...
            $ccnt++;
          }elseif ($annualTermMarks->marks=="D") {
            $dcnt++;
          }elseif ($annualTermMarks->marks=="E") {
            $ecnt++;
          }else{
            $fcnt++;
          }


        /*  if(array_key_exists($annualTermMarks->marks,$gradeArray)){
            $gg=$gradeArray[$annualTermMarks->marks];
            $gdpoint=$gg*50/100;
            echo array_search(ceil($gdpoint),$gradeArray);
            $gradesubstotal+=$gg;
            $gradesubs++;
            $annualTotalP+=0;
          //  echo "yy" .$gradesubstotal;
          //  echo"point ". $gg;exit;
        } */
        }
      }else{echo "-";} ?></td>
      <td>
      <?php
       if(!$isGraded){
       echo ceil($grandTotal);
       if(ceil($grandTotal)!="AB" || ceil($grandTotal)!="" || ceil($grandTotal)!=null || !is_int(ceil($grandTotal))){
         $grandTotalP+=ceil($grandTotal);
       }else{
        $grandTotalP+=0;
     }
       }else{
        // echo $acnt."|".$bcnt."|".$ccnt."|".$dcnt."|".$fcnt;
         $MaxValues=array("A"=>$acnt,"B"=>$bcnt,"C"=>$ccnt,"D"=>$dcnt,"E"=>$ecnt,"F"=>$fcnt);
      //   $maxValue = max($MaxValues);
      echo $maxIndex = array_search(max($MaxValues), $MaxValues);
      //   echo "<br>".max($acnt, $bcnt, $ccnt, $dcnt, $fcnt);
    /*   if($gradesubs==0){
           $gradesubs=1;
         }
         $fg=ceil((int)$gradesubstotal)/ceil((int)$gradesubs);
       echo array_search(ceil($fg),$gradeArray);
       $grandTotalP+=0; */

       }

       if(ceil($grandTotal) < 30){
         $fr++;
       }
      ?>
    </td>
    </tr>

  <?php endforeach; ?>
  <tr>
    <td>Total</td>
    <td><?php echo ceil($firstTotal); ?></td>
    <td><?php echo ceil($secondTotal); ?></td>
    <td><?php echo ceil($monthlyTotal); ?></td>
    <td><?php echo ceil($annualTotal); ?></td>
    <td><?php echo ceil($firstTotalP); ?></td>
    <td><?php echo ceil($secondTotalP); ?></td>
    <td><?php echo ceil($monthlyTotalP); ?></td>
    <td><?php echo ceil($annualTotalP); ?></td>
    <td><?php echo ceil($grandTotalP); ?></td>
  </tr>
  <tr>
    <td>Percentage of Marks</td>
    <td><?php echo ceil($firstTotal/$x); ?></td>
    <td><?php echo ceil($secondTotal/$x); ?></td>
    <td><?php echo ceil($monthlyTotal/$x); ?></td>
    <td><?php echo ceil($annualTotal/$x); ?></td>
    <td><?php echo ceil($firstTotalP/$x); ?></td>
    <td><?php echo ceil($secondTotalP/$x); ?></td>
    <td><?php echo ceil($monthlyTotalP/$x); ?></td>
    <td><?php echo ceil($annualTotalP/$x); ?></td>
    <td><?php echo ceil($grandTotalP/$x); ?></td>
  </tr>
  <tr>
    <td>No of Pupils in Class</td>
    <td><?php echo ceil($noOfStu); ?></td>
    <td><?php echo ceil($noOfStu); ?></td>
    <td><?php echo ceil($noOfStu); ?></td>
    <td><?php echo ceil($noOfStu); ?></td>
    <td><?php echo ceil($noOfStu); ?></td>
    <td><?php echo ceil($noOfStu); ?></td>
    <td><?php echo ceil($noOfStu); ?></td>
    <td><?php echo ceil($noOfStu); ?></td>
    <td><?php echo ceil($noOfStu); ?></td>
  </tr>
  <tr>
    <td>No of Working Days</td>
    <td><?php echo isset($workingdays[0]->first)?$workingdays[0]->first:"-"; ?></td>
    <td><?php echo isset($workingdays[0]->second)?$workingdays[0]->second:"-"; ?></td>
    <td><?php echo "-"; ?></td>
    <td><?php echo isset($workingdays[0]->final)?$workingdays[0]->final:"-"; ?></td>
    <td><?php echo "-"; ?></td>
    <td><?php echo "-"; ?></td>
    <td><?php echo "-"; ?></td>
    <td><?php echo "-"; ?></td>
    <td><?php echo (isset($workingdays[0]->first)?$workingdays[0]->first:"0")+
                   (isset($workingdays[0]->second)?$workingdays[0]->second:"0")+
                   (isset($workingdays[0]->final)?$workingdays[0]->final:"0"); ?>
    </td>
  </tr>
  <tr>
    <td>No of Days Attended</td>
    <td><?php echo isset($stu_value->total_attendance)?$stu_value->total_attendance==0 ?"-": $stu_value->total_attendance :"-"; ?></td>
    <td><?php echo isset($stu_value->total_attendance)?$stu_value->total_attendance==0 ?"-": $stu_value->total_attendance :"-"; ?></td>
    <td><?php echo "-"; ?></td>
    <td><?php echo isset($stu_value->total_attendance)?$stu_value->total_attendance==0 ?"-": $stu_value->total_attendance :"-"; ?></td>
    <td><?php echo "-"; ?></td>
    <td><?php echo "-"; ?></td>
    <td><?php echo "-"; ?></td>
    <td><?php echo "-"; ?></td>
    <td><?php echo isset($stu_value->total_attendance)?$stu_value->total_attendance==0 ?"-": $stu_value->total_attendance :"-"; ?>
    </td>
  </tr>
  <tr>
    <td>Attended %</td>
    <td><?php echo "-"; ?></td>
    <td><?php echo "-"; ?></td>
    <td><?php echo "-"; ?></td>
    <td><?php echo "-"; ?></td>
    <td><?php echo "-"; ?></td>
    <td><?php echo "-"; ?></td>
    <td><?php echo "-"; ?></td>
    <td><?php echo "-"; ?></td>
    <td><?php echo "-"; ?>
    </td>
  </tr>

</tbody>
</table>
</div>
<div class="col-md-12" style="text-align:center;  margin-left:-5px;margin-right:-5px;margin-top: -10px;">
<h6>PERSONALITY TRAITS</h6>
</div>
<div class="row" style="display: flex;padding: 0px 5px 0px 5px;">
<div class="col-md-12">
  <?php $ptfirst=ExamController::getptFirstMarks($value->subject,$stu_value->reg_no,$cid,$batch,$session)
  ?>
  <?php $ptSecond=ExamController::getptSecondMarks($value->subject,$stu_value->reg_no,$cid,$batch,$session) ?>
  <?php $ptFinal=ExamController::getptFinalMarks($value->subject,$stu_value->reg_no,$cid,$batch,$session) ?>

  <table style="font-size: 7px;" style="width:100%" width="100%">
  <tr>
    <td>
      <table class="table table-bordered">
        <thead>
          <tr>
            <td>TRAITS</td>
            <td>1ST TERM</td>
            <td>2ND TERM</td>
            <td>ANNUAL TERM</td>
          </tr>
        </thead>
      <tbody>

        <tr>
          <td>CLEANLINESS</td>
          <td>
            <?php
            if(!$ptfirst->isEmpty() ) {
             //print_r($ptfirst);exit;
              echo isset($ptfirst[0]->cleanliness)?$ptfirst[0]->cleanliness:"-";
            }else{
            //  print_r($ptfirst);
              echo "-";
            }
             ?>
          </td>
          <td>
            <?php
            if(!$ptSecond->isEmpty()){
            //print_r($ptSecond);  echo "hii";exit;
             echo isset($ptSecond[0]->cleanliness)?$ptSecond[0]->cleanliness:"-";
            }else{
              echo "-";
            }
             ?>
          </td>
          <td>
            <?php
            if(!$ptfirst->isEmpty()){
              /*print_r($ptfirst);  echo "hii";exit;*/
              echo isset($ptFinal[0]->cleanliness)?$ptFinal[0]->cleanliness:"-";
            }else{
              echo "-";
            }
             ?>
          </td>
        </tr>
        <tr>
          <td>CO-OPERATIVE</td>
          <td>
            <?php
            if(!$ptfirst->isEmpty()){
              /*echo $ptfirst->co_operative;*/
              echo isset($ptfirst[0]->co_operative) ? $ptfirst[0]->co_operative : "-";
            }else{
              echo "-";
            }
             ?>
          </td>
          <td>
            <?php
            if(!$ptSecond->isEmpty()){
              /*echo $ptSecond->co_operative;*/
              echo isset($ptSecond[0]->co_operative) ? $ptSecond[0]->co_operative : "-";
            }else{
              echo "-";
            }
             ?>
          </td>
          <td>
            <?php
            if(!$ptFinal->isEmpty()) {
              /*echo $ptFinal->co_operative;*/
              echo isset($ptFinal[0]->co_operative) ? $ptFinal[0]->co_operative : "-";
            }else{
              echo "-";
            }
             ?>
          </td>
        </tr>
        <tr>
          <td>COURTESY</td>
          <td>
            <?php
            if(!$ptfirst->isEmpty() ) {
              /*echo $ptfirst->courtesty;*/
              /*print_r($ptfirst);  echo "hii";exit;*/
              echo isset($ptfirst[0]->courtesty) ? $ptfirst[0]->courtesty : "-";
            }else{
              echo "-";
            }
             ?>
          </td>
          <td>
            <?php
            if(!$ptSecond->isEmpty()){
              /*echo $ptSecond->courtesty;*/
              echo isset($ptSecond[0]->courtesty) ? $ptSecond[0]->courtesty : "-";
            }else{
              echo "-";
            }
             ?>
          </td>
          <td>
            <?php
            if(!$ptFinal->isEmpty()) {
              /*echo $ptFinal->courtesty;*/
              echo isset($ptFinal[0]->courtesty) ? $ptFinal[0]->courtesty : "-";
            }else{
              echo "-";
            }
             ?>
          </td>
        </tr>
        <tr>
          <td>INDUSTRY</td>
          <td>
            <?php
            if(!$ptfirst->isEmpty()){
              echo isset($ptfirst[0]->industry) ? $ptfirst[0]->industry : "-";
              /*echo $ptfirst->industry;*/
            }else{
              echo "-";
            }
             ?>
          </td>
          <td>
            <?php
            if(!$ptSecond->isEmpty() ) {
              /*echo $ptSecond->industry;*/
              echo isset($ptSecond[0]->industry) ? $ptSecond[0]->industry : "-";
            }else{
              echo "-";
            }
             ?>
          </td>
          <td>
            <?php
            if(!$ptFinal->isEmpty()){
              /*echo $ptFinal->industry;*/
              echo isset($ptFinal[0]->industry) ? $ptFinal[0]->industry : "-";
            }else{
              echo "-";
            }
             ?>
          </td>
        </tr>
    </tbody>
      </table>
    </td>
    <td>
      <table class="table table-bordered">
        <thead>
          <tr>
            <td>TRAITS</td>
            <td>1ST TERM</td>
            <td>2ND TERM</td>
            <td>ANNUAL TERM</td>
          </tr>
        </thead>
      <tbody>
        <tr>
          <td>HONESTY</td>
          <td>
            <?php
            if(!$ptfirst->isEmpty()){
            /*  echo $ptfirst->honesty;*/
              echo isset($ptfirst[0]->honesty) ? $ptfirst[0]->honesty : "-";
            }else{
              echo "-";
            }
             ?>
          </td>
          <td>
            <?php
            if(!$ptSecond->isEmpty()){
              /*echo $ptSecond->honesty;*/
              echo isset($ptSecond[0]->honesty) ? $ptSecond[0]->honesty : "-";
            }else{
              echo "-";
            }
             ?>
          </td>
          <td>
            <?php
            if(!$ptFinal->isEmpty()) {
           /*   echo $ptFinal->honesty;*/
              echo isset($ptFinal[0]->honesty) ? $ptFinal[0]->honesty : "-";
            }else{
              echo "-";
            }
             ?>
          </td>
        </tr>
        <tr>
          <td>OBEDIENCE</td>
          <td>
            <?php
            if(!$ptfirst->isEmpty()){
             /* echo $ptfirst->obedience;*/
              echo isset($ptfirst[0]->obedience) ? $ptfirst[0]->obedience : "-";
            }else{
              echo "-";
            }
             ?>
          </td>
          <td>
            <?php
            if(!$ptSecond->isEmpty()){
              /*echo $ptSecond->obedience;*/
              echo isset($ptSecond[0]->obedience) ? $ptSecond[0]->obedience : "-";
            }else{
              echo "-";
            }
             ?>
          </td>
          <td>
            <?php
            if(!$ptFinal->isEmpty()){
              /*echo $ptFinal->obedience;*/
              echo isset($ptFinal[0]->obedience) ? $ptFinal[0]->obedience : "-";
            }else{
              echo "-";
            }
             ?>
          </td>
        </tr>
        <tr>
          <td>PERSISTENCE</td>
          <td>
            <?php
            if(!$ptfirst->isEmpty()) {
              /*echo $ptfirst->persistence;*/
                echo isset($ptfirst[0]->persistence) ? $ptfirst[0]->persistence : "-";
            }else{
              echo "-";
            }
             ?>
          </td>
          <td>
            <?php
            if(!$ptSecond->isEmpty()){
              /*echo $ptSecond->persistence;*/
              echo isset($ptSecond[0]->persistence) ? $ptSecond[0]->persistence : "-";
            }else{
              echo "-";
            }
             ?>
          </td>
          <td>
            <?php
            if(!$ptFinal->isEmpty()){
            /*  echo $ptFinal->persistence;*/
              echo isset($ptFinal[0]->persistence) ? $ptFinal[0]->persistence : "-";
            }else{
              echo "-";
            }
             ?>
          </td>
        </tr>
        <tr>
          <td>PROMPTNESS</td>
          <td>
            <?php
            if(!$ptfirst->isEmpty()){
              /*echo $ptfirst->promptness;*/
              echo isset($ptfirst[0]->promptness) ? $ptfirst[0]->promptness : "-";
            }else{
              echo "-";
            }
             ?>
          </td>
          <td>
            <?php
            if(!$ptSecond->isEmpty()) {
            /*  echo $ptSecond->promptness;*/
              echo isset($ptSecond[0]->promptness) ? $ptSecond[0]->promptness : "-";
            }else{
              echo "-";
            }
             ?>
          </td>
          <td>
            <?php
            if(!$ptFinal->isEmpty()){
             /* echo $ptFinal->promptness;*/
              echo isset($ptFinal[0]->promptness) ? $ptFinal[0]->promptness : "-";
            }else{
              echo "-";
            }
             ?>
          </td>
        </tr>
    </tbody>
      </table>
    </td>
  </tr>
  </table>
</div>
</div>

<div class="row" style="display: flex;padding: 5px;margin-top: -20px;">
<div class="col-md-12">
<span style="font-size:10px;">Grade A = 80 % TO 100% , B = 60% TO 79%
   C = 50% TO 59% , D = 40% TO 49% , E = 35% TO 39% ,F = 0% TO 34% .</span>
</div>
</div>
<div class="row" style="display: flex;padding: 5px;">
<div class="col-md-12" style="text-align:center;">
<h4 style="font-size: 12px;">TEACHER'S REMARKS</h4>
<p style="font-size: 8px;">( Passed / Promoted / WithHeld / Detained )</p>
</div>
</div>
<div class="row" style="display:flex;padding: 5px;">
<div class="col-md-12">
<h4 style="font-size: 12px;">FINAL RESULT :  <span><?php if($fr==0){echo "PASS and Promoted to Class ".$nextClass;}else{echo "Promoted to Class ".$nextClass;};  ?> </span></h4>
<br>  <span style="font-size: 10px;">SIGNATURE SUPERVISOR/HEADMASTER&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
  <span style="font-size: 10px;" class="margin" style="margin-left:20px">CLASS TEACHER&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
  <span style="font-size: 10px;" class="margin" style="margin-left:20px">PRINCIPAL</span>
</div>
</div>
<div class="row" style="display:flex;padding: 5px;">
<div class="col-md-12" style="float:right;">
<span style="font-size: 8px;">School Seal</span>
</div>
</div>
<span style="font-size: 8px;"><?php echo $stu_value->reg_no ?></span>
</div>

<?php endforeach; ?>

</div>

<script>
$(document).ready(function() {
  alert();
   $.extend($.fn.dataTable.defaults, {
 dom: 'Bfrtip'
});
   $('#example').DataTable();
   } );
</script>
