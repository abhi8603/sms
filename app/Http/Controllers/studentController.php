<?php

namespace App\Http\Controllers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use PDF;
use App\Http\Requests;
use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use App\permission;
use App\EmployeeRolesPermission;
use App\EmployeeRoles;
use Illuminate\Support\Facades\Crypt;
date_default_timezone_set('Asia/Kolkata');
class studentController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
    //  $this->middleware('SchoolMiddleware');
  }

  function student_bulk_upload(Request $request){
    $class=Input::get('class');
    $section=Input::get('section');
    $accadmicyear=Input::get('accadmicyear');
    $fileName = $_FILES["file"]["tmp_name"];
    $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
    if ($ext == 'csv') {
    if ($_FILES["file"]["size"] > 0) {
      $file = fopen($fileName, "r");
      $importData_arr = array();
      $i = 0;
      while (($filedata = fgetcsv($file, 10000, ",")) !== FALSE) {
        $num = count($filedata );
               if($i == 0){
                $i++;
                continue;
             }
             for ($c=0; $c < $num; $c++) {
              $importData_arr[$i][] = $filedata [$c];
           }
           $i++;

      }
      //echo count($importData_arr);
      if(count($importData_arr)==0){
        return redirect('student/import')->with([
          'message' => 'File not have any Student Data.',
          'message_important'=>true
      ]);
      }

     foreach($importData_arr as $importData){
          $studentlogindata=array(
            "emp_code"=>$importData[0],
            "name"=>$importData[3],
            "username"=>$importData[0],
            "email"=>$importData[22],
            "mobile"=>$importData[21],
            "password"=>bcrypt($importData[0]),
            "school_name"=>Auth::user()->school_name,
            "school_id"=>Auth::user()->school_id,
            "user_role"=>"S"
          );
          $parentlogindata=array(
            "emp_code"=>$importData[24],
            "name"=>$importData[23],
            "username"=>$importData[24],
            "email"=>$importData[22],
            "mobile"=>$importData[24],
            "password"=>bcrypt($importData[24]),
            "school_name"=>Auth::user()->school_name,
            "school_id"=>Auth::user()->school_id,
            "user_role"=>"P"
          );
          $stuAdmission=array(
            "accdmic_year"=>$accadmicyear,
            "reg_no"=>$importData[0],
            "joining_date"=>$importData[1],
            "course"=>$class,
            "batch"=>$section,
            "roll_no"=>$importData[2],
            "stu_name"=>$importData[3],
            "dob"=>$importData[4],
            "gender"=>$importData[5],
            "blood_group"=>$importData[6],
            "birth_place"=>$importData[7],
            "nationaliy"=>$importData[8],
            "category"=>$importData[9],
            "religion"=>$importData[10],
            "aadhar_no"=>$importData[11],
            "prev_school"=>$importData[12],
            "prev_school_address"=>$importData[13],
            "prev_qualification"=>$importData[14],
            "acadmic_year"=>$accadmicyear,
            "branch_code"=>Auth::user()->school_id,
          );
          $office_reg_data=array(
            "reg_no"=>$importData[0],
            "accdmic_year"=>$accadmicyear,
            "joining_date"=>$importData[1],
            "course"=>$class,
            "batch"=>$section,
            "roll_no"=>$importData[2],
            "branch_code"=>Auth::user()->school_id,
            "parent_mobile"=>$importData[24]
          );
          $stuContact=array(
            "reg_no"=>$importData[0],
            "roll_no"=>$importData[2],
            "permanent_address"=>$importData[15],
            "present_address"=>$importData[16],
            "city"=>$importData[17],
            "pin"=>$importData[18],
            "country"=>$importData[19],
            "state"=>$importData[20],
            "phone"=>$importData[21],
            "email"=>$importData[22],
            "father_name"=>$importData[23],
            "mother_name"=>$importData[26],
            "father_phone"=>$importData[24],
            "mother_phone"=>"",
            "father_aadhar"=>$importData[25],
            "father_job"=>"",
          );

          $logincnt=DB::table('users')->where('username',$studentlogindata['username'])->get();
          $admncnt=DB::table('stu_admission')->where('reg_no',$stuAdmission['reg_no'])->get();
          $concnt=DB::table('stu_contact')->where('reg_no',$stuContact['reg_no'])->get();
          $pcnt=DB::table('users')->where('username',$parentlogindata['username'])->get();
          if(count($logincnt)==0){
          $login=DB::table('users')->insertGetId($studentlogindata);
          if($login !=null || $login != ""){
            if(count($admncnt)==0){
            $admn=DB::table('stu_admission')->insertGetId($stuAdmission);
            if($admn){
              if(count($concnt)==0){
              $stu_contact=DB::table('stu_contact')->insertGetId($stuContact);
              $stu_office=DB::table('office_student_reg')->insertGetId($office_reg_data);
              if($stu_contact){
                if($parentlogindata['emp_code'] != "" || $parentlogindata['emp_code'] != null){
                  if(count($pcnt)==0){
                  $parentlogin=DB::table('users')->insertGetId($parentlogindata);
                  }
                }

              }
            }else{
              DB::table('stu_contact')
              ->where('reg_no',$stuContact['reg_no'])
              ->update($stuAdmission);
            }
            }else{

            }
          }else{
            DB::table('stu_admission')
            ->where('reg_no',$stuAdmission['reg_no'])
            ->update($stuAdmission);
          }
        }else{

        }

        }else{
          DB::table('users')
            ->where('username', $studentlogindata['username'])
            ->update($studentlogindata);
        }

      }
     // fclose($fileName);
    /* echo "<pre>";
     print_r($studentlogindata);
     print_r($parentlogindata['emp_code']);
     print_r($stuAdmission);
     print_r($stuContact);
     print_r($importData_arr);exit;*/

     return redirect('student/import')->with([
      'message' => 'Student Data Uploaded Successfully.'

  ]);

    }else{
      return redirect('student/import')->with([
        'message' => 'File not have any data',
        'message_important'=>true
    ]);
    }
  }else{
 return redirect('student/import')->with([
                'message' => 'Invalid File Format.',
                'message_important'=>true
            ]);
  }
  }

  function studentimport(){
    $accadmicyear=DB::table('academicyear')->where('branch_code',Auth::user()->school_id)->orderBy('startyear','desc')->get();
    $course=DB::table('tb_course')->where('branch_code',Auth::user()->school_id)->orderBy('id','asc')->get();
    $batch=DB::table('tb_batch')->where('branch_code',Auth::user()->school_id)->orderBy('id','asc')->get();
    //  print_r($data);exit;
    return view('students.student_import',compact('accadmicyear','course','batch'));
  }

   // new DomicileCertificate

  public function studentcategory(){
    $self='student/category';
    if (\Auth::user()->user_role!=='1'){
        $get_perm=permission::permitted($self);

        if ($get_perm=='access denied'){
            return redirect('permission-error')->with([
                'message' => 'You do not have permission to view this page',
                'message_important'=>true
            ]);
        }
    }
     $stu_category=DB::table('tb_studentcategory')->where('branch_code',Auth::user()->school_id)->get();
     return view('students.student-category',compact('stu_category'));
  }

  public function addstuCategory(Request $request){
  $usertype=Input::get('studentCategory');
  $created_date = date('d-m-Y H:i:s');
  DB::table('tb_studentcategory')->insert(['stu_category'=>$usertype,'created_on'=>$created_date,'branch_code'=>Auth::user()->school_id]);
         return redirect('student/category')->with([
              'message' => 'New Student Category Added Successfully'
          ]);
  }

  public function studentaddmission(){
    $self='student/admission';
    if (\Auth::user()->user_role!=='1'){
        $get_perm=permission::permitted($self);

        if ($get_perm=='access denied'){
            return redirect('permission-error')->with([
                'message' => 'You do not have permission to view this page',
                'message_important'=>true
            ]);
        }
    }
      $accadmicyear=DB::table('academicyear')->where('branch_code',Auth::user()->school_id)->orderBy('startyear','desc')->get();
      $course=DB::table('tb_course')->where('branch_code',Auth::user()->school_id)->orderBy('id','asc')->get();
      $category=DB::table('tb_studentcategory')->where('branch_code',Auth::user()->school_id)->orderBy('id','desc')->get();
      $batch=DB::table('tb_batch')->where('branch_code',Auth::user()->school_id)->orderBy('id','asc')->get();
      $fees=DB::table('fee_subcategory')->where('branch_code',Auth::user()->school_id)->orderBy('id','desc')->get();
      $accadmicyearactive=DB::table('academicyear')->where('status','1')->orderBy('startyear','desc')->get();
      foreach($accadmicyearactive as $accadmicyearactive){
        $activeyear=$accadmicyearactive->startyear;
      }
      $currntcnt = DB::table('office_student_reg')->where('branch_code',Auth::user()->school_id)->count();
      $currntcnt=$currntcnt+1;
      //$reg_code=$activeyear."100".$currntcnt+1;
	  // add reg_code in compact line
     return view('students.student-admission',compact('accadmicyear','course','batch','fees','category'));
  }
  public function batchlist(Request $request){
   $eid = $request->eid;
   $batch = DB::table('tb_batch')->select('id','batch_name')->where('branch_code',Auth::user()->school_id)->where('course',$eid)->get();
   //$batch=DB::table('tb_batch')->where('course',$eid)->orderBy('id','desc')->get();
  $cart = array();
   foreach($batch as $batch){
    array_push($cart,$batch);
   }
    echo json_encode($cart);
  }
  public function feeamt(Request $request){
    $eid = $request->eid;
    $batch = DB::table('fee_subcategory')->select('amount')->where('branch_code',Auth::user()->school_id)->where('id',$eid)->get();
    //$batch=DB::table('tb_batch')->where('course',$eid)->orderBy('id','desc')->get();
   $cart = array();
    foreach($batch as $batch){
     array_push($cart,$batch);
    }
     echo json_encode($cart);
  }
  public function countstu(Request $request){
    $eid = $request->eid;
    $batch = DB::table('tb_batch')->where('branch_code',Auth::user()->school_id)->where('id',$eid)->get();

    foreach($batch as $batch){
      $totstu=$batch->max_no_stu;
    }
    $currntcnt = DB::table('office_student_reg')->where('branch_code',Auth::user()->school_id)->where('batch',$eid)->count();
    //$batch=DB::table('tb_batch')->where('course',$eid)->orderBy('id','desc')->get();

     echo $totstu."|".$currntcnt;
  }
  public function studentregister(Request $request){
    $this->validate($request, [
        'accdmic_year'=>'required',
        'reg_no'=>'required|string|max:255|unique:stu_admission',
        'joining_date'=>'required',
        'course'=>'required',


        'fname'=>'required',
        'father_phone'=>'required',
        'present_address'=>'required',
        'father_name'=>'required',

            ]);
    $accdmic_year=Input::get('accdmic_year');
    $reg_no=Input::get('reg_no');
    $joining_date=Input::get('joining_date');
    $course=Input::get('course');
     $batch=Input::get('batch');
    $roll_no=Input::get('roll_no');
    $fname=Input::get('fname');
    $dob=Input::get('dob');
    $gender=Input::get('gender');
    $blood_group=Input::get('blood_group');
    $birth_place=Input::get('birth_place');
    $nationaliy=Input::get('nationaliy');
    $category=Input::get('category');
    $religion=Input::get('religion');
    $aadhar_no=Input::get('aadhar_no');
    $permanent_address=Input::get('permanent_address');
    $present_address=Input::get('present_address');
    $city=Input::get('city');
    $pin=Input::get('pin');
    $country=Input::get('country');
    $state=Input::get('state');
    $phone=Input::get('phone');
    $email=Input::get('email');
    $father_name=Input::get('father_name');
    $mother_name=Input::get('mother_name');
    $father_job=Input::get('father_job');
    $father_phone=Input::get('father_phone');
    $mother_phone=Input::get('mother_phone');
    $father_aadhar=Input::get('father_aadhar');
    $prev_school=Input::get('prev_school');
    $prev_school_address=Input::get('prev_school_address');
    $prev_qualification=Input::get('prev_qualification');
    $created_date = date('d-m-Y H:i:s');
    try{
  $stu_admin= DB::table('stu_admission')->insert(['accdmic_year'=>$accdmic_year,'reg_no'=>$reg_no,'joining_date'=>$joining_date,'course'=>$course,'batch'=>$batch,'roll_no'=>$roll_no,
    'stu_name'=>$fname,'dob'=>$dob,'gender'=>$gender,'blood_group'=>$blood_group,'birth_place'=>$birth_place,
    'nationaliy'=>$nationaliy,'category'=>$category,'religion'=>$religion,'aadhar_no'=>$aadhar_no,'prev_school'=>$prev_school,'prev_school_address'=>$prev_school_address,'prev_qualification'=>$prev_qualification,'branch_code'=>Auth::user()->school_id,'created_date'=>$created_date]);
      if($stu_admin!=""){
  $stu_contact=DB::table('stu_contact')->insert(['reg_no'=>$reg_no,'roll_no'=>$roll_no,
    'permanent_address'=>$permanent_address,'present_address'=>$present_address,'city'=>$city,'pin'=>$pin,'country'=>$country,'state'=>$state,'phone'=>$phone,
    'email'=>$email,'father_name'=>$father_name,'mother_name'=>$mother_name,'father_job'=>$father_job,'father_phone'=>$father_phone,'mother_phone'=>$mother_phone,'father_aadhar'=>$father_aadhar]);
if($stu_contact!=""){
$officedata=DB::table('office_student_reg')->insert(['reg_no'=>$reg_no,'accdmic_year'=>$accdmic_year,'joining_date'=>$joining_date,'course'=>$course,'batch'=>$batch,'roll_no'=>$roll_no,'branch_code'=>Auth::user()->school_id,'created_date'=>$created_date]);
  if($officedata!=""){
    $cnt=DB::table('users')->where('username',$father_phone)->count();
    if($cnt =="0"){
    $plogin=DB::table('users')->insert(['name'=>$father_name,'username'=>$father_phone,'email'=>$email,'password'=>bcrypt($father_phone),'school_name'=>Auth::user()->school_name,'school_id'=>Auth::user()->school_id,'user_role'=>'P']);
  }
    return redirect('student/admission')->with([
       'message' => 'New Student Registration Completed Successfully'
       ]);
  }else{
    DB::table('stu_admission')->where('reg_no',$reg_no)->delete();
    DB::table('stu_contact')->where('reg_no',$reg_no)->delete();
    DB::table('office_student_reg')->where('reg_no',$reg_no)->delete();
    return redirect('student/admission')->with([
       'message' => 'Unable to Complete Student Registration.try again',
       'message_important'=>true
       ]);
  }
}else{
  DB::table('stu_admission')->where('reg_no',$reg_no)->delete();
  DB::table('stu_contact')->where('reg_no',$reg_no)->delete();
  return redirect('student/admission')->with([
     'message' => 'Unable to Complete Student Registration.try again',
     'message_important'=>true
     ]);
}
}else{
  DB::table('stu_admission')->where('reg_no',$reg_no)->delete();
  return redirect('student/admission')->with([
     'message' => 'Unable to Complete Student Registration.try again',
     'message_important'=>true
     ]);
}
}catch(\Illuminate\Database\QueryException $ex){
  return redirect('student/admission')->with([
       'message' => 'Someting Went Worng Please Contact Technical Team : '.$ex->getMessage(). '',
       'message_important'=>true
   ]);

  }
}  
// Student list check start
public function getSubcategory(Request $request , $category)
	{
       $subcatsss=DB::table('tb_course')
	   ->join('tb_batch', 'tb_batch.course', '=', 'tb_course.id')
	  // ->join('stu_contact', 'stu_admission.roll_no', '=', 'stu_admission.roll_no')
	 // ->Leftjoin('tb_course', 'stu_admission.course', '=', 'tb_course.id')
	 // ->Leftjoin('stu_contact', 'stu_admission.roll_no', '=', 'stu_admission.roll_no')
	           ->where('course',$category)
			   ->get();
/*
$subcatsss=DB::table('tb_batch')
	   ->join('tb_course', 'tb_course.id', '=', 'tb_batch.course')
	  // ->join('stu_contact', 'stu_admission.roll_no', '=', 'stu_admission.roll_no')
	 // ->Leftjoin('tb_course', 'stu_admission.course', '=', 'tb_course.id')
	 // ->Leftjoin('stu_contact', 'stu_admission.roll_no', '=', 'stu_admission.roll_no')
	           ->where('course',$category)
			   ->get();
*/
        return response()->json($subcatsss);
    }
	public function getSubcategoryss(Request $request , $category)
	{
       $subcatsss=DB::table('tb_degination')
	   ->join('emp_details', 'emp_details.designation', '=', 'tb_degination.degination')
	           ->where('designation',$category)
			   ->get();

        return response()->json($subcatsss);
    }
