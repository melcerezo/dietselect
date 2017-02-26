<?php

namespace App\Http\Controllers\Chef;

use App\Http\Controllers\Controller;
use App\Ingredient;
use App\Meal;
use App\MealPlan;
use App\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use phpDocumentor\Reflection\Types\Integer;

class MealPlanController extends Controller
{
    /**
     * Check for chef authentication
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('chef.auth');
    }

    public function getMealPlanPage(Plan $plan)


    {
        $plans=Plan::where('chef_id', Auth::guard('chef')->user()->id)->get();
        $planCount= $plans->count();
        return view('chef.mealplan')->with([
            'chef' => Auth::guard('chef')->user(),
            'plans' => $plans, //get data of meal plan
            'planCount'=>$planCount,
            'plan' => $plan,
        ]);
    }

    public function createPlan(Request $request)
    {
        $plan= new Plan();
        $plan->chef_id = Auth::guard('chef')->user()->id;
        $plan->plan_name = $request['plan_name'];
        $plan->calories= (int)$request['calories'];
        $plan->price= (float)$request['price'];
        $plan->save();
        return back();

        // DONE!
    }

    public function prepareMealsPage(Plan $plan)
    {
//        $meals3=array();
        $ingredients = DB::table('ingredients')->select('id','calories', 'protein', 'fat', 'carbohydrates', 'description')->limit(5)->get();
//        $meals = Meal::take(5);
        $mealPlans=$plan->mealplans()->get();
        $mealPlansCount=$mealPlans->count();
        $ingredientmeals=$plan::with('mealplans.meal.ingredient_meal')->first();
//        $meals2=$ingredientmeals->mealplans;
//
//        if($mealPlans->meal->){
//
//        }
        return view('chef.meal_planner', compact('plan'))->with([
            'chef' => Auth::guard('chef')->user(),
            'mealPlans' => $mealPlans,
            'mealPlansCount'=>$mealPlansCount,
            'ingredients' => $ingredients,
//            'meals3' => $meals3
        ]);
    }

    // modal that pops up to create meal in meal plan

//$id,
    public function setMeal(Request $request, Plan $plan)
    {


        $meal = new Meal();
        $meal->chef_id = Auth::guard('chef')->user()->id;
        $meal->description = $request['description'];
        $meal->main_ingredient = $request['main_ingredient'];
        $ingredient = $request['ingredients'];

        $val = Ingredient::where('id', '=', $ingredient)->first();
        $grams = $request['grams'];
        $cal = $val->calories * .01 * $grams;
        $pro = $val->protein * .01 * $grams;
        $fat = $val->fat * .01 * $grams;
        $car = $val->carbohydrates * .01 * $grams;
        $meal->calories = $cal;
        $meal->carbohydrates = $car;
        $meal->protein = $pro;
        $meal->fat = $fat;

        $meal->save();
        DB::table('meal_plans')->insert(
            ['plan_id' => $plan->id, 'meal_id' => $meal->id, 'day' => $request['day'], 'meal_type' => $request['meal_type']]
        );

        DB::table('ingredient_meal')->insert(
            ['meal_id' => $meal->id, 'ingredient_id' => $request['ingredients'], 'grams' => $grams]
        );

        return back();


    }

    //modal that pops up to update meal in meal plan

    public function updateMeal(Meal $meal, Request $request)
    {
//        $meal


        return back();
    }

    //modal that pops up to delete meal in meal plan

    public function deleteMeal(Meal $meal)
    {
        $meal->delete();
        return back();
    }
}
