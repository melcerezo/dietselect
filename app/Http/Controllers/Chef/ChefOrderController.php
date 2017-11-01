<?php

namespace App\Http\Controllers\Chef;

use App\ChefCustomizedMeal;
use App\Commission;
use App\CustomPlan;
use App\Foodie;
use App\Http\Controllers\Controller;

use App\Chat;
use App\CustomizedMeal;
use App\Http\Controllers\Chef\Auth\VerifiesSms;
use App\Mail\CancelSuccessChef;
use App\Mail\CancelSuccessFoodie;
use App\Mail\DeliverySuccessChef;
use App\Mail\DeliverySuccessFoodie;
use App\Notification;
use App\Order;
use App\Message;
use App\OrderItem;
use App\Plan;
use App\MealPlan;
use App\Meal;
use App\IngredientMeal;
use App\Refund;
use App\SimpleCustomPlan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Mail as mailer;


class ChefOrderController extends Controller
{

    use VerifiesSms;


    public function __construct(){
        $this->middleware('chef.auth');
    }

    public function getAllOrdersView($from){


        $chef = Auth::guard('chef')->user();

        $orderItems=OrderItem::where('chef_id','=', $chef->id)
            ->join('orders','order_items.order_id','=','orders.id')->orderBy('is_paid','ASC')
            ->orderBy('order_items.created_at','desc')
            ->select('*','order_items.id as it_id')
            ->get();

//        dd($orderItems);

        $totalPaid=0;

        foreach($orderItems->where('is_paid','=',1)->where('is_cancelled','=',0) as $orderItem){
            $totalPaid+=$orderItem->price;
        }



        $pendPaid=0;

        foreach($orderItems->where('is_paid','=',0)->where('is_cancelled','=',0) as $orderItem){
            $pendPaid+=$orderItem->price;
        }


//        dd($orderItems->where('is_paid','=',1)->where('is_cancelled','=',0));

        $orders = [];

        foreach($orderItems as $orderItem){
            if($orderItem->order_type==0){
                $orderPlan = Plan::where('id','=',$orderItem->plan_id)->first();
                $orderPlanPic = $orderPlan->picture;
                $orderPlanName = $orderPlan->plan_name;
                $orderType="Standard";
                $dt = new Carbon($orderItem->order->created_at);
                $startOfWeek=$dt->startOfWeek()->addDay(7)->format('F d, Y');
            }elseif($orderItem->order_type==1){
                $orderPlan = CustomPlan::where('id','=',$orderItem->plan_id)->first();
//                dd($orderPlan);
                if($orderPlan!=null) {
                    $orderPlanPic = $orderPlan->plan->picture;
                    $orderPlanName = $orderPlan->plan->plan_name;
                    $orderType = "Customized";
                    $dt = new Carbon($orderItem->order->created_at);
                    $startOfWeek = $dt->startOfWeek()->addDay(7)->format('F d, Y');
                }
            }elseif($orderItem->order_type==2){
                $orderPlan = SimpleCustomPlan::where('id','=',$orderItem->plan_id)->first();
                if($orderPlan!=null) {
                    $orderPlanPic = $orderPlan->plan->picture;
                    $orderPlanName = $orderPlan->plan->plan_name;
                    $orderType = "Customized";
                    $dt = new Carbon($orderItem->order->created_at);
                    $startOfWeek = $dt->startOfWeek()->addDay(7)->format('F d, Y');
                }
            }
            if($orderPlan!=null){
                $orders[]= array('id'=>$orderItem->it_id,'plan_name'=>$orderPlanName,'foodie_id'=>$orderItem->order->foodie_id,'week'=>$startOfWeek,
                    'quantity'=>$orderItem->quantity,'picture'=>$orderPlanPic,'price'=>$orderItem->price,'order_type'=>$orderType,'is_paid'=>$orderItem->order->is_paid,
                    'is_cancelled'=>$orderItem->is_cancelled,'is_delivered'=>$orderItem->is_delivered,'created_at'=>$orderItem->created_at->format('F d, Y h:i A'));
            }

        }

//        dd($orders);

        $chats= Chat::where('chef_id','=',$chef->id)->where('chef_can_see', '=', 1)->latest($column = 'updated_at')->get();
        $foodies=Foodie::all();
        $messages= Message::where('receiver_id','=',Auth::guard('chef')->user()->id)->where('chef_can_see', '=', 1)->where('receiver_type','=','c')->where('is_read','=',0)->get();
        $notifications=Notification::where('receiver_id','=',$chef->id)->where('receiver_type','=','c')->get();
        return view('chef.showAllOrders')->with([
            'sms_unverified' => $this->mobileNumberExists(),
            'chef'=>$chef,
            'foodies'=>$foodies,
            'orderItems'=>$orderItems,
            'orders'=>$orders,
            'from'=>$from,
            'chats' => $chats,
            'messages'=>$messages,
            'notifications' => $notifications,
            'totalPaid'=>$totalPaid,
            'pendPaid'=>$pendPaid
        ]);
    }

    public function commissions()
    {
        $chef = Auth::guard('chef')->user();
        $chats= Chat::where('chef_id','=',$chef->id)->where('chef_can_see', '=', 1)->latest($column = 'updated_at')->get();
        $foodies=Foodie::all();
        $messages= Message::where('receiver_id','=',Auth::guard('chef')->user()->id)->where('chef_can_see', '=', 1)->where('receiver_type','=','c')->where('is_read','=',0)->get();
        $notifications=Notification::where('receiver_id','=',$chef->id)->where('receiver_type','=','c')->get();

        return view('chef.commissions')->with([
            'sms_unverified' => $this->mobileNumberExists(),
            'chef'=>$chef,
            'foodies'=>$foodies,
            'chats' => $chats,
            'messages'=>$messages,
            'notifications' => $notifications
        ]);
    }

    public function getIngred($id,$cust){
        if($cust==1){
            $meal = CustomizedMeal::where('id','=',$id)->first();
        }else if($cust==2){
            $meal = ChefCustomizedMeal::where('id','=',$id)->first();
        }

        $ingreds = $meal->customized_ingredient_meal()->get();

        $ingredientMeals = '[';
        $i=0;
        foreach($ingreds as $ingred){
            $ingredientDesc = DB::table('ingredients')
                ->join('ingredients_group_description','ingredients.FdGrp_Cd','=','ingredients_group_description.FdGrp_Cd')
                ->where('NDB_No','=',$ingred->ingredient_id)
                ->select('ingredients.Long_Desc','ingredients_group_description.FdGrp_Desc')
                ->first();

            if(++$i<$ingreds->count()) {
                $ingredientMeals .= '{ "meal":"' . $ingred->meal_id . '","ingredient":"'.$ingredientDesc->Long_Desc.'","ingredient_group":"'.$ingredientDesc->FdGrp_Desc.'","grams":"'.$ingred->grams.'","is_customized":"'.$ingred->is_customized.'"}, ';
            }
            else{
                $ingredientMeals .= '{ "meal":"' . $ingred->meal_id . '","ingredient":"'.$ingredientDesc->Long_Desc.'","ingredient_group":"'.$ingredientDesc->FdGrp_Desc.'","grams":"'.$ingred->grams.'","is_customized":"'.$ingred->is_customized.'"} ';
            }

        }
        $ingredientMeals.= ']';
        $response=$ingredientMeals;
        return $response;
    }

