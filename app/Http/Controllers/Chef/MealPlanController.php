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
        $plans = Plan::where('chef_id', Auth::guard('chef')->user())->get();
        return view('chef.mealplan')->with([
            'chef' => Auth::guard('chef')->user(),
            'plan' => $plans //get data of meal plan
        ]);

    }

    public function prepareMealsPage(Plan $plan)
    {
//        $list = Ingredient::all();
//        $ingredients = $list->take(10);

        $ingredients = DB::table('ingredients')->select('calories', 'protein', 'fat', 'carbohydrates', 'description')->limit(1)->get();
//        foreach ($ingredients as $ingredient) :
//            echo 'Calories:'. $ingredient->calories * 0.01 .'<br>';
//            echo 'Protein:'. $ingredient->protein * 0.01 .'<br>';
//            echo 'Fat:'. $ingredient->fat * 0.01 .'<br>';
//            echo 'Carbohydrates:'. $ingredient->carbohydrates * 0.01 .'<br><br>';
//        endforeach;
//
//        die();


        $mealPlans = $plan->mealplans()->get();
        return view('chef.meal_planner')->with([
            'chef' => Auth::guard('chef')->user(),
            'mealPlans' => $mealPlans,
            'ingredients' => $ingredients,
        ]);


    }

    // modal that pops up to create meal in meal plan

//$id,
    public function setMeal(Request $request)
    {


//        $newMeal= new Meal(['chef_id'=> Auth::guard('chef')->user(),'description'=>,'main_ingredient'=>,'calories'=>,'carbohydrates'=>,'protein'=>,'fat'=>,]);
        // Creation of Meal
        $meal = new Meal();
        $meal->chef_id = Auth::guard('chef')->user()->id;
        $meal->description = $request['description'];
        $meal->main_ingredient = 'test_ingredient';
        $meal->calories = 10;
        $meal->carbohydrates = 10;
        $meal->protein = 10;
        $meal->fat = 10;
//        dd($meal);
        $meal->save();
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