public function studentlistSendSms(){
    $self='student/list';
    if (\Auth::user()->user_role!=='1'){
        $get_perm=permission::permitted($self);

        if ($get_perm=='access denied'){
            return redirect('permission-error')->with([
                'message' =>'You do not have permission to view this page',
                'message_important'=>true
            ]);
        }
    }
    $accadmicyear=DB::table('academicyear')
	        // Branch ko comment me kiye tab hi total year show kiye hai.
			//->where('branch_code',Auth::user()->school_id)
			->orderBy('startyear','desc')
			->get();
	
    $course=DB::table('tb_course')
			->where('branch_code',Auth::user()->school_id)
			->orderBy('id','asc')
			->get();
	$select_class=DB::table('tb_course')
	        // ->join('tb_batch','tb_batch.course','=','tb_course.id')
			//->where('branch_code',Auth::user()->school_id)
			->orderBy('id','asc')
			->get();
    $batch=DB::table('tb_batch')
			->where('branch_code',Auth::user()->school_id)
			->orderBy('id','asc')
			->get();
	$batch_wise=DB::table('tb_batch')
			->where('branch_code',Auth::user()->school_id)
			->orderBy('id','asc')
			->get();
//print_r($accadmicyear);
    $studentss = DB::table('stu_admission')
            ->Leftjoin('tb_course', 'stu_admission.course', '=', 'tb_course.id')
            ->Leftjoin('tb_batch', 'stu_admission.batch', '=', 'tb_batch.id')
            ->join('stu_contact', 'stu_admission.reg_no', '=', 'stu_contact.reg_no')
            ->select('stu_admission.*','stu_contact.phone','stu_contact.father_phone','tb_course.course_name','tb_batch.batch_name','stu_contact.mother_name','stu_contact.father_name','stu_contact.permanent_address')
            ->where('stu_admission.branch_code',Auth::user()->school_id)
            ->where('stu_admission.acadmic_year',app_config('Session',Auth::user()->school_id))
           // ->orderBy('gender','desc')
            ->get();
			
				   
	$students_count = DB::table('stu_admission')
            ->Leftjoin('tb_course', 'stu_admission.course', '=', 'tb_course.id')
            ->Leftjoin('tb_batch', 'stu_admission.batch', '=', 'tb_batch.id')
            ->join('stu_contact', 'stu_admission.reg_no', '=', 'stu_contact.reg_no')
            ->select('stu_admission.*','stu_contact.phone','stu_contact.father_phone','tb_course.course_name','tb_batch.batch_name','stu_contact.mother_name','stu_contact.father_name','stu_contact.permanent_address')
            ->where('stu_admission.branch_code',Auth::user()->school_id)
            ->where('stu_admission.acadmic_year',app_config('Session',Auth::user()->school_id))
            ->orderBy('gender','desc')
            ->count();
	$total_count = DB::table('stu_admission')
            ->join('tb_course', 'tb_course.id', '=', 'stu_admission.course')
            ->count();
	$driver=DB::table('tb_driver')->get();
			
	$accadmicyearwise=Input::get('accadmicyearwise');
	$course=Input::get('category');
     $batch=Input::get('subcategory');
	 
	 $companies = DB::table('stu_admission')
      ->join('stu_contact', 'stu_admission.reg_no', '=', 'stu_contact.reg_no')
	    //->orderBy('batch', 'ASC')
		->where('stu_admission.accdmic_year', '=' , "$accadmicyearwise")
      ->where('stu_admission.course', '=' , "$course")
      ->where('batch', 'like' , '%'. $batch. '%')
	 
	  //->orwhere('batch', 'like' , '%'. $batch. '%')
      ->get();
	  $companies_count = DB::table('stu_admission')
      ->join('stu_contact', 'stu_admission.reg_no', '=', 'stu_contact.reg_no')
	    //->orderBy('batch', 'ASC')
		->where('stu_admission.accdmic_year', '=' , "$accadmicyearwise")
      ->where('stu_admission.course', '=' , "$course")
      ->where('batch', 'like' , '%'. $batch. '%')
	 
	  //->orwhere('batch', 'like' , '%'. $batch. '%')
      ->count();
	
    return view('students.student_send_sms',compact('accadmicyear','course','batch','studentss','students_count','companies','driver','select_class','batch_wise','total_count','companies_count'));
  }
  public function emplyeelistSendSms(){
    $self='student/list';
    if (\Auth::user()->user_role!=='1'){
        $get_perm=permission::permitted($self);

        if ($get_perm=='access denied'){
            return redirect('permission-error')->with([
                'message' =>'You do not have permission to view this page',
                'message_important'=>true
            ]);
        }
    }
    $accadmicyear=DB::table('academicyear')
			->where('branch_code',Auth::user()->school_id)
			->orderBy('startyear','desc')
			->get();
	
    $course=DB::table('tb_course')
			->where('branch_code',Auth::user()->school_id)
			->orderBy('id','asc')
			->get();
	$select_class=DB::table('tb_course')
	        // ->join('tb_batch','tb_batch.course','=','tb_course.id')
			//->where('branch_code',Auth::user()->school_id)
			->orderBy('id','asc')
			->get();
    $batch=DB::table('tb_batch')
			->where('branch_code',Auth::user()->school_id)
			->orderBy('id','asc')
			->get();
	$batch_wise=DB::table('tb_batch')
			->where('branch_code',Auth::user()->school_id)
			->orderBy('id','asc')
			->get();
//print_r($accadmicyear);
    $studentss = DB::table('stu_admission')
            ->Leftjoin('tb_course', 'stu_admission.course', '=', 'tb_course.id')
            ->Leftjoin('tb_batch', 'stu_admission.batch', '=', 'tb_batch.id')
            ->join('stu_contact', 'stu_admission.reg_no', '=', 'stu_contact.reg_no')
            ->select('stu_admission.*','stu_contact.phone','stu_contact.father_phone','tb_course.course_name','tb_batch.batch_name','stu_contact.mother_name','stu_contact.father_name','stu_contact.permanent_address')
            ->where('stu_admission.branch_code',Auth::user()->school_id)
            ->where('stu_admission.acadmic_year',app_config('Session',Auth::user()->school_id))
           // ->orderBy('gender','desc')
            ->get();
			
				   
	$students_count = DB::table('stu_admission')
            ->Leftjoin('tb_course', 'stu_admission.course', '=', 'tb_course.id')
            ->Leftjoin('tb_batch', 'stu_admission.batch', '=', 'tb_batch.id')
            ->join('stu_contact', 'stu_admission.reg_no', '=', 'stu_contact.reg_no')
            ->select('stu_admission.*','stu_contact.phone','stu_contact.father_phone','tb_course.course_name','tb_batch.batch_name','stu_contact.mother_name','stu_contact.father_name','stu_contact.permanent_address')
            ->where('stu_admission.branch_code',Auth::user()->school_id)
            ->where('stu_admission.acadmic_year',app_config('Session',Auth::user()->school_id))
            ->orderBy('gender','desc')
            ->count();
	$total_count = DB::table('stu_admission')
            ->join('tb_course', 'tb_course.id', '=', 'stu_admission.course')
            ->count();
	$driver=DB::table('tb_driver')->get();
			
	$course=Input::get('category');
     $batch=Input::get('subcategory');
	 
	 $companies = DB::table('stu_admission')
      ->join('stu_contact', 'stu_admission.reg_no', '=', 'stu_contact.reg_no')
	    //->orderBy('batch', 'ASC')
      ->where('stu_admission.course', '=' , "$course")
      ->where('batch', 'like' , '%'. $batch. '%')
	 
	  //->orwhere('batch', 'like' , '%'. $batch. '%')
      ->get();
	   $companies = DB::table('emp_details')
      ->join('emp_contact', 'emp_details.user_id', '=', 'emp_contact.user_id')
      ->where('emp_details.designation', '=' , "$course")
      //->where('batch', 'like' , '%'. $batch. '%')
      ->get();
	  $companies_emp_count = DB::table('emp_details')
      ->join('emp_contact', 'emp_details.user_id', '=', 'emp_contact.user_id')
      ->where('emp_details.designation', '=' , "$course")
      //->where('batch', 'like' , '%'. $batch. '%')
      ->count();
	  $deg=DB::table('tb_degination')->get();
	
    return view('students.emplyee_send_sms',compact('accadmicyear','course','batch','studentss','students_count','companies','driver','select_class','batch_wise','total_count','deg','companies_emp_count'));
  }
  public function employeelistSendSms12(){
    $self='employee/postsearch/send';
    if (\Auth::user()->user_role!=='1'){
        $get_perm=permission::permitted($self);

        if ($get_perm=='access denied'){
            return redirect('permission-error')->with([
                'message' => 'You do not have permission to view this page',
                'message_important'=>true
            ]);
        }
    }
    $accadmicyear=DB::table('academicyear')
			->where('branch_code',Auth::user()->school_id)
			->orderBy('startyear','desc')
			->get();
	
    $course=DB::table('tb_course')
			->where('branch_code',Auth::user()->school_id)
			->orderBy('id','asc')
			->get();
	$select_class=DB::table('tb_course')
	        // ->join('tb_batch','tb_batch.course','=','tb_course.id')
			//->where('branch_code',Auth::user()->school_id)
			->orderBy('id','asc')
			->get();
    $batch=DB::table('tb_batch')
			->where('branch_code',Auth::user()->school_id)
			->orderBy('id','asc')
			->get();
	$batch_wise=DB::table('tb_batch')
			->where('branch_code',Auth::user()->school_id)
			->orderBy('id','asc')
			->get();
//print_r($accadmicyear);
    $studentss = DB::table('stu_admission')
            ->Leftjoin('tb_course', 'stu_admission.course', '=', 'tb_course.id')
            ->Leftjoin('tb_batch', 'stu_admission.batch', '=', 'tb_batch.id')
            ->join('stu_contact', 'stu_admission.reg_no', '=', 'stu_contact.reg_no')
            ->select('stu_admission.*','stu_contact.phone','stu_contact.father_phone','tb_course.course_name','tb_batch.batch_name')
            ->where('stu_admission.branch_code',Auth::user()->school_id)
            ->where('stu_admission.acadmic_year',app_config('Session',Auth::user()->school_id))
           // ->orderBy('gender','desc')
            ->get();
			
				   
	$students_count = DB::table('stu_admission')
            ->Leftjoin('tb_course', 'stu_admission.course', '=', 'tb_course.id')
            ->Leftjoin('tb_batch', 'stu_admission.batch', '=', 'tb_batch.id')
            ->join('stu_contact', 'stu_admission.reg_no', '=', 'stu_contact.reg_no')
            ->select('stu_admission.*','stu_contact.phone','stu_contact.father_phone','tb_course.course_name','tb_batch.batch_name')
            ->where('stu_admission.branch_code',Auth::user()->school_id)
            ->where('stu_admission.acadmic_year',app_config('Session',Auth::user()->school_id))
            ->orderBy('gender','desc')
            ->count();
	$total_count = DB::table('stu_admission')
            ->join('tb_course', 'tb_course.id', '=', 'stu_admission.course')
            ->count();
	$driver=DB::table('tb_driver')->get();
			
	$course=Input::get('category');
     $batch=Input::get('subcategory');
	 
	 $companies = DB::table('emp_details')
      ->join('emp_contact', 'emp_details.user_id', '=', 'emp_contact.user_id')
      ->where('emp_details.designation', '=' , "$course")
      //->where('batch', 'like' , '%'. $batch. '%')
      ->get();
	  $companies_emp_count = DB::table('emp_details')
      ->join('emp_contact', 'emp_details.user_id', '=', 'emp_contact.user_id')
      ->where('emp_details.designation', '=' , "$course")
      //->where('batch', 'like' , '%'. $batch. '%')
      ->count();
	  $deg=DB::table('tb_degination')->get();
	
	
	
    return view('students.emplyee_send_sms',compact('accadmicyear','course','batch','studentss','students_count','companies','driver','select_class','batch_wise','total_count','deg','companies_emp_count'));
  }
   public function batchlistwise(Request $request){
   $eid = $request->eid;
   $batch = DB::table('tb_batch')->select('id','batch_name')->where('branch_code',Auth::user()->school_id)->where('course',$eid)->get();
   //$batch=DB::table('tb_batch')->where('course',$eid)->orderBy('id','desc')->get();
  $cart = array();
   foreach($batch as $batch){
    array_push($cart,$batch);
   }
    echo json_encode($cart);
  }
  public function stu_send_sms_insert(Request $request){
/*student_sms   
   $Mobile = Input::get('vehicle');
	$sms = Input::get('sms');
	$status="successfull";

	DB::table('send_sms')
		->insert([
		'mobile'=>$Mobile,
		'message'=>$sms
		]);
	//$msg1='dear';
	*/
	
	
	$data = $request->all();
	   $fltno= $request['mobile'];
	   $stu_name= $request['stu_name'];
	    $roll_no= $request['roll_no'];
	    $reg_no= $request['reg_no'];
	    $accdmic_year= $request['accdmic_year'];
	    $course= $request['course'];
	    $status= $request['status'];
	   $sms= $request['sms'];
	   // print_r ($fltno);
	 $d=sizeof($fltno);
	 //echo $fltno[0];
	//print($d);
	for($i=0;$i<$d;$i++){
		$check=DB::table('student_sms')
		->insert([
			'mobile'=>$fltno[$i],
			'stu_name'=>$stu_name[$i],
			'roll_no'=>$roll_no[$i],
			'reg_no'=>$reg_no[$i],
			'accdmic_year'=>$accdmic_year[$i],
			'course'=>$course[$i],
			'status'=>$status[$i],
			'message'=>$sms
		]);
	}
	
	$url="sms/s.php?sendSMS=true&message=".$sms."&mobileNos=".$Mobile;
			return redirect($url)->with([
		'message' => 'Massage Send Successfully.'
	  ]);
		//return redirect('student/list/send/sms');
}
public function particular_send_sms_insert(Request $request){
  /*
   $Mobile = Input::get('mobile');
	$sms = Input::get('sms');
	$status="successfull";

	$check=DB::table('particular_sms')
		->insert([
		'mobile'=>$Mobile,
		'message'=>$sms,
		'status'=>$status
		]);
	//$msg1='dear';
	
	echo"$check";
	die();
	*/

	$data = $request->all();
	   $Mobile= $request['mobile'];
	   $sms=$request['sms'];
	    $status= $request['status'];
	   print_r($Mobile);
	   $Input = explode(",",$Mobile);
	   print_r($Input);
	  
	   //print_r($data);
	   
	   // print_r ($fltno);
	 $d=sizeof($Input);
	
	for($i=0;$i<$d;$i++){
		
		$check=DB::table('particular_sms')
						->insert([
							'mobile'=>$Input[$i],
							'status'=>$status,
							'message'=>$sms
						]);
		
	}
	
	$url="sms/particular.php?sendSMS=true&message=".$sms."&mobileNos=".$Mobile;
			return redirect($url)->with([
		'message' => 'Massage Send Successfully.'
	  ]);
		//return redirect('student/list/send/sms');
}
public function emp_send_sms_insert(Request $request){
   /* sahi hai ye code, $Mobile = Input::get('vehicle');
	$sms = Input::get('sms');

	DB::table('send_sms')
		->insert([
			'mobile'=>$Mobile,
			'message'=>$sms
		]); till */
	//$msg1='dear';
	//$status = Input::get('status');
	 //$input = Input::all();
	 $data = $request->all();
	   $fltno= $request['vehicle'];
	   $stu_id= $request['stu_id'];
	    $designation= $request['designation'];
	    $fname= $request['fname'];
	    $mname= $request['mname'];
	    $lname= $request['lname'];
		//$name=$fname.$mname.$lname;
		
	    $status= $request['status'];
	   $sms= $request['sms'];
       // print_r ($fltno);
	   $d=sizeof($fltno);
	   //echo $fltno[0];
	   //print($d);
	   for($i=0;$i<$d;$i++){
		   $name=$fname[$i]." ".$mname[$i]." ".$lname[$i];
		 
		$check=DB::table('send_sms')
		->insert([
			'mobile'=>$fltno[$i],
			'stu_id'=>$stu_id[$i],
			'designation'=>$designation[$i],
			'fname'=>$name,
			//'mname'=>$mname[$i],
			//'lname'=>$lname[$i],
			'status'=>$status[$i],
			'message'=>$sms
		]);
	}
	
	$url="sms/emp.php?sendSMS=true&message=".$sms."&mobileNos=".$Mobile;
			return redirect($url)->with([
		'message' => 'Massage Send Successfully.'
	  ]);
		//return redirect('student/list/send/sms');
}
public function studentsearchsir(Request $request)
{
     $course=Input::get('category');
     $batch=Input::get('subcategory');
	 
	 $companies = DB::table('stu_admission')
      //->join('locationinfo', 'locationinfo.BusinessName', '=', 'businesslist.B_list_Id')
	    //->orderBy('seo_ranking', 'ASC')
      ->where('stu_admission.course', '=' , "$course")
      ->where('batch', 'like' , '%'. $batch. '%')
	  //->orwhere('Company_Name', 'like' , '%'. $company. '%')
      ->get();
	 
	 return view('students.stu_sms_sir',compact('companies'));
	 
}
public function search_days_wise(Request $request)
	{
		$from = Input::get ( 'from' );
		$to = Input::get ( 'to' );
			if($from != ""){
				$user = DB::table('stu_admission')
				->join('sub_category','sub_category.cat_name','=','locationinfo.category_id')
				->orWhere ( 'sub_cat_name', 'LIKE', '%' . $q . '%' )
				->get ();
				
		
        $wordCount = $user->count();
		if (count ( $user ) > 0)
			return view ('students.dayswise',compact('user','wordCount'))->withDetails ( $user )->withQuery ( $from,$to );
		else
			return view( 'students.dayswise',compact('user','wordCount'))->withMessage ( 'No Details found. Try to search again !' );
	      }
	
      }