    public function getOneOrderDetails(OrderItem $orderItem){
        $planName = '';
        $chef = Auth::guard('chef')->user();
        $chats= Chat::where('chef_id','=',$chef->id)->where('chef_can_see', '=', 1)->latest($column = 'updated_at')->get();
        $foodies=Foodie::all();
        $foodie = Foodie::where('id','=',$orderItem->order->foodie->id)->first();
        DB::table('foodie_address')->where('foodie_id','=',$foodie->id)->select('id','city','unit','street','brgy','bldg','type')->get();
        $orderAddress=DB::table('foodie_address')->where('id','=',$orderItem->order->address_id)->select('id','city','unit','street','brgy','bldg','type')->first();
//        dd($orderAddress);
        $allergies = $foodie->allergy()->get();
//        dd($allergies);
        $messages= Message::where('receiver_id','=',Auth::guard('chef')->user()->id)->where('chef_can_see', '=', 1)->where('receiver_type','=','c')->where('is_read','=',0)->get();
        $orderMealPlans = [];
        $orderPlan='';
        $ingredientMeals=[];
        $orderMealPlans=[];
        $saMeals = 0;
        $moSnaMeals = 0;
        $aftSnaMeals = 0;
        $tasteCount= 0;
        $cookCount = 0;
        $driedCount = 0;
        if($orderItem->order_type==0){
            $orderPlan=Plan::where('id','=',$orderItem->plan_id)->first();
            $planName = $orderPlan->plan_name;
            $mealPlans=$orderPlan->mealplans()->where('is_deleted','=',0)->get();
            $saMeals = $mealPlans->where('day','=','SA')->count();
            $moSnaMeals = $mealPlans->where('meal_type','=','MorningSnack')->count();
            $aftSnaMeals = $mealPlans->where('meal_type','=','AfternoonSnack')->count();
            foreach($mealPlans as $item){
                $orderMealPlans[]= $item->chefcustomize;
            }
        }elseif($orderItem->order_type==1){
            $orderPlan=CustomPlan::where('id','=',$orderItem->plan_id)->first();
            $planName = $orderPlan->plan->plan_name;
            $orderMealPlans=$orderPlan->customized_meal()->get();
            foreach($orderMealPlans as $orderMealPlan){
                if($orderMealPlan->chefcustomize->mealplans->day=='SA'){
                    $saMeals+=1;
                }
                if($orderMealPlan->chefcustomize->mealplans->meal_type=='MorningSnack'){
                    $moSnaMeals+=1;
                }elseif($orderMealPlan->chefcustomize->mealplans->meal_type=='AfternoonSnack'){
                    $aftSnaMeals+=1;
                }
            }
//            dd($saMeals.' '.$moSnaMeals.' '.$aftSnaMeals);
            foreach($orderMealPlans as $orderMealPlan){
                foreach($orderMealPlan->customized_ingredient_meal()->get() as $orderMealIngredient){
                    $ingredientDesc = DB::table('ingredients')
                        ->join('ingredients_group_description','ingredients.FdGrp_Cd','=','ingredients_group_description.FdGrp_Cd')
                        ->where('NDB_No','=',$orderMealIngredient->ingredient_id)
                        ->select('ingredients.Long_Desc','ingredients_group_description.FdGrp_Desc')
                        ->first();
                    $ingredientMeals[]=array(
                        "meal"=>$orderMealIngredient->meal_id,
                        "ingredient"=>$ingredientDesc->Long_Desc,
                        "ingredient_group"=>$ingredientDesc->FdGrp_Desc,
                        "grams"=>$orderMealIngredient->grams,
                        "is_customized"=>$orderMealIngredient->is_customized
                    );

                }
            }
//            dd($ingredientMeals);
        }elseif($orderItem->order_type==2){
            $orderPlan=SimpleCustomPlan::where('id','=',$orderItem->plan_id)->first();
            $planName = $orderPlan->plan->plan_name;
            $orderMealPlans=$orderPlan->simple_custom_meal()->get();
            foreach($orderMealPlans as $orderMealPlan){
                if($orderMealPlan->chef_customized_meal->mealplans->day=='SA'){
                    $saMeals+=1;
                }
                if($orderMealPlan->chef_customized_meal->mealplans->meal_type=='MorningSnack'){
                    $moSnaMeals+=1;
                }elseif($orderMealPlan->chef_customized_meal->mealplans->meal_type=='AfternoonSnack'){
                    $aftSnaMeals+=1;
                }
            }
            $tasteCount=$orderPlan->simple_custom_plan_detail()
                ->where('detail','=','sweet')
                ->orWhere('detail','=','salty')
                ->orWhere('detail','=','spicy')
                ->orWhere('detail','=','bitter')
                ->orWhere('detail','=','savory')
                ->count();
            $cookCount = $orderPlan->simple_custom_plan_detail()
                ->where('detail','=','fried')
                ->orWhere('detail','=','grilled')
                ->count();

            $driedCount = $orderPlan->simple_custom_plan_detail()
                ->where('detail','=','preservatives')
                ->orWhere('detail','=','salt')
                ->orWhere('detail','=','sweeteners')
                ->count();

        }
        $notifications=Notification::where('receiver_id','=',$chef->id)->where('receiver_type','=','c')->get();
//        dd($tasteCount);
//        dd($ingredientMealData);

//        dd($orderItem);

        return view('chef.showSingleOrder')->with([
            'sms_unverified' => $this->mobileNumberExists(),
            'chef'=>$chef,
            'foodies'=>$foodies,
            'foodie'=>$foodie,
            'chats'=>$chats,
            'messages'=>$messages,
            'orderPlan'=>$orderPlan,
            'orderAddress'=>$orderAddress,
            'allergies'=>$allergies,
            'saMeals'=>$saMeals,
            'moSnaMeals'=>$moSnaMeals,
            'aftSnaMeals'=>$aftSnaMeals,
            'tasteCount'=>$tasteCount,
            'cookCount'=>$cookCount,
            'driedCount'=>$driedCount,
            'planName'=>$planName,
            'mealPlans'=>$orderMealPlans,
            'ingredientsMeal'=>$ingredientMeals,
            'orderItem'=>$orderItem,
            'notifications' => $notifications
        ]);
    }

    public function updateDelivery($id,mailer\Mailer $mailer)
    {
        $orderItem = OrderItem::where('id','=',$id)->first();
        $planName = "";
        if($orderItem->order_type == 0){
            $orderPlan = Plan::where('id','=',$orderItem->plan_id)->first();
            $planName = $orderPlan->plan_name;
        }else if($orderItem->order_type == 2){
            $orderPlan = SimpleCustomPlan::where('id','=',$orderItem->plan_id)->first();
            $planName = $orderPlan->plan->plan_name;
        }

        $foodie = $orderItem->order->foodie;
        $messageFoodie = 'Greetings from DietSelect! Your order delivery status for '.$planName.' has been changed to delivered on ' . Carbon::now()->format('F d, Y g:i A').'.' ;
        $messageFoodie .= 'Please expect it within the week of '.$orderItem->created_at->startOfWeek()->addDays(7)->format('F d, Y').'.' ;
        $foodiePhoneNumber = '0' . $foodie->mobile_number;
//        dd($foodie);
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

        $foodnotif = new Notification();
        $foodnotif->sender_id = 0;
        $foodnotif->receiver_id = $foodie->id;
        $foodnotif->receiver_type = 'f';
        $foodnotif->notification = 'Your order for '.$planName.'\'s status has been changed to delivered, please expect it on the week of: ';
        $foodnotif->notification .= $orderItem->created_at->startOfWeek()->addDays(7)->format('F d, Y').'.';
        $foodnotif->notification_type = 2;
        $foodnotif->save();

        $chef= Auth::guard('chef')->user();
        $message = 'Greetings from DietSelect! You have changed ' . $foodie->first_name . ' ' . $foodie->last_name . '\'s order delivery status to delivered for: ';
        $message .= $planName;
        $message .= ' on ' . Carbon::now()->format('F d, Y g:i A');
        $message .= '.';
        $chefPhoneNumber = '0' . $chef->mobile_number;
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

        $chefnotif = new Notification();
        $chefnotif->sender_id = 0;
        $chefnotif->receiver_id = $chef->id;
        $chefnotif->receiver_type = 'c';
        $chefnotif->notification = 'You have changed ' . $foodie->first_name . ' ' . $foodie->last_name . '\'s order for: ';
        $chefnotif->notification .= $planName . ' to delivered on ';
        $chefnotif->notification .= Carbon::now()->format('F d, Y g:i A').'.';
        $chefnotif->notification .= 'Please deliver on week of: '.$orderItem->created_at->startOfWeek()->addDays(7)->format('F d, Y').'.';
        $chefnotif->notification_type = 4;
        $chefnotif->save();

        $chefName = $chef->name;
//        $planName = $orderItem->plan->plan_name;
        $time = Carbon::now()->format('F d, Y g:i A');
        $startTime = $orderItem->created_at->startOfWeek()->addDays(7)->format('F d, Y');
        $mailer->to($foodie->email)
            ->send(new DeliverySuccessFoodie(
                $chefName,
                $planName,
                $time,
                $startTime));

        $foodieName = $foodie->first_name . ' ' . $foodie->last_name;

        $mailer->to($chef->email)
            ->send(new DeliverySuccessChef(
                $foodieName,
                $planName,
                $time,
                $startTime));


        $orderItem->is_delivered=1;
        $orderItem->save();

//        $com = new Commission();
//        $com->chef_id = $chef->id;
//        $com->order_item_id = $orderItem->id;
//        $com->amount = $orderItem->price * $orderItem->quantity;
//        $com->save();

        return redirect()->route('chef.order.single',$orderItem->id)->with(['status'=>'Delivery Status Updated']);
    }

//    public function getCommissions(){
//        $chef = Auth::guard('chef')->user();
//
//
//    }

