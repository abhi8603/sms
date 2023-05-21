<?php
namespace App;
namespace App\Http\Controllers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Crypt;
use App\Http\Requests;
use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\permission;
use App\EmployeeRolesPermission;
use App\EmployeeRoles;
date_default_timezone_set('Asia/Kolkata');
class HRController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
      $this->middleware('SchoolMiddleware');
  }

//leave Start

function applyLeave(){
    $leave_types=DB::table('leave_types')->where('is_active','1')->orderBy('id','desc')->get();
    $username=Auth::user()->username;
    $sql="SELECT a.*,b.emp_code,COUNT(b.id) AS leave_taken,((a.no_of_days)-COUNT(b.id)) AS avilable_leave
          FROM leave_types a
          LEFT JOIN emp_leave_application b ON a.id=b.leave_type AND b.emp_code='$username' AND b.`status`='1'
          GROUP BY a.id";
    $leavecnt=DB::select($sql);

    return view('Hr_Payroll.leave.apply-leave',compact('leave_types','leavecnt'));
}

function Leaveview(){
  $leave=DB::table('emp_leave_application')
  ->leftJoin('leave_types','leave_types.id','emp_leave_application.leave_type')
  ->select('emp_leave_application.*','leave_types.name')
  ->where('emp_leave_application.status',0)
  ->orderBy('emp_leave_application.id','desc')->get();
  return view('Hr_Payroll.leave.leave-view',compact('leave'));
}

function EmpLeaveview($id,$empcode){
  $leave=DB::table('emp_leave_application')
  ->leftJoin('leave_types','leave_types.id','emp_leave_application.leave_type')
  ->select('emp_leave_application.*','leave_types.name')
  ->where('emp_leave_application.id',$id)
  ->orderBy('emp_leave_application.id','desc')->first();

  $username=$empcode;
  $sql="SELECT a.*,b.emp_code,COUNT(b.id) AS leave_taken,((a.no_of_days)-COUNT(b.id)) AS avilable_leave
        FROM leave_types a
        LEFT JOIN emp_leave_application b ON a.id=b.leave_type AND b.emp_code='$username' AND b.`status`='1'
        GROUP BY a.id";
  $leavecnt=DB::select($sql);
  return view('Hr_Payroll.leave.leave-detail-view',compact('leave','leavecnt','username'));
}

function LeaveviewAction(Request $request){
  $this->validate($request, [
    'id'=>'required',
    'status_remark'=>'required',
    'action'=>'required',
    'emp_code'=>'required',
  ]);
  $id=Input::get('id');
  $emp=Input::get('emp');
  $emp_code=Input::get('emp_code');
  $action=Input::get('action');
  $actionData=array(
    "status"=>Input::get('action'),
    "status_remark"=>Input::get('status_remark'),
    "approved_by"=>Auth::user()->username,
  );
    if($action=="1"){
      $a_taken=" Approved";
    }elseif ($action=="2") {
      // code...
        $a_taken=" Rejected";
    }else{
      $a_taken=" Pending";
    }
  DB::table('emp_leave_application')->where('id',$id)->update($actionData);
  return redirect('hr/employee/leave/view/'.$id.'/'.$emp_code)->with([
      'message' => 'Leave Application Status Change to'.$a_taken.' for ' .$emp
  ]);

}
function allLeave(){
  $leave=DB::table('emp_leave_application')
  ->leftJoin('leave_types','leave_types.id','emp_leave_application.leave_type')
  ->select('emp_leave_application.*','leave_types.name')
  ->orderBy('emp_leave_application.id','desc')->get();

  return view('Hr_Payroll.leave.all-leave',compact('leave'));

}
function LeaveAppliedview(){

  $leave=DB::table('emp_leave_application')
  ->leftJoin('leave_types','leave_types.id','emp_leave_application.leave_type')
  ->select('emp_leave_application.*','leave_types.name')
  ->where('emp_leave_application.emp_code',Auth::user()->username)
  ->where('emp_leave_application.status',0)
  ->orderBy('emp_leave_application.id','desc')->get();

  $accepted=DB::table('emp_leave_application')
  ->leftJoin('leave_types','leave_types.id','emp_leave_application.leave_type')
  ->select('emp_leave_application.*','leave_types.name')
  ->where('emp_leave_application.emp_code',Auth::user()->username)
  ->where('emp_leave_application.status',1)
  ->orderBy('emp_leave_application.id','desc')->get();

  $rejected=DB::table('emp_leave_application')
  ->leftJoin('leave_types','leave_types.id','emp_leave_application.leave_type')
  ->select('emp_leave_application.*','leave_types.name')
  ->where('emp_leave_application.emp_code',Auth::user()->username)
  ->where('emp_leave_application.status',2)
  ->orderBy('emp_leave_application.id','desc')->get();

    return view('Hr_Payroll.leave.leave-emp-view',compact('leave','accepted','rejected'));
}


function leave_type(){
  //echo "hii";exit;
$leave_types=DB::table('leave_types')->orderBy('id','desc')->get();

return view('Hr_Payroll.leave.leave-type',compact('leave_types'));
}

