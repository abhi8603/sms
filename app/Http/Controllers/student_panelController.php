<?php
namespace App\atompay;

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
use App\TransactionRequest;
use App\TransactionResponse;
use Illuminate\Support\Facades\Crypt;
use PDF;
date_default_timezone_set('Asia/Kolkata');
class student_panelController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('StudentMiddleware');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

	public function StartonlineClasses($id){
   $id=Crypt::decrypt($id);
   $id=$id."&output=embed";
  return view('stu_panel.onlineClassStart',compact('id'));
}

public function onlineClasses(){
//  print_r(getNotification());exit;
  $data=DB::table('stu_admission')
         ->where('stu_admission.reg_no',Auth::user()->username)
         ->orderBy('id','desc')
         ->limit(1)
         ->get();
         foreach($data as $d)
         {
            $class=$d->course;
            $section=$d->batch;
         }
         $onlineClasses=DB::table('online_class_schedule')
         ->join('tb_subject','tb_subject.id','online_class_schedule.subject')
         ->join('users','users.emp_code','online_class_schedule.created_by')
         ->select('online_class_schedule.*','users.name','tb_subject.subject_name')
         ->where('online_class_schedule.class',$class)
         ->where('online_class_schedule.section',$section)
         ->where('online_class_schedule.session',app_config('Session',Auth::user()->school_id))
         ->orderBy('online_class_schedule.id','desc')
         ->get();
//print_r($onlineClasses);exit;
  return view('stu_panel.onlineClasses',compact('onlineClasses'));
}

	
     public function studentindex(){
       $id=Auth::user()->username;
      // session(['wardregno' => $id]);
       $wards = DB::table('stu_contact')
                   ->join('stu_admission', 'stu_contact.reg_no', '=', 'stu_admission.reg_no')
                   ->join('tb_course', 'stu_admission.course', '=', 'tb_course.id')
                   ->join('tb_batch', 'stu_admission.batch', '=', 'tb_batch.id')
                   ->select('stu_contact.father_phone', 'stu_admission.accdmic_year', 'stu_admission.reg_no', 'tb_course.course_name', 'tb_batch.batch_name', 'stu_admission.roll_no', 'stu_admission.stu_name')
                   ->where('stu_contact.reg_no',$id)
                   ->where('stu_admission.branch_code',Auth::user()->school_id)
                   ->get();
       $data = DB::table('stu_contact')
                   ->join('stu_admission', 'stu_contact.reg_no', '=', 'stu_admission.reg_no')
                   ->select('stu_contact.father_phone', 'stu_admission.accdmic_year', 'stu_admission.reg_no', 'stu_admission.course', 'stu_admission.batch', 'stu_admission.roll_no', 'stu_admission.stu_name')
                   ->where('stu_contact.reg_no',$id)
                   ->where('stu_admission.branch_code',Auth::user()->school_id)
                   ->get();
      foreach ($data as $data) {
       $course=$data->course;
       $batch=$data->batch;
  }
       app_config('Session',Auth::user()->school_id);
    /*   $classsubject= DB::table('assign_subject')
            ->join('tb_subject', 'assign_subject.subject', '=', 'tb_subject.id')
            ->join('tb_subject', 'assign_subject.subject', '=', 'tb_subject.id')
            ->select('assign_subject.*', 'tb_subject.subject_name', 'tb_subject.id', 'tb_subject.subject_code')
            //->where('assign_subject.batch',$batch)
            ->where('assign_subject.course',$course)
            ->where('assign_subject.branch_id',Auth::user()->school_id)
            ->get(); */
            $sid= Auth::user()->school_id;
            $sql="SELECT `assign_subject`.*,c.emp_id,CONCAT_WS(' ',d.fname,d.mname,d.lname) AS emp_name, `tb_subject`.`subject_name`, `tb_subject`.`id`, `tb_subject`.`subject_code`
                  FROM `assign_subject`
                  INNER JOIN `tb_subject` ON `assign_subject`.`subject` = `tb_subject`.`id`
                  LEFT JOIN subject_allocation c ON assign_subject.subject=c.subject AND assign_subject.course=c.course
                  left JOIN emp_details d ON c.emp_id=d.empcode
                  WHERE  `assign_subject`.`course` = '$course' AND `assign_subject`.`branch_id` = '$sid'
                  GROUP BY assign_subject.subject";
              $classsubject=DB::select($sql);
          //  print_r($classsubject);
          //  exit;
      $classteacher= DB::table('class_teacher_allocation')
                  ->join('emp_details', 'class_teacher_allocation.teacher_id', '=', 'emp_details.empcode')
                  ->join('emp_contact', 'emp_details.empcode', '=', 'emp_contact.emp_id')
                  ->select('class_teacher_allocation.*', 'emp_details.fname', 'emp_details.mname', 'emp_details.mname', 'emp_details.lname', 'emp_details.lname', 'emp_contact.phone')
                  ->where('class_teacher_allocation.batch',$batch)
                  ->where('class_teacher_allocation.course',$course)
                  ->where('class_teacher_allocation.accadmicyear',app_config('Session',Auth::user()->school_id))
                  ->where('class_teacher_allocation.branch_code',Auth::user()->school_id)
                  ->get();
                  $lastfeereceipt=DB::table('fee_collection')
                  ->where('stu_reg_no',$id)->where('acadmic_year',app_config('Session',Auth::user()->school_id))
                  ->where('branch_code',Auth::user()->school_id)->latest()->first();
                  if($lastfeereceipt !=null){
                $receipt_no=$lastfeereceipt->receipt_no;
              }else{
                  $receipt_no="0";
              }

      $lastfeepaid=DB::table('fee_collection')->select(DB::raw('sum(amt) as totalfee,month,year,pay_mode,created_date'))
      ->where('receipt_no',$receipt_no)->where('acadmic_year',app_config('Session',Auth::user()->school_id))
      ->where('branch_code',Auth::user()->school_id)->get();
 $currentmonth= date('F');
  $currntdate=date('d');
  $total_days=cal_days_in_month(CAL_GREGORIAN, date('m'), date('y'));
$attendance=DB::table('stu_attendance')->where('reg_no',Auth::user()->username)->where('month',$currentmonth)->where('accadmicyear',app_config('Session',Auth::user()->school_id))->where('status','P')->count();
$absentdays=$currntdate-$attendance;

       return view('stu_panel.main-welcome',compact('wards','classsubject','classteacher','lastfeepaid','attendance','absentdays'));
     }

