<?php
namespace App;
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
use Illuminate\Support\Facades\Validator;

use Illuminate\Foundation\Auth\RegistersUsers;
use App\permission;
use App\EmployeeRolesPermission;
use App\EmployeeRoles;
use PHPExcel;
use PHPExcel_IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Response;
date_default_timezone_set('Asia/Kolkata');
class ExamController extends Controller
{
  public $srow,$erow,$scol,$ecol;
  public function __construct()
  {
      $this->middleware('auth');
      $this->middleware('SchoolMiddleware');
  }
function resultReleaseCancel($id,$session){
  if(isset($id)){
    DB::table('result_release')->where('id',$id)->update(['status'=>0]);
    return redirect('Exam/result/release/'.$session)->with([
        'message' => 'Result Released cancel Succesfully.',
    ]);
  }else{
    return redirect('Exam/result/release/'.$session)->with([
        'message' => 'Something Went Worng.Please try again.',
        'message_important'=>true
    ]);
  }
}
function resultReleaseSave(Request $request){
  $session=input::get('academicyear');
  $exam=input::get('exam');
  $course=input::get('course');
  $saveData=array(
    "session"=>$session,
    "class"=>$course,
    "exam"=>$exam,
    "status"=>1,
    "release_by"=>Auth::user()->username,
  );
//  print_r($saveData);exit;
  $where=array(
    "session"=>$session,
    "class"=>$course,
    "exam"=>$exam,
    "status"=>1,
  );
  $cnt=DB::table('result_release')->where($where)->count();
  if($cnt==0){
  $save=DB::table('result_release')->insertGetId($saveData);
  if($save){
    return redirect('Exam/result/release/'.$session)->with([
        'message' => 'Result Released Succesfully.',
    ]);
  }else{
    return redirect('Exam/result/release/'.$session)->with([
        'message' => 'Something Went Worng.Please try again.',
        'message_important'=>true
    ]);
  }
}else{
  return redirect('Exam/result/release/'.$session)->with([
      'message' => 'Result Already Released.',
      'message_important'=>true
  ]);
}
}
function resultRelease($session=null){
  //echo $session;exit;
  $course=DB::table('tb_course')->where('branch_code',Auth::user()->school_id)->get();
  $accadmicyear = DB::table('academicyear')
  ->where('branch_code',Auth::user()->school_id)->orderBy('startyear','desc')
  ->get();
  $exam=DB::table('tb_exam')->where('id','!=','12')->where('branch_code',Auth::user()->school_id)->get();
  $result_release=DB::table('result_release')
  ->join('tb_course','result_release.class','tb_course.id')
  ->join('tb_exam','result_release.exam','tb_exam.id')
  ->select('result_release.*','tb_course.course_name','tb_exam.exam_name')
  ->where('result_release.session',$session)
  ->orderBy('result_release.id','desc')->get();



  return view('Exam.resultRelease',compact('course','accadmicyear','exam','result_release'));
}

	
  function marksSubmitReportSearch(Request $request){
    $course=Input::get("course");
	$batch=Input::get("batch");
    $session= Input::get("academicyear");
    $exam=Input::get("exam");
    $list = DB::select(DB::raw("SELECT X.*,ex.exam_name FROM (SELECT X.*,f.batch_name,g.exam,e.name,g.id AS submit_id,if(g.id IS NULL,'Not Submitted','Submitted') AS submit_status,g.created_at FROM (
             SELECT b.id,b.subject_name,c.id AS course,c.course_name,
             d.emp_id,d.batch ,a.acadmic_year FROM assign_subject a
             INNER JOIN tb_subject b ON a.subject=b.id
             INNER JOIN tb_course c ON a.course=c.id
             INNER JOIN subject_allocation d ON a.subject=d.subject AND a.acadmic_year=d.acadmic_year AND a.course=d.course
             WHERE a.acadmic_year=:sessions AND a.`status`=1
             GROUP BY a.id,a.course,a.subject) X
             INNER JOIN users e ON e.emp_code=x.emp_id
             INNER JOIN tb_batch f ON x.batch=f.id
             LEFT JOIN marks_submit_status g ON x.id=g.sub_code  AND x.acadmic_year=g.academic_year AND g.`status`=1 #AND g.exam=9
             AND x.course=g.class AND x.batch=g.section
             ORDER BY x.course,x.batch DESC) x
             left JOIN tb_exam ex ON x.exam=ex.id
             WHERE x.course=:course AND x.acadmic_year=:session AND x.exam=:exam AND x.batch=:batch"), array(
    'sessions' =>$session,
   'course' => $course,
   'session' =>$session,
   'exam' => $exam,
   'batch'=>$batch
 ));

 $course=DB::table('tb_course')->where('branch_code',Auth::user()->school_id)->get();
 $accadmicyear = DB::table('academicyear')
 ->where('branch_code',Auth::user()->school_id)->orderBy('startyear','desc')
 ->get();
 $exam=DB::table('tb_exam')->where('id','!=','12')->where('branch_code',Auth::user()->school_id)->get();
 return view('Exam.marksSubmitReport',compact('course','accadmicyear','exam','list'));

  }

  function marksSubmitReportRepoen($id){
    DB::table('marks_submit_status')->where('id',$id)->update(['status'=>'2']);
    return redirect('Exam/marksSubmit/report')->with([
        'message' => 'Marks Submit Status Changed Succesfully.',
        'message_important'=>true
    ]);
  }

  function marksSubmitReport(){
    $course=DB::table('tb_course')->where('branch_code',Auth::user()->school_id)->get();
    $accadmicyear = DB::table('academicyear')
    ->where('branch_code',Auth::user()->school_id)->orderBy('startyear','desc')
    ->get();

    $list = DB::select( DB::raw("    SELECT X.*,ex.exam_name FROM (SELECT X.*,f.batch_name,g.exam,e.name,g.id AS submit_id,if(g.id IS NULL,'Not Submitted','Submitted') AS submit_status,g.created_at FROM (
             SELECT b.id,b.subject_name,c.id AS course,c.course_name,
             d.emp_id,d.batch ,a.acadmic_year FROM assign_subject a
             INNER JOIN tb_subject b ON a.subject=b.id
             INNER JOIN tb_course c ON a.course=c.id
             INNER JOIN subject_allocation d ON a.subject=d.subject AND a.acadmic_year=d.acadmic_year AND a.course=d.course
             WHERE a.acadmic_year='2020-2021' AND a.`status`=1
             GROUP BY a.id,a.course,a.subject) X
             INNER JOIN users e ON e.emp_code=x.emp_id
             INNER JOIN tb_batch f ON x.batch=f.id
             LEFT JOIN marks_submit_status g ON x.id=g.sub_code  AND x.acadmic_year=g.academic_year AND g.`status`=1 #AND g.exam=9
             AND x.course=g.class AND x.batch=g.section
             ORDER BY x.course,x.batch DESC) x
             left JOIN tb_exam ex ON x.exam=ex.id"), array());



    $exam=DB::table('tb_exam')->where('id','!=','12')->where('branch_code',Auth::user()->school_id)->get();
    return view('Exam.marksSubmitReport',compact('course','accadmicyear','exam','list'));
  }

	
	public static function getGradingSuject($subject){
//  $subject=69;
  $isGraded=DB::table('tb_subject')->where('id',$subject)->where('elective','Yes')->count();
  if($isGraded){
    return true;
  }else{
    return false;
  }
  //echo $isGraded;exit;
}
  public static function getptFirstMarks($subject,$reg_no,$cid,$batch,$session){
    $ptfirst = DB::table('personallity_traits_exam')->where('exam','7')
              ->where('session',$session)->where('course',$cid)
              ->where('batch',$batch)->where('reg_no',$reg_no)
              ->get();
          //  print_r($ptfirst[0]->cleanliness);exit;
    return $ptfirst;
  }

  public static function getptSecondMarks($subject,$reg_no,$cid,$batch,$session){
    $ptSecond = DB::table('personallity_traits_exam')->where('exam','8')
              ->where('session',$session)->where('course',$cid)
              ->where('batch',$batch)->where('reg_no',$reg_no)
              ->get();
            //  print_r($ptSecond);exit;
            //  print_r($ptSecond[0]->cleanliness);exit;
    return $ptSecond;
  }

  public static function getptFinalMarks($subject,$reg_no,$cid,$batch,$session){
    $ptFinal = DB::table('personallity_traits_exam')->where('exam','9')
              ->where('session',$session)->where('course',$cid)
              ->where('batch',$batch)->where('reg_no',$reg_no)
              ->get();
            //  print_r($ptFinal);exit;
          //  print_r($ptFinal[0]->cleanliness);exit;
    return $ptFinal;
  }

  public static function getmonthlyMarks($subject,$reg_no,$cid,$batch,$session){
    $result = DB::table('monthly_exam')->select(DB::raw('SUM(marks) as marks'))
    ->where('subject',$subject)->where('session',$session)
    ->where('course',$cid)->where('batch',$batch)
    ->where('reg_no',$reg_no)->get();
  //  print_r($result);exit;
    return $result;
  }

  public static function getannualTermMarks($subject,$reg_no,$cid,$batch,$session){
    $result=  DB::table('mark_register')->select(DB::raw('marks'))->where('exam','9')
    ->where('subject',$subject)->where('academic_year',$session)
    ->where('course',$cid)->where('batch',$batch)->where('register_no',$reg_no)->first();
    return $result;
  }

  public static function getSecondTermMarks($subject,$reg_no,$cid,$batch,$session){
  $result=  DB::table('mark_register')->select(DB::raw('marks'))->where('exam','8')
    ->where('subject',$subject)->where('academic_year',$session)
    ->where('course',$cid)->where('batch',$batch)->where('register_no',$reg_no)->first();
    return $result;
  }
  public static function getFirstTermMarks($subject,$reg_no,$cid,$batch,$session){
  $result=  DB::table('mark_register')->select(DB::raw('marks'))->where('exam','7')
    ->where('subject',$subject)->where('academic_year',$session)
    ->where('course',$cid)->where('batch',$batch)->where('register_no',$reg_no)->first();
    //print_r($result);exit;
    return $result;
  }

  function final_result_print(){
    $course=DB::table('tb_course')->where('branch_code',Auth::user()->school_id)->get();
  $accadmicyear = DB::table('academicyear')
  ->where('branch_code',Auth::user()->school_id)->orderBy('startyear','desc')
  ->get();
   $exam=DB::table('tb_exam')->where('id','9')->where('branch_code',Auth::user()->school_id)->get();
  return view('Exam.final_result_print',compact('course','accadmicyear','exam'));
  }
function finalResultPrint(){
    $course=DB::table('tb_course')->where('branch_code',Auth::user()->school_id)->get();
  $accadmicyear = DB::table('academicyear')
  ->where('branch_code',Auth::user()->school_id)->orderBy('startyear','desc')
  ->get();
   $exam=DB::table('tb_exam')->where('id','9')->where('branch_code',Auth::user()->school_id)->get();
   $individual=true;
  return view('Exam.final_result_print',compact('course','accadmicyear','exam','individual'));
  }
  function final_result_print_back(Request $request){
    set_time_limit(0);
    ini_set('memory_limit', '1G');
    $session=input::get('academicyear');
    $exam=input::get('exam');
    $cid=input::get('course');
    $batch=input::get('batch');
  	$reg_no=input::get('reg_no');
    $individual=input::get('individual');
    $nextClass="";
    $currentClass=DB::table('tb_course')->where('id',$cid)->get();
    if(isset($currentClass)){
        $cname=$currentClass[0]->course_name;
            if($cname=="Nursery"){
          $nextClass="JR KG";
        }elseif($cname=="JR KG"){
          $nextClass="SR KG";
        }elseif ($cname=="SR KG") {
          $nextClass="I";
        }elseif ($cname=="I") {
          $nextClass="II";
        }elseif ($cname=="II") {
          $nextClass="III";
        }elseif ($cname=="III") {
          $nextClass=="IV";
        }elseif ($cname=="IV") {
          $nextClass="V";
        }elseif ($cname=="V") {
          $nextClass="VI";
        }elseif ($cname=="VI") {
          $nextClass="VII";
        }elseif ($cname=="VII") {
          $nextClass="VIII";
        }elseif ($cname=="VIII") {
          $nextClass="IX";
        }elseif ($cname=="IX") {
          $nextClass="X";
        }elseif ($cname=="X") {
          $nextClass="XI";
        }elseif ($cname=="XI") {
          $nextClass="XII";
        }elseif ($cname=="XI-Science") {
          $nextClass="XII-Science";
        }elseif ($cname=="XI-Commerce") {
          $nextClass="XII-Commerce";
        }else {
          $nextClass="";
        }
    }
  //  echo $nextClass;exit;
	    if(!$individual || empty($individual)){
    $stu_list= DB::table('stu_admission')
                  ->join('tb_course', 'stu_admission.course', '=', 'tb_course.id')
                  ->join('tb_batch', 'stu_admission.batch', '=', 'tb_batch.id')
                  ->LeftJoin('stu_attendance',function($join){
                    $join->on("stu_attendance.reg_no","=","stu_admission.reg_no")
                        ->on("stu_attendance.course","=","stu_admission.course")
                        ->on("stu_attendance.accadmicyear","=","stu_admission.acadmic_year")
                        ->on("stu_attendance.status","=",DB::raw("'P'"));
                })
                  ->select('stu_admission.*',DB::raw('count(stu_attendance.id) as total_attendance') ,'tb_course.course_name', 'tb_batch.batch_name')
                  ->where('stu_admission.course',$cid)
                  ->where('stu_admission.batch',$batch)
                  ->where('stu_admission.acadmic_year',$session)
                 // ->limit(2)
                 ->groupBy("stu_admission.reg_no")
                  ->get();
		}else{
		  $stu_list= DB::table('stu_admission')
                                ->join('tb_course', 'stu_admission.course', '=', 'tb_course.id')
                                ->join('tb_batch', 'stu_admission.batch', '=', 'tb_batch.id')
                                ->LeftJoin('stu_attendance',function($join){
                                  $join->on("stu_attendance.reg_no","=","stu_admission.reg_no")
                                      ->on("stu_attendance.course","=","stu_admission.course")
                                      ->on("stu_attendance.accadmicyear","=","stu_admission.acadmic_year")
                                      ->on("stu_attendance.status","=",DB::raw("'P'"));
                              })
                                ->select('stu_admission.*',DB::raw('count(stu_attendance.id) as total_attendance') ,'tb_course.course_name', 'tb_batch.batch_name')
                                ->where('stu_admission.course',$cid)
                                ->where('stu_admission.batch',$batch)
                                ->where('stu_admission.acadmic_year',$session)
                                ->where('stu_admission.reg_no',$reg_no)
                              //  ->limit(2)
                               ->groupBy("stu_admission.reg_no")
                                ->get();
		}
      //           print_r($stu_list);exit;
   $subjects=DB::table('assign_subject')
                  ->join('tb_subject','assign_subject.subject','=','tb_subject.id')
                  ->select('assign_subject.*','tb_subject.subject_name','tb_subject.elective')
                  ->where('assign_subject.acadmic_year',$session)
                  ->where('assign_subject.course',$cid)
                    //  ->where('assign_subject.batch',$batch)
                  ->groupBy('assign_subject.subject')
                  ->get();
    $workingdays=DB::table('working_days')->where('class',$cid)->where('session',$session)->get();

    $noOfStu=count($stu_list);
//print_r($subjects);exit;
//   return view('Exam.downloadResultBack', compact('workingdays','stu_list','subjects','session','cid','batch','noOfStu'));exit;

    $pdf = PDF::loadView('Exam.downloadResultBack', compact('nextClass','workingdays','stu_list','subjects','session','cid','batch','noOfStu'));
    //$pdf->set_option('isHtml5ParserEnabled', true);
    return $pdf->download($session.'.pdf');

  }

function downloadResultfinalBunch(Request $request,$cid,$session,$batch,$exam){
//  echo $session;exit;
  $spreadsheet = new Spreadsheet();
  $sheet = $spreadsheet->getActiveSheet();
  $writer = new Xlsx($spreadsheet);
  $spreadsheet->getActiveSheet()->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
  $spreadsheet->getActiveSheet()->getPageSetup()->setPaperSize(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_A4);
  $spreadsheet->getActiveSheet()->getPageSetup()->setFitToWidth(1);
  $spreadsheet->getActiveSheet()->getPageSetup()->setFitToHeight(0);

  $examtype=DB::table('tb_exam')->where('id',$exam)->get();
  foreach($examtype as $examtype){
      $examname=$examtype->exam_name;
  }

   $style=array(
          'alignment' => array(
                  'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                  'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ),
          'font' => array(
                  //'bold' => true,
                  //'color' => array('rgb' => 'FF0000'),
                  'size' => 18,
                  'name' => 'Arial'

           ),
          'borders' => array(
                  'allborders' => array(
                      'style' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
                  )
          )
         );

      $sheet->getStyle('A1:B1')->applyFromArray($style);
      $spreadsheet->getActiveSheet()->getStyle('B1')->applyFromArray($style);
      $spreadsheet->setActiveSheetIndex(0);


     // $drawing->setPath(asset(app_config('AppLogo',Auth::user()->school_id)));

      $spreadsheet->getActiveSheet()->setTitle("Result");



     $spreadsheet->getActiveSheet()->getStyle('E1:J1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $spreadsheet->getActiveSheet()->mergeCells('A1:B1');
      $spreadsheet->getActiveSheet()->mergeCells('G1:P1');
      $spreadsheet->getActiveSheet()->getStyle('A1'.$this->erow)->getAlignment()->setWrapText(true);
      $spreadsheet->getActiveSheet()->getStyle('G1'.$this->erow)->getAlignment()->setWrapText(true);
      $spreadsheet->getActiveSheet()->setCellValue('G1'.$this->erow, Auth::user()->school_name);
      $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(35);

     // $spreadsheet->getActiveSheet()->setCellValue('A1', 'www.phpexcel.net');
    //    $spreadsheet->getActiveSheet()->getCell('A1')->setPath()->setUrl(asset(app_config('AppLogo',Auth::user()->school_id)));


      $spreadsheet->getActiveSheet()->getStyle('C2:J2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $spreadsheet->getActiveSheet()->mergeCells('A2:B2');
      $spreadsheet->getActiveSheet()->mergeCells('G2:P2');
      $spreadsheet->getActiveSheet()->getStyle('A2'.$this->erow)->getAlignment()->setWrapText(true);
      $spreadsheet->getActiveSheet()->getStyle('G2'.$this->erow)->getAlignment()->setWrapText(true);
      $spreadsheet->getActiveSheet()->setCellValue('G2'.$this->erow, institute_details('2','insitute_address'));
      $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(35);

      $spreadsheet->getActiveSheet()->getStyle('C3:J3')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $spreadsheet->getActiveSheet()->mergeCells('A3:B3');
      $spreadsheet->getActiveSheet()->mergeCells('G3:P3');
      $spreadsheet->getActiveSheet()->getStyle('G3'.$this->erow)->getAlignment()->setWrapText(true);
      $spreadsheet->getActiveSheet()->setCellValue('G3'.$this->erow, "Phone No : ".institute_details('2','insitute_mobile'));
      $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(35);


      $spreadsheet->getActiveSheet()->getStyle('G5:P5')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $spreadsheet->getActiveSheet()->mergeCells('G5:P5');

      $spreadsheet->getActiveSheet()->getStyle('G5'.$this->erow)->getAlignment()->setWrapText(true);
      $spreadsheet->getActiveSheet()->getStyle('G5'.$this->erow)->getAlignment()->setWrapText(true);
      $spreadsheet->getActiveSheet()->setCellValue('G5'.$this->erow, $examname." - ".$session);
      $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(35);

      $stu_list= DB::table('stu_admission')
              ->join('tb_course', 'stu_admission.course', '=', 'tb_course.id')
              ->join('tb_batch', 'stu_admission.batch', '=', 'tb_batch.id')
              ->select('stu_admission.*', 'tb_course.course_name', 'tb_batch.batch_name')
              ->where('stu_admission.course',$cid)
              ->where('stu_admission.batch',$batch)
              ->where('stu_admission.acadmic_year',$session)
              ->get();
            //  echo "<pre>";print_r($stu_list);exit;
            $x=7;
            $ff=0;
     foreach ($stu_list as $stu_list) {
      // $ff++;
      // if($ff<=2){
       // code...
$reg_no=$stu_list->reg_no;
      $stu_details = DB::table('stu_admission')
              ->join('tb_course', 'stu_admission.course', '=', 'tb_course.id')
              ->join('tb_batch', 'stu_admission.batch', '=', 'tb_batch.id')
              ->select('stu_admission.*', 'tb_course.course_name', 'tb_batch.batch_name')
              ->where('stu_admission.course',$cid)
              ->where('stu_admission.batch',$batch)
              ->where('stu_admission.reg_no',$stu_list->reg_no)
              ->where('stu_admission.acadmic_year',$session)
              ->get();

  foreach($stu_details as $stu_details){
      $stu_name=$stu_details->stu_name;
      $course_name=$stu_details->course_name;
      $batch_name=$stu_details->batch_name;
  }



  //    $spreadsheet->getActiveSheet()->getStyle('D6')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    //  $spreadsheet->getActiveSheet()->mergeCells('A6:C6');



//  $spreadsheet->getActiveSheet()->mergeCells('B'.$i.':' .'C'.$i);
      $spreadsheet->getActiveSheet()->mergeCells('H'.$x.':'.'K'.$x);
      $spreadsheet->getActiveSheet()->getStyle('H'.$x.$this->erow)->getAlignment()->setWrapText(true);

      $spreadsheet->getActiveSheet()->setCellValue('H'.$x.$this->erow, "Name : ".$stu_name);
      $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);


   //   $spreadsheet->getActiveSheet()->getStyle('H6')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    //  $spreadsheet->getActiveSheet()->mergeCells('A6:C6');
    //  $spreadsheet->getActiveSheet()->mergeCells('M7:O7');
        $spreadsheet->getActiveSheet()->mergeCells('M'.$x.':'.'O'.$x);
      $spreadsheet->getActiveSheet()->getStyle('M'.$x.$this->erow)->getAlignment()->setWrapText(true);
      $spreadsheet->getActiveSheet()->setCellValue('M'.$x.$this->erow, "Reg. No. : ". $reg_no);
      $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);
      $x++;
     $spreadsheet->getActiveSheet()->getStyle('I'.$x)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    // $spreadsheet->getActiveSheet()->getStyle('H8')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

      $spreadsheet->getActiveSheet()->getStyle('I'.$x.$this->erow)->getAlignment()->setWrapText(true);
      $spreadsheet->getActiveSheet()->getStyle('H'.$x.$this->erow)->getAlignment()->setWrapText(true);
      $spreadsheet->getActiveSheet()->setCellValue('H'.$x.$this->erow, "Class : ");
      $spreadsheet->getActiveSheet()->setCellValue('I'.$x.$this->erow, $course_name);
      $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);


     //  $spreadsheet->getActiveSheet()->mergeCells('A6:C6');
     // $spreadsheet->getActiveSheet()->mergeCells('H7');
      $spreadsheet->getActiveSheet()->getStyle('M'.$x)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

      $spreadsheet->getActiveSheet()->getStyle('M'.$x.$this->erow)->getAlignment()->setWrapText(true);
      $spreadsheet->getActiveSheet()->getStyle('N'.$x.$this->erow)->getAlignment()->setWrapText(true);
      $spreadsheet->getActiveSheet()->setCellValue('M'.$x.$this->erow, "Section : ");
      $spreadsheet->getActiveSheet()->setCellValue('N'.$x.$this->erow, $batch_name);
      $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);
      $x=$x+2;
      $spreadsheet->getActiveSheet()->getStyle('A'.$x.':'.'V'.$x)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
      $spreadsheet->getActiveSheet()->getStyle('A'.$x.':'.'V'.$x)->getFill()->getStartColor()->setARGB('CCCC');
     // $spreadsheet->getActiveSheet()->getStyle('A10:V10')->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_RED);


      $spreadsheet->getActiveSheet()->mergeCells('B'.$x.':'.'C'.$x);
      $spreadsheet->getActiveSheet()->getStyle('B'.$x.':'.'C'.$x)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

      $spreadsheet->getActiveSheet()->getStyle('B'.$x.$this->erow)->getAlignment()->setWrapText(true);
      $spreadsheet->getActiveSheet()->getStyle('B'.$x.$this->erow)->getAlignment()->setWrapText(true);
      $spreadsheet->getActiveSheet()->getStyle('B'.$x.$this->erow)->getFont()->setBold(true);
      $spreadsheet->getActiveSheet()->setCellValue('B'.$x.$this->erow, "Subject");
      $spreadsheet->getActiveSheet()->getStyle('B'.$x.$this->erow)->getFont()->setSize(10);
      $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);


      $spreadsheet->getActiveSheet()->mergeCells('D'.$x.':'.'E'.$x);
      $spreadsheet->getActiveSheet()->getStyle('D'.$x.':'.'E'.$x)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

      $spreadsheet->getActiveSheet()->getStyle('D'.$x.$this->erow)->getAlignment()->setWrapText(true);
      $spreadsheet->getActiveSheet()->getStyle('D'.$x.$this->erow)->getAlignment()->setWrapText(true);
      $spreadsheet->getActiveSheet()->setCellValue('D'.$x.$this->erow, "1st Term (100 marks)");
      $spreadsheet->getActiveSheet()->getStyle('D'.$x.$this->erow)->getFont()->setBold(true);
      $spreadsheet->getActiveSheet()->getStyle('D'.$x.$this->erow)->getFont()->setSize(10);
      $spreadsheet->getActiveSheet()->getRowDimension('10')->setRowHeight(35);


      $spreadsheet->getActiveSheet()->mergeCells('F'.$x.':'.'G'.$x);
         $spreadsheet->getActiveSheet()->getStyle('F'.$x.':'.'G'.$x)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

      $spreadsheet->getActiveSheet()->getStyle('F'.$x.$this->erow)->getAlignment()->setWrapText(true);
      $spreadsheet->getActiveSheet()->getStyle('F'.$x.$this->erow)->getAlignment()->setWrapText(true);
      $spreadsheet->getActiveSheet()->setCellValue('F'.$x.$this->erow, "2st Term (100 marks)");
      $spreadsheet->getActiveSheet()->getStyle('F'.$x.$this->erow)->getFont()->setBold(true);
      $spreadsheet->getActiveSheet()->getStyle('F'.$x.$this->erow)->getFont()->setSize(10);

    //  $spreadsheet->getActiveSheet()->mergeCells('H10:I10');
      $spreadsheet->getActiveSheet()->mergeCells('H'.$x.':'.'I'.$x);
         $spreadsheet->getActiveSheet()->getStyle('H'.$x.':'.'I'.$x)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

      $spreadsheet->getActiveSheet()->getStyle('H'.$x.$this->erow)->getAlignment()->setWrapText(true);
      $spreadsheet->getActiveSheet()->getStyle('H'.$x.$this->erow)->getAlignment()->setWrapText(true);
      $spreadsheet->getActiveSheet()->setCellValue('H'.$x.$this->erow, "Monthly Test (100 marks)");
      $spreadsheet->getActiveSheet()->getStyle('H'.$x.$this->erow)->getFont()->setBold(true);
      $spreadsheet->getActiveSheet()->getStyle('H'.$x.$this->erow)->getFont()->setSize(10);
      $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);

    //  $spreadsheet->getActiveSheet()->mergeCells('J10:K10');
      $spreadsheet->getActiveSheet()->mergeCells('J'.$x.':'.'K'.$x);
         $spreadsheet->getActiveSheet()->getStyle('J'.$x.':'.'K'.$x)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

      $spreadsheet->getActiveSheet()->getStyle('J'.$x.$this->erow)->getAlignment()->setWrapText(true);
      $spreadsheet->getActiveSheet()->getStyle('J'.$x.$this->erow)->getAlignment()->setWrapText(true);
      $spreadsheet->getActiveSheet()->setCellValue('J'.$x.$this->erow, "Annual Exam (100 marks)");
      $spreadsheet->getActiveSheet()->getStyle('J'.$x.$this->erow)->getFont()->setBold(true);
      $spreadsheet->getActiveSheet()->getStyle('J'.$x.$this->erow)->getFont()->setSize(10);
      $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);


    //  $spreadsheet->getActiveSheet()->mergeCells('L10:M10');
      $spreadsheet->getActiveSheet()->mergeCells('L'.$x.':'.'M'.$x);
      $spreadsheet->getActiveSheet()->getStyle('L'.$x.':'.'M'.$x)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

      $spreadsheet->getActiveSheet()->getStyle('L'.$x.$this->erow)->getAlignment()->setWrapText(true);
      $spreadsheet->getActiveSheet()->getStyle('L'.$x.$this->erow)->getAlignment()->setWrapText(true);
      $spreadsheet->getActiveSheet()->setCellValue('L'.$x.$this->erow, "1st Term (15%)");
      $spreadsheet->getActiveSheet()->getStyle('L'.$x.$this->erow)->getFont()->setBold(true);
      $spreadsheet->getActiveSheet()->getStyle('L'.$x.$this->erow)->getFont()->setSize(10);
      $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);


    //  $spreadsheet->getActiveSheet()->mergeCells('N10:O10');
      $spreadsheet->getActiveSheet()->mergeCells('N'.$x.':'.'O'.$x);
      $spreadsheet->getActiveSheet()->getStyle('N'.$x.':'.'O'.$x)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

      $spreadsheet->getActiveSheet()->getStyle('N'.$x.$this->erow)->getAlignment()->setWrapText(true);
      $spreadsheet->getActiveSheet()->getStyle('N'.$x.$this->erow)->getAlignment()->setWrapText(true);
      $spreadsheet->getActiveSheet()->setCellValue('N'.$x.$this->erow, "2st Term (15%)");
      $spreadsheet->getActiveSheet()->getStyle('N'.$x.$this->erow)->getFont()->setBold(true);
      $spreadsheet->getActiveSheet()->getStyle('N'.$x.$this->erow)->getFont()->setSize(10);
      $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);

