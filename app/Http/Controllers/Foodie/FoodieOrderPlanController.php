<?php

namespace App\Http\Controllers\Foodie;

use App\Chat;
use App\ChefCustomizedMeal;
use App\CustomPlan;
use App\Mail\MyOrderMailUpdate;
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
use App\Refund;
use App\SimpleCustomDetail;
use App\SimpleCustomPlan;
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
        $messages = Message::where('receiver_id', '=', Auth::guard('foodie')->user()->id)->where('receiver_type', '=', 'f')->where('is_read', '=', 0)->get();
        $foodie = Auth::guard('foodie')->user()->id;
        $chats = Chat::where('foodie_id', '=', $foodie)->latest($column = 'updated_at')->get();
        $chefs = Chef::all();
        $notifications = Notification::where('receiver_id', '=', $foodie)->where('receiver_type', '=', 'f')->get();
        $unreadNotifications = Notification::where('receiver_id', '=', $foodie)->where('receiver_type', '=', 'f')->where('is_read', '=', 0)->count();

        return view('foodie.orders', compact('plan'))->with([
            'sms_unverified' => $this->smsIsUnverified(),
            'foodie' => Auth::guard('foodie')->user(),
            'messages' => $messages,
            'chats' => $chats,
            'chefs' => $chefs,
            'notifications' => $notifications,
            'unreadNotifications' => $unreadNotifications
        ]);
    }

    public function getAllOrdersView($from)
    {

        $thisDay = Carbon::today();
//        dd($from);
        $foodie = Auth::guard('foodie')->user();
        $foodieAddress = DB::table('foodie_address')->where('foodie_id', '=', $foodie->id)->select('id', 'city', 'unit', 'street', 'brgy', 'bldg', 'type')->get();
        $orders = '';
        $ordersCount = Order::where('foodie_id', '=', $foodie->id)->count();
        $pendOrdCount = Order::where('foodie_id', '=', $foodie->id)->where('is_paid', '=', 0)->where('is_cancelled', '=', 0)->count();
        $paidOrdCount = Order::where('foodie_id', '=', $foodie->id)->where('is_paid', '=', 1)->where('is_cancelled', '=', 0)->count();
        $cancelOrdCount = Order::where('foodie_id', '=', $foodie->id)->where('is_cancelled', '=', 1)->count();

        $totalPaid = 0;
        $totalPend = 0;

        $orderAmounts = Order::where('foodie_id', '=', $foodie->id)->where('is_cancelled', '=', 0)->get();
        foreach($orderAmounts->where('is_paid','=',0) as $orderAmount){
            $totalPend+=$orderAmount->total;
        }
        foreach($orderAmounts->where('is_paid','=',1) as $orderAmount){
            $totalPaid+=$orderAmount->total;
        }



        $chats = Chat::where('foodie_id', '=', $foodie->id)->where('foodie_can_see', '=', 1)->latest($column = 'updated_at')->get();
        $chefs = Chef::all();
        if ($ordersCount > 0) {
            $orders = Order::where('foodie_id', '=', $foodie->id)->orderBy('is_paid','ASC')->latest($column = 'created_at')->get();
        }

        $orderArray = [];
        $orderItemArray = [];

        if ($ordersCount > 0) {
            foreach ($orders as $order) {
                $dt = new Carbon($order->created_at);
                $startOfWeek = $dt->startOfWeek()->addDay(7)->format('F d, Y');
                //            dd($startOfWeek);
                $orderAddress = '';

                if ($order->address_id != null) {
                    foreach ($foodieAddress as $fAdd) {
                        if ($fAdd->id == $order->address_id) {
                            $orderAddress = $fAdd->unit;
                            if ($fAdd->bldg != '') {
                                $orderAddress .= ' ' . $fAdd->bldg . ', ';
                            }
                            $orderAddress .= ' ' . $fAdd->street;
                            $orderAddress .= ', ' . $fAdd->brgy;
                            $orderAddress .= ' ' . $fAdd->city;
                        }
                    }
                }
                $is_paid = "";
                if ($order->is_paid == 0) {
                    $is_paid = "Pending";
                } elseif ($order->is_paid == 1) {
                    $is_paid = "Paid";
                }


                $orderArray[] = array('id' => $order->id, 'address' => $orderAddress, 'total' => number_format($order->total, 2, '.', ','),
                    'is_paid' => $is_paid, 'is_cancelled' => $order->is_cancelled, 'week' => $startOfWeek, 'created_at' => $order->created_at);

                $orderItems = $order->order_item()->get();
                foreach ($orderItems as $orderItem) {
                    $orderPlan = "";
                    $planPic = "";
                    $planName = "";
                    $chefName = "";
                    $orderType = "";
                    if ($orderItem->order_type == 0) {
                        $orderPlan = Plan::where('id', '=', $orderItem->plan_id)->first();
                        //                    dd($orderPlan->picture);
                        $planPic = $orderPlan->picture;
                        $planName = $orderPlan->plan_name;
                        $chefName = $orderPlan->chef->name;
                        $orderType = "Standard";
                    } elseif ($orderItem->order_type == 1 || $orderItem->order_type == 2) {
                        if ($orderItem->order_type == 1) {
                            $orderPlan = CustomPlan::where('id', '=', $orderItem->plan_id)->first();
                        } elseif ($orderItem->order_type == 2) {
                            $orderPlan = SimpleCustomPlan::where('id', '=', $orderItem->plan_id)->first();
                        }
                        if ($orderPlan != null) {
                            $planPic = $orderPlan->plan->picture;
                            $planName = $orderPlan->plan->plan_name;
                            $chefName = $orderPlan->plan->chef->name;
                            $orderType = "Customized";
                        }
                    }
                    if ($orderPlan != null) {
                        $orderItemArray[] = array('id' => $orderItem->id, 'order_id' => $orderItem->order_id, 'is_delivered' => $orderItem->is_delivered,
                            'plan' => $planName, 'planPic' => $planPic, 'chef' => $chefName, 'type' => $orderType, 'cust' => $orderItem->order_type, 'quantity' => $orderItem->quantity, 'price' => 'PHP ' . number_format($orderItem->price, 2, '.', ','));
                    }
                }

            }
        }

//        dd($orderArray[0]['id']);

        $messages = Message::where('receiver_id', '=', Auth::guard('foodie')->user()->id)
            ->where('receiver_type', '=', 'f')
            ->where('foodie_can_see', '=', 1)
            ->where('is_read', '=', 0)->get();

        $notifications = Notification::where('receiver_id', '=', $foodie->id)->where('receiver_type', '=', 'f')->get();
        $unreadNotifications = Notification::where('receiver_id', '=', $foodie->id)->where('receiver_type', '=', 'f')->where('is_read', '=', 0)->count();
//        dd($unreadNotifications);


        return view('foodie.viewAllOrders')->with([
            'sms_unverified' => $this->smsIsUnverified(),
            'foodie' => $foodie,
            'orders' => $orders,
            'thisDay'=>$thisDay,
            'orderArray' => $orderArray,
            'orderItemArray' => $orderItemArray,
            'ordersCount' => $ordersCount,
            'pendOrdCount' => $pendOrdCount,
            'paidOrdCount' => $paidOrdCount,
            'cancelOrdCount' => $cancelOrdCount,
            'chefs' => $chefs,
            'chats' => $chats,
            'messages' => $messages,
            'notifications' => $notifications,
            'unreadNotifications' => $unreadNotifications,
            'from' => $from,
            'totalPaid'=>$totalPaid,
            'totalPend'=>$totalPend
        ]);
    }

    public function getOneOrderDetails(OrderItem $orderItem)
    {
        $planName = '';
        $foodie = Auth::guard('foodie')->user();
        $messages = Message::where('receiver_id', '=', Auth::guard('foodie')->user()->id)
            ->where('receiver_type', '=', 'f')
            ->where('foodie_can_see', '=', 1)
            ->where('is_read', '=', 0)
            ->get();
        $chats = Chat::where('foodie_id', '=', $foodie)->where('foodie_can_see', '=', 1)->latest($column = 'updated_at')->get();
        $orderPlan = '';
        $ingredientMeals = [];
        $orderMealPlans = [];
        $saMeals = 0;
        $moSnaMeals = 0;
        $aftSnaMeals = 0;
        $tasteCount = 0;
        $cookCount = 0;
        $driedCount = 0;
        if ($orderItem->order_type == 0) {
            $orderPlan = Plan::where('id', '=', $orderItem->plan_id)->first();
            $planName = $orderPlan->plan_name;
            $mealPlans = $orderPlan->mealplans()->where('is_deleted','=',0)->get();
            $saMeals = $mealPlans->where('day', '=', 'SA')->count();
            $moSnaMeals = $mealPlans->where('meal_type', '=', 'MorningSnack')->count();
            $aftSnaMeals = $mealPlans->where('meal_type', '=', 'AfternoonSnack')->count();

            foreach ($mealPlans as $item) {
                $orderMealPlans[] = $item->chefcustomize;
            }
//            dd($orderMealPlans);
        } elseif ($orderItem->order_type == 1) {
            $orderPlan = CustomPlan::where('id', '=', $orderItem->plan_id)->first();
            $planName = $orderPlan->plan->plan_name;
            $orderMealPlans = $orderPlan->customized_meal()->get();
            foreach ($orderMealPlans as $orderMealPlan) {
                if ($orderMealPlan->chefcustomize->mealplans->day == 'SA') {
                    $saMeals += 1;
                }
                if ($orderMealPlan->chefcustomize->mealplans->meal_type == 'MorningSnack') {
                    $moSnaMeals += 1;
                } elseif ($orderMealPlan->chefcustomize->mealplans->meal_type == 'AfternoonSnack') {
                    $aftSnaMeals += 1;
                }
            }
//            dd($saMeals.' '.$moSnaMeals.' '.$aftSnaMeals);
            foreach ($orderMealPlans as $orderMealPlan) {
                foreach ($orderMealPlan->customized_ingredient_meal()->get() as $orderMealIngredient) {
                    $ingredientDesc = DB::table('ingredients')
                        ->join('ingredients_group_description', 'ingredients.FdGrp_Cd', '=', 'ingredients_group_description.FdGrp_Cd')
                        ->where('NDB_No', '=', $orderMealIngredient->ingredient_id)
                        ->select('ingredients.Long_Desc', 'ingredients_group_description.FdGrp_Desc')
                        ->first();
                    $ingredientMeals[] = array(
                        "meal" => $orderMealIngredient->meal_id,
                        "ingredient" => $ingredientDesc->Long_Desc,
                        "ingredient_group" => $ingredientDesc->FdGrp_Desc,
                        "grams" => $orderMealIngredient->grams,
                        "is_customized" => $orderMealIngredient->is_customized
                    );

                }
            }
        } elseif ($orderItem->order_type == 2) {
            $orderPlan = SimpleCustomPlan::where('id', '=', $orderItem->plan_id)->first();
            $planName = $orderPlan->plan->plan_name;
            $orderMealPlans = $orderPlan->simple_custom_meal()->get();
            foreach ($orderMealPlans as $orderMealPlan) {
                if ($orderMealPlan->chef_customized_meal->mealplans->day == 'SA') {
                    $saMeals += 1;
                }
                if ($orderMealPlan->chef_customized_meal->mealplans->meal_type == 'MorningSnack') {
                    $moSnaMeals += 1;
                } elseif ($orderMealPlan->chef_customized_meal->mealplans->meal_type == 'AfternoonSnack') {
                    $aftSnaMeals += 1;
                }
            }
            $tasteCount = $orderPlan->simple_custom_plan_detail()
                ->where(function ($query) {
                    $query->where('detail', 'sweet')
                        ->where('detail', 'salty')
                        ->orWhere('detail', 'spicy')
                        ->orWhere('detail', 'bitter')
                        ->orWhere('detail', 'savory');
                })
                ->count();
            $cookCount = $orderPlan->simple_custom_plan_detail()
                ->where(function ($query) {
                    $query->where('detail', 'fried')
                        ->orWhere('detail', 'grilled');
                })
                ->count();

//        dd($simpleCustomPlan->simple_custom_plan_detail()->where([
//            ['detail','=','fried'],
//            ['detail','=','grilled']
//        ])->get());
            $driedCount = $orderPlan->simple_custom_plan_detail()
                ->where(function ($query) {
                    $query->where('detail', 'preservatives')
                        ->orWhere('detail', 'salt')
                        ->orWhere('detail', 'sweeteners');
                })
                ->count();
        }
//        dd($orderItem);

        $notifications = Notification::where('receiver_id', '=', $foodie->id)->where('receiver_type', '=', 'f')->get();
        $unreadNotifications = Notification::where('receiver_id', '=', $foodie->id)->where('receiver_type', '=', 'f')->where('is_read', '=', 0)->count();
        $chefs = Chef::all();
        return view('foodie.viewSingleOrder')->with([
            'sms_unverified' => $this->smsIsUnverified(),
            'foodie' => $foodie,
            'chats' => $chats,
            'chefs' => $chefs,
            'messages' => $messages,
            'notifications' => $notifications,
            'unreadNotifications' => $unreadNotifications,
            'orderPlan' => $orderPlan,
            'saMeals' => $saMeals,
            'moSnaMeals' => $moSnaMeals,
            'aftSnaMeals' => $aftSnaMeals,
            'tasteCount' => $tasteCount,
            'cookCount' => $cookCount,
            'driedCount' => $driedCount,
            'planName' => $planName,
            'mealPlans' => $orderMealPlans,
            'orderItem' => $orderItem,
        ]);
    }


    public function getIngred($id, $cust)
    {
        if ($cust == 1) {
            $meal = CustomizedMeal::where('id', '=', $id)->first();
        } elseif ($cust == 2) {
            $meal = ChefCustomizedMeal::where('id', '=', $id)->first();
        }

        $ingreds = $meal->customized_ingredient_meal()->get();

        $ingredientMeals = '[';
        $i = 0;
        foreach ($ingreds as $ingred) {
            $ingredientDesc = DB::table('ingredients')
                ->join('ingredients_group_description', 'ingredients.FdGrp_Cd', '=', 'ingredients_group_description.FdGrp_Cd')
                ->where('NDB_No', '=', $ingred->ingredient_id)
                ->select('ingredients.Long_Desc', 'ingredients_group_description.FdGrp_Desc')
                ->first();

            if (++$i < $ingreds->count()) {
                $ingredientMeals .= '{ "meal":"' . $ingred->meal_id . '","ingredient":"' . $ingredientDesc->Long_Desc . '","ingredient_group":"' . $ingredientDesc->FdGrp_Desc . '","grams":"' . $ingred->grams . '","is_customized":"' . $ingred->is_customized . '"}, ';
            } else {
                $ingredientMeals .= '{ "meal":"' . $ingred->meal_id . '","ingredient":"' . $ingredientDesc->Long_Desc . '","ingredient_group":"' . $ingredientDesc->FdGrp_Desc . '","grams":"' . $ingred->grams . '","is_customized":"' . $ingred->is_customized . '"} ';
            }

        }
        $ingredientMeals .= ']';
        $response = $ingredientMeals;
        return $response;
    }

    public function getSimpCustView(OrderItem $orderItem)
    {
        $messages = Message::where('receiver_id', '=', Auth::guard('foodie')->user()->id)
            ->where('receiver_type', '=', 'f')
            ->where('foodie_can_see', '=', 1)
            ->where('is_read', '=', 0)
            ->get();
        $chefs = Chef::all();
        $chats = Chat::where('foodie_id', '=', Auth::guard('foodie')->user()->id)->where('foodie_can_see', '=', 1)->latest($column = 'updated_at')->get();
        $notifications = Notification::where('receiver_id', '=', Auth::guard('foodie')->user()->id)->where('receiver_type', '=', 'f')->get();
        $unreadNotifications = Notification::where('receiver_id', '=', Auth::guard('foodie')->user()->id)->where('receiver_type', '=', 'f')->where('is_read', '=', 0)->count();

        $plan = SimpleCustomPlan::where('id', '=', $orderItem->plan_id)->first();

        $simpCusts = SimpleCustomDetail::where('simple_custom_plan_id', '=', $plan->id)->get();


        return view('foodie.simpleCustShow')->with([
            'foodie' => Auth::guard('foodie')->user(),
            'sms_unverified' => $this->smsIsUnverified(),
            'messages' => $messages,
            'chats' => $chats,
            'notifications' => $notifications,
            'unreadNotifications' => $unreadNotifications,
            'chefs' => $chefs,
            'orderItem' => $orderItem,
            'plan' => $plan,
            'simpCusts' => $simpCusts
        ]);

    }

    public function order(mailer\Mailer $mailer)
    {
        $lastSaturday = Carbon::parse("last saturday 15:01:00")->format('Y-m-d H:i:s');

//        >where('type','=','R')
        $foodie = Auth::guard('foodie')->user();
        $foodieAddress = DB::table('foodie_address')->where('foodie_id', '=', $foodie->id)->select('id')->first();
//        dd($foodieAddress);
        $orderAddress = null;
        if ($foodieAddress != null) {
            $orderAddress = $foodieAddress->id;
        }
        $cartItems = Cart::content();

        $chefs = Chef::all();
        $thisSaturday = Carbon::parse('this saturday')->format('F d, Y');
        $cartChefs = [];
        $mailHTML = [];
//        $messages = Message::where('receiver_id', '=', Auth::guard('foodie')->user()->id)
//            ->where('receiver_type', '=', 'f')
//            ->where('is_read', '=', 0)
//            ->get();

        //pending orders
//        $pendingOrders = Order::where('is_paid', '=', 0)->where('is_cancelled', '=', 0)->where('foodie_id', '=', $foodie->id)->where('created_at', '>', $lastSaturday)->latest()->get();
//
//        $found = false;
//        if($pendingOrders->count() > 0){
//            foreach ($pendingOrders as $pendingOrder) {
//                $orderItems = $pendingOrder->order_item()->get();
//                foreach ($orderItems as $orderItem) {
//                    foreach ($cartItems as $cartItem) {
//                        if ($cartItem->id == $orderItem->plan_id) {
//                            $found=true;
//                            $pendId = $pendingOrder->id;
//                            $orderItem->quantity += $cartItem->qty;
//                            $orderItem->save();
//                            $pendingOrder->total += $cartItem->price;
//                            $pendingOrder->save();
//                            Cart::remove($cartItem->rowId);
//
//    //                        dd($orderItem);
//    //                        break;
//                        }
//                    }
//                }
//            }
//            if ($found) {
////                if(Cart::count()>0){
////                    $order=Order::where('id','=',$pendId)->first();
////                    foreach ($cartItems as $cartItem) {
////                        $orderItem = new OrderItem();
////                        $orderItem->order_id = $order->id;
////                        $orderItem->plan_id = $cartItem->id;
////                        $orderItem->chef_id = $cartItem->options->chef;
////                        $orderItem->order_type = $cartItem->options->cust;
////                        $orderItem->quantity = $cartItem->qty;
////                        $orderItem->price = $cartItem->price;
////                        $orderItem->save();
////
////                        $mailNameHTML = $cartItem->name;
////                        $mailQtyHTML = $cartItem->qty;
////                        $mailPriceHTML = $cartItem->price;
////                        foreach ($chefs as $chef) {
////                            if ($chef->id == $cartItem->options->chef) {
////                                $mailChefHTML = $chef->name;
////                            }
////                        }
////                        if ($cartItem->options->cust == 0) {
////                            $mailTypeHTML = 'Standard';
////                        } elseif ($cartItem->options->cust == 1) {
////                            $mailTypeHTML = 'Customized';
////                        }
////    //            $mailDateHTML=$cartItem->options->date;
////                        $cartChefs[] = $cartItem->options->chef;
////                        $mailHTML[] = [
////                            'name' => $mailNameHTML,
////                            'qty' => $mailQtyHTML,
////                            'price' => $mailPriceHTML,
////                            'chef' => $mailChefHTML,
////                            'type' => $mailTypeHTML,
////                            'date' => $thisSaturday
////                        ];
////
////
////                        $order->total+=$cartItem->price;
////                        $order->save();
////                    }
////
////
////                    $messageFoodie = 'Greetings from DietSelect! Your order has been updated on ' . $order->updated_at . '. Please pay your balance of: PHP ';
////                    $messageFoodie .= number_format($order->total, 2, '.', ',') . ' before ' . $thisSaturday;
////                    $foodiePhoneNumber = '0' . $foodie->mobile_number;
////                    $urlFoodie = 'https://www.itexmo.com/php_api/api.php';
////                    $itexmoFoodie = array('1' => $foodiePhoneNumber, '2' => $messageFoodie, '3' => 'PR-DIETS656642_VBVIA');
////                    $paramFoodie = array(
////                        'http' => array(
////                            'header' => "Content-type: application/x-www-form-urlencoded\r\n",
////                            'method' => 'POST',
////                            'content' => http_build_query($itexmoFoodie),
////                        ),
////                        "ssl" => array(
////                            "verify_peer" => false,
////                            "verify_peer_name" => false,
////                        ),
////                    );
////                    $contextFoodie = stream_context_create($paramFoodie);
////                    file_get_contents($urlFoodie, false, $contextFoodie);
////
////                    $price = number_format($order->total,2,'.',',');
////                    $time = $order->created_at;
////
////                    $mailer->to($foodie->email)
////                        ->send(new MyOrderMailUpdate(
////                            $mailHTML,
////                            $price,
////                            $time
////                        ));
////
////
////                    $orderChefs = array_unique($cartChefs);
////    //        dd($orderChefs);
////
////                    foreach ($orderChefs as $orderChef) {
////                        $planName = [];
////                        foreach ($cartItems as $cartItem) {
////                            if ($cartItem->options->chef == $orderChef) {
////                                $planName[] = $cartItem->name;
////                                if ($cartItem->options->cust == 0) {
////                                    $planName[] .= '- Standard';
////                                } elseif ($cartItem->options->cust == 1) {
////                                    $planName[] .= '- Custom';
////                                }
////
////                            }
////                        }
////                        $chefnotif = new Notification();
////                        $chefnotif->sender_id = 0;
////                        $chefnotif->receiver_id = $orderChef;
////                        $chefnotif->receiver_type = 'c';
////                        $chefnotif->notification = $foodie->first_name . ' ' . $foodie->last_name . ' has placed an order for: ';
////                        foreach ($planName as $pName) {
////                            $chefnotif->notification .= $pName . ' ';
////                        }
////                        $chefnotif->notification .= '.';
////                        $chefnotif->notification_type = 1;
////                        $chefnotif->save();
////
////                        $phoneChef = Chef::where('id', '=', $orderChef)->select('mobile_number')->first();
////                        $message = 'Greetings from DietSelect! ' . $foodie->first_name . ' ' . $foodie->last_name . ' has ordered: ';
////                        foreach ($planName as $pName) {
////                            $message .= $pName . ' ';
////                        }
////                        $message .= ' on ' . $order->created_at;
////                        $message .= '.';
////                        $chefPhoneNumber = '0' . $phoneChef->mobile_number;
////                        $url = 'https://www.itexmo.com/php_api/api.php';
////                        $itexmo = array('1' => $chefPhoneNumber, '2' => $message, '3' => 'PR-DIETS656642_VBVIA');
////                        $param = array(
////                            'http' => array(
////                                'header' => "Content-type: application/x-www-form-urlencoded\r\n",
////                                'method' => 'POST',
////                                'content' => http_build_query($itexmo),
////                            ),
////                            "ssl" => array(
////                                "verify_peer" => false,
////                                "verify_peer_name" => false,
////                            ),
////                        );
////                        $context = stream_context_create($param);
////                        file_get_contents($url, false, $context);
////
////                        $emailChef = Chef::where('id', '=', $orderChef)->select('email')->first();
////                        $foodieName = $foodie->first_name . ' ' . $foodie->last_name;
////                        $price = Cart::total();
////    //        dd($foodieName);
////                        $mailer->to($emailChef)
////                            ->send(new MyOrderMailChef(
////                                $planName,
////                                $foodieName,
////                                $price));
////                    }
////                }
//
//                if(Cart::count()==0){
//                    Cart::destroy();
//                    return redirect()->route('order.show', $pendId)->with(['status' => 'Added to existing pending order']);
//                }
//            }
//        }

//        dd($notfound);

//        $notifications = Notification::where('receiver_id', '=', $foodie->id)->where('receiver_type', '=', 'f')->get();
//        $unreadNotifications = Notification::where('receiver_id', '=', $foodie->id)->where('receiver_type', '=', 'f')->where('is_read', '=', 0)->count();
//        $chats = Chat::where('foodie_id', '=', $foodie->id)->latest($column = 'updated_at')->get();


//        $dt=Carbon::now();
//        $startOfNextWeek = $dt->startOfWeek()->addDay(7)->format('F d');


        $order = new Order();
        $order->foodie_id = $foodie->id;
        $order->address_id = $orderAddress;
        $order->total = floatval(str_replace(',', '', Cart::total()));
//        $order->week = $startOfNextWeek;
        $order->save();

        $foodnotif = new Notification();
        $foodnotif->sender_id = 0;
        $foodnotif->receiver_id = $foodie->id;
        $foodnotif->receiver_type = 'f';
        $foodnotif->notification = 'Your order has been placed ';
        $foodnotif->notification .= '. Please pay before ' . $thisSaturday . ' 3:00pm.';
        $foodnotif->notification_type = 1;
        $foodnotif->save();



        $messageFoodie = 'Greetings from DietSelect! Your order has been placed on ' . $order->created_at->format('F d, Y g:i A') . '. Please pay your balance of: PHP ';
        $messageFoodie .= number_format($order->total, 2, '.', ',') . ' before ' . $thisSaturday.' 3:00pm';
        $foodiePhoneNumber = '0' . $foodie->mobile_number;
        $urlFoodie = 'https://www.itexmo.com/php_api/api.php';
        $itexmoFoodie = array('1' => $foodiePhoneNumber, '2' => $messageFoodie, '3' => 'PR-DIETS656642_VBVIA');
        $paramFoodie = array(
            'http' => array(
                'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                'method' => 'POST',
                'content' => http_build_query($itexmoFoodie),
            ),
            "ssl" => array(
                "verify_peer" => false,
                "verify_peer_name" => false,
            ),
        );
        $contextFoodie = stream_context_create($paramFoodie);
        file_get_contents($urlFoodie, false, $contextFoodie);

        $cartChefs = [];

        $mailHTML = [];
        $mailChefHTML = '';
        $mailNameHTML = '';
        $mailTypeHTML = '';
        foreach ($cartItems as $cartItem) {
            $orderItem = new OrderItem();
            $orderItem->order_id = $order->id;
            $orderItem->plan_id = $cartItem->id;
            $orderItem->chef_id = $cartItem->options->chef;
            $orderItem->order_type = $cartItem->options->cust;
            $orderItem->quantity = $cartItem->qty;
            $orderItem->price = $cartItem->price;
            $orderItem->save();
            $mailNameHTML = $cartItem->name;
            $mailQtyHTML = $cartItem->qty;
            $mailPriceHTML = $cartItem->price;
            foreach ($chefs as $chef) {
                if ($chef->id == $cartItem->options->chef) {
                    $mailChefHTML = $chef->name;
                }
            }
            if ($cartItem->options->cust == 0) {
                $mailTypeHTML = 'Standard';
            } elseif ($cartItem->options->cust == 1) {
                $mailTypeHTML = 'Customized';
            }
//            $mailDateHTML=$cartItem->options->date;
            $cartChefs[] = $cartItem->options->chef;
            $mailHTML[] = [
                'name' => $mailNameHTML,
                'qty' => $mailQtyHTML,
                'price' => $mailPriceHTML,
                'chef' => $mailChefHTML,
                'type' => $mailTypeHTML,
                'date' => $thisSaturday
            ];
        }
//        dd($mailHTML);


        $price = Cart::total();

        $mailer->to($foodie->email)
            ->send(new MyOrderMail(
                $mailHTML,
                $price
            ));

        $orderChefs = array_unique($cartChefs);
//        dd($orderChefs);

        foreach ($orderChefs as $orderChef) {
            $planName = [];
            foreach ($cartItems as $cartItem) {
                if ($cartItem->options->chef == $orderChef) {
                    $planName[] = $cartItem->name;
                    if ($cartItem->options->cust == 0) {
                        $planName[] .= '- Standard';
                    } elseif ($cartItem->options->cust == 1) {
                        $planName[] .= '- Custom';
                    }
                }
            }
            $chefnotif = new Notification();
            $chefnotif->sender_id = 0;
            $chefnotif->receiver_id = $orderChef;
            $chefnotif->receiver_type = 'c';
            $chefnotif->notification = $foodie->first_name . ' ' . $foodie->last_name . ' has placed an order for: ';
            foreach ($planName as $pName) {
                $chefnotif->notification .= $pName . ' ';
            }
            $chefnotif->notification .= '.';
            $chefnotif->notification_type = 1;
            $chefnotif->save();

            $phoneChef = Chef::where('id', '=', $orderChef)->select('mobile_number')->first();
            $message = 'Greetings from DietSelect! ' . $foodie->first_name . ' ' . $foodie->last_name . ' has ordered: ';
            foreach ($planName as $pName) {
                $message .= $pName . ' ';
            }
            $message .= ' on ' . $order->created_at->format('F d, Y g:i A');
            $message .= '.';
            $chefPhoneNumber = '0' . $phoneChef->mobile_number;
            $url = 'https://www.itexmo.com/php_api/api.php';
            $itexmo = array('1' => $chefPhoneNumber, '2' => $message, '3' => 'PR-DIETS656642_VBVIA');
            $param = array(
                'http' => array(
                    'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                    'method' => 'POST',
                    'content' => http_build_query($itexmo),
                ),
                "ssl" => array(
                    "verify_peer" => false,
                    "verify_peer_name" => false,
                ),
            );
            $context = stream_context_create($param);
            file_get_contents($url, false, $context);

            $emailChef = Chef::where('id', '=', $orderChef)->select('email')->first();
            $foodieName = $foodie->first_name . ' ' . $foodie->last_name;
            $price = Cart::total();
//        dd($foodieName);
            $mailer->to($emailChef)
                ->send(new MyOrderMailChef(
                    $planName,
                    $foodieName,
                    $price));
        }

        Cart::destroy();

        $status= 'Successfully placed an order!';
//        if($notfound){
//            $status= 'Updated pre';
//        }
        return redirect()->route('order.show', $order->id)->with(['status'=>$status]);

    }

    public function custStore(Plan $plan, $customId, mailer\Mailer $mailer)
    {
        $foodie = Auth::guard('foodie')->user();
        $thisSaturday = Carbon::parse('this saturday')->format('F d');
        $customList = json_decode($customId);
        $order = new Order();
        $order->chef_id = $plan->chef_id;
        $order->foodie_id = $foodie->id;
        $order->order_type = 'c';
        $plan->orders()->save($order);
        $chefs = Chef::all();
        $customize = [];

        for ($i = 0; $i < count($customList); $i++) {
            $customize[] = CustomizedMeal::where('id', '=', $customList[$i])->first();
            $customize[$i]->order_id = $order->id;
//            dd($order->id);
            $customize[$i]->save();
        }

        //Notification

        $foodnotif = new Notification();
        $foodnotif->sender_id = 0;
        $foodnotif->receiver_id = $foodie->id;
        $foodnotif->receiver_type = 'f';
        $foodnotif->notification = 'You have just ordered the plan: ' . $plan->plan_name . ' from ';
        $foodnotif->notification .= $plan->chef->name;
        $foodnotif->notification .= '. Please pay before ' . $thisSaturday . '.';
        $foodnotif->notification_type = 1;
//        dd($foodnotif);
        $foodnotif->save();

        $chefnotif = new Notification();
        $chefnotif->sender_id = 0;
        $chefnotif->receiver_id = $plan->chef_id;
        $chefnotif->receiver_type = 'c';
        $chefnotif->notification = $foodie->first_name . ' ' . $foodie->last_name . ' has just ordered the plan: ' . $plan->plan_name . '.';
        $chefnotif->notification_type = 1;
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

        $foodieName = $foodie->first_name . ' ' . $foodie->last_name;
//        dd($foodieName);
        $mailer->to($order->chef->email)
            ->send(new MyOrderMailChef(
                $planName,
                $foodieName,
                $price));


        $message = $foodieName . ' has ordered ' . $planName . '.';
        $chefPhoneNumber = '0' . $order->chef->mobile_number;
        $url = 'https://www.itexmo.com/php_api/api.php';
        $itexmo = array('1' => $chefPhoneNumber, '2' => $message, '3' => 'PR-DIETS656642_VBVIA');
        $param = array(
            'http' => array(
                'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                'method' => 'POST',
                'content' => http_build_query($itexmo),
            ),
            "ssl" => array(
                "verify_peer" => false,
                "verify_peer_name" => false,
            ),
        );
        $context = stream_context_create($param);
        file_get_contents($url, false, $context);

        $messageFoodie = 'You have ordered the plan, ' . $planName . ', from the chef, ' . $chefName . '.';
        $foodiePhoneNumber = '0' . $foodie->mobile_number;
        $urlFoodie = 'https://www.itexmo.com/php_api/api.php';
        $itexmoFoodie = array('1' => $foodiePhoneNumber, '2' => $messageFoodie, '3' => 'PR-DIETS656642_VBVIA');
        $paramFoodie = array(
            'http' => array(
                'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                'method' => 'POST',
                'content' => http_build_query($itexmoFoodie),
            ),
            "ssl" => array(
                "verify_peer" => false,
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


    public function store(Plan $plan, mailer\Mailer $mailer)
    {
//        dd('hello');
        $foodie = Auth::guard('foodie')->user();
        $chefs = Chef::all();
        $thisSaturday = Carbon::parse('this saturday')->format('F d');

        $dt = new Carbon();
//        dd($dt->format('Y-m-d H:i:s'));
        $isSaturday = Carbon::parse("this saturday 15:00:00")->format('Y-m-d H:i:s');
        $thisSunday = Carbon::now()->endOfWeek()->format('Y-m-d H:i:s');

        if ($dt->dayOfWeek == Carbon::SUNDAY) {
//            dd("hi");
            $isSaturday = Carbon::parse("last saturday 15:00:00")->format('Y-m-d H:i:s');
        } else if ($dt->dayOfWeek == Carbon::MONDAY) {
//            dd('hey');
            $isSaturday = Carbon::parse("this saturday 15:00:00")->format('Y-m-d H:i:s');
        }

        if ($dt->format('Y-m-d H:i:s') >= $isSaturday && $dt->format('Y-m-d H:i:s') <= $thisSunday) {
            return back()->with(['status' => 'You can\'t order']);

        } else {
//            dd('hello
//            ');
            $order = new Order();
            $order->chef_id = $plan->chef_id;
            $order->foodie_id = $foodie->id;
            $plan->orders()->save($order);


            $foodnotif = new Notification();
            $foodnotif->sender_id = 0;
            $foodnotif->receiver_id = $foodie->id;
            $foodnotif->receiver_type = 'f';
            $foodnotif->notification = 'You have a pending order. ';
            $foodnotif->notification .= ' Please pay before ' . $thisSaturday . '.';
            $foodnotif->notification_type = 1;
//        dd($foodnotif);
            $foodnotif->save();


            $chefnotif = new Notification();
            $chefnotif->sender_id = 0;
            $chefnotif->receiver_id = $plan->chef_id;
            $chefnotif->receiver_type = 'c';
            $chefnotif->notification = $foodie->first_name . ' ' . $foodie->last_name . ' has just ordered the plan: ' . $plan->plan_name . '.';
            $chefnotif->notification_type = 1;
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

            $foodieName = $foodie->first_name . ' ' . $foodie->last_name;
//        dd($foodieName);
            $mailer->to($order->chef->email)
                ->send(new MyOrderMailChef(
                    $planName,
                    $foodieName,
                    $price));


            $message = $foodieName . ' has ordered ' . $planName . '.';
            $chefPhoneNumber = '0' . $order->chef->mobile_number;
            $url = 'https://www.itexmo.com/php_api/api.php';
            $itexmo = array('1' => $chefPhoneNumber, '2' => $message, '3' => 'PR-DIETS656642_VBVIA');
            $param = array(
                'http' => array(
                    'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                    'method' => 'POST',
                    'content' => http_build_query($itexmo),
                ),
                "ssl" => array(
                    "verify_peer" => false,
                    "verify_peer_name" => false,
                ),
            );
            $context = stream_context_create($param);
            file_get_contents($url, false, $context);

            $messageFoodie = 'You have ordered the plan, ' . $planName . ', from the chef, ' . $chefName . '.';
            $foodiePhoneNumber = '0' . $foodie->mobile_number;
            $urlFoodie = 'https://www.itexmo.com/php_api/api.php';
            $itexmoFoodie = array('1' => $foodiePhoneNumber, '2' => $messageFoodie, '3' => 'PR-DIETS656642_VBVIA');
            $paramFoodie = array(
                'http' => array(
                    'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                    'method' => 'POST',
                    'content' => http_build_query($itexmoFoodie),
                ),
                "ssl" => array(
                    "verify_peer" => false,
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


    public function show(Order $order)
    {

        if ($order->is_paid == 1) {
            return redirect()->route('foodie.dashboard')->with(['status' => 'Order has been paid already']);
        }

        $dt = $order->created_at;
        $nextWeekString = $dt->addDay(7)->startOfWeek()->format('F d');
        $ds = $order->created_at;
        $nextWeekEnd = $ds->addDay(7)->startOfWeek()->addDay(4)->format('F d');
        $foodie = Auth::guard('foodie')->user();
        $orderItems = $order->order_item()->get();
        $orderPlans = [];
        foreach ($orderItems as $orderItem) {
            if ($orderItem->order_type == 0) {
                $orderPlans[] = Plan::where('id', '=', $orderItem->plan_id)->first();
            } elseif ($orderItem->order_type == 1) {
                $orderPlans[] = CustomPlan::where('id', '=', $orderItem->plan_id)->first();
            } elseif ($orderItem->order_type == 2) {
                $orderPlans[] = SimpleCustomPlan::where('id', '=', $orderItem->plan_id)->first();
            }
        }
//        dd($orderPlans[0]->chef->bank_account);
        $foodieAddress = DB::table('foodie_address')->where('foodie_id', '=', $foodie->id)->select('id', 'city', 'unit', 'street', 'brgy', 'bldg', 'type')->get();
        $orderAddress = DB::table('foodie_address')->where('id', '=', $order->address_id)->select('id', 'city', 'unit', 'street', 'brgy', 'bldg', 'type')->first();
        $chefs = Chef::all();
        $messages = Message::where('receiver_id', '=', $foodie->id)->where('foodie_can_see', '=', 1)->where('receiver_type', '=', 'f')->where('is_read', '=', 0)->get();
        $chats = Chat::where('foodie_id', '=', $foodie->id)->where('foodie_can_see', '=', 1)->latest($column = 'updated_at')->get();
        $notifications = Notification::where('receiver_id', '=', $foodie->id)->where('receiver_type', '=', 'f')->get();
        $unreadNotifications = Notification::where('receiver_id', '=', $foodie->id)->where('receiver_type', '=', 'f')->where('is_read', '=', 0)->count();

        return view('foodie.showOrder')->with([
            'sms_unverified' => $this->smsIsUnverified(),
            'foodie' => Auth::guard('foodie')->user(),
            'order' => $order,
            'orderItems' => $orderItems,
            'orderPlans' => $orderPlans,
            'foodieAddress' => $foodieAddress,
            'orderAddress' => $orderAddress,
            'messages' => $messages,
            'chefs' => $chefs,
            'chats' => $chats,
            'notifications' => $notifications,
            'unreadNotifications' => $unreadNotifications,
            'nextWeek' => $nextWeekString,
            'nextWeekEnd' => $nextWeekEnd
        ]);

//        dd('hello');
////        dd($foodieAddress);
////        dd($orderAddress);
//
//        $plan = Plan::where('id', '=', $order->plan_id)->first();
//        $foodieOrder = Order::where('foodie_id', '=', $foodie->id)->where('is_paid', '=', 0)->orderBy('created_at', 'desc')->first();
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
        $orderItems = $order->order_item()->get();
        $orderChef = [];
        foreach ($orderItems as $orderItem) {
            if ($orderItem->order_type == 0) {
                $orderPlan = Plan::where('id', '=', $orderItem->plan_id)->first();
                $orderChef[] = $orderPlan->chef->id;
            } elseif ($orderItem->order_type == 0) {
                $orderPlan = CustomPlan::where('id', '=', $orderItem->plan_id)->first();
                $orderChef[] = $orderPlan->plan->chef->id;
            }
        }

        $uniqueChef = array_unique($orderChef);

        foreach ($uniqueChef as $chef) {
            $chefnotif = new Notification();
            $chefnotif->sender_id = 0;
            $chefnotif->receiver_id = $chef;
            $chefnotif->receiver_type = 'c';
            $chefnotif->notification = $foodie->first_name . ' ' . $foodie->last_name . ' has cancelled their order.';
            $chefnotif->notification_type = 3;
//        dd($chefnotif);
            $chefnotif->save();
        }
//        $chef = $order->chef->id;
//        dd($chef);
        $order->is_cancelled = 1;
        $order->save();

        $foodnotif = new Notification();
        $foodnotif->sender_id = 0;
        $foodnotif->receiver_id = $foodie->id;
        $foodnotif->receiver_type = 'f';
        $foodnotif->notification = 'You have cancelled your order.';
//        $foodnotif->notification.=' Please pay before '.$thisSaturday.'.';
        $foodnotif->notification_type = 3;
//        dd($foodnotif);
        $foodnotif->save();

        return redirect()->route('foodie.plan.show')->with([
            'status' => 'You have cancelled your order.'
        ]);
    }

    public function cancelAllOrder(Order $order)
    {
        $foodie = Auth::guard('foodie')->user();
        $orderItems = $order->order_item()->get();
        $orderChef = [];
        foreach ($orderItems as $orderItem) {
            if ($orderItem->order_type == 0) {
                $orderPlan = Plan::where('id', '=', $orderItem->plan_id)->first();
                $orderChef[] = $orderPlan->chef->id;
            } elseif ($orderItem->order_type == 0) {
                $orderPlan = CustomPlan::where('id', '=', $orderItem->plan_id)->first();
                $orderChef[] = $orderPlan->plan->chef->id;
            }
        }

        $uniqueChef = array_unique($orderChef);

        foreach ($uniqueChef as $chef) {
            $chefnotif = new Notification();
            $chefnotif->sender_id = 0;
            $chefnotif->receiver_id = $chef;
            $chefnotif->receiver_type = 'c';
            $chefnotif->notification = $foodie->first_name . ' ' . $foodie->last_name . ' has cancelled their order.';
            $chefnotif->notification_type = 3;
//        dd($chefnotif);
            $chefnotif->save();
        }
//        $chef = $order->chef->id;
//        dd($chef);
        $order->is_cancelled = 1;
        $order->save();

        $foodnotif = new Notification();
        $foodnotif->sender_id = 0;
        $foodnotif->receiver_id = $foodie->id;
        $foodnotif->receiver_type = 'f';
        $foodnotif->notification = 'You have cancelled your order.';
//        $foodnotif->notification.=' Please pay before '.$thisSaturday.'.';
        $foodnotif->notification_type = 3;
//        dd($foodnotif);
        $foodnotif->save();

        return redirect()->route('foodie.order.view', ['from' => 3])->with([
            'status' => 'You have cancelled your order.'
        ]);
    }

    public function changeOrderAddress(Request $request, $id)
    {
        Validator::make($request->all(), [
            'addressSelect' => 'required',
        ])->validate();
        $addressId = $request['addressSelect'];
        $foodie = Auth::guard('foodie')->user();
        $order = Order::where('id', '=', $id)->first();
        $order->address_id = $addressId;
        $order->save();
//        $address = DB::table('foodie_address')->where('foodie_id','=',$foodie->id)->where('id','=', $id)->select('id','city','unit','street','brgy','bldg','type')->first();
        return back()->with(['status' => 'Added delivery address!']);
    }

    public function refundPage($id)
    {
        $foodie = Auth::guard('foodie')->user();
        $refund = Refund::where('id','=',$id)->first();
        $chefs = Chef::all();
        $orderItem = $refund->order_item;
        $messages = Message::where('receiver_id', '=', $foodie->id)->where('foodie_can_see', '=', 1)->where('receiver_type', '=', 'f')->where('is_read', '=', 0)->get();
        $chats = Chat::where('foodie_id', '=', $foodie->id)->where('foodie_can_see', '=', 1)->latest($column = 'updated_at')->get();
        $notifications = Notification::where('receiver_id', '=', $foodie->id)->where('receiver_type', '=', 'f')->get();
        $unreadNotifications = Notification::where('receiver_id', '=', $foodie->id)->where('receiver_type', '=', 'f')->where('is_read', '=', 0)->count();
        return view('foodie.refunds')->with([
            'foodie'=>$foodie,
            'sms_unverified' => $this->smsIsUnverified(),
            'messages' => $messages,
            'chats' => $chats,
            'chefs'=>$chefs,
            'notifications' => $notifications,
            'unreadNotifications' => $unreadNotifications,
            'refund'=>$refund,
            'orderItem'=>$orderItem
        ]);
    }

    public function chooseRefund(Request $request, $id)
    {
        $refund = Refund::where('id','=',$id)->first();
        $type = $request['refundType'];
        if($type==0){
            $refund->method = $type;
            $refund->bank_type = $request['bankType'];
            $refund->bank_account = $request['acctNmbr'];
            $refund->name = $request['acctName'];
            $refund->save();
            $status = 'Confirmed refund through bank deposit!';
        }else if($type==1){
            $refund->method = $type;
            $refund->transfer_company = $request['transferType'];
            $refund->name = $request['acctName'];
            $refund->save();
            $status = 'Confirmed refund through money transfer!';
        }

        return redirect()->route('foodie.order.view', ['from'=>4])->with(['status'=>$status]);
    }

    public function dateChange($type,$id)
    {
        $thisDay = Carbon::today();
        $dw = Carbon::now();
        $startOfWeek=$dw->startOfWeek();
        $de = Carbon::now();
        $endOfWeek = $de->endOfWeek();

        $ds = Carbon::now();
        $startOfMonth=$ds->startOfMonth();
        $dr = Carbon::now();
        $endOfMonth = $dr->endOfMonth();

        $dt = Carbon::now();
        $startOfYear=$dt->startOfYear();
        $dm = Carbon::now();
        $endOfYear = $dm->endOfYear();

        $foodieAddress = DB::table('foodie_address')->where('foodie_id', '=', Auth::guard('foodie')->user()->id)->select('id', 'city', 'unit', 'street', 'brgy', 'bldg', 'type')->get();

        $thisInput = null;
        if ($type == 1) {
            $i = 0;

            if($id==0){
                $orders = Order::where('created_at', '>=', $thisDay)->where('is_cancelled','=',0)->orderBy('is_paid','ASC')
                    ->where('foodie_id', '=', Auth::guard('foodie')->user()->id)
                    ->latest()->get();
            }else if($id==1){
                $orders = Order::where('created_at', '>=', $thisDay)->where('is_cancelled','=',0)
                    ->where('is_paid','=',0)->orderBy('is_paid','ASC')
                    ->where('foodie_id', '=', Auth::guard('foodie')->user()->id)
                    ->latest()->get();
            }else if($id==2){
                $orders = Order::where('created_at', '>=', $thisDay)->where('is_cancelled','=',0)
                    ->where('is_paid','=',1)->orderBy('is_paid','ASC')
                    ->where('foodie_id', '=', Auth::guard('foodie')->user()->id)
                    ->latest()->get();
            }else if($id==3){
                $orders = Order::where('created_at', '>=', $thisDay)->where('is_cancelled','=',1)->orderBy('is_paid','ASC')
                    ->where('foodie_id', '=', Auth::guard('foodie')->user()->id)
                    ->latest()->get();
            }

            if ($orders->count() > 0) {
                $thisInput = '[';
                foreach ($orders as $order) {
                    $thisInput .= '{';
                    $thisInput .= '"id":' . $order->id . ', ';

                    $orderAddress = '';
                    if ($order->address_id != null) {
                        foreach ($foodieAddress as $fAdd) {
                            if ($fAdd->id == $order->address_id) {
                                $orderAddress = $fAdd->unit;
                                if ($fAdd->bldg != '') {
                                    $orderAddress .= ' ' . $fAdd->bldg . ', ';
                                }
                                $orderAddress .= ' ' . $fAdd->street;
                                $orderAddress .= ', ' . $fAdd->brgy;
                                $orderAddress .= ' ' . $fAdd->city;
                            }
                        }
                    }
                    $thisInput .= '"address":"' . $orderAddress . '", ';
                    $thisInput .= '"total":"PHP ' . number_format($order->total, 2, '.', ',') . '", ';
                    $is_paid = "";
                    if ($order->is_paid == 0) {
                        $is_paid = "Pending";
                    } elseif ($order->is_paid == 1) {
                        $is_paid = "Paid";
                    }
                    $thisInput .= '"is_paid":"' . $is_paid . '", ';
                    $thisInput .= '"is_cancelled":' . $order->is_cancelled . ', ';
                    $dt = new Carbon($order->created_at);
                    $startOfWeek = $dt->startOfWeek()->addDay(7)->format('F d, Y');
                    $thisInput .= '"week":"' . $startOfWeek . '", ';
                    $thisInput .= '"created_at":"' . $order->created_at->format('F d, Y h:i A') . '", ';
                    $orderItems = $order->order_item()->get();
                    $thisInput .= '"items": [';
                    $j = 0;
//        $orderItemArray[]= array('id'=>$orderItem->id,'order_id'=>$orderItem->order_id,
//            'plan'=>$planName,'planPic'=>$planPic,'chef'=>$chefName,'type'=>$orderType,'cust'=>$orderItem->order_type,'quantity'=>$orderItem->quantity,'price'=>'PHP '.number_format($orderItem->price,2,'.',','));
                    foreach ($orderItems as $orderItem) {
//                        $orderPlan = "";
//                        $planPic = "";
//                        $planName = "";
//                        $chefName = "";
//                        $orderType = "";
                        if ($orderItem->order_type == 0) {
                            $orderPlan = Plan::where('id', '=', $orderItem->plan_id)->first();
                            //                    dd($orderPlan->picture);
                            $planPic = $orderPlan->picture;
                            $planName = $orderPlan->plan_name;
                            $chefName = $orderPlan->chef->name;
                            $orderType = "Standard";
                        } elseif ($orderItem->order_type == 1 || $orderItem->order_type == 2) {
                            if ($orderItem->order_type == 1) {
                                $orderPlan = CustomPlan::where('id', '=', $orderItem->plan_id)->first();
                            } elseif ($orderItem->order_type == 2) {
                                $orderPlan = SimpleCustomPlan::where('id', '=', $orderItem->plan_id)->first();
                            }
                            if ($orderPlan != null) {
                                $planPic = $orderPlan->plan->picture;
                                $planName = $orderPlan->plan->plan_name;
                                $chefName = $orderPlan->plan->chef->name;
                                $orderType = "Customized";
                            }
                        }
                        $thisInput .= '{';
                        $thisInput .= '"id":' . $orderItem->id . ', ';
                        $thisInput .= '"order_id":' . $orderItem->order_id . ', ';
                        $thisInput .= '"plan":"' . $planName . '", ';
                        $thisInput .= '"planPic":"' . $planPic . '", ';
                        $thisInput .= '"chef":"' . $chefName . '", ';
                        $thisInput .= '"type":"' . $orderType . '", ';
                        $thisInput .= '"cust":' . $orderItem->order_type . ', ';
                        $thisInput .= '"quantity":' . $orderItem->quantity . ', ';
                        $thisInput .= '"delivery":' . $orderItem->is_delivered . ', ';
                        $thisInput .= '"price":"' . 'PHP ' . number_format($orderItem->price, 2, '.', ',') . '"';
                        if (++$j < $orderItems->count()) {
                            $thisInput .= '},';
                        } else {
                            $thisInput .= '}';
                        }
                    }
                    $thisInput .= ']';
                    if (++$i < $orders->count()) {
                        $thisInput .= '},';
                    } else {
                        $thisInput .= '}';
                    }
                }
                $thisInput .= ']';

                return $thisInput;
            }
        }else if($type==2){
            $i = 0;

            if($id==0){
                $orders = Order::where('created_at', '>', $startOfWeek)
                    ->where('created_at', '<', $endOfWeek)->where('is_cancelled','=',0)->orderBy('is_paid','ASC')
                    ->where('foodie_id', '=', Auth::guard('foodie')->user()->id)
                    ->latest()->get();
            }else if($id==1){
                $orders = Order::where('created_at', '>', $startOfWeek)
                    ->where('created_at', '<', $endOfWeek)->where('is_cancelled','=',0)
                    ->where('is_paid','=',0)
                    ->orderBy('is_paid','ASC')
                    ->where('foodie_id', '=', Auth::guard('foodie')->user()->id)
                    ->latest()->get();
            }else if($id==2){
                $orders = Order::where('created_at', '>', $startOfWeek)
                    ->where('created_at', '<', $endOfWeek)->where('is_cancelled','=',0)
                    ->where('is_paid','=',1)
                    ->orderBy('is_paid','ASC')
                    ->where('foodie_id', '=', Auth::guard('foodie')->user()->id)
                    ->latest()->get();
            }else if($id==3){
                $orders = Order::where('created_at', '>', $startOfWeek)
                    ->where('created_at', '<', $endOfWeek)->where('is_cancelled','=',1)->orderBy('is_paid','ASC')
                    ->where('foodie_id', '=', Auth::guard('foodie')->user()->id)
                    ->latest()->get();
            }
            if ($orders->count() > 0) {
                $thisInput = '[';
                foreach ($orders as $order) {
                    $thisInput .= '{';
                    $thisInput .= '"id":' . $order->id . ', ';

                    $orderAddress = '';
                    if ($order->address_id != null) {
                        foreach ($foodieAddress as $fAdd) {
                            if ($fAdd->id == $order->address_id) {
                                $orderAddress = $fAdd->unit;
                                if ($fAdd->bldg != '') {
                                    $orderAddress .= ' ' . $fAdd->bldg . ', ';
                                }
                                $orderAddress .= ' ' . $fAdd->street;
                                $orderAddress .= ', ' . $fAdd->brgy;
                                $orderAddress .= ' ' . $fAdd->city;
                            }
                        }
                    }
                    $thisInput .= '"address":"' . $orderAddress . '", ';
                    $thisInput .= '"total":"PHP ' . number_format($order->total, 2, '.', ',') . '", ';
                    $is_paid = "";
                    if ($order->is_paid == 0) {
                        $is_paid = "Pending";
                    } elseif ($order->is_paid == 1) {
                        $is_paid = "Paid";
                    }
                    $thisInput .= '"is_paid":"' . $is_paid . '", ';
                    $thisInput .= '"is_cancelled":' . $order->is_cancelled . ', ';
                    $dt = new Carbon($order->created_at);
                    $startOfWeek = $dt->startOfWeek()->addDay(7)->format('F d, Y');
                    $thisInput .= '"week":"' . $startOfWeek . '", ';
                    $thisInput .= '"created_at":"' . $order->created_at->format('F d, Y h:i A') . '", ';
                    $orderItems = $order->order_item()->get();
                    $thisInput .= '"items": [';
                    $j = 0;
//        $orderItemArray[]= array('id'=>$orderItem->id,'order_id'=>$orderItem->order_id,
//            'plan'=>$planName,'planPic'=>$planPic,'chef'=>$chefName,'type'=>$orderType,'cust'=>$orderItem->order_type,'quantity'=>$orderItem->quantity,'price'=>'PHP '.number_format($orderItem->price,2,'.',','));
                    foreach ($orderItems as $orderItem) {
//                        $orderPlan = "";
//                        $planPic = "";
//                        $planName = "";
//                        $chefName = "";
//                        $orderType = "";
                        if ($orderItem->order_type == 0) {
                            $orderPlan = Plan::where('id', '=', $orderItem->plan_id)->first();
                            //                    dd($orderPlan->picture);
                            $planPic = $orderPlan->picture;
                            $planName = $orderPlan->plan_name;
                            $chefName = $orderPlan->chef->name;
                            $orderType = "Standard";
                        } elseif ($orderItem->order_type == 1 || $orderItem->order_type == 2) {
                            if ($orderItem->order_type == 1) {
                                $orderPlan = CustomPlan::where('id', '=', $orderItem->plan_id)->first();
                            } elseif ($orderItem->order_type == 2) {
                                $orderPlan = SimpleCustomPlan::where('id', '=', $orderItem->plan_id)->first();
                            }
                            if ($orderPlan != null) {
                                $planPic = $orderPlan->plan->picture;
                                $planName = $orderPlan->plan->plan_name;
                                $chefName = $orderPlan->plan->chef->name;
                                $orderType = "Customized";
                            }
                        }
                        $thisInput .= '{';
                        $thisInput .= '"id":' . $orderItem->id . ', ';
                        $thisInput .= '"order_id":' . $orderItem->order_id . ', ';
                        $thisInput .= '"plan":"' . $planName . '", ';
                        $thisInput .= '"planPic":"' . $planPic . '", ';
                        $thisInput .= '"chef":"' . $chefName . '", ';
                        $thisInput .= '"type":"' . $orderType . '", ';
                        $thisInput .= '"cust":' . $orderItem->order_type . ', ';
                        $thisInput .= '"quantity":' . $orderItem->quantity . ', ';
                        $thisInput .= '"delivery":' . $orderItem->is_delivered . ', ';
                        $thisInput .= '"price":"' . 'PHP ' . number_format($orderItem->price, 2, '.', ',') . '"';
                        if (++$j < $orderItems->count()) {
                            $thisInput .= '},';
                        } else {
                            $thisInput .= '}';
                        }
                    }
                    $thisInput .= ']';
                    if (++$i < $orders->count()) {
                        $thisInput .= '},';
                    } else {
                        $thisInput .= '}';
                    }
                }
                $thisInput .= ']';

                return $thisInput;
            }
        }else if($type==3){
            $i = 0;

            if($id==0){
                $orders = Order::where('created_at', '>', $startOfMonth)
                    ->where('created_at', '<', $endOfMonth)->where('is_cancelled','=',0)->orderBy('is_paid','ASC')
                    ->where('foodie_id', '=', Auth::guard('foodie')->user()->id)
                    ->latest()->get();
            }else if($id==1){
                $orders = Order::where('created_at', '>', $startOfMonth)
                    ->where('created_at', '<', $endOfMonth)->where('is_cancelled','=',0)
                    ->where('is_paid','=',0)->orderBy('is_paid','ASC')
                    ->where('foodie_id', '=', Auth::guard('foodie')->user()->id)
                    ->latest()->get();
            }else if($id==2){
                $orders = Order::where('created_at', '>', $startOfMonth)
                    ->where('created_at', '<', $endOfMonth)->where('is_cancelled','=',0)
                    ->where('is_paid','=',1)->orderBy('is_paid','ASC')
                    ->where('foodie_id', '=', Auth::guard('foodie')->user()->id)
                    ->latest()->get();
            }else if($id==3){
                $orders = Order::where('created_at', '>', $startOfMonth)
                    ->where('created_at', '<', $endOfMonth)->where('is_cancelled','=',1)->orderBy('is_paid','ASC')
                    ->where('foodie_id', '=', Auth::guard('foodie')->user()->id)
                    ->latest()->get();
            }


            if ($orders->count() > 0) {
                $thisInput = '[';
                foreach ($orders as $order) {
                    $thisInput .= '{';
                    $thisInput .= '"id":' . $order->id . ', ';

                    $orderAddress = '';
                    if ($order->address_id != null) {
                        foreach ($foodieAddress as $fAdd) {
                            if ($fAdd->id == $order->address_id) {
                                $orderAddress = $fAdd->unit;
                                if ($fAdd->bldg != '') {
                                    $orderAddress .= ' ' . $fAdd->bldg . ', ';
                                }
                                $orderAddress .= ' ' . $fAdd->street;
                                $orderAddress .= ', ' . $fAdd->brgy;
                                $orderAddress .= ' ' . $fAdd->city;
                            }
                        }
                    }
                    $thisInput .= '"address":"' . $orderAddress . '", ';
                    $thisInput .= '"total":"PHP ' . number_format($order->total, 2, '.', ',') . '", ';
                    $is_paid = "";
                    if ($order->is_paid == 0) {
                        $is_paid = "Pending";
                    } elseif ($order->is_paid == 1) {
                        $is_paid = "Paid";
                    }
                    $thisInput .= '"is_paid":"' . $is_paid . '", ';
                    $thisInput .= '"is_cancelled":' . $order->is_cancelled . ', ';
                    $dt = new Carbon($order->created_at);
                    $startOfWeek = $dt->startOfWeek()->addDay(7)->format('F d, Y');
                    $thisInput .= '"week":"' . $startOfWeek . '", ';
                    $thisInput .= '"created_at":"' . $order->created_at->format('F d, Y h:i A') . '", ';
                    $orderItems = $order->order_item()->get();
                    $thisInput .= '"items": [';
                    $j = 0;
//        $orderItemArray[]= array('id'=>$orderItem->id,'order_id'=>$orderItem->order_id,
//            'plan'=>$planName,'planPic'=>$planPic,'chef'=>$chefName,'type'=>$orderType,'cust'=>$orderItem->order_type,'quantity'=>$orderItem->quantity,'price'=>'PHP '.number_format($orderItem->price,2,'.',','));
                    foreach ($orderItems as $orderItem) {
//                        $orderPlan = "";
//                        $planPic = "";
//                        $planName = "";
//                        $chefName = "";
//                        $orderType = "";
                        if ($orderItem->order_type == 0) {
                            $orderPlan = Plan::where('id', '=', $orderItem->plan_id)->first();
                            //                    dd($orderPlan->picture);
                            $planPic = $orderPlan->picture;
                            $planName = $orderPlan->plan_name;
                            $chefName = $orderPlan->chef->name;
                            $orderType = "Standard";
                        } elseif ($orderItem->order_type == 1 || $orderItem->order_type == 2) {
                            if ($orderItem->order_type == 1) {
                                $orderPlan = CustomPlan::where('id', '=', $orderItem->plan_id)->first();
                            } elseif ($orderItem->order_type == 2) {
                                $orderPlan = SimpleCustomPlan::where('id', '=', $orderItem->plan_id)->first();
                            }
                            if ($orderPlan != null) {
                                $planPic = $orderPlan->plan->picture;
                                $planName = $orderPlan->plan->plan_name;
                                $chefName = $orderPlan->plan->chef->name;
                                $orderType = "Customized";
                            }
                        }
                        $thisInput .= '{';
                        $thisInput .= '"id":' . $orderItem->id . ', ';
                        $thisInput .= '"order_id":' . $orderItem->order_id . ', ';
                        $thisInput .= '"plan":"' . $planName . '", ';
                        $thisInput .= '"planPic":"' . $planPic . '", ';
                        $thisInput .= '"chef":"' . $chefName . '", ';
                        $thisInput .= '"type":"' . $orderType . '", ';
                        $thisInput .= '"cust":' . $orderItem->order_type . ', ';
                        $thisInput .= '"quantity":' . $orderItem->quantity . ', ';
                        $thisInput .= '"delivery":' . $orderItem->is_delivered . ', ';
                        $thisInput .= '"price":"' . 'PHP ' . number_format($orderItem->price, 2, '.', ',') . '"';
                        if (++$j < $orderItems->count()) {
                            $thisInput .= '},';
                        } else {
                            $thisInput .= '}';
                        }
                    }
                    $thisInput .= ']';
                    if (++$i < $orders->count()) {
                        $thisInput .= '},';
                    } else {
                        $thisInput .= '}';
                    }
                }
                $thisInput .= ']';

                return $thisInput;
            }
        }else if($type==4){
            $i = 0;

            if($id==0){
                $orders = Order::where('created_at', '>', $startOfYear)
                    ->where('created_at', '<', $endOfYear)->where('is_cancelled','=',0)->orderBy('is_paid','ASC')
                    ->where('foodie_id', '=', Auth::guard('foodie')->user()->id)
                    ->latest()->get();
            }else if($id==1){
                $orders = Order::where('created_at', '>', $startOfYear)
                    ->where('created_at', '<', $endOfYear)->where('is_cancelled','=',0)
                    ->where('is_paid','=',0)->orderBy('is_paid','ASC')
                    ->where('foodie_id', '=', Auth::guard('foodie')->user()->id)
                    ->latest()->get();
            }else if($id==2){
                $orders = Order::where('created_at', '>', $startOfYear)
                    ->where('created_at', '<', $endOfYear)->where('is_cancelled','=',0)
                    ->where('is_paid','=',1)->orderBy('is_paid','ASC')
                    ->where('foodie_id', '=', Auth::guard('foodie')->user()->id)
                    ->latest()->get();
            }else if($id==3){
                $orders = Order::where('created_at', '>', $startOfYear)
                    ->where('created_at', '<', $endOfYear)->where('is_cancelled','=',1)
                    ->orderBy('is_paid','ASC')
                    ->where('foodie_id', '=', Auth::guard('foodie')->user()->id)
                    ->latest()->get();
            }


            if ($orders->count() > 0) {
                $thisInput = '[';
                foreach ($orders as $order) {
                    $thisInput .= '{';
                    $thisInput .= '"id":' . $order->id . ', ';

                    $orderAddress = '';
                    if ($order->address_id != null) {
                        foreach ($foodieAddress as $fAdd) {
                            if ($fAdd->id == $order->address_id) {
                                $orderAddress = $fAdd->unit;
                                if ($fAdd->bldg != '') {
                                    $orderAddress .= ' ' . $fAdd->bldg . ', ';
                                }
                                $orderAddress .= ' ' . $fAdd->street;
                                $orderAddress .= ', ' . $fAdd->brgy;
                                $orderAddress .= ' ' . $fAdd->city;
                            }
                        }
                    }
                    $thisInput .= '"address":"' . $orderAddress . '", ';
                    $thisInput .= '"total":"PHP ' . number_format($order->total, 2, '.', ',') . '", ';
                    $is_paid = "";
                    if ($order->is_paid == 0) {
                        $is_paid = "Pending";
                    } elseif ($order->is_paid == 1) {
                        $is_paid = "Paid";
                    }
                    $thisInput .= '"is_paid":"' . $is_paid . '", ';
                    $thisInput .= '"is_cancelled":' . $order->is_cancelled . ', ';
                    $dt = new Carbon($order->created_at);
                    $startOfWeek = $dt->startOfWeek()->addDay(7)->format('F d, Y');
                    $thisInput .= '"week":"' . $startOfWeek . '", ';
                    $thisInput .= '"created_at":"' . $order->created_at->format('F d, Y h:i A') . '", ';
                    $orderItems = $order->order_item()->get();
                    $thisInput .= '"items": [';
                    $j = 0;
//        $orderItemArray[]= array('id'=>$orderItem->id,'order_id'=>$orderItem->order_id,
//            'plan'=>$planName,'planPic'=>$planPic,'chef'=>$chefName,'type'=>$orderType,'cust'=>$orderItem->order_type,'quantity'=>$orderItem->quantity,'price'=>'PHP '.number_format($orderItem->price,2,'.',','));
                    foreach ($orderItems as $orderItem) {
//                        $orderPlan = "";
//                        $planPic = "";
//                        $planName = "";
//                        $chefName = "";
//                        $orderType = "";
                        if ($orderItem->order_type == 0) {
                            $orderPlan = Plan::where('id', '=', $orderItem->plan_id)->first();
                            //                    dd($orderPlan->picture);
                            $planPic = $orderPlan->picture;
                            $planName = $orderPlan->plan_name;
                            $chefName = $orderPlan->chef->name;
                            $orderType = "Standard";
                        } elseif ($orderItem->order_type == 1 || $orderItem->order_type == 2) {
                            if ($orderItem->order_type == 1) {
                                $orderPlan = CustomPlan::where('id', '=', $orderItem->plan_id)->first();
                            } elseif ($orderItem->order_type == 2) {
                                $orderPlan = SimpleCustomPlan::where('id', '=', $orderItem->plan_id)->first();
                            }
                            if ($orderPlan != null) {
                                $planPic = $orderPlan->plan->picture;
                                $planName = $orderPlan->plan->plan_name;
                                $chefName = $orderPlan->plan->chef->name;
                                $orderType = "Customized";
                            }
                        }
                        $thisInput .= '{';
                        $thisInput .= '"id":' . $orderItem->id . ', ';
                        $thisInput .= '"order_id":' . $orderItem->order_id . ', ';
                        $thisInput .= '"plan":"' . $planName . '", ';
                        $thisInput .= '"planPic":"' . $planPic . '", ';
                        $thisInput .= '"chef":"' . $chefName . '", ';
                        $thisInput .= '"type":"' . $orderType . '", ';
                        $thisInput .= '"cust":' . $orderItem->order_type . ', ';
                        $thisInput .= '"quantity":' . $orderItem->quantity . ', ';
                        $thisInput .= '"delivery":' . $orderItem->is_delivered . ', ';
                        $thisInput .= '"price":"' . 'PHP ' . number_format($orderItem->price, 2, '.', ',') . '"';
                        if (++$j < $orderItems->count()) {
                            $thisInput .= '},';
                        } else {
                            $thisInput .= '}';
                        }
                    }
                    $thisInput .= ']';
                    if (++$i < $orders->count()) {
                        $thisInput .= '},';
                    } else {
                        $thisInput .= '}';
                    }
                }
                $thisInput .= ']';

                return $thisInput;
            }
        }

        return $thisInput;
    }

    public function dayChange($date,$type)
    {
        $dt = Carbon::createFromFormat('Y-m-d', $date);
        $thisDay=$dt->startOfDay();
        $dr = Carbon::createFromFormat('Y-m-d', $date);
        $endDay=$dr->endOfDay();

        $foodieAddress = DB::table('foodie_address')->where('foodie_id', '=', Auth::guard('foodie')->user()->id)->select('id', 'city', 'unit', 'street', 'brgy', 'bldg', 'type')->get();

        $thisInput = null;
            $i = 0;
        if($type==0){
            $orders = Order::where('created_at', '>=', $thisDay)->where('created_at','<=',$endDay)->orderBy('is_paid','ASC')
                ->where('is_cancelled','=',0)
                ->where('foodie_id', '=', Auth::guard('foodie')->user()->id)
                ->latest()->get();
        }else if($type==1){
            $orders = Order::where('created_at', '>=', $thisDay)->where('created_at','<=',$endDay)->orderBy('is_paid','ASC')
                ->where('is_cancelled','=',0)->where('is_paid','=',0)
                ->where('foodie_id', '=', Auth::guard('foodie')->user()->id)
                ->latest()->get();
        }else if($type==2){
            $orders = Order::where('created_at', '>=', $thisDay)->where('created_at','<=',$endDay)->orderBy('is_paid','ASC')
                ->where('is_cancelled','=',0)->where('is_paid','=',1)
                ->where('foodie_id', '=', Auth::guard('foodie')->user()->id)
                ->latest()->get();
        }else if($type==3){
            $orders = Order::where('created_at', '>=', $thisDay)->where('created_at','<=',$endDay)->orderBy('is_paid','ASC')
                ->where('is_cancelled','=',1)
                ->where('foodie_id', '=', Auth::guard('foodie')->user()->id)
                ->latest()->get();
        }

            if ($orders->count() > 0) {
                $thisInput = '[';
                foreach ($orders as $order) {
                    $thisInput .= '{';
                    $thisInput .= '"id":' . $order->id . ', ';

                    $orderAddress = '';
                    if ($order->address_id != null) {
                        foreach ($foodieAddress as $fAdd) {
                            if ($fAdd->id == $order->address_id) {
                                $orderAddress = $fAdd->unit;
                                if ($fAdd->bldg != '') {
                                    $orderAddress .= ' ' . $fAdd->bldg . ', ';
                                }
                                $orderAddress .= ' ' . $fAdd->street;
                                $orderAddress .= ', ' . $fAdd->brgy;
                                $orderAddress .= ' ' . $fAdd->city;
                            }
                        }
                    }
                    $thisInput .= '"address":"' . $orderAddress . '", ';
                    $thisInput .= '"total":"PHP ' . number_format($order->total, 2, '.', ',') . '", ';
                    $is_paid = "";
                    if ($order->is_paid == 0) {
                        $is_paid = "Pending";
                    } elseif ($order->is_paid == 1) {
                        $is_paid = "Paid";
                    }
                    $thisInput .= '"is_paid":"' . $is_paid . '", ';
                    $thisInput .= '"is_cancelled":' . $order->is_cancelled . ', ';
                    $dt = new Carbon($order->created_at);
                    $startOfWeek = $dt->startOfWeek()->addDay(7)->format('F d, Y');
                    $thisInput .= '"week":"' . $startOfWeek . '", ';
                    $thisInput .= '"created_at":"' . $order->created_at->format('F d, Y h:i A') . '", ';
                    $orderItems = $order->order_item()->get();
                    $thisInput .= '"items": [';
                    $j = 0;
//        $orderItemArray[]= array('id'=>$orderItem->id,'order_id'=>$orderItem->order_id,
//            'plan'=>$planName,'planPic'=>$planPic,'chef'=>$chefName,'type'=>$orderType,'cust'=>$orderItem->order_type,'quantity'=>$orderItem->quantity,'price'=>'PHP '.number_format($orderItem->price,2,'.',','));
                    foreach ($orderItems as $orderItem) {
//                        $orderPlan = "";
//                        $planPic = "";
//                        $planName = "";
//                        $chefName = "";
//                        $orderType = "";
                        if ($orderItem->order_type == 0) {
                            $orderPlan = Plan::where('id', '=', $orderItem->plan_id)->first();
                            //                    dd($orderPlan->picture);
                            $planPic = $orderPlan->picture;
                            $planName = $orderPlan->plan_name;
                            $chefName = $orderPlan->chef->name;
                            $orderType = "Standard";
                        } elseif ($orderItem->order_type == 1 || $orderItem->order_type == 2) {
                            if ($orderItem->order_type == 1) {
                                $orderPlan = CustomPlan::where('id', '=', $orderItem->plan_id)->first();
                            } elseif ($orderItem->order_type == 2) {
                                $orderPlan = SimpleCustomPlan::where('id', '=', $orderItem->plan_id)->first();
                            }
                            if ($orderPlan != null) {
                                $planPic = $orderPlan->plan->picture;
                                $planName = $orderPlan->plan->plan_name;
                                $chefName = $orderPlan->plan->chef->name;
                                $orderType = "Customized";
                            }
                        }
                        $thisInput .= '{';
                        $thisInput .= '"id":' . $orderItem->id . ', ';
                        $thisInput .= '"order_id":' . $orderItem->order_id . ', ';
                        $thisInput .= '"plan":"' . $planName . '", ';
                        $thisInput .= '"planPic":"' . $planPic . '", ';
                        $thisInput .= '"chef":"' . $chefName . '", ';
                        $thisInput .= '"type":"' . $orderType . '", ';
                        $thisInput .= '"delivery":' . $orderItem->is_delivered . ', ';
                        $thisInput .= '"cust":' . $orderItem->order_type . ', ';
                        $thisInput .= '"quantity":' . $orderItem->quantity . ', ';
                        $thisInput .= '"price":"' . 'PHP ' . number_format($orderItem->price, 2, '.', ',') . '"';
                        if (++$j < $orderItems->count()) {
                            $thisInput .= '},';
                        } else {
                            $thisInput .= '}';
                        }
                    }
                    $thisInput .= ']';
                    if (++$i < $orders->count()) {
                        $thisInput .= '},';
                    } else {
                        $thisInput .= '}';
                    }
                }
                $thisInput .= ']';

                return $thisInput;
            }

        return $thisInput;
    }

    public function selectDay($type)
    {
        if($type == 0){
            $orderTime = Order::where('foodie_id','=',Auth::guard('foodie')->user()->id)->where('is_cancelled','=',0)->select('created_at')->latest()->get();
        }else if($type == 1){
            $orderTime = Order::where('foodie_id','=',Auth::guard('foodie')->user()->id)->where('is_paid','=',0)->where('is_cancelled','=',0)->select('created_at')->latest()->get();
        }else if($type == 2){
            $orderTime = Order::where('foodie_id','=',Auth::guard('foodie')->user()->id)->where('is_paid','=',1)->where('is_cancelled','=',0)->select('created_at')->latest()->get();
        }else if($type == 3){
            $orderTime = Order::where('foodie_id','=',Auth::guard('foodie')->user()->id)->where('is_cancelled','=',1)->select('created_at')->latest()->get();
        }

//        $yearArray = [];
//        $monthArray =[];
//        $dayArray = [];
        $timeArray =[];
        foreach($orderTime as $item){
//            $yearArray[] = $item->created_at->year;
//            $monthArray[] = $item->created_at->month;
//            $dayArray[] = $item->created_at->day;
            $timeArray[]=date('Y-m-d', strtotime($item->created_at));
        }
        $uniqueTimeArray = array_unique($timeArray);
//        dd($timeArray);
        return $uniqueTimeArray;
    }

    public function refundChange($type)
    {
        $foodie=Auth::guard('foodie')->user();
        $thisDay = Carbon::today();
        $dw = Carbon::now();
        $startOfWeek=$dw->startOfWeek();
        $de = Carbon::now();
        $endOfWeek = $de->endOfWeek();

        $ds = Carbon::now();
        $startOfMonth=$ds->startOfMonth();
        $dr = Carbon::now();
        $endOfMonth = $dr->endOfMonth();

        $dt = Carbon::now();
        $startOfYear=$dt->startOfYear();
        $dm = Carbon::now();
        $endOfYear = $dm->endOfYear();

        if($type==1){
            $refunds = Refund::where('foodie_id','=',$foodie->id)->where('created_at','>',$thisDay)->get();

        }else if($type==2){
            $refunds = Refund::where('foodie_id','=',$foodie->id)->where('created_at','>',$startOfWeek)->where('created_at','<',$endOfWeek)->get();

        }else if($type==3){
            $refunds = Refund::where('foodie_id','=',$foodie->id)->where('created_at','>',$startOfMonth)->where('created_at','<',$endOfMonth)->get();

        }else if($type==4){
            $refunds = Refund::where('foodie_id','=',$foodie->id)->where('created_at','>',$startOfYear)->where('created_at','<',$endOfYear)->get();

        }

        $thisInput = null;
        $i=0;
        $refunds = Refund::where('foodie_id','=',$foodie->id)->where('created_at','>',$startOfWeek)->where('created_at','<',$endOfWeek)->get();
//        dd($refunds);

        if($refunds->count()>0){
//            dd('hello');
            $thisInput ='[';
            foreach($refunds as $refund){
                $orderItem = $refund->order_item;
                if ($orderItem->order_type == 0) {
                    $orderPlan = Plan::where('id', '=', $orderItem->plan_id)->first();
                    //                    dd($orderPlan->picture);
                    $planPic = $orderPlan->picture;
                    $planName = $orderPlan->plan_name;
                    $chefName = $orderPlan->chef->name;
                    $orderType = "Standard";
                } elseif ($orderItem->order_type == 1 || $orderItem->order_type == 2) {
                    if ($orderItem->order_type == 1) {
                        $orderPlan = CustomPlan::where('id', '=', $orderItem->plan_id)->first();
                    } elseif ($orderItem->order_type == 2) {
                        $orderPlan = SimpleCustomPlan::where('id', '=', $orderItem->plan_id)->first();
                    }
                    if ($orderPlan != null) {
                        $planPic = $orderPlan->plan->picture;
                        $planName = $orderPlan->plan->plan_name;
                        $chefName = $orderPlan->plan->chef->name;
                        $orderType = "Customized";
                    }
                }

                $thisInput .='{';
                $thisInput .= '"id":' . $refund->id . ', ';
                $thisInput .= '"plan":"' . $planName . '", ';
                $thisInput .= '"chef":"' . $chefName . '", ';
                $thisInput .= '"type":"' . $orderType . '", ';
                $thisInput .='"quantity":' . $orderItem->quantity . ', ';
                $thisInput .='"amount":"PHP ' . number_format(($orderItem->price * $orderItem->quantity), 2, '.', ',') . '", ';
                $thisInput .='"created_at":" ' . $refund->created_at->format('F d, Y h:i A') . '"';
                if (++$i < $refunds->count()) {
                    $thisInput .= '},';
                } else {
                    $thisInput .= '}';
                }
            }
            $thisInput .=']';
        }

        return $thisInput;
    }
}
