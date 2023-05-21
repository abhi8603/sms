<?php
namespace App\atompay;

namespace App\Http\Controllers;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;

use App\Http\Requests;
use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use App\permission;
use App\EmployeeRolesPermission;
use App\EmployeeRoles;
use App\institute_details;
use App\TransactionRequest;
use App\TransactionResponse;
use Session;
use Illuminate\Support\Facades\Crypt;
use PDF;
date_default_timezone_set('Asia/Kolkata');
class parentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('ParentMiddleware');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
	
	
public function downloadCurricularCertificate(Request $request){
  $stu=explode("|",Input::get('stu_name'));
//	print_r($stu);exit;
	$stu_name=$stu[0];
	$reg_no=$stu[1];
  $class=Input::get('class');
  $participating_in=Input::get('participating_in');
  $accdmic_year=Input::get('accdmic_year');
  $type=Input::get('type');

	$whereArray=array(
"reg_no"=>$reg_no,
"stu_name"=>$stu_name,
"type"=>$type,
"class"=>$class,
"participating_in"=>$participating_in,
"accdmic_year"=>$accdmic_year,
);
	
$cnt=DB::table('curricular_certificate_issue')->where($whereArray)->count();


  //PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('reports.invoiceSell')->stream();
  $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true,'setBasePath'=>$_SERVER['DOCUMENT_ROOT']])->loadView('students.downloadCurricularCertificate',['stu_name'=>$stu_name,'class'=>$class,'participating_in'=>$participating_in,'accdmic_year'=>$accdmic_year,'type'=>$type]);
  //PDF::setBasePath($_SERVER['DOCUMENT_ROOT']);
 // return view('students.downloadCurricularCertificate',compact('stu_name','class','participating_in','accdmic_year')); //$pdf->download($id.'.pdf');
    return $pdf->download($stu_name.'.pdf');
}

	
     public function CurricularCertificate(){
		 $regNo= session()->get('wardregno');
	$list=DB::table('curricular_certificate_issue')->where('reg_no',$regNo)->orderBy('id','desc')->get();
	 return view('gurdian.CurricularCertificate',compact('list'));
	 }
     public function viewward($id){
		// echo Auth::user()->user_role;exit;
       $id=Crypt::decrypt($id);
		 $course="";
       session(['wardregno' => $id]);
       $wards = DB::table('stu_contact')
                   ->join('stu_admission', 'stu_contact.reg_no', '=', 'stu_admission.reg_no')
                   ->join('tb_course', 'stu_admission.course', '=', 'tb_course.id')
                   ->join('tb_batch', 'stu_admission.batch', '=', 'tb_batch.id')
                   ->select('stu_contact.father_phone', 'stu_admission.accdmic_year', 'stu_admission.reg_no', 'tb_course.course_name', 'tb_batch.batch_name', 'stu_admission.roll_no', 'stu_admission.stu_name')
                   ->where('stu_contact.reg_no',$id)
                //   ->where('stu_admission.status',1)
                   ->where('stu_admission.branch_code',Auth::user()->school_id)
                   ->get();
       $data = DB::table('stu_contact')
                   ->join('stu_admission', 'stu_contact.reg_no', '=', 'stu_admission.reg_no')
                   ->select('stu_contact.father_phone', 'stu_admission.accdmic_year', 'stu_admission.reg_no', 'stu_admission.course', 'stu_admission.batch', 'stu_admission.roll_no', 'stu_admission.stu_name')
                   ->where('stu_contact.reg_no',$id)
                //   ->where('stu_admission.status',1)
                   ->where('stu_admission.branch_code',Auth::user()->school_id)
                   ->get();
      foreach ($data as $data) {
      $course=$data->course;
      $batch=$data->batch;
       }
       app_config('Session',Auth::user()->school_id);
      /* $classsubject= DB::table('assign_subject')
            ->join('tb_subject', 'assign_subject.subject', '=', 'tb_subject.id')
            ->select('assign_subject.*', 'tb_subject.subject_name', 'tb_subject.id', 'tb_subject.subject_code')
          //  ->where('assign_subject.batch',$batch)
            ->where('assign_subject.course',$course)
            ->where('assign_subject.branch_id',Auth::user()->school_id)
            ->get();*/
            $sid= Auth::user()->school_id;
            $sql="SELECT `assign_subject`.*,c.emp_id,CONCAT_WS(' ',d.fname,d.mname,d.lname) AS emp_name, `tb_subject`.`subject_name`, `tb_subject`.`id`, `tb_subject`.`subject_code`
                  FROM `assign_subject`
                  INNER JOIN `tb_subject` ON `assign_subject`.`subject` = `tb_subject`.`id`
                  LEFT JOIN subject_allocation c ON assign_subject.subject=c.subject AND assign_subject.course=c.course
                  left JOIN emp_details d ON c.emp_id=d.empcode
                  WHERE  `assign_subject`.`course` = '$course' AND `assign_subject`.`branch_id` = '$sid'
                  GROUP BY assign_subject.subject";
              $classsubject=DB::select($sql);
      $classteacher= DB::table('class_teacher_allocation')
                  ->join('emp_details', 'class_teacher_allocation.teacher_id', '=', 'emp_details.empcode')
                  ->join('emp_contact', 'emp_details.empcode', '=', 'emp_contact.emp_id')
                  ->select('class_teacher_allocation.*', 'emp_details.fname', 'emp_details.mname', 'emp_details.mname', 'emp_details.lname', 'emp_details.lname', 'emp_contact.phone')
                  ->where('class_teacher_allocation.batch',$batch)
                  ->where('class_teacher_allocation.course',$course)
                  ->where('class_teacher_allocation.accadmicyear',app_config('Session',Auth::user()->school_id))
                  ->where('class_teacher_allocation.branch_code',Auth::user()->school_id)
                  ->get();
                  $lastfeereceipt=DB::table('fee_collection')
                  ->where('stu_reg_no',$id)->where('acadmic_year',app_config('Session',Auth::user()->school_id))
                  ->where('branch_code',Auth::user()->school_id)->latest()->first();
                  if($lastfeereceipt !=null){
                $receipt_no=$lastfeereceipt->receipt_no;
              }else{
                  $receipt_no="0";
              }

      $lastfeepaid=DB::table('fee_collection')->select(DB::raw('sum(amt) as totalfee,month,year,pay_mode,created_date'))
      ->where('receipt_no',$receipt_no)->where('receipt_no',$receipt_no)->where('acadmic_year',app_config('Session',Auth::user()->school_id))
      ->where('branch_code',Auth::user()->school_id)->get();
 $currentmonth= date('F');
  $currntdate=date('d');
  $total_days=cal_days_in_month(CAL_GREGORIAN, date('m'), date('y'));
$attendance=DB::table('stu_attendance')->where('reg_no',session()->get('wardregno'))->where('month',$currentmonth)->where('accadmicyear',app_config('Session',Auth::user()->school_id))->where('status','P')->count();
$absentdays=$currntdate-$attendance;

       return view('gurdian.main-welcome',compact('wards','classsubject','classteacher','lastfeepaid','attendance','absentdays'));
     }

     public function feepayonline(){
       if(version_compare(PHP_VERSION, '7.2.0', '>=')) {
           error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
       }
       $receipt_no=DB::table('fee_collection')->latest('id')->where('branch_code',Auth::user()->school_id)->first();
       if(count($receipt_no) > 0){
         $receipt_no=$receipt_no->receipt_no+1;
       }else{
         $receipt_no=1;
       }
      return view('gurdian.feepay-online',compact('receipt_no'));
     }




     public function getfeecolleciononline(Request $request){
       $eid = $request->date;
       $data=json_decode($eid);
       $reg_no = $request->reg_no;
       $receipt_no = $request->receipt_no;
       $course_code = $request->course_code;
       $batch = $request->batch;
       $pay_mode = $request->pay_mode;
       $bankname = $request->bankname;
       $chequeno = $request->chequeno;
       $chequedate = $request->chekdate;
       $remark = $request->remark;
       $dob = $request->dob;
       $student_name=$request->student_name;
       $year=date("Y");
       $created_date = date('Y-m-d');

     foreach ($data as $data) {
       // code...
       $feehead=$data->feehead;
       $feename=$data->feename;
       $actualamount=$data->actualamount;
       $due=$data->due;
       $discount=$data->discount;
       $month=$data->Month;
       $final_amt=$actualamount-$discount;
       try {
     $savedata= DB::table('fee_collection')->insert(['stu_reg_no'=>$reg_no,'stu_name'=>$student_name,'class'=>$course_code,'section'=>$batch,
     'month'=>$month,'year'=>$year,'fee_head'=>$feehead,'fee_category'=>$feename,
     'amt'=>$actualamount,'dueamt'=>$due,'discount'=>$discount,'final_amt'=>$final_amt,'pay_mode'=>$pay_mode,'bankname'=>$bankname,'chequeno'=>$chequeno,
     'chequedate'=>$chequedate,'remark'=>$remark,'receipt_no'=>$receipt_no,'receipt_status'=>'0','acadmic_year'=>app_config('Session',Auth::user()->school_id),'branch_code'=>Auth::user()->school_id,'created_date'=>$created_date]);
   }catch(\Illuminate\Database\QueryException $ex){
     echo $ex->getMessage();
   }
     }
     if(!empty($savedata)){
       echo "Fee Collected Successfully for Registration No ".$reg_no;
  //    return redirect('parents/ward/fee/payonline/paymentgatway');
     }else{
       echo "Unable to Collect Fee.Please Try Again.";
     }

     }
     function paytempered(){
       return redirect('parents/ward/fee/payonline')->with([
            'message' => 'Someting Went Worng. Please Contact Admin',
            'message_important'=>true
        ]);
     }
     function payredirect(){
  $merchant_data=app_config('pg_merchant_id',Auth::user()->school_id);
	$working_key=app_config('pg_working_key',Auth::user()->school_id);
	$access_code=app_config('pg_access_code',Auth::user()->school_id);

	foreach ($_POST as $key => $value){
		$merchant_data.=$key.'='.$value.'&';
	}
	$encrypted_data=encrypts($merchant_data,$working_key);
  return view('gurdian.pg-redirect',compact('encrypted_data','access_code'));
//  echo "<pre>";print_r($encrypted_data);
     }
     public function paymentgatway($id){
        $receipt_id=base64_decode($id);
        $fee_total=DB::table('fee_collection')->where('receipt_no',$receipt_id)->sum('amt');
        $fee_due=DB::table('fee_collection')->where('receipt_no',$receipt_id)->sum('dueamt');
        $fee_discount=DB::table('fee_collection')->where('receipt_no',$receipt_id)->sum('discount');
        $fee_sum=($fee_total+$fee_due)-$fee_discount;//exit;
        $fee_details=DB::table('fee_collection')
        ->join('stu_contact', 'fee_collection.stu_reg_no', '=', 'stu_contact.reg_no')
        ->join('tb_batch', 'fee_collection.section', '=', 'tb_batch.id')
        ->join('tb_course', 'fee_collection.class', '=', 'tb_course.id')
        ->select('fee_collection.*', 'stu_contact.*','tb_batch.batch_name','tb_course.course_name')
        ->where('fee_collection.receipt_no',$receipt_id)
        ->where('fee_collection.branch_code',Auth::user()->school_id)
        ->get();
        foreach ($fee_details as $fee_details) {
          // code...
          $course_name=$fee_details->course_name;
          $batch_name=$fee_details->batch_name;
          $month=$fee_details->month;
          $year=$fee_details->year;
          $stu_reg_no=$fee_details->stu_reg_no;
          $stu_name=$fee_details->stu_name;
          $permanent_address=$fee_details->permanent_address;
          $city=$fee_details->city;
          $country=$fee_details->country;
          $pin=$fee_details->pin;
          $state=$fee_details->state;
          $email=$fee_details->email;
          $father_phone=$fee_details->father_phone;
        }
      //  app_config('pg_access_code',Auth::user()->school_id);
//$encrypted_data=encrypts($state,app_config('pg_working_key',Auth::user()->school_id));
//echo $encrypted_data;
  //    exit;
        //echo "<pre>";
        if($email==""){
        $email=app_config('Email',Auth::user()->school_id);
        }
        $billing_address=$permanent_address."-".$city."-".$state."-".$pin;

       $datenow = date("d/m/Y h:m:s");
       $transactionDate = str_replace(" ", "%20", $datenow);
       $transactionId = $receipt_id;
       $paydata=array(
         "course_name"=>$course_name,
         "batch_name"=>$batch_name,
         "month"=>$month,
         "year"=>$year,
         "stu_reg_no"=>$stu_reg_no,
         "stu_name"=>$stu_name,
         "billing_address"=>$billing_address,
         "city"=>$city,
         "country"=>$country,
         "pin"=>$pin,
         "state"=>$state,
         "father_phone"=>$father_phone,
         "email"=>$email,
         "transactionId"=>$transactionId,
         "fee_sum"=>$fee_sum
       );
       $session_pay=array(
         "order_id"=>$transactionId,
         "amt"=>$fee_sum
       );
       Session::put('onlinepay_data', $session_pay);

       $ipaddress = '';
   if (getenv('HTTP_CLIENT_IP'))
       $ipaddress = getenv('HTTP_CLIENT_IP');
   else if(getenv('HTTP_X_FORWARDED_FOR'))
       $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
   else if(getenv('HTTP_X_FORWARDED'))
       $ipaddress = getenv('HTTP_X_FORWARDED');
   else if(getenv('HTTP_FORWARDED_FOR'))
       $ipaddress = getenv('HTTP_FORWARDED_FOR');
   else if(getenv('HTTP_FORWARDED'))
      $ipaddress = getenv('HTTP_FORWARDED');
   else if(getenv('REMOTE_ADDR'))
       $ipaddress = getenv('REMOTE_ADDR');
   else
       $ipaddress = 'UNKNOWN';
       DB::table('pg_trans_log')->insert(['order_id'=>$transactionId,'amount'=>$fee_sum,
       'by'=>Auth::user()->username,'ip_address'=>$ipaddress,'trans_status'=>'initiated']);
//    echo"<pre>";   print_r($paydata);
    return view('gurdian.paymentGatway',compact('paydata'));
    exit;

       $transactionRequest = new TransactionRequest();

     $transactionRequest->setLogin(192);
       $transactionRequest->setPassword("Test@123");
       $transactionRequest->setProductId("NSE");
       $transactionRequest->setAmount($fee_sum);
       $transactionRequest->setTransactionCurrency("INR");
       $transactionRequest->setTransactionAmount($fee_sum);
       $transactionRequest->setReturnUrl(url('/')."/parents/ward/fee/payonline/getresponse");
       $transactionRequest->setClientCode($stu_reg_no);
       $transactionRequest->setTransactionId($transactionId);
       $transactionRequest->setTransactionDate($transactionDate);
       $transactionRequest->setCustomerName($stu_name);
       $transactionRequest->setCustomerEmailId($email);
       $transactionRequest->setCustomerMobile($father_phone);
       $transactionRequest->setCustomerBillingAddress($billing_address);
       $transactionRequest->setCustomerAccount("639827");
       $transactionRequest->setReqHashKey("KEY123657234");
       $transactionRequest->seturl("https://paynetzuat.atomtech.in/paynetz/epi/fts");
       $transactionRequest->setRequestEncypritonKey("8E41C78439831010F81F61C344B7BFC7");
       $transactionRequest->setSalt("8E41C78439831010F81F61C344B7BFC7");

       $url = $transactionRequest->getPGUrl();
      // echo $url;
       return redirect($url);
     }
     public function ToObject($Array) {

    // Clreate new stdClass object
    $object = new \stdClass();

    // Use loop to convert array into object
    foreach ($Array as $key => $value) {
        if (is_array($value)) {
            $value = ToObject($value);
        }
        $object->$key = $value;
    }
    return $object;
}
     public function getpaymentgatwayresponse(Request $request){

      $workingKey=app_config('pg_working_key',Auth::user()->school_id);		//Working Key should be provided here.
     	$encResponse=$_POST["encResp"];			//This is the response sent by the CCAvenue Server
     	$rcvdString=decrypts($encResponse,$workingKey);		//Crypto Decryption used as per the specified working key.
     	$order_status="";
     	$decryptValues=explode('&', $rcvdString);
     	$dataSize=sizeof($decryptValues);
     	for($i = 0; $i < $dataSize; $i++)
     	{
     		$information=explode('=',$decryptValues[$i]);
     		if($i==3)	$order_status=$information[1];
     	}
     	if($order_status==="Success")
     	{
     	//	echo "<br>Thank you for shopping with us. Your credit card has been charged and your transaction is successful. We will be shipping your order to you soon.";
     	}
     	else if($order_status==="Aborted")
     	{
     	//	echo "<br>Thank you for shopping with us.We will keep you posted regarding the status of your order through e-mail";
     	}
     	else if($order_status==="Failure")
     	{
     	//	echo "<br>Thank you for shopping with us.However,the transaction has been declined.";
     	}
     	else
     	{
     	//	echo "<br>Security Error. Illegal access detected";
     	}
      $paymentresponse=array();
     	for($i = 0; $i < $dataSize; $i++)
     	{
     		$information=explode('=',$decryptValues[$i]);
        $paymentresponse[$information[0]]=$information[1];
     	}
    //  $pg_trans=array();
      $value=$this->ToObject($paymentresponse);
//print_r($value->order_id);exit;
//foreach ($pg_trans as $value) {
  // code...
$order_id=$value->order_id;
$tracking_id=$value->tracking_id;
$bank_ref_no=$value->bank_ref_no;
$status=$value->order_status;
$failure_message=$value->failure_message;
$payment_mode=$value->payment_mode;
$card_name=$value->card_name;
$status_code=$value->status_code;
$status_message=$value->status_message;
$currency=$value->currency;
$amount=$value->amount;
$billing_name=$value->billing_name;
$billing_address=$value->billing_address;
$billing_name=$value->billing_name;
$billing_city=$value->billing_city;
$billing_state=$value->billing_state;
$billing_zip=$value->billing_zip;
$billing_country=$value->billing_country;
$billing_zip=$value->billing_zip;
$billing_tel=$value->billing_tel;
$billing_email=$value->billing_email;
$delivery_name=$value->delivery_name;
$delivery_address=$value->delivery_address;
$delivery_city=$value->delivery_city;
$delivery_state=$value->delivery_state;
$delivery_zip=$value->delivery_zip;
$delivery_country=$value->delivery_country;
$delivery_tel=$value->delivery_tel;
$stu_reg_no=$value->merchant_param1;
$pay_year=$value->merchant_param2;
$pay_month=$value->merchant_param3;
$stu_class=$value->merchant_param4;
$stu_section=$value->merchant_param5;
$vault=$value->vault;
$offer_type=$value->offer_type;
$offer_code=$value->offer_code;
$discount_value=$value->discount_value;
$mer_amount=$value->mer_amount;
$eci_value=$value->eci_value;
$retry=$value->retry;
$response_code=$value->response_code;
$billing_notes=$value->billing_notes;
$trans_date=$value->trans_date;
$bin_country=$value->bin_country;
//print_r(session('onlinepay_data'));
//echo"<br>". floatval(session('onlinepay_data.amt'));
//echo "<br>".$order_id."-".$amount."-".$mer_amount;
/*if(session('onlinepay_data.order_id')==$order_id && (double)session('onlinepay_data.amt')==(double)$amount){
      $cntrow= DB::table('pg_trans')->where('order_id',$order_id)->count();
      if($cntrow != 0){
        return redirect('parents/ward/payonline/fail/'.base64_encode($order_id))->with([
            'message' => 'Sorry Someting went Worng.',
            'message_important'=>true
        ]);
      }
}else{
  return redirect('parents/ward/payonline/fail/'.base64_encode($order_id))->with([
    'message' => 'Sorry Someting went Worng..',
    'message_important'=>true
 ]);
}*/

if(session('onlinepay_data.order_id')!=$order_id && number_format(session('onlinepay_data.amt'),2)!=number_format($amount,2)){
  $savedata=DB::table('pg_trans')->insert($pg_data);
  return redirect('parents/ward/payonline/fail/'.base64_encode($order_id))->with([
    'message' => 'Sorry Someting went Worng..',
    'message_important'=>true
 ]);
}else{
//exit;
$cntrow= DB::table('pg_trans')->where('order_id',$order_id)->count();
if($cntrow != 0){
  return redirect('parents/ward/payonline/fail/'.base64_encode($order_id))->with([
      'message' => 'Sorry Someting went Worng.',
      'message_important'=>true
  ]);
}
}

$request->session()->forget('onlinepay_data');
//exit;

$pg_data['order_id'] = $order_id;
$pg_data['tracking_id'] = $tracking_id;
$pg_data['bank_ref_no'] = $bank_ref_no;
$pg_data['order_status'] = $status;
$pg_data['failure_message'] = $failure_message;
$pg_data['payment_mode'] = $payment_mode;
$pg_data['card_name'] = $card_name;
$pg_data['status_code'] = $status_code;
$pg_data['status_message'] = $status_message;
$pg_data['currency'] = $currency;
$pg_data['amount'] = $amount;
$pg_data['billing_name'] = $billing_name;
$pg_data['billing_address'] = $billing_address;
$pg_data['billing_city'] = $billing_city;
$pg_data['billing_state'] = $billing_state;
$pg_data['billing_zip'] = $billing_zip;
$pg_data['billing_country'] = $billing_country;
$pg_data['billing_tel'] = $billing_tel;
$pg_data['billing_email'] = $billing_email;
$pg_data['delivery_name'] = $delivery_name;
$pg_data['delivery_address'] = $delivery_address;
$pg_data['delivery_city'] = $delivery_city;
$pg_data['delivery_state'] = $delivery_state;
$pg_data['delivery_zip'] = $delivery_zip;
$pg_data['delivery_country'] = $delivery_country;
$pg_data['delivery_tel'] = $delivery_tel;
$pg_data['stu_reg_no'] = $stu_reg_no;
$pg_data['pay_year'] = $pay_year;
$pg_data['pay_month'] = $pay_month;
$pg_data['stu_class'] = $stu_class;
$pg_data['stu_section'] = $stu_section;
$pg_data['vault'] = $vault;
$pg_data['offer_type'] = $offer_type;
$pg_data['offer_code'] = $offer_code;
$pg_data['discount_value'] = $discount_value;
$pg_data['mer_amount'] = $mer_amount;
$pg_data['eci_value'] = $eci_value;
$pg_data['retry'] = $retry;
$pg_data['response_code'] = $response_code;
$pg_data['billing_notes'] = $billing_notes;
$pg_data['trans_date'] = $trans_date;
$pg_data['bin_country'] = $bin_country;
//$pg_data['trans_status'] = "completed";


  DB::table('pg_trans_log')->where('order_id',$order_id)->update(['trans_status'=>'completed']);
        if($status=="Success"){
          $savedata=DB::table('pg_trans')->insert($pg_data);
          if(!empty($savedata)){

            DB::table('fee_collection')
            ->where('receipt_no', $order_id)
            ->update(['receipt_status' => "1"]);

              return redirect('parents/ward/payonline/receipt/'.base64_encode($order_id))->with([
                  'message' => 'Online Fee Collected Successfully.Please print Fee Receipt.'
              ]);
          }else{
            DB::table('fee_collection')
            ->where('receipt_no', $order_id)
            ->update(['receipt_status' => "1"]);

              return redirect('parents/ward/payonline/receipt/'.base64_encode($order_id))->with([
                  'message' => 'Online Fee Collected Successfully.Please print Fee Receipt.'
              ]);
          }

        }else{
          $savedata=DB::table('pg_trans')->insert($pg_data);
          return redirect('parents/ward/payonline/fail/'.base64_encode($order_id))->with([
              'message' => 'Sorry Someting went Worng.'
          ]);

        }

     }

     public function paymentfailure($id){
       $id=base64_decode($id);
      $transdetails= DB::table('pg_trans')->where('order_id',$id)->get();
       foreach ($transdetails as $transdetails) {
         // code...
         $receipt=$transdetails->order_id;
         $ipg_txn_id=$transdetails->bank_ref_no;
         $date=$transdetails->trans_date;
         $amt=$transdetails->amount;
         $tracking_id=$transdetails->tracking_id;
         $error=$transdetails->status_message;
       }
          return view('gurdian.payment-fail',compact('id','error','receipt','tracking_id','ipg_txn_id','amt','date'),['message'=>'Sorry Transaction Fail.']);
     }

     public function viewreceipt($id){
       $id=base64_decode($id);
       $logo=null;
       $Institution=DB::table('create_institute')->where('branch_code',Auth::user()->school_id)->get();
       foreach ($Institution as $Institution) {
         $address = $Institution->insitute_address;
         $InstitutionEmail = $Institution->insitute_email;
         $InstitutionMobile = $Institution->insitute_mobile;

         $logo = $Institution->logo;

         $Institutionphone = $Institution->insitute_phone;
         $Institutionfax = $Institution->insitute_fax;

       }
     $month=array();
  //   echo base64_decode($id);exit;
       $receipt = DB::table('fee_collection')
                   ->join('tb_course', 'fee_collection.class', '=', 'tb_course.id')
                   ->join('tb_batch', 'fee_collection.section', '=', 'tb_batch.id')
                   ->select('fee_collection.*', 'tb_course.course_name', 'tb_batch.batch_name')
                   ->where('fee_collection.branch_code',Auth::user()->school_id)
                   ->where('fee_collection.receipt_no',$id)
                   ->groupBy('fee_collection.month')
                   ->get();
                //   print_r($receipt);exit;
       foreach($receipt as $receipt){
         $stu_reg_no=$receipt->stu_reg_no;
         $stu_name=$receipt->stu_name;
         $class=$receipt->course_name;
         $section=$receipt->batch_name;
         $date=$receipt->created_date;
         $pay_mode=$receipt->pay_mode;
         $receipt_status=$receipt->receipt_status;
         $monthName = date('F', mktime(0, 0, 0, $receipt->month, 10));

         array_push($month,$monthName);
       }
       //print_r($month);
       $receipts=DB::table('fee_collection')->select(DB::raw('fee_head,month, SUM(amt) as totamount,sum(discount) as discount,sum(final_amt) as final_amt'))
       ->where('branch_code',Auth::user()->school_id)
       ->where('receipt_no',$id)
       ->groupBy('fee_head')
       ->get();
       $pg_data=DB::table('pg_trans')
       ->where('order_id',$id)->first();
      // echo $id;
       //print_r($pg_data); exit;

       if ($logo!=null) {
       return view('gurdian.fee-receipt',compact('pg_data','receipt_status','month','logo','pay_mode','stu_reg_no','stu_name','InstitutionEmail','Institutionfax','Institutionphone','class','section','date','receipts','id','address'),['message'=>'Online Fee Collected Successfully.Please print Fee Receipt.']);
       }else{
         $logo=null;
       return view('gurdian.fee-receipt',compact('pg_data','receipt_status','logo','pay_mode','stu_reg_no','stu_name','InstitutionEmail','Institutionfax','class','section','Institutionphone','date','receipts','id','address'),['message'=>'Online Fee Collected Successfully.Please print Fee Receipt.']);
     }
   }

   public function feepadlist(){

   $feeslist = DB::table('fee_collection')
   ->join('tb_course', 'fee_collection.class', '=', 'tb_course.id')
   ->join('tb_batch', 'fee_collection.section', '=', 'tb_batch.id')
   ->where('fee_collection.branch_code',Auth::user()->school_id)
   ->where('fee_collection.stu_reg_no',session()->get('wardregno'))
   ->select(DB::raw('fee_collection.stu_reg_no,fee_collection.stu_name,fee_collection.fee_head,fee_collection.receipt_status, SUM(fee_collection.amt) as totamount,SUM(fee_collection.dueamt) as dueamt,SUM(fee_collection.discount) as discount,fee_collection.month,fee_collection.pay_mode,fee_collection.created_date,fee_collection.receipt_no'), 'tb_course.course_name', 'tb_batch.batch_name')
   ->groupBy('fee_collection.receipt_no')
   ->get();
return view('gurdian.feepaid-list',compact('feeslist'));
}

