<?php

namespace App\Http\Controllers;

use App\CustomPlan;
use Illuminate\Http\Request;
use App\Http\Controllers\Foodie\Auth\VerifiesSms;
use App\Plan;
use App\Chat;
use App\Chef;
use App\Message;
use App\Notification;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

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
        $cartTotal=Cart::total();
        $messages = Message::where('receiver_id', '=', Auth::guard('foodie')->user()->id)
            ->where('receiver_type', '=', 'f')
            ->where('is_read','=',0)
            ->get();

        $notifications=Notification::where('receiver_id','=',$foodie)->where('receiver_type','=','f')->get();
        $unreadNotifications=Notification::where('receiver_id','=',$foodie)->where('receiver_type','=','f')->where('is_read','=',0)->count();
        $chats= Chat::where('foodie_id','=',$foodie)->latest($column = 'updated_at')->get();
        $chefs = Chef::all();
//        dd($cartItems.': '.$cartTotal);

        return view('foodie.cart.index')->with([
            'cartItems' =>$cartItems,
            'cartTotal' =>$cartTotal,
            'messages' => $messages,
            'notifications' => $notifications,
            'unreadNotifications'=> $unreadNotifications,
            'sms_unverified' => $this->smsIsUnverified(),
            'foodie'=>Auth::guard('foodie')->user(),
            'chats' => $chats,
            'chefs' => $chefs,

        ]);
    }

    public function add($id, $cust){
        $plan = '';
        if($cust==0){
            $plan = Plan::where('id','=',$id)->first();
        }elseif($cust==1){
            $plan = CustomPlan::where('id','=',$id)->first();
        }

//        dd($plan);

        $dt=Carbon::now();
        $startOfNextWeek = $dt->startOfWeek()->addDay(7)->format('F d');
        if($cust == 0){
            Cart::add($id, $plan->plan_name,1,$plan->price,['cust'=>$cust,'chef'=>$plan->chef->id, 'date'=>$startOfNextWeek]);
        }elseif($cust == 1){
            Cart::add($id, $plan->plan->plan_name,1,$plan->plan->price,['cust'=>$cust,'chef'=>$plan->plan->chef->id, 'date'=>$startOfNextWeek]);
        }

//        dd($startOfNextWeek);
        return back()->with(['status'=>'Added to cart!']);
    }

    public function update($id){
        Cart::update($id, 2);

        return back()->with([
            'status'=>'Updated Quantity!'
        ]);

    }

    public function remove($id)
    {
        Cart::remove($id);

        return back()->with(['status'=>'Removed cart item']);
    }
}
