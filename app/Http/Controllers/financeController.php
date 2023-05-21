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
use App\institute_details;
use Illuminate\Support\Facades\Crypt;
use PDF;
date_default_timezone_set('Asia/Kolkata');
class financeController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
    //  $this->middleware('SchoolMiddleware');
  }


function dailyCashRegisterDaySearch(Request $request)
  {
  $date=Input::get('day');
  $academic_year=DB::table('academicyear')->orderBy('startyear','desc')->get();
  $fee_category=DB::table('fee_category')->orderBy('fee_category','asc')->get();
  $sql = "SELECT a.acadmic_year,a.fee_head,SUM(a.final_amt) AS head_total,a.created_date FROM fee_collection a
  WHERE a.created_date='$date' AND a.receipt_status=1
  GROUP BY a.fee_head,a.acadmic_year";
  $fee_detailsdays = DB::select($sql);
  $tab=2;
  return view('finance.fee.dailyCashRegister',compact('academic_year','fee_category','fee_detailsdays','tab'));
  } 
function dailyCashRegisterSearch(Request $request){
  $date=Input::get('date');
  $feehead=Input::get('feehead');
  $session=Input::get('session');
  $tab=1;
  $data=array(
    "fee_collection.fee_head"=>$feehead,
    "fee_collection.acadmic_year"=>$session,
    "fee_collection.created_date"=>$date,
    "fee_collection.receipt_status"=>1
  );
  $fee_detailsdays=array();
//  print_r(array_filter($data));
  $fee_details=DB::table('fee_collection')->
  join('tb_course','fee_collection.class','tb_course.id')
  ->where(array_filter($data))->get();
//  print_r($fee_details);
$academic_year=DB::table('academicyear')->orderBy('startyear','desc')->get();
$fee_category=DB::table('fee_category')->orderBy('fee_category','asc')->get();
return view('finance.fee.dailyCashRegister',compact('academic_year','fee_category','fee_details','tab','fee_detailsdays'));
}
function dailyCashRegister(){
  $academic_year=DB::table('academicyear')->orderBy('startyear','desc')->get();
  $fee_category=DB::table('fee_category')->orderBy('fee_category','asc')->get();
  $fee_details=array();
  $tab=1;
  return view('finance.fee.dailyCashRegister',compact('academic_year','fee_category','tab'));
}

	
function individualFeeReportSearch(Request $request){
  $stu_id=Input::get('stu_id');
  $collection_type=Input::get('collection_type');
  $status=Input::get('status');
  $whereArray=array(
    "stu_reg_no"=>$stu_id,
    "pay_mode"=>$collection_type,
    "receipt_status"=>$status
  );
  $whereArraysum=array(
    "stu_reg_no"=>$stu_id,
    "receipt_status"=>1
  );
//  print_r(array_filter($whereArray));
  $stulist=DB::table('stu_admission')->where('branch_code',Auth::user()->school_id)->groupBy('reg_no')->get();

  $feeslist = DB::table('fee_collection')
  ->join('tb_course', 'fee_collection.class', '=', 'tb_course.id')
  ->join('tb_batch', 'fee_collection.section', '=', 'tb_batch.id')
  ->where('fee_collection.branch_code',Auth::user()->school_id)
  ->where(array_filter($whereArray))
  ->select(DB::raw('fee_collection.stu_reg_no,fee_collection.stu_name,fee_collection.fee_head,fee_collection.month,fee_collection.receipt_status, SUM(fee_collection.amt) as totamount,SUM(fee_collection.dueamt) as dueamt,SUM(fee_collection.discount) as discount,fee_collection.pay_mode, GROUP_CONCAT( DISTINCT MONTH) AS month,fee_collection.year,fee_collection.created_date,fee_collection.receipt_no'), 'tb_course.course_name', 'tb_batch.batch_name')
  ->orderby('fee_collection.receipt_no','desc')
  ->groupBy('fee_collection.receipt_no')
  ->get();

  $feessum = DB::table('fee_collection')
  ->join('tb_course', 'fee_collection.class', '=', 'tb_course.id')
  ->join('tb_batch', 'fee_collection.section', '=', 'tb_batch.id')
  ->where('fee_collection.branch_code',Auth::user()->school_id)
  ->where(array_filter($whereArraysum))
  ->select(DB::raw('SUM(fee_collection.amt) as totamount'))
  ->orderby('fee_collection.receipt_no','desc')
  //->groupBy('fee_collection.receipt_no')
  ->get();

  //print_r($feessum[0]->totamount);exit;
  return view('finance.fee.individualFeeReport',compact('stulist','feeslist','feessum'));
}

function individualFeeReport(){
  $stulist=DB::table('stu_admission')->where('branch_code',Auth::user()->school_id)->groupBy('reg_no')->get();
  $feeslist=array();
  $feessum=array();
  return view('finance.fee.individualFeeReport',compact('stulist','feeslist','feessum'));

}
	
  public function feecategory(){
    $self='finance/Fee-Category';
    if (\Auth::user()->user_role!=='1'){
        $get_perm=permission::permitted($self);

        if ($get_perm=='access denied'){
            return redirect('permission-error')->with([
                'message' => 'You do not have permission to view this page.',
                'message_important'=>true
            ]);
        }
    }
     $fee_category=DB::table('fee_category')->where('branch_code',Auth::user()->school_id)->get();
     return view('finance.fee.fee-category',compact('fee_category'));
  }

  public function addfeecategory(Request $request){
    $this->validate($request, [
      //  'fee_category'=>'required|string|max:255|unique:fee_category',
      //  'fee_category' => 'required|unique:fee_category,fee_category',
      'fee_category' => 'required|unique:fee_category,branch_code,NULL,NULL,fee_category,NULL',
      //  'receipt_prefix' => 'required|unique:fee_category,branch_code',
        'receipt_prefix'=>'required|string|max:255|unique:fee_category,branch_code',
      ]);
  $fee_category=Input::get('fee_category');
  $receipt_prefix=Input::get('receipt_prefix');
  $description=Input::get('description');
  $created_date = date('d-m-Y H:i:s');
  DB::table('fee_category')->insert(['fee_category'=>$fee_category,'receipt_prefix'=>$receipt_prefix,'discription'=>$description,'branch_code'=>Auth::user()->school_id,'created_date'=>$created_date]);
         return redirect('finance/Fee-Category')->with([
              'message' => 'New Fee Category Added Successfully'
          ]);
  }

  public function feesubcategory(){
    $self='finance/Fee-SubCategory';
    if (\Auth::user()->user_role!=='1'){
        $get_perm=permission::permitted($self);

        if ($get_perm=='access denied'){
            return redirect('permission-error')->with([
                'message' => 'You do not have permission to view this page.',
                'message_important'=>true
            ]);
        }
    }
     $fee_category=DB::table('fee_category')->where('branch_code',Auth::user()->school_id)->get();
    // $fee_subcategory=DB::table('fee_subcategory')->where('branch_code',Auth::user()->school_id)->get();
     $fee_subcategory=DB::table('fee_subcategory')
                 ->join('fee_category', 'fee_subcategory.fee_category', '=', 'fee_category.id')
                 ->select('fee_subcategory.*', 'fee_category.fee_category')
                 ->get();
     return view('finance.fee.fee-SubCategory',compact('fee_category','fee_subcategory'));
  }
  public function addfeesubcategory(Request $request){
    $this->validate($request, [
        'fee_category'=>'required',
        'sub_category'=>'required',
        'fee_type'=>'required',
      ]);
      $fee_category=Input::get('fee_category');
      $sub_category=Input::get('sub_category');
      $fee_type=Input::get('fee_type');
      $fee_dates_start=Input::get('dobstart');
      $fee_dates_dues=Input::get('dobdue');
      $fee_dates_ends=Input::get('dobend');
      $created_date = date('d-m-Y H:i:s');
     DB::table('fee_subcategory')->insert(['fee_category'=>$fee_category,'sub_category'=>$sub_category,'fee_type'=>$fee_type,'branch_code'=>Auth::user()->school_id,'created_date'=>$created_date]);

          /*    $feedates=array();
              foreach ($fee_dates_start as $fee_dates_start) {
                DB::table('fee_dates')->insert(['fee_subcategory'=>$sub_category,'fee_type'=>$fee_type,'start_date'=>$fee_dates_start,'due_date'=>'','end_date'=>'']);

              }
              foreach ($fee_dates_dues as $fee_dates_due) {
                DB::table('fee_dates')
                ->where('fee_subcategory',$sub_category)->where('fee_type',$fee_type)
                ->update(['due_date' => $fee_dates_due]);
              }
              foreach ($fee_dates_ends as $fee_dates_end) {
            //  array_push($feedates,$fee_dates_end);
            DB::table('fee_dates')
            ->where('fee_subcategory',$sub_category)->where('fee_type',$fee_type)
            ->update(['end_date' => $fee_dates_end]);
          }*/
              return redirect('finance/Fee-SubCategory')->with([
                   'message' => 'New Fee Sub Category Added Successfully'
               ]);

  }
  public function feesubcategoryfine(){
    $self='finance/Fee-SubCategory/fine';
    if (\Auth::user()->user_role!=='1'){
        $get_perm=permission::permitted($self);

        if ($get_perm=='access denied'){
            return redirect('permission-error')->with([
                'message' => 'You do not have permission to view this page.',
                'message_important'=>true
            ]);
        }
    }
    $fee_category=DB::table('fee_category')->where('branch_code',Auth::user()->school_id)->get();
   // $fee_subcategory=DB::table('fee_subcategory')->where('branch_code',Auth::user()->school_id)->get();
  /*  $fee_subcategory=DB::table('subcategory_fine')
                ->join('fee_subcategory', 'fee_subcategory.id', '=', 'subcategory_fine.fee_subcategory')
                ->select('subcategory_fine.*', 'fee_subcategory.sub_category')
                ->where('subcategory_fine.branch_code',Auth::user()->school_id)
                ->get(); */
    $sql="SELECT a.*,b.sub_category,c.fee_category AS fee_category_name,GROUP_CONCAT(monthname(STR_TO_DATE(a.fine_months,'%m')) ORDER BY a.fine_months ASC) AS months from subcategory_fine a
          INNER JOIN fee_subcategory b ON a.fee_subcategory=b.id
          INNER JOIN fee_category c ON a.fee_category=c.id
          GROUP BY a.fee_category,b.sub_category";
    $fee_subcategory=DB::select($sql);

    return view('finance.fee.fee-SubCategory-fine',compact('fee_category','fee_subcategory'));
  }

  public function getfeesubcategory(request $request){
    $eid = $request->eid;
    $batch = DB::table('fee_subcategory')->select('id','sub_category')->where('branch_code',Auth::user()->school_id)->where('fee_category',$eid)->orderBy('id','desc')->get();
    //$batch=DB::table('tb_batch')->where('course',$eid)->orderBy('id','desc')->get();
   $cart = array();
    foreach($batch as $batch){
     array_push($cart,$batch);
    }
     echo json_encode($cart);
  }
  public function addfeesubcategoryfine(request $request){
    $this->validate($request, [
      'fee_category'=>'required|string|max:255',
      'fee_subcategory'=>'required|string|max:255|unique:subcategory_fine',
      'type'=>'required',
      'fine_amt'=>'required',
      'fine_type'=>'required',
      'finedate'=>'required',
      'month'=>'required',
      ]);
  $fee_category=Input::get('fee_category');
  $fee_subcategory=Input::get('fee_subcategory');
  $type=Input::get('type');
  $fine_amt=Input::get('fine_amt');
  $fine_type=Input::get('fine_type');
  $fineincrementin=Input::get('fineincrementin');
  $days=Input::get('days');
  $maxfinepercent=Input::get('maxfinepercent');
  $month=Input::get('month');
  $finedate=Input::get('finedate');
  $created_date = date('d-m-Y H:i:s');
  foreach ($month as $month) {
    // code...
  $savedata= DB::table('subcategory_fine')->insert(['fee_category'=>$fee_category,'fee_subcategory'=>$fee_subcategory,'type'=>$type,'fine_amt'=>$fine_amt,'fine_type'=>$fine_type,'fine_date'=>$finedate,'fine_months'=>$month,'incrementin'=>$fineincrementin,'days'=>$days,'maxfineAmt'=>$maxfinepercent,'branch_code'=>Auth::user()->school_id,'created_date'=>$created_date]);


  }
  //exit;
//  DB::table('subcategory_fine')->insert(['fee_category'=>$fee_category,'fee_subcategory'=>$fee_subcategory,'type'=>$type,'fine_amt'=>$fine_amt,'fine_type'=>$fine_type,'incrementin'=>$fineincrementin,'days'=>$days,'maxfineAmt'=>$maxfinepercent,'branch_code'=>Auth::user()->school_id,'created_date'=>$created_date]);
if($savedata!=""){
         return redirect('finance/Fee-SubCategory/fine')->with([
              'message' => 'New Fee Sub Category Fine Added Successfully'
          ]);
        }else{
          return redirect('finance/Fee-SubCategory/fine')->with([
               'message' => 'Unable to add Fee Sub Category Fine.Please try Again.',
               'message_important'=>true
           ]);
        }
  }
  public function feecollecion(){
  /*  $self='finance/Fee-SubCategory/fine';
    if (\Auth::user()->user_role!=='1'){
        $get_perm=permission::permitted($self);

        if ($get_perm=='access denied'){
            return redirect('permission-error')->with([
                'message' => 'You do not have permission to view this page.',
                'message_important'=>true
            ]);
        }
    }
*/

      $fee_name = DB::table('fee_subcategory')
            ->join('fee_category', 'fee_subcategory.fee_category', '=', 'fee_category.id')
            ->join('subcategory_fine', 'fee_subcategory.id', '=', 'subcategory_fine.fee_subcategory')
            ->select('fee_subcategory.*', 'subcategory_fine.*','fee_category.fee_category')
            ->where('fee_subcategory.branch_code',Auth::user()->school_id)
            ->get();
            if(version_compare(PHP_VERSION, '7.2.0', '>=')) {
                error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
            }
            $receipt_no=DB::table('fee_collection')->latest('id')->where('branch_code',Auth::user()->school_id)->first();
            if(count($receipt_no) > 0){
              $receipt_no=$receipt_no->receipt_no+1;
            }else{
              $receipt_no=1;
            }
          //  echo $receipt_no->receipt_no;exit;
    $acadmic_year=DB::table('academicyear')->orderBy('startyear','desc')->get();
    $students=DB::table('stu_admission')->where('branch_code',Auth::user()->school_id)->orderBy('id','desc')->get();
    $route=DB::table('tb_route')->where('branch_code',Auth::user()->school_id)->orderBy('id','desc')->get();
      return view('finance.fee.fee-collection',compact('students','route','fee_name','receipt_no','acadmic_year'));
  }

  public function update_status_fee_master(Request $request,$status,$id){
      $self='finance/Fee-master/update';
      if (\Auth::user()->user_role!=='1'){
          $get_perm=permission::permitted($self);

          if ($get_perm=='access denied'){
              return redirect('permission-error')->with([
                  'message' => 'You do not have permission to view this page.',
                  'message_important'=>true
              ]);
          }
      }
    //  echo $status; exit;
    if($status==0){
      $status=1;
    }else{
      $status=0;
    }
    if($id!=null){
       DB::table('fee_master')->where('id','=',Crypt::decrypt($id))->update(["status"=>$status]);
        return redirect('finance/Fee-master')->with([
            'message' => "Fee Master Status Updated Successfully."
        ]);
    }else{
        return redirect('finance/Fee-master')->with([
            'message' => "Fee Master Details Not Found",
            'message_important' => true
        ]);
    }
    }

    function update_status_fee_waiver($status,$id){
      $self='finance/Fee-waiver/update-Status';
      if (\Auth::user()->user_role!=='1'){
          $get_perm=permission::permitted($self);

          if ($get_perm=='access denied'){
              return redirect('permission-error')->with([
                  'message' => 'You do not have permission to view this page.',
                  'message_important'=>true
              ]);
          }
      }
    //  echo $status; exit;
    if($status==0){
      $status=1;
    }else{
      $status=0;
    }
    if($id!=null){
       DB::table('fee_waiver')->where('id','=',Crypt::decrypt($id))->update(["status"=>$status]);
        return redirect('finance/fee/waiver')->with([
            'message' => "Fee waiver Status Updated Successfully."
        ]);
    }else{
        return redirect('finance/fee/waiver')->with([
            'message' => "Fee waiver Details Not Found",
            'message_important' => true
        ]);
    }
    }
    public function updatefeemaster(Request $request){
      $self='finance/Fee-master';
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
        'feecategory'=>'required',
        'fee_subcategory'=>'required',
        'month'=>'required',
        'course'=>'required',
        'amount'=>'required',
        ]);
        $feecategory=Input::get('feecategory');
        $fee_subcategory=Input::get('fee_subcategory');
        $month=Input::get('month');
        $course=Input::get('course');
        $amount=Input::get('amount');
        $id=Input::get('id');

          // code...
          DB::table('fee_master')->where('id',$id)->update(['feecategory'=>$feecategory,'fee_subcategory'=>$fee_subcategory,'month'=>$month,'course'=>$course,'amount'=>$amount,'branch_code'=>Auth::user()->school_id]);



      return redirect('finance/Fee-master')->with([
           'message' => 'Fee Master Updated Successfully'
       ]);
    }
    function viewfeemaster($id){
      $fee_category=DB::table('fee_category')->where('status',1)->where('branch_code',Auth::user()->school_id)->get();
     // $fee_subcategory=DB::table('fee_subcategory')->where('branch_code',Auth::user()->school_id)->get();
      $course=DB::table('tb_course')->where('branch_code',Auth::user()->school_id)->get();
      $fee_subcategory=DB::table('fee_subcategory')
                  ->join('fee_category', 'fee_subcategory.fee_category', '=', 'fee_category.id')
                  ->select('fee_subcategory.*', 'fee_category.fee_category')
                  ->where('fee_subcategory.status',1)
                  ->where('fee_category.branch_code',Auth::user()->school_id)
                  ->get();
      $data=DB::table('fee_master')->where('id','=',Crypt::decrypt($id))->first();
      return view('finance.fee.fee-master-view',compact('data','fee_category','course','fee_subcategory'));

    }

  public function feemaster(){
    $self='finance/Fee-SubCategory';
    if (\Auth::user()->user_role!=='1'){
        $get_perm=permission::permitted($self);

        if ($get_perm=='access denied'){
            return redirect('permission-error')->with([
                'message' => 'You do not have permission to view this page.',
                'message_important'=>true
            ]);
        }
    }
     $fee_category=DB::table('fee_category')->where('branch_code',Auth::user()->school_id)->get();
    // $fee_subcategory=DB::table('fee_subcategory')->where('branch_code',Auth::user()->school_id)->get();
     $course=DB::table('tb_course')->where('branch_code',Auth::user()->school_id)->get();
     $fee_subcategory=DB::table('fee_subcategory')
                 ->join('fee_category', 'fee_subcategory.fee_category', '=', 'fee_category.id')
                 ->select('fee_subcategory.*', 'fee_category.fee_category')
                 ->where('fee_category.branch_code',Auth::user()->school_id)
                 ->get();
      $fee_master=DB::table('fee_master')
      ->join('fee_category', 'fee_master.feecategory', '=', 'fee_category.id')
      ->join('fee_subcategory', 'fee_master.fee_subcategory', '=', 'fee_subcategory.id')
      ->join('tb_course', 'fee_master.course', '=', 'tb_course.id')
      ->select('fee_master.*', 'fee_category.fee_category','fee_subcategory.sub_category','tb_course.course_name')
      ->where('fee_category.branch_code',Auth::user()->school_id)
      ->get();


     return view('finance.fee.fee-master',compact('fee_category','fee_subcategory','course','fee_master'));
  }

  public function addfeemaster(Request $request){
    $self='finance/Fee-master';
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
      'feecategory'=>'required|string|max:255',
      'fee_subcategory'=>'required',
      'month'=>'required',
      'course'=>'required',
      'amount'=>'required',
      ]);
      $feecategory=Input::get('feecategory');
      $fee_subcategory=Input::get('fee_subcategory');
      $month=Input::get('month');
      $course=Input::get('course');
      $amount=Input::get('amount');
      $created_date = date('d-m-Y H:i:s');

      foreach ($month as $month) {
        // code...
        DB::table('fee_master')->insert(['feecategory'=>$feecategory,'fee_subcategory'=>$fee_subcategory,'month'=>$month,'course'=>$course,'amount'=>$amount,'branch_code'=>Auth::user()->school_id,'created_date'=>$created_date]);

      }

    return redirect('finance/Fee-master')->with([
         'message' => 'New Fee Master Added for '.$course. ' Successfully'
     ]);
  }
