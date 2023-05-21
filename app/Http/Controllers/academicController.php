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
class academicController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }
 
	// online Classes start


public function onlineClassesCreate(Request $request){
  
  $this->validate($request, [
      'addacadmicyear'=>'required',
      'course'=>'required',
      'batch'=>'required',
      'subject'=>'required',
      'cdate'=>'required',
      'ctime'=>'required',
      'url'=>'required'
    ]);

    $data=array(
      "session"=> Input::get('addacadmicyear'),
      "class"=> Input::get('course'),
      "section"=> Input::get('batch'),
      "subject"=> Input::get('subject'),
      "date"=> Input::get('cdate'),
      "time"=> Input::get('ctime'),
      "url"=> Input::get('url'),
      "discription"=> Input::get('discription'),
      "created_by"=> Auth::user()->username,
    );
  $save=DB::table('online_class_schedule')->insertGetId($data);
  if($save){
    sendNotification(Auth::user()->username,null,1,"Online Class Schedule","Online Class Schedule",false,false,Input::get('course'),Input::get('batch'));
    return redirect('online/classes')->with([
        'message' => 'Online Class Scheduled Succesfully.',

    ]);
  }else{
    return redirect('online/classes')->with([
        'message' => 'Someting Went Worng.Please try again.',
        'message_important'=>true
    ]);
  }
}

public function CancelonlineClasses($id){
  DB::table('online_class_schedule')->where('id',$id)->update(['status'=>0,'cancel_by'=>Auth::user()->username]);
  return redirect('online/classes')->with([
      'message' => 'Online Class Cancel Succesfully.',

  ]);
}
public function onlineClasses(){
  $semester=DB::table('tb_semester')->where('branch_code',Auth::user()->school_id)->orderBy('semester_name','asc')->get();
  $course=DB::table('tb_course')->where('branch_code',Auth::user()->school_id)->orderBy('id','asc')->get();
  $subject=DB::table('tb_subject')->where('branch_code',Auth::user()->school_id)->get();
  $Acadmicyear= DB::table('academicyear')->where('branch_code',Auth::user()->school_id)->get();
  $Acadmic_year=$Acadmicyear;
  $courses=$course;
  if(Auth::user()->user_role==1){
    $onlineClasses=DB::table('online_class_schedule')
    ->join('tb_subject','tb_subject.id','online_class_schedule.subject')
    ->join('users','users.emp_code','online_class_schedule.created_by')
    ->select('online_class_schedule.*','users.name','tb_subject.subject_name')
  //  ->where('online_class_schedule.created_by',Auth::user()->username)
    ->where('online_class_schedule.session',app_config('Session',Auth::user()->school_id))
    ->orderBy('online_class_schedule.id','desc')
    ->get();
  }else{
  $onlineClasses=DB::table('online_class_schedule')
  ->join('tb_subject','tb_subject.id','online_class_schedule.subject')
  ->join('users','users.emp_code','online_class_schedule.created_by')
  ->select('online_class_schedule.*','users.name','tb_subject.subject_name')
  ->where('online_class_schedule.created_by',Auth::user()->username)
  ->where('online_class_schedule.session',app_config('Session',Auth::user()->school_id))
  ->orderBy('online_class_schedule.id','desc')
  ->get();
}
  return view('acadmic.onlineClasses.onlineClasses',compact('courses','onlineClasses','Acadmic_year','Acadmicyear','course','subject','semester'));
}

// online classess end

	
	public function course(){
    $self='add-course';
    if (\Auth::user()->user_role!=='1'){
        $get_perm=permission::permitted($self);

        if ($get_perm=='access denied'){
            return redirect('permission-error')->with([
                'message' => 'You do not have permission to view this page.',
                'message_important'=>true
            ]);
        }
    }
    $courses=DB::table('tb_course')->where('branch_code',Auth::user()->school_id)->orderBy('id','desc')->get();

     return view('acadmic.course.add-course',compact('courses'));
  }
  public function addcourse(request $request){
    $this->validate($request, [
        'coursename'=>'required',
        'description'=>'required',
        'code'=>'required',
        'map'=>'required',
        'atttype'=>'required',
        'twd'=>'required',
        'gt'=>'required',
       // 'tns'=>'required'
      ]);
    $coursename = Input::get('coursename');
    $description = Input::get('description');
    $code = Input::get('code');
    $map = Input::get('map');
    $atttype = Input::get('atttype');
    $twd = Input::get('twd');
    $gt = Input::get('gt');
   // $tns=Input::get('tns');
    $precedence=Input::get('precedence');
    $created_date = date('d-m-Y H:i:s');
    DB::table('tb_course')->insert(['course_name'=>$coursename,'description'=>$description,'code'=>$code,'min_atten_percent'=>$map,'attendancetype'=>$atttype,'tot_work_day'=>$twd,'syllabus_name'=>$gt,"precedence"=>$precedence,'created_date'=>$created_date,'branch_code'=>Auth::user()->school_id]);
           return redirect('add-course')->with([
                'message' => 'New Course Added Successfully.'
            ]);
  }

  public function addbatch(){
    $self='add-batch';
    if (\Auth::user()->user_role!=='1'){
        $get_perm=permission::permitted($self);

        if ($get_perm=='access denied'){
            return redirect('permission-error')->with([
                'message' => 'You do not have permission to view this page.',
                'message_important'=>true
            ]);
        }
    }
      $courses=DB::table('tb_course')->where('branch_code',Auth::user()->school_id)->orderBy('id','desc')->get();

        $batch = DB::table('tb_batch')
            ->join('tb_course', 'tb_batch.course', '=', 'tb_course.id')
            ->select('tb_batch.*', 'tb_course.course_name')
            ->where('tb_batch.branch_code',Auth::user()->school_id)
            ->orderBy('tb_batch.id','desc')
            ->get();
     return view('acadmic.course.add-batch',compact('courses','batch'));
  }
 public function newbatch(request $request){
   $this->validate($request, [
       'course'=>'required',
       'batchname'=>'required',
       'startdate'=>'required',
       'enddate'=>'required',
       'maxstu'=>'required'
     ]);
   $coursename = Input::get('course');
   $batchname = Input::get('batchname');
   $startdate = Input::get('startdate');
   $enddate = Input::get('enddate');
   $maxstu = Input::get('maxstu');
   $created_date = date('d-m-Y H:i:s');
   DB::table('tb_batch')->insert(['course'=>$coursename,'batch_name'=>$batchname,'start_date'=>$startdate,'end_date'=>$enddate,'max_no_stu'=>$maxstu,'created_date'=>$created_date,'branch_code'=>Auth::user()->school_id]);
          return redirect('add-batch')->with([
               'message' => 'New Batch Added Successfully.'
           ]);
 }
 public function viewcourse(Request $request,$id)
 {
// echo $id;
   if($id!=null)
   {
         $viewcourse=DB::table('tb_course')->where('id','=',$id)->get();

        return view('acadmic.course.view-course',compact('viewcourse'));// ['active_parners' => $activepartner]);

   } else
//$activepartner=DB::table('active_parners')->get();
 return redirect('Academic-Details')->with([
         'message' => "Academic-Details Info Not Found",
         'message_important' => true
     ]);
 }
 public function updatecourse(Request $request){
   $this->validate($request, [
        'id'=>'required',
       'coursename'=>'required',
       'description'=>'required',
       'code'=>'required',
       'map'=>'required',
       'atttype'=>'required',
       'twd'=>'required',
       'gt'=>'required'
     ]);
   $id = Input::get('id');
   $coursename = Input::get('coursename');
   $description = Input::get('description');
   $code = Input::get('code');
   $map = Input::get('map');
   $atttype = Input::get('atttype');
   $twd = Input::get('twd');
   $gt = Input::get('gt');
   $precedence=Input::get('precedence');
   $created_date = date('d-m-Y H:i:s');
   DB::table('tb_course')->where('branch_code',Auth::user()->school_id)->where('id','=',$id)->update(['course_name'=>$coursename,'description'=>$description,'code'=>$code,'min_atten_percent'=>$map,'attendancetype'=>$atttype,'tot_work_day'=>$twd,'syllabus_name'=>$gt,"precedence"=>$precedence,'created_date'=>$created_date,'branch_code'=>Auth::user()->school_id]);
          return redirect('add-course')->with([
               'message' => 'Course Updated Successfully.'
           ]);
 }
 public function deletecourse(Request $request,$id){
 if($id!=null){
    DB::table('tb_course')->where('id','=',$id)->where('branch_code',Auth::user()->school_id)->delete();
     return redirect('add-course')->with([
         'message' => "Course Deleted Successfully"
     ]);
 }else{
     return redirect('add-course')->with([
         'message' => "Course Details Not Found",
         'message_important' => true
     ]);
 }
 }
 public function viewbatch(Request $request,$id){
       if($id!=null)
       {
        $courses=DB::table('tb_course')->where('branch_code',Auth::user()->school_id)->orderBy('id','desc')->get();
        $batch = DB::table('tb_batch')
        ->join('tb_course', 'tb_batch.course', '=', 'tb_course.id')
        ->select('tb_batch.*', 'tb_course.id')
        ->where('tb_batch.branch_code',Auth::user()->school_id)
        ->where('tb_batch.id',$id)
        ->get();
          return view('acadmic.course.view-batch',compact('batch','courses'));// ['active_parners' => $activepartner]);

      } else
  //$activepartner=DB::table('active_parners')->get();
   return redirect('acadmic.course.add-batch')->with([
           'message' => "Batch Info Not Found",
           'message_important' => true
       ]);
 }

 public function updatebatch(Request $request)
 {
   // code...
   $this->validate($request, [
       'course'=>'required',
       'batchname'=>'required',
       'startdate'=>'required',
       'enddate'=>'required',
       'maxstu'=>'required'
     ]);
   $id = Input::get('id');
   $coursename = Input::get('course');
   $batchname = Input::get('batchname');
   $startdate = Input::get('startdate');
   $enddate = Input::get('enddate');
   $maxstu = Input::get('maxstu');
   $created_date = date('d-m-Y H:i:s');
   DB::table('tb_batch')->where('branch_code',Auth::user()->school_id)->where('id',$id)->update(['course'=>$coursename,'batch_name'=>$batchname,'start_date'=>$startdate,'end_date'=>$enddate,'max_no_stu'=>$maxstu,'created_date'=>$created_date,'branch_code'=>Auth::user()->school_id]);
          return redirect('add-batch')->with([
               'message' => 'Batch Updated Successfully.'
           ]);
 }