//$spreadsheet->getActiveSheet()->mergeCells('P10:Q10');
      $spreadsheet->getActiveSheet()->mergeCells('P'.$x.':'.'Q'.$x);
      $spreadsheet->getActiveSheet()->getStyle('P'.$x.':'.'Q'.$x)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

      $spreadsheet->getActiveSheet()->getStyle('P'.$x.$this->erow)->getAlignment()->setWrapText(true);
      $spreadsheet->getActiveSheet()->getStyle('P'.$x.$this->erow)->getAlignment()->setWrapText(true);
      $spreadsheet->getActiveSheet()->setCellValue('P'.$x.$this->erow, "Monthly Test (20%)");
      $spreadsheet->getActiveSheet()->getStyle('P'.$x.$this->erow)->getFont()->setBold(true);
      $spreadsheet->getActiveSheet()->getStyle('P'.$x.$this->erow)->getFont()->setSize(10);
      $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);


    //  $spreadsheet->getActiveSheet()->mergeCells('R10:S10');
      $spreadsheet->getActiveSheet()->mergeCells('R'.$x.':'.'S'.$x);
      $spreadsheet->getActiveSheet()->getStyle('R'.$x.':'.'S'.$x)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

      $spreadsheet->getActiveSheet()->getStyle('R'.$x.$this->erow)->getAlignment()->setWrapText(true);
      $spreadsheet->getActiveSheet()->getStyle('R'.$x.$this->erow)->getAlignment()->setWrapText(true);
      $spreadsheet->getActiveSheet()->setCellValue('R'.$x.$this->erow, "Annaual (50%)");
      $spreadsheet->getActiveSheet()->getStyle('R'.$x.$this->erow)->getFont()->setBold(true);
      $spreadsheet->getActiveSheet()->getStyle('R'.$x.$this->erow)->getFont()->setSize(10);
      $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);

    //  $spreadsheet->getActiveSheet()->mergeCells('T10:U10');
      $spreadsheet->getActiveSheet()->mergeCells('T'.$x.':'.'U'.$x);

      $spreadsheet->getActiveSheet()->getStyle('T'.$x.':'.'U'.$x)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $spreadsheet->getActiveSheet()->getStyle('T'.$x.$this->erow)->getAlignment()->setWrapText(true);
      $spreadsheet->getActiveSheet()->getStyle('T'.$x.$this->erow)->getAlignment()->setWrapText(true);
      $spreadsheet->getActiveSheet()->setCellValue('T'.$x.$this->erow, "Grand Total (100 Marks)");
      $spreadsheet->getActiveSheet()->getStyle('T'.$x.$this->erow)->getFont()->setBold(true);
      $spreadsheet->getActiveSheet()->getStyle('T'.$x.$this->erow)->getFont()->setSize(10);
      $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);
DB::enableQueryLog();
       $result=DB::table('assign_subject')
      ->join('tb_subject','assign_subject.subject','=','tb_subject.id')
      ->select('assign_subject.*','tb_subject.subject_name')
      ->where('assign_subject.acadmic_year',$session)
      ->where('assign_subject.course',$cid)
    //  ->where('assign_subject.batch',$batch)
      ->get();
//dd(DB::getQueryLog());
  //    echo "<pre>";print_r($result);exit;
      $i=$x;
      $pt=0;
      foreach($result as $result){
      $fmk="";
      $smk="";
      $mmk="";
      $amk="";

      $sub_code=$result->subject;

      $i=$i+1;
      $spreadsheet->getActiveSheet()->getStyle('B'.$i.':' .'C'.$i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $spreadsheet->getActiveSheet()->mergeCells('B'.$i.':' .'C'.$i);
      $spreadsheet->getActiveSheet()->getStyle('B'.$i.$this->erow)->getAlignment()->setWrapText(true);
      $spreadsheet->getActiveSheet()->getStyle('B'.$i.$this->erow)->getAlignment()->setWrapText(true);
      $spreadsheet->getActiveSheet()->setCellValue('B'.$i.$this->erow, $result->subject_name);
      $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);
      $grandtotal=0;
      // 1st term exam marks 6=7

       $first_query = DB::table('mark_register')->select(DB::raw('marks'))->where('exam','7')->where('subject',$sub_code)->where('academic_year',$session)->where('course',$cid)->where('batch',$batch)->where('register_no',$reg_no)->get();
    //   print_r($first_query);exit;
            foreach($first_query as $first_query){
             $fmk=$first_query->marks;

            }
    if($fmk=="0"){
       $fmk="0";
       $finalfmk="0";
   }else if($fmk==null){
       $fmk="-";
       $finalfmk="-";
   }else if($fmk=="AB"){
       $fmk="AB";
       $finalfmk="AB";
  }else if($fmk=="-"){

       $finalfmk="-";
  }else{
       $finalfmk=(int)ceil(ceil($fmk)*15/100);
       $grandtotal+=$finalfmk;
  }
      $spreadsheet->getActiveSheet()->mergeCells('D'.$i.':'.'E'.$i);
      $spreadsheet->getActiveSheet()->getStyle('D'.$i.':'.'E'.$i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $spreadsheet->getActiveSheet()->getStyle('D'.$i.$this->erow)->getAlignment()->setWrapText(true);
      $spreadsheet->getActiveSheet()->getStyle('D'.$i.$this->erow)->getAlignment()->setWrapText(true);
      $spreadsheet->getActiveSheet()->setCellValue('D'.$i.$this->erow, $fmk);

      $spreadsheet->getActiveSheet()->mergeCells('L'.$i.':'.'M'.$i);
      $spreadsheet->getActiveSheet()->getStyle('L'.$i.':'.'M'.$i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $spreadsheet->getActiveSheet()->getStyle('L'.$i.$this->erow)->getAlignment()->setWrapText(true);
      $spreadsheet->getActiveSheet()->getStyle('L'.$i.$this->erow)->getAlignment()->setWrapText(true);
     // $spreadsheet->getActiveSheet()->setCellValue('R'.$i.$this->erow,"=(IF(J$i>=0,J$i*50/100,IF(EXACT(J$i,AB),AB,0)))");
      $spreadsheet->getActiveSheet()->setCellValue('L'.$i.$this->erow,$finalfmk);


         // 2st term exam marks 7=8

       $second_query = DB::table('mark_register')->select(DB::raw('marks'))->where('exam','8')->where('subject',$sub_code)->where('academic_year',$session)->where('course',$cid)->where('batch',$batch)->where('register_no',$reg_no)->get();

            foreach($second_query as $second_query){
             $smk=$second_query->marks;

            }

    if($smk=="0"){
       $smk="0";
       $finalsmk="0";
   }else if($smk==null){
       $smk="-";
       $finalsmk="-";
   }else if($smk=="AB"){
       $smk="AB";
       $finalsmk="AB";
  }else if($smk=="-"){
       $smk=$smk;
       $finalsmk="-";
  }else{
       $smk=$smk;
       $finalsmk=(int)ceil(ceil($smk)*15/100);
       $grandtotal+=$finalsmk;
  }
      $spreadsheet->getActiveSheet()->mergeCells('F'.$i.':'.'G'.$i);
      $spreadsheet->getActiveSheet()->getStyle('F'.$i.':'.'G'.$i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $spreadsheet->getActiveSheet()->getStyle('F'.$i.$this->erow)->getAlignment()->setWrapText(true);
      $spreadsheet->getActiveSheet()->getStyle('F'.$i.$this->erow)->getAlignment()->setWrapText(true);
      $spreadsheet->getActiveSheet()->setCellValue('F'.$i.$this->erow,  $smk);



      $spreadsheet->getActiveSheet()->mergeCells('N'.$i.':'.'O'.$i);
      $spreadsheet->getActiveSheet()->getStyle('N'.$i.':'.'O'.$i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $spreadsheet->getActiveSheet()->getStyle('N'.$i.$this->erow)->getAlignment()->setWrapText(true);
      $spreadsheet->getActiveSheet()->getStyle('N'.$i.$this->erow)->getAlignment()->setWrapText(true);
     // $spreadsheet->getActiveSheet()->setCellValue('R'.$i.$this->erow,"=(IF(J$i>=0,J$i*50/100,IF(EXACT(J$i,AB),AB,0)))");
      $spreadsheet->getActiveSheet()->setCellValue('N'.$i.$this->erow,$finalsmk);


         // MONTHLY exam marks

       $monthlyquery = DB::table('monthly_exam')->select(DB::raw('SUM(marks) as marks'))->where('subject',$sub_code)->where('session',$session)->where('course',$cid)->where('batch',$batch)->where('reg_no',$reg_no)->get();

            foreach($monthlyquery as $monthlyquery){
             $mmk=$monthlyquery->marks;

            }

    if($mmk=="0"){
       $mmk="0";
       $finalmmk="0";
   }else if($mmk==null){
       $mmk="-";
       $finalmmk="-";
   }else if($mmk=="AB"){
       $mmk="AB";
       $finalmmk="AB";
  }else if($mmk=="-"){
       $mmk=$mmk;
       $finalmmk="-";
  }else{
       $mmk=$mmk;
       $finalmmk=ceil($mmk)*20/100;
       $grandtotal+=$finalmmk;
  }
      $spreadsheet->getActiveSheet()->mergeCells('H'.$i.':'.'I'.$i);
      $spreadsheet->getActiveSheet()->getStyle('H'.$i.':'.'I'.$i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $spreadsheet->getActiveSheet()->getStyle('H'.$i.$this->erow)->getAlignment()->setWrapText(true);
      $spreadsheet->getActiveSheet()->setCellValue('H'.$i.$this->erow,$mmk);

      $spreadsheet->getActiveSheet()->mergeCells('P'.$i.':'.'Q'.$i);
      $spreadsheet->getActiveSheet()->getStyle('P'.$i.':'.'Q'.$i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $spreadsheet->getActiveSheet()->getStyle('P'.$i.$this->erow)->getAlignment()->setWrapText(true);
      // $spreadsheet->getActiveSheet()->setCellValue('R'.$i.$this->erow,"=(IF(J$i>=0,J$i*50/100,IF(EXACT(J$i,AB),AB,0)))");
      $spreadsheet->getActiveSheet()->setCellValue('P'.$i.$this->erow,$finalmmk);



      // Annual term exam marks 5=9
       $annual_query = DB::table('mark_register')->select(DB::raw('marks'))->where('exam','9')->where('subject',$sub_code)->where('academic_year',$session)->where('course',$cid)->where('batch',$batch)->where('register_no',$reg_no)->get();

            foreach($annual_query as $annual_query){
             $amk=$annual_query->marks;

            }
      $spreadsheet->getActiveSheet()->mergeCells('J'.$i.':'.'K'.$i);
      $spreadsheet->getActiveSheet()->getStyle('J'.$i.':'.'K'.$i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $spreadsheet->getActiveSheet()->getStyle('J'.$i.$this->erow)->getAlignment()->setWrapText(true);
    //   $spreadsheet->getActiveSheet()->setCellValue('J'.$i.$this->erow,(!empty($amk)) ? $amk : (empty($amk) ? $amk :"-"));
   if($amk=="0"){
       $amk="0";
       $finalamk="0";
   }else if($amk==null){
       $amk="-";
       $finalamk="-";
   }else if($amk=="AB"){
        $amk="AB";
       $finalamk="AB";
  }else if($amk=="-"){
       $amk=$amk;
       $amk="-";
  }else{
         $amk=$amk;
         $finalamk=ceil(ceil($amk)*50/100);
         $grandtotal+=$finalamk;
  }
      $spreadsheet->getActiveSheet()->setCellValue('J'.$i.$this->erow,$amk);

      $spreadsheet->getActiveSheet()->mergeCells('R'.$i.':'.'S'.$i);
      $spreadsheet->getActiveSheet()->getStyle('R'.$i.':'.'S'.$i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $spreadsheet->getActiveSheet()->getStyle('R'.$i.$this->erow)->getAlignment()->setWrapText(true);
     // $spreadsheet->getActiveSheet()->setCellValue('R'.$i.$this->erow,"=(IF(J$i>=0,J$i*50/100,IF(EXACT(J$i,AB),AB,0)))");
      $spreadsheet->getActiveSheet()->setCellValue('R'.$i.$this->erow,$finalamk);



      $spreadsheet->getActiveSheet()->mergeCells('T'.$i.':'.'U'.$i);
      $spreadsheet->getActiveSheet()->getStyle('T'.$i.':'.'U'.$i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $spreadsheet->getActiveSheet()->getStyle('T'.$i.$this->erow)->getAlignment()->setWrapText(true);
      $spreadsheet->getActiveSheet()->setCellValue('T'.$i.$this->erow,round($grandtotal));

   }
   $ptm=0;
   $pt=$i+4;
   $ptn=$pt+2;
      $spreadsheet->getActiveSheet()->mergeCells('K'.$pt.':'.'M'.$pt);
      $spreadsheet->getActiveSheet()->getStyle('K'.$pt.':'.'M'.$pt)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $spreadsheet->getActiveSheet()->getStyle('K'.$pt.$this->erow)->getAlignment()->setWrapText(true);
      $spreadsheet->getActiveSheet()->setCellValue('K'.$pt.$this->erow, "PERSONALITY TRAITS");
      $spreadsheet->getActiveSheet()->getStyle('K'.$pt.$this->erow)->getFont()->setBold(true);
      $spreadsheet->getActiveSheet()->getStyle('K'.$pt.$this->erow)->getFont()->setSize(12);
      $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);

      $spreadsheet->getActiveSheet()->getStyle('A'.$ptn.':'.'V'.$ptn)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
      $spreadsheet->getActiveSheet()->getStyle('A'.$ptn.':'.'V'.$ptn)->getFill()->getStartColor()->setARGB('CCCC');

      //$ptfirst=DB
       $ptfirst = DB::table('personallity_traits_exam')->where('exam','6')->where('session',$session)->where('course',$cid)->where('batch',$batch)->where('reg_no',$reg_no)->get();
       $cleanliness="";
       $co_operative="";
       $courtesty="";
       $industry="";
       $honesty="";
       $obedience="";
       $persistence="";
       $promptness="";
       foreach($ptfirst as $ptfirst){
           $cleanliness=$ptfirst->cleanliness;
           $co_operative=$ptfirst->co_operative;
           $courtesty=$ptfirst->courtesty;
           $industry=$ptfirst->industry;
           $honesty=$ptfirst->honesty;
           $obedience=$ptfirst->obedience;
           $persistence=$ptfirst->persistence;
           $promptness=$ptfirst->promptness;
       }
       $ptsecond = DB::table('personallity_traits_exam')->where('exam','7')->where('session',$session)->where('course',$cid)->where('batch',$batch)->where('reg_no',$reg_no)->get();
       $scleanliness="";
       $sco_operative="";
       $scourtesty="";
       $sindustry="";
       $shonesty="";
       $sobedience="";
       $spersistence="";
       $spromptness="";
       foreach($ptsecond as $ptsecond){
           $scleanliness=$ptsecond->cleanliness;
           $sco_operative=$ptsecond->co_operative;
           $scourtesty=$ptsecond->courtesty;
           $sindustry=$ptsecond->industry;
           $shonesty=$ptsecond->honesty;
           $sobedience=$ptsecond->obedience;
           $spersistence=$ptsecond->persistence;
           $spromptness=$ptsecond->promptness;
       }
       $atsecond = DB::table('personallity_traits_exam')->where('exam','5')->where('session',$session)->where('course',$cid)->where('batch',$batch)->where('reg_no',$reg_no)->get();
       $acleanliness="";
       $aco_operative="";
       $acourtesty="";
       $aindustry="";
       $ahonesty="";
       $aobedience="";
       $apersistence="";
       $apromptness="";
       foreach($atsecond as $atsecond){
           $acleanliness=$atsecond->cleanliness;
           $aco_operative=$atsecond->co_operative;
           $acourtesty=$atsecond->courtesty;
           $aindustry=$atsecond->industry;
           $ahonesty=$atsecond->honesty;
           $aobedience=$atsecond->obedience;
           $apersistence=$atsecond->persistence;
           $apromptness=$atsecond->promptness;
       }

       //print_r($ptfirst);exit;

      $spreadsheet->getActiveSheet()->mergeCells('F'.$ptn.':'.'G'.$ptn);
      $spreadsheet->getActiveSheet()->getStyle('F'.$ptn.':'.'G'.$ptn)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $spreadsheet->getActiveSheet()->getStyle('F'.$ptn.$this->erow)->getAlignment()->setWrapText(true);
      $spreadsheet->getActiveSheet()->setCellValue('F'.$ptn.$this->erow, "TRAITS");
      $spreadsheet->getActiveSheet()->getStyle('F'.$ptn.$this->erow)->getFont()->setBold(true);
      $spreadsheet->getActiveSheet()->getStyle('F'.$ptn.$this->erow)->getFont()->setSize(11);
      $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);

      $ptn1=$ptn+2;
      $spreadsheet->getActiveSheet()->mergeCells('F'.$ptn1.':'.'G'.$ptn1);
      $spreadsheet->getActiveSheet()->getStyle('F'.$ptn1.':'.'G'.$ptn1)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $spreadsheet->getActiveSheet()->getStyle('F'.$ptn1.$this->erow)->getAlignment()->setWrapText(true);
      $spreadsheet->getActiveSheet()->setCellValue('F'.$ptn1.$this->erow, "CLEANLINESS");
   //   $spreadsheet->getActiveSheet()->getStyle('F'.$ptn1.$this->erow)->getFont()->setBold(true);
      $spreadsheet->getActiveSheet()->getStyle('F'.$ptn1.$this->erow)->getFont()->setSize(11);
      $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);


      $spreadsheet->getActiveSheet()->getStyle('H'.$ptn1)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $spreadsheet->getActiveSheet()->getStyle('H'.$ptn1.$this->erow)->getAlignment()->setWrapText(true);
      $spreadsheet->getActiveSheet()->setCellValue('H'.$ptn1.$this->erow, $cleanliness?$cleanliness:'-');
      $spreadsheet->getActiveSheet()->getStyle('H'.$ptn1.$this->erow)->getFont()->setSize(11);
      $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);

      $spreadsheet->getActiveSheet()->getStyle('I'.$ptn1)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $spreadsheet->getActiveSheet()->getStyle('I'.$ptn1.$this->erow)->getAlignment()->setWrapText(true);
      $spreadsheet->getActiveSheet()->setCellValue('I'.$ptn1.$this->erow, $scleanliness?$scleanliness:'-');
      $spreadsheet->getActiveSheet()->getStyle('I'.$ptn1.$this->erow)->getFont()->setSize(11);
      $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);

      $spreadsheet->getActiveSheet()->getStyle('J'.$ptn1)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $spreadsheet->getActiveSheet()->getStyle('J'.$ptn1.$this->erow)->getAlignment()->setWrapText(true);
      $spreadsheet->getActiveSheet()->setCellValue('J'.$ptn1.$this->erow, $acleanliness?$acleanliness:'-');
      $spreadsheet->getActiveSheet()->getStyle('J'.$ptn1.$this->erow)->getFont()->setSize(11);
      $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);


      $ptn2=$ptn+3;
      $spreadsheet->getActiveSheet()->mergeCells('F'.$ptn2.':'.'G'.$ptn2);
      $spreadsheet->getActiveSheet()->getStyle('F'.$ptn2.':'.'G'.$ptn2)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $spreadsheet->getActiveSheet()->getStyle('F'.$ptn2.$this->erow)->getAlignment()->setWrapText(true);
      $spreadsheet->getActiveSheet()->setCellValue('F'.$ptn2.$this->erow, "CO-OPERATIVE");
   //   $spreadsheet->getActiveSheet()->getStyle('F'.$ptn2.$this->erow)->getFont()->setBold(true);
      $spreadsheet->getActiveSheet()->getStyle('F'.$ptn2.$this->erow)->getFont()->setSize(11);
      $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);

      $spreadsheet->getActiveSheet()->getStyle('H'.$ptn2)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $spreadsheet->getActiveSheet()->getStyle('H'.$ptn2.$this->erow)->getAlignment()->setWrapText(true);
      $spreadsheet->getActiveSheet()->setCellValue('H'.$ptn2.$this->erow, $co_operative);
      $spreadsheet->getActiveSheet()->getStyle('H'.$ptn2.$this->erow)->getFont()->setSize(11);
      $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);

      $spreadsheet->getActiveSheet()->getStyle('I'.$ptn2)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $spreadsheet->getActiveSheet()->getStyle('I'.$ptn2.$this->erow)->getAlignment()->setWrapText(true);
      $spreadsheet->getActiveSheet()->setCellValue('I'.$ptn2.$this->erow, $sco_operative?$sco_operative:'-');
      $spreadsheet->getActiveSheet()->getStyle('I'.$ptn2.$this->erow)->getFont()->setSize(11);
      $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);

      $spreadsheet->getActiveSheet()->getStyle('J'.$ptn2)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $spreadsheet->getActiveSheet()->getStyle('J'.$ptn2.$this->erow)->getAlignment()->setWrapText(true);
      $spreadsheet->getActiveSheet()->setCellValue('J'.$ptn2.$this->erow, $aco_operative?$aco_operative:'-');
      $spreadsheet->getActiveSheet()->getStyle('J'.$ptn2.$this->erow)->getFont()->setSize(11);
      $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);




      $ptn3=$ptn+4;
      $spreadsheet->getActiveSheet()->mergeCells('F'.$ptn3.':'.'G'.$ptn3);
      $spreadsheet->getActiveSheet()->getStyle('F'.$ptn3.':'.'G'.$ptn3)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $spreadsheet->getActiveSheet()->getStyle('F'.$ptn3.$this->erow)->getAlignment()->setWrapText(true);
      $spreadsheet->getActiveSheet()->setCellValue('F'.$ptn3.$this->erow, "COURTESY");
    //  $spreadsheet->getActiveSheet()->getStyle('F'.$ptn3.$this->erow)->getFont()->setBold(true);
      $spreadsheet->getActiveSheet()->getStyle('F'.$ptn3.$this->erow)->getFont()->setSize(11);
      $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);

      $spreadsheet->getActiveSheet()->getStyle('H'.$ptn3)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $spreadsheet->getActiveSheet()->getStyle('H'.$ptn3.$this->erow)->getAlignment()->setWrapText(true);
      $spreadsheet->getActiveSheet()->setCellValue('H'.$ptn3.$this->erow, $courtesty?$courtesty:'-');
      $spreadsheet->getActiveSheet()->getStyle('H'.$ptn3.$this->erow)->getFont()->setSize(11);
      $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);

      $spreadsheet->getActiveSheet()->getStyle('I'.$ptn3)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $spreadsheet->getActiveSheet()->getStyle('I'.$ptn3.$this->erow)->getAlignment()->setWrapText(true);
      $spreadsheet->getActiveSheet()->setCellValue('I'.$ptn3.$this->erow, $scourtesty?$scourtesty:'-');
      $spreadsheet->getActiveSheet()->getStyle('I'.$ptn3.$this->erow)->getFont()->setSize(11);
      $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);

      $spreadsheet->getActiveSheet()->getStyle('J'.$ptn3)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $spreadsheet->getActiveSheet()->getStyle('J'.$ptn3.$this->erow)->getAlignment()->setWrapText(true);
      $spreadsheet->getActiveSheet()->setCellValue('J'.$ptn3.$this->erow, $acourtesty?$acourtesty:'-');
      $spreadsheet->getActiveSheet()->getStyle('J'.$ptn3.$this->erow)->getFont()->setSize(11);
      $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);




      $ptn4=$ptn+5;
      $spreadsheet->getActiveSheet()->mergeCells('F'.$ptn4.':'.'G'.$ptn4);
      $spreadsheet->getActiveSheet()->getStyle('F'.$ptn4.':'.'G'.$ptn4)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $spreadsheet->getActiveSheet()->getStyle('F'.$ptn4.$this->erow)->getAlignment()->setWrapText(true);
      $spreadsheet->getActiveSheet()->setCellValue('F'.$ptn4.$this->erow, "INDUSTRY");
    //  $spreadsheet->getActiveSheet()->getStyle('F'.$ptn4.$this->erow)->getFont()->setBold(true);
      $spreadsheet->getActiveSheet()->getStyle('F'.$ptn4.$this->erow)->getFont()->setSize(11);
      $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);

      $spreadsheet->getActiveSheet()->getStyle('H'.$ptn4)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $spreadsheet->getActiveSheet()->getStyle('H'.$ptn4.$this->erow)->getAlignment()->setWrapText(true);
      $spreadsheet->getActiveSheet()->setCellValue('H'.$ptn4.$this->erow, $industry?$industry:'-');
      $spreadsheet->getActiveSheet()->getStyle('H'.$ptn4.$this->erow)->getFont()->setSize(11);
      $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);


      $spreadsheet->getActiveSheet()->getStyle('I'.$ptn4)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $spreadsheet->getActiveSheet()->getStyle('I'.$ptn4.$this->erow)->getAlignment()->setWrapText(true);
      $spreadsheet->getActiveSheet()->setCellValue('I'.$ptn4.$this->erow, $sindustry?$sindustry:'-');
      $spreadsheet->getActiveSheet()->getStyle('I'.$ptn4.$this->erow)->getFont()->setSize(11);
      $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);

      $spreadsheet->getActiveSheet()->getStyle('J'.$ptn4)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $spreadsheet->getActiveSheet()->getStyle('J'.$ptn4.$this->erow)->getAlignment()->setWrapText(true);
      $spreadsheet->getActiveSheet()->setCellValue('J'.$ptn4.$this->erow, $aindustry?$aindustry:'-');
      $spreadsheet->getActiveSheet()->getStyle('J'.$ptn4.$this->erow)->getFont()->setSize(11);
      $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);



      $spreadsheet->getActiveSheet()->getStyle('H'.$pt)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $spreadsheet->getActiveSheet()->getStyle('H'.$ptn.$this->erow)->getAlignment()->setWrapText(true);
      $spreadsheet->getActiveSheet()->setCellValue('H'.$ptn.$this->erow, "1ST TERM");
      $spreadsheet->getActiveSheet()->getStyle('H'.$ptn.$this->erow)->getFont()->setBold(true);
      $spreadsheet->getActiveSheet()->getStyle('H'.$ptn.$this->erow)->getFont()->setSize(10);
      $spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(11);
      $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);




    //  $spreadsheet->getActiveSheet()->mergeCells('F'.$ptn);
  //    $spreadsheet->getActiveSheet()->getStyle('F'.$ptn.':'.'J'.$ptn)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $spreadsheet->getActiveSheet()->getStyle('I'.$ptn.$this->erow)->getAlignment()->setWrapText(true);
      $spreadsheet->getActiveSheet()->setCellValue('I'.$ptn.$this->erow, "2ST TERM");
      $spreadsheet->getActiveSheet()->getStyle('I'.$ptn.$this->erow)->getFont()->setBold(true);
      $spreadsheet->getActiveSheet()->getStyle('I'.$ptn.$this->erow)->getFont()->setSize(10);
      $spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(11);
      $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);


  //    $spreadsheet->getActiveSheet()->mergeCells('G'.$ptn);
     // $spreadsheet->getActiveSheet()->getStyle('G'.$ptn.':'.'J'.$ptn)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $spreadsheet->getActiveSheet()->getStyle('J'.$ptn.$this->erow)->getAlignment()->setWrapText(true);
      $spreadsheet->getActiveSheet()->setCellValue('J'.$ptn.$this->erow, "Annual Term");
      $spreadsheet->getActiveSheet()->getStyle('J'.$ptn.$this->erow)->getFont()->setBold(true);
      $spreadsheet->getActiveSheet()->getStyle('J'.$ptn.$this->erow)->getFont()->setSize(10);
      $spreadsheet->getActiveSheet()->getColumnDimension('J')->setWidth(11);
      $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);


      $spreadsheet->getActiveSheet()->mergeCells('L'.$ptn.':'.'M'.$ptn);
      $spreadsheet->getActiveSheet()->getStyle('L'.$ptn.':'.'M'.$ptn)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $spreadsheet->getActiveSheet()->getStyle('L'.$ptn.$this->erow)->getAlignment()->setWrapText(true);
      $spreadsheet->getActiveSheet()->setCellValue('L'.$ptn.$this->erow, "TRAITS");
      $spreadsheet->getActiveSheet()->getStyle('L'.$ptn.$this->erow)->getFont()->setBold(true);
      $spreadsheet->getActiveSheet()->getStyle('L'.$ptn.$this->erow)->getFont()->setSize(11);
      $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);



      $ptn1=$ptn+2;
      $spreadsheet->getActiveSheet()->mergeCells('L'.$ptn1.':'.'M'.$ptn1);
      $spreadsheet->getActiveSheet()->getStyle('L'.$ptn1.':'.'M'.$ptn1)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $spreadsheet->getActiveSheet()->getStyle('L'.$ptn1.$this->erow)->getAlignment()->setWrapText(true);
      $spreadsheet->getActiveSheet()->setCellValue('L'.$ptn1.$this->erow, "HONESTY");
   //   $spreadsheet->getActiveSheet()->getStyle('F'.$ptn1.$this->erow)->getFont()->setBold(true);
      $spreadsheet->getActiveSheet()->getStyle('L'.$ptn1.$this->erow)->getFont()->setSize(11);
      $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);

      $spreadsheet->getActiveSheet()->getStyle('N'.$ptn1)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $spreadsheet->getActiveSheet()->getStyle('N'.$ptn1.$this->erow)->getAlignment()->setWrapText(true);
      $spreadsheet->getActiveSheet()->setCellValue('N'.$ptn1.$this->erow, $honesty?$honesty:'-');
      $spreadsheet->getActiveSheet()->getStyle('N'.$ptn1.$this->erow)->getFont()->setSize(11);
      $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);

      $spreadsheet->getActiveSheet()->getStyle('O'.$ptn1)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $spreadsheet->getActiveSheet()->getStyle('O'.$ptn1.$this->erow)->getAlignment()->setWrapText(true);
      $spreadsheet->getActiveSheet()->setCellValue('O'.$ptn1.$this->erow, $shonesty?$shonesty:'-');
      $spreadsheet->getActiveSheet()->getStyle('O'.$ptn1.$this->erow)->getFont()->setSize(11);
      $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);

      $spreadsheet->getActiveSheet()->getStyle('P'.$ptn1)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $spreadsheet->getActiveSheet()->getStyle('P'.$ptn1.$this->erow)->getAlignment()->setWrapText(true);
      $spreadsheet->getActiveSheet()->setCellValue('P'.$ptn1.$this->erow, $ahonesty?$ahonesty:'-');
      $spreadsheet->getActiveSheet()->getStyle('P'.$ptn1.$this->erow)->getFont()->setSize(11);
      $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);


      $ptn2=$ptn+3;
      $spreadsheet->getActiveSheet()->mergeCells('L'.$ptn2.':'.'M'.$ptn2);
      $spreadsheet->getActiveSheet()->getStyle('L'.$ptn2.':'.'M'.$ptn2)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $spreadsheet->getActiveSheet()->getStyle('L'.$ptn2.$this->erow)->getAlignment()->setWrapText(true);
      $spreadsheet->getActiveSheet()->setCellValue('L'.$ptn2.$this->erow, "OBEDIENCE");
   //   $spreadsheet->getActiveSheet()->getStyle('F'.$ptn2.$this->erow)->getFont()->setBold(true);
      $spreadsheet->getActiveSheet()->getStyle('L'.$ptn2.$this->erow)->getFont()->setSize(11);
      $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);

      $spreadsheet->getActiveSheet()->getStyle('N'.$ptn2)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $spreadsheet->getActiveSheet()->getStyle('N'.$ptn2.$this->erow)->getAlignment()->setWrapText(true);
      $spreadsheet->getActiveSheet()->setCellValue('N'.$ptn2.$this->erow, $obedience?$obedience:'-');
      $spreadsheet->getActiveSheet()->getStyle('N'.$ptn2.$this->erow)->getFont()->setSize(11);
      $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);

      $spreadsheet->getActiveSheet()->getStyle('O'.$ptn2)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $spreadsheet->getActiveSheet()->getStyle('O'.$ptn2.$this->erow)->getAlignment()->setWrapText(true);
      $spreadsheet->getActiveSheet()->setCellValue('O'.$ptn2.$this->erow, $sobedience?$sobedience:'-');
      $spreadsheet->getActiveSheet()->getStyle('O'.$ptn2.$this->erow)->getFont()->setSize(11);
      $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);

      $spreadsheet->getActiveSheet()->getStyle('P'.$ptn2)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $spreadsheet->getActiveSheet()->getStyle('P'.$ptn2.$this->erow)->getAlignment()->setWrapText(true);
      $spreadsheet->getActiveSheet()->setCellValue('P'.$ptn2.$this->erow, $aobedience?$aobedience:'-');
      $spreadsheet->getActiveSheet()->getStyle('P'.$ptn2.$this->erow)->getFont()->setSize(11);
      $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);





      $ptn3=$ptn+4;
      $spreadsheet->getActiveSheet()->mergeCells('L'.$ptn3.':'.'M'.$ptn3);
      $spreadsheet->getActiveSheet()->getStyle('L'.$ptn3.':'.'M'.$ptn3)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $spreadsheet->getActiveSheet()->getStyle('L'.$ptn3.$this->erow)->getAlignment()->setWrapText(true);
      $spreadsheet->getActiveSheet()->setCellValue('L'.$ptn3.$this->erow, "PERSISTENCE");
      $spreadsheet->getActiveSheet()->getStyle('L'.$ptn3.$this->erow)->getFont()->setSize(11);
      $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);

      $spreadsheet->getActiveSheet()->getStyle('N'.$ptn3)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $spreadsheet->getActiveSheet()->getStyle('N'.$ptn3.$this->erow)->getAlignment()->setWrapText(true);
      $spreadsheet->getActiveSheet()->setCellValue('N'.$ptn3.$this->erow, $persistence ? $persistence:'-');
      $spreadsheet->getActiveSheet()->getStyle('N'.$ptn3.$this->erow)->getFont()->setSize(11);
      $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);

      $spreadsheet->getActiveSheet()->getStyle('O'.$ptn3)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $spreadsheet->getActiveSheet()->getStyle('O'.$ptn3.$this->erow)->getAlignment()->setWrapText(true);
      $spreadsheet->getActiveSheet()->setCellValue('O'.$ptn3.$this->erow, $spersistence?$spersistence:'-');
      $spreadsheet->getActiveSheet()->getStyle('O'.$ptn3.$this->erow)->getFont()->setSize(11);
      $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);

      $spreadsheet->getActiveSheet()->getStyle('P'.$ptn3)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $spreadsheet->getActiveSheet()->getStyle('P'.$ptn3.$this->erow)->getAlignment()->setWrapText(true);
      $spreadsheet->getActiveSheet()->setCellValue('P'.$ptn3.$this->erow, $apersistence?$apersistence:'-');
      $spreadsheet->getActiveSheet()->getStyle('P'.$ptn3.$this->erow)->getFont()->setSize(11);
      $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);




      $ptn4=$ptn+5;
      $spreadsheet->getActiveSheet()->mergeCells('L'.$ptn4.':'.'M'.$ptn4);
      $spreadsheet->getActiveSheet()->getStyle('L'.$ptn4.':'.'M'.$ptn4)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $spreadsheet->getActiveSheet()->getStyle('L'.$ptn4.$this->erow)->getAlignment()->setWrapText(true);
      $spreadsheet->getActiveSheet()->setCellValue('L'.$ptn4.$this->erow, "PROMPTNESS");
    //  $spreadsheet->getActiveSheet()->getStyle('F'.$ptn4.$this->erow)->getFont()->setBold(true);
      $spreadsheet->getActiveSheet()->getStyle('L'.$ptn4.$this->erow)->getFont()->setSize(11);
      $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);

     $spreadsheet->getActiveSheet()->getStyle('N'.$ptn4)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $spreadsheet->getActiveSheet()->getStyle('N'.$ptn4.$this->erow)->getAlignment()->setWrapText(true);
      $spreadsheet->getActiveSheet()->setCellValue('N'.$ptn4.$this->erow, $promptness?$promptness:'-');
      $spreadsheet->getActiveSheet()->getStyle('N'.$ptn4.$this->erow)->getFont()->setSize(11);
      $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);

      $spreadsheet->getActiveSheet()->getStyle('O'.$ptn4)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $spreadsheet->getActiveSheet()->getStyle('O'.$ptn4.$this->erow)->getAlignment()->setWrapText(true);
      $spreadsheet->getActiveSheet()->setCellValue('O'.$ptn4.$this->erow, $spromptness?$spromptness:'-');
      $spreadsheet->getActiveSheet()->getStyle('O'.$ptn4.$this->erow)->getFont()->setSize(11);
      $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);

      $spreadsheet->getActiveSheet()->getStyle('P'.$ptn4)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $spreadsheet->getActiveSheet()->getStyle('P'.$ptn4.$this->erow)->getAlignment()->setWrapText(true);
      $spreadsheet->getActiveSheet()->setCellValue('P'.$ptn4.$this->erow, $apromptness?$apromptness:'-');
      $spreadsheet->getActiveSheet()->getStyle('P'.$ptn4.$this->erow)->getFont()->setSize(11);
      $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);


      $spreadsheet->getActiveSheet()->getStyle('N'.$ptn.$this->erow)->getAlignment()->setWrapText(true);
      $spreadsheet->getActiveSheet()->setCellValue('N'.$ptn.$this->erow, "1ST TERM");
      $spreadsheet->getActiveSheet()->getStyle('N'.$ptn.$this->erow)->getFont()->setBold(true);
      $spreadsheet->getActiveSheet()->getStyle('N'.$ptn.$this->erow)->getFont()->setSize(10);
      $spreadsheet->getActiveSheet()->getColumnDimension('N')->setWidth(11);
      $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);


      $spreadsheet->getActiveSheet()->getStyle('O'.$ptn.$this->erow)->getAlignment()->setWrapText(true);
      $spreadsheet->getActiveSheet()->setCellValue('O'.$ptn.$this->erow, "2ST TERM");
      $spreadsheet->getActiveSheet()->getStyle('O'.$ptn.$this->erow)->getFont()->setBold(true);
      $spreadsheet->getActiveSheet()->getStyle('O'.$ptn.$this->erow)->getFont()->setSize(10);
      $spreadsheet->getActiveSheet()->getColumnDimension('O')->setWidth(11);
      $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);

      $spreadsheet->getActiveSheet()->getStyle('P'.$ptn.$this->erow)->getAlignment()->setWrapText(true);
      $spreadsheet->getActiveSheet()->setCellValue('P'.$ptn.$this->erow, "Annual TERM");
      $spreadsheet->getActiveSheet()->getStyle('P'.$ptn.$this->erow)->getFont()->setBold(true);
      $spreadsheet->getActiveSheet()->getStyle('P'.$ptn.$this->erow)->getFont()->setSize(10);
      $spreadsheet->getActiveSheet()->getColumnDimension('P')->setWidth(11);
      $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);

      $x=$ptn+8;
      $spreadsheet->getActiveSheet()->getStyle('A'.$x.':'.'V'.$x)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
      $spreadsheet->getActiveSheet()->getStyle('A'.$x.':'.'V'.$x)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
      $spreadsheet->getActiveSheet()->getStyle('A'.$x.':'.'V'.$x)->getFill()->getStartColor()->setARGB('FFA0A0A0');
      $x=$x+2;
}

      $note1=$ptn4+3;

      $spreadsheet->getActiveSheet()->getStyle('B'.$note1.':'.'V'.$note1)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
      $spreadsheet->getActiveSheet()->getStyle('B'.$note1.':'.'V'.$note1)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
      $spreadsheet->getActiveSheet()->getStyle('B'.$note1.':'.'V'.$note1)->getFill()->getStartColor()->setARGB('FFA0A0A0');
      $spreadsheet->getActiveSheet()->mergeCells('B'.$note1.':'.'V'.$note1);
      $spreadsheet->getActiveSheet()->getStyle('B'.$note1.':'.'V'.$note1)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $spreadsheet->getActiveSheet()->getStyle('B'.$note1.$this->erow)->getAlignment()->setWrapText(true);
      $spreadsheet->getActiveSheet()->setCellValue('B'.$note1.$this->erow, "Grade A = 80 % TO 100% , B = 60% TO 79% , C = 50% TO 59% , D = 40% TO 49% , E = 35% TO 39% ,F = 0% TO 34% .");
      $spreadsheet->getActiveSheet()->getStyle('B'.$note1.$this->erow)->getFont()->setSize(11);
      $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);

      $rstart=$note1+3;
      $spreadsheet->getActiveSheet()->mergeCells('G'.$rstart.':'.'P'.$rstart);
      $spreadsheet->getActiveSheet()->getStyle('G'.$rstart.':'.'P'.$rstart)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $spreadsheet->getActiveSheet()->getStyle('G'.$rstart.$this->erow)->getAlignment()->setWrapText(true);
      $spreadsheet->getActiveSheet()->setCellValue('G'.$rstart.$this->erow, "TEACHER'S REMARKS");
      $spreadsheet->getActiveSheet()->getStyle('G'.$rstart.$this->erow)->getFont()->setSize(11);
      $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);

      $rstatus=$rstart+3;
      $spreadsheet->getActiveSheet()->mergeCells('G'.$rstatus.':'.'P'.$rstatus);
      $spreadsheet->getActiveSheet()->getStyle('G'.$rstatus.':'.'P'.$rstatus)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $spreadsheet->getActiveSheet()->getStyle('G'.$rstatus.$this->erow)->getAlignment()->setWrapText(true);
      $spreadsheet->getActiveSheet()->setCellValue('G'.$rstatus.$this->erow, "Final Result : ");
      $spreadsheet->getActiveSheet()->getStyle('G'.$rstatus.$this->erow)->getFont()->setSize(11);
      $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);

      $rsign=$rstatus+3;
      $spreadsheet->getActiveSheet()->mergeCells('D'.$rsign.':'.'G'.$rsign);
      $spreadsheet->getActiveSheet()->getStyle('D'.$rsign.':'.'G'.$rsign)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $spreadsheet->getActiveSheet()->getStyle('D'.$rsign.$this->erow)->getAlignment()->setWrapText(true);
      $spreadsheet->getActiveSheet()->setCellValue('D'.$rsign.$this->erow, "SIGNATURE SUPERVISOR/HEADMASTER ");
      $spreadsheet->getActiveSheet()->getStyle('D'.$rsign.$this->erow)->getFont()->setSize(11);
      $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);

      $spreadsheet->getActiveSheet()->mergeCells('J'.$rsign.':'.'M'.$rsign);
      $spreadsheet->getActiveSheet()->getStyle('J'.$rsign.':'.'M'.$rsign)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $spreadsheet->getActiveSheet()->getStyle('J'.$rsign.$this->erow)->getAlignment()->setWrapText(true);
      $spreadsheet->getActiveSheet()->setCellValue('J'.$rsign.$this->erow, "CLASS TEACHER");
      $spreadsheet->getActiveSheet()->getStyle('J'.$rsign.$this->erow)->getFont()->setSize(11);
      $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);

      $spreadsheet->getActiveSheet()->mergeCells('P'.$rsign.':'.'S'.$rsign);
      $spreadsheet->getActiveSheet()->getStyle('P'.$rsign.':'.'S'.$rsign)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $spreadsheet->getActiveSheet()->getStyle('P'.$rsign.$this->erow)->getAlignment()->setWrapText(true);
      $spreadsheet->getActiveSheet()->setCellValue('P'.$rsign.$this->erow, "PRINCIPAL ");
      $spreadsheet->getActiveSheet()->getStyle('P'.$rsign.$this->erow)->getFont()->setSize(11);
      $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);


      $stamp=$rsign+3;
      $spreadsheet->getActiveSheet()->mergeCells('P'.$stamp.':'.'S'.$stamp);
      $spreadsheet->getActiveSheet()->getStyle('P'.$stamp.':'.'S'.$stamp)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $spreadsheet->getActiveSheet()->getStyle('P'.$stamp.$this->erow)->getAlignment()->setWrapText(true);
      $spreadsheet->getActiveSheet()->setCellValue('P'.$stamp.$this->erow, "School Seal ");
      $spreadsheet->getActiveSheet()->getStyle('P'.$stamp.$this->erow)->getFont()->setSize(11);
      $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);

      $finalnote=$stamp+5;
      $spreadsheet->getActiveSheet()->getStyle('B'.$finalnote.':'.'V'.$finalnote)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
      $spreadsheet->getActiveSheet()->getStyle('B'.$finalnote.':'.'V'.$finalnote)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
      $spreadsheet->getActiveSheet()->getStyle('B'.$finalnote.':'.'V'.$finalnote)->getFill()->getStartColor()->setARGB('FFA0A0A0');
      $spreadsheet->getActiveSheet()->mergeCells('B'.$finalnote.':'.'V'.$finalnote);
      $spreadsheet->getActiveSheet()->getStyle('B'.$finalnote.':'.'V'.$finalnote)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $spreadsheet->getActiveSheet()->getStyle('B'.$finalnote.$this->erow)->getAlignment()->setWrapText(true);
      $spreadsheet->getActiveSheet()->setCellValue('B'.$finalnote.$this->erow, "Note : This is a system generated RESULT. For any Modification Contact Examination Department..");
      $spreadsheet->getActiveSheet()->getStyle('B'.$finalnote.$this->erow)->getFont()->setSize(11);
      $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);
      $file_name="final_Result_of_".$session."_".$cid."_".$batch.".xlsx";
      header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
      header('Content-Disposition: attachment;filename='.$file_name);
      header('Cache-Control: max-age=0');

  $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
  return $writer->save('php://output');

    }



