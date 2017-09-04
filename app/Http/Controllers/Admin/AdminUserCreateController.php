<?php

namespace App\Http\Controllers\Admin;

use App\Foodie;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminUserCreateController extends Controller
{
    use RegistersUsers;
    use VerifiesSms;
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

    protected function validator(array $data)
    {
//        $data['mobile_number'] = '63' . $data['mobile_number'];
        return Validator::make($data, [
            'last_name' => 'required|max:100',
            'first_name' => 'required|max:100',
            'mobile_number' => 'required|digits:10|unique:foodies',
            'registration_email' => 'required|email|max:255|unique:foodies,email',
            'password' => 'required|min:6|confirmed',
        ]);
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
            'password' => bcrypt($data['password'])
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

        $this->create($request->all());

        $this->createSmsVerification();

        return back()->with([
            'status' => 'Foodie successfully registered!',
        ]);
    }
}