public function announcement(Request $request)
{
  $notification=DB::table('parent_announcement')
  ->where('register_no','=','no')
  ->orderby('id','desc')
  ->get();
  $msg=DB::table('parent_announcement')
  ->where('register_no','=',session()->get('wardregno'))
  ->orderby('id','desc')
  ->get();
  return view('gurdian.announcement',compact('notification','msg'));
}
public function attendancereport(){



  return view('gurdian.attendance-report');
}

public function exam_result(){
  $regNo= session()->get('wardregno');
  $exam=DB::table('tb_exam')->where('id','!=','12')->where('branch_code',Auth::user()->school_id)->get();
  $course=DB::table('stu_admission')
  ->join('tb_course','stu_admission.course','tb_course.id')
  ->select('stu_admission.course','tb_course.course_name')
  ->where('stu_admission.branch_code',Auth::user()->school_id)
  ->where('stu_admission.reg_no',$regNo)
  ->orderBy('stu_admission.course','desc')->get();
  //print_r($course);exit;
  $accadmicyear = DB::table('academicyear')
  ->where('branch_code',Auth::user()->school_id)->orderBy('startyear','desc')
  ->get();
  return view('gurdian.exam_result',compact('exam','course','accadmicyear'));
}


public function getexam_report_particular(Request $request){

  $exam_id=Input::get('exam_id');
  $course=Input::get('course');
  $accadmicyear=Input::get('accadmicyear');
  $regNo= session()->get('wardregno');
  $checkforResultRelease=DB::table('result_release')
  ->where('session',$accadmicyear)
  ->where('class',$course)
  ->where('exam',$exam_id)
  ->where('status',1)->count();

  if($checkforResultRelease > 0){
  $sql="SELECT a.*,b.subject_name,GROUP_CONCAT('',b.subject_name,' - ',a.marks ORDER BY b.subject_name ASC)
  AS marks_list FROM mark_register a
  INNER JOIN tb_subject b ON a.subject=b.id
  WHERE a.exam='$exam_id' and a.course='$course' and  a.academic_year='$accadmicyear'   AND register_no='$regNo'
  ORDER BY a.roll_no asc";
 // echo $sql;
  $data=DB::select($sql);

}else{
  $data=array();
}


  return view('gurdian.showExamReport',compact('data'));
}


