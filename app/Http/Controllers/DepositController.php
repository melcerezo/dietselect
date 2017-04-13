<?php

namespace App\Http\Controllers;

use App\Deposit;
use App\Order;
use App\Rating;
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

    public function deposit(Request $request, Order $order){
        $user = Auth::guard('foodie')->user();

        $this->validate($request, [
            'receipt_number' => 'required',
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

            $notification = new Message();
            $notification->sender_id = Auth::guard('foodie')->user()->id;
            $notification->receiver_id = $order->chef->id;
            $notification->receiver_type = 'c';
            $notification->receipt_name = $filename;
            $notification->deposit_id = $deposit->id;
            $notification->message = 'Hello! I just paid it through bank deposit.';
            $notification->save();

            $order->is_paid = 1;
            $order->save();

            $message = $user->first_name.' '.$user->last_name.' placed an order.';
            $chefPhoneNumber = $order->chef->mobile_number;
            $url = 'https://www.itexmo.com/php_api/api.php';
            $itexmo = array('1' => $chefPhoneNumber, '2' => $message, '3' => 'ST-MARKK578810_4MXKV');
            $param = array(
                'http' => array(
                    'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                    'method' => 'POST',
                    'content' => http_build_query($itexmo),
                ),
                "ssl" => array(
                    "verify_peer"      => false,
                    "verify_peer_name" => false,
                ),
            );
            $context = stream_context_create($param);
            file_get_contents($url, false, $context);

            $rating = new Rating();
            $rating->chef_id = $order->chef->id;
            $rating->foodie_id = Auth::guard('foodie')->user()->id;
            $order->rating()->save($rating);

            return back();
        }

    }
}