function submitLeave(Request $request){
  $this->validate($request, [
    'leave_type'=>'required',
    'from_date'=>'required',
    'to_date'=>'required',
    'leave_reason'=>'required',
    'no_of_days'=>'required'
  ]);

  if(isset($_FILES['file'])){
  	$errors= array();
  		 $file_name = $_FILES['file']['name'];
  		 $file_size =$_FILES['file']['size'];
  		 $file_tmp =$_FILES['file']['tmp_name'];
  		 $file_type=$_FILES['file']['type'];
  		// $file_ext=strtolower(end(explode('.',$_FILES['file']['name'])));
  		$tmp = explode('.', $file_name);
  		$file_ext = end($tmp);
  		 if($file_size > 2097152){
  				$errors[]='File size must be excately 2 MB';
  		 }
  		 if(empty($errors)==true){
           move_uploaded_file($file_tmp,"assets/uploads/leave/".$file_name);
          $filepath="assets/uploads/leave/".$file_name;
        }else{
  				return redirect('employee/leave/apply')->with([
  						'message' => 'Unable to upload File.Please try again',
  						'message_important'=>true
  				]);
        }

  }else{
  	$filepath="";
  }

  $leaveData=array(
    'emp_code'=>Auth::user()->username,
    'emp_name'=>Auth::user()->name,
    'leave_type'=>Input::get('leave_type'),
    'from_date'=>Input::get('from_date'),
    'to_date'=>Input::get('to_date'),
    'no_of_days'=>Input::get('no_of_days'),
    'leave_reason'=>Input::get('leave_reason'),
    'leave_file'=>$filepath,
  );
  $st=DB::table('emp_leave_application')->insert($leaveData);
  if($st){
    return redirect('employee/leave/apply')->with([
        'message' => 'Your Leave Application Submitted Succesfully.'
    ]);
  }else{
    return redirect('employee/leave/apply')->with([
        'message' => 'Unable to Submit Your Leave Application.Please try again',
        'message_important'=>true
    ]);
  }

}

function Change_status_leave_type($id,$status){
      if($status=="1"){
        $status="0";
      }else{
        $status="1";
      }

      DB::table('leave_types')->where('id',$id)->update(["is_active"=>$status]);
      return redirect('employee/leave/leave-type')->with([
           'message' => 'Leave Status Updated Successfully'
       ]);

}
function delete_leave_type($id){
    DB::table('leave_types')->where('id',$id)->delete();
    return redirect('employee/leave/leave-type')->with([
         'message' => 'Leave Type Deleted Successfully'
     ]);
}