public function show_att_report(Request $request)
{
    $accadmicyear=$request->accadmicyear;
    $date=$request->date;
  $attendance=DB::table('stu_attendance')
            ->where('stu_attendance.reg_no',session()->get('wardregno'))
            ->where('accadmicyear',$accadmicyear)
            ->where('att_date',$date)
            ->get();

            echo $attendance;
}

public function homework(Request $request)
{
  $data=DB::table('stu_admission')
         ->where('stu_admission.reg_no',session()->get('wardregno'))
         ->get();
         foreach($data as $d)
         {
           $c=$d->course;
           $b=$d->batch;
         }
         $homework=DB::table('homework')
         ->join('tb_course','homework.course','tb_course.id')
         ->join('tb_batch','homework.batch','tb_batch.id')
         ->join('tb_subject','homework.subject','tb_subject.id')
         ->Leftjoin('evaluate_homework', function ($join) {
              $join->on('homework.id', '=', 'evaluate_homework.homework_id')
                   ->where('evaluate_homework.student',session()->get('wardregno'));
          })
         ->select('homework.*','evaluate_homework.status','tb_subject.subject_name','tb_course.course_name','tb_batch.batch_name')
         ->where('homework.course',$c)
         ->where('homework.batch',$b)
         ->orderby('id','desc')
         ->get();
      //  echo"<pre>"; print_r($homework);exit;
  return view('gurdian.homework',compact('homework'));
}
function homeworkview(Request $request){
$id=$request->id;
$wardans=DB::table('evaluate_homework')->where('homework_id',$id)->where('student',session()->get('wardregno'))->get();
//print_r($wardans);exit;
if(count($wardans)<=0){
  echo "<span style='color:red;'>Answer Not Submitted Yet.<span>";
}else{
  return view('gurdian.homework-wardAnswer-view',compact('wardans'));
}
}

