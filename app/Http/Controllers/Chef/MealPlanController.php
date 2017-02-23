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

    public function getMealPlanPage()


    {
        $plans=Plan::where('chef_id', Auth::guard('chef')->user()->id)->get();
        $planCount= $plans->count();
        return view('chef.mealplan')->with([
            'chef' => Auth::guard('chef')->user(),
            'plans' => $plans, //get data of meal plan
            'planCount'=>$planCount
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
    }

    public function prepareMealsPage(Plan $plan)
    {
//        $list = Ingredient::all();
//        $ingredients = $list->take(10);

        $ingredients = DB::table('ingredients')->select('id','calories', 'protein', 'fat', 'carbohydrates', 'description')->limit(5)->get();
//        foreach ($ingredients as $ingredient) :
//            echo 'Calories:'. $ingredient->calories * 0.01 .'<br>';
//            echo 'Protein:'. $ingredient->protein * 0.01 .'<br>';
//            echo 'Fat:'. $ingredient->fat * 0.01 .'<br>';
//            echo 'Carbohydrates:'. $ingredient->carbohydrates * 0.01 .'<br><br>';
//        endforeach;
//
//        die();

        $mealPlans=$plan->mealplans()->get();
        $mealPlansCount=$mealPlans->count();
//        dd($mealPlansCount);
        return view('chef.meal_planner')->with([
            'chef' => Auth::guard('chef')->user(),
            'mealPlans' => $mealPlans,
            'mealPlansCount'=> $mealPlansCount,
            'ingredients' => $ingredients
        ]);
    }

    // modal that pops up to create meal in meal plan

//$id,
    public function setMeal(Request $request)
    {
        dd($request);

//        $newMeal= new Meal(['chef_id'=> Auth::guard('chef')->user(),'description'=>,'main_ingredient'=>,'calories'=>,'carbohydrates'=>,'protein'=>,'fat'=>,]);
        // Creation of Meal
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
        $meal->save();
        $meal->ingredients()->sync($request['ingredients'], false);
        DB::table('meal_plans')->insert(['day' => $request['day'], 'meal_type' => $request['meal_type']]);
        return back();

//        $plan_id=$id;
//        $newSetMeal= new MealPlan(['plan_id'=>$plan_id,''=>,''=>,''=>,]);


    }

    //modal that pops up to update meal in meal plan

    public function updateMeal(Meal $meal, Request $request)
    {

        $ingredient = Ingredient::where('meal_id', '=', $meal->id)->get();

        $grams = Ingredient::all();
        $grams = $grams->pluck('grams');
        $meal->description = $request['description'];
        $meal->main_ingredient = $request['main_ingredient'];
        $meal->calories = $request['calories'];
        $meal->carbohydrates = $request['carbohydrates'];
        $meal->protein = $request['protein'];
        $meal->fat = $request['fat'];



        $grams = $request['grams'];

        dd($grams);
        // Ingredients select option


        // Select option maybe in the future
        $meal->save();
//        $meal->ingredients()->save($meal);
        $meal->ingredients()->attach($request['ingredient_id'], false);
        return back();
    }

    //modal that pops up to delete meal in meal plan

    public function deleteMeal(Meal $meal)
    {
        $meal->delete();
        return back();
    }
}
