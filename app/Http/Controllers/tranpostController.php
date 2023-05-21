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
use Illuminate\Support\Facades\Crypt;
date_default_timezone_set('Asia/Kolkata');
class tranpostController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
      $this->middleware('SchoolMiddleware');
  }
  public function vehicle(){
    $self='transport/vehicle';
    if (\Auth::user()->user_role!=='1'){
        $get_perm=permission::permitted($self);

        if ($get_perm=='access denied'){
            return redirect('permission-error')->with([
                'message' => 'You do not have permission to view this page.',
                'message_important'=>true
            ]);
        }
    }
     $vehicle=DB::table('tb_vehicle')->where('branch_code',Auth::user()->school_id)->get();
     return view('transport.vehicle',compact('vehicle'));
  }

  public function addvehicle(Request $request){
    $self='transport/vehicle/add';
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
        'vehicleno'=>'required|string|max:255|unique:tb_vehicle',
        'noofseats'=>'required',
        'maximumallowed'=>'required',
        'vehicletype'=>'required',
        'contactperson'=>'required',
        'trackid'=>'required',
            ]);
  $vehicleno=Input::get('vehicleno');
  $noofseats=Input::get('noofseats');
  $maximumallowed=Input::get('maximumallowed');
  $vehicletype=Input::get('vehicletype');
  $contactperson=Input::get('contactperson');
  $trackid=Input::get('trackid');
  $insurancerenewaldate=Input::get('insurancerenewaldate');
  $created_date = date('d-m-Y H:i:s');
  DB::table('tb_vehicle')->insert(['vehicleno'=>$vehicleno,'noofseats'=>$noofseats,'maximumallowed'=>$maximumallowed,
  'vehicletype'=>$vehicletype,'contactperson'=>$contactperson,'insurancerenewaldate'=>$insurancerenewaldate,'trackid'=>$trackid,'branch_code'=>Auth::user()->school_id,'created_on'=>$created_date]);
         return redirect('transport/vehicle')->with([
              'message' => 'New vehicle Added Successfully.'
          ]);
  }

  public function deletevehicle(Request $request,$id){
    $self='transport/vehicle/delete';
    if (\Auth::user()->user_role!=='1'){
        $get_perm=permission::permitted($self);

        if ($get_perm=='access denied'){
            return redirect('permission-error')->with([
                'message' => 'You do not have permission to view this page.',
                'message_important'=>true
            ]);
        }
    }
    if($id!=null){
       DB::table('tb_vehicle')->where('branch_code',Auth::user()->school_id)->where('vehicleno','=',$id)->delete();
        return redirect('transport/vehicle')->with([
            'message' => "Vehicle Details Deleted Successfully."
        ]);
    }else{
        return redirect('transport/vehicle')->with([
            'message' => "Vehicle Details Not Found",
            'message_important' => true
        ]);
    }
  }
  public function viewvehicle(Request $request,$id){
    $vechicle=DB::table('tb_vehicle')->where('vehicleno',$id)->where('branch_code',Auth::user()->school_id)->get();
    return view('transport.view-vechicle',compact('vechicle'));
  }
  public function updatevehicle(Request $request){
    $self='transport/vehicle/update';
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
        'vehicleno'=>'required|string|max:255',
        'noofseats'=>'required',
        'maximumallowed'=>'required',
        'vehicletype'=>'required',
        'contactperson'=>'required',
        'trackid'=>'required',
            ]);
  $vehicleno=Input::get('vehicleno');
  $id=Input::get('id');
  $noofseats=Input::get('noofseats');
  $maximumallowed=Input::get('maximumallowed');
  $vehicletype=Input::get('vehicletype');
  $contactperson=Input::get('contactperson');
  $trackid=Input::get('trackid');
  $insurancerenewaldate=Input::get('insurancerenewaldate');
  $created_date = date('d-m-Y H:i:s');
  DB::table('tb_vehicle')->where('branch_code',Auth::user()->school_id)->where('id','=',$id)->update(['vehicleno'=>$vehicleno,'noofseats'=>$noofseats,'maximumallowed'=>$maximumallowed,
  'vehicletype'=>$vehicletype,'contactperson'=>$contactperson,'insurancerenewaldate'=>$insurancerenewaldate,'trackid'=>$trackid,'branch_code'=>Auth::user()->school_id,'created_on'=>$created_date]);
         return redirect('transport/vehicle')->with([
              'message' => 'Vehicle Details Updated Successfully.'
          ]);
  }
  public function driver(){
    $self='transport/driver';
    if (\Auth::user()->user_role!=='1'){
        $get_perm=permission::permitted($self);

        if ($get_perm=='access denied'){
            return redirect('permission-error')->with([
                'message' => 'You do not have permission to view this page.',
                'message_important'=>true
            ]);
        }
    }
     $vehicle=DB::table('tb_vehicle')->where('branch_code',Auth::user()->school_id)->get();
     $drivers = DB::table('tb_driver')
            ->join('tb_vehicle', 'tb_driver.vehicleno', '=', 'tb_vehicle.id')
            ->select('tb_driver.*', 'tb_vehicle.vehicleno')
            ->where('tb_driver.branch_code',Auth::user()->school_id)
            ->get();
          //  print_r($drivers);
     return view('transport.driver',compact('vehicle','drivers'));
  }
  public function adddriver(Request $request){
    $self='transport/driver/add';
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
        'vehicleno'=>'required|string|max:255',
        'name'=>'required',
        'presentaddress'=>'required',

        'dob'=>'required',
        'phone'=>'required|string|max:255|unique:tb_driver',
        'licensenumber'=>'required|string|max:255|unique:tb_driver',
            ]);
  $vehicleno=Input::get('vehicleno');
  $name=Input::get('name');
  $presentaddress=Input::get('presentaddress');
  $permanentaddress=Input::get('permanentaddress');

  $dob=Input::get('dob');
  $phone=Input::get('phone');
  $licensenumber=Input::get('licensenumber');
  $created_date = date('d-m-Y H:i:s');
  DB::table('tb_driver')->insert(['vehicleno'=>$vehicleno,'name'=>$name,'presentaddress'=>$presentaddress,'permanentaddress'=>$permanentaddress,
  'dob'=>$dob,'phone'=>$phone,'licensenumber'=>$licensenumber,'branch_code'=>Auth::user()->school_id,'created_on'=>$created_date]);
         return redirect('transport/driver')->with([
              'message' => 'New Driver Added Successfully.'
          ]);
  }
  public function deletedriver(Request $request,$id){
    $self='transport/driver/delete';
    if (\Auth::user()->user_role!=='1'){
        $get_perm=permission::permitted($self);

        if ($get_perm=='access denied'){
            return redirect('permission-error')->with([
                'message' => 'You do not have permission to view this page.',
                'message_important'=>true
            ]);
        }
    }
    if($id!=null){
       DB::table('tb_driver')->where('branch_code',Auth::user()->school_id)->where('id','=',$id)->delete();
        return redirect('transport/driver')->with([
            'message' => "Driver Details Deleted Successfully."
        ]);
    }else{
        return redirect('transport/vehicle')->with([
            'message' => "Driver Details Not Found",
            'message_important' => true
        ]);
    }
  }

  public function viewdriver(Request $request,$id){
    $self='transport/driver/view';
    if (\Auth::user()->user_role!=='1'){
        $get_perm=permission::permitted($self);

        if ($get_perm=='access denied'){
            return redirect('permission-error')->with([
                'message' => 'You do not have permission to view this page.',
                'message_important'=>true
            ]);
        }
    }
     $vehicle=DB::table('tb_vehicle')->where('branch_code',Auth::user()->school_id)->get();
     $driver=DB::table('tb_driver')->where('id','=',$id)->where('branch_code',Auth::user()->school_id)->get();
      return view('transport.view-driver',compact('vehicle','driver'));
  }
  public function updatedriver(Request $request){
    $self='transport/driver/update';
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
        'vehicleno'=>'required|string|max:255',
        'name'=>'required',
        'presentaddress'=>'required',
        'dob'=>'required',
        'phone'=>'required|string|max:15',
        'licensenumber'=>'required|string|max:255',
            ]);
  $vehicleno=Input::get('vehicleno');
  $name=Input::get('name');
  $id=Input::get('id');
  $presentaddress=Input::get('presentaddress');
  $permanentaddress=Input::get('permanentaddress');

  $dob=Input::get('dob');
  $phone=Input::get('phone');
  $licensenumber=Input::get('licensenumber');
  $created_date = date('d-m-Y H:i:s');
  DB::table('tb_driver')->where('branch_code',Auth::user()->school_id)->where('id','=',$id)->update(['vehicleno'=>$vehicleno,'name'=>$name,'presentaddress'=>$presentaddress,'permanentaddress'=>$permanentaddress,
  'dob'=>$dob,'phone'=>$phone,'licensenumber'=>$licensenumber,'branch_code'=>Auth::user()->school_id,'created_on'=>$created_date]);
         return redirect('transport/driver')->with([
              'message' => 'Driver Details Updated Successfully.'
          ]);
  }
  public function route(){
    $self='transport/route';
    if (\Auth::user()->user_role!=='1'){
        $get_perm=permission::permitted($self);

        if ($get_perm=='access denied'){
            return redirect('permission-error')->with([
                'message' => 'You do not have permission to view this page.',
                'message_important'=>true
            ]);
        }
    }
    $vehicle=DB::table('tb_vehicle')->where('branch_code',Auth::user()->school_id)->get();
    $routes = DB::table('tb_route')
           ->join('tb_vehicle', 'tb_route.vehicleno', '=', 'tb_vehicle.id')
           ->select('tb_route.*', 'tb_vehicle.vehicleno')
           ->where('tb_route.branch_code',Auth::user()->school_id)
           ->get();
    return view('transport.route',compact('vehicle','routes'));
  }
  public function addroute(Request $request){
    $self='transport/route/add';
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
        'vehicleno'=>'required|string|max:255',
        'routestartplace'=>'required',
        'routecode'=>'required|string|max:255|unique:tb_route',
        'routestopplace'=>'required',
            ]);
  $vehicleno=Input::get('vehicleno');
  $routecode=Input::get('routecode');
  $routestartplace=Input::get('routestartplace');
  $routestopplace=Input::get('routestopplace');
  $created_date = date('d-m-Y H:i:s');

  DB::table('tb_route')->insert(['vehicleno'=>$vehicleno,'routecode'=>$routecode,'routestartplace'=>$routestartplace,
  'routestopplace'=>$routestopplace,'branch_code'=>Auth::user()->school_id,'created_on'=>$created_date]);
         return redirect('transport/route')->with([
              'message' => 'New Route Added Successfully.'
          ]);
  }
  public function deleteroute(Request $request,$id){
    $self='transport/route/delete';
    if (\Auth::user()->user_role!=='1'){
        $get_perm=permission::permitted($self);

        if ($get_perm=='access denied'){
            return redirect('permission-error')->with([
                'message' => 'You do not have permission to view this page.',
                'message_important'=>true
            ]);
        }
    }
    if($id!=null){
       DB::table('tb_route')->where('branch_code',Auth::user()->school_id)->where('id','=',$id)->delete();
        return redirect('transport/route')->with([
            'message' => "Route Details Deleted Successfully."
        ]);
    }else{
        return redirect('transport/route')->with([
            'message' => "Route Details Not Found",
            'message_important' => true
        ]);
    }
  }
  public function viewroute(Request $request,$id){
    $self='transport/route/view';
    if (\Auth::user()->user_role!=='1'){
        $get_perm=permission::permitted($self);

        if ($get_perm=='access denied'){
            return redirect('permission-error')->with([
                'message' => 'You do not have permission to view this page.',
                'message_important'=>true
            ]);
        }
    }
     $vehicle=DB::table('tb_vehicle')->where('branch_code',Auth::user()->school_id)->get();
     $route=DB::table('tb_route')->where('id','=',$id)->where('branch_code',Auth::user()->school_id)->get();
      return view('transport.view-route',compact('vehicle','route'));
  }

  public function routedriver(Request $request){
    $self='transport/route/update';
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
        'vehicleno'=>'required|string|max:255',
        'routestartplace'=>'required',
        'routecode'=>'required|string|max:255',
        'routestopplace'=>'required',
            ]);
  $id=Input::get('id');
  $vehicleno=Input::get('vehicleno');
  $routecode=Input::get('routecode');
  $routestartplace=Input::get('routestartplace');
  $routestopplace=Input::get('routestopplace');
  $created_date = date('d-m-Y H:i:s');

  DB::table('tb_route')->where('id','=',$id)->where('branch_code',Auth::user()->school_id)->update(['vehicleno'=>$vehicleno,'routecode'=>$routecode,'routestartplace'=>$routestartplace,
  'routestopplace'=>$routestopplace,'branch_code'=>Auth::user()->school_id,'created_on'=>$created_date]);
         return redirect('transport/route')->with([
              'message' => 'Route Updated Successfully.'
          ]);
  }
  public function designation(){
    $self='transport/destination';
    if (\Auth::user()->user_role!=='1'){
        $get_perm=permission::permitted($self);

        if ($get_perm=='access denied'){
            return redirect('permission-error')->with([
                'message' => 'You do not have permission to view this page.',
                'message_important'=>true
            ]);
        }
    }
  //  $rt=DB::table('tb_route')->where('branch_code',Auth::user()->school_id)->get();
    $routes = DB::table('tb_route')
           ->join('tb_vehicle', 'tb_route.vehicleno', '=', 'tb_vehicle.id')
           ->select('tb_route.*', 'tb_vehicle.vehicleno')
           ->where('tb_route.branch_code',Auth::user()->school_id)
           ->get();
    $destination = DB::table('tb_destination')
          ->join('tb_route', 'tb_destination.route_code', '=', 'tb_route.id')
          ->select('tb_destination.*', 'tb_route.routecode')
          ->where('tb_destination.branch_code',Auth::user()->school_id)
          ->get();
    return view('transport.destination',compact('routes','destination'));
  }
  public function adddesignation(Request $request){
    $self='transport/destination/add';
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
        'route_code'=>'required|string|max:255',
        'pickanddrop'=>'required',
        'stoptime'=>'required|string|max:255',
        'amount'=>'required',
        'month'=>'required',
            ]);
  $route_code=Input::get('route_code');
  $pickanddrop=Input::get('pickanddrop');
  $stoptime=Input::get('stoptime');
  $amount=Input::get('amount');
  $feetype=Input::get('month');
  $created_date = date('d-m-Y H:i:s');