public function announcement(Request $request)
{
  $notification=DB::table('parent_announcement')
  ->where('register_no','=','no')
  ->orderby('id','desc')
  ->get();
  $msg=DB::table('parent_announcement')
  ->where('register_no','=',Auth::user()->username)
  ->orderby('id','desc')
  ->get();
  return view('stu_panel.announcement',compact('notification','msg'));
}
public function attendancereport(){



  return view('stu_panel.attendance-report');
}

public function show_att_report(Request $request)
{
    $accadmicyear=$request->accadmicyear;
    $date=$request->date;
  $attendance=DB::table('stu_attendance')
            ->where('stu_attendance.reg_no',Auth::user()->username)
            ->where('accadmicyear',$accadmicyear)
            ->where('att_date',$date)
            ->get();

            echo $attendance;
}

public function homework(Request $request)
{
  $data=DB::table('stu_admission')
         ->where('stu_admission.reg_no',Auth::user()->username)
         ->get();
         foreach($data as $d)
         {
           $c=$d->course;
           $b=$d->batch;
         }
       $academic_year= app_config('Session',Auth::user()->school_id);
       $HomeWork=DB::table('homework')
       ->join('tb_course','homework.course','tb_course.id')
       ->join('tb_batch','homework.batch','tb_batch.id')
       ->join('tb_subject','homework.subject','tb_subject.id')
       ->Leftjoin('evaluate_homework', function ($join) {
            $join->on('homework.id', '=', 'evaluate_homework.homework_id')
                 ->where('evaluate_homework.student',Auth::user()->username);
        })
       ->select('homework.*','evaluate_homework.status','tb_subject.subject_name','tb_course.course_name','tb_batch.batch_name')
       ->where('homework.course',$c)
       ->where('homework.batch',$b)
       ->where('homework.academic_year',$academic_year)
       ->orderby('homework.id','desc')
       ->get();
  return view('stu_panel.homework',compact('HomeWork'));
}

