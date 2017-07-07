<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Foodie\Auth\VerifiesSms;
use App\Plan;
use App\Message;
use App\Notification;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    use VerifiesSms;

    public function __construct()
    {
        $this->middleware('foodie.auth');
    }

    public function index()
    {
        $foodie= Auth::guard('foodie')->user()->id;
        $cartItems=Cart::content();
        $messages = Message::where('receiver_id', '=', Auth::guard('foodie')->user()->id)
            ->where('receiver_type', '=', 'f')
            ->where('is_read','=',0)
            ->get();
        $notifications=Notification::where('receiver_id','=',$foodie)->where('receiver_type','=','f')->get();
        $unreadNotifications=Notification::where('receiver_id','=',$foodie)->where('receiver_type','=','f')->where('is_read','=',0)->count();
        
        return view('foodie.cart.index')->with([
            'cartItems' =>$cartItems,
            'messages' => $messages,
            'notifications' => $notifications,
            'unreadNotifications'=> $unreadNotifications,
            'sms_unverified' => $this->smsIsUnverified(),
        ]);
    }

    public function add(Plan $plan, $cust)
    {
        Cart::add($plan->id, $plan->plan_name,1,$plan->price,['cust'=>$cust]);

        return back()->with(['status'=>'Added to cart!']);
    }
}
