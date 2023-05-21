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
class CastDetails extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
      $this->middleware('SchoolMiddleware');
  }
  
  public function studentCastDetails(Request $request){
    $data=(array)null;
    $category=(array)null;
    $categorySum=(array)null;
    $acadmic_year=null;
    $courseLength=0;
    $categoryLength=0;
    $totalMale=0;
    $totalFemale=0;
    $totalStudent=0;
    $male=0;
    $female=0;
    $total=0;
    $allMale=0;
    $allFemale=0;
    $all=0;
    $categoryMale=0;
    $categoryFemale=0;
    $categoryTotal=0;
    $z=0;
    //Start Acadmic Year
      $sessionList = DB::table('academicyear')
                        ->orderBy('startyear','DESC')
                        ->get();
      $sessionList = json_encode($sessionList,true);
      $sessionList = json_decode($sessionList,true);
    //End Acadmic Year
    //Start Course 
      $allCourse = DB::table('tb_course')
                            ->select('id','course_name')
                            ->where('branch_code',2)
                            ->orderBy('id','ASC')
                            ->get();
      $allCourse =json_encode($allCourse,true);
      $allCourse=json_decode($allCourse,true);  
      $courseLength = sizeof($allCourse);
    //End Course 
      $totalCategory = DB::table('tb_studentcategory')
                            ->orderBy('id','ASC')
                            ->get();                                      
      $totalCategory =json_encode($totalCategory,true);
      $totalCategory =json_decode($totalCategory,true);  
      $categoryLength =sizeof($totalCategory);
    //Start Category
    if($request->isMethod('post')){
        $acadmic_year=trim(Input::get('acadmic_year'));
          for($i=0;$i<$courseLength;$i++){
              $data[$i]['course'] = $allCourse[$i]['course_name'];
              //Start Total Male
                $totalMale = DB::table('stu_admission')
                                  ->where(DB::raw('upper(acadmic_year)'),strtoupper($acadmic_year))
                                  ->where(DB::raw('upper(gender)'),strtoupper('male'))
                                  ->where('course',($i+1))
                                  ->get()
                                  ->count();
                $data[$i]['totalMale']=$totalMale;
                $allMale=$allMale+$totalMale;
              //End Total Male
              //Start Total Female
                $totalFemale = DB::table('stu_admission')
                              ->where(DB::raw('upper(acadmic_year)'),strtoupper($acadmic_year))
                              ->where(DB::raw('upper(gender)'),strtoupper('feMale'))
                              ->where('course',($i+1))
                              ->get()
                              ->count();
                $data[$i]['totalFemale']=$totalFemale;
              //End Total Female
              //Start Total 
                $data[$i]['totalStudent'] = $totalMale+$totalFemale;
                $allFemale = $allFemale+$totalFemale;
              //End Total
              for($j=0;$j<$categoryLength;$j++){
                //Start Female
                  $female = DB::table('stu_admission')
                            ->where(DB::raw('upper(acadmic_year)'),strtoupper($acadmic_year))
                            ->where(DB::raw('upper(gender)'),strtoupper('female'))
                            ->where(DB::raw('upper(category)'),strtoupper($totalCategory[$j]['stu_category']))
                            ->where('course',($i+1))
                            ->get()
                            ->count();
                  $category[$j]['female'] = $female;
                //End Female 
                //Start Female
                  $male = DB::table('stu_admission')
                            ->where(DB::raw('upper(acadmic_year)'),strtoupper($acadmic_year))
                            ->where(DB::raw('upper(gender)'),strtoupper('male'))
                            ->where(DB::raw('upper(category)'),strtoupper($totalCategory[$j]['stu_category']))
                            ->where('course',($i+1))
                            ->get()
                            ->count();
                  $category[$j]['male'] = $male;
                  //start total
                    $categoryMale=$categoryMale+$male;
                    $categorySum[$j]['categoryMale'] = $categoryMale;
                    /*print_r($categorySum[$j]['categoryMale']."         H");*/
                  //End total

                //End Female 
                //Start Total
                  $category[$j]['total'] = $female+$male;
                //End Total
              }
              $data[$i]['category'] = $category;
          }
          $dataLength = sizeof($data);
          $all = $all+$allMale+$allFemale;
          return view('students.cast_details',compact('sessionList','acadmic_year','totalCategory','data','courseLength','categoryLength','category','dataLength','all','allMale','allFemale'));
        }else{
           $year = date('Y');
           $year_month = date('Y-m');
           if($year_month>$year.'-'.'03'){
                $acadmic_year= $year.'-'.($year+1);
            }else{
                $acadmic_year =($year-1).'-'.$year;
            }
           for($i=0;$i<$courseLength;$i++){
              $data[$i]['course'] = $allCourse[$i]['course_name'];
              //Start Total Male
                $totalMale = DB::table('stu_admission')
                                  ->where(DB::raw('upper(acadmic_year)'),strtoupper($acadmic_year))
                                  ->where(DB::raw('upper(gender)'),strtoupper('male'))
                                  ->where('course',($i+1))
                                  ->get()
                                  ->count();
                $data[$i]['totalMale']=$totalMale;
                $allMale=$allMale+$totalMale;
              //End Total Male
              //Start Total Female
                $totalFemale = DB::table('stu_admission')
                              ->where(DB::raw('upper(acadmic_year)'),strtoupper($acadmic_year))
                              ->where(DB::raw('upper(gender)'),strtoupper('feMale'))
                              ->where('course',($i+1))
                              ->get()
                              ->count();
                $data[$i]['totalFemale']=$totalFemale;
                $allFemale = $allFemale+$totalFemale;
              //End Total Female
              //Start Total 
                $data[$i]['totalStudent'] = $totalMale+$totalFemale;
              //End Total
              for($j=0;$j<$categoryLength;$j++){
                //Start Female
                  $female = DB::table('stu_admission')
                            ->where(DB::raw('upper(acadmic_year)'),strtoupper($acadmic_year))
                            ->where(DB::raw('upper(gender)'),strtoupper('female'))
                            ->where(DB::raw('upper(category)'),strtoupper($totalCategory[$j]['stu_category']))
                            ->where('course',($i+1))
                            ->get()
                            ->count();
                  $category[$j]['female'] = $female;
                //End Female 
                //Start Female
                  $male = DB::table('stu_admission')
                            ->where(DB::raw('upper(acadmic_year)'),strtoupper($acadmic_year))
                            ->where(DB::raw('upper(gender)'),strtoupper('male'))
                            ->where(DB::raw('upper(category)'),strtoupper($totalCategory[$j]['stu_category']))
                            ->where('course',($i+1))
                            ->get()
                            ->count();
                  $category[$j]['male'] = $male;
                //End Female 
                //Start Total
                  $category[$j]['total'] = $female+$male;
                //End Total
              }
              $data[$i]['category'] = $category;
          }             
          $dataLength = sizeof($data);
          $all = $all+$allMale+$allFemale;
      return view('students.cast_details',compact('sessionList','acadmic_year','totalCategory','data','courseLength','categoryLength','category','dataLength','all','allMale','allFemale'));
      }
  }
}
?>
