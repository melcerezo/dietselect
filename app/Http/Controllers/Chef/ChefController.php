<?php

namespace App\Http\Controllers\Chef;

use App\Http\Controllers\Chef\Auth\VerifiesEmail;
use App\Http\Controllers\Chef\Auth\VerifiesSms;
use App\Http\Controllers\Controller;
use App\Order;
use Illuminate\Support\Facades\Auth;

class ChefController extends Controller
{
    use VerifiesSms;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('chef.auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {

        $orders='';
        $ordersCount=Order::where('chef_id', '=', Auth::guard('chef')->user()->id)->where('is_paid','=',0)->get()->count();

        if($ordersCount >0){
            $orders = Order::where('chef_id', '=', Auth::guard('chef')->user()->id)->where('is_paid','=',0)->get();
        }

        return view('chef.dashboard')->with([
            'sms_unverified' => $this->mobileNumberExists(),
            'chef' => Auth::guard('chef')->user(),
            'ordersCount' => $ordersCount,
            'orders' => $orders,
        ]);
    }

    public function profile(){
        return view('chef.profile')->with([

        ]);
    }


}
