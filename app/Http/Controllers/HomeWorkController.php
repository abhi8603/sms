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
class HomeWorkController extends Controller
{

	public function __construct()
  {
      $this->middleware('auth');
      $this->middleware('SchoolMiddleware');
  }

  public function homeworklist(Request $request)
  {
  	$self='homework/homeworklist';
    if (\Auth::user()->user_role=='P'){
        $get_perm=permission::permitted($self);

        if ($get_perm=='access denied'){
            return redirect('permission-error')->with([
                'message' => 'You do not have permission to view this page.',
                'message_important'=>true
            ]);
        }
    }
    $course=DB::table('tb_course')->where('branch_code',Auth::user()->school_id)->get();

    return view('Homework.homework',compact('course'));
  }

  public function createhomework(Request $request)
  {
  	$self='homework/createhomework';
    if (\Auth::user()->user_role=='P'){
        $get_perm=permission::permitted($self);

        if ($get_perm=='access denied'){
            return redirect('permission-error')->with([
                'message' => 'You do not have permission to view this page.',
                'message_important'=>true
            ]);
        }
    }

    $course=DB::table('tb_course')->where('branch_code',Auth::user()->school_id)->get();
    return view('Homework.create_homework',compact('course'));
  }
	function getSubjectbyclass(Request $request){
		$class = $request->cid;
		$section = $request->bid;
	 // $section = $request->section;
	 if(Auth::user()->id==1){
		 $subjects=DB::table('subject_allocation')
		 ->join('tb_subject','subject_allocation.subject','tb_subject.id')
		 ->where('subject_allocation.course',$class)
		 ->where('subject_allocation.batch',$section)
		 ->where('subject_allocation.acadmic_year',app_config('Session',Auth::user()->school_id))
		 ->get();
	 }else{
	//	 echo $class."-".$section."-".Auth::user()->emp_code;
		$subjects=DB::table('subject_allocation')
		->join('tb_subject','subject_allocation.subject','tb_subject.id')
		->where('subject_allocation.course',$class)
		->where('subject_allocation.batch',$section)
	  ->where('subject_allocation.emp_id',Auth::user()->emp_code)
		->where('subject_allocation.acadmic_year',app_config('Session',Auth::user()->school_id))
		->get();
	}
		echo json_encode($subjects);
	}
  public function insert_homework(Request $request)
  {
  	 $self='homework/createhomework';
    if (\Auth::user()->user_role=='P'){
        $get_perm=permission::permitted($self);

        if ($get_perm=='access denied'){
            return redirect('permission-error')->with([
                'message' => 'You do not have permission to view this page.',
                'message_important'=>true
            ]);
        }
    }
if(isset($_FILES['file'])){
	$errors= array();
		 $file_name = $_FILES['file']['name'];
		 $file_size =$_FILES['file']['size'];
		 $file_tmp =$_FILES['file']['tmp_name'];
		 $file_type=$_FILES['file']['type'];
		// $file_ext=strtolower(end(explode('.',$_FILES['file']['name'])));
		$tmp = explode('.', $file_name);
		$file_ext = end($tmp);
		 if($file_size > 2097152){
				$errors[]='File size must be excately 2 MB';
		 }
		 if(empty($errors)==true){
         move_uploaded_file($file_tmp,"assets/homeworkupload/".$file_name);
        $filepath="assets/homeworkupload/".$file_name;
      }else{
				return redirect('homework/createhomework')->with([
						'message' => 'Unable to upload Home work File.Please try again',
						'message_important'=>true
				]);
      }

}else{
	$filepath="";
}


    $course=Input::get('course');
    $batch=Input::get('batch');
    $subject=Input::get('subject');
    $homework_date=Input::get('homework_date');
    $date_of_submission=Input::get('date_of_submission');
    $description=Input::get('description');
    $created_date = date('d-m-Y H:i:s');

     $save=DB::table('homework')->insert(['course'=>$course,'batch'=>$batch,'subject'=>$subject,'homework_date'=>$homework_date,'date_of_submission'=>$date_of_submission,'description'=>$description,'document'=>$filepath,'given_by'=>Auth::user()->username,'academic_year'=>app_config('Session',Auth::user()->school_id),'created_date'=>$created_date,'branch_code'=>Auth::user()->school_id]);

      if(!empty($save)){
         return redirect('homework/createhomework')->with([
                 'message' => 'Homework Added Succesfully.'
             ]);
       }else{
              return redirect('homework/createhomework')->with([
                   'message' => 'Homework Added failed.',
                   'message_important'=>true
               ]);
            }

  }

