<?php

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
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\permission;
use App\EmployeeRolesPermission;
use App\feecollection;
use App\EmployeeRoles;
use App\AppConfig;
use Illuminate\Support\Facades\Crypt;
date_default_timezone_set('Asia/Kolkata');
class settingController extends Controller
{
  use RegistersUsers;
  public function __construct()
  {
      $this->middleware('auth');
      $this->middleware('SchoolMiddleware');

  }
  public function permissionError()
  {
      return view('setting.permission-error');
  }
	
public function updatePassword()
{
    return view('setting.password_update');
}

public function updateUserPassword(Request $request){
  if (\Auth::user()->user_role!=='1'){
      $get_perm=permission::permitted($self);

      if ($get_perm=='access denied'){
          return redirect('permission-error')->with([
              'message' => 'You do not have permission to view this page',
              'message_important'=>true
          ]);
      }
  }
  $this->validate($request, [
      'username' => 'required',
  ]);

  $username=Input::get('username');
  $password=Input::get('npassword');
  $cnt=DB::table('users')->where('username','=',$username)->count();
  //echo $cnt;exit;
  if($cnt=="1"){
  DB::table('users')
  ->where('username','=',$username)
  ->update(['password'=>bcrypt($password)]);
  $dt=array(
      "username"=>Auth::user()->username,
      "change_by"=>Auth::user()->username,
      "newpassword"=>$password,
  );
  DB::table('password_change_log')->insert($dt);
  return redirect('user/password/update')->with([
      'message' => 'Password Updated Successfully.'
  ]);
}else{
  return redirect('user/password/update')->with([
    'message' => 'User Name Not Found.',
    'message_important'=>true
  ]);
}
}
	
