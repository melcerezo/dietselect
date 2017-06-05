<?php

namespace App\Http\Controllers;

use App\Chat;
use App\Http\Controllers\Foodie\Auth\VerifiesSms;
use App\Message;
use App\Order;
use App\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class RatingsController extends Controller
{
    use VerifiesSms;

    public function getRatingPage()
    {
        $foodie = Auth::guard('foodie')->user();
        $chats= Chat::where('foodie_id','=',$foodie)->latest($column = 'updated_at')->get();
        $lastSaturday = Carbon::parse("last saturday 15:00:00")->format('Y-m-d H:i:s');
        $messages = Message::where('receiver_id', '=', Auth::guard('foodie')->user()->id)->where('receiver_type', '=', 'f')->where('is_read','=',0)->get();
        $orders = Order::where('foodie_id', '=', $foodie->id)->where('created_at','<',$lastSaturday)->where('is_paid','=',1)->get();

//        dd($orders->count());

//        dd($ratings);
//        dd($orders);
//        dd($ratings);
        return view('foodie.chefRating', compact('foodie', 'orders', 'ratings'))->with([
            'sms_unverified' => $this->smsIsUnverified(),
            'chats'=>$chats,
            'messages'=>$messages,
            'orders'=>$orders
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
