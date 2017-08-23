<?php

namespace App\Http\Controllers;

use App\Chat;
use App\Chef;
use App\Commission;
use App\CustomPlan;
use App\Gcash;
use App\Mail\PaymentSuccessFoodie;
use App\Notification;
use App\Http\Controllers\Controller;
use App\Deposit;
use App\Order;
use App\OrderItem;
use App\Plan;
use App\Rating;
use App\SimpleCustomPlan;
use Illuminate\Http\Request;
use App\Mail\PaymentSuccess;
use App\Mail\PaymentSuccessChef;
use App\Message;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
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
//        dd($user->email);
        $foodieName = $user->first_name.' '.$user->last_name;

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

//            $chatPayment=new Chat();
//            $chatPayment->foodie_id = Auth::guard('foodie')->user()->id;
//            $chatPayment->chef_id= $order->chef->id;
//            $chatPayment->save();
//
//
//            $notification = new Message();
//            $notification->chat_id= $chatPayment->id;
//            $notification->sender_id = Auth::guard('foodie')->user()->id;
//            $notification->receiver_id = $order->chef->id;
//            $notification->receiver_type = 'c';
//            $notification->receipt_name = $filename;
//            $notification->deposit_id = $deposit->id;
//            $notification->subject = 'Bank Deposit Payment';
//            $notification->message = 'Hello! I just paid it through bank deposit. Receipt Number: '.$receiptNumber;
//            $notification->save();

            $order->is_paid = 1;
            $order->save();

            $foodnotif= new Notification();
            $foodnotif->sender_id=0;
            $foodnotif->receiver_id=$user->id;
            $foodnotif->receiver_type='f';
            $foodnotif->notification='You have confirmed your order.';
            $foodnotif->notification_type=2;
//        dd($foodnotif);
            $foodnotif->save();

            $messageFoodie = 'You have confirmed your order through bank deposit. Thank you.';
            $foodiePhoneNumber = '0'.$user->mobile_number;
            $urlFoodie = 'https://www.itexmo.com/php_api/api.php';
            $itexmoFoodie = array('1' => $foodiePhoneNumber, '2' => $messageFoodie, '3' => 'ST-DIETS656642_77ZA3');
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

//            $chefnotif= new Notification();
//            $chefnotif->sender_id=0;
//            $chefnotif->receiver_id=$order->chef->id;
//            $chefnotif->receiver_type='c';
//            $chefnotif->notification=$user->first_name.' '.$user->last_name.' has paid for their order of: '.$order->plan->plan_name. '.';
//            $chefnotif->notification_type=2;
////        dd(chefdnotif);
//            $chefnotif->save();


            $orderItems = $order->order_item()->get();
            $orderPlanNames = [];
            $orderChef=[];

            foreach ($orderItems as $orderItem){
                $ratingChef="";
                $price = "";
                if($orderItem->order_type==0){
                    $orderPlan = Plan::where('id','=',$orderItem->plan_id)->first();
                    $orderChef[]=$orderPlan->chef->id;
                    $ratingChef=$orderPlan->chef->id;
                    $price=$orderPlan->price;
                    $orderPlanNames[] = array('plan_name'=>$orderPlan->plan_name, 'chef_id'=>$orderPlan->chef->id, 'chef_name'=>$orderPlan->chef->name,
                        'price'=>$orderPlan->price,'type'=>'Standard');
                }elseif($orderItem->order_type==1){
                    $orderPlan= CustomPlan::where('id','=',$orderItem->plan_id)->first();
                    $orderChef[]=$orderPlan->plan->chef->id;
                    $ratingChef=$orderPlan->plan->chef->id;
                    $price=$orderPlan->plan->price;

                    $orderPlanNames[] = array('plan_name'=>$orderPlan->plan->plan_name, 'chef_id'=>$orderPlan->plan->chef->id,'chef_name'=>$orderPlan->plan->chef->name,
                        'price'=>$orderPlan->plan->price,
                        'type'=>'Customized');
                }elseif($orderItem->order_type==2){
                    $orderPlan= SimpleCustomPlan::where('id','=',$orderItem->plan_id)->first();
                    $orderChef[]=$orderPlan->plan->chef->id;
                    $ratingChef=$orderPlan->plan->chef->id;
                    $price=$orderPlan->plan->price;

                    $orderPlanNames[] = array('plan_name'=>$orderPlan->plan->plan_name, 'chef_id'=>$orderPlan->plan->chef->id,'chef_name'=>$orderPlan->plan->chef->name,
                        'price'=>$orderPlan->plan->price,
                        'type'=>'Customized');
                }

                $com = new Commission();
                $com->chef_id = $ratingChef;
                $com->amount = $price;
                $com->save();

                $rating = new Rating();
                $rating->chef_id = $ratingChef;
                $rating->foodie_id = Auth::guard('foodie')->user()->id;
                $rating->order_item_id = $orderItem->id;
                $rating->save();
            }
