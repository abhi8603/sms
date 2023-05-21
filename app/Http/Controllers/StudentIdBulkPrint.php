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
class StudentIdBulkPrint extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
      $this->middleware('SchoolMiddleware');
  }
  
  public function bulkPrint(Request $request,$id=null){
    $data=(array)null;
    $detail=null;
     $courseList = DB::table('tb_course')
                      ->orderBy('id','AESC')
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
         $studentList = DB::table('view_id_card')
                      ->where('acadmic_year',$acadmic_year)
                      ->where('course',$course)
                      ->where('batch',$batch)
                      ->orderBy('id','AESC')
                      ->get();
          $studentList = json_encode($studentList,true);
          $studentList = json_decode($studentList,true);
          if($studentList){
            return view('bulkprint.id_card',compact('studentList'));
          }else{
            echo "<script>alert('Please Upload Student Photo !!');</script>";
            return view('bulkprint.searchBulkPrint',compact('courseList','sessionList'));
          }
        }else{
         return view('bulkprint.searchBulkPrint',compact('courseList','sessionList'));
      }
  }
}
?>
