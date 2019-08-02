<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

use Auth;

/**
 * Class LoginController
 * @package App\Http\Controllers\Auth
 */
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

  /**
   * Where to redirect users after login.
   *
   * @var string
   */
  protected $redirectTo = '/rcpadmin';

  /**
   * Create a new controller instance.
   */
  public function __construct()
  {
    $this->middleware('guest')->except('logout');
    $this->middleware('guest:student')->except('logout');
    $this->middleware('guest:landlord')->except('logout');
  }

  /**
   * Check either username or email.
   * @return string
   */
  public function username()
  {
    $identity = request()->get('identity');
    $fieldName = filter_var($identity, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
    request()->merge([$fieldName => $identity]);

    return $fieldName;
  }

  /**
   * Validate the user login.
   * @param Request $request
   */
  protected function validateLogin(Request $request)
  {
    $this->validate(
      $request,
      [
        'identity' => 'required|string',
        'password' => 'required|string',
      ],
      [
        'identity.required' => 'Username or email is required',
        'password.required' => 'Password is required',
      ]
    );
  }

  /**
   * @param Request $request
   * @throws ValidationException
   */
  protected function sendFailedLoginResponse(Request $request)
  {
    $request->session()->put('login_error', trans('auth.failed'));
    throw ValidationException::withMessages(
      [
        'error' => [trans('auth.failed')],
      ]
    );
  }

  public function showStudentLoginForm()
  {
    return view('auth.login', ['url' => 'student']);
  }

  public function studentLogin(Request $request)
  {

    $this->validate(
      $request,
      [
        'identity' => 'required|string',
        'password' => 'required|string',
      ],
      [
        'identity.required' => 'Username or email is required',
        'password.required' => 'Password is required',
      ]
    );

    /*if (Auth::guard('student')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'), 2)) {*/
    if ($this->attempt(['email' => $request->identity, 'password' => $request->password], $request->get('remember'), 2)) {
      return redirect()->intended('/student');
    }
    return back()->withInput($request->only('email', 'remember'));
  }

  public function showLandlordLoginForm()
  {
    return view('auth.login', ['url' => 'landlord']);
  }

  public function landlordLogin(Request $request)
  {
    $this->validate(
      $request,
      [
        'identity' => 'required|string',
        'password' => 'required|string',
      ],
      [
        'identity.required' => 'Username or email is required',
        'password.required' => 'Password is required',
      ]
    );
    if ($this->attempt(['email' => $request->identity, 'password' => $request->password], $request->get('remember'), 3)) {
      return redirect()->intended('/landlord');
    }
    return back()->withInput($request->only('email', 'remember'));
  }

  public function attempt($request, $remember = '', $role = '')
  {
    $user = \App\User::where([
      'role' => $role,
      'email' => $request['email'],
      'password' => md5($request['password'])
    ])->first();
    if ($user && $role == 2) {
      $studentAuth = auth()->guard('student')->login($user, true);
      return true;
    } else if ($user && $role == 3) {
      $landlordtAuth = auth()->guard('landlord')->login($user, true);
      return true;
    }
    return false;
  }

  public function studentLogout(Request $request)
  {
    Auth::guard('student')->logout();
    $request->session()->flush();
    $request->session()->regenerate();
    return redirect()->guest(url('login/student'));
  }

  public function landlordLogout(Request $request)
  {
    Auth::guard('landlord')->logout();
    $request->session()->flush();
    $request->session()->regenerate();
    return redirect()->guest(url('login/landlord'));
  }

  public function logout(Request $request)
  {
    Auth::guard('student')->logout();
    Auth::guard('landlord')->logout();
    $this->guard()->logout();

    $request->session()->invalidate();

    return $this->loggedOut($request) ?: redirect('/');
  }

}