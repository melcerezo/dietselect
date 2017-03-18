<?php

namespace App\Http\Controllers\Foodie;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Foodie\Auth\VerifiesSms;
use App\Order;
use App\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FoodieOrderPlanController extends Controller
{

    use VerifiesSms;


    public function __construct()
    {
        $this->middleware('foodie.auth');
    }

    // Shows the order plan
    public function index(Plan $plan)
    {
        return view('foodie.orders', compact('plan'))->with([
            'sms_unverified' => $this->smsIsUnverified(),
            'foodie'=>Auth::guard('foodie')->user(),

        ]);
    }


    public function store(Request $request, Plan $plan){
        $order = new Order();
        $order->chef_id = $plan->chef_id;
        $order->foodie_id = Auth::guard('foodie')->user()->id;
        $plan->orders()->save($order);

        return redirect()->route('order.show', $order->id);
    }


    public function show(Order $order){
        $foodie = Auth::guard('foodie')->user();
        $plan = Plan::where('id', '=', $order->plan_id)->get();

        $foodieOrder = Order::where('foodie_id', '=', $foodie->id)->where('is_paid', '=', null)->get();
        return view('foodie.showOrder', compact('order', 'foodieOrder', 'plan'))->with([
            'sms_unverified' => $this->smsIsUnverified(),
            'foodie'=>Auth::guard('foodie')->user(),

        ]);
    }
}