// End Student list check End

  public function studentlist(){
    $self='student/list';
    if (\Auth::user()->user_role!=='1'){
        $get_perm=permission::permitted($self);

        if ($get_perm=='access denied'){
            return redirect('permission-error')->with([
                'message' => 'You do not have permission to view this page',
                'message_important'=>true
            ]);
        }
    } 
	 // echo app_config('Session',Auth::user()->school_id);exit;
    $accadmicyear=DB::table('academicyear')->where('branch_code',Auth::user()->school_id)->orderBy('startyear','desc')->get();
    $course=DB::table('tb_course')->where('branch_code',Auth::user()->school_id)->orderBy('id','asc')->get();
    $batch=DB::table('tb_batch')->where('branch_code',Auth::user()->school_id)->orderBy('id','asc')->get();
//print_r($accadmicyear);
    $students = DB::table('stu_admission')
            ->Leftjoin('tb_course', 'stu_admission.course', '=', 'tb_course.id')
            ->Leftjoin('tb_batch', 'stu_admission.batch', '=', 'tb_batch.id')
            ->join('stu_contact', 'stu_admission.reg_no', '=', 'stu_contact.reg_no')
            ->select('stu_admission.*','stu_contact.phone','stu_contact.father_phone','tb_course.course_name','tb_batch.batch_name','stu_contact.mother_name','stu_contact.father_name','stu_contact.permanent_address')
            ->where('stu_admission.branch_code',Auth::user()->school_id)
            ->where('stu_admission.accdmic_year',app_config('Session',Auth::user()->school_id))
		//	->where('stu_admission.reg_no','21/87')
          //  ->orderBy('gender','desc')
            ->get();
    return view('students.student-list',compact('accadmicyear','course','batch','students'));
  }
