<?php

namespace App\Http\Controllers\Foodie;

use App\Allergy;
use App\Chat;
use App\ChefCustomizedIngredientMeal;
use App\ChefCustomizedMeal;
use App\CustomPlan;
use App\FoodiePreference;
use App\Notification;
use App\CustomizedIngredientMeal;
use App\CustomizedMeal;
use App\Http\Controllers\Controller;
use App\Chef;
use App\IngredientMeal;
use App\Meal;
use App\MealPlan;
use App\Order;
use App\OrderItem;
use App\Plan;
use App\Message;
use App\Http\Controllers\Foodie\Auth\VerifiesSms;
use App\SimpleCustomDetail;
use App\SimpleCustomMeal;
use App\SimpleCustomPlan;
use App\SimpleCustomPlanDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use phpDocumentor\Reflection\Types\Integer;


class FoodieMealPlanController extends Controller
{
    use VerifiesSms;
//    line 159 start

    public function __construct()
    {
        $this->middleware('foodie.auth');
    }

    public function viewPlans(){
        $lastSaturday = Carbon::parse("last saturday 15:00:00")->format('Y-m-d H:i:s');
        $foodie = Auth::guard('foodie')->user()->id;
        $messages = Message::where('receiver_id', '=', Auth::guard('foodie')->user()->id)
            ->where('receiver_type', '=', 'f')
            ->where('foodie_can_see','=',1)
            ->where('is_read','=',0)
            ->get();
        $chefs = Chef::all();
        $chefCurrent=Chef::where('active','=',1)->get();
        $plans = Plan::where('created_at','>',$lastSaturday)->where('lockPlan','=',1)->where('is_banned','=',0)->get();
        $chats= Chat::where('foodie_id','=',$foodie)->where('foodie_can_see','=',1)->latest($column = 'updated_at')->get();

        $suggested = array();
        $foodiePreferenceCount = FoodiePreference::where('foodie_id', '=', $foodie)->count();
        $foodiePreference = '';
        if ($foodiePreferenceCount > 0) {
            $foodiePreference = FoodiePreference::where('foodie_id', '=', $foodie)->first()->ingredient;
        }

        foreach ($plans as $plan) {
            $chicken = 0;
            $beef = 0;
            $pork = 0;
            $seafood = 0;

            $mealPlans = MealPlan::where('plan_id', '=', $plan->id)->get();
            foreach ($mealPlans as $mealPlan) {
                $mainIngredient = Str::lower($mealPlan->chefcustomize->main_ingredient);

//                echo $mainIngredient . ' ';

                switch ($mainIngredient) {
                    case 'chicken':
                        $chicken += 1;
                        break;
                    case 'beef':
                        $beef += 1;
                        break;
                    case 'pork':
                        $pork += 1;
                        break;
                    case 'seafood':
                        $seafood += 1;
                        break;
                }
            }

            if ($chicken > $beef && $chicken > $pork && $chicken > $seafood) {
                if ($foodiePreference == 'chicken') {
                    $suggested[] = array('id' => $plan->id, 'name' => $plan->plan_name);
                }
            } else if ($beef > $chicken && $beef > $pork && $beef > $seafood) {
                if ($foodiePreference == 'beef') {
                    $suggested[] = array('id' => $plan->id, 'name' => $plan->plan_name);
                }
            } else if ($pork > $beef && $pork > $chicken && $pork > $seafood) {
                if ($foodiePreference == 'pork') {
                    $suggested[] = array('id' => $plan->id, 'name' => $plan->plan_name);
                }
            } else if ($seafood > $beef && $seafood > $pork && $seafood > $chicken) {
                if ($foodiePreference == 'seafood') {
                    $suggested[] = array('id' => $plan->id, 'name' => $plan->plan_name);
                }
            }
        } // END OF DEADLINE SATURDAY @ 3 PM

//        dd($foodiePreference);
//        dd($this->smsIsUnverified());

        $notifications=Notification::where('receiver_id','=',$foodie)->where('receiver_type','=','f')->get();
        $unreadNotifications=Notification::where('receiver_id','=',$foodie)->where('receiver_type','=','f')->where('is_read','=',0)->count();

//        $incomplete=SimpleCustomPlan::where('foodie_id','=',$foodie)->where('created_at','>',$lastSaturday)->latest()->take(3)->get();
//        $orders = Order::where('foodie_id','=',$foodie)->latest()->take(3)->get();
//
//
//        $incompArray = [];
//
//        foreach($incomplete as $item){
//            $orderItemsCount=0;
//            foreach($orders as $order){
//                $orderItemsCount=$order->order_item()
//                    ->where('plan_id','=',$item->id)
//                    ->where('order_type','=',2)->count();
//                if($orderItemsCount){
//                    break;
//                }
//            }
//            if($orderItemsCount){
////                        break;
//            }else{
//                $incompArray[]= [
//                    'id'=>$item->id,
//                    'name'=>$item->plan->plan_name,
//                ];
////                        break;
//            }
//        }


        return view('foodie.planSelect')->with([
            'sms_unverified' => $this->smsIsUnverified(),
            'chefs' => $chefs,
            'foodie' => Auth::guard('foodie')->user(),
            'messages' => $messages,
            'plans' => $plans,
            'chats' => $chats,
            'chefCurrent'=>$chefCurrent,
            'notifications'=>$notifications,
            'unreadNotifications'=>$unreadNotifications,
            'suggested'=>$suggested
        ]);
    }

//    public function viewChefs()
//    {
//        $messages = Message::where('receiver_id', '=', Auth::guard('foodie')->user()->id)
//            ->where('receiver_type', '=', 'f')
//            ->where('is_read','=',0)
//            ->get();
//        $chefs = Chef::all();
//
//        return view('foodie.chefselect')->with([
//            'sms_unverified' => $this->smsIsUnverified(),
//            'foodie' => Auth::guard('foodie')->user(),
//            'chefs' => $chefs,
//            'messages' => $messages
//        ]);
//    }