  public function index()
 {
   $Institution=DB::table('create_institute')->where('id','1')->get();
   $today = date('Y-m-d');
   $first_day_this_month = date('01-m-Y');
   $last_day_this_month  = date('t-m-Y');
   foreach ($Institution as $Institution) {
     $InstitutionName =$Institution->insitute_name;
     $address = $Institution->insitute_address;
     $InstitutionEmail = $Institution->insitute_email;
     $InstitutionMobile = $Institution->insitute_mobile;
     $Institutionphone = $Institution->insitute_phone;
     $contactperson = $Institution->admin_cont_name;
     $language = $Institution->language;
     $logo = $Institution->logo;
     $address = $Institution->insitute_name;
     $Institutionphone = $Institution->insitute_name;
     $Institutionfax = $Institution->insitute_fax;
     $country = $Institution->country;
     $InstitutionCode = $Institution->insitute_code;
   }
   $mon=date('m');
   $yr=date('Y');
   $d=cal_days_in_month(CAL_GREGORIAN,$mon,$yr);
   $emp=DB::table('emp_details')->where('branch_code',Auth::user()->school_id)->count();
   $course=DB::table('tb_course')->where('branch_code',Auth::user()->school_id)->count();
   $batch=DB::table('tb_batch')->where('branch_code',Auth::user()->school_id)->count();
   $student=DB::table('office_student_reg')->where('branch_code',Auth::user()->school_id)->count();
   $totalfee=DB::table('fee_collection')->where('created_date',$today)->where('receipt_status','1')->where('branch_code',Auth::user()->school_id)->sum('amt');
   $duefee=DB::table('fee_collection')->where('created_date',$today)->where('receipt_status','1')->where('branch_code',Auth::user()->school_id)->sum('dueamt');
   $discountfee=DB::table('fee_collection')->where('created_date',$today)->where('receipt_status','1')->where('branch_code',Auth::user()->school_id)->sum('discount');
   $todaytotalfee=($totalfee+$duefee)-$discountfee;
   $firstday = date("Y-m-d", strtotime("first day of this month"));
   $lastday = date("Y-m-d", strtotime("last day of this month"));
   $monthtotalfee=DB::table('fee_collection')->whereBetween('created_date',[$firstday,$lastday])->where('receipt_status','1')->where('branch_code',Auth::user()->school_id)->sum('amt');
   $monthduefee=DB::table('fee_collection')->whereBetween('created_date',[$firstday,$lastday])->where('receipt_status','1')->where('branch_code',Auth::user()->school_id)->sum('dueamt');
   $monthdiscountfee=DB::table('fee_collection')->whereBetween('created_date',[$firstday,$lastday])->where('receipt_status','1')->where('branch_code',Auth::user()->school_id)->sum('discount');
   $monthtotalfee=($monthtotalfee+$monthduefee)-$monthdiscountfee;

  $feecollection=feecollection::whereBetween('created_date',array($firstday,$lastday))->where('receipt_status','1')->select(DB::raw('sum(amt) as tamt,sum(dueamt) as damt,sum(amt) as tamt,(SUM(amt)+SUM(dueamt)-SUM(discount)) AS amt'),DB::raw('created_date as date'))->groupBy('created_date')->get()->toJson();
/*    $feecollection = DB::table('fee_collection')
                        ->select(DB::raw('sum(amt) as amt, created_date as date'))
                        ->whereBetween('created_date',array($firstday,$lastday))
                        ->where('branch_code',Auth::user()->school_id)
                        ->groupBy('created_date','month')
                        ->get()
                        ->toJson();*/
    $att_date=('d-m-Y');
    $sql = "SELECT x.present,(x.total_student-x.present) AS absent,x.total_student FROM
            (SELECT COUNT(a.`status`) AS present,
            (SELECT COUNT(b.reg_no) FROM stu_admission b WHERE b.accdmic_year='2020-2021') AS total_student
            FROM stu_attendance a WHERE a.`status`='P' and a.att_date='$att_date'
            ) x";
    $attendance = DB::select($sql);
    //Birthday Calculation
        $bdate =date('Y');
        $bmonth =date('m');
        $bday = date('d');
        $start= $bdate-1;
        $sss = $start.'-'.$bdate;
        $now = $bmonth.'/'.$bday;
        $studentBirthdayList = DB::table('view_student_birthday')  
                       ->where(DB::raw('upper(accdmic_year)'),strtoupper($sss))
                       ->where(DB::raw('SUBSTRING(dob, 1, 5)'),$now)
                       ->orderBy('roll_no','ASC')
                       ->get();
        $studentBirthdayList = json_encode($studentBirthdayList,true);
        $studentBirthdayList = json_decode($studentBirthdayList,true);
      
        $eventCurrentDate=date('Y-m-d');
        $eventList = DB::table('view_event_details') 
                            ->where('from_date','>=',$eventCurrentDate)
                            ->where('event_status',1)
                            ->orderBy('from_date','ASC')
                            ->limit(10)
                            ->get();
        $eventList = json_encode($eventList,true);
        $eventList = json_decode($eventList,true);
	  
	    $assigned_subejcts=array();
    $notice=array();
    $classTeacher=array();
    if(Auth::user()->user_role==6){
    $classTeacher=DB::table("class_teacher_allocation")
    ->join('tb_course','tb_course.id','class_teacher_allocation.course')
    ->join('tb_batch','tb_batch.id','class_teacher_allocation.batch')
    ->select('class_teacher_allocation.teacher_id','tb_course.course_name','tb_batch.batch_name')
    ->where('class_teacher_allocation.teacher_id',Auth::user()->username)
    ->where('class_teacher_allocation.accadmicyear',app_config('Session',Auth::user()->school_id))
    ->get();

    $assigned_subejcts=DB::table("subject_allocation")
    ->join('tb_course','tb_course.id','subject_allocation.course')
    ->join('tb_batch','tb_batch.id','subject_allocation.batch')
    ->join('tb_subject','tb_subject.id','subject_allocation.subject')
    ->select('subject_allocation.emp_id','subject_allocation.acadmic_year','tb_subject.subject_name','tb_course.course_name','tb_batch.batch_name')
    ->where('subject_allocation.emp_id',Auth::user()->username)
    ->where('subject_allocation.acadmic_year',app_config('Session',Auth::user()->school_id))
    ->get();


    }

    $notice=DB::table('user_notification')
    ->join('users','users.username','user_notification.user_from')
    ->select('user_notification.*','users.name')
    ->where('user_notification.user_to',Auth::user()->username)
    ->orWhere('user_notification.user_role',Auth::user()->user_role)
    ->where('user_notification.status',1)
    ->get();

	  
	  
	    return view('welcome',compact('d','assigned_subejcts','notice','classTeacher','attendance','emp','course','batch','student','monthtotalfee','todaytotalfee','feecollection','studentBirthdayList','eventList'));

	  /*
	  return view('welcome',compact('d','assigned_subejcts','notice','classTeacher','emp','course','batch','student','InstitutionName','address','InstitutionEmail','InstitutionMobile','Institutionphone','contactperson','language','logo','address','Institutionphone','Institutionfax','country','InstitutionCode','monthtotalfee','todaytotalfee','feecollection'));*/


 }
  public function createInstitution(){
    $logo=null;
    $Institution=DB::table('create_institute')->where('branch_code',Auth::user()->school_id)->get();
    foreach ($Institution as $Institution) {
      $InstitutionName =$Institution->insitute_name;
      $address = $Institution->insitute_address;
      $InstitutionEmail = $Institution->insitute_email;
      $InstitutionMobile = $Institution->insitute_mobile;
      $Institutionphone = $Institution->insitute_phone;
      $contactperson = $Institution->admin_cont_name;
      $language = $Institution->language;
      $logo = $Institution->logo;
      $address = $Institution->insitute_name;
      $Institutionphone = $Institution->insitute_name;
      $Institutionfax = $Institution->insitute_fax;
      $country = $Institution->country;
      $InstitutionCode = $Institution->insitute_code;
    }
    if ($logo!=null) {
      return view('setting.institution-create',compact('InstitutionName','address','InstitutionEmail','InstitutionMobile','Institutionphone','contactperson','language','logo','address','Institutionphone','Institutionfax','country','InstitutionCode'));

    }else{
      $logo=null;
      return view('setting.institution-create',compact('InstitutionName','address','InstitutionEmail','InstitutionMobile','Institutionphone','contactperson','language','logo','address','Institutionphone','Institutionfax','country','InstitutionCode'));

    }
  }