public function Deletestudent(Request $request,$id){
    $self='student/delete';
    if (\Auth::user()->user_role!=='1'){
        $get_perm=permission::permitted($self);

        if ($get_perm=='access denied'){
            return redirect('permission-error')->with([
                'message' => 'You do not have permission to view this page',
                'message_important'=>true
            ]);
        }
    }
  if($id!=null){
     DB::table('stu_admission')->where('reg_no','=',Crypt::decrypt($id))->where('branch_code',Auth::user()->school_id)->delete();
     DB::table('office_student_reg')->where('reg_no','=',Crypt::decrypt($id))->where('branch_code',Auth::user()->school_id)->delete();
     DB::table('stu_contact')->where('reg_no','=',Crypt::decrypt($id))->delete();
      return redirect('student/list')->with([
          'message' => "Student Details Deleted Successfully."
      ]);
  }else{
      return redirect('student/list')->with([
          'message' => "Student Details Not Found",
          'message_important' => true
      ]);
  }
  }
public function viewstudent(Request $request,$id){
  $self='student/view';
  if (\Auth::user()->user_role!=='1'){
      $get_perm=permission::permitted($self);

      if ($get_perm=='access denied'){
          return redirect('permission-error')->with([
              'message' => 'You do not have permission to view this page',
              'message_important'=>true
          ]);
      }
  }
  $accadmicyears=DB::table('academicyear')->where('branch_code',Auth::user()->school_id)->orderBy('startyear','desc')->get();
  $course=DB::table('tb_course')->where('branch_code',Auth::user()->school_id)->orderBy('id','desc')->get();
  $category=DB::table('tb_studentcategory')->where('branch_code',Auth::user()->school_id)->orderBy('id','desc')->get();
  $batch=DB::table('tb_batch')->where('branch_code',Auth::user()->school_id)->orderBy('id','desc')->get();
  $fees=DB::table('fee_subcategory')->where('branch_code',Auth::user()->school_id)->orderBy('id','desc')->get();
  $students=DB::table('stu_admission')
            ->join('stu_contact', 'stu_admission.reg_no', '=', 'stu_contact.reg_no')
            ->join('tb_batch', 'stu_admission.batch', '=', 'tb_batch.id')
            ->select('stu_admission.*', 'stu_contact.*','tb_batch.batch_name')
            ->where('stu_admission.branch_code',Auth::user()->school_id)
            ->where('stu_admission.reg_no',Crypt::decrypt($id))->orderBy('stu_admission.id', 'desc')->limit(1)->get();
//print_r(Crypt::decrypt($id));
  return view('students.edit-student',compact('accadmicyears','course','batch','fees','category','students'));
}
public function updatestudent(Request $request){
  $self='student/update';
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
    'accdmic_year'=>'required',

    'joining_date'=>'required',
    'course'=>'required',
    'batch'=>'required',
    'roll_no'=>'required',
    'fname'=>'required',
    'present_address'=>'required',
    'father_name'=>'required',
          ]);
  $accdmic_year=Input::get('accdmic_year');
  $reg_no=Input::get('reg_no');
  $joining_date=Input::get('joining_date');
  $course=Input::get('course');
  $batch=Input::get('batch');
  $roll_no=Input::get('roll_no');
  $fname=Input::get('fname');
  $dob=Input::get('dob');
  $gender=Input::get('gender');
  $blood_group=Input::get('blood_group');
  $birth_place=Input::get('birth_place');
  $nationaliy=Input::get('nationaliy');
  $category=Input::get('category');
  $religion=Input::get('religion');
  $aadhar_no=Input::get('aadhar_no');
  $permanent_address=Input::get('permanent_address');
  $present_address=Input::get('present_address');
  $city=Input::get('city');
  $pin=Input::get('pin');
  $country=Input::get('country');
  $state=Input::get('state');
  $phone=Input::get('phone');
  $email=Input::get('email');
  $father_name=Input::get('father_name');
  $mother_name=Input::get('mother_name');
  $father_job=Input::get('father_job');
  $father_phone=Input::get('father_phone');
  $mother_phone=Input::get('mother_phone');
  $father_aadhar=Input::get('father_aadhar');
  $prev_school=Input::get('prev_school');
  $prev_school_address=Input::get('prev_school_address');
  $prev_qualification=Input::get('prev_qualification');
  $created_date = date('d-m-Y H:i:s');
  DB::table('stu_admission')->where('branch_code',Auth::user()->school_id)->where('reg_no','=',$reg_no)->update(['accdmic_year'=>$accdmic_year,'joining_date'=>$joining_date,'course'=>$course,'batch'=>$batch,'roll_no'=>$roll_no,
  'stu_name'=>$fname,'dob'=>$dob,'gender'=>$gender,'blood_group'=>$blood_group,'birth_place'=>$birth_place,
  'nationaliy'=>$nationaliy,'category'=>$category,'religion'=>$religion,'aadhar_no'=>$aadhar_no,'prev_school'=>$prev_school,'prev_school_address'=>$prev_school_address,'prev_qualification'=>$prev_qualification,'branch_code'=>Auth::user()->school_id,'created_date'=>$created_date]);

  DB::table('stu_contact')->where('reg_no','=',$reg_no)->update(['reg_no'=>$reg_no,'roll_no'=>$roll_no,
  'permanent_address'=>$permanent_address,'present_address'=>$present_address,'city'=>$city,'pin'=>$pin,'country'=>$country,'state'=>$state,'phone'=>$phone,
  'email'=>$email,'father_name'=>$father_name,'mother_name'=>$mother_name,'father_job'=>$father_job,'father_phone'=>$father_phone,'mother_phone'=>$mother_phone,'father_aadhar'=>$father_aadhar]);

  DB::table('office_student_reg')->where('branch_code',Auth::user()->school_id)->where('reg_no','=',$reg_no)->update(['reg_no'=>$reg_no,'accdmic_year'=>$accdmic_year,'joining_date'=>$joining_date,'course'=>$course,'batch'=>$batch,'roll_no'=>$roll_no,'branch_code'=>Auth::user()->school_id,'created_date'=>$created_date]);
   
	$cnt=DB::table('users')->where('username' , $father_phone)->count();
	//echo $cnt;exit;
	if($cnt=="0"){
  $plogin=DB::table('users')->insert(['name'=>$father_name,'username'=>$father_phone,'email'=>$email,'mobile' => $father_phone,'password'=>bcrypt($father_phone),'school_name'=>Auth::user()->school_name,'school_id'=>Auth::user()->school_id,'user_role'=>'P']);
}else{
  DB::table('users')->where('username',$father_phone)->update(['name'=>$father_name,'username' => $father_phone,'emp_code' => $father_phone,'mobile' => $father_phone]);
}

	
	return redirect('student/list')->with([
              'message' => 'Student Details Updated Successfully.'
          ]);
}
public function studentsearch(Request $request){
     $course=Input::get('course');
     $c=$course;
     $batch=Input::get('batch');
     $b=$batch;
     $accadmicyear=Input::get('accadmicyear');
     $accadmic=$accadmicyear;
     $accadmicyear=DB::table('academicyear')->where('branch_code',Auth::user()->school_id)->orderBy('startyear','desc')->get();
     $course=DB::table('tb_course')->where('branch_code',Auth::user()->school_id)->orderBy('id','asc')->get();
     $batch=DB::table('tb_batch')->where('branch_code',Auth::user()->school_id)->orderBy('id','asc')->get();

 if($c !="0" && $b=="0" && $accadmic=="0" ){
     $students = DB::table('stu_admission')
             ->join('tb_course', 'stu_admission.course', '=', 'tb_course.id')
             ->join('tb_batch', 'stu_admission.batch', '=', 'tb_batch.id')
             ->join('stu_contact', 'stu_admission.reg_no', '=', 'stu_contact.reg_no')
             ->select('stu_admission.*','stu_contact.phone','stu_contact.father_phone','tb_course.course_name','tb_batch.batch_name','stu_contact.mother_name','stu_contact.father_name','stu_contact.permanent_address')             ->where('stu_admission.branch_code',Auth::user()->school_id)
             ->where('stu_admission.course','=',$c)
             ->orderBy('gender','desc')
             ->get();

             return view('students.student-list',compact('accadmicyear','course','batch','students'));
   }
  if($b != "0" && $c != "0" && $accadmic == "0"){
       $students = DB::table('stu_admission')
               ->join('tb_course', 'stu_admission.course', '=', 'tb_course.id')
               ->join('tb_batch', 'stu_admission.batch', '=', 'tb_batch.id')
               ->join('stu_contact', 'stu_admission.reg_no', '=', 'stu_contact.reg_no')
               ->select('stu_admission.*','stu_contact.phone','stu_contact.father_phone','tb_course.course_name','tb_batch.batch_name','stu_contact.mother_name','stu_contact.father_name','stu_contact.permanent_address')     ->where('stu_admission.branch_code',Auth::user()->school_id)
               ->where('stu_admission.course','=',$c)
               ->where('stu_admission.batch',$b)
			   ->orderBy('gender','desc')
               ->get();

               return view('students.student-list',compact('accadmicyear','course','batch','students'));
     }
     if($c == "0" && $b == "0" && $accadmic !="0"){
         $students = DB::table('stu_admission')
                 ->join('tb_course', 'stu_admission.course', '=', 'tb_course.id')
                 ->join('tb_batch', 'stu_admission.batch', '=', 'tb_batch.id')
                 ->join('stu_contact', 'stu_admission.reg_no', '=', 'stu_contact.reg_no')
                 ->select('stu_admission.*','stu_contact.phone','stu_contact.father_phone','tb_course.course_name','tb_batch.batch_name','stu_contact.mother_name','stu_contact.father_name','stu_contact.permanent_address')     ->where('stu_admission.branch_code',Auth::user()->school_id)
            ->where('stu_admission.branch_code',Auth::user()->school_id)
                 ->where('stu_admission.accdmic_year',$accadmic)
			     ->orderBy('gender','desc')
                 ->get();

                 return view('students.student-list',compact('accadmicyear','course','batch','students'));
       }
       if($course !="0" && $batch !="0" && $accadmic !="0"){ 
           $students = DB::table('stu_admission')
                   ->join('tb_course', 'stu_admission.course', '=', 'tb_course.id')
                   ->join('tb_batch', 'stu_admission.batch', '=', 'tb_batch.id')
                   ->join('stu_contact', 'stu_admission.reg_no', '=', 'stu_contact.reg_no')
                   ->select('stu_admission.*','stu_contact.phone','stu_contact.father_phone','tb_course.course_name','tb_batch.batch_name','stu_contact.mother_name','stu_contact.father_name','stu_contact.permanent_address')     ->where('stu_admission.branch_code',Auth::user()->school_id)
                   ->where('stu_admission.branch_code',Auth::user()->school_id)
                   ->where('stu_admission.accdmic_year',$accadmic)
                   ->where('stu_admission.batch',$b)
                   ->where('stu_admission.course',$c)
			       ->orderBy('gender','desc')
                   ->get(); 
		 //  echo $b."|".$c."|".$accadmic;
		   //print_r($students);exit;

                   return view('students.student-list',compact('accadmicyear','course','batch','students'));
         }
         if($c =="0" && $b =="0" && $accadmic =="0"){
           $students = DB::table('stu_admission')
                   ->join('tb_course', 'stu_admission.course', '=', 'tb_course.id')
                   ->join('tb_batch', 'stu_admission.batch', '=', 'tb_batch.id')
                   ->join('stu_contact', 'stu_admission.reg_no', '=', 'stu_contact.reg_no')
                   ->select('stu_admission.*','stu_contact.phone','stu_contact.father_phone','tb_course.course_name','tb_batch.batch_name','stu_contact.mother_name','stu_contact.father_name','stu_contact.permanent_address')     ->where('stu_admission.branch_code',Auth::user()->school_id)
                   ->where('stu_admission.branch_code',Auth::user()->school_id)
			             ->orderBy('gender','desc')
                   ->get();

                   return view('students.student-list',compact('accadmicyear','course','batch','students'));
         }
        //  echo "pre";
        //  print_r($students);
        //  exit ();
        //  return view('students.student-list',compact('accadmicyear','course','batch','students'));
}
public function transportallocation(){
  $self='student/transport';
  if (\Auth::user()->user_role!=='1'){
      $get_perm=permission::permitted($self);

      if ($get_perm=='access denied'){
          return redirect('permission-error')->with([
              'message' => 'You do not have permission to view this page',
              'message_important'=>true
          ]);
      }
  }
  $accadmicyear = DB::table('academicyear')
  ->where('branch_code',Auth::user()->school_id)->orderBy('startyear','desc')
  ->get();
  $students=DB::table('stu_admission')->where('branch_code',Auth::user()->school_id)->orderBy('id','desc')->get();
  $route=DB::table('tb_route')->where('branch_code',Auth::user()->school_id)->orderBy('id','desc')->get();

  return view('students.transport-allocation',compact('students','route','accadmicyear'));
}
public function stuinfo(request $request){
  $eid = Crypt::decrypt($request->eid);
  $acadmic_year =$request->acadmic_year;
  $studentss = DB::table('stu_admission')
            ->join('stu_contact', 'stu_admission.reg_no', '=', 'stu_contact.reg_no')
            ->join('tb_batch', 'stu_admission.batch', '=', 'tb_batch.id')
            ->join('tb_course', 'stu_admission.course', '=', 'tb_course.id')
            ->select('stu_admission.*', 'stu_contact.*','tb_batch.batch_name','tb_course.course_name')
            ->where('stu_admission.branch_code',Auth::user()->school_id)
            ->where('stu_admission.accdmic_year',$acadmic_year)
            ->where('stu_admission.reg_no',$eid)
            ->get();
        //   print_r($studentss);exit;
  $cnt=DB::table('transport_allocation')->where('branch_code',Auth::user()->school_id)
  ->where('reg_no',$eid)->count();
            $currentyear= date("Y");
  $feemonths=$users = DB::table('fee_collection')->select('month')
  ->where('stu_reg_no',$eid)
  ->where('year',$currentyear)
  ->where('receipt_status','1')
  ->where('acadmic_year',$acadmic_year)
  ->where('branch_code',Auth::user()->school_id)
  ->get();
  foreach($studentss as $studentss){
    $fname=$studentss->stu_name;
    $name=$fname;
    $batch=$studentss->batch_name;
    $batch_code=$studentss->batch;
    $course_name=$studentss->course_name;
    $course_code=$studentss->course;
    $father=$studentss->father_name;
    $contact=$studentss->father_phone;
    $address=$studentss->present_address;
  }
  //  print_r($studentss);
  echo $eid."|".$name."|".$batch."|".$course_name."|".$father."|".$contact."|".$address."|".$feemonths."|".$course_code."|".$cnt."|".$batch_code;
}
  public function xyz(Request $request){
  $eid = $request->eid;
  $destinations = DB::table('tb_destination')->select('id','pickanddrop')
  ->where('branch_code',Auth::user()->school_id)->groupBy('pickanddrop')
  ->where('route_code',$eid)->get();
  $dest = array();
  foreach($destinations as $destinations){
   array_push($dest,$destinations);
  }
   echo json_encode($dest);
}