function Addleave_type(Request $request){
//  unset(Input::get('_token'));
  $this->validate($request, [
    'name'=>'required|unique:leave_types',
    'no_of_days'=>'required'
  ]);
  $leaveData=array(
    'name'=>Input::get('name'),
    'no_of_days'=>Input::get('no_of_days'),
    'created_by'=>Auth::user()->username
  );
$st=DB::table('leave_types')->insert($leaveData);
if($st){
  return redirect('employee/leave/leave-type')->with([
       'message' => 'Leave Type Added Successfully'
   ]);
}else{
  return redirect('employee/leave/leave-type')->with([
       'message' => 'Unable to Add Leave Type.Please try again',
       'important'=>true
   ]);
}
}
//leave End


  function deleteCategory($id){
      if($id!==""){
        DB::table('tb_studentcategory')->where('id',$id)->delete();
        return redirect('hr/category')->with([
            'message' => 'Category Deleted Successfully'
        ]);
    }else{
        return redirect('hr/category')->with([
            'message' => 'Unable to Delete Category',
            'important'=>true
        ]);
    }
  }
  public function category(){
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
     return view('Hr_Payroll.emp_management.category',compact('stu_category'));
  }

  public function addCategory(Request $request){
    $usertype=Input::get('studentCategory');
    $created_date = date('d-m-Y H:i:s');
    DB::table('tb_studentcategory')->insert(['stu_category'=>$usertype,'created_on'=>$created_date,'branch_code'=>Auth::user()->school_id]);
           return redirect('hr/category')->with([
                'message' => 'New Student Category Added Successfully'
            ]);
    }

  function update_profile(Request $request){
   /* $self='hr/employee/add';
    if (\Auth::user()->user_role!=='1'){
        $get_perm=permission::permitted($self);

        if ($get_perm=='access denied'){
            return redirect('permission-error')->with([
                'message' => 'You do not have permission to view this page.',
                'message_important'=>true
            ]);
        }
    }  */
    $this->validate($request, [
        'empcode'=>'required',
        'user_id'=>'required',
        'joiningdate'=>'required',
        'department'=>'required',
        'designation'=>'required',
        'qualification'=>'required',
        'totalexperience'=>'required',
        'usertype'=>'required',
        'fname'=>'required',
        'lname'=>'required',
        'dob'=>'required',
        'gender'=>'required',

        'nationality'=>'required',
        'category'=>'required',
        'religion'=>'required',
        'permanentsddress'=>'required',
        'persentddress'=>'required',
        'city'=>'required',
        'pin'=>'required',
        'country'=>'required',
        'state'=>'required',
        'phone'=>'required',
        'email'=>'required'
      ]);
      $empcode=Input::get('empcode');
      $user_id=Input::get('user_id');
      $joiningdate=Input::get('joiningdate');
      $department=Input::get('department');
      $designation=Input::get('designation');
      $qualification=Input::get('qualification');
      $totalexperience=Input::get('totalexperience');
      $usertype=Input::get('usertype');
      $fname=Input::get('fname');
      $mname=Input::get('mname');
      $lname=Input::get('lname');
      $dob=Input::get('dob');
      $gender=Input::get('gender');
      $panno=Input::get('panno');
      $pf=Input::get('pf');

      $esi=Input::get('esi');
      $nationality=Input::get('nationality');
      $category=Input::get('category');
      $religion=Input::get('religion');
      $aadharno=Input::get('aadharno');
      $permanentsddress=Input::get('permanentsddress');
      $persentddress=Input::get('persentddress');
      $city=Input::get('city');
      $pin=Input::get('pin');
      $country=Input::get('country');
      $state=Input::get('state');
      $phone=Input::get('phone');
      $email=Input::get('email');
    $emp_contact=array(
            "permanent_address"=>$permanentsddress,
            "present_address"=>$persentddress,
            "city"=>$city,
            "pin"=>$pin,
            "country"=>$country,
            "state"=>$state,
            "phone"=>$phone,
            "email"=>$email,
            );

         //   print_r($emp_contact); exit;
        $emp_details=array(
            "joiningdate"=>$joiningdate,
            "department"=>$department,
            "designation"=>$designation,
            "qualification"=>$qualification,
            "tot_exp"=>$totalexperience,
            "user_type"=>$usertype,
            "fname"=>$fname,
            "mname"=>$mname,
            "lname"=>$lname,
            "dob"=>$dob,
            "gender"=>$gender,
            "pan_no"=>$panno,
            "pf_no"=>$pf,
            "esi"=>$esi,
            "nationality"=>$nationality,
            "category"=>$category,
            "religion"=>$religion,
            "aadhar_number"=>$aadharno,
        );

        $users = DB::table('emp_details')
        ->where('user_id', $user_id)
        ->get();
        if(count($users)=="1"){
            DB::table('emp_details')
            ->where('user_id', $user_id)
            ->update($emp_details);
        }else{
            $emp_details["empcode"]=$empcode;
            $emp_details["user_id"]=$user_id;
            DB::table('emp_details')->insert($emp_details);
        }
        $user_contact = DB::table('emp_contact')
        ->where('user_id', $user_id)
        ->get();
        if(count($user_contact)=="1"){
            DB::table('emp_contact')
            ->where('user_id', $user_id)
            ->update($emp_contact);
        }else{
            $emp_contact["empcode"]=$empcode;
            $emp_contact["user_id"]=$user_id;
            DB::table('emp_contact')->insert($emp_contact);
        }
        DB::table('users')
        ->where('id', $user_id)
        ->update(['email' => $email]);
        return redirect('user_profile')->with([
            'message' => 'Profile Updated Successfully.'
        ]);
  }
  function admin_update_profile(Request $request){
     $self='hr/employee/add';
     if (\Auth::user()->user_role!=='1'){
         $get_perm=permission::permitted($self);

         if ($get_perm=='access denied'){
             return redirect('permission-error')->with([
                 'message' => 'You do not have permission to view this page.',
                 'message_important'=>true
             ]);
         }
     }
     $this->validate($request, [
         'empcode'=>'required',
         'user_id'=>'required',
         'joiningdate'=>'required',
         'department'=>'required',
         'designation'=>'required',
         'qualification'=>'required',
         'totalexperience'=>'required',
         'usertype'=>'required',
         'fname'=>'required',
         'lname'=>'required',
         'dob'=>'required',
         'gender'=>'required',

         'nationality'=>'required',
         'category'=>'required',
         'religion'=>'required',
         'permanentsddress'=>'required',
         'persentddress'=>'required',
         'city'=>'required',
         'pin'=>'required',
         'country'=>'required',
         'state'=>'required',
         'phone'=>'required',
         'email'=>'required'
       ]);
       $empcode=Input::get('empcode');
       $user_id=Input::get('user_id');
       $joiningdate=Input::get('joiningdate');
       $department=Input::get('department');
       $designation=Input::get('designation');
       $qualification=Input::get('qualification');
       $totalexperience=Input::get('totalexperience');
       $usertype=Input::get('usertype');
       $fname=Input::get('fname');
       $mname=Input::get('mname');
       $lname=Input::get('lname');
       $dob=Input::get('dob');
       $gender=Input::get('gender');
       $panno=Input::get('panno');
       $pf=Input::get('pf');

       $esi=Input::get('esi');
       $nationality=Input::get('nationality');
       $category=Input::get('category');
       $religion=Input::get('religion');
       $aadharno=Input::get('aadharno');
       $permanentsddress=Input::get('permanentsddress');
       $persentddress=Input::get('persentddress');
       $city=Input::get('city');
       $pin=Input::get('pin');
       $country=Input::get('country');
       $state=Input::get('state');
       $phone=Input::get('phone');
       $email=Input::get('email');
     $emp_contact=array(
             "permanent_address"=>$permanentsddress,
             "present_address"=>$persentddress,
             "city"=>$city,
             "pin"=>$pin,
             "country"=>$country,
             "state"=>$state,
             "phone"=>$phone,
             "email"=>$email,
             );

          //   print_r($emp_contact); exit;
         $emp_details=array(
             "joiningdate"=>$joiningdate,
             "department"=>$department,
             "designation"=>$designation,
             "qualification"=>$qualification,
             "tot_exp"=>$totalexperience,
             "user_type"=>$usertype,
             "fname"=>$fname,
             "mname"=>$mname,
             "lname"=>$lname,
             "dob"=>$dob,
             "gender"=>$gender,
             "pan_no"=>$panno,
             "pf_no"=>$pf,
             "esi"=>$esi,
             "nationality"=>$nationality,
             "category"=>$category,
             "religion"=>$religion,
             "aadhar_number"=>$aadharno,
         );

         $users = DB::table('emp_details')
         ->where('user_id', $user_id)
         ->get();
         if(count($users)=="1"){
             DB::table('emp_details')
             ->where('user_id', $user_id)
             ->update($emp_details);
         }else{
             $emp_details["empcode"]=$empcode;
             $emp_details["user_id"]=$user_id;
             DB::table('emp_details')->insert($emp_details);
         }
         $user_contact = DB::table('emp_contact')
         ->where('user_id', $user_id)
         ->get();
         if(count($user_contact)=="1"){
             DB::table('emp_contact')
             ->where('user_id', $user_id)
             ->update($emp_contact);
         }else{
             $emp_contact["empcode"]=$empcode;
             $emp_contact["user_id"]=$user_id;
             DB::table('emp_contact')->insert($emp_contact);
         }
         DB::table('users')
         ->where('id', $user_id)
         ->update(['email' => $email,'user_role'=>$usertype]);
         return redirect('hr/employee/view/'.$empcode)->with([
             'message' => 'Profile Updated Successfully.'
         ]);
   }
   function admin_update_password(Request $request){
    $password=Input::get('npassword');
    $empcode=Input::get('empcode');
    DB::table('users')
    ->where('username','=',$empcode)
    ->update(['password'=>bcrypt($password)]);
    $dt=array(
        "username"=>Auth::user()->username,
        "change_by"=>Auth::user()->username,
        "newpassword"=>$password,
    );
    DB::table('password_change_log')->insert($dt);
    return redirect('hr/employee/view/'.$empcode)->with([
        'message' => 'Password Updated Successfully.'
    ]);

  }


  function admin_update_profile_image(Request $request){
    $empcode=Input::get('empcode');
    if(isset($_FILES['image'])){
        $errors= array();
        $file_name = $_FILES['image']['name'];
        $file_size =$_FILES['image']['size'];
        $file_tmp =$_FILES['image']['tmp_name'];
        $file_type=$_FILES['image']['type'];
        $ed=explode('.',$file_name);
        $file_ext=end($ed);

        $extensions= array("jpeg","jpg","png");

        if(in_array($file_ext,$extensions)=== false){
           $errors[]="extension not allowed, please choose a JPEG or PNG file.";
        }

        if($file_size > 2097152){
           $errors[]='File size must be excately 2 MB';
        }
        $img_path="assets/images/profile_image/".$file_name;
        if(empty($errors)==true){
           if(move_uploaded_file($file_tmp,$img_path)){
            DB::table('users')->where('id','=',Auth::user()->id)
            ->update(['profile_img'=>$img_path]);

            return redirect('hr/employee/view/'.$empcode)->with([
                'message' => 'Profile Image Updated Successfully.'
            ]);
           }else{
            return redirect('hr/employee/view/'.$empcode)->with([
                'message' => $errors,
                'message_important'=>true
            ]);
           }
          // echo "Success";
        }else{
            return redirect('user_profile')->with([
                'message' => 'Unable to upload profile image.Please try again.',
                'message_important'=>true
            ]);
        }
    }
}

  function update_password(Request $request){
    $password=Input::get('npassword');
    DB::table('users')
    ->where('username','=',Auth::user()->username)
    ->update(['password'=>bcrypt($password)]);
    $dt=array(
        "username"=>Auth::user()->username,
        "change_by"=>Auth::user()->username,
        "newpassword"=>$password,
    );
    DB::table('password_change_log')->insert($dt);
    return redirect('user_profile')->with([
        'message' => 'Password Updated Successfully.'
    ]);

  }
