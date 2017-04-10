<?php

namespace App\Http\Controllers\Foodie;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Foodie\Auth\VerifiesSms;
use App\Mail\MyOrderMail;
use App\Order;
use App\Plan;
use App\Message;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Mail as mailer;

class FoodieOrderPlanController extends Controller
{

    use VerifiesSms;
    use Notifiable;

    public function __construct()
    {
        $this->middleware('foodie.auth');
    }

    // Shows the order plan
    public function index(Plan $plan)
    {
        $messages = Message::where('receiver_id', '=', Auth::guard('foodie')->user()->id)->where('receiver_type', '=', 'f')->get();

        return view('foodie.orders', compact('plan'))->with([
            'sms_unverified' => $this->smsIsUnverified(),
            'foodie'=>Auth::guard('foodie')->user(),
            'messages'=>$messages
        ]);
    }


    public function store(Plan $plan, mailer\Mailer $mailer){
        $foodie = Auth::guard('foodie')->user();
        $order = new Order();
        $order->chef_id = $plan->chef_id;
        $order->foodie_id = $foodie->id;
        $plan->orders()->save($order);

            $mailer->to($foodie->email)
            ->send(new MyOrderMail($plan->plan_name));
    //        $message = new MailMessage();
    //        $message->subject('Order')
    //            ->line($foodie.' placed an order created by:'. $plan->chef->name)
    //            ->success();

        return redirect()->route('order.show', $order->id);
    }


    public function show(Order $order){
        $foodie = Auth::guard('foodie')->user();
        $plan = Plan::where('id', '=', $order->plan_id)->get();
        $messages = Message::where('receiver_id', '=', $foodie->id)->where('receiver_type', '=', 'f')->get();
        $foodieOrder = Order::where('foodie_id', '=', $foodie->id)->where('is_paid', '=', null)->get();

        return view('foodie.showOrder', compact('order', 'foodieOrder', 'plan'))->with([
            'sms_unverified' => $this->smsIsUnverified(),
            'foodie'=>Auth::guard('foodie')->user(),
            'messages'=>$messages
        ]);
    }
}
