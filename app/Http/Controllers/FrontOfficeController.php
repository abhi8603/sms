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
class FrontOfficeController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
      $this->middleware('SchoolMiddleware');
  }

  public function office_setup(Request $request)
    {
      $purpose=DB::table('tb_purpose')->where('branch_code',Auth::user()->school_id)->orderBy('id','desc')->get();
      $complain=DB::table('tb_complain')->where('branch_code',Auth::user()->school_id)->orderBy('id','desc')->get();
      $source=DB::table('tb_source')->where('branch_code',Auth::user()->school_id)->orderBy('id','desc')->get();
      $reference=DB::table('tb_reference')->where('branch_code',Auth::user()->school_id)->orderBy('id','desc')->get();
        return view('FrontOffice.office_setup',compact('purpose','complain','source','reference'));
    }

    public function purpose(Request $request)
    {
      $purpose=Input::get('purpose');
      $description=Input::get('description');
      $created_date = date('d-m-Y H:i:s');

      $save=DB::table('tb_purpose')->insert(['purpose'=>$purpose,'description'=>$description,'academic_year'=>app_config('Session',Auth::user()->school_id),'created_date'=>$created_date,'branch_code'=>Auth::user()->school_id]);

      if(!empty($save)){
         return redirect('FrontOffice/office_setup')->with([
                 'message' => 'Purpose Save Succesfully .'
             ]);
       }else{
              return redirect('FrontOffice/office_setup')->with([
                   'message' => 'Faied To Add Purpose.',
                   'message_important'=>true
               ]);
            }
    }


    public function delete_purpose(Request $request,$id)
    {
       if($id!=null){
           DB::table('tb_purpose')->where('id',$id)->where('branch_code',Auth::user()->school_id)->delete();

            return redirect('FrontOffice/office_setup')->with([
                'message' => "Purpose  Deleted Successfully."
            ]);
        }else{
            return redirect('FrontOffice/office_setup')->with([
                'message' => "Purpose Details Not Found",
                'message_important' => true
            ]);
      }
    }

    public function complain_type(Request $request)
    {
      $complain_type=Input::get('complain_type');
      $description=Input::get('description');
      $created_date = date('d-m-Y H:i:s');

      $save=DB::table('tb_complain')->insert(['complain_type'=>$complain_type,'description'=>$description,'academic_year'=>app_config('Session',Auth::user()->school_id),'created_date'=>$created_date,'branch_code'=>Auth::user()->school_id]);

      if(!empty($save)){
         return redirect('FrontOffice/office_setup')->with([
                 'message' => 'Purpose Save Succesfully .'
             ]);
       }else{
              return redirect('FrontOffice/office_setup')->with([
                   'message' => 'Faied To Add Purpose.',
                   'message_important'=>true
               ]);
            }
    }


    public function delete_complain(Request $request,$id)
    {
       if($id!=null){
           DB::table('tb_complain')->where('id',$id)->where('branch_code',Auth::user()->school_id)->delete();

            return redirect('FrontOffice/office_setup')->with([
                'message' => "Complain  Deleted Successfully."
            ]);
        }else{
            return redirect('FrontOffice/office_setup')->with([
                'message' => "Complain Details Not Found",
                'message_important' => true
            ]);
      }
    }

    public function insert_source(Request $request)
    {
      $source=Input::get('source');
      $description=Input::get('description');
      $created_date = date('d-m-Y H:i:s');

      $save=DB::table('tb_source')->insert(['source'=>$source,'description'=>$description,'academic_year'=>app_config('Session',Auth::user()->school_id),'created_date'=>$created_date,'branch_code'=>Auth::user()->school_id]);

      if(!empty($save)){
         return redirect('FrontOffice/office_setup')->with([
                 'message' => 'Purpose Save Succesfully .'
             ]);
       }else{
              return redirect('FrontOffice/office_setup')->with([
                   'message' => 'Faied To Add Purpose.',
                   'message_important'=>true
               ]);
            }
    }

     public function delete_sources(Request $request,$id)
    {
       if($id!=null){
           DB::table('tb_source')->where('id',$id)->where('branch_code',Auth::user()->school_id)->delete();

            return redirect('FrontOffice/office_setup')->with([
                'message' => "Source  Deleted Successfully."
            ]);
        }else{
            return redirect('FrontOffice/office_setup')->with([
                'message' => "Source Details Not Found",
                'message_important' => true
            ]);
      }
    }



    public function insert_reference(Request $request)
    {
        $reference=Input::get('reference');
      $description=Input::get('description');
      $created_date = date('d-m-Y H:i:s');

      $save=DB::table('tb_reference')->insert(['reference'=>$reference,'description'=>$description,'academic_year'=>app_config('Session',Auth::user()->school_id),'created_date'=>$created_date,'branch_code'=>Auth::user()->school_id]);

      if(!empty($save)){
         return redirect('FrontOffice/office_setup')->with([
                 'message' => 'Reference Save Succesfully .'
             ]);
       }else{
              return redirect('FrontOffice/office_setup')->with([
                   'message' => 'Faied To Add Purpose.',
                   'message_important'=>true
               ]);
            }
    }

     public function delete_references(Request $request,$id)
    {
       if($id!=null){
           DB::table('tb_reference')->where('id',$id)->where('branch_code',Auth::user()->school_id)->delete();

            return redirect('FrontOffice/office_setup')->with([
                'message' => "Reference  Deleted Successfully."
            ]);
        }else{
            return redirect('FrontOffice/office_setup')->with([
                'message' => "Reference Details Not Found",
                'message_important' => true
            ]);
      }
    }

 public function admission_enquiry(Request $request)
  {
    $source=DB::table('tb_source')->where('branch_code',Auth::user()->school_id)->orderBy('id','desc')->get();
    $reference=DB::table('tb_reference')->where('branch_code',Auth::user()->school_id)->orderBy('id','desc')->get();
  $course=DB::table('tb_course')->where('branch_code',Auth::user()->school_id)->orderBy('id','desc')->get();
    
     return view('FrontOffice.admission_enquiry',compact('course','source','reference'));

  }

  public function insert_admission_enquiry(Request $request)
  {
          $name=Input::get('name');
          $phone=Input::get('phone');
          $email=Input::get('email');
          $address=Input::get('address');

          $description=Input::get('description');
          $note=Input::get('note');
          $date=Input::get('date');
          $next_allow_date=Input::get('next_allow_date');
          $assigned=Input::get('assigned');
          $resourse=Input::get('resourse');
          $reference=Input::get('reference');
          $course=Input::get('course');
          $number_of_child=Input::get('number_of_child');
      $created_date = date('d-m-Y H:i:s');
       
      $exam=DB::table('admission_enquiry')->insert(['name'=>$name,'phone'=>$phone,'email'=>$email,'address'=>$address,'description'=>$description,'note'=>$note,'date'=>$date,'next_follow_date'=>$next_allow_date,'assigned'=>$assigned,'resourse'=>$resourse,'admission_reference'=>$reference,'course'=>$course,'number_of_child'=>$number_of_child,'academic_year'=>app_config('Session',Auth::user()->school_id),'created_date'=>$created_date,'branch_code'=>Auth::user()->school_id]);

      if(!empty($exam)){
         return redirect('FrontOffice/admission_enquiry')->with([
                 'message' => 'Enquiry Save Succesfully .'
             ]);
       }else{
              return redirect('FrontOffice/admission_enquiry')->with([
                   'message' => 'Faied To Add Enquiry.',
                   'message_important'=>true
               ]);
            }
  }

  public  function show_admission_enquiry(Request $request)
  {
    $start_date=$request->start_date;
    $end_date=$request->end_date;
    $source=$request->source;
    $enq=DB::table('admission_enquiry')
    ->where('branch_code',Auth::user()->school_id)
    ->whereBetween('date',[$start_date,$end_date])
    ->where('resourse',$source)
    ->get();
    echo $enq;

  }

  public function visitor_book(Request $request)
  {
    $visitor=DB::table('visitor_book')
    ->join('tb_purpose','visitor_book.purpose_id','=','tb_purpose.id')
    ->select('visitor_book.*','tb_purpose.purpose')
     ->where('visitor_book.branch_code',Auth::user()->school_id)
     ->get();
     $purpose=DB::table('tb_purpose')->where('branch_code',Auth::user()->school_id)->orderBy('id','desc')->get();
    

    return view('FrontOffice.visitor_book',compact('purpose','visitor'));

  }

  public function insert_visitor_book(Request $request)
  {
    $purpose=Input::get('purpose');
    $name=Input::get('name');
    $phone=Input::get('phone');
    $id_card=Input::get('id_card');
    $number_of_person=Input::get('number_of_person');
    $date=Input::get('date');
    $in_date=Input::get('in_time');
    $out_date=Input::get('out_time');
    $note=Input::get('note');
    $created_date = date('d-m-Y H:i:s');
   
   $visitor= DB::table('visitor_book')
    ->insert(['purpose_id'=>$purpose,'name'=>$name,'phone'=>$phone,'id_card'=>$id_card,'number_of_person'=>$number_of_person,'date'=>$date,'in_time'=>$in_date,'out_time'=>$out_date,'note'=>$note,'academic_year'=>app_config('Session',Auth::user()->school_id),'created_date'=>$created_date,'branch_code'=>Auth::user()->school_id]);
    if(!empty($visitor)){
         return redirect('FrontOffice/visitor_book')->with([
                 'message' => 'Visitor is Added Succesfully.'
             ]);
       }else{
              return redirect('FrontOffice/visitor_book')->with([
                   'message' => 'Visitor Added failed.',
                   'message_important'=>true
               ]);
            }

  }
   public function visitor_delete(Request $request,$id)
      {
       
    $self='FrontOffice/visitor_book';
    if (\Auth::user()->user_role!=='1'){
        $get_perm=permission::permitted($self);

        if ($get_perm=='access denied'){
            return redirect('permission-error')->with([
                'message' => 'You do not have permission to view this page',
                'message_important'=>true
            ]);
        }
    }
        if($id!=null){
           DB::table('visitor_book')->where('id',$id)->where('branch_code',Auth::user()->school_id)->delete();
          
            return redirect('FrontOffice/visitor_book')->with([
                'message' => "Visitor Details Deleted Successfully."
            ]);
        }else{
            return redirect('FrontOffice/visitor_book')->with([
                'message' => "Visitor Details Not Found",
                'message_important' => true
            ]);
      }
  }

  public function phone_call()
  {
      $call_details=DB::table('phone_call')->where('branch_code',Auth::user()->school_id)->orderBy('id','desc')->get();
    return view('FrontOffice.phone_call',compact('call_details'));
  }

  public function add_phone_call(Request $request)
  {
    $name=Input::get('name');
    $phone=Input::get('phone');
    $date=Input::get('date');
    $description=Input::get('description');
    $next_allow_up_date=Input::get('next_date');
    $call_duration=Input::get('call_duration');
    $note=Input::get('note');
    $call_type=Input::get('call_type');
    $created_date = date('d-m-Y H:i:s');

    $call=DB::table('phone_call')->insert(['name'=>$name,'phone'=>$phone,'date'=>$date,'description'=>$description,'next_date'=>$next_allow_up_date,'call_duration'=>$call_duration,'note'=>$note,'call_type'=>$call_type,'academic_year'=>app_config('Session',Auth::user()->school_id),'created_date'=>$created_date,'branch_code'=>Auth::user()->school_id]);

    if(!empty($call)){
         return redirect('FrontOffice/phone_call')->with([
                 'message' => 'Phone Call is Added Succesfully.'
             ]);
       }else{
              return redirect('FrontOffice/phone_call')->with([
                   'message' => 'Phone Call Added failed.',
                   'message_important'=>true
               ]);
            }
  }
  
  public function delete_call(Request $request,$id)
  {
      $self='FrontOffice/phone_call';
    if (\Auth::user()->user_role!=='1'){
        $get_perm=permission::permitted($self);

        if ($get_perm=='access denied'){
            return redirect('permission-error')->with([
                'message' => 'You do not have permission to view this page',
                'message_important'=>true
            ]);
        }
    }
        if($id!=null){
           DB::table('phone_call')->where('id',$id)->where('branch_code',Auth::user()->school_id)->delete();
          
            return redirect('FrontOffice/phone_call')->with([
                'message' => "Contact Details Deleted Successfully."
            ]);
        }else{
            return redirect('FrontOffice/phone_call')->with([
                'message' => "gupnp_control_point_callback_set(cpoint, signal, callback) Details Not Found",
                'message_important' => true
            ]);
      }

    }

    public function postal_dispatch()
    {
      $postal=DB::table('postal_dispatch')->where('branch_code',Auth::user()->school_id)->orderBy('id','desc')->get();
      return view('FrontOffice.Postal_Dispatch',compact('postal'));
    }

    public function insert_postal_dispatch(Request $request)
    {
     $to_title=Input::get('to_title');
     $reference_no=Input::get('reference_no');
     $address=Input::get('address');
     $note=Input::get('note');
     $from_title=Input::get('from_title');
     $date=Input::get('date');
     // $document=Input::file('document');
     // $img_dest ='/opt/lampp/htdocs/schoolErp/assets/images';
     // if($document != null){
     //  $h_logo_name='h_logo.'.$document->getClientOriginalExtension();

     //  $document->move($img_dest,$h_logo_name);
     // }
     
     $created_date = date('d-m-Y H:i:s');

     $save=DB::table('postal_dispatch')->insert(['to_title'=>$to_title,'reference_no'=>$reference_no,'address'=>$address,'note'=>$note,'from_title'=>$from_title,'date'=>$date,'academic_year'=>app_config('Session',Auth::user()->school_id),'created_date'=>$created_date,'branch_code'=>Auth::user()->school_id]);

     if(!empty($save)){
         return redirect('FrontOffice/postal_dispatch')->with([
                 'message' => 'Phone Call is Added Succesfully.'
             ]);
       }else{
              return redirect('FrontOffice/postal_dispatch')->with([
                   'message' => 'Phone Call Added failed.',
                   'message_important'=>true
               ]);
            }
    }

    public function delete_postal(Request $request,$id)
    {
      $self='FrontOffice/postal_dispatch';
    if (\Auth::user()->user_role!=='1'){
        $get_perm=permission::permitted($self);

        if ($get_perm=='access denied'){
            return redirect('permission-error')->with([
                'message' => 'You do not have permission to view this page',
                'message_important'=>true
            ]);
        }
    }
        if($id!=null){
           DB::table('postal_dispatch')->where('id',$id)->where('branch_code',Auth::user()->school_id)->delete();
          
            return redirect('FrontOffice/postal_dispatch')->with([
                'message' => "Contact Details Deleted Successfully."
            ]);
        }else{
            return redirect('FrontOffice/postal_dispatch')->with([
                'message' => "gupnp_control_point_callback_set(cpoint, signal, callback) Details Not Found",
                'message_important' => true
            ]);
      }
    }

    public function postal_recieve(Request $request)
    {
      $postal=DB::table('postal_recieve')->where('branch_code',Auth::user()->school_id)->orderBy('id','desc')->get();
      return view('FrontOffice.Postal_Recieve',compact('postal'));
    }

    public function insert_postal_recieve(Request $request)
    {
      $from_title=Input::get('from_title');
      $to_title=Input::get('to_title');
      $reference_no=Input::get('reference_no');
      $address=Input::get('address');
      $note=Input::get('note');
      $date=Input::get('date');
      $created_date = date('d-m-Y H:i:s');

     $save=DB::table('postal_recieve')->insert(['to_title'=>$to_title,'reference_no'=>$reference_no,'address'=>$address,'note'=>$note,'from_title'=>$from_title,'date'=>$date,'academic_year'=>app_config('Session',Auth::user()->school_id),'created_date'=>$created_date,'branch_code'=>Auth::user()->school_id]);

     if(!empty($save)){
         return redirect('FrontOffice/postal_recieve')->with([
                 'message' => 'Postal  Added Succesfully.'
             ]);
       }else{
              return redirect('FrontOffice/postal_recieve')->with([
                   'message' => ' failed.',
                   'message_important'=>true
               ]);
            }
    }

      public function delete_postal_recive(Request $request,$id)
    {
      $self='FrontOffice/postal_recieve';
    if (\Auth::user()->user_role!=='1'){
        $get_perm=permission::permitted($self);

        if ($get_perm=='access denied'){
            return redirect('permission-error')->with([
                'message' => 'You do not have permission to view this page',
                'message_important'=>true
            ]);
        }
    }
        if($id!=null){
           DB::table('postal_recieve')->where('id',$id)->where('branch_code',Auth::user()->school_id)->delete();
          
            return redirect('FrontOffice/postal_recieve')->with([
                'message' => " Deleted Successfully."
            ]);
        }else{
            return redirect('FrontOffice/postal_recieve')->with([
                'message' => "gupnp_control_point_callback_set(cpoint, signal, callback) Details Not Found",
                'message_important' => true
            ]);
      }
    }
    public function complain(Request $request)
    {
       $purpose=DB::table('tb_purpose')->where('branch_code',Auth::user()->school_id)->orderBy('id','desc')->get();
     $comp=DB::table('tb_complain')->where('branch_code',Auth::user()->school_id)->orderBy('id','desc')->get();

       
       $complain=DB::table('complain')
       ->join('tb_complain','complain.complain_id','=','tb_complain.id')
       ->select('complain.*','tb_complain.complain_type')
        ->where('complain.branch_code',Auth::user()->school_id)   
        ->get();
      return view('FrontOffice.Complain',compact('complain','comp','purpose'));
    }

    public function insert_complain(Request $request)
    {
      $complain_type=Input::get('complain_type');
      $source=Input::get('source');
      $complain_by=Input::get('complain_by');
      $phone=Input::get('phone');
      $date=Input::get('date');
      $description=Input::get('description');
      $action_taken=Input::get('action_taken');
      $assigned=Input::get('assigned');
      $note=Input::get('note');
      $created_date = date('d-m-Y H:i:s');

      $save=DB::table('complain')->insert(['complain_id'=>$complain_type,'complain_by'=>$complain_by,'source'=>$source,'phone'=>$phone,'date'=>$date,'description'=>$description,'action_taken'=>$action_taken,'assigned'=>$assigned,'note'=>$note,'academic_year'=>app_config('Session',Auth::user()->school_id),'created_date'=>$created_date,'branch_code'=>Auth::user()->school_id]);
      if(!empty($save)){
         return redirect('FrontOffice/complain')->with([
                 'message' => 'Complain Added Succesfully.'
             ]);
       }else{
              return redirect('FrontOffice/complain')->with([
                   'message' => 'Failed To Add.',
                   'message_important'=>true
               ]);
            }
    }

    public function complain_delete(Request $request,$id)
    {
       $self='FrontOffice/complain';
    if (\Auth::user()->user_role!=='1'){
        $get_perm=permission::permitted($self);

        if ($get_perm=='access denied'){
            return redirect('permission-error')->with([
                'message' => 'You do not have permission to view this page',
                'message_important'=>true
            ]);
        }
    }
        if($id!=null){
           DB::table('complain')->where('id',$id)->where('branch_code',Auth::user()->school_id)->delete();
          
            return redirect('FrontOffice/complain')->with([
                'message' => "Complain Deleted Successfully."
            ]);
        }else{
            return redirect('FrontOffice/complain')->with([
                'message' => "Complain Details Not Found",
                'message_important' => true
            ]);
      }

    }
    
  
}

?>