public function deletebatch(Request $request,$id){
  if($id!=null){
     DB::table('tb_batch')->where('id','=',$id)->where('branch_code',Auth::user()->school_id)->delete();
      return redirect('add-batch')->with([
          'message' => "Batch Deleted Successfully"
      ]);
  }else{
      return redirect('add-batch')->with([
          'message' => "Batch Details Not Found",
          'message_important' => true
      ]);
  }
}
  public function classTeacherAllocation(){
    $self='classTeacher-Allocation';
    if (\Auth::user()->user_role!=='1'){
        $get_perm=permission::permitted($self);

        if ($get_perm=='access denied'){
            return redirect('permission-error')->with([
                'message' => 'You do not have permission to view this page.',
                'message_important'=>true
            ]);
        }
    }

  $course= DB::table('tb_course')->where('branch_code',Auth::user()->school_id)->get();
  $teachers= DB::table('emp_details')->where('user_type','6')
	 ->where('branch_code',Auth::user()->school_id)->get();
  $Acadmicyear= DB::table('academicyear')->where('branch_code',Auth::user()->school_id)->get();
  $allocatedTeachers = DB::table('class_teacher_allocation')
            ->join('emp_details', 'class_teacher_allocation.teacher_id', '=', 'emp_details.empcode')
            ->join('tb_batch', 'class_teacher_allocation.batch', '=', 'tb_batch.id')
            ->join('tb_course', 'class_teacher_allocation.course', '=', 'tb_course.id')
            ->select('class_teacher_allocation.*','emp_details.fname','emp_details.mname','emp_details.lname','emp_details.empcode', 'tb_course.course_name', 'tb_batch.batch_name')
            ->where('class_teacher_allocation.branch_code',Auth::user()->school_id)
            ->get();
    return view('acadmic.course.classTeacher-Allocation',compact('course','teachers','Acadmicyear','allocatedTeachers'));
  }

  public function deleteclassTeacher(Request $request,$id){
    if($id!=null){
       DB::table('class_teacher_allocation')->where('id','=',$id)->where('branch_code',Auth::user()->school_id)->delete();
        return redirect('classTeacher-Allocation')->with([
            'message' => "Allocated Class Teacher Deleted Successfully"
        ]);
    }else{
        return redirect('classTeacher-Allocation')->with([
            'message' => "Allocated Class Teacher Details Not Found",
            'message_important' => true
        ]);
    }
  }
  public function addsubject(request $request){
    $self='classTeacher-Allocation';
    if (\Auth::user()->user_role!=='1'){
        $get_perm=permission::permitted($self);

        if ($get_perm=='access denied'){
            return redirect('permission-error')->with([
                'message' => 'You do not have permission to view this page.',
                'message_important'=>true
            ]);
        }
    }
    $this->validate($request, [
        'subject_name'=>'required|string|max:255|unique:tb_subject',
        'subject_code'=>'required|string|max:255|unique:tb_subject',
        'elective'=>'required',
      ]);
      $subjectname = Input::get('subject_name');
      $subjectcode = Input::get('subject_code');
      $elective = Input::get('elective');
      $description = Input::get('description');
      $created_date = date('d-m-Y H:i:s');
      DB::table('tb_subject')->insert(['branch_code'=>Auth::user()->school_id,'subject_name'=>$subjectname,'subject_code'=>$subjectcode,'elective'=>$elective,'discripton'=>$description,'created_date'=>$created_date]);
             return redirect('subject/create')->with([
                  'message' => 'New Subject Added Successfully.'
              ]);
  }
  public function allocateclassTeacher(Request $request){
    $self='classTeacher-Allocation';
    if (\Auth::user()->user_role!=='1'){
        $get_perm=permission::permitted($self);

        if ($get_perm=='access denied'){
            return redirect('permission-error')->with([
                'message' => 'You do not have permission to view this page.',
                'message_important'=>true
            ]);
        }
    }
    $this->validate($request, [
        'course'=>'required',
        'batch'=>'required',
        'addacadmicyear'=>'required',
        'classteacher'=>'required',
      ]);
      $course=input::get('course');
      $batch=input::get('batch');
      $addacadmicyear=input::get('addacadmicyear');
      $classteacher=input::get('classteacher');
      $created_date = date('d-m-Y');
      $cnt=DB::table('class_teacher_allocation')->where('course',$course)
          ->where('batch',$batch)->where('accadmicyear',$addacadmicyear)->count();

  // echo $cnt; exit;
          if($cnt==0){
            DB::table('class_teacher_allocation')->insert(['teacher_id'=>$classteacher,'course'=>$course,'batch'=>$batch,'accadmicyear'=>$addacadmicyear,'branch_code'=>Auth::user()->school_id,'created_date'=>$created_date]);
            return redirect('classTeacher-Allocation')->with([
              'message' => 'Class Teacher Allocated Successfully.'
          ]);
            }else{
              DB::table('class_teacher_allocation')->where('course',$course)
              ->where('batch',$batch)->where('accadmicyear',$addacadmicyear)
              ->update(['teacher_id'=>$classteacher,'branch_code'=>Auth::user()->school_id,'created_date'=>$created_date]);

              return redirect('classTeacher-Allocation')->with([
                'message' => 'Class Teacher Allocation Updated Successfully.'
            ]);
          }

        /*  }else{
            return redirect('classTeacher-Allocation')->with([
                 'message' => 'Class Teacher Allocated Already Please Try Another Teacher.',
                 'message_important'=>true
             ]);
          }*/



  }
  public function deletesubject(Request $request,$id){
    if($id!=null){
       DB::table('tb_subject')->where('id','=',$id)->where('branch_code',Auth::user()->school_id)->delete();
        return redirect('subject/create')->with([
            'message' => "Subject Deleted Successfully"
        ]);
    }else{
        return redirect('subject/create')->with([
            'message' => "Subject Details Not Found",
            'message_important' => true
        ]);
    }
  }
  public function createsubject(){
    $self='subject/create';
    if (\Auth::user()->user_role!=='1'){
        $get_perm=permission::permitted($self);

        if ($get_perm=='access denied'){
            return redirect('permission-error')->with([
                'message' => 'You do not have permission to view this page',
                'message_important'=>true
            ]);
        }
    }
      $subject=DB::table('tb_subject')->where('branch_code',Auth::user()->school_id)->orderBy('id','desc')->get();
      return view('acadmic.subject.create-subject',compact('subject'));
  }
  public function viewsubject(Request $request,$id){
        if($id!=null)
        {
            $subject=DB::table('tb_subject')->where('branch_code',Auth::user()->school_id)->where('id',$id)->get();
           return view('acadmic.subject.view-subject',compact('subject'));

       } else
   //$activepartner=DB::table('active_parners')->get();
    return redirect('acadmic.subject.add-subject')->with([
            'message' => "Subject Info Not Found",
            'message_important' => true
        ]);
  }
  public function updatesubject(Request $request){
    $this->validate($request, [
        'subject_name'=>'required',
        'subject_code'=>'required',
        'elective'=>'required',
      ]);
      $id = Input::get('id');
      $subjectname = Input::get('subject_name');
      $subjectcode = Input::get('subject_code');
      $elective = Input::get('elective');
      $description = Input::get('description');
      $created_date = date('d-m-Y H:i:s');
      DB::table('tb_subject')->where('branch_code',Auth::user()->school_id)->where('id',$id)->update(['branch_code'=>Auth::user()->school_id,'subject_name'=>$subjectname,'subject_code'=>$subjectcode,'elective'=>$elective,'discripton'=>$description,'created_date'=>$created_date]);
             return redirect('subject/create')->with([
                  'message' => 'Subject '.$subjectname. ' Updated Successfully.'
              ]);
  }
  public function assignsubject(){
    $self='subject/assign-subject';
    if (\Auth::user()->user_role!=='1'){
        $get_perm=permission::permitted($self);

        if ($get_perm=='access denied'){
            return redirect('permission-error')->with([
                'message' => 'You do not have permission to view this page.',
                'message_important'=>true
            ]);
        }
    }
    $courses=DB::table('tb_course')->where('branch_code',Auth::user()->school_id)->orderBy('id','asc')->get();
    $subject=DB::table('tb_subject')->where('branch_code',Auth::user()->school_id)->orderBy('id','asc')->get();
    $assignsubjects = DB::table('assign_subject')
          //  ->join('tb_batch', 'assign_subject.batch', '=', 'tb_batch.id')
            ->join('tb_course', 'assign_subject.course', '=', 'tb_course.id')
            ->join('tb_subject', 'assign_subject.subject', '=', 'tb_subject.id')
            ->select('tb_course.*', 'tb_course.course_name', 'tb_subject.*','assign_subject.*')
            ->where('branch_id',Auth::user()->school_id)
            ->get();
//echo $assignsubjects;exit;
    return view('acadmic.subject.assign-subject',compact('courses','subject','assignsubjects'));
  }
  public function addassignsubject(Request $request){
    $this->validate($request, [
        'course'=>'required',
      //  'batch'=>'required',
        'subject'=>'required',
      ]);
      $course = Input::get('course');
      $batch = null;//Input::get('batch');
      $subjectcode = Input::get('subject');
      $created_date = date('d-m-Y H:i:s');
      foreach ($subjectcode as $subjectcode) {
        $subject=$subjectcode;
        DB::table('assign_subject')->insert(['course'=>$course,'batch'=>$batch,'subject'=>$subject,"acadmic_year"=>app_config('Session',Auth::user()->school_id),'branch_id'=>Auth::user()->school_id,'created_date'=>$created_date]);
      }
      return redirect('subject/assign-subject')->with([
           'message' => 'Subject Assigned Added Successfully.'
       ]);

  }
  public function subjectallocation(){
    $self='subject/subject-allocation';
    if (\Auth::user()->user_role!=='1'){
        $get_perm=permission::permitted($self);

        if ($get_perm=='access denied'){
            return redirect('permission-error')->with([
                'message' => 'You do not have permission to view this page.',
                'message_important'=>true
            ]);
        }
    }
    $emp=DB::table('emp_details')->where('branch_code',Auth::user()->school_id)
    ->where('status','1')->where('id','!=',1)
  //  ->where('user_type','6')
    ->orderBy('id','asc')->get();
    $course=DB::table('tb_course')->where('branch_code',Auth::user()->school_id)->orderBy('id','asc')->get();
    $courses=DB::table('tb_course')->where('branch_code',Auth::user()->school_id)->orderBy('id','asc')->get();
    $subject=DB::table('tb_subject')->where('branch_code',Auth::user()->school_id)->get();
    $Acadmicyear= DB::table('academicyear')->where('branch_code',Auth::user()->school_id)->get();

    $subsallocation = DB::table('subject_allocation')
            ->join('emp_details', 'subject_allocation.emp_id', '=', 'emp_details.empcode')
            ->join('tb_course', 'subject_allocation.course', '=', 'tb_course.id')
            ->join('tb_batch', 'subject_allocation.batch', '=', 'tb_batch.id')
            ->join('tb_subject', 'subject_allocation.subject', '=', 'tb_subject.id')
            ->select('subject_allocation.*', 'emp_details.fname','emp_details.mname', 'emp_details.lname','emp_details.empcode','tb_subject.subject_name', 'tb_subject.subject_code','tb_batch.batch_name', 'tb_course.course_name')
            ->where('subject_allocation.branch_code',Auth::user()->school_id)
            ->get();
          //  print_r($subsallocation); exit;
    return view('acadmic.subject.subject-allocation',compact('emp','course','courses','subject','Acadmicyear','subsallocation'));
  }
	
	public function assignnewsubject(Request $request){
    $self='subject/subject-allocation';
    if (\Auth::user()->user_role!=='1'){
        $get_perm=permission::permitted($self);

        if ($get_perm=='access denied'){
            return redirect('permission-error')->with([
                'message' => 'You do not have permission to view this page.',
                'message_important'=>true
            ]);
        }
    }
    $this->validate($request, [
        'course'=>'required',
        'batch'=>'required',
        'subject'=>'required',
        'addacadmicyear'=>'required',
        'emp_id'=>'required',
      //  'department'=>'required',
      ]);
      $course = Input::get('course');
      $batch = Input::get('batch');
      $subject = Input::get('subject');
      $acadmicyear = Input::get('addacadmicyear');
      $emp_id = Input::get('emp_id');

//    echo  count($subject); exit;
    for($i=0;$i < count($subject);$i++){
      $datawhere=array(
        "course"=>$course,
        "batch"=>$batch,
        "acadmic_year"=>$acadmicyear,
        "subject"=>$subject[$i],
      );
    //  print_r($datawhere);exit;
      $cnt=DB::table('subject_allocation')->where($datawhere)->count();
     // echo $cnt;exit;
      if($cnt=="0"){
      $department=null;//Input::get('department');
      $created_date = date('d-m-Y H:i:s');
      DB::table('subject_allocation')->insert(['department'=>$department,'emp_id'=>$emp_id,'course'=>$course,'batch'=>$batch,"acadmic_year"=>$acadmicyear,'subject'=>$subject[$i],'branch_code'=>Auth::user()->school_id,'created_date'=>$created_date]);

      }else{
        $dataupdate=array(
          "emp_id"=>$emp_id,
          "course"=>$course,
          "batch"=>$batch,
          "acadmic_year"=>$acadmicyear,
          "subject"=>$subject[$i],
        );
        DB::table('subject_allocation')->where($datawhere)->update($dataupdate);
//        return redirect('subject/subject-allocation')->with([
  //        'message' => 'Subject Assigned Updated Successfully.'
  //    ]);
      }
    }
    return redirect('subject/subject-allocation')->with([
         'message' => 'Subject Assigned Successfully.'
     ]);

  }
	
	
	/*
  public function assignnewsubject(Request $request){
    $self='subject/subject-allocation';
    if (\Auth::user()->user_role!=='1'){
        $get_perm=permission::permitted($self);

        if ($get_perm=='access denied'){
            return redirect('permission-error')->with([
                'message' => 'You do not have permission to view this page.',
                'message_important'=>true
            ]);
        }
    }
    $this->validate($request, [
        'course'=>'required',
        'batch'=>'required',
        'subject'=>'required',
        'addacadmicyear'=>'required',
        'emp_id'=>'required',
      //  'department'=>'required',
      ]);
      $course = Input::get('course');
      $batch = Input::get('batch');
      $subject = Input::get('subject');
      $acadmicyear = Input::get('addacadmicyear');
      $emp_id = Input::get('emp_id');
      $datawhere=array(
        "course"=>$course,
        "batch"=>$batch,
        "acadmic_year"=>$acadmicyear,
        "subject"=>$subject,
      );
      $cnt=DB::table('subject_allocation')->where($datawhere)->count();
     // echo $cnt;exit;
      if($cnt=="0"){
      $department=null;//Input::get('department');
      $created_date = date('d-m-Y H:i:s');
      DB::table('subject_allocation')->insert(['department'=>$department,'emp_id'=>$emp_id,'course'=>$course,'batch'=>$batch,"acadmic_year"=>$acadmicyear,'subject'=>$subject,'branch_code'=>Auth::user()->school_id,'created_date'=>$created_date]);

      return redirect('subject/subject-allocation')->with([
           'message' => 'Subject Assigned Successfully.'
       ]);
      }else{
        $dataupdate=array(
          "emp_id"=>$emp_id,
          "course"=>$course,
          "batch"=>$batch,
          "acadmic_year"=>$acadmicyear,
          "subject"=>$subject,
        );
        DB::table('subject_allocation')->where($datawhere)->update($dataupdate);
        return redirect('subject/subject-allocation')->with([
          'message' => 'Subject Assigned Updated Successfully.'
      ]);
      }
  }  */
  function Deleteassignclasssubject($id){
  //  exit;
    if($id){
      DB::table('assign_subject')->where('id',$id)->delete();
      return redirect('subject/assign-subject')->with([
        'message' => 'Assigned Class Subject Deleted Successfully.',
    ]);
    }else{
      return redirect('subject/assign-subject')->with([
        'message' => 'Something went worng.Please try again.',
        'important'=>true
    ]);
    }

  }
