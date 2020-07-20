<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth; ///// use auth here 

class AdminLoginController extends Controller
{	


	public function __construct(){

	$this->middleware('guest:admin', ['except'=>['logout']]);

	}

    public function showAdminLoginForm()
    { // show  admin login form 
    	return view('auth.admin-login');
    }

    public function loginForm(Request $request)
    {
    	
    	//validate the form data 
    $this->validate($request , [
   		'email' => 'required|email',
   		'password'=> 'required|min:6'
   		]);
	//attempt to log the user in
   	// i.e Auth::attempt->$credential->$remeber;
   	if(Auth::guard('admin')->attempt(['email'=>$request->email , 'password'=>$request->password],$request->remember))
   		{
   	  	//if user successful to log in the redirect to intended location 
   			return  redirect()->intended(route('admin.dashboard'));
   		}	
	//if un-successful then redirect back to the login with the form data 
   		return redirect()->back()->withInput($request->only('email','remember'));
   	   	
    }



    public function logout(){
      //this function is not accessable because we have guest middleware
      //SOlution  use  except logout()

        Auth::guard('admin')->logout();

        // $request->session()->flush();
        /*$request->session()->invalidate();*/
        return redirect('/');
    }
    




    

}