    public function viewChefsPlans($id)
    {
        $foodie=Auth::guard('foodie')->user->id;
        $chefPlans = Plan::where('chef_id', $id)->get();
        $chefsPlanCount = $chefPlans->count();
        $messages = Message::where('receiver_id', '=', Auth::guard('foodie')->user()->id)
            ->where('receiver_type', '=', 'f')
            ->where('foodie_can_see','=',1)
            ->where('is_read','=',0)
            ->get();
        $chats= Chat::where('foodie_id','=',$foodie)->where('foodie_can_see','=',1)->latest($column = 'updated_at')->get();
        $notifications=Notification::where('receiver_id','=',$foodie)->where('receiver_type','=','f')->get();
        $unreadNotifications=Notification::where('receiver_id','=',$foodie)->where('receiver_type','=','f')->where('is_read','=',0)->count();
        return view('foodie.planSelect')->with([
            'sms_unverified' => $this->smsIsUnverified(),
            'foodie' => Auth::guard('foodie')->user(),
            'plans' => $chefPlans,
            'planCount' => $chefsPlanCount,
            'messages' => $messages,
            'chats' => $chats,
            'notifications'=>$notifications,
            'unreadNotifications'=>$unreadNotifications
        ]);
    }

    public function viewPlanStandard($id)
    {
        $plan=Plan::where('id','=',$id)->first();
        if($plan===null){
            return redirect()->route('foodie.plan.show')->with(['status'=>'Plan does not exist']);
        }
//        $plan->created_at()
        $dt=$plan->created_at;
        $startWeek=$dt->addDay(7)->startOfWeek()->format('F d, Y');
//        dd($startWeek);
        $foodie = Auth::guard('foodie')->user()->id;
        $mealPlans = $plan->mealplans()->where('is_deleted','=',0)
            ->orderByRaw('FIELD(meal_type,"Breakfast","MorningSnack","Lunch","AfternoonSnack","Dinner")')
            ->get();

        $saMeals = $mealPlans->where('day','=','SA')->count();
        $moSnaMeals = $mealPlans->where('meal_type','=','MorningSnack')->count();
        $aftSnaMeals = $mealPlans->where('meal_type','=','AfternoonSnack')->count();

//        dd($saMeals);
//        $ingredientsMeal = '';
//        $ingredientCount = DB::table('ingredient_meal')
//            ->join('meals', 'ingredient_meal.meal_id', '=', 'meals.id')
//            ->join('meal_plans', 'meal_plans.meal_id', '=', 'meals.id')
//            ->count();
//
//        if ($ingredientCount > 0) {
//            $ingredientsMeal = DB::table('ingredients')
//                ->join('ingredient_meal', 'ingredients.NDB_No', '=', 'ingredient_meal.ingredient_id')
//                ->join('ingredients_group_description', 'ingredients.FdGrp_Cd', '=',
//                    'ingredients_group_description.FdGrp_Cd')
//                ->join('meals', 'ingredient_meal.meal_id', '=', 'meals.id')
//                ->join('meal_plans', 'meal_plans.meal_id', '=', 'meals.id')
//                ->select('ingredients.Long_Desc', 'ingredients_group_description.FdGrp_Desc', 'ingredient_meal.meal_id',
//                    'ingredient_meal.grams')->get();
//        }

        $mealPhotos = DB::table('meal_image')
            ->join('chef_customized_meals','chef_customized_meals.meal_id','=','meal_image.meal_id')
            ->join('meal_plans','meal_plans.id','=','chef_customized_meals.mealplan_id')
            ->join('plans','plans.id','=','meal_plans.plan_id')
//            ->join('meals','meal_image.meal_id','=','meals.id')
            ->where('plans.id','=',$plan->id)
            ->select('chef_customized_meals.meal_id','meal_plans.plan_id','chef_customized_meals.description','meal_image.image')->get();

//        dd($mealPhotos);

        $messages = Message::where('receiver_id', '=', Auth::guard('foodie')->user()->id)
            ->where('receiver_type', '=', 'f')
            ->where('foodie_can_see','=',1)
            ->where('is_read','=',0)
            ->get();
        $chefs = Chef::all();
        $chats= Chat::where('foodie_id','=',$foodie)->where('foodie_can_see','=',1)->latest($column = 'updated_at')->get();
        $notifications=Notification::where('receiver_id','=',$foodie)->where('receiver_type','=','f')->get();
        $unreadNotifications=Notification::where('receiver_id','=',$foodie)->where('receiver_type','=','f')->where('is_read','=',0)->count();

        return view('foodie.mealView')->with([
            'foodie'=> Auth::guard('foodie')->user(),
            'messages' => $messages,
            'chats' => $chats,
            'notifications'=>$notifications,
            'unreadNotifications'=>$unreadNotifications,
            'chefs' => $chefs,
            'startWeek'=>$startWeek,
            'mealPlans' => $mealPlans,
            'mealPhotos'=>$mealPhotos,
            'saMeals'=>$saMeals,
            'moSnaMeals'=>$moSnaMeals,
            'aftSnaMeals'=>$aftSnaMeals,
            'plan' => $plan,
            'sms_unverified' => $this->smsIsUnverified()
        ]);
    }

