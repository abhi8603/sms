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
use Illuminate\Support\Facades\Crypt;
date_default_timezone_set('Asia/Kolkata');
class StockController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
      $this->middleware('SchoolMiddleware');
  }

  public function item_category(Request $request)
  {
  	//return view('Stock.add_category');
  	$self='stock/item_category';
    if (\Auth::user()->user_role!=='1'){
        $get_perm=permission::permitted($self);

        if ($get_perm=='access denied'){
            return redirect('permission-error')->with([
                'message' => 'You do not have permission to view this page.',
                'message_important'=>true
            ]);
        }
    }
     $categorylist=DB::table('tb_category')->where('branch_code',Auth::user()->school_id)->get();
   return view('Stock.add_category',compact('categorylist'));
  }

  public function insert_item_category(Request $request)
  {

  $self='stock/item_category';
    if (\Auth::user()->user_role!=='1'){
        $get_perm=permission::permitted($self);

        if ($get_perm=='access denied'){
            return redirect('permission-error')->with([
                'message' => 'You do not have permission to view this page.',
                'message_important'=>true
            ]);
        }
    }
       $category_name=Input::get('category_name');
      $description=Input::get('description');
      $created_date = date('d-m-Y H:i:s');
       $this->validate($request, [
      'category_name'=>'required|string|max:255|unique:tb_category',
      ]);
      $exam=DB::table('tb_category')->insert(['category_name'=>$category_name,'description'=>$description,'academic_year'=>app_config('Session',Auth::user()->school_id),'created_date'=>$created_date,'branch_code'=>Auth::user()->school_id]);

      if(!empty($exam)){
         return redirect('stock/item_category')->with([
                 'message' => 'item category is Added Succesfully.'
             ]);
       }else{
              return redirect('stock/item_category')->with([
                   'message' => 'category Added failed.',
                   'message_important'=>true
               ]);
            }
        }

        public function item_store(Request $request)
        {
        	$self='stock/item_store';
    if (\Auth::user()->user_role!=='1'){
        $get_perm=permission::permitted($self);

        if ($get_perm=='access denied'){
            return redirect('permission-error')->with([
                'message' => 'You do not have permission to view this page.',
                'message_important'=>true
            ]);
        }
    }
     $itemlist=DB::table('item_store')->where('branch_code',Auth::user()->school_id)->get();
   return view('Stock.add_item_store',compact('itemlist'));
        }


   public function insert_item_store(Request $request)
        {
          $self='stock/item_store';
    if (\Auth::user()->user_role!=='1'){
        $get_perm=permission::permitted($self);

        if ($get_perm=='access denied'){
            return redirect('permission-error')->with([
                'message' => 'You do not have permission to view this page.',
                'message_important'=>true
            ]);
        }
    }
       $item_store_name=Input::get('item_store_name');
       $item_stock_code=Input::get('item_stock_code');
      $description=Input::get('description');
      $created_date = date('d-m-Y H:i:s');

      $exam=DB::table('item_store')->insert(['item_store_name'=>$item_store_name,'item_stock_code'=>$item_stock_code,'description'=>$description,'academic_year'=>app_config('Session',Auth::user()->school_id),'created_date'=>$created_date,'branch_code'=>Auth::user()->school_id]);

      if(!empty($exam)){
         return redirect('stock/item_store')->with([
                 'message' => 'item Store is Added Succesfully.'
             ]);
       }else{
              return redirect('stock/item_store')->with([
                   'message' => 'Item Added failed.',
                   'message_important'=>true
               ]);
            }
        }


      public function item_supplier(Request $request)
      {
        $self='stock/item_supplier';
    if (\Auth::user()->user_role!=='1'){
        $get_perm=permission::permitted($self);

        if ($get_perm=='access denied'){
            return redirect('permission-error')->with([
                'message' => 'You do not have permission to view this page.',
                'message_important'=>true
            ]);
        }
    }
     $supplier=DB::table('item_supplier')->where('branch_code',Auth::user()->school_id)->get();
      return view('Stock.add_item_supplier',compact('supplier'));
      }


      public function insert_item_supplier(Request $request)
      {
        $self='stock/item_supplier';
    if (\Auth::user()->user_role!=='1'){
        $get_perm=permission::permitted($self);

        if ($get_perm=='access denied'){
            return redirect('permission-error')->with([
                'message' => 'You do not have permission to view this page.',
                'message_important'=>true
            ]);
        }

    }
       $name=Input::get('name');
       $phone=Input::get('phone');
       $email=Input::get('email');
       $address=Input::get('address');
       $contact_person_name=Input::get('contact_person_name');
       $contact_person_phone=Input::get('contact_person_phone');
       $contact_person_email=Input::get('contact_person_email');
       $description=Input::get('description');
       $created_date = date('d-m-Y H:i:s');

       $save=DB::table('item_supplier')->insert(['name'=>$name,'phone'=>$phone,'email'=>$email,'address'=>$address,'contact_person_name'=>$contact_person_name,'contact_person_phone'=>$contact_person_phone,'contact_person_email'=>$contact_person_email,'description'=>$description,'academic_year'=>app_config('Session',Auth::user()->school_id),'created_date'=>$created_date,'branch_code'=>Auth::user()->school_id]);
       if(!empty($save)){
         return redirect('stock/item_supplier')->with([
                 'message' => 'item Supplier is Added Succesfully.'
             ]);
       }else{
              return redirect('stock/item_supplier')->with([
                   'message' => 'Item Supplier Added failed.',
                   'message_important'=>true
               ]);
            }
      }


  public function add_item(Request $request)
  {
       $category=DB::table('tb_category')->where('branch_code',Auth::user()->school_id)->get();
       $item=DB::table('tb_item')
       ->Leftjoin('item_stock','tb_item.id','=','item_stock.item')
       ->join('tb_category','tb_item.category','=','tb_category.id')
       ->select('tb_item.item_name', 'tb_item.id', 'item_stock.qty','tb_category.category_name')
       ->where('tb_item.branch_code',Auth::user()->school_id)
       ->get();
       return view('Stock.add_item',compact('category','item'));
    }

    function view_item($id){
      $id=Crypt::decrypt($id);
      $category=DB::table('tb_category')->where('branch_code',Auth::user()->school_id)->get();
      $item=DB::table('tb_item')->where('id',$id)->first();
      return view('Stock.view_item',compact('category','item'));
    }

  public function insert_item(Request $request)
  {
    $self='stock/add_item';
    if (\Auth::user()->user_role!=='1'){
        $get_perm=permission::permitted($self);

        if ($get_perm=='access denied'){
            return redirect('permission-error')->with([
                'message' => 'You do not have permission to view this page.',
                'message_important'=>true
            ]);
        }
    }

        $item=Input::get('item');
        $category=Input::get('category');

       $description=Input::get('description');
       $created_date = date('d-m-Y H:i:s');

       $save=DB::table('tb_item')->insert(['item_name'=>$item,'category'=>$category,'description'=>$description,'academic_year'=>app_config('Session',Auth::user()->school_id),'created_date'=>$created_date,'branch_code'=>Auth::user()->school_id]);
       if(!empty($save)){
         return redirect('stock/add_item')->with([
                 'message' => 'item  is Added Succesfully.'
             ]);
       }else{
              return redirect('stock/add_item')->with([
                   'message' => 'Item  Added failed.',
                   'message_important'=>true
               ]);
   }

  }