  public function InstitutionDetails(Request $request){
    $self='create-Institution';
    if (\Auth::user()->user_role!=='1'){
        $get_perm=permission::permitted($self);

        if ($get_perm=='access denied'){
            return redirect('permission-error')->with([
                'message' => 'You do not have permission to view this page',
                'message_important'=>true
            ]);
        }
    }
    $this->validate($request, [
        'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'InstitutionName'=>'required',
    ]);

  $setting=  array();

    $InstitutionName = Input::get('InstitutionName');
    $address = Input::get('address');
    $InstitutionEmail = Input::get('InstitutionEmail');
    $InstitutionMobile = Input::get('InstitutionMobile');
    $Institutionphone = Input::get('Institutionphone');
    $contactperson = Input::get('contactperson');
    $language = Input::get('language');
    $app_logo = Input::file('logo');
    $address = Input::get('address');
    $Institutionphone = Input::get('Institutionphone');
    $Institutionfax = Input::get('Institutionfax');
    $country = Input::get('country');
    $InstitutionCode = Input::get('InstitutionCode');
    $created_date = date('d-m-Y H:i:s');
   $imageName = time().'.'.$request->logo->getClientOriginalExtension();
   $imagepath='assets/images/school/'.$imageName;

   if($request->logo->move('assets/images/school/', $imageName)){
  //   DB::table('create_institute')->truncate();
     DB::table('create_institute')->insert(['insitute_name'=>$InstitutionName,'insitute_address'=>$address,'insitute_email'=>$InstitutionEmail,'insitute_phone'=>$Institutionphone,'insitute_mobile'=>$InstitutionMobile,'insitute_fax'=>$Institutionfax,'admin_cont_name'=>$contactperson,'country'=>$country,'language'=>$language,'insitute_code'=>$InstitutionCode,'logo'=>$imagepath,'created_date'=>$created_date
     ,'branch_code'=>Auth::user()->id]);
        AppConfig::where('setting', '=', 'AppLogo')->where('branch_code',Auth::user()->school_id)->update(['value' => $imagepath]);
            return redirect('create-Institution')->with([
                 'message' => 'Institution Created Successfully.'
             ]);
   }else{
     return redirect('create-Institution')->withErrors($errors, $this->errorBag());
   }
}
  public function academicDetails(){
    $self='Academic-Details';
    if (\Auth::user()->user_role!=='1'){
        $get_perm=permission::permitted($self);

        if ($get_perm=='access denied'){
            return redirect('permission-error')->with([
                'message' => 'You do not have permission to view this page',
                'message_important'=>true
            ]);
        }
    }
    $acadmic=DB::table('academicyear')->where('branch_code',Auth::user()->school_id)->orderBy('startyear','desc')->get();
     return view('setting.Academic-Details',compact('acadmic'));
  }

