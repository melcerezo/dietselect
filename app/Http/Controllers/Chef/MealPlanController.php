<?php

namespace App\Http\Controllers\Chef;

use App\Http\Controllers\Controller;
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
        return view('chef.mealplan')->with([
            'chef' => Auth::guard('chef')->user(),
        ]);



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
