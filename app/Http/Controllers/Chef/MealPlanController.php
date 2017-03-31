<?php

namespace App\Http\Controllers\Chef;

use App\CustomizedMeal;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Chef\Auth\VerifiesSms;
use App\Ingredient;
use App\Meal;
use App\MealPlan;
use App\Plan;
use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use phpDocumentor\Reflection\Types\Integer;

class MealPlanController extends Controller
{
    use VerifiesSms;

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
        $messages= Message::where('receiver_id','=',Auth::guard('chef')->user()->id)->where('receiver_type','=','c')->get();
        return view('chef.mealplan')->with([
            'sms_unverified' => $this->mobileNumberExists(),
            'chef' => Auth::guard('chef')->user(),
            'plans' => $plans, //get data of meal plan
            'planCount'=>$planCount,
            'plan' => $plan,
            'messages'=>$messages
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
        $mealPlans=$plan->mealplans()->orderByRaw('FIELD(meal_type,"Breakfast","MorningSnack","Lunch","AfternoonSnack","Dinner")')->get();
        $mealPlansCount=$mealPlans->count();
        $ingredientsMeal= '';
        $ingredientCount=DB::table('ingredient_meal')
        ->join('meals','ingredient_meal.meal_id','=','meals.id')
        ->join('meal_plans','meal_plans.meal_id','=','meals.id')
        ->count();

        if($ingredientCount>0){
            $ingredientsMeal=DB::table('ingredients')
            ->join('ingredient_meal','ingredients.NDB_No','=','ingredient_meal.ingredient_id')
            ->join('ingredients_group_description','ingredients.FdGrp_Cd','=','ingredients_group_description.FdGrp_Cd')
            ->join('meals','ingredient_meal.meal_id','=','meals.id')
            ->join('meal_plans','meal_plans.meal_id','=','meals.id')
            ->select('ingredients.Long_Desc','ingredients_group_description.FdGrp_Desc','ingredient_meal.meal_id','ingredient_meal.grams')->get();
        }

        $messages= Message::where('receiver_id','=',Auth::guard('chef')->user()->id)->where('receiver_type','=','c')->get();

        return view('chef.meal_planner', compact('plan'))->with([
            'sms_unverified' => $this->mobileNumberExists(),
            'chef' => Auth::guard('chef')->user(),
            'mealPlans' => $mealPlans,
            'mealPlansCount'=>$mealPlansCount,
            'ingredientsMeal'=>$ingredientsMeal,
            'ingredientCount'=>$ingredientCount,
            'messages'=>$messages
        ]);
    }

    public function getIngredJson($type){

        $categ=$type;
        $data='';

        if($categ=='chicken'){
            $data = DB::table('ingredients')->select('Long_Desc')->where('FdGrp_Cd','~0500~')->get();
        }else if($categ=='pork'){
            $data = DB::table('ingredients')->select('Long_Desc')->where('FdGrp_Cd','~1000~')->get();
        }else if($categ=='beef'){
            $data = DB::table('ingredients')->select('Long_Desc')->where('FdGrp_Cd','~1300~')->get();
        }else if($categ=='fish'){
            $data = DB::table('ingredients')->select('Long_Desc')->where('FdGrp_Cd','~1500~')->get();
        }else if($categ=='vegetables'){
            $data = DB::table('ingredients')->select('Long_Desc')->where('FdGrp_Cd','~1100~')->get();
        }else if($categ=='carbohydrates(baked)'){
            $data = DB::table('ingredients')->select('Long_Desc')
                ->where('FdGrp_Cd','~1800~')
                ->get();
        }else if($categ=='carbohydrates(grains,pasta)'){
            $data = DB::table('ingredients')->select('Long_Desc')
                ->where('FdGrp_Cd','~2000~')
                ->get();
        }


        $ingredCount=$data->count();
        $i=0;
//        dd($ingredCount);
//        dd($ingreds);
        $jsonData='{"data": {';
            foreach($data as $datum){
                if(++$i<$ingredCount) {
                    $jsonData .= '"' . $datum->Long_Desc . '" : null, ';
                }
                else{
                    $jsonData .= '"' . $datum->Long_Desc . '" : null';
                }
            }
        $jsonData.='}, "limit": 3 }';
        $response=$jsonData;
        return $response;
    }

    public function getIngredCount(Meal $meal){
        $meal_ingredientCount=$meal->ingredient_meal()->count();

        $response=$meal_ingredientCount;

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
        $ingredId=[];
//loop starts
            for($i=0;$i<$ingredientCount;$i++){


                $ingredient = $request['ingredients'][$i];

                $ingredId[$i]=DB::table('ingredients')->select('NDB_No')->where('Long_Desc','=',$ingredient)->first();
//                dd($ingredId[$i]->NDB_No);
//                $val = DB::table('ingredients')->select('calories','protein','carbohydrates','fat')->where('description','=',$ingredient)->first();
                $ingredCal=DB::table('ingredients_nutrient_data')->select('Nutr_Val')
                    ->where('NDB_No','=',$ingredId[$i]->NDB_No)
                    ->where('Nutr_No','=','~208~')->first();
                $ingredPro=DB::table('ingredients_nutrient_data')->select('Nutr_Val')
                    ->where('NDB_No','=',$ingredId[$i]->NDB_No)
                    ->where('Nutr_No','=','~203~')->first();
                $ingredFat=DB::table('ingredients_nutrient_data')->select('Nutr_Val')
                    ->where('NDB_No','=',$ingredId[$i]->NDB_No)
                    ->where('Nutr_No','=','~204~')->first();
                $ingredCarb=DB::table('ingredients_nutrient_data')->select('Nutr_Val')
                    ->where('NDB_No','=',$ingredId[$i]->NDB_No)
                    ->where('Nutr_No','=','~205~')->first();
                $grams = $request['grams'][$i];
                $cal = $ingredCal->Nutr_Val * .01 * $grams;
                $pro = $ingredPro->Nutr_Val * .01 * $grams;
                $fat = $ingredFat->Nutr_Val * .01 * $grams;
                $carb = $ingredCarb->Nutr_Val * .01 * $grams;
                $meal->calories += $cal;
                $meal->carbohydrates += $carb;
                $meal->protein += $pro;
                $meal->fat += $fat;
            }
//loop ends
        $meal->save();

        for($i=0;$i<$ingredientCount;$i++){
            DB::table('ingredient_meal')->insert(
                ['meal_id' => $meal->id, 'ingredient_id' => $ingredId[$i]->NDB_No, 'grams' => $request['grams'][$i]]
            );
        }
        DB::table('meal_plans')->insert(
            ['plan_id' => $plan->id, 'meal_id' => $meal->id, 'customized_meal_id' =>$meal->id, 'day' => $request['day'], 'meal_type' => $request['meal_type']]
        );

        return back();


    }

    //modal that pops up to update meal in meal plan

    public function updateMeal(Meal $meal, Request $request)
    {
        $ingredId=[];
        $meal->description = $request['description'];
        $meal->main_ingredient = $request['main_ingredient'];
        $ingredientCountUpdate=count($request['ingredients']);
        $updateCalories = 0;
        $updateCarbohydrates = 0;
        $updateProtein = 0;
        $updateFat = 0;
        $prevIngreds = DB::table('ingredient_meal')->select('ingredient_id')->where('meal_id','=',$meal->id)->get();
//        dd($prevIngreds);
        for($i=0;$i<$ingredientCountUpdate;$i++){
            $ingredient = $request['ingredients'][$i];

            $ingredId[$i]=DB::table('ingredients')->select('NDB_No')->where('Long_Desc','=',$ingredient)->first();
//                dd($ingredId[$i]->NDB_No);
//                $val = DB::table('ingredients')->select('calories','protein','carbohydrates','fat')->where('description','=',$ingredient)->first();
            $ingredCal=DB::table('ingredients_nutrient_data')->select('Nutr_Val')
                ->where('NDB_No','=',$ingredId[$i]->NDB_No)
                ->where('Nutr_No','=','~208~')->first();
            $ingredPro=DB::table('ingredients_nutrient_data')->select('Nutr_Val')
                ->where('NDB_No','=',$ingredId[$i]->NDB_No)
                ->where('Nutr_No','=','~203~')->first();
            $ingredFat=DB::table('ingredients_nutrient_data')->select('Nutr_Val')
                ->where('NDB_No','=',$ingredId[$i]->NDB_No)
                ->where('Nutr_No','=','~204~')->first();
            $ingredCarb=DB::table('ingredients_nutrient_data')->select('Nutr_Val')
                ->where('NDB_No','=',$ingredId[$i]->NDB_No)
                ->where('Nutr_No','=','~205~')->first();
            $grams = $request['grams'][$i];
            $cal = $ingredCal->Nutr_Val * .01 * $grams;
            $pro = $ingredPro->Nutr_Val * .01 * $grams;
            $fat = $ingredFat->Nutr_Val * .01 * $grams;
            $carb = $ingredCarb->Nutr_Val * .01 * $grams;
            $updateCalories += $cal;
            $updateCarbohydrates += $carb;
            $updateProtein += $pro;
            $updateFat += $fat;
        }
//            dd($updateFat);

        $meal->calories = $updateCalories;
        $meal->carbohydrates = $updateCarbohydrates;
        $meal->protein = $updateProtein;
        $meal->fat = $updateFat;
//        dd($meal->calories);
        $meal->save();

        for($i=0;$i<$ingredientCountUpdate;$i++){
            DB::table('ingredient_meal')->where('meal_id','=',$meal->id)->where('ingredient_id','=',$prevIngreds[$i]->ingredient_id)->update(
                ['meal_id' => $meal->id, 'ingredient_id' => $ingredId[$i]->NDB_No, 'grams' => $request['grams'][$i]]
            );
        }

        return back();
    }

    //modal that pops up to delete meal in meal plan

    public function deleteMeal(Meal $meal)
    {
        $mealPlan= $meal->mealplan->first();
        $ingredient_mealDeletes= $meal->ingredient_meal()->get();

//        dd($mealPlan);
        $mealPlan->delete();
        foreach ($ingredient_mealDeletes as $mealDelete){
            $mealDelete->where('meal_id','=',$meal->id)->delete();
        }
        $meal->delete();
        return back();
    }
}
