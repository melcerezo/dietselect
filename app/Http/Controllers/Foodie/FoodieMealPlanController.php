<?php

namespace App\Http\Controllers\Foodie;

use App\CustomizedIngredientMeal;
use App\CustomizedMeal;
use App\Http\Controllers\Controller;
use App\Chef;
use App\IngredientMeal;
use App\Meal;
use App\MealPlan;
use App\Plan;
use App\Message;
use App\Http\Controllers\Foodie\Auth\VerifiesSms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use phpDocumentor\Reflection\Types\Integer;


class FoodieMealPlanController extends Controller
{
    use VerifiesSms;
//    line 159 start

    public function __construct()
    {
        $this->middleware('foodie.auth');
    }

    public function viewChefs()
    {
        $messages = Message::where('receiver_id', '=', Auth::guard('foodie')->user()->id)
            ->where('receiver_type', '=', 'f')
            ->get();
        $chefs = Chef::all();

        return view('foodie.chefselect')->with([
            'sms_unverified' => $this->smsIsUnverified(),
            'foodie' => Auth::guard('foodie')->user(),
            'chefs' => $chefs,
            'messages' => $messages
        ]);
    }

    public function viewChefsPlans($id)
    {
        $chefPlans = Plan::where('chef_id', $id)->get();
        $chefsPlanCount = $chefPlans->count();
        $messages = Message::where('receiver_id', '=', Auth::guard('foodie')->user()->id)
            ->where('receiver_type', '=', 'f')
            ->get();
        return view('foodie.planSelect')->with([
            'sms_unverified' => $this->smsIsUnverified(),
            'foodie' => Auth::guard('foodie')->user(),
            'plans' => $chefPlans,
            'planCount' => $chefsPlanCount,
            'messages' => $messages
        ]);
    }

