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
use App\permission;
use App\EmployeeRolesPermission;
use App\EmployeeRoles;
date_default_timezone_set('Asia/Kolkata');
class StudentPromote extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
      $this->middleware('SchoolMiddleware');
  }
  public function promoteStudent(Request $request){
    $data=(array)null;
     $courseList = DB::table('tb_course')
                    ->orderBy('id','ASC')
                    ->get();
    $courseList = json_encode($courseList,true);
    $courseList = json_decode($courseList,true);
    $sessionList = DB::table('academicyear')
                      ->orderBy('startyear','DESC')
                      ->get();
    $sessionList = json_encode($sessionList,true);
    $sessionList = json_decode($sessionList,true);
    if($request->isMethod('post')){
        $acadmic_year=trim(Input::get('acadmic_year'));
        $course=trim(Input::get('course'));
        $batch=trim(Input::get('batch'));
        //getting data from stu_admission table
         $data = DB::table('stu_admission')
                      ->where('accdmic_year',$acadmic_year)
                      ->where('course',$course)
                      ->where('batch',$batch)
                      ->orderBy('roll_no','ASC')
                      ->get();
          $data = json_encode($data,true);
          $data = json_decode($data,true);
          //get Class
          $calss=DB::table('tb_course')
                    ->where('id',$course)
                    ->where('branch_code',2)
                    ->first();
          $calss = json_encode($calss,true);
          $calss = json_decode($calss,true);
          $course_name=$calss['course_name'];
          //get Section
           $batchDetails=DB::table('tb_batch')
                        ->where('id',$batch)
                        ->where('branch_code',2)
                        ->first();
          $batchDetails = json_encode($batchDetails,true);
          $batchDetails = json_decode($batchDetails,true);
          $batch_name=$batchDetails['batch_name'];
          return view('students.promote.studentDetails',compact('acadmic_year','data','course_name','batch_name','sessionList','courseList','course','batch'));
        }else{
         return view('students.promote.studentDetails',compact('courseList','sessionList','data'));
      }
  }
  public function promoteStudentDetails(Request $request){
    $data=(array)null;
    if($request->isMethod('post')){
      $k=0;
      $acadmic_year_data=Input::get('acadmic_year_data');
      $course_data=Input::get('course_data');
      $batch_details=Input::get('batch_details');

      $prev_acadmic_year=Input::get('prev_acadmic_year');
      $prev_course=Input::get('prev_course');
      $batch_data=Input::get('batch_data');

      $status=Input::get('status');
      $statusSize = sizeof($status);
      for($i=0;$i<$statusSize;$i++){
      //  echo $status[$i];exit;
        $data=explode("|",$status[$i]);
        $id=$data[0];
        $reg_no=$data[1];

      $prev_details=DB::table('stu_admission')->where("id",$id)->where('reg_no',$reg_no)->get();
      $updateStatus=DB::table('stu_admission')->where("id",$id)->where('reg_no',$reg_no)->update(["status"=>0]);
      $check=array(
        "acadmic_year"=>$acadmic_year_data,//$prev_details[0]->accdmic_year;
        "reg_no"=>$reg_no,
        "course"=>$course_data
      );
      $cnt=DB::table('stu_admission')->where($check)->count();
      if($cnt==0){
        $saveArray=array(
          "accdmic_year"=>$acadmic_year_data,//$prev_details[0]->accdmic_year;
          "reg_no"=>$reg_no,
          "joining_date"=>$prev_details[0]->joining_date,
          "course"=>$course_data,
          "batch"=>$batch_details,
          "roll_no"=>$prev_details[0]->roll_no,
          "stu_name"=>$prev_details[0]->stu_name,
          "dob"=>$prev_details[0]->dob,
          "gender"=>$prev_details[0]->gender,
          "blood_group"=>$prev_details[0]->blood_group,
          "birth_place"=>$prev_details[0]->birth_place,
          "nationaliy"=>$prev_details[0]->nationaliy,
          "category"=>$prev_details[0]->category,
          "religion"=>$prev_details[0]->religion,
          "aadhar_no"=>$prev_details[0]->aadhar_no,
          "prev_school"=>$prev_details[0]->prev_school,
          "prev_school_address"=>$prev_details[0]->prev_school_address,
          "prev_qualification"=>$prev_details[0]->prev_qualification,
          "acadmic_year"=>$acadmic_year_data,
          "branch_code"=>$prev_details[0]->branch_code,
          "photo_status"=>$prev_details[0]->photo_status,
          "status"=>1,
        );
      $save= DB::table('stu_admission')->insertGetId($saveArray);
      if($save){
        $k++;
      }
      }else{

          $updateArray=array(
            "joining_date"=>$prev_details[0]->joining_date,
            "course"=>$course_data,
            "batch"=>$batch_details,
            "roll_no"=>$prev_details[0]->roll_no,
            "stu_name"=>$prev_details[0]->stu_name,
            "dob"=>$prev_details[0]->dob,
            "gender"=>$prev_details[0]->gender,
            "blood_group"=>$prev_details[0]->blood_group,
            "birth_place"=>$prev_details[0]->birth_place,
            "nationaliy"=>$prev_details[0]->nationaliy,
            "category"=>$prev_details[0]->category,
            "religion"=>$prev_details[0]->religion,
            "aadhar_no"=>$prev_details[0]->aadhar_no,
            "prev_school"=>$prev_details[0]->prev_school,
            "prev_school_address"=>$prev_details[0]->prev_school_address,
            "prev_qualification"=>$prev_details[0]->prev_qualification,
            "photo_status"=>$prev_details[0]->photo_status,
            "status"=>1,
          );
        $update= DB::table('stu_admission')->where("acadmic_year",$acadmic_year_data)->where("reg_no",$reg_no,)->update($updateArray);
        if($update){
          $k++;
        }
      }
    }

    return redirect('student/promotion')->with([
         'message' => $k. ' Students Promoted Successfully.'
     ]);

  }else{
    return redirect('student/promotion')->with([
        'message' => 'Someting Went Worng.',
        'message_important'=>true
    ]);
  }
  }
   public function batchlist(Request $request){
   $cart = array();
   $eid = $request->eid;
   $batch = DB::table('tb_batch')
            ->select('id','batch_name')
            ->where('branch_code',2)
            ->where('id',$eid)
            ->get();
   foreach($batch as $batch){
    array_push($cart,$batch);
   }
    echo json_encode($cart);
  }
}
?>
