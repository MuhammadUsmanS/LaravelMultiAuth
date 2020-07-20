<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;   //like  LoginController extends Controller  
                               //Implements  AuthenticatesUser     is like interface 

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => ['logout','userLogout']]);
    }



    public function userLogout(){
      //this function is not accessable because we have guest middleware
      //SOlution  use  except userLogout()

        Auth::guard('web')->logout();

        // $request->session()->flush();
        /*$request->session()->invalidate();*/
        return redirect('/');
    }
}
