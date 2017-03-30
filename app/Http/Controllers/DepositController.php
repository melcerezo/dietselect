<?php

namespace App\Http\Controllers;

use App\Deposit;
use App\Order;
use Illuminate\Http\Request;
use App\Message;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class DepositController extends Controller
{
    public function __construct()
    {
        $this->middleware('foodie.auth');
    }


    public function deposit(Request $request, Order $order)
    {
        $this->validate($request, [
           'image' => 'required'
        ]);

        $image = $request['image'];


        if ($request->hasFile('image')) {

            $filename = time() . '.' . $image->getClientOriginalExtension();
            $originalName = $image->getClientOriginalName();
            Image::make($image)->resize(500, 500)->save(public_path('img/' . $filename));


            $deposit = new Deposit();
            $deposit->receipt_name = $filename;
            $deposit->previous_file_name = $originalName;
            $deposit->foodie_id = Auth::guard('foodie')->user()->id;
            $order->deposit()->save($deposit);

            $notification =  new Message();
            $notification->sender_id = Auth::guard('foodie')->user()->id;
            $notification->receiver_id = $order->chef->id;
            $notification->receiver_type = 'c';
            $notification->receipt_name = $filename;
            $notification->deposit_id = $deposit->id;
            $notification->message = 'Hello! I just paid it through bank deposit.';
            $notification->save();

            $order->is_paid = 1;
            $order->save();

            return 'saved!';

        }
    }
}