function final_result_bunch(){
  $course=DB::table('tb_course')->where('branch_code',Auth::user()->school_id)->get();
$accadmicyear = DB::table('academicyear')
->where('branch_code',Auth::user()->school_id)->orderBy('startyear','desc')
->get();
 $exam=DB::table('tb_exam')->where('id','9')->where('branch_code',Auth::user()->school_id)->get();
return view('Exam.final_result_bunch',compact('course','accadmicyear','exam'));
}

  function annualExamReportGenerate(Request $request){
    $academicyear=$request->academicyear;
//  $exam=$request->exam;
    $course=$request->course;
    $batch=$request->batch;
    $subjects= DB::table('assign_subject')
          ->join('tb_subject', 'assign_subject.subject', '=', 'tb_subject.id')
          ->select('assign_subject.*', 'tb_subject.subject_name','tb_subject.id')
          ->where('assign_subject.acadmic_year',app_config('Session',Auth::user()->school_id))
      //    ->where('assign_subject.batch',$bid)
          ->where('assign_subject.course',$course)
          ->where('assign_subject.status','1')
          ->where('assign_subject.branch_id',Auth::user()->school_id)
          ->groupBy('assign_subject.subject')
          ->get();
//$examName=DB::table('tb_exam')->where('id',$exam)->get();
//print_r($examName[0]->exam_name);exit;
        /*  $sql="SELECT a.register_no,a.student_name,GROUP_CONCAT(CONCAT_WS('|',a.subject,a.marks)) AS marks FROM mark_register a
          WHERE a.exam='$exam' AND a.course='$course' AND a.academic_year='$academicyear'
          GROUP BY a.register_no"; */

  /*  $sql="SELECT a.register_no,a.student_name,if(b.phone IS NULL,b.father_phone,b.phone) AS mobile,
    GROUP_CONCAT(CONCAT_WS('|',c.exam_name,a.subject, (IF(a.marks IS NULL,0,a.marks))) ORDER BY c.exam_name) AS marks_details,
     GROUP_CONCAT(CONCAT_WS('|',a.subject,if(a.marks IS NULL,0,a.marks))) AS marks,
(
SELECT COUNT(*)
FROM stu_attendance x
WHERE x.reg_no=a.register_no AND x.accadmicyear='$academicyear' AND x.status='P') AS tot_stuatt,
(
SELECT COUNT(*)
FROM stu_attendance x
WHERE x.course='$course' AND x.accadmicyear='$academicyear') AS total_cls
FROM mark_register a
INNER JOIN tb_exam c ON a.exam=c.id
LEFT JOIN stu_contact b ON a.register_no=b.reg_no
WHERE a.exam IN (7,8,9) AND a.course='$course' and a.batch='$batch' AND a.academic_year='$academicyear'
GROUP BY a.register_no"; */

$sql="SELECT z.*,k.marks_monthly FROM  (SELECT a.roll_no,a.academic_year, a.register_no,a.student_name, IF(b.phone IS NULL,b.father_phone,b.phone) AS mobile, GROUP_CONCAT(CONCAT_WS('|',c.exam_name,a.subject, (IF(a.marks IS NULL,'0',a.marks)))
ORDER BY c.exam_name) AS marks_details, GROUP_CONCAT(CONCAT_WS('|',a.subject, IF(a.marks IS NULL,'',a.marks))) AS marks, (
SELECT COUNT(*)
FROM stu_attendance x
WHERE x.reg_no=a.register_no AND x.accadmicyear='$academicyear' AND x.status='P') AS tot_stuatt, (
SELECT COUNT(*)
FROM stu_attendance x
WHERE x.course='$course' AND x.accadmicyear='$academicyear') AS total_cls
FROM mark_register a
INNER JOIN tb_exam c ON a.exam=c.id
LEFT JOIN stu_contact b ON a.register_no=b.reg_no
WHERE a.exam IN (7,8,9) AND a.course='$course' AND a.batch='$batch' AND a.academic_year='$academicyear'
GROUP BY a.register_no)z
LEFT JOIN (
SELECT x.*,GROUP_CONCAT(CONCAT_WS('|',x.subject,x.marks)) AS marks_monthly FROM (SELECT a.reg_no,a.student_name, IF(b.phone IS NULL,b.father_phone,b.phone) AS mobile, GROUP_CONCAT(CONCAT_WS('|',c.exam_name,a.subject, (IF(a.marks IS NULL,'',a.marks)))
ORDER BY c.exam_name) AS marks_details,a.subject,SUM(IF(a.marks IS NULL OR a.marks='AB',0,a.marks)) AS marks
FROM monthly_exam a
INNER JOIN tb_exam c ON a.exam=c.id
LEFT JOIN stu_contact b ON a.reg_no=b.reg_no
WHERE a.exam IN (12) AND a.course='$course' AND a.batch='$batch' AND a.session='$academicyear'
GROUP BY a.reg_no,a.subject
)X
GROUP BY x.reg_no) k ON k.reg_no=z.register_no";

        //  echo $sql;exit;
          $marks = DB::select($sql);

          $sqls="SELECT COUNT(*) AS stu_cnt FROM stu_admission a
WHERE a.course='$course' AND a.accdmic_year='$academicyear'";

          //      echo $sql;exit;
                $stu_cnt = DB::select($sqls);

          //      print_r($stu_cnt[0]->stu_cnt);exit;
        //  echo "<pre>";print_r($subjects);exit;
          $spreadsheet = new Spreadsheet();
          $sheet = $spreadsheet->getActiveSheet();
          $writer = new Xlsx($spreadsheet);

          $style=array(
                 'alignment' => array(
                         'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                         'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                   ),
                 'font' => array(
                         //'bold' => true,
                         //'color' => array('rgb' => 'FF0000'),
                         'size' => 18,
                         'name' => 'Arial'

                  ),
                 'borders' => array(
                         'allborders' => array(
                             'style' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
                         )
                 )
                );

          //   $sheet->getStyle('A1:B1')->applyFromArray($style);
            // $spreadsheet->getActiveSheet()->getStyle('A1:J1')->applyFromArray($style);
            // $spreadsheet->getActiveSheet()->getStyle('B1')->applyFromArray($style);
             $spreadsheet->setActiveSheetIndex(0);

             $spreadsheet->getActiveSheet()->setTitle("Annual Report");


            $spreadsheet->getActiveSheet()->getStyle('C1:H1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $spreadsheet->getActiveSheet()->mergeCells('C1:H1');
            $spreadsheet->getActiveSheet()->setCellValue('C1'.$this->erow, Auth::user()->school_name);
            $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(35);

            $spreadsheet->getActiveSheet()->getStyle('C2:H2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
             $spreadsheet->getActiveSheet()->mergeCells('C2:H2');
             $spreadsheet->getActiveSheet()->setCellValue('C2'.$this->erow, institute_details('2','insitute_address'));
          //   $spreadsheet->getActiveSheet()->getColumnDimension('C2')->setAutoSize(true);

             $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(35);

             $spreadsheet->getActiveSheet()->getStyle('C3:H3')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
             $spreadsheet->getActiveSheet()->mergeCells('C3:H3');
             $spreadsheet->getActiveSheet()->getStyle('C3'.$this->erow)->getAlignment()->setWrapText(true);
             $spreadsheet->getActiveSheet()->setCellValue('C3'.$this->erow, "Phone No : ".institute_details('2','insitute_mobile'));
             $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(35);


             $spreadsheet->getActiveSheet()->getStyle('C5:H5')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
             $spreadsheet->getActiveSheet()->mergeCells('C5:H5');

             $spreadsheet->getActiveSheet()->getStyle('C5'.$this->erow)->getAlignment()->setWrapText(true);
             $spreadsheet->getActiveSheet()->setCellValue('C5'.$this->erow, "Annual Report");
             $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(35);

             $row=7;
          //   $col=1;
          $spreadsheet->getActiveSheet()->getStyle('A'.$row.':'.'J'.$row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

             $spreadsheet->getActiveSheet()->setCellValue('A'.$row.$this->erow, "Sl. No");
             $spreadsheet->getActiveSheet()->getStyle('A'.$row.$this->erow)
             ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_RED);
             $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);

             $spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
             $spreadsheet->getActiveSheet()->getStyle('B')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
             $spreadsheet->getActiveSheet()->getStyle('B'.$row.$this->erow)->getAlignment()->setWrapText(true);
             $spreadsheet->getActiveSheet()->getStyle('B'.$row.$this->erow)
             ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_RED);
             $spreadsheet->getActiveSheet()->setCellValue('B'.$row.$this->erow, "Student (Reg. No)");

             $spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
             $spreadsheet->getActiveSheet()->getStyle('C'.$row.$this->erow)->getAlignment()->setWrapText(true);
             $spreadsheet->getActiveSheet()->getStyle('C'.$row.$this->erow)
             ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_RED);
             $spreadsheet->getActiveSheet()->getStyle('C')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
             $spreadsheet->getActiveSheet()->setCellValue('C'.$row.$this->erow, "Mobile No");

      //   foreach($subjects as $key=>$value){
               $rows = $row;
               $lastColumn = $spreadsheet->getActiveSheet()->getHighestColumn();
               $lastColumn++;
            //  echo "<pre>"; print_r($subjects);exit;
               $column = 'D';
               foreach ($subjects as $key => $value) {
                 // code...

                 $cell = $spreadsheet->getActiveSheet()->getCell($column.$rows);
                 $spreadsheet->getActiveSheet()->getStyle($column)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                 $spreadsheet->getActiveSheet()->getStyle($column.$row.$this->erow)
                 ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_RED);
                 $spreadsheet->getActiveSheet()->setCellValue($column.$rows.$this->erow, $value->subject_name." (Details)");
                 $spreadsheet->getActiveSheet()->getColumnDimension($column)->setAutoSize(true);

                 $column++;
                 $cell = $spreadsheet->getActiveSheet()->getCell($column.$rows);
                 $spreadsheet->getActiveSheet()->getStyle($column)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                 $spreadsheet->getActiveSheet()->getStyle($column.$row.$this->erow)
                 ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_RED);
                 $spreadsheet->getActiveSheet()->setCellValue($column.$rows.$this->erow, $value->subject_name." (Total)");
                 $spreadsheet->getActiveSheet()->getColumnDimension($column)->setAutoSize(true);
              //   $spreadsheet->getActiveSheet()->getStyle($column.$rows.$this->erow)->applyFromArray($style);
              //   $spreadsheet->getActiveSheet()->getStyle($column.$rows.$this->erow)->getAlignment()->setIndent(1);

