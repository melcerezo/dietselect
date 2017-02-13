<?php

namespace App\Http\Controllers\Chef;

use App\Http\Controllers\Controller;
use App\Meal;
use App\MealPlan;
use App\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $plans= Plan::where('chef_id', Auth::guard('chef')->user())->get();
        return view('chef.mealplan')->with([
            'chef' => Auth::guard('chef')->user(),
            'plan'=> $plans //get data of meal plan
        ]);

    }

    public function prepareMealsPage(Plan $plan){
        $mealPlans= $plan->mealplans()->get();
        return view('chef.meal_planner')->with([
            'chef' => Auth::guard('chef')->user(),
            'mealPlans' =>$mealPlans

        ]);


    }

    // modal that pops up to create meal in meal plan

    public function setMeal($id)
    {
//        $newMeal= new Meal(['chef_id'=> Auth::guard('chef')->user(),'description'=>,'main_ingredient'=>,'calories'=>,'carbohydrates'=>,'protein'=>,'fat'=>,]);


        $plan_id=$id;
//        $newSetMeal= new MealPlan(['plan_id'=>$plan_id,''=>,''=>,''=>,]);


    }

    //modal that pops up to update meal in meal plan

    public function updateMeal()
    {

    }

    //modal that pops up to delete meal in meal plan

    public function deleteMeal()
    {

    }
}
