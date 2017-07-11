<?php

namespace App\Http\Controllers\Foodie;

use App\Chat;
use App\Notification;
use App\Chef;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Foodie\Auth\VerifiesSms;
use App\Mail\MyOrderMail;
use App\Mail\MyOrderMailChef;
use App\Order;
use App\OrderItem;
use App\Plan;
use App\Message;
use App\CustomizedMeal;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Mail as mailer;
use Illuminate\Http\Request;
use Validator;
use Carbon\Carbon;

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
        $messages = Message::where('receiver_id', '=', Auth::guard('foodie')->user()->id)->where('receiver_type', '=', 'f')->where('is_read','=',0)->get();
        $foodie = Auth::guard('foodie')->user()->id;
        $chats= Chat::where('foodie_id','=',$foodie)->latest($column = 'updated_at')->get();
        $chefs = Chef::all();
        $notifications=Notification::where('receiver_id','=',$foodie)->where('receiver_type','=','f')->get();
        $unreadNotifications=Notification::where('receiver_id','=',$foodie)->where('receiver_type','=','f')->where('is_read','=',0)->count();

        return view('foodie.orders', compact('plan'))->with([
            'sms_unverified' => $this->smsIsUnverified(),
            'foodie'=>Auth::guard('foodie')->user(),
            'messages'=>$messages,
            'chats' => $chats,
            'chefs'=>$chefs,
            'notifications'=>$notifications,
            'unreadNotifications'=>$unreadNotifications
        ]);
    }

    public function getAllOrdersView($from){

//        dd($from);
        $foodie = Auth::guard('foodie')->user();
        $orders='';
        $ordersCount=Order::where('foodie_id','=',$foodie->id)->count();
        $pendOrdCount=Order::where('foodie_id','=',$foodie->id)->where('is_paid','=',0)->where('is_cancelled','=',0)->count();
        $paidOrdCount=Order::where('foodie_id','=',$foodie->id)->where('is_paid','=',1)->where('is_cancelled','=',0)->count();
        $cancelOrdCount=Order::where('foodie_id','=',$foodie->id)->where('is_cancelled','=',1)->count();



        $chats= Chat::where('foodie_id','=',$foodie->id)->latest($column = 'updated_at')->get();
        $chefs= Chef::all();
        if($ordersCount>0){
            $orders=Order::where('foodie_id','=',$foodie->id)->latest($column = 'created_at')->get();
        }

        $messages = Message::where('receiver_id', '=', Auth::guard('foodie')->user()->id)->where('receiver_type', '=', 'f')->where('is_read','=',0)->get();

        $notifications=Notification::where('receiver_id','=',$foodie->id)->where('receiver_type','=','f')->get();
        $unreadNotifications=Notification::where('receiver_id','=',$foodie->id)->where('receiver_type','=','f')->where('is_read','=',0)->count();
//        dd($unreadNotifications);


        return view('foodie.viewAllOrders')->with([
            'sms_unverified' => $this->smsIsUnverified(),
            'foodie'=>$foodie,
            'orders'=>$orders,
            'ordersCount'=>$ordersCount,
            'pendOrdCount'=>$pendOrdCount,
            'paidOrdCount'=>$paidOrdCount,
            'cancelOrdCount'=>$cancelOrdCount,
            'chefs'=>$chefs,
            'chats' => $chats,
            'messages'=>$messages,
            'notifications'=>$notifications,
            'unreadNotifications'=>$unreadNotifications,
            'from'=>$from
        ]);
    }

    public function getOneOrderDetails(Order $order){
        $foodie = Auth::guard('foodie')->user();
        $messages = Message::where('receiver_id', '=', Auth::guard('foodie')->user()->id)->where('receiver_type', '=', 'f')->where('is_read','=',0)->get();
        $chats= Chat::where('foodie_id','=',$foodie)->latest($column = 'updated_at')->get();
        $orderPlan=$order->plan->first();
        $orderMealPlans=$orderPlan->mealplans()->get();
        $orderMealPlansCount = $orderMealPlans->count();
//        dd($orderMealPlans);
        $orderCustomizedMeals=[];
        $ingredientMeals=[];
        $ingredientMealData=[];
        $ingredientCount = DB::table('ingredient_meal')
            ->join('meals', 'ingredient_meal.meal_id', '=', 'meals.id')
            ->join('meal_plans', 'meal_plans.meal_id', '=', 'meals.id')
            ->count();

        for($i=0;$i<count($orderMealPlans);$i++){
            $orderCustomizedMeals[]=CustomizedMeal::where('meal_id','=',$orderMealPlans[$i]->meal_id)->where('order_id','=',$order->id)->first();
            for($j=0;$j<$orderCustomizedMeals[$i]->customized_ingredient_meal->count();$j++){
                $ingredientMeals[]=$orderCustomizedMeals[$i]->customized_ingredient_meal[$j];
            }
        }
        for($i=0;$i<count($ingredientMeals);$i++){
            $ingredientDesc=DB::table('ingredients')
                ->join('ingredients_group_description','ingredients.FdGrp_Cd','=','ingredients_group_description.FdGrp_Cd')
                ->where('NDB_No','=',$ingredientMeals[$i]->ingredient_id)
                ->select('ingredients.Long_Desc','ingredients_group_description.FdGrp_Desc')
                ->first();
            $ingredientMealData[]=array(
                "meal"=>$ingredientMeals[$i]->meal_id,
                "ingredient"=>$ingredientDesc->Long_Desc,
                "ingredient_group"=>$ingredientDesc->FdGrp_Desc,
                "grams"=>$ingredientMeals[$i]->grams
            );
        }
//        dd($ingredientMealData);

        $notifications=Notification::where('receiver_id','=',$foodie->id)->where('receiver_type','=','f')->get();
        $unreadNotifications=Notification::where('receiver_id','=',$foodie->id)->where('receiver_type','=','f')->where('is_read','=',0)->count();
        $chefs=Chef::all();
        return view('foodie.viewSingleOrder')->with([
            'sms_unverified' => $this->smsIsUnverified(),
            'foodie'=>$foodie,
            'chats'=>$chats,
            'chefs'=>$chefs,
            'messages'=>$messages,
            'notifications'=>$notifications,
            'unreadNotifications'=>$unreadNotifications,
            'mealPlans'=>$orderMealPlans,
            'mealPlansCount'=>$orderMealPlansCount,
            'customize'=>$orderCustomizedMeals,
            'ingredientsMeal'=>$ingredientMealData,
            'ingredientCount'=>$ingredientCount
        ]);
    }

    public function order(mailer\Mailer $mailer)
    {
        $foodie = Auth::guard('foodie')->user();
        $cartItems = Cart::content();
        $messages = Message::where('receiver_id', '=', Auth::guard('foodie')->user()->id)
            ->where('receiver_type', '=', 'f')
            ->where('is_read','=',0)
            ->get();

        $notifications=Notification::where('receiver_id','=',$foodie->id)->where('receiver_type','=','f')->get();
        $unreadNotifications=Notification::where('receiver_id','=',$foodie->id)->where('receiver_type','=','f')->where('is_read','=',0)->count();
        $chats= Chat::where('foodie_id','=',$foodie->id)->latest($column = 'updated_at')->get();
        $chefs = Chef::all();
        $thisSaturday=Carbon::parse('this saturday')->format('F d');

        $foodnotif=new Notification();
        $foodnotif->sender_id=0;
        $foodnotif->receiver_id=$foodie->id;
        $foodnotif->receiver_type='f';
        $foodnotif->notification='Your order has been placed ';
        $foodnotif->notification.='. Please pay before '.$thisSaturday.'.';
        $foodnotif->notification_type=1;
        $foodnotif->save();

        $mailHTML ='<table>';
        $mailHTML .='<tr>';
        $mailHTML .='<td>Name</td>';
        $mailHTML .='<td>Chef</td>';
        $mailHTML .='<td>Quantity</td>';
        $mailHTML .='<td>Price</td>';
        $mailHTML .='<td>Type</td>';
        $mailHTML .='<td>Week</td>';
        $mailHTML .='</tr>';

        $order = new Order();
        $order->foodie_id = $foodie->id;
        $order->total = floatval(str_replace( ',', '', Cart::total() ));
        $order->save();

        $cartChefs = [];

        foreach($cartItems as $cartItem){
            $orderItem = new OrderItem();
            $orderItem->order_id = $order->id;
            $orderItem->plan_id = $cartItem->id;
            $orderItem->order_type = $cartItem->options->cust;
            $orderItem->quantity = $cartItem->qty;
            $orderItem->save();
            $mailHTML.='<tr>';
            $mailHTML.='<td>'.$cartItem->name.'</td>';
            foreach($chefs as $chef){
                if($chef->id==$cartItem->options->chef){
                    $mailHTML.='<td>'.$chef->name.'</td>';
                }
            }
            $mailHTML.='<td>'.$cartItem->qty.'</td>';
            $mailHTML.='<td>'.$cartItem->price.'</td>';
            if($cartItem->options->cust==0){
                $mailHTML.='<td>Standard</td>';
            }elseif($cartItem->options->cust==1){
                $mailHTML.='<td>Customized</td>';
            }
            $mailHTML.='<td>'.$cartItem->options->date.'</td>';
            $mailHTML.='</tr>';
            $cartChefs[] = $cartItem->options->chef;
        }


        $price = Cart::total();

        $mailer->to($foodie->email)
            ->send(new MyOrderMail(
                $mailHTML,
                $price
            ));

        $orderChefs = array_unique($cartChefs);
//        dd($orderChefs);

        foreach($orderChefs as $orderChef){
            $planName = [];
            foreach($cartItems as $cartItem){
                if($cartItem->options->chef==$orderChef){
                    $planName[]= $cartItem->name;
                    if($cartItem->options->cust==0){
                        $planName[].='- Standard';
                    }elseif($cartItem->options->cust==1){
                        $planName[].='- Custom';
                    }
                }
            }
            $chefnotif=new Notification();
            $chefnotif->sender_id=0;
            $chefnotif->receiver_id=$orderChef;
            $chefnotif->receiver_type='c';
            $chefnotif->notification=$foodie->first_name.' '.$foodie->last_name .' has placed an order.';
            $chefnotif->notification_type=1;
            $chefnotif->save();

            $emailChef = Chef::where('id','=', $orderChef)->select('email')->first();
            $foodieName = $foodie->first_name.' '.$foodie->last_name;
            $price = Cart::total();
//        dd($foodieName);
            $mailer->to($emailChef)
                ->send(new MyOrderMailChef(
                    $planName,
                    $foodieName,
                    $price));
        }

        return redirect()->route('order.show', $order->id);

    }

    public function custStore(Plan $plan,$customId,mailer\Mailer $mailer){
        $foodie = Auth::guard('foodie')->user();
        $thisSaturday=Carbon::parse('this saturday')->format('F d');
        $customList=json_decode($customId);
        $order = new Order();
        $order->chef_id = $plan->chef_id;
        $order->foodie_id = $foodie->id;
        $order->order_type = 'c';
        $plan->orders()->save($order);
        $chefs=Chef::all();
        $customize=[];

        for($i=0;$i<count($customList);$i++) {
            $customize[] = CustomizedMeal::where('id', '=', $customList[$i])->first();
            $customize[$i]->order_id=$order->id;
//            dd($order->id);
            $customize[$i]->save();
        }

        //Notification

        $foodnotif=new Notification();
        $foodnotif->sender_id=0;
        $foodnotif->receiver_id=$foodie->id;
        $foodnotif->receiver_type='f';
        $foodnotif->notification='You have just ordered the plan: '.$plan->plan_name. ' from ';
        $foodnotif->notification.=$plan->chef->name;
        $foodnotif->notification.='. Please pay before '.$thisSaturday.'.';
        $foodnotif->notification_type=1;
//        dd($foodnotif);
        $foodnotif->save();

        $chefnotif=new Notification();
        $chefnotif->sender_id=0;
        $chefnotif->receiver_id=$plan->chef_id;
        $chefnotif->receiver_type='c';
        $chefnotif->notification=$foodie->first_name.' '.$foodie->last_name .' has just ordered the plan: '.$plan->plan_name.'.';
        $chefnotif->notification_type=1;
//        dd($chefnotif);
        $chefnotif->save();
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
        $chefPhoneNumber = '0'.$order->chef->mobile_number;
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

        $messageFoodie = 'You have ordered the plan, '.$planName.', from the chef, '.$chefName.'.';
        $foodiePhoneNumber = '0'.$foodie->mobile_number;
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
        //        $message = new MailMessage();
        //        $message->subject('Order')
        //            ->line($foodie.' placed an order created by:'. $plan->chef->name)
        //            ->success();

        return redirect()->route('order.show', $order->id);
    }


    public function store(Plan $plan, mailer\Mailer $mailer){
//        dd('hello');
        $foodie = Auth::guard('foodie')->user();
        $chefs=Chef::all();
        $thisSaturday=Carbon::parse('this saturday')->format('F d');

        $dt =  new Carbon();
//        dd($dt->format('Y-m-d H:i:s'));
        $isSaturday = Carbon::parse("this saturday 15:00:00")->format('Y-m-d H:i:s');
        $thisSunday = Carbon::now()->endOfWeek()->format('Y-m-d H:i:s');

        if($dt->dayOfWeek == Carbon::SUNDAY){
//            dd("hi");
            $isSaturday=Carbon::parse("last saturday 15:00:00")->format('Y-m-d H:i:s');
        }else if($dt->dayOfWeek == Carbon::MONDAY){
//            dd('hey');
            $isSaturday=Carbon::parse("this saturday 15:00:00")->format('Y-m-d H:i:s');
        }

        if ($dt->format('Y-m-d H:i:s') >= $isSaturday && $dt->format('Y-m-d H:i:s')<= $thisSunday) {
            return back()->with([ 'status' => 'You can\'t order']);

        }else {
//            dd('hello
//            ');
            $order = new Order();
            $order->chef_id = $plan->chef_id;
            $order->foodie_id = $foodie->id;
            $plan->orders()->save($order);


            $foodnotif=new Notification();
            $foodnotif->sender_id=0;
            $foodnotif->receiver_id=$foodie->id;
            $foodnotif->receiver_type='f';
            $foodnotif->notification='You have a pending order. ';
            $foodnotif->notification.=' Please pay before '.$thisSaturday.'.';
            $foodnotif->notification_type=1;
//        dd($foodnotif);
            $foodnotif->save();


            $chefnotif=new Notification();
            $chefnotif->sender_id=0;
            $chefnotif->receiver_id=$plan->chef_id;
            $chefnotif->receiver_type='c';
            $chefnotif->notification=$foodie->first_name.' '.$foodie->last_name .' has just ordered the plan: '.$plan->plan_name.'.';
            $chefnotif->notification_type=1;
//        dd($chefnotif);
            $chefnotif->save();

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
            $chefPhoneNumber = '0'.$order->chef->mobile_number;
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

            $messageFoodie = 'You have ordered the plan, '.$planName.', from the chef, '.$chefName.'.';
            $foodiePhoneNumber = '0'.$foodie->mobile_number;
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
            //        $message = new MailMessage();
            //        $message->subject('Order')
            //            ->line($foodie.' placed an order created by:'. $plan->chef->name)
            //            ->success();

            return redirect()->route('order.show', $order->id);
        }
    }


    public function show(Order $order){

        $foodie = Auth::guard('foodie')->user();
        dd($order);
        $orderItems = $order->order_item()->get();



//        dd('hello');
//        $foodieAddress= DB::table('foodie_address')->where('foodie_id','=',$foodie->id)->select('id','city','unit','street','brgy','bldg','type')->get();
////        dd($foodieAddress);
//        $orderAddress = DB::table('foodie_address')->where('id','=',$order->address_id)->select('id','city','unit','street','brgy','bldg','type')->first();
////        dd($orderAddress);
//
//        $plan = Plan::where('id', '=', $order->plan_id)->first();
//        $messages = Message::where('receiver_id', '=', $foodie->id)->where('receiver_type', '=', 'f')->where('is_read','=',0)->get();
//        $foodieOrder = Order::where('foodie_id', '=', $foodie->id)->where('is_paid', '=', 0)->orderBy('created_at', 'desc')->first();
//        $chefs=Chef::all();
//        $chats= Chat::where('foodie_id','=',$foodie->id)->latest($column = 'updated_at')->get();
//        $notifications=Notification::where('receiver_id','=',$foodie->id)->where('receiver_type','=','f')->get();
//        $unreadNotifications=Notification::where('receiver_id','=',$foodie->id)->where('receiver_type','=','f')->where('is_read','=',0)->count();




//        return view('foodie.showOrder', compact('order', 'foodieOrder', 'plan'))->with([
//            'sms_unverified' => $this->smsIsUnverified(),
//            'foodie'=>Auth::guard('foodie')->user(),
//            'foodieAddress' =>$foodieAddress,
//            'orderAddress' => $orderAddress,
//            'messages'=>$messages,
//            'chefs'=>$chefs,
//            'chats' => $chats,
//            'notifications'=>$notifications,
//            'unreadNotifications'=>$unreadNotifications
//        ]);
    }

    public function cancelOrder(Order $order)
    {
        $foodie = Auth::guard('foodie')->user();
        $chef = $order->chef->id;
//        dd($chef);
        $order->is_cancelled = 1;
        $order->save();

        $foodnotif = new Notification();
        $foodnotif->sender_id=0;
        $foodnotif->receiver_id=$foodie->id;
        $foodnotif->receiver_type='f';
        $foodnotif->notification='You have cancelled your order of '.$order->plan->plan_name.'.';
//        $foodnotif->notification.=' Please pay before '.$thisSaturday.'.';
        $foodnotif->notification_type=3;
//        dd($foodnotif);
        $foodnotif->save();

        $chefnotif=new Notification();
        $chefnotif->sender_id=0;
        $chefnotif->receiver_id=$order->chef_id;
        $chefnotif->receiver_type='c';
        $chefnotif->notification=$foodie->first_name.' '.$foodie->last_name .' has cancelled their ordered the plan: '.$order->plan->plan_name.'.';
        $chefnotif->notification_type=3;
//        dd($chefnotif);
        $chefnotif->save();


        return redirect() ->route('foodie.plan.show')->with([
            'status'=>'You have cancelled your order of '.$order->plan->plan_name.'.'
        ]);
    }

    public function changeOrderAddress(Request $request, $id)
    {
        Validator::make($request->all(), [
            'addressSelect' => 'required',
        ])->validate();
        $addressId = $request['addressSelect'];
        $foodie = Auth::guard('foodie')->user();
        $order= Order::where('id','=',$id)->first();
        $order->address_id = $addressId;
        $order->save();
//        $address = DB::table('foodie_address')->where('foodie_id','=',$foodie->id)->where('id','=', $id)->select('id','city','unit','street','brgy','bldg','type')->first();
        return back()->with(['status'=>'Added delivery address!']);
    }
}
