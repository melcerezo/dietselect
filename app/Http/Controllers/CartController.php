<?php

namespace App\Http\Controllers;

use App\CustomPlan;
use App\SimpleCustomPlan;
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
        $dt=Carbon::now();
        $startOfNextWeek = $dt->startOfWeek()->addDay(7)->format('F d');
        $ds=Carbon::now();
        $endOfNextWeek = $ds->startOfWeek()->addDay(7)->addDay(4)->format('F d');


        $foodie= Auth::guard('foodie')->user()->id;
        $cartItems=Cart::content();
        $cartCount=Cart::count();
        $cartTotal=Cart::total();
        $messages = Message::where('receiver_id', '=', Auth::guard('foodie')->user()->id)
            ->where('receiver_type', '=', 'f')
            ->where('foodie_can_see', '=', 1)
            ->where('is_read','=',0)
            ->get();

        $notifications=Notification::where('receiver_id','=',$foodie)->where('receiver_type','=','f')->get();
        $unreadNotifications=Notification::where('receiver_id','=',$foodie)->where('receiver_type','=','f')->where('is_read','=',0)->count();
        $chats= Chat::where('foodie_id','=',$foodie)->where('foodie_can_see', '=', 1)->latest($column = 'updated_at')->get();
        $chefs = Chef::all();
//        dd($cartItems);

        return view('foodie.cart.index')->with([
            'cartItems' =>$cartItems,
            'cartTotal' =>$cartTotal,
            'cartCount' =>$cartCount,
            'messages' => $messages,
            'notifications' => $notifications,
            'unreadNotifications'=> $unreadNotifications,
            'sms_unverified' => $this->smsIsUnverified(),
            'foodie'=>Auth::guard('foodie')->user(),
            'nextWeek'=>$startOfNextWeek,
            'endNextWeek'=>$endOfNextWeek,
            'chats' => $chats,
            'chefs' => $chefs,

        ]);
    }

    public function add($id, $cust){
        $plan = '';
        $planCategory='';
        if($cust==0){
            $plan = Plan::where('id','=',$id)->first();
            if($plan->category==1){
                $planCategory='Weight Loss';
            }else if($plan->category==2){
                $planCategory='High Protein';
            }else if($plan->category==3){
                $planCategory='Vegetarian';
            }
        }elseif($cust==1){
            $plan = CustomPlan::where('id','=',$id)->first();
        }elseif($cust==2){
            $plan = SimpleCustomPlan::where('id','=',$id)->first();
        }


        $dt=Carbon::now();
        $startOfNextWeek = $dt->startOfWeek()->addDay(7)->format('F d');
        if($cust == 0){
            Cart::add($id, $plan->plan_name,1,$plan->price,['categ'=>$planCategory, 'pic'=>$plan->picture,'cust'=>$cust,'chef'=>$plan->chef->id, 'date'=>$startOfNextWeek]);
        }elseif($cust == 1){
            Cart::add($id, $plan->plan->plan_name,1,$plan->plan->price,['categ'=>$planCategory, 'pic'=>$plan->plan->picture,'cust'=>$cust,'chef'=>$plan->plan->chef->id, 'date'=>$startOfNextWeek]);
        }elseif($cust == 2){
            Cart::add($id, $plan->plan->plan_name,1,$plan->plan->price,['categ'=>$planCategory, 'pic'=>$plan->plan->picture,'cust'=>$cust,'chef'=>$plan->plan->chef->id, 'date'=>$startOfNextWeek]);
//            dd(Cart::content());
        }

//        dd($startOfNextWeek);
        return redirect()->route('cart.index')->with(['status'=>'Added to cart!']);
    }


    public function remove($id)
    {
        Cart::remove($id);

        return back()->with(['status'=>'Removed cart item']);
    }


    public function update($id, Request $request){
//        dd("hello");
        Cart::update($id, $request['qty']);

        return back()->with([
            'status'=>'Updated Quantity!'
        ]);
    }


}