public function studentAttendance(){
  if(Auth::user()->id==1){
    $course=DB::table('tb_course') ->where('branch_code',Auth::user()->school_id)->get();
    $courses=DB::table('tb_course')->where('branch_code',Auth::user()->school_id)->get();
  }else{
    $course=DB::table('tb_course')
    ->join('class_teacher_allocation','class_teacher_allocation.course','tb_course.id')
    ->where('class_teacher_allocation.branch_code',Auth::user()->school_id)
    ->where('class_teacher_allocation.teacher_id',Auth::user()->emp_code)->get();

    $courses=DB::table('tb_course')
    ->join('class_teacher_allocation','class_teacher_allocation.course','tb_course.id')
    ->where('class_teacher_allocation.branch_code',Auth::user()->school_id)
    ->where('class_teacher_allocation.teacher_id',Auth::user()->emp_code)->get();

  }

   $accadmicyear = DB::table('academicyear')
   ->where('branch_code',Auth::user()->school_id)->orderBy('startyear','desc')
   ->get();
       return view('students.student-attendance',compact('course','courses','accadmicyear'));
}

public function savestudentAttendance(Request $request){
   $date = $request->dates;
   $dates = strtotime($date);
   $day= date('d',$dates);
   $month= date('F',$dates);
  $course = $request->course;
  $batch = $request->batch;
  $subject_name = $request->subject_name;
  $subject_id = $request->subject;
  $month_number=date('m',$dates);
  //  $students= $request->studentids;
    $stu_id= $request->stu_id;

    $list=json_decode($request->stu_id);

    //$month = date('F', strtotime($date));
      try {
    foreach ($list as $list) {
      // code...

     $cntatt= DB::table('stu_attendance')->where('reg_no',$list->reg_no)->where('att_date',$date)->count();
      if($cntatt==0){
      $savedata=DB::table('stu_attendance')->insert(['reg_no'=>$list->reg_no,'roll_no'=>$list->roll,'name'=>$list->name,'att_date'=>$date
      ,'day'=>$day,'course'=>$course,'batch'=>$batch,'subject_id'=>$subject_id,'subject_name'=>$subject_name,'month'=>$month,'month_number'=>$month_number
      ,'status'=>$list->statuss,'remark'=>$list->remark,'accadmicyear'=>app_config('Session',Auth::user()->school_id),'branch_code'=>Auth::user()->school_id]);
      if(!empty($savedata)){
        $msg="1";
      }else{
        $msg="0";
      }

    }else{
      DB::table('stu_attendance')
            ->where('reg_no',$list->reg_no)->where('att_date',$date)
            ->update(['status'=>$list->statuss,'remark'=>$list->remark]);
            $msg="1";
    }

  }
  echo $msg;
  }catch(\Illuminate\Database\QueryException $ex){
    echo "3";
 // echo  $ex->getMessage();
}

}