    public function cancelOrderItem(Request $request,$id,mailer\Mailer $mailer)
    {

        $reason = $request['cancelReason'];

        $orderItem = OrderItem::where('id','=',$id)->first();
        $order = $orderItem->order;

        $orderItemsAll = $order->order_item()->get();
        $planName = "";
        if($orderItem->order_type == 0){
            $orderPlan= Plan::where('id','=',$orderItem->plan_id)->first();
            $planName = $orderPlan->plan_name;
        }else if($orderItem->order_type == 2){
            $orderPlan = SimpleCustomPlan::where('id','=',$orderItem->plan_id)->first();
            $planName = $orderPlan->plan->plan_name;
        }

//        dd($orderItemsAll->where('is_cancelled','=',0)->count());

        $foodieName = $orderItem->order->foodie->first_name.' '.$orderItem->order->foodie->last_name;
        $chef = Auth::guard('chef')->user();
        if($order->is_paid == 0){
            $orderItem->is_cancelled = 1;
            if($reason == 0){
                $orderItem->cancelled_reason = "Out of Stock.";
            }else if($reason == 1){
                $orderItem->cancelled_reason = "Not Interested.";
            }else if($reason == 2){
                $orderItem->cancelled_reason = "Unable to take delivery.";
            }else if($reason == 3){
                $orderItem->cancelled_reason = "Out of Town.";
            }else if($reason == 4){
                $orderItem->cancelled_reason = $request['otherReason'];
            }
            $orderItem->save();

            if(!($order->order_item()->where('is_cancelled','=',0)->count())){
                $order->is_cancelled=1;
//                if($reason == 0){
//                    $order->cancelled_reason = "Out of Stock.";
//                }else if($reason == 1){
//                    $order->cancelled_reason = "Not Interested.";
//                }else if($reason == 2){
//                    $order->cancelled_reason = "Unable to take delivery.";
//                }else if($reason == 3){
//                    $order->cancelled_reason = "Out of Town.";
//                }else if($reason == 4){
                    $order->cancelled_reason = 'Chefs\' Cancellation';
//                }
                $order->save();
//                dd($order);
                $foodnotif = new Notification();
                $foodnotif->sender_id = 0;
                $foodnotif->receiver_id = $orderItem->order->foodie->id;
                $foodnotif->receiver_type = 'f';
                $foodnotif->notification = 'Your order has been cancelled on ';
                $foodnotif->notification .= Carbon::now()->format('F d, Y g:i A').', due to: ';
                $foodnotif->notification .= 'chefs cancelling their orders';
                $foodnotif->notification_type = 1;
                $foodnotif->save();
            }

            $foodnotif = new Notification();
            $foodnotif->sender_id = 0;
            $foodnotif->receiver_id = $orderItem->order->foodie->id;
            $foodnotif->receiver_type = 'f';
            $foodnotif->notification = 'Your order for '.$planName.' has been cancelled by '.$chef->name.' on ';
            $foodnotif->notification .= Carbon::now()->format('F d, Y g:i A').', due to: ';
            if($reason == 0){
                $foodnotif->notification .= "Out of Stock.";
            }else if($reason == 1){
                $foodnotif->notification .= "Not Interested.";
            }else if($reason == 2){
                $foodnotif->notification .= "Unable to take delivery.";
            }else if($reason == 3){
                $foodnotif->notification .= "Out of Town.";
            }else if($reason == 4){
                $foodnotif->notification .= $request['otherReason'];
            }
            $foodnotif->notification_type = 1;
            $foodnotif->save();

            $adminnotif = new Notification();
            $adminnotif->sender_id = $order->id;
            $adminnotif->receiver_id = 2;
            $adminnotif->receiver_type = 'a';
            $adminnotif->notification = $chef->name. ' has cancelled '.$foodieName.'\'s order for '.$planName.' on '.Carbon::now()->format('F d, Y g:i A').'.';
            $adminnotif->notification .= 'Reason: ';
            if($reason == 0){
                $adminnotif->notification .= "Out of Stock.";
            }else if($reason == 1){
                $adminnotif->notification .= "Not Interested.";
            }else if($reason == 2){
                $adminnotif->notification .= "Unable to take delivery.";
            }else if($reason == 3){
                $adminnotif->notification .= "Out of Town.";
            }else if($reason == 4){
                $adminnotif->notification .= $request['otherReason'];
            }
            $adminnotif->notification_type = 3;
            $adminnotif->save();

            $chefnotif = new Notification();
            $chefnotif->sender_id = 0;
            $chefnotif->receiver_id = $chef->id;
            $chefnotif->receiver_type = 'c';
            $chefnotif->notification = 'You have cancelled ' . $foodieName . '\'s order for: ';
            $chefnotif->notification .= $planName . ' on';
            $chefnotif->notification .= Carbon::now()->format('F d, Y g:i A').' due to: ';
            if($reason == 0){
                $chefnotif->notification .= "Out of Stock.";
            }else if($reason == 1){
                $chefnotif->notification .= "Not Interested.";
            }else if($reason == 2){
                $chefnotif->notification .= "Unable to take delivery.";
            }else if($reason == 3){
                $chefnotif->notification .= "Out of Town.";
            }else if($reason == 4){
                $chefnotif->notification .= $request['otherReason'];
            }
            $chefnotif->notification_type = 3;
            $chefnotif->save();

            $messageFoodie = 'Greetings from DietSelect! '.$chef->name.' has cancelled your order for '.$planName.' on ' . Carbon::now()->format('F d, Y g:i A').'.' ;
            $messageFoodie .= 'The listed reason is: ' ;
            if($reason == 0){
                $messageFoodie .= "Out of Stock.";
            }else if($reason == 1){
                $messageFoodie .= "Not Interested.";
            }else if($reason == 2){
                $messageFoodie .= "Unable to take delivery.";
            }else if($reason == 3){
                $messageFoodie .= "Out of Town.";
            }else if($reason == 4){
                $messageFoodie .= $request['otherReason'];
            }
            $foodiePhoneNumber = '0' . $orderItem->order->foodie->mobile_number;
//        dd($foodie);
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

            $message = 'Greetings from DietSelect! You have cancelled ' . $foodieName . '\'s order for: ';
            $message .= $planName;
            $message .= ' on ' . Carbon::now()->format('F d, Y g:i A');
            $message .= '.';
            $message .= '. The listed reason is: ' ;
            if($reason == 0){
                $message .= "Out of Stock.";
            }else if($reason == 1){
                $message .= "Not Interested.";
            }else if($reason == 2){
                $message .= "Unable to take delivery.";
            }else if($reason == 3){
                $message .= "Out of Town.";
            }else if($reason == 4){
                $message .= $request['otherReason'];
            }
            $chefPhoneNumber = '0' . $chef->mobile_number;
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

            $chefName = $chef->name;
//            $planName = $orderItem->plan->plan_name;
            $time = Carbon::now()->format('F d, Y g:i A');
            $mailMess='';
            if($reason == 0){
                $mailMess .= "Out of Stock.";
            }else if($reason == 1){
                $mailMess .= "Not Interested.";
            }else if($reason == 2){
                $mailMess .= "Unable to take delivery.";
            }else if($reason == 3){
                $mailMess .= "Out of Town.";
            }else if($reason == 4){
                $mailMess .= $request['otherReason'];
            }
            $mailer->to($orderItem->order->foodie->email)
                ->send(new CancelSuccessFoodie(
                    $chefName,
                    $planName,
                    $time,
                    $mailMess));

            $mailer->to($chef->email)
                ->send(new CancelSuccessChef(
                    $foodieName,
                    $planName,
                    $time,
                    $mailMess));

            $message = 'You have cancelled '.$foodieName.'\'s for '.$planName;

        }else if($order->is_paid == 1){

            $orderItem->is_cancelled = 1;
            if($reason == 0){
                $orderItem->cancelled_reason = "Out of Stock.";
            }else if($reason == 1){
                $orderItem->cancelled_reason = "Not Interested.";
            }else if($reason == 2){
                $orderItem->cancelled_reason = "Unable to take delivery.";
            }else if($reason == 3){
                $orderItem->cancelled_reason = "Out of Town.";
            }else if($reason == 4){
                $orderItem->cancelled_reason = $request['otherReason'];
            }
            $orderItem->save();

            if(!($order->order_item()->where('is_cancelled','=',0)->count())){
                $order->is_cancelled=1;
//                if($reason == 0){
//                    $order->cancelled_reason = "Out of Stock.";
//                }else if($reason == 1){
//                    $order->cancelled_reason = "Not Interested.";
//                }else if($reason == 2){
//                    $order->cancelled_reason = "Unable to take delivery.";
//                }else if($reason == 3){
//                    $order->cancelled_reason = "Out of Town.";
//                }else if($reason == 4){
                    $order->cancelled_reason = 'Chefs\' cancellation';
//                }
                $order->save();
            }

            $refund = new Refund();
            $refund->foodie_id = $orderItem->order->foodie->id;
            $refund->order_item_id = $orderItem->id;
            $refund->save();


            $foodnotif = new Notification();
            $foodnotif->sender_id = 0;
            $foodnotif->receiver_id = $orderItem->order->foodie->id;
            $foodnotif->receiver_type = 'f';
            $foodnotif->notification = 'Your order for '.$planName.' has been cancelled by '.$chef->name.' on ';
            $foodnotif->notification .= Carbon::now()->format('F d, Y g:i A').' due to: ';
            if($reason == 0){
                $foodnotif->notification .= "Out of Stock.";
            }else if($reason == 1){
                $foodnotif->notification .= "Not Interested.";
            }else if($reason == 2){
                $foodnotif->notification .= "Unable to take delivery.";
            }else if($reason == 3){
                $foodnotif->notification .= "Out of Town.";
            }else if($reason == 4){
                $foodnotif->notification .= $request['otherReason'];
            }
            $foodnotif->notification .= 'Please go to the refunds tab on you orders page to confirm your refund.';
            $foodnotif->notification_type = 4;
            $foodnotif->save();

            $chefnotif = new Notification();
            $chefnotif->sender_id = 0;
            $chefnotif->receiver_id = $chef->id;
            $chefnotif->receiver_type = 'c';
            $chefnotif->notification = 'You have cancelled ' . $foodieName . '\'s order for: ';
            $chefnotif->notification .= $planName . ' on';
            $chefnotif->notification .= Carbon::now()->format('F d, Y g:i A').' due to: ';
            if($reason == 0){
                $chefnotif->notification .= "Out of Stock.";
            }else if($reason == 1){
                $chefnotif->notification .= "Not Interested.";
            }else if($reason == 2){
                $chefnotif->notification .= "Unable to take delivery.";
            }else if($reason == 3){
                $chefnotif->notification .= "Out of Town.";
            }else if($reason == 4){
                $chefnotif->notification .= $request['otherReason'];
            }
            $chefnotif->notification_type = 3;
            $chefnotif->save();

            $messageFoodie = 'Greetings from DietSelect! '.$chef->name.' has cancelled your order for '.$planName.' on ' . Carbon::now()->format('F d, Y g:i A').' due to: ' ;
            if($reason == 0){
                $messageFoodie .= "Out of Stock.";
            }else if($reason == 1){
                $messageFoodie .= "Not Interested.";
            }else if($reason == 2){
                $messageFoodie .= "Unable to take delivery.";
            }else if($reason == 3){
                $messageFoodie .= "Out of Town.";
            }else if($reason == 4){
                $messageFoodie .= $request['otherReason'];
            }
            $messageFoodie .= 'Please go to the refunds tab of your orders page to process your refund.' ;
            $foodiePhoneNumber = '0' . $orderItem->order->foodie->mobile_number;
//        dd($foodie);
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

            $message = 'Greetings from DietSelect! You have cancelled ' . $foodieName . '\'s order for: ';
            $message .= $planName;
            $message .= ' on ' . Carbon::now()->format('F d, Y g:i A');
            $message .= ' due to: ';
            if($reason == 0){
                $message .= "Out of Stock.";
            }else if($reason == 1){
                $message .= "Not Interested.";
            }else if($reason == 2){
                $message .= "Unable to take delivery.";
            }else if($reason == 3){
                $message .= "Out of Town.";
            }else if($reason == 4){
                $message .= $request['otherReason'];
            }
            $chefPhoneNumber = '0' . $chef->mobile_number;
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

            $chefName = $chef->name;
//            $planName = $orderItem->plan->plan_name;
            $time = Carbon::now()->format('F d, Y g:i A');
            $mailMess='';
            if($reason == 0){
                $mailMess .= "Out of Stock.";
            }else if($reason == 1){
                $mailMess .= "Not Interested.";
            }else if($reason == 2){
                $mailMess .= "Unable to take delivery.";
            }else if($reason == 3){
                $mailMess .= "Out of Town.";
            }else if($reason == 4){
                $mailMess .= $request['otherReason'];
            }
            $mailer->to($orderItem->order->foodie->email)
                ->send(new CancelSuccessFoodie(
                    $chefName,
                    $planName,
                    $time,
                    $mailMess));

            $mailer->to($chef->email)
                ->send(new CancelSuccessChef(
                    $foodieName,
                    $planName,
                    $time,
                    $mailMess));

        $message = 'You have cancelled '.$foodieName.'\'s for '.$planName;
        }

        return redirect()->route('chef.order.view',['from'=>3])->with(['status'=>$message]);

    }


