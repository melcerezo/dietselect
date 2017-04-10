<?php

namespace App\Http\Controllers\Chef\Auth;

use App\Chef;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;
    use VerifiesEmail;
    use VerifiesSms;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/chef/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('chef.guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
//        $data['mobile_number'] = '0' . $data['mobile_number'];
        return Validator::make($data, [
            'name' => 'required|min:5|max:255|unique:chefs',
            'email' => 'required|email|max:255|unique:chefs',
            'mobile_number' => 'required|digits:11|unique:chefs',
            'website' => 'min:10|max:255',
            'url_name' => 'required|alpha_num|min:5|max:255|unique:chefs',
            'password' => 'required|min:6|max:255|confirmed',
            'partner_agreement' => 'accepted',
        ]);
    }

    public function showRegistrationForm()
    {
        return view('chef.auth.register');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return Chef
     */
    protected function create(array $data)
    {
        return Chef::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'mobile_number' => $data['mobile_number'],
            'website' => $data['website'],
            'url_name' => $data['url_name'],
            'password' => bcrypt($data['password']),
        ]);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $this->guard()->login($this->create($request->all()));

        $this->createsSmsVerification();
        $this->createsEmailVerification($request['email']);

        if ($this->guard()->check()) {
            $this->guard()->logout();
            return redirect()->intended($this->redirectTo)->with([
                'status' => 'We have sent you a link to your email that verifies your account!',
                'after_registration' => true,
            ]);
        }

        return redirect()->back()->with([
            'status' => 'Something went wrong while trying to authenticate you to the site. Try again later.',
            'after_registration' => true,
        ]);
    }

    public function guard()
    {
        return Auth::guard('chef');
    }
}
