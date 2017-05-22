<?php

namespace App\Http\Controllers\Chef;

use App\Chat;
use App\CustomizedMeal;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Chef\Auth\VerifiesSms;
use App\Ingredient;
use App\Meal;
use App\MealPlan;
use App\Plan;
use App\Message;
use Carbon\Carbon;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use phpDocumentor\Reflection\Types\Integer;

class MealPlanController extends Controller
{
    use VerifiesSms;
    protected $redirectTo = '/chef/plan';
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
        $chef= Auth::guard('chef')->user()->id;

        $chats= Chat::where('chef_id','=',$chef)->latest($column = 'updated_at')->get();

        $dt = Carbon::now();
        $currentPlans = $dt->isLastWeek();

        // 2 Weeks ago
        $pastWeekPlans = $dt->diffInWeeks(2);

        $currentTime = $dt->format('H:i:A');
        $endTime = Carbon::create($dt->year, $dt->month, $dt->day, 15, 0, 0)->format('H:i:A');

        $startOfTheWeek = $dt->startOfWeek()->format('Y-m-d');
        $endOfTheWeek = $dt->endOfWeek()->format('Y-m-d');

        # QUERY FOR THE UPCOMING PLANS
        /**
         *  PLANS CREATED THIS WEEK
         */

        $plans=Plan::where('chef_id', Auth::guard('chef')->user()->id)
            ->where('created_at', '>=', $startOfTheWeek )
            ->where('created_at', '<=', $endOfTheWeek)
            ->get();

        # QUERY FOR THE PRESENT PLANS
        /**
         *  PLANS CREATED LAST WEEK
         */

        # QUERY FOR THE PAST PLANS
        /**
         *  PLANS CREATED BEFORE LAST WEEK
         *  LIMIT TO (5) FIVE
         */


        $planCount= $plans->count();
        $messages= Message::where('receiver_id','=',Auth::guard('chef')->user()->id)->where('receiver_type','=','c')->get();
        return view('chef.mealplan')->with([
            'sms_unverified' => $this->mobileNumberExists(),
            'chef' => Auth::guard('chef')->user(),
            'plans' => $plans, //get data of meal plan
            'planCount'=>$planCount,
            'plan' => $plan,
            'messages'=>$messages,
            'chats' => $chats,
            'currentTime' => $currentTime,
            'endTime' => $endTime,
            'startOfTheWeek' => $startOfTheWeek,
            'endOfTheWeek' => $endOfTheWeek,
        ]);
    }

    public function createPlan(Request $request)
    {
        Validator::make($request->all(), [
            'plan_name' => 'required|max:100',
            'calories' =>'required',
            'price' =>'required'
        ])->validate();

        $plan= new Plan();
        $plan->chef_id = Auth::guard('chef')->user()->id;
        $plan->plan_name = $request['plan_name'];
        $plan->calories= (int)$request['calories'];
        $plan->price= (float)$request['price'];
        $plan->save();
        return redirect($this->redirectTo)->with(['status'=>'Successfully created plan: '.$plan->plan_name.'']);

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
        }else if($categ=='dairy,eggs') {
            $data = DB::table('ingredients')->select('Long_Desc')
                ->where('FdGrp_Cd', '~0100~')
                ->get();
        }else if($categ=='soups,sauces,gravy') {
            $data = DB::table('ingredients')->select('Long_Desc')
                ->where('FdGrp_Cd', '~0600~')
                ->get();
        }else if($categ=='fruits') {
            $data = DB::table('ingredients')->select('Long_Desc')
                ->where('FdGrp_Cd', '~0900~')
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

    public function validateIngredJson($type){

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
        }else if($categ=='dairy,eggs') {
            $data = DB::table('ingredients')->select('Long_Desc')
                ->where('FdGrp_Cd', '~0100~')
                ->get();
        }else if($categ=='soups,sauces,gravy') {
            $data = DB::table('ingredients')->select('Long_Desc')
                ->where('FdGrp_Cd', '~0600~')
                ->get();
        }else if($categ=='fruits') {
            $data = DB::table('ingredients')->select('Long_Desc')
                ->where('FdGrp_Cd', '~0900~')
                ->get();
        }


        $ingredCount=$data->count();
        $i=0;
        $jsonData='[';
        foreach($data as $datum){
            if(++$i<$ingredCount) {
                $jsonData .= '{ "name":"' . $datum->Long_Desc . '"}, ';
            }
            else{
                $jsonData .= '{ "name":"' . $datum->Long_Desc . '"}';
            }
        }
        $jsonData.=']';
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
        $arrayKeys=array_keys($request['ingredients']);
//loop starts
            for($i=0;$i<$ingredientCount;$i++){
//                dd($request['ingredients']);

                $ingredient = $request['ingredients'][$arrayKeys[$i]];

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
                $grams = $request['grams'][$arrayKeys[$i]];
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
                ['meal_id' => $meal->id, 'ingredient_id' => $ingredId[$i]->NDB_No, 'grams' => $request['grams'][$arrayKeys[$i]]]
            );
        }
        DB::table('meal_plans')->insert(
            ['plan_id' => $plan->id, 'meal_id' => $meal->id, 'customized_meal_id' =>$meal->id, 'day' => $request['day'], 'meal_type' => $request['meal_type']]
        );

        return back()->with(['status'=>'Successfully created meal: '.$meal->description.'']);


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
        $arrayKeys=array_keys($request['ingredients']);
//        dd($arrayKeys);
        for($i=0;$i<$ingredientCountUpdate;$i++){
            $ingredient = $request['ingredients'][$arrayKeys[$i]];
//            dd($ingredient);

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
//        dd($request[]);
//            dd($updateFat);

        $meal->calories = $updateCalories;
        $meal->carbohydrates = $updateCarbohydrates;
        $meal->protein = $updateProtein;
        $meal->fat = $updateFat;
//        dd($meal->calories);
        $meal->save();

        for($i=0;$i<$ingredientCountUpdate;$i++){
            DB::table('ingredient_meal')->where('meal_id','=',$meal->id)->where('ingredient_id','=',$prevIngreds[$i]->ingredient_id)->update(
                ['meal_id' => $meal->id, 'ingredient_id' => $ingredId[$i]->NDB_No, 'grams' => $request['grams'][$arrayKeys[$i]]]
            );
        }

        return back()->with(['status'=>'Successfully updated meal '.$meal->description.'!']);
    }

    public function deletePlan(Plan $plan){
        $plan->delete();

        return redirect($this->redirectTo)->with(['status'=>'Successfully deleted the plan!']);
    }

    public function deleteMeal(Meal $meal)
    {

        $mealPlan= $meal->mealplan->first();
        $ingredient_mealDeletes= $meal->ingredient_meal()->get();

        foreach ($ingredient_mealDeletes as $mealDelete){
            $mealDelete->where('meal_id','=',$meal->id)->delete();
        }
        $meal->delete();
        $mealPlan->delete();
        return back()->with(['status'=>'Successfully deleted the meal!']);
    }
}
