<?php

namespace App\Http\Controllers;

use App\Chat;
use App\CustomPlan;
use App\Notification;
use App\Http\Controllers\Foodie\Auth\VerifiesSms;
use App\Message;
use App\Order;
use App\Plan;
use App\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class RatingsController extends Controller
{
    use VerifiesSms;


    public function __construct()
    {
        $this->middleware('foodie.auth');
    }

    public function getRatingPage()
    {
        $foodie = Auth::guard('foodie')->user();
        $chats= Chat::where('foodie_id','=',$foodie)->latest($column = 'updated_at')->get();
        $lastSaturday = Carbon::parse("last saturday 15:00:00")->format('Y-m-d H:i:s');
        $messages = Message::where('receiver_id', '=', Auth::guard('foodie')->user()->id)->where('receiver_type', '=', 'f')->where('is_read','=',0)->get();
        $orders = Order::where('foodie_id', '=', $foodie->id)->where('created_at','<',$lastSaturday)->where('is_paid','=',1)->get();
        $notifications=Notification::where('receiver_id','=',$foodie)->where('receiver_type','=','f')->get();
        $unreadNotifications=Notification::where('receiver_id','=',$foodie)->where('receiver_type','=','f')->where('is_read','=',0)->count();

        $ordersRatingChef = [];
        foreach($orders as $order){
            $orderItems = $order->order_item()->get();
            foreach($orderItems as $orderItem){
                $rating = $orderItem->rating;
                if($rating->is_rated==0){
                    $planName = "";
                    $chefName = "";
                    $orderType = "";
                    if ($orderItem->order_type == 0) {
                        $orderPlan = Plan::where('id', '=', $orderItem->plan_id)->first();
                        $planName = $orderPlan->plan_name;
                        $chefName = $orderPlan->chef->name;
                        $orderType = "Standard";
                    } elseif ($orderItem->order_type == 1) {
                        $orderPlan = CustomPlan::where('id', '=', $orderItem->plan_id)->first();
                        $planName = $orderPlan->plan->plan_name;
                        $chefName = $orderPlan->plan->chef->name;
                        $orderType = "Customized";
                    }

                    $ordersRatingChef[] = array('id' => $orderItem->id, 'order_id' => $orderItem->order_id, 'plan_id' => $orderItem->plan_id,
                        'plan' => $planName, 'chef' => $chefName, 'type' => $orderType, 'quantity' => $orderItem->quantity, 'price' => 'PHP' . $orderItem->price);
                }
            }
        }

//        dd($ratings);
//        dd($orders);
//        dd($ratings);
        return view('foodie.chefRating', compact('foodie', 'orders', 'ratings'))->with([
            'sms_unverified' => $this->smsIsUnverified(),
            'chats'=>$chats,
            'messages'=>$messages,
            'orders'=>$orders,
            'ordersRatingChef'=>$ordersRatingChef,
            'notifications'=>$notifications,
            'unreadNotifications'=>$unreadNotifications
        ]);
    }

    public function rateChef(Order $order, Request $request)
    {

        $foodie = Auth::guard('foodie')->user();
        $rating = Rating::where('order_id', '=', $order->id)->where('foodie_id', '=', $foodie->id)->first();
        $rating->feedback = $request['feedback'];
        $rating->rating = $request['rate'];
        $rating->is_rated = true;
        $order->rating()->save($rating);
//        dd($rating);
        return back();
    }
}
