session_start();
<?php
    if($_GET['sendSMS'] == "true"){sms_Send();}
    $msg="";
	
    function search()
    { $url="student/list/send/sms";
        $mobnos=$_GET['mobileNos'];
        $mobno = base64_encode(convert_uuencode($mobnos));
        header('Location: '.$url);
    }

    function sms_Send()
    {
		
        $text=urlencode($_GET['message']);
        $number=$_GET['mobileNos'];
		
		
		
		//echo"check";
		//echo"$text";
		//echo"$number";
		//die();
        // $gotoURL = $_GET['gotoURL'];
        $cSession = curl_init();
        $arr=array();
        curl_setopt($cSession,CURLOPT_URL,"http://msg.smscluster.com/rest/services/sendSMS/sendGroupSms?AUTH_KEY=9044463e6b29e6282dbce1b6b820fdc2&message=".$text."&senderId=DIGEMO&routeId=1&mobileNos=".$number."&smsContentType=english");
		
        curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($cSession,CURLOPT_HEADER,false);
        $results=curl_exec($cSession);
        print_r($results);
		
        curl_close($cSession);
    }
    search();


?>