//                 $spreadsheet->getActiveSheet()->getStyle($column.$rows.$this->erow)->getAlignment()->setWrapText(true);

                 $column++;
               }

               $spreadsheet->getActiveSheet()->getStyle($column)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
               $spreadsheet->getActiveSheet()->getStyle($column.$row.$this->erow)
               ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_RED);
               $spreadsheet->getActiveSheet()->setCellValue($column.$rows.$this->erow, "No of Pupils in Class");
               $spreadsheet->getActiveSheet()->getColumnDimension($column)->setAutoSize(true);
               $column++;
               $spreadsheet->getActiveSheet()->getStyle($column)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
               $spreadsheet->getActiveSheet()->getStyle($column.$row.$this->erow)
               ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_RED);
               $spreadsheet->getActiveSheet()->setCellValue($column.$rows.$this->erow, "No of Working Days");
               $spreadsheet->getActiveSheet()->getColumnDimension($column)->setAutoSize(true);

               $column++;
               $spreadsheet->getActiveSheet()->getStyle($column)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
               $spreadsheet->getActiveSheet()->getStyle($column.$row.$this->erow)
               ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_RED);
               $spreadsheet->getActiveSheet()->setCellValue($column.$rows.$this->erow, "No of Days Attended");
               $spreadsheet->getActiveSheet()->getColumnDimension($column)->setAutoSize(true);


               $row++;
               $j=0;
               $startColumn="A";
              foreach ($marks as $key => $value) {
                $subjectColumn="D";
                $j++;
                $spreadsheet->getActiveSheet()->getStyle('A')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $spreadsheet->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
                $spreadsheet->getActiveSheet()->getStyle('A'.$row.$this->erow)->getAlignment()->setWrapText(true);
                $spreadsheet->getActiveSheet()->setCellValue('A'.$row.$this->erow, $j);

                $spreadsheet->getActiveSheet()->getStyle('B')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
                $spreadsheet->getActiveSheet()->getStyle('B'.$row.$this->erow)->getAlignment()->setWrapText(true);
                $spreadsheet->getActiveSheet()->setCellValue('B'.$row.$this->erow, $value->student_name ." (".$value->register_no.")" );

                $spreadsheet->getActiveSheet()->getStyle('C')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
                $spreadsheet->getActiveSheet()->getStyle('C'.$row.$this->erow)->getAlignment()->setWrapText(true);
                $spreadsheet->getActiveSheet()->setCellValue('C'.$row.$this->erow, $value->mobile );

                foreach($subjects as $keys=>$values){

                  $mm="";
                  $data=explode(',',$value->marks_details);
                  $infoData="";
                  $total_marks=0;
                  $gardes=array();
                  for($k=0; $k < count($data);$k++){
                    $dt=explode("|",$data[$k]);
                  //  echo "<pre>";print_r($dt);
                    $exam=$dt[0];
                    $sub_code=isset($dt[1]) ? $dt[1] : null;
                    $sub_marks=isset($dt[2]) ? $dt[2] :null;
                    if($values->id==$sub_code){
                       $mm=$sub_marks;
                       $infoData.="Exam : ".$exam.PHP_EOL."";
                       $infoData.=" Marks : ".$sub_marks.",".PHP_EOL."";
                       if($exam=="FIRST TERMINAL EXAMINATION"){
                         if(is_int((int)$sub_marks)){
                         $total_marks+=(int)$sub_marks*15/100;
                       }else{
                          $total_marks=$sub_marks;
                          array_push($gardes,$sub_marks);
                       }
                       }
                       if($exam=="SECOND TERMINAL EXAMINATION"){
                         if(is_int((int)$sub_marks)){
                         $total_marks+=(int)$sub_marks*15/100;
                       }else{
                          $total_marks=$sub_marks;
                          array_push($gardes,$sub_marks);
                       }
                       }
                       if($exam=="ANNUAL EXAMINATION"){
                         if(is_int((int)$sub_marks)){
                         $total_marks+=(int)$sub_marks*50/100;
                       }else{
                         $total_marks=$sub_marks;
                         array_push($gardes,$sub_marks);
                       }
                       }
                    }

                  //  $infoData="";


                  }//exit;

                  $datam=explode(',',$value->marks_monthly);
                  for($j=0; $j < count($datam);$j++){
                    $dtm=explode("|",$datam[$j]);
                    $sub_codem=isset($dtm[0]) ? $dtm[0] : null;
                    $sub_marksm=isset($dtm[1]) ? $dtm[1] : null;
                    if($values->id==$sub_codem){
                       $mmm=$sub_marksm;
                       $infoData.="Exam : "."MONTHLY EXAMINATION".PHP_EOL."";
                       $infoData.=" Marks : ".$sub_marksm.",".PHP_EOL."";
                       if(is_int((int)$sub_marks)){
                       $total_marks+=(int)$sub_marksm*20/100;
                        }else{
                          $total_marks=$sub_marksm;
                          array_push($gardes,$sub_marks);
                        }
                    }
                  }
                  if($mm!=""){
                    $markss=$mm;
                  }else{
                    $markss="Marks Not Sumitted";
                  }
                  $cell = $spreadsheet->getActiveSheet()->getCell($subjectColumn.$row);
                  $spreadsheet->getActiveSheet()->getStyle($subjectColumn)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                  $spreadsheet->getActiveSheet()->getStyle($subjectColumn.$row.$this->erow)->getAlignment()->setWrapText(true);

                  $spreadsheet->getActiveSheet()->setCellValue($subjectColumn.$row.$this->erow,$infoData);
                  $spreadsheet->getActiveSheet()->getColumnDimension($subjectColumn)->setAutoSize(true);

                  $subjectColumn++;
                  $m="";
                  $data=explode(',',$value->marks);
                  for($k=0; $k < count($data);$k++){
                    $dt=explode("|",$data[$k]);

                    $sub_code=$dt[0];
                    $sub_marks=$dt[1];
                    if($values->id==$sub_code){
                       $m=$sub_marks;
                    }
                  }
                  if($total_marks!=""){
                    $marks=$total_marks;
                  }else{
                    $marks=$total_marks;
                  }
                  $cell = $spreadsheet->getActiveSheet()->getCell($subjectColumn.$row);
                  $spreadsheet->getActiveSheet()->getStyle($subjectColumn)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                  $spreadsheet->getActiveSheet()->setCellValue($subjectColumn.$row.$this->erow, $marks);
                  $spreadsheet->getActiveSheet()->getColumnDimension($subjectColumn)->setAutoSize(true);
                  $subjectColumn++;
                }
                $cell = $spreadsheet->getActiveSheet()->getCell($subjectColumn.$row);
                $spreadsheet->getActiveSheet()->getStyle($subjectColumn)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $spreadsheet->getActiveSheet()->setCellValue($subjectColumn.$row.$this->erow, $stu_cnt[0]->stu_cnt);
                $spreadsheet->getActiveSheet()->getColumnDimension($subjectColumn)->setAutoSize(true);

                $subjectColumn++;
                $cell = $spreadsheet->getActiveSheet()->getCell($subjectColumn.$row);
                $spreadsheet->getActiveSheet()->getStyle($subjectColumn)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $spreadsheet->getActiveSheet()->setCellValue($subjectColumn.$row.$this->erow, $value->total_cls);
                $spreadsheet->getActiveSheet()->getColumnDimension($subjectColumn)->setAutoSize(true);

                $subjectColumn++;
                $cell = $spreadsheet->getActiveSheet()->getCell($subjectColumn.$row);
                $spreadsheet->getActiveSheet()->getStyle($subjectColumn)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $spreadsheet->getActiveSheet()->setCellValue($subjectColumn.$row.$this->erow, $value->tot_stuatt);
                $spreadsheet->getActiveSheet()->getColumnDimension($subjectColumn)->setAutoSize(true);


                $row++;
              }
            // exit;

             $file_name="Annualreport.xlsx";
             header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
             header('Content-Disposition: attachment;filename='."$file_name");
             header('Cache-Control: max-age=0');


         $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
         return $writer->save('php://output');


//    $pdf = PDF::loadView('Exam.examReportDownload',['marks'=>$marks,'subjects'=>$subjects])->setPaper('a4', 'landscape');
  // return view('Exam.examReportDownload',compact('marks','subjects')); //$pdf->download($id.'.pdf');
  // return $pdf->download($exam.'.pdf');
  }

  public function AnnualExamReport(){
    $course=DB::table('tb_course')->where('branch_code',Auth::user()->school_id)->get();
    $accadmicyear = DB::table('academicyear')
    ->where('branch_code',Auth::user()->school_id)->orderBy('startyear','desc')
    ->get();
    return view("Exam.AnnualExamReport",compact('course','accadmicyear'));
  }



  public function teacherByclass(Request $request){
    $academicyear=$request->academicyear;
    $course=$request->course;
    $section=$request->section;
    $teacher=DB::table('subject_allocation')
    ->join('users','subject_allocation.emp_id','users.emp_code')
    ->where('subject_allocation.acadmic_year',$academicyear)
    ->where('subject_allocation.course',$course)
    ->where('subject_allocation.batch',$section)->groupBy('subject_allocation.emp_id')->get();
    echo $teacher;
  }
  public function downloadmarksByTeacher($subject,$course,$batch,$academicyear,$empid){

  //  echo $emp_name[0]->name;exit;
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $writer = new Xlsx($spreadsheet);
    $protection = $spreadsheet->getActiveSheet()->getProtection();
    $protection->setPassword('metas@123');
    $protection->setSheet(true);
    $protection->setSort(true);
    $protection->setInsertRows(true);
    $protection->setFormatCells(true);
    $style=array(
           'alignment' => array(
                   'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                   'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
             ),
           'font' => array(
                   //'bold' => true,
                   //'color' => array('rgb' => 'FF0000'),
                   'size' => 18,
                   'name' => 'Arial'

            ),
           'borders' => array(
                   'allborders' => array(
                       'style' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
                   )
           )
          );
          $spreadsheet->setActiveSheetIndex(0);

          $spreadsheet->getActiveSheet()->setTitle("Marks Card");


         $spreadsheet->getActiveSheet()->getStyle('C1:H1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
         $spreadsheet->getActiveSheet()->mergeCells('C1:H1');
         $spreadsheet->getActiveSheet()->setCellValue('C1'.$this->erow, Auth::user()->school_name);
         $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(35);

          $spreadsheet->getActiveSheet()->getStyle('C2:H2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
          $spreadsheet->getActiveSheet()->mergeCells('C2:H2');
          $spreadsheet->getActiveSheet()->setCellValue('C2'.$this->erow, institute_details('2','insitute_address'));
       //   $spreadsheet->getActiveSheet()->getColumnDimension('C2')->setAutoSize(true);

          $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(35);

          $spreadsheet->getActiveSheet()->getStyle('C3:H3')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
          $spreadsheet->getActiveSheet()->mergeCells('C3:H3');
          $spreadsheet->getActiveSheet()->getStyle('C3'.$this->erow)->getAlignment()->setWrapText(true);
          $spreadsheet->getActiveSheet()->setCellValue('C3'.$this->erow, "Phone No : ".institute_details('2','insitute_mobile'));
          $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(35);


          $spreadsheet->getActiveSheet()->getStyle('C4:H4')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
          $spreadsheet->getActiveSheet()->mergeCells('C4:H4');
          $spreadsheet->getActiveSheet()->setCellValue('C4'.$this->erow, "Academic Year : ". $academicyear);

          $emp_name=DB::table('users')->where('emp_code',$empid)->limit(1)->get();
          $subject_name=DB::table('tb_subject')->where('id',$subject)->limit(1)->get();

          $spreadsheet->getActiveSheet()->getStyle('C6')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
          $spreadsheet->getActiveSheet()->setCellValue('C6'.$this->erow, "Name of teacher : ". $emp_name[0]->name);

          $spreadsheet->getActiveSheet()->getStyle('I6')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
          $spreadsheet->getActiveSheet()->setCellValue('I6'.$this->erow, "Subject : ". $subject_name[0]->subject_name);

          $class_name=DB::table('tb_course')->where('id',$course)->limit(1)->get();
          $section_name=DB::table('tb_batch')->where('id',$batch)->limit(1)->get();

          $spreadsheet->getActiveSheet()->getStyle('C7')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
          $spreadsheet->getActiveSheet()->setCellValue('C7'.$this->erow, "Class : ". $class_name[0]->course_name);

          $spreadsheet->getActiveSheet()->getStyle('I7')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
          $spreadsheet->getActiveSheet()->setCellValue('I7'.$this->erow, "Section : ". $section_name[0]->batch_name);


          $spreadsheet->getActiveSheet()->setCellValue('B9'.$this->erow, "Roll No");
          $spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
          $spreadsheet->getActiveSheet()->getStyle('B9')->getAlignment()->setHorizontal('center');
          $spreadsheet->getActiveSheet()->getRowDimension('9')->setRowHeight(30);
          $spreadsheet->getActiveSheet()->getStyle('B9:L9')->getAlignment()->setVertical('center');
          $spreadsheet->getActiveSheet()->getStyle('B9:L9')->getFont()->setBold(true);

          $spreadsheet->getActiveSheet()->setCellValue('C9'.$this->erow, "Name of student");
          $spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
          $spreadsheet->getActiveSheet()->getStyle('C9')->getAlignment()->setHorizontal('center');

          $spreadsheet->getActiveSheet()->setCellValue('D9'.$this->erow, "1st Term Exam (100 Marks)");
          $spreadsheet->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
          $spreadsheet->getActiveSheet()->getStyle('D9')->getAlignment()->setHorizontal('center');

          $spreadsheet->getActiveSheet()->setCellValue('E9'.$this->erow, "2st Term Exam (100 Marks)");
          $spreadsheet->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
          $spreadsheet->getActiveSheet()->getStyle('E9')->getAlignment()->setHorizontal('center');

          $spreadsheet->getActiveSheet()->setCellValue('F9'.$this->erow, "Monthly Exam (100 Marks)");
          $spreadsheet->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
          $spreadsheet->getActiveSheet()->getStyle('F9')->getAlignment()->setHorizontal('center');

          $spreadsheet->getActiveSheet()->setCellValue('G9'.$this->erow, "Annual Exam (100 Marks)");
          $spreadsheet->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
          $spreadsheet->getActiveSheet()->getStyle('G9')->getAlignment()->setHorizontal('center');

          $spreadsheet->getActiveSheet()->setCellValue('H9'.$this->erow, "1st Term Exam (15%)");
          $spreadsheet->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
          $spreadsheet->getActiveSheet()->getStyle('H9')->getAlignment()->setHorizontal('center');

          $spreadsheet->getActiveSheet()->setCellValue('I9'.$this->erow, "2st Term Exam (15%)");
          $spreadsheet->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
          $spreadsheet->getActiveSheet()->getStyle('I9')->getAlignment()->setHorizontal('center');

          $spreadsheet->getActiveSheet()->setCellValue('J9'.$this->erow, "Monthly Exam (20%)");
          $spreadsheet->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
          $spreadsheet->getActiveSheet()->getStyle('J9')->getAlignment()->setHorizontal('center');

          $spreadsheet->getActiveSheet()->setCellValue('K9'.$this->erow, "Annual Exam (50%)");
          $spreadsheet->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
          $spreadsheet->getActiveSheet()->getStyle('K9')->getAlignment()->setHorizontal('center');

          $spreadsheet->getActiveSheet()->setCellValue('L9'.$this->erow, "Grand Total(100 Marks)");
          $spreadsheet->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
          $spreadsheet->getActiveSheet()->getStyle('L9')->getAlignment()->setHorizontal('center');

   $row=10;
  // $subject,$course,$batch,$academicyear,$empid
   $sql_firstTerm = "SELECT a.reg_no,a.stu_name,b.roll_no,b.id,b.marks,b.exam
           FROM stu_admission a
           LEFT JOIN mark_register b ON a.reg_no=b.register_no AND a.accdmic_year=b.academic_year
           AND b.exam='7' AND b.subject='$subject'
           WHERE a.accdmic_year='$academicyear' AND a.course='$course' AND a.batch='$batch'";
	 $firstTerm = DB::select($sql_firstTerm);
  // echo "<pre>"; print_r(collect($firstTerm)->toArray());exit;
        foreach (collect($firstTerm)->toArray() as  $value) {
          // code...
        //echo"<br>".$value->marks;
          $spreadsheet->getActiveSheet()->setCellValue('B'.$row.$this->erow, $value->roll_no);
          $spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
          $spreadsheet->getActiveSheet()->getStyle('B'.$row.$this->erow)->getAlignment()->setHorizontal('center');

          $spreadsheet->getActiveSheet()->setCellValue('C'.$row.$this->erow, $value->stu_name." (".$value->reg_no.")");
          $spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
          $spreadsheet->getActiveSheet()->getStyle('C'.$row.$this->erow)->getAlignment()->setHorizontal('center');

          $spreadsheet->getActiveSheet()->setCellValue('D'.$row.$this->erow, $value->marks);
          $spreadsheet->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
          $spreadsheet->getActiveSheet()->getStyle('D'.$row.$this->erow)->getAlignment()->setHorizontal('center');

          $spreadsheet->getActiveSheet()->setCellValue('H'.$row.$this->erow, ($value->marks=="AB" || $value->marks==null?0:$value->marks)*15/100);
          $spreadsheet->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
          $spreadsheet->getActiveSheet()->getStyle('H'.$row.$this->erow)->getAlignment()->setHorizontal('center');

          $row++;
        }

        $row1=10;
        $sql_secondTerm = "SELECT a.reg_no,a.stu_name,b.roll_no,b.id,b.marks,b.exam
                FROM stu_admission a
                LEFT JOIN mark_register b ON a.reg_no=b.register_no AND a.accdmic_year=b.academic_year
                AND b.exam='8' AND b.subject='$subject'
                WHERE a.accdmic_year='$academicyear' AND a.course='$course' AND a.batch='$batch'";
        $secondTerm = DB::select($sql_secondTerm);

        foreach (collect($secondTerm)->toArray() as  $value) {
          // code...
        //echo"<br>".$value->marks;
          $spreadsheet->getActiveSheet()->setCellValue('E'.$row1.$this->erow, $value->marks);
          $spreadsheet->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
          $spreadsheet->getActiveSheet()->getStyle('E'.$row1.$this->erow)->getAlignment()->setHorizontal('center');

          $spreadsheet->getActiveSheet()->setCellValue('I'.$row1.$this->erow, ($value->marks=="AB" || $value->marks==null?0:$value->marks)*15/100);
          $spreadsheet->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
          $spreadsheet->getActiveSheet()->getStyle('I'.$row1.$this->erow)->getAlignment()->setHorizontal('center');

          $row1++;
        }


        $row2=10;
        $sql_secondTerm = "SELECT a.reg_no,a.stu_name,b.roll_no,b.id,b.marks,b.exam
                FROM stu_admission a
                LEFT JOIN mark_register b ON a.reg_no=b.register_no AND a.accdmic_year=b.academic_year
                AND b.exam='9' AND b.subject='$subject'
                WHERE a.accdmic_year='$academicyear' AND a.course='$course' AND a.batch='$batch'";
        $secondTerm = DB::select($sql_secondTerm);

        foreach (collect($secondTerm)->toArray() as  $value) {
          // code...
        //echo"<br>".$value->marks;
          $spreadsheet->getActiveSheet()->setCellValue('G'.$row2.$this->erow, $value->marks==null || $value->marks==""?"NA":$value->marks);
          $spreadsheet->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
          $spreadsheet->getActiveSheet()->getStyle('G'.$row2.$this->erow)->getAlignment()->setHorizontal('center');

          $spreadsheet->getActiveSheet()->setCellValue('K'.$row2.$this->erow, ($value->marks=="AB" || $value->marks==null || $value->marks=="NA" ?0:$value->marks)*50/100);
          $spreadsheet->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
          $spreadsheet->getActiveSheet()->getStyle('K'.$row2.$this->erow)->getAlignment()->setHorizontal('center');

          $row2++;
        }

        $row3=10;
        $sql_monthly = "SELECT a.reg_no,a.stu_name,b.id,SUM( if(b.marks IS NULL OR b.marks='AB',0,b.marks)) AS marks,
        b.exam FROM stu_admission a
        LEFT JOIN monthly_exam b ON a.reg_no=b.reg_no AND a.accdmic_year=b.session AND b.subject='$subject'
        WHERE a.accdmic_year='$academicyear' AND a.course='$course' AND a.batch='$batch'
        GROUP BY b.reg_no";
        //echo $sql_monthly;exit;
        $monthly = DB::select($sql_monthly);

        foreach (collect($monthly)->toArray() as  $value) {
          // code...
        //echo"<br>".$value->marks;
          $spreadsheet->getActiveSheet()->setCellValue('F'.$row3.$this->erow, $value->marks==null || $value->marks==""?"NA":$value->marks);
          $spreadsheet->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
          $spreadsheet->getActiveSheet()->getStyle('F'.$row3.$this->erow)->getAlignment()->setHorizontal('center');

          $spreadsheet->getActiveSheet()->setCellValue('J'.$row3.$this->erow, ($value->marks=="AB" || $value->marks==null || $value->marks=="NA" ?0:$value->marks)*15/100);
          $spreadsheet->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
          $spreadsheet->getActiveSheet()->getStyle('J'.$row3.$this->erow)->getAlignment()->setHorizontal('center');

          $spreadsheet->getActiveSheet()->setCellValue('L'.$row3.$this->erow,"=sum(H".$row3.$this->erow.":K".$row3.$this->erow.  ")");
          $spreadsheet->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
          $spreadsheet->getActiveSheet()->getStyle('L'.$row3.$this->erow)->getAlignment()->setHorizontal('center');

          $row3++;
        }



      //  exit;

          $file_name=$subject ."report.xlsx";
          header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
          header('Content-Disposition: attachment;filename='."$file_name");
          header('Cache-Control: max-age=0');


      $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
      return $writer->save('php://output');

  }
  public function subjectlistReport(Request $request){
    $academicyear=$request->academicyear;
    $course=$request->course;
    $section=$request->section;
    $teacher=Input::get('teacher');

    $subjects=DB::table('subject_allocation')
    ->join('tb_subject','subject_allocation.subject','tb_subject.id')
    ->where('subject_allocation.emp_id',$teacher)
    ->where('subject_allocation.acadmic_year',$academicyear)
    ->where('subject_allocation.course',$course)
    ->where('subject_allocation.batch',$section)->get();
    return view('Exam.subjectlistByTeacher',compact('subjects'));
    //echo $subjects;
  }
  public function ExamBunchReport(Request $request){
    $teacher=DB::table('users')->where('user_role',6)->where('school_id',Auth::user()->school_id)->get();
    $course=DB::table('tb_course')->where('branch_code',Auth::user()->school_id)->get();
    $academic_year=DB::table('academicyear')->orderBy('startyear','desc')->get();
    return view('Exam.ExambunchReport',compact('teacher','course','academic_year'));
  }

  public function getexamReport(Request $request){
    $exam_id=Input::get('exam_id');
    $courses=Input::get('courses');
    $batch=Input::get('batch');
	$accadmicyear=Input::get('accadmicyear');
    $sql="SELECT a.*,c.course_name,d.batch_name,b.subject_name,GROUP_CONCAT('',b.subject_name,' - ',a.marks ORDER BY b.subject_name ASC) AS marks_list FROM mark_register a
    INNER JOIN tb_subject b ON a.subject=b.id
    INNER JOIN tb_course c ON a.course=c.id
    INNER JOIN tb_batch d ON a.batch=d.id
    WHERE a.exam='$exam_id' AND a.course='$courses' AND a.batch='$batch' and a.academic_year='$accadmicyear'
    GROUP BY a.register_no ORDER BY a.roll_no asc";
   // echo $sql;
    $data=DB::select($sql);
    return view('Exam.showExamReport',compact('data'));
  }

  public function examReport(){
    $exam=DB::table('tb_exam')->where('branch_code',Auth::user()->school_id)->get();
    $course=DB::table('tb_course')->where('branch_code',Auth::user()->school_id)->get();
	$accadmicyear = DB::table('academicyear')
    ->where('branch_code',Auth::user()->school_id)->orderBy('startyear','desc')
    ->get();
    return view('Exam.exam_report',compact('exam','course','accadmicyear'));
  }

  public function examlist(){
    $self='Exam/exam_list';
    if (\Auth::user()->user_role!=='1'){
        $get_perm=permission::permitted($self);

        if ($get_perm=='access denied'){
            return redirect('permission-error')->with([
                'message' => 'You do not have permission to view this page.',
                'message_important'=>true
            ]);
        }
    }
     $examlist=DB::table('tb_exam')->where('branch_code',Auth::user()->school_id)->get();
  //   print_r($userList);exit;
     return view('Exam.exam_list',compact('examlist'));
  }

  public function add_exam(Request $request)
  {
      $self='Exam/exam_list';
    if (\Auth::user()->user_role!=='1'){
        $get_perm=permission::permitted($self);

        if ($get_perm=='access denied'){
            return redirect('permission-error')->with([
                'message' => 'You do not have permission to view this page.',
                'message_important'=>true
            ]);
        }
    }
       $exam_name=Input::get('exam_name');
       $fullmarks=Input::get('fullmarks');
       $passmarks=Input::get('passmarks');
       $description=Input::get('description');
       $created_date = date('d-m-Y H:i:s');
       $this->validate($request, [
      'exam_name'=>'required|string|max:255|unique:tb_exam',
      'fullmarks'=>'required|string|max:255',
      'passmarks'=>'required|string|max:255',
      ]);
      $exam=DB::table('tb_exam')->insert(['exam_name'=>$exam_name,'fullmarks'=>$fullmarks,'passmarks'=>$passmarks,
      'description'=>$description,'academic_year'=>app_config('Session',Auth::user()->school_id),'created_date'=>$created_date,'branch_code'=>Auth::user()->school_id]);

      if(!empty($exam)){
         return redirect('Exam/exam_list')->with([
                 'message' => 'Exam is Added Succesfully.'
             ]);
       }else{
              return redirect('Exam/exam_list')->with([
                   'message' => 'Exam Added failed.',
                   'message_important'=>true
               ]);
            }
        }


    public function delete_exam(Request $request,$id)
      {
    $self='exam/delete';
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
           DB::table('tb_exam')->where('id',$id)->where('branch_code',Auth::user()->school_id)->delete();

            return redirect('Exam/exam_list')->with([
                'message' => "Exam Details Deleted Successfully."
            ]);
        }else{
            return redirect('Exam/exam_list')->with([
                'message' => "Exam Details Not Found",
                'message_important' => true
            ]);
      }
  }

    public function exam_schedule(Request $request)
    {


      $course=DB::table('tb_course')->where('branch_code',Auth::user()->school_id)->get();
    //$subject=DB::table('tb_subject')->where('branch_code',Auth::user()->school_id)->get();

    //return view('Exam.exam_shedule_lists',compact('course','e_id'));
	return view('Exam.exam_shedule_lists',compact('course'));
    }

    public function schedulelist(Request  $request)
    {
        $bid=$request->bid;
        $cid=$request->cid;
        $list=DB::table('exam_schedule')
        ->join('tb_exam','exam_schedule.exam','=','tb_exam.id')
        ->select('exam_schedule.*','tb_exam.exam_name')
        ->where('exam_schedule.branch_code',Auth::user()->school_id)
        ->where('exam_schedule.course',$cid)
        ->where('exam_schedule.batch',$bid)
        ->where('exam_schedule.academic_year',app_config('Session',Auth::user()->school_id))
        ->get();

        echo $list;

    }

    public function add_exam_schedule(Request $request)
    {
      $exam=DB::table('tb_exam')->where('branch_code',Auth::user()->school_id)->get();
      $course=DB::table('tb_course')->where('branch_code',Auth::user()->school_id)->get();
      return view('Exam.create_exam_schedules',compact('exam','course'));
    }

    public function subjectlist(Request $request)
    {
      $bid=$request->bid;
      $cid=$request->cid;
      $session=$request->session;
      $exam_id=$request->exam_id;
      $type=$request->type;

     /*   $s=DB::table('assign_subject')
            ->join('tb_subject', 'assign_subject.subject', '=', 'tb_subject.id')
            ->select('assign_subject.*', 'tb_subject.subject_name')
            ->where('assign_subject.acadmic_year',app_config('Session',Auth::user()->school_id))
          //  ->where('assign_subject.batch',$bid)
            ->where('assign_subject.course',$cid)
            ->where('assign_subject.status','1')
            ->where('assign_subject.branch_id',Auth::user()->school_id)
            ->get();*/
	//	DB::enableQueryLog();
//    echo app_config('Session',Auth::user()->school_id);  IF(marks_submit_status.status is null,0,marks_submit_status) as marks_submit_status
        $submitted_by=Auth::user()->username;
		    $s=DB::table('subject_allocation')
            ->join('tb_subject', 'subject_allocation.subject', '=', 'tb_subject.id')
            ->LeftJoin('marks_submit_status',function($join) use ($exam_id,$submitted_by){
               $join->on('subject_allocation.subject', '=', 'marks_submit_status.sub_code')
               ->on('subject_allocation.acadmic_year', '=', 'marks_submit_status.academic_year')
               ->on('subject_allocation.course', '=', 'marks_submit_status.class')
               ->on('subject_allocation.batch', '=', 'marks_submit_status.section')
               ->on('subject_allocation.emp_id', '=','marks_submit_status.submitted_by')
               ->on('marks_submit_status.exam', '=', DB::raw($exam_id))
               ->on('marks_submit_status.status', '=', DB::raw(1));
             })
            ->select('subject_allocation.*', 'tb_subject.subject_name','marks_submit_status.status')
            ->where('subject_allocation.acadmic_year',$session)
            ->where('subject_allocation.batch',$bid)
            ->where('subject_allocation.course',$cid)
            ->where('subject_allocation.emp_id',Auth::user()->username)
            ->get();

          /*  $submit_status=DB::table("marks_submit_status")
            ->select('marks_submit_status.*',\DB::raw('IF(marks_submit_status.status is NULL,0,marks_submit_status.status) as status'))
            ->where("academic_year",$session)
            ->where('class',$cid)
            ->where('section',$bid)
            ->where('exam',$examid)
            ->where('sub_code',$subject)
            ->where('submitted_by',Auth::user()->username)->get(); */

          //  $queries = DB::getQueryLog();
          //  print_r($s);
          if($type=="2"){
            return view('Exam.monthlyExam.showFacultySubjectList',compact('s'));
          }else{
            return view('Exam.showFacultySubjectList',compact('s'));
          }
            //  echo $s;

            }

            public function downloadMarksSubjectWiseMonthly($subject,$class,$section,$academic_year,$examid,$month){
              $ob = "CAST(stu_admission.roll_no AS UNSIGNED) asc";
              $student=DB::table('stu_admission')
               ->LeftJoin('monthly_exam' ,function($join) use ($examid, $subject){
                 $join->on('stu_admission.reg_no','monthly_exam.reg_no');
                 $join->on('stu_admission.course','monthly_exam.course');
                 $join->on('stu_admission.batch','monthly_exam.batch');
                 $join->on('monthly_exam.exam','=',DB::raw($examid));
                 $join->on('monthly_exam.subject','=',DB::raw($subject));
               })
               ->select('stu_admission.*',\DB::raw('IF(monthly_exam.marks is NULL,"NA",monthly_exam.marks) as marks ,IF(monthly_exam.id is NULL,0,monthly_exam.id) as marks_id'))
               ->where('monthly_exam.month',$month)
               ->where('stu_admission.course',$class)
               ->where('stu_admission.batch',$section)
               ->where('stu_admission.branch_code',Auth::user()->school_id)
               ->where('stu_admission.accdmic_year',$academic_year)
               ->orderByRaw($ob)
               ->get();
            //   print_r($student);exit;
            $subjectName=DB::table("tb_subject")->where('id',$subject)->get();
            $examName=DB::table("tb_exam")->where('id',$examid)->get();
            $className=DB::table("tb_course")->where('id',$class)->get();
            $sectionName=DB::table("tb_batch")->where('id',$section)->get();
            $teacher=Auth::user()->name ."(".Auth::user()->username .")";
            //  $sectionName=DB::table("tb_batch")->where('id',$section)->get();
            //  print_r($subjectName);exit;
              $pdf = PDF::loadView('Exam.monthlyExam.downloadMarks', compact('student','teacher','academic_year','subjectName','examName','className','sectionName','month'));
              return $pdf->download($subject.'.pdf');
            }

      public function downloadMarksSubjectWise($subject,$class,$section,$academic_year,$examid){
        $ob = "CAST(stu_admission.roll_no AS UNSIGNED) asc";
        $student=DB::table('stu_admission')
         ->LeftJoin('mark_register' ,function($join) use ($examid, $subject){
           $join->on('stu_admission.reg_no','mark_register.register_no');
           $join->on('stu_admission.course','mark_register.course');
           $join->on('stu_admission.batch','mark_register.batch');
           $join->on('mark_register.exam','=',DB::raw($examid));
           $join->on('mark_register.subject','=',DB::raw($subject));
         })
         ->select('stu_admission.*',\DB::raw('IF(mark_register.marks is NULL,0,mark_register.marks) as marks ,IF(mark_register.id is NULL,0,mark_register.id) as marks_id'))
         ->where('stu_admission.course',$class)
         ->where('stu_admission.batch',$section)
         ->where('stu_admission.branch_code',Auth::user()->school_id)
         ->where('stu_admission.accdmic_year',$academic_year)
         ->orderByRaw($ob)
         ->get();
      // /   print_r($student);exit;
      $subjectName=DB::table("tb_subject")->where('id',$subject)->get();
      $examName=DB::table("tb_exam")->where('id',$examid)->get();
      $className=DB::table("tb_course")->where('id',$class)->get();
      $sectionName=DB::table("tb_batch")->where('id',$section)->get();
      $teacher=Auth::user()->name ."(".Auth::user()->username .")";
    //  $sectionName=DB::table("tb_batch")->where('id',$section)->get();
    //  print_r($subjectName);exit;
        $pdf = PDF::loadView('Exam.downloadMarks', compact('student','teacher','academic_year','subjectName','examName','className','sectionName'));
        return $pdf->download($subject.'.pdf');
      }
    public function createschedule(Request $request)
    {
        $bid=$request->bid;
      $cid=$request->cid;

      $s=DB::table('assign_subject')
            ->join('tb_subject', 'assign_subject.subject', '=', 'tb_subject.id')
            ->select('assign_subject.*', 'tb_subject.subject_name','tb_subject.id')
            ->where('assign_subject.acadmic_year',app_config('Session',Auth::user()->school_id))
            ->where('assign_subject.batch',$bid)
            ->where('assign_subject.course',$cid)
            ->where('assign_subject.status','1')
            ->where('assign_subject.branch_id',Auth::user()->school_id)
            ->get();
              echo $s;

    }


    public function create_exam_schedule(Request $request)
    {
      $eid = $request->date;
      $data=json_decode($eid);
      $exam_name=$request->exam_name;
      $course=$request->courses;
      $batch=$request->batch;
      //$created_date = date('d-m-Y H:i:s');

      $cnt=DB::table('exam_schedule')->where('exam',$exam_name)->where('course',$course)->where('batch',$batch)->where('academic_year',app_config('Session',Auth::user()->school_id))->count();

if($cnt=='0'){
    try{
    $ExamID=DB::table('exam_schedule')->insertGetId(['exam'=>$exam_name,'course'=>$course,'batch'=>$batch,'branch_code'=>Auth::user()->school_id,'academic_year'=>app_config('Session',Auth::user()->school_id)]);
   // echo $cnt;exit;
        if(!empty($ExamID)){
        foreach($data as $data){
    //    echo $data->name;
         $saveData= DB::table('exam_schedule_details')->insert(['exam_id'=>$exam_name,'exam_schedule_id'=>$ExamID,'sub_id'=>$data->sub_id,'subject'=>$data->name,'exam_date'=>$data->dates,'start_time'=>$data->starttime,'end_time'=>$data->endtime,'room_no'=>$data->room,"created_by"=>Auth::user()->emp_code]);
        }
        }else{
            echo "Unable to create exam scheudule.Please try again.";
        }
    }catch(\Illuminate\Database\QueryException $ex){
        echo "Something went worng.Please Contact Teachnical Team.";//$ex->getMessage();
    }
    if(!empty($saveData)){
        echo "Exam Scheudule Created Successfully.";
    }else{
         echo "Unable to create exam scheudule.Please try again.";
    }
}else{
    echo "This Exam Schedule Already Exists for this Acadmic Year.";
}


    /*  for($i=0;$i<count($subject_name);$i++)
      {
        $save=DB::table('exam_schedule')->insert(['exam'=>$exam_name,'course'=>$course,'batch'=>$batch,'subject'=>$subject_name[$i],'exam_date'=>$date[$i],'start_time'=>$start_time[$i],'end_time'=>$end_time[$i],'room_no'=>$room[$i],'full_marks'=>$full_marks[$i],'pass_marks'=>$pass_marks[$i],'academic_year'=>app_config('Session',Auth::user()->school_id),'created_date'=>$created_date,'branch_code'=>Auth::user()->school_id]);
      }

          if(!empty($exam)){
         return redirect('Exam/createschedule')->with([
                 'message' => 'Exam is Added Succesfully.'
             ]);
       }else{
              return redirect('Exam/createschedule')->with([
                   'message' => 'Exam Added failed.',
                   'message_important'=>true
               ]);
            }*/
      }

      public function exam_time_table(Request $request)
      {
         $e_id=$request->e_id;
        $ex=DB::table('exam_schedule_details')
        ->where('exam_schedule_id',$e_id)
        ->get();

       echo $ex;
      }

      public function mark_grade()
      {
         $self='Exam/mark_grade';
    if (\Auth::user()->user_role!=='1'){
        $get_perm=permission::permitted($self);

        if ($get_perm=='access denied'){
            return redirect('permission-error')->with([
                'message' => 'You do not have permission to view this page.',
                'message_important'=>true
            ]);
        }
    }
     $grade=DB::table('tb_marks_grade')->where('branch_code',Auth::user()->school_id)->get();
  //   print_r($userList);exit;
     return view('Exam.marks_grade',compact('grade'));
      }

      public function add_mark_grade(Request $request)
      {
        $self='Exam/mark_grade';
    if (\Auth::user()->user_role!=='1'){
        $get_perm=permission::permitted($self);

        if ($get_perm=='access denied'){
            return redirect('permission-error')->with([
                'message' => 'You do not have permission to view this page.',
                'message_important'=>true
            ]);
        }
    }
       $grade_name=Input::get('grade_name');
       $percent_from=Input::get('percent_from');
       $percent_upto=Input::get('percent_upto');

      $description=Input::get('description');
      $created_date = date('d-m-Y H:i:s');
       $this->validate($request, [
      'grade_name'=>'required|string|max:255|unique:tb_marks_grade',
      ]);
      $grade=DB::table('tb_marks_grade')->insert(['grade_name'=>$grade_name,'percent_from'=>$percent_from,'percent_upto'=>$percent_upto,'description'=>$description,'academic_year'=>app_config('Session',Auth::user()->school_id),'created_date'=>$created_date,'branch_code'=>Auth::user()->school_id]);

      if(!empty($grade)){
         return redirect('Exam/mark_grade')->with([
                 'message' => 'grade is Added Succesfully.'
             ]);
       }else{
              return redirect('Exam/mark_grade')->with([
                   'message' => 'Grade Added failed.',
                   'message_important'=>true
               ]);
            }
        }


    public function delete_grade(Request $request,$id)
      {
    $self='exam/delete_grade';
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
           DB::table('tb_marks_grade')->where('id',$id)->where('branch_code',Auth::user()->school_id)->delete();

            return redirect('Exam/mark_grade')->with([
                'message' => "Grade Details Deleted Successfully."
            ]);
        }else{
            return redirect('Exam/mark_grade')->with([
                'message' => "Grade Details Not Found",
                'message_important' => true
            ]);
      }
  }
  public function finalExamReport(){
    $course=DB::table('tb_course')->where('branch_code',Auth::user()->school_id)->get();
    $accadmicyear = DB::table('academicyear')
    ->where('branch_code',Auth::user()->school_id)->orderBy('startyear','desc')
    ->get();
    $exam=DB::table('tb_exam')->where('branch_code',Auth::user()->school_id)->get();

    return view("Exam.finalExamReport",compact('course','accadmicyear','exam'));
  }
  function finalExamReportGenerate(Request $request){
    $academicyear=$request->academicyear;
    $exam=$request->exam;
    $course=$request->course;
    $batch=$request->batch;
    $subjects= DB::table('assign_subject')
          ->join('tb_subject', 'assign_subject.subject', '=', 'tb_subject.id')
          ->select('assign_subject.*', 'tb_subject.subject_name','tb_subject.id')
          ->where('assign_subject.acadmic_year',app_config('Session',Auth::user()->school_id))
      //    ->where('assign_subject.batch',$bid)
          ->where('assign_subject.course',$course)
          ->where('assign_subject.status','1')
          ->where('assign_subject.branch_id',Auth::user()->school_id)
          ->groupBy('assign_subject.subject')
          ->get();
$examName=DB::table('tb_exam')->where('id',$exam)->get();
//print_r($examName[0]->exam_name);exit;
        /*  $sql="SELECT a.register_no,a.student_name,GROUP_CONCAT(CONCAT_WS('|',a.subject,a.marks)) AS marks FROM mark_register a
          WHERE a.exam='$exam' AND a.course='$course' AND a.academic_year='$academicyear'
          GROUP BY a.register_no"; */

    $sql="SELECT a.register_no,a.student_name,if(b.phone IS NULL,b.father_phone,b.phone) AS mobile, GROUP_CONCAT(CONCAT_WS('|',a.subject,if(a.marks IS NULL,0,a.marks))) AS marks,
(
SELECT COUNT(*)
FROM stu_attendance x
WHERE x.reg_no=a.register_no AND x.accadmicyear='$academicyear' AND x.status='P') AS tot_stuatt,
(
SELECT COUNT(*)
FROM stu_attendance x
WHERE x.course='$course' AND x.accadmicyear='$academicyear') AS total_cls
FROM mark_register a
LEFT JOIN stu_contact b ON a.register_no=b.reg_no
WHERE a.exam='$exam' AND a.course='$course' and a.batch='$batch' AND a.academic_year='$academicyear'
GROUP BY a.register_no";

        //  echo $sql;exit;
          $marks = DB::select($sql);

          $sqls="SELECT COUNT(*) AS stu_cnt FROM stu_admission a
WHERE a.course='$course' AND a.accdmic_year='$academicyear'";

          //      echo $sql;exit;
                $stu_cnt = DB::select($sqls);

          //      print_r($stu_cnt[0]->stu_cnt);exit;
        //  echo "<pre>";print_r($subjects);exit;
          $spreadsheet = new Spreadsheet();
          $sheet = $spreadsheet->getActiveSheet();
          $writer = new Xlsx($spreadsheet);

          $style=array(
                 'alignment' => array(
                         'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                         'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                   ),
                 'font' => array(
                         //'bold' => true,
                         //'color' => array('rgb' => 'FF0000'),
                         'size' => 18,
                         'name' => 'Arial'

                  ),
                 'borders' => array(
                         'allborders' => array(
                             'style' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
                         )
                 )
                );

          //   $sheet->getStyle('A1:B1')->applyFromArray($style);
            // $spreadsheet->getActiveSheet()->getStyle('A1:J1')->applyFromArray($style);
            // $spreadsheet->getActiveSheet()->getStyle('B1')->applyFromArray($style);
             $spreadsheet->setActiveSheetIndex(0);

             $spreadsheet->getActiveSheet()->setTitle($examName[0]->exam_name);


            $spreadsheet->getActiveSheet()->getStyle('C1:H1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $spreadsheet->getActiveSheet()->mergeCells('C1:H1');
            $spreadsheet->getActiveSheet()->setCellValue('C1'.$this->erow, Auth::user()->school_name);
            $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(35);

            $spreadsheet->getActiveSheet()->getStyle('C2:H2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
             $spreadsheet->getActiveSheet()->mergeCells('C2:H2');
             $spreadsheet->getActiveSheet()->setCellValue('C2'.$this->erow, institute_details('2','insitute_address'));
          //   $spreadsheet->getActiveSheet()->getColumnDimension('C2')->setAutoSize(true);

             $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(35);

             $spreadsheet->getActiveSheet()->getStyle('C3:H3')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
             $spreadsheet->getActiveSheet()->mergeCells('C3:H3');
             $spreadsheet->getActiveSheet()->getStyle('C3'.$this->erow)->getAlignment()->setWrapText(true);
             $spreadsheet->getActiveSheet()->setCellValue('C3'.$this->erow, "Phone No : ".institute_details('2','insitute_mobile'));
             $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(35);


             $spreadsheet->getActiveSheet()->getStyle('C5:H5')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
             $spreadsheet->getActiveSheet()->mergeCells('C5:H5');

             $spreadsheet->getActiveSheet()->getStyle('C5'.$this->erow)->getAlignment()->setWrapText(true);
             $spreadsheet->getActiveSheet()->setCellValue('C5'.$this->erow, "Result of ". $examName[0]->exam_name." - ".$academicyear);
             $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(35);

             $row=7;
          //   $col=1;
          $spreadsheet->getActiveSheet()->getStyle('A'.$row.':'.'J'.$row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

             $spreadsheet->getActiveSheet()->setCellValue('A'.$row.$this->erow, "Sl. No");
             $spreadsheet->getActiveSheet()->getStyle('A'.$row.$this->erow)
             ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_RED);
             $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);

             $spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
             $spreadsheet->getActiveSheet()->getStyle('B')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
             $spreadsheet->getActiveSheet()->getStyle('B'.$row.$this->erow)->getAlignment()->setWrapText(true);
             $spreadsheet->getActiveSheet()->getStyle('B'.$row.$this->erow)
             ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_RED);
             $spreadsheet->getActiveSheet()->setCellValue('B'.$row.$this->erow, "Student (Reg. No)");

             $spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
             $spreadsheet->getActiveSheet()->getStyle('C'.$row.$this->erow)->getAlignment()->setWrapText(true);
             $spreadsheet->getActiveSheet()->getStyle('C'.$row.$this->erow)
             ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_RED);
             $spreadsheet->getActiveSheet()->getStyle('C')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
             $spreadsheet->getActiveSheet()->setCellValue('C'.$row.$this->erow, "Mobile No");

      //   foreach($subjects as $key=>$value){
               $rows = $row;
               $lastColumn = $spreadsheet->getActiveSheet()->getHighestColumn();
               $lastColumn++;
            //  echo "<pre>"; print_r($subjects);exit;
               $column = 'D';
               foreach ($subjects as $key => $value) {
                 // code...
                 $cell = $spreadsheet->getActiveSheet()->getCell($column.$rows);
                 $spreadsheet->getActiveSheet()->getStyle($column)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                 $spreadsheet->getActiveSheet()->getStyle($column.$row.$this->erow)
                 ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_RED);
                 $spreadsheet->getActiveSheet()->setCellValue($column.$rows.$this->erow, $value->subject_name);
                 $spreadsheet->getActiveSheet()->getColumnDimension($column)->setAutoSize(true);
              //   $spreadsheet->getActiveSheet()->getStyle($column.$rows.$this->erow)->applyFromArray($style);
              //   $spreadsheet->getActiveSheet()->getStyle($column.$rows.$this->erow)->getAlignment()->setIndent(1);

