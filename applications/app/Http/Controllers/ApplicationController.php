<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\AesCipher;
use Auth;
use Session;

class ApplicationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function instructions(){
      return view('application.instructions');
    }

    public function PaymentTab(){
      $pay_status=1;
      $stream="Commerce";
      return view('application.payment',compact('pay_status','stream'));
    }
    public function undertakingTab(Request $request){
      $stream= Session::get('selected_stream');    
      $where=array(
       "email" => Auth::user()->email,
       "course" => $stream,
       "mobile" => Auth::user()->mobile,
      );  
      $getwhere=array(
        "applications.email" => Auth::user()->email,
        "applications.stream" => $stream,
        "applications.s_phone_no" => Auth::user()->mobile,
       );      
      if (request()->isMethod('post')) { 

        $formData=DB::table('applications')
        ->leftJoin('application_documents',function($join){
          $join->on("applications.email","=","application_documents.email")
          ->on("applications.s_phone_no","=","application_documents.mobile")
          ->on("applications.course","=","application_documents.course");
        })->where($getwhere)->get();
     
      if($_FILES['photo_f']['name']!=""){
        $errors= array();
             $file_name = $_FILES['photo_f']['name'];
             $file_size =$_FILES['photo_f']['size'];
             $file_tmp =$_FILES['photo_f']['tmp_name'];
             $file_type=$_FILES['photo_f']['type'];
            // $file_ext=strtolower(end(explode('.',$_FILES['file']['name'])));
            $tmp = explode('.', $file_name);
            $file_ext = end($tmp);
             if($file_size > 2097152){
                    $errors[]='File size must be excately 2 MB';
             }
          if(empty($errors)==true){
             move_uploaded_file($file_tmp,"assets/admission/".$file_name);
            $filepath="assets/admission/".$file_name;
          }else{
                  /*  return redirect('admission-form')->with([
                            'message' => 'Unable to upload File.Please try again',
                            'message_important'=>true
                    ]);*/
          }

    }else{
        $filepath=isset($formData[0]->photo_f) ? $formData[0]->photo_f : "";
    }

    if($_FILES['photo_m']['name'] != ""){
        $errors= array();
             $photo_m_name = $_FILES['photo_m']['name'];
             $photo_m_size =$_FILES['photo_m']['size'];
             $photo_m_tmp =$_FILES['photo_m']['tmp_name'];
             $photo_m_type=$_FILES['photo_m']['type'];
            // $file_ext=strtolower(end(explode('.',$_FILES['file']['name'])));
            $tmp = explode('.', $photo_m_name);
            $file_ext = end($tmp);
             if($file_size > 2097152){
                    $errors[]='File size must be excately 2 MB';
             }
             if(empty($errors)==true){
             move_uploaded_file($photo_m_tmp,"assets/admission/".$photo_m_name);
            $photo_m_path="assets/admission/".$photo_m_name;
          }else{
                    return redirect('admission-form')->with([
                            'message' => 'Unable to upload File.Please try again',
                            'message_important'=>true
                    ]);
          }

    }else{
        $photo_m_path=isset($formData[0]->photo_m) ? $formData[0]->photo_m : "";
    }
    if($_FILES['sign_a']['name'] != ""){
        $errors= array();
             $sign_a_name = $_FILES['sign_a']['name'];
             $sign_a_size =$_FILES['sign_a']['size'];
             $sign_a_tmp =$_FILES['sign_a']['tmp_name'];
             $sign_a_type=$_FILES['sign_a']['type'];
            // $file_ext=strtolower(end(explode('.',$_FILES['file']['name'])));
            $tmp = explode('.', $sign_a_name);
            $file_ext = end($tmp);
             if($file_size > 2097152){
                    $errors[]='File size must be excately 2 MB';
             }
             if(empty($errors)==true){
             move_uploaded_file($sign_a_tmp,"assets/admission/".$sign_a_name);
            $sign_a_path="assets/admission/".$sign_a_name;
          }else{
                    return redirect('admission-form')->with([
                            'message' => 'Unable to upload File.Please try again',
                            'message_important'=>true
                    ]);
          }

    }else{
        $sign_a_path=isset($formData[0]->sign_a) ? $formData[0]->sign_a : "";
    }
    if($_FILES['sign_p']['name'] != ""){
        $errors= array();
             $sign_p_name = $_FILES['sign_p']['name'];
             $sign_p_size =$_FILES['sign_p']['size'];
             $sign_p_tmp =$_FILES['sign_p']['tmp_name'];
             $sign_p_type=$_FILES['sign_p']['type'];
            // $file_ext=strtolower(end(explode('.',$_FILES['file']['name'])));
            $tmp = explode('.', $sign_p_name);
            $file_ext = end($tmp);
             if($file_size > 2097152){
                    $errors[]='File size must be excately 2 MB';
             }
             if(empty($errors)==true){
             move_uploaded_file($sign_p_tmp,"assets/admission/".$sign_p_name);
            $sign_p_path="assets/admission/".$sign_p_name;
          }else{
                    return redirect('admission-form')->with([
                            'message' => 'Unable to upload File.Please try again',
                            'message_important'=>true
                    ]);
          }

      }else{
          $sign_p_path=isset($formData[0]->sign_p) ? $formData[0]->sign_p : "";
      }

      $updateArray=array(
          "photo_f"=>$filepath,
               "photo_m"=>$photo_m_path,
               "sign_a"=>$sign_a_path,
               "sign_p"=>$sign_p_path,

      ); //echo "<pre>";print_r($updateArray);exit;
      DB::table('application_documents')->where($where)->update($updateArray);
     
    }
    if (request()->isMethod('get')) { 
      $formData=DB::table('applications')
        ->leftJoin('application_documents',function($join){
          $join->on("applications.email","=","application_documents.email")
          ->on("applications.s_phone_no","=","application_documents.mobile")
          ->on("applications.course","=","application_documents.course");
        })->where($getwhere)->get();
    }

      return view('application.undertakingStep',compact('formData'));
    }
    public function photoTab(Request $request){

      $stream= Session::get('selected_stream');    
      $where=array(
       "email" => Auth::user()->email,
       "course" => $stream,
       "mobile" => Auth::user()->mobile,
      ); 
      $getwhere=array(
        "applications.email" => Auth::user()->email,
        "applications.stream" => $stream,
        "applications.s_phone_no" => Auth::user()->mobile,
       ); 
      if (request()->isMethod('post')) {  

        $cast_doc_path= $cast_doc=$request->c_path;
        $dob_doc_path=  $dob_doc=$request->dob_path;
      
    if(isset($_FILES['cast_certi'])){
     $errors= array();
     $file_name_s = $_FILES['cast_certi']['name'];
    // echo $file_name_s;exit;
     $file_size_s  =$_FILES['cast_certi']['size'];
     $file_tmp_s  =$_FILES['cast_certi']['tmp_name'];
     $file_tmp_sp  =$_FILES['cast_certi']['tmp_name'];
     $file_type_s =$_FILES['cast_certi']['type'];
     $tmp_s = explode('.', $file_name_s);
     $file_ext_s = end($tmp_s);
   //  $file_ext=strtolower(end(explode('.',$_FILES['file']['name'])));
     
     $extensions= array("jpeg","jpg","png","pdf");
   
     if(in_array($file_ext_s,$extensions)=== false){
        $errors[]="extension not allowed, please choose a JPEG or PNG OR PDF file.";
     }
     
     if($file_size_s  > 2097152){
        $errors[]='File size must be excately 2 MB';
     }
   
     if(empty($errors)==true){
      if(move_uploaded_file($file_tmp_s,"assets/application/photo/".$file_name_s)){
        move_uploaded_file($file_tmp_sp,"application/assets/application/photo/".$file_name_s);
        $cast_doc_path= "assets/application/photo/".$file_name_s;
      }else{
        echo "unable to upload Photo.Please try again.";
      }
     }
    }else{
      $cast_doc_path= $cast_doc;
    }

    if(isset($_FILES['dob_doc'])){
      $errors= array();
      $file_name_s = $_FILES['dob_doc']['name'];
     // echo $file_name_s;exit;
      $file_size_s  =$_FILES['dob_doc']['size'];
      $file_tmp_s  =$_FILES['dob_doc']['tmp_name'];
      $file_tmp_sp  =$_FILES['dob_doc']['tmp_name'];
      $file_type_s =$_FILES['dob_doc']['type'];
      $tmp_s = explode('.', $file_name_s);
      $file_ext_s = end($tmp_s);
    //  $file_ext=strtolower(end(explode('.',$_FILES['file']['name'])));
      
      $extensions= array("jpeg","jpg","png","pdf");
    
      if(in_array($file_ext_s,$extensions)=== false){
         $errors[]="extension not allowed, please choose a JPEG or PNG OR PDF file.";
      }
      
      if($file_size_s  > 2097152){
         $errors[]='File size must be excately 2 MB';
      }
    
      if(empty($errors)==true){
       if(move_uploaded_file($file_tmp_s,"assets/application/photo/".$file_name_s)){
         move_uploaded_file($file_tmp_sp,"application/assets/application/photo/".$file_name_s);
         $dob_doc_path= "assets/application/photo/".$file_name_s;
       }else{
         echo "unable to upload Photo.Please try again.";
       }
      }
     }else{
       $dob_doc_path= $dob_doc;
     }



        $cnt=DB::table('application_documents')->where($where)->count();
        if($cnt==0){
          $saverecord=array(
            "email" => Auth::user()->email,
           "course" => $stream,
           "mobile" => Auth::user()->mobile,
           "cast_doc"=>$cast_doc_path,
           "dob_doc"=>$dob_doc_path,
          );
          DB::table('application_documents')->insert($saverecord);
        }else{
          $updaterecord=array(
            "cast_doc"=>$cast_doc_path,
            "dob_doc"=>$dob_doc_path,
          );

          DB::table('application_documents')->where($where)->update($updaterecord);
        }

        $formData=DB::table('applications')
        ->leftJoin('application_documents',function($join){
          $join->on("applications.email","=","application_documents.email")
          ->on("applications.s_phone_no","=","application_documents.mobile")
          ->on("applications.course","=","application_documents.course");
        })->where($getwhere)->get();
      }

      if (request()->isMethod('get')) { 
        $formData=DB::table('applications')
        ->leftJoin('application_documents',function($join){
          $join->on("applications.email","=","application_documents.email")
          ->on("applications.s_phone_no","=","application_documents.mobile")
          ->on("applications.course","=","application_documents.course");
        })->where($getwhere)->get();

      }
      return view('application.photoStep',compact('formData'));
    }

    public function subjectTab(){
      $subjects=array();
      $stream="Commerce";
      return view('application.subjectStep',compact('subjects','stream'));
    }

    public function documentTab(Request $request){ 

      $stream= Session::get('selected_stream');    
      $where=array(
       "email" => Auth::user()->email,
       "stream" => $stream,
       "s_phone_no" => Auth::user()->mobile,
      );       
      if (request()->isMethod('post')) {  
        $updaterecord=array(
          "present_address"=>$request->present_address,
          "po"=>$request->po,
          "ps"=>$request->ps,
          "district"=>$request->district,
          "state"=>$request->state,
          "pin"=>$request->pin,
          "permanent_address"=>$request->permanent_address,
          "p_po"=>$request->p_po,
          "p_ps"=>$request->p_ps,
          "p_district"=>$request->p_district,
          "p_state"=>$request->p_state,
          "p_pin"=>$request->p_pin,
        );
          DB::table('applications')->where($where)->update($updaterecord);
          
          $getwhere=array(
            "applications.email" => Auth::user()->email,
            "applications.stream" => $stream,
            "applications.s_phone_no" => Auth::user()->mobile,
           ); 

          $formData=DB::table('applications')->leftJoin('application_documents',function($join){
            $join->on("applications.email","=","application_documents.email")
            ->on("applications.s_phone_no","=","application_documents.mobile")
            ->on("applications.course","=","application_documents.course");
          })->where($getwhere)->get();
         //  echo "<pre>";  print_r($formData);exit;

         }
         if (request()->isMethod('get')) {  
          $getwhere=array(
            "applications.email" => Auth::user()->email,
            "applications.stream" => $stream,
            "applications.s_phone_no" => Auth::user()->mobile,
           ); 
          $formData=DB::table('applications')->leftJoin('application_documents',function($join){
            $join->on("applications.email","=","application_documents.email")
            ->on("applications.s_phone_no","=","application_documents.mobile")
            ->on("applications.course","=","application_documents.course");
          })->where($getwhere)->get();
         }

      return view('application.documentStep',compact('formData'));
    }

    public function qualificationTab(){
      return view('application.qualificationStep');
    }

    public function addressTab(Request $request){
      if (request()->isMethod('post')) {  
     $stream= Session::get('selected_stream');    
     $where=array(
      "email" => Auth::user()->email,
      "stream" => $stream,
      "s_phone_no" => Auth::user()->mobile,
     );

     $updaterecord=array(
       "f_name"=>$request->f_name,
       "m_name"=>$request->m_name,
       "p_phone"=>$request->p_phone,
       "f_email"=>$request->f_email,
       "f_qualification"=>$request->f_qualification,
       "f_speak"=>$request->f_speak,
       "occupation"=>$request->occupation,
       "s_parent"=>$request->s_parent,
     );
       DB::table('applications')->where($where)->update($updaterecord);    
       $formData=DB::table('applications')->where($where)->get();
      }
      if (request()->isMethod('get')) {  
        $formData=DB::table('applications')->where($where)->get();
      }     
      return view('application.addressStep',compact('formData'));
    }


    public function selectCourse(){      
      return view('application.selectCourse');
    }


    public function parentsTab(Request $request){ 
      $stream= Session::get('selected_stream');    
    if (request()->isMethod('post')) {   
    $where=array(
       "email" => Auth::user()->email,
       "stream" => $stream,
       "s_phone_no" => Auth::user()->mobile,
    );

    $check=DB::table('applications')->where($where)->count();
    if($check==0){
    $saverecord=array(
      "name" => $request->name,
      "stream" => $request->stream,
      "course" => $request->stream,
      "year" => app_config('Session'),
      "gender" => $request->gender,
      "cast" => $request->cast,
      "subcast" => $request->subcast,
      "religion" => $request->religion,
      "birth_place"=>$request->birthpalce,
      "denomination" => $request->denomination,
      "handicap" => $request->handicap,
      "dob" => $request->dob,
      "email" => Auth::user()->email,
      "s_phone_no" => Auth::user()->mobile,
    );
   $record_id=DB::table('applications')->insertGetId($saverecord);
   $formData=DB::table('applications')->where($where)->get();
   Session::put('record_id', $record_id);
  }else{
    $updaterecord=array(
      "name" => $request->name,
      "stream" => $request->stream,
      "course" => $request->stream,
      "year" => app_config('Session'),
      "gender" => $request->gender,
      "cast" => $request->cast,
      "subcast" => $request->subcast,
      "religion" => $request->religion,
      "birth_place"=>$request->birthpalce,
      "denomination" => $request->denomination,
      "handicap" => $request->handicap,
     // "dob" => $request->dob,    
    );
  // echo "<pre>"; print_r($where); print_r($updaterecord);exit;
 // DB::enableQueryLog();
    DB::table('applications')->where($where)->update($updaterecord);// and then you can get query log

  //  dd(DB::getQueryLog());exit;
    $formData=DB::table('applications')->where($where)->get();


    $record_id=$formData[0]->id;
    Session::put('record_id', $record_id);
  }
   if($record_id){
    return view('application.step2',compact('formData'));
   }else{
    return redirect('/home')->with([
      'message' =>"Something went worng.Please try again."
       ]);
   }
  //  print_r($saverecord);exit;
    //DB::table('a')


}
 
if (request()->isMethod('get')) {
  $where=array(
    "email" => Auth::user()->email,
    "stream" => $request->stream,
    "s_phone_no" => Auth::user()->mobile,
 );
    $formData=DB::table('applications')->where('id',Session::get('record_id'))->get();
}

      return view('application.step2',compact('formData'));
    }
    public function downloadForm($id,$email){
     ini_set('max_execution_time', '0');
       $formData=DB::table('applications')
       ->join('application_subjects','applications.id','application_subjects.app_id')
       ->where('applications.id',$id)->where('applications.email',Crypt::decrypt($email))->get();
    
      $formDoc=DB::table('application_documents')
      ->where('mobile',Auth::user()->mobile)
      ->where('course',$formData[0]->stream)
      ->where('email',Crypt::decrypt($email))->get();
       $pay_info=DB::table('sab_paisa_pg_trans')
       ->where('order_id',$formData[0]->receipt_id)
       ->where('course',$formData[0]->course)
       ->where('mobileNo',Auth::user()->mobile)->where('email',Auth::user()->email)->get();
    //   echo "<pre>"; print_r( $formDoc);exit; 
    //  echo "<pre>"; print_r($form_date);
		
     // echo "<pre>"; print_r($pay_info);exit;
  $subjects=array();
  return view('application.downloadForm',compact('formData','formDoc','pay_info','subjects'));
 
     //  $pdf = PDF::loadView('application.downloadForm',compact('form_date','pay_info'));
     //          return $pdf->download('medium.pdf');
     // return view('application.downloadForm');
    }

    public function paymentRequest(Request $request){
    /* echo Session::get('record_id');
    echo "<br>". $merchant_data=app_config('pg_merchant_id','2');
    echo "<br>". $working_key=app_config('pg_working_key','2');
    echo "<br>".$access_code=app_config('pg_access_code','2'); */

      $data=DB::table('applications')->where('id',Session::get('record_id'))->get();

        print_r($data);

        foreach($data as $key=>$value){

        }
  
    }
    function onlinepay(Request $request){
      $id=Session::get('record_id');
      $data=DB::table('applications')->where('id',$id)->get();
      $paydata=array(
        "name"=>$data[0]->name,
        "stu_phone"=>$data[0]->p_phone,
        "billing_address"=>"Seventh Day Adventist School,Bariyatu Road,Ranchi",
        "city"=>"Ranchi",
        "country"=>"India",
        "pin"=>"834009",
        "state"=>"Jharkhand",
        "father_phone"=>$data[0]->p_phone,
        "email"=>$data[0]->email,
        "transactionId"=>$data[0]->id,
        "amt"=>"500"
      );
    //  print_r($paydata); exit; 
    //  return view('application.selectCourse');
      return view('application.paymentGatway',compact('paydata'));

    }
    function payredirect(Request $request){
      $merchant_data=app_config('pg_merchant_id','2');
    $working_key=app_config('pg_working_key','2');
    $access_code=app_config('pg_access_code','2');
        //  exit;
    foreach ($_POST as $key => $value){
      $merchant_data.=$key.'='.$value.'&';
    }
   echo "<pre>"; print_r($merchant_data); exit;
    $encrypted_data=encrypts($merchant_data,$working_key);
 //print_r($encrypted_data); exit;
    return view('application.pg-redirect',compact('encrypted_data','access_code'));
 
      }

      public function paymentResponse(Request $request){
        echo "work";exit;
      }
      function getpaymentgatwayresponse(Request $request){ //exit;
         echo "Work";exit;
         $workingKey=app_config('pg_working_key','2');	//Working Key should be provided here.
         $encResponse=$_POST["encResp"];

        // print_r($encResponse);exit;
         //This is the response sent by the CCAvenue Server
         $rcvdString=decrypts($encResponse,$workingKey);	//Crypto Decryption used as per the specified working key.
         $order_status="";
         $decryptValues=explode('&', $rcvdString);
         $dataSize=sizeof($decryptValues);
         for($i = 0; $i < $dataSize; $i++)
         {
             $information=explode('=',$decryptValues[$i]);
             if($i==3)	$order_status=$information[1];
         }
            // print_r( $information);exit;
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

 $request->session()->forget('onlinepay_data');
 //exit;
/*if($amount !="500"){
  return redirect('payonline/fail/'.base64_encode($order_id))->with([
    'message' => 'Sorry Someting went Worng..',
    'message_important'=>true
 ]);
} */
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

 //echo $status;exit;
  print_r($pg_data);exit;
  //DB::table('pg_trans_log')->where('order_id',$order_id)->update(['trans_status'=>'completed']);
        if($status=="Success"){
           // echo $status;exit;
          $savedata=DB::table('pg_trans_admission')->insert($pg_data);
          if(!empty($savedata)){

            DB::table('online_application')
            ->where('id', $order_id)
            ->update(['pay_status' => "1"]);

              return redirect('applications/home/')->with([
                  'message' => 'Online Fee Collected Successfully.Please print Fee Receipt.'
              ]);
          }else{
            DB::table('online_application')
            ->where('id', $order_id)
            ->update(['pay_status' => "1"]);

            DB::table('pg_trans_admission')
            ->where('order_id', $order_id)
            ->update(['remark' => "Data not inserted in admission table."]);

              return redirect('payonline/receipt/'.base64_encode($order_id))->with([
                  'message' => 'Online Fee Collected Successfully.Please print Fee Receipt.'
              ]);
          }

        }else{
          $savedata=DB::table('pg_trans_admission')->insert($pg_data);
          return redirect('payonline/fail/'.base64_encode($order_id))->with([
              'message' => 'Sorry Someting went Worng.'
          ]);

        }

     }


  public function fileUpload(Request $request){
    $coursename=$request->course;
    $c_path=$request->c_path;
    $s_path=$request->s_path;
    $photo_path=$request->photo_path;
   
    if(isset($_FILES['signature'])){
     $errors= array();
     $file_name_s = $_FILES['photo']['name'];
    // echo $file_name_s;exit;
     $file_size_s  =$_FILES['photo']['size'];
     $file_tmp_s  =$_FILES['photo']['tmp_name'];
     $file_tmp_sp  =$_FILES['photo']['tmp_name'];
     $file_type_s =$_FILES['photo']['type'];
     $tmp_s = explode('.', $file_name_s);
     $file_ext_s = end($tmp_s);
   //  $file_ext=strtolower(end(explode('.',$_FILES['file']['name'])));
     
     $extensions= array("jpeg","jpg","png");
   
     if(in_array($file_ext_s,$extensions)=== false){
        $errors[]="extension not allowed, please choose a JPEG or PNG file.";
     }
     
     if($file_size_s  > 2097152){
        $errors[]='File size must be excately 2 MB';
     }
   
     if(empty($errors)==true){
      if(move_uploaded_file($file_tmp_s,"assets/application/photo/".$file_name_s)){
        move_uploaded_file($file_tmp_sp,"application/assets/application/photo/".$file_name_s);
        $photoPath= "assets/application/photo/".$file_name_s;
      }else{
        echo "unable to upload Photo.Please try again.";
      }
     }
    }else{
      $photoPath= $photo_path;
    }

   if(isset($_FILES['signature'])){
     $file_name_s = $_FILES['signature']['name'];
     $file_size_s  =$_FILES['signature']['size'];
     $file_tmp_s  =$_FILES['signature']['tmp_name'];
     $file_tmp_sp  =$_FILES['signature']['tmp_name'];
     $file_type_s =$_FILES['signature']['type'];
     $tmp_s = explode('.', $file_name_s);
     $file_ext_s = end($tmp_s);
   //  $file_ext=strtolower(end(explode('.',$_FILES['file']['name'])));
     
     $extensions= array("jpeg","jpg","png");
   
     if(in_array($file_ext_s,$extensions)=== false){
        $errors[]="extension not allowed, please choose a JPEG or PNG file.";
     }
     
     if($file_size_s  > 2097152){
        $errors[]='File size must be excately 2 MB';
     }
   
     if(empty($errors)==true){
      if(move_uploaded_file($file_tmp_s,"assets/application/sign/".$file_name_s)){
        move_uploaded_file($file_tmp_sp,"application/assets/application/sign/".$file_name_s);
        $signaturePath= "assets/application/sign/".$file_name_s;
      }else{
        echo "unable to upload Photo.Please try again.";
      }
     }
    }else{
      $signaturePath=$s_path;
    }
     if(isset($_FILES['cast_certi'])){
      $file_name_d = $_FILES['cast_certi']['name'];    
      $file_size_d  =$_FILES['cast_certi']['size'];
      $file_tmp_d  =$_FILES['cast_certi']['tmp_name'];
      $file_tmp_dp  =$_FILES['cast_certi']['tmp_name'];
      $file_type_d =$_FILES['cast_certi']['type'];
      $tmp_d = explode('.', $file_name_d);
      $file_ext_d = end($tmp_d);
    //  $file_ext=strtolower(end(explode('.',$_FILES['file']['name'])));
      
      $extensions= array("pdf");
    
      if(in_array($file_ext_d,$extensions)=== false){
         $errors[]="extension not allowed, please choose PDF file.";
      }
      
      if($file_size_d  > 2097152){
         $errors[]='File size must be excately 2 MB';
      }
    
      if(empty($errors)==true){
       if(move_uploaded_file($file_tmp_d,"assets/application/doc/".$file_name_d)){
         move_uploaded_file($file_tmp_dp,"application/assets/application/doc/".$file_name_d);
         $docsPath= "assets/application/doc/".$file_name_d;
       }else{
         echo "unable to upload Photo.Please try again.";
       }
      }else{
        print_r($errors);
        exit;
      }
    }else{
      $docsPath=$c_path;
    }
   
   $saveDocs=array(
      "email"=>Auth::user()->email,
      "mobile"=>Auth::user()->mobile,
      "course"=>$coursename,
      "photo"=>$photoPath,
      "signature"=>$signaturePath,
      "cast_doc"=>$docsPath,
    );
    $where=array(
      "email"=>Auth::user()->email,
      "mobile"=>Auth::user()->mobile,
      "course"=>$coursename,
    );
    $updateArray=array(
      "photo"=>$photoPath,
      "signature"=>$signaturePath,
      "cast_doc"=>$docsPath,
    );
      $cnt=DB::table('application_documents')->where($where)->count();     
       DB::table('users')->where("email",Auth::user()->email)
    ->where("mobile",Auth::user()->mobile)
    ->update(['profile_img'=>$photoPath]);
      if($cnt==0){
        DB::table('application_documents')->insert($saveDocs);
        echo "Documents Saved Succesfully";
      }else{
        DB::table('application_documents')->where($where)->update($updateArray);
        echo "Documents updated Succesfully";
      }

     exit;
  }

      public function save(Request $request){
           $eid = $request->data;
           $data=json_decode($eid);
          // print_r($data);
           $subjects=json_decode($request->subjects);
           unset($data->sub_type);
           unset($data->subject);
           $where=array(
             "s_phone_no"=>$data->s_phone_no,
             "email"=>$data->email,
             "stream"=>$data->stream,
           );
           //print_r($where);
          $cnt=DB::table('applications')->where($where)->get();
         // print(  $cnt);exit;
          if(count($cnt)==0){
          $saveid=DB::table('applications')->insertGetId((array) $data);
          $receipt_id="Intermediate/2021-23/000".$saveid;
          DB::table('applications')->where('id',$saveid)->update(['receipt_id'=>$receipt_id]);
          DB::table('applications')->where('id',$saveid)->update(['form_id'=>$receipt_id]);
          $request->session()->put('receipt_id', $receipt_id);
         }else{
           $update=DB::table('applications')->where($where)->update((array) $data);
           $saveid=$cnt[0]->id;
           $receipt_id="Intermediate/2021-23/000".$saveid;
           DB::table('applications')->where('id',$saveid)->update(['receipt_id'=>$receipt_id]);
           $request->session()->put('receipt_id', $receipt_id);
         }

         $deletewhere=array(
           "app_id"=>$saveid,
           "user_mobile"=>$data->s_phone_no,
           "user_email"=>$data->email,
         );
         DB::table('application_subjects')->where($deletewhere)->delete();
         for($i=0;$i<count($subjects);$i++){
          $subs=array(
              "app_id"=>$saveid,
              "user_mobile"=>$data->s_phone_no,
              "user_email"=>$data->email,
              "sub_type"=>$subjects[$i]->sub_type,
              "sub_name"=>$subjects[$i]->subject,
            );

            DB::table('application_subjects')->insert($subs);

         }
        if($saveid){
          echo $saveid;
        }else{
          echo 0;
        }
    }

    public function index(Request $request)
    {     
     
      if (request()->isMethod('get')) {   
        $stream= Session::get('selected_stream');        
      }else{
        $stream=$request->stream;     
        $request->session()->put('selected_stream', $stream);
      }
      if ($request->session()->exists('selected_stream')) {
       
      }else{
         echo "not";
       }
    
      $formData=DB::table('applications')->where('stream',$stream)->where('email',Auth::user()->email)->where('s_phone_no',Auth::user()->mobile)->limit(1)->get();
      $docs=DB::table('application_documents')->where('course',$stream)->where('email',Auth::user()->email)->where('mobile',Auth::user()->mobile)->get();

      if(count($formData) > 0){
        $submitted=$formData[0]->submit_status;
      }else{
        $submitted=0;
      }
      if(count($formData) > 0){
        $pay_status=$formData[0]->pay_status;
      }else{
        $pay_status=0;
      } 
 //   echo "<pre>";  print_r($formData);exit;
    //  echo $submitted;exit;
  //    print_r(count($subjects));exit;
      return view('application.application',compact('formData','docs','stream','submitted','pay_status'));
    }
}