public function homeworklist(Request $request)
{
  $date=$request->date;

   $data=DB::table('stu_admission')
          ->where('stu_admission.reg_no',session()->get('wardregno'))
          ->get();
          foreach($data as $d)
          {
            $c=$d->course;
            $b=$d->batch;
          }
        $home=DB::table('homework')
        ->join('tb_course','homework.course','tb_course.id')
        ->join('tb_batch','homework.batch','tb_batch.id')
        ->select('homework.*','tb_course.course_name','tb_batch.batch_name')
        ->where('homework.course',$c)
        ->where('homework.batch',$b)
        ->where('homework.homework_date',$date)
        ->get();
        echo $home;

}

public function homework_report(Request $request)
{
   $data=DB::table('stu_admission')
          ->where('stu_admission.reg_no',session()->get('wardregno'))
          ->get();
          foreach($data as $d)
          {
            $c=$d->course;
            $b=$d->batch;
          }
   $report=DB::table('evaluate_homework')
    ->join('homework','evaluate_homework.homework','=','homework.id')
    ->join('tb_subject','homework.subject','=','tb_subject.id')
    ->join('stu_admission','evaluate_homework.student','=','stu_admission.reg_no')
    ->select('stu_admission.stu_name','homework.homework_date','homework.date_of_submission','tb_subject.subject_name','evaluate_homework.status','evaluate_homework.id')
    ->where('homework.course',$c)
    ->where('homework.batch',$b)
    ->where('evaluate_homework.student',session()->get('wardregno'))
    ->get();
    return view('gurdian.homework_report',compact('report'));
}

    public function assignment(Request $request)
    {
      return view('gurdian.assignment');
    }

    public function assignmentlist(Request $request)
    {
      $date=$request->date;

   $data=DB::table('stu_admission')
         ->where('stu_admission.reg_no',session()->get('wardregno'))

          ->get();
          foreach($data as $d)
          {
            $c=$d->course;
            $b=$d->batch;
          }
        $home=DB::table('assignment')
        ->join('tb_course','assignment.course','tb_course.id')
        ->join('tb_batch','assignment.batch','tb_batch.id')
        ->select('assignment.*','tb_course.course_name','tb_batch.batch_name')
        ->where('assignment.course',$c)
        ->where('assignment.batch',$b)
        ->where('assignment.assignment_date',$date)
        ->get();
        echo $home;
    }

    public function assignment_report(Request $request)
    {

   $data=DB::table('stu_admission')
           ->where('stu_admission.reg_no',session()->get('wardregno'))
          ->get();
          foreach($data as $d)
          {
             $c=$d->course;
             $b=$d->batch;
          }
   $report=DB::table('evaluate_assignment')
    ->join('assignment','evaluate_assignment.assignment','=','assignment.id')
    ->join('tb_subject','assignment.subject','=','tb_subject.id')
    ->join('stu_admission','evaluate_assignment.student','=','stu_admission.reg_no')
    ->select('stu_admission.stu_name','assignment.assignment_date','assignment.date_of_submission','tb_subject.subject_name','evaluate_assignment.status','evaluate_assignment.id')
    ->where('assignment.course',$c)
    ->where('assignment.batch',$b)
    ->where('evaluate_assignment.student',session()->get('wardregno'))
    ->get();
    return view('gurdian.assignment_report',compact('report'));
    }

    public function view_homework(Request $request)
    {
      echo $idd=$request->id;
      $data=DB::table('homework')
      ->join('tb_course','homework.course','=','tb_course.id')
      ->join('tb_batch','homework.batch','=','tb_batch.id')
      ->where('homework.branch_code',Auth::user()->school_id)
      ->where('homework.id',1)
      ->get();
      echo $data;
    }

    public function exam_hall_arrangement(Request $request)
    {
      $exam=DB::table('tb_exam')
      ->get();
      return view('gurdian.exam_hall_arrangement',compact('exam'));
    }

    public function view_exam_hall_arrangement(Request $request)
    {
      $reg_no=DB::table('stu_contact')
   ->where('stu_contact.father_phone',Auth::user()->username)
   ->get();
   foreach($reg_no as $r)
   {
    $r_no=$r->reg_no;
   }
    $r_no;
   $data=DB::table('stu_admission')
          ->where('stu_admission.reg_no',session()->get('wardregno'))
          ->get();
          foreach($data as $d)
          {
             $c=$d->course;
             $b=$d->batch;
          }

       $exam=$request->exam;
       $ex=DB::table('exam_schedule')
        ->join('tb_exam','exam_schedule.exam','=','tb_exam.id')
        ->join('tb_course','exam_schedule.course','=','tb_course.id')
        ->join('tb_batch','exam_schedule.batch','=','tb_batch.id')
        ->where('exam_schedule.branch_code',Auth::user()->school_id)
        ->where('exam_schedule.exam',$exam)
        ->where('exam_schedule.course',$c)
        ->where('exam_schedule.batch',$b)
        ->get();
       echo $ex;
    }

    public function daily_timetable(Request $request)
    {
       $data=DB::table('stu_admission')
          ->where('stu_admission.reg_no',session()->get('wardregno'))
          ->get();
          foreach($data as $d)
          {
             $c=$d->course;
             $b=$d->batch;
          }
          $prd=DB::table('tb_period')
          ->join('cls_time_table','tb_period.id','=','cls_time_table.period')
          ->groupBy('cls_time_table.period')

          ->where('cls_time_table.branch_code',Auth::user()->school_id)
          ->where('cls_time_table.batch','=',$b)
          ->where('cls_time_table.course','=',$c)
          ->get();

          $result=array();
          $rel=array();
          foreach($prd as $p)
          {
            // $t=DB::table('subject_allocation')
            // ->join('emp_details','subject_allocation.emp_id','=','emp_details.id')
            // ->where('subject_allocation.course','=',$cid)
            // ->where('subject_allocation.batch','=',$bid)
            // ->where('subject_allocation.branch_code',Auth::user()->school_id)
            // ->get();

            $subs=DB::table('cls_time_table')
            ->join('tb_subject','cls_time_table.subject','=','tb_subject.id')

           ->where('cls_time_table.branch_code',Auth::user()->school_id)
          ->where('cls_time_table.batch','=',$b)
          ->where('cls_time_table.course','=',$c)

          ->where('cls_time_table.period','=',$p->period)
          ->get();

          foreach($subs as $ss)
          {
            $teachers = DB::table('subject_allocation')
              ->join('emp_details','emp_details.id','=','subject_allocation.emp_id')
              ->where('subject','=',$ss->subject)
              ->where('course','=',$ss->course)
              ->where('batch','=',$ss->batch)
              ->get();
            $t_name="";
            foreach($teachers as $t)
            {
             $t_name= $t->fname ." "  .$t->mname ." " .$t->lname;
            }
            array_push($result,array('period'=>$ss->period,'subject_name'=>$ss->subject_name,'room'=>$ss->room_no,'day'=>$ss->day,'','t_name'=>$t_name));
          }
       }
       echo"<pre>";
       print_r($prd);
       exit;
       json_encode($result);

          return view('gurdian.timetable',compact('prd','result'));

    }

    public function lesson_plane(Request $request)
    {
      $data=DB::table('stu_admission')
         ->where('stu_admission.reg_no',session()->get('wardregno'))
         ->get();
         foreach($data as $d)
         {
             $c=$d->course;
             $b=$d->batch;
         }
  /*    $lesson=DB::table('tb_lession_planning')
      ->join('tb_lession_topic','tb_lession_planning.id','=','tb_lession_topic.tb_plan_id')

      ->where('tb_lession_planning.class','=',$c)
      ->where('tb_lession_planning.section','=',$b)
      ->where('tb_lession_planning.branch_code',Auth::user()->school_id)
      ->get();
*/
$accadmicyear=app_config('Session',Auth::user()->school_id);
$branchcode=Auth::user()->school_id;
$sql="SELECT a.id,a.class,a.section,a.subject_id,a.status,a.created_by,
      GROUP_CONCAT(CONCAT_WS('|',b.topic,b.objective,b.hours_class,b.from_date,b.to_date,b.t_status,b.teaching_methods)) AS topics,c.subject_name
      ,CONCAT_WS(' ',d.fname,d.mname,d.lname) AS teacher FROM tb_lession_planning a
      INNER JOIN tb_lession_topic b ON a.id=b.tb_plan_id
      INNER JOIN tb_subject c ON a.subject_id=c.id
      INNER JOIN emp_details d ON a.created_by=d.empcode
      WHERE a.class='$c' AND a.section='$b' AND a.session='$accadmicyear' AND a.branch_code='$branchcode'
      GROUP BY a.subject_id";
$lesson=DB::select($sql);
      return view('gurdian.lesson_planing',compact('lesson'));
    }

