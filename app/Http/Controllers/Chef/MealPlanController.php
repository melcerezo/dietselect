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
        $ingredients = DB::table('ingredients')->select('id','calories', 'protein', 'fat', 'carbohydrates', 'description')->limit(5)->get();
        $mealPlans=$plan->mealplans()->get();
        $mealPlansCount=$mealPlans->count();
        $ingredientsMeal= '';
        $ingredientCount=DB::table('ingredient_meal')
        ->join('meals','ingredient_meal.meal_id','=','meals.id')
        ->join('meal_plans','meal_plans.meal_id','=','meals.id')
        ->count();

        if($ingredientCount>0){
            $ingredientsMeal=DB::table('ingredients')
            ->join('ingredient_meal','ingredients.id','=','ingredient_meal.ingredient_id')
            ->join('meals','ingredient_meal.meal_id','=','meals.id')
            ->join('meal_plans','meal_plans.meal_id','=','meals.id')
            ->select('ingredients.description','ingredient_meal.meal_id','ingredient_meal.grams')->get();
        }
        return view('chef.meal_planner', compact('plan'))->with([
            'chef' => Auth::guard('chef')->user(),
            'mealPlans' => $mealPlans,
            'mealPlansCount'=>$mealPlansCount,
            'ingredients' => $ingredients,
            'ingredientsMeal'=>$ingredientsMeal,
            'ingredientCount'=>$ingredientCount,
        ]);
    }

    public function getIngredJson(){
        $data = DB::table('ingredients')->select('id','description')->limit(5)->get()->toJson();

        $ingreds=json_decode($data, true);
        $ingredCount=count($ingreds);
        $i=0;
//        dd($ingredCount);
//        dd($ingreds);
        $jsonData='{"data": {';
            foreach($ingreds as $ingred){
                if(++$i<$ingredCount) {
                    $jsonData .= '"' . $ingred["description"] . '" : null, ';
                }else{
                    $jsonData .= '"' . $ingred["description"] . '" : null';
                }
            }
        $jsonData.='}, "limit":20}';
        $response=$jsonData;

        return $response;
    }

    // modal that pops up to create meal in meal plan

    public function setMeal(Request $request, Plan $plan)
    {
        $meal = new Meal();
        $meal->chef_id = Auth::guard('chef')->user()->id;
        $meal->description = $request['description'];
        $meal->main_ingredient = $request['main_ingredient'];
        $meal->calories = 0;
        $meal->carbohydrates = 0;
        $meal->protein = 0;
        $meal->fat = 0;
        $ingredientCount=count($request['ingredients']);
//loop starts
            for($i=0;$i<$ingredientCount;$i++){


                $ingredient = $request['ingredients'][$i];

                $val = Ingredient::where('id', '=', $ingredient)->first();
                $grams = $request['grams'][$i];
                $cal = $val->calories * .01 * $grams;
                $pro = $val->protein * .01 * $grams;
                $fat = $val->fat * .01 * $grams;
                $car = $val->carbohydrates * .01 * $grams;
                $meal->calories += $cal;
                $meal->carbohydrates += $car;
                $meal->protein += $pro;
                $meal->fat += $fat;
            }
//loop ends
        $meal->save();
        for($i=0;$i<$ingredientCount;$i++){
            DB::table('ingredient_meal')->insert(
                ['meal_id' => $meal->id, 'ingredient_id' => $request['ingredients'][$i], 'grams' => $request['grams'][$i]]
            );
        }
        DB::table('meal_plans')->insert(
            ['plan_id' => $plan->id, 'meal_id' => $meal->id, 'day' => $request['day'], 'meal_type' => $request['meal_type']]
        );

        return back();


    }

    //modal that pops up to update meal in meal plan

    public function updateMeal(Meal $meal, Request $request)
    {


        return back();
    }

    //modal that pops up to delete meal in meal plan

    public function deleteMeal(Meal $meal)
    {
        $meal->delete();
        return back();
    }
}
