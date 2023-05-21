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
class StudentPhotoUpload extends Controller
{
  public function __construct(){
      $this->middleware('auth');
      $this->middleware('SchoolMiddleware');
  }
  public function studentDetails(Request $request,$id=null){
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
        $reg_no=trim(Input::get('reg_no'));
        $id=trim(Input::get('id'));
        $photo_path = Input::file('photo_path');
        $student_photo_id=Input::get('student_photo_id');
        //getting data from stu_admission table
         $studentList = DB::table('stu_admission')
                      ->where('acadmic_year',$acadmic_year)
                      ->where('course',$course)
                      ->where('batch',$batch)
                      ->orderBy('id','ASC')
                      ->get();
        $studentList = json_encode($studentList,true);
        $studentList = json_decode($studentList,true);
          if($id!="" && $reg_no!="" && $student_photo_id==""){
            //CheckInsert Data
            $checkInsert=DB::table('tbl_student_photo')
                      ->where('reg_no',$reg_no)
                      ->where('status',1)
                      ->first();
            $checkInsert = json_encode($checkInsert,true);
            $checkInsert = json_decode($checkInsert,true);
            if($checkInsert){
              return view('bulkprint.serch_upload_student',compact('courseList','sessionList','studentList','acadmic_year','course','batch'));
            }else{
                 $created_on = date('Y-m-d H:i:s');
                 $insertData = DB::table('tbl_student_photo')->insertGetId([
                                                                    'reg_no'=>$reg_no,
                                                                    'created_on'=>$created_on,
                                                                    'stu_admission_id'=>$id
                                                                    ]);
                 if($insertData){
                  //update photo_status
                          $updateData = DB::table('stu_admission')
                              ->where('id',$id)
                                ->update([
                              'photo_status'=>1
                              ]);
                    //Update Photo_path
                        $file_dest ='assets/images/studentPhoto';
                        $finalFilePath=md5($insertData).".".$photo_path->getClientOriginalExtension();        
                        $photo_path->move($file_dest,$finalFilePath);
                          $updateData = DB::table('tbl_student_photo')
                              ->where('id',$insertData)
                                ->update([
                              'photo_path'=>$file_dest.'/'.$finalFilePath
                              ]);
                            //getting data from stu_admission table
                             $studentList = DB::table('stu_admission')
                                          ->where('acadmic_year',$acadmic_year)
                                          ->where('course',$course)
                                          ->where('batch',$batch)
                                          ->orderBy('id','ASC')
                                          ->get();
                            $studentList = json_encode($studentList,true);
                            $studentList = json_decode($studentList,true);
                            echo "<script>alert('Student Photo Uploaded Successfully !!');</script>";
                           /* print_r($studentList);
                            die();*/
                    return view('bulkprint.serch_upload_student',compact('courseList','sessionList','studentList','acadmic_year','course','batch'));
                 }else{
                      echo "<script>alert('Something Wrong!!');</script>";
                     return view('bulkprint.serch_upload_student',compact('courseList','sessionList','studentList','acadmic_year','course','batch'));
                 }
            }
           
          }elseif($id!="" && $reg_no!="" && $student_photo_id!=""){
          //Update Photo_path
            $file_dest ='assets/images/studentPhoto';
            $finalFilePath=md5($student_photo_id).".".$photo_path->getClientOriginalExtension();        
            $photo_path->move($file_dest,$finalFilePath);
              $updateData = DB::table('tbl_student_photo')
                  ->where('id',$student_photo_id)
                    ->update([
                  'photo_path'=>$file_dest.'/'.$finalFilePath,
                  'status'=>1
                  ]);
                 //update photo_status
                    $updateData = DB::table('stu_admission')
                        ->where('id',$id)
                          ->update([
                        'photo_status'=>1
                        ]);
              echo "<script>alert('Student Photo Updated Successfully !!');</script>";
              return view('bulkprint.serch_upload_student',compact('courseList','sessionList','studentList','acadmic_year','course','batch'));
          }else{
             return view('bulkprint.serch_upload_student',compact('courseList','sessionList','studentList','acadmic_year','course','batch'));
          }
        }else if (isset($id)) {
          $studentDetails = DB::table('stu_admission')
                        ->where(DB::raw('md5(id)'),$id)
                        ->first();
          $studentDetails = json_encode($studentDetails,true);
          $studentDetails = json_decode($studentDetails,true);
          //get tbl_student_photo id 
          $student_photo = DB::table('tbl_student_photo')
                        ->select('id as student_photo_id','photo_path')
                        ->where(DB::raw('md5(stu_admission_id)'),$id)
                        ->first();
          $student_photo = json_encode($student_photo,true);
          $student_photo = json_decode($student_photo,true);
          return view('bulkprint.student_details',compact('courseList','sessionList','studentDetails','student_photo'));
        }else{
          $studentList = (array)null;
          return view('bulkprint.serch_upload_student',compact('courseList','sessionList','studentList'));
      }
  }
}
?>
