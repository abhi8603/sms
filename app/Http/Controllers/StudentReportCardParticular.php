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
class StudentReportCardParticular extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
      $this->middleware('SchoolMiddleware');
  }
  
  public function studentCardReport(Request $request){
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
          return view('reportCard.search_particular',compact('acadmic_year','data','course_name','batch_name','sessionList','courseList','course','batch'));
        }else{
         return view('reportCard.search_particular',compact('courseList','sessionList','data'));
      }
  }
  public function generateReportCard(Request $request){
    $data=(array)null;
    if($request->isMethod('post')){
      $course=Input::get('course');
      $batch=Input::get('batch');
      $acadmic_year=Input::get('acadmic_year');
      $status=Input::get('status');
      $statusSize = sizeof($status);
      for ($i=0; $i<$statusSize; $i++) { 
        $studentData = DB::table('stu_admission')
                      ->where('id',$status[$i])
                      ->first();
        $studentData = json_encode($studentData,true);
        $studentData = json_decode($studentData,true);
        $data[$i]['stu_name']=$studentData['stu_name'];
        $data[$i]['roll_no']=$studentData['roll_no'];
        $data[$i]['dob']=$studentData['dob'];
        $data[$i]['reg_no']=$studentData['reg_no'];
      }
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
      return view('reportCard.particularDetails',compact('acadmic_year','data','course_name','batch_name','course','statusSize'));
    }else{
      return view('reportCard.search_particular',compact('courseList','sessionList','data'));
    }
  }
}
?>