//                 $spreadsheet->getActiveSheet()->getStyle($column.$rows.$this->erow)->getAlignment()->setWrapText(true);

                 $column++;
               }

               $spreadsheet->getActiveSheet()->getStyle($column)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
               $spreadsheet->getActiveSheet()->getStyle($column.$row.$this->erow)
               ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_RED);
               $spreadsheet->getActiveSheet()->setCellValue($column.$rows.$this->erow, "No of Pupils in Class");
               $spreadsheet->getActiveSheet()->getColumnDimension($column)->setAutoSize(true);
               $column++;
               $spreadsheet->getActiveSheet()->getStyle($column)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
               $spreadsheet->getActiveSheet()->getStyle($column.$row.$this->erow)
               ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_RED);
               $spreadsheet->getActiveSheet()->setCellValue($column.$rows.$this->erow, "No of Working Days");
               $spreadsheet->getActiveSheet()->getColumnDimension($column)->setAutoSize(true);

               $column++;
               $spreadsheet->getActiveSheet()->getStyle($column)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
               $spreadsheet->getActiveSheet()->getStyle($column.$row.$this->erow)
               ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_RED);
               $spreadsheet->getActiveSheet()->setCellValue($column.$rows.$this->erow, "No of Days Attended");
               $spreadsheet->getActiveSheet()->getColumnDimension($column)->setAutoSize(true);


               $row++;
               $j=0;
               $startColumn="A";
              foreach ($marks as $key => $value) {
                $subjectColumn="D";
                $j++;
                $spreadsheet->getActiveSheet()->getStyle('A')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $spreadsheet->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
                $spreadsheet->getActiveSheet()->getStyle('A'.$row.$this->erow)->getAlignment()->setWrapText(true);
                $spreadsheet->getActiveSheet()->setCellValue('A'.$row.$this->erow, $j);

                $spreadsheet->getActiveSheet()->getStyle('B')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
                $spreadsheet->getActiveSheet()->getStyle('B'.$row.$this->erow)->getAlignment()->setWrapText(true);
                $spreadsheet->getActiveSheet()->setCellValue('B'.$row.$this->erow, $value->student_name ." (".$value->register_no.")" );

                $spreadsheet->getActiveSheet()->getStyle('C')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
                $spreadsheet->getActiveSheet()->getStyle('C'.$row.$this->erow)->getAlignment()->setWrapText(true);
                $spreadsheet->getActiveSheet()->setCellValue('C'.$row.$this->erow, $value->mobile );

                foreach($subjects as $keys=>$values){
                  $m="";
                  $data=explode(',',$value->marks);
                  for($k=0; $k < count($data);$k++){
                    $dt=explode("|",$data[$k]);

                    $sub_code=$dt[0];
                    $sub_marks=$dt[1];
                    if($values->id==$sub_code){
                       $m=$sub_marks;
                    }
                  }
                  if($m!=""){
                    $marks=$m;
                  }else{
                    $marks="Marks Not Sumitted";
                  }
                  $cell = $spreadsheet->getActiveSheet()->getCell($subjectColumn.$row);
                  $spreadsheet->getActiveSheet()->getStyle($subjectColumn)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                  $spreadsheet->getActiveSheet()->setCellValue($subjectColumn.$row.$this->erow, $marks);
                  $spreadsheet->getActiveSheet()->getColumnDimension($subjectColumn)->setAutoSize(true);
                  $subjectColumn++;
                }
                $cell = $spreadsheet->getActiveSheet()->getCell($subjectColumn.$row);
                $spreadsheet->getActiveSheet()->getStyle($subjectColumn)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $spreadsheet->getActiveSheet()->setCellValue($subjectColumn.$row.$this->erow, $stu_cnt[0]->stu_cnt);
                $spreadsheet->getActiveSheet()->getColumnDimension($subjectColumn)->setAutoSize(true);

                $subjectColumn++;
                $cell = $spreadsheet->getActiveSheet()->getCell($subjectColumn.$row);
                $spreadsheet->getActiveSheet()->getStyle($subjectColumn)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $spreadsheet->getActiveSheet()->setCellValue($subjectColumn.$row.$this->erow, $value->total_cls);
                $spreadsheet->getActiveSheet()->getColumnDimension($subjectColumn)->setAutoSize(true);

                $subjectColumn++;
                $cell = $spreadsheet->getActiveSheet()->getCell($subjectColumn.$row);
                $spreadsheet->getActiveSheet()->getStyle($subjectColumn)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $spreadsheet->getActiveSheet()->setCellValue($subjectColumn.$row.$this->erow, $value->tot_stuatt);
                $spreadsheet->getActiveSheet()->getColumnDimension($subjectColumn)->setAutoSize(true);


                $row++;
              }
            // exit;

             $file_name=$examName[0]->exam_name ."report.xlsx";
             header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
             header('Content-Disposition: attachment;filename='."$file_name");
             header('Cache-Control: max-age=0');


         $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
         return $writer->save('php://output');


