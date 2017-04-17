<?php

namespace App\Http\Controllers\Chef;

use App\Http\Controllers\Controller;

use App\CustomizedMeal;
use App\Http\Controllers\Chef\Auth\VerifiesSms;
use App\Order;
use App\Message;
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
        $orders='';
        $ordersCount=Order::where('chef_id','=',$chef->id)->get()->count();

        if($ordersCount>0){
            $orders=Order::where('chef_id','=',$chef->id)->get();
        }

        $messages = Message::where('receiver_id', '=', Auth::guard('chef')->user()->id)->where('receiver_type', '=', 'f')->get();


        return view('chef.showAllOrders')->with([
            'sms_unverified' => $this->mobileNumberExists(),
            'chef'=>$chef,
            'orders'=>$orders,
            'ordersCount'=>$ordersCount,
            'messages'=>$messages
        ]);
    }

    public function getOneOrderDetails(Order $order){
        $chef = Auth::guard('chef')->user();
        $messages = Message::where('receiver_id', '=', Auth::guard('chef')->user()->id)->where('receiver_type', '=', 'f')->get();
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

        return view('chef.showSingleOrder')->with([
            'sms_unverified' => $this->mobileNumberExists(),
            'chef'=>$chef,
            'messages'=>$messages,
            'mealPlans'=>$orderMealPlans,
            'mealPlansCount'=>$orderMealPlansCount,
            'customize'=>$orderCustomizedMeals,
            'ingredientsMeal'=>$ingredientMealData,
            'ingredientCount'=>$ingredientCount
        ]);
    }
}
