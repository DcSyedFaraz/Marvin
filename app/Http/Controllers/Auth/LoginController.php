<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Socialite;
use App\User;
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

    use AuthenticatesUsers;




    // public function credentials(Request $request){
    //     return ['email'=>$request->email,'password'=>$request->password,'status'=>'active','role'=>'admin'];
    // }
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    // public function redirectTo() {

    //     $role = Auth::user()->getRoleNames();

    //     dd($role);
    //     if($role){
    //         return redirect()->route($role);
    //     }

    //  }
     public function logout()
     {
         if(Auth::check())
         {
             $user = Auth::logout();
             return redirect()->to('/login')->with('success', 'User Logout successfully.');
         }else{
             return redirect()->to('/login')->with('error', 'User Logout successfully.');
         }
     }
}