//    $pdf = PDF::loadView('Exam.examReportDownload',['marks'=>$marks,'subjects'=>$subjects])->setPaper('a4', 'landscape');
  // return view('Exam.examReportDownload',compact('marks','subjects')); //$pdf->download($id.'.pdf');
  // return $pdf->download($exam.'.pdf');
  }

  public function mark_register(Request $request)
  {
    $cid=$request->cid;
    $bid=$request->bid;
     $exam=DB::table('tb_exam')->where('branch_code',Auth::user()->school_id)->get();
    // ->where('academic_year',app_config('Session',Auth::user()->school_id))
      $course=DB::table('tb_course')->where('branch_code',Auth::user()->school_id)->get();
//print_r($exam);

       $s=DB::table('subject_allocation')
          ->join('tb_subject','subject_allocation.subject','=','tb_subject.id')
          ->where('subject_allocation.branch_code',Auth::user()->school_id)
          ->where('subject_allocation.batch','=',$bid)
          ->where('subject_allocation.course','=',$cid)
          ->get();

           $m=DB::table('mark_register')
          ->join('tb_course','mark_register.course','=','tb_course.id')
          ->join('tb_batch','mark_register.batch','=','tb_batch.id')
          ->groupby('mark_register.register_no')
          ->where('mark_register.batch','=',$bid)
          ->where('mark_register.course','=',$cid)
          ->get();
		   $mk=null;
          $result=array();
          foreach($m as $mkk)
          {
             $mkk->register_no;

               $mk=DB::table('mark_register')
          ->join('tb_course','mark_register.course','=','tb_course.id')
          ->join('tb_batch','mark_register.batch','=','tb_batch.id')
          ->where('mark_register.batch','=',$bid)
          ->where('mark_register.course','=',$cid)
          ->where('mark_register.register_no','=',$mkk->register_no)
          ->get();
          foreach($mk as $mm)
          {
            array_push($result,array('id'=>$mm->id,'marks'=>$mm->marks));
          }
          }
           json_encode($result);
         // echo "<pre>";

         // print_r($result);
         // exit;



 $marks = DB::table('mark_register')
                 ->join('stu_admission', 'mark_register.register_no', '=', 'stu_admission.reg_no')
                 ->select('mark_register.subject','mark_register.id','stu_admission.stu_name','stu_admission.reg_no','stu_admission.roll_no')
                 ->where('mark_register.batch','2')
                 ->where('mark_register.course','2')
                  ->where('mark_register.exam','4')
                 ->get();
                 $finaldata=array();
                 $marksarray=array();
                 $basic_details=array();
                 foreach($marks as $marks){
                      $stu_name=$marks->stu_name;
                     $reg_no=$marks->reg_no;
                     $roll=$marks->roll_no;
                     $id=$marks->id;
           //        $db= DB::table('mark_register')->where('register_no',$reg_no)->get();
               $db= DB::table('mark_register')
            ->join('tb_subject', 'mark_register.subject', '=', 'tb_subject.id')
            ->select('mark_register.*', 'tb_subject.subject_name')
            ->where('mark_register.register_no',$reg_no)
            ->get();
                   foreach($db as $db){
                       array_push($marksarray,array("marks"=>$db->marks,"subject"=>$db->subject,"sub_name"=>$db->subject_name));
                   }
                    $subs["subjects"]=$marksarray;

                    array_push($basic_details,array("stu_name"=>$stu_name,"reg_id"=>$reg_no,"roll_no"=>$roll,"all_subs"=>$subs));
                    unset($subs);
                    unset($marksarray);
                    $marksarray=array();
                 }
                 //$stu_details['stu_details']=$basic_details;
                 //$subs["subjects"]=$marksarray;
                 //array_merge($stu_details,$subs);
              //  array_push($finaldata,$reg_no,$roll,$stu_name,$subs);
              $d=$basic_details;
              //   echo "<pre>";
              //   print_r(array_unique($basic_details, SORT_REGULAR));

  //              print_r($exam);exit;
      return view('Exam.marks',compact('exam','course','s','m','mk','result'));
  }
  public function all_result(Request $request){

      $cid=$request->cid;
      $bid=$request->bid;
      $examid=$request->examid;
      $subjects= DB::table('assign_subject')
            ->join('tb_subject', 'assign_subject.subject', '=', 'tb_subject.id')
            ->select('assign_subject.*', 'tb_subject.subject_name','tb_subject.id')
            ->where('assign_subject.acadmic_year',app_config('Session',Auth::user()->school_id))
        //    ->where('assign_subject.batch',$bid)
            ->where('assign_subject.course',$cid)
            ->where('assign_subject.status','1')
            ->where('assign_subject.branch_id',Auth::user()->school_id)
            ->groupBy('assign_subject.subject')
            ->get();
      //  echo "<pre>";   print_r($subjects);exit;

 /*$marks = DB::table('mark_register')
                 ->join('stu_admission', 'mark_register.register_no', '=', 'stu_admission.reg_no')
                 ->select('mark_register.subject','mark_register.id','stu_admission.stu_name','stu_admission.reg_no','stu_admission.roll_no')
                 ->where('mark_register.batch',$bid)
                 ->where('mark_register.course',$cid)
              //    ->where('mark_register.exam',$examid)
                 ->get(); */

$sql="SELECT a.register_no,a.student_name,GROUP_CONCAT(CONCAT_WS('|',a.subject,a.marks)) AS marks FROM mark_register a
WHERE a.exam='$examid' AND a.course='$cid' AND a.batch='$bid'
GROUP BY a.register_no";
$marks = DB::select($sql);

                /* $finaldata=array();
                 $marksarray=array();
                 $basic_details=array();
                 foreach($marks as $marks){
                      $stu_name=$marks->stu_name;
                     $reg_no=$marks->reg_no;
                     $roll=$marks->roll_no;
                     $id=$marks->id;
           //        $db= DB::table('mark_register')->where('register_no',$reg_no)->get();
               $db= DB::table('mark_register')
            ->join('tb_subject', 'mark_register.subject', '=', 'tb_subject.id')
            ->select('mark_register.*', 'tb_subject.subject_name')
            ->where('mark_register.register_no',$reg_no)
            ->get();
                   foreach($db as $db){
                       array_push($marksarray,array("register_no"=>$db->register_no,"marks"=>$db->marks,"subject"=>$db->subject,"sub_name"=>$db->subject_name));
                   }
                    $subs["subjects"]=$marksarray;

                    array_push($basic_details,array("stu_name"=>$stu_name,"reg_id"=>$reg_no,"roll_no"=>$roll,"all_subs"=>$subs));
                    unset($subs);
                    unset($marksarray);
                    $marksarray=array();
                 }
           $d="hg";
          // $data=array_unique($basic_details, SORT_REGULAR);
           //echo $subjects."|".json_encode($data); */
           return view('Exam.showmarks',compact('subjects','marks'));
  }

  public function create_mark_register(Request $request)
  {
  // $grade="SELECT tb_marks_grade.grade_name FROM tb_marks_grade WHERE '90' BETWEEN tb_marks_grade.percent_from and tb_marks_grade.percent_upto";


      $exam=DB::table('tb_exam')->where('branch_code',Auth::user()->school_id)->get();
      $course=DB::table('tb_course')->where('branch_code',Auth::user()->school_id)->get();
      $academic_year=DB::table('academicyear')->orderBy('startyear','desc')->get();
      return view('Exam.create_mark_register',compact('exam','course','academic_year'));
  }


  public function p_student_details(Request $request)
  {
        $bid=$request->bid;
        $cid=$request->cid;
        $examid=$request->examid;
        $subject=$request->subject;
       DB::enableQueryLog();
       $student=DB::table('stu_admission')
      ->LeftJoin('personallity_traits_exam' ,function($join) use ($examid){
        $join->on('stu_admission.reg_no','personallity_traits_exam.reg_no');
        $join->on('stu_admission.course','personallity_traits_exam.course');
        $join->on('stu_admission.batch','personallity_traits_exam.batch');
        $join->on('personallity_traits_exam.exam','=',DB::raw($examid));
      })
      ->select('personallity_traits_exam.*','stu_admission.*')
      ->where('stu_admission.course',$cid)
      ->where('stu_admission.batch',$bid)
      ->where('stu_admission.branch_code',Auth::user()->school_id)
      ->where('stu_admission.accdmic_year',app_config('Session',Auth::user()->school_id))
      ->orderBy('stu_admission.id','desc')
      ->get();
    //  $query = DB::getQueryLog();

    //  print_r($query);exit;
      $exam_details=DB::table('tb_exam')->where('id',$examid)->get();
      $cntmarks=DB::table('mark_register')->where('exam',$examid)->where('course',$cid)->where('batch',$bid)->where('subject',$subject)->where('academic_year',app_config('Session',Auth::user()->school_id))->count();

      echo $student."|".$exam_details."|".$cntmarks;
  }


  public function student_details(Request $request)
  {
         $data=$request->data;
         $values=explode("|",$data);
         $subject=$values[0];
         $cid=$values[1];
         $bid=$values[2];
         $academic_year=$values[3];
         $examid=$request->exam_id;
         $type=$request->type;
       DB::enableQueryLog();
	   $ob = "CAST(stu_admission.roll_no AS UNSIGNED) asc";
       $student=DB::table('stu_admission')
      ->LeftJoin('mark_register' ,function($join) use ($examid, $subject){
        $join->on('stu_admission.reg_no','mark_register.register_no');
        $join->on('stu_admission.course','mark_register.course');
        $join->on('stu_admission.batch','mark_register.batch');
        $join->on('mark_register.exam','=',DB::raw($examid));
        $join->on('mark_register.subject','=',DB::raw($subject));
      })
      ->select('stu_admission.*',\DB::raw('IF(mark_register.marks is NULL,"NA",mark_register.marks) as marks ,IF(mark_register.id is NULL,0,mark_register.id) as marks_id'))
      ->where('stu_admission.course',$cid)
      ->where('stu_admission.batch',$bid)
      ->where('stu_admission.branch_code',Auth::user()->school_id)
      ->where('stu_admission.accdmic_year',$academic_year)
      ->orderByRaw($ob)
      ->get();

      $submit_status=DB::table("marks_submit_status")
       ->select('marks_submit_status.*',\DB::raw('IF(marks_submit_status.status is NULL,0,marks_submit_status.status) as status'))
       ->where("academic_year",$academic_year)
       ->where('class',$cid)
       ->where('section',$bid)
       ->where('exam',$examid)
       ->where('sub_code',$subject)
	    ->where('status','1')
       ->where('submitted_by',Auth::user()->username)->get();
     $query = DB::getQueryLog();
 //  echo "<pre>";  print_r($submit_status[0]->status);exit;
    if (isset($submit_status[0]->status)) {
      $submit_status= $submit_status[0]->status;
    }else{
      $submit_status=0;
    }
	 // print_r($submit_status);exit;
    $graded=DB::table('tb_subject')->where('id',$subject)->get();
    $sub_type=$graded[0]->elective;
    //  print_r($submit_status);exit;
      $exam_details=DB::table('tb_exam')->where('id',$examid)->get();
      $cntmarks=DB::table('mark_register')->where('exam',$examid)->where('course',$cid)->where('batch',$bid)->where('subject',$subject)->where('academic_year',$academic_year)->count();

      if($type=="2"){
        return view("Exam.monthlyExam.stuListForMarksUpload",compact('student','sub_type','exam_details','cntmarks','subject','submit_status'));
      }else{
      return view("Exam.stuListForMarksUpload",compact('student','sub_type','exam_details','cntmarks','subject','submit_status'));
      }
      //echo $student."|".$exam_details."|".$cntmarks;
  }

  public function insert_mark_register(Request $request)
  {
  //  echo $data=Input::get('data');exit;
    $data=explode("|",Input::get('data'));
    $exam_id=Input::get('exam_id');
    $course=Input::get('course');
    $batch=Input::get('batch');
    $subject=$data[3];
    $reg_no=$data[1];
    $roll_no=$data[0];
    $stu_name=$data[2];
    $stu_id=$data[4];
    $attendance=Input::get('attendance');
    $marks=Input::get('marks');
    $marks_id=Input::get('marks_id');
    $full_marks=Input::get('max_marks');
    $pass_marks=Input::get('pass_marks');
    $academic_year=Input::get('academic_year');
    // echo "abs:";
    // print_r($abs);
    // exit;
    $created_date = date('d-m-Y H:i:s');


DB::beginTransaction();
try {
        $checkarray=array(
          "register_no"=>$reg_no,
          "course"=>$course,
          "batch"=>$batch,
          "exam"=>$exam_id,
          "subject"=>$subject,
        //  "uploaded_by"=>Auth::user()->username
        );
        echo $cnt=DB::table('mark_register')->where($checkarray)->count();
        if($cnt==0){
        $save=DB::table('mark_register')
        ->insertGetId(['exam'=>$exam_id,'course'=>$course,'batch'=>$batch,'register_no'=>$reg_no,'roll_no'=>$roll_no,'student_name'=>$stu_name  ,
        'stu_id'=>$stu_id,'full_marks'=>$full_marks,'marks'=>$marks,'subject'=>$subject,
        'academic_year'=>$academic_year,'created_date'=>$created_date
        ,'branch_code'=>Auth::user()->school_id,"uploaded_by"=>Auth::user()->username]);
        if($save){
            DB::commit();
            echo true;
        }
      }else{
      $update=DB::table('mark_register')->where($checkarray)->update(['marks'=>$marks]);
      if($update){
        DB::commit();
        echo true;
      }else{
        echo "Marks Not Updated Succesfully.";
      }
      }

    }catch(\Exception $e){
       DB::rollback();
    //   echo $e;
     echo "Something Went Worng.Please enter marks again.";
    }
  }
  public function final_submit(Request $request){
    $exam_id=Input::get('exam_id');
    $course=Input::get('course');
    $batch=Input::get('batch');
    $subject=Input::get('subject');
    $academic_year=Input::get('academic_year');
    $where=array(
      "academic_year"=>$academic_year,
      "exam"=>$exam_id,
      "class"=>$course,
      "section"=>$batch,
      "sub_code"=>$subject,
      "submitted_by"=>Auth::user()->username,
      "status"=>1
    );
    $insert=array(
      "academic_year"=>$academic_year,
      "exam"=>$exam_id,
      "class"=>$course,
      "section"=>$batch,
      "sub_code"=>$subject,
      "submitted_by"=>Auth::user()->username,
      "status"=>1,
    );
    $cnt=DB::table("marks_submit_status")->where($where)->count();
    if($cnt==0){
    $save=DB::table('marks_submit_status')->insertGetId($insert);
    if($save){
      echo "Marks Submitted Succesfully.";
    }else{
      echo "Unable to submit marks.Please try agian.";
    }
    }else{
      echo "Marks Already Submitted.";
    }
  }
  public function marklist(Request $request)
  {
      $xid=$request->xid;
      $bid=$request->bid;
      $cid=$request->cid;

      $s=DB::table('subject_allocation')
          ->join('tb_subject','subject_allocation.subject','=','tb_subject.id')
          ->where('subject_allocation.branch_code',Auth::user()->school_id)
          ->where('subject_allocation.batch','=',$bid)
          ->where('subject_allocation.course','=',$cid)
          ->get();


            $m=DB::table('mark_register')
          ->join('tb_course','mark_register.course','=','tb_course.id')
          ->join('tb_batch','mark_register.batch','=','tb_batch.id')
          ->join('tb_exam','mark_register.exam','=','tb_exam.id')
          ->groupby('mark_register.register_no')
          ->where('mark_register.batch','=',$bid)
          ->where('mark_register.course','=',$cid)
          ->where('mark_register.exam','=',$xid)
          ->get();
          $result=array();
          foreach($s as $ss)
          {

          foreach($m as $mkk)
          {
             $mkk->register_no;

               $mk=DB::table('mark_register')
          ->join('tb_course','mark_register.course','=','tb_course.id')
          ->join('tb_batch','mark_register.batch','=','tb_batch.id')
          ->join('tb_subject','mark_register.subject','=','tb_subject.id')
          ->join('tb_exam','mark_register.exam','=','tb_exam.id')
          ->where('mark_register.batch','=',$bid)
          ->where('mark_register.course','=',$cid)
          ->where('mark_register.exam','=',$xid)
          ->where('mark_register.register_no','=',$mkk->register_no)
          ->where('mark_register.subject','=',$ss->subject)
          ->get();
          foreach($mk as $mm)
          {
            array_push($result,array('marks'=>$mm->marks,'reg_no'=>$mm->register_no,'id'=>$mm->id));
          }
          }
        }

        echo $s.'|' .json_encode($result) .'|' .$m;
  }

public function marks_studentlist(Request $request)
{
echo $cid=$request->cid;
echo $bid=$request->bid;

  $student=DB::table('stu_admission')
  ->where('course',$cid)
  ->where('batch',$bid)
   ->where('stu_admission.branch_code',Auth::user()->school_id)
  ->where('stu_admission.acadmic_year',app_config('Session',Auth::user()->school_id))
        ->orderBy('id','desc')
        ->get();
   echo $student;

}

public function view_report(Request $request,$id)
{
        $reg_no=DB::table('stu_admission')
        ->where('id',$id)
        ->get();
        foreach($reg_no as $r_no)
        {
          $reg=$r_no->reg_no;
          $cls=$r_no->course;
        }
        $student_detail=DB::table('stu_admission')
        ->join('tb_course','stu_admission.course','=','tb_course.id')
        ->join('tb_batch','stu_admission.batch','=','tb_batch.id')
        ->where('reg_no','=',$reg)
        ->get();

        $grade=DB::table('tb_marks_grade')->get();
        $std=DB::table('assign_subject')
        ->join('tb_subject','assign_subject.subject','=','tb_subject.id')
        ->select('tb_subject.subject_name','tb_subject.id')
        ->where('course','=',$cls)
        ->get();
        $exam=DB::table('tb_exam')
        ->get();
        $result=array();
        foreach($exam as $ex)
        {

            $report=DB::table('mark_register')
          ->join('tb_subject','mark_register.subject','=','tb_subject.id')
          ->join('tb_exam','mark_register.exam','=','tb_exam.id')
          ->where('mark_register.register_no','=',$reg)
          ->where('mark_register.exam','=',$ex->id)
          ->get();

        foreach($report as $r)
        {
          if($ex->id == $r->exam)
          {
              array_push($result,array('marks'=>$r->marks,'subject'=>$r->subject,'exam'=>$r->exam,'exam_name'=>$r->exam_name));
          }
        }
        }
        json_encode($result);
        // echo"<pre>";
        // print_r($result);
        // exit;


        return view('Exam.view_report_card',compact('result','std','exam','student_detail','grade'));
    }

    public function search_grade_name(Request $request)
    {
      $marks=$request->marks;
      $grade=DB::table('tb_marks_grade')
       ->where('percent_from','>=',$marks)
      ->where('percent_upto','<=',$marks)
      ->get();
      foreach($grade as $g)
      {
        echo $g->grade_name;
      }
    }

	public function student_exam_report(Request $request)
	{
		$course=DB::table('tb_course')->where('branch_code',Auth::user()->school_id)->get();
      $accadmicyear = DB::table('academicyear')
        ->where('branch_code',Auth::user()->school_id)->orderBy('startyear','desc')
        ->get();
        $exam=DB::table('tb_exam')->where('branch_code',Auth::user()->school_id)->where('academic_year',app_config('Session',Auth::user()->school_id))->get();

        $spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$writer = new Xlsx($spreadsheet);

 $style=array(
        'alignment' => array(
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
          ),
        'font' => array(
                //'bold' => true,
                //'color' => array('rgb' => 'FF0000'),
                'size' => 8,
                'name' => 'Arial'
         ),
        'borders' => array(
                'allborders' => array(
                    'style' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
                )
        )
       );


		return view('Exam.search_by_student',compact('course','accadmicyear','exam'));
	}


public function view_student_exam_report(Request $request){
    $reg_no=$request->reg_no;
     $session=$request->session;
     $cid=$request->cid;
      $batch=$request->batch;
      $exam=$request->exam;
    $result=DB::table('mark_register')
    ->join('tb_subject','mark_register.subject','=','tb_subject.id')
    ->select('mark_register.*','tb_subject.subject_name')
    ->where('mark_register.academic_year',$session)
    ->where('mark_register.exam',$exam)->where('mark_register.course',$cid)->where('mark_register.batch',$batch)->where('mark_register.register_no',$reg_no)->get();
      echo $result;
}

	public function student_for_mark(Request $request)
	{
    $cid=$request->cid;
    $bid=$request->bid;
    $accadmicyear=$request->accadmicyear;
		$student=DB::table('stu_admission')
    ->where('course','=',$cid)
    ->where('batch','=',$bid)
    ->where('acadmic_year','=',$accadmicyear)
    ->get();
    echo $student;
	}

  public function mark_by_student_name(Request $request,$cid,$id)
  {
    $cls=$request->cid;
    $id=$request->id;


        $reg_no=DB::table('stu_admission')
        ->where('id',$id)
        ->get();
        foreach($reg_no as $r_no)
        {
         echo $reg=$r_no->reg_no;


        }

     $student_detail=DB::table('stu_admission')
        ->join('tb_course','stu_admission.course','=','tb_course.id')
        ->join('tb_batch','stu_admission.batch','=','tb_batch.id')
        ->where('reg_no','=',$reg)
        ->get();

        $grade=DB::table('tb_marks_grade')->get();
        $std=DB::table('assign_subject')
        ->join('tb_subject','assign_subject.subject','=','tb_subject.id')
        ->select('tb_subject.subject_name','tb_subject.id')
        ->where('course','=',$cls)
        ->get();
        $exam=DB::table('tb_exam')
        ->get();
        $result=array();
        foreach($exam as $ex)
        {
            $report=DB::table('mark_register')
          ->join('tb_subject','mark_register.subject','=','tb_subject.id')
          ->join('tb_exam','mark_register.exam','=','tb_exam.id')
          ->where('mark_register.register_no','=',$reg)
          ->where('mark_register.exam','=',$ex->id)
          ->get();

        foreach($report as $r)
        {
          if($ex->id == $r->exam)
          {
              array_push($result,array('marks'=>$r->marks,'subject'=>$r->subject,'exam'=>$r->exam,'exam_name'=>$r->exam_name));
          }
        }
        }
         json_encode($result);
          return view('Exam.view_student_report_card',compact('result','std','exam','student_detail','grade'));
  }


  public function downloadResult(Request $request,$cid,$reg_no,$session,$batch,$exam){

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$writer = new Xlsx($spreadsheet);

$examtype=DB::table('tb_exam')->where('id',$exam)->get();
foreach($examtype as $examtype){
    $examname=$examtype->exam_name;
}

 $style=array(
        'alignment' => array(
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
          ),
        'font' => array(
                //'bold' => true,
                //'color' => array('rgb' => 'FF0000'),
                'size' => 18,
                'name' => 'Arial'

         ),
        'borders' => array(
                'allborders' => array(
                    'style' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
                )
        )
       );

    $sheet->getStyle('A1:B1')->applyFromArray($style);
    $spreadsheet->getActiveSheet()->getStyle('A1:J1')->applyFromArray($style);
    $spreadsheet->getActiveSheet()->getStyle('B1')->applyFromArray($style);
    $spreadsheet->setActiveSheetIndex(0);

    $spreadsheet->getActiveSheet()->setTitle("Result");


   $spreadsheet->getActiveSheet()->getStyle('E1:J1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $spreadsheet->getActiveSheet()->mergeCells('A1:B1');
    $spreadsheet->getActiveSheet()->mergeCells('C1:J1');
    $spreadsheet->getActiveSheet()->getStyle('A1'.$this->erow)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->getStyle('C1'.$this->erow)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->setCellValue('C1'.$this->erow, Auth::user()->school_name);
    $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(35);

   // $spreadsheet->getActiveSheet()->setCellValue('A1', 'www.phpexcel.net');
//    $spreadsheet->getActiveSheet()->getCell('A1')->setPath()->setUrl(asset(app_config('AppLogo',Auth::user()->school_id)));


    $spreadsheet->getActiveSheet()->getStyle('C2:J2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $spreadsheet->getActiveSheet()->mergeCells('A2:B2');
    $spreadsheet->getActiveSheet()->mergeCells('C2:J2');
    $spreadsheet->getActiveSheet()->getStyle('A2'.$this->erow)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->getStyle('C2'.$this->erow)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->setCellValue('C2'.$this->erow, institute_details('2','insitute_address'));
    $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(35);

    $spreadsheet->getActiveSheet()->getStyle('C3:J3')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $spreadsheet->getActiveSheet()->mergeCells('A3:B3');
    $spreadsheet->getActiveSheet()->mergeCells('C3:J3');
    $spreadsheet->getActiveSheet()->getStyle('C3'.$this->erow)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->getStyle('C3'.$this->erow)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->setCellValue('C3'.$this->erow, "Phone No : ".institute_details('2','insitute_mobile'));
    $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(35);


    $spreadsheet->getActiveSheet()->getStyle('D5:I5')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $spreadsheet->getActiveSheet()->mergeCells('D5:I5');

    $spreadsheet->getActiveSheet()->getStyle('D5'.$this->erow)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->getStyle('D5'.$this->erow)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->setCellValue('D5'.$this->erow, $examname." - ".$session);
    $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(35);


    $stu_details = DB::table('stu_admission')
            ->join('tb_course', 'stu_admission.course', '=', 'tb_course.id')
            ->join('tb_batch', 'stu_admission.batch', '=', 'tb_batch.id')
            ->select('stu_admission.*', 'tb_course.course_name', 'tb_batch.batch_name')
            ->where('stu_admission.course',$cid)
            ->where('stu_admission.batch',$batch)
            ->where('stu_admission.reg_no',base64_decode($reg_no))
            ->where('stu_admission.acadmic_year',app_config('Session',Auth::user()->school_id))
            ->get();

foreach($stu_details as $stu_details){
    $stu_name=$stu_details->stu_name;
    $course_name=$stu_details->course_name;
    $batch_name=$stu_details->batch_name;
}

      $file_name="Result_of_".$stu_name."-".base64_decode($reg_no).".xlsx";

//    $spreadsheet->getActiveSheet()->getStyle('D6')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
  //  $spreadsheet->getActiveSheet()->mergeCells('A6:C6');
    $spreadsheet->getActiveSheet()->mergeCells('D7:F7');
    $spreadsheet->getActiveSheet()->getStyle('D7'.$this->erow)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->getStyle('D7'.$this->erow)->getAlignment()->setWrapText(true);

    $spreadsheet->getActiveSheet()->setCellValue('D7'.$this->erow, "Name : ".$stu_name);
    $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);


 //   $spreadsheet->getActiveSheet()->getStyle('H6')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
  //  $spreadsheet->getActiveSheet()->mergeCells('A6:C6');
    $spreadsheet->getActiveSheet()->mergeCells('H7:J7');
    $spreadsheet->getActiveSheet()->getStyle('H7'.$this->erow)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->getStyle('H7'.$this->erow)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->setCellValue('H7'.$this->erow, "Reg. No. : ".base64_decode($reg_no));
    $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);

    $spreadsheet->getActiveSheet()->getStyle('D8')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $spreadsheet->getActiveSheet()->getStyle('E8')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

    $spreadsheet->getActiveSheet()->getStyle('D8'.$this->erow)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->getStyle('D8'.$this->erow)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->setCellValue('D8'.$this->erow, "Class : ");
    $spreadsheet->getActiveSheet()->setCellValue('E8'.$this->erow, $course_name);
    $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);


   $spreadsheet->getActiveSheet()->getStyle('H8')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
  $spreadsheet->getActiveSheet()->getStyle('I8')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

  //  $spreadsheet->getActiveSheet()->mergeCells('A6:C6');
   // $spreadsheet->getActiveSheet()->mergeCells('H7');
    $spreadsheet->getActiveSheet()->getStyle('H8'.$this->erow)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->getStyle('H8'.$this->erow)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->setCellValue('H8'.$this->erow, "Section : ");
    $spreadsheet->getActiveSheet()->setCellValue('I8'.$this->erow, $batch_name);
    $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);


    //$spreadsheet->getActiveSheet()->getStyle('E10:F10')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $spreadsheet->getActiveSheet()->mergeCells('E10:F10');
    $spreadsheet->getActiveSheet()->getStyle('E10'.$this->erow)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->getStyle('E10'.$this->erow)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->getStyle('E10'.$this->erow)->getFont()->setBold(true);
    $spreadsheet->getActiveSheet()->setCellValue('E10'.$this->erow, "Subject");
    $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);


    //$spreadsheet->getActiveSheet()->getStyle('H10:I10')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $spreadsheet->getActiveSheet()->mergeCells('H10:I10');
    $spreadsheet->getActiveSheet()->getStyle('H10'.$this->erow)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->getStyle('H10'.$this->erow)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->setCellValue('H10'.$this->erow, "Marks");
    $spreadsheet->getActiveSheet()->getStyle('H10'.$this->erow)->getFont()->setBold(true);
    $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);


     $result=DB::table('mark_register')
    ->join('tb_subject','mark_register.subject','=','tb_subject.id')
    ->select('mark_register.*','tb_subject.subject_name')
    ->where('mark_register.academic_year',$session)
    ->where('mark_register.exam',$exam)->where('mark_register.course',$cid)->where('mark_register.batch',$batch)->where('mark_register.register_no',base64_decode($reg_no))->get();
$i=10;
$count=0;
$j=0;
$k=0;
$fullmarks=0;
$obatin_marks=0;
$note=0;
foreach($result as $result){
    $i=$i+1;
   $passmarks=$result->pass_marks;
   $fullmarks+=$result->full_marks;
   if($result->marks=='AB'){
       $mk='0';
   }else{
       $mk=$result->marks;
   }
   $obatin_marks+=$mk;


  //  $spreadsheet->getActiveSheet()->getStyle('E'.$i.':' .'F'.$i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $spreadsheet->getActiveSheet()->mergeCells('E'.$i.':' .'F'.$i);
    $spreadsheet->getActiveSheet()->getStyle('E'.$i.$this->erow)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->getStyle('E'.$i.$this->erow)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->setCellValue('E'.$i.$this->erow, $result->subject_name);
    $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);

  //  $spreadsheet->getActiveSheet()->getStyle('H'.$i.':' .'I'.$i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $spreadsheet->getActiveSheet()->mergeCells('H'.$i.':' .'I'.$i);
    $spreadsheet->getActiveSheet()->getStyle('H'.$i.$this->erow)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->setCellValue('H'.$i.$this->erow, $result->marks.'/'.$result->full_marks);
    $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);

     $conditional1 = new \PhpOffice\PhpSpreadsheet\Style\Conditional();
    $conditional1->setConditionType(\PhpOffice\PhpSpreadsheet\Style\Conditional::CONDITION_CELLIS);
    $conditional1->setOperatorType(\PhpOffice\PhpSpreadsheet\Style\Conditional::OPERATOR_EQUAL);
    $conditional1->addCondition('0');
    $conditional1->getStyle()->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_RED);
    $conditional1->getStyle()->getFont()->setBold(true);

    $conditionalStyles = $spreadsheet->getActiveSheet()->getStyle('H'.$i.$this->erow)->getConditionalStyles();
    $conditionalStyles[] = $conditional1;

    $spreadsheet->getActiveSheet()->getStyle('H'.$i.$this->erow)->setConditionalStyles($conditionalStyles);
    $j=$i+3;
    $k=$i+2;
    $note=$i+5;
    if($result->marks < $passmarks || $result->marks=='AB'){
        $count=$count+1;
    }
    }
    if($count <= '0'){
        $finalresult="Pass";
    }else{
        $finalresult="Fail";
    }

      $spreadsheet->getActiveSheet()->getStyle('G'.$k.':' .'I'.$k)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $spreadsheet->getActiveSheet()->mergeCells('G'.$k.':' .'I'.$k);
    $spreadsheet->getActiveSheet()->getStyle('G'.$k.$this->erow)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->getStyle('G'.$k.$this->erow)->getFont()->setBold(true);
    $spreadsheet->getActiveSheet()->setCellValue('G'.$k.$this->erow, "Total Marks : ".$obatin_marks.'/'.intval($fullmarks));
    $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);


    $spreadsheet->getActiveSheet()->getStyle('G'.$j.':' .'I'.$j)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $spreadsheet->getActiveSheet()->mergeCells('G'.$j.':' .'I'.$j);
    $spreadsheet->getActiveSheet()->getStyle('G'.$j.$this->erow)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->getStyle('G'.$j.$this->erow)->getFont()->setBold(true);
    $spreadsheet->getActiveSheet()->setCellValue('G'.$j.$this->erow, "Result : ".$finalresult);
    $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);

   $spreadsheet->getActiveSheet()->getStyle('B'.$note.':' .'K'.$note)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $spreadsheet->getActiveSheet()->mergeCells('B'.$note.':' .'K'.$note);
    $spreadsheet->getActiveSheet()->getStyle('B'.$note.$this->erow)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->getStyle('B'.$note.$this->erow)->getFont()->setBold(true);
    $spreadsheet->getActiveSheet()->setCellValue('B'.$note.$this->erow, "Note: This is System Generated Marks Sheet.For any Correction Please Contact Authority.");
    $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename='."$file_name");
    header('Cache-Control: max-age=0');