public function leaveapply(){

  $leavelist=DB::table('stu_leave_application')->where('reg_no',session()->get('wardregno'))
  ->where('acadmic_year',app_config('Session',Auth::user()->school_id))
  ->where('branch_code',Auth::user()->school_id)
  ->get();

  return view('gurdian.leave-application',compact('leavelist'));
}
public function applyleave(Request $request){
  $this->validate($request, [
    'todate'=>'required',
    'fromdate'=>'required',
    'reason'=>'required',
    ]);
   $todate=Input::get('todate');
   $fromdate=Input::get('fromdate');
   $reason=Input::get('reason');

   try{
   $savedata=DB::table('stu_leave_application')->insert(['reg_no'=>session()->get('wardregno'), 'fromdate' =>$fromdate,'todate'=>$todate,'reason'=>$reason,'acadmic_year'=>app_config('Session',Auth::user()->school_id),'branch_code'=>Auth::user()->school_id]);

   if(!empty($savedata)){
     return redirect('parents/ward/leave/apply')->with([
          'message' => 'Leave Applyed Successfully.'
      ]);
   }else{
     return redirect('parents/ward/leave/apply')->with([
          'message' => 'Unable to Apply Leave.Please Try Again.'
      ]);
   }

   }catch(\Illuminate\Database\QueryException $ex){
     return redirect('parents/ward/leave/apply')->with([
          'message' => 'Someting Went Worng Please Contact Technical Team : '.$ex->getMessage(). '',
          'message_important'=>true
      ]);

  }

}