    public function viewChefsMeals(Plan $plan, Request $request)
    {

        $mealPlans = $plan->mealplans()
            ->orderByRaw('FIELD(meal_type,"Breakfast","MorningSnack","Lunch","AfternoonSnack","Dinner")')
            ->get();
        $mealPlansCount = $mealPlans->count();
//        foreach($mealPlans as $mealCust){
//                $customMeal= new CustomizedMeal();
//                $customMeal->meal_id = $mealCust->meal->id;
//                $customMeal->foodie_id = Auth::guard('foodie')->user()->id;
//                $customMeal->description = $mealCust->meal->description;
//                $customMeal->main_ingredient = $mealCust->meal->main_ingredient;
//                $customMeal->calories = $mealCust->meal->calories;
//                $customMeal->carbohydrates = $mealCust->meal->carbohydrates;
//                $customMeal->protein = $mealCust->meal->protein;
//                $customMeal->fat = $mealCust->meal->fat;
//                $customMeal->save();
//
//                $mealCust->customized_meal_id= $customMeal->id;
//                $mealCust->save();
//        }

        $ingredientsMeal = '';
        $ingredientCount = DB::table('ingredient_meal')
            ->join('meals', 'ingredient_meal.meal_id', '=', 'meals.id')
            ->join('meal_plans', 'meal_plans.meal_id', '=', 'meals.id')
            ->count();

        if ($ingredientCount > 0) {
            $ingredientsMeal = DB::table('ingredients')
                ->join('ingredient_meal', 'ingredients.NDB_No', '=', 'ingredient_meal.ingredient_id')
                ->join('ingredients_group_description', 'ingredients.FdGrp_Cd', '=',
                    'ingredients_group_description.FdGrp_Cd')
                ->join('meals', 'ingredient_meal.meal_id', '=', 'meals.id')
                ->join('meal_plans', 'meal_plans.meal_id', '=', 'meals.id')
                ->select('ingredients.Long_Desc', 'ingredients_group_description.FdGrp_Desc', 'ingredient_meal.meal_id',
                    'ingredient_meal.grams')->get();
        }

        $messages = Message::where('receiver_id', '=', Auth::guard('foodie')->user()->id)
            ->where('receiver_type', '=', 'f')
            ->get();

        $ingredId = [];
        $user = Auth::guard('foodie')->user()->id;
        $main_ingredient = $request['main_ingredient'];
        $ingredientCountUpdate = count($request['ingredients']);
        $updateCalories = 0;
        $updateCarbohydrates = 0;
        $updateProtein = 0;
        $updateFat = 0;
//        $prevIngreds = DB::table('ingredient_meal')->select('ingredient_id')->where('meal_id','=',$meal->id)->get();
//        dd($meal);
//            dd($ingredientCountUpdate);


        for ($i = 0; $i < $ingredientCountUpdate; $i++) {
            $ingredient = $request['ingredients'][$i];

            $ingredId[$i] = DB::table('ingredients')->select('NDB_No')->where('Long_Desc', '=', $ingredient)->first();
            $ingredCal = DB::table('ingredients_nutrient_data')->select('Nutr_Val')
                ->where('NDB_No', '=', $ingredId[$i]->NDB_No)
                ->where('Nutr_No', '=', '~208~')->first();
            $ingredPro = DB::table('ingredients_nutrient_data')->select('Nutr_Val')
                ->where('NDB_No', '=', $ingredId[$i]->NDB_No)
                ->where('Nutr_No', '=', '~203~')->first();
            $ingredFat = DB::table('ingredients_nutrient_data')->select('Nutr_Val')
                ->where('NDB_No', '=', $ingredId[$i]->NDB_No)
                ->where('Nutr_No', '=', '~204~')->first();
            $ingredCarb = DB::table('ingredients_nutrient_data')->select('Nutr_Val')
                ->where('NDB_No', '=', $ingredId[$i]->NDB_No)
                ->where('Nutr_No', '=', '~205~')->first();
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

        $caloriesUpdate = $updateCalories;
        $carbohydratesUpdate = $updateCarbohydrates;
        $proteinUpdate = $updateProtein;
        $fatUpdate = $updateFat;

        $mealPlans = MealPlan::where('plan_id', '=', $plan->id)->get();
        $mealId = $mealPlans->pluck('meal_id');
//        dd($mealId);

//    dd($mealIngreds[3]);
        $customId = [];// this array will hold the created customized meal ids

        foreach ($mealPlans as $mealPlan) {
            $customize = new CustomizedMeal();
            $customize->meal_id = $mealPlan->meal->id;
            $customize->foodie_id = $user;
            $customize->description = $mealPlan->meal->description;
            $customize->main_ingredient = $mealPlan->meal->main_ingredient;
            $customize->calories = $mealPlan->meal->calories;
            $customize->carbohydrates = $mealPlan->meal->carbohydrates;
            $customize->protein = $mealPlan->meal->protein;
            $customize->fat = $mealPlan->meal->fat;
            $customize->save();
            $customId[] = $customize->id;//saves the created meal id into $customId
        }

        $mealIngreds = [];
        //makes array of arrays
        for ($i = 0; $i < $mealId->count(); $i++) {
            $mealIngreds[$i] = IngredientMeal::where('meal_id', '=', $mealId[$i])->get();
        }
        for ($i = 0; $i < count($mealIngreds); $i++) {
            foreach ($mealIngreds[$i] as $item) {
                $customizeIngredient = new CustomizedIngredientMeal();
                $customizeIngredient->meal_id = $customId[$i];
                $customizeIngredient->ingredient_id = $item->ingredient_id;
                $customizeIngredient->grams = $item->grams;
                $customizeIngredient->save();
            }
        }

        $customIdString=json_encode($customId);

        return redirect()->route('foodie.meal', compact('plan','customIdString'))->with([//I need the $customId array to be passed into this route.
            'plan'=>$plan,
            'sms_unverified' => $this->smsIsUnverified(),
            'foodie' => Auth::guard('foodie')->user(),
            'mealPlans' => $mealPlans,
            'mealPlansCount' => $mealPlansCount,
            'ingredientsMeal' => $ingredientsMeal,
            'ingredientCount' => $ingredientCount,
            'messages' => $messages,
            'customId'=>array($customId)
        ]);
    }

    public function viewMeal(Plan $plan, $customId)//I need to access the $customId array here
    {
//        dd($id);
        $customList=json_decode($customId);
        $mealPlans = $plan->mealplans()
            ->orderByRaw('FIELD(meal_type,"Breakfast","MorningSnack","Lunch","AfternoonSnack","Dinner")')
            ->get();

        $customize=[];
        $ingredientsMeal = [];
        $ingredientDesc="";
        $ingredientMealData=[];
        $ingredientCount = DB::table('ingredient_meal')
            ->join('meals', 'ingredient_meal.meal_id', '=', 'meals.id')
            ->join('meal_plans', 'meal_plans.meal_id', '=', 'meals.id')
            ->count();
        for($i=0;$i<count($customList);$i++){
          $customize[]=CustomizedMeal::where('id','=',$customList[$i])->first();
          for($j=0;$j<$customize[$i]->customized_ingredient_meal->count();$j++){
              $ingredientsMeal[]=$customize[$i]->customized_ingredient_meal[$j];
          }
//            $customize[]=CustomizedMeal::where('meal_id','=',$mealPlan->meal_id)->first();
        }
        for($i=0;$i<count($ingredientsMeal);$i++){
          $ingredientDesc=DB::table('ingredients')
              ->join('ingredients_group_description','ingredients.FdGrp_Cd','=','ingredients_group_description.FdGrp_Cd')
              ->where('NDB_No','=',$ingredientsMeal[$i]->ingredient_id)
              ->select('ingredients.Long_Desc','ingredients_group_description.FdGrp_Desc')
              ->first();
          $ingredientMealData[]=array(
              "meal"=>$ingredientsMeal[$i]->meal_id,
              "ingredient"=>$ingredientDesc->Long_Desc,
              "ingredient_group"=>$ingredientDesc->FdGrp_Desc,
              "grams"=>$ingredientsMeal[$i]->grams
          );
        }

//        dd($ingredientMealData[0]['grams']);

//        dd($customize);
        $mealPlans = $plan->mealplans()
            ->orderByRaw('FIELD(meal_type,"Breakfast","MorningSnack","Lunch","AfternoonSnack","Dinner")')
            ->get();
        $mealPlansCount = $mealPlans->count();


//        dd($ingredientCount);
        if ($ingredientCount > 0) {



//                    $ingredientsMeal[] = DB::table('ingredients')
//                        ->join('customized_ingredient_meals', 'ingredients.NDB_No', '=', 'customized_ingredient_meals.ingredient_id')
//                        ->join('ingredients_group_description', 'ingredients.FdGrp_Cd', '=', 'ingredients_group_description.FdGrp_Cd')
//                        ->join('customized_meals', 'customized_ingredient_meals.meal_id', '=', 'customized_meals.id')
//                        ->join('meal_plans', 'meal_plans.meal_id', '=', 'customized_meals.meal_id')
//                        ->select('ingredients.Long_Desc', 'ingredients_group_description.FdGrp_Desc', 'customized_ingredient_meals.meal_id',
//                            'customized_ingredient_meals.grams')->where('customized_meals.id','=',$customList[$i])
//                        ->first();

        }


        $messages = Message::where('receiver_id', '=', Auth::guard('foodie')->user()->id)
            ->where('receiver_type', '=', 'f')
            ->get();

//        dd($customize);

//        $customMeals = MealPlan::where('customized_meal_id', '=', $customize->meal_id)->get();
//        dd($customMeals);



        return view('foodie.mealCustomize', compact('plan', 'customize'))->with([
            'sms_unverified' => $this->smsIsUnverified(),
            'foodie' => Auth::guard('foodie')->user(),
            'mealPlans' => $mealPlans,
            'mealPlansCount' => $mealPlansCount,
            'ingredientsMeal' => $ingredientMealData,
            'ingredientCount' => $ingredientCount,
            'messages' => $messages
        ]);
    }

    public function getIngredJson($type)
    {

        $categ = $type;
        $data = '';
        if ($categ == 'chicken') {
            $data = DB::table('ingredients')->select('Long_Desc')->where('FdGrp_Cd', '~0500~')->get();
        } else {
            if ($categ == 'pork') {
                $data = DB::table('ingredients')->select('Long_Desc')->where('FdGrp_Cd', '~1000~')->get();
            } else {
                if ($categ == 'beef') {
                    $data = DB::table('ingredients')->select('Long_Desc')->where('FdGrp_Cd', '~1300~')->get();
                } else {
                    if ($categ == 'fish') {
                        $data = DB::table('ingredients')->select('Long_Desc')->where('FdGrp_Cd', '~1500~')->get();
                    } else {
                        if ($categ == 'vegetables') {
                            $data = DB::table('ingredients')->select('Long_Desc')->where('FdGrp_Cd', '~1100~')->get();
                        } else {
                            if ($categ == 'carbohydrates(baked)') {
                                $data = DB::table('ingredients')->select('Long_Desc')
                                    ->where('FdGrp_Cd', '~1800~')
                                    ->get();
                            } else {
                                if ($categ == 'carbohydrates(grains,pasta)') {
                                    $data = DB::table('ingredients')->select('Long_Desc')
                                        ->where('FdGrp_Cd', '~2000~')
                                        ->get();
                                }
                            }
                        }
                    }
                }
            }
        }

        $ingredCount = $data->count();
        $i = 0;
        $jsonData = '{"data": {';
        foreach ($data as $datum) {
            if (++$i < $ingredCount) {
                $jsonData .= '"' . $datum->Long_Desc . '" : null, ';
            } else {
                $jsonData .= '"' . $datum->Long_Desc . '" : null';
            }
        }
        $jsonData .= '}, "limit": 3 }';
        $response = $jsonData;
        return $response;
    }

    public function customizeChefsMeals(CustomizedMeal $customize, Request $request)
    {

//        dd($request['ingredients']);
        $ingredId = [];
        $user = Auth::guard('foodie')->user()->id;
        $main_ingredient = $request['main_ingredient'];
        $ingredientCountUpdate = count($request['ingredients']);
        $updateCalories = 0;
        $updateCarbohydrates = 0;
        $updateProtein = 0;
        $updateFat = 0;
        $arrayKeys=array_keys($request['ingredients']);
        for ($i = 0; $i < $ingredientCountUpdate; $i++) {
            $ingredient = $request['ingredients'][$arrayKeys[$i]];
//            dd($ingredient);
            $ingredId[$i] = DB::table('ingredients')->select('NDB_No')->where('Long_Desc', '=', $ingredient)->first();
            $ingredCal = DB::table('ingredients_nutrient_data')->select('Nutr_Val')
                ->where('NDB_No', '=', $ingredId[$i]->NDB_No)
                ->where('Nutr_No', '=', '~208~')->first();
            $ingredPro = DB::table('ingredients_nutrient_data')->select('Nutr_Val')
                ->where('NDB_No', '=', $ingredId[$i]->NDB_No)
                ->where('Nutr_No', '=', '~203~')->first();
            $ingredFat = DB::table('ingredients_nutrient_data')->select('Nutr_Val')
                ->where('NDB_No', '=', $ingredId[$i]->NDB_No)
                ->where('Nutr_No', '=', '~204~')->first();
            $ingredCarb = DB::table('ingredients_nutrient_data')->select('Nutr_Val')
                ->where('NDB_No', '=', $ingredId[$i]->NDB_No)
                ->where('Nutr_No', '=', '~205~')->first();
            $grams = $request['grams'][$arrayKeys[$i]];
            $cal = $ingredCal->Nutr_Val * .01 * $grams;
            $pro = $ingredPro->Nutr_Val * .01 * $grams;
            $fat = $ingredFat->Nutr_Val * .01 * $grams;
            $carb = $ingredCarb->Nutr_Val * .01 * $grams;
            $updateCalories += $cal;
            $updateCarbohydrates += $carb;
            $updateProtein += $pro;
            $updateFat += $fat;
        }

        $caloriesUpdate = $updateCalories;
        $carbohydratesUpdate = $updateCarbohydrates;
        $proteinUpdate = $updateProtein;
        $fatUpdate = $updateFat;

//        $cust_id= CustomizedMeal::where('meal_id', '=', $meal->id)->pluck('id')->first();
        $prevIngreds = DB::table('customized_ingredient_meals')->select('ingredient_id')->where('meal_id','=',$customize->id)->get();
        $customize->update([
            'foodie_id' => $user,
            'main_ingredient' => $main_ingredient,
            'calories' => $caloriesUpdate,
            'carbohydrates' => $carbohydratesUpdate,
            'protein' => $proteinUpdate,
            'fat' => $fatUpdate
        ]);
        $customIngred=$customize->customized_ingredient_meal;
//        dd($customIngred);
//        dd($customIngred[1]->id);
//        for($i = 0; $i < $customize->customized_ingredient_meal->count(); $i++){
//            echo $customIngred[$i];
////            echo $ingredId[$i]->NDB_No;
////            echo $request['grams'][$arrayKeys[$i]];
//        }
//        die();
//        $customz = $customIngred[0];
        for ($i = 0; $i < $customize->customized_ingredient_meal->count(); $i++) {
            DB::table('customized_ingredient_meals')->where('id','=',$customIngred[$i]->id)->where('ingredient_id','=',$prevIngreds[$i]->ingredient_id)->update(
                ['meal_id' => $customize->id, 'ingredient_id' => $ingredId[$i]->NDB_No, 'grams' => $request['grams'][$arrayKeys[$i]]]
            );
//            update([
//                'ingredient_id'=>$ingredId[$i]->NDB_No,
//                'grams' => $request['grams'][$arrayKeys[$i]]
//            ]);
//            echo $customIngred[$i]->id . "<br />";
//            echo $customIngred[$i]->ingredient_id . "<br />";
//            echo $customIngred[$i]->grams . "<br />";
        }

//        die();

        return back();
    }


}