$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
return $writer->save('php://output');

  }


  public function personality_traits(Request $request){
      		$course=DB::table('tb_course')->where('branch_code',Auth::user()->school_id)->get();
      $accadmicyear = DB::table('academicyear')
        ->where('branch_code',Auth::user()->school_id)->orderBy('startyear','desc')
        ->get();
        $exam=DB::table('tb_exam')->where('branch_code',Auth::user()->school_id)->get();



      return view('Exam.personality_traits',compact('course','accadmicyear','exam'));

  }

    public function savepersonality_traits(Request $request){
        $self='Exam/personality_traits/save';
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
          'academicyear'=>'required',
          'exam'=>'required',
          'course'=>'required',
          'batch'=>'required',
        ]);

      $session=Input::get('academicyear');
      $exam=Input::get('exam');
      $courses=Input::get('course');
      $batch=Input::get('batch');
      $reg_no=Input::get('reg_no');
      $cleanliness=Input::get('cleanliness');
      $co_operative=Input::get('co_operative');
      $stu_name=Input::get('stu_name');
      $obedience=Input::get('obedience');
      $courtesty=Input::get('courtesty');
      $persistence=Input::get('persistence');
      $industry=Input::get('industry');
      $promptness=Input::get('promptness');
      $honesty=Input::get('honesty');
      $date=date('d:m:Y');
    try{
        for($i=0;$i<count($reg_no);$i++)
    {
      $where=array(
  "reg_no"=>$reg_no[$i],
  "batch"=>$batch,
  "course"=>$courses,
  "exam"=>$exam,
  "session"=>$session,
);
//print_r($where);
$cnt=DB::table('personallity_traits_exam')->where($where)->count();
//echo $cnt;exit;
if($cnt==0){
  $save=DB::table('personallity_traits_exam')->insert(['reg_no'=>$reg_no[$i],'stu_name'=>$stu_name[$i],'batch'=>$batch,'course'=>$courses,
        'exam'=>$exam,'session'=>$session,'cleanliness'=>$cleanliness[$i],'co_operative'=>$co_operative[$i],'courtesty'=>$courtesty[$i],'industry'=>$industry[$i],'honesty'=>$honesty[$i],'obedience'=>$obedience[$i]
        ,'persistence'=>$persistence[$i],'promptness'=>$promptness[$i],'created_at'=>$date]);
}else{
  $update=array(
    "cleanliness"=>$cleanliness[$i],
    "co_operative"=>$co_operative[$i],
    "courtesty"=>$courtesty[$i],
    "industry"=>$industry[$i],
    "honesty"=>$honesty[$i],
    "obedience"=>$obedience[$i],
    "persistence"=>$persistence[$i],
    "promptness"=>$promptness[$i],
  );
  DB::table('personallity_traits_exam')->where($where)->update($update);


}

    }
    return redirect('Exam/personality_traits')->with([
              'message' => 'Personality Traits Marks Uploaded Successfully.'
       ]);
      }catch(\Illuminate\Database\QueryException $ex){
             return redirect('Exam/personality_traits')->with([
                    'message' => "something Went Worng.Please Try Again. Error :  ". $ex->getMessage(),
                    'message_important'=>true
               ]);
      }


           /*      try{
DB::table('personallity_traits_exam')->insert(['reg_no'=>$reg_no,'batch'=>$batch,'course'=>$courses,
        'exam'=>$exam,'session'=>$session,'cleanliness'=>$cleanliness,'co_operative'=>$co_operative,'courtesty'=>$courtesty,'industry'=>$industry,'honesty'=>$honesty,'obedience'=>$obedience
        ,'persistence'=>$persistence,'promptness'=>$promptness,'created_at'=>$date]);
               return redirect('Exam/personality_traits')->with([
                    'message' => 'Personality Traits Marks Uploaded Successfully.'
                ]);
              }catch(\Illuminate\Database\QueryException $ex){
                return redirect('Exam/personality_traits')->with([
                    'message' => "something Went Worng.Please Try Again. Error :  ". $ex->getMessage(),
                    'message_important'=>true
                ]);

               }*/


    }
    public function monthlymarkRegister(){
      $academic_year=DB::table('academicyear')->orderBy('startyear','desc')->get();
      $exam=DB::table('tb_exam')->where('exam_name','LIKE','%month%')->where('branch_code',Auth::user()->school_id)->get();
      $course=DB::table('tb_course')->where('branch_code',Auth::user()->school_id)->get();
      return view('Exam.monthlyExam.monthlyMarkRegister',compact('exam','course','academic_year'));
    }

  public function savepersonality_traits_last(Request $request){
        $self='Exam/personality_traits/save';
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
          'academicyear'=>'required',
          'exam'=>'required',
          'course'=>'required',
          'batch'=>'required',
          'student'=>'required',
          'cleanliness'=>'required',
          'honesty'=>'required',
          'co_operative'=>'required',
          'obedience'=>'required',
          'courtesty'=>'required',
          'persistence'=>'required',
          'industry'=>'required',
          'promptness'=>'required'
        ]);

      $session=Input::get('academicyear');
      $exam=Input::get('exam');
      $courses=Input::get('course');
      $batch=Input::get('batch');
      $reg_no=Input::get('student');
      $cleanliness=Input::get('cleanliness');
      $co_operative=Input::get('co_operative');
      $obedience=Input::get('obedience');
      $courtesty=Input::get('courtesty');
      $persistence=Input::get('persistence');
      $industry=Input::get('industry');
      $promptness=Input::get('promptness');
      $honesty=Input::get('honesty');
      $date=date('d:m:Y');
         try{
        DB::table('personallity_traits_exam')->insert(['reg_no'=>$reg_no,'batch'=>$batch,'course'=>$courses,
        'exam'=>$exam,'session'=>$session,'cleanliness'=>$cleanliness,'co_operative'=>$co_operative,'courtesty'=>$courtesty,'industry'=>$industry,'honesty'=>$honesty,'obedience'=>$obedience
        ,'persistence'=>$persistence,'promptness'=>$promptness,'created_at'=>$date]);
               return redirect('Exam/personality_traits')->with([
                    'message' => 'Personality Traits Marks Uploaded Successfully.'
                ]);
              }catch(\Illuminate\Database\QueryException $ex){
                return redirect('Exam/personality_traits')->with([
                    'message' => "something Went Worng.Please Try Again. Error :  ". $ex->getMessage(),
                    'message_important'=>true
                ]);

               }

  }
    public function savemonthlymark(Request $request)
  {
    $dataValue=Input::get('data');
    $data=explode("|",$dataValue);
    $exam_id=Input::get('exam_id');
    $course=Input::get('course');
    $batch=Input::get('batch');
    $subject=$data[3];
    $reg_no=$data[1];
	  $roll_no=$data[0];
    $month=Input::get('month');
    $stu_name=$data[2];
    $stu_id=$data[4];
    $attendance=Input::get('attendance');
    $marks=Input::get('marks');
    $full_marks=Input::get('max_marks');
    $pass_marks=Input::get('pass_marks');
    $month=Input::get('month');
    $session=Input::get('academic_year');
    $created_date = date('d-m-Y');
    $year=date('Y');
    $where=array(
        "reg_no"=>$reg_no,
        "exam"=>$exam_id,
        "course"=>$course,
        "batch"=>$batch,
        "subject"=>$subject,
        "month"=>$month,
      );
      $cnt=DB::table('monthly_exam')->where($where)->count();
      if($cnt==0){
        $save=DB::table('monthly_exam')
        ->insert(['reg_no'=>$reg_no,'student_name'=>$stu_name,'roll_no'=>$roll_no,'exam'=>$exam_id,
        'course'=>$course,'batch'=>$batch,'month'=>$month,'year'=>$year,'subject'=>$subject,
        'full_marks'=>$full_marks,'pass_marks'=>$pass_marks,'marks'=>$marks
        ,'created_by'=>Auth::user()->emp_code,'session'=>$session,'created_at'=>$created_date]);
      }else{
        DB::table('monthly_exam')->where($where)->update(['marks'=>$marks]);
      }
      echo true;
   }
      public function student_details_monthly(Request $request)
  {
    //  echo "ok"; exit;
    $data=explode("|",$request->subject);
        $bid=$request->bid;
        $cid=$request->cid;
        $examid=$request->examid;
        $subject=$data[0];
        $month=$request->month;
        $academic_year=$request->session;

  /*  $student=DB::table('stu_admission')
      ->where('course',$cid)
      ->where('batch',$bid)
       ->where('stu_admission.branch_code',Auth::user()->school_id)
      ->where('stu_admission.accdmic_year',app_config('Session',Auth::user()->school_id))
      ->orderBy('id','desc')
      ->get();
*/
	  $ob = "CAST(stu_admission.roll_no AS UNSIGNED) asc";
      $student=DB::table('stu_admission')
     ->LeftJoin('monthly_exam' ,function($join) use ($examid, $subject,$month){
       $join->on('stu_admission.reg_no','monthly_exam.reg_no');
       $join->on('stu_admission.course','monthly_exam.course');
       $join->on('stu_admission.batch','monthly_exam.batch');
       $join->on('monthly_exam.exam','=',DB::raw($examid));
       $join->on('monthly_exam.subject','=',DB::raw($subject));
       $join->on('monthly_exam.month','=',DB::raw($month));
     })
     ->select('stu_admission.*',\DB::raw('IF(monthly_exam.marks is NULL,"NA",monthly_exam.marks) as marks ,IF(monthly_exam.id is NULL,0,monthly_exam.id) as marks_id'))
     ->where('stu_admission.course',$cid)
     ->where('stu_admission.batch',$bid)
     ->where('stu_admission.branch_code',Auth::user()->school_id)
     ->where('stu_admission.accdmic_year',$academic_year)
     ->orderByRaw($ob)
     ->get();

     $submit_status=DB::table("marks_submit_status")
      ->select('marks_submit_status.*',\DB::raw('IF(marks_submit_status.status is NULL,0,marks_submit_status.status) as status'))
      ->where("academic_year",$academic_year)
      ->where('class',$cid)
      ->where('section',$bid)
      ->where('exam',$examid)
      ->where('sub_code',$subject)
      ->where('submitted_by',Auth::user()->username)->get();

     if (isset($submit_status[0]->status)) {
       $submit_status= $submit_status[0]->status;
     }else{
       $submit_status=0;
     }
     $submit_status=0;
     $graded=DB::table('tb_subject')->where('id',$subject)->get();
     $sub_type=$graded[0]->elective;
     //echo $subject;
     $exam_details=DB::table('tb_exam')->where('id',$examid)->get();
    // print_r($exam_details);exit;
     $cntmarks=DB::table('monthly_exam')->where('exam',$examid)->where('month',$month)->where('course',$cid)->where('batch',$bid)->where('subject',$subject)->where('session',$academic_year)->count();
     return view("Exam.monthlyExam.stuListForMarksUpload",compact('student','sub_type','exam_details','cntmarks','subject','submit_status'));
    //  echo $student."|".$exam_details."|".$cntmarks;
  }

  public function final_result(){
      		$course=DB::table('tb_course')->where('branch_code',Auth::user()->school_id)->get();
      $accadmicyear = DB::table('academicyear')
        ->where('branch_code',Auth::user()->school_id)->orderBy('startyear','desc')
        ->get();
         $exam=DB::table('tb_exam')->where('branch_code',Auth::user()->school_id)->get();
	    return view('Exam.final_result',compact('course','accadmicyear','exam'));

  }


    public function downloadResultfinal(Request $request,$cid,$reg_no,$session,$batch,$exam){

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$writer = new Xlsx($spreadsheet);
$spreadsheet->getActiveSheet()->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
$spreadsheet->getActiveSheet()->getPageSetup()->setPaperSize(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_A4);
$spreadsheet->getActiveSheet()->getPageSetup()->setFitToWidth(1);
$spreadsheet->getActiveSheet()->getPageSetup()->setFitToHeight(0);

$examtype=DB::table('tb_exam')->where('id',$exam)->get();
foreach($examtype as $examtype){
    $examname=$examtype->exam_name;
}

 $style=array(
        'alignment' => array(
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
          ),
        'font' => array(
                //'bold' => true,
                //'color' => array('rgb' => 'FF0000'),
                'size' => 18,
                'name' => 'Arial'

         ),
        'borders' => array(
                'allborders' => array(
                    'style' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
                )
        )
       );

    $sheet->getStyle('A1:B1')->applyFromArray($style);
    $spreadsheet->getActiveSheet()->getStyle('B1')->applyFromArray($style);
    $spreadsheet->setActiveSheetIndex(0);


   // $drawing->setPath(asset(app_config('AppLogo',Auth::user()->school_id)));

    $spreadsheet->getActiveSheet()->setTitle("Result");



   $spreadsheet->getActiveSheet()->getStyle('E1:J1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $spreadsheet->getActiveSheet()->mergeCells('A1:B1');
    $spreadsheet->getActiveSheet()->mergeCells('G1:P1');
    $spreadsheet->getActiveSheet()->getStyle('A1'.$this->erow)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->getStyle('G1'.$this->erow)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->setCellValue('G1'.$this->erow, Auth::user()->school_name);
    $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(35);

   // $spreadsheet->getActiveSheet()->setCellValue('A1', 'www.phpexcel.net');
  //    $spreadsheet->getActiveSheet()->getCell('A1')->setPath()->setUrl(asset(app_config('AppLogo',Auth::user()->school_id)));


    $spreadsheet->getActiveSheet()->getStyle('C2:J2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $spreadsheet->getActiveSheet()->mergeCells('A2:B2');
    $spreadsheet->getActiveSheet()->mergeCells('G2:P2');
    $spreadsheet->getActiveSheet()->getStyle('A2'.$this->erow)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->getStyle('G2'.$this->erow)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->setCellValue('G2'.$this->erow, institute_details('2','insitute_address'));
    $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(35);

    $spreadsheet->getActiveSheet()->getStyle('C3:J3')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $spreadsheet->getActiveSheet()->mergeCells('A3:B3');
    $spreadsheet->getActiveSheet()->mergeCells('G3:P3');
    $spreadsheet->getActiveSheet()->getStyle('G3'.$this->erow)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->setCellValue('G3'.$this->erow, "Phone No : ".institute_details('2','insitute_mobile'));
    $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(35);


    $spreadsheet->getActiveSheet()->getStyle('G5:P5')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $spreadsheet->getActiveSheet()->mergeCells('G5:P5');

    $spreadsheet->getActiveSheet()->getStyle('G5'.$this->erow)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->getStyle('G5'.$this->erow)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->setCellValue('G5'.$this->erow, $examname." - ".$session);
    $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(35);


    $stu_details = DB::table('stu_admission')
            ->join('tb_course', 'stu_admission.course', '=', 'tb_course.id')
            ->join('tb_batch', 'stu_admission.batch', '=', 'tb_batch.id')
            ->select('stu_admission.*', 'tb_course.course_name', 'tb_batch.batch_name')
            ->where('stu_admission.course',$cid)
            ->where('stu_admission.batch',$batch)
            ->where('stu_admission.reg_no',base64_decode($reg_no))
            ->where('stu_admission.acadmic_year',app_config('Session',Auth::user()->school_id))
            ->get();

foreach($stu_details as $stu_details){
    $stu_name=$stu_details->stu_name;
    $course_name=$stu_details->course_name;
    $batch_name=$stu_details->batch_name;
}



//    $spreadsheet->getActiveSheet()->getStyle('D6')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
  //  $spreadsheet->getActiveSheet()->mergeCells('A6:C6');
    $spreadsheet->getActiveSheet()->mergeCells('H7:K7');
    $spreadsheet->getActiveSheet()->getStyle('H7'.$this->erow)->getAlignment()->setWrapText(true);

    $spreadsheet->getActiveSheet()->setCellValue('H7'.$this->erow, "Name : ".$stu_name);
    $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);


 //   $spreadsheet->getActiveSheet()->getStyle('H6')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
  //  $spreadsheet->getActiveSheet()->mergeCells('A6:C6');
    $spreadsheet->getActiveSheet()->mergeCells('M7:O7');
    $spreadsheet->getActiveSheet()->getStyle('M7'.$this->erow)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->setCellValue('M7'.$this->erow, "Reg. No. : ".base64_decode($reg_no));
    $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);

   $spreadsheet->getActiveSheet()->getStyle('I8')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
  // $spreadsheet->getActiveSheet()->getStyle('H8')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

    $spreadsheet->getActiveSheet()->getStyle('I8'.$this->erow)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->getStyle('H8'.$this->erow)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->setCellValue('H8'.$this->erow, "Class : ");
    $spreadsheet->getActiveSheet()->setCellValue('I8'.$this->erow, $course_name);
    $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);


   //  $spreadsheet->getActiveSheet()->mergeCells('A6:C6');
   // $spreadsheet->getActiveSheet()->mergeCells('H7');
    $spreadsheet->getActiveSheet()->getStyle('M8')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

    $spreadsheet->getActiveSheet()->getStyle('M8'.$this->erow)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->getStyle('N8'.$this->erow)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->setCellValue('M8'.$this->erow, "Section : ");
    $spreadsheet->getActiveSheet()->setCellValue('N8'.$this->erow, $batch_name);
    $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);

    $spreadsheet->getActiveSheet()->getStyle('A10:V10')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
    $spreadsheet->getActiveSheet()->getStyle('A10:V10')->getFill()->getStartColor()->setARGB('CCCC');
   // $spreadsheet->getActiveSheet()->getStyle('A10:V10')->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_RED);


    $spreadsheet->getActiveSheet()->mergeCells('B10:C10');
    $spreadsheet->getActiveSheet()->getStyle('B10:C10')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

    $spreadsheet->getActiveSheet()->getStyle('B10'.$this->erow)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->getStyle('B10'.$this->erow)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->getStyle('B10'.$this->erow)->getFont()->setBold(true);
    $spreadsheet->getActiveSheet()->setCellValue('B10'.$this->erow, "Subject");
    $spreadsheet->getActiveSheet()->getStyle('B10'.$this->erow)->getFont()->setSize(10);
    $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);


    $spreadsheet->getActiveSheet()->mergeCells('D10:E10');
    $spreadsheet->getActiveSheet()->getStyle('D10:E10')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

    $spreadsheet->getActiveSheet()->getStyle('D10'.$this->erow)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->getStyle('D10'.$this->erow)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->setCellValue('D10'.$this->erow, "1st Term (100 marks)");
    $spreadsheet->getActiveSheet()->getStyle('D10'.$this->erow)->getFont()->setBold(true);
    $spreadsheet->getActiveSheet()->getStyle('D10'.$this->erow)->getFont()->setSize(10);
    $spreadsheet->getActiveSheet()->getRowDimension('10')->setRowHeight(35);


    $spreadsheet->getActiveSheet()->mergeCells('F10:G10');
       $spreadsheet->getActiveSheet()->getStyle('F10:G10')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

    $spreadsheet->getActiveSheet()->getStyle('F10'.$this->erow)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->getStyle('F10'.$this->erow)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->setCellValue('F10'.$this->erow, "2st Term (100 marks)");
    $spreadsheet->getActiveSheet()->getStyle('F10'.$this->erow)->getFont()->setBold(true);
    $spreadsheet->getActiveSheet()->getStyle('F10'.$this->erow)->getFont()->setSize(10);

    $spreadsheet->getActiveSheet()->mergeCells('H10:I10');
       $spreadsheet->getActiveSheet()->getStyle('H10:I10')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

    $spreadsheet->getActiveSheet()->getStyle('H10'.$this->erow)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->getStyle('H10'.$this->erow)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->setCellValue('H10'.$this->erow, "Monthly Test (100 marks)");
    $spreadsheet->getActiveSheet()->getStyle('H10'.$this->erow)->getFont()->setBold(true);
    $spreadsheet->getActiveSheet()->getStyle('H10'.$this->erow)->getFont()->setSize(10);
    $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);

    $spreadsheet->getActiveSheet()->mergeCells('J10:K10');
       $spreadsheet->getActiveSheet()->getStyle('J10:K10')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

    $spreadsheet->getActiveSheet()->getStyle('J10'.$this->erow)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->getStyle('J10'.$this->erow)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->setCellValue('J10'.$this->erow, "Annual Exam (100 marks)");
    $spreadsheet->getActiveSheet()->getStyle('J10'.$this->erow)->getFont()->setBold(true);
    $spreadsheet->getActiveSheet()->getStyle('J10'.$this->erow)->getFont()->setSize(10);
    $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);


    $spreadsheet->getActiveSheet()->mergeCells('L10:M10');
    $spreadsheet->getActiveSheet()->getStyle('L10:M10')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

    $spreadsheet->getActiveSheet()->getStyle('L10'.$this->erow)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->getStyle('L10'.$this->erow)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->setCellValue('L10'.$this->erow, "1st Term (15%)");
    $spreadsheet->getActiveSheet()->getStyle('L10'.$this->erow)->getFont()->setBold(true);
    $spreadsheet->getActiveSheet()->getStyle('L10'.$this->erow)->getFont()->setSize(10);
    $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);


    $spreadsheet->getActiveSheet()->mergeCells('N10:O10');
    $spreadsheet->getActiveSheet()->getStyle('N10:O10')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

    $spreadsheet->getActiveSheet()->getStyle('N10'.$this->erow)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->getStyle('N10'.$this->erow)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->setCellValue('N10'.$this->erow, "2st Term (15%)");
    $spreadsheet->getActiveSheet()->getStyle('N10'.$this->erow)->getFont()->setBold(true);
    $spreadsheet->getActiveSheet()->getStyle('N10'.$this->erow)->getFont()->setSize(10);
    $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);

    $spreadsheet->getActiveSheet()->mergeCells('P10:Q10');
       $spreadsheet->getActiveSheet()->getStyle('P10:Q10')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

    $spreadsheet->getActiveSheet()->getStyle('P10'.$this->erow)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->getStyle('P10'.$this->erow)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->setCellValue('P10'.$this->erow, "Monthly Test (20%)");
    $spreadsheet->getActiveSheet()->getStyle('P10'.$this->erow)->getFont()->setBold(true);
    $spreadsheet->getActiveSheet()->getStyle('P10'.$this->erow)->getFont()->setSize(10);
    $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);


    $spreadsheet->getActiveSheet()->mergeCells('R10:S10');
       $spreadsheet->getActiveSheet()->getStyle('R10:S10')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

    $spreadsheet->getActiveSheet()->getStyle('R10'.$this->erow)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->getStyle('R10'.$this->erow)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->setCellValue('R10'.$this->erow, "Annaual (50%)");
    $spreadsheet->getActiveSheet()->getStyle('R10'.$this->erow)->getFont()->setBold(true);
    $spreadsheet->getActiveSheet()->getStyle('R10'.$this->erow)->getFont()->setSize(10);
    $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);

    $spreadsheet->getActiveSheet()->mergeCells('T10:U10');
    $spreadsheet->getActiveSheet()->getStyle('T10:U10')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $spreadsheet->getActiveSheet()->getStyle('T10'.$this->erow)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->getStyle('T10'.$this->erow)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->setCellValue('T10'.$this->erow, "Grand Total (100 Marks)");
    $spreadsheet->getActiveSheet()->getStyle('T10'.$this->erow)->getFont()->setBold(true);
    $spreadsheet->getActiveSheet()->getStyle('T10'.$this->erow)->getFont()->setSize(10);
    $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);

     $result=DB::table('assign_subject')
    ->join('tb_subject','assign_subject.subject','=','tb_subject.id')
    ->select('assign_subject.*','tb_subject.subject_name')
    ->where('assign_subject.acadmic_year',$session)
    ->where('assign_subject.course',$cid)->where('assign_subject.batch',$batch)->get();

    #print_r($result);exit;
    $i=10;
    $pt=0;
      foreach($result as $result){
    $fmk="";
    $smk="";
    $mmk="";
    $amk="";

        $sub_code=$result->subject;


    $i=$i+1;
    $spreadsheet->getActiveSheet()->getStyle('B'.$i.':' .'C'.$i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $spreadsheet->getActiveSheet()->mergeCells('B'.$i.':' .'C'.$i);
    $spreadsheet->getActiveSheet()->getStyle('B'.$i.$this->erow)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->getStyle('B'.$i.$this->erow)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->setCellValue('B'.$i.$this->erow, $result->subject_name);
    $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);
    $grandtotal=0;
    // 1st term exam marks

     $first_query = DB::table('mark_register')->select(DB::raw('marks'))->where('exam','6')->where('subject',$sub_code)->where('academic_year',$session)->where('course',$cid)->where('batch',$batch)->where('register_no',base64_decode($reg_no))->get();

          foreach($first_query as $first_query){
           $fmk=$first_query->marks;

          }
  if($fmk=="0"){
     $fmk="0";
     $finalfmk="0";
 }else if($fmk==null){
     $fmk="-";
     $finalfmk="-";
 }else if($fmk=="AB"){
     $fmk="AB";
     $finalfmk="AB";
}else if($fmk=="-"){

     $finalfmk="-";
}else{
     $finalfmk=$fmk*15/100;
     $grandtotal+=$finalfmk;
}
    $spreadsheet->getActiveSheet()->mergeCells('D'.$i.':'.'E'.$i);
    $spreadsheet->getActiveSheet()->getStyle('D'.$i.':'.'E'.$i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $spreadsheet->getActiveSheet()->getStyle('D'.$i.$this->erow)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->getStyle('D'.$i.$this->erow)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->setCellValue('D'.$i.$this->erow, $fmk);

    $spreadsheet->getActiveSheet()->mergeCells('L'.$i.':'.'M'.$i);
    $spreadsheet->getActiveSheet()->getStyle('L'.$i.':'.'M'.$i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $spreadsheet->getActiveSheet()->getStyle('L'.$i.$this->erow)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->getStyle('L'.$i.$this->erow)->getAlignment()->setWrapText(true);
   // $spreadsheet->getActiveSheet()->setCellValue('R'.$i.$this->erow,"=(IF(J$i>=0,J$i*50/100,IF(EXACT(J$i,AB),AB,0)))");
    $spreadsheet->getActiveSheet()->setCellValue('L'.$i.$this->erow,$finalfmk);


       // 2st term exam marks

     $second_query = DB::table('mark_register')->select(DB::raw('marks'))->where('exam','7')->where('subject',$sub_code)->where('academic_year',$session)->where('course',$cid)->where('batch',$batch)->where('register_no',base64_decode($reg_no))->get();

          foreach($second_query as $second_query){
           $smk=$second_query->marks;

          }

  if($smk=="0"){
     $smk="0";
     $finalsmk="0";
 }else if($smk==null){
     $smk="-";
     $finalsmk="-";
 }else if($smk=="AB"){
     $smk="AB";
     $finalsmk="AB";
}else if($smk=="-"){
     $smk=$smk;
     $finalsmk="-";
}else{
     $smk=$smk;
     $finalsmk=$smk*15/100;
     $grandtotal+=$finalsmk;
}
    $spreadsheet->getActiveSheet()->mergeCells('F'.$i.':'.'G'.$i);
    $spreadsheet->getActiveSheet()->getStyle('F'.$i.':'.'G'.$i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $spreadsheet->getActiveSheet()->getStyle('F'.$i.$this->erow)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->getStyle('F'.$i.$this->erow)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->setCellValue('F'.$i.$this->erow,  $smk);



    $spreadsheet->getActiveSheet()->mergeCells('N'.$i.':'.'O'.$i);
    $spreadsheet->getActiveSheet()->getStyle('N'.$i.':'.'O'.$i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $spreadsheet->getActiveSheet()->getStyle('N'.$i.$this->erow)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->getStyle('N'.$i.$this->erow)->getAlignment()->setWrapText(true);
   // $spreadsheet->getActiveSheet()->setCellValue('R'.$i.$this->erow,"=(IF(J$i>=0,J$i*50/100,IF(EXACT(J$i,AB),AB,0)))");
    $spreadsheet->getActiveSheet()->setCellValue('N'.$i.$this->erow,$finalsmk);


       // MONTHLY exam marks

     $monthlyquery = DB::table('monthly_exam')->select(DB::raw('SUM(marks) as marks'))->where('subject',$sub_code)->where('session',$session)->where('course',$cid)->where('batch',$batch)->where('reg_no',base64_decode($reg_no))->get();

          foreach($monthlyquery as $monthlyquery){
           $mmk=$monthlyquery->marks;

          }

  if($mmk=="0"){
     $mmk="0";
     $finalmmk="0";
 }else if($mmk==null){
     $mmk="-";
     $finalmmk="-";
 }else if($mmk=="AB"){
     $mmk="AB";
     $finalmmk="AB";
}else if($mmk=="-"){
     $mmk=$mmk;
     $finalmmk="-";
}else{
     $mmk=$mmk;
     $finalmmk=$mmk*20/100;
     $grandtotal+=$finalmmk;
}
    $spreadsheet->getActiveSheet()->mergeCells('H'.$i.':'.'I'.$i);
    $spreadsheet->getActiveSheet()->getStyle('H'.$i.':'.'I'.$i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $spreadsheet->getActiveSheet()->getStyle('H'.$i.$this->erow)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->setCellValue('H'.$i.$this->erow,$mmk);

    $spreadsheet->getActiveSheet()->mergeCells('P'.$i.':'.'Q'.$i);
    $spreadsheet->getActiveSheet()->getStyle('P'.$i.':'.'Q'.$i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $spreadsheet->getActiveSheet()->getStyle('P'.$i.$this->erow)->getAlignment()->setWrapText(true);
    // $spreadsheet->getActiveSheet()->setCellValue('R'.$i.$this->erow,"=(IF(J$i>=0,J$i*50/100,IF(EXACT(J$i,AB),AB,0)))");
    $spreadsheet->getActiveSheet()->setCellValue('P'.$i.$this->erow,$finalmmk);



    // Annual term exam marks
     $annual_query = DB::table('mark_register')->select(DB::raw('marks'))->where('exam','5')->where('subject',$sub_code)->where('academic_year',$session)->where('course',$cid)->where('batch',$batch)->where('register_no',base64_decode($reg_no))->get();

          foreach($annual_query as $annual_query){
           $amk=$annual_query->marks;

          }
    $spreadsheet->getActiveSheet()->mergeCells('J'.$i.':'.'K'.$i);
    $spreadsheet->getActiveSheet()->getStyle('J'.$i.':'.'K'.$i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $spreadsheet->getActiveSheet()->getStyle('J'.$i.$this->erow)->getAlignment()->setWrapText(true);
  //   $spreadsheet->getActiveSheet()->setCellValue('J'.$i.$this->erow,(!empty($amk)) ? $amk : (empty($amk) ? $amk :"-"));
 if($amk=="0"){
     $amk="0";
     $finalamk="0";
 }else if($amk==null){
     $amk="-";
     $finalamk="-";
 }else if($amk=="AB"){
      $amk="AB";
     $finalamk="AB";
}else if($amk=="-"){
     $amk=$amk;
     $amk="-";
}else{
       $amk=$amk;
       $finalamk=$amk*50/100;
       $grandtotal+=$finalamk;
}
    $spreadsheet->getActiveSheet()->setCellValue('J'.$i.$this->erow,$amk);

    $spreadsheet->getActiveSheet()->mergeCells('R'.$i.':'.'S'.$i);
    $spreadsheet->getActiveSheet()->getStyle('R'.$i.':'.'S'.$i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $spreadsheet->getActiveSheet()->getStyle('R'.$i.$this->erow)->getAlignment()->setWrapText(true);
   // $spreadsheet->getActiveSheet()->setCellValue('R'.$i.$this->erow,"=(IF(J$i>=0,J$i*50/100,IF(EXACT(J$i,AB),AB,0)))");
    $spreadsheet->getActiveSheet()->setCellValue('R'.$i.$this->erow,$finalamk);



    $spreadsheet->getActiveSheet()->mergeCells('T'.$i.':'.'U'.$i);
    $spreadsheet->getActiveSheet()->getStyle('T'.$i.':'.'U'.$i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $spreadsheet->getActiveSheet()->getStyle('T'.$i.$this->erow)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->setCellValue('T'.$i.$this->erow,round($grandtotal));

 }
 $ptm=0;
 $pt=$i+4;
 $ptn=$pt+2;
    $spreadsheet->getActiveSheet()->mergeCells('K'.$pt.':'.'M'.$pt);
    $spreadsheet->getActiveSheet()->getStyle('K'.$pt.':'.'M'.$pt)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $spreadsheet->getActiveSheet()->getStyle('K'.$pt.$this->erow)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->setCellValue('K'.$pt.$this->erow, "PERSONALITY TRAITS");
    $spreadsheet->getActiveSheet()->getStyle('K'.$pt.$this->erow)->getFont()->setBold(true);
    $spreadsheet->getActiveSheet()->getStyle('K'.$pt.$this->erow)->getFont()->setSize(12);
    $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);

    $spreadsheet->getActiveSheet()->getStyle('A'.$ptn.':'.'V'.$ptn)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
    $spreadsheet->getActiveSheet()->getStyle('A'.$ptn.':'.'V'.$ptn)->getFill()->getStartColor()->setARGB('CCCC');

    //$ptfirst=DB
     $ptfirst = DB::table('personallity_traits_exam')->where('exam','6')->where('session',$session)->where('course',$cid)->where('batch',$batch)->where('reg_no',base64_decode($reg_no))->get();
     $cleanliness="";
     $co_operative="";
     $courtesty="";
     $industry="";
     $honesty="";
     $obedience="";
     $persistence="";
     $promptness="";
     foreach($ptfirst as $ptfirst){
         $cleanliness=$ptfirst->cleanliness;
         $co_operative=$ptfirst->co_operative;
         $courtesty=$ptfirst->courtesty;
         $industry=$ptfirst->industry;
         $honesty=$ptfirst->honesty;
         $obedience=$ptfirst->obedience;
         $persistence=$ptfirst->persistence;
         $promptness=$ptfirst->promptness;
     }
     $ptsecond = DB::table('personallity_traits_exam')->where('exam','7')->where('session',$session)->where('course',$cid)->where('batch',$batch)->where('reg_no',base64_decode($reg_no))->get();
     $scleanliness="";
     $sco_operative="";
     $scourtesty="";
     $sindustry="";
     $shonesty="";
     $sobedience="";
     $spersistence="";
     $spromptness="";
     foreach($ptsecond as $ptsecond){
         $scleanliness=$ptsecond->cleanliness;
         $sco_operative=$ptsecond->co_operative;
         $scourtesty=$ptsecond->courtesty;
         $sindustry=$ptsecond->industry;
         $shonesty=$ptsecond->honesty;
         $sobedience=$ptsecond->obedience;
         $spersistence=$ptsecond->persistence;
         $spromptness=$ptsecond->promptness;
     }
     $atsecond = DB::table('personallity_traits_exam')->where('exam','5')->where('session',$session)->where('course',$cid)->where('batch',$batch)->where('reg_no',base64_decode($reg_no))->get();
     $acleanliness="";
     $aco_operative="";
     $acourtesty="";
     $aindustry="";
     $ahonesty="";
     $aobedience="";
     $apersistence="";
     $apromptness="";
     foreach($atsecond as $atsecond){
         $acleanliness=$atsecond->cleanliness;
         $aco_operative=$atsecond->co_operative;
         $acourtesty=$atsecond->courtesty;
         $aindustry=$atsecond->industry;
         $ahonesty=$atsecond->honesty;
         $aobedience=$atsecond->obedience;
         $apersistence=$atsecond->persistence;
         $apromptness=$atsecond->promptness;
     }

     //print_r($ptfirst);exit;

    $spreadsheet->getActiveSheet()->mergeCells('F'.$ptn.':'.'G'.$ptn);
    $spreadsheet->getActiveSheet()->getStyle('F'.$ptn.':'.'G'.$ptn)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $spreadsheet->getActiveSheet()->getStyle('F'.$ptn.$this->erow)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->setCellValue('F'.$ptn.$this->erow, "TRAITS");
    $spreadsheet->getActiveSheet()->getStyle('F'.$ptn.$this->erow)->getFont()->setBold(true);
    $spreadsheet->getActiveSheet()->getStyle('F'.$ptn.$this->erow)->getFont()->setSize(11);
    $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);

    $ptn1=$ptn+2;
    $spreadsheet->getActiveSheet()->mergeCells('F'.$ptn1.':'.'G'.$ptn1);
    $spreadsheet->getActiveSheet()->getStyle('F'.$ptn1.':'.'G'.$ptn1)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $spreadsheet->getActiveSheet()->getStyle('F'.$ptn1.$this->erow)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->setCellValue('F'.$ptn1.$this->erow, "CLEANLINESS");
 //   $spreadsheet->getActiveSheet()->getStyle('F'.$ptn1.$this->erow)->getFont()->setBold(true);
    $spreadsheet->getActiveSheet()->getStyle('F'.$ptn1.$this->erow)->getFont()->setSize(11);
    $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);


    $spreadsheet->getActiveSheet()->getStyle('H'.$ptn1)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $spreadsheet->getActiveSheet()->getStyle('H'.$ptn1.$this->erow)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->setCellValue('H'.$ptn1.$this->erow, $cleanliness?$cleanliness:'-');
    $spreadsheet->getActiveSheet()->getStyle('H'.$ptn1.$this->erow)->getFont()->setSize(11);
    $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);

    $spreadsheet->getActiveSheet()->getStyle('I'.$ptn1)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $spreadsheet->getActiveSheet()->getStyle('I'.$ptn1.$this->erow)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->setCellValue('I'.$ptn1.$this->erow, $scleanliness?$scleanliness:'-');
    $spreadsheet->getActiveSheet()->getStyle('I'.$ptn1.$this->erow)->getFont()->setSize(11);
    $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);

    $spreadsheet->getActiveSheet()->getStyle('J'.$ptn1)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $spreadsheet->getActiveSheet()->getStyle('J'.$ptn1.$this->erow)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->setCellValue('J'.$ptn1.$this->erow, $acleanliness?$acleanliness:'-');
    $spreadsheet->getActiveSheet()->getStyle('J'.$ptn1.$this->erow)->getFont()->setSize(11);
    $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);


    $ptn2=$ptn+3;
    $spreadsheet->getActiveSheet()->mergeCells('F'.$ptn2.':'.'G'.$ptn2);
    $spreadsheet->getActiveSheet()->getStyle('F'.$ptn2.':'.'G'.$ptn2)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $spreadsheet->getActiveSheet()->getStyle('F'.$ptn2.$this->erow)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->setCellValue('F'.$ptn2.$this->erow, "CO-OPERATIVE");
 //   $spreadsheet->getActiveSheet()->getStyle('F'.$ptn2.$this->erow)->getFont()->setBold(true);
    $spreadsheet->getActiveSheet()->getStyle('F'.$ptn2.$this->erow)->getFont()->setSize(11);
    $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);

    $spreadsheet->getActiveSheet()->getStyle('H'.$ptn2)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $spreadsheet->getActiveSheet()->getStyle('H'.$ptn2.$this->erow)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->setCellValue('H'.$ptn2.$this->erow, $co_operative);
    $spreadsheet->getActiveSheet()->getStyle('H'.$ptn2.$this->erow)->getFont()->setSize(11);
    $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);

    $spreadsheet->getActiveSheet()->getStyle('I'.$ptn2)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $spreadsheet->getActiveSheet()->getStyle('I'.$ptn2.$this->erow)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->setCellValue('I'.$ptn2.$this->erow, $sco_operative?$sco_operative:'-');
    $spreadsheet->getActiveSheet()->getStyle('I'.$ptn2.$this->erow)->getFont()->setSize(11);
    $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);

    $spreadsheet->getActiveSheet()->getStyle('J'.$ptn2)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $spreadsheet->getActiveSheet()->getStyle('J'.$ptn2.$this->erow)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->setCellValue('J'.$ptn2.$this->erow, $aco_operative?$aco_operative:'-');
    $spreadsheet->getActiveSheet()->getStyle('J'.$ptn2.$this->erow)->getFont()->setSize(11);
    $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);




    $ptn3=$ptn+4;
    $spreadsheet->getActiveSheet()->mergeCells('F'.$ptn3.':'.'G'.$ptn3);
    $spreadsheet->getActiveSheet()->getStyle('F'.$ptn3.':'.'G'.$ptn3)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $spreadsheet->getActiveSheet()->getStyle('F'.$ptn3.$this->erow)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->setCellValue('F'.$ptn3.$this->erow, "COURTESY");
  //  $spreadsheet->getActiveSheet()->getStyle('F'.$ptn3.$this->erow)->getFont()->setBold(true);
    $spreadsheet->getActiveSheet()->getStyle('F'.$ptn3.$this->erow)->getFont()->setSize(11);
    $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);

    $spreadsheet->getActiveSheet()->getStyle('H'.$ptn3)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $spreadsheet->getActiveSheet()->getStyle('H'.$ptn3.$this->erow)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->setCellValue('H'.$ptn3.$this->erow, $courtesty?$courtesty:'-');
    $spreadsheet->getActiveSheet()->getStyle('H'.$ptn3.$this->erow)->getFont()->setSize(11);
    $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);

    $spreadsheet->getActiveSheet()->getStyle('I'.$ptn3)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $spreadsheet->getActiveSheet()->getStyle('I'.$ptn3.$this->erow)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->setCellValue('I'.$ptn3.$this->erow, $scourtesty?$scourtesty:'-');
    $spreadsheet->getActiveSheet()->getStyle('I'.$ptn3.$this->erow)->getFont()->setSize(11);
    $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);

    $spreadsheet->getActiveSheet()->getStyle('J'.$ptn3)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $spreadsheet->getActiveSheet()->getStyle('J'.$ptn3.$this->erow)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->setCellValue('J'.$ptn3.$this->erow, $acourtesty?$acourtesty:'-');
    $spreadsheet->getActiveSheet()->getStyle('J'.$ptn3.$this->erow)->getFont()->setSize(11);
    $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);




    $ptn4=$ptn+5;
    $spreadsheet->getActiveSheet()->mergeCells('F'.$ptn4.':'.'G'.$ptn4);
    $spreadsheet->getActiveSheet()->getStyle('F'.$ptn4.':'.'G'.$ptn4)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $spreadsheet->getActiveSheet()->getStyle('F'.$ptn4.$this->erow)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->setCellValue('F'.$ptn4.$this->erow, "INDUSTRY");
  //  $spreadsheet->getActiveSheet()->getStyle('F'.$ptn4.$this->erow)->getFont()->setBold(true);
    $spreadsheet->getActiveSheet()->getStyle('F'.$ptn4.$this->erow)->getFont()->setSize(11);
    $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);

    $spreadsheet->getActiveSheet()->getStyle('H'.$ptn4)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $spreadsheet->getActiveSheet()->getStyle('H'.$ptn4.$this->erow)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->setCellValue('H'.$ptn4.$this->erow, $industry?$industry:'-');
    $spreadsheet->getActiveSheet()->getStyle('H'.$ptn4.$this->erow)->getFont()->setSize(11);
    $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);


    $spreadsheet->getActiveSheet()->getStyle('I'.$ptn4)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $spreadsheet->getActiveSheet()->getStyle('I'.$ptn4.$this->erow)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->setCellValue('I'.$ptn4.$this->erow, $sindustry?$sindustry:'-');
    $spreadsheet->getActiveSheet()->getStyle('I'.$ptn4.$this->erow)->getFont()->setSize(11);
    $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);

    $spreadsheet->getActiveSheet()->getStyle('J'.$ptn4)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $spreadsheet->getActiveSheet()->getStyle('J'.$ptn4.$this->erow)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->setCellValue('J'.$ptn4.$this->erow, $aindustry?$aindustry:'-');
    $spreadsheet->getActiveSheet()->getStyle('J'.$ptn4.$this->erow)->getFont()->setSize(11);
    $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);



    $spreadsheet->getActiveSheet()->getStyle('H'.$pt)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $spreadsheet->getActiveSheet()->getStyle('H'.$ptn.$this->erow)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->setCellValue('H'.$ptn.$this->erow, "1ST TERM");
    $spreadsheet->getActiveSheet()->getStyle('H'.$ptn.$this->erow)->getFont()->setBold(true);
    $spreadsheet->getActiveSheet()->getStyle('H'.$ptn.$this->erow)->getFont()->setSize(10);
    $spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(11);
    $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);




  //  $spreadsheet->getActiveSheet()->mergeCells('F'.$ptn);
