<?php

namespace App\Http\Controllers\Foodie;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Foodie\Auth\VerifiesSms;
use App\Mail\MyOrderMail;
use App\Mail\MyOrderMailChef;
use App\Order;
use App\Plan;
use App\Message;
use App\CustomizedMeal;
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

    public function custStore(Plan $plan,$customId,mailer\Mailer $mailer){
        $foodie = Auth::guard('foodie')->user();

        $customList=json_decode($customId);

        $order = new Order();
        $order->chef_id = $plan->chef_id;
        $order->foodie_id = $foodie->id;
        $order->order_type = 'c';
        $plan->orders()->save($order);

        $customize=[];

        for($i=0;$i<count($customList);$i++) {
            $customize[] = CustomizedMeal::where('id', '=', $customList[$i])->first();
            $customize[$i]->order_id=$order->id;
            $customize[$i]->save();
        }

        // Message Template
        $planName = $plan->plan_name;
        $chefName = $plan->chef->name;
        $price = $plan->price;

        $mailer->to($foodie->email)
            ->send(new MyOrderMail(
                $planName,
                $chefName,
                $price));

        $foodieName = $foodie->first_name.' '.$foodie->last_name;
//        dd($foodieName);
        $mailer->to($order->chef->email)
            ->send(new MyOrderMailChef(
                $planName,
                $foodieName,
                $price));


        $message = $foodieName.' has ordered '.$planName.'.';
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

        $messageFoodie = 'You have ordered the plan, '.$planName.', from the chef, '.$chefName.'.';
        $foodiePhoneNumber = $foodie->mobile_number;
        $urlFoodie = 'https://www.itexmo.com/php_api/api.php';
        $itexmoFoodie = array('1' => $foodiePhoneNumber, '2' => $messageFoodie, '3' => 'ST-MARKK578810_4MXKV');
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
        //        $message = new MailMessage();
        //        $message->subject('Order')
        //            ->line($foodie.' placed an order created by:'. $plan->chef->name)
        //            ->success();

        return redirect()->route('order.show', $order->id);
    }


    public function store(Plan $plan, mailer\Mailer $mailer){
        $foodie = Auth::guard('foodie')->user();
        $order = new Order();
        $order->chef_id = $plan->chef_id;
        $order->foodie_id = $foodie->id;
        $plan->orders()->save($order);

        // Message Template
        $planName = $plan->plan_name;
        $chefName = $plan->chef->name;
        $price = $plan->price;

            $mailer->to($foodie->email)
            ->send(new MyOrderMail(
                $planName,
                $chefName,
                $price));

        $foodieName = $foodie->first_name.' '.$foodie->last_name;
//        dd($foodieName);
        $mailer->to($order->chef->email)
            ->send(new MyOrderMailChef(
                $planName,
                $foodieName,
                $price));


        $message = $foodieName.' has ordered '.$planName.'.';
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

        $messageFoodie = 'You have ordered the plan, '.$planName.', from the chef, '.$chefName.'.';
        $foodiePhoneNumber = $foodie->mobile_number;
        $urlFoodie = 'https://www.itexmo.com/php_api/api.php';
        $itexmoFoodie = array('1' => $foodiePhoneNumber, '2' => $messageFoodie, '3' => 'ST-MARKK578810_4MXKV');
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
    //        $message = new MailMessage();
    //        $message->subject('Order')
    //            ->line($foodie.' placed an order created by:'. $plan->chef->name)
    //            ->success();

        return redirect()->route('order.show', $order->id);
    }


    public function show(Order $order){
        $foodie = Auth::guard('foodie')->user();
        $plan = Plan::where('id', '=', $order->plan_id)->first();
        $messages = Message::where('receiver_id', '=', $foodie->id)->where('receiver_type', '=', 'f')->get();
        $foodieOrder = Order::where('foodie_id', '=', $foodie->id)->where('is_paid', '=', 0)->orderBy('created_at', 'desc')->first();

        return view('foodie.showOrder', compact('order', 'foodieOrder', 'plan'))->with([
            'sms_unverified' => $this->smsIsUnverified(),
            'foodie'=>Auth::guard('foodie')->user(),
            'messages'=>$messages
        ]);
    }
    public function showAll(){
        $foodie = Auth::guard('foodie')->user();
        $order = Order::where('foodie_id','=',$foodie->id)->get();

        return view()->with([

        ]);


    }
}
