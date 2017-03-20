<?php

namespace App\Http\Controllers\Foodie;

use App\CustomizedIngredientMeal;
use App\CustomizedMeal;
use App\Http\Controllers\Controller;
use App\Chef;
use App\Meal;
use App\MealPlan;
use App\Plan;
use App\Http\Controllers\Foodie\Auth\VerifiesSms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use phpDocumentor\Reflection\Types\Integer;


class FoodieMealPlanController extends Controller
{
    use VerifiesSms;


    public function __construct()
    {
        $this->middleware('foodie.auth');
    }

    public function viewChefs(){
        $chefs=Chef::all();
        return view('foodie.chefselect')->with([
            'sms_unverified' => $this->smsIsUnverified(),
            'foodie'=>Auth::guard('foodie')->user(),
            'chefs'=>$chefs
        ]);
    }

    public function viewChefsPlans($id){
        $chefPlans=Plan::where('chef_id', $id)->get();
        $chefsPlanCount= $chefPlans->count();
        return view('foodie.planSelect')->with([
            'sms_unverified' => $this->smsIsUnverified(),
            'foodie'=>Auth::guard('foodie')->user(),
            'plans' => $chefPlans,
            'planCount'=>$chefsPlanCount
        ]);
    }

    public function viewChefsMeals(Plan $plan){
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



        return view('foodie.mealCustomize', compact('plan'))->with([
            'sms_unverified' => $this->smsIsUnverified(),
            'foodie'=>Auth::guard('foodie')->user(),
            'mealPlans' => $mealPlans,
            'mealPlansCount'=>$mealPlansCount,
            'ingredientsMeal'=>$ingredientsMeal,
            'ingredientCount'=>$ingredientCount,
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

    public function customizeChefsMeals(Meal $meal, Request $request){
        $ingredId=[];
        $user=Auth::guard('foodie')->user()->id;
        $main_ingredient = $request['main_ingredient'];
        $ingredientCountUpdate=count($request['ingredients']);
        $updateCalories = 0;
        $updateCarbohydrates = 0;
        $updateProtein = 0;
        $updateFat = 0;
        $prevIngreds = DB::table('ingredient_meal')->select('ingredient_id')->where('meal_id','=',$meal->id)->get();
//        dd($meal);
        for($i=0;$i<$ingredientCountUpdate;$i++){
            $ingredient = $request['ingredients'][$i];

            $ingredId[$i]=DB::table('ingredients')->select('NDB_No')->where('Long_Desc','=',$ingredient)->first();
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
//            dd($meal->id);

        $caloriesUpdate = $updateCalories;
        $carbohydratesUpdate = $updateCarbohydrates;
        $proteinUpdate = $updateProtein;
        $fatUpdate = $updateFat;



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
