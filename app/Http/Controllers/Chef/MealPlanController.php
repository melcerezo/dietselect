<?php

namespace App\Http\Controllers\Chef;

use App\Chat;
use App\ChefCustomizedMeal;
use App\CustomizedMeal;
use App\Foodie;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Chef\Auth\VerifiesSms;
use App\Ingredient;
use App\Meal;
use App\MealPlan;
use App\Notification;
use App\Plan;
use App\Message;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Intervention\Image\Facades\Image;
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
        $foodies=Foodie::all();
        $chats= Chat::where('chef_id','=',$chef)->latest($column = 'updated_at')->get();

        $lastSaturday = Carbon::parse("last saturday 15:00:00")->format('Y-m-d H:i:s');
        # DO NOT REMOVE THIS
        $isSaturday = Carbon::parse("saturday this week 15:00:00")->format('Y-m-d H:i:s');

        $lastTwoWeeks = Carbon::parse("previous week Saturday 15:00:00")->subDays(7)->format('Y-m-d H:i:s');

        /* PAST PLANS
         * Get ALL the plans WHERE updated_at is LESS THAN twoWeeksAGO
         */

        $pastPlans = Plan::where('chef_id', Auth::guard('chef')->user()->id)
            ->where('created_at', '<=', $lastTwoWeeks)
            ->limit(5)
            ->get();

        /* CURRENT PLANS
         *  Get ALL the plans WHERE updated_at is GREATER THAN 2 WEEKS AGO AND
         *  WHERE updated_at is LESS THAN lastSaturday
         */

        $plans = Plan::where('chef_id', Auth::guard('chef')->user()->id)
            ->where('created_at', '>=', $lastTwoWeeks)
            ->where('created_at', '<=', $lastSaturday)
            ->get();

        /* FUTURE PLANS
         * Get ALL the plans WHERE updated_at is GREATER THAN lastWeek
         */
        $futurePlans = Plan::where('chef_id', Auth::guard('chef')->user()->id)
            ->where('created_at', '>=', $lastSaturday)
            ->get();

//        dd($futurePlans[0]->created_at);
//        dd($futurePlans);
        /**
         *  REMOVE THE COMMENT FOR THE LOOP && DD IF YOU
         *  WANT TO SEE THE OUTPUT
         */

//        foreach ($pastPlans as $pastPlan) {
//            echo 'Past Plan:'. $pastPlan->plan_name .'<br><br>';
//        }
//
//        foreach ($plans as $plan) {
//            echo 'Current Plan:'. $plan->plan_name .'<br><br>';
//        }
//
//        foreach ($futurePlans as $futurePlan) {
//            echo 'Future Plan:'. $futurePlan->plan_name .'<br><br>';
//        }
//
//        dd('here');

        $planCount = Plan::count();
        $notifications=Notification::where('receiver_id','=',$chef)->where('receiver_type','=','c')->get();