    public function viewSimpleCustomize($id)
    {
        $plan=Plan::where('id','=',$id)->first();
        if($plan===null){
            return redirect()->route('foodie.plan.show')->with(['status'=>'Plan does not exist']);
        }

        $simpleCustomPlan=new SimpleCustomPlan();
        $simpleCustomPlan->foodie_id=Auth::guard('foodie')->user()->id;
        $simpleCustomPlan->plan_id=$plan->id;
        $simpleCustomPlan->save();

        $mealPlans = $plan->mealplans()->where('is_deleted','=',0)
            ->orderByRaw('FIELD(meal_type,"Breakfast","MorningSnack","Lunch","AfternoonSnack","Dinner")')
            ->get();

        foreach($mealPlans as $mealPlan){
            $simpleCustomMeal = new SimpleCustomMeal();
            $simpleCustomMeal->simple_custom_plan_id = $simpleCustomPlan->id;
            $simpleCustomMeal->chef_customized_meal_id = $mealPlan->chefcustomize->id;
            $simpleCustomMeal->save();
        }

        return redirect()->route('foodie.plan.simpleView', $simpleCustomPlan->id);
    }

    public function simpleCustomView($id)
    {
        $simpleCustomPlan = SimpleCustomPlan::where('id','=',$id)->where('foodie_id','=',Auth::guard('foodie')->user()->id)->first();
        if($simpleCustomPlan===null){
            return back()->with(['status'=>'Plan does not exist']);
        }
        $orders=Order::all();
        foreach($orders as $order){
            $orderItemsCount=$order->order_item()
                ->where('plan_id','=',$simpleCustomPlan->id)
                ->where('order_type','=',2)->count();
            if($orderItemsCount){
                return redirect()->route('foodie.dashboard')->with(['status'=>'Customized plan has already been ordered']);
                break;
            }
        }

//        $incomplete=OrderItem::where('order_type','=',2)->where('plan_id','=',$simpleCustomPlan->id)->count();
//        dd($incomplete);

        $mealPlans = $simpleCustomPlan->plan->mealplans()
            ->orderByRaw('FIELD(meal_type,"Breakfast","MorningSnack","Lunch","AfternoonSnack","Dinner")')
            ->get();

        $simpleCustomMeals = $simpleCustomPlan->simple_custom_meal()->get();

//        dd($simpleCustomMeals->where('is_customized','=',1)->count());
        $saMeals = $mealPlans->where('day','=','SA')->count();
        $moSnaMeals = $mealPlans->where('meal_type','=','MorningSnack')->count();
        $aftSnaMeals = $mealPlans->where('meal_type','=','AfternoonSnack')->count();
        $tasteCount=$simpleCustomPlan->simple_custom_plan_detail()
            ->where(function($query)
            {
                $query->where('detail','sweet')
                    ->where('detail', 'salty')
                    ->orWhere('detail','spicy')
                    ->orWhere('detail','bitter')
                    ->orWhere('detail','savory');
            })
            ->count();
        $cookCount = $simpleCustomPlan->simple_custom_plan_detail()
            ->where(function($query)
            {
                $query->where('detail','fried')
                    ->orWhere('detail','grilled');
            })
            ->count();

        $allergies = Allergy::where('foodie_id', Auth::guard('foodie')->user()->id)->select('allergy')->get();
        $allergyJson = '[';
        $i = 0;
        foreach ($allergies as $allergy) {
            if (++$i < $allergies->count()) {
                $allergyJson .= '{"allergy": "' . $allergy->allergy . '"},';
            } else {
                $allergyJson .= '{"allergy": "' . $allergy->allergy . '"}';
            }
        }
        $allergyJson .= ']';
//        dd($allergyJson);
//        dd($simpleCustomPlan->simple_custom_plan_detail()->where([
//            ['detail','=','fried'],
//            ['detail','=','grilled']
//        ])->get());
        $driedCount = $simpleCustomPlan->simple_custom_plan_detail()
            ->where(function($query)
            {
                $query->where('detail','preservatives')
                    ->orWhere('detail', 'salt')
                    ->orWhere('detail','sweeteners');
            })
            ->count();

//        dd($tasteCount);

        $messages = Message::where('receiver_id', '=', Auth::guard('foodie')->user()->id)
            ->where('receiver_type', '=', 'f')
            ->where('foodie_can_see', '=', 1)
            ->where('is_read','=',0)
            ->get();
        $chefs = Chef::all();
        $chats= Chat::where('foodie_id','=',Auth::guard('foodie')->user()->id)->where('foodie_can_see', '=', 1)->latest($column = 'updated_at')->get();
        $notifications=Notification::where('receiver_id','=',Auth::guard('foodie')->user()->id)->where('receiver_type','=','f')->get();
        $unreadNotifications=Notification::where('receiver_id','=',Auth::guard('foodie')->user()->id)->where('receiver_type','=','f')->where('is_read','=',0)->count();

        $details=$simpleCustomPlan->simple_custom_plan_detail()->get();

        $mealPhotos = DB::table('meal_image')
            ->join('chef_customized_meals','chef_customized_meals.meal_id','=','meal_image.meal_id')
            ->join('meal_plans','meal_plans.id','=','chef_customized_meals.mealplan_id')
            ->select('meal_plans.id','meal_plans.plan_id','meal_image.image')->get();

        $detailJson = '[';
        $i = 0;
        foreach ($details as $detail) {
            if (++$i < $details->count()) {
                $detailJson .= '{"detail": "' . $detail->detail . '"},';
            } else {
                $detailJson .= '{"detail": "' . $detail->detail . '"}';
            }
        }
        $detailJson .= ']';

        return view('foodie.simpleCustomize')->with([
            'sms_unverified' => $this->smsIsUnverified(),
            'foodie' => Auth::guard('foodie')->user(),
            'chats' => $chats,
            'notifications'=>$notifications,
            'unreadNotifications'=>$unreadNotifications,
            'messages' => $messages,
            'chefs' => $chefs,
            'simpleCustomPlan'=>$simpleCustomPlan,
            'simpleCustomMeals'=>$simpleCustomMeals,
            'saMeals'=>$saMeals,
            'moSnaMeals'=>$moSnaMeals,
            'aftSnaMeals'=>$aftSnaMeals,
            'tasteCount'=>$tasteCount,
            'cookCount'=>$cookCount,
            'driedCount'=>$driedCount,
            'mealPhotos'=>$mealPhotos,
            'detailJson'=>$detailJson,
            'allergyJson'=>$allergyJson
        ]);
    }