public function getstudent(Request $request){
   $batch =$request->batch;
  $course =$request->course;
  $date =$request->date;
 /* $stu_details = DB::table('stu_admission')
  ->where('branch_code',Auth::user()->school_id)
  ->where('course',$course)
  ->where('batch',$batch)->get();*/


$branch_code=Auth::user()->school_id;
$accdmic_year=app_config('Session',Auth::user()->school_id);
$stu_details = DB::select("SELECT a.*,c.stu_name,
(SELECT b.`status` FROM stu_attendance b WHERE b.reg_no=a.reg_no AND b.course=a.course and b.batch=a.batch AND b.att_date='$date') AS att_status,
(SELECT d.remark FROM stu_attendance d WHERE d.reg_no=a.reg_no AND d.course=a.course and d.batch=a.batch AND d.att_date='$date') AS att_remark
FROM office_student_reg a
INNER JOIN stu_admission c ON a.reg_no=c.reg_no
WHERE a.course='$course' AND a.batch='$batch'AND a.accdmic_year='$accdmic_year' AND a.branch_code='$branch_code'");


//print_r($stu_details); exit;


  $subjects = DB::table('assign_subject')
              ->join('tb_subject', 'assign_subject.subject', '=', 'tb_subject.id')
              ->select('assign_subject.*', 'tb_subject.subject_name')
                ->where('assign_subject.course', $course)
                ->where('assign_subject.batch', $batch)
                ->where('assign_subject.acadmic_year', app_config('Session',Auth::user()->school_id))
                ->where('assign_subject.status', '1')
                ->where('assign_subject.branch_id', Auth::user()->school_id)
              ->get();
  echo json_encode($stu_details)."|".$subjects;

}
public function allocatetransport(Request $request ){
  $self='transport/transport/allocate';
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
      'stu_name'=>'required',
      'reg_no'=>'required',
      'course'=>'required',
      'batch'=>'required',
      'parent_name'=>'required',
      'route'=>'required',
      'destination'=>'required',
      'start_date'=>'required',
      'end_date'=>'required',
      'contact_no'=>'required']);
  $stu_name=Input::get('stu_name');
  $reg_no=Input::get('reg_no');
  $course=Input::get('course');
  $batch=Input::get('batch');
  $parent_name=Input::get('parent_name');
  $contact_no=Input::get('contact_no');
  $route=Input::get('route');
  $destination=Input::get('destination');
  $start_date=Input::get('start_date');
  $end_date=Input::get('end_date');
  $created_date = date('d-m-Y');
    try {
$savedata= DB::table('transport_allocation')->insert(['reg_no'=>$reg_no,'stu_name'=>$stu_name,'course'=>$course,
'batch'=>$batch,'parent_name'=>$parent_name,'contact_no'=>$contact_no,'route'=>$route,'destination'=>$destination,'amt'=>'','start_date'=>$start_date,'end_date'=>$end_date,'acadmic_year'=>app_config('Session',Auth::user()->school_id),'created_date'=>$created_date,'branch_code'=>Auth::user()->school_id]);
  if(!empty($savedata)){
    $amount=DB::table('tb_destination')->where('pickanddrop',$destination)->where('route_code',$route)->limit(1)->get();
    foreach ($amount as $amount) {
        $ax=$amount->amount;
        DB::table('transport_allocation')
                ->where('reg_no', $reg_no)
                ->update(['amt' => $ax]);
    }
  return redirect('student/transport')->with([
       'message' => 'Tranport Allocated for '.$stu_name. ' Successfully'
   ]);
 }else{
   return redirect('student/transport')->with([
        'message' => 'Unable to Allocate Tranport for '.$stu_name. '',
        'message_important'=>true
    ]);
 }
  }catch(\Illuminate\Database\QueryException $ex){
    return redirect('student/transport')->with([
         'message' => 'Someting Went Worng Please Contact Technical Team : '.$ex->getMessage(). '',
         'message_important'=>true
     ]);

 }
}

  public function studentAttendancereport(Request $request){
    $month=$request->month;
    $no_of_days= cal_days_in_month(CAL_GREGORIAN, $month, 2020);
    $course=$request->course;
    $batch=$request->batch;
  /*  $attendancelist=DB::table('stu_attendance')
    ->where('course',$course)
    ->where('batch',$batch)
    ->where('month',$month)
    ->where('branch_code',Auth::user()->school_id)->orderBy('reg_no','asc')->get(); */

    $attendance = DB::select("SELECT a.reg_no,COUNT(a.day) AS total_class,a.roll_no,a.name,a.month, GROUP_CONCAT(CONCAT_WS('-',a.day,a.`status`)) AS attendance
    FROM stu_attendance a
    WHERE a.course='2' AND a.batch ='37' AND a.month_number='4' AND a.accadmicyear='2020-2021'
    GROUP BY a.reg_no
    ORDER BY a.reg_no DESC");


    return view('students.stu_attendance_report_view',compact('no_of_days','month','attendance'));
  //  echo $attendancelist;
  }
  public function Attendancereport(){

    $courses=DB::table('tb_course')->where('branch_code',Auth::user()->school_id)->get();
    $accadmicyear = DB::table('academicyear')
    ->where('branch_code',Auth::user()->school_id)->orderBy('startyear','desc')
    ->get();
    $student=DB::table('stu_admission')->get();
    $acadmic_year="";
    $students="";
   $attendance = DB::select("SELECT a.reg_no,a.roll_no,a.name,b.course_name AS class,c.batch_name AS section ,a.month, COUNT(a.`status`) AS totalcls,
   SUM(IF(a.`status`='P','1','0')) AS present, SUM(IF(a.`status`='A','1','0')) AS absent
    FROM stu_attendance a
    INNER JOIN  tb_course b ON a.course=b.id
    INNER JOIN tb_batch c ON a.batch=c.id
    WHERE a.reg_no='$students' AND a.accadmicyear='$acadmic_year'
    GROUP BY a.reg_no,a.month_number");

    return view('students.attendance-report',compact('attendance','courses','accadmicyear','student'));
  }

  function getAttendancereport(Request $request){
    $student_reg=$request->student;
    $acadmic_year=$request->acadmic_year;
    $courses=DB::table('tb_course')->where('branch_code',Auth::user()->school_id)->get();
    $accadmicyear = DB::table('academicyear')
    ->where('branch_code',Auth::user()->school_id)->orderBy('startyear','desc')
    ->get();
    $student=DB::table('stu_admission')->get();
  //  DB::enableQueryLog();
    $attendance = DB::select("SELECT a.reg_no,a.roll_no,a.name,b.course_name AS class,c.batch_name AS section ,
      a.month, COUNT(a.`status`) AS totalcls, SUM(IF(a.`status`='P','1','0')) AS present, SUM(IF(a.`status`='A','1','0')) AS absent
    FROM stu_attendance a
    INNER JOIN  tb_course b ON a.course=b.id
    INNER JOIN tb_batch c ON a.batch=c.id
    WHERE a.reg_no='$student_reg' AND a.accadmicyear='$acadmic_year'
    GROUP BY a.reg_no,a.month_number");

    return view('students.attendance-report',compact('courses','accadmicyear','student','attendance'));
  }

  public function postAttendancereport(Request $request){
    $course=$request->course;
    $batch=$request->batch;
    $date=$request->date;
    $accadmic=$request->accadmicyear;

    $attendancelist=DB::table('stu_attendance')
    ->where('course',$course)
    ->where('batch',$batch)
    ->where('att_date',$date)
    ->where('accadmicyear',$accadmic)
    ->where('branch_code',Auth::user()->school_id)->orderBy('reg_no','asc')->get();
    echo $attendancelist;
    echo"helo";
  }

  public function roll_section(Request $request)
  {

        $courses=DB::table('tb_course')->where('branch_code',Auth::user()->school_id)->get();
        $accadmicyear = DB::table('academicyear')
        ->where('branch_code',Auth::user()->school_id)
        ->get();
            return view('students.roll_section_assign',compact('courses','accadmicyear'));
  }

  public  function studenlist(Request $request)
  {
    $s_id=$request->eid;
    $accadmic=$request->academicyear;
    $student=DB::table('stu_admission')

    ->orderBy('gender','desc')
    ->orderBy('stu_name')
    ->join('tb_course','stu_admission.course','=','tb_course.id')
    //->select('stu_admission.stu_name','stu_admission.reg_no','stu_admission.course','tb_course.course_name')
    ->where('stu_admission.course','=',$s_id)
    ->where('stu_admission.branch_code',Auth::user()->school_id)
    ->where('stu_admission.accdmic_year',$accadmic)
    ->get();
    $batch=DB::table('tb_batch')
    ->where('course',$s_id)
   //->select('tb_batch.id','tb_batch.batch_name')
    ->get();
  echo $student.'|' .$batch;
  }
  public function assign_roll_section(Request $request)
  {
    $course=Input::get('course');
    $academic=Input::get('academicyear');
    $reg_no=Input::get('reg_no');
    $batch=Input::get('batch');
    $roll_no=Input::get('roll_no');
    $created_date = date('d-m-Y');

    for($i=0;$i<count($batch);$i++)
    {
       $batch[$i];

       $roll_no[$i];
             $reg_no[$i];
      $save=DB::table('stu_admission')
      ->where('reg_no','=',$reg_no[$i])
      ->where('course','=',$course)
      ->update(['batch'=>$batch[$i],'roll_no'=>$roll_no[$i]]);
    }
    if(!empty($save)){
      for($k=0;$k<count($batch);$k++)
      {
          $offica=DB::table('office_student_reg')
        ->where('reg_no','=',$reg_no[$k])
        ->where('course','=',$course)
        ->update(['batch'=>$batch[$k],'roll_no'=>$roll_no[$k]]);
      }
    for($j=0;$j<count($batch);$j++)
    {
      $data=DB::table('student_final_admission')
      ->insert(['course'=>$course,'batch'=>$batch[$j],'roll_no'=>$roll_no[$j],'reg_no'=>$reg_no[$j],'created_date'=>$created_date,'academic_year'=>$academic,'branch_code'=>Auth::user()->school_id]);
    }
    if(!empty($data)){
       return redirect('student/roll_section')->with([
               'message' => '  Succesfully.'
           ]);
     }else{
            return redirect('student/roll_section')->with([
                 'message' => 'Failed .',
                 'message_important'=>true
             ]);
          }
        }else{
      echo "Someting Went Worng.Please Try Again.";
    }
  }

  public function update_roll_section(Request $request)
  {
    $courses=DB::table('tb_course')->where('branch_code',Auth::user()->school_id)->get();
        $accadmicyear = DB::table('academicyear')
        ->where('branch_code',Auth::user()->school_id)
        ->get();
    return view('students.update_roll_section',compact('courses','accadmicyear'));
  }

  public function edit_roll_section(Request $request)
  {
    $course=Input::get('course');
    $academic=Input::get('academicyear');
    $reg_no=Input::get('reg_no');
    $batch=Input::get('batch');
    $roll_no=Input::get('roll_no');
    $created_date = date('d-m-Y');

    for($i=0;$i<count($batch);$i++)
    {
       $batch[$i];

       $roll_no[$i];
             $reg_no[$i];

      $save=DB::table('stu_admission')
      ->where('reg_no','=',$reg_no[$i])
      ->where('course','=',$course)
      ->update(['batch'=>$batch[$i],'roll_no'=>$roll_no[$i]]);
    }
    if(!empty($save)){
      for($k=0;$k<count($batch);$k++)
      {
          $offica=DB::table('office_student_reg')
        ->where('reg_no','=',$reg_no[$k])
        ->where('course','=',$course)
        ->update(['batch'=>$batch[$k],'roll_no'=>$roll_no[$k]]);
      }
       if(!empty($offica)){
       return redirect('student/roll_section')->with([
               'message' => '  Succesfully.'
           ]);
     }else{
            return redirect('student/roll_section')->with([
                 'message' => 'Failed .',
                 'message_important'=>true
             ]);
          }
        }
}

public function student_get_pass(Request $request)
{
   $courses=DB::table('tb_course')->where('branch_code',Auth::user()->school_id)->get();
   return view('students.student_get_pass',compact('courses'));
}

public function student_list(Request $request)
{
  $cid=$request->cid;
  $bid=$request->bid;
  $student_list=DB::table('stu_admission')
  ->where('course','=',$cid)
  ->where('batch','=',$bid)
  ->get();
  echo $student_list;
}
function student_get_pass_download($id){
  ini_set('max_execution_time', 300);
  $stu_data=DB::table('student_get_pass')
  ->join('stu_admission','stu_admission.reg_no','student_get_pass.student')
  ->join('tb_course','tb_course.id','student_get_pass.course')
  ->join('tb_batch','tb_batch.id','student_get_pass.batch')
  ->where('student_get_pass.id',$id)->orderBy('student_get_pass.id','desc')->get();
 // print_r($stu_data); exit;
 // print_r($stu_data[0]->stu_name);exit;
  $data = [
    'title' => 'Gate Pass',
    'stu_name' => $stu_data[0]->stu_name,
    'person_name' => $stu_data[0]->person_name,
    'contact_number' => $stu_data[0]->contact_number,
    'id_proof' => $stu_data[0]->id_proof,
    'id_proof_no' => $stu_data[0]->id_proof_no,
    'pass_date' => $stu_data[0]->pass_date,
    'reason' => $stu_data[0]->reason,
    'class' => $stu_data[0]->course_name,
    'section' => $stu_data[0]->batch_name,
      ];


 // print_r($data);exit;
  $pdf = PDF::loadView('students.gate_pass_download', $data);
//  return view('students.gate_pass_download',$data); //$pdf->download($id.'.pdf');
  return $pdf->download($stu_data[0]->stu_name.'.pdf');
}
public function insert_get_pass_student(Request $request)
{
  $course=Input::get('course');
  $batch=Input::get('batch');
  $student=Input::get('student');
  $person_name=Input::get('person_name');
  $contact_number=Input::get('contact_number');
  $pass_date=Input::get('pass_date');
  $reason=Input::get('reason');
  $idproof=Input::get('idproof');
  $idproofno=Input::get('idproofno');
  $created_date = date('d-m-Y');

  $save=DB::table('student_get_pass')->insert(['course'=>$course,'batch'=>$batch,'student'=>$student,'person_name'=>$person_name,'contact_number'=>$contact_number,"id_proof"=>$idproof,"id_proof_no"=>$idproofno,'pass_date'=>$pass_date,'reason'=>$reason,'created_at'=>$created_date,'academic_year'=>app_config('Session',Auth::user()->school_id),'branch_code'=>Auth::user()->school_id]);
   if(!empty($save)){
       return redirect('student/student_get_pass')->with([
               'message' => '  Succesfully.'
           ]);
     }else{
            return redirect('student/student_get_pass')->with([
                 'message' => 'Failed .',
                 'message_important'=>true
             ]);
          }
}

public function student_get_pass_list(Request $request)
{
  $list=DB::table('student_get_pass')
    ->join('stu_admission','student_get_pass.student','=','stu_admission.id')
    ->select('student_get_pass.*','stu_admission.stu_name')
    ->get();

    return view('students.student_get_pass_list',compact('list'));
}

public function delete_get_pass_list(Request $request,$id)
{
   if($id!=null){
           DB::table('student_get_pass')->where('id',$id)->where('branch_code',Auth::user()->school_id)->delete();

            return redirect('student/student_get_pass_list')->with([
                'message' => " Details Deleted Successfully."
            ]);
        }else{
            return redirect('student/student_get_pass_list')->with([
                'message' => " Details Not Found",
                'message_important' => true
            ]);
      }
}


// // DOMICILE START
   public function  DomicileCertificate(){
    $self='student/DomicileCertificate';
     if (\Auth::user()->user_role!=='1'){
         $get_perm=permission::permitted($self);

        if ($get_perm=='access denied'){
            return redirect('permission-error')->with([
               'message' => 'You do not have permission to view this page',
               'message_important'=>true
             ]);
         }
     }
  $students = DB::table('domicile_issue')
  ->Leftjoin('tb_course','domicile_issue.class','tb_course.id')
  ->select('domicile_issue.*','tb_course.course_name')
  ->orderBy('id','desc')->get();
  return view('students.DomicileCertificate',compact('students'));
}

public function DomicilePostsearch(Request $request){
$admn_no=Input::get('grno');
$downloadID=trim(Input::get('downloadID'));
$cnt=DB::table('stu_admission')->where('reg_no',$admn_no)->count();
if($cnt > 0){
  $stu=DB::table('stu_admission')
  ->join('stu_contact','stu_admission.reg_no','stu_contact.reg_no')
  ->where('stu_admission.reg_no',$admn_no)->orderBy('stu_admission.id','desc')->limit(1)->get();
$stucnt = DB::table('bonafied_issue')->count();
if(isset($downloadID) && !empty($downloadID)) {
  $stucnt=Input::get('downloadID');
}else{
  $stucnt=$stucnt+1;
 DB::table('domicile_issue')->insert(['reg_no'=>$admn_no,'name'=>$stu[0]->stu_name,'class'=>$stu[0]->course,"issue_by"=>Auth::user()->emp_code,'sl_no'=>$stucnt]);

}

//DB::table('domicile_issue')->insert(['reg_no'=>$admn_no,"issue_by"=>Auth::user()->emp_code]);


  $pdf = PDF::loadView('students.download_Domicile_Certificate',['stu'=>$stu,'stucnt'=>$stucnt]);
//  return view('students.download_Domicile_Certificate',compact('stu')); //$pdf->download($id.'.pdf');
  return $pdf->download($admn_no.'.pdf');

}else{
  return redirect('student/DomicileCertificate')->with([
     'message' => 'Registration No. Not Found.',
     'message_important'=>true
   ]);
}
}
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
	
$saveArray=array(
"reg_no"=>$reg_no,
"stu_name"=>$stu_name,
"type"=>$type,
"class"=>$class,
"participating_in"=>$participating_in,
"accdmic_year"=>$accdmic_year,
"created_by"=>Auth::user()->emp_code,
);
$cnt=DB::table('curricular_certificate_issue')->where($whereArray)->count();

	if($cnt==0){
	DB::table('curricular_certificate_issue')->insert($saveArray);
	}

  //PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('reports.invoiceSell')->stream();
  $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true,'setBasePath'=>$_SERVER['DOCUMENT_ROOT']])->loadView('students.downloadCurricularCertificate',['stu_name'=>$stu_name,'class'=>$class,'participating_in'=>$participating_in,'accdmic_year'=>$accdmic_year,'type'=>$type]);
  //PDF::setBasePath($_SERVER['DOCUMENT_ROOT']);
 // return view('students.downloadCurricularCertificate',compact('stu_name','class','participating_in','accdmic_year')); //$pdf->download($id.'.pdf');
    return $pdf->download($stu_name.'.pdf');
}