//        dd($plans);
        $messages= Message::where('receiver_id','=',Auth::guard('chef')->user()->id)->where('receiver_type','=','c')->where('is_read','=',0)->get();
        return view('chef.mealplan')->with([
            'sms_unverified' => $this->mobileNumberExists(),
            'chef' => Auth::guard('chef')->user(),
            'foodies' => $foodies,
            'planCount'=>$planCount,
            'plan' => $plan,
            'messages'=>$messages,
            'chats' => $chats,
            'pastPlans' => $pastPlans, // PAST PLANS
            'plans' => $plans, //get data of meal plan
            'futurePlans' => $futurePlans, // FUTURE PLANS
            'notifications' => $notifications
        ]);
    }

    public function createPlan(Request $request)
    {
        Validator::make($request->all(), [
            'plan_name' => 'required|max:100',
            'calories' =>'required',
            'description'=>'required|max:255',
            'planPic'=>'required',
            'price' =>'required'
        ])->validate();

        $image = $request['planPic'];
        if ($request->hasFile('planPic')) {
//            dd($request['planPic']);
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $originalName = $image->getClientOriginalName();
            Image::make($image)->resize(500, 500)->save(public_path('img/' . $filename));
            $plan = new Plan();
            $plan->chef_id = Auth::guard('chef')->user()->id;
            $plan->plan_name = $request['plan_name'];
            $plan->calories = (int)$request['calories'];
            $plan->description = $request['description'];
            $plan->picture=$filename;
            $plan->price = (float)$request['price'];
            $plan->save();
            return redirect($this->redirectTo)->with(['status' => 'Successfully created plan: ' . $plan->plan_name . '']);
        }

        // DONE!
    }

    public function prepareMealsPage(Plan $plan)
    {
        $foodies= Foodie::all();
        $chef=Auth::guard('chef')->user();
        $chats= Chat::where('chef_id','=',$chef->id)->latest($column = 'updated_at')->get();
        $messages= Message::where('receiver_id','=',Auth::guard('chef')->user()->id)->where('receiver_type','=','c')->where('is_read','=',0)->get();
        $mealPlans=$plan->mealplans()->orderByRaw('FIELD(meal_type,"Breakfast","MorningSnack","Lunch","AfternoonSnack","Dinner")')->get();
        $mealPlansCount=$mealPlans->count();
        $meals= Meal::where('chef_id','=', $chef->id);
        $ingredientsMeal= '';
//        $ingredientCount=DB::table('ingredient_meal')
//        ->join('meals','ingredient_meal.meal_id','=','meals.id')
//        ->join('meal_plans','meal_plans.meal_id','=','meals.id')
//        ->count();
//        $ingredientCount=DB::table('ingredient_meal')
//            ->join('meals','ingredient_meal.meal_id','=','meals.id')
////            ->join('meal_plans','meal_plans.meal_id','=','meals.id')
//            ->get();
//        if($ingredientCount>0){
//            $ingredientsMeal=DB::table('ingredients')
//            ->join('ingredient_meal','ingredients.NDB_No','=','ingredient_meal.ingredient_id')
//            ->join('ingredients_group_description','ingredients.FdGrp_Cd','=','ingredients_group_description.FdGrp_Cd')
//            ->join('meals','ingredient_meal.meal_id','=','meals.id')
//            ->join('meal_plans','meal_plans.meal_id','=','meals.id')
//            ->select('ingredients.Long_Desc','ingredients_group_description.FdGrp_Desc','ingredient_meal.meal_id','ingredient_meal.grams')->get();
            $ingredientsMeal=DB::table('ingredients')
            ->join('chef_customized_ingredient_meals','ingredients.NDB_No','=','chef_customized_ingredient_meals.ingredient_id')
            ->join('ingredients_group_description','ingredients.FdGrp_Cd','=','ingredients_group_description.FdGrp_Cd')
            ->join('chef_customized_meals','chef_customized_ingredient_meals.meal_id','=','chef_customized_meals.id')
//            ->join('meal_plans','meal_plans.meal_id','=','meals.id')
            ->select('ingredients.Long_Desc','ingredients_group_description.FdGrp_Desc','chef_customized_ingredient_meals.meal_id','chef_customized_ingredient_meals.grams')->get();
//        }
//        dd($ingredientsMeal->count());


        $notifications=Notification::where('receiver_id','=',$chef->id)->where('receiver_type','=','c')->get();


        return view('chef.meal_planner', compact('plan'))->with([
            'sms_unverified' => $this->mobileNumberExists(),
            'plan'=>$plan,
            'chef' => $chef,
            'foodies' => $foodies,
            'mealPlans' => $mealPlans,
            'mealPlansCount'=>$mealPlansCount,
            'meals' => $meals,
            'ingredientsMeal'=>$ingredientsMeal,
//            'ingredientCount'=>$ingredientCount,
            'chats' => $chats,
            'messages'=>$messages,
            'notifications' => $notifications
        ]);
    }

    public function getMeals(){
        $chef=Auth::guard('chef')->user()->id;
        $meals = Meal::where('chef_id','=', $chef)->get();
        $i=0;
        $jsonMeal ='[';

        foreach ($meals as $meal){
            if(++$i<$meals->count()) {
                $jsonMeal .= '{ "id":"'.$meal->id.'", "description":"' . $meal->description . '", "main_ingredient":"'.$meal->main_ingredient.'"';
                $jsonMeal .= ', "calories":"'.$meal->calories.'", "carbohydrates":"' . $meal->carbohydrates . '", "protein":"'.$meal->protein.'"';
                $jsonMeal .= ', "fat":"'.$meal->fat.'"}, ';
            }
            else{
                $jsonMeal .= '{ "id":"'.$meal->id.'", "description":"' . $meal->description . '", "main_ingredient":"'.$meal->main_ingredient.'" ';
                $jsonMeal .= ', "calories":"'.$meal->calories.'", "carbohydrates":"' . $meal->carbohydrates . '", "protein":"'.$meal->protein.'" ';
                $jsonMeal .= ', "fat":"'.$meal->fat.'"}';
            }
        }
        $jsonMeal.=']';

        return $jsonMeal;
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

        $customMeal=new ChefCustomizedMeal();
        $customMeal->meal_id=$meal->id;
        $customMeal->chef_id=Auth::guard('chef')->user()->id;
        $customMeal->plan_id=$plan->id;
        $customMeal->description=$request['description'];
        $customMeal->main_ingredient=$request['main_ingredient'];
        $customMeal->calories=$meal->calories;
        $customMeal->carbohydrates=$meal->carbohydrates;
        $customMeal->protein=$meal->protein;
        $customMeal->fat=$meal->fat;
        $customMeal->save();

        $mealPlan=New MealPlan();
        $mealPlan->plan_id=$plan->id;
        $mealPlan->meal_id=$meal->id;
        $mealPlan->customized_meal_id=$customMeal->id;
        $mealPlan->day=$request['dayCreate'];
        $mealPlan->meal_type=$request['meal_typeCreate'];
        $mealPlan->save();

        $customMeal->mealplan_id=$mealPlan->id;
        $customMeal->save();

        for($i=0;$i<$ingredientCount;$i++){
            DB::table('ingredient_meal')->insert(
                ['meal_id' => $meal->id, 'ingredient_id' => $ingredId[$i]->NDB_No, 'grams' => $request['grams'][$arrayKeys[$i]], 'created_at'=>Carbon::now(),'updated_at'=>Carbon::now()]
            );
            DB::table('chef_customized_ingredient_meals')->insert(
                ['meal_id' => $customMeal->id, 'ingredient_id' => $ingredId[$i]->NDB_No, 'grams' => $request['grams'][$arrayKeys[$i]], 'created_at'=>Carbon::now(),'updated_at'=>Carbon::now()]
            );
        }

        return back()->with(['status'=>'Successfully created meal: '.$customMeal->description.'']);

    }