    public function dateChange($type,$id)
    {
        $thisDay = Carbon::today();
//        $orderArray[] = array('id'=>$order->id,'address'=>$orderAddress,'total'=>number_format($order->total,2,'.',','),
//            'is_paid'=>$is_paid,'is_cancelled'=>$order->is_cancelled,'week'=>$startOfWeek,'created_at'=>$order->created_at);
        $dw = Carbon::now();
        $startOfTheWeek=$dw->startOfWeek();
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

        $thisInput = null;
        if($type==1){
            if($id==0){
                $orderItems = OrderItem::whereHas('order', function ($query) {
                    $query->where('is_cancelled', '=', 0);
                })->join('orders','order_items.order_id','=','orders.id')->orderBy('is_paid','ASC')->where('order_items.is_cancelled','=',0)
                    ->where('order_items.is_cancelled','=',0)
                    ->where('order_items.created_at', '>=', $thisDay)
                    ->where('chef_id', '=', Auth::guard('chef')->user()->id)
                    ->latest($column='order_items.created_at')
                    ->select('*','order_items.id as it_id')->get();
            }else if($id==1){
                $orderItems = OrderItem::whereHas('order', function ($query) {
                    $query->where('is_cancelled', '=', 0);
                })->where('is_delivered','=',0)->join('orders','order_items.order_id','=','orders.id')->orderBy('is_paid','ASC')->where('order_items.is_cancelled','=',0)
                    ->where('order_items.created_at', '>=', $thisDay)
                    ->where('chef_id', '=', Auth::guard('chef')->user()->id)
                    ->latest($column='order_items.created_at')
                    ->select('*','order_items.id as it_id')->get();
            }else if($id==2){
                $orderItems = OrderItem::whereHas('order', function ($query) {
                    $query->where('is_cancelled', '=', 0)
                        ->where('is_paid','=',1);
                })->join('orders','order_items.order_id','=','orders.id')->orderBy('is_paid','ASC')->where('order_items.is_cancelled','=',0)
                    ->where('order_items.created_at', '>=', $thisDay)
                    ->where('chef_id', '=', Auth::guard('chef')->user()->id)
                    ->latest($column='order_items.created_at')
                    ->select('*','order_items.id as it_id')->get();
            }else if($id==3){
                $orderItems = OrderItem::join('orders','order_items.order_id','=','orders.id')->orderBy('is_paid','ASC')->where('order_items.is_cancelled','=',1)
                    ->where('order_items.created_at', '>=', $thisDay)
                    ->where('chef_id', '=', Auth::guard('chef')->user()->id)
                    ->latest($column='order_items.created_at')
                    ->select('*','order_items.id as it_id')->get();
            }else if($id==4){
                $orderItems = OrderItem::whereHas('order', function ($query) {
                    $query->where('is_cancelled', '=', 0);
                })->where('is_delivered','=',1)->join('orders','order_items.order_id','=','orders.id')->orderBy('is_paid','ASC')->where('order_items.is_cancelled','=',0)
                    ->where('order_items.created_at', '>=', $thisDay)
                    ->where('chef_id', '=', Auth::guard('chef')->user()->id)
                    ->latest($column='order_items.created_at')
                    ->select('*','order_items.id as it_id')->get();
            }


            $thisInput = null;
            $i=0;
            if($orderItems->count() >0){
                $thisInput = '[';
                foreach($orderItems as $orderItem){
//                if($orderItem->order->is_cancelled!=1){
                    if($orderItem->order_type==0){
                        $orderPlan = Plan::where('id','=',$orderItem->plan_id)->first();
                        $orderPlanPic = $orderPlan->picture;
                        $orderPlanName = $orderPlan->plan_name;
                        $orderType="Standard";
                        $dt = new Carbon($orderItem->order->created_at);
                        $startOfWeek=$dt->startOfWeek()->addDay(7)->format('F d, Y');
                    }elseif($orderItem->order_type==1){
                        $orderPlan = CustomPlan::where('id','=',$orderItem->plan_id)->first();
                        //                dd($orderPlan);
                        if($orderPlan!=null) {
                            $orderPlanPic = $orderPlan->plan->picture;
                            $orderPlanName = $orderPlan->plan->plan_name;
                            $orderType = "Customized";
                            $dt = new Carbon($orderItem->order->created_at);
                            $startOfWeek = $dt->startOfWeek()->addDay(7)->format('F d, Y');
                        }
                    }elseif($orderItem->order_type==2){
                        $orderPlan = SimpleCustomPlan::where('id','=',$orderItem->plan_id)->first();
                        if($orderPlan!=null) {
                            $orderPlanPic = $orderPlan->plan->picture;
                            $orderPlanName = $orderPlan->plan->plan_name;
                            $orderType = "Customized";
                            $dt = new Carbon($orderItem->order->created_at);
                            $startOfWeek = $dt->startOfWeek()->addDay(7)->format('F d, Y');
                        }
                    }
                    $thisInput .= '{';
                    $thisInput .= '"id":' . $orderItem->it_id . ', ';
                    $thisInput .= '"plan_name":"' . $orderPlanName . '", ';
                    $thisInput .= '"week":"' . $startOfWeek . '", ';
                    $thisInput .= '"picture":"' . $orderPlanPic . '", ';
                    $thisInput .= '"foodie":"' . $orderItem->order->foodie->first_name.' '.$orderItem->order->foodie->last_name. '", ';
                    $thisInput .= '"type":"' . $orderType . '", ';
                    $thisInput .= '"is_paid":' . $orderItem->order->is_paid . ', ';
                    $thisInput .= '"is_delivered":' . $orderItem->is_delivered . ', ';
                    $thisInput .= '"is_cancelled":' . $orderItem->is_cancelled . ', ';
                    $thisInput .= '"quantity":' . $orderItem->quantity . ', ';
                    $thisInput .= '"created_at":"' . $orderItem->order->created_at->format('F d, Y h:i A') . '", ';
                    $thisInput .= '"price":"' . 'PHP ' . number_format($orderItem->price, 2, '.', ',') . '", ';
                    $thisInput .= '"amount":'.($orderItem->price * $orderItem->quantity).'';
                    if (++$i < $orderItems->count()) {
                        $thisInput .= '},';
                    } else {
                        $thisInput .= '}';
                    }
//                }
                }
                $thisInput .= ']';

                return $thisInput;
            }
        }else if($type==2){

            if($id==0){
                $orderItems = OrderItem::whereHas('order', function ($query) {
                    $query->where('is_cancelled', '=', 0);
                })->join('orders','order_items.order_id','=','orders.id')->orderBy('is_paid','ASC')->where('order_items.is_cancelled','=',0)
                    ->where('order_items.created_at', '>=', $startOfTheWeek)->where('order_items.created_at','<=',$endOfWeek)
                    ->where('chef_id', '=', Auth::guard('chef')->user()->id)
                    ->latest($column='order_items.created_at')
                    ->select('*','order_items.id as it_id')->get();
            }else if($id==1){
                $orderItems = OrderItem::whereHas('order', function ($query) {
                    $query->where('is_cancelled', '=', 0);
                })->where('is_delivered','=',0)->join('orders','order_items.order_id','=','orders.id')->orderBy('is_paid','ASC')->where('order_items.is_cancelled','=',0)
                    ->where('order_items.created_at', '>=', $startOfTheWeek)->where('order_items.created_at','<=',$endOfWeek)
                    ->where('chef_id', '=', Auth::guard('chef')->user()->id)
                    ->latest($column='order_items.created_at')
                    ->select('*','order_items.id as it_id')->get();
            }else if($id==2){
                $orderItems = OrderItem::whereHas('order', function ($query) {
                    $query->where('is_cancelled', '=', 0)
                        ->where('is_paid','=',1);
                })->join('orders','order_items.order_id','=','orders.id')->orderBy('is_paid','ASC')->where('order_items.is_cancelled','=',0)
                    ->where('order_items.created_at', '>=', $startOfTheWeek)->where('order_items.created_at','<=',$endOfWeek)
                    ->where('chef_id', '=', Auth::guard('chef')->user()->id)
                    ->latest($column='order_items.created_at')
                    ->select('*','order_items.id as it_id')->get();
            }else if($id==3){
                $orderItems = OrderItem::join('orders','order_items.order_id','=','orders.id')->orderBy('is_paid','ASC')->where('order_items.is_cancelled','=',1)
                    ->where('order_items.created_at', '>=', $startOfTheWeek)->where('order_items.created_at','<=',$endOfWeek)
                    ->where('chef_id', '=', Auth::guard('chef')->user()->id)
                    ->latest($column='order_items.created_at')
                    ->select('*','order_items.id as it_id')->get();
            }else if($id==4){
                $orderItems = OrderItem::whereHas('order', function ($query) {
                    $query->where('is_cancelled', '=', 0);
                })->where('is_delivered','=',1)->join('orders','order_items.order_id','=','orders.id')->orderBy('is_paid','ASC')->where('order_items.is_cancelled','=',0)
                    ->where('order_items.created_at', '>=', $startOfTheWeek)->where('order_items.created_at','<=',$endOfWeek)
                    ->where('chef_id', '=', Auth::guard('chef')->user()->id)
                    ->latest($column='order_items.created_at')
                    ->select('*','order_items.id as it_id')->get();
            }



            $thisInput = null;
            $i=0;
            if($orderItems->count() >0){
                $thisInput = '[';
                foreach($orderItems as $orderItem){
//                if($orderItem->order->is_cancelled!=1){
                    if($orderItem->order_type==0){
                        $orderPlan = Plan::where('id','=',$orderItem->plan_id)->first();
                        $orderPlanPic = $orderPlan->picture;
                        $orderPlanName = $orderPlan->plan_name;
                        $orderType="Standard";
                        $dt = new Carbon($orderItem->order->created_at);
                        $startOfWeek=$dt->startOfWeek()->addDay(7)->format('F d, Y');
                    }elseif($orderItem->order_type==1){
                        $orderPlan = CustomPlan::where('id','=',$orderItem->plan_id)->first();
                        //                dd($orderPlan);
                        if($orderPlan!=null) {
                            $orderPlanPic = $orderPlan->plan->picture;
                            $orderPlanName = $orderPlan->plan->plan_name;
                            $orderType = "Customized";
                            $dt = new Carbon($orderItem->order->created_at);
                            $startOfWeek = $dt->startOfWeek()->addDay(7)->format('F d, Y');
                        }
                    }elseif($orderItem->order_type==2){
                        $orderPlan = SimpleCustomPlan::where('id','=',$orderItem->plan_id)->first();
                        if($orderPlan!=null) {
                            $orderPlanPic = $orderPlan->plan->picture;
                            $orderPlanName = $orderPlan->plan->plan_name;
                            $orderType = "Customized";
                            $dt = new Carbon($orderItem->order->created_at);
                            $startOfWeek = $dt->startOfWeek()->addDay(7)->format('F d, Y');
                        }
                    }
                    $thisInput .= '{';
                    $thisInput .= '"id":' . $orderItem->it_id . ', ';
                    $thisInput .= '"plan_name":"' . $orderPlanName . '", ';
                    $thisInput .= '"week":"' . $startOfWeek . '", ';
                    $thisInput .= '"picture":"' . $orderPlanPic . '", ';
                    $thisInput .= '"foodie":"' . $orderItem->order->foodie->first_name.' '.$orderItem->order->foodie->last_name. '", ';
                    $thisInput .= '"type":"' . $orderType . '", ';
                    $thisInput .= '"is_paid":' . $orderItem->order->is_paid . ', ';
                    $thisInput .= '"is_delivered":' . $orderItem->is_delivered . ', ';
                    $thisInput .= '"is_cancelled":' . $orderItem->is_cancelled . ', ';
                    $thisInput .= '"quantity":' . $orderItem->quantity . ', ';
                    $thisInput .= '"created_at":"' . $orderItem->order->created_at->format('F d, Y h:i A') . '", ';
                    $thisInput .= '"price":"' . 'PHP ' . number_format($orderItem->price, 2, '.', ',') . '", ';
                    $thisInput .= '"amount":'.($orderItem->price * $orderItem->quantity).'';
                    if (++$i < $orderItems->count()) {
                        $thisInput .= '},';
                    } else {
                        $thisInput .= '}';
                    }
//                }
                }
                $thisInput .= ']';

                return $thisInput;
            }
        }else if($type==3){

            if($id==0){
                $orderItems = OrderItem::whereHas('order', function ($query) {
                    $query->where('is_cancelled', '=', 0);
                })->join('orders','order_items.order_id','=','orders.id')->orderBy('is_paid','ASC')->where('order_items.is_cancelled','=',0)
                    ->where('order_items.created_at', '>=', $startOfMonth)->where('order_items.created_at','<=',$endOfMonth)
                    ->where('chef_id', '=', Auth::guard('chef')->user()->id)
                    ->latest($column='order_items.created_at')
                    ->select('*','order_items.id as it_id')->get();
            }else if($id==1){
                $orderItems = OrderItem::whereHas('order', function ($query) {
                    $query->where('is_cancelled', '=', 0);
                })->where('is_delivered','=',0)->join('orders','order_items.order_id','=','orders.id')->orderBy('is_paid','ASC')->where('order_items.is_cancelled','=',0)
                    ->where('order_items.created_at', '>=', $startOfMonth)->where('order_items.created_at','<=',$endOfMonth)
                    ->where('chef_id', '=', Auth::guard('chef')->user()->id)
                    ->latest($column='order_items.created_at')
                    ->select('*','order_items.id as it_id')->get();
            }else if($id==2){
                $orderItems = OrderItem::whereHas('order', function ($query) {
                    $query->where('is_cancelled', '=', 0)
                        ->where('is_paid','=',1);
                })->join('orders','order_items.order_id','=','orders.id')->orderBy('is_paid','ASC')->where('order_items.is_cancelled','=',0)
                    ->where('order_items.created_at', '>=', $startOfMonth)->where('order_items.created_at','<=',$endOfMonth)
                    ->where('chef_id', '=', Auth::guard('chef')->user()->id)
                    ->latest($column='order_items.created_at')
                    ->select('*','order_items.id as it_id')->get();
            }else if($id==3){
                $orderItems = OrderItem::join('orders','order_items.order_id','=','orders.id')->orderBy('is_paid','ASC')->where('order_items.is_cancelled','=',1)
                    ->where('order_items.created_at', '>=', $startOfMonth)->where('order_items.created_at','<=',$endOfMonth)
                    ->where('chef_id', '=', Auth::guard('chef')->user()->id)
                    ->latest($column='order_items.created_at')
                    ->select('*','order_items.id as it_id')->get();
            }else if($id==4){
                $orderItems = OrderItem::whereHas('order', function ($query) {
                    $query->where('is_cancelled', '=', 0);
                })->where('is_delivered','=',1)->join('orders','order_items.order_id','=','orders.id')->orderBy('is_paid','ASC')->where('order_items.is_cancelled','=',0)
                    ->where('order_items.created_at', '>=', $startOfMonth)->where('order_items.created_at','<=',$endOfMonth)
                    ->where('chef_id', '=', Auth::guard('chef')->user()->id)
                    ->latest($column='order_items.created_at')
                    ->select('*','order_items.id as it_id')->get();
            }

            $thisInput = null;
            $i=0;
            if($orderItems->count() >0){
                $thisInput = '[';
                foreach($orderItems as $orderItem){
//                if($orderItem->order->is_cancelled!=1){
                    if($orderItem->order_type==0){
                        $orderPlan = Plan::where('id','=',$orderItem->plan_id)->first();
                        $orderPlanPic = $orderPlan->picture;
                        $orderPlanName = $orderPlan->plan_name;
                        $orderType="Standard";
                        $dt = new Carbon($orderItem->order->created_at);
                        $startOfWeek=$dt->startOfWeek()->addDay(7)->format('F d, Y');
                    }elseif($orderItem->order_type==1){
                        $orderPlan = CustomPlan::where('id','=',$orderItem->plan_id)->first();
                        //                dd($orderPlan);
                        if($orderPlan!=null) {
                            $orderPlanPic = $orderPlan->plan->picture;
                            $orderPlanName = $orderPlan->plan->plan_name;
                            $orderType = "Customized";
                            $dt = new Carbon($orderItem->order->created_at);
                            $startOfWeek = $dt->startOfWeek()->addDay(7)->format('F d, Y');
                        }
                    }elseif($orderItem->order_type==2){
                        $orderPlan = SimpleCustomPlan::where('id','=',$orderItem->plan_id)->first();
                        if($orderPlan!=null) {
                            $orderPlanPic = $orderPlan->plan->picture;
                            $orderPlanName = $orderPlan->plan->plan_name;
                            $orderType = "Customized";
                            $dt = new Carbon($orderItem->order->created_at);
                            $startOfWeek = $dt->startOfWeek()->addDay(7)->format('F d, Y');
                        }
                    }
                    $thisInput .= '{';
                    $thisInput .= '"id":' . $orderItem->it_id . ', ';
                    $thisInput .= '"plan_name":"' . $orderPlanName . '", ';
                    $thisInput .= '"week":"' . $startOfWeek . '", ';
                    $thisInput .= '"picture":"' . $orderPlanPic . '", ';
                    $thisInput .= '"foodie":"' . $orderItem->order->foodie->first_name.' '.$orderItem->order->foodie->last_name. '", ';
                    $thisInput .= '"type":"' . $orderType . '", ';
                    $thisInput .= '"is_paid":' . $orderItem->order->is_paid . ', ';
                    $thisInput .= '"is_delivered":' . $orderItem->is_delivered . ', ';
                    $thisInput .= '"is_cancelled":' . $orderItem->is_cancelled . ', ';
                    $thisInput .= '"quantity":' . $orderItem->quantity . ', ';
                    $thisInput .= '"created_at":"' . $orderItem->order->created_at->format('F d, Y h:i A') . '", ';
                    $thisInput .= '"price":"' . 'PHP ' . number_format($orderItem->price, 2, '.', ',') . '", ';
                    $thisInput .= '"amount":'.($orderItem->price * $orderItem->quantity).'';
                    if (++$i < $orderItems->count()) {
                        $thisInput .= '},';
                    } else {
                        $thisInput .= '}';
                    }
//                }
                }
                $thisInput .= ']';

                return $thisInput;
            }
        }else if($type==4){

            if($id==0){
                $orderItems = OrderItem::whereHas('order', function ($query) {
                    $query->where('is_cancelled', '=', 0);
                })->join('orders','order_items.order_id','=','orders.id')->orderBy('is_paid','ASC')->where('order_items.is_cancelled','=',0)
                    ->where('order_items.created_at', '>=', $startOfYear)->where('order_items.created_at','<=',$endOfYear)
                    ->where('chef_id', '=', Auth::guard('chef')->user()->id)
                    ->latest($column='order_items.created_at')
                    ->select('*','order_items.id as it_id')->get();
            }else if($id==1){
                $orderItems = OrderItem::whereHas('order', function ($query) {
                    $query->where('is_cancelled', '=', 0);
                })->where('is_delivered','=',0)->join('orders','order_items.order_id','=','orders.id')->orderBy('is_paid','ASC')->where('order_items.is_cancelled','=',0)
                    ->where('order_items.created_at', '>=', $startOfYear)->where('order_items.created_at','<=',$endOfYear)
                    ->where('chef_id', '=', Auth::guard('chef')->user()->id)
                    ->latest($column='order_items.created_at')
                    ->select('*','order_items.id as it_id')->get();
            }else if($id==2){
                $orderItems = OrderItem::whereHas('order', function ($query) {
                    $query->where('is_cancelled', '=', 0)
                        ->where('is_paid','=',1);
                })->join('orders','order_items.order_id','=','orders.id')->orderBy('is_paid','ASC')->where('order_items.is_cancelled','=',0)
                    ->where('order_items.created_at', '>=', $startOfYear)->where('order_items.created_at','<=',$endOfYear)
                    ->where('chef_id', '=', Auth::guard('chef')->user()->id)
                    ->latest($column='order_items.created_at')
                    ->select('*','order_items.id as it_id')->get();
            }else if($id==3){
                $orderItems = OrderItem::join('orders','order_items.order_id','=','orders.id')->orderBy('is_paid','ASC')->where('order_items.is_cancelled','=',1)
                    ->where('order_items.created_at', '>=', $startOfYear)->where('order_items.created_at','<=',$endOfYear)
                    ->where('chef_id', '=', Auth::guard('chef')->user()->id)
                    ->latest($column='order_items.created_at')
                    ->select('*','order_items.id as it_id')->get();
            }else if($id==4){
                $orderItems = OrderItem::whereHas('order', function ($query) {
                    $query->where('is_cancelled', '=', 0);
                })->where('is_delivered','=',1)->join('orders','order_items.order_id','=','orders.id')->orderBy('is_paid','ASC')->where('order_items.is_cancelled','=',0)
                    ->where('order_items.is_cancelled','=',0)
                    ->where('order_items.created_at', '>=', $startOfYear)->where('order_items.created_at','<=',$endOfYear)
                    ->where('chef_id', '=', Auth::guard('chef')->user()->id)
                    ->latest($column='order_items.created_at')
                    ->select('*','order_items.id as it_id')->get();
            }


            $thisInput = null;
            $i=0;
            if($orderItems->count() >0){
                $thisInput = '[';
                foreach($orderItems as $orderItem){
//                if($orderItem->order->is_cancelled!=1){
                    if($orderItem->order_type==0){
                        $orderPlan = Plan::where('id','=',$orderItem->plan_id)->first();
                        $orderPlanPic = $orderPlan->picture;
                        $orderPlanName = $orderPlan->plan_name;
                        $orderType="Standard";
                        $dt = new Carbon($orderItem->order->created_at);
                        $startOfWeek=$dt->startOfWeek()->addDay(7)->format('F d, Y');
                    }elseif($orderItem->order_type==1){
                        $orderPlan = CustomPlan::where('id','=',$orderItem->plan_id)->first();
                        //                dd($orderPlan);
                        if($orderPlan!=null) {
                            $orderPlanPic = $orderPlan->plan->picture;
                            $orderPlanName = $orderPlan->plan->plan_name;
                            $orderType = "Customized";
                            $dt = new Carbon($orderItem->order->created_at);
                            $startOfWeek = $dt->startOfWeek()->addDay(7)->format('F d, Y');
                        }
                    }elseif($orderItem->order_type==2){
                        $orderPlan = SimpleCustomPlan::where('id','=',$orderItem->plan_id)->first();
                        if($orderPlan!=null) {
                            $orderPlanPic = $orderPlan->plan->picture;
                            $orderPlanName = $orderPlan->plan->plan_name;
                            $orderType = "Customized";
                            $dt = new Carbon($orderItem->order->created_at);
                            $startOfWeek = $dt->startOfWeek()->addDay(7)->format('F d, Y');
                        }
                    }
                    $thisInput .= '{';
                    $thisInput .= '"id":' . $orderItem->it_id . ', ';
                    $thisInput .= '"plan_name":"' . $orderPlanName . '", ';
                    $thisInput .= '"week":"' . $startOfWeek . '", ';
                    $thisInput .= '"picture":"' . $orderPlanPic . '", ';
                    $thisInput .= '"foodie":"' . $orderItem->order->foodie->first_name.' '.$orderItem->order->foodie->last_name. '", ';
                    $thisInput .= '"type":"' . $orderType . '", ';
                    $thisInput .= '"is_paid":' . $orderItem->order->is_paid . ', ';
                    $thisInput .= '"is_delivered":' . $orderItem->is_delivered . ', ';
                    $thisInput .= '"is_cancelled":' . $orderItem->is_cancelled . ', ';
                    $thisInput .= '"quantity":' . $orderItem->quantity . ', ';
                    $thisInput .= '"created_at":"' . $orderItem->order->created_at->format('F d, Y h:i A') . '", ';
                    $thisInput .= '"price":"' . 'PHP ' . number_format($orderItem->price, 2, '.', ',') . '", ';
                    $thisInput .= '"amount":'.($orderItem->price * $orderItem->quantity).'';
                    if (++$i < $orderItems->count()) {
                        $thisInput .= '},';
                    } else {
                        $thisInput .= '}';
                    }
//                }
                }
                $thisInput .= ']';

                return $thisInput;
            }
        }
    }