public function deletefeemaster(Request $request,$id){
  $self='finance/account/account-group/delete';
  if (\Auth::user()->user_role!=='1'){
      $get_perm=permission::permitted($self);

      if ($get_perm=='access denied'){
          return redirect('permission-error')->with([
              'message' => 'You do not have permission to view this page.',
              'message_important'=>true
          ]);
      }
  }
  try{
  if($id!=null){
     DB::table('fee_master')->where('branch_code',Auth::user()->school_id)->where('id','=',$id)->delete();
      return redirect('finance/Fee-master')->with([
          'message' => "Fee Master Details Deleted Successfully."
      ]);
  }else{
      return redirect('finance/Fee-master')->with([
          'message' => "Fee Master Details Not Found",
          'message_important' => true
      ]);
  }
}catch(\Illuminate\Database\QueryException $ex){
  return redirect('finance/Fee-master')->with([
       'message' => 'Someting Went Worng Please Contact Technical Team : '.$ex->getMessage(). '',
       'message_important'=>true
   ]);

}
}
	
		public function feehistoryByStudents(request $request){
$eid = Crypt::decrypt($request->reg_no);
$data=DB::table('fee_collection')
->Leftjoin('pg_trans','fee_collection.receipt_no','pg_trans.order_id')
->where('fee_collection.stu_reg_no',$eid)
//  ->select('sum(amount) as amount','fee_head','fee_category')
->select(DB::raw('fee_collection.receipt_no,GROUP_CONCAT(CONCAT_WS("|",fee_collection.fee_category,fee_collection.final_amt,fee_collection.month,fee_collection.year,fee_collection.receipt_status)  ORDER BY fee_collection.month,fee_collection.year)
 AS fees,fee_collection.acadmic_year,
SUM(fee_collection.final_amt) AS sum_amt,if(fee_collection.receipt_status=1,"Success","Fail") AS receipt_status,fee_collection.pay_mode,fee_collection.collected_by,
if(fee_collection.pay_mode LIKE "online",pg_trans.bank_ref_no,"NA") AS bank_ref_no'))
->groupBy('fee_collection.receipt_no')
->orderBy('fee_collection.receipt_no','desc')->get();
return view('finance.fee.feehistoryByStudents',compact('data'));
}
	
/*	public function feehistoryByStudents(request $request){
$eid = Crypt::decrypt($request->reg_no);
$data=DB::table('fee_collection')
->Leftjoin('pg_trans','fee_collection.receipt_no','pg_trans.order_id')
->where('fee_collection.stu_reg_no',$eid)
//  ->select('sum(amount) as amount','fee_head','fee_category')
->select(DB::raw('fee_collection.receipt_no,GROUP_CONCAT(CONCAT_WS("|",fee_collection.fee_category,fee_collection.final_amt,fee_collection.month,fee_collection.year)  ORDER BY fee_collection.month,fee_collection.year,fee_collection.receipt_status)
 AS fees,fee_collection.acadmic_year,
SUM(fee_collection.final_amt) AS sum_amt,if(fee_collection.receipt_status=1,"Success","Fail") AS receipt_status,fee_collection.pay_mode,fee_collection.collected_by,
if(fee_collection.pay_mode LIKE "online",pg_trans.bank_ref_no,"NA") AS bank_ref_no'))
->groupBy('fee_collection.receipt_no')
->orderBy('fee_collection.receipt_no','desc')->get();
return view('finance.fee.feehistoryByStudents',compact('data'));
} */
	
	
public function stuinfo(request $request){
  $eid = Crypt::decrypt($request->eid);
  $acadmic_year =$request->acadmic_year;
  $ac_year=explode("-",$acadmic_year);
  $from=$ac_year[0];
  $to=$ac_year[1];
  $studentss = DB::table('stu_admission')
            ->join('stu_contact', 'stu_admission.reg_no', '=', 'stu_contact.reg_no')
          #  ->join('tb_batch', 'stu_admission.batch', '=', 'tb_batch.id')
            ->join('tb_course', 'stu_admission.course', '=', 'tb_course.id')
            ->select('stu_admission.*', 'stu_contact.*'/*,'tb_batch.batch_name'*/,'tb_course.course_name')
            ->where('stu_admission.branch_code',Auth::user()->school_id)
    //        ->where('stu_admission.accdmic_year',$acadmic_year)
            ->where('stu_admission.reg_no',$eid)
            ->get();
  //       print_r($studentss);exit;
  $cnt=DB::table('transport_allocation')->where('branch_code',Auth::user()->school_id)
  ->where('reg_no',$eid)->count();
            $currentyear= date("Y");
  $feemonths=$users = DB::table('fee_collection')->select('month')
  ->where('stu_reg_no',$eid)
  //->where('year',$currentyear)
  ->where('year',$to)
  ->where('receipt_status','1')
  //->where('acadmic_year',app_config('Session',Auth::user()->school_id))
  ->where('acadmic_year',$acadmic_year)
  ->where('branch_code',Auth::user()->school_id)
  ->get();
  foreach($studentss as $studentss){
    $fname=$studentss->stu_name;
    $name=$fname;
    $batch="NA";//$studentss->batch_name;
    $batch_code=$studentss->batch;
    $course_name=$studentss->course_name;
    $course_code=$studentss->course;
    $father=$studentss->father_name;
    $contact=$studentss->father_phone;
    $address=$studentss->present_address;
    $joining_date=$studentss->joining_date;
  }

  $sql = "SELECT SUM(a.amount) AS amount,a.fee_head,a.fee_category FROM fee_due a
          WHERE a.`status`=0 AND a.stu_reg_no='$eid'
          GROUP BY a.fee_receipt_id";
//  $duefee = DB::select($sql);
  $duefee=DB::table('fee_due')->where('stu_reg_no',$eid)->where('status','0')
  ->select('sum(amount) as amount','fee_head','fee_category')
  ->select('*',DB::raw('SUM(amount) AS tot_amount'))
  ->groupBy('fee_receipt_id')

  ->get();
  //print_r($feecategory);exit;
//    print_r($duefee);
	
	  $last_fee=DB::table('fee_collection')->where('stu_reg_no',$eid)->where('receipt_status','1')
//  ->select('sum(amount) as amount','fee_head','fee_category')
  ->select(DB::raw('receipt_no,SUM(final_amt) AS tot_amount,GROUP_CONCAT(DISTINCT month order by month) AS months'))
  ->groupBy('receipt_no')
  ->orderBy('receipt_no','desc')->limit(1)->get();
	
  echo $eid."|".$name."|".$batch."|".$course_name."|".$father."|".$contact."|".$address."|".$feemonths."|".$course_code."|".$cnt."|".$batch_code."|".$duefee."|".$joining_date."|".$last_fee;
}
/* 20-01-2021 public function stuinfo(request $request){
  $eid = Crypt::decrypt($request->eid);
  $acadmic_year =$request->acadmic_year;
  $studentss = DB::table('stu_admission')
            ->join('stu_contact', 'stu_admission.reg_no', '=', 'stu_contact.reg_no')
            ->join('tb_batch', 'stu_admission.batch', '=', 'tb_batch.id')
            ->join('tb_course', 'stu_admission.course', '=', 'tb_course.id')
            ->select('stu_admission.*', 'stu_contact.*','tb_batch.batch_name','tb_course.course_name')
            ->where('stu_admission.branch_code',Auth::user()->school_id)
            ->where('stu_admission.accdmic_year',$acadmic_year)
            ->where('stu_admission.reg_no',$eid)
            ->get();
        //   print_r($studentss);exit;
  $cnt=DB::table('transport_allocation')->where('branch_code',Auth::user()->school_id)
  ->where('reg_no',$eid)->count();
            $currentyear= date("Y");
  $feemonths=$users = DB::table('fee_collection')->select('month')
  ->where('stu_reg_no',$eid)
  ->where('year',$currentyear)
  ->where('receipt_status','1')
  ->where('acadmic_year',app_config('Session',Auth::user()->school_id))
  ->where('branch_code',Auth::user()->school_id)
  ->get();
  foreach($studentss as $studentss){
    $fname=$studentss->stu_name;
    $name=$fname;
    $batch=$studentss->batch_name;
    $batch_code=$studentss->batch;
    $course_name=$studentss->course_name;
    $course_code=$studentss->course;
    $father=$studentss->father_name;
    $contact=$studentss->father_phone;
    $address=$studentss->present_address;
    $joining_date=$studentss->joining_date;
  }

  $sql = "SELECT SUM(a.amount) AS amount,a.fee_head,a.fee_category FROM fee_due a
          WHERE a.`status`=0 AND a.stu_reg_no='$eid'
          GROUP BY a.fee_receipt_id";
//  $duefee = DB::select($sql);
  $duefee=DB::table('fee_due')->where('stu_reg_no',$eid)->where('status','0')
  ->select('sum(amount) as amount','fee_head','fee_category')
  ->select('*',DB::raw('SUM(amount) AS tot_amount'))
  ->groupBy('fee_receipt_id')

  ->get();
  //print_r($feecategory);exit;
//    print_r($duefee);
  echo $eid."|".$name."|".$batch."|".$course_name."|".$father."|".$contact."|".$address."|".$feemonths."|".$course_code."|".$cnt."|".$batch_code."|".$duefee."|".$joining_date;
}*/
function getfeehead(){
  $feecategory=DB::table('fee_category')->where('status',1)->get();
  echo $feecategory;
}

  public function getStudentfeeDetails(Request $request){
    if(version_compare(PHP_VERSION, '7.2.0', '>=')) {
      error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
    }
    $eid = $request->eid;
    $course = $request->course;
    $reg_no=$request->reg_no;
    //$fee=array();
    try {

      $feedue=DB::table('fee_due')
                ->where('fee_due.status','0')
                ->where('fee_due.stu_reg_no',$reg_no)
              //  ->where('fee_collection.dueamt','>','0')
              //  ->where('tb_destination.months',$eid)
                ->get();

     $transportfees = DB::table('transport_allocation')
               ->join('tb_destination', 'transport_allocation.destination', '=', 'tb_destination.pickanddrop')
               ->select('transport_allocation.*','tb_destination.*')
               ->where('transport_allocation.branch_code',Auth::user()->school_id)
               ->where('transport_allocation.status','1')
               ->where('transport_allocation.reg_no',$reg_no)
               ->where('tb_destination.months',$eid)
               ->get();
    $hostelfee = DB::table('hostel_allocation')
           ->join('hostel_type', 'hostel_allocation.hosteltypee', '=', 'hostel_type.id')
           ->join('hostel_details', 'hostel_allocation.hostelnamee', '=', 'hostel_details.id')
           ->join('hostel_room', 'hostel_allocation.hostelroom', '=', 'hostel_room.id')
           ->select('hostel_allocation.*', 'hostel_type.hotel_type', 'hostel_details.hostel_name', 'hostel_room.room_no')
           ->where('hostel_allocation.branch_code',Auth::user()->school_id)
           ->where('hostel_allocation.user_name',$reg_no)
            ->where('hostel_allocation.months',$eid)
           ->get();


    $fees = DB::table('fee_master')
              ->join('fee_category', 'fee_master.feecategory', '=', 'fee_category.id')
              ->join('fee_subcategory', 'fee_master.fee_subcategory', '=', 'fee_subcategory.id')
              ->select('fee_master.*', 'fee_category.fee_category','fee_subcategory.sub_category')
              ->where('fee_master.branch_code',Auth::user()->school_id)
              ->where('fee_master.course',$course)
              ->where('fee_master.month',$eid)
              ->get();
  $fee_waivier=DB::table('fee_waiver')->where('stu_reg_no',$reg_no)->where('acadmic_year',app_config('Session',Auth::user()->school_id))->where('branch_code',Auth::user()->school_id)->get();
  $lastfeecollection=DB::table('fee_collection')->where('stu_reg_no',$reg_no)->where('class',$course)->where('branch_code',Auth::user()->school_id)->orderBy('month','desc')->max('month');
  $acadminstartmonth=DB::table('academicyear')->where('branch_code',Auth::user()->school_id)->where('status','1')->get();
//  echo count($lastfeecollection);exit;
  foreach($acadminstartmonth as $acadminstartmonth){
    $startmonth=$acadminstartmonth->startmonth;
    $startyear=$acadminstartmonth->startyear;
  }

   $monnumber=date("m", strtotime($startmonth."-".$startyear));
  $currentmonth=date('m');
  $currentdate=date('d');
  $fine_amt=DB::table('subcategory_fine')->where('branch_code',Auth::user()->school_id)->get();
  foreach ($fine_amt as $fine_amt) {
    // code...
    $finedate=$fine_amt->fine_date;
    $fineamt=$fine_amt->fine_amt;
  }
//  print_r($lastfeecollection);
  //if(count($lastfeecollection) > 0){
  if($lastfeecollection==""){
    if($currentmonth > $eid){
    if($currentdate > $finedate){
        $finemonth=$eid;
    }else{
      $finemonth=$eid-1;
    }
  }else{
      $finemonth=$eid-1;
  }
  }else{
      if($currentmonth < $eid){
        $finemonth=0;
      }else{
          if($currentdate > $finedate){
    $finemonth=$eid-$lastfeecollection;
  }else{
    $finemonth=($eid-$lastfeecollection)-1;
  }
      }
  }
  $totalfine=$finemonth*$fineamt;
//}else{
//  $totalfine="0";
//}
    $current_month=date('m');
 if($current_month > $eid ){
   $cntmonth = $current_month-$eid;
   $totalfine=$cntmonth*$fineamt;
   $totalfine=0;	// comment this line to get late fee 
//   $totalfine=1*$fineamt;
 }else{
   $totalfine=0;
 }
//echo $finedate."|".$fineamt."|".$currentmonth."|".$eid."|".$cntmonth;
//exit;


              echo $fees."|".$transportfees."|".$hostelfee."|".$totalfine."|".$fee_waivier."|".$feedue;
            }catch(\Illuminate\Database\QueryException $ex){
              $ex->getMessage();
  }
}
    public function feecollection(Request $request){
    $custom=json_encode($request->feehead);
    echo $custom;

  }
  public function getfeecollecionpdf(Request $request){
    $eid = $request->eid;
    $course = $request->course;

  }

  function dueinfoBystu(Request $request){
    $rid=$request->rid;
    $dueinfo=DB::table('fee_due')->where('fee_receipt_id',$rid)->where('status',0)->get();
    //echo $dueinfo;
    return view('finance.fee.fee_due_stu',compact('dueinfo'));
  }
  public function getfeecollecion(Request $request){
    $eid = $request->date;
    $data=json_decode($eid);
    $reg_no = $request->reg_no;
    $receipt_no = $request->receipt_no;
    $course_code = $request->course_code;
    $batch = $request->batch;
    $pay_mode = $request->pay_mode;
    $bankname = $request->bankname;
    $chequeno = $request->chequeno;
    $chequedate = $request->chekdate;
    $remark = $request->remark;
    $dob = $request->dob;
    $student_name=$request->student_name;
	$academic_year=$request->academic_year;
    $year=date("Y");
    $created_date = date('Y-m-d');
    DB::beginTransaction();
    $k=0;
    $j=0;
try {
  foreach ($data as $data) {
    $j++;
    // code...
    $feehead=$data->feehead;
    $feename=$data->feename;
    $actualamount=$data->actualamount;
    $due="0";
    $discount=$data->discount;
    $month=$data->Month;
    $final_amt=$actualamount-$discount;
    $st=$data->st;
    $feeduedata=$data->feeduedata;
    if($due > 0){
      $receipt_status="0";
    }else{
      $receipt_status="1";
    }

      if($st==true){
        $savedata= DB::table('fee_collection')->insert(['stu_reg_no'=>$reg_no,'stu_name'=>$student_name,'class'=>$course_code,'section'=>$batch,
        'month'=>$month,'year'=>$year,'fee_head'=>$feehead,'fee_category'=>$feename,
        'amt'=>$actualamount,'dueamt'=>$due,'discount'=>$discount,'final_amt'=>$final_amt,'pay_mode'=>$pay_mode,'bankname'=>$bankname,'chequeno'=>$chequeno,
        'chequedate'=>$chequedate,'remark'=>$remark,'receipt_no'=>$receipt_no,'receipt_status'=>"1",'collected_by'=>Auth::user()->emp_code,'acadmic_year'=>$academic_year,'branch_code'=>Auth::user()->school_id,'created_date'=>$created_date]);
          if($savedata){
            $k++;
          }

          if($feeduedata!="0"){
            $feedata=explode("|",$feeduedata);
            $dueid=$feedata[0];
            $feedueid=$feedata[1];
            $feereceiptid=$feedata[2];

            DB::table('fee_due')->where('id',$dueid)->where('fee_receipt_id',$feereceiptid)->update(['status'=>"1"]);
            DB::table('fee_collection')->where('id',$feedueid)->where('receipt_no',$feereceiptid)->update(['receipt_status'=>"2"]);

          }

      }else{
        $savedata= DB::table('fee_collection')->insertGetId(['stu_reg_no'=>$reg_no,'stu_name'=>$student_name,'class'=>$course_code,'section'=>$batch,
        'month'=>$month,'year'=>$year,'fee_head'=>$feehead,'fee_category'=>$feename,
        'amt'=>$actualamount,'dueamt'=>$due,'discount'=>$discount,'final_amt'=>$final_amt,'pay_mode'=>$pay_mode,'bankname'=>$bankname,'chequeno'=>$chequeno,
        'chequedate'=>$chequedate,'remark'=>$remark,'receipt_no'=>$receipt_no,'receipt_status'=>"0",'collected_by'=>Auth::user()->emp_code,'acadmic_year'=>$academic_year,'branch_code'=>Auth::user()->school_id,'created_date'=>$created_date]);

        $duearray=array(
          "fee_id"=>$savedata,
          "fee_receipt_id"=>$receipt_no,
          "fee_head"=>$feehead,
          "fee_category"=>$feename,
          "month"=>$month,
          "year"=>$year,
          "stu_reg_no"=>$reg_no,
          "amount"=>$actualamount,
          "collected_by"=>Auth::user()->emp_code
        );
        $duestats= DB::table("fee_due")->insert($duearray);
        if($duestats){
          $k++;
        }
      }
  //  echo"<pre>";  print_r($feeduedata);exit;



  }
  if($j==$k){
    DB::commit();
    echo "Fee Collected Successfully for Registration No ".$reg_no;
  }
}catch(\Illuminate\Database\QueryException $ex){
  DB::rollback();
echo "0"; //$ex->getMessage();
exit;
}


  }
	
	public function searchbydateonline(Request $request)
{
 // code...
 $todate=Input::get('todate');
 $todates=$todate;
 $fromdate=Input::get('fromdate');
 $fromdates=$fromdate;
 $students=DB::table('stu_admission')
   ->where('branch_code',Auth::user()->school_id)
   ->get();
 $batch = DB::table('tb_batch')
         ->join('tb_course', 'tb_batch.course', '=', 'tb_course.id')
         ->select('tb_batch.*', 'tb_course.course_name')
         ->where('tb_batch.branch_code',Auth::user()->school_id)
         ->orderBy('course','asc')
         ->get();
 $feeheads=DB::table('fee_category')
   ->where('branch_code',Auth::user()->school_id)
   ->get();
   if($todates!="" && $fromdates=="" ){
/*   $feeslist = DB::table('fee_collection')
   ->join('tb_course', 'fee_collection.class', '=', 'tb_course.id')
   ->join('tb_batch', 'fee_collection.section', '=', 'tb_batch.id')
   ->where('fee_collection.branch_code',Auth::user()->school_id)
   ->where('fee_collection.created_date',$todates)
   ->select(DB::raw('fee_collection.stu_reg_no,fee_collection.stu_name,fee_collection.fee_head,GROUP_CONCAT(month) as month,fee_collection.receipt_status, SUM(fee_collection.amt) as totamount,SUM(fee_collection.dueamt) as dueamt,SUM(fee_collection.discount) as discount,fee_collection.pay_mode,fee_collection.month,fee_collection.created_date,fee_collection.receipt_no'),'tb_course.course_name', 'tb_batch.batch_name')
   ->groupBy('fee_collection.receipt_no')
   ->get(); */
   $feeslist = DB::table('fee_collection')
   ->join('tb_course', 'fee_collection.class', '=', 'tb_course.id')
   ->join('tb_batch', 'fee_collection.section', '=', 'tb_batch.id')
   ->Leftjoin('pg_trans', 'fee_collection.receipt_no', '=', 'pg_trans.order_id')
   ->where('fee_collection.branch_code',Auth::user()->school_id)
   ->where('fee_collection.pay_mode','online')
   ->where('fee_collection.created_date',$todates)
   ->select(DB::raw('fee_collection.stu_reg_no,fee_collection.stu_name,fee_collection.fee_head,GROUP_CONCAT(month) as month,fee_collection.receipt_status, SUM(fee_collection.amt) as totamount,SUM(fee_collection.dueamt) as dueamt,SUM(fee_collection.discount) as discount,fee_collection.pay_mode,fee_collection.month,fee_collection.created_date,fee_collection.receipt_no'),'pg_trans.bank_ref_no as bank_ref_no','pg_trans.order_status', 'tb_course.course_name', 'tb_batch.batch_name')
   ->orderby('fee_collection.receipt_no','desc')
   ->groupBy('fee_collection.receipt_no')
   ->get();
 }
 if($todates!="" && $fromdates!="" )
/* $feeslist = DB::table('fee_collection')
 ->join('tb_course', 'fee_collection.class', '=', 'tb_course.id')
 ->join('tb_batch', 'fee_collection.section', '=', 'tb_batch.id')
 ->where('fee_collection.branch_code',Auth::user()->school_id)
 ->whereBetween('fee_collection.created_date',[$todates,$fromdates])
 ->select(DB::raw('fee_collection.stu_reg_no,fee_collection.stu_name,fee_collection.fee_head,GROUP_CONCAT(month) as month,fee_collection.receipt_status, SUM(fee_collection.amt) as totamount,SUM(fee_collection.dueamt) as dueamt,SUM(fee_collection.discount) as discount,fee_collection.pay_mode,fee_collection.month,fee_collection.created_date,fee_collection.receipt_no'), 'tb_course.course_name', 'tb_batch.batch_name')
 ->groupBy('fee_collection.receipt_no')
 ->get();
*/
 $feeslist = DB::table('fee_collection')
 ->join('tb_course', 'fee_collection.class', '=', 'tb_course.id')
 ->join('tb_batch', 'fee_collection.section', '=', 'tb_batch.id')
 ->Leftjoin('pg_trans', 'fee_collection.receipt_no', '=', 'pg_trans.order_id')
 ->where('fee_collection.branch_code',Auth::user()->school_id)
 ->where('fee_collection.pay_mode','online')
 ->whereBetween('fee_collection.created_date',[$todates,$fromdates])
 ->select(DB::raw('fee_collection.stu_reg_no,fee_collection.stu_name,fee_collection.fee_head,GROUP_CONCAT(month) as month,fee_collection.receipt_status, SUM(fee_collection.amt) as totamount,SUM(fee_collection.dueamt) as dueamt,SUM(fee_collection.discount) as discount,fee_collection.pay_mode,fee_collection.month,fee_collection.created_date,fee_collection.receipt_no'),'pg_trans.bank_ref_no as bank_ref_no','pg_trans.order_status', 'tb_course.course_name', 'tb_batch.batch_name')
 ->orderby('fee_collection.receipt_no','desc')
 ->groupBy('fee_collection.receipt_no')
 ->get();


   return view('finance.fee.fee-collection-list-online',compact('feeheads','feeslist','batch','students','batch'));
}
	
	
  function onlinefeecollectionlist(){
    $feeslist = DB::table('fee_collection')
    ->join('tb_course', 'fee_collection.class', '=', 'tb_course.id')
    ->join('tb_batch', 'fee_collection.section', '=', 'tb_batch.id')
    ->Leftjoin('pg_trans', 'fee_collection.receipt_no', '=', 'pg_trans.order_id')
    ->where('fee_collection.branch_code',Auth::user()->school_id)
    ->where('fee_collection.pay_mode','online')
    ->select(DB::raw('fee_collection.stu_reg_no,fee_collection.stu_name,fee_collection.fee_head,GROUP_CONCAT(month) as month,fee_collection.receipt_status, SUM(fee_collection.amt) as totamount,SUM(fee_collection.dueamt) as dueamt,SUM(fee_collection.discount) as discount,fee_collection.pay_mode,fee_collection.month,fee_collection.created_date,fee_collection.receipt_no'),'pg_trans.bank_ref_no as bank_ref_no','pg_trans.order_status', 'tb_course.course_name', 'tb_batch.batch_name')
    ->orderby('fee_collection.id','desc')
    ->groupBy('fee_collection.receipt_no')
    ->get();
    $students=DB::table('stu_admission')
      ->where('branch_code',Auth::user()->school_id)
      ->get();
      $feeheads=DB::table('fee_category')
        ->where('branch_code',Auth::user()->school_id)
        ->get();
    $batch = DB::table('tb_batch')
            ->join('tb_course', 'tb_batch.course', '=', 'tb_course.id')
            ->select('tb_batch.*', 'tb_course.course_name')
              ->where('tb_batch.branch_code',Auth::user()->school_id)
            ->get();
   //print_r($batch);

 return view('finance.fee.fee-collection-list-online',compact('feeslist','batch','students','batch','feeheads'));
  }
    public function feecollectionlist(){

    $feeslist = DB::table('fee_collection')
    ->join('tb_course', 'fee_collection.class', '=', 'tb_course.id')
    ->join('tb_batch', 'fee_collection.section', '=', 'tb_batch.id')
    ->where('fee_collection.branch_code',Auth::user()->school_id)
    ->select(DB::raw('fee_collection.stu_reg_no,fee_collection.stu_name,fee_collection.fee_head,GROUP_CONCAT(month) as month,fee_collection.receipt_status, SUM(fee_collection.amt) as totamount,SUM(fee_collection.dueamt) as dueamt,SUM(fee_collection.discount) as discount,fee_collection.pay_mode,fee_collection.month,fee_collection.created_date,fee_collection.receipt_no'), 'tb_course.course_name', 'tb_batch.batch_name')
    ->orderby('fee_collection.receipt_no','desc')
    ->groupBy('fee_collection.receipt_no')
    ->get();
    $students=DB::table('stu_admission')
      ->where('branch_code',Auth::user()->school_id)
      ->get();
      $feeheads=DB::table('fee_category')
        ->where('branch_code',Auth::user()->school_id)
        ->get();
    $batch = DB::table('tb_batch')
            ->join('tb_course', 'tb_batch.course', '=', 'tb_course.id')
            ->select('tb_batch.*', 'tb_course.course_name')
              ->where('tb_batch.branch_code',Auth::user()->school_id)
            ->get();
   //print_r($batch);

 return view('finance.fee.fee-collection-list',compact('feeslist','batch','students','batch','feeheads'));
}
public function updateReceipt(Request $request,$id){
  $self='finance/account/voucher/receiptupdate';
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
    try{
    $remarks="Cancel By ".Auth::user()->emp_code;
    $savedata=DB::table('fee_collection')->where('receipt_no',$id)->update(['receipt_status'=>'0','remark'=>$remarks]);

    if($savedata){
      return redirect('finance/Fee/feeCollection/list')->with([
           'message' => 'Receipt Status Updated Successfully.'
       ]);
    }else{
      return redirect('finance/Fee/feeCollection/list')->with([
           'message' => 'Unable to Update Receipt Status.Please Try Again.',
           'message_important'=>true
       ]);
    }

    }catch(\Illuminate\Database\QueryException $ex){
      return redirect('finance/Fee/feeCollection/list')->with([
           'message' => 'Someting Went Worng Please Contact Technical Team',
           'message_important'=>true
       ]);
   }
 }
}
public function searchfeeCollection(Request $request){
   $student=Input::get('student');
   $students=$student;
   $batch=Input::get('batch');
   $batchs=$batch;
   $month=Input::get('month');

   $months=$month;
   $fee_head=Input::get('feehead');
   $fee_heads=$fee_head;//preg_replace('/\s+/','',);
   $start_date=Input::get('start_date');
  $start_dates=$start_date;
  $students=DB::table('stu_admission')
    ->where('branch_code',Auth::user()->school_id)
    ->get();
  $batch = DB::table('tb_batch')
          ->join('tb_course', 'tb_batch.course', '=', 'tb_course.id')
          ->select('tb_batch.*', 'tb_course.course_name')
          ->where('tb_batch.branch_code',Auth::user()->school_id)
          ->orderBy('course','asc')
          ->get();
  $feeheads=DB::table('fee_category')
    ->where('branch_code',Auth::user()->school_id)
    ->get();
          if($students!='0' && $batchs =='0' && $months=='0' && $fee_heads=='0'){
            $feeslist =DB::table('fee_collection')
            ->join('tb_course', 'fee_collection.class', '=', 'tb_course.id')
            ->join('tb_batch', 'fee_collection.section', '=', 'tb_batch.id')
            ->where('fee_collection.branch_code',Auth::user()->school_id)
            ->where('fee_collection.stu_reg_no',$student)
            ->select(DB::raw('fee_collection.stu_reg_no,fee_collection.stu_name,fee_collection.fee_head,GROUP_CONCAT(month) as month,fee_collection.receipt_status, SUM(fee_collection.amt) as totamount,SUM(fee_collection.dueamt) as dueamt,SUM(fee_collection.discount) as discount,fee_collection.pay_mode,fee_collection.month,fee_collection.created_date,fee_collection.receipt_no'), 'tb_course.course_name', 'tb_batch.batch_name')
            ->groupBy('fee_collection.receipt_no')
            ->get();
            return view('finance.fee.fee-collection-list',compact('feeheads','feeslist','batch','students','batch'));
          }
        else if($batchs != "0"){
            $feeslist = DB::table('fee_collection')
            ->join('tb_course', 'fee_collection.class', '=', 'tb_course.id')
            ->join('tb_batch', 'fee_collection.section', '=', 'tb_batch.id')
            ->where('fee_collection.branch_code',Auth::user()->school_id)
            ->where('fee_collection.class',$batchs)
            ->select(DB::raw('fee_collection.stu_reg_no,fee_collection.stu_name,fee_collection.fee_head,GROUP_CONCAT(month) as month,fee_collection.receipt_status, SUM(fee_collection.amt) as totamount,SUM(fee_collection.dueamt) as dueamt,SUM(fee_collection.discount) as discount,fee_collection.pay_mode,fee_collection.month,fee_collection.created_date,fee_collection.receipt_no'), 'tb_course.course_name', 'tb_batch.batch_name')
            ->groupBy('fee_collection.receipt_no')
            ->get();
            return view('finance.fee.fee-collection-list',compact('feeheads','feeslist','batch','students','batch'));
          }
        else if($months!='0'){
            $feeslist = DB::table('fee_collection')
            ->join('tb_course', 'fee_collection.class', '=', 'tb_course.id')
            ->join('tb_batch', 'fee_collection.section', '=', 'tb_batch.id')
            ->where('fee_collection.branch_code',Auth::user()->school_id)
            ->where('fee_collection.month',$month)
            ->select(DB::raw('fee_collection.stu_reg_no,fee_collection.stu_name,fee_collection.fee_head,GROUP_CONCAT(month) as month,fee_collection.receipt_status, SUM(fee_collection.amt) as totamount,SUM(fee_collection.dueamt) as dueamt,SUM(fee_collection.discount) as discount,fee_collection.pay_mode,fee_collection.month,fee_collection.created_date,fee_collection.receipt_no'), 'tb_course.course_name', 'tb_batch.batch_name')
            ->groupBy('fee_collection.receipt_no')
            ->get();
            return view('finance.fee.fee-collection-list',compact('feeheads','feeslist','batch','students','batch'));
          }else if($fee_heads!='0'){

            $feeslist = DB::table('fee_collection')
            ->join('tb_course', 'fee_collection.class', '=', 'tb_course.id')
            ->join('tb_batch', 'fee_collection.section', '=', 'tb_batch.id')
            ->where('fee_collection.branch_code',Auth::user()->school_id)
            ->where('fee_collection.fee_head',$fee_heads)
            ->select(DB::raw('fee_collection.stu_reg_no,fee_collection.stu_name,fee_collection.fee_head,GROUP_CONCAT(month) as month,fee_collection.receipt_status, SUM(fee_collection.amt) as totamount,SUM(fee_collection.dueamt) as dueamt,SUM(fee_collection.discount) as discount,fee_collection.pay_mode,fee_collection.month,fee_collection.created_date,fee_collection.receipt_no'), 'tb_course.course_name', 'tb_batch.batch_name')
            ->groupBy('fee_collection.receipt_no')
            ->get();
            return view('finance.fee.fee-collection-list',compact('feeheads','feeslist','batch','students','batch'));
          }
          else if($start_dates !=null){
          //  echo "fdgdf";
            $feeslist = DB::table('fee_collection')
            ->join('tb_course', 'fee_collection.class', '=', 'tb_course.id')
            ->join('tb_batch', 'fee_collection.section', '=', 'tb_batch.id')
            ->where('fee_collection.branch_code',Auth::user()->school_id)
            ->where('fee_collection.created_date',$start_dates)
            ->select(DB::raw('fee_collection.stu_reg_no,fee_collection.stu_name,fee_collection.fee_head,GROUP_CONCAT(month) as month,fee_collection.receipt_status, SUM(fee_collection.amt) as totamount,SUM(fee_collection.dueamt) as dueamt,SUM(fee_collection.discount) as discount,fee_collection.pay_mode,fee_collection.month,fee_collection.created_date,fee_collection.receipt_no'), 'tb_course.course_name', 'tb_batch.batch_name')
            ->groupBy('fee_collection.receipt_no')
            ->get();
            return view('finance.fee.fee-collection-list',compact('feeheads','feeslist','batch','students','batch'));
          }
          else{
            $feeslist = DB::table('fee_collection')
            ->join('tb_course', 'fee_collection.class', '=', 'tb_course.id')
            ->join('tb_batch', 'fee_collection.section', '=', 'tb_batch.id')
            ->where('fee_collection.branch_code',Auth::user()->school_id)
            ->where('fee_collection.created_date',$start_date)
            ->select(DB::raw('fee_collection.stu_reg_no,fee_collection.stu_name,fee_collection.fee_head,GROUP_CONCAT(month) as month,fee_collection.receipt_status, SUM(fee_collection.amt) as totamount,SUM(fee_collection.dueamt) as dueamt,SUM(fee_collection.discount) as discount,fee_collection.pay_mode,fee_collection.month,fee_collection.created_date,fee_collection.receipt_no'), 'tb_course.course_name', 'tb_batch.batch_name')
            ->groupBy('fee_collection.receipt_no')
            ->get();
            return view('finance.fee.fee-collection-list',compact('feeheads','feeslist','batch','students','batch'));
          }

}

 public function searchbydatefeeCollection(Request $request)
{
  // code...
  $todate=Input::get('todate');
  $todates=$todate;
  $fromdate=Input::get('fromdate');
  $fromdates=$fromdate;
  $students=DB::table('stu_admission')
    ->where('branch_code',Auth::user()->school_id)
    ->get();
  $batch = DB::table('tb_batch')
          ->join('tb_course', 'tb_batch.course', '=', 'tb_course.id')
          ->select('tb_batch.*', 'tb_course.course_name')
          ->where('tb_batch.branch_code',Auth::user()->school_id)
          ->orderBy('course','asc')
          ->get();
  $feeheads=DB::table('fee_category')
    ->where('branch_code',Auth::user()->school_id)
    ->get();
    if($todates!="" && $fromdates=="" ){
    $feeslist = DB::table('fee_collection')
    ->join('tb_course', 'fee_collection.class', '=', 'tb_course.id')
    ->join('tb_batch', 'fee_collection.section', '=', 'tb_batch.id')
    ->where('fee_collection.branch_code',Auth::user()->school_id)
    ->where('fee_collection.created_date',$todates)
    ->select(DB::raw('fee_collection.stu_reg_no,fee_collection.stu_name,fee_collection.fee_head,GROUP_CONCAT(month) as month,fee_collection.receipt_status, SUM(fee_collection.amt) as totamount,SUM(fee_collection.dueamt) as dueamt,SUM(fee_collection.discount) as discount,fee_collection.pay_mode,fee_collection.month,fee_collection.created_date,fee_collection.receipt_no'),'tb_course.course_name', 'tb_batch.batch_name')
    ->groupBy('fee_collection.receipt_no')
    ->get();
  }
  if($todates!="" && $fromdates!="" )
  $feeslist = DB::table('fee_collection')
  ->join('tb_course', 'fee_collection.class', '=', 'tb_course.id')
  ->join('tb_batch', 'fee_collection.section', '=', 'tb_batch.id')
  ->where('fee_collection.branch_code',Auth::user()->school_id)
  ->whereBetween('fee_collection.created_date',[$todates,$fromdates])
  ->select(DB::raw('fee_collection.stu_reg_no,fee_collection.stu_name,fee_collection.fee_head,GROUP_CONCAT(month) as month,fee_collection.receipt_status, SUM(fee_collection.amt) as totamount,SUM(fee_collection.dueamt) as dueamt,SUM(fee_collection.discount) as discount,fee_collection.pay_mode,fee_collection.month,fee_collection.created_date,fee_collection.receipt_no'), 'tb_course.course_name', 'tb_batch.batch_name')
  ->groupBy('fee_collection.receipt_no')
  ->get();
    return view('finance.fee.fee-collection-list',compact('feeheads','feeslist','batch','students','batch'));
}

public function feereceipt(Request $request,$id){
  $logo=null;
  $Institution=DB::table('create_institute')->where('branch_code',Auth::user()->school_id)->get();
  foreach ($Institution as $Institution) {
    $address = $Institution->insitute_address;
    $InstitutionEmail = $Institution->insitute_email;
    $InstitutionMobile = $Institution->insitute_mobile;

    $logo = $Institution->logo;

    $Institutionphone = $Institution->insitute_phone;
    $Institutionfax = $Institution->insitute_fax;

  }
	
$paidFees= DB::table('fee_collection')
  ->where('branch_code',Auth::user()->school_id)
              ->where('receipt_no',$id)            
              ->where('fee_collection.receipt_status',"1")
              ->groupBy('fee_collection.month')->count();

              $failFees= DB::table('fee_collection')
  ->where('branch_code',Auth::user()->school_id)
              ->where('receipt_no',$id)            
              ->where('fee_collection.receipt_status',"0")
              ->groupBy('fee_collection.month')->count();

  $month=array();
  $receipt = DB::table('fee_collection')
              ->join('tb_course', 'fee_collection.class', '=', 'tb_course.id')
              ->join('tb_batch', 'fee_collection.section', '=', 'tb_batch.id')
              ->select('fee_collection.*', 'tb_course.course_name', 'tb_batch.batch_name')
              ->where('fee_collection.branch_code',Auth::user()->school_id)
              ->where('fee_collection.receipt_no',$id)
//              ->where('fee_collection.receipt_status',"1")
              ->groupBy('fee_collection.month')
              ->get();
  foreach($receipt as $receipt){
    $stu_reg_no=$receipt->stu_reg_no;
    $stu_name=$receipt->stu_name;
    $class=$receipt->course_name;
    $section=$receipt->batch_name;
    $date=$receipt->created_date;
    $pay_mode=$receipt->pay_mode;
    $receipt_status=$receipt->receipt_status;
    $monthName = date('F', mktime(0, 0, 0, $receipt->month, 10));

    array_push($month,$monthName);
  }

	if($failFees > 0 && $paidFees > 0){
    $receipt_status="Partial Paid";
  }else{
    $receipt_status= $receipt_status;
  }

  //print_r($month); exit;
  $receipts=DB::table('fee_collection')->select(DB::raw('fee_head,month, SUM(amt) as totamount,sum(discount) as discount,sum(final_amt) as final_amt'))
  ->where('branch_code',Auth::user()->school_id)
  ->where('receipt_no',$id)
    ->where('receipt_status',1)
  ->groupBy('fee_head')
  ->get();
  $pg_data=DB::table('pg_trans')->where('order_id',$id)->get();
//print_r($pg_data);exit;
//echo $conf = institute_details::where('branch_code','=','2')->first(['insitute_name']);
  if ($logo!=null) {
  return view('finance.fee.view-fee-collection',compact('receipt_status','pg_data','month','logo','pay_mode','stu_reg_no','stu_name','InstitutionEmail','Institutionfax','Institutionphone','class','section','date','receipts','id','address'));
  }else{
    $logo=null;
  return view('finance.fee.view-fee-collection',compact('receipt_status','pg_data','month','logo','pay_mode','stu_reg_no','stu_name','InstitutionEmail','Institutionfax','class','section','Institutionphone','date','receipts','id','address'));
  }


}
public function downloadreceipt(){
  $pdf = App::make('dompdf.wrapper');
  $pdf->loadHTML('<h1>Test</h1>');
  return $pdf->stream();
}
public function feereports(){
  $course=DB::table('tb_course')->where('branch_code',Auth::user()->school_id)->orderBy('id','asc')->get();
  $feecategory=DB::table('fee_category')->where('branch_code',Auth::user()->school_id)->get();
  return view('finance.fee.fee-reports',compact('course','feecategory'));
}

public function feesubcollectionlist(Request $request){
 $month = $request->month;
 $batch = $request->batch;
  $course = $request->course;
  $feecat = $request->feecat;
 try{
//    \DB::connection()->enableQueryLog();
 $reportdata = DB::table('fee_collection')
           ->join('tb_course', 'fee_collection.class', '=', 'tb_course.id')
           ->select('fee_collection.*', 'tb_course.course_name')
           ->where('fee_collection.branch_code',Auth::user()->school_id)
           ->where('fee_collection.class',$course)
           ->where('fee_collection.month',$month)
           ->where('fee_collection.section',$batch)
           ->where('fee_collection.fee_head',$feecat)
           ->get();
        //    $queries = \DB::getQueryLog();
        //   print_r($queries); exit;
           echo $reportdata;
         }catch(\Illuminate\Database\QueryException $ex){
        //   echo $ex->getMessage();
         }
 }
 public function duereport(){
  /* $self='finance/Fee-Category';
   if (\Auth::user()->user_role!=='1'){
       $get_perm=permission::permitted($self);

       if ($get_perm=='access denied'){
           return redirect('permission-error')->with([
               'message' => 'You do not have permission to view this page.',
               'message_important'=>true
           ]);
       }
   }*/
    $month=date('m');
    $year=date('Y');
   $course=DB::table('tb_course')->where('branch_code',Auth::user()->school_id)->orderBy('id','desc')->get();
   $paidlist=array();
   $stulist=array();
   $feeduelist=DB::table('fee_collection')->where('branch_code',Auth::user()->school_id)->where('month',$month)->where('year',$year)->get();
   foreach ($feeduelist as $feeduelist) {
     // code...
     $reg_no=$feeduelist->stu_reg_no;
     array_push($paidlist,$reg_no);
   }
   $stu_list=DB::table('stu_admission')->where('branch_code',Auth::user()->school_id)->get();
   foreach ($stu_list as $stu_list) {
     // code...
     $list=$stu_list->reg_no;
     array_push($stulist,$list);
   }
   $duelist=$result=array_diff($stulist,$paidlist);
//  $fee_due_list=DB::table('stu_admission')->whereIn('reg_no',$duelist)->get();
  $fee_due_list = DB::table('stu_admission')
            ->join('tb_course', 'stu_admission.course', '=', 'tb_course.id')
            ->join('tb_batch', 'stu_admission.batch', '=', 'tb_batch.id')
            ->join('fee_master', 'stu_admission.course', '=', 'tb_batch.course')
            ->select('stu_admission.*', 'tb_course.course_name', 'tb_batch.batch_name','fee_master.amount')
            ->whereIn('stu_admission.reg_no',$duelist)
            ->where('stu_admission.branch_code',Auth::user()->school_id)
            ->where('fee_master.month',$month)
            ->groupBy('reg_no')
            ->get();
          //  print_r($fee_due_list); exit;
    return view('finance.fee.fee-due-report',compact('course','fee_due_list','month'));
 }
public function postduereport(Request $request){
/*  $self='finance/Fee-Category';
  if (\Auth::user()->user_role!=='1'){
      $get_perm=permission::permitted($self);

      if ($get_perm=='access denied'){
          return redirect('permission-error')->with([
              'message' => 'You do not have permission to view this page.',
              'message_important'=>true
          ]);
      }
  } */
$date=Input::get('dob');
 $class=Input::get('course');
 $section=Input::get('batch');
$time=strtotime($date);
$parts = explode("-", $date);
$month = $parts[0];
$year = $parts[1];
$paidlist=array();
$stulist=array();
 $course=DB::table('tb_course')->where('branch_code',Auth::user()->school_id)->orderBy('id','desc')->get();
$feeduelist=DB::table('fee_collection')->where('branch_code',Auth::user()->school_id)->where('section',$section)->where('class',$class)->where('year',$year)->where('month',$month)->get();
foreach ($feeduelist as $feeduelist) {
  // code...
  $reg_no=$feeduelist->stu_reg_no;
  array_push($paidlist,$reg_no);
}
//print_r($paidlist);
$stu_list=DB::table('stu_admission')->where('branch_code',Auth::user()->school_id)->get();
foreach ($stu_list as $stu_list) {
  // code...
  $list=$stu_list->reg_no;
  array_push($stulist,$list);
}
$duelist=$result=array_diff($stulist,$paidlist);
//  $fee_due_list=DB::table('stu_admission')->whereIn('reg_no',$duelist)->get();
$fee_due_list = DB::table('stu_admission')
         ->join('tb_course', 'stu_admission.course', '=', 'tb_course.id')
         ->join('tb_batch', 'stu_admission.batch', '=', 'tb_batch.id')
         ->join('fee_master', 'stu_admission.course', '=', 'tb_batch.course')
         ->select('stu_admission.*', 'tb_course.course_name', 'tb_batch.batch_name','fee_master.amount')
         ->whereIn('stu_admission.reg_no',$duelist)
         ->where('stu_admission.branch_code',Auth::user()->school_id)
         ->where('stu_admission.batch',$section)
         ->where('stu_admission.course',$class)
         ->where('fee_master.month',$month)
         ->groupBy('reg_no')
         ->get();
      //   print_r($fee_due_list); exit;
           return view('finance.fee.fee-due-report',compact('course','fee_due_list','month'));
}

public function accountgroup(){
  $self='finance/account/account-group';
  if (\Auth::user()->user_role!=='1'){
      $get_perm=permission::permitted($self);

      if ($get_perm=='access denied'){
          return redirect('permission-error')->with([
              'message' => 'You do not have permission to view this page.',
              'message_important'=>true
          ]);
      }
  }
   $accountgroup=DB::table('account_group')->where('branch_code',Auth::user()->school_id)->get();
   return view('finance.account.account-group',compact('accountgroup'));
}
public function saveaccountgroup(Request $request){
  $self='finance/account/account-group/add';
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
    'account_name'=>'required|string|max:255|unique:account_group',
    'groupunder'=>'required',
    'openingbalance'=>'required',
    ]);
    $account_name=Input::get('account_name');
    $groupunder=Input::get('groupunder');
    $openingbalance=Input::get('openingbalance');
    $created_date = date('d-m-Y H:i:s');
    try{
    $savedata=DB::table('account_group')->insert(['account_name'=>$account_name, 'groupunder' =>$groupunder,'openingbalance'=>$openingbalance,'branch_code'=>Auth::user()->school_id,'created_date'=>$created_date]);

    if(!empty($savedata)){
      return redirect('finance/account/account-group')->with([
           'message' => 'New Account Group Added Successfully.'
       ]);
    }else{
      return redirect('finance/account/account-group')->with([
           'message' => 'Unable to add new Account Group.Please Try Again.'
       ]);
    }

    }catch(\Illuminate\Database\QueryException $ex){
      return redirect('finance/account/account-group')->with([
           'message' => 'Someting Went Worng Please Contact Technical Team : '.$ex->getMessage(). '',
           'message_important'=>true
       ]);

   }

}
public function deleteaccountgroup(Request $request,$id){
  $self='finance/account/account-group/delete';
  if (\Auth::user()->user_role!=='1'){
      $get_perm=permission::permitted($self);

      if ($get_perm=='access denied'){
          return redirect('permission-error')->with([
              'message' => 'You do not have permission to view this page.',
              'message_important'=>true
          ]);
      }
  }
  try{
  if($id!=null){
     DB::table('account_group')->where('branch_code',Auth::user()->school_id)->where('id','=',$id)->delete();
      return redirect('finance/account/account-group')->with([
          'message' => "Account Group Details Deleted Successfully."
      ]);
  }else{
      return redirect('finance/account/account-group')->with([
          'message' => "Account Group Details Not Found",
          'message_important' => true
      ]);
  }
}catch(\Illuminate\Database\QueryException $ex){
  return redirect('finance/account/account-group')->with([
       'message' => 'Someting Went Worng Please Contact Technical Team : '.$ex->getMessage(). '',
       'message_important'=>true
   ]);

}

}

