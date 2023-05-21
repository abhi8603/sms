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
class hostelController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
      $this->middleware('SchoolMiddleware');
  }
  public function hosteldetails(){
    $self='hostel/details';
    if (\Auth::user()->user_role!=='1'){
        $get_perm=permission::permitted($self);

        if ($get_perm=='access denied'){
            return redirect('permission-error')->with([
                'message' => 'You do not have permission to view this page',
                'message_important'=>true
            ]);
        }
    }
    $hosteltype=DB::table('hostel_type')->where('branch_code',Auth::user()->school_id)->get();
    $hosteltypes=DB::table('hostel_type')->where('branch_code',Auth::user()->school_id)->get();
    $hosteldetails=DB::table('hostel_details')->where('branch_code',Auth::user()->school_id)->get();
    return view('hostel.hostel-details',compact('hosteltype','hosteltypes','hosteldetails'));
  }

  public function hosteltype(Request $request){
    $self='hostel/hosteltype';
    if (\Auth::user()->user_role!=='1'){
        $get_perm=permission::permitted($self);

        if ($get_perm=='access denied'){
            return redirect('permission-error')->with([
                'message' => 'You do not have permission to view this page',
                'message_important'=>true
            ]);
        }
      }
  $type=Input::get('type');
  $created_date = date('d-m-Y H:i:s');
  DB::table('hostel_type')->insert(['hotel_type'=>$type,'created_on'=>$created_date,'branch_code'=>Auth::user()->school_id]);
         return redirect('hostel/details')->with([
              'message' => 'New Hostel Type Added Successfully.'
          ]);
  }
  public function deletehosteltype(Request $request,$id){
    $self='hostel/hosteltype/delete';
    if (\Auth::user()->user_role!=='1'){
        $get_perm=permission::permitted($self);

        if ($get_perm=='access denied'){
            return redirect('permission-error')->with([
                'message' => 'You do not have permission to view this page',
                'message_important'=>true
            ]);
        }
      }
      $request->all();
      try {
      if($id!=null){
        DB::table('hostel_type')->where('id','=',$id)->where('branch_code','=',Auth::user()->school_id)->delete();
         return redirect('hostel/details')->with([
             'message' => "Hostel Type ".$id." Deleted Successfully"
         ]);
      }else{
        return redirect('hostel/details')->with([
            'message' => "Unable to Delete Hotel Type.Please Try Again.",
            'message_important'=>true
        ]);
      }
    }catch(\Illuminate\Database\QueryException $ex){
      return redirect('hostel/details')->with([
          'message' => "something Went Worng.Please Try Again. Error :  ". $ex->getMessage(),
          'message_important'=>true
      ]);

     }
  }
  public function hosteldetailssave(Request $request){
    $self='hostel/hosteldetails';
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
          'hostel_type'=>'required',
          'hostel_name'=>'required',
          'hostel_address'=>'required',
          'hostel_phone'=>'required',
          'warden_name'=>'required',
          'warden_address'=>'required',
          'warden_phone'=>'required'
        ]);
        $hostel_type=Input::get('hostel_type');
        $hostel_name=Input::get('hostel_name');
        $hostel_address=Input::get('hostel_address');
        $hostel_phone=Input::get('hostel_phone');
        $warden_name=Input::get('warden_name');
        $warden_address=Input::get('warden_address');
        $warden_phone=Input::get('warden_phone');
        $created_date = date('d-m-Y');
        try{
        DB::table('hostel_details')->insert(['hostel_type'=>$hostel_type,'hostel_name'=>$hostel_name,'hostel_address'=>$hostel_address,
        'hostel_phone'=>$hostel_phone,'warden_name'=>$warden_name,'warden_address'=>$warden_address,'warden_phone'=>$warden_phone,'created_date'=>$created_date,'branch_code'=>Auth::user()->school_id]);
               return redirect('hostel/details')->with([
                    'message' => 'Hostel Details Saved Successfully.'
                ]);
              }catch(\Illuminate\Database\QueryException $ex){
                return redirect('hostel/details')->with([
                    'message' => "something Went Worng.Please Try Again. Error :  ". $ex->getMessage(),
                    'message_important'=>true
                ]);

               }
  }
  public function hosteldetailsdelete(Request $request,$id){
    $self='hostel/hosteldetails/delete';
    if (\Auth::user()->user_role!=='1'){
        $get_perm=permission::permitted($self);

        if ($get_perm=='access denied'){
            return redirect('permission-error')->with([
                'message' => 'You do not have permission to view this page',
                'message_important'=>true
            ]);
        }
      }
      $request->all();
      try {
      if($id!=null){
        DB::table('hostel_details')->where('id','=',$id)->where('branch_code','=',Auth::user()->school_id)->delete();
         return redirect('hostel/details')->with([
             'message' => "Hostel Details ".$id." Deleted Successfully"
         ]);
      }else{
        return redirect('hostel/details')->with([
            'message' => "Unable to Delete Hotel Details.Please Try Again.",
            'message_important'=>true
        ]);
      }
    }catch(\Illuminate\Database\QueryException $ex){
      return redirect('hostel/details')->with([
          'message' => "something Went Worng.Please Try Again. Error :  ". $ex->getMessage(),
          'message_important'=>true
      ]);

     }
  }
  public function hosteldetailsview(Request $request){
  $id=$request->id;
  $hosteltype=DB::table('hostel_type')->where('branch_code',Auth::user()->school_id)->get();
  $hosteldetails=DB::table('hostel_details')->where('id',$id)->where('branch_code',Auth::user()->school_id)->get();
foreach ($hosteldetails as $hosteldetails) {
  // code...
    $id=$hosteldetails->id;
  $hosteltypess=$hosteldetails->hostel_type;
  $hostel_name=$hosteldetails->hostel_name;
  $hostel_address=$hosteldetails->hostel_address;
  $hostel_phone=$hosteldetails->hostel_phone;
  $warden_name=$hosteldetails->warden_name;
  $warden_address=$hosteldetails->warden_address;
  $warden_phone=$hosteldetails->warden_phone;
  }
  return view('hostel.view-hostel-details',compact('id','hosteltypess','hosteltype','hostel_name','hostel_address','hostel_phone','warden_name','warden_address','warden_phone'));
  }

  public function hosteldetailsupdate(Request $request){
    $self='hostel/hosteldetails/update';
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
          'hostel_type'=>'required',
          'hostel_name'=>'required',
          'hostel_address'=>'required',
          'hostel_phone'=>'required',
          'warden_name'=>'required',
          'warden_address'=>'required',
          'warden_phone'=>'required'
        ]);
      $id=Input::get('id');
        $hostel_type=Input::get('hostel_type');
        $hostel_name=Input::get('hostel_name');
        $hostel_address=Input::get('hostel_address');
        $hostel_phone=Input::get('hostel_phone');
        $warden_name=Input::get('warden_name');
        $warden_address=Input::get('warden_address');
        $warden_phone=Input::get('warden_phone');
        $created_date = date('d-m-Y');
        try{
        DB::table('hostel_details')->where('id',$id)->where('branch_code',Auth::user()->school_id)->update(['hostel_type'=>$hostel_type,'hostel_name'=>$hostel_name,'hostel_address'=>$hostel_address,
        'hostel_phone'=>$hostel_phone,'warden_name'=>$warden_name,'warden_address'=>$warden_address,'warden_phone'=>$warden_phone,'created_date'=>$created_date,'branch_code'=>Auth::user()->school_id]);
               return redirect('hostel/details')->with([
                    'message' => 'Hostel Details Update Successfully.'
                ]);
              }catch(\Illuminate\Database\QueryException $ex){
                return redirect('hostel/details')->with([
                    'message' => "something Went Worng.Please Try Again. Error :  ". $ex->getMessage(),
                    'message_important'=>true
                ]);

               }
  }
  public function hostelroom(){
    $self='hostel/room';
    if (\Auth::user()->user_role!=='1'){
        $get_perm=permission::permitted($self);

        if ($get_perm=='access denied'){
            return redirect('permission-error')->with([
                'message' => 'You do not have permission to view this page',
                'message_important'=>true
            ]);
        }
      }
      $room_type=DB::table('hostel_type')->where('branch_code',Auth::user()->school_id)->get();
      $rooms = DB::table('hostel_room')
            ->join('hostel_type', 'hostel_room.hosteltype', '=', 'hostel_type.id')
            ->join('hostel_details', 'hostel_room.hostelname', '=', 'hostel_details.id')
            ->select('hostel_room.*', 'hostel_details.hostel_name', 'hostel_type.hotel_type')
            ->where('hostel_room.branch_code',Auth::user()->school_id)
            ->get();
       return view('hostel.hostel-room',compact('room_type','rooms'));
  }