public function viewleave($id){
  $viewleave=DB::table('stu_leave_application')->where('id',$id)->get();
  foreach ($viewleave as $viewleave) {
    $fromdate=$viewleave->fromdate;
    $todate=$viewleave->todate;
    $reason=$viewleave->reason;
  }
  return view('gurdian.view-leave',compact('fromdate','todate','reason'));
}
public function updateleave(Request $request){
  $this->validate($request, [
    'todate'=>'required',
    'fromdate'=>'required',
    'reason'=>'required',
    ]);
   $todate=Input::get('todate');
   $fromdate=Input::get('fromdate');
   $reason=Input::get('reason');

   try{
   $savedata=DB::table('stu_leave_application')->where('reg_no',session()->get('wardregno'))->update(['reg_no'=>session()->get('wardregno'), 'fromdate' =>$fromdate,'todate'=>$todate,'reason'=>$reason,'acadmic_year'=>app_config('Session',Auth::user()->school_id),'branch_code'=>Auth::user()->school_id]);

   if(!empty($savedata)){
     return redirect('parents/ward/leave/apply')->with([
          'message' => 'Leave Updated Successfully.'
      ]);
   }else{
     return redirect('parents/ward/leave/apply')->with([
          'message' => 'Unable to Apply Update.Please Try Again.'
      ]);
   }

   }catch(\Illuminate\Database\QueryException $ex){
     return redirect('parents/ward/leave/apply')->with([
          'message' => 'Someting Went Worng Please Contact Technical Team : '.$ex->getMessage(). '',
          'message_important'=>true
      ]);
  }
}

  public function feedback(){
  //  echo Auth::user()->username;
  $list=DB::table('feedback')->where('parent_no',Auth::user()->username)->where('branch_code',Auth::user()->school_id)->get();
    return view('gurdian.feedback',compact('list'));
  }
