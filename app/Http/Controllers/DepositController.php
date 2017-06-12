<?php

namespace App\Http\Controllers;

use App\Chat;
use App\Gcash;
use App\Notification;
use App\Http\Controllers\Controller;
use App\Deposit;
use App\Order;
use App\Rating;
use Illuminate\Http\Request;
use App\Mail\PaymentSuccess;
use App\Mail\PaymentSuccessChef;
use App\Message;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Redirect;
use Illuminate\Mail as mailer;




class DepositController extends Controller
{
    public function __construct()
    {
        $this->middleware('foodie.auth');
    }

    public function deposit(Request $request, Order $order, mailer\Mailer $mailer){
        $user = Auth::guard('foodie')->user();

        $this->validate($request, [
            'receipt_number' => 'required',
            'datePay' => 'required',
            'image' => 'required'
        ]);

        $image = $request['image'];
        $date_of_pay = $request['datePay'];
        $receiptNumber=$request['receipt_number'];
        if ($request->hasFile('image')) {

            $filename = time() . '.' . $image->getClientOriginalExtension();
            $originalName = $image->getClientOriginalName();
            Image::make($image)->resize(500, 500)->save(public_path('img/' . $filename));

            $deposit = new Deposit();
            $deposit->reference_number = $receiptNumber;
            $deposit->receipt_name = $filename;
            $deposit->previous_file_name = $originalName;
            $deposit->date_of_pay = $date_of_pay;
            $deposit->foodie_id = Auth::guard('foodie')->user()->id;
            $order->deposit()->save($deposit);

            $chatPayment=new Chat();
            $chatPayment->foodie_id = Auth::guard('foodie')->user()->id;
            $chatPayment->chef_id= $order->chef->id;
            $chatPayment->save();


            $notification = new Message();
            $notification->chat_id= $chatPayment->id;
            $notification->sender_id = Auth::guard('foodie')->user()->id;
            $notification->receiver_id = $order->chef->id;
            $notification->receiver_type = 'c';
            $notification->receipt_name = $filename;
            $notification->deposit_id = $deposit->id;
            $notification->subject = 'Bank Deposit Payment';
            $notification->message = 'Hello! I just paid it through bank deposit. Receipt Number: '.$receiptNumber;
            $notification->save();

            $foodnotif= new Notification();
            $foodnotif->sender_id=0;
            $foodnotif->receiver_id=$user->id;
            $foodnotif->receiver_type='f';
            $foodnotif->notification='You have just paid your order for: '.$order->plan->plan_name. '.';
            $foodnotif->notification_type=2;
//        dd($foodnotif);
            $foodnotif->save();

            $chefnotif= new Notification();
            $chefnotif->sender_id=0;
            $chefnotif->receiver_id=$order->chef->id;
            $chefnotif->receiver_type='c';
            $chefnotif->notification=$user->first_name.' '.$user->last_name.' has paid for their order of: '.$order->plan->plan_name. '.';
            $chefnotif->notification_type=2;
//        dd(chefdnotif);
            $chefnotif->save();

            $order->is_paid = 1;
            $order->save();

            $chefName = $order->chef->name;
            $amount = $order->plan->price;

            $mailer->to($user->email)
                ->send(new PaymentSuccess(
                    $chefName,
                    $amount));

            $foodieName = $user->first_name.' '.$user->last_name;
            $amount = $order->plan->price;
            $planName = $order->plan->plan_name;

            $mailer->to($order->chef->email)
                ->send(new PaymentSuccessChef(
                    $foodieName,
                    $amount,
                    $planName));

            $message = $foodieName.' paid for the order of '.$planName.'.';
            $chefPhoneNumber = '0'.$order->chef->mobile_number;
            $url = 'https://www.itexmo.com/php_api/api.php';
            $itexmo = array('1' => $chefPhoneNumber, '2' => $message, '3' => 'TR-DIETS656642_GAG39');
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

            $messageFoodie = 'You have paid '.$chefName.' for your order of '.$planName.'.';
            $foodiePhoneNumber = '0'.$user->mobile_number;
            $urlFoodie = 'https://www.itexmo.com/php_api/api.php';
            $itexmoFoodie = array('1' => $foodiePhoneNumber, '2' => $messageFoodie, '3' => 'TR-DIETS656642_GAG39');
            $paramFoodie = array(
                'http' => array(
                    'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                    'method' => 'POST',
                    'content' => http_build_query($itexmoFoodie),
                ),
                "ssl" => array(
                    "verify_peer"      => false,
                    "verify_peer_name" => false,
                ),
            );
            $contextFoodie = stream_context_create($paramFoodie);
            file_get_contents($urlFoodie, false, $contextFoodie);

            $rating = new Rating();
            $rating->chef_id = $order->chef->id;
            $rating->foodie_id = Auth::guard('foodie')->user()->id;
            $order->rating()->save($rating);

            return Redirect::route('foodie.dashboard')->with(['status'=>'Payment through Bank Deposit Successful!','status2'=>'Please Rate '.$order->chef->name.'!']);

        }

    }