public function hostelname(Request $request){
  $eid = $request->eid;
//  echo $eid;exit;
  $batch = DB::table('hostel_details')->select('id','hostel_name')->where('branch_code',Auth::user()->school_id)->where('id',$eid)->get();
  //$batch=DB::table('tb_batch')->where('course',$eid)->orderBy('id','desc')->get();
 $cart = array();
  foreach($batch as $batch){
   array_push($cart,$batch);
  }
   echo json_encode($cart);
}
  public function hostelroomAdd(Request $request){
    $self='hostel/hostel/addRoom';
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
          'hostel_type'=>'required',
          'hostel_name'=>'required',
          'floor_name'=>'required',
          'room_no'=>'required',
          'no_of_bed'=>'required',
          'amount'=>'required'
        ]);
        $id=Input::get('id');
        $hostel_type=Input::get('hostel_type');
        $hostel_name=Input::get('hostel_name');
        $floor_name=Input::get('floor_name');
        $room_no=Input::get('room_no');
        $no_of_bed=Input::get('no_of_bed');
        $amount=Input::get('amount');
        $created_date = date('d-m-Y');
        try{
        DB::table('hostel_room')->insert(['hosteltype'=>$hostel_type,'hostelname'=>$hostel_name,'floor_name'=>$floor_name,
        'room_no'=>$room_no,'no_of_bed'=>$no_of_bed,'amount'=>$amount,'created_date'=>$created_date,'branch_code'=>Auth::user()->school_id]);
               return redirect('hostel/room')->with([
                    'message' => 'New Hostel Room Added Successfully.'
                ]);
              }catch(\Illuminate\Database\QueryException $ex){
                return redirect('hostel/room')->with([
                    'message' => "something Went Worng.Please Try Again. Error :  ". $ex->getMessage(),
                    'message_important'=>true
                ]);

  }
}
public function deleteroom(Request $request,$id){
  $self='hostel/hostel/deleteroom';
  if (\Auth::user()->user_role!=='1'){
      $get_perm=permission::permitted($self);

      if ($get_perm=='access denied'){
          return redirect('permission-error')->with([
              'message' => 'You do not have permission to view this page',
              'message_important'=>true
          ]);
      }
    }
    $request->all();
    try {
    if($id!=null){
      DB::table('hostel_room')->where('id','=',$id)->where('branch_code','=',Auth::user()->school_id)->delete();
       return redirect('hostel/room')->with([
           'message' => "Hostel Room ".$id." Deleted Successfully"
       ]);
    }else{
      return redirect('hostel/room')->with([
          'message' => "Unable to Delete Hotel Room.Please Try Again.",
          'message_important'=>true
      ]);
    }
  }catch(\Illuminate\Database\QueryException $ex){
    return redirect('hostel/details')->with([
        'message' => "something Went Worng.Please Try Again. Error :  ". $ex->getMessage(),
        'message_important'=>true
    ]);
}
}
public function hostelroomview(Request $request){
    $id=$request->id;
    $room_type=DB::table('hostel_type')->where('branch_code',Auth::user()->school_id)->get();
  //  $rooms=DB::table('hostel_room')->where('id',$id)->where('branch_code',Auth::user()->school_id)->get();
    $rooms = DB::table('hostel_room')
                ->join('hostel_type', 'hostel_room.hosteltype', '=', 'hostel_type.id')
                ->join('hostel_details', 'hostel_room.hostelname', '=', 'hostel_details.id')
                ->select('hostel_room.*', 'hostel_type.hotel_type', 'hostel_details.hostel_name')
                ->where('hostel_room.id',$id)->where('hostel_room.branch_code',Auth::user()->school_id)->get();

    foreach ($rooms as $rooms) {
      // code...
      $id=$rooms->id;
      $hosteltype=$rooms->hosteltype;
      $hostelname=$rooms->hostel_name;
      $floor_name=$rooms->floor_name;
      $room_no=$rooms->room_no;
      $no_of_bed=$rooms->no_of_bed;
      $amount=$rooms->amount;
    }
    return view('hostel.view-hostel-room',compact('room_type','hostelname','hosteltype','floor_name','room_no','no_of_bed','amount','id'));
}
public function hostelroomupdate(Request $request){
  $self='hostel/hostel/addRoom';
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
        'hostel_type'=>'required',
        'hostel_name'=>'required',
        'floor_name'=>'required',
        'room_no'=>'required',
        'no_of_bed'=>'required',
        'amount'=>'required'
      ]);
      $id=Input::get('id');
      $hostel_type=Input::get('hostel_type');
      $hostel_name=Input::get('hostel_name');
      $floor_name=Input::get('floor_name');
      $room_no=Input::get('room_no');
      $no_of_bed=Input::get('no_of_bed');
      $amount=Input::get('amount');
      try{
      DB::table('hostel_room')->where('id',$id)->where('branch_code',Auth::user()->school_id)->update(['hosteltype'=>$hostel_type,'hostelname'=>$hostel_name,'floor_name'=>$floor_name,
      'room_no'=>$room_no,'no_of_bed'=>$no_of_bed,'amount'=>$amount]);
             return redirect('hostel/room')->with([
                  'message' => 'Hostel Room Updated Successfully.'
              ]);
            }catch(\Illuminate\Database\QueryException $ex){
              return redirect('hostel/room')->with([
                  'message' => "something Went Worng.Please Try Again. Error :  ". $ex->getMessage(),
                  'message_important'=>true
              ]);

}

}
public function hostelnamebytype(Request $request){
  $eid = $request->eid;
  $batch = DB::table('hostel_details')->select('id','hostel_name')->where('branch_code',Auth::user()->school_id)->where('hostel_type',$eid)->get();
  //$batch=DB::table('tb_batch')->where('course',$eid)->orderBy('id','desc')->get();
 $cart = array();
  foreach($batch as $batch){
   array_push($cart,$batch);
  }
   echo json_encode($cart);
}
public function hostelroombyname(Request $request){
  $eid = $request->eid;
  $batch = DB::table('hostel_room')->select('id','floor_name','room_no')->where('branch_code',Auth::user()->school_id)->where('hostelname',$eid)->get();
  //$batch=DB::table('tb_batch')->where('course',$eid)->orderBy('id','desc')->get();
 $cart = array();
  foreach($batch as $batch){
   array_push($cart,$batch);
  }
   echo json_encode($cart);
}
public function hostelroomdetails(Request $request){
    $eid = $request->eid;
    $hosteltype = $request->hosteltype;
    $hostelname = $request->hostelname;
  //  $roomdetails = DB::table('hostel_room')->where('branch_code',Auth::user()->school_id)->where('id',$eid)->get();

    $roomdetails = DB::table('hostel_room')
            ->join('hostel_type', 'hostel_room.hosteltype', '=', 'hostel_type.id')
            ->join('hostel_details', 'hostel_room.hostelname', '=', 'hostel_details.id')
            ->select('hostel_room.*', 'hostel_type.hotel_type', 'hostel_details.hostel_name')
            ->where('hostel_room.branch_code',Auth::user()->school_id)->where('hostel_room.id',$eid)->where('hostel_room.hostelname',$hostelname)
            ->get();
    $roomcntt=DB::table('hostel_allocation')->where('branch_code',Auth::user()->school_id)->where('hostelnamee',$hostelname)->where('hostelroom',$eid)->groupBy('user_name')->get();
$roomcnt=0;
foreach ($roomcntt as $roomcntt) {
  // code...
  $roomcnt++;
}
    foreach ($roomdetails as $roomdetails) {
      // code...
      $hosteltype=$roomdetails->hotel_type;
      $hostelname=$roomdetails->hostel_name;
      $floorname=$roomdetails->floor_name;
      $room_no=$roomdetails->room_no;
      $no_of_bed=$roomdetails->no_of_bed;
      $amount=$roomdetails->amount;
    }

    echo $hosteltype."|".$roomcnt."|".$hostelname."|".$floorname."|".$room_no."|".$no_of_bed."|".$amount;
}
public function hostelstudentroomdetails(Request $request){
    $eid = $request->eid;
    $hotelallocationlist = DB::table('hostel_allocation')
            ->join('hostel_type', 'hostel_allocation.hosteltypee', '=', 'hostel_type.id')
            ->join('hostel_details', 'hostel_allocation.hostelnamee', '=', 'hostel_details.id')
            ->join('hostel_room', 'hostel_allocation.hostelroom', '=', 'hostel_room.id')
            ->select('hostel_allocation.*', 'hostel_type.hotel_type', 'hostel_details.hostel_name', 'hostel_room.room_no', 'hostel_room.floor_name')
            ->where('hostel_allocation.branch_code',Auth::user()->school_id)->where('hostel_allocation.user_name',$eid)
            ->groupBy('hostel_allocation.user_name')
            ->get();
            foreach ($hotelallocationlist as $hotelallocationlist) {
              // code...
              $hostel=$hotelallocationlist->hostel_name;
              $floor=$hotelallocationlist->floor_name;
              $roomno=$hotelallocationlist->room_no;
              $amt=$hotelallocationlist->amt;
            }
            echo $hostel."|".$floor."|".$roomno."|".$amt;
}
  public function hostelallocation(){
    $self='hostel/allocation';
    if (\Auth::user()->user_role!=='1'){
        $get_perm=permission::permitted($self);

        if ($get_perm=='access denied'){
            return redirect('permission-error')->with([
                'message' => 'You do not have permission to view this page',
                'message_important'=>true
            ]);
        }
      }
    $students=DB::table('stu_admission')->where('branch_code',Auth::user()->school_id)->get();
    $employess=DB::table('emp_details')->where('branch_code',Auth::user()->school_id)->get();
    $hosteltype=DB::table('hostel_type')->where('branch_code',Auth::user()->school_id)->get();

    $hotelallocationlist = DB::table('hostel_allocation')
            ->join('hostel_type', 'hostel_allocation.hosteltypee', '=', 'hostel_type.id')
            ->join('hostel_details', 'hostel_allocation.hostelnamee', '=', 'hostel_details.id')
            ->join('hostel_room', 'hostel_allocation.hostelroom', '=', 'hostel_room.id')
            ->select('hostel_allocation.*', 'hostel_type.hotel_type', 'hostel_details.hostel_name', 'hostel_room.room_no')
            ->groupBy('hostel_allocation.user_name')
            ->get();
    return view('hostel.hostel-allocation',compact('students','employess','hosteltype','hotelallocationlist'));
  }
  public function hostelroomsavenew(Request $request){
    $self='hostel/allocation';
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
        'utype'=>'required',
        'reg_no'=>'required',
        'emp_code'=>'required',
        'hosteltype'=>'required',
        'hostelname'=>'required',
        'hostelroom'=>'required',
        'rent_amt1'=>'required',
        'startdate'=>'required',
        'vacatdate'=>'required',
      //  'month'=>'required'
      ]);
      $utype=Input::get('utype');
      $reg_no=Input::get('reg_no');
      $emp_code=Input::get('emp_code');
      $hosteltype=Input::get('hosteltype');
      $hostelname=Input::get('hostelname');
      $hostelroom=Input::get('hostelroom');
      $rent_amt=Input::get('rent_amt1');
      $startdate=Input::get('startdate');
      $vacatdate=Input::get('vacatdate');
    //  $months=Input::get('month');
      $created_date = date('d-m-Y H:i:s');
      if($reg_no=='0'){
        $userid=$emp_code;
      }else{
        $userid=$reg_no;
      }
        try {
      //    foreach ($months as $months) {
            // code...
            $savedata=DB::table('hostel_allocation')->insert(['usertype'=>$utype,'user_name'=>$userid,
            'hosteltypee'=>$hosteltype,'hostelnamee'=>$hostelname,'hostelroom'=>$hostelroom,'amt'=>$rent_amt,
            'hostel_reg_date'=>$startdate,'hostel_vacating_date'=>$vacatdate,'months'=>null,'acadmic_year'=>app_config('Session',Auth::user()->school_id),'branch_code'=>Auth::user()->school_id,'created_date'=>$created_date]);
        //  }

      if(!empty($savedata)){
        return redirect('hostel/allocation')->with([
             'message' => 'Hostel Room Allocated Successfully for '.$userid
         ]);
      }else {
        return redirect('hostel/allocation')->with([
             'message' => 'Unable to allocate Hostel Room.Please Try Again.',
             'message_important'=>true
         ]);
      }
        }catch(\Illuminate\Database\QueryException $ex){
          return redirect('hostel/allocation')->with([
               'message' => 'Something Went Wrong. Error :- '.$ex->getMessage(),
               'message_important'=>true
           ]);
        }
  }

  public function hostelcheck(Request $request){
  $eid = $request->eid;
  $cnt=DB::table('hostel_allocation')->where('user_name',$eid)->where('acadmic_year',app_config('Session',Auth::user()->school_id))->where('branch_code',Auth::user()->school_id)->count();
  echo $cnt;
  }

  public function requestdetails(){
    $self='hostel/request/details';
    if (\Auth::user()->user_role!=='1'){
        $get_perm=permission::permitted($self);

        if ($get_perm=='access denied'){
            return redirect('permission-error')->with([
                'message' => 'You do not have permission to view this page',
                'message_important'=>true
            ]);
        }
      }
       return view('hostel.request-details');
  }
  public function hosteltransfervacate(){
    $self='hostel/transfer/vacate';
    if (\Auth::user()->user_role!=='1'){
        $get_perm=permission::permitted($self);

        if ($get_perm=='access denied'){
            return redirect('permission-error')->with([
                'message' => 'You do not have permission to view this page',
                'message_important'=>true
            ]);
        }
      }
      $students=DB::table('stu_admission')->where('branch_code',Auth::user()->school_id)->get();
      $employess=DB::table('emp_details')->where('branch_code',Auth::user()->school_id)->get();
      $hosteltype=DB::table('hostel_type')->where('branch_code',Auth::user()->school_id)->get();
       return view('hostel.hostel-transfer-vacate',compact('students','employess','hosteltype'));
  }
  public function hosteltranfer(Request $request){
    $self='hostel/allocation';
    if (\Auth::user()->user_role!=='1'){
        $get_perm=permission::permitted($self);

        if ($get_perm=='access denied'){
            return redirect('permission-error')->with([
                'message' => 'You do not have permission to view this page',
                'message_important'=>true
            ]);
        }
      }

      $utype=Input::get('utype');
      $reg_no=Input::get('reg_no');
      $emp_code=Input::get('emp_code');
      $hosteltype=Input::get('hosteltype');
      $hostelname=Input::get('hostelname');
      $hostelroom=Input::get('hostelrooms');
      $rent_amt=Input::get('rent_amt1');
      $updatetype=Input::get('updatetype');

      if($reg_no=='0'){
        $userid=$emp_code;
      }else{
        $userid=$reg_no;
      }
        try {
        if($updatetype=='vacate'){
            $savedata=DB::table('hostel_allocation')->where('branch_code',Auth::user()->school_id)->where('user_name',$userid)->update(['status'=>'0']);
      }else{
        $this->validate($request, [
            'utype'=>'required',
            'reg_no'=>'required',
            'emp_code'=>'required',
            'hosteltype'=>'required',
            'hostelname'=>'required',
            'hostelrooms'=>'required',
            'rent_amt1'=>'required',
            'updatetype'=>'required'
          ]);
        $savedata=DB::table('hostel_allocation')->where('branch_code',Auth::user()->school_id)->where('user_name',$userid)->update(['usertype'=>$utype,'user_name'=>$userid,
        'hosteltypee'=>$hosteltype,'hostelnamee'=>$hostelname,'hostelroom'=>$hostelroom,'amt'=>$rent_amt,'status'=>'1'  ]);
      }

      if(!empty($savedata)){
        return redirect('hostel/transfer/vacate')->with([
             'message' => 'Hostel Room Allocated Details Updated Successfully for '.$userid
         ]);
      }else {
        return redirect('hostel/transfer/vacate')->with([
             'message' => 'Unable to Update allocate Hostel Room.Please Try Again.',
             'message_important'=>true
         ]);
      }
        }catch(\Illuminate\Database\QueryException $ex){
          return redirect('hostel/transfer/vacate')->with([
               'message' => 'Something Went Wrong. Error :- '.$ex->getMessage(),
               'message_important'=>true
           ]);
        }
  }
  public function hostelregister(){
    $self='hostel/register';
    if (\Auth::user()->user_role!=='1'){
        $get_perm=permission::permitted($self);

        if ($get_perm=='access denied'){
            return redirect('permission-error')->with([
                'message' => 'You do not have permission to view this page',
                'message_important'=>true
            ]);
        }
      }
      $students=DB::table('stu_admission')->where('branch_code',Auth::user()->school_id)->get();
      $employess=DB::table('emp_details')->where('branch_code',Auth::user()->school_id)->get();
      $movement=DB::table('hostel_register')->where('branch_code',Auth::user()->school_id)->get();
       return view('hostel.hostel-register',compact('students','employess','movement'));
  }

  public function hostelregisterupdate(Request $request){
    $self='hostel/allocation';
    if (\Auth::user()->user_role!=='1'){
        $get_perm=permission::permitted($self);

        if ($get_perm=='access denied'){
            return redirect('permission-error')->with([
                'message' => 'You do not have permission to view this page',
                'message_important'=>true
            ]);
        }
      }
      $utype=Input::get('utype');
      $reg_no=Input::get('reg_no');
      $emp_code=Input::get('emp_code');
      $hostelname=Input::get('hostel');
      $hostelroom=Input::get('floor_room');
      $date=Input::get('startdate');
      $time=Input::get('stoptime');
      if($reg_no=='0'){
        $userid=$emp_code;
      }else{
        $userid=$reg_no;
      }
      $status=Input::get('inout');
      try{
      if($status=='Out'){
        $savedata=DB::table('hostel_register')->insert(['usertype'=>$utype,'reg_no'=>$userid,
        'hostel'=>$hostelname,'floor_room'=>$hostelroom,'in_time'=>'-','out_time'=>$time,
        'in_date'=>'-','out_date'=>$date,'status'=>$status,'branch_code'=>Auth::user()->school_id]);
        return redirect('hostel/register')->with([
             'message' => 'Student MoveOut Successfully'

         ]);
      }else{
      $outdata=DB::table('hostel_register')->select('id')->where('reg_no',$userid)->latest('id')->first();
      if(count($outdata) == 0){
        return redirect('hostel/register')->with([
             'message' => 'Student is not Out.',
             'message_important'=>true
         ]);
      }
      foreach ($outdata as $outdatas) {
      $id=$outdatas;
      }

        $savedata=DB::table('hostel_register')->where('branch_code',Auth::user()->school_id)->where('reg_no',$userid)->where('id',$id)->update([
        'in_time'=>$time,'in_date'=>$date,'status'=>$status]);
        return redirect('hostel/register')->with([
             'message' => 'Student MoveIn Successfully'

         ]);
      }
    }catch(\Illuminate\Database\QueryException $ex){
      return redirect('hostel/register')->with([
           'message' => 'Something Went Wrong',
           'message_important'=>true
       ]);
    }

  }
  public function hostelregisterdelete(Request $request,$id){
    $self='hostel/register/delete';
    if (\Auth::user()->user_role!=='1'){
        $get_perm=permission::permitted($self);

        if ($get_perm=='access denied'){
            return redirect('permission-error')->with([
                'message' => 'You do not have permission to view this page',
                'message_important'=>true
            ]);
        }
      }
      $request->all();
      try {
      if($id!=null){
        DB::table('hostel_register')->where('id','=',$id)->where('branch_code','=',Auth::user()->school_id)->delete();
         return redirect('hostel/register')->with([
             'message' => "Hostel movement Details Deleted Successfully"
         ]);
      }else{
        return redirect('hostel/register')->with([
            'message' => "Unable to Delete Hotel movement Details.Please Try Again.",
            'message_important'=>true
        ]);
      }
    }catch(\Illuminate\Database\QueryException $ex){
      return redirect('hostel/register')->with([
          'message' => "something Went Worng.Please Try Again. Error :  ". $ex->getMessage(),
          'message_important'=>true
      ]);

     }
  }

  public function hostelvisitors(){
    $self='hostel/visitors';
    if (\Auth::user()->user_role!=='1'){
        $get_perm=permission::permitted($self);

        if ($get_perm=='access denied'){
            return redirect('permission-error')->with([
                'message' => 'You do not have permission to view this page',
                'message_important'=>true
            ]);
        }
      }
      $students=DB::table('stu_admission')->where('branch_code',Auth::user()->school_id)->get();
      $employess=DB::table('emp_details')->where('branch_code',Auth::user()->school_id)->get();
      $visitor_list=DB::table('hostel_visitor')->where('branch_code',Auth::user()->school_id)->orderBy('id','desc')->get();
      return view('hostel.hostel-visitors',compact('students','employess','visitor_list'));
  }
  public function savevisitor(Request $request){
    $self='hostel/room/savevisitor';
    if (\Auth::user()->user_role!=='1'){
        $get_perm=permission::permitted($self);

        if ($get_perm=='access denied'){
            return redirect('permission-error')->with([
                'message' => 'You do not have permission to view this page',
                'message_important'=>true
            ]);
        }
      }
      $utype=Input::get('utype');
      $reg_no=Input::get('reg_no');
      $emp_code=Input::get('emp_code');
      $hostelname=Input::get('hostel');
      $hostelroom=Input::get('floor_room');
      $date=Input::get('startdate');
      $time=Input::get('stoptime');
      $visitor_name=Input::get('visitor_name');
      $relation=Input::get('relation');
      if($reg_no=='0'){
        $userid=$emp_code;
      }else{
        $userid=$reg_no;
      }
      try{
        $savedata=DB::table('hostel_visitor')->insert(['usertype'=>$utype,'student_name'=>$reg_no,
        'hostelname'=>$hostelname,'floor_room'=>$hostelroom,'vistor_name'=>$visitor_name,'relation'=>$relation,
        'datee'=>$date,'time'=>$time,'branch_code'=>Auth::user()->school_id]);
        if(!empty($savedata)){
        return redirect('hostel/visitors')->with([
             'message' => 'Visitor Recored Saved Successfully.'

         ]);
       }else{
         return redirect('hostel/visitors')->with([
              'message' => 'Unable to Save Visitor Recored.'

          ]);
       }
      }catch(\Illuminate\Database\QueryException $ex){
        return redirect('hostel/visitors')->with([
            'message' => "something Went Worng.Please Try Again. Error :  ". $ex->getMessage(),
            'message_important'=>true
        ]);

       }

  }
  public function visitorsdelete(Request $request,$id){
    $self='hostel/visitors/delete';
    if (\Auth::user()->user_role!=='1'){
        $get_perm=permission::permitted($self);

        if ($get_perm=='access denied'){
            return redirect('permission-error')->with([
                'message' => 'You do not have permission to view this page',
                'message_important'=>true
            ]);
        }
      }
      $request->all();
      try {
      if($id!=null){
        DB::table('hostel_visitor')->where('id','=',$id)->where('branch_code','=',Auth::user()->school_id)->delete();
         return redirect('hostel/visitors')->with([
             'message' => "Hostel Visitor Details Deleted Successfully"
         ]);
      }else{
        return redirect('hostel/visitors')->with([
            'message' => "Unable to Delete Hotel Visitor Details.Please Try Again.",
            'message_important'=>true
        ]);
      }
    }catch(\Illuminate\Database\QueryException $ex){
      return redirect('hostel/visitors')->with([
          'message' => "something Went Worng.Please Try Again. Error :  ". $ex->getMessage(),
          'message_important'=>true
      ]);

     }
  }
  public function hostelfeecollection(){
    $self='hostel/fee/collection';
    if (\Auth::user()->user_role!=='1'){
        $get_perm=permission::permitted($self);

        if ($get_perm=='access denied'){
            return redirect('permission-error')->with([
                'message' => 'You do not have permission to view this page',
                'message_important'=>true
            ]);
        }
      }
       return view('hostel.hostel-fee-collection');
  }