public function viewaccountgroup(Request $request,$id){
  $self='finance/account/account-group/view';
  if (\Auth::user()->user_role!=='1'){
      $get_perm=permission::permitted($self);

      if ($get_perm=='access denied'){
          return redirect('permission-error')->with([
              'message' => 'You do not have permission to view this page.',
              'message_important'=>true
          ]);
      }
  }
  $accountgroup=DB::table('account_group')->where('branch_code',Auth::user()->school_id)->where('id','=',$id)->get();
  foreach ($accountgroup as $accountgroup) {
    // code...
  $account_name=$accountgroup->account_name;
  $groupunder=$accountgroup->groupunder;
  $openingbalance=$accountgroup->openingbalance;
  }
 return view('finance.account.view-account-group',compact('account_name','groupunder','openingbalance','id'));
}
public function updateaccountgroup(Request $request){
  $self='finance/account/account-group/update';
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
    'account_name'=>'required|string|max:255',
    'groupunder'=>'required',
    'openingbalance'=>'required',
    ]);
    $account_name=Input::get('account_name');
    $groupunder=Input::get('groupunder');
    $openingbalance=Input::get('openingbalance');
    $id=Input::get('id');
    try{
    $savedata=DB::table('account_group')->where('branch_code',Auth::user()->school_id)->where('id','=',$id)->update(['account_name'=>$account_name, 'groupunder' =>$groupunder,'openingbalance'=>$openingbalance]);

    if(!empty($savedata)){
      return redirect('finance/account/account-group')->with([
           'message' => 'Account Group Updated Successfully.'
       ]);
    }else{
      return redirect('finance/account/account-group')->with([
           'message' => 'Unable to Updated Account Group.Please Try Again.'
       ]);
    }

    }catch(\Illuminate\Database\QueryException $ex){
      return redirect('finance/account/account-group')->with([
           'message' => 'Someting Went Worng Please Contact Technical Team : '.$ex->getMessage(). '',
           'message_important'=>true
       ]);

   }
}
public function vouchermaster(){
  $self='finance/account/voucher-master';
  if (\Auth::user()->user_role!=='1'){
      $get_perm=permission::permitted($self);

      if ($get_perm=='access denied'){
          return redirect('permission-error')->with([
              'message' => 'You do not have permission to view this page.',
              'message_important'=>true
          ]);
      }
  }
   $voucher_master=DB::table('voucher_master')->where('branch_code',Auth::user()->school_id)->get();
   return view('finance.account.voucher-master',compact('voucher_master'));
}
public function vouchermasteradd(Request $request){
  $self='finance/account/voucher-master/add';
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
    'voucher_master'=>'required|string|max:255|unique:voucher_master',
    'crdr'=>'required'
    ]);
    $voucher_master=Input::get('voucher_master');
    $crdr=Input::get('crdr');
    $created_date = date('d-m-Y H:i:s');
    try{
    $savedata=DB::table('voucher_master')->insert(['voucher_master'=>$voucher_master, 'crdr' =>$crdr,'branch_code'=>Auth::user()->school_id,'created_date'=>$created_date]);

    if(!empty($savedata)){
      return redirect('finance/account/voucher-master')->with([
           'message' => 'New Voucher Master Added Successfully.'
       ]);
    }else{
      return redirect('finance/account/voucher-master')->with([
           'message' => 'Unable to add Voucher Master.Please Try Again.'
       ]);
    }

    }catch(\Illuminate\Database\QueryException $ex){
      return redirect('finance/account/voucher-master')->with([
           'message' => 'Someting Went Worng Please Contact Technical Team : '.$ex->getMessage(). '',
           'message_important'=>true
       ]);
   }
}
public function deletevouchermaster(Request $request,$id){
  $self='finance/account/voucher-master/delete';
  if (\Auth::user()->user_role!=='1'){
      $get_perm=permission::permitted($self);

      if ($get_perm=='access denied'){
          return redirect('permission-error')->with([
              'message' => 'You do not have permission to view this page.',
              'message_important'=>true
          ]);
      }
  }
  try{
  if($id!=null){
     DB::table('voucher_master')->where('branch_code',Auth::user()->school_id)->where('id','=',$id)->delete();
      return redirect('finance/account/voucher-master')->with([
          'message' => "Voucher Details Deleted Successfully."
      ]);
  }else{
      return redirect('finance/account/voucher-master')->with([
          'message' => "Voucher Details Not Found",
          'message_important' => true
      ]);
  }
}catch(\Illuminate\Database\QueryException $ex){
  return redirect('finance/account/voucher-master')->with([
       'message' => 'Someting Went Worng Please Contact Technical Team : '.$ex->getMessage(). '',
       'message_important'=>true
   ]);

}
}
public function viewvouchermaster(Request $request,$id){
  $self='finance/account/voucher-master/view';
  if (\Auth::user()->user_role!=='1'){
      $get_perm=permission::permitted($self);

      if ($get_perm=='access denied'){
          return redirect('permission-error')->with([
              'message' => 'You do not have permission to view this page.',
              'message_important'=>true
          ]);
      }
  }
  $vouchermaster=DB::table('voucher_master')->where('id','=',$id)->where('branch_code',Auth::user()->school_id)->get();
  foreach ($vouchermaster as $vouchermaster) {
    // code...
    $voucher_master=$vouchermaster->voucher_master;
    $crdr=$vouchermaster->crdr;
  }
     return view('finance.account.view-voucher-master',compact('voucher_master','crdr','id'));
}
public function updatevouchermaster(Request $request){
  $self='finance/account/voucher-master/add';
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
    'voucher_master'=>'required',
    'crdr'=>'required'
    ]);
    $voucher_master=Input::get('voucher_master');
    $crdr=Input::get('crdr');
    $id=Input::get('id');
    try{
    $savedata=DB::table('voucher_master')->where('branch_code',Auth::user()->school_id)->where('id','=',$id)->update(['voucher_master'=>$voucher_master, 'crdr' =>$crdr]);

    if(!empty($savedata)){
      return redirect('finance/account/voucher-master')->with([
           'message' => 'New Voucher Master Updated Successfully.'
       ]);
    }else{
      return redirect('finance/account/voucher-master')->with([
           'message' => 'Unable to Update Voucher Master.Please Try Again.'
       ]);
    }

    }catch(\Illuminate\Database\QueryException $ex){
      return redirect('finance/account/voucher-master')->with([
           'message' => 'Someting Went Worng Please Contact Technical Team : '.$ex->getMessage(). '',
           'message_important'=>true
       ]);
   }
}
public function voucherhead(){
  $self='finance/account/voucher-head';
  if (\Auth::user()->user_role!=='1'){
      $get_perm=permission::permitted($self);

      if ($get_perm=='access denied'){
          return redirect('permission-error')->with([
              'message' => 'You do not have permission to view this page.',
              'message_important'=>true
          ]);
      }
  }

  $accountgroup=DB::table('account_group')->where('branch_code',Auth::user()->school_id)->get();
  //$voucher_heads=DB::table('voucher_head')->where('branch_code',Auth::user()->school_id)->get();
  $voucher_heads = DB::table('voucher_head')
              ->join('account_group', 'voucher_head.account_group', '=', 'account_group.id')
              ->select('voucher_head.*', 'account_group.account_name')
              ->where('voucher_head.branch_code',Auth::user()->school_id)
              ->get();
   return view('finance.account.voucher-head',compact('accountgroup','voucher_heads'));
}
public function addvoucherhead(Request $request){
  $self='finance/account/voucher-master/add';
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
    'voucher_head'=>'required|string|max:255|unique:voucher_head',
    'account_group'=>'required',
    'num'=>'required'
    ]);
    $voucher_head=Input::get('voucher_head');
    $account_group=Input::get('account_group');
    $number=Input::get('num');
    $enb=Input::get('enable');
    $created_date = date('d-m-Y H:i:s');
    if($enb!='1'){
      $enb='0';
    }
    try{
    $savedata=DB::table('voucher_head')->insert(['voucher_head'=>$voucher_head,'account_group'=>$account_group, 'num' =>$number,'enable_voucher'=>$enb,'branch_code'=>Auth::user()->school_id,'created_date'=>$created_date]);

    if(!empty($savedata)){
      return redirect('finance/account/voucher-head')->with([
           'message' => 'New Voucher Head Added Successfully.'
       ]);
    }else{
      return redirect('finance/account/voucher-head')->with([
           'message' => 'Unable to add Voucher Head.Please Try Again.'
       ]);
    }

    }catch(\Illuminate\Database\QueryException $ex){
      return redirect('finance/account/voucher-head')->with([
           'message' => 'Someting Went Worng Please Contact Technical Team : '.$ex->getMessage(). '',
           'message_important'=>true
       ]);
   }
}
public function deletevoucherhead(Request $request,$id){
  $self='finance/account/voucher-head/delete';
  if (\Auth::user()->user_role!=='1'){
      $get_perm=permission::permitted($self);

      if ($get_perm=='access denied'){
          return redirect('permission-error')->with([
              'message' => 'You do not have permission to view this page.',
              'message_important'=>true
          ]);
      }
  }
  try{
  if($id!=null){
     DB::table('voucher_head')->where('branch_code',Auth::user()->school_id)->where('id','=',$id)->delete();
      return redirect('finance/account/voucher-head')->with([
          'message' => "Voucher Head Details Deleted Successfully."
      ]);
  }else{
      return redirect('finance/account/voucher-head')->with([
          'message' => "Voucher Head Details Not Found",
          'message_important' => true
      ]);
  }
   }catch(\Illuminate\Database\QueryException $ex){
      return redirect('finance/account/voucher-head')->with([
           'message' => 'Someting Went Worng Please Contact Technical Team : '.$ex->getMessage(). '',
           'message_important'=>true
       ]);
   }

}
public function viewvoucherhead(Request $request,$id){
  $self='finance/account/voucher-head/view';
  if (\Auth::user()->user_role!=='1'){
      $get_perm=permission::permitted($self);

      if ($get_perm=='access denied'){
          return redirect('permission-error')->with([
              'message' => 'You do not have permission to view this page.',
              'message_important'=>true
          ]);
      }
  }
    $voucher_heads=DB::table('voucher_head')->where('id',$id)->where('branch_code',Auth::user()->school_id)->get();

    $accountgroup=DB::table('account_group')->where('branch_code',Auth::user()->school_id)->get();
    foreach ($voucher_heads as $voucher_heads) {
      // code...
      $voucher_head=$voucher_heads->voucher_head;
      $account_group=$voucher_heads->account_group;
      $num=$voucher_heads->num;
    }
    return view('finance.account.view-voucher-head',compact('id','accountgroup','voucher_head','voucher_master','account_group','num'));
}
public function updatevoucherhead(Request $request){
  $self='finance/account/voucher-master/add';
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
    'voucher_head'=>'required|string|max:255|unique:voucher_head',
    'account_group'=>'required',
    'num'=>'required'
    ]);
    $voucher_head=Input::get('voucher_head');
    $account_group=Input::get('account_group');
    $number=Input::get('num');
    $id=Input::get('id');
    $enb=Input::get('enable');
    $created_date = date('d-m-Y H:i:s');
    if($enb!='1'){
      $enb='0';
    }
    try{
    $savedata=DB::table('voucher_head')->where('id',$id)->where('branch_code',Auth::user()->school_id)->update(['voucher_head'=>$voucher_head,'account_group'=>$account_group, 'num' =>$number,'enable_voucher'=>$enb]);
    if(!empty($savedata)){
      return redirect('finance/account/voucher-head')->with([
           'message' => 'Voucher Head Updated Successfully.'
       ]);
    }else{
      return redirect('finance/account/voucher-head')->with([
           'message' => 'Unable to Update Voucher Head.Please Try Again.'
       ]);
    }

    }catch(\Illuminate\Database\QueryException $ex){
      return redirect('finance/account/voucher-head')->with([
           'message' => 'Someting Went Worng Please Contact Technical Team : '.$ex->getMessage(). '',
           'message_important'=>true
       ]);
   }
}
public function voucher(){
  $self='finance/account/voucher';
  if (\Auth::user()->user_role!=='1'){
      $get_perm=permission::permitted($self);

      if ($get_perm=='access denied'){
          return redirect('permission-error')->with([
              'message' => 'You do not have permission to view this page.',
              'message_important'=>true
          ]);
      }
  }
  $vouchercnt=DB::table('tb_voucher')->where('branch_code',Auth::user()->school_id)->get();
  foreach ($vouchercnt as $vouchercnt) {
    // code...
    $voucher_no=$vouchercnt->voucher_no;
  }
  $vouchercnt=$voucher_no+1;;

  $accountgroup=DB::table('account_group')->where('branch_code',Auth::user()->school_id)->get();
  //$voucher_heads=DB::table('voucher_head')->where('branch_code',Auth::user()->school_id)->get();
  $voucher_heads = DB::table('voucher_head')
              ->join('account_group', 'voucher_head.account_group', '=', 'account_group.id')
              ->select('voucher_head.*', 'account_group.account_name')
              ->where('voucher_head.branch_code',Auth::user()->school_id)
              ->get();

              $voucherlist = DB::table('tb_voucher')
                        ->join('voucher_head', 'tb_voucher.voucher_heads', '=', 'voucher_head.id')
                        ->select('tb_voucher.*', 'voucher_head.voucher_head')
                        ->where('tb_voucher.branch_code',Auth::user()->school_id)->get();

   return view('finance.account.create-voucher',compact('vouchercnt','voucher_heads','voucherlist'));
}
public function feeheadlist(Request $request){
 $eid = $request->eid;

 //$batch = DB::table('account_group')->select('id','account_name')->where('branch_code',Auth::user()->school_id)->where('id',$accountgroup)->get();
 //$batch=DB::table('tb_batch')->where('course',$eid)->orderBy('id','desc')->get();
 $batch = DB::table('voucher_head')
            ->join('account_group', 'voucher_head.account_group', '=', 'account_group.id')
            ->select('voucher_head.enable_voucher','account_group.id', 'account_group.account_name')
            ->where('voucher_head.branch_code',Auth::user()->school_id)->where('voucher_head.id',$eid)
            ->get();
$cart = array();
 foreach($batch as $batch){
  array_push($cart,$batch);
 }
  echo json_encode($cart);
}
public function createvoucher(Request $request){
  $self='finance/account/voucher/create';
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
    'voucher_no'=>'required|max:255|unique:tb_voucher',
    'transcation_date'=>'required',
    'voucher_head'=>'required',
    'ledger_acc'=>'required',
    'crdr'=>'required',
    'paymode'=>'required',
    'amt'=>'required',
    'narration'=>'required',
    ]);
    $voucher_head=Input::get('voucher_head');
    $voucher_no=Input::get('voucher_no');
    $transcation_date=Input::get('transcation_date');
    $ledger_acc=Input::get('ledger_acc');
    $crdr=Input::get('crdr');
    $paymode=Input::get('paymode');
    $amt=Input::get('amt');
    $narration=Input::get('narration');
    $created_date = date('d-m-Y H:i:s');
    $cr="0.00";
    $dr="0.00";
    if($crdr=='Cr'){
      $cr=$amt;
    }else{
      $dr=$amt;
    }
    try{
    $savedata=DB::table('tb_voucher')->insert(['voucher_no'=>$voucher_no,'transaction_date'=>$transcation_date,'voucher_heads'=>$voucher_head,
    'ledger_acc'=>$ledger_acc, 'cr' =>$cr,'dr'=>$dr,'payment_mode'=>$paymode,'narration'=>$narration,'branch_code'=>Auth::user()->school_id,'created_date'=>$created_date]);

    if(!empty($savedata)){
      return redirect('finance/account/voucher')->with([
           'message' => 'New Voucher Head Added Successfully.'
       ]);
    }else{
      return redirect('finance/account/voucher')->with([
           'message' => 'Unable to add Voucher Head.Please Try Again.'
       ]);
    }

    }catch(\Illuminate\Database\QueryException $ex){
      return redirect('finance/account/voucher')->with([
           'message' => 'Someting Went Worng Please Contact Technical Team : '.$ex->getMessage(). '',
           'message_important'=>true
       ]);
   }
}
public function voucherlist(){
  $self='finance/account/voucher-head';
  if (\Auth::user()->user_role!=='1'){
      $get_perm=permission::permitted($self);

      if ($get_perm=='access denied'){
          return redirect('permission-error')->with([
              'message' => 'You do not have permission to view this page.',
              'message_important'=>true
          ]);
      }
  }
  $voucher_heads = DB::table('voucher_head')
              ->join('account_group', 'voucher_head.account_group', '=', 'account_group.id')
              ->select('voucher_head.*', 'account_group.account_name')
              ->where('voucher_head.branch_code',Auth::user()->school_id)
              ->get();
  $voucherlist = DB::table('tb_voucher')
              ->join('voucher_head', 'tb_voucher.voucher_heads', '=', 'voucher_head.id')
              ->select('tb_voucher.*', 'voucher_head.voucher_head')
              ->where('tb_voucher.branch_code',Auth::user()->school_id)->get();
   return view('finance.account.voucher-list',compact('voucherlist','voucher_heads'));
}

