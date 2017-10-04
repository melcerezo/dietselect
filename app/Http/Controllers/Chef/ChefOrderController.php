<?php

namespace App\Http\Controllers\Chef;

use App\ChefCustomizedMeal;
use App\CustomPlan;
use App\Foodie;
use App\Http\Controllers\Controller;

use App\Chat;
use App\CustomizedMeal;
use App\Http\Controllers\Chef\Auth\VerifiesSms;
use App\Notification;
use App\Order;
use App\Message;
use App\OrderItem;
use App\Plan;
use App\MealPlan;
use App\Meal;
use App\IngredientMeal;
use App\SimpleCustomPlan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;



class ChefOrderController extends Controller
{

    use VerifiesSms;


    public function __construct(){
        $this->middleware('chef.auth');
    }

    public function getAllOrdersView($from){

       $orderItems = DB::table('order_items')
        ->join('orders','order_items.order_id','=','orders.id')
            ->where('orders.is_cancelled','=',0)->get();
        dd($orderItems->count());

        $chef = Auth::guard('chef')->user();

        $orderItems=OrderItem::where('chef_id','=', $chef->id)->orderBy('created_at','desc')->get();

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
                $orders[]= array('id'=>$orderItem->id,'plan_name'=>$orderPlanName,'foodie_id'=>$orderItem->order->foodie_id,'week'=>$startOfWeek,
                    'quantity'=>$orderItem->quantity,'picture'=>$orderPlanPic,'price'=>$orderItem->price,'order_type'=>$orderType,'is_paid'=>$orderItem->order->is_paid,
                    'is_cancelled'=>$orderItem->order->is_cancelled);
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
            'orders'=>$orders,
            'from'=>$from,
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
        $orderMealPlans="";
        $saMeals = 0;
        $moSnaMeals = 0;
        $aftSnaMeals = 0;
        $tasteCount= 0;
        $cookCount = 0;
        $driedCount = 0;
        if($orderItem->order_type==0){
            $orderPlan=Plan::where('id','=',$orderItem->plan_id)->first();
            $planName = $orderPlan->plan_name;
            $mealPlans=$orderPlan->mealplans()->get();
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

    public function updateDelivery($id)
    {
        $orderItem = OrderItem::where('id','=',$id)->first();
        $orderItem->is_delivered=1;
        $orderItem->save();

        return redirect()->route('chef.order.single',$orderItem->id)->with(['status'=>'Delivery Status Updated']);
    }

    public function dateChange()
    {
        
    }

    public function dayChange($date)
    {
        $dt = Carbon::createFromFormat('Y-m-d', $date);
        $thisDay=$dt->startOfDay();
        $dr = Carbon::createFromFormat('Y-m-d', $date);
        $endDay=$dr->endOfDay();


//        $orders[]= array('id'=>$orderItem->id,'plan_name'=>$orderPlanName,'foodie_id'=>$orderItem->order->foodie_id,'week'=>$startOfWeek,
//            'quantity'=>$orderItem->quantity,'picture'=>$orderPlanPic,'price'=>$orderItem->price,'order_type'=>$orderType,'is_paid'=>$orderItem->order->is_paid,
//            'is_cancelled'=>$orderItem->order->is_cancelled);
//        $orderItems = OrderItem::with(array('order' => function($query)
//        {
//            $query->where('is_cancelled', '=', 1);
//
//        }))->where('created_at', '>=', $thisDay)->where('created_at','<=',$endDay)
//            ->where('chef_id', '=', Auth::guard('chef')->user()->id)
//            ->latest()->get();

        $orderItems = DB::table('order_items')
            ->join('orders','order_items.order_id','=','orders.id')
        ->where('orders.is_cancelled','=',0)->get();

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
                    $thisInput .= '"quantity":' . $orderItem->quantity . ', ';
                    $thisInput .= '"created_at":"' . $orderItem->order->created_at . '", ';
                    $thisInput .= '"price":"' . 'PHP ' . number_format($orderItem->price, 2, '.', ',') . '"';
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

    public function selectDay()
    {
        $orderTime = OrderItem::where('chef_id','=',Auth::guard('chef')->user()->id)->latest()->get();
//        $yearArray = [];
//        $monthArray =[];
//        $dayArray = [];
        $timeArray =[];
        foreach($orderTime as $item){
//            $yearArray[] = $item->created_at->year;
//            $monthArray[] = $item->created_at->month;
//            $dayArray[] = $item->created_at->day;
            if($item->order->is_cancelled!=1){
                $timeArray[]=date('Y-m-d', strtotime($item->created_at));
            }
        }
        $uniqueTimeArray = array_unique($timeArray);
//        dd($timeArray);
        return $uniqueTimeArray;
    }

}
