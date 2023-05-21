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
class AddEvent extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
      $this->middleware('SchoolMiddleware');
  }
  public function eventList(Request $request){
    $eventList = "";/*DB::table('view_event_details')
                      ->orderBy('id','DESC')
                      ->get();*/
    $eventList = json_encode($eventList,true);
    $eventList = json_decode($eventList,true);
    return view('event.add_event_list',compact('eventList'));
  }
  public function add_update(Request $request,$id=null){
    $eventTypeList = DB::table('tbl_event_mstr')
                        ->where('status',1)
                        ->orderBy('id','ASC')
                        ->get();
    $eventTypeList = json_encode($eventTypeList,true);
    $eventTypeList = json_decode($eventTypeList,true);  
    if($request->isMethod('post')){
        $event_name=trim(Input::get('event_name'));
        $event_mstr_id=trim(Input::get('event_mstr_id'));
        $from_date=Input::get('from_date');
        $to_date=Input::get('to_date');
        $discription=trim(Input::get('discription'));
        $event_status=trim(Input::get('event_status'));
       /* echo $event_status;
        die();*/
        $id=trim(Input::get('id'));
        $created_on =date('Y-m-d H:i:s');
        $updated_on =date('Y-m-d H:i:s');
        if($id==""){
          $insertData = DB::table('tbl_event')->insertGetId([
            'event_name'=>$event_name,
            'event_mstr_id'=>$event_mstr_id,
            'from_date'=>$from_date,
            'to_date'=>$to_date,
            'discription'=>$discription,
            'created_on'=>$created_on,
            'updated_on'=>$updated_on,
            'event_status'=>$event_status
            ]);
            if($insertData){
                return redirect('assignevent')
                      ->with([
                     'message' =>'Event Added Successfully!!'
                ]);
            }else{
              echo "<script>alert('Something Wrong!!');</script>";
              return view('event.assign_event',compact('event_name','event_mstr_id','from_date','to_date','discription','eventTypeList'));
            }
          }else{ //Update Statement
              $updateData = DB::table('tbl_event')
                      ->where(DB::raw('md5(id)'),$id)
                        ->update([
                      'event_name'=>$event_name,
                      'event_mstr_id'=>$event_mstr_id,
                      'from_date'=>$from_date,
                      'to_date'=>$to_date,
                      'discription'=>$discription,
                      'updated_on'=>$updated_on,
                      'event_status'=>$event_status
                      ]);
              if($updateData ){
                return redirect('assignevent')
                      ->with([
                              'message' =>'Event Updated Successfully!!'
                             ]);
              }else{
                echo "<script>alert('Fail To Update Record!!');</script>";
                return view('event.assign_event',compact('event_name','event_mstr_id','from_date','to_date','discription','eventTypeList','event_status'));
              }
          }
        }else if(isset($id)){
          $updateData = DB::table('tbl_event')
                      ->where(DB::raw('md5(id)'),$id)
                      ->where('status',1)
                      ->first();
            $updateData = json_encode($updateData,true);
            $updateData =json_decode($updateData,true);
            $event_name =$updateData['event_name'];
            $event_mstr_id =$updateData['event_mstr_id'];
            $from_date =$updateData['from_date'];
            $to_date =$updateData['to_date'];
            $discription =$updateData['discription'];
            $event_status =$updateData['event_status'];
            $id =$updateData['id'];
             return view('event.assign_event',compact('event_name','event_mstr_id','from_date','to_date','discription','id','eventTypeList','event_status'));

        }else{
          return view('event.assign_event',compact('eventTypeList'));
        }
  }
  public function delete(Request $request,$id=null){
    $query = DB::table('tbl_event')
            ->where(DB::raw('md5(id)'),$id)
              ->update([
            'status'=>0
            ]);
    if($query){
      return redirect('assignevent')
                   ->with([
                   'message' =>'Event Deleted Successfully!!'
                ]);
    }else{
      return redirect('assignevent')
                    ->with([
                   'message' =>'Fail To Delete Event!!'
                ]);
    }
  }
}
?>