public function submitfeedback(Request $request){
  $this->validate($request, [
    'subject'=>'required',
    'reason'=>'required'
    ]);
   $subject=Input::get('subject');
   $reason=Input::get('reason');

   try{
   $savedata=DB::table('feedback')->insert(['subject'=>$subject, 'parent_no'=>Auth::user()->username,'name'=>Auth::user()->name,'msg'=>$reason,'branch_code'=>Auth::user()->school_id]);

   if(!empty($savedata)){
     return redirect('parents/ward/feedback')->with([
          'message' => 'Your Complaint/Feedback Submited Successfully.'
      ]);
   }else{
     return redirect('parents/ward/feedback')->with([
          'message' => 'Unable to Your Complaint/Feedback.Please Try Again.'
      ]);
   }

   }catch(\Illuminate\Database\QueryException $ex){
     return redirect('parents/ward/feedback')->with([
          'message' => 'Someting Went Worng Please Contact Technical Team : '.$ex->getMessage(). '',
          'message_important'=>true
      ]);
  }

}
public function viewfeedback($id){
$feeback=DB::table('feedback')->where('id',$id)->get();
  foreach ($feeback as $feeback) {
    // code...
    $subject=$feeback->subject;
    $msg=$feeback->msg;
    $created_at=$feeback->created_at;
    $status=$feeback->status;
    $id=$feeback->id;
  }
  $feedback_comments=DB::table('feedback_comments')->where('feedback_id',$id)->get();
  return view('gurdian.view-feedback',compact('id','subject','msg','created_at','status','feedback_comments'));
}
public function submitfeedbackcomments(Request $request){
  $this->validate($request, [
    'id'=>'required',
    'user'=>'required',
    'reason'=>'required'
    ]);
   $id=Input::get('id');
   $user=Input::get('user');
   $reason=Input::get('reason');

   try{
   $savedata=DB::table('feedback_comments')->insert(['feedback_id'=>$id, 'msg'=>$reason,'user'=>Auth::user()->name]);

   if(!empty($savedata)){
     return redirect('parents/ward/feedback/view/'.$id)->with([
          'message' => 'Your Complaint/Feedback Submited Successfully.'
      ]);
   }else{
     return redirect('parents/ward/feedback/view/'.$id)->with([
          'message' => 'Unable to Your Complaint/Feedback.Please Try Again.'
      ]);
   }

   }catch(\Illuminate\Database\QueryException $ex){
     return redirect('parents/ward/feedback/view/'.$id)->with([
          'message' => 'Someting Went Worng Please Contact Technical Team : '.$ex->getMessage(). '',
          'message_important'=>true
      ]);
  }
}

public function closefeedbackcomments($id){
  try{
  $savedata=DB::table('feedback')->where('id',$id)->update(['status'=>'1']);

  if(!empty($savedata)){
    return redirect('parents/ward/feedback')->with([
         'message' => 'Your Complaint/Feedback Ticket is closed Successfully.'
     ]);
  }else{
    return redirect('parents/ward/feedback')->with([
         'message' => 'Unable to close Complaint/Feedback Ticket.Please Try Again.'
     ]);
  }

  }catch(\Illuminate\Database\QueryException $ex){
    return redirect('parents/ward/feedback')->with([
         'message' => 'Someting Went Worng Please Contact Technical Team : '.$ex->getMessage(). '',
         'message_important'=>true
     ]);
 }
}



}
