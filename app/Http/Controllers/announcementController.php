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
class announcementController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }
  public function parents(Request $request)
  {
    	$course=DB::table('tb_course')->where('branch_code',Auth::user()->school_id)->get();
  	return view('announcement.parents',compact('course'));
  }
  public function studentlist(Request $request)
       {
        $bid=$request->bid;
        $cid=$request->cid;
       
      $studentlist=DB::table('stu_admission')
      	->where('batch','=',$bid)
      	->where('course','=',$cid)
      	->get();
      
            $cart=array();
    foreach($studentlist as $studentlist)
    {
      array_push($cart,$studentlist);
    }
    echo json_encode($cart);

       }

       public function parents_msg(Request $request)
       {
        $announcement_for=Input::get('announcement_for');
       	$msg=Input::get('msg');
        $notification=Input::get('notification');
        $student=Input::get('student');
       	$created_date = date('d-m-Y H:i:s');
        if($announcement_for == 'Common To All')
        {
            $save=DB::table('parent_announcement')
            ->insert(['msg'=>$msg,'created_date'=>$created_date,'register_no'=>'no']);

                if(!empty($save)){
         return redirect('announcement/parents')->with([
                 'message' => 'Notification Send Succesfully.'
             ]);
       }else{
              return redirect('announcement/parents')->with([
                   'message' => 'Failed To Send.',
                   'message_important'=>true
               ]);
            }

        }
        else
        {
            $save=DB::table('parent_announcement')
            ->insert(['msg'=>$notification,'register_no'=>$student,'created_date'=>$created_date]);

                if(!empty($save)){
         return redirect('announcement/parents')->with([
                 'message' => 'Notification Send Succesfully.'
             ]);
       }else{
              return redirect('announcement/parents')->with([
                   'message' => 'Failed To Send.',
                   'message_important'=>true
               ]);
            }

        }
             }

 public function teachers()
 {
  $deg=DB::table('tb_degination')->get();

  return view('announcement.teachers',compact('deg'));
 }

 function teacher_msg(Request $request){
    $announcement_for=Input::get('announcement_for');
    $msg=Input::get('msg');
 $desi=Input::get('desi');

    $created_date = date('d-m-Y H:i:s');
 if($announcement_for == 'Common To All')
 {
     $save=DB::table('staff_announcement')
     ->insert(['msg'=>$msg,'created_date'=>$created_date,'for'=>'all']);

         if(!empty($save)){
  return redirect('announcement/teacher')->with([
          'message' => 'Notification Send Succesfully.'
      ]);
}else{
       return redirect('announcement/teacher')->with([
            'message' => 'Failed To Send.',
            'message_important'=>true
        ]);
     }

 }
 else
 {
     $save=DB::table('staff_announcement')
     ->insert(['msg'=>$msg,'for'=>$desi,'created_date'=>$created_date]);

         if(!empty($save)){
  return redirect('announcement/teacher')->with([
          'message' => 'Notification Send Succesfully.'
      ]);
}else{
       return redirect('announcement/teacher')->with([
            'message' => 'Failed To Send.',
            'message_important'=>true
        ]);
     }

 }
 }
}