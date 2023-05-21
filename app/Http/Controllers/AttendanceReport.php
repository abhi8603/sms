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
class AttendanceReport extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
      $this->middleware('SchoolMiddleware');
  }
  
  public function studentReport(Request $request){
    $data=(array)null;
    $allDays=(array)null;
    $no_of_days=0;
    $year=0;
    $attendance=null;
    $month=0;
    $acadmic_year=null;
    $course=null;
    $studentSize=0;
    //Start Acadmic Year
      $sessionList = DB::table('academicyear')
                        ->orderBy('startyear','DESC')
                        ->get();
      $sessionList = json_encode($sessionList,true);
      $sessionList = json_decode($sessionList,true);
    //End Acadmic Year
    //Start Batch
      $batchList = DB::table('tb_batch')
                      ->join('tb_course', 'tb_batch.course', '=', 'tb_course.id')
                      ->select('tb_batch.*', 'tb_course.course_name')
                      ->where('tb_batch.branch_code',2)
                      ->orderBy('tb_course.id','ASC')
                      ->get();
      $batchList = json_encode($batchList,true);
      $batchList = json_decode($batchList,true);
    //End Bath
    if($request->isMethod('post')){
        $acadmic_year=Input::get('acadmic_year');
        $month=Input::get('month');
        $course=Input::get('course');
        //Start 
          $couserBatch = DB::table('view_course_batch')
                        ->where('id',$course)
                        ->first(); 
          $couserBatch = json_encode($couserBatch,true);
          $couserBatch = json_decode($couserBatch,true);
        //End
          $class=$couserBatch['course'];
          $section=$couserBatch['id'];
          if($month>3 && $month<=12){
           $year=substr($acadmic_year,0,4);
          }else{
            $year=substr($acadmic_year,5,9);
          }
          //get Number of days
          $no_of_days=cal_days_in_month(CAL_GREGORIAN, $month, $year);
          //Attendance
          $studentData = DB::table('stu_admission')
                          ->select('reg_no','roll_no','stu_name')
                          ->where('acadmic_year',$acadmic_year)
                          ->where('course',$class)
                          ->where('batch',$section)
                          
                          ->get();
          $studentData = json_encode($studentData,true);
          $studentData = json_decode($studentData,true);
          $studentSize = sizeof( $studentData);
          //get total class
          $totalClass = DB::table('stu_attendance')
                                  ->select(DB::raw('DISTINCT day'))
                                  ->where('accadmicyear',$acadmic_year)
                                  ->where('course',$class)
                                  ->where('batch',$section)
                                  ->where('month_number',$month)
                                  ->get()
                                  ->count();
          //get Month
          /*$monthName = DB::table('stu_attendance')
                                  ->select('month')
                                  ->where('accadmicyear',$acadmic_year)
                                  ->where('course',$class)
                                  ->where('batch',$section)
                                  ->where('month_number',$month)
                                  ->first();
          $monthName = json_encode($monthName,true);
          $monthName = json_decode($monthName,true);   */               
          for($i=0;$i<$studentSize;$i++){
            $data[$i]['reg_no']=$studentData[$i]['reg_no'];
            $data[$i]['stu_name']=$studentData[$i]['stu_name'];
            $data[$i]['roll_no']=$studentData[$i]['roll_no'];
            $data[$i]['totalClass']=$totalClass;
            /*$data[$i]['monthName']=$monthName['month'];*/
              for($k=1;$k<=$no_of_days;$k++){
                  $attendanceData = DB::table('stu_attendance')
                                  ->select('status')
                                  ->where(DB::raw('upper(reg_no)'),strtoupper($studentData[$i]['reg_no']))
                                  ->where('accadmicyear',$acadmic_year)
                                  ->where('course',$class)
                                  ->where('batch',$section)
                                  ->where('month_number',$month)
                                
                                  ->first();
                  $attendanceData = json_encode($attendanceData,true);
                  $attendanceData = json_decode($attendanceData,true);
                  if(empty($attendanceData)){
                    $allDays[$k]['status']="";
                  }else{
                    $allDays[$k]['status']=$attendanceData['status'];
                  }
              }
              $data[$i]['allDays']= $allDays;
            }
          return view('students.attendance_report_details',compact('batchList','sessionList','no_of_days','month','data','acadmic_year','course','studentSize'));
        }else{
        return view('students.attendance_report_details',compact('batchList','sessionList','no_of_days','month','data','acadmic_year','course','studentSize'));
      }
  }
}
?>
