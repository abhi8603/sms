<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      //  $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

	public function UpdatePassword(Request $request){
      $this->validate($request, [
        'email'=>'required',
        'mobile'=>'required',
        'password'=>'required', 
     
        ]);
        $checkWhere=array(
          "username"=>$request->email,
          "mobile"=>$request->mobile,
        );
          $checkUser=DB::table('users')->where($checkWhere)->count();
          if($checkUser==1){
            $password=$request->password;
            DB::table('users')
            ->where($checkWhere)
            ->update(['password'=>bcrypt($password)]);

            $dt=array(
              "username"=>$request->email,
              "change_by"=>$request->email,
              "newpassword"=>$password,
          );
          DB::table('password_change_log')->insert($dt);
          return redirect('forgot-password')->with([
              'message' => 'Password Updated Successfully.'
          ]);


          }else{
            return redirect('forgot-password')->with([
              'message' => 'User Not Exists.Please enter regitered Email-id and mobile No.',
              'message_important'=>true
          ]);
          }


    }

	
	
    public function UserRegister(Request $request){
	//echo 	url('');exit;
      $this->validate($request, [
     'email'=>'required|string|max:255|unique:users',
     'mobile'=>'required',
     'password'=>'required|string|max:255',
     'name'=>'required|string|max:255',
	// 'file'=>'required',
     ]);
    
     $data=array(
       "email"=> $request->email,
       "mobile"=>$request->mobile,
	     "username"=>$request->email,
       "password"=>bcrypt($request->password),
       "name"=>$request->name,
	  	 "school_name"=>"",
	  	 "school_id"=>"2",
       "user_role"=> "NA",
		   "profile_img"=>"",
       "status"=>1,
     );
       $save=DB::table('users')->insertGetId($data);
       if($save){
         return redirect('/')->with([
           'message' => 'Registered Successfully. Please Login.'
    ]);
       }else{
         return redirect('register')->with([
        'message' => 'something went worng.Please try again.',
        'message_important'=>true
    ]);
       }
	 
}

    public function index()
    {
    $this->middleware('auth');
    if(Auth::user()->status==0){
      Auth::logout();
      return redirect('/')->with([
     'message' => 'unauthorized access.',
     'message_important'=>true
       ]);
    }
    if(Auth::user()->user_role=="NA"){
      $formData=DB::table('applications')
      ->where('email',Auth::user()->email)->where('s_phone_no',Auth::user()->mobile)->get();
	//	print_r( $formData);exit;
      return view('home',compact('formData'));
    }else{

        return view('home');
    }

    }
}
