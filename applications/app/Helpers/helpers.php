<?php

use App\AppConfig;


function app_config($value = '',$branchcode='')
{ 
    $conf = AppConfig::where('setting','=',$value)->first();
    return $conf->value;
}
/*For Permission*/



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