public function homework_report(Request $request)
{
  $date=$request->date;

   $data=DB::table('stu_admission')
          ->where('stu_admission.reg_no',Auth::user()->username)
          ->get();
          foreach($data as $d)
          {
            $c=$d->course;
            $b=$d->batch;
          }
        $home=DB::table('homework')
        ->join('tb_course','homework.course','tb_course.id')
        ->join('tb_batch','homework.batch','tb_batch.id')
        ->join('tb_subject','homework.subject','tb_subject.id')
        ->select('homework.*','tb_subject.subject_name','tb_course.course_name','tb_batch.batch_name')
        ->where('homework.course',$c)
        ->where('homework.batch',$b)
        ->where('homework.homework_date',$date)
        ->get();
        echo $home;

}

    function upload_homework(Request $request){
        $discription=Input::get('description');
        $id=Input::get('id');
        $homeWork_id=Crypt::encrypt(Input::get('id'));
        $ans_id=Input::get('ans_id');

        $file_name = $_FILES['file']['name'];
        $file_size =$_FILES['file']['size'];
        $file_tmp =$_FILES['file']['tmp_name'];
        $file_type=$_FILES['file']['type'];
      if($file_name=="" && $discription=="")
      {
        return redirect('student/homework/submit/'.$homeWork_id)->with([
             'message' => 'Please Submit either answer file or Write You Answer.',
             'message_important'=>true
         ]);
      }
      if($file_name!=""){  //."_".Auth::user()->username."_".date('d-m-Y h:i:sa')
        if(move_uploaded_file($file_tmp,"assets/uploads/homework/".$file_name)){
          $ans_path="assets/uploads/homework/".$file_name;
              if($ans_id =="" || $ans_id==null){
                $ansarray=array(
                  "student"=>Auth::user()->username,
                  "homework_id"=>$id,
                  "answer"=>$discription,
                  "ans_file"=>$ans_path,
                  "status"=>'1',
                );
                DB::table('evaluate_homework')->insert($ansarray);
              }else{
                $ansupdatearray=array(
                  "student"=>Auth::user()->username,
                  "homework_id"=>$id,
                  "answer"=>$discription,
                  "ans_file"=>$ans_path,
                  "status"=>'1',
                );
                DB::table('evaluate_homework')->where('id',$ans_id)->update($ansupdatearray);
              }
              return redirect('student/homework/submit/'.$homeWork_id)->with([
                   'message' => 'Your Answer Submited Succesfully.'
               ]);
        }else{
          return redirect('student/homework/submit/'.$homeWork_id)->with([
               'message' => 'Unable to Upload Your Answer File.Please try Again.',
               'message_important'=>true
           ]);
        }
      }else{
        $ans_path=null;
        if($ans_id =="" || $ans_id == null){
          $ansarray=array(
            "student"=>Auth::user()->username,
            "homework_id"=>$id,
            "answer"=>$discription,
            "ans_file"=>$ans_path,
            "status"=>'1',
          );
          DB::table('evaluate_homework')->insert($ansarray);
        }else{
          $ansupdatearray=array(
            "student"=>Auth::user()->username,
            "homework_id"=>$id,
            "answer"=>$discription,
            "ans_file"=>$ans_path,
            "status"=>'1',
          );
          DB::table('evaluate_homework')->where('id',$ans_id)->update($ansupdatearray);
        }
        return redirect('student/homework/submit/'.$homeWork_id)->with([
             'message' => 'Your Answer Submited Succesfully.'
         ]);
      }
    }
    public function homework_submit($id)
    {
      $id= Crypt::decrypt($id);
      $academic_year= app_config('Session',Auth::user()->school_id);
      $HomeWork=DB::table('homework')
       ->join('tb_course','homework.course','tb_course.id')
       ->join('tb_batch','homework.batch','tb_batch.id')
       ->join('tb_subject','homework.subject','tb_subject.id')
       ->Leftjoin('evaluate_homework', function ($join) {
            $join->on('homework.id', '=', 'evaluate_homework.homework_id')
                 ->where('evaluate_homework.student',Auth::user()->username);
        })
       ->select('homework.*','evaluate_homework.answer','evaluate_homework.ans_file as ans_file','evaluate_homework.id as ans_id','tb_subject.subject_name','tb_course.course_name','tb_batch.batch_name')
       ->where('homework.id',$id)
       ->where('homework.academic_year',$academic_year)
       ->get();
      // print_r($HomeWork);exit;

      return view('stu_panel.homework_submit',compact('HomeWork'));
    }

  public function view_homework(Request $request)
    {
      echo $idd=$request->id;
      $data=DB::table('homework')
      ->join('tb_course','homework.course','=','tb_course.id')
      ->join('tb_batch','homework.batch','=','tb_batch.id')
      ->where('homework.branch_code',Auth::user()->school_id)
      ->where('homework.id',1)
      ->get();
      echo $data;
    }

    public function exam_hall_arrangement(Request $request)
    {
      $exam=DB::table('tb_exam')
      ->get();
      return view('stu_panel.exam_hall_arrangement',compact('exam'));
    }

    public function view_exam_hall_arrangement(Request $request)
    {
      $reg_no=DB::table('stu_contact')
   ->where('stu_contact.father_phone',Auth::user()->username)
   ->get();
   foreach($reg_no as $r)
   {
    $r_no=$r->reg_no;
   }
    $r_no;
   $data=DB::table('stu_admission')
          ->where('stu_admission.reg_no',Auth::user()->username)
          ->get();
          foreach($data as $d)
          {
             $c=$d->course;
             $b=$d->batch;
          }

       $exam=$request->exam;
       $ex=DB::table('exam_schedule')
        ->join('tb_exam','exam_schedule.exam','=','tb_exam.id')
        ->join('tb_course','exam_schedule.course','=','tb_course.id')
        ->join('tb_batch','exam_schedule.batch','=','tb_batch.id')
        ->where('exam_schedule.branch_code',Auth::user()->school_id)
        ->where('exam_schedule.exam',$exam)
        ->where('exam_schedule.course',$c)
        ->where('exam_schedule.batch',$b)
        ->get();
       echo $ex;
    }

    public function daily_timetable(Request $request)
    {
       $data=DB::table('stu_admission')
          ->where('stu_admission.reg_no',Auth::user()->username)
          ->get();
          foreach($data as $d)
          {
             $c=$d->course;
             $b=$d->batch;
          }
          $prd=DB::table('tb_period')
          ->join('cls_time_table','tb_period.id','=','cls_time_table.period')
          ->groupBy('cls_time_table.period')

          ->where('cls_time_table.branch_code',Auth::user()->school_id)
          ->where('cls_time_table.batch','=',$b)
          ->where('cls_time_table.course','=',$c)
          ->get();

          $result=array();
          $rel=array();
          foreach($prd as $p)
          {
            // $t=DB::table('subject_allocation')
            // ->join('emp_details','subject_allocation.emp_id','=','emp_details.id')
            // ->where('subject_allocation.course','=',$cid)
            // ->where('subject_allocation.batch','=',$bid)
            // ->where('subject_allocation.branch_code',Auth::user()->school_id)
            // ->get();

            $subs=DB::table('cls_time_table')
            ->join('tb_subject','cls_time_table.subject','=','tb_subject.id')

           ->where('cls_time_table.branch_code',Auth::user()->school_id)
          ->where('cls_time_table.batch','=',$b)
          ->where('cls_time_table.course','=',$c)

          ->where('cls_time_table.period','=',$p->period)
          ->get();

          foreach($subs as $ss)
          {
            $teachers = DB::table('subject_allocation')
              ->join('emp_details','emp_details.id','=','subject_allocation.emp_id')
              ->where('subject','=',$ss->subject)
              ->where('course','=',$ss->course)
              ->where('batch','=',$ss->batch)
              ->get();
            $t_name="";
            foreach($teachers as $t)
            {
             $t_name= $t->fname ." "  .$t->mname ." " .$t->lname;
            }
            array_push($result,array('period'=>$ss->period,'subject_name'=>$ss->subject_name,'room'=>$ss->room_no,'day'=>$ss->day,'','t_name'=>$t_name));
          }
       }
       echo"<pre>";
       print_r($prd);
       exit;
       json_encode($result);

          return view('stu_panel.timetable',compact('prd','result'));

    }

    public function lesson_plane(Request $request)
    {
      $data=DB::table('stu_admission')
         ->where('stu_admission.reg_no',Auth::user()->username)
         ->get();
         foreach($data as $d)
         {
             $c=$d->course;
             $b=$d->batch;
         }
  /*    $lesson=DB::table('tb_lession_planning')
      ->join('tb_lession_topic','tb_lession_planning.id','=','tb_lession_topic.tb_plan_id')
      ->join('tb_subject','tb_lession_planning.subject_id','=','tb_subject.id')
      ->where('tb_lession_planning.class','=',$c)
      ->where('tb_lession_planning.section','=',$b)
      ->where('tb_lession_planning.branch_code',Auth::user()->school_id)
      ->where('tb_lession_planning.session',app_config('Session',Auth::user()->school_id))
      ->get();*/
      $accadmicyear=app_config('Session',Auth::user()->school_id);
      $branchcode=Auth::user()->school_id;
      $sql="SELECT a.id,a.class,a.section,a.subject_id,a.status,a.created_by,
            GROUP_CONCAT(CONCAT_WS('|',b.topic,b.objective,b.hours_class,b.from_date,b.to_date,b.t_status,b.teaching_methods)) AS topics,c.subject_name
            ,CONCAT_WS(' ',d.fname,d.mname,d.lname) AS teacher FROM tb_lession_planning a
            INNER JOIN tb_lession_topic b ON a.id=b.tb_plan_id
            INNER JOIN tb_subject c ON a.subject_id=c.id
            INNER JOIN emp_details d ON a.created_by=d.empcode
            WHERE a.class='$c' AND a.section='$b' AND a.session='$accadmicyear' AND a.branch_code='$branchcode'
            GROUP BY a.subject_id";
      $lesson=DB::select($sql);
      return view('stu_panel.lesson_planing',compact('lesson'));
    }