    public function dayChange($date,$type)
    {
        $dt = Carbon::createFromFormat('Y-m-d', $date);
        $thisDay=$dt->startOfDay();
        $dr = Carbon::createFromFormat('Y-m-d', $date);
        $endDay=$dr->endOfDay();


//        $orders[]= array('id'=>$orderItem->id,'plan_name'=>$orderPlanName,'foodie_id'=>$orderItem->order->foodie_id,'week'=>$startOfWeek,
//            'quantity'=>$orderItem->quantity,'picture'=>$orderPlanPic,'price'=>$orderItem->price,'order_type'=>$orderType,'is_paid'=>$orderItem->order->is_paid,
//            'is_cancelled'=>$orderItem->order->is_cancelled);

        if($type==0){
            $orderItems = OrderItem::whereHas('order', function ($query) {
                $query->where('is_cancelled', '=', 0);
            })->join('orders','order_items.order_id','=','orders.id')->orderBy('is_paid','ASC')->where('order_items.is_cancelled','=',0)
                ->where('order_items.created_at', '>=', $thisDay)->where('order_items.created_at','<=',$endDay)
                ->where('chef_id', '=', Auth::guard('chef')->user()->id)
                ->latest($column='order_items.created_at')->get();
        }else if($type==1){
            $orderItems = OrderItem::whereHas('order', function ($query) {
                $query->where('is_cancelled', '=', 0)
                      ->where('is_delivered','=',0);
            })->join('orders','order_items.order_id','=','orders.id')->orderBy('is_paid','ASC')->where('order_items.is_cancelled','=',0)
                ->where('order_items.created_at', '>=', $thisDay)->where('order_items.created_at','<=',$endDay)
                ->where('chef_id', '=', Auth::guard('chef')->user()->id)
                ->latest($column='order_items.created_at')->get();
        }else if($type==2){
            $orderItems = OrderItem::whereHas('order', function ($query) {
                $query->where('is_cancelled', '=', 0)
                    ->where('is_paid','=',1);
            })->join('orders','order_items.order_id','=','orders.id')->orderBy('is_paid','ASC')->where('order_items.is_cancelled','=',0)
                ->where('order_items.created_at', '>=', $thisDay)->where('order_items.created_at','<=',$endDay)
                ->where('chef_id', '=', Auth::guard('chef')->user()->id)
                ->latest($column='order_items.created_at')->get();
        }else if($type==3){
            $orderItems = OrderItem::whereHas('order', function ($query) {
                $query->where('is_cancelled', '=', 1);
            })->join('orders','order_items.order_id','=','orders.id')->orderBy('is_paid','ASC')->where('order_items.is_cancelled','=',1)
                ->where('order_items.created_at', '>=', $thisDay)->where('order_items.created_at','<=',$endDay)
                ->where('chef_id', '=', Auth::guard('chef')->user()->id)
                ->latest($column='order_items.created_at')->get();
        }else if($type==4){
            $orderItems = OrderItem::whereHas('order', function ($query) {
                $query->where('is_cancelled', '=', 0)
                    ->where('is_delivered','=',1);
            })->join('orders','order_items.order_id','=','orders.id')->orderBy('is_paid','ASC')->where('order_items.is_cancelled','=',0)
                ->where('order_items.created_at', '>=', $thisDay)->where('order_items.created_at','<=',$endDay)
                ->where('chef_id', '=', Auth::guard('chef')->user()->id)
                ->latest($column='order_items.created_at')->get();
        }


        $thisInput = null;
        $i=0;
        if($orderItems->count() >0){
            $thisInput = '[';
            foreach($orderItems as $orderItem){
//                if($orderItem->order->is_cancelled!=1){
                    if($orderItem->order_type==0){
                        $orderPlan = Plan::where('id','=',$orderItem->plan_id)->first();
                        $orderPlanPic = $orderPlan->picture;
                        $orderPlanName = $orderPlan->plan_name;
                        $orderType="Standard";
                        $dt = new Carbon($orderItem->order->created_at);
                        $startOfWeek=$dt->startOfWeek()->addDay(7)->format('F d, Y');
                    }elseif($orderItem->order_type==1){
                        $orderPlan = CustomPlan::where('id','=',$orderItem->plan_id)->first();
        //                dd($orderPlan);
                        if($orderPlan!=null) {
                            $orderPlanPic = $orderPlan->plan->picture;
                            $orderPlanName = $orderPlan->plan->plan_name;
                            $orderType = "Customized";
                            $dt = new Carbon($orderItem->order->created_at);
                            $startOfWeek = $dt->startOfWeek()->addDay(7)->format('F d, Y');
                        }
                    }elseif($orderItem->order_type==2){
                        $orderPlan = SimpleCustomPlan::where('id','=',$orderItem->plan_id)->first();
                        if($orderPlan!=null) {
                            $orderPlanPic = $orderPlan->plan->picture;
                            $orderPlanName = $orderPlan->plan->plan_name;
                            $orderType = "Customized";
                            $dt = new Carbon($orderItem->order->created_at);
                            $startOfWeek = $dt->startOfWeek()->addDay(7)->format('F d, Y');
                        }
                    }
                    $thisInput .= '{';
                    $thisInput .= '"id":' . $orderItem->id . ', ';
                    $thisInput .= '"plan_name":"' . $orderPlanName . '", ';
                    $thisInput .= '"week":"' . $startOfWeek . '", ';
                    $thisInput .= '"picture":"' . $orderPlanPic . '", ';
                    $thisInput .= '"foodie":"' . $orderItem->order->foodie->first_name.' '.$orderItem->order->foodie->last_name. '", ';
                    $thisInput .= '"type":"' . $orderType . '", ';
                    $thisInput .= '"is_paid":' . $orderItem->order->is_paid . ', ';
                    $thisInput .= '"is_delivered":' . $orderItem->is_delivered . ', ';
                    $thisInput .= '"is_cancelled":' . $orderItem->is_cancelled . ', ';
                    $thisInput .= '"quantity":' . $orderItem->quantity . ', ';
                    $thisInput .= '"created_at":"' . $orderItem->order->created_at->format('F d, Y h:i A') . '", ';
                    $thisInput .= '"price":"' . 'PHP ' . number_format($orderItem->price, 2, '.', ',') . '", ';
                    $thisInput .= '"amount":'.($orderItem->price * $orderItem->quantity).'';
                    if (++$i < $orderItems->count()) {
                        $thisInput .= '},';
                    } else {
                        $thisInput .= '}';
                    }
//                }
            }
            $thisInput .= ']';

            return $thisInput;
        }
        return $thisInput;
    }

