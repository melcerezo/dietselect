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

}
