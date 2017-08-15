<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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
* Where to redirect users after login / registration.
*
* @var string
*/
protected $redirectTo = '/admin/home';

/**
* Create a new controller instance.
*
*/
public function __construct()
{
$this->middleware('admin.guest', ['except' => 'logout']);
}

/**
* Show the application's login form.
*
* @return \Illuminate\Http\Response
*/
public function showLoginForm()
{
    dd("show login form");
return redirect('/');
}

/**
* Handle a login request to the application.
*
* @param  \Illuminate\Http\Request  $request
* @return \Illuminate\Http\Response
*/
public function login(Request $request)
{
$this->validateLogin($request);

// If the class is using the ThrottlesLogins trait, we can automatically throttle
// the login attempts for this application. We'll key this by the username and
// the IP address of the client making these requests into this application.
if ($lockedOut = $this->hasTooManyLoginAttempts($request)) {
$this->fireLockoutEvent($request);

return $this->sendLockoutResponse($request);
}

$credentials = $this->credentials($request);

if ($this->guard()->attempt($credentials)) {
    return $this->sendLoginResponse($request);
}

// If the login attempt was unsuccessful we will increment the number of attempts
// to login and redirect the user back to the login form. Of course, when this
// user surpasses their maximum number of attempts they will get locked out.
if (! $lockedOut) {
$this->incrementLoginAttempts($request);
}

return $this->sendFailedLoginResponse($request);
}

/**
* Send the response after the user was authenticated.
*
* @param  \Illuminate\Http\Request  $request
* @return \Illuminate\Http\Response
*/
protected function sendLoginResponse(Request $request)
{
    dd("HELLO!");

    $request->session()->regenerate();

//$this->clearLoginAttempts($request);

return $this->authenticated();
}

/**
* The user has been authenticated.
*
* @return mixed
*/
protected function authenticated()
{
    dd("authenticated");
return redirect($this->redirectTo);
}

/**
* Log the user out of the application.
*
* @param  Request  $request
* @return \Illuminate\Http\Response
*/
public function logout(Request $request)
{
$this->guard()->logout();

$successMsg = "Successfully logged out!";
return redirect('/')->with(['status' => $successMsg]);
}

public function guard()
{
return Auth::guard('admin');
}

//public function logoutAuto()
//{
//$autoMsg = "Your session has ended.";
//return view('welcome', ['from' => 'welcome'])->with(['status' => $autoMsg]);
//}
}