foreach ($feetype as $feetype) {
  // code...
  DB::table('tb_destination')->insert(['route_code'=>$route_code,'pickanddrop'=>$pickanddrop,'stoptime'=>$stoptime,
  'amount'=>$amount,'months'=>$feetype,'branch_code'=>Auth::user()->school_id,'created_on'=>$created_date]);
}

         return redirect('transport/destination')->with([
              'message' => 'New Destination Added Successfully.'
          ]);

  }
  public function deletedestination(Request $request,$id){
    $self='transport/destination/delete';
    if (\Auth::user()->user_role!=='1'){
        $get_perm=permission::permitted($self);

        if ($get_perm=='access denied'){
            return redirect('permission-error')->with([
                'message' => 'You do not have permission to view this page.',
                'message_important'=>true
            ]);
        }
    }
    if($id!=null){
       DB::table('tb_destination')->where('branch_code',Auth::user()->school_id)->where('id','=',$id)->delete();
        return redirect('transport/destination')->with([
            'message' => "Destination Details Deleted Successfully."
        ]);
    }else{
        return redirect('transport/destination')->with([
            'message' => "Destination Details Not Found",
            'message_important' => true
        ]);
    }
  }

  public function viewdestination(Request $request,$id){
    $self='transport/destination/view';
    if (\Auth::user()->user_role!=='1'){
        $get_perm=permission::permitted($self);

        if ($get_perm=='access denied'){
            return redirect('permission-error')->with([
                'message' => 'You do not have permission to view this page.',
                'message_important'=>true
            ]);
        }
    }
    $routes = DB::table('tb_route')
           ->join('tb_vehicle', 'tb_route.vehicleno', '=', 'tb_vehicle.id')
           ->select('tb_route.*', 'tb_vehicle.vehicleno')
           ->where('tb_route.branch_code',Auth::user()->school_id)
           ->get();
           $destination = DB::table('tb_destination')
                 ->join('tb_route', 'tb_destination.route_code', '=', 'tb_route.id')
                 ->select('tb_destination.*', 'tb_route.routecode')
                 ->where('tb_destination.branch_code',Auth::user()->school_id)
                 ->get();
    return view('transport.view-destination',compact('routes','destination'));
  }
  public function updatedestination(Request $request){
    $self='transport/destination/update';
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
        'route_code'=>'required|string|max:255',
        'pickanddrop'=>'required',
        'stoptime'=>'required|string|max:255',
        'amount'=>'required',
        'feetype'=>'required',
            ]);
  $route_code=Input::get('route_code');
  $pickanddrop=Input::get('pickanddrop');
  $stoptime=Input::get('stoptime');
  $amount=Input::get('amount');
  $id=Input::get('id');
  $feetype=Input::get('feetype');
  $created_date = date('d-m-Y H:i:s');

  DB::table('tb_destination')->where('branch_code',Auth::user()->school_id)->where('id','=',$id)->update(['route_code'=>$route_code,'pickanddrop'=>$pickanddrop,'stoptime'=>$stoptime,
  'amount'=>$amount,'feetype'=>$feetype,'branch_code'=>Auth::user()->school_id,'created_on'=>$created_date]);
         return redirect('transport/destination')->with([
              'message' => 'Destination Updated Successfully.'
          ]);
  }

  public function transportallocationlist(){
    $self='transport/allocation/list';
    if (\Auth::user()->user_role!=='1'){
        $get_perm=permission::permitted($self);

        if ($get_perm=='access denied'){
            return redirect('permission-error')->with([
                'message' => 'You do not have permission to view this page.',
                'message_important'=>true
            ]);
        }
    }
    $allocationlist=DB::table('transport_allocation')
            ->join('tb_route', 'transport_allocation.route', '=', 'tb_route.id')
            ->select('transport_allocation.*', 'tb_route.routecode')
            ->where('tb_route.branch_code',Auth::user()->school_id)
            ->get();
    $course=DB::table('tb_course')->where('branch_code',Auth::user()->school_id)->orderBy('course_name','asc')->get();
    $route=DB::table('tb_route')->where('branch_code',Auth::user()->school_id)->get();
     return view('transport.trans-allocation-list',compact('allocationlist','course','route'));
  }
  public function studenttranportallocation(Request $request){
    $self='transport/allocation/list';
    if (\Auth::user()->user_role!=='1'){
        $get_perm=permission::permitted($self);

        if ($get_perm=='access denied'){
            return redirect('permission-error')->with([
                'message' => 'You do not have permission to view this page.',
                'message_important'=>true
            ]);
        }
    }
  //  echo Crypt::decrypt($request->id);exit;
     $transportDetails=DB::table('transport_allocation')->where('reg_no',Crypt::decrypt($request->id))->where('branch_code',Auth::user()->school_id)->get();

     foreach ($transportDetails as $transportDetails) {
       // code...
       $reg_no=$transportDetails->reg_no;
       $stu_name=$transportDetails->stu_name;
       $course=$transportDetails->course;
       $batch=$transportDetails->batch;
       $parent_name=$transportDetails->parent_name;
       $contact_no=$transportDetails->contact_no;

       $routes=$transportDetails->route;
       $destination=$transportDetails->destination;
       $status=$transportDetails->status;
       $startdate=$transportDetails->start_date;
        $enddate=$transportDetails->end_date;
     }
     $route=DB::table('tb_route')->where('branch_code',Auth::user()->school_id)->get();
     return view('transport.edit-transportallocation',compact('route','reg_no','status','startdate','enddate','stu_name','course','batch','parent_name','contact_no','routes','destination'));
  }

  public function studenttranportallocationupdate(Request $request){
    $self='transport/transport/allocate';
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
        'stu_name'=>'required',
        'reg_no'=>'required',
        'course'=>'required',
        'batch'=>'required',
        'parent_name'=>'required',
        'route'=>'required',
        'destination'=>'required',
        'start_date'=>'required',
        'end_date'=>'required',
        'contact_no'=>'required']);
    $stu_name=Input::get('stu_name');
    $reg_no=Input::get('reg_no');
    $course=Input::get('course');
    $batch=Input::get('batch');
    $parent_name=Input::get('parent_name');
    $contact_no=Input::get('contact_no');
    $route=Input::get('route');
    $destination=Input::get('destination');
    $start_date=Input::get('start_date');
    $end_date=Input::get('end_date');
    $status=Input::get('status');

      try {
   DB::table('transport_allocation')->where('reg_no',$reg_no)->where('branch_code',Auth::user()->school_id)
   ->update(['status'=>$status,'route'=>$route,'destination'=>$destination,'start_date'=>$start_date,'end_date'=>$end_date]);

    return redirect('transport/allocation/list')->with([
         'message' => 'Tranport Allocated for '.$stu_name. ' Updated Successfully'
 ]);

    }catch(\Illuminate\Database\QueryException $ex){
      return redirect('transport/allocation/list')->with([
           'message' => 'Someting Went Worng Please Contact Technical Team : '.$ex->getMessage(). '',
           'message_important'=>true
       ]);

   }
  }

}
?>
