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
class EventReport extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
      $this->middleware('SchoolMiddleware');
  }
  public function report(Request $request){
    $eventTypeList = DB::table('tbl_event_mstr')
                        ->where('status',1)
                        ->orderBy('id','ASC')
                        ->get();
    $eventTypeList = json_encode($eventTypeList,true);
    $eventTypeList = json_decode($eventTypeList,true);  
    if($request->isMethod('post')){
        $event_mstr_id=trim(Input::get('event_mstr_id'));
        $from_date=Input::get('from_date');
        $to_date=Input::get('to_date');
        if($event_mstr_id!=""){ //Single Data
            $eventListData =""; /*DB::table('view_event_details')
                        ->where(DB::raw('date(created_on)'),'>=',$from_date)
                        ->where(DB::raw('date(created_on)'),'<=',$to_date)
                        ->where('event_mstr_id',$event_mstr_id)
                        ->orderBy('id','DESC')
                        ->get();*/
          $eventListData = json_encode($eventListData,true);
          $eventListData = json_decode($eventListData,true);
         return view('event.event_report',compact('eventTypeList','eventListData','from_date','to_date','event_mstr_id'));
        }else{
             $eventListData = "";/*DB::table('view_event_details')
                        ->where(DB::raw('date(created_on)'),'>=',$from_date)
                        ->where(DB::raw('date(created_on)'),'<=',$to_date)
                        ->orderBy('id','DESC')
                        ->get();*/
          $eventListData = json_encode($eventListData,true);
          $eventListData = json_decode($eventListData,true);
          
         return view('event.event_report',compact('eventTypeList','eventListData','from_date','to_date','event_mstr_id'));  
        }
    }else{
        $currernt_date =date('Y-m-d');
        $eventListData ="";/* DB::table('view_event_details')
                      ->where(DB::raw('date(created_on)'),$currernt_date)
                      ->orderBy('id','DESC')
                      ->get();*/
        $eventListData = json_encode($eventListData,true);
        $eventListData = json_decode($eventListData,true);
        return view('event.event_report',compact('eventTypeList','eventListData'));
    }
  }
}
?>
