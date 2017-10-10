<?php

namespace App\Http\Controllers;

use App\Chat;
use App\CustomPlan;
use App\Notification;
use App\Http\Controllers\Foodie\Auth\VerifiesSms;
use App\Message;
use App\Order;
use App\OrderItem;
use App\Plan;
use App\Rating;
use App\SimpleCustomPlan;
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

    public function getRatingPage($id)
    {
        if($id==0 || $id==1){
            $from=$id;
        }else{
            $from=0;
        }

        $foodie = Auth::guard('foodie')->user();
        $chats= Chat::where('foodie_id','=',$foodie)->where('foodie_can_see', '=', 1)->latest($column = 'updated_at')->get();
//        $lastTwoWeeks = Carbon::parse("previous week Saturday 15:00:00")->subDays(7)->format('Y-m-d H:i:s');
        $messages = Message::where('receiver_id', '=', Auth::guard('foodie')->user()->id)->where('foodie_can_see', '=', 1)->where('receiver_type', '=', 'f')->where('is_read','=',0)->get();
        $orders = Order::where('foodie_id', '=', $foodie->id)->where('is_paid','=',1)->latest()->get();
        $notifications=Notification::where('receiver_id','=',$foodie->id)->where('receiver_type','=','f')->get();
        $unreadNotifications=Notification::where('receiver_id','=',$foodie->id)->where('receiver_type','=','f')->where('is_read','=',0)->count();

//        dd($orders);

        $ordersRatingChef = [];
        $ordersRatingsFinished =[];
        foreach($orders as $order){
            $orderItems = $order->order_item()->get();
            foreach($orderItems as $orderItem){
                $rating = $orderItem->rating;
                if(!is_null($orderItem->rating)){
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
                        }elseif ($orderItem->order_type == 2) {
                            $orderPlan = SimpleCustomPlan::where('id', '=', $orderItem->plan_id)->first();
                            $planName = $orderPlan->plan->plan_name;
                            $chefName = $orderPlan->plan->chef->name;
                            $orderType = "Customized";
                        }

                        $ordersRatingChef[] = array('id' => $orderItem->id, 'order_id' => $orderItem->order_id, 'plan_id' => $orderItem->plan_id,'created_at'=>$orderItem->created_at,
                            'plan' => $planName, 'chef' => $chefName, 'type' => $orderType, 'quantity' => $orderItem->quantity, 'price' => 'PHP' . $orderItem->price);
                    }else if($rating->is_rated==1){
                        $planName = "";
                        $chefName = "";
                        $orderType = "";
                        $planPic="";
                        if ($orderItem->order_type == 0) {
                            $orderPlan = Plan::where('id', '=', $orderItem->plan_id)->first();
                            $planName = $orderPlan->plan_name;
                            $chefName = $orderPlan->chef->name;
                            $planPic=$orderPlan->picture;
                            $orderType = "Standard";
                        } elseif ($orderItem->order_type == 1) {
                            $orderPlan = CustomPlan::where('id', '=', $orderItem->plan_id)->first();
                            $planName = $orderPlan->plan->plan_name;
                            $chefName = $orderPlan->plan->chef->name;
                            $planPic=$orderPlan->plan->picture;
                            $orderType = "Customized";
                        }elseif ($orderItem->order_type == 2) {
                            $orderPlan = SimpleCustomPlan::where('id', '=', $orderItem->plan_id)->first();
                            $planName = $orderPlan->plan->plan_name;
                            $chefName = $orderPlan->plan->chef->name;
                            $planPic=$orderPlan->plan->picture;
                            $orderType = "Customized";
                        }

                        $ordersRatingsFinished[] = array('id' => $orderItem->id, 'order_id' => $orderItem->order_id, 'plan_id' => $orderItem->plan_id, 'rating' => $rating->rating,'picture'=>$planPic ,
                            'feedback'=>$rating->feedback,'created_at'=>$orderItem->created_at,'plan' => $planName, 'chef' => $chefName, 'type' => $orderType, 'quantity' => $orderItem->quantity, 'price' => 'PHP' . $orderItem->price);
                    }
                }
            }
        }

//        dd($ordersRatingChef);
//        dd($orders);
//        dd($ratings);
        return view('foodie.chefRating', compact('foodie', 'orders', 'ratings'))->with([
            'sms_unverified' => $this->smsIsUnverified(),
            'chats'=>$chats,
            'messages'=>$messages,
            'orders'=>$orders,
            'ordersRatingChef'=>$ordersRatingChef,
            'ordersRatingsFinished'=>$ordersRatingsFinished,
            'notifications'=>$notifications,
            'unreadNotifications'=>$unreadNotifications,
            'from'=>$from
        ]);
    }

    public function rateChef(OrderItem $orderItem,$key, Request $request)
    {

        $foodie = Auth::guard('foodie')->user();
        $rating = Rating::where('order_item_id', '=', $orderItem->id)->where('foodie_id', '=', $foodie->id)->first();
//        dd($rating);
        $rating->feedback = $request['feedback'.$key];
        $rating->rating = $request['rating'];
        $rating->is_rated = true;
        $orderItem->rating()->save($rating);
//        dd($rating);
        return redirect()->route('chef.rating', ['id'=>1])->with([ 'status'=> 'Successfully rated the plan!']);
    }
}