    public function simpleMake($id, Request $request)
    {
        $simpleCustomPlan= SimpleCustomPlan::where('id','=',$id)->first();
        if($simpleCustomPlan===null){
            return redirect()->route('foodie.plan.show')->with(['status'=>'Plan does not exist']);
        }

        foreach($request->all() as $key=>$value){
//            dd($request);
            if($value == "1"){

                if (SimpleCustomPlanDetail::where([
                        ['simple_custom_plan_id', '=', $simpleCustomPlan->id],
                        ['detail', '=', $key]
                    ])->count() == 0
                ){
                    $detail = new SimpleCustomPlanDetail();
                    $detail->simple_custom_plan_id = $simpleCustomPlan->id;
                    $detail->detail = $key;
                    $detail->save();
                }

            }else{
                if (SimpleCustomPlanDetail::where([
                        ['simple_custom_plan_id', '=', $simpleCustomPlan->id],
                        ['detail', '=', $key]
                    ])->count() > 0
                ){
                    $detail = SimpleCustomPlanDetail::where([
                        ['simple_custom_plan_id', '=', $simpleCustomPlan->id],
                        ['detail', '=', $key]
                    ])->first();
                    $detail->delete();
                }
            }
        }

        return redirect()->route('foodie.plan.simpleView', $simpleCustomPlan->id)->with([
            'status'=>'Successfully customized the plan!'
        ]);
//        return redirect()->route('cart.add', ['id' => $simpleCustom->id,'cust' => 2]);
    }

