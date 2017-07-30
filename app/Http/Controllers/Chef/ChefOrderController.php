<?php

namespace App\Http\Controllers\Chef;

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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;



class ChefOrderController extends Controller
{

    use VerifiesSms;


    public function __construct(){
        $this->middleware('chef.auth');
    }

    public function getAllOrdersView(){

        $chef = Auth::guard('chef')->user();

        $orderItems=OrderItem::where('chef_id','=', $chef->id)->get();

        $orders = [];

        foreach($orderItems as $orderItem){
            if($orderItem->order_type==0){
                $orderPlan = Plan::where('id','=',$orderItem->plan_id)->first();
                $orderPlanName = $orderPlan->plan_name;
                $orderType="Standard";
            }elseif($orderItem->order_type==1){
                $orderPlan = CustomPlan::where('id','=',$orderItem->plan_id)->first();
//                dd($orderPlan);
                $orderPlanName = $orderPlan->plan->plan_name;
                $orderType="Customized";
            }
            $orders[]= array('id'=>$orderItem->id,'plan_name'=>$orderPlanName,'foodie_id'=>$orderItem->order->foodie_id,
                'quantity'=>$orderItem->quantity,'price'=>$orderItem->price,'order_type'=>$orderItem->order_type,'is_paid'=>$orderItem->order->is_paid,
                'is_cancelled'=>$orderItem->order->is_cancelled);
        }

//        dd($orders);

        $chats= Chat::where('chef_id','=',$chef->id)->latest($column = 'updated_at')->get();
        $foodies=Foodie::all();
        $messages= Message::where('receiver_id','=',Auth::guard('chef')->user()->id)->where('receiver_type','=','c')->where('is_read','=',0)->get();
        $notifications=Notification::where('receiver_id','=',$chef->id)->where('receiver_type','=','c')->get();
        return view('chef.showAllOrders')->with([
            'sms_unverified' => $this->mobileNumberExists(),
            'chef'=>$chef,
            'foodies'=>$foodies,
            'orders'=>$orders,
            'chats' => $chats,
            'messages'=>$messages,
            'notifications' => $notifications
        ]);
    }

    public function getOneOrderDetails(OrderItem $orderItem){
        $planName = '';
        $chef = Auth::guard('chef')->user();
        $chats= Chat::where('chef_id','=',$chef->id)->latest($column = 'updated_at')->get();
        $foodies=Foodie::all();
        $messages= Message::where('receiver_id','=',Auth::guard('chef')->user()->id)->where('receiver_type','=','c')->where('is_read','=',0)->get();
        $orderMealPlans = [];
        $ingredientMeals=[];
        $orderMealPlans="";
        if($orderItem->order_type==0){
            $orderPlan=Plan::where('id','=',$orderItem->plan_id)->first();
            $planName = $orderPlan->plan_name;
            $mealPlans=$orderPlan->mealplans()->get();
            foreach($mealPlans as $item){
                $orderMealPlans[]= $item->chefcustomize;
            }
//            dd($orderMealPlans[0]->mealplans->day);
        }elseif($orderItem->order_type==1){
            $orderPlan=CustomPlan::where('id','=',$orderItem->plan_id)->first();
            $planName = $orderPlan->plan->plan_name;
            $orderMealPlans=$orderPlan->customized_meal()->get();
//            dd($orderMealPlans);
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
                        "grams"=>$orderMealIngredient->grams
                    );

                }
            }
//            dd($ingredientMeals);
        }
        $notifications=Notification::where('receiver_id','=',$chef->id)->where('receiver_type','=','c')->get();
//        dd($orderCustomizedMeals);
//        dd($ingredientMealData);

        return view('chef.showSingleOrder')->with([
            'sms_unverified' => $this->mobileNumberExists(),
            'chef'=>$chef,
            'foodies'=>$foodies,
            'chats'=>$chats,
            'messages'=>$messages,
            'planName'=>$planName,
            'mealPlans'=>$orderMealPlans,
            'ingredientsMeal'=>$ingredientMeals,
            'orderItem'=>$orderItem,
            'notifications' => $notifications
        ]);
    }
}