public function leaveapply(){

  $leavelist=DB::table('stu_leave_application')->where('reg_no',Auth::user()->username)
  ->where('acadmic_year',app_config('Session',Auth::user()->school_id))
  ->where('branch_code',Auth::user()->school_id)
  ->get();

  return view('stu_panel.leave-application',compact('leavelist'));
}
public function applyleave(Request $request){
  $this->validate($request, [
    'todate'=>'required',
    'fromdate'=>'required',
    'reason'=>'required',
    ]);
   $todate=Input::get('todate');
   $fromdate=Input::get('fromdate');
   $reason=Input::get('reason');

   try{
   $savedata=DB::table('stu_leave_application')->insert(['reg_no'=>Auth::user()->username, 'fromdate' =>$fromdate,'todate'=>$todate,'reason'=>$reason,'acadmic_year'=>app_config('Session',Auth::user()->school_id),'branch_code'=>Auth::user()->school_id]);

   if(!empty($savedata)){
     return redirect('parents/ward/leave/apply')->with([
          'message' => 'Leave Applyed Successfully.'
      ]);
   }else{
     return redirect('parents/ward/leave/apply')->with([
          'message' => 'Unable to Apply Leave.Please Try Again.'
      ]);
   }

   }catch(\Illuminate\Database\QueryException $ex){
     return redirect('parents/ward/leave/apply')->with([
          'message' => 'Someting Went Worng Please Contact Technical Team : '.$ex->getMessage(). '',
          'message_important'=>true
      ]);

  }

}

