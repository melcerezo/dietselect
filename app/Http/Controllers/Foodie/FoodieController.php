<?php

namespace App\Http\Controllers\Foodie;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Foodie\Auth\VerifiesSms;
use Illuminate\Support\Facades\Auth;

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

    public function saveProfile()
    {
        $gender=Input::get('gender');
        $username=Input::get('username');
        $birthday=Input::get('birthday');

        return DB::table($this->foodies)->where('id',$this->getID())->update([
            'gender' => $gender,
            'username' =>$username,
            'birthday' =>$birthday
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

    public function getID()
    {
        return Auth::guard($this->guard)->user()->id;
    }
}