function Deleteassignsubject($id){
  if($id){
    DB::table('subject_allocation')->where('id',$id)->delete();
    return redirect('subject/subject-allocation')->with([
      'message' => 'Assigned Subject Deleted Successfully.',
  ]);
  }else{
    return redirect('subject/subject-allocation')->with([
      'message' => 'Something went worng.Please try again.',
      'important'=>true
  ]);
  }

}
  public function assignsubjectpostsearch(Request $request){
    $eid = $request->eid;
    $course = $request->course;
    $subsallocation = DB::table('subject_allocation')
            ->join('emp_details', 'subject_allocation.emp_id', '=', 'emp_details.id')
            ->join('tb_course', 'subject_allocation.course', '=', 'tb_course.id')
            ->join('tb_batch', 'subject_allocation.batch', '=', 'tb_batch.id')
            ->join('tb_subject', 'subject_allocation.subject', '=', 'tb_subject.id')
            ->select('subject_allocation.*', 'emp_details.fname','emp_details.mname', 'emp_details.lname','emp_details.empcode','tb_subject.subject_name', 'tb_subject.subject_code','tb_batch.batch_name', 'tb_course.course_name')
            ->where('subject_allocation.branch_code',Auth::user()->school_id)
            ->where('subject_allocation.course',$course)
            ->where('subject_allocation.batch',$eid)
            ->get();
            echo $subsallocation;
  }

  public function emplist(Request $request){
    $eid = $request->eid;
    $batch = DB::table('emp_details')->select('id','fname','mname','lname','empcode')->where('branch_code',Auth::user()->school_id)->where('department',$eid)->orderBy('id','desc')->get();
    //$batch=DB::table('tb_batch')->where('course',$eid)->orderBy('id','desc')->get();
   $cart = array();
    foreach($batch as $batch){
     array_push($cart,$batch);
    }
     echo json_encode($cart);
  }
  public function lessionplanning(){
    $self='subject/lession-planning';
    if (\Auth::user()->user_role!=='1' && !menuAccess(Auth::user()->user_type,'1009')){
        $get_perm=permission::permitted($self);

        if ($get_perm=='access denied'){
            return redirect('permission-error')->with([
                'message' => 'You do not have permission to view this page.',
                'message_important'=>true
            ]);
        }
    }
    $semester=DB::table('tb_semester')->where('branch_code',Auth::user()->school_id)->orderBy('semester_name','asc')->get();
    $course=DB::table('tb_course')->where('branch_code',Auth::user()->school_id)->orderBy('id','asc')->get();
    $subject=DB::table('tb_subject')->where('branch_code',Auth::user()->school_id)->get();
    $Acadmicyear= DB::table('academicyear')->where('branch_code',Auth::user()->school_id)->get();
    $Acadmic_year=$Acadmicyear;
    $courses=$course;
    //echo app_config('Session',Auth::user()->school_id);
    $lessionplaning= DB::table('tb_lession_planning')
            ->join('tb_course', 'tb_lession_planning.class', '=', 'tb_course.id')
            ->join('tb_batch', 'tb_lession_planning.section', '=', 'tb_batch.id')
            ->select('tb_lession_planning.*', 'tb_course.course_name', 'tb_batch.batch_name')
            ->where('tb_lession_planning.branch_code',Auth::user()->school_id)
            ->where('tb_lession_planning.session',app_config('Session',Auth::user()->school_id))
            ->get();
    return view('acadmic.subject.lession-planning',compact('courses','Acadmic_year','Acadmicyear','course','subject','lessionplaning','semester'));
  }

    function getSubjectbyclass(Request $request){
      $class = $request->class_id;
     // $section = $request->section;
      $subjects=DB::table('assign_subject')
      ->join('tb_subject','assign_subject.subject','tb_subject.id')
      ->where('assign_subject.course',$class)
     // ->where('assign_subject.batch',$section)
      ->where('assign_subject.acadmic_year',app_config('Session',Auth::user()->school_id))
      ->get();
      echo json_encode($subjects);
    }

    function getSubjectbyclass_teacher(Request $request){
      $class = $request->class_id;
      $acadmic_year = $request->acadmic_year;
      if(Auth::user()->id==1){
        $subjects=DB::table('subject_allocation')
        ->join('tb_subject','subject_allocation.subject','tb_subject.id')
        ->where('subject_allocation.course',$class)
       // ->where('subject_allocation.emp_id',Auth::user()->emp_code)
       ->where('subject_allocation.acadmic_year',$acadmic_year)
        ->get();
      }else{
        $subjects=DB::table('subject_allocation')
        ->join('tb_subject','subject_allocation.subject','tb_subject.id')
        ->where('subject_allocation.course',$class)
        ->where('subject_allocation.emp_id',Auth::user()->emp_code)
        ->where('subject_allocation.acadmic_year',$acadmic_year)
        ->get();
      }

      echo json_encode($subjects);
    }
    function getlessionplanning(Request $request){
      $class = $request->class_id;
      $acadmic_year = $request->acadmic_year;
      $subject = $request->subject;
      $lessions=DB::table('tb_lession_planning')
      ->join('tb_lession_topic','tb_lession_planning.id','tb_lession_topic.tb_plan_id')
      ->where('tb_lession_planning.subject_id',$subject)
    //  ->where('tb_lession_planning.emp_id',Auth::user()->emp_code)
      ->where('tb_lession_planning.session',$acadmic_year)
      ->get();
      return view('acadmic.subject.lession-planning-report',compact('lessions'));
    }

    function deletelessionplanning($id){
      if($id){
       // DB::table('tb_lession_planning')->where('id',$id)->delete();
        DB::table('tb_lession_topic')->where('id',$id)->delete();
        return redirect('subject/lession-planning')->with([
          'message' => 'Lession Plan Deleted Successfully.',
      ]);
      }else{
        return redirect('subject/lession-planning')->with([
          'message' => 'Something went worng.Please try again.',
          'important'=>true
      ]);
      }

    }
    function updateStatuslessionplanning($id){  //exit;
      if($id){
        DB::table('tb_lession_topic')->where('id',$id)->update(['t_status'=>'1']);

        return redirect('subject/lession-planning')->with([
          'message' => 'Lession Plan Updated Successfully.',
      ]);
      }else{
        return redirect('subject/lession-planning')->with([
          'message' => 'Something went worng.Please try again.',
          'important'=>true
      ]);
      }

    }

  public function savelessionplanning(Request $request){
     // echo "hello";exit;
    $eid = $request->data;

    $data=json_decode($eid);

    $course = $request->course;

    $batch = $request->batch;
    $acadmic_year = $request->acadmic_year;
    $subject = $request->subject;
    $semester=$request->semester;

    //echo $request->data;
      try {
        $sp=DB::table('tb_lession_planning')->where('class' ,$course)->where('section' , $batch)
        ->where('subject_id' , $subject)
        ->where('session' , $acadmic_year)
        ->where('created_by' , Auth::user()->emp_code)
        ->first();
        if(count($sp)==0){
    $id = DB::table('tb_lession_planning')->insertGetId(
            ['class' =>$course, 'section' => $batch, 'section' => $batch, 'subject_id' => $subject,'session'=>app_config('Session',Auth::user()->school_id),"created_by"=>Auth::user()->emp_code ,'branch_code' => Auth::user()->school_id]
    );
  }else{
    $id=$sp->id;
  }

    if($id!=null){
       //
      foreach ($data as $datas) {
       //   echo $data;exit;
        $from_date=$datas->fromdate;
        $to_date=$datas->todate;
        $topic=$datas->topic;
        $objective=$datas->objective;
        $hours_class=$datas->hours_class;
        $t_method=$datas->t_method;
        $savedata=DB::table('tb_lession_topic')->insert(['tb_plan_id' =>$id,'from_date'=>$from_date,'to_date' =>$to_date,'objective' =>$objective,'topic' =>$topic,'hours_class' =>$hours_class,'teaching_methods'=>$t_method]);
      }

    }

    if(!empty($savedata)){
      $msg="1";
    }else{
      DB::table('tb_lession_planning')->where('id',$id)->delete();
      $msg="0";
    }
  }catch(\Illuminate\Database\QueryException $ex){
    echo $ex->getMessage();
  }
    echo $msg;
  }

  public function createtimetable(request $request)
  {
    $course=DB::table('tb_course')->where('branch_code',Auth::user()->school_id)->get();
    return view('acadmic.timetable.create_timetable',compact('course'));
  }

  function SetTimeTable(Request $request){
      $period = Input::get('pid');
      $class = Input::get('cid');
      $section = Input::get('bid');
      $subjects=DB::table('assign_subject')
      ->join('tb_subject','assign_subject.subject','tb_subject.id')
      ->select('assign_subject.*','tb_subject.subject_name')
      ->where('assign_subject.status',1)
      ->where('assign_subject.course',$class)
      ->where('assign_subject.acadmic_year',app_config('Session',Auth::user()->school_id))->get();
    $room_no=DB::table('time_table_room')->get();
    $periodTime=DB::table('tb_period')->where('course',$class)->where('batch',$section)->where('period_name',$period)
    ->where('academic_year',app_config('Session',Auth::user()->school_id))->get();
  //  echo"<pre>";  print_r($periodTime); exit;
  if(!empty($periodTime) && !empty($subjects) && !empty($room_no)){
      return view('acadmic.timetable.time-table-view',compact('subjects','room_no','periodTime'));
    }else{
      echo "<div><span>All Criteria Not available to create time-table.</span></div>";
    }
  }

  public function batchlist(Request $request){
   $eid = $request->eid;
   $batch = DB::table('tb_batch')->select('id','batch_name')->where('branch_code',Auth::user()->school_id)->where('course',$eid)->get();
   //$batch=DB::table('tb_batch')->where('course',$eid)->orderBy('id','desc')->get();
  $cart = array();
   foreach($batch as $batch){
    array_push($cart,$batch);
   }
    echo json_encode($cart);
  }

  public function subjectlist(Request $request)
  {
     $cid=$request->cid;
     $bid=$request->bid;
    $subject=DB::table('assign_subject')
    ->join('tb_course','assign_subject.course','=','tb_course.id')
    ->join('tb_batch','assign_subject.batch','=','tb_batch.id')
    ->join('tb_subject','assign_subject.subject','=','tb_subject.id')
    ->select('tb_subject.*')
    ->where('assign_subject.branch_id',Auth::user()->school_id)
    ->where('assign_subject.course',$cid)
    ->where('assign_subject.batch',$bid)
    ->get();

    $cart=array();
    foreach($subject as $subject)
    {
      array_push($cart,$subject);
    }
    echo json_encode($cart);
  }

  public function create_time_table(Request $request)
  {
    $data=json_decode($request->data);
  //  print_r($data);
    //exit;
    DB::beginTransaction();
    try
    {
      foreach ($data as $data) {
        $checkarray=array(
          "day"=>$data->day,
          "period"=>$data->period,
          "time"=>$data->time,
          "room_no"=>$data->room_no,
          "academic_year"=>app_config('Session',Auth::user()->school_id),

        );
        $check=array(
          "course"=>$data->class,
          "batch"=>$data->section,
          "subject"=>$data->subject,
          "day"=>$data->day,
          "period"=>$data->period,
          "time"=>$data->time,
          "room_no"=>$data->room_no,
          "academic_year"=>app_config('Session',Auth::user()->school_id),
        );
        $insertArray=array(
          "course"=>$data->class,
          "batch"=>$data->section,
          "subject"=>$data->subject,
          "day"=>$data->day,
          "period"=>$data->period,
          "time"=>$data->time,
          "room_no"=>$data->room_no,
          "academic_year"=>app_config('Session',Auth::user()->school_id),
          "created_by"=>Auth::user()->username,
        );
        $cnt=DB::table('cls_time_table')->where($checkarray)->count();
        if($cnt==0){
        $cnt2=DB::table('cls_time_table')->where($check)->count();
        if($cnt2==0){
          $st=DB::table('cls_time_table')->insert($insertArray);
          if($st){
               DB::commit();
              echo "Time Table Allocated Successfully";
          }else{
            echo "Unable to allocated time-table.Please try again.";
          }
        }else{
          echo "Time Time Already Allocated For this.";
        }

        }else{
          echo "This Time Slot is already Allocated.";
        }

      }
    }catch (\Exception $e) {
        // Rollback Transaction
        DB::rollback();
    }


  }

  public function viewtimetable(Request $request)
  {
    $course=DB::table('tb_course')->where('branch_code',Auth::user()->school_id)->get();
    //$subject=DB::table('tb_subject')->where('branch_code',Auth::user()->school_id)->get();
    $room_no=DB::table('time_table_room')->get();
    $teacher=DB::table('users')
    ->join('emp_details','users.emp_code','emp_details.empcode')
    ->where('users.user_role','6')
    ->get();
    $subject=DB::table('tb_subject')->get();
    //echo "<pre>";print_r($subject);exit;
    $class=DB::table('tb_course')->get();
    return view('acadmic.timetable.view_timetable',compact('room_no','teacher','subject','class'));
  }

  public function timetablelist(Request $request)
  {

     $cid = $request->cid;
     $bid = $request->bid;
     $sid = $request->sid;

    // $subs=DB::table('cls_time_table')
    // ->join('tb_subject','cls_time_table.subject','=','tb_subject.id')
    // ->groupBy('cls_time_table.subject')
    // ->where('cls_time_table.branch_code',Auth::user()->school_id)
    // ->where('cls_time_table.subject','=',$sid)
    // ->where('cls_time_table.batch','=',$bid)
    // ->where('cls_time_table.course','=',$cid)
    // ->get();

    // $timetables=DB::table('cls_time_table')
    // ->join('tb_course','cls_time_table.course','=','tb_course.id')
    // ->join('tb_batch','cls_time_table.batch','=','tb_batch.id')
    // ->join('tb_subject','cls_time_table.subject','=','tb_subject.id')

    // ->where('cls_time_table.subject','=',$sid)
    // ->where('cls_time_table.batch','=',$bid)
    // ->where('cls_time_table.course','=',$cid)
    // ->get();


    //   $t1=DB::table('subject_allocation')
    // ->join('tb_course','subject_allocation.course','=','tb_course.id')
    // ->join('tb_batch','subject_allocation.batch','=','tb_batch.id')
    // ->join('tb_subject','subject_allocation.subject','=','tb_subject.id')
    // ->where('subject_allocation.subject','=',$sid)
    // ->where('subject_allocation.batch','=',$bid)
    // ->where('subject_allocation.course','=',$cid)
    // ->get();
    //   foreach($t1 as $row)
    //   {
    //      $e_id=$row->emp_id;
    //   }
    //    $e_id;
    //    $teacher=DB::table('emp_details')
    //    ->where('branch_code',Auth::user()->school_id)
    //    ->where('id',$e_id)
    //    ->get();



    //   echo $subs .  ' |' .$timetables .'|' .$teacher;

        $prd=DB::table('tb_period')
          ->join('cls_time_table','tb_period.id','=','cls_time_table.period')
          ->groupBy('cls_time_table.period')
          ->where('cls_time_table.branch_code',Auth::user()->school_id)
          ->where('cls_time_table.batch','=',$bid)
          ->where('cls_time_table.course','=',$cid)
          ->where('cls_time_table.subject','=',$sid)

          ->get();
           $result=array();
          foreach($prd as $p)
          {
            $subs=DB::table('cls_time_table')
            ->join('tb_subject','cls_time_table.subject','=','tb_subject.id')
           ->where('cls_time_table.branch_code',Auth::user()->school_id)
          ->where('cls_time_table.batch','=',$bid)
          ->where('cls_time_table.course','=',$cid)
          ->where('cls_time_table.period','=',$p->period)
          ->where('cls_time_table.subject','=',$sid)
          ->get();

          foreach($subs as $ss)
          {
            array_push($result,array('period'=>$ss->period,'subject_name'=>$ss->subject_name,'room'=>$ss->room_no));
          }
          }
          json_encode($result);
          echo $prd.'|' .json_encode($result);
       }
       public function getteacherlist(Request $request)
       {
        $bid=$request->bid;
        $cid=$request->cid;
        $sid=$request->sid;
        $t1=DB::table('subject_allocation')
        ->join('tb_course','subject_allocation.course','=','tb_course.id')
        ->join('tb_batch','subject_allocation.batch','=','tb_batch.id')
        ->join('tb_subject','subject_allocation.subject','=','tb_subject.id')
            ->where('subject_allocation.batch','=',$bid)
        ->where('subject_allocation.course','=',$cid)
        ->where('subject_allocation.subject','=',$sid)
        ->get();
          foreach($t1 as $row)
          {
             $e_id=$row->emp_id;
          }
           $e_id;
           $teacher=DB::table('emp_details')
           ->where('branch_code',Auth::user()->school_id)
           ->where('id',$e_id)
           ->get();
            $cart=array();
    foreach($teacher as $teacher)
    {
      array_push($cart,$teacher);
    }
    echo json_encode($cart);

       }


       public function batchtimetable(Request $request)
       {
        $course=DB::table('tb_course')->where('branch_code',Auth::user()->school_id)->get();
        return view('acadmic.timetable.batch_time_table',compact('course'));
       }

    public function periodlist(Request $request)
       {
            $cid=$request->cid;
     $bid=$request->bid;
    $subject=DB::table('tb_period')
    ->join('tb_course','tb_period.course','=','tb_course.id')
    ->join('tb_batch','tb_period.batch','=','tb_batch.id')
    ->select('tb_period.*')
    ->where('tb_period.branch_code',Auth::user()->school_id)
    ->where('tb_period.course',$cid)
    ->where('tb_period.batch',$bid)
    ->get();

    $cart=array();
    foreach($subject as $subject)
    {
      array_push($cart,$subject);
    }
    echo json_encode($cart);
       }


       public function timetablebyRoom(Request $request)
          {
          $room_no = $request->room_no;

          $acadmicyear=app_config('Session',Auth::user()->school_id);
          $sql="SELECT a.*,b.subject_name,c.course_name,d.batch_name,CONCAT_WS(' ',f.fname,f.mname,f.lname) AS emp_name,e.emp_id AS emp_code FROM cls_time_table a
                INNER JOIN tb_subject b ON a.subject=b.id
                INNER JOIN tb_course c ON a.course=c.id
                INNER JOIN tb_batch d ON a.batch=d.id
                LEFT JOIN subject_allocation e ON a.subject=e.subject AND a.course=e.course AND a.batch=e.batch
                LEFT JOIN emp_details f ON e.emp_id=f.empcode
                WHERE a.room_no='$room_no' AND a.academic_year='$acadmicyear'";
          $timetable=DB::select($sql);
          $type="Room No";
          if(count($timetable)==0){
            echo "<span style='color:red;font-size: large;'>Time table not found.</span>";
          }else{
            return view('acadmic.timetable.timetable_report',compact('timetable','type'));
          }
         }
         public function timetablebyTeacher(Request $request)
            {
            $teacher_id = $request->teacher_id;

            $acadmicyear=app_config('Session',Auth::user()->school_id);
            $sql="SELECT a.*,b.subject_name,c.course_name,d.batch_name,CONCAT_WS(' ',f.fname,f.mname,f.lname) AS emp_name,e.emp_id AS emp_code FROM cls_time_table a
                  INNER JOIN tb_subject b ON a.subject=b.id
                  INNER JOIN tb_course c ON a.course=c.id
                  INNER JOIN tb_batch d ON a.batch=d.id
                  INNER JOIN subject_allocation e ON a.subject=e.subject AND a.course=e.course AND a.batch=e.batch
                  INNER JOIN emp_details f ON e.emp_id=f.empcode
                  WHERE e.emp_id='$teacher_id' AND a.academic_year='$acadmicyear'";
            $timetable=DB::select($sql);
            $type="Teacher";
            if(count($timetable)==0){
              echo "<span style='color:red;font-size: large;'>Time table not found.</span>";
            }else{
              return view('acadmic.timetable.timetable_report',compact('timetable','type'));
            }
           }

           public function timetablebysubject(Request $request)
              {
              $subject_id = $request->subject_id;

              $acadmicyear=app_config('Session',Auth::user()->school_id);
              $sql="SELECT a.*,b.subject_name,c.course_name,d.batch_name,CONCAT_WS(' ',f.fname,f.mname,f.lname) AS emp_name,e.emp_id AS emp_code FROM cls_time_table a
                    INNER JOIN tb_subject b ON a.subject=b.id
                    INNER JOIN tb_course c ON a.course=c.id
                    INNER JOIN tb_batch d ON a.batch=d.id
                    INNER JOIN subject_allocation e ON a.subject=e.subject AND a.course=e.course AND a.batch=e.batch
                    INNER JOIN emp_details f ON e.emp_id=f.empcode
                    WHERE a.subject='$subject_id' AND a.academic_year='$acadmicyear'";
              $timetable=DB::select($sql);
              $type="Teacher";
              if(count($timetable)==0){
                echo "<span style='color:red;font-size: large;'>Time table not found.</span>";
              }else{
                return view('acadmic.timetable.timetable_report',compact('timetable','type'));
              }
             }
             public function timetablebyclasssubject(Request $request)
                {
                $subject_id = $request->subject_id;
                $class_id = $request->class_id;
                $acadmicyear=app_config('Session',Auth::user()->school_id);
                $sql="SELECT a.*,b.subject_name,c.course_name,d.batch_name,CONCAT_WS(' ',f.fname,f.mname,f.lname) AS emp_name,e.emp_id AS emp_code FROM cls_time_table a
                      INNER JOIN tb_subject b ON a.subject=b.id
                      INNER JOIN tb_course c ON a.course=c.id
                      INNER JOIN tb_batch d ON a.batch=d.id
                      INNER JOIN subject_allocation e ON a.subject=e.subject AND a.course=e.course AND a.batch=e.batch
                      INNER JOIN emp_details f ON e.emp_id=f.empcode
                      WHERE a.subject='$subject_id' and a.course='$class_id' AND a.academic_year='$acadmicyear'";
                $timetable=DB::select($sql);
                $type="Teacher";
                if(count($timetable)==0){
                  echo "<span style='color:red;font-size: large;'>Time table not found.</span>";
                }else{
                  return view('acadmic.timetable.timetable_report',compact('timetable','type'));
                }
               }
     public function batchtimetablelist(Request $request)
        {
        $cid = $request->cid;
        $bid = $request->bid;
      /*  $timetable=DB::table('cls_time_table')
        ->join('tb_subject','cls_time_table.subject','tb_subject.id')
        ->join('tb_course','cls_time_table.course','tb_course.id')
        ->join('tb_batch','cls_time_table.batch','tb_batch.id')
        ->select('cls_time_table.*','tb_subject.subject_name','tb_course.course_name','tb_batch.batch_name')
        ->where('cls_time_table.course',$cid)
        ->where('cls_time_table.batch',$bid)->get(); */
        $acadmicyear=app_config('Session',Auth::user()->school_id);


        $period=DB::table('tb_period')
        ->where('course',$cid)
        ->where('batch',$bid)
        ->where('academic_year',app_config('Session',Auth::user()->school_id))
        ->get();

        $sql="SELECT a.*,b.subject_name,c.course_name,d.batch_name,CONCAT_WS(' ',f.fname,f.mname,f.lname) AS emp_name,e.emp_id AS emp_code FROM cls_time_table a
              INNER JOIN tb_subject b ON a.subject=b.id
              INNER JOIN tb_course c ON a.course=c.id
              INNER JOIN tb_batch d ON a.batch=d.id
              LEFT JOIN subject_allocation e ON a.subject=e.subject AND a.course=e.course AND a.batch=e.batch
              LEFT JOIN emp_details f ON e.emp_id=f.empcode
              WHERE a.course='$cid' AND a.batch='$bid' AND a.academic_year='$acadmicyear'";
        $timetable=DB::select($sql);
        if(count($timetable)==0){
          echo "<span style='color:red;font-size: large;'>Time table not found.</span>";
        }else{
          return view('acadmic.timetable.view_batch_timetable',compact('timetable','period'));
        }
       }


       public function teachertimetable()
       {
         $emp=DB::table('emp_details')->where('branch_code',Auth::user()->school_id)->get();
         return view('acadmic.timetable.view_teacher_timetable',compact('emp'));
       }


       public function teachertimetablelist(Request $request)
       {
         //   $eid=$request->eid;
         //   $d=DB::table('subject_allocation')
         //  ->where('branch_code',Auth::user()->school_id)
         //  ->where('emp_id','=',$eid)
         //  ->get();
         //  foreach($d as $row)
         //  {
         //      $s=$row->subject;

         //      $c=$row->course;

         //      $b=$row->batch;
         //  }
         //   $rel1 = array();
         //  $subs=DB::table('cls_time_table')
         //  ->join('tb_subject','cls_time_table.subject','=','tb_subject.id')
         //  ->join('subject_allocation','cls_time_table.subject','=','subject_allocation.subject')
         //  ->groupBy('cls_time_table.subject')
         //  ->where('cls_time_table.branch_code',Auth::user()->school_id)
         //  ->where('cls_time_table.batch','=',$b)
         //  ->where('cls_time_table.course','=',$c)
         //  ->where('subject_allocation.emp_id','=',$eid)
         //  ->get();

         //  foreach($subs as $sub)
         //  {
         //     $time_tables=DB::table('cls_time_table')
         //    ->join('tb_subject','cls_time_table.subject','=','tb_subject.id')
         //    ->join('tb_course','cls_time_table.course','=','tb_course.id')
         //    ->join('tb_batch','cls_time_table.batch','=','tb_batch.id')
         //    ->where('cls_time_table.branch_code',Auth::user()->school_id)
         //    ->where('cls_time_table.course','=',$sub->course)
         //    ->where('cls_time_table.subject','=',$sub->subject)
         //    ->where('cls_time_table.batch','=',$sub->batch)
         //    ->get();
         //      foreach($time_tables as $time_table)
         //    {
         //      array_push($rel1,array('subject' => $time_table->subject,'start_time'=> $time_table->start_time,'end_time'=> $time_table->end_time,'room_no'=> $time_table->room_no,'batch_name'=>$time_table->batch_name));
         //      //array_push($rel1,$time_table);            }
         //  }

         // echo $subs .'|' .json_encode($rel1);
//exit();
        $eid=$request->eid;
         $d=DB::table('subject_allocation')
          ->where('branch_code',Auth::user()->school_id)
          ->where('emp_id','=',$eid)
          ->get();
          $result=array();
          foreach($d as $dd)
          {
            $b=$dd->batch;
            $c=$dd->course;
            $s=$dd->subject;

            $prd=DB::table('tb_period')
          ->join('cls_time_table','tb_period.id','=','cls_time_table.period')
          ->groupBy('cls_time_table.period')
          ->where('cls_time_table.branch_code',Auth::user()->school_id)
          ->where('cls_time_table.batch','=',$b)
          ->where('cls_time_table.course','=',$c)
          ->where('cls_time_table.subject','=',$s)
          ->get();

          foreach($prd as $p)
          {
           $subs=DB::table('cls_time_table')
          ->join('tb_subject','cls_time_table.subject','=','tb_subject.id')
          ->where('cls_time_table.branch_code',Auth::user()->school_id)
          ->where('cls_time_table.batch','=',$b)
          ->where('cls_time_table.course','=',$c)
          ->where('cls_time_table.subject','=',$s)
          ->where('cls_time_table.period','=',$p->period)
          ->get();

           foreach($subs as $ss)
          {
            array_push($result,array('period'=>$ss->period,'subject_name'=>$ss->subject_name,'room'=>$ss->room_no));
          }
        }
          }

            echo $prd.'|' .json_encode($result);
      //json_encode($result);

           //echo $prd.'|' .json_encode($result);
  }

    public function period_master(Request $request)
    {
        $period=DB::table('tb_period')
        ->join('tb_course','tb_period.course','=','tb_course.id')
        ->join('tb_batch','tb_period.batch','=','tb_batch.id')
        ->select('tb_period.*','tb_course.course_name','tb_batch.batch_name')
        ->get();
      //  echo "<pre>";print_r($period);exit;

       $course=DB::table('tb_course')->where('branch_code',Auth::user()->school_id)->get();
        return view('acadmic.timetable.period_master',compact('course','period'));
    }

    function room(){
    $room=DB::table('time_table_room')->orderBy('id','desc')->get();
      return view('acadmic.timetable.add-room',compact('room'));

    }
    function Addroom(Request $request){
      $this->validate($request, [
        'room_no'=>'required|unique:time_table_room',
      ]);

      $data=array(
        "room_no"=>Input::get('room_no'),
        "created_by"=>Auth::user()->username
      );
      DB::table('time_table_room')->insert($data);
      return redirect('add-room')->with([
          'message' => 'Room Added Succesfully.'
      ]);
    }
    function Deleteroom($id){
      DB::table('time_table_room')->where('id',$id)->delete();
      return redirect('add-room')->with([
          'message' => 'Room Deleted Succesfully.'
      ]);
    }
    public function add_period(Request $request)
    {
      $self='period_master';
    if (\Auth::user()->user_role!=='1'){
        $get_perm=permission::permitted($self);

        if ($get_perm=='access denied'){
            return redirect('permission-error')->with([
                'message' => 'You do not have permission to view this page.',
                'message_important'=>true
            ]);
        }
    }
    $this->validate($request, [
      'course'=>'required',
      'batch'=>'required',
      'period'=>'required',
      'start_time'=>'required',
      'end_time'=>'required',
    ],[
      'course.required'=>'Please Select Class',
      'batch.required'=>'Please Select Section',
      'period.required'=>'Please Enter Period',
    ]);
       $course=Input::get('course');
       $batch=Input::get('batch');
      $period=Input::get('period');
      $start_time=Input::get('start_time');
      $end_time=Input::get('end_time');
      $created_date = date('d-m-Y H:i:s');

      $validateArray=array(
        "course"=>$course,
        "batch"=>$batch,
        "period_name"=>$period,
        "academic_year"=>app_config('Session',Auth::user()->school_id)
      );
      $cnt=DB::table('tb_period')->where($validateArray)->count();
      if($cnt > 0){
        return redirect('period_master')->with([
             'message' => 'Same Period Exists with Class/section.',
             'message_important'=>true
         ]);
      }

      $period=DB::table('tb_period')->insert(['course'=>$course,'batch'=>$batch,'period_name'=>$period,'start_time'=>$start_time,'end_time'=>$end_time,'academic_year'=>app_config('Session',Auth::user()->school_id),'created_by'=>Auth::user()->username,'created_date'=>$created_date,'branch_code'=>Auth::user()->school_id]);

      if(!empty($period)){
         return redirect('period_master')->with([
                 'message' => 'Period is Added Succesfully.'
             ]);
       }else{
              return redirect('period_master')->with([
                   'message' => 'Failed To Add period.',
                   'message_important'=>true
               ]);
            }
    }

    public function delete_period(Request $request,$id)
    {
       $self='period_master';
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
           DB::table('tb_period')->where('id',$id)->where('branch_code',Auth::user()->school_id)->delete();

            return redirect('period_master')->with([
                'message' => "Period Details Deleted Successfully."
            ]);
        }else{
            return redirect('period_master')->with([
                'message' => "Period Details Not Found",
                'message_important' => true
            ]);
      }
    }

    public function updatetimetable(Request $request,$cid,$bid,$id)
    {

          $sql=DB::table('cls_time_table')
      ->join('tb_period','cls_time_table.period','=','tb_period.id')
      ->join('tb_subject','cls_time_table.subject','=','tb_subject.id')
      ->select('tb_period.period_name','tb_subject.subject_name','cls_time_table.*')
     ->where('cls_time_table.branch_code',Auth::user()->school_id)
     ->where('cls_time_table.batch','=',$bid)
     ->where('cls_time_table.course','=',$cid)
     ->where('cls_time_table.period','=',$id)
     ->get();

      return view('acadmic.timetable.update_timetable',compact('sql'));
    }

    public function edit_timetable(Request $request)
    {
       $period=$request->period;
       $course=$request->course;
       $batch=$request->batch;
       $room_no=$request->room_no;
        $cls_id=$request->cls_id;
        for($i=0;$i<count($cls_id);$i++)
        {
          $change=DB::table('cls_time_table')
          ->where('id',$cls_id[$i])
          ->update(['room_no'=>$room_no[$i]]);
        }

        if(!empty($change)){
           return redirect('batch_timetable')->with([

               ]);
         }else{
                return redirect('batch_timetable')->with([

                 ]);
              }
    }

    public function semester(Request $request)
    {
      $semester=DB::table('tb_semester')->get();
      return view('acadmic.course.semester',compact('semester'));
    }

    public function add_semester(Request $request)
    {
      $semester=Input::get('semester');
         $created_date = date('d-m-Y H:i:s');
         $save=DB::table('tb_semester')->insert(['semester_name'=>$semester,'academic_year'=>app_config('Session',Auth::user()->school_id),'created_date'=>$created_date,'branch_code'=>Auth::user()->school_id]);

          if(!empty($save)){
         return redirect('semester')->with([
                 'message' => 'Semester is Added Succesfully.'
             ]);
       }else{
              return redirect('semester')->with([
                   'message' => 'semester To Add period.',
                   'message_important'=>true
               ]);
            }
    }

  }
?>