  public function addacadmicyear(request $request){
    $this->validate($request, [
        'startyear'=>'required',
        'startmonth'=>'required',
        'endyear'=>'required',
        'endmonth'=>'required',
        'status'=>'required',
    ]);
    $startyear = Input::get('startyear');
    $startmonth = Input::get('startmonth');
    $endyear = Input::get('endyear');
    $endmonth = Input::get('endmonth');
    $status = Input::get('status');
    $created_date = date('d-m-Y H:i:s');
    DB::table('academicyear')->insert(['startyear'=>$startyear,'startmonth'=>$startmonth,'endyear'=>$endyear,'endmonth'=>$endmonth,'status'=>$status,'created_date'=>$created_date,'branch_code'=>Auth::user()->id]);
           return redirect('Academic-session')->with([
                'message' => 'Academic Year Added Successfully.'
            ]);
  }
  public function academicDetailsview(Request $request,$id)
  {
// echo $id;
    if($id!=null)
    {
        $academicyear=DB::table('academicyear')->where('branch_code',Auth::user()->id)->orderBy('startyear','desc')->get();
        $academicyears=DB::table('academicyear')->where('startyear','=',$id)->get();

         return view('setting.View-Academic-Details',compact('academicyear','academicyears'));// ['active_parners' => $activepartner]);

    } else
//$activepartner=DB::table('active_parners')->get();
  return redirect('Academic-session')->with([
          'message' => "Academic-Details Info Not Found",
          'message_important' => true
      ]);
  }
  public function addacadmicyearupdate(Request $request){
    $this->validate($request, [
        'startyear'=>'required',
        'startmonth'=>'required',
        'endyear'=>'required',
        'endmonth'=>'required',
        'status'=>'required',
    ]);
    $startyear = Input::get('startyear');
    $startmonth = Input::get('startmonth');
    $endyear = Input::get('endyear');
    $endmonth = Input::get('endmonth');
    $status = Input::get('status');
    $created_date = date('d-m-Y H:i:s');
	  $session=$startyear."-".$endyear;
    DB::table('academicyear')->where('branch_code',Auth::user()->id)->where('startyear','=',$startyear)->update(['startyear'=>$startyear,'startmonth'=>$startmonth,'endyear'=>$endyear,'endmonth'=>$endmonth,'status'=>$status,'created_date'=>$created_date,'branch_code'=>Auth::user()->id]);
	  
	  DB::table('sys_appconfig')->where('setting','Session')->update(["value"=>$session]);
           return redirect('Academic-session')->with([
                'message' => 'Academic Year Updated Successfully.'
            ]);
  }
public function deleteacadmicyear(Request $request,$id){
  $request->all();
if($id!=null){
   DB::table('academicyear')->where('startyear','=',$id)->delete();
    return redirect('Academic-session')->with([
        'message' => "Academic Year Details Deleted Successfully"
    ]);
}else{
    return redirect('Academic-session')->with([
        'message' => "Academic Year Details Not Found",
        'message_important' => true
    ]);
}
}
public function branch(){
  $code = DB::table('create_institute')->select('insitute_code','insitute_name')->get();
  foreach($code as $code){
     $codee=$code->insitute_code;
     $insitute_name=$code->insitute_name;
  }
  $users = DB::table('users')->count();
  $users=$users+1;
  $branchcode=$codee.env('Branch_code').$users;
   return view('setting.branch',compact('branchcode','insitute_name'));
}
public function addbranch(request $request){
  $this->validate($request, [
      'name'=>'required',
      'email'=>'required|string|email|max:255|unique:users',
      'password'=>'required|string|min:6|confirmed',
      'school_name'=>'required',
          ]);
$name = Input::get('name');
$email = Input::get('email');
$password = Input::get('password');
$school_name = Input::get('school_name');
$passwordd = bcrypt($password);
 $last_id = DB::select(DB::raw("SELECT `auto_increment` FROM INFORMATION_SCHEMA.TABLES WHERE table_name = 'users'"));
//print_r($last_id);
               foreach ($last_id as $last_id) {
                  // code...
                      $lastid= $last_id->auto_increment;
               }

 $school_id=$lastid;
DB::table('setting')->insert(['setting'=>'AppLogo','value'=>'','branch_code'=>$school_id]);
DB::table('users')->insert(['name'=>$name,'email'=>$email,'password'=>$passwordd,'school_name'=>$school_name,'school_id'=>$school_id]);
       return redirect('setting/branch')->with([
            'message' => 'Branch Added Successfully.'
        ]);
}

public function feedbacklist(){
  $list=DB::table('feedback')->where('branch_code',Auth::user()->school_id)->get();
  return view('feedback.feedbacklist',compact('list'));
}
public function schoolviewfeedback($id){
  $feeback=DB::table('feedback')->where('id',$id)->get();
    foreach ($feeback as $feeback) {
      // code...
      $subject=$feeback->subject;
      $name=$feeback->name;
      $parent_no=$feeback->parent_no;
      $msg=$feeback->msg;
      $created_at=$feeback->created_at;
      $status=$feeback->status;
      $id=$feeback->id;
    }
    $feedback_comments=DB::table('feedback_comments')->where('feedback_id',$id)->get();
    return view('feedback.view-feedback',compact('name','parent_no','id','subject','msg','created_at','status','feedback_comments'));
}

public function submitfeedbackcommentsschool(Request $request){
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
     return redirect('feedback/view/'.$id)->with([
          'message' => 'Your Complaint/Feedback Submited Successfully.'
      ]);
   }else{
     return redirect('feedback/view/'.$id)->with([
          'message' => 'Unable to Your Complaint/Feedback.Please Try Again.'
      ]);
   }

   }catch(\Illuminate\Database\QueryException $ex){
     return redirect('feedback/view/'.$id)->with([
          'message' => 'Someting Went Worng Please Contact Technical Team : '.$ex->getMessage(). '',
          'message_important'=>true
      ]);
  }
}
 public function generate_attendance_report(Request $request)
  {
    $month=$request->month;
    $student=$request->student;

    $report=DB::table('stu_attendance')
            ->where('month','=','April')
            ->where('reg_no','=',$student)
            ->get();

            echo $report;
  }
}
?>