//    public function setUpdatedMeal()
//    {
//
//    }

    public function chooseMeal(Request $request, Plan $plan)
    {
        $day=$request['dayChoose'];
        $meal_type=$request['meal_typeChoose'];
        $meal_id=$request['meal_idChoose'];
        $meal=Meal::where('id','=',$meal_id)->first();
//        dd($meal->ingredient_meal->count());
        $customMeal=new ChefCustomizedMeal();
        $customMeal->meal_id=$meal->id;
        $customMeal->chef_id=Auth::guard('chef')->user()->id;
        $customMeal->plan_id=$plan->id;
        $customMeal->description=$meal->description;
        $customMeal->main_ingredient=$meal->main_ingredient;
        $customMeal->calories=$meal->calories;
        $customMeal->carbohydrates=$meal->carbohydrates;
        $customMeal->protein=$meal->protein;
        $customMeal->fat=$meal->fat;
        $customMeal->save();

        $mealPlan=New MealPlan();
        $mealPlan->plan_id=$plan->id;
        $mealPlan->meal_id=$meal->id;
        $mealPlan->customized_meal_id=$customMeal->id;
        $mealPlan->day=$day;
        $mealPlan->meal_type=$meal_type;
        $mealPlan->save();
        $customMeal->mealplan_id=$mealPlan->id;
        $customMeal->save();

        if($meal->ingredient_meal->count()>0){
            foreach($meal->ingredient_meal as $ingred){
                DB::table('chef_customized_ingredient_meals')->insert(
                    ['meal_id' => $customMeal->id, 'ingredient_id' => $ingred->ingredient_id, 'grams' => $ingred->grams, 'created_at'=>Carbon::now(),'updated_at'=>Carbon::now()]
                );
            }
        }

        return back()->with(['status'=>'Successfully created meal: '.$customMeal->description.'']);
    }

    //modal that pops up to update meal in meal plan

    public function updateMeal(ChefCustomizedMeal $chefCustomizedMeal, Request $request)
    {
//        dd($chefCustomizedMeal);
        $ingredId=[];
        $chefCustomizedMeal->description = $request['description'];
        $chefCustomizedMeal->main_ingredient = $request['main_ingredient'];
        $ingredientCountUpdate=count($request['ingredients']);
        $updateCalories = 0;
        $updateCarbohydrates = 0;
        $updateProtein = 0;
        $updateFat = 0;
        $prevIngreds = DB::table('chef_customized_ingredient_meals')->select('ingredient_id')->where('meal_id','=',$chefCustomizedMeal->id)->get();
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

        $chefCustomizedMeal->calories = $updateCalories;
        $chefCustomizedMeal->carbohydrates = $updateCarbohydrates;
        $chefCustomizedMeal->protein = $updateProtein;
        $chefCustomizedMeal->fat = $updateFat;
//        dd($meal->calories);
        $chefCustomizedMeal->save();

        for($i=0;$i<$ingredientCountUpdate;$i++){
            DB::table('chef_customized_ingredient_meals')->where('meal_id','=',$chefCustomizedMeal->id)->where('ingredient_id','=',$prevIngreds[$i]->ingredient_id)->update(
                ['meal_id' => $chefCustomizedMeal->id, 'ingredient_id' => $ingredId[$i]->NDB_No, 'grams' => $request['grams'][$arrayKeys[$i]]]
            );
        }

        return back()->with(['status'=>'Successfully updated meal '.$chefCustomizedMeal->description.'!']);
    }

    public function deletePlan(Plan $plan){
        $plan->delete();

        return redirect($this->redirectTo)->with(['status'=>'Successfully deleted the plan!']);
    }

    public function finalPlan(Plan $plan)
    {
        $plan->lockPlan=1;
        $plan->save();

        return redirect($this->redirectTo)->with(['status'=>'Plan ready to order!']);
    }
    public function unlockPlan(Plan $plan)
    {
        $plan->lockPlan=0;
        $plan->save();

        return back()->with(['status'=>'Plan unlocked!']);
    }

    public function deleteMealPlan(Request $request)
    {
        $id=$request['deleteMealPlanId'];
        $mealPlan=MealPlan::where('id','=',$id)->first();
        $mealType = $mealPlan->meal_type;
        $mealTypeDisplay ='';
        switch ($mealType){
            case 'Breakfast':
                $mealTypeDisplay='Breakfast';
                break;
            case 'MorningSnack':
                $mealTypeDisplay='Morning Snack';
                break;
            case 'Lunch':
                $mealTypeDisplay='Lunch';
                break;
            case 'AfternoonSnack':
                $mealTypeDisplay='Afternoon Snack';
                break;
            case 'Dinner':
                $mealTypeDisplay='Dinner';
                break;
        }

        $mealDay=$mealPlan->day;
        $day='';
        switch ($mealDay){
            case 'MO':
                $day='Monday';
                break;
            case 'TU':
                $day='Tuesday';
                break;
            case 'WE':
                $day='Wednesday';
                break;
            case 'TH':
                $day='Thursday';
                break;
            case 'FR':
                $day='Friday';
                break;
            case 'SA':
                $day='Saturday';
                break;
        }

        $mealPlan->delete();
        return back()->with(['status'=>'Successfully deleted '.$mealTypeDisplay.' for '.$day.'!']);
    }

    public function deleteMeal(ChefCustomizedMeal $chefCustomizedMeal)
    {
        dd($chefCustomizedMeal);
        $mealPlan= $chefCustomizedMeal->mealplan->first();
        $ingredient_mealDeletes= $chefCustomizedMeal->customized_ingredient_meal()->get();

        foreach ($ingredient_mealDeletes as $mealDelete){
            $mealDelete->where('meal_id','=',$chefCustomizedMeal->id)->delete();
        }
        $chefCustomizedMeal->delete();
        $mealPlan->delete();
        return back()->with(['status'=>'Successfully deleted the meal!']);
    }
}

