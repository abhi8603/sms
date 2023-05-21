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
class LibraryController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
      $this->middleware('SchoolMiddleware');
  }
  public function librarycategory(){
    $self='library/category';
    if (\Auth::user()->user_role!=='1'){
        $get_perm=permission::permitted($self);

        if ($get_perm=='access denied'){
            return redirect('permission-error')->with([
                'message' => 'You do not have permission to view this page.',
                'message_important'=>true
            ]);
        }
    }
    $library_category=DB::table('library_category')->where('branch_code',Auth::user()->school_id)->get();
    return view('library.library-category',compact('library_category'));
  }
  public function addlibrarycategory(Request $request){
    $self='library/category/add';
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
        'category_name' => 'required',
        'section_code'=>'required',
      ]);
  $category_name=Input::get('category_name');
  $section_code=Input::get('section_code');
  $created_date = date('d-m-Y H:i:s');
  try{
    $savedata= DB::table('library_category')->insert(['category_name'=>$category_name,'section_code'=>$section_code,'branch_code'=>Auth::user()->school_id,'created_date'=>$created_date]);
          if(!empty($savedata)){
            return redirect('library/category')->with([
                 'message' => 'New Library Category Added Successfully.'
             ]);
          }else{
            return redirect('library/category')->with([
                 'message' => 'Unable to add new Library Category.Please Try Again.'
             ]);
          }
    }catch(\Illuminate\Database\QueryException $ex){
          return redirect('library/category')->with([
               'message' => 'Someting Went Worng Please Contact Technical Team : '.$ex->getMessage(). '',
               'message_important'=>true
           ]);

       }
  }
  public function deletelibrarycategory(Request $request,$id){
    $self='hostel/visitors/delete';
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
       DB::table('library_category')->where('branch_code',Auth::user()->school_id)->where('id','=',$id)->delete();
        return redirect('library/category')->with([
            'message' => "Library Category Details Deleted Successfully."
        ]);
    }else{
        return redirect('library/category')->with([
            'message' => "Library Category Details Not Found",
            'message_important' => true
        ]);
    }
  }catch(\Illuminate\Database\QueryException $ex){
    return redirect('library/category')->with([
         'message' => 'Someting Went Worng Please Contact Technical Team : '.$ex->getMessage(). '',
         'message_important'=>true
     ]);

  }
}
public function viewlibrarycategory(Request $request,$id){
  $self='library/category/view';
  if (\Auth::user()->user_role!=='1'){
      $get_perm=permission::permitted($self);

      if ($get_perm=='access denied'){
          return redirect('permission-error')->with([
              'message' => 'You do not have permission to view this page.',
              'message_important'=>true
          ]);
      }
  }
  $library_category=DB::table('library_category')->where('id',$id)->where('branch_code',Auth::user()->school_id)->get();
foreach ($library_category as $library_category) {
  // code...
  $category_name=$library_category->category_name;
  $section_code=$library_category->section_code;
}
  return view('library.view-library-category',compact('category_name','section_code','id'));
}

public function updatelibrarycategory(Request $request){
  $self='library/category/add';
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
      'category_name' => 'required',
      'section_code'=>'required',
    ]);
