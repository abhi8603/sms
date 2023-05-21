<?php

namespace App\Http\Controllers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use Session;
use Illuminate\Support\Facades\Crypt;
use App\Http\Requests;
use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use App\permission;
use App\sendSMS;
use App\EmployeeRolesPermission;
use App\EmployeeRoles;
use PDF;
date_default_timezone_set('Asia/Kolkata');
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      //  $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
	
 	function admissionFormList(){
          $receipt=DB::table('online_application')
          ->join('pg_trans_admission','online_application.id','pg_trans_admission.order_id')
          ->orderBy('online_application.id','desc')
          ->get();
          return view('online_form.admission_form_list',compact('receipt'));
      }
	
     function onlinepay(Request $request,$id){
       $id=Crypt::decrypt($id);
       $data=DB::table('online_application')->where('id',$id)->where('pay_status','0')->get();
       $paydata=array(
         "name"=>$data[0]->stu_name,
         "stu_phone"=>$data[0]->f_mobile,
         "billing_address"=>"Seventh Day Adventist School,Bariyatu Road,Ranchi",
         "city"=>"Ranchi",
         "country"=>"India",
         "pin"=>"834009",
         "state"=>"Jharkhand",
         "father_phone"=>$data[0]->f_mobile,
         "email"=>$data[0]->email,
         "transactionId"=>$data[0]->id,
         "amt"=>$data[0]->amt
       );
      // print_r($paydata); exit; 

       return view('online_form.paymentGatway',compact('paydata'));

     }
     function payredirect(){
     $merchant_data=app_config('pg_merchant_id','2');
 	$working_key=app_config('pg_working_key','2');
 	$access_code=app_config('pg_access_code','2');
       //  exit;
 	foreach ($_POST as $key => $value){
 		$merchant_data.=$key.'='.$value.'&';
 	}
 	$encrypted_data=encrypts($merchant_data,$working_key);
//print_r($encrypted_data);
   return view('online_form.pg-redirect',compact('encrypted_data','access_code'));

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
     function getpaymentgatwayresponse(Request $request){ //exit;
        // echo "Work";exit;
         $workingKey=app_config('pg_working_key','2');	//Working Key should be provided here.
         $encResponse=$_POST["encResp"];

        // print_r($encResponse);exit;
         //This is the response sent by the CCAvenue Server
         $rcvdString=decrypts($encResponse,$workingKey);	print_r($rcvdString);	//Crypto Decryption used as per the specified working key.
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

 if(session('onlinepay_data.order_id')==$order_id && (double)session('onlinepay_data.amt')==(double)$amount){
     //echo"<br>order.id". $order_id."|".(double)$amount;exit;
     $cntrow= DB::table('pg_trans_admission')->where('order_id',$order_id)->count();
   //  echo "<br>cnt : ". $cntrow;exit;
     if($cntrow != 0){
        return redirect('payonline/fail/'.base64_encode($order_id))->with([
            'message' => 'Sorry Someting went Worng.',
            'message_important'=>true
        ]);
      }
 }else{
  return redirect('payonline/fail/'.base64_encode($order_id))->with([
    'message' => 'Sorry Someting went Worng..',
    'message_important'=>true
 ]);
 }
 $request->session()->forget('onlinepay_data');
 //exit;
if($amount !="30550"){
  return redirect('payonline/fail/'.base64_encode($order_id))->with([
    'message' => 'Sorry Someting went Worng..',
    'message_important'=>true
 ]);
}
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

  //DB::table('pg_trans_log')->where('order_id',$order_id)->update(['trans_status'=>'completed']);
        if($status=="Success"){
           // echo $status;exit;
          $savedata=DB::table('pg_trans_admission')->insert($pg_data);
          if(!empty($savedata)){

            DB::table('online_application')
            ->where('id', $order_id)
            ->update(['pay_status' => "1"]);

              return redirect('payonline/receipt/'.base64_encode($order_id))->with([
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

     function newAdmission(){
      return view('online_form.new_admission');
     }
     public function Receiptdownload(Request $request){ 
       return view('online_form.receiptdownload');
     }

     function ReceiptdownloadView(Request $request){
      $email=Input::get('email');
      $mobile=Input::get('mobile');
      $dob=date_format(date_create(Input::get('dob')),'m/d/Y');
       $where=array(
         "dob"=>$dob,
         "f_phone"=>$mobile,
         "email"=>$email,
       );
    
     $record=DB::table('online_application')->where($where)->get();

     if(count($record) > 0){
        return redirect('payonline/receipt/'.base64_encode($record[0]->id));
       }else{
         return redirect('online/receipt/download')->with([
           'message' => 'Record Not Found.Please try again !',
           'message_important'=>true
         ]);
       }
     }

     function viewreceipt($id){
         $id=base64_decode($id);
         $receipt=DB::table('online_application')
         ->join('pg_trans_admission','online_application.id','pg_trans_admission.order_id')
         ->where('online_application.id',$id)
         ->where('pg_trans_admission.order_id',$id)
         ->get();
         return view('online_form.admission_recepit',compact('receipt'));

     }
     function paymentfailure($id){
         $id=base64_decode($id);
         $receipt=DB::table('online_application')
         ->join('pg_trans_admission','online_application.id','pg_trans_admission.order_id')
         ->where('online_application.id',$id)
         ->where('pg_trans_admission.order_id',$id)
         ->get();
         return view('online_form.admission_recepit',compact('receipt'));

     }





     function submitfrom(Request $request){
           $this->validate($request, [
               'class'=>'required',
               'sign_a'=>'required|mimes:jpeg,jpg,png|max:10000',
               'sign_p'=>'required|mimes:jpeg,jpg,png|max:10000',
               'stu_name'=>'required',
               'dob'=>'required',
               'f_mobile'=>'required',
              // 'tns'=>'required'
           ],[
               'class.required' => 'Please Select class.',
               'sign_a.required' => 'Please select valid Student image.',
               'sign_p.required' => 'Please select valid Student Signature.',
               'f_mobile.required' => 'Please enter valid Father Mobile no.',
               'email.required' => 'Please enter valid Email address.'
           ]);

           if(isset($_FILES['dob_c'])){
            $errors= array();
                 $file_name = $_FILES['dob_c']['name'];
                 $file_size =$_FILES['dob_c']['size'];
                 $file_tmp =$_FILES['dob_c']['tmp_name'];
                 $file_type=$_FILES['dob_c']['type'];
                // $file_ext=strtolower(end(explode('.',$_FILES['file']['name'])));
                $tmp = explode('.', $file_name);
                $file_ext = end($tmp);
                 if($file_size > 2097152){
                        $errors[]='File size must be excately 2 MB';
                 }
                 if(empty($errors)==true){
                 move_uploaded_file($file_tmp,"assets/admission/".$file_name);
                $dob_c="assets/admission/".$file_name;
              }else{
                        return redirect('admission-form')->with([
                                'message' => 'Unable to upload File.Please try again',
                                'message_important'=>true
                        ]);
              }

        }else{
            $dob_c="";
        }

        if(isset($_FILES['cast_c'])){
          $errors= array();
               $file_name = $_FILES['cast_c']['name'];
               $file_size =$_FILES['cast_c']['size'];
               $file_tmp =$_FILES['cast_c']['tmp_name'];
               $file_type=$_FILES['cast_c']['type'];
              // $file_ext=strtolower(end(explode('.',$_FILES['file']['name'])));
              $tmp = explode('.', $file_name);
              $file_ext = end($tmp);
               if($file_size > 2097152){
                      $errors[]='File size must be excately 2 MB';
               }
               if(empty($errors)==true){
               move_uploaded_file($file_tmp,"assets/admission/".$file_name);
              $cast_c="assets/admission/".$file_name;
            }else{
                      return redirect('admission-form')->with([
                              'message' => 'Unable to upload File.Please try again',
                              'message_important'=>true
                      ]);
            }

      }else{
          $cast_c="";
      }

           if(isset($_FILES['photo_f'])){
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
                           return redirect('admission-form')->with([
                                   'message' => 'Unable to upload File.Please try again',
                                   'message_important'=>true
                           ]);
                 }

           }else{
               $filepath="";
           }

           if(isset($_FILES['photo_m'])){
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
               $photo_m_path="";
           }
           if(isset($_FILES['sign_a'])){
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
               $sign_a_path="";
           }
           if(isset($_FILES['sign_p'])){
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
               $sign_p_path="";
           }
          // exit;
           $dataarray=array(
               "stu_name"=>Input::get('stu_name'),
               "class"=>Input::get('class'),
               "dob"=>Input::get('dob'),
               "birthpalce"=>Input::get('birthpalce'),
               "gender"=>Input::get('gender'),
               "blood_group"=>Input::get('blood_group'),
               "handicap"=>Input::get('handicap'),
               "religion"=>Input::get('religion'),
               "subcast"=>Input::get('subcast'),
               "f_name"=>Input::get('f_name'),
               "f_phone"=>Input::get('f_phone'),
               "f_mobile"=>Input::get('f_mobile'),
               "f_qualification"=>Input::get('f_qualification'),
               "email"=>Input::get('email'),
               "fax"=>Input::get('fax'),
               "eng_speak"=>Input::get('eng_speak'),
               "f_service"=>Input::get('f_service'),
               "m_name"=>Input::get('m_name'),
               "m_phone"=>Input::get('m_phone'),
               "m_mobile"=>Input::get('m_mobile'),
               "m_qualification"=>Input::get('m_qualification'),
               "m_email"=>Input::get('m_email'),
               "m_fax"=>Input::get('m_fax'),
               "m_speak"=>Input::get('m_speak'),
               "m_service"=>Input::get('m_service'),
               "s_parent"=>Input::get('s_parent'),
               "dob_c"=>$dob_c,
               "cast_c"=>$cast_c,
               "photo_f"=>$filepath,
               "photo_m"=>$photo_m_path,
               "sign_a"=>$sign_a_path,
               "sign_p"=>$sign_p_path,
               "amt"=>"30550",
          );

          $save=DB::table('online_application')->insertGetId($dataarray);
          if($save){
              $session_pay=array(
               "order_id"=>$save,
               "amt"=>"30550"
             );
             Session::put('onlinepay_data', $session_pay);

              return redirect('payonline/pay/'.Crypt::encrypt($save));


          }else{
           return redirect('admission-form')->with([
               'message' => 'Unable to Submit Your Application.Please try again',
               'message_important'=>true
           ]);
          }

       }
     function admissionForm(){
     // echo  $merchant_data=app_config('pg_merchant_id','2'); exit;
      $class=DB::table('tb_course')->orderBy('id','desc')->get();
       return view('online_form.admission-form',compact('class'));
     }
	
     public function checkuser(){
          $this->middleware('auth');
              if (\Auth::user()->user_role==='P'){
              return redirect()->intended('parentwelcome');
              }

              elseif(\Auth::user()->user_role==='1')
                {
                  return redirect()->intended('welcome');
                } elseif(\Auth::user()->user_role==='S'){
                  return redirect()->intended('studentwelcome');
                }
              else{
				  return redirect()->intended('welcome');
              //  return redirect()->intended('logout');
              }
          }
     public function login(){
        $this->middleware('auth');
        return view('login');
     }

     public function parentindex(Request $request){
        $this->middleware('auth');
$request->session()->forget('wardregno');
 $wards = DB::table('stu_contact')
             ->join('stu_admission', 'stu_contact.reg_no', '=', 'stu_admission.reg_no')
             ->join('tb_course', 'stu_admission.course', '=', 'tb_course.id')
             ->join('tb_batch', 'stu_admission.batch', '=', 'tb_batch.id')

             ->where('stu_contact.father_phone',Auth::user()->username)
             ->where('stu_admission.branch_code',Auth::user()->school_id)
	  	//	 ->where('stu_admission.status',1)            
             ->groupBy('stu_admission.reg_no')
             ->get();

       return view('gurdian.welcome',compact('wards'));
     }

     public function teacherindex(Request $request)
     {
        $this->middleware('auth');
        $request->session()->forget('wardregno');
        $detail=DB::table('emp_contact')
        ->join('emp_details','emp_contact.emp_id','=','emp_details.empcode')
        ->where('emp_contact.phone',Auth::user()->username)
        ->where('emp_details.branch_code',Auth::user()->school_id)
        ->get();
         $emp_detail=DB::table('emp_contact')
        ->join('emp_details','emp_contact.emp_id','=','emp_details.empcode')
        ->where('emp_contact.phone',Auth::user()->username)
        ->where('emp_details.branch_code',Auth::user()->school_id)
        ->get();
         $emp_education=DB::table('emp_contact')
        ->join('emp_details','emp_contact.emp_id','=','emp_details.empcode')
        ->where('emp_contact.phone',Auth::user()->username)
        ->where('emp_details.branch_code',Auth::user()->school_id)
        ->get();
        return view('Teacher.Welcom',compact('detail','emp_detail','emp_education'));
     }


	    public function changepassword(Request $request)
    {
        return view('changepassword');
    }
    public function updatepassword(Request $request)
    {
        $password=Input::get('password');

            DB::table('users')
            ->where('id','=',Auth::user()->id)
            ->update(['password'=>bcrypt($password)]);
            return redirect('Password/change_password')
            ->with([
            'message' =>'Password Update SuccesFully..'
        ]);
    }

    public function forgot_password()
    {
         return view('forgotPassword');
    }

    public function checkuserhas(){
      $username=Input::get('username');
      $users = DB::table('users')
                ->where('username', $username)
                ->get();
                if(count($users)=="1"){

                }else{
                    echo "0";
                }

    //echo count($users);
    }




    function update_password(){
       $username=Input::get('username');
       DB::enableQueryLog();
       $userdata = DB::table('users')->select('mobile')
                ->where('username', $username)
                ->get();

            # your laravel query builder goes
       //     $laQuery = DB::getQueryLog();
              //  print_r($userdata[0]) ;exit;
             $mobile_no=$userdata[0]->mobile;
                $password="12345";
               // $password= rand(1000,9999);
                $msg="Dear User,your new password is ".$password;
             if($mobile_no!='' || $mobile_no==null){
                $sendSMS = sendSMS($mobile_no,$msg);
                if($sendSMS){
                    DB::table('users')
                    ->where('username','=',$username)
                    ->update(['password'=>bcrypt($password)]);
                    $dt=array(
                        "username"=>$username,
                        "change_by"=>"self",
                        "newpassword"=>$password,
                    );
                    DB::table('password_change_log')->insert($dt);

                    echo "1";
                }else{
                    echo "3";
                }
             }else{
                 echo "2";
             }

     //  DB::table('users')->where('id','=',Auth::user()->id)->update(['password'=>bcrypt($password)]);
       // $sendSMS = sendSMS();

    }

}
