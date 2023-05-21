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
use App\institute_details;
use Illuminate\Support\Facades\Crypt;
use PDF;
date_default_timezone_set('Asia/Kolkata');
class FeeCollection extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
      $this->middleware('SchoolMiddleware');
  }
  public function feeCollectionDetails(Request $request){
    $data=(array)null;
    $acadmic_year=null;
    $feeslist=null;
    $jan=0;
    $feb=0;
    $march=0;
    $april=0;
    $may=0;
    $june=0;
    $july=0;
    $aug=0;
    $sept=0;
    $oct=0;
    $nov=0;
    $dec=0;
    $sessionList = DB::table('academicyear')
                  ->orderBy('startyear','DESC')
                  ->get();
    $sessionList = json_encode($sessionList,true);
    $sessionList = json_decode($sessionList,true);
    //Start Batch
    $batch = DB::table('tb_batch')
                    ->join('tb_course', 'tb_batch.course', '=', 'tb_course.id')
                    ->select('tb_batch.*', 'tb_course.course_name')
                    ->where('tb_batch.branch_code',2)
                    ->orderBy('tb_course.id','ASC')
                    ->get();
    $batch = json_encode($batch,true);
    $batch = json_decode($batch,true);
    //End Bath
    if($request->isMethod('post')){
        $acadmic_year=Input::get('acadmic_year');
        $course=Input::get('course');
        //start 
          $classSection = DB::table('tb_batch')
                        ->where('branch_code',2)
                        ->where('id',$course)
                        ->get();
          $classSection = json_encode($classSection,true);
          $classSection = json_decode($classSection,true);
        //End
        //Start 
          $couserBatch = DB::table('view_course_batch')
                        ->where('id',$course)
                        ->first(); 
          $couserBatch = json_encode($couserBatch,true);
          $couserBatch = json_decode($couserBatch,true);
        //End
        // Start get student admission
          $studentList = DB::table('stu_admission')
                        ->select('reg_no','course','batch','acadmic_year','roll_no','stu_name')
                        ->where('course',$classSection[0]['course'])
                        ->where('batch',$classSection[0]['id'])
                        ->where('acadmic_year',$acadmic_year)
                        ->where('branch_code',2)
                        ->orderBy('roll_no','ASC')
                        ->get(); 
          $studentList = json_encode($studentList,true);
          $studentList = json_decode($studentList,true);
          foreach ($studentList as $key => $value) {  
              $data[$key]['stu_reg_no']=$value['reg_no'];  
              $data[$key]['roll_no']=$value['roll_no']; 
              $data[$key]['acadmic_year']=$value['acadmic_year'];   
              $data[$key]['stu_name']=$value['stu_name']; 
              $data[$key]['stu_name']=$value['stu_name']; 
              $data[$key]['batch_name']=$couserBatch['batch_name'];
              $data[$key]['course_name']=$couserBatch['course_name'];
              //start Calculation 
                //jan
                $janData = DB::table('fee_collection')
                            ->select(DB::raw('COALESCE(SUM(final_amt),0 )as amount'))
                            ->where('stu_reg_no',$value['reg_no'])
                            ->where('month','01')
                            ->where('section',$couserBatch['id'])
                            ->where('class',$couserBatch['course'])
                            ->where('acadmic_year',$acadmic_year)
                            ->where('branch_code',2)
                            ->where('receipt_status',1)
                            ->first();
                $janData = json_encode($janData,true);
                $janData = json_decode($janData,true);
                $data[$key]['jan']=$janData['amount'];
                //Feb
                 $febData = DB::table('fee_collection')
                            ->select(DB::raw('COALESCE(SUM(final_amt),0 )as amount'))
                            ->where('stu_reg_no',$value['reg_no'])
                            ->where('month','02')
                            ->where('section',$couserBatch['id'])
                            ->where('class',$couserBatch['course'])
                            ->where('acadmic_year',$acadmic_year)
                            ->where('branch_code',2)
                            ->where('receipt_status',1)
                            ->first();
                $febData = json_encode($febData,true);
                $febData = json_decode($febData,true);
                $data[$key]['feb']=$febData['amount'];
                //March
                 $marchData = DB::table('fee_collection')
                            ->select(DB::raw('COALESCE(SUM(final_amt),0 )as amount'))
                            ->where('stu_reg_no',$value['reg_no'])
                            ->where('month','03')
                            ->where('section',$couserBatch['id'])
                            ->where('class',$couserBatch['course'])
                            ->where('acadmic_year',$acadmic_year)
                            ->where('branch_code',2)
                            ->where('receipt_status',1)
                            ->first();
                $marchData = json_encode($marchData,true);
                $marchData = json_decode($marchData,true);
                $data[$key]['march']=$marchData['amount'];
                //April
                 $aprilData = DB::table('fee_collection')
                            ->select(DB::raw('COALESCE(SUM(final_amt),0 )as amount'))
                            ->where('stu_reg_no',$value['reg_no'])
                            ->where('month','04')
                            ->where('section',$couserBatch['id'])
                            ->where('class',$couserBatch['course'])
                            ->where('acadmic_year',$acadmic_year)
                            ->where('branch_code',2)
                            ->where('receipt_status',1)
                            ->first();
                $aprilData = json_encode($aprilData,true);
                $aprilData = json_decode($aprilData,true);
                $data[$key]['april']=$aprilData['amount'];
                //May
                 $mayData = DB::table('fee_collection')
                            ->select(DB::raw('COALESCE(SUM(final_amt),0 )as amount'))
                            ->where('stu_reg_no',$value['reg_no'])
                            ->where('month','05')
                            ->where('section',$couserBatch['id'])
                            ->where('class',$couserBatch['course'])
                            ->where('acadmic_year',$acadmic_year)
                            ->where('branch_code',2)
                            ->where('receipt_status',1)
                            ->first();
                $mayData = json_encode($mayData,true);
                $mayData = json_decode($mayData,true);
                $data[$key]['may']=$mayData['amount'];
                //June
                $juneData = DB::table('fee_collection')
                            ->select(DB::raw('COALESCE(SUM(final_amt),0 )as amount'))
                            ->where('stu_reg_no',$value['reg_no'])
                            ->where('month','06')
                            ->where('section',$couserBatch['id'])
                            ->where('class',$couserBatch['course'])
                            ->where('acadmic_year',$acadmic_year)
                            ->where('branch_code',2)
                            ->where('receipt_status',1)
                            ->first();
                $juneData = json_encode($juneData,true);
                $juneData = json_decode($juneData,true);
                $data[$key]['june']=$juneData['amount'];
                //July
                $julyData = DB::table('fee_collection')
                            ->select(DB::raw('COALESCE(SUM(final_amt),0 )as amount'))
                            ->where('stu_reg_no',$value['reg_no'])
                            ->where('month','07')
                            ->where('section',$couserBatch['id'])
                            ->where('class',$couserBatch['course'])
                            ->where('acadmic_year',$acadmic_year)
                            ->where('branch_code',2)
                            ->where('receipt_status',1)
                            ->first();
                $julyData = json_encode($julyData,true);
                $julyData = json_decode($julyData,true);
                $data[$key]['july']=$julyData['amount'];
                //August
                $augustData = DB::table('fee_collection')
                            ->select(DB::raw('COALESCE(SUM(final_amt),0 )as amount'))
                            ->where('stu_reg_no',$value['reg_no'])
                            ->where('month','08')
                            ->where('section',$couserBatch['id'])
                            ->where('class',$couserBatch['course'])
                            ->where('acadmic_year',$acadmic_year)
                            ->where('branch_code',2)
                            ->where('receipt_status',1)
                            ->first();
                $augustData = json_encode($augustData,true);
                $augustData = json_decode($augustData,true);
                $data[$key]['aug']=$augustData['amount'];
                //September
                $setpData = DB::table('fee_collection')
                            ->select(DB::raw('COALESCE(SUM(final_amt),0 )as amount'))
                            ->where('stu_reg_no',$value['reg_no'])
                            ->where('month','09')
                            ->where('section',$couserBatch['id'])
                            ->where('class',$couserBatch['course'])
                            ->where('acadmic_year',$acadmic_year)
                            ->where('branch_code',2)
                            ->where('receipt_status',1)
                            ->first();
                $setpData = json_encode($setpData,true);
                $setpData = json_decode($setpData,true);
                $data[$key]['sept']=$setpData['amount'];
                //Oct
                $octData = DB::table('fee_collection')
                            ->select(DB::raw('COALESCE(SUM(final_amt),0 )as amount'))
                            ->where('stu_reg_no',$value['reg_no'])
                            ->where('month','10')
                            ->where('section',$couserBatch['id'])
                            ->where('class',$couserBatch['course'])
                            ->where('acadmic_year',$acadmic_year)
                            ->where('branch_code',2)
                            ->where('receipt_status',1)
                            ->first();
                $octData = json_encode($octData,true);
                $octData = json_decode($octData,true);
                $data[$key]['oct']=$octData['amount'];
                //Nov
                $novData = DB::table('fee_collection')
                            ->select(DB::raw('COALESCE(SUM(final_amt),0 )as amount'))
                            ->where('stu_reg_no',$value['reg_no'])
                            ->where('month','11')
                            ->where('section',$couserBatch['id'])
                            ->where('class',$couserBatch['course'])
                            ->where('acadmic_year',$acadmic_year)
                            ->where('branch_code',2)
                            ->where('receipt_status',1)
                            ->first();
                $novData = json_encode($novData,true);
                $novData = json_decode($novData,true);
                $data[$key]['nov']=$novData['amount'];
                //dec
                $decData = DB::table('fee_collection')
                            ->select(DB::raw('COALESCE(SUM(final_amt),0 )as amount'))
                            ->where('stu_reg_no',$value['reg_no'])
                            ->where('month','12')
                            ->where('section',$couserBatch['id'])
                            ->where('class',$couserBatch['course'])
                            ->where('acadmic_year',$acadmic_year)
                            ->where('branch_code',2)
                            ->where('receipt_status',1)
                            ->first();
                $decData = json_encode($decData,true);
                $decData = json_decode($decData,true);
                $data[$key]['dec']=$decData['amount'];
          }
        return view('finance.fee.fee_collection_details',compact('data','batch','sessionList','acadmic_year','course'));
      }else{
           $year = date('Y');
           $year_month = date('Y-m');
           if($year_month>$year.'-'.'03'){
                $acadmic_year= $year.'-'.($year+1);
            }else{
                $acadmic_year =($year-1).'-'.$year;
            }
         return view('finance.fee.fee_collection_details',compact('data','batch','sessionList','acadmic_year'));
      }
  }
}
?>