$category_name=Input::get('category_name');
$section_code=Input::get('section_code');
$id=Input::get('id');
$created_date = date('d-m-Y H:i:s');
try{
  $savedata= DB::table('library_category')->where('id',$id)->where('branch_code',Auth::user()->school_id)->update(['category_name'=>$category_name,'section_code'=>$section_code]);
        if(!empty($savedata)){
          return redirect('library/category')->with([
               'message' => 'New Library Category Update Successfully.'
           ]);
        }else{
          return redirect('library/category')->with([
               'message' => 'Unable to Update Library Category.Please Try Again.'
           ]);
        }
  }catch(\Illuminate\Database\QueryException $ex){
        return redirect('library/category')->with([
             'message' => 'Someting Went Worng Please Contact Technical Team : '.$ex->getMessage(). '',
             'message_important'=>true
         ]);

     }
}
public function books(){
  $self='library/books';
  if (\Auth::user()->user_role!=='1'){
      $get_perm=permission::permitted($self);

      if ($get_perm=='access denied'){
          return redirect('permission-error')->with([
              'message' => 'You do not have permission to view this page.',
              'message_important'=>true
          ]);
      }
  }
  $library_category=DB::table('library_category')->where('branch_code',Auth::user()->school_id)->get();
  $booklist=DB::table('new_book')->where('branch_code',Auth::user()->school_id)->get();
  return view('library.book',compact('library_category','booklist'));
}
public function addbooks(Request $request){
  $self='library/books/add';
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
      'puchase_date' => 'required',
      'bill_no'=>'required',
      'bookisbn_no' => 'required',
      'book_no'=>'required|string|max:255|unique:new_book',
      'title' => 'required',
      'auther' => 'required',
      'edition' => 'required',
      'bookcategory'=>'required',
      'publisher' => 'required',
      'no_of_copy'=>'required',
      'book_cost' => 'required',
      'language'=>'required',
      'book_condition'=>'required',
    ]);
    $puchase_date=Input::get('puchase_date');
    $bill_no=Input::get('bill_no');
    $bookisbn_no=Input::get('bookisbn_no');
    $book_no=Input::get('book_no');
    $auther=Input::get('auther');
    $title=Input::get('title');
    $edition=Input::get('edition');
    $bookcategory=Input::get('bookcategory');
    $publisher=Input::get('publisher');
    $no_of_copy=Input::get('no_of_copy');
    $shelf_no=Input::get('shelf_no');
    $book_position=Input::get('book_position');
    $book_cost=Input::get('book_cost');
    $language=Input::get('language');
    $book_condition=Input::get('book_condition');
    $created_date = date('d-m-Y H:i:s');
    try{
      $savedata= DB::table('new_book')->insert(['puchase_date'=>$puchase_date,'bill_no'=>$bill_no,
        'bookisbn_no'=>$bookisbn_no,'book_no'=>$book_no,'auther'=>$auther,'title'=>$title,
        'edition'=>$edition,'bookcategory'=>$bookcategory,'publisher'=>$publisher,'no_of_copy'=>$no_of_copy,
        'shelf_no'=>$shelf_no,'book_position'=>$book_position,'book_cost'=>$book_cost,'language'=>$language,
        'book_condition'=>$book_condition,'branch_code'=>Auth::user()->school_id,'created_date'=>$created_date]);
            if(!empty($savedata)){
              return redirect('library/books')->with([
                   'message' => 'New Book Added Successfully.'
               ]);
            }else{
              return redirect('library/books')->with([
                   'message' => 'Unable to add new Book.Please Try Again.'
               ]);
            }
      }catch(\Illuminate\Database\QueryException $ex){
            return redirect('library/books')->with([
                 'message' => 'Someting Went Worng Please Contact Technical Team : '.$ex->getMessage(). '',
                 'message_important'=>true
             ]);

         }

}
public function deletebooks(Request $request,$id){
  $self='library/books/delete';
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
     DB::table('new_book')->where('branch_code',Auth::user()->school_id)->where('id','=',$id)->delete();
      return redirect('library/books')->with([
          'message' => "Book Details Deleted Successfully."
      ]);
  }else{
      return redirect('library/books')->with([
          'message' => "Book Details Not Found",
          'message_important' => true
      ]);
  }
}catch(\Illuminate\Database\QueryException $ex){
  return redirect('library/category')->with([
       'message' => 'Someting Went Worng Please Contact Technical Team : '.$ex->getMessage(). '',
       'message_important'=>true
   ]);

}
}
public function viewbook(Request $request,$id){
  $self='library/books';
  if (\Auth::user()->user_role!=='1'){
      $get_perm=permission::permitted($self);

      if ($get_perm=='access denied'){
          return redirect('permission-error')->with([
              'message' => 'You do not have permission to view this page.',
              'message_important'=>true
          ]);
      }
  }
  $library_category=DB::table('library_category')->where('branch_code',Auth::user()->school_id)->get();
  $bookdetails=DB::table('new_book')->where('id',$id)->where('branch_code',Auth::user()->school_id)->get();

  return view('library.view-book-details',compact('library_category','bookdetails'));
}
public function updatebook(Request $request){
  $self='library/books/add';
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
      'puchase_date' => 'required',
      'bill_no'=>'required',
      'bookisbn_no' => 'required',
      'book_no'=>'required',
      'title' => 'required',
      'auther' => 'required',
      'edition' => 'required',
      'bookcategory'=>'required',
      'publisher' => 'required',
      'no_of_copy'=>'required',
      'book_cost' => 'required',
      'language'=>'required',
      'book_condition'=>'required',
    ]);
    $puchase_date=Input::get('puchase_date');
    $bill_no=Input::get('bill_no');
    $bookisbn_no=Input::get('bookisbn_no');
    $book_no=Input::get('book_no');
    $auther=Input::get('auther');
    $title=Input::get('title');
    $edition=Input::get('edition');
    $bookcategory=Input::get('bookcategory');
    $publisher=Input::get('publisher');
    $no_of_copy=Input::get('no_of_copy');
    $shelf_no=Input::get('shelf_no');
    $book_position=Input::get('book_position');
    $book_cost=Input::get('book_cost');
    $language=Input::get('language');
    $book_condition=Input::get('book_condition');
    $created_date = date('d-m-Y H:i:s');
    try{
      if(!empty($book_no)){
      $savedata= DB::table('new_book')->where('book_no',$book_no)->where('branch_code',Auth::user()->school_id)->update(['puchase_date'=>$puchase_date,'bill_no'=>$bill_no,
        'bookisbn_no'=>$bookisbn_no,'book_no'=>$book_no,'auther'=>$auther,'title'=>$title,
        'edition'=>$edition,'bookcategory'=>$bookcategory,'publisher'=>$publisher,'no_of_copy'=>$no_of_copy,
        'shelf_no'=>$shelf_no,'book_position'=>$book_position,'book_cost'=>$book_cost,'language'=>$language,
        'book_condition'=>$book_condition]);
            if(!empty($savedata)){
              return redirect('library/books')->with([
                   'message' => 'New Book Added Successfully.'
               ]);
            }else{
              return redirect('library/books')->with([
                   'message' => 'Unable to add new Book.Please Try Again.',
                    'message_important'=>true
               ]);
            }
          }else{
            return redirect('library/books')->with([
                 'message' => 'Invalid Book Id.Please Try Again.',
                  'message_important'=>true
             ]);
          }
      }catch(\Illuminate\Database\QueryException $ex){
            return redirect('library/books')->with([
                 'message' => 'Someting Went Worng Please Contact Technical Team : '.$ex->getMessage(). '',
                 'message_important'=>true
             ]);

         }
}

