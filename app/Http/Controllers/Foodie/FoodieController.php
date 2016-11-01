<?php

namespace App\Http\Controllers\Foodie;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Foodie\Auth\VerifiesSms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class FoodieController extends Controller
{
    use VerifiesSms;


    protected $foodies = 'foodies';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('foodie.auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\View\View;
     */
    public function index()
    {
        return view('foodie.dashboard')->with([
            'sms_unverified' => $this->smsIsUnverified(),
            'foodie' => Auth::guard('foodie')->user(),
        ]);
    }


    /**
     * Show the foodie profile.
     *
     * @return \Illuminate\Contracts\View\View;
     */
    public function profile()
    {
        return view('foodie.profile')->with([
            'sms_unverified' => $this->smsIsUnverified(),
            'foodie' => Auth::guard('foodie')->user(),
        ]);
    }

  /*  public function getID()
    {
        return Auth::guard($this->guard)->user()->id;
    }*/
    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function saveProfileBasicInfo(Request $request)
    {
        Validator::make($request->all(), [
            'last_name' => 'required|max:100',
            'first_name' => 'required|max:100',
            'gender' => 'required|max:100',
            'mobile_number' => 'required|digits:12|unique:foodies',
            'registration_email' => 'required|email|max:255|unique:foodies,email',
        ])->validate();

       /* return DB::table($this->foodies)->where('id',$this->getID())->update([
            'gender'=> Input::get('gender'),
            'username'=> Input::get('username'),
            'birthday'=> Input::get('birthday')
    ]);*/

    }
}