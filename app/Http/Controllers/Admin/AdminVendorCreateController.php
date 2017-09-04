<?php

namespace App\Http\Controllers\Admin;

use App\Chef;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminVendorCreateController extends Controller
{
    use RegistersUsers;
    use VerifiesEmailChef;
    use VerifiesSmsChef;


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
            'mobile_number' => 'required|digits:10|unique:chefs',
            'website' => 'min:10|max:255',
            'url_name' => 'required|alpha_num|min:5|max:255|unique:chefs',
            'password' => 'required|min:6|max:255|confirmed',
        ]);
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
        $this->guard()->logout();

        return redirect()->back()->with([
            'status' => 'Chef successfully created!',
        ]);
    }

    public function guard()
    {
        return Auth::guard('chef');
    }
}
