<?php

namespace App\Http\Controllers;

use App\Deposit;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
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
//            $location = public_path('deposits');

//            $image->move($location, $image->getClientOriginalName());

            Image::make($image)->resize(500, 500)->save(public_path('deposits/' . $filename));


            $deposit = new Deposit();
            $deposit->receipt_name = $filename;
            $deposit->previous_file_name = $originalName;
            $deposit->foodie_id = Auth::guard('foodie')->user()->id;
            $order->deposit()->save($deposit);

            $notification = new Message();
            $notification->sender_id = Auth::guard('foodie')->user()->id;
            $notification->receiver_id = $order->chef->id;
            $notification->deposit_id = $deposit->id;

            return 'saved!';

        }
    }
}