public function viewleave($id){
  $viewleave=DB::table('stu_leave_application')->where('id',$id)->get();
  foreach ($viewleave as $viewleave) {
    $fromdate=$viewleave->fromdate;
    $todate=$viewleave->todate;
    $reason=$viewleave->reason;
  }
  return view('stu_panel.view-leave',compact('fromdate','todate','reason'));
}
public function updateleave(Request $request){
  $this->validate($request, [
    'todate'=>'required',
    'fromdate'=>'required',
    'reason'=>'required',
    ]);
   $todate=Input::get('todate');
   $fromdate=Input::get('fromdate');
   $reason=Input::get('reason');

   try{
   $savedata=DB::table('stu_leave_application')->where('reg_no',Auth::user()->username)->update(['reg_no'=>Auth::user()->username, 'fromdate' =>$fromdate,'todate'=>$todate,'reason'=>$reason,'acadmic_year'=>app_config('Session',Auth::user()->school_id),'branch_code'=>Auth::user()->school_id]);

   if(!empty($savedata)){
     return redirect('parents/ward/leave/apply')->with([
          'message' => 'Leave Updated Successfully.'
      ]);
   }else{
     return redirect('parents/ward/leave/apply')->with([
          'message' => 'Unable to Apply Update.Please Try Again.'
      ]);
   }

   }catch(\Illuminate\Database\QueryException $ex){
     return redirect('parents/ward/leave/apply')->with([
          'message' => 'Someting Went Worng Please Contact Technical Team : '.$ex->getMessage(). '',
          'message_important'=>true
      ]);
  }
}

  public function feedback(){
  //  echo Auth::user()->username;
  $list=DB::table('feedback')->where('parent_no',Auth::user()->username)->where('branch_code',Auth::user()->school_id)->get();
    return view('stu_panel.feedback',compact('list'));
  }