public function postsearchvoucherlist(Request $request){
  $from=Input::get('from');
  $fromdate=$from;
  $to=Input::get('to');
  $todate=$to;
  $voucherhead=Input::get('voucherhead');
  $voucher_head=$voucherhead;

 $firstday = date("d-m-Y", strtotime("first day of this month"));
 $lastday = date("d-m-Y", strtotime("last day of this month"));

  $voucher_heads = DB::table('voucher_head')
              ->join('account_group', 'voucher_head.account_group', '=', 'account_group.id')
              ->select('voucher_head.*', 'account_group.account_name')
              ->where('voucher_head.branch_code',Auth::user()->school_id)
              ->get();

          if($fromdate!=null && $todate==null && $voucher_head=='0'){
            $voucherlist = DB::table('tb_voucher')
            ->join('voucher_head', 'tb_voucher.voucher_heads', '=', 'voucher_head.id')
            ->select('tb_voucher.*', 'voucher_head.voucher_head')
            ->where('tb_voucher.transaction_date',$fromdate)
            ->where('tb_voucher.branch_code',Auth::user()->school_id)->get();

            return view('finance.account.voucher-list',compact('voucher_heads','voucherlist'));
          }
          if($fromdate!=null && $todate!=null && $voucher_head=='0'){
            $voucherlist = DB::table('tb_voucher')
            ->join('voucher_head', 'tb_voucher.voucher_heads', '=', 'voucher_head.id')
            ->select('tb_voucher.*', 'voucher_head.voucher_head')
            ->whereBetween('tb_voucher.transaction_date',[$fromdate,$todate])
            ->where('tb_voucher.branch_code',Auth::user()->school_id)->get();

            return view('finance.account.voucher-list',compact('voucher_heads','voucherlist'));
          }
          if($fromdate!=null && $todate!=null && $voucher_head!='0'){
            $voucherlist = DB::table('tb_voucher')
            ->join('voucher_head', 'tb_voucher.voucher_heads', '=', 'voucher_head.id')
            ->select('tb_voucher.*', 'voucher_head.voucher_head')
            ->whereBetween('tb_voucher.transaction_date',[$fromdate,$todate])
            ->where('tb_voucher.voucher_heads',$voucher_head)
            ->where('tb_voucher.branch_code',Auth::user()->school_id)->get();

            return view('finance.account.voucher-list',compact('voucher_heads','voucherlist'));
          }
          if($fromdate==null && $todate==null && $voucher_head=='0'){
            $voucherlist = DB::table('tb_voucher')
            ->join('voucher_head', 'tb_voucher.voucher_heads', '=', 'voucher_head.id')
            ->select('tb_voucher.*', 'voucher_head.voucher_head')
            ->whereBetween('tb_voucher.transaction_date',[$firstday,$lastday])
            ->where('tb_voucher.branch_code',Auth::user()->school_id)->get();

            return view('finance.account.voucher-list',compact('voucher_heads','voucherlist'));
          }
          if($fromdate==null && $todate==null && $voucher_head!='0'){
            $voucherlist = DB::table('tb_voucher')
            ->join('voucher_head', 'tb_voucher.voucher_heads', '=', 'voucher_head.id')
            ->select('tb_voucher.*', 'voucher_head.voucher_head')
            ->where('tb_voucher.voucher_heads',$voucher_head)
            ->where('tb_voucher.branch_code',Auth::user()->school_id)->get();

            return view('finance.account.voucher-list',compact('voucher_heads','voucherlist'));
          }
}
public function daybook(){
  $self='finance/account/voucher-head';
  if (\Auth::user()->user_role!=='1'){
      $get_perm=permission::permitted($self);

      if ($get_perm=='access denied'){
          return redirect('permission-error')->with([
              'message' => 'You do not have permission to view this page.',
              'message_important'=>true
          ]);
      }
  }
/*  $voucher_heads = DB::table('voucher_head')
              ->join('account_group', 'voucher_head.account_group', '=', 'account_group.id')
              ->select('voucher_head.*', 'account_group.account_name')
              ->where('voucher_head.branch_code',Auth::user()->school_id)
              ->get();*/
  $voucherlist = DB::table('tb_voucher')
              ->join('voucher_head', 'tb_voucher.voucher_heads', '=', 'voucher_head.id')
              ->select('tb_voucher.*', 'voucher_head.voucher_head')
              ->where('tb_voucher.transaction_date',date("d-m-Y"))
              ->where('tb_voucher.branch_code',Auth::user()->school_id)->get();
   return view('finance.account.voucher-day-book',compact('voucherlist'));
}
public function postsearchdaybook(Request $request){
  $from=Input::get('from');
  $fromdate=$from;
          if($fromdate!=null){
            $voucherlist = DB::table('tb_voucher')
            ->join('voucher_head', 'tb_voucher.voucher_heads', '=', 'voucher_head.id')
            ->select('tb_voucher.*', 'voucher_head.voucher_head')
            ->where('tb_voucher.transaction_date',$fromdate)
            ->where('tb_voucher.branch_code',Auth::user()->school_id)->get();

            return view('finance.account.voucher-day-book',compact('voucherlist'));
          }else{
            $voucherlist = DB::table('tb_voucher')
            ->join('voucher_head', 'tb_voucher.voucher_heads', '=', 'voucher_head.id')
            ->select('tb_voucher.*', 'voucher_head.voucher_head')
            ->where('tb_voucher.transaction_date',date("d-m-Y"))
            ->where('tb_voucher.branch_code',Auth::user()->school_id)->get();
            return view('finance.account.voucher-day-book',compact('voucherlist'));
          }
}