public function hosteldetailsreport(){
  $self='hostel/details/report';
  if (\Auth::user()->user_role!=='1'){
      $get_perm=permission::permitted($self);

      if ($get_perm=='access denied'){
          return redirect('permission-error')->with([
              'message' => 'You do not have permission to view this page',
              'message_important'=>true
          ]);
      }
    }
    $hostel=DB::table('hostel_details')->
    join('hostel_type','hostel_details.hostel_type','hostel_type.id')
    ->where('hostel_details.branch_code','=',Auth::user()->school_id)
    ->get();
       return view('hostel.hostel-details-report',compact('hostel'));
  }
  public function roomavailabilityreport(){
    $self='room/availability/report';
    if (\Auth::user()->user_role!=='1'){
        $get_perm=permission::permitted($self);

        if ($get_perm=='access denied'){
            return redirect('permission-error')->with([
                'message' => 'You do not have permission to view this page',
                'message_important'=>true
            ]);
        }
      }
      $hosteltype=DB::table('hostel_type')->get();
       return view('hostel.room-availability-report',compact('hosteltype'));
  }
  function hostel_allocation_info(Request $request){
     $id=$request->id;
     $sql="SELECT a.*,e.hostel_name,f.floor_name,f.room_no,b.stu_name,c.course_name,d.batch_name FROM hostel_allocation a
           INNER JOIN hostel_details e ON a.hostelnamee=e.id
           INNER JOIN hostel_room f ON a.hostelroom=f.id
           INNER JOIN stu_admission b ON a.user_name=b.reg_no
           INNER JOIN tb_course c ON b.course=c.id
           INNER JOIN tb_batch d ON b.batch=d.id
           WHERE a.id='$id'";
     $info=DB::select($sql);
     return view('hostel.hostel-allocation-info',compact('info'));
  }
  function getrommbytype(Request $request){
    $id=$request->id;
    $hostelroom=DB::table('hostel_details')->where('hostel_type',$id)->where('branch_code','=',Auth::user()->school_id)->get();
    echo $hostelroom;
  }
  function getHostelOccupancyView(Request $request){
    $hostel_type=$request->hostel_type;
    $hostelname=$request->hostelname;
    $branch_id=Auth::user()->school_id;
    $sql="SELECT a.*,b.hostel_name,c.hotel_type,
          (SELECT COUNT(*) FROM hostel_allocation x WHERE x.hosteltypee=a.hosteltype
          and x.hostelnamee=a.hostelname and x.hostelroom=a.id) AS useroom,
          (SELECT GROUP_CONCAT(d.id) from hostel_allocation d WHERE  d.hosteltypee=a.hosteltype
          and d.hostelnamee=a.hostelname and d.hostelroom=a.id GROUP BY d.hosteltypee,d.hostelnamee,d.hostelroom) AS allocateinfo
          FROM hostel_room a
          INNER JOIN hostel_details b ON a.hosteltype=b.hostel_type AND a.hostelname=b.id
          INNER JOIN hostel_type c ON b.hostel_type=c.id
          WHERE a.hosteltype='$hostel_type' AND a.hostelname='$hostelname' AND a.branch_code='$branch_id'
";
    $data=DB::select($sql);
    return view('hostel.Hostel-Occupancy-View',compact('data'));
  }
  public function roomrequestreport(){
    $self='room/request/report';
    if (\Auth::user()->user_role!=='1'){
        $get_perm=permission::permitted($self);

        if ($get_perm=='access denied'){
            return redirect('permission-error')->with([
                'message' => 'You do not have permission to view this page',
                'message_important'=>true
            ]);
        }
      }
       return view('hostel.room-request-report');
  }
  public function roomroccupancyreport(){
    $self='room/occupancy/report';
    if (\Auth::user()->user_role!=='1'){
        $get_perm=permission::permitted($self);

        if ($get_perm=='access denied'){
            return redirect('permission-error')->with([
                'message' => 'You do not have permission to view this page',
                'message_important'=>true
            ]);
        }
      }
       return view('hostel.room-occupancy-report');
  }
  public function feereports(){
    $self='hostel/fee/reports';
    if (\Auth::user()->user_role!=='1'){
        $get_perm=permission::permitted($self);

        if ($get_perm=='access denied'){
            return redirect('permission-error')->with([
                'message' => 'You do not have permission to view this page',
                'message_important'=>true
            ]);
        }
      }
       return view('hostel.fee-reports');
  }



}
?>
