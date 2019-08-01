<?php
/**
 * Created by PhpStorm.
 * User: Tariq-pc
 * Date: 7/30/2019
 * Time: 4:46 PM
 */
namespace App\Http\Controllers;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Input;
use Illuminate\Routing\Controller as BaseController;

class LoginController extends BaseController
{

  public function LoginViewHandler()
  {
    return View::make('login-view');
  }

  public function LoginActionHandler()
  {
    $credentials = ['email' => Input::get('loginemail'), 'password' => Input::get('loginpassword')];
    $studentAuth = auth()->guard('student');
    if ($this->attempt($credentials)) {
      dd(auth()->guard('student')->user()->role);
      return redirect('student/');
    } else {
      die('Invalid Login, please try again');
      return redirect()->back()->withErrors('Invalid Login, please try again');
    }

  }

  public function attempt($request)
   {

     $user = \App\User::where([
       'email' => $request['email'],
       'password' => md5($request['password'])
     ])->first();
     if ($user) {
       $studentAuth = auth()->guard('student')->login($user, true);

       return true;
     }

     return false;
   }
}