public function legderaccount(){
  $self='finance/account/voucher-head';
  if (\Auth::user()->user_role!=='1'){
      $get_perm=permission::permitted($self);

      if ($get_perm=='access denied'){
          return redirect('permission-error')->with([
              'message' => 'You do not have permission to view this page.',
              'message_important'=>true
          ]);
      }
  }
  $ledger_acc = DB::table('account_group')
              ->where('branch_code',Auth::user()->school_id)
              ->get();
   return view('finance.account.ledger-account',compact('ledger_acc'));
}
public function trialaccount(){
  $self='finance/account/voucher/trial-account';
  if (\Auth::user()->user_role!=='1'){
      $get_perm=permission::permitted($self);

      if ($get_perm=='access denied'){
          return redirect('permission-error')->with([
              'message' => 'You do not have permission to view this page.',
              'message_important'=>true
          ]);
      }
  }
  $firstday = date("d-m-Y", strtotime("first day of this month"));
  $lastday = date("d-m-Y", strtotime("last day of this month"));
    $voucherlist = DB::table('tb_voucher')
    ->join('voucher_head', 'tb_voucher.voucher_heads', '=', 'voucher_head.id')
    ->select('tb_voucher.*', 'voucher_head.voucher_head')
    ->whereBetween('tb_voucher.transaction_date',[$firstday,$lastday])
    ->where('tb_voucher.branch_code',Auth::user()->school_id)->get();
    return view('finance.account.trial-balance',compact('voucherlist'));
}
public function trialaccountpostsearch(Request $request){
  $from=Input::get('from');
  $to=Input::get('to');
  $fromdate=$from;
  $todate=$to;
  $voucherlist = DB::table('tb_voucher')
  ->join('voucher_head', 'tb_voucher.voucher_heads', '=', 'voucher_head.id')
  ->select('tb_voucher.*', 'voucher_head.voucher_head')
  ->whereBetween('tb_voucher.transaction_date',[$from,$to])
  ->where('tb_voucher.branch_code',Auth::user()->school_id)->get();
//  print_r($voucherlist);
  return view('finance.account.trial-balance',compact('voucherlist'));
}
  public function viewvoucher(Request $request,$id){
    if(!empty($id)){
    //  $voucherdetails=DB::table('tb_voucher')->where('voucher_no',$id)->where('branch_code',Auth::user()->school_id)->get();
    $vouchers = DB::table('tb_voucher')
    ->join('voucher_head', 'tb_voucher.voucher_heads', '=', 'voucher_head.id')
    ->select('tb_voucher.*', 'voucher_head.voucher_head')
    ->where('tb_voucher.voucher_no',$id)
    ->where('tb_voucher.branch_code',Auth::user()->school_id)->get();
    foreach ($vouchers as $vouchers) {
      // code...
      $date=$vouchers->transaction_date;
    }
      $voucherdetails = DB::table('tb_voucher')
      ->join('voucher_head', 'tb_voucher.voucher_heads', '=', 'voucher_head.id')
      ->select('tb_voucher.*', 'voucher_head.voucher_head')
      ->where('tb_voucher.voucher_no',$id)
      ->where('tb_voucher.branch_code',Auth::user()->school_id)->get();
    }
      return view('finance.account.view-voucher',compact('id','voucherdetails','date'));
  }
  public function deletevoucher(Request $request,$id){
    $self='finance/account/voucher/delete';
    if (\Auth::user()->user_role!=='1'){
        $get_perm=permission::permitted($self);

        if ($get_perm=='access denied'){
            return redirect('permission-error')->with([
                'message' => 'You do not have permission to view this page.',
                'message_important'=>true
            ]);
        }
    }
    try{
    if($id!=null){
       DB::table('tb_voucher')->where('branch_code',Auth::user()->school_id)->where('voucher_no','=',$id)->delete();
        return redirect('finance/account/voucher')->with([
            'message' => "Voucher Details Deleted Successfully."
        ]);
    }else{
        return redirect('finance/account/voucher')->with([
            'message' => "Voucher Details Not Found",
            'message_important' => true
        ]);
    }
  }catch(\Illuminate\Database\QueryException $ex){
    return redirect('finance/account/voucher')->with([
         'message' => 'Someting Went Worng Please Contact Technical Team : '.$ex->getMessage(). '',
         'message_important'=>true
     ]);

  }
  }

  public function feewaiver(){
    $self='finance/fee/waiver';
    if (\Auth::user()->user_role!=='1'){
        $get_perm=permission::permitted($self);

        if ($get_perm=='access denied'){
            return redirect('permission-error')->with([
                'message' => 'You do not have permission to view this page.',
                'message_important'=>true
            ]);
        }
    }
     $category=DB::table('tb_studentcategory')->where('branch_code',Auth::user()->school_id)->get();
     $fee_category=DB::table('fee_category')->where('branch_code',Auth::user()->school_id)->get();
    $stu_info=DB::table('stu_admission')->where('branch_code',Auth::user()->school_id)->where('acadmic_year',app_config('Session',Auth::user()->school_id))->groupBy('reg_no')
    ->orderBy('reg_no','desc')
    ->get();
    $fee_waivier=DB::table('fee_waiver')
            ->join('stu_admission', 'fee_waiver.stu_reg_no', '=', 'stu_admission.reg_no')
            ->join('fee_category', 'fee_waiver.fee_category', '=', 'fee_category.id')
            ->select('fee_waiver.*', 'stu_admission.reg_no', 'stu_admission.stu_name', 'fee_category.fee_category')
            ->where('fee_waiver.acadmic_year',app_config('Session',Auth::user()->school_id))
            ->groupBy('fee_waiver.stu_reg_no')
            ->get();
    return view('finance.fee.fee-waiver',compact('fee_category','category','stu_info','fee_waivier'));
  }

  public function viewfeewaiver($id){
    $self='finance/waiver/view';
    if (\Auth::user()->user_role!=='1'){
        $get_perm=permission::permitted($self);

        if ($get_perm=='access denied'){
            return redirect('permission-error')->with([
                'message' => 'You do not have permission to view this page.',
                'message_important'=>true
            ]);
        }
    }
     $fee_category=DB::table('fee_category')->where('status',1)->where('branch_code',Auth::user()->school_id)->get();
    $stu_info=DB::table('stu_admission')->where('branch_code',Auth::user()->school_id)->where('acadmic_year',app_config('Session',Auth::user()->school_id))->groupBy('reg_no')
    ->orderBy('reg_no','desc')
    ->get();
    $data=DB::table('fee_waiver')->where('id','=',Crypt::decrypt($id))->first();

    return view('finance.fee.fee-waiver-view',compact('fee_category','stu_info','data'));
  }