  public function homework(Request $request)
  {
  	$cid=$request->cid;
  	$bid=$request->bid;
  	$sub=$request->sub;

		if(Auth::user()->id==1){
  	$homework=DB::table('homework')
  	->join('tb_course','homework.course','=','tb_course.id')
  	->join('tb_batch','homework.batch','=','tb_batch.id')
  	->join('tb_subject','homework.subject','tb_subject.id')
  	->select('homework.*','tb_batch.batch_name','tb_course.course_name','tb_subject.subject_name')
  	->where('homework.branch_code',Auth::user()->school_id)
  	->where('homework.course','=',$cid)
  	->where('homework.batch','=',$bid)
  	->where('homework.subject','=',$sub)
  	->get();
}else{
	$homework=DB::table('homework')
	->join('tb_course','homework.course','=','tb_course.id')
	->join('tb_batch','homework.batch','=','tb_batch.id')
	->join('tb_subject','homework.subject','tb_subject.id')
	->select('homework.*','tb_batch.batch_name','tb_course.course_name','tb_subject.subject_name')
	->where('homework.branch_code',Auth::user()->school_id)
	->where('homework.course','=',$cid)
	->where('homework.batch','=',$bid)
	->where('homework.subject','=',$sub)
	->where('homework.given_by','=',Auth::user()->username)
	->get();
}
  	echo $homework;
  }

  public function evaluate(Request $request,$cid)
  {
    $session = app_config('Session',Auth::user()->school_id);
    $sql = "SELECT a.*,b.stu_name AS stu_name,b.course,b.batch FROM evaluate_homework a
						INNER JOIN stu_admission b ON a.student=b.reg_no
						WHERE a.homework_id='$cid'";
					//	echo $sql;exit;
	 $result = DB::select($sql);
   return view('Homework.evaluate',compact('result','cid'));
  }

  public function evaluate_homework($id,$status,$hwid)
  {
	//	echo $id;exit;
		if($status==0){
			$status=1;
		}else{
			$status=0;
		}
		$updatearray=array(
			"status"=>$status,
			"evaluated_by"=>Auth::user()->username
		);
	$save=DB::table('evaluate_homework')->where('id',$id)->update($updatearray);

     		if(!empty($save)){
         return redirect('homework/evaluate/'.$hwid)->with([
                 'message' => 'Evaluate Succesfully.'
             ]);
       }else{
              return redirect('homework/evaluate/'.$hwid)->with([
                   'message' => 'Evaluate failed.Please try again',
                   'message_important'=>true
               ]);
            }
              }

   public function evaluation_report()
   {
   	$self='homework/evaluation_report';
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
$report=null;
$r=null;
    return view('Homework.evaluation_report',compact('course','report','r'));


    }

    public function show_report_list(Request $request)
    {
    	echo $cid=$request->cid;
    	echo $bid=$request->bid;
    	echo $sub=$request->sub;
    	echo $date=$request->date;
    	 $report=DB::table('evaluate_homework')
    ->join('homework','evaluate_homework.homework','=','homework.id')
    ->join('tb_subject','homework.subject','=','tb_subject.id')
    ->join('stu_admission','evaluate_homework.student','=','stu_admission.reg_no')
    ->select('stu_admission.stu_name','homework.homework_date','homework.date_of_submission','tb_subject.subject_name','evaluate_homework.status','evaluate_homework.id')
    ->where('homework.course',$cid)
    ->where('homework.batch',$bid)
    ->where('homework.subject',$sub)
    ->where('homework.homework_date',$date)
    ->get();
    	echo $report;

    }
   }
?>