    public function simpleMealMake($id, Request $request)
    {
        $simpleCustomMeal=SimpleCustomMeal::where('id','=',$id)->first();

        if($simpleCustomMeal===null){
//            return redirect()->route('foodie.plan.show')->with(['status'=>'Plan does not exist']);
            return back()->with([
                'status'=>'Meal does not exist!'
            ]);
        }

        foreach($request->except(['_token']) as $value){
//            dd($request);
            $detail = new SimpleCustomDetail();
            $detail->simple_custom_meal_id = $simpleCustomMeal->id;

            $detail->detail = $value;
            $detail->save();

        }

        $simpleCustomMeal->is_customized=1;
        $simpleCustomMeal->save();

        return redirect()->route('foodie.plan.simpleView', $simpleCustomMeal->simple_custom_plan->id)->with([
            'status'=>'Successfully customized the meal!'
        ]);
//        return redirect()->route('cart.add', ['id' => $simpleCustom->id,'cust' => 2]);
    }

    public function simpleCustomDelete(SimpleCustomPlan $simpleCustomPlan)
    {
        $simpleCustomPlan->delete();
        return redirect()->route('foodie.dashboard')->with([ 'status'=>'Deleted the Customized Plan!' ]);
    }

    public function simpleCustomDetailDelete(SimpleCustomMeal $simpleCustomMeal)
    {
//        dd($simpleCustomMeal->simple_custom_detail()->get());
        $simpleCustomMeal->is_customized=0;
        $simpleCustomMeal->save();
        $simpleDetails=$simpleCustomMeal->simple_custom_detail()->get();
        foreach($simpleDetails as $simpleDetail){
            $simpleDetail->delete();
        }

        return redirect()->route('foodie.plan.simpleView', $simpleCustomMeal->simple_custom_plan->id)->with(['status'=>"Undid customization for ".$simpleCustomMeal->chef_customized_meal->description."!"]);
    }

