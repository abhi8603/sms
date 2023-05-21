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
class EmployeeDocTypeMstr extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
      $this->middleware('SchoolMiddleware');
  }
  public function employeeDocList(Request $request){
    $docList = DB::table('tbl_emp_doc_mstr')
                      ->where('status',1)
                      ->orderBy('id','DESC')
                      ->get();
    $docList = json_encode($docList,true);
    $docList = json_decode($docList,true);
    return view('Hr_Payroll.emp_management.doc_type_list',compact('docList'));
  }
  public function add_update(Request $request,$id=null){
    if($request->isMethod('post')){
        $doc_name=trim(Input::get('doc_name'));
        $id=trim(Input::get('id'));
        if($id==""){
          $checkData=DB::table('tbl_emp_doc_mstr')
                      ->where(DB::raw('upper(doc_name)'),strtoupper($doc_name))
                      ->where('status',1)
                      ->get();
                      $checkData =json_encode($checkData,true);
                      $checkData=json_decode($checkData,true);
            if($checkData){
              echo "<script>alert('Document Already Exists!!');</script>";
                return view('Hr_Payroll.emp_management.addDocType',compact('doc_name'));
            }else{
              $insertData = DB::table('tbl_emp_doc_mstr')->insertGetId([
                'doc_name'=>$doc_name
                ]);
                if($insertData){
                    return redirect('emp/doc/mstr/list')
                          ->with([
                         'message' =>'Document Type Added Successfully!!!'
                    ]);
                }else{
                  echo "<script>alert('Something Wrong!!');</script>";
                  return view('Hr_Payroll.emp_management.addDocType',compact('doc_name'));
                }
            }
          }else{ //Update Statement
             
            $checkUpdate = DB::table('tbl_emp_doc_mstr')
                  ->where(DB::raw('upper(doc_name)'),strtoupper($doc_name))
                  ->where(DB::raw('md5(id)'),'!=',$id)
                  ->where('status',1)
                  ->get();
                  $checkUpdate =json_encode($checkUpdate,true);
                  $checkUpdate =json_decode($checkUpdate,true);
             
            if($checkUpdate){
              echo "<script>alert('Document Already Exists!!');</script>";
              return view('Hr_Payroll.emp_management.addDocType',compact('doc_name','id'));
            }else{
              $updateData = DB::table('tbl_emp_doc_mstr')
                      ->where(DB::raw('md5(id)'),$id)
                      ->update([
                      'doc_name'=>$doc_name
                      ]);
             
              if($updateData){
                return redirect('emp/doc/mstr/list')
                      ->with([
                              'message' =>'Document Type Updated Successfully!!'
                             ]);
              }else{
                echo "<script>alert('Fail To Update Document!!!');</script>";
                return view('Hr_Payroll.emp_management.addDocType',compact('doc_name','id'));
              }
            }
          }
        }else if(isset($id)){
          $updateData = DB::table('tbl_emp_doc_mstr')
                      ->where(DB::raw('md5(id)'),$id)
                      ->where('status',1)
                      ->first();
            $updateData = json_encode($updateData,true);
            $updateData =json_decode($updateData,true);
            $doc_name =$updateData['doc_name'];
            $id =$updateData['id'];
            return view('Hr_Payroll.emp_management.addDocType',compact('doc_name','id'));

        }else{
          return view('Hr_Payroll.emp_management.addDocType');
        }
  }
  public function delete(Request $request,$id=null){
    $query = DB::table('tbl_emp_doc_mstr')
            ->where(DB::raw('md5(id)'),$id)
              ->update([
            'status'=>0
            ]);
    if($query){
      return redirect('emp/doc/mstr/list')
                   ->with([
                   'message' =>'Document Type Deleted Successfully!!!'
                ]);
    }else{
      return redirect('emp/doc/mstr/list')
                    ->with([
                   'message' =>'Fail To Delete Document Type!!!'
                ]);
    }
  }
}
?>
