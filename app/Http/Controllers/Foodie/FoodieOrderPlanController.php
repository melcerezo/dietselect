<?php

namespace App\Http\Controllers\Foodie;

use App\Http\Controllers\Controller;

use App\Plan;
use Illuminate\Http\Request;

class FoodieOrderPlanController extends Controller
{

    // Shows the order plan
    public function index(Plan $plan)
    {

        return view('foodie.orders', compact('plan'));
    }


    public function store(Request $request)
    {

    }
}