public function CurricularCertificate(){
 $stuList=DB::table('stu_admission')->groupBy('stu_admission.reg_no')->orderBy('stu_admission.stu_name','asc')->get();
 $class=DB::table('tb_course')->get();
 $acadmic_year=DB::table('academicyear')->get();
	$list=DB::table('curricular_certificate_issue')->orderBy('id','desc')->get();
 return view('students/CurricularCertificate',compact('stuList','class','acadmic_year','list'));
}

public function dclist(Request $request){
  $eid = $request->eid;
  $batch = DB::table('tb_batch')->select('id','batch_name')->where('branch_code',Auth::user()->school_id)->where('course',$eid)->get();
  //$batch=DB::table('tb_batch')->where('course',$eid)->orderBy('id','desc')->get();
 $cart = array();
  foreach($batch as $batch){
   array_push($cart,$batch);
  }
   echo json_encode($cart);
 }

// DOMICILE END

  public function  trialCertificate(){
    $self='student/trialCertificate';
     if (\Auth::user()->user_role!=='1'){
         $get_perm=permission::permitted($self);

        if ($get_perm=='access denied'){
            return redirect('permission-error')->with([
               'message' => 'You do not have permission to view this page',
               'message_important'=>true
             ]);
         }
     }
     $students = DB::table('trail_issue')->orderBy('id','desc')->get();

     return view('students.trialCertificate',compact('students'));
  }
	
 function downloadTrail(){
     $admn_no=Input::get('grno');
   $ref_no=Input::get('ref_no');
   $of=Input::get('of');
   $trail=Input::get('trail');
   $downloadID=Input::get('downloadID');
   $download=Input::get('download');
   $cnt=DB::table('stu_admission')->where('reg_no',$admn_no)->count();
   if($cnt > 0){
     $stu=DB::table('stu_admission')
     ->join('stu_contact','stu_admission.reg_no','stu_contact.reg_no')
     ->Leftjoin('tb_course','stu_admission.course','tb_course.id')
     ->Leftjoin('tb_batch','stu_admission.batch','tb_batch.id')
     ->where('stu_admission.reg_no',$admn_no)->get();
   $stucnt = DB::table('trail_issue')->count();

   if($download=="Re-Generate"){
     $stucnt=$downloadID;
   }else{
     DB::table('trail_issue')->insert(['reg_no'=>$admn_no,'name'=>$stu[0]->stu_name,'class'=>$stu[0]->course_name,
       'ref_no'=>$ref_no,'of'=>$of,'trail'=>$trail,"issue_by"=>Auth::user()->emp_code,'sl_no'=>($stucnt+1)]);
     $stucnt=$stucnt+1;
   }


     $pdf = PDF::loadView('students.downlaod_TrailCertificate',['of'=>$of,'trail'=>$trail,'stu'=>$stu,'stucnt'=>$stucnt,'ref_no'=>$ref_no]);
   //  return view('students.downlaod_CharacterCertificate',compact('stu','stucnt','ref_no')); //$pdf->download($id.'.pdf');
     return $pdf->download($admn_no.'.pdf');

   }else{
     return redirect('student/trialCertificate')->with([
        'message' => 'Registration No. Not Found.',
        'message_important'=>true
      ]);
   }
 }

  public function  CharacterCertificate(){
    $self='student/CharacterCertificate';
     if (\Auth::user()->user_role!=='1'){
         $get_perm=permission::permitted($self);

        if ($get_perm=='access denied'){
            return redirect('permission-error')->with([
               'message' => 'You do not have permission to view this page',
               'message_important'=>true
             ]);
         }
     }
     $students = DB::table('character_issue')->orderBy('id','desc')->get();

     return view('students.CharacterCertificate',compact('students'));
  }

function downloadCharacter(Request $request){
   $admn_no=Input::get('grno');
  $ref_no=Input::get('ref_no');
  $downloadID=Input::get('downloadID');
  $download=Input::get('download');
  $cnt=DB::table('stu_admission')->where('reg_no',$admn_no)->count();
  if($cnt > 0){
    $stu=DB::table('stu_admission')
    ->join('stu_contact','stu_admission.reg_no','stu_contact.reg_no')
    ->join('tb_course','stu_admission.course','tb_course.id')
    ->Leftjoin('tb_batch','stu_admission.batch','tb_batch.id')
    ->where('stu_admission.reg_no',$admn_no)->get();
  $stucnt = DB::table('character_issue')->count();

  if($download=="Re-Generate"){
    $stucnt=$downloadID;
  }else{
    DB::table('character_issue')->insert(['reg_no'=>$admn_no,'name'=>$stu[0]->stu_name,'class'=>$stu[0]->course_name,
      'sl_no'=>($stucnt+1),'ref_no'=>$ref_no,"issue_by"=>Auth::user()->emp_code]);
    $stucnt=$stucnt+1;
  }

//  DB::table('character_issue')->insert(['reg_no'=>$admn_no,'ref_no'=>$ref_no,"issue_by"=>Auth::user()->emp_code]);


    $pdf = PDF::loadView('students.downlaod_CharacterCertificate',['stu'=>$stu,'stucnt'=>$stucnt,'ref_no'=>$ref_no]);
  //  return view('students.download_Domicile_Certificate',compact('stu')); //$pdf->download($id.'.pdf');
    return $pdf->download($admn_no.'.pdf');

  }else{
    return redirect('student/CharacterCertificate')->with([
       'message' => 'Registration No. Not Found.',
       'message_important'=>true
     ]);
  }


}
  public function  BonafideCertificate(){
    $self='student/BonafideCertificate';
     if (\Auth::user()->user_role!=='1'){
         $get_perm=permission::permitted($self);

        if ($get_perm=='access denied'){
            return redirect('permission-error')->with([
               'message' => 'You do not have permission to view this page',
               'message_important'=>true
             ]);
         }
     }
     $students = DB::table('bonafied_issue')->orderBy('id','desc')->get();

     return view('students.BonafideCertificate',compact('students'));
  }

  function downloadBonafied(Request $request){
      $admn_no=Input::get('grno');
    $downloadID=Input::get('downloadID');
    $download=Input::get('download');
    $cnt=DB::table('stu_admission')->where('reg_no',$admn_no)->count();
    if($cnt > 0){
      $stu=DB::table('stu_admission')
      ->join('stu_contact','stu_admission.reg_no','stu_contact.reg_no')
      ->join('tb_course','stu_admission.course','tb_course.id')
      ->Leftjoin('tb_batch','stu_admission.batch','tb_batch.id')
      ->where('stu_admission.reg_no',$admn_no)->get();
    $stucnt = DB::table('bonafied_issue')->count();

    if($download=="Re-Generate"){
      $stucnt=$downloadID;
    }else{
      DB::table('bonafied_issue')->insert(['reg_no'=>$admn_no,'name'=>$stu[0]->stu_name,'class'=>$stu[0]->course_name,
        'sl_no'=>($stucnt+1),"issue_by"=>Auth::user()->emp_code]);
      $stucnt=$stucnt+1;
    }
  //  DB::table('bonafied_issue')->insert(['reg_no'=>$admn_no,"issue_by"=>Auth::user()->emp_code]);


      $pdf = PDF::loadView('students.download_Bonafied_Certificate',['stu'=>$stu,'stucnt'=>$stucnt]);
    //  return view('students.download_Domicile_Certificate',compact('stu')); //$pdf->download($id.'.pdf');
      return $pdf->download($admn_no.'.pdf');

    }else{
      return redirect('student/BonafideCertificate')->with([
         'message' => 'Registration No. Not Found.',
         'message_important'=>true
       ]);
    }
  }
