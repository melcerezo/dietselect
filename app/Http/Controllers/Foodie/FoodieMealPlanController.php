<?php

namespace App\Http\Controllers\Foodie;

use App\Http\Controllers\Controller;
use App\Chef;
use App\Meal;
use App\MealPlan;
use App\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use phpDocumentor\Reflection\Types\Integer;


class FoodieMealPlanController extends Controller
{
    public function __construct()
    {
        $this->middleware('foodie.auth');
    }

    public function viewChefs(){
        $chefs=Chef::all();
        return view('foodie.chefselect')->with([
            'foodie'=>Auth::guard('foodie')->user(),
            'chefs'=>$chefs
        ]);
    }

    public function viewChefsPlans($id){
        $chefPlans=Plan::where('chef_id', $id)->get();
        $chefsPlanCount= $chefPlans->count();
        return view('foodie.planSelect')->with([
            'foodie'=>Auth::guard('foodie')->user(),
            'plans' => $chefPlans, //get data of meal plan
            'planCount'=>$chefsPlanCount
        ]);
    }

    public function viewChefsMeals(Plan $plan){
        $mealPlans=$plan->mealplans()->get();
        $mealPlansCount=$mealPlans->count();

        return view('foodie.mealCustomize')->with([
            'foodie'=>Auth::guard('foodie')->user(),
            'mealPlans' => $mealPlans,
            'mealPlansCount'=>$mealPlansCount
        ]);
    }

    public function customizeChefsMeals(Meal $meal, Request $request){
        //
    }


}