public function issuebooks(){
  $self='library/books/issue';
  if (\Auth::user()->user_role!=='1'){
      $get_perm=permission::permitted($self);

      if ($get_perm=='access denied'){
          return redirect('permission-error')->with([
              'message' => 'You do not have permission to view this page.',
              'message_important'=>true
          ]);
      }
  }
  $booklist=DB::table('new_book')->where('branch_code',Auth::user()->school_id)->get();
  $students=DB::table('stu_admission')->where('branch_code',Auth::user()->school_id)->where('accdmic_year',app_config('Session',Auth::user()->school_id))->get();
  $employess=DB::table('emp_details')->where('branch_code',Auth::user()->school_id)->get();
  $issuebooklist=DB::table('issue_book')->where('branch_code',Auth::user()->school_id)->get();
  return view('library.issue-book',compact('booklist','students','employess','issuebooklist'));
}
public function bookinfo(Request $request){
  $eid=$request->eid;
  $booklist = DB::table('new_book')
            ->join('library_category', 'new_book.bookcategory', '=', 'library_category.id')
            ->select('new_book.*', 'library_category.category_name')
            ->where('new_book.id',$eid)->where('new_book.branch_code',Auth::user()->school_id)->get();
  $bookcnt=DB::table('issue_book')->where('issue_status','1')->where('book_id',$eid)->where('branch_code',Auth::user()->school_id)->count();

  foreach ($booklist as $booklist) {
    // code...
    $isbnno=$booklist->bookisbn_no;
    $book_no=$booklist->book_no;
    $title=$booklist->title;
    $auther=$booklist->auther;
    $edition=$booklist->edition;
    $category_name=$booklist->category_name;
    $publisher=$booklist->publisher;
    $no_of_copy=$booklist->no_of_copy;
    $shelf_no=$booklist->shelf_no;
    $book_position=$booklist->book_position;
    $book_cost=$booklist->book_cost;
    $language=$booklist->language;
    $book_condition=$booklist->book_condition;
    $issue_status=$booklist->issue_status;
  }
echo $isbnno."|".$book_no."|".$title."|".$auther."|".$edition."|".$category_name."|".$publisher."|".$no_of_copy."|".$shelf_no."|".$book_position."|".$book_cost."|".$language."|".$book_condition."|".$issue_status."|"
.$bookcnt;
}
public function bookissue(Request $request){
  $self='library/bookissue/issue';
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
      'book' => 'required',
      'issuedate'=>'required',
      'duedate' => 'required',
      'utype' => 'required',
      'title' => 'required',
      'book_no'=>'required',
    ]);
    $book=Input::get('title');
    $issuedate=Input::get('issuedate');
    $duedate=Input::get('duedate');
    $utype=Input::get('utype');
    $title=Input::get('title');
    $book_no=Input::get('book_no');
    $created_date = date('d-m-Y H:i:s');
    if($utype=='student'){
     $reg_no=Input::get('reg_no');
      $course_department=Input::get('course');
      $batch_designation=Input::get('batch');
      $name=Input::get('stu_name');
      $contact=Input::get('contact_no');
    }else{
      $reg_no=Input::get('emp_code');
      $course_department=Input::get('department');
      $batch_designation=Input::get('designation');
      $name=Input::get('emp_name');
      $contact="";
    }
    try{
      if(!empty($book_no)){
      $savedata= DB::table('issue_book')->insert(['book_name'=>$book,'book_id'=>preg_replace('/\s+/', '', $book_no),
        'usertype'=>$utype,'reg_no'=>$reg_no,'course_department'=>$course_department,'batch_designation'=>$batch_designation,
        'contact'=>$contact,'name'=>$name,'issue_date'=>$issuedate,'due_date'=>$duedate,'acadmic_year'=>app_config('Session',Auth::user()->school_id),
        'branch_code'=>Auth::user()->school_id,'created_date'=>$created_date]);
            if(!empty($savedata)){
              return redirect('library/books/issue')->with([
                   'message' => 'Book Issued To ' .$name.'-'.$reg_no.' Successfully.'
               ]);
            }else{
              return redirect('library/books/issue')->with([
                   'message' => 'Unable to Issue Book.Please Try Again.',
                    'message_important'=>true
               ]);
            }
          }else{
            return redirect('library/books/issue')->with([
                 'message' => 'Invalid Book Id.Please Try Again.',
                  'message_important'=>true
             ]);
          }
      }catch(\Illuminate\Database\QueryException $ex){
            return redirect('library/books/issue')->with([
                 'message' => 'Someting Went Worng Please Contact Technical Team : '.$ex->getMessage(). '',
                 'message_important'=>true
             ]);

         }
}