function update_profile_image(Request $request){
    if(isset($_FILES['image'])){
        $errors= array();
        $file_name = $_FILES['image']['name'];
        $file_size =$_FILES['image']['size'];
        $file_tmp =$_FILES['image']['tmp_name'];
        $file_type=$_FILES['image']['type'];
        $ed=explode('.',$file_name);
        $file_ext=end($ed);

        $extensions= array("jpeg","jpg","png");

        if(in_array($file_ext,$extensions)=== false){
           $errors[]="extension not allowed, please choose a JPEG or PNG file.";
        }

        if($file_size > 2097152){
           $errors[]='File size must be excately 2 MB';
        }
        $img_path="assets/images/profile_image/".$file_name;
        if(empty($errors)==true){
           if(move_uploaded_file($file_tmp,$img_path)){
            DB::table('users')->where('id','=',Auth::user()->id)
            ->update(['profile_img'=>$img_path]);

            return redirect('user_profile')->with([
                'message' => 'Profile Image Updated Successfully.'
            ]);
           }else{
            return redirect('user_profile')->with([
                'message' => $errors,
                'message_important'=>true
            ]);
           }
          // echo "Success";
        }else{
            return redirect('user_profile')->with([
                'message' => 'Unable to upload profile image.Please try again.',
                'message_important'=>true
            ]);
        }
    }
}
 function user_profile(){


    $self='hr/employee';
    if (\Auth::user()->user_role!=='1'){
        $get_perm=permission::permitted($self);

      /*  if ($get_perm=='access denied'){
            return redirect('permission-error')->with([
                'message' => 'You do not have permission to view this page.',
                'message_important'=>true
            ]);
        } */
    }
    DB::enableQueryLog();
      $department=DB::table('tb_department')->where('branch_code',Auth::user()->school_id)->orderBy('id','desc')->get();
      $category=DB::table('tb_studentcategory')->where('branch_code',Auth::user()->school_id)->orderBy('id','desc')->get();
      $designation=DB::table('tb_degination')->where('branch_code',Auth::user()->school_id)->orderBy('id','desc')->get();
      $userList=DB::table('tb_usertype')->where('branch_code',Auth::user()->school_id)->get();
      $code=DB::table('create_institute')->where('branch_code',Auth::user()->school_id)->get();
      $code = DB::table('create_institute')->select('insitute_code')->get();
      foreach($code as $code){
         $codee=$code->insitute_code;
      }
      $users = DB::table('emp_details')
      ->join('emp_contact', 'emp_details.user_id', '=', 'emp_contact.user_id')
      ->join('users', 'emp_details.user_id', '=', 'users.id')
      ->where('emp_details.user_id',Auth::user()->id)->first();
    //  $query = DB::getQueryLog();




//echo count($users);
//print_r($users);exit;
      //$users=$users+1;
     // $empcode=$codee.env('EMP_code').$users;
    // echo Auth::user()->id;
   //  print_r($users->id);exit;

        return view('Hr_Payroll.emp_management.user_profile',compact('users','department','designation','userList','category'));


}

  public function newusertype(){
    $self='hr/add-userType';
    if (\Auth::user()->user_role!=='1'){
        $get_perm=permission::permitted($self);

        if ($get_perm=='access denied'){
            return redirect('permission-error')->with([
                'message' => 'You do not have permission to view this page.',
                'message_important'=>true
            ]);
        }
    }
     $userList=DB::table('tb_usertype')->where('branch_code',Auth::user()->school_id)->get();
  //   print_r($userList);exit;
     return view('Hr_Payroll.emp_management.newUser_Type',compact('userList'));
  }

  public function newusertypeadd(Request $request){
    $self='hr/add-userType-new';
    if (\Auth::user()->user_role!=='1'){
        $get_perm=permission::permitted($self);

        if ($get_perm=='access denied'){
            return redirect('permission-error')->with([
                'message' => 'You do not have permission to view this page.',
                'message_important'=>true
            ]);
        }
    }
  $usertype=Input::get('userType');
  $created_date = date('d-m-Y H:i:s');
  DB::table('tb_usertype')->insert(['usertype'=>$usertype,'branch_code'=>Auth::user()->school_id,'created_on'=>$created_date]);
         return redirect('hr/add-userType')->with([
              'message' => 'New User Type Added Successfully'
          ]);
  }

  public function adddesignation(Request $request){
  $degination=Input::get('designation');
  $created_date = date('d-m-Y H:i:s');
  DB::table('tb_degination')->insert(['degination'=>$degination,'created_on'=>$created_date,'branch_code'=>Auth::user()->school_id]);
         return redirect('hr/designation')->with([
              'message' => 'New Designation Added Successfully.'
          ]);
  }

  public function designation(){
    $self='designations';
    Auth::user()->user_role;
    if (\Auth::user()->user_role!=='1'){
        $get_perm=permission::permitted($self);

        if ($get_perm=='access denied'){
            return redirect('permission-error')->with([
                'message' => 'You do not have permission to view this page.',
                'message_important'=>true
            ]);
        }
    }
     $tb_degination=DB::table('tb_degination')->where('branch_code',Auth::user()->school_id)->get();
  //   print_r($userList);exit;
     return view('Hr_Payroll.emp_management.designation',compact('tb_degination'));
  }

  public function deletedegination(Request $request,$id){
    $self='hr/delete/degination';
    $get_perm=permission::permitted($self);
        if ($get_perm=='access denied'){
            return redirect('permission-error')->with([
                'message' => 'You do not have permission to view this page',
                'message_important'=>true
            ]);
        }
  if($id!=null){
     DB::table('tb_degination')->where('id','=',Crypt::decrypt($id))->delete();
      return redirect('hr/designation')->with([
          'message' => "designation Details Deleted Successfully."
      ]);
  }else{
      return redirect('hr/designation')->with([
          'message' => "Designation Details Not Found",
          'message_important' => true
      ]);
  }
  }

  public function newdepartment(){
    $self='departments';
    if (\Auth::user()->user_role!=='1'){
        $get_perm=permission::permitted($self);

        if ($get_perm=='access denied'){
            return redirect('permission-error')->with([
                'message' => 'You do not have permission to view this page.',
                'message_important'=>true
            ]);
        }
    }
      $department=DB::table('tb_department')->where('branch_code',Auth::user()->school_id)->orderBy('id','desc')->get();
     return view('Hr_Payroll.emp_management.addDepartment',compact('department'));
  }

  public function addnewdepartment(request $request){

     $departmentname=Input::get('departmentnames');
     $created_date = date('d-m-Y H:i:s');
    DB::table('tb_department')->insert(['department_name'=>$departmentname,'created_date'=>$created_date,'branch_code'=>Auth::user()->school_id]);
           return redirect('hr/department')->with([
                'message' => 'New Department Added Successfully'
            ]);
  }

  public function deletedepartment(Request $request,$id){
    $self='hr/department/delete';
    $get_perm=permission::permitted($self);
        if ($get_perm=='access denied'){
            return redirect('permission-error')->with([
                'message' => 'You do not have permission to view this page',
                'message_important'=>true
            ]);
        }
  if($id!=null){
     DB::table('tb_department')->where('id','=',Crypt::decrypt($id))->delete();
      return redirect('hr/department')->with([
          'message' => "Student Details Deleted Successfully."
      ]);
  }else{
      return redirect('hr/department')->with([
          'message' => "Student Details Not Found",
          'message_important' => true
      ]);
  }
  }

  public function employee(){

    $self='hr/employee';
    if (\Auth::user()->user_role!=='1'){
        $get_perm=permission::permitted($self);

        if ($get_perm=='access denied'){
            return redirect('permission-error')->with([
                'message' => 'You do not have permission to view this page.',
                'message_important'=>true
            ]);
        }
    }
      $department=DB::table('tb_department')->where('branch_code',Auth::user()->school_id)->orderBy('id','desc')->get();
      $category=DB::table('tb_studentcategory')->where('branch_code',Auth::user()->school_id)->orderBy('id','desc')->get();
      $designation=DB::table('tb_degination')->where('branch_code',Auth::user()->school_id)->orderBy('id','desc')->get();
      $userList=DB::table('tb_usertype')->where('branch_code',Auth::user()->school_id)->get();
      $code=DB::table('create_institute')->where('branch_code',Auth::user()->school_id)->get();
      $code = DB::table('create_institute')->select('insitute_code')->get();
      foreach($code as $code){
         $codee=$code->insitute_code;
      }
      $users = DB::table('emp_details')->where('branch_code',Auth::user()->school_id)->count();
      $users=$users+1;
      $empcode=$codee.env('EMP_code').$users;
        return view('Hr_Payroll.emp_management.add-employee',compact('department','designation','userList','category','empcode'));
  }

  public function addemployee(request $request){
    $self='hr/employee/add';
    if (\Auth::user()->user_role!=='1'){
        $get_perm=permission::permitted($self);

        if ($get_perm=='access denied'){
            return redirect('permission-error')->with([
                'message' => 'You do not have permission to view this page.',
                'message_important'=>true
            ]);
        }
    }
    $this->validate($request, [
        'empcode'=>'required|string|max:255|unique:emp_details',
        'joiningdate'=>'required',
        'department'=>'required',
        'designation'=>'required',
        'qualification'=>'required',
        'totalexperience'=>'required',
        'usertype'=>'required',
        'fname'=>'required',
        'emppassword'=>'required',
        'lname'=>'required',
        'dob'=>'required',
        'gender'=>'required',

        'nationality'=>'required',
        'category'=>'required',
        'religion'=>'required',
        'permanentsddress'=>'required',
        'persentddress'=>'required',
        'city'=>'required',
        'pin'=>'required',
        'country'=>'required',
        'state'=>'required',
        'phone'=>'required',
        'email'=>'required'
      ]);
      $empcode=Input::get('empcode');
      $joiningdate=Input::get('joiningdate');
      $department=Input::get('department');
      $designation=Input::get('designation');
      $qualification=Input::get('qualification');
      $totalexperience=Input::get('totalexperience');
      $usertype=Input::get('usertype');
      $fname=Input::get('fname');
      $mname=Input::get('mname');
      $lname=Input::get('lname');
      $dob=Input::get('dob');
      $gender=Input::get('gender');
      $panno=Input::get('panno');
      $pf=Input::get('pf');
      $emppassword=Input::get('emppassword');
      $esi=Input::get('esi');
      $nationality=Input::get('nationality');
      $category=Input::get('category');
      $religion=Input::get('religion');
      $aadharno=Input::get('aadharno');
      $permanentsddress=Input::get('permanentsddress');
      $persentddress=Input::get('persentddress');
      $city=Input::get('city');
      $pin=Input::get('pin');
      $country=Input::get('country');
      $state=Input::get('state');
      $phone=Input::get('phone');
      $email=Input::get('email');

      $created_date = date('d-m-Y H:i:s');
      $name=$fname." ".$mname." ".$lname;
    //  $password="123";
      $passwordd = bcrypt($emppassword);
    $lastid=DB::table('users')->insertGetId(['emp_code'=>$empcode,'name'=>$name,'username'=>$empcode,'email'=>$email,'mobile'=>$phone,'password'=>$passwordd,'school_name'=>Auth::user()->school_name,'school_id'=>Auth::user()->school_id,'user_role'=>$usertype]);
        if($lastid){
            DB::table('emp_details')->insert(['user_id'=>$lastid,'empcode'=>$empcode,'joiningdate'=>$joiningdate,'department'=>$department,'designation'=>$designation,'qualification'=>$qualification,'tot_exp'=>$totalexperience,'user_type'=>$usertype,'fname'=>$fname,'mname'=>$mname,'lname'=>$lname,'dob'=>$dob,'gender'=>$gender
            ,'pan_no'=>$panno,'pf_no'=>$pf,'esi'=>$esi,'nationality'=>$nationality,'category'=>$category,'religion'=>$religion,'aadhar_number'=>$aadharno,'created_date'=>$created_date,'branch_code'=>Auth::user()->school_id]);

            DB::table('emp_contact')->insert(['user_id'=>$lastid,'emp_id'=>$empcode,'permanent_address'=>$permanentsddress,'present_address'=>$persentddress,'city'=>$city,'pin'=>$pin,'country'=>$country,'state'=>$state,'phone'=>$phone,'email'=>$email,'branch_code'=>Auth::user()->school_id,'created_date'=>$created_date]);
            $msg="Employee Registration Completed Successfully";
        }else{
            $msg="Unable to add Employee.Please try again.";
        }
              return redirect('hr/employee')->with([
                 'message' => $msg
             ]);
  }

  public function employeelist(){

    $self='hr/employee/list';
    if (\Auth::user()->user_role!=='1'){
        $get_perm=permission::permitted($self);

        if ($get_perm=='access denied'){
            return redirect('permission-error')->with([
                'message' => 'You do not have permission to view this page.',
                'message_important'=>true
            ]);
        }
    }
      $department=DB::table('tb_department')->where('branch_code',Auth::user()->school_id)->orderBy('id','desc')->get();
      $category=DB::table('tb_studentcategory')->where('branch_code',Auth::user()->school_id)->orderBy('id','desc')->get();
      $designation=DB::table('tb_degination')->where('branch_code',Auth::user()->school_id)->orderBy('id','desc')->get();
      $emplist = DB::table('emp_details')
            ->join('emp_contact', 'emp_details.empcode', '=', 'emp_contact.emp_id')
            ->select('emp_details.*', 'emp_contact.*')->where('emp_details.branch_code',Auth::user()->school_id)->orderBy('id','desc')
            ->get();
          //return view('Hr_Payroll.emp_management.employee-list',compact('department','category','designation','emp','emplist'));
          return view('Hr_Payroll.emp_management.employee-list',compact('department','category','designation','emplist'));
  }
  public function deleteemployee(Request $request,$id){
    $self='hr/employee/delete';
    if (\Auth::user()->user_role!=='1'){
        $get_perm=permission::permitted($self);

        if ($get_perm=='access denied'){
            return redirect('permission-error')->with([
                'message' => 'You do not have permission to view this page.',
                'message_important'=>true
            ]);
        }
    }
    $request->all();
  if($id!=null){
     DB::table('emp_details')->where('empcode','=',$id)->where('branch_code','=',Auth::user()->school_id)->delete();
     DB::table('emp_contact')->where('emp_id','=',$id)->where('branch_code','=',Auth::user()->school_id)->delete();
      return redirect('hr/employee/list')->with([
          'message' => "Employee ".$id." Deleted Successfully"
      ]);
  }else{
      return redirect('hr/employee/list')->with([
          'message' => "Employee Details Not Found.",
          'message_important' => true
      ]);
  }
  }
  public function viweemployee(Request $request,$id){

    $department=DB::table('tb_department')->where('branch_code',Auth::user()->school_id)->orderBy('id','desc')->get();
    $category=DB::table('tb_studentcategory')->where('branch_code',Auth::user()->school_id)->orderBy('id','desc')->get();
    $designation=DB::table('tb_degination')->where('branch_code',Auth::user()->school_id)->orderBy('id','desc')->get();
    $userList=DB::table('tb_usertype')->where('branch_code',Auth::user()->school_id)->get();
    $code=DB::table('create_institute')->where('branch_code',Auth::user()->school_id)->get();
    $code = DB::table('create_institute')->select('insitute_code')->get();
    foreach($code as $code){
       $codee=$code->insitute_code;
    }     if($id!=null)
      {
             /* $emplist = DB::table('emp_details')
              ->join('emp_contact', 'emp_details.empcode', '=', 'emp_contact.emp_id')
              ->select('emp_details.*', 'emp_contact.*')
              ->where('emp_details.empcode',$id)->where('emp_details.branch_code',Auth::user()->school_id)->orderBy('id','desc')
              ->get();*/
              $users = DB::table('emp_details')
              ->join('emp_contact', 'emp_details.user_id', '=', 'emp_contact.user_id')
              ->join('users', 'emp_details.user_id', '=', 'users.id')
              ->where('emp_details.empcode',$id)->first();

              //echo $id;
            //  print_r($users);exit;
           return view('Hr_Payroll.emp_management.edit-employee',compact('users','department','designation','userList','category'));// ['active_parners' => $activepartner]);

      } else
  //$activepartner=DB::table('active_parners')->get();
    return redirect('hr/employee/list')->with([
            'message' => "Academic-Details Info Not Found",
            'message_important' => true
        ]);
  }
  public function updateemployee(Request $request){
    $self='hr/employee/update';
    if (\Auth::user()->user_role!=='1'){
        $get_perm=permission::permitted($self);

        if ($get_perm=='access denied'){
            return redirect('permission-error')->with([
                'message' => 'You do not have permission to view this page.',
                'message_important'=>true
            ]);
        }
    }
    $this->validate($request, [
        'empcode'=>'required',
        'joiningdate'=>'required',
        'department'=>'required',
        'designation'=>'required',
        'qualification'=>'required',
        'totalexperience'=>'required',
        'usertype'=>'required',
        'fname'=>'required',

        'lname'=>'required',
        'dob'=>'required',
        'gender'=>'required',

        'nationality'=>'required',
        'category'=>'required',
        'religion'=>'required',
        'permanentsddress'=>'required',
        'persentddress'=>'required',
        'city'=>'required',
        'pin'=>'required',
        'country'=>'required',
        'state'=>'required',
        'phone'=>'required',
        'email'=>'required'
      ]);
      $empcode=Input::get('empcode');
      $joiningdate=Input::get('joiningdate');
      $department=Input::get('department');
      $designation=Input::get('designation');
      $qualification=Input::get('qualification');
      $totalexperience=Input::get('totalexperience');
      $usertype=Input::get('usertype');
      $fname=Input::get('fname');
      $mname=Input::get('mname');
      $lname=Input::get('lname');
      $dob=Input::get('dob');
      $gender=Input::get('gender');
      $panno=Input::get('panno');
      $pf=Input::get('pf');

      $esi=Input::get('esi');
      $nationality=Input::get('nationality');
      $category=Input::get('category');
      $religion=Input::get('religion');
      $aadharno=Input::get('aadharno');
      $permanentsddress=Input::get('permanentsddress');
      $persentddress=Input::get('persentddress');
      $city=Input::get('city');
      $pin=Input::get('pin');
      $country=Input::get('country');
      $state=Input::get('state');
      $phone=Input::get('phone');
      $email=Input::get('email');

      $created_date = date('d-m-Y H:i:s');
     DB::table('emp_details')->where('branch_code',Auth::user()->school_id)->where('empcode','=',$empcode)->update(['empcode'=>$empcode,'joiningdate'=>$joiningdate,'department'=>$department,'designation'=>$designation,'qualification'=>$qualification,'tot_exp'=>$totalexperience,'user_type'=>$usertype,'fname'=>$fname,'mname'=>$mname,'lname'=>$lname,'dob'=>$dob,'gender'=>$gender
     ,'pan_no'=>$panno,'pf_no'=>$pf,'esi'=>$esi,'nationality'=>$nationality,'category'=>$category,'religion'=>$religion,'aadhar_number'=>$aadharno,'created_date'=>$created_date,'branch_code'=>Auth::user()->school_id]);

     DB::table('emp_contact')->where('branch_code',Auth::user()->school_id)->where('emp_id','=',$empcode)->update(['emp_id'=>$empcode,'permanent_address'=>$permanentsddress,'present_address'=>$persentddress,'city'=>$city,'pin'=>$pin,'country'=>$country,'state'=>$state,'phone'=>$phone,'email'=>$email,'branch_code'=>Auth::user()->school_id,'created_date'=>$created_date]);

            return redirect('hr/employee/list')->with([
                 'message' => 'Employee Registration Completed Successfully'
             ]);
  }
  public function searchemployee(Request $request){
      $department=Input::get('department');
      $dep=$department;
      $designation=Input::get('designation');
      $des=$designation;
      $department=DB::table('tb_department')->where('branch_code',Auth::user()->school_id)->orderBy('id','desc')->get();
    //  $category=DB::table('tb_studentcategory')->where('branch_code',Auth::user()->school_id)->orderBy('id','desc')->get();
    if($dep !="0" && $des=="0"){
      $designation=DB::table('tb_degination')->where('branch_code',Auth::user()->school_id)->orderBy('id','desc')->get();
      $emplist = DB::table('emp_details')
            ->join('emp_contact', 'emp_details.empcode', '=', 'emp_contact.emp_id')
            ->select('emp_details.*', 'emp_contact.*')
            ->where('emp_details.branch_code',Auth::user()->school_id)
            ->where('emp_details.department',$dep)
            ->orderBy('id','desc')
            ->get();
          return view('Hr_Payroll.emp_management.employee-list',compact('department','designation','emplist'));
        }
        if($dep =="0" && $des !="0"){
          $designation=DB::table('tb_degination')->where('branch_code',Auth::user()->school_id)->orderBy('id','desc')->get();
          $emplist = DB::table('emp_details')
                ->join('emp_contact', 'emp_details.empcode', '=', 'emp_contact.emp_id')
                ->select('emp_details.*', 'emp_contact.*')
                ->where('emp_details.branch_code',Auth::user()->school_id)
                ->where('emp_details.designation',$des)
                ->orderBy('id','desc')
                ->get();
              return view('Hr_Payroll.emp_management.employee-list',compact('department','designation','emplist'));
            }
        if($dep !="0" && $des !="0"){
        $designation=DB::table('tb_degination')->where('branch_code',Auth::user()->school_id)->orderBy('id','desc')->get();
        $emplist = DB::table('emp_details')
        ->join('emp_contact', 'emp_details.empcode', '=', 'emp_contact.emp_id')
        ->select('emp_details.*', 'emp_contact.*')
        ->where('emp_details.branch_code',Auth::user()->school_id)
        ->where('emp_details.designation',$des)
        ->where('emp_details.department',$dep)
        ->orderBy('id','desc')
        ->get();
          return view('Hr_Payroll.emp_management.employee-list',compact('department','designation','emplist'));
        }
        if($dep =="0" && $des =="0"){
        $designation=DB::table('tb_degination')->where('branch_code',Auth::user()->school_id)->orderBy('id','desc')->get();
        $emplist = DB::table('emp_details')
        ->join('emp_contact', 'emp_details.empcode', '=', 'emp_contact.emp_id')
        ->select('emp_details.*', 'emp_contact.*')
        ->where('emp_details.branch_code',Auth::user()->school_id)

        ->orderBy('id','desc')
        ->get();
            return view('Hr_Payroll.emp_management.employee-list',compact('department','designation','emplist'));
          }
  }
  public function setroles($id){
  //   $userList=DB::table('tb_usertype')->where('branch_code',Auth::user()->school_id)->get();
  //   print_r($userList);exit;

  $emp_roles=array();
    $emp_roles=EmployeeRoles::where('branch_code',Auth::user()->school_id)->where('id',$id)->get();
foreach ($emp_roles as $emp_roles) {
  // code...
  $emp_roles=$emp_roles;
}


     return view('Hr_Payroll.emp_management.set-roles',compact('emp_roles'));
  }
  /* updateEmployeeSetRoles  Function Start Here */
  public function updateEmployeeSetRoles(Request $request)
  {
      $self='employee-roles';
      if (\Auth::user()->user_role!=='1'){
          $get_perm=permission::permitted($self);

          if ($get_perm=='access denied'){
              return redirect('permission-error')->with([
                  'message' => 'You do not have permission to view this page',
                  'message_important'=>true
              ]);
          }
      }

      $role_id=Input::get('role_id');

      $v=\Validator::make($request->all(),[
          'perms'=>'required','role_id'=>'required'
      ]);

      if ($v->fails()){
          return redirect('hr/employee/set-roles/'.$role_id)->withErrors($v->errors());
      }

      $perms = Input::get('perms');
      if (count($perms) == 0) {
          return redirect('hr/employee/set-roles/'.$role_id)->with([
              'message' => 'Permission not assigned',
              'message_important' => true
          ]);
      }

      EmployeeRolesPermission::where('role_id',$role_id)->where('branch_code',Auth::user()->school_id)->delete();

      foreach($perms as $perm){
          $emp_r_perm=new EmployeeRolesPermission();

          $emp_r_perm->role_id=$role_id;
          $emp_r_perm->perm_id=$perm;
          $emp_r_perm->branch_code=Auth::user()->school_id;
          $emp_r_perm->save();
      }

      return redirect('hr/employee/set-roles/'.$role_id)->with([
          'message'=> 'Permission Updated'
      ]);
  }
  public function empinfo(request $request){
    $eid = $request->eid;
    $empinfo=DB::table('emp_details')->where('branch_code',Auth::user()->school_id)->where('empcode',$eid)->get();
    foreach ($empinfo as $empinfo) {
      // code...
      $reg_no=$empinfo->empcode;
      $department=$empinfo->department;
      $designation=$empinfo->designation;
      $fname=$empinfo->fname;
      $mname=$empinfo->mname;
      $lname=$empinfo->lname;
      $empname=$fname." ".$mname." ".$lname;
      echo $reg_no."|".$empname."|".$department."|".$designation;
    }
  }

  // ---------------------------------------------------------------------------Bikash ------------------------


      public function deleteusertype(Request $request,$id){
        if($id!=null){
            DB::table('tb_usertype')->where('id','=',$id)->where('branch_code',Auth::user()->school_id)->delete();
            return redirect('hr/add-userType')->with([
                'message' => "User Type Deleted Successfully"
            ]);
        }else{
            return redirect('hr/add-userType')->with([
                'message' => "User Type Details Not Found",
                'message_important' => true
            ]);
        }
      }

}

?>