function updatefeewaiver(Request $request){
  $this->validate($request, [
      'feecategory'=>'required',
      'fee_subcategory'=>'required',
      'student'=>'required',
      'type'=>'required',
      'amount'=>'required']);
  $fee_category=Input::get('feecategory');
  $fee_subcategory=Input::get('fee_subcategory');
  $type=Input::get('type');
  $student=Input::get('student');
  $amount=Input::get('amount');
  $id=Input::get('id');

  $data=array(
    "fee_category"=>$fee_category,
    "fee_subcategory"=>$fee_subcategory,
    "type"=>$type,
    "stu_reg_no"=>$student,
    "amt"=>$amount
  );
  DB::table('fee_waiver')->where('id',$id)->update($data);
  return redirect('finance/fee/waiver')->with([
       'message' => 'Fee waiver Successfully Updated for Registration No '.$student.''
   ]);
}

  public function savefeewaiver(Request $request){
    $this->validate($request, [
        'feecategory'=>'required',
        'wby'=>'required',
        'fee_subcategory'=>'required',
        'deduction_type'=>'required',
        'type'=>'required',
        'amount'=>'required']);
    $fee_category=Input::get('feecategory');
    $fee_subcategory=Input::get('fee_subcategory');
    $type=Input::get('type');
    $student=Input::get('student');
    $deduction_type=Input::get('deduction_type');
    $amount=Input::get('amount');
    $wby=Input::get('wby');
try {
     if($wby=="student"){
    $stuinfo=DB::table('stu_admission')->where('reg_no',$student)->where('acadmic_year',app_config('Session',Auth::user()->school_id))->orderBy('id','desc')->limit(1)->get();
    foreach ($stuinfo as $stuinfo) {
    $stu_class=$stuinfo->course;
  }
    $feeamt=DB::table('fee_master')->where('course',$stu_class)->where('feecategory',$fee_category)->where('fee_subcategory',$fee_subcategory)->limit(1)->get();

      foreach ($feeamt as $feeamt) {
         $amt=$feeamt->amount;
      }
      if($deduction_type=="%"){
        $amount=$amt*$amount/100;
      }
if($amt > $amount){
    $cnt=DB::table('fee_waiver')->where('stu_reg_no',$student)->where('acadmic_year',app_config('Session',Auth::user()->school_id))->where('branch_code',Auth::user()->school_id)->count();

    if($cnt=="0"){
    $savedata=DB::table('fee_waiver')->insert(['fee_category'=>$fee_category,'fee_subcategory'=>$fee_subcategory,'type'=>$type,
  'stu_reg_no'=>$student,'deduction_type'=>$deduction_type,'amt'=>$amount,'acadmic_year'=>app_config('Session',Auth::user()->school_id),'branch_code'=>Auth::user()->school_id]);
  if(!empty($savedata)){
    return redirect('finance/fee/waiver')->with([
         'message' => 'Fee waiver Successfully apply to Registration No '.$student.''
     ]);
   }else{
     return redirect('finance/fee/waiver')->with([
          'message' => 'Unable to Fee waive for '.$stu_name. '',
          'message_important'=>true
      ]);
   }
 }else{
   return redirect('finance/fee/waiver')->with([
        'message' => 'Fee waiver already apply for Registration No '.$student.' for this accadmic year.',
        'message_important'=>true
    ]);
 }


}else{
  return redirect('finance/fee/waiver')->with([
       'message' => 'Fee waiver Amount can not be greater than fee amount.',
       'message_important'=>true
   ]);
}

}else{
$category=Input::get('category');
$stu_list=DB::table('stu_admission')->where('category',$category)->where('branch_code',Auth::user()->school_id)->where('accdmic_year',app_config('Session',Auth::user()->school_id))->get();
//print_r($stu_list);exit;
if(count($stu_list) > 0){
foreach ($stu_list as $stu_list) {
 $student=$stu_list->reg_no;


$stuinfo=DB::table('stu_admission')->where('reg_no',$student)->where('acadmic_year',app_config('Session',Auth::user()->school_id))->orderBy('id','desc')->limit(1)->get();
foreach ($stuinfo as $stuinfo) {
$stu_class=$stuinfo->course;
}
$feeamt=DB::table('fee_master')->where('course',$stu_class)->where('feecategory',$fee_category)->where('fee_subcategory',$fee_subcategory)->limit(1)->get();
$amt=$amount=0;
  foreach ($feeamt as $feeamt) {
     $amt=$feeamt->amount;
  }
  if($deduction_type=="%"){
    $amount=$amt*$amount/100;
  }
//  echo $amt."-".$amount;exit;
if($amt > $amount){

$cnt=DB::table('fee_waiver')->where('stu_reg_no',$student)->where('acadmic_year',app_config('Session',Auth::user()->school_id))->where('branch_code',Auth::user()->school_id)->count();

if($cnt=="0"){
$savedata=DB::table('fee_waiver')->insert(['fee_category'=>$fee_category,'fee_subcategory'=>$fee_subcategory,'type'=>$type,
'stu_reg_no'=>$student,'deduction_type'=>$deduction_type,'amt'=>$amount,'acadmic_year'=>app_config('Session',Auth::user()->school_id),'branch_code'=>Auth::user()->school_id]);
if(!empty($savedata)){

}else{
 return redirect('finance/fee/waiver')->with([
      'message' => 'Unable to Fee waive for '.$stu_name. '',
      'message_important'=>true
  ]);
}
}else{
/*return redirect('finance/fee/waiver')->with([
    'message' => 'Fee waiver already apply for Registration No '.$student.' for this accadmic year.',
    'message_important'=>true
]);*/
}


}else{
return redirect('finance/fee/waiver')->with([
   'message' => 'Fee waiver Amount can not be greater than fee amount.',
   'message_important'=>true
]);
}
}

}else{
  return redirect('finance/fee/waiver')->with([
     'message' => 'Student not found in this Category.',
     'message_important'=>true
  ]);
}

return redirect('finance/fee/waiver')->with([
     'message' => 'Fee waiver Successfully apply for Category '.$category.''
 ]);
}


 } catch (\Exception $e) {
   return redirect('finance/fee/waiver')->with([
        'message' => 'Someting Went Worng Please Contact Technical Team.'.$e,
        'message_important'=>true
    ]);
 }

  }


  public function feewaiverstuinfo(Request $request){
    $reg_no = $request->reg_no;
    $sub_category = $request->sub_category;
    $category = $request->category;
    $stuinfo = DB::table('stu_admission')
                ->join('tb_course', 'stu_admission.course', '=', 'tb_course.id')
                ->join('tb_batch', 'stu_admission.batch', '=', 'tb_batch.id')
                ->select('stu_admission.*', 'tb_course.course_name', 'tb_batch.batch_name')
                ->where('stu_admission.reg_no',$reg_no)
                ->where('stu_admission.acadmic_year',app_config('Session',Auth::user()->school_id))
                ->orderBy('stu_admission.id','desc')->limit(1)
                ->get();

    foreach ($stuinfo as $stuinfo) {
    $stu_classid=$stuinfo->course;
    $stu_class=$stuinfo->course_name;
    $stu_name=$stuinfo->stu_name;
    $section=$stuinfo->batch_name;
    $acadmic_year=$stuinfo->acadmic_year;
  }
    $feeamt=DB::table('fee_master')->where('course',$stu_classid)->where('feecategory',$category)->where('fee_subcategory',$sub_category)->limit(1)->get();

      foreach ($feeamt as $feeamt) {
         $amt=$feeamt->amount;
      }
    echo $stu_name."|".$stu_class."|".$section."|".$acadmic_year."|".$amt;
  }