//            dd($orderPlanNames);
            $amount = $order->total;


            $mailer->to($user->email)->send(new PaymentSuccessFoodie($amount,$orderPlanNames));


//            dd(Mail::failures());

            $uniqueChefs = array_unique($orderChef);

            foreach($uniqueChefs as $uniqueChef){
                $chef = Chef::where('id','=',$uniqueChef)->first();
                $chefOrderPlans = [];

                foreach($orderPlanNames as $orderPlanName){
                    if($orderPlanName['chef_id']==$uniqueChef){
                        $chefOrderPlans[]=array('plan_name'=>$orderPlanName['plan_name'],'type'=>$orderPlanName['type'],'price'=>$orderPlanName['price']);
                    }
                }

                $chefnotif= new Notification();
                $chefnotif->sender_id=0;
                $chefnotif->receiver_id=$uniqueChef;
                $chefnotif->receiver_type='c';
                $chefnotif->notification=$user->first_name.' '.$user->last_name.'\'s order has been confirmed.';
                $chefnotif->notification_type=2;
                $chefnotif->save();

                $mailer->to($chef->email)
                    ->send(new PaymentSuccessChef(
                        $foodieName,
                        $chefOrderPlans));

//                dd($user->email.' '.$chef->email);

                $message = $foodieName.'has confirmed their order for: ';
                foreach($chefOrderPlans as $chefOrderPlan){
                    $message.=$chefOrderPlan['plan_name'].'-'.$chefOrderPlan['type'].' ';
                }
                $message.='.';
                $chefPhoneNumber = '0'.$chef->mobile_number;
                $url = 'https://www.itexmo.com/php_api/api.php';
                $itexmo = array('1' => $chefPhoneNumber, '2' => $message, '3' => 'ST-DIETS656642_77ZA3');
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
            }

            return Redirect::route('foodie.dashboard')->with(['status'=>'Payment through Bank Deposit Successful!']);

        }

    }

    public function gcash(Request $request,Order $order,mailer\Mailer $mailer)
    {
        $user = Auth::guard('foodie')->user();
        $foodieName = $user->first_name.' '.$user->last_name;

        $this->validate($request, [
//            'gcRefNmbr' => 'required',
            'gcDatePay' => 'required',
            'gcPic' => 'required'
        ]);

        $image = $request['gcPic'];
        $date_of_pay=$request['gcDatePay'];
//        $receiptNumber = $request['gcRefNmbr'];
        if ($request->hasFile('gcPic')) {

            $filename = time() . '.' . $image->getClientOriginalExtension();
            $originalName = $image->getClientOriginalName();
            Image::make($image)->resize(500, 500)->save(public_path('img/' . $filename));

            $gcash = New Gcash();
//            $gcash->reference_number = $receiptNumber;
            $gcash->picture= $filename;
            $gcash->date_of_pay = $date_of_pay;
            $gcash->foodie_id = Auth::guard('foodie')->user()->id;
            $order->gcash()->save($gcash);
//
//            $chatPayment=new Chat();
//            $chatPayment->foodie_id = Auth::guard('foodie')->user()->id;
//            $chatPayment->chef_id= $order->chef->id;
//            $chatPayment->save();
//
//
//            $notification = new Message();
//            $notification->chat_id= $chatPayment->id;
//            $notification->sender_id = Auth::guard('foodie')->user()->id;
//            $notification->receiver_id = $order->chef->id;
//            $notification->receiver_type = 'c';
//            $notification->receipt_name = $filename;
//            $notification->deposit_id = $gcash->id;
//            $notification->subject = 'GCash Payment';
//            $notification->message = 'Hello! I just paid it through Gcash.';
//            $notification->save();
            $order->is_paid = 1;
            $order->save();

            $foodnotif= new Notification();
            $foodnotif->sender_id=0;
            $foodnotif->receiver_id=$user->id;
            $foodnotif->receiver_type='f';
            $foodnotif->notification='You have confirmed your order.';
            $foodnotif->notification_type=2;
//        dd($foodnotif);
            $foodnotif->save();

            $messageFoodie = 'You have confirmed your order through bank deposit. Thank you.';
            $foodiePhoneNumber = '0'.$user->mobile_number;
            $urlFoodie = 'https://www.itexmo.com/php_api/api.php';
            $itexmoFoodie = array('1' => $foodiePhoneNumber, '2' => $messageFoodie, '3' => 'ST-DIETS656642_77ZA3');
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

//            $chefnotif= new Notification();
//            $chefnotif->sender_id=0;
//            $chefnotif->receiver_id=$order->chef->id;
//            $chefnotif->receiver_type='c';
//            $chefnotif->notification=$user->first_name.' '.$user->last_name.' has paid for their order of: '.$order->plan->plan_name. '.';
//            $chefnotif->notification_type=2;
////        dd(chefdnotif);
//            $chefnotif->save();


            $orderItems = $order->order_item()->get();
            $orderPlanNames = [];
            $orderChef=[];

            foreach ($orderItems as $orderItem){
                $ratingChef="";
                $price="";
                if($orderItem->order_type==0){
                    $orderPlan = Plan::where('id','=',$orderItem->plan_id)->first();
                    $orderChef[]=$orderPlan->chef->id;
                    $ratingChef=$orderPlan->chef->id;
                    $price=$orderPlan->price;
                    $orderPlanNames[] = array('plan_name'=>$orderPlan->plan_name, 'chef_id'=>$orderPlan->chef->id, 'chef_name'=>$orderPlan->chef->name,
                        'price'=>$orderPlan->price,'type'=>'Standard');
                }elseif($orderItem->order_type==1){
                    $orderPlan= CustomPlan::where('id','=',$orderItem->plan_id)->first();
                    $orderChef[]=$orderPlan->plan->chef->id;
                    $ratingChef=$orderPlan->plan->chef->id;
                    $price=$orderPlan->plan->price;
                    $orderPlanNames[] = array('plan_name'=>$orderPlan->plan->plan_name, 'chef_id'=>$orderPlan->plan->chef->id,'chef_name'=>$orderPlan->plan->chef->name,
                        'price'=>$orderPlan->plan->price,
                        'type'=>'Customized');
                }elseif($orderItem->order_type==2){
                    $orderPlan= SimpleCustomPlan::where('id','=',$orderItem->plan_id)->first();
                    $orderChef[]=$orderPlan->plan->chef->id;
                    $ratingChef=$orderPlan->plan->chef->id;
                    $price=$orderPlan->plan->price;

                    $orderPlanNames[] = array('plan_name'=>$orderPlan->plan->plan_name, 'chef_id'=>$orderPlan->plan->chef->id,'chef_name'=>$orderPlan->plan->chef->name,
                        'price'=>$orderPlan->plan->price,
                        'type'=>'Customized');
                }

                $com = new Commission();
                $com->chef_id = $ratingChef;
                $com->amount = $price;
                $com->save();

                $rating = new Rating();
                $rating->chef_id = $ratingChef;
                $rating->foodie_id = Auth::guard('foodie')->user()->id;
                $rating->order_item_id = $orderItem->id;
                $rating->save();
            }

            $amount = $order->total;

            $mailer->to($user->email)->send(new PaymentSuccessFoodie($amount,$orderPlanNames));

            $uniqueChefs = array_unique($orderChef);

            foreach($uniqueChefs as $uniqueChef){
                $chef = Chef::where('id','=',$uniqueChef)->first();
                $chefOrderPlans = [];

                foreach($orderPlanNames as $orderPlanName){
                    if($orderPlanName['chef_id']==$uniqueChef){
                        $chefOrderPlans[]=array('plan_name'=>$orderPlanName['plan_name'],'type'=>$orderPlanName['type'],'price'=>$orderPlanName['price']);
                    }
                }

                $chefnotif= new Notification();
                $chefnotif->sender_id=0;
                $chefnotif->receiver_id=$uniqueChef;
                $chefnotif->receiver_type='c';
                $chefnotif->notification=$user->first_name.' '.$user->last_name.'\'s order has been confirmed.';
                $chefnotif->notification_type=2;
                $chefnotif->save();

                $mailer->to($chef->email)
                    ->send(new PaymentSuccessChef(
                        $foodieName,
                        $chefOrderPlans));

                $message = $foodieName.'has confirmed their order for: ';
                foreach($chefOrderPlans as $chefOrderPlan){
                    $message.=$chefOrderPlan['plan_name'].'-'.$chefOrderPlan['type'].' ';
                }
                $message.='.';
                $chefPhoneNumber = '0'.$chef->mobile_number;
                $url = 'https://www.itexmo.com/php_api/api.php';
                $itexmo = array('1' => $chefPhoneNumber, '2' => $message, '3' => 'ST-DIETS656642_77ZA3');
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
            }

            return Redirect::route('foodie.dashboard')->with(['status'=>'Payment through Gcash Successful!']);
        }
    }
}
