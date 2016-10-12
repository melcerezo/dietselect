<?php

namespace App\Http\Controllers\Foodie\Auth;

use App\Foodie;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    use VerifiesSms;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/foodie/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('foodie.guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $data['mobile_number'] = '63' . $data['mobile_number'];
        return Validator::make($data, [
            'last_name' => 'required|max:100',
            'first_name' => 'required|max:100',
            'mobile_number' => 'required|digits:12|unique:foodies',
            'registration_email' => 'required|email|max:255|unique:foodies,email',
            'password' => 'required|min:6|confirmed',
            'user_agreement' => 'accepted',
        ]);
    }

    public function showRegistrationForm()
    {
        return view('welcome', ['from' => 'register']);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return Foodie
     */
    protected function create(array $data)
    {
        return Foodie::create([
            'last_name' => $data['last_name'],
            'first_name' => $data['first_name'],
            'mobile_number' => $data['mobile_number'],
            'email' => $data['registration_email'],
            'password' => bcrypt($data['password']),
            'joined_newsletter' => $data['joined_newsletter'],
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

        $this->createSmsVerification();

        return redirect($this->redirectTo)->with([
            'status' => 'You have successfully registered!',
            'after_registration' => true,
        ]);
    }

    public function guard()
    {
        return Auth::guard('foodie');
    }
}
