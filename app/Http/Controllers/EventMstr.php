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
class EventMstr extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
      $this->middleware('SchoolMiddleware');
  }
  public function eventList(Request $request){
    $eventList = DB::table('tbl_event_mstr')
                      ->where('status',1)
                      ->orderBy('id','DESC')
                      ->get();
    $eventList = json_encode($eventList,true);
    $eventList = json_decode($eventList,true);
    return view('event.event_list',compact('eventList'));
  }
  public function add_update(Request $request,$id=null){
    if($request->isMethod('post')){
        $event_name=trim(Input::get('event_name'));
        $id=trim(Input::get('id'));
        if($id==""){
          $checkData=DB::table('tbl_event_mstr')
                      ->where(DB::raw('upper(event_name)'),strtoupper($event_name))
                      ->where('status',1)
                      ->first();
                      $checkData =json_encode($checkData,true);
                      $checkData=json_decode($checkData,true);
            if($checkData){
              echo "<script>alert('Event Already Exists!!');</script>";
                return view('event.add_event',compact('event_name'));
            }else{
              $insertData = DB::table('tbl_event_mstr')->insertGetId([
                'event_name'=>$event_name
                ]);
                if($insertData){
                    return redirect('event')
                          ->with([
                         'message' =>'Event Added Successfully!!'
                    ]);
                }else{
                  echo "<script>alert('Something Wrong!!');</script>";
                  return view('event.add_event',compact('event_name'));
                }
            }
          }else{ //Update Statement
            $checkUpdate = DB::table('tbl_event_mstr')
                  ->where(DB::raw('upper(event_name)'),strtoupper($event_name))
                  ->where(DB::raw('md5(id)'),'!=',$id)
                  ->where('status',1)
                  ->first();
                  $checkUpdate =json_encode($checkUpdate,true);
                  $checkUpdate =json_decode($checkUpdate,true);
            if($checkUpdate){
              return view('event.add_event',compact('event_name','id'));
            }else{
              $query = DB::table('tbl_event_mstr')
                      ->where(DB::raw('md5(id)'),$id)
                        ->update([
                      'event_name'=>$event_name
                      ]);
              if($query){
                return redirect('event')
                      ->with([
                              'message' =>'Event Updated Successfully!!'
                             ]);
              }else{
                echo "<script>alert('Fail To Update Record!!');</script>";
                return view('event.add_event',compact('event_name','id'));
              }
            }
          }
        }else if(isset($id)){
          $updateData = DB::table('tbl_event_mstr')
                      ->where(DB::raw('md5(id)'),$id)
                      ->where('status',1)
                      ->first();
            $updateData = json_encode($updateData,true);
            $updateData =json_decode($updateData,true);
            $event_name =$updateData['event_name'];
            $id =$updateData['id'];
            return view('event.add_event',compact('event_name','id'));

        }else{
          return view('event.add_event');
        }
  }
  public function delete(Request $request,$id=null){
    $query = DB::table('tbl_event_mstr')
            ->where(DB::raw('md5(id)'),$id)
              ->update([
            'status'=>0
            ]);
    if($query){
      return redirect('event')
                   ->with([
                   'message' =>'Event Deleted Successfully!!'
                ]);
    }else{
      return redirect('event')
                    ->with([
                   'message' =>'Fail To Delete Event!!'
                ]);
    }
  }
}
?>