public function submitfeedback(Request $request){
  $this->validate($request, [
    'subject'=>'required',
    'reason'=>'required'
    ]);
   $subject=Input::get('subject');
   $reason=Input::get('reason');

   try{
   $savedata=DB::table('feedback')->insert(['subject'=>$subject, 'parent_no'=>Auth::user()->username,'name'=>Auth::user()->name,'msg'=>$reason,'branch_code'=>Auth::user()->school_id]);

   if(!empty($savedata)){
     return redirect('parents/ward/feedback')->with([
          'message' => 'Your Complaint/Feedback Submited Successfully.'
      ]);
   }else{
     return redirect('parents/ward/feedback')->with([
          'message' => 'Unable to Your Complaint/Feedback.Please Try Again.'
      ]);
   }

   }catch(\Illuminate\Database\QueryException $ex){
     return redirect('parents/ward/feedback')->with([
          'message' => 'Someting Went Worng Please Contact Technical Team : '.$ex->getMessage(). '',
          'message_important'=>true
      ]);
  }

}
public function viewfeedback($id){
$feeback=DB::table('feedback')->where('id',$id)->get();
  foreach ($feeback as $feeback) {
    // code...
    $subject=$feeback->subject;
    $msg=$feeback->msg;
    $created_at=$feeback->created_at;
    $status=$feeback->status;
    $id=$feeback->id;
  }
  $feedback_comments=DB::table('feedback_comments')->where('feedback_id',$id)->get();
  return view('stu_panel.view-feedback',compact('id','subject','msg','created_at','status','feedback_comments'));
}
public function submitfeedbackcomments(Request $request){
  $this->validate($request, [
    'id'=>'required',
    'user'=>'required',
    'reason'=>'required'
    ]);
   $id=Input::get('id');
   $user=Input::get('user');
   $reason=Input::get('reason');

   try{
   $savedata=DB::table('feedback_comments')->insert(['feedback_id'=>$id, 'msg'=>$reason,'user'=>Auth::user()->name]);

   if(!empty($savedata)){
     return redirect('parents/ward/feedback/view/'.$id)->with([
          'message' => 'Your Complaint/Feedback Submited Successfully.'
      ]);
   }else{
     return redirect('parents/ward/feedback/view/'.$id)->with([
          'message' => 'Unable to Your Complaint/Feedback.Please Try Again.'
      ]);
   }

   }catch(\Illuminate\Database\QueryException $ex){
     return redirect('parents/ward/feedback/view/'.$id)->with([
          'message' => 'Someting Went Worng Please Contact Technical Team : '.$ex->getMessage(). '',
          'message_important'=>true
      ]);
  }
}

public function closefeedbackcomments($id){
  try{
  $savedata=DB::table('feedback')->where('id',$id)->update(['status'=>'1']);

  if(!empty($savedata)){
    return redirect('parents/ward/feedback')->with([
         'message' => 'Your Complaint/Feedback Ticket is closed Successfully.'
     ]);
  }else{
    return redirect('parents/ward/feedback')->with([
         'message' => 'Unable to close Complaint/Feedback Ticket.Please Try Again.'
     ]);
  }

  }catch(\Illuminate\Database\QueryException $ex){
    return redirect('parents/ward/feedback')->with([
         'message' => 'Someting Went Worng Please Contact Technical Team : '.$ex->getMessage(). '',
         'message_important'=>true
     ]);
 }
}



}