function update_item(Request $request){
  $self='stock/add_item';
  if (\Auth::user()->user_role!=='1'){
      $get_perm=permission::permitted($self);

      if ($get_perm=='access denied'){
          return redirect('permission-error')->with([
              'message' => 'You do not have permission to view this page.',
              'message_important'=>true
          ]);
      }
  }

      $item=Input::get('item');
      $category=Input::get('category');
      $id=Input::get('id');
      $description=Input::get('description');
      $created_date = date('d-m-Y H:i:s');

     $save=DB::table('tb_item')->where('id',$id)->update(['item_name'=>$item,'category'=>$category,'description'=>$description,'academic_year'=>app_config('Session',Auth::user()->school_id),'created_date'=>$created_date,'branch_code'=>Auth::user()->school_id]);
     if(!empty($save)){
       return redirect('stock/add_item')->with([
               'message' => 'item  Updated Succesfully.'
           ]);
     }else{
            return redirect('stock/add_item')->with([
                 'message' => 'Item  update failed.',
                 'message_important'=>true
             ]);
 }
}
  public function add_item_stock(Request $request)
  {
     $category=DB::table('tb_category')->where('branch_code',Auth::user()->school_id)->get();
     $item=DB::table('tb_item')->where('branch_code',Auth::user()->school_id)->get();
     $supplier=DB::table('item_supplier')->where('branch_code',Auth::user()->school_id)->get();
     $store=DB::table('item_store')->where('branch_code',Auth::user()->school_id)->get();


     $stock=DB::table('item_stock')
     ->join('tb_item','item_stock.item','=','tb_item.id')
     ->join('tb_category','item_stock.category','=','tb_category.id')
     ->join('item_supplier','item_stock.supplier','=','item_supplier.id')
     ->join('item_store','item_stock.store','=','item_store.id')
     ->select('item_stock.*','item_store.item_store_name','tb_item.item_name','tb_category.category_name','item_supplier.supplier_name')
     ->get();
    // print_r($stock); exit;
  return view('Stock.item_stock',compact('category','item','supplier','store','stock'));
  }
  function delete_item_stock($id){
    if($id){
      DB::table('item_stock')->where('id',$id)->delete();
      return redirect('stock/add_item_stock')->with([
           'message' => 'Stock Deleted Succesfully.'
       ]);
    }else{
      return redirect('stock/add_item_stock')->with([
           'message' => 'Unable to delete stock.',
           'message_important'=>true
       ]);
    }
  }
  function view_item_stock($id){
    $id=Crypt::decrypt($id);
    $category=DB::table('tb_category')->where('branch_code',Auth::user()->school_id)->get();
    $item=DB::table('tb_item')->where('branch_code',Auth::user()->school_id)->get();
    $supplier=DB::table('item_supplier')->where('branch_code',Auth::user()->school_id)->get();
    $store=DB::table('item_store')->where('branch_code',Auth::user()->school_id)->get();

    $stock=DB::table('item_stock')
    ->join('tb_item','item_stock.item','=','tb_item.id')
    ->join('tb_category','item_stock.category','=','tb_category.id')
    ->join('item_supplier','item_stock.supplier','=','item_supplier.id')
    ->join('item_store','item_stock.store','=','item_store.id')
    ->select('item_stock.*','item_store.id as item_store_id','tb_item.id as tb_item_id','tb_category.id as tb_category_id','item_supplier.id as item_supplier_id')
    ->where('item_stock.id',$id)
    ->get();
    // print_r($stock); exit;
    return view('Stock.view_item_stock',compact('category','item','supplier','store','stock'));
  }

    public function insert_item_stock(Request $request)
    {
      $self='stock/add_item_stock';
    if (\Auth::user()->user_role!=='1'){
        $get_perm=permission::permitted($self);

        if ($get_perm=='access denied'){
            return redirect('permission-error')->with([
                'message' => 'You do not have permission to view this page.',
                'message_important'=>true
            ]);
        }
    }

      $category=Input::get('category');
      $item=Input::get('item');
      $supplier=Input::get('supplier');
      $store=Input::get('store');
      $qty=Input::get('qty');
      $date=Input::get('date');
      $description=Input::get('description');
      $created_date = date('d-m-Y H:i:s');
    if(isset($_FILES['file'])){
     $file_name = $_FILES['file']['name'];
     $file_size =$_FILES['file']['size'];
     $file_tmp =$_FILES['file']['tmp_name'];
     $file_type=$_FILES['file']['type'];
  //   $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));

  if($file_size > 2097152){
           //$errors[]='File size must be excately 2 MB';
           return redirect('stock/add_item_stock')->with([
                'message' => 'Document size must be less than or equal to 2 MB.',
                'message_important'=>true
            ]);
        }

        if(empty($errors)==true){
                   if(move_uploaded_file($file_tmp,"assets/uploads/stock/".$file_name)){
                     $path="assets/uploads/stock/".$file_name;
                   }else{
                     return redirect('stock/add_item_stock')->with([
                          'message' => 'Unable to upload file.',
                          'message_important'=>true
                      ]);
                   }
                  // $path="assets/uploads/stock".$file_name;
              }
      }else{
        $path="";
      }

      $save=DB::table('item_stock')->insert(['category'=>$category,'item'=>$item,'supplier'=>$supplier,'store'=>$store,'qty'=>$qty,'date'=>$date,'document'=>$path,'description'=>$description,'academic_year'=>app_config('Session',Auth::user()->school_id),'created_date'=>$created_date,'branch_code'=>Auth::user()->school_id]);

       if(!empty($save)){
         return redirect('stock/add_item_stock')->with([
                 'message' => 'item  is Added Succesfully.'
             ]);
       }else{
              return redirect('stock/add_item_stock')->with([
                   'message' => 'Item  Added failed.',
                   'message_important'=>true
               ]);
   }

    }
    public function update_item_stock(Request $request)
    {
      $self='stock/add_item_stock';
    if (\Auth::user()->user_role!=='1'){
        $get_perm=permission::permitted($self);

        if ($get_perm=='access denied'){
            return redirect('permission-error')->with([
                'message' => 'You do not have permission to view this page.',
                'message_important'=>true
            ]);
        }
    }

      $category=Input::get('category');
      $item=Input::get('item');
      $id=Input::get('id');
      $supplier=Input::get('supplier');
      $store=Input::get('store');
      $qty=Input::get('qty');
      $date=Input::get('date');
      $description=Input::get('description');
      $created_date = date('d-m-Y H:i:s');
      if($_FILES['file']['name'] !=""){
    if(isset($_FILES['file'])){
     $file_name = $_FILES['file']['name'];
     $file_size =$_FILES['file']['size'];
     $file_tmp =$_FILES['file']['tmp_name'];
     $file_type=$_FILES['file']['type'];
  //   $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));

  if($file_size > 2097152){
           //$errors[]='File size must be excately 2 MB';
           return redirect('stock/add_item_stock')->with([
                'message' => 'Document size must be less than or equal to 2 MB.',
                'message_important'=>true
            ]);
        }

        if(empty($errors)==true){
                   if(move_uploaded_file($file_tmp,"assets/uploads/stock/".$file_name)){
                     $path="assets/uploads/stock/".$file_name;
                     DB::table('item_stock')->where('id',$id)->update(['document'=>$path]);
                   }else{
                     return redirect('stock/add_item_stock')->with([
                          'message' => 'Unable to upload file.',
                          'message_important'=>true
                      ]);
                   }
                  // $path="assets/uploads/stock".$file_name;
              }
      }else{
      //  $path="";
      }
}
      $save=DB::table('item_stock')->where('id',$id)->update(['category'=>$category,'item'=>$item,'supplier'=>$supplier,'store'=>$store,'qty'=>$qty,'date'=>$date,'description'=>$description,'academic_year'=>app_config('Session',Auth::user()->school_id),'created_date'=>$created_date,'branch_code'=>Auth::user()->school_id]);

       if(!empty($save)){
         return redirect('stock/add_item_stock')->with([
                 'message' => 'item  is Updated Succesfully.'
             ]);
       }else{
              return redirect('stock/add_item_stock')->with([
                   'message' => 'Unable to Update.',
                   'message_important'=>true
               ]);
   }

    }

    public function issue_item(Request $request)
    {
         return view('Stock.issue_item');
    }

    public function add_issue_item(Request $request)
    {
   $students=DB::table('stu_admission')->where('branch_code',Auth::user()->school_id)->get();
   $employess=DB::table('emp_details')->where('branch_code',Auth::user()->school_id)->get();
   $category=DB::table('tb_category')->where('branch_code',Auth::user()->school_id)->get();
      return view('Stock.add_issue',compact('students','employess','category'));
    }

    public function itemlist(Request $request)
    {
     $eid = $request->eid;
   $itemlist = DB::table('tb_item')->select('id','item_name')->where('branch_code',Auth::user()->school_id)->where('category',$eid)->get();
   //$batch=DB::table('tb_batch')->where('course',$eid)->orderBy('id','desc')->get();
  $cart = array();
   foreach($itemlist as $itemlist){
    array_push($cart,$itemlist);
   }
    echo json_encode($cart);
    }


    public function insert_issue_item(Request $request)
    {
       $self='stock/issue_item';
    if (\Auth::user()->user_role!=='1'){
        $get_perm=permission::permitted($self);

        if ($get_perm=='access denied'){
            return redirect('permission-error')->with([
                'message' => 'You do not have permission to view this page.',
                'message_important'=>true
            ]);
        }
    }
        $user_type=Input::get('user_type');

    $issue_by=Input::get('issue_by');
    $issue_date=Input::get('issue_date');
    $return_date=Input::get('return_date');
    $note=Input::get('note');
    $category=Input::get('category');
    $item=Input::get('item');
    $qty=Input::get('qty');
    $created_date = date('d-m-Y H:i:s');
    if($user_type=='student')
    {
    $user_type=Input::get('user_type');
    $issue_by_student=Input::get('issue_by_student');
    $issue_by=Input::get('issue_by');
    $issue_date=Input::get('issue_date');
    $return_date=Input::get('return_date');
    $note=Input::get('note');
    $category=Input::get('category');
    $item=Input::get('item');
    $qty=Input::get('qty');
    $created_date = date('d-m-Y H:i:s');
    $save=DB::table('issue_item')->insert(['user_type'=>$user_type,'issue_to'=>$issue_by_student,'issue_by'=>$issue_by,'issue_date'=>$issue_date,'return_date'=>$return_date,'note'=>$note,'category'=>$category,'item'=>$item,'qty'=>$qty,'academic_year'=>app_config('Session',Auth::user()->school_id),'created_date'=>$created_date,'branch_code'=>Auth::user()->school_id]);
  }
  else
  {
    $user_type=Input::get('user_type');
    $issue_by_emp=Input::get('issue_by_emp');
    $issue_by=Input::get('issue_by');
    $issue_date=Input::get('issue_date');
    $return_date=Input::get('return_date');
    $note=Input::get('note');
    $category=Input::get('category');
    $item=Input::get('item');
    $qty=Input::get('qty');
     $created_date = date('d-m-Y H:i:s');

    $save=DB::table('issue_item')->insert(['user_type'=>$user_type,'issue_to'=>$issue_by_emp,'issue_by'=>$issue_by,'issue_date'=>$issue_date,'return_date'=>$return_date,'note'=>$note,'category'=>$category,'item'=>$item,'qty'=>$qty,'academic_year'=>app_config('Session',Auth::user()->school_id),'created_date'=>$created_date,'branch_code'=>Auth::user()->school_id]);
  }
    if(!empty($save)){
         return redirect('stock/add_issue_item')->with([
                 'message' => 'Issue Succes.'
             ]);
       }else{
              return redirect('stock/add_issue_item')->with([
                   'message' => 'failed to Issue.',
                   'message_important'=>true
               ]);

    }
  }

  public function all_issue(Request $request)
  {
     $utype=$request->user_type; ;
     if($utype=='student')
     {
      $issue=DB::table('issue_item')
    ->join('tb_item','issue_item.item','=','tb_item.id')
    ->join('tb_category','issue_item.category','=','tb_category.id')
    ->join('stu_admission','issue_item.issue_to','=','stu_admission.reg_no')

    ->where('issue_item.branch_code',Auth::user()->school_id)
    ->where('issue_item.user_type',$utype)
    ->get();
     }
     else
     {
      $issue=DB::table('issue_item')
    ->join('tb_item','issue_item.item','=','tb_item.id')
    ->join('tb_category','issue_item.category','=','tb_category.id')
    ->select('issue_item.*', 'tb_item.item_name','tb_category.category_name')
    ->join('emp_details','issue_item.issue_to','=','emp_details.empcode')
    ->where('issue_item.branch_code',Auth::user()->school_id)
    ->where('issue_item.user_type',$utype)
    ->get();
     }

    echo $issue;
  }

  public function update_stock_status($id)
  {
    DB::table('issue_item')->where('branch_code',Auth::user()->school_id)->where('id',$id)->update(['status'=>'0']);
    return redirect('stock/issue_item')->with([
               'message' => 'Item Return Successfully.'
    ]);
  }
}


 ?>
