<?php

namespace App\Http\Controllers\Chef;

use App\Http\Controllers\Controller;
use App\Meal;
use App\MealPlan;
use App\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            'plan'=> $plans
        ]);

    }

    public function prepareMealsPage(Plan $plan){
        $mealPlan= $plan->mealplans();


    }


    public function setMeal()
    {

    }

    public function updateMeal()
    {

    }

    public function deleteMeal()
    {

    }
}