public function update_status_fee_category(Request $request,$status,$id){
    $self='finance/Fee-Category/delete';
    if (\Auth::user()->user_role!=='1'){
        $get_perm=permission::permitted($self);

        if ($get_perm=='access denied'){
            return redirect('permission-error')->with([
                'message' => 'You do not have permission to view this page.',
                'message_important'=>true
            ]);
        }
    }
  //  echo $status; exit;
  if($status==0){
    $status=1;
  }else{
    $status=0;
  }
  if($id!=null){
     DB::table('fee_category')->where('id','=',Crypt::decrypt($id))->update(["status"=>$status]);
      return redirect('finance/Fee-Category')->with([
          'message' => "Fee Category Status Updated Successfully."
      ]);
  }else{
      return redirect('finance/Fee-Category')->with([
          'message' => "Fee_Category Details Not Found",
          'message_important' => true
      ]);
  }
  }
  function viewfeecategory($id){
    $data=DB::table('fee_category')->where('id','=',Crypt::decrypt($id))->first();
    return view('finance.fee.fee_category-view',compact('data'));
  }
  function updatefeecategory(Request $request){
    $fee_category=Input::get('fee_category');
    $receipt_prefix=Input::get('receipt_prefix');
    $description=Input::get('description');
    $id=Input::get('id');
    $data=array(
      "fee_category"=>$fee_category,
      "receipt_prefix"=>$receipt_prefix,
      "discription"=>$description
    );
    DB::table('fee_category')->where('id','=',$id)->update($data);
    return redirect('finance/Fee-Category')->with([
        'message' => "Fee Category Updated Successfully."

    ]);
  }
  function view_fee_sub_category($id){
    $fee_category=DB::table('fee_category')->where('branch_code',Auth::user()->school_id)->get();

    $data=DB::table('fee_subcategory')->where('id','=',Crypt::decrypt($id))->first();
    return view('finance.fee.fee-subCategory-view',compact('data','fee_category'));

  }
  function updatefeesubcategory(Request $request){
    $fee_category=Input::get('fee_category');
    $sub_category=Input::get('sub_category');
    $fee_type=Input::get('fee_type');
    $id=Input::get('id');
    $data=array(
      "fee_category"=>$fee_category,
      "sub_category"=>$sub_category,
      "fee_type"=>$fee_type
    );
     DB::table('fee_subcategory')->where('id',$id)->update($data);
    return redirect('finance/Fee-SubCategory')->with([
                 'message' => 'Sub Category Updated Successfully'
             ]);
  }
  public function update_status_fee_subcategory(Request $request,$status,$id){
      $self='finance/Fee-subCategory/update';
      if (\Auth::user()->user_role!=='1'){
          $get_perm=permission::permitted($self);

          if ($get_perm=='access denied'){
              return redirect('permission-error')->with([
                  'message' => 'You do not have permission to view this page.',
                  'message_important'=>true
              ]);
          }
      }
    //  echo $status; exit;
    if($status==0){
      $status=1;
    }else{
      $status=0;
    }
    if($id!=null){
       DB::table('fee_subcategory')->where('id','=',Crypt::decrypt($id))->update(["status"=>$status]);
        return redirect('finance/Fee-SubCategory')->with([
            'message' => "Fee Category Status Updated Successfully."
        ]);
    }else{
        return redirect('finance/Fee-SubCategory')->with([
            'message' => "Fee_Category Details Not Found",
            'message_important' => true
        ]);
    }
    }

  public function delete_fee_sub_category_fine(Request $request,$id){
    $self='finance/Fee-Sub-Category-fine/delete';
    $get_perm=permission::permitted($self);
        if ($get_perm=='access denied'){
            return redirect('permission-error')->with([
                'message' => 'You do not have permission to view this page',
                'message_important'=>true
            ]);
        }
  if($id!=null){
     DB::table('fee_category')->where('id','=',Crypt::decrypt($id))->delete();
      return redirect('finance/Fee-SubCategory/fine')->with([
          'message' => "Fee Sub Category Fine Details Deleted Successfully."
      ]);
  }else{
      return redirect('finance/Fee-SubCategory/fine')->with([
          'message' => "Fee Sub Category Fine Details Not Found",
          'message_important' => true
      ]);
  }
  }
  public function update_status_fee_subcategory_fine(Request $request,$status,$category,$subcategory){
      $self='finance/Fee-subCategory-fine/update';
      if (\Auth::user()->user_role!=='1'){
          $get_perm=permission::permitted($self);

          if ($get_perm=='access denied'){
              return redirect('permission-error')->with([
                  'message' => 'You do not have permission to view this page.',
                  'message_important'=>true
              ]);
          }
      }
    //  echo $status; exit;
    if($status==0){
      $status=1;
    }else{
      $status=0;
    }
    if($category!=null){
       DB::table('subcategory_fine')->where('fee_category','=',Crypt::decrypt($category))
       ->where('fee_subcategory','=',Crypt::decrypt($subcategory))
       ->update(["status"=>$status]);
        return redirect('finance/Fee-SubCategory/fine')->with([
            'message' => "Fee Sub Category Fine Status Updated Successfully."
        ]);
    }else{
        return redirect('finance/Fee-SubCategory/fine')->with([
            'message' => "Fee Sub Category Fine Details Not Found",
            'message_important' => true
        ]);
    }
    }
    function update_fee_subcategory_fine($id,$category,$subcategory){
      echo Crypt::decrypt($id);
    }
}
?>
