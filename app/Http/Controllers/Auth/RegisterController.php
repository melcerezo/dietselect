<?php

namespace App\Http\Controllers\Auth;

use App\Foodie;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Http\Controllers\VerificationController;
use Illuminate\Http\Request;
use App\Http\Controllers\VerifiesUser;
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
    //use VerifiesUser;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/foodie/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'last_name' => 'required|max:255',
            'first_name' => 'required|max:255',
            'mobile_number' => 'required|min:10|max:10|unique:foodies',
            'registration_email' => 'required|email|max:255|unique:foodies,email',
            'password' => 'required|min:5|confirmed',
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
        $joined_newsletter = $data['joined_newsletter']? 1 : 0;
        return Foodie::create([
            'last_name' => $data['last_name'],
            'first_name' => $data['first_name'],
            'mobile_number' => $data['mobile_number'],
            'email' => $data['registration_email'],
            'password' => bcrypt($data['password']),
            'joined_newsletter' => $joined_newsletter,
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

        VerificationController::sendVerificationCode();

        return redirect($this->redirectPath());
    }
}
