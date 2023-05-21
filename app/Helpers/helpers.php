<?php

use App\AppConfig;
use App\Employee;
use App\Leave;
use App\institute_details;

function sendNotification($from,$to=null,$user_role=null,$subject=null,$msg=null,$notice_path=false,$notice_type=null,$class=false,$section=false){
  if($notice_path){
    if(isset($_FILES['file'])){
    $errors= array();
    $file_name = $_FILES['file']['name'];
    $file_size =$_FILES['file']['size'];
    $file_tmp =$_FILES['file']['tmp_name'];
    $file_type=$_FILES['file']['type'];
    $file_ext=strtolower(end(explode('.',$_FILES['file']['name'])));

    $extensions= array("jpeg","jpg","png","pdf");

    if(in_array($file_ext,$extensions)=== false){
       $errors[]="extension not allowed, please choose a JPEG or PNG or PDF file.";
    }


    if(empty($errors)==true){
       move_uploaded_file($file_tmp,"assets/uploads/notice/".$file_name);
       $notice_path="assets/uploads/notice/".$file_name;

    }else{
      // print_r($errors);
    }
 }
  }
  $data=array(
    "user_from"=>$from,
    "user_to"=>$to,
    "user_role"=>$user_role,
    "subject"=>$subject,
    "discription"=>$msg,
    "notice_path"=>$notice_path,
    "notice_type"=>$notice_type,
  );
  $lastId=DB::table('user_notification')->insertGetId($data);

  if($class || $batch){
    $dataclass=array(
      "notice_id"=>$lastId,
      "class"=>$class,
      "section"=>$section,
    );
    DB::table('user_notification_other')->insertGetId($dataclass);
  }
  return true;
}
function getNotification(){
  if(Auth::user()->user_role=='S'){
    $reg_no=Auth::user()->username;
    $sql = "SELECT * FROM stu_admission a
    WHERE a.reg_no='$reg_no' ORDER BY a.id DESC LIMIT 1";
    $result = DB::select($sql);
    $extra="WHERE (case when x.notice_id IS NOT NULL then x.class='".$result[0]->course."' OR x.section='".$result[0]->batch."' ELSE 1=1 END)";
    }else{
      $extra="";
    }
  //echo $extra;exit;
$notice=  DB::select(DB::raw("SELECT * FROM (SELECT a.*,b.id AS other_id,b.notice_id,b.class,b.section FROM user_notification a
LEFT JOIN user_notification_other b ON a.id=b.id
WHERE a.user_to=:user_to AND a.`status`=1
UNION all
SELECT a.*,b.id AS other_id,b.notice_id,b.class,b.section FROM user_notification a
LEFT JOIN user_notification_other b ON a.id=b.id
WHERE a.user_role=:user_role AND a.`status`='1'
) x
$extra"), array(
  'user_to' =>Auth::user()->username,
  'user_role' => Auth::user()->user_role
  ));
  
  return $notice;
}


function app_config($value = '',$branchcode='')
{
    $conf = AppConfig::where('setting','=',$value)->where('branch_code','=',$branchcode)->first();
    return $conf->value;
}
function institute_details($branchcode='',$column)
{
      $conf = institute_details::where('branch_code','=',$branchcode)->first([$column]);
      return $conf->$column;
}
/*For Permission*/

function permission ($role_id,$perm_id) {

    $permcheck = \App\EmployeeRolesPermission::where('role_id', $role_id)->where('perm_id', $perm_id)->first();
   // print_r($permcheck);exit;
    if ($permcheck==NULL){
        return false;
    }else{
        if (!$permcheck->perm_id>0){
            return false;
        }
        return true;
    }

}
function menuAccess($role_id,$perm_id) {
   // echo $perm_id;exit;
   \DB::enableQueryLog();
    if($role_id!="1"){
    $permcheck = \App\EmployeeRolesPermission::where('role_id', $role_id)->where('perm_id', $perm_id)->first();
   // print_r($permcheck);exit;
   //echo $permcheck;
   $query = \DB::getQueryLog();
     //   print_r(end($query));
    if ($permcheck==NULL){
     //   exit;
        return false;
    }else{
        if (!$permcheck->perm_id>0){
            exit;
            return false;
        }else{

        return true;
        }
    }
}else{
    return true;
}

}

 function sendSMS($Mobile_No, $smsText)
    {

        $msg="";
        $mobno = filter_var($Mobile_No,FILTER_SANITIZE_STRING);

        $msg = $smsText;
        $baseurl = "http://msg.smscluster.com/rest/services/sendSMS/sendGroupSms?AUTH_KEY=9044463e6b29e6282dbce1b6b820fdc2&message=$msg&senderId=METASC&routeId=1&mobileNos=$mobno&smsContentType=english";

        $curl_handle=curl_init();
        curl_setopt($curl_handle,CURLOPT_URL,$baseurl);
        curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,2);
        curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);
        $buffer = curl_exec($curl_handle);
        curl_close($curl_handle);
        if (empty($buffer)){
            return $baseurl;
        }
        else{
            return $baseurl;
        }
}

// payment gatway code start//

function encrypts($plainText,$key)
	{
		$key = hextobin(md5($key));
		$initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
		$openMode = openssl_encrypt($plainText, 'AES-128-CBC', $key, OPENSSL_RAW_DATA, $initVector);
		$encryptedText = bin2hex($openMode);
		return $encryptedText;
	}

	function decrypts($encryptedText,$key)
	{
		$key = hextobin(md5($key));
		$initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
		$encryptedText = hextobin($encryptedText);
		$decryptedText = openssl_decrypt($encryptedText, 'AES-128-CBC', $key, OPENSSL_RAW_DATA, $initVector);
		return $decryptedText;
	}
	//*********** Padding Function *********************

	 function pkcs5_pad ($plainText, $blockSize)
	{
	    $pad = $blockSize - (strlen($plainText) % $blockSize);
	    return $plainText . str_repeat(chr($pad), $pad);
	}

	//********** Hexadecimal to Binary function for php 4.0 version ********

	function hextobin($hexString)
   	 {
        	$length = strlen($hexString);
        	$binString="";
        	$count=0;
        	while($count<$length)
        	{
        	    $subString =substr($hexString,$count,2);
        	    $packedString = pack("H*",$subString);
        	    if ($count==0)
		    {
				$binString=$packedString;
		    }

		    else
		    {
				$binString.=$packedString;
		    }

		    $count+=2;
        	}
  	        return $binString;
    	  }
// payment gatway code end//

function roman_number($integer, $upcase = true) 
{
    $table = array('M'=>1000, 'CM'=>900, 'D'=>500, 'CD'=>400, 'C'=>100, 'XC'=>90, 'L'=>50, 'XL'=>40, 'X'=>10, 'IX'=>9, 'V'=>5, 'IV'=>4, 'I'=>1);
    $return = '';
    while($integer > 0)
    {
        foreach($table as $rom=>$arb)
        {
            if($integer >= $arb)
            {
                $integer -= $arb;
                $return .= $rom;
                break;
            }
        }
    }

    return $return;
}
