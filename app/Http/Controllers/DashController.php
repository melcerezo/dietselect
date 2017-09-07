<?php

namespace App\Http\Controllers;

use App\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashController extends Controller
{
    public function loadInfo()
    {
        return view('testMaterializeTemplates.testDashboard');
    }
    public function loadMessage()
    {
        return view('testMaterializeTemplates.testMessage');
    }
    public function loadMealPlanner(){

//        $plan=Plan::where('chef_id','=',1)->where('id','=',1)->first();
//        $mealPlan=$plan->mealplans()->orderByRaw('FIELD(meal_type,"Breakfast","MorningSnack","Lunch","AfternoonSnack","Dinner")')->get();
//        $mealPlansCount=$mealPlan->count();
//        $ingredientsMeal= '';
//        $ingredientCount=DB::table('ingredient_meal')
//            ->join('meals','ingredient_meal.meal_id','=','meals.id')
//            ->join('meal_plans','meal_plans.meal_id','=','meals.id')
//            ->count();
//
//        if($ingredientCount>0){
//            $ingredientsMeal=DB::table('ingredients')
//                ->join('ingredient_meal','ingredients.NDB_No','=','ingredient_meal.ingredient_id')
//                ->join('ingredients_group_description','ingredients.FdGrp_Cd','=','ingredients_group_description.FdGrp_Cd')
//                ->join('meals','ingredient_meal.meal_id','=','meals.id')
//                ->join('meal_plans','meal_plans.meal_id','=','meals.id')
//                ->select('ingredients.Long_Desc','ingredients_group_description.FdGrp_Desc','ingredient_meal.meal_id','ingredient_meal.grams')->get();
//        }

        return view('testMaterializeTemplates.testMealPlanner');
//            ->with([
//            'plan'=>$plan,
//            'mealPlans' => $mealPlan,
//            'mealPlansCount'=>$mealPlansCount,
//            'ingredientsMeal'=>$ingredientsMeal,
//            'ingredientCount'=>$ingredientCount
//        ]);
    }
}
