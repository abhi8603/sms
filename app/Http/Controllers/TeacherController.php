<?php
namespace App;
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
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\permission;
use App\EmployeeRolesPermission;
use App\EmployeeRoles;
date_default_timezone_set('Asia/Kolkata');
class TeacherController extends Controller
{
	 public function __construct()
  {
      $this->middleware('auth');
      $this->middleware('SchoolMiddleware');
  }
  function getSubjectbyclass(Request $request){
    $class = $request->class_id;     
   // $section = $request->section;
    $subjects=DB::table('assign_subject')
    ->join('tb_subject','assign_subject.subject','tb_subject.id')
    ->where('assign_subject.course',$class)
 //   ->where('assign_subject.batch',$section)
    ->where('assign_subject.acadmic_year',app_config('Session',Auth::user()->school_id))
    ->get();
    echo json_encode($subjects);
  }

  function lessionplanning(){
    
        $self='subject/lession-planning';
        if (\Auth::user()->user_role=='1'){
            $get_perm=permission::permitted($self);
    
            if ($get_perm=='access denied'){
                return redirect('permission-error')->with([
                    'message' => 'You do not have permission to view this page.',
                    'message_important'=>true
                ]);
            }
        }
        $course=DB::table('tb_course')->where('branch_code',Auth::user()->school_id)->orderBy('id','asc')->get();
        $subject=DB::table('tb_subject')->where('branch_code',Auth::user()->school_id)->get();
        $Acadmicyear= DB::table('academicyear')->where('branch_code',Auth::user()->school_id)->get();
    
        //echo app_config('Session',Auth::user()->school_id);
        $lessionplaning= DB::table('tb_lession_planning')
                ->join('tb_course', 'tb_lession_planning.class', '=', 'tb_course.id')
                ->join('tb_batch', 'tb_lession_planning.section', '=', 'tb_batch.id')
                ->select('tb_lession_planning.*', 'tb_course.course_name', 'tb_batch.batch_name')
                ->where('tb_lession_planning.branch_code',Auth::user()->school_id)
                ->where('tb_lession_planning.session',app_config('Session',Auth::user()->school_id))
                ->get();
        return view('Teacher.lession-planning',compact('Acadmicyear','course','subject','lessionplaning'));
      
  }



  public function attendance(Request $request)
  {
  	$self='teacher/attendance';
    if (\Auth::user()->user_role!=='T'){
        $get_perm=permission::permitted($self);

        if ($get_perm=='access denied'){
            return redirect('permission-error')->with([
                'message' => 'You do not have permission to view this page.',
                'message_important'=>true
            ]);
        }
    }
      $course=DB::table('tb_course')->where('branch_code',Auth::user()->school_id)->get();
   $courses=DB::table('tb_course')->where('branch_code',Auth::user()->school_id)->get();
   $accadmicyear = DB::table('academicyear')
   ->where('branch_code',Auth::user()->school_id)
   ->get();
       return view('Teacher.student_attendance',compact('course','courses','accadmicyear'));
  }

  public function teacher_subject(Request $request)
  {
  	 	$self='teacher/teacher_subject';
    if (\Auth::user()->user_role!=='T'){
        $get_perm=permission::permitted($self);

        if ($get_perm=='access denied'){
            return redirect('permission-error')->with([
                'message' => 'You do not have permission to view this page.',
                'message_important'=>true
            ]);
        }
    }
    $idd=DB::table('emp_details')
    ->join('emp_contact','emp_details.empcode','=','emp_contact.emp_id')
    ->select('emp_details.id')
     ->where('emp_contact.phone',Auth::user()->username)
      ->where('emp_contact.branch_code',Auth::user()->school_id)
     ->get();
     foreach($idd as $d)
     {
     	$e_id=$d->id;
     }
      $e_id;

    $subject=DB::table('subject_allocation')
    ->join('emp_details','subject_allocation.emp_id','=','emp_details.id')
    ->join('tb_course','subject_allocation.course','=','tb_course.id')
    ->join('tb_batch','subject_allocation.batch','=','tb_batch.id')
    ->join('tb_subject','subject_allocation.subject','=','tb_subject.id')
     ->where('subject_allocation.branch_code',Auth::user()->school_id)
     ->where('subject_allocation.emp_id',$e_id)
     ->get();

     return view('Teacher.subject_list',compact('subject'));
  }