function generateLeavingCertificate(Request $request){
  ini_set('max_execution_time', 300);
  $grno=Input::get('grno');
  $leaving_date=Input::get('leaving_date');
  $conduct=Input::get('conduct');
  $qualified=Input::get('qualified');
  $reason=Input::get('reason');
  $remark = Input::get('remark');
  $jc = Input::get('jc');
  $joining_date = Input::get('joining_date');
  $downloadID=Input::get('downloadID');
  $download=Input::get('download');

  $stu=DB::table('stu_admission')
  ->join('stu_contact','stu_admission.reg_no','stu_contact.reg_no')
	  ->join('tb_course','stu_admission.course','tb_course.id')
  ->where('stu_admission.reg_no',$grno)->orderBy('stu_admission.id','desc')->limit(1)->get();
  if(count($stu) > 0){

    if($download=="Re-Generate"){
      $id=$downloadID;
    }else{
  //    DB::table('bonafied_issue')->insert(['reg_no'=>$admn_no,'name'=>$stu[0]->stu_name,'class'=>$stu[0]->course_name,
    //    'sl_no'=>($stucnt+1),"issue_by"=>Auth::user()->emp_code]);
    //  $stucnt=$stucnt+1;
    $id=DB::table('leaving_certificate_issue')->insertGetId(['reg_no'=>$grno,'name'=>$stu[0]->stu_name,'class'=>$stu[0]->course_name,
    'joining_class'=>$jc,'joining_date'=>$joining_date,'leave_date'=>$leaving_date,'conduct'=>$conduct,'qualified'=>$qualified,
    'reason'=>$reason,'remark'=>$remark,'issue_by'=>Auth::user()->emp_code]);

    }

//  $id=DB::table('leaving_certificate_issue')->insertGetId(['reg_no'=>$grno,'issue_by'=>Auth::user()->emp_code]);
  //  $pdf = PDF::loadView('students.gate_pass_download', $data);
  $pdf = PDF::loadView('students.download_leaving_certificate', ['jc'=>$jc,'joining_date'=>$joining_date,'remark'=>$remark,'reason'=>$reason,'conduct'=>$conduct,'qualified'=>$qualified,'stu'=>$stu,'id'=>$id,'leaving_date'=>$leaving_date]);
    //return view('students.download_leaving_certificate',compact('remark','reason','conduct','qualified','stu','id','leaving_date')); //$pdf->download($id.'.pdf');
    return $pdf->download($grno.'.pdf');
  }else{
    return redirect('student/LeavingCertificate')->with([
       'message' => 'Please Enter Valid GR No.',
       'message_important'=>true
     ]);
  }

}
  public function  LeavingCertificate(){
    $self='student/LeavingCertificate';
     if (\Auth::user()->user_role!=='1'){
         $get_perm=permission::permitted($self);

        if ($get_perm=='access denied'){
            return redirect('permission-error')->with([
               'message' => 'You do not have permission to view this page',
               'message_important'=>true
             ]);
         }
     }
	   $students=DB::table('leaving_certificate_issue')->orderBy('id','desc')->get();
     return view('students.LeavingCertificate',compact('students'));
  }

 //<!---- bikash ------------------------------------------------------------------------------------->
  public function studentboylist(){
    $self='student/list';
    if (\Auth::user()->user_role!=='1'){
        $get_perm=permission::permitted($self);

        if ($get_perm=='access denied'){
            return redirect('permission-error')->with([
                'message' => 'You do not have permission to view this page',
                'message_important'=>true
            ]);
        }
    }
   // echo Auth::user()->school_id;
  // echo app_config('session',Auth::user()->school_id);exit;
    $accadmicyear=DB::table('academicyear')->where('branch_code',Auth::user()->school_id)->orderBy('startyear','desc')->get();
    $course=DB::table('tb_course')->where('branch_code',Auth::user()->school_id)->orderBy('id','asc')->get();
    $batch=DB::table('tb_batch')->where('branch_code',Auth::user()->school_id)->orderBy('id','asc')->get();
//print_r($accadmicyear);
    $students = DB::table('stu_admission')
            ->Leftjoin('tb_course', 'stu_admission.course', '=', 'tb_course.id')
            ->Leftjoin('tb_batch', 'stu_admission.batch', '=', 'tb_batch.id')
            ->join('stu_contact', 'stu_admission.reg_no', '=', 'stu_contact.reg_no')
            ->select('stu_admission.*','stu_contact.phone','stu_contact.father_phone','tb_course.course_name','tb_batch.batch_name')
            ->where('stu_admission.branch_code',Auth::user()->school_id)
            ->where('stu_admission.accdmic_year',"2020-2021")
            ->where('gender', '=', 'Male')
            ->orderBy('stu_name','asc')
            ->get();
          //  print_r($students);exit;
    return view('students.boylist',compact('accadmicyear','course','batch','students'));
  }


  public function boysearch(Request $request){
    $course=Input::get('course');
    $c=$course;
    $batch=Input::get('batch');
    $b=$batch;
    $accadmicyear=Input::get('accadmicyear');
    $accadmic=$accadmicyear;
    $accadmicyear=DB::table('academicyear')->where('branch_code',Auth::user()->school_id)->orderBy('startyear','desc')->get();
    $course=DB::table('tb_course')->where('branch_code',Auth::user()->school_id)->orderBy('id','desc')->get();
    $batch=DB::table('tb_batch')->where('branch_code',Auth::user()->school_id)->orderBy('id','desc')->get();

  if($c !="0" && $b=="0" && $accadmic=="0" ){
    $students = DB::table('stu_admission')
            ->join('tb_course', 'stu_admission.course', '=', 'tb_course.id')
            ->join('tb_batch', 'stu_admission.batch', '=', 'tb_batch.id')
            ->join('stu_contact', 'stu_admission.reg_no', '=', 'stu_contact.reg_no')
            ->select('stu_admission.*','stu_contact.phone','stu_contact.father_phone','tb_course.course_name','tb_batch.batch_name')

            ->where('stu_admission.branch_code',Auth::user()->school_id)
            ->where('stu_admission.course','=',$c)
            ->where('gender', '=', 'Male')
            ->orderBy('stu_name','asc')
            ->get();

            return view('students.boylist',compact('accadmicyear','course','batch','students'));
  }
  if($b != "0" && $c != "0" && $accadmic == "0"){
      $students = DB::table('stu_admission')
              ->join('tb_course', 'stu_admission.course', '=', 'tb_course.id')
              ->join('tb_batch', 'stu_admission.batch', '=', 'tb_batch.id')
              ->join('stu_contact', 'stu_admission.reg_no', '=', 'stu_contact.reg_no')
              ->select('stu_admission.*','stu_contact.phone','stu_contact.father_phone','tb_course.course_name','tb_batch.batch_name')

              ->where('stu_admission.branch_code',Auth::user()->school_id)
              ->where('stu_admission.course','=',$c)
              ->where('stu_admission.batch',$b)
              ->where('gender', '=', 'Male')
              ->orderBy('stu_name','asc')
              ->get();

              return view('students.student-list',compact('accadmicyear','course','batch','students'));
    }
    if($c == "0" && $b == "0" && $accadmic !="0"){
        $students = DB::table('stu_admission')
                ->join('tb_course', 'stu_admission.course', '=', 'tb_course.id')
                ->join('tb_batch', 'stu_admission.batch', '=', 'tb_batch.id')
                ->join('stu_contact', 'stu_admission.reg_no', '=', 'stu_contact.reg_no')
                ->select('stu_admission.*','stu_contact.phone','stu_contact.father_phone','tb_course.course_name','tb_batch.batch_name')

                ->where('stu_admission.branch_code',Auth::user()->school_id)
                ->where('stu_admission.accdmic_year',$accadmic)
                ->where('gender', '=', 'Male')
                ->orderBy('stu_name','asc')
                ->get();

                return view('students.boylist',compact('accadmicyear','course','batch','students'));
      }
      if($course !="0" && $batch !="0" && $accadmic !="0"){
          $students = DB::table('stu_admission')
                  ->join('tb_course', 'stu_admission.course', '=', 'tb_course.id')
                  ->join('tb_batch', 'stu_admission.batch', '=', 'tb_batch.id')
                  ->join('stu_contact', 'stu_admission.reg_no', '=', 'stu_contact.reg_no')
                  ->select('stu_admission.*','stu_contact.phone','stu_contact.father_phone','tb_course.course_name','tb_batch.batch_name')

                  ->where('stu_admission.branch_code',Auth::user()->school_id)
                  ->where('stu_admission.accdmic_year',$accadmic)
                  ->where('stu_admission.batch',$b)
                  ->where('stu_admission.course',$c)
                  ->where('gender', '=', 'Male')
                  ->orderBy('stu_name','asc')
                  ->get();

                  return view('students.boylist',compact('accadmicyear','course','batch','students'));
        }
        if($c =="0" && $b =="0" && $accadmic =="0"){
          $students = DB::table('stu_admission')
                  ->join('tb_course', 'stu_admission.course', '=', 'tb_course.id')
                  ->join('tb_batch', 'stu_admission.batch', '=', 'tb_batch.id')
                  ->join('stu_contact', 'stu_admission.reg_no', '=', 'stu_contact.reg_no')
                  ->select('stu_admission.*','stu_contact.phone','stu_contact.father_phone','tb_course.course_name','tb_batch.batch_name')

                  ->where('stu_admission.branch_code',Auth::user()->school_id)
                  ->where('gender', '=', 'Male')
                  ->orderBy('stu_name','asc')
                  ->get();

                  return view('students.boylist',compact('accadmicyear','course','batch','students'));
        }
       //  echo "pre";
       //  print_r($students);
       //  exit ();
       //  return view('students.student-list',compact('accadmicyear','course','batch','students'));
  }


  // girl list start

  public function studentgirllist(){
    $self='student/list';
    if (\Auth::user()->user_role!=='1'){
        $get_perm=permission::permitted($self);

        if ($get_perm=='access denied'){
            return redirect('permission-error')->with([
                'message' => 'You do not have permission to view this page',
                'message_important'=>true
            ]);
        }
    }
    $accadmicyear=DB::table('academicyear')->where('branch_code',Auth::user()->school_id)->orderBy('startyear','desc')->get();
    $course=DB::table('tb_course')->where('branch_code',Auth::user()->school_id)->orderBy('id','desc')->get();
    $batch=DB::table('tb_batch')->where('branch_code',Auth::user()->school_id)->orderBy('id','desc')->get();
//print_r($accadmicyear);
    $students = DB::table('stu_admission')
            ->join('tb_course', 'stu_admission.course', '=', 'tb_course.id')
            ->Leftjoin('tb_batch', 'stu_admission.batch', '=', 'tb_batch.id')
            ->join('stu_contact', 'stu_admission.reg_no', '=', 'stu_contact.reg_no')
            ->select('stu_admission.*','stu_contact.phone','stu_contact.father_phone','tb_course.course_name','tb_batch.batch_name')

            ->where('stu_admission.branch_code',Auth::user()->school_id)
            ->where('stu_admission.acadmic_year',app_config('Session',Auth::user()->school_id))
            ->where('gender', '=', 'Female')
            ->orderBy('stu_name','asc')
            ->get();
    return view('students.girlslist',compact('accadmicyear','course','batch','students'));
  }


  public function girlsearch(Request $request){
    $course=Input::get('course');
    $c=$course;
    $batch=Input::get('batch');
    $b=$batch;
    $accadmicyear=Input::get('accadmicyear');
    $accadmic=$accadmicyear;
    $accadmicyear=DB::table('academicyear')->where('branch_code',Auth::user()->school_id)->orderBy('startyear','desc')->get();
    $course=DB::table('tb_course')->where('branch_code',Auth::user()->school_id)->orderBy('id','desc')->get();
    $batch=DB::table('tb_batch')->where('branch_code',Auth::user()->school_id)->orderBy('id','desc')->get();

  if($c !="0" && $b=="0" && $accadmic=="0" ){
    $students = DB::table('stu_admission')
            ->join('tb_course', 'stu_admission.course', '=', 'tb_course.id')
            ->join('tb_batch', 'stu_admission.batch', '=', 'tb_batch.id')
            ->join('stu_contact', 'stu_admission.reg_no', '=', 'stu_contact.reg_no')
            ->select('stu_admission.*','stu_contact.phone','stu_contact.father_phone','tb_course.course_name','tb_batch.batch_name')

            ->where('stu_admission.branch_code',Auth::user()->school_id)
            ->where('stu_admission.course','=',$c)
            ->where('gender', '=', 'Female')
            ->orderBy('stu_name','asc')
            ->get();

            return view('students.girlslist',compact('accadmicyear','course','batch','students'));
  }
  if($b != "0" && $c != "0" && $accadmic == "0"){
      $students = DB::table('stu_admission')
              ->join('tb_course', 'stu_admission.course', '=', 'tb_course.id')
              ->join('tb_batch', 'stu_admission.batch', '=', 'tb_batch.id')
              ->join('stu_contact', 'stu_admission.reg_no', '=', 'stu_contact.reg_no')
              ->select('stu_admission.*','stu_contact.phone','stu_contact.father_phone','tb_course.course_name','tb_batch.batch_name')

              ->where('stu_admission.branch_code',Auth::user()->school_id)
              ->where('stu_admission.course','=',$c)
              ->where('stu_admission.batch',$b)
              ->where('gender', '=', 'Female')
              ->orderBy('stu_name','asc')
              ->get();

              return view('students.girlslist',compact('accadmicyear','course','batch','students'));
    }
    if($c == "0" && $b == "0" && $accadmic !="0"){
        $students = DB::table('stu_admission')
                ->join('tb_course', 'stu_admission.course', '=', 'tb_course.id')
                ->join('tb_batch', 'stu_admission.batch', '=', 'tb_batch.id')
                ->join('stu_contact', 'stu_admission.reg_no', '=', 'stu_contact.reg_no')
                ->select('stu_admission.*','stu_contact.phone','stu_contact.father_phone','tb_course.course_name','tb_batch.batch_name')
                ->where('stu_admission.branch_code',Auth::user()->school_id)
                ->where('stu_admission.accdmic_year',$accadmic)
                ->where('gender', '=', 'Female')
                ->orderBy('stu_name','asc')
                ->get();

                return view('students.girlslist',compact('accadmicyear','course','batch','students'));
      }
      if($course !="0" && $batch !="0" && $accadmic !="0"){
          $students = DB::table('stu_admission')
                  ->join('tb_course', 'stu_admission.course', '=', 'tb_course.id')
                  ->join('tb_batch', 'stu_admission.batch', '=', 'tb_batch.id')
                  ->join('stu_contact', 'stu_admission.reg_no', '=', 'stu_contact.reg_no')
                  ->select('stu_admission.*','stu_contact.phone','stu_contact.father_phone','tb_course.course_name','tb_batch.batch_name')

                  ->where('stu_admission.branch_code',Auth::user()->school_id)
                  ->where('stu_admission.accdmic_year',$accadmic)
                  ->where('stu_admission.batch',$b)
                  ->where('stu_admission.course',$c)
                  ->where('gender', '=', 'Female')
                  ->orderBy('stu_name','asc')
                  ->get();

                  return view('students.girlslist',compact('accadmicyear','course','batch','students'));
        }
        if($c =="0" && $b =="0" && $accadmic =="0"){
          $students = DB::table('stu_admission')
                  ->join('tb_course', 'stu_admission.course', '=', 'tb_course.id')
                  ->join('tb_batch', 'stu_admission.batch', '=', 'tb_batch.id')
                  ->join('stu_contact', 'stu_admission.reg_no', '=', 'stu_contact.reg_no')
                  ->select('stu_admission.*','stu_contact.phone','stu_contact.father_phone','tb_course.course_name','tb_batch.batch_name')

                  ->where('stu_admission.branch_code',Auth::user()->school_id)
                  ->where('gender', '=', 'Female')
                  ->orderBy('stu_name','asc')
                  ->get();

                  return view('students.girlslist',compact('accadmicyear','course','batch','students'));
        }
       //  echo "pre";
       //  print_r($students);
       //  exit ();
       //  return view('students.student-list',compact('accadmicyear','course','batch','students'));
  }

}
?>