    public function gcash(Request $request,Order $order,mailer\Mailer $mailer)
    {
        $user = Auth::guard('foodie')->user();

        $this->validate($request, [
            'gcRefNmbr' => 'required',
            'gcDatePay' => 'required',
            'gcPic' => 'required'
        ]);

        $image = $request['gcPic'];
        $date_of_pay=$request['gcDatePay'];
        $receiptNumber = $request['gcRefNmbr'];
        if ($request->hasFile('gcPic')) {

            $filename = time() . '.' . $image->getClientOriginalExtension();
            $originalName = $image->getClientOriginalName();
            Image::make($image)->resize(500, 500)->save(public_path('img/' . $filename));

            $gcash = New Gcash();
            $gcash->reference_number = $receiptNumber;
            $gcash->picture= $filename;
            $gcash->date_of_pay = $date_of_pay;
            $gcash->foodie_id = Auth::guard('foodie')->user()->id;
            $order->gcash()->save($gcash);

            $chatPayment=new Chat();
            $chatPayment->foodie_id = Auth::guard('foodie')->user()->id;
            $chatPayment->chef_id= $order->chef->id;
            $chatPayment->save();


            $notification = new Message();
            $notification->chat_id= $chatPayment->id;
            $notification->sender_id = Auth::guard('foodie')->user()->id;
            $notification->receiver_id = $order->chef->id;
            $notification->receiver_type = 'c';
            $notification->receipt_name = $filename;
            $notification->deposit_id = $gcash->id;
            $notification->subject = 'GCash Payment';
            $notification->message = 'Hello! I just paid it through Gcash. Reference Number: '.$receiptNumber;
            $notification->save();

            $foodnotif= new Notification();
            $foodnotif->sender_id=0;
            $foodnotif->receiver_id=$user->id;
            $foodnotif->receiver_type='f';
            $foodnotif->notification='You have just paid your order for: '.$order->plan->plan_name. '.';
            $foodnotif->notification_type=2;
//        dd($foodnotif);
            $foodnotif->save();

            $chefnotif= new Notification();
            $chefnotif->sender_id=0;
            $chefnotif->receiver_id=$order->chef->id;
            $chefnotif->receiver_type='c';
            $chefnotif->notification=$user->first_name.' '.$user->last_name.' has paid for their order of: '.$order->plan->plan_name. '.';
            $chefnotif->notification_type=2;
//        dd(chefdnotif);
            $chefnotif->save();

            $order->is_paid = 1;
            $order->save();

            $chefName = $order->chef->name;
            $amount = $order->plan->price;

            $mailer->to($user->email)
                ->send(new PaymentSuccess(
                    $chefName,
                    $amount));

            $foodieName = $user->first_name.' '.$user->last_name;
            $amount = $order->plan->price;
            $planName = $order->plan->plan_name;

            $mailer->to($order->chef->email)
                ->send(new PaymentSuccessChef(
                    $foodieName,
                    $amount,
                    $planName));

            $message = $foodieName.' paid for the order of '.$planName.'.';
            $chefPhoneNumber = '0'.$order->chef->mobile_number;
            $url = 'https://www.itexmo.com/php_api/api.php';
            $itexmo = array('1' => $chefPhoneNumber, '2' => $message, '3' => 'TR-DIETS656642_GAG39');
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

            $messageFoodie = 'You have paid '.$chefName.' for your order of '.$planName.'.';
            $foodiePhoneNumber = '0'.$user->mobile_number;
            $urlFoodie = 'https://www.itexmo.com/php_api/api.php';
            $itexmoFoodie = array('1' => $foodiePhoneNumber, '2' => $messageFoodie, '3' => 'TR-DIETS656642_GAG39');
            $paramFoodie = array(
                'http' => array(
                    'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                    'method' => 'POST',
                    'content' => http_build_query($itexmoFoodie),
                ),
                "ssl" => array(
                    "verify_peer"      => false,
                    "verify_peer_name" => false,
                ),
            );
            $contextFoodie = stream_context_create($paramFoodie);
            file_get_contents($urlFoodie, false, $contextFoodie);

            $rating = new Rating();
            $rating->chef_id = $order->chef->id;
            $rating->foodie_id = Auth::guard('foodie')->user()->id;
            $order->rating()->save($rating);

            return Redirect::route('foodie.dashboard')->with(['status'=>'Payment through Bank Deposit Successful!','status2'=>'Please Rate '.$order->chef->name.'!']);
        }
    }
}
