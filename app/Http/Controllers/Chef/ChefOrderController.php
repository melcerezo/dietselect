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
        $orders=DB::table('order_items')->join('orders','orders.id','=','order_items.order_id')
            ->join('plans','plans.id','=','order_items.plan_id')
            ->where('plans.chef_id','=',$chef->id)
            ->where('orders.is_paid','=',1)
            ->where('orders.is_cancelled','=',0)
            ->select('order_items.id','plans.plan_name','order_items.quantity','orders.foodie_id','orders.address_id',
                'order_items.order_type','order_items.created_at','order_items.updated_at')
            ->get();

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
//        dd($orderItem);
        $chef = Auth::guard('chef')->user();
        $chats= Chat::where('chef_id','=',$chef->id)->latest($column = 'updated_at')->get();
        $foodies=Foodie::all();
        $messages= Message::where('receiver_id','=',Auth::guard('chef')->user()->id)->where('receiver_type','=','c')->where('is_read','=',0)->get();
        $orderMealPlans = [];
        $ingredientMeals=[];
        $orderMealPlans="";
        if($orderItem->order_type==0){
            $orderPlan=Plan::where('id','=',$orderItem->plan_id)->first();
            $mealPlans=$orderPlan->mealplans()->get();
            foreach($mealPlans as $item){
                $orderMealPlans[]= $item->chefcustomize;
            }
            dd($orderMealPlans[0]->mealplans[0]->day);
        }elseif($orderItem->order_type==1){
            $orderPlan=CustomPlan::where('id','=',$orderItem->plan_id)->first();
            $orderMealPlans=$orderPlan->customized_meal()->get();
            dd($orderMealPlans);
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
            'mealPlans'=>$orderMealPlans,
            'ingredientsMeal'=>$ingredientMeals,
            'orderItem'=>$orderItem,
            'notifications' => $notifications
        ]);
    }
}
