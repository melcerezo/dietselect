<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Foodie\Auth\VerifiesSms;
use App\Message;
use App\Order;
use App\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RatingsController extends Controller
{
    use VerifiesSms;

    public function getRatingPage()
    {
        $foodie = Auth::guard('foodie')->user();

        $messages = Message::where('receiver_id', '=', Auth::guard('foodie')->user()->id)->where('receiver_type', '=', 'f')->get();
        $ordersCount= Order::where('foodie_id', '=', $foodie->id)->orderBy('created_at', 'desc')->get()->count();
        $ratingsCount=0;
        $orders='';
        $ratings='';
        if($ordersCount>0){
            $orders = Order::where('foodie_id', '=', $foodie->id)->orderBy('created_at', 'desc')->first();
            $ratingsCount = Rating::where('foodie_id', '=', $foodie->id)->where('order_id','=',$orders->id)->orderBy('created_at', 'desc')->get()->count();

        }
        if($ratingsCount>0){
            $ratings = Rating::where('foodie_id', '=', $foodie->id)->where('order_id','=',$orders->id)->orderBy('created_at', 'desc')->first();
        }
//        dd($ratings);
//        dd($orders);
//        dd($ratings);
        return view('foodie.chefRating', compact('foodie', 'orders', 'ratings'))->with([
            'sms_unverified' => $this->smsIsUnverified(),
            'messages'=>$messages,
            'ratingsCount'=>$ratingsCount
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