  public function give_assignment(Request $request)
  {
  	$self='teacher/give_assignment';
    if (\Auth::user()->user_role!=='T'){
        $get_perm=permission::permitted($self);

        if ($get_perm=='access denied'){
            return redirect('permission-error')->with([
                'message' => 'You do not have permission to view this page.',
                'message_important'=>true
            ]);
        }
    }
  
    $course=DB::table('tb_course')->where('branch_code',Auth::user()->school_id)->get();

    return view('Teacher.give_assignment',compact('course'));
  }

  public function add_assignment(Request $request)
  {
  	  $idd=DB::table('emp_details')
    ->join('emp_contact','emp_details.empcode','=','emp_contact.emp_id')
    ->select('emp_details.*')
     ->where('emp_contact.phone',Auth::user()->username)
      ->where('emp_contact.branch_code',Auth::user()->school_id)
     ->get();
     foreach($idd as $d)
     {
     	$e_name=$d->fname.' '.$d->mname.' '.$d->lname;
     }
       $e_name;

       $self='teacher/give_assignment';
    if (\Auth::user()->user_role!=='T'){
        $get_perm=permission::permitted($self);

        if ($get_perm=='access denied'){
            return redirect('permission-error')->with([
                'message' => 'You do not have permission to view this page.',
                'message_important'=>true
            ]);
        }
    }
    $course=Input::get('course');
    $batch=Input::get('batch');
    $subject=Input::get('subject');
    $assignment_date=Input::get('assignment_date');
    $date_of_submission=Input::get('date_of_submission');
    $description=Input::get('description');
     $created_date = date('d-m-Y H:i:s');

     $save=DB::table('assignment')->insert(['course'=>$course,'batch'=>$batch,'subject'=>$subject,'assignment_date'=>$assignment_date,'date_of_submission'=>$date_of_submission,'description'=>$description,'created_by'=>$e_name,'academic_year'=>app_config('Session',Auth::user()->school_id),'created_date'=>$created_date,'branch_code'=>Auth::user()->school_id]);

      if(!empty($save)){
         return redirect('teacher/give_assignment')->with([
                 'message' => 'Assignemt Added Succesfully.'
             ]);
       }else{
              return redirect('teacher/give_assignmentk')->with([
                   'message' => 'Assignemt Added failed.',
                   'message_important'=>true
               ]);
            }
           }

    public function assignment_list()
    {
    	 $self='teacher/assignmentlist';
    if (\Auth::user()->user_role!=='T'){
        $get_perm=permission::permitted($self);

        if ($get_perm=='access denied'){
            return redirect('permission-error')->with([
                'message' => 'You do not have permission to view this page.',
                'message_important'=>true
            ]);
        }
    }
     $course=DB::table('tb_course')->where('branch_code',Auth::user()->school_id)->get();
     return view('Teacher.assignment_list',compact('course'));

    }  

    public function view_assignment(Request $request)
    {
    	$cid=$request->cid;
  	$bid=$request->bid;
  	$sub=$request->sub;

  	$homework=DB::table('assignment')
  	->join('tb_course','assignment.course','=','tb_course.id')
  	->join('tb_batch','assignment.batch','=','tb_batch.id')
  	->join('tb_subject','assignment.subject','tb_subject.id')
  	->select('assignment.*','tb_batch.batch_name','tb_course.course_name','tb_subject.subject_name')
  	->where('assignment.branch_code',Auth::user()->school_id)
  	->where('assignment.course','=',$cid)
  	->where('assignment.batch','=',$bid)
  	->where('assignment.subject','=',$sub)
  	->get();

  	echo $homework;

    }

    public function evaluate_assignment(Request $request,$bid,$cid,$sid,$hid)
  {
  	 $h=$hid;
  

     $session = app_config('Session',Auth::user()->school_id);
    $sql = "SELECT assign_subject.subject,stu_admission.* FROM stu_admission INNER JOIN assign_subject on assign_subject.course=stu_admission.course and assign_subject.batch WHERE stu_admission.course='".$cid."' and stu_admission.batch='".$bid."' and stu_admission.accdmic_year ='".$session."' AND assign_subject.subject='".$sid."' ORDER by stu_admission.id DESC";
	 $result = DB::select($sql);
	 return view('Teacher.evaluate_assignment',compact('result','h'));
  }

  public function evaluate_assignment_status(Request $request)
  {
  	$assignment=Input::get('assignment');
  	$reg_no=Input::get('reg_no');
  	$status=Input::get('status');
  	$created_date = date('d-m-Y H:i:s');

  
  	for($i=0;$i<count($reg_no);$i++)
  	{
  	$save=DB::table('evaluate_assignment')->insert(['student'=>$reg_no[$i],'assignment'=>$assignment,'status'=>$status[$i],'academic_year'=>app_config('Session',Auth::user()->school_id),'created_date'=>$created_date,'branch_code'=>Auth::user()->school_id]);
   }
     		if(!empty($save)){
         return redirect('teacher/assignmentlist')->with([
                 'message' => 'Evaluate Succesfully.'
             ]);
       }else{
              return redirect('teacher/assignmentlist')->with([
                   'message' => 'Evaluate failed.',
                   'message_important'=>true
               ]);
            }
  }