    public function viewChefsMeals(Plan $plan, Request $request)
    {

        $mealPlans = $plan->mealplans()
            ->orderByRaw('FIELD(meal_type,"Breakfast","MorningSnack","Lunch","AfternoonSnack","Dinner")')
            ->get();
        $mealPlansCount = $mealPlans->count();

        $ingredientsMeal = '';
//        $ingredientCount = DB::table('chef_customized_ingredient_meals')
//            ->join('chef_customized_ingredient_meals', 'chef_customized_ingredient_meals.meal_id', '=', 'chef_customized_meals.id')
////            ->join('meal_plans', 'meal_plans.meal_id', '=', 'meals.id')
//            ->count();


        $ingredientsMeal = DB::table('ingredients')
            ->join('chef_customized_ingredient_meals', 'ingredients.NDB_No', '=', 'chef_customized_ingredient_meals.ingredient_id')
            ->join('ingredients_group_description', 'ingredients.FdGrp_Cd', '=',
                'ingredients_group_description.FdGrp_Cd')
            ->join('chef_customized_meals', 'chef_customized_ingredient_meals.meal_id', '=', 'chef_customized_meals.id')
//                ->join('meal_plans', 'meal_plans.meal_id', '=', 'meals.id')
            ->select('ingredients.Long_Desc', 'ingredients_group_description.FdGrp_Desc', 'chef_customized_ingredient_meals.meal_id',
                'chef_customized_ingredient_meals.grams')->get();


        $messages = Message::where('receiver_id', '=', Auth::guard('foodie')->user()->id)
            ->where('receiver_type', '=', 'f')
            ->where('foodie_can_see', '=', 1)
            ->where('is_read','=',0)
            ->get();
        $chefs = Chef::all();
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

        $customPlan = new CustomPlan();
        $customPlan->plan_id = $plan->id;
        $customPlan->save();
        $mealPlans = MealPlan::where('plan_id', '=', $plan->id)->get();
//        dd($mealId);
//        dd($customPlan);
//    dd($mealIngreds[3]);
        $customId = [];// this array will hold the created customized meal ids
        $mealId =[];
        foreach ($mealPlans as $mealPlan) {
            $customize = new CustomizedMeal();
            $customize->meal_id = $mealPlan->chefcustomize->id;
            $customize->foodie_id = $user;
            $customize->custom_plan_id = $customPlan->id;
            $customize->description = $mealPlan->chefcustomize->description;
            $customize->main_ingredient = $mealPlan->chefcustomize->main_ingredient;
            $customize->calories = $mealPlan->chefcustomize->calories;
            $customize->carbohydrates = $mealPlan->chefcustomize->carbohydrates;
            $customize->protein = $mealPlan->chefcustomize->protein;
            $customize->fat = $mealPlan->chefcustomize->fat;
            $customize->save();
            $mealId[]= $mealPlan->chefcustomize->id;
            $customId[] = $customize->id;//saves the created meal id into $customId
        }

        $mealIngreds = [];
        //makes array of arrays
        for ($i = 0; $i < count($mealId); $i++) {
            $mealIngreds[$i] = ChefCustomizedIngredientMeal::where('meal_id', '=', $mealId[$i])->get();
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
//        dd('finished meal ingred');

        $customIdString=json_encode($customId);

        return redirect()->route('foodie.meal', compact('plan','customIdString','customPlan'))->with([
            'plan'=>$plan,
            'sms_unverified' => $this->smsIsUnverified(),
            'foodie' => Auth::guard('foodie')->user(),
            'mealPlans' => $mealPlans,
            'mealPlansCount' => $mealPlansCount,
            'ingredientsMeal' => $ingredientsMeal,
//            'ingredientCount' => $ingredientCount,
            'messages' => $messages,
            'customId'=>array($customId),
            'chefs'=>$chefs,
            'customPlan'=>$customPlan
        ]);
    }

    public function getIngred(ChefCustomizedMeal $chefCustomizedMeal){

        $ingreds = $chefCustomizedMeal->customized_ingredient_meal()->get();

        $ingredientMeals = '[';
        $i=0;
        foreach($ingreds as $ingred){
            $ingredientDesc = DB::table('ingredients')
                ->join('ingredients_group_description','ingredients.FdGrp_Cd','=','ingredients_group_description.FdGrp_Cd')
                ->where('NDB_No','=',$ingred->ingredient_id)
                ->select('ingredients.Long_Desc','ingredients.FdGrp_Cd','ingredients_group_description.FdGrp_Desc')
                ->first();

            if(++$i<$ingreds->count()) {
                $ingredientMeals .= '{ "meal":"' . $ingred->meal_id . '","ingredient":"'.$ingredientDesc->Long_Desc.'","ingredient_group":"'.$ingredientDesc->FdGrp_Cd.'","grams":"'.$ingred->grams.'"}, ';
            }
            else{
                $ingredientMeals .= '{ "meal":"' . $ingred->meal_id . '","ingredient":"'.$ingredientDesc->Long_Desc.'","ingredient_group":"'.$ingredientDesc->FdGrp_Cd.'","grams":"'.$ingred->grams.'"} ';
            }

        }
        $ingredientMeals.= ']';
        $response=$ingredientMeals;
        return $response;
    }

    public function viewMeal(Plan $plan, $customId,CustomPlan $customPlan)
    {
        $foodie = Auth::guard('foodie')->user()->id;
//        dd($id);
        $customList=json_decode($customId);
        $mealPlans = $plan->mealplans()
            ->orderByRaw('FIELD(meal_type,"Breakfast","MorningSnack","Lunch","AfternoonSnack","Dinner")')
            ->get();

        $customize=[];
        $ingredientsMeal = [];
        $ingredientDesc="";
        $ingredientMealData=[];
//        $ingredientCount = DB::table('ingredient_meal')
//            ->join('meals', 'ingredient_meal.meal_id', '=', 'meals.id')
//            ->join('meal_plans', 'meal_plans.meal_id', '=', 'meals.id')
//            ->count();

//        dd($ingredientCount);
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
              "grams"=>$ingredientsMeal[$i]->grams,
              "custom"=>$ingredientsMeal[$i]->is_customized
          );
        }

//        dd(count($ingredientMealData));

//        dd($customize);
        $mealPlans = $plan->mealplans()
            ->orderByRaw('FIELD(meal_type,"Breakfast","MorningSnack","Lunch","AfternoonSnack","Dinner")')
            ->get();
        $mealPlansCount = $mealPlans->count();

