<?php

namespace App\Http\Controllers;

use App\Chat;
use App\Chef;
use App\CustomPlan;
use App\Http\Requests;
use App\Order;
use App\Message;
use App\Plan;
use App\Rating;
use App\Mail\PaymentSuccess;
use App\Mail\PaymentSuccessChef;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Validator;
use URL;
use Session;
use Redirect;
use Illuminate\Mail as mailer;

/** All Paypal Details class **/
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;

class AddMoneyController extends Controller{
    private $_api_context;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
//        parent::__construct();

        /** setup PayPal api context **/
        $paypal_conf = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'],
            $paypal_conf['secret']));
        $this->_api_context->setConfig($paypal_conf['settings']);
    }

    /**
     * Show the application paywith paypalpage.
     *
     * @return \Illuminate\Http\Response
     */
//    public function payWithPaypal(Order $order){
//        return view('paywithpaypal', compact('order'));
//    }

    /**
     * Store a details of payment with paypal.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function postPaymentWithpaypal(Request $request, Order $order){
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        $item_1 = new Item();
        $item_1->setName('Item 1')/** item name **/
        ->setCurrency('PHP')
            ->setQuantity(1)
            ->setPrice($order->total);
        /** unit price **/
        $item_list = new ItemList();
        $item_list->setItems(array($item_1));
        $amount = new Amount();
        $amount->setCurrency('PHP')
            ->setTotal($order->total);
        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('Your transaction description');
        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::route('order.show', $order->id))/** Specify return URL **/
        ->setCancelUrl(URL::route('order.show', $order->id));
        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));
        /** dd($payment->create($this->_api_context));exit; **/
        try {
            $payment->create($this->_api_context);
        } catch (\PayPal\Exception\PPConnectionException $ex) {
            if (\Config::get('app.debug')) {
                \Session::put('error', 'Connection timeout');
                return Redirect::route('order.show', $order->id)->with(['status'=>'Payment cancelled!']);
//                return Redirect::route('addmoney.paywithpaypal', compact('order'));
                /** echo "Exception: " . $ex->getMessage() . PHP_EOL; **/
                /** $err_data = json_decode($ex->getData(), true); **/
                /** exit; **/
            } else {
                \Session::put('error', 'Some error occur, sorry for inconvenient');
                return Redirect::route('order.show', $order->id)->with(['status'=>'Payment cancelled!']);
//                return Redirect::route('addmoney.paywithpaypal', compact('order'));
                /** die('Some error occur, sorry for inconvenient'); **/
            }
        }
        foreach ($payment->getLinks() as $link) {
            if ($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }
        /** add payment ID to session **/
        Session::put('paypal_payment_id', $payment->getId());
        if (isset($redirect_url)) {
            /** redirect to paypal **/
            return Redirect::away($redirect_url);
        }
        \Session::put('error', 'Unknown error occurred');
        return Redirect::route('order.show', $order->id)->with(['status'=>'Payment cancelled!']);
//        return Redirect::route('addmoney.paywithpaypal', compact('order'));
    }

    public function getPaymentStatus(Order $order,mailer\Mailer $mailer){
        /** Get the payment ID before session clear **/
        $payment_id = Session::get('paypal_payment_id');
        /** clear the session payment ID **/
        Session::forget('paypal_payment_id');
//        if (empty(Auth::guard('foodie')->user()->id || Auth::guard('chef')->user()->id) || empty(Input::get('token'))) {
        if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {
            \Session::put('error', 'Payment failed');
            return Redirect::route('order.show', $order->id)->with(['status'=>'Payment cancelled!']);
        }
        $payment = Payment::get($payment_id, $this->_api_context);
        /** PaymentExecution object includes information necessary **/
        /** to execute a PayPal account payment. **/
        /** The payer_id is added to the request query parameters **/
        /** when the user is redirected from paypal back to your site **/
        $execution = new PaymentExecution();
        $execution->setPayerId(Input::get('PayerID'));
//        $execution->setPayerId(empty(Auth::guard('foodie')->user()->id || Auth::guard('chef')->user()->id));
        /**Execute the payment **/
        $result = $payment->execute($execution, $this->_api_context);
        /** dd($result);exit; /** DEBUG RESULT, remove it later **/
        if ($result->getState() == 'approved') {

            /** it's all right **/
            /** Here Write your database logic like that insert record or value in database if you want **/
            $user=Auth::guard('foodie')->user();
            $foodieName = $user->first_name.' '.$user->last_name;

            $paypal = new

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
                if($orderItem->order_type==0){
                    $orderPlan = Plan::where('id','=',$orderItem->plan_id)->first();
                    $orderChef[]=$orderPlan->chef->id;
                    $orderPlanNames[] = array('plan_name'=>$orderPlan->plan_name, 'chef_id'=>$orderPlan->chef->id, 'chef_name'=>$orderPlan->chef->name,
                        'price'=>$orderPlan->price,'type'=>'Standard');
                }elseif($orderItem->order_type==1){
                    $orderPlan= CustomPlan::where('id','=',$orderItem->plan_id)->first();
                    $orderChef[]=$orderPlan->plan->chef->id;
                    $orderPlanNames[] = array('plan_name'=>$orderPlan->plan->plan_name, 'chef_id'=>$orderPlan->plan->chef->id,'chef_name'=>$orderPlan->plan->chef->name,
                        'price'=>$orderPlan->plan->price,
                        'type'=>'Customized');
                }
            }

            $amount = $order->total;

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

                $rating = new Rating();
                $rating->chef_id = $uniqueChef;
                $rating->foodie_id = Auth::guard('foodie')->user()->id;
                $order->rating()->save($rating);

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



            $mailer->to($user->email)
                ->send(new PaymentSuccess(
                    $orderPlanNames,
                    $amount));


            \Session::put('success', 'Payment success');
            return Redirect::route('foodie.dashboard')->with(['status'=>'Payment through Paypal Successful!', 'status2'=>'Please rate '.$order->chef->name.'!']);
//            return Redirect::route('addmoney.paywithpaypal', compact('order'));
        }
        \Session::put('error', 'Payment failed');
        return Redirect::route('order.show', $order->id)->with(['status'=>'Payment cancelled!']);
    }
}