  public function assignment_report(Request $request)
  {
  	$self='teacher/assignment_report';
    if (\Auth::user()->user_role!=='T'){
        $get_perm=permission::permitted($self);

        if ($get_perm=='access denied'){
            return redirect('permission-error')->with([
                'message' => 'You do not have permission to view this page.',
                'message_important'=>true
            ]);
        }
    }
     
 
    $course=DB::table('tb_course')->where('branch_code',Auth::user()->school_id)->get();

    return view('Teacher.assignment_report',compact('course','report','r'));
  }

  public function evalution_report_list(Request $request)
    {
    	 $cid=$request->cid;
    	 $bid=$request->bid;
    	 $sub=$request->sub;
    	 $date=$request->date;
    	 $report=DB::table('evaluate_assignment')
    ->join('assignment','evaluate_assignment.assignment','=','assignment.id')
    ->join('tb_subject','assignment.subject','=','tb_subject.id')
    ->join('stu_admission','evaluate_assignment.student','=','stu_admission.reg_no')
    ->select('stu_admission.stu_name','assignment.assignment_date','assignment.date_of_submission','tb_subject.subject_name','evaluate_assignment.status','evaluate_assignment.id')
    ->where('assignment.course',$cid)
    ->where('assignment.batch',$bid)
    ->where('assignment.subject',$sub)
    ->where('assignment.assignment_date',$date)
    ->get();
    echo $report;

    }

    public function set_marks(Request $request)
  {
      $exam=DB::table('tb_exam')->where('branch_code',Auth::user()->school_id)->get();
      $course=DB::table('tb_course')->where('branch_code',Auth::user()->school_id)->get();
      return view('Teacher.set_marks',compact('exam','course'));
  }

  public function student_attendance(Request $request)
  {
   $course=DB::table('tb_course')
   ->join('class_teacher_allocation','tb_course.id','class_teacher_allocation.course')
   ->where('tb_course.branch_code',Auth::user()->school_id)->where("class_teacher_allocation.teacher_id",Auth::user()->emp_code)->get();
   $courses=DB::table('tb_course')
   ->join('class_teacher_allocation','tb_course.id','class_teacher_allocation.course')
   ->where('tb_course.branch_code',Auth::user()->school_id)->where("class_teacher_allocation.teacher_id",Auth::user()->emp_code)->get();
   $accadmicyear = DB::table('academicyear')
   ->where('branch_code',Auth::user()->school_id)
   ->get();
       return view('Teacher.attendance',compact('course','courses','accadmicyear'));
  
  }

  public function insert_student_attendance(Request $request)
  {
  	$t=date('d-m-Y');
     $day=date("D");
    $month=date("M");

    $course=Input::get('course');
    $batch=Input::get('batch');
    
    $reg_no=Input::get('reg_no');
    $roll_no=Input::get('roll_no');
    $name=Input::get('student_name');
    $attendance=Input::get('attendance');
    $created_date = date('d-m-Y H:i:s');

      
    for($i=0;$i<count($reg_no);$i++)
    {
    	$save=DB::table('stu_attendance')->insert(['reg_no'=>$reg_no[$i],'roll_no'=>$roll_no[$i],'name'=>$name[$i],'att_date'=>$created_date,'day'=>$day,'course'=>$course,'batch'=>$batch,'month'=>$month,'status'=>$attendance[$i],'accadmicyear'=>app_config('Session',Auth::user()->school_id),'branch_code'=>Auth::user()->school_id]);

    }

     		if(!empty($save)){
         return redirect('teacher/student_attendance')->with([
                 'message' => 'Attendance Completed.'
             ]);
       }else{
              return redirect('teacher/student_attendance')->with([
                   'message' => 'Something Wroeng Try Again',
                   'message_important'=>true
               ]);
            }
  }

  public function student_attendance_report(Request $request)
  {
  		$courses=DB::table('tb_course')->where('branch_code',Auth::user()->school_id)->get();
    $accadmicyear = DB::table('academicyear')
    ->where('branch_code',Auth::user()->school_id)
    ->get();
    return view('Teacher.student_attendance_report',compact('courses','accadmicyear'));
  }
}