        $saMeals = $mealPlans->where('day','=','SA')->count();
        $moSnaMeals = $mealPlans->where('meal_type','=','MorningSnack')->count();
        $aftSnaMeals = $mealPlans->where('meal_type','=','AfternoonSnack')->count();


//        dd($mealPlans[0]->chefcustomize->id);

        $chats= Chat::where('foodie_id','=',$foodie)->where('foodie_can_see', '=', 1)->latest($column = 'updated_at')->get();


        $messages = Message::where('receiver_id', '=', Auth::guard('foodie')->user()->id)
            ->where('receiver_type', '=', 'f')
            ->where('foodie_can_see', '=', 1)
            ->where('is_read','=',0)
            ->get();
        $chefs = Chef::all();
//        dd($customize);

//        $customMeals = MealPlan::where('customized_meal_id', '=', $customize->meal_id)->get();
//        dd($customMeals);

//        dd($customize);

        $notifications=Notification::where('receiver_id','=',$foodie)->where('receiver_type','=','f')->get();
        $unreadNotifications=Notification::where('receiver_id','=',$foodie)->where('receiver_type','=','f')->where('is_read','=',0)->count();

//        $mealPhotos = DB::table('meal_image')
//            ->join('meals','meal_image.meal_id','=','meals.id')
//            ->join('meal_plans','meal_plans.meal_id','=','meals.id')
//            ->select('meal_plans.id','meal_plans.plan_id','meal_image.image')->get();

        $mealPhotos = DB::table('meal_image')
            ->join('chef_customized_meals','chef_customized_meals.meal_id','=','meal_image.meal_id')
            ->join('meal_plans','meal_plans.id','=','chef_customized_meals.mealplan_id')
            ->select('meal_plans.id','meal_plans.plan_id','meal_image.image')->get();