    public function selectDay($type)
    {
        if($type == 0){
            $orderTime = OrderItem::whereHas('order', function ($query) {
                $query->where('is_cancelled', '=', 0);
            })->where('is_cancelled','=',0)->where('chef_id','=',Auth::guard('chef')->user()->id)->latest()->get();
        }else if($type == 1){
            $orderTime = OrderItem::whereHas('order', function ($query) {
                $query->where('is_cancelled', '=', 0);
            })->where('is_delivered','=',0)->where('is_cancelled','=',0)->where('chef_id','=',Auth::guard('chef')->user()->id)->latest()->get();
        }else if($type == 2){
            $orderTime = OrderItem::whereHas('order', function ($query) {
                $query->where('is_cancelled', '=', 0)
                    ->where('is_paid','=',1);
            })->where('is_cancelled','=',0)->where('chef_id','=',Auth::guard('chef')->user()->id)->latest()->get();
        }else if($type == 3){
            $orderTime = OrderItem::whereHas('order', function ($query) {
                $query->where('is_cancelled', '=', 1);
            })->where('is_cancelled','=',1)->where('chef_id','=',Auth::guard('chef')->user()->id)->latest()->get();
        }else if($type == 4){
            $orderTime = OrderItem::whereHas('order', function ($query) {
                $query->where('is_cancelled', '=', 0);
            })->where('is_delivered','=',1)->where('is_cancelled','=',0)->where('chef_id','=',Auth::guard('chef')->user()->id)->latest()->get();
        }
//        $orderTime = OrderItem::where('chef_id','=',Auth::guard('chef')->user()->id)->latest()->get();
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

    public function getYears(){
        $current = Carbon::now();
        $currentYear = $current->copy()->year;
        $commissions = Commission::orderBy('created_at', 'desc')->get();
        $years = [];
        $years[]=array('current'=>1,'year'=>$currentYear,'yearText'=>$current->format('Y'));
        foreach($commissions as $commission){
            if($commission->created_at->copy()->year < $currentYear){
                $years[]=array('current'=>0,'year'=>$commission->created_at->copy()->year,'yearText'=>$commission->created_at->copy()->format('Y'));
            }
//            $months[]=
//                array('month'=>$commission->created_at->copy()->format('m'),
//                'start'=>$commission->created_at->copy()->startOfMonth(),
//                'end'=>$commission->created_at->copy()->endOfMonth());
        }

        $years = array_intersect_key($years, array_unique(array_map('serialize', $years)));

//        $monthJson = json_encode($months);
        $i=0;
        $yearJson = '[';
        foreach($years as $year){
            $yearJson .='{';
            $yearJson .= '"current":'.$year['current'].', ';
            $yearJson .= '"year":'.$year['year'].', ';
            $yearJson .= '"yearText":"'.$year['yearText'].'"';
            if (++$i < count($years)) {
                $yearJson .= '},';
            } else {
                $yearJson .= '}';
            }
        }
        $yearJson .=']';

        return $yearJson;
    }

    public function getMonths($val)
    {
        $chef = Auth::guard('chef')->user();
        $current = Carbon::now();
        $currentMonth = $current->copy()->month;
        $commissions = Commission::orderBy('created_at', 'desc')->where('chef_id','=',$chef->id)->get();
        if($val<$current->copy()->year){
            $current = Carbon::create($val, 12, 31, 0, 0 ,0);

            $months = [];
            $months[]=array('current'=>0,'month'=>$current->copy()->month,'monthText'=>$current->format('F'));
            foreach($commissions as $commission){
                if($commission->created_at < $current){
                    $months[]=array('current'=>0,'month'=>$commission->created_at->copy()->month,'monthText'=>$commission->created_at->copy()->format('F'));
                }
                //            $months[]=
                //                array('month'=>$commission->created_at->copy()->format('m'),
                //                'start'=>$commission->created_at->copy()->startOfMonth(),
                //                'end'=>$commission->created_at->copy()->endOfMonth());
            }
        }else{
            $months = [];
            $months[]=array('current'=>1,'month'=>$currentMonth,'monthText'=>$current->format('F'));
            foreach($commissions as $commission){
                if($commission->created_at->copy()->month < $currentMonth){
                    $months[]=array('current'=>0,'month'=>$commission->created_at->copy()->month,'monthText'=>$commission->created_at->copy()->format('F'));
                }
                //            $months[]=
                //                array('month'=>$commission->created_at->copy()->format('m'),
                //                'start'=>$commission->created_at->copy()->startOfMonth(),
                //                'end'=>$commission->created_at->copy()->endOfMonth());
            }

        }

        $months = array_intersect_key($months, array_unique(array_map('serialize', $months)));

//        $monthJson = json_encode($months);
        $i=0;
        $monthJson = '[';
        foreach($months as $month){
            $monthJson .='{';
            $monthJson .= '"current":'.$month['current'].', ';
            $monthJson .= '"month":'.$month['month'].', ';
            $monthJson .= '"monthText":"'.$month['monthText'].'"';
            if (++$i < count($months)) {
                $monthJson .= '},';
            } else {
                $monthJson .= '}';
            }
        }
        $monthJson .=']';

        return $monthJson;
    }

    public function monthChange($yearType,$monthType)
    {
        $chef = Auth::guard('chef')->user();
        $year = $yearType;
        $month = $monthType;

        $commissions = Commission::where('chef_id','=',$chef->id)->latest()->get();

        $monthComJson ='';
        if($commissions->count()){
            $comArray = [];
            foreach($commissions as $commission){
                if($commission->created_at->copy()->year == $year && $commission->created_at->copy()->month == $month){
                    $comArray[]= array(
                        'id'=>$commission->id,
                        'name'=>$commission->chef->name,
                        'created_at'=>$commission->created_at->format('F d, Y'),
                        'amount'=>$commission->amount,
                        'chefAmount'=>($commission->amount * 0.9),
                        'dietAmount'=>($commission->amount * 0.1),
                        'paid'=>$commission->paid,
                        'status'=>$commission->order_item->is_cancelled
                    );
                }
            }
            $i=0;
            $monthComJson ='[';
            foreach($comArray as $item){
                $monthComJson .='{';
                $monthComJson .='"id":'.$item['id'].', ';
                $monthComJson .='"name":"'.$item['name'].'", ';
                $monthComJson .='"created_at":"'.$item['created_at'].'", ';
                $monthComJson .='"amount":'.$item['amount'].', ';
                $monthComJson .='"chefAmount":'.$item['chefAmount'].', ';
                $monthComJson .='"dietAmount":'.$item['dietAmount'].', ';
                $monthComJson .='"paid":'.$item['paid'].', ';
                $monthComJson .='"status":'.$item['status'].'';
                if (++$i < count($comArray)) {
                    $monthComJson .= '},';
                } else {
                    $monthComJson .= '}';
                }
            }
            $monthComJson .= ']';
        }

        return $monthComJson;
    }

}
