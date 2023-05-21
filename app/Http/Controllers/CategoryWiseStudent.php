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
class CategoryWiseStudent extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
      $this->middleware('SchoolMiddleware');
  }
  
  public function studentDetails(Request $request){
    $data=(array)null;
    $detail=null;
    $acadmic_year=null;
    $totalStudent=0;
    $totalBoys=0;
    $totalGirls=0;
    $totalBoysGen=0;
    $totalGirlsGen=0;
    $totalGen=0;
    $totalBoysObc=0;
    $totalGirlsObc=0;
    $totalObc=0;
    $totalBoysSc=0;
    $totalGirlsSc=0;
    $totalSc=0;
    $totalBoysSt=0;
    $totalGirlsSt=0;
    $totalSt=0;
    $totalBoysOthers=0;
    $totalGirlsOthers=0;
    $totalOthers=0;
    $sessionList = DB::table('academicyear')
                      ->orderBy('startyear','DESC')
                      ->get();
    $sessionList = json_encode($sessionList,true);
    $sessionList = json_decode($sessionList,true);
    $allCourse = DB::table('tb_course')
                          ->where('branch_code',2)
                          ->get()
                          ->count();  
	$sessionList = json_encode($sessionList,true);
    $sessionList = json_decode($sessionList,true);
	$allCourseDetails = DB::table('tb_course')
                          ->where('branch_code',2)
                          ->get();
    $allCourseDetails = json_encode($allCourseDetails,true);
    $allCourseDetails = json_decode($allCourseDetails,true);   
    if($request->isMethod('post')){
        $acadmic_year=trim(Input::get('acadmic_year'));

          for($i=0;$i<$allCourse;$i++){
			  $data[$i]['course_dt']=$allCourseDetails[$i]['course_name'];
                $totalStudentNursery = DB::table('stu_admission')
                                  ->where(DB::raw('upper(acadmic_year)'),strtoupper($acadmic_year))
                                  ->where('course',($i+1))
                                  ->get()
                                  ->count();
                $data[$i]['totalStudentNursery']=$totalStudentNursery;
                 //total Student
                $totalStudent=$totalStudent+$totalStudentNursery;
                $totalBoysNursery = DB::table('stu_admission')
                                ->where(DB::raw('upper(acadmic_year)'),strtoupper($acadmic_year))
                                ->where(DB::raw('upper(gender)'),strtoupper('Male'))
                                ->where('course',($i+1))
                                ->get()
                                ->count();
            $data[$i]['totalBoysNursery']=$totalBoysNursery;

            //total Boys
            $totalBoys = $totalBoys+$totalBoysNursery;

            $totalGirlsNursery = DB::table('stu_admission')
                                ->where(DB::raw('upper(acadmic_year)'),strtoupper($acadmic_year))
                                ->where(DB::raw('upper(gender)'),strtoupper('Female'))
                                ->where('course',($i+1))
                                ->get()
                                ->count();
            $data[$i]['totalGirlsNursery']=$totalGirlsNursery;

            //total Girls
            $totalGirls=$totalGirls+$totalGirlsNursery;

            $totalBoysGeneralNursery = DB::table('stu_admission')
                                      ->where(DB::raw('upper(acadmic_year)'),strtoupper($acadmic_year))
                                      ->where(DB::raw('upper(gender)'),strtoupper('male'))
                                      ->where(DB::raw('upper(category)'),strtoupper('general'))
                                      ->where('course',($i+1))
                                      ->get()
                                      ->count();
            $data[$i]['totalBoysGeneralNursery']=$totalBoysGeneralNursery;
            //total Boys General
            $totalBoysGen=$totalBoysGen+$totalBoysGeneralNursery;

            $totalGirlsGeneralNursery = DB::table('stu_admission')
                                      ->where(DB::raw('upper(acadmic_year)'),strtoupper($acadmic_year))
                                      ->where(DB::raw('upper(gender)'),strtoupper('female'))
                                      ->where(DB::raw('upper(category)'),strtoupper('general'))
                                      ->where('course',($i+1))
                                      ->get()
                                      ->count();
              $data[$i]['totalGirlsGeneralNursery']=$totalGirlsGeneralNursery;
              $totalGeneralNursery = $totalGirlsGeneralNursery+$totalBoysGeneralNursery;
              //total Girls Gen
              $totalGirlsGen = $totalGirlsGen+$totalGirlsGeneralNursery;
              $data[$i]['totalGeneralNursery']=$totalGeneralNursery;
              $totalBoysObcNursery = DB::table('stu_admission')
                                      ->where(DB::raw('upper(acadmic_year)'),strtoupper($acadmic_year))
                                      ->where(DB::raw('upper(gender)'),strtoupper('male'))
                                      ->where(DB::raw('upper(category)'),strtoupper('obc'))
                                      ->where('course',($i+1))
                                      ->get()
                                      ->count();
              $data[$i]['totalBoysObcNursery']=$totalBoysObcNursery;
              //total boys Obc
              $totalBoysObc=$totalBoysObc+$totalBoysObcNursery;

              $totalGirlsObcNursery = DB::table('stu_admission')
                                      ->where(DB::raw('upper(acadmic_year)'),strtoupper($acadmic_year))
                                      ->where(DB::raw('upper(gender)'),strtoupper('female'))
                                      ->where(DB::raw('upper(category)'),strtoupper('obc'))
                                      ->where('course',($i+1))
                                      ->get()
                                      ->count();
              $data[$i]['totalGirlsObcNursery']=$totalGirlsObcNursery;

              $totalObcNursery = $totalBoysObcNursery+$totalGirlsObcNursery;
              //Total Girs Obc
              $totalGirlsObc=$totalGirlsObc+$totalGirlsObcNursery;

              $data[$i]['totalObcNursery']=$totalObcNursery;

              $totalBoysScNursery = DB::table('stu_admission')
                                      ->where(DB::raw('upper(acadmic_year)'),strtoupper($acadmic_year))
                                      ->where(DB::raw('upper(gender)'),strtoupper('male'))
                                      ->where(DB::raw('upper(category)'),strtoupper('sc'))
                                      ->where('course',($i+1))
                                      ->get()
                                      ->count();
              $data[$i]['totalBoysScNursery']=$totalBoysScNursery;
               //total Boys Sc
              $totalBoysSc=$totalBoysSc+$totalBoysScNursery;
              $totalGirlScNursery = DB::table('stu_admission')
                                      ->where(DB::raw('upper(acadmic_year)'),strtoupper($acadmic_year))
                                      ->where(DB::raw('upper(gender)'),strtoupper('female'))
                                      ->where(DB::raw('upper(category)'),strtoupper('sc'))
                                      ->where('course',($i+1))
                                      ->get()
                                      ->count();
             $data[$i]['totalGirlScNursery']=$totalGirlScNursery;

              $totalScNursery = $totalBoysScNursery+$totalGirlScNursery;
              $data[$i]['totalScNursery']=$totalScNursery;

              //total Girls Sc
              $totalGirlsSc=$totalGirlsSc+$totalGirlScNursery;

              $totalBoysStNursery = DB::table('stu_admission')
                                      ->where(DB::raw('upper(acadmic_year)'),strtoupper($acadmic_year))
                                      ->where(DB::raw('upper(gender)'),strtoupper('male'))
                                      ->where(DB::raw('upper(category)'),strtoupper('st'))
                                      ->where('course',($i+1))
                                      ->get()
                                      ->count();
              $data[$i]['totalBoysStNursery']=$totalBoysStNursery;
              //total Boys st
              $totalBoysSt =$totalBoysSt+$totalBoysStNursery;
              $totalGirlsStNursery = DB::table('stu_admission')
                                      ->where(DB::raw('upper(acadmic_year)'),strtoupper($acadmic_year))
                                      ->where(DB::raw('upper(gender)'),strtoupper('female'))
                                      ->where(DB::raw('upper(category)'),strtoupper('st'))
                                      ->where('course',($i+1))
                                      ->get()
                                      ->count();
              $data[$i]['totalGirlsStNursery']=$totalGirlsStNursery;

              $totalStNursery = $totalBoysStNursery+$totalGirlsStNursery;
              $data[$i]['totalStNursery']=$totalStNursery;
              //total Girls St
              $totalGirlsSt=$totalGirlsSt+$totalGirlsStNursery;


              //Others 

              $totalBoysOthersNursery = DB::table('stu_admission')
                                      ->where(DB::raw('upper(acadmic_year)'),strtoupper($acadmic_year))
                                      ->where(DB::raw('upper(gender)'),strtoupper('male'))
                                      ->where(DB::raw('upper(category)'),'!=',strtoupper('st'))
                                      ->where(DB::raw('upper(category)'),'!=',strtoupper('general'))
                                      ->where(DB::raw('upper(category)'),'!=',strtoupper('obc'))
                                      ->where(DB::raw('upper(category)'),'!=',strtoupper('sc'))
                                      ->where('course',($i+1))
                                      ->get()
                                      ->count();
              $data[$i]['totalBoysOthersNursery']=$totalBoysOthersNursery;
              //total Boys st
              $totalBoysOthers =$totalBoysOthers+$totalBoysOthersNursery;

              $totalGirlsOthersNursery = DB::table('stu_admission')
                                      ->where(DB::raw('upper(acadmic_year)'),strtoupper($acadmic_year))
                                      ->where(DB::raw('upper(gender)'),strtoupper('female'))
                                      ->where(DB::raw('upper(category)'),'!=',strtoupper('st'))
                                      ->where(DB::raw('upper(category)'),'!=',strtoupper('general'))
                                      ->where(DB::raw('upper(category)'),'!=',strtoupper('obc'))
                                      ->where(DB::raw('upper(category)'),'!=',strtoupper('sc'))
                                      ->where('course',($i+1))
                                      ->get()
                                      ->count();
              $data[$i]['totalGirlsOthersNursery']=$totalGirlsOthersNursery;
              $totalOthersNursery = $totalBoysOthersNursery+$totalGirlsOthersNursery;
              $data[$i]['totalOthersNursery']=$totalOthersNursery;
              //total Girls St
              $totalGirlsOthers=$totalGirlsOthers+$totalGirlsOthersNursery;
              //End Others
            } 
            $totalGen=$totalBoysGen+$totalGirlsGen;
            $totalObc=$totalBoysObc+$totalGirlsObc;
            $totalSc=$totalBoysSc+$totalGirlsSc;
            $totalSt=$totalBoysSt+$totalGirlsSt;
            $totalOthers=$totalBoysOthers+$totalGirlsOthers;
          return view('category.category_list',compact('sessionList','data','acadmic_year','totalStudent','totalBoys','totalGirls','totalBoysGen','totalGirlsGen','totalGen','totalBoysObc','totalGirlsObc','totalObc','totalSc','totalBoysSc','totalGirlsSc','totalSt','totalBoysSt','totalGirlsSt','totalBoysOthers','totalGirlsOthers','totalOthers'));
        }else{
           $year = date('Y');
           $year_month = date('Y-m');
           if($year_month>$year.'-'.'03'){
                $acadmic_year= $year.'-'.($year+1);
            }else{
                $acadmic_year =($year-1).'-'.$year;
            }
            for($i=0;$i<$allCourse;$i++){
				$data[$i]['course_dt']=$allCourseDetails[$i]['course_name'];
                $totalStudentNursery = DB::table('stu_admission')
                                  ->where(DB::raw('upper(acadmic_year)'),strtoupper($acadmic_year))
                                  ->where('course',($i+1))
                                  ->get()
                                  ->count();
                $data[$i]['totalStudentNursery']=$totalStudentNursery;
                //total Student
                $totalStudent=$totalStudent+$totalStudentNursery;

                $totalBoysNursery = DB::table('stu_admission')
                                ->where(DB::raw('upper(acadmic_year)'),strtoupper($acadmic_year))
                                ->where(DB::raw('upper(gender)'),strtoupper('Male'))
                                ->where('course',($i+1))
                                ->get()
                                ->count();
               $data[$i]['totalBoysNursery']=$totalBoysNursery;
               //total Boys
               $totalBoys = $totalBoys+$totalBoysNursery;

               $totalGirlsNursery = DB::table('stu_admission')
                                ->where(DB::raw('upper(acadmic_year)'),strtoupper($acadmic_year))
                                ->where(DB::raw('upper(gender)'),strtoupper('Female'))
                                ->where('course',($i+1))
                                ->get()
                                ->count();
              $data[$i]['totalGirlsNursery']=$totalGirlsNursery;
              //total Girls
              $totalGirls=$totalGirls+$totalGirlsNursery;
          
              $totalBoysGeneralNursery = DB::table('stu_admission')
                                      ->where(DB::raw('upper(acadmic_year)'),strtoupper($acadmic_year))
                                      ->where(DB::raw('upper(gender)'),strtoupper('male'))
                                      ->where(DB::raw('upper(category)'),strtoupper('general'))
                                      ->where('course',($i+1))
                                      ->get()
                                      ->count();
              $data[$i]['totalBoysGeneralNursery']=$totalBoysGeneralNursery;
              //total Boys General
              $totalBoysGen=$totalBoysGen+$totalBoysGeneralNursery;

              $totalGirlsGeneralNursery = DB::table('stu_admission')
                                      ->where(DB::raw('upper(acadmic_year)'),strtoupper($acadmic_year))
                                      ->where(DB::raw('upper(gender)'),strtoupper('female'))
                                      ->where(DB::raw('upper(category)'),strtoupper('general'))
                                      ->where('course',($i+1))
                                      ->get()
                                      ->count();
              $data[$i]['totalGirlsGeneralNursery']=$totalGirlsGeneralNursery;
              $totalGeneralNursery = $totalGirlsGeneralNursery+$totalBoysGeneralNursery;
              $data[$i]['totalGeneralNursery']=$totalGeneralNursery;
              //total Girls Gen
              $totalGirlsGen = $totalGirlsGen+$totalGirlsGeneralNursery;
              $totalBoysObcNursery = DB::table('stu_admission')
                                      ->where(DB::raw('upper(acadmic_year)'),strtoupper($acadmic_year))
                                      ->where(DB::raw('upper(gender)'),strtoupper('male'))
                                      ->where(DB::raw('upper(category)'),strtoupper('obc'))
                                      ->where('course',($i+1))
                                      ->get()
                                      ->count();
              $data[$i]['totalBoysObcNursery']=$totalBoysObcNursery;
              //total boys Obc
              $totalBoysObc=$totalBoysObc+$totalBoysObcNursery;
              $totalGirlsObcNursery = DB::table('stu_admission')
                                      ->where(DB::raw('upper(acadmic_year)'),strtoupper($acadmic_year))
                                      ->where(DB::raw('upper(gender)'),strtoupper('female'))
                                      ->where(DB::raw('upper(category)'),strtoupper('obc'))
                                      ->where('course',($i+1))
                                      ->get()
                                      ->count();
              $data[$i]['totalGirlsObcNursery']=$totalGirlsObcNursery;
              $totalObcNursery = $totalBoysObcNursery+$totalGirlsObcNursery;
              $data[$i]['totalObcNursery']=$totalObcNursery;

              //Total Girs Obc
              $totalGirlsObc=$totalGirlsObc+$totalGirlsObcNursery;

              $totalBoysScNursery = DB::table('stu_admission')
                                      ->where(DB::raw('upper(acadmic_year)'),strtoupper($acadmic_year))
                                      ->where(DB::raw('upper(gender)'),strtoupper('male'))
                                      ->where(DB::raw('upper(category)'),strtoupper('sc'))
                                      ->where('course',($i+1))
                                      ->get()
                                      ->count();
              $data[$i]['totalBoysScNursery']=$totalBoysScNursery;
               //total Boys Sc
              $totalBoysSc=$totalBoysSc+$totalBoysScNursery;

              $totalGirlScNursery = DB::table('stu_admission')
                                      ->where(DB::raw('upper(acadmic_year)'),strtoupper($acadmic_year))
                                      ->where(DB::raw('upper(gender)'),strtoupper('female'))
                                      ->where(DB::raw('upper(category)'),strtoupper('sc'))
                                      ->where('course',($i+1))
                                      ->get()
                                      ->count();
              $data[$i]['totalGirlScNursery']=$totalGirlScNursery;
              $totalScNursery = $totalBoysScNursery+$totalGirlScNursery;
              //total Girls Sc
              $totalGirlsSc=$totalGirlsSc+$totalGirlScNursery;

              $data[$i]['totalScNursery']=$totalScNursery;

              $totalBoysStNursery = DB::table('stu_admission')
                                      ->where(DB::raw('upper(acadmic_year)'),strtoupper($acadmic_year))
                                      ->where(DB::raw('upper(gender)'),strtoupper('male'))
                                      ->where(DB::raw('upper(category)'),strtoupper('st'))
                                      ->where('course',($i+1))
                                      ->get()
                                      ->count();
              $data[$i]['totalBoysStNursery']=$totalBoysStNursery;
              //total Boys st
              $totalBoysSt =$totalBoysSt+$totalBoysStNursery;

              $totalGirlsStNursery = DB::table('stu_admission')
                                      ->where(DB::raw('upper(acadmic_year)'),strtoupper($acadmic_year))
                                      ->where(DB::raw('upper(gender)'),strtoupper('female'))
                                      ->where(DB::raw('upper(category)'),strtoupper('st'))
                                      ->where('course',($i+1))
                                      ->get()
                                      ->count();
              $data[$i]['totalGirlsStNursery']=$totalGirlsStNursery;

              $totalStNursery = $totalBoysStNursery+$totalGirlsStNursery;
              $data[$i]['totalStNursery']=$totalStNursery;
              //total Girls St
              $totalGirlsSt=$totalGirlsSt+$totalGirlsStNursery;
              //Others 

              $totalBoysOthersNursery = DB::table('stu_admission')
                                      ->where(DB::raw('upper(acadmic_year)'),strtoupper($acadmic_year))
                                      ->where(DB::raw('upper(gender)'),strtoupper('male'))
                                      ->where(DB::raw('upper(category)'),'!=',strtoupper('st'))
                                      ->where(DB::raw('upper(category)'),'!=',strtoupper('general'))
                                      ->where(DB::raw('upper(category)'),'!=',strtoupper('obc'))
                                      ->where(DB::raw('upper(category)'),'!=',strtoupper('sc'))
                                      ->where('course',($i+1))
                                      ->get()
                                      ->count();
              $data[$i]['totalBoysOthersNursery']=$totalBoysOthersNursery;
              //total Boys st
              $totalBoysOthers =$totalBoysOthers+$totalBoysOthersNursery;

              $totalGirlsOthersNursery = DB::table('stu_admission')
                                      ->where(DB::raw('upper(acadmic_year)'),strtoupper($acadmic_year))
                                      ->where(DB::raw('upper(gender)'),strtoupper('female'))
                                      ->where(DB::raw('upper(category)'),'!=',strtoupper('st'))
                                      ->where(DB::raw('upper(category)'),'!=',strtoupper('general'))
                                      ->where(DB::raw('upper(category)'),'!=',strtoupper('obc'))
                                      ->where(DB::raw('upper(category)'),'!=',strtoupper('sc'))
                                      ->where('course',($i+1))
                                      ->get()
                                      ->count();
              $data[$i]['totalGirlsOthersNursery']=$totalGirlsOthersNursery;
              $totalOthersNursery = $totalBoysOthersNursery+$totalGirlsOthersNursery;
              $data[$i]['totalOthersNursery']=$totalOthersNursery;
              //total Girls St
              $totalGirlsOthers=$totalGirlsOthers+$totalGirlsOthersNursery;
              //End Others
             
            } 
            $totalGen=$totalBoysGen+$totalGirlsGen;
            $totalObc=$totalBoysObc+$totalGirlsObc;
            $totalSc=$totalBoysSc+$totalGirlsSc;
            $totalSt=$totalBoysSt+$totalGirlsSt;
            $totalOthers=$totalBoysOthers+$totalGirlsOthers;	 
         return view('category.category_list',compact('sessionList','data','acadmic_year','totalStudent','totalBoys','totalGirls','totalBoysGen','totalGirlsGen','totalGen','totalBoysObc','totalGirlsObc','totalObc','totalSc','totalBoysSc','totalGirlsSc','totalSt','totalBoysSt','totalGirlsSt','totalBoysOthers','totalGirlsOthers','totalOthers'));
      }
  }
}
?>