//    $spreadsheet->getActiveSheet()->getStyle('F'.$ptn.':'.'J'.$ptn)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $spreadsheet->getActiveSheet()->getStyle('I'.$ptn.$this->erow)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->setCellValue('I'.$ptn.$this->erow, "2ST TERM");
    $spreadsheet->getActiveSheet()->getStyle('I'.$ptn.$this->erow)->getFont()->setBold(true);
    $spreadsheet->getActiveSheet()->getStyle('I'.$ptn.$this->erow)->getFont()->setSize(10);
    $spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(11);
    $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);


//    $spreadsheet->getActiveSheet()->mergeCells('G'.$ptn);
   // $spreadsheet->getActiveSheet()->getStyle('G'.$ptn.':'.'J'.$ptn)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $spreadsheet->getActiveSheet()->getStyle('J'.$ptn.$this->erow)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->setCellValue('J'.$ptn.$this->erow, "Annual Term");
    $spreadsheet->getActiveSheet()->getStyle('J'.$ptn.$this->erow)->getFont()->setBold(true);
    $spreadsheet->getActiveSheet()->getStyle('J'.$ptn.$this->erow)->getFont()->setSize(10);
    $spreadsheet->getActiveSheet()->getColumnDimension('J')->setWidth(11);
    $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);


    $spreadsheet->getActiveSheet()->mergeCells('L'.$ptn.':'.'M'.$ptn);
    $spreadsheet->getActiveSheet()->getStyle('L'.$ptn.':'.'M'.$ptn)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $spreadsheet->getActiveSheet()->getStyle('L'.$ptn.$this->erow)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->setCellValue('L'.$ptn.$this->erow, "TRAITS");
    $spreadsheet->getActiveSheet()->getStyle('L'.$ptn.$this->erow)->getFont()->setBold(true);
    $spreadsheet->getActiveSheet()->getStyle('L'.$ptn.$this->erow)->getFont()->setSize(11);
    $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);



    $ptn1=$ptn+2;
    $spreadsheet->getActiveSheet()->mergeCells('L'.$ptn1.':'.'M'.$ptn1);
    $spreadsheet->getActiveSheet()->getStyle('L'.$ptn1.':'.'M'.$ptn1)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $spreadsheet->getActiveSheet()->getStyle('L'.$ptn1.$this->erow)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->setCellValue('L'.$ptn1.$this->erow, "HONESTY");
 //   $spreadsheet->getActiveSheet()->getStyle('F'.$ptn1.$this->erow)->getFont()->setBold(true);
    $spreadsheet->getActiveSheet()->getStyle('L'.$ptn1.$this->erow)->getFont()->setSize(11);
    $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);

    $spreadsheet->getActiveSheet()->getStyle('N'.$ptn1)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $spreadsheet->getActiveSheet()->getStyle('N'.$ptn1.$this->erow)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->setCellValue('N'.$ptn1.$this->erow, $honesty?$honesty:'-');
    $spreadsheet->getActiveSheet()->getStyle('N'.$ptn1.$this->erow)->getFont()->setSize(11);
    $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);

    $spreadsheet->getActiveSheet()->getStyle('O'.$ptn1)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $spreadsheet->getActiveSheet()->getStyle('O'.$ptn1.$this->erow)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->setCellValue('O'.$ptn1.$this->erow, $shonesty?$shonesty:'-');
    $spreadsheet->getActiveSheet()->getStyle('O'.$ptn1.$this->erow)->getFont()->setSize(11);
    $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);

    $spreadsheet->getActiveSheet()->getStyle('P'.$ptn1)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $spreadsheet->getActiveSheet()->getStyle('P'.$ptn1.$this->erow)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->setCellValue('P'.$ptn1.$this->erow, $ahonesty?$ahonesty:'-');
    $spreadsheet->getActiveSheet()->getStyle('P'.$ptn1.$this->erow)->getFont()->setSize(11);
    $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);


    $ptn2=$ptn+3;
    $spreadsheet->getActiveSheet()->mergeCells('L'.$ptn2.':'.'M'.$ptn2);
    $spreadsheet->getActiveSheet()->getStyle('L'.$ptn2.':'.'M'.$ptn2)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $spreadsheet->getActiveSheet()->getStyle('L'.$ptn2.$this->erow)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->setCellValue('L'.$ptn2.$this->erow, "OBEDIENCE");
 //   $spreadsheet->getActiveSheet()->getStyle('F'.$ptn2.$this->erow)->getFont()->setBold(true);
    $spreadsheet->getActiveSheet()->getStyle('L'.$ptn2.$this->erow)->getFont()->setSize(11);
    $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);

    $spreadsheet->getActiveSheet()->getStyle('N'.$ptn2)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $spreadsheet->getActiveSheet()->getStyle('N'.$ptn2.$this->erow)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->setCellValue('N'.$ptn2.$this->erow, $obedience?$obedience:'-');
    $spreadsheet->getActiveSheet()->getStyle('N'.$ptn2.$this->erow)->getFont()->setSize(11);
    $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);

    $spreadsheet->getActiveSheet()->getStyle('O'.$ptn2)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $spreadsheet->getActiveSheet()->getStyle('O'.$ptn2.$this->erow)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->setCellValue('O'.$ptn2.$this->erow, $sobedience?$sobedience:'-');
    $spreadsheet->getActiveSheet()->getStyle('O'.$ptn2.$this->erow)->getFont()->setSize(11);
    $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);

    $spreadsheet->getActiveSheet()->getStyle('P'.$ptn2)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $spreadsheet->getActiveSheet()->getStyle('P'.$ptn2.$this->erow)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->setCellValue('P'.$ptn2.$this->erow, $aobedience?$aobedience:'-');
    $spreadsheet->getActiveSheet()->getStyle('P'.$ptn2.$this->erow)->getFont()->setSize(11);
    $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);





    $ptn3=$ptn+4;
    $spreadsheet->getActiveSheet()->mergeCells('L'.$ptn3.':'.'M'.$ptn3);
    $spreadsheet->getActiveSheet()->getStyle('L'.$ptn3.':'.'M'.$ptn3)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $spreadsheet->getActiveSheet()->getStyle('L'.$ptn3.$this->erow)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->setCellValue('L'.$ptn3.$this->erow, "PERSISTENCE");
    $spreadsheet->getActiveSheet()->getStyle('L'.$ptn3.$this->erow)->getFont()->setSize(11);
    $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);

    $spreadsheet->getActiveSheet()->getStyle('N'.$ptn3)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $spreadsheet->getActiveSheet()->getStyle('N'.$ptn3.$this->erow)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->setCellValue('N'.$ptn3.$this->erow, $persistence ? $persistence:'-');
    $spreadsheet->getActiveSheet()->getStyle('N'.$ptn3.$this->erow)->getFont()->setSize(11);
    $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);

    $spreadsheet->getActiveSheet()->getStyle('O'.$ptn3)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $spreadsheet->getActiveSheet()->getStyle('O'.$ptn3.$this->erow)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->setCellValue('O'.$ptn3.$this->erow, $spersistence?$spersistence:'-');
    $spreadsheet->getActiveSheet()->getStyle('O'.$ptn3.$this->erow)->getFont()->setSize(11);
    $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);

    $spreadsheet->getActiveSheet()->getStyle('P'.$ptn3)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $spreadsheet->getActiveSheet()->getStyle('P'.$ptn3.$this->erow)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->setCellValue('P'.$ptn3.$this->erow, $apersistence?$apersistence:'-');
    $spreadsheet->getActiveSheet()->getStyle('P'.$ptn3.$this->erow)->getFont()->setSize(11);
    $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);




    $ptn4=$ptn+5;
    $spreadsheet->getActiveSheet()->mergeCells('L'.$ptn4.':'.'M'.$ptn4);
    $spreadsheet->getActiveSheet()->getStyle('L'.$ptn4.':'.'M'.$ptn4)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $spreadsheet->getActiveSheet()->getStyle('L'.$ptn4.$this->erow)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->setCellValue('L'.$ptn4.$this->erow, "PROMPTNESS");
  //  $spreadsheet->getActiveSheet()->getStyle('F'.$ptn4.$this->erow)->getFont()->setBold(true);
    $spreadsheet->getActiveSheet()->getStyle('L'.$ptn4.$this->erow)->getFont()->setSize(11);
    $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);

   $spreadsheet->getActiveSheet()->getStyle('N'.$ptn4)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $spreadsheet->getActiveSheet()->getStyle('N'.$ptn4.$this->erow)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->setCellValue('N'.$ptn4.$this->erow, $promptness?$promptness:'-');
    $spreadsheet->getActiveSheet()->getStyle('N'.$ptn4.$this->erow)->getFont()->setSize(11);
    $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);

    $spreadsheet->getActiveSheet()->getStyle('O'.$ptn4)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $spreadsheet->getActiveSheet()->getStyle('O'.$ptn4.$this->erow)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->setCellValue('O'.$ptn4.$this->erow, $spromptness?$spromptness:'-');
    $spreadsheet->getActiveSheet()->getStyle('O'.$ptn4.$this->erow)->getFont()->setSize(11);
    $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);

    $spreadsheet->getActiveSheet()->getStyle('P'.$ptn4)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $spreadsheet->getActiveSheet()->getStyle('P'.$ptn4.$this->erow)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->setCellValue('P'.$ptn4.$this->erow, $apromptness?$apromptness:'-');
    $spreadsheet->getActiveSheet()->getStyle('P'.$ptn4.$this->erow)->getFont()->setSize(11);
    $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);


    $spreadsheet->getActiveSheet()->getStyle('N'.$ptn.$this->erow)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->setCellValue('N'.$ptn.$this->erow, "1ST TERM");
    $spreadsheet->getActiveSheet()->getStyle('N'.$ptn.$this->erow)->getFont()->setBold(true);
    $spreadsheet->getActiveSheet()->getStyle('N'.$ptn.$this->erow)->getFont()->setSize(10);
    $spreadsheet->getActiveSheet()->getColumnDimension('N')->setWidth(11);
    $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);


    $spreadsheet->getActiveSheet()->getStyle('O'.$ptn.$this->erow)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->setCellValue('O'.$ptn.$this->erow, "2ST TERM");
    $spreadsheet->getActiveSheet()->getStyle('O'.$ptn.$this->erow)->getFont()->setBold(true);
    $spreadsheet->getActiveSheet()->getStyle('O'.$ptn.$this->erow)->getFont()->setSize(10);
    $spreadsheet->getActiveSheet()->getColumnDimension('O')->setWidth(11);
    $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);

    $spreadsheet->getActiveSheet()->getStyle('P'.$ptn.$this->erow)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->setCellValue('P'.$ptn.$this->erow, "Annual TERM");
    $spreadsheet->getActiveSheet()->getStyle('P'.$ptn.$this->erow)->getFont()->setBold(true);
    $spreadsheet->getActiveSheet()->getStyle('P'.$ptn.$this->erow)->getFont()->setSize(10);
    $spreadsheet->getActiveSheet()->getColumnDimension('P')->setWidth(11);
    $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);

    $note1=$ptn4+3;

    $spreadsheet->getActiveSheet()->getStyle('B'.$note1.':'.'V'.$note1)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
    $spreadsheet->getActiveSheet()->getStyle('B'.$note1.':'.'V'.$note1)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
    $spreadsheet->getActiveSheet()->getStyle('B'.$note1.':'.'V'.$note1)->getFill()->getStartColor()->setARGB('FFA0A0A0');
    $spreadsheet->getActiveSheet()->mergeCells('B'.$note1.':'.'V'.$note1);
    $spreadsheet->getActiveSheet()->getStyle('B'.$note1.':'.'V'.$note1)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $spreadsheet->getActiveSheet()->getStyle('B'.$note1.$this->erow)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->setCellValue('B'.$note1.$this->erow, "Grade A = 80 % TO 100% , B = 60% TO 79% , C = 50% TO 59% , D = 40% TO 49% , E = 35% TO 39% ,F = 0% TO 34% .");
    $spreadsheet->getActiveSheet()->getStyle('B'.$note1.$this->erow)->getFont()->setSize(11);
    $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);

    $rstart=$note1+3;
    $spreadsheet->getActiveSheet()->mergeCells('G'.$rstart.':'.'P'.$rstart);
    $spreadsheet->getActiveSheet()->getStyle('G'.$rstart.':'.'P'.$rstart)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $spreadsheet->getActiveSheet()->getStyle('G'.$rstart.$this->erow)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->setCellValue('G'.$rstart.$this->erow, "TEACHER'S REMARKS");
    $spreadsheet->getActiveSheet()->getStyle('G'.$rstart.$this->erow)->getFont()->setSize(11);
    $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);

    $rstatus=$rstart+3;
    $spreadsheet->getActiveSheet()->mergeCells('G'.$rstatus.':'.'P'.$rstatus);
    $spreadsheet->getActiveSheet()->getStyle('G'.$rstatus.':'.'P'.$rstatus)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $spreadsheet->getActiveSheet()->getStyle('G'.$rstatus.$this->erow)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->setCellValue('G'.$rstatus.$this->erow, "Final Result : ");
    $spreadsheet->getActiveSheet()->getStyle('G'.$rstatus.$this->erow)->getFont()->setSize(11);
    $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);

    $rsign=$rstatus+3;
    $spreadsheet->getActiveSheet()->mergeCells('D'.$rsign.':'.'G'.$rsign);
    $spreadsheet->getActiveSheet()->getStyle('D'.$rsign.':'.'G'.$rsign)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $spreadsheet->getActiveSheet()->getStyle('D'.$rsign.$this->erow)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->setCellValue('D'.$rsign.$this->erow, "SIGNATURE SUPERVISOR/HEADMASTER ");
    $spreadsheet->getActiveSheet()->getStyle('D'.$rsign.$this->erow)->getFont()->setSize(11);
    $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);

    $spreadsheet->getActiveSheet()->mergeCells('J'.$rsign.':'.'M'.$rsign);
    $spreadsheet->getActiveSheet()->getStyle('J'.$rsign.':'.'M'.$rsign)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $spreadsheet->getActiveSheet()->getStyle('J'.$rsign.$this->erow)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->setCellValue('J'.$rsign.$this->erow, "CLASS TEACHER");
    $spreadsheet->getActiveSheet()->getStyle('J'.$rsign.$this->erow)->getFont()->setSize(11);
    $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);

    $spreadsheet->getActiveSheet()->mergeCells('P'.$rsign.':'.'S'.$rsign);
    $spreadsheet->getActiveSheet()->getStyle('P'.$rsign.':'.'S'.$rsign)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $spreadsheet->getActiveSheet()->getStyle('P'.$rsign.$this->erow)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->setCellValue('P'.$rsign.$this->erow, "PRINCIPAL ");
    $spreadsheet->getActiveSheet()->getStyle('P'.$rsign.$this->erow)->getFont()->setSize(11);
    $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);


    $stamp=$rsign+3;
    $spreadsheet->getActiveSheet()->mergeCells('P'.$stamp.':'.'S'.$stamp);
    $spreadsheet->getActiveSheet()->getStyle('P'.$stamp.':'.'S'.$stamp)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $spreadsheet->getActiveSheet()->getStyle('P'.$stamp.$this->erow)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->setCellValue('P'.$stamp.$this->erow, "School Seal ");
    $spreadsheet->getActiveSheet()->getStyle('P'.$stamp.$this->erow)->getFont()->setSize(11);
    $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);

    $finalnote=$stamp+5;
    $spreadsheet->getActiveSheet()->getStyle('B'.$finalnote.':'.'V'.$finalnote)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
    $spreadsheet->getActiveSheet()->getStyle('B'.$finalnote.':'.'V'.$finalnote)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
    $spreadsheet->getActiveSheet()->getStyle('B'.$finalnote.':'.'V'.$finalnote)->getFill()->getStartColor()->setARGB('FFA0A0A0');
    $spreadsheet->getActiveSheet()->mergeCells('B'.$finalnote.':'.'V'.$finalnote);
    $spreadsheet->getActiveSheet()->getStyle('B'.$finalnote.':'.'V'.$finalnote)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $spreadsheet->getActiveSheet()->getStyle('B'.$finalnote.$this->erow)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->setCellValue('B'.$finalnote.$this->erow, "Note : This is a system generated RESULT. For any Modification Contact Examination Department..");
    $spreadsheet->getActiveSheet()->getStyle('B'.$finalnote.$this->erow)->getFont()->setSize(11);
    $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(25);
    $file_name="final_Result_of_".$stu_name."_".base64_decode($reg_no).".xlsx";
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename='.$file_name);
    header('Cache-Control: max-age=0');

$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
return $writer->save('php://output');

  }

 }


?>