public function returnbook(){
  $self='library/bookissue/return';
  if (\Auth::user()->user_role!=='1'){
      $get_perm=permission::permitted($self);

      if ($get_perm=='access denied'){
          return redirect('permission-error')->with([
              'message' => 'You do not have permission to view this page.',
              'message_important'=>true
          ]);
      }
  }

  //$issuebooklist=DB::table('issue_book')->where('issue_status','1')->where('branch_code',Auth::user()->school_id)->get();
  $issuebooklist = DB::table('issue_book')
            ->join('new_book', 'issue_book.book_id', '=', 'new_book.id')
            ->select('issue_book.*', 'new_book.bookisbn_no', 'new_book.auther')
            ->where('issue_book.issue_status','1')->where('issue_book.branch_code',Auth::user()->school_id)->get();
  $returnbooklist = DB::table('issue_book')
            ->join('new_book', 'issue_book.book_id', '=', 'new_book.id')
            ->select('issue_book.*', 'new_book.bookisbn_no', 'new_book.auther')
            ->where('issue_book.issue_status','0')->where('issue_book.branch_code',Auth::user()->school_id)->orderBy('issue_book.id','desc')->get();
  return view('library.return-book',compact('issuebooklist','returnbooklist'));
}
public function bookdetails(Request $request){
  $eid=$request->eid;
  //$booksdetails=DB::table('issue_book')->where('id',$eid)->where('branch_code',Auth::user()->school_id)->get();
  $booksdetails = DB::table('issue_book')
            ->join('new_book', 'issue_book.book_id', '=', 'new_book.id')
            ->select('issue_book.*', 'new_book.bookisbn_no', 'new_book.title', 'new_book.auther')
            ->where('issue_book.id',$eid)->where('issue_book.branch_code',Auth::user()->school_id)->get();

  foreach ($booksdetails as $booksdetails) {
    // code...
    $isbnno=$booksdetails->bookisbn_no;
    $bookno=$booksdetails->book_id;
    $title=$booksdetails->title;
    $auther=$booksdetails->auther;
    $usertype=$booksdetails->usertype;
    $name=$booksdetails->name;
    $issuedate=$booksdetails->issue_date;
    $duedate=$booksdetails->due_date;
    $id=$booksdetails->id;

    echo $isbnno."|".$bookno."|".$title."|".$auther."|".$usertype."|".$name."|".$issuedate."|".$duedate."|".$id;

  }
}
public function bookreturn(Request $request){
  $self='library/bookissue/return';
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
      'book' => 'required',
      'retun'=>'required'
    ]);
  $id=Input::get('id');
  $return=Input::get('retun');
  try{
  if($return=='Return'){
      $returndate=Input::get('returndate');
      $fineamt=Input::get('fineamt');
      $review=Input::get('review');
    $updatedata= DB::table('issue_book')
            ->where('id',$id)->where('branch_code',Auth::user()->school_id)
            ->update(['return_date' => $returndate,'fineamt' => $fineamt,'remark' => $review,'issue_status' => '0']);
  }else{
    $renewdate=Input::get('duedate');
    $updatedata=  DB::table('issue_book')
          ->where('id',$id)->where('branch_code',Auth::user()->school_id)
          ->update(['return_date' => $renewdate]);
  }
  if(!empty($updatedata)){
    return redirect('library/bookissue/return')->with([
         'message' => 'Book Details Updated Successfully.'

     ]);
  }else{
    return redirect('library/bookissue/return')->with([
         'message' => 'Unable to Update Book.Please Try Again.',
          'message_important'=>true
     ]);
  }
}catch(\Illuminate\Database\QueryException $ex){
        return redirect('library/bookissue/return')->with([
             'message' => 'Someting Went Worng Please Contact Technical Team : '.$ex->getMessage(). '',
             'message_important'=>true
         ]);

     }
}
  public function returnbookdetails(Request $request){
    $self='library/returnbooks/view';
    if (\Auth::user()->user_role!=='1'){
        $get_perm=permission::permitted($self);

        if ($get_perm=='access denied'){
            return redirect('permission-error')->with([
                'message' => 'You do not have permission to view this page.',
                'message_important'=>true
            ]);
        }
    }
    $booksdetails = DB::table('issue_book')
              ->join('new_book', 'issue_book.book_id', '=', 'new_book.id')
              ->select('issue_book.*', 'new_book.bookisbn_no', 'new_book.title', 'new_book.auther')
              ->where('issue_book.id',$request->id)->where('issue_book.branch_code',Auth::user()->school_id)->get();
  //  print_r($booksdetails);
    foreach ($booksdetails as $booksdetails) {
      // code...
      $usertype=$booksdetails->usertype;
        $title=$booksdetails->title;
          $auther=$booksdetails->auther;
            $reg_no=$booksdetails->reg_no;
                $name=$booksdetails->name;
              $course=$booksdetails->course_department;
                $batch=$booksdetails->batch_designation;
                  $bookno=$booksdetails->book_id;
                    $returndate=$booksdetails->return_date;
                      $fineamt=$booksdetails->fineamt;
                        $remark=$booksdetails->remark;
    }
      return view('library.view-bookreturn-details',compact('usertype','title','auther','name','reg_no','course','batch','bookno','returndate','fineamt','remark'));
  }

}
?>