        return view('foodie.mealCustomize', compact('plan', 'customize'))->with([
            'viewPlan'=>$plan,
            'sms_unverified' => $this->smsIsUnverified(),
            'foodie' => Auth::guard('foodie')->user(),
            'mealPlans' => $mealPlans,
            'mealPhotos' => $mealPhotos,
            'saMeals'=>$saMeals,
            'moSnaMeals'=>$moSnaMeals,
            'aftSnaMeals'=>$aftSnaMeals,
            'mealPlansCount' => $mealPlansCount,
            'ingredientsMeal' => $ingredientMealData,
//            'ingredientCount' => $ingredientCount,
            'chats' => $chats,
            'notifications'=>$notifications,
            'unreadNotifications'=>$unreadNotifications,
            'messages' => $messages,
            'customId' => $customId,
            'chefs' => $chefs,
            'customPlan' =>$customPlan
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
                                }else{
                                    if($categ=='dairy,eggs') {
                                        $data = DB::table('ingredients')->select('Long_Desc')
                                            ->where('FdGrp_Cd', '~0100~')
                                            ->get();
                                    }else{
                                        if($categ=='soups,sauces,gravy') {
                                            $data = DB::table('ingredients')->select('Long_Desc')
                                                ->where('FdGrp_Cd', '~0600~')
                                                ->get();
                                        }else{
                                            if($categ=='fruits') {
                                                $data = DB::table('ingredients')->select('Long_Desc')
                                                    ->where('FdGrp_Cd', '~0900~')
                                                    ->get();
                                            }else{
                                                if($categ=='beans,peanuts'){
                                                    $data = DB::table('ingredients')->select('Long_Desc')
                                                        ->where('FdGrp_Cd', '~1600~')
                                                        ->get();
                                                }else {
                                                    if ($categ == 'fat,oils') {
                                                        $data = DB::table('ingredients')->select('Long_Desc')
                                                            ->where('FdGrp_Cd', '~0400~')
                                                            ->get();
                                                    }
                                                }
                                            }
                                        }
                                    }
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

    public function validateIngredJson($type){

        $categ=$type;
//        if($categ=="fruits/fruit juices"){
//            $categ='fruits';
//        }else if($categ=='carbohydrates(grain, pasta)'){
//            $categ='carbohydrates(grain,pasta)';
//        }else if($categ=='fish/shellfish'){
//            $categ='fish';
//        }else if($categ=='dairy,egg'){
//            $categ='dairy,eggs';
//        }

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
        }else if($categ=='beans,peanuts') {
            $data = DB::table('ingredients')->select('Long_Desc')
                ->where('FdGrp_Cd', '~1600~')
                ->get();
        }else if($categ == 'fat,oils') {
            $data = DB::table('ingredients')->select('Long_Desc')
                ->where('FdGrp_Cd', '~0400~')
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

    public function customizeChefsMeals(CustomizedMeal $customize, Request $request)
    {
        $origMeal=$customize->chefcustomize;
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
        $cust_type=1;
//        $cust_id= CustomizedMeal::where('meal_id', '=', $meal->id)->pluck('id')->first();
        $prevIngreds = DB::table('customized_ingredient_meals')->select('ingredient_id')->where('meal_id','=',$customize->id)->get();
        $customize->update([
            'foodie_id' => $user,
            'custom_type' => $cust_type,
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




        foreach($origMeal->customized_ingredient_meal()->get() as $i=>$item) {
            if($ingredId[$i]->NDB_No!=$item->ingredient_id || $request['grams'][$arrayKeys[$i]]!=$item->grams){
                DB::table('customized_ingredient_meals')->where('id','=',$customIngred[$i]->id)->where('ingredient_id','=',$prevIngreds[$i]->ingredient_id)->update(
                    ['meal_id' => $customize->id,'is_customized'=>1, 'ingredient_id' => $ingredId[$i]->NDB_No, 'grams' => $request['grams'][$arrayKeys[$i]]]
                );
            }
        }

//        die();

        return back()->with(['status','Successfully customized the meal!']);
    }


}
