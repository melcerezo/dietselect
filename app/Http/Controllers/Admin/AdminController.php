<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Foodie;
use App\Chef;
use App\Plan;
use App\Order;
use App\OrderItem;
use App\ChefCustomizedMeal;
use App\ChefCustomizedIngredientMeal;
use App\Meal;
use App\IngredientMeal;
use App\Ingredient;
use App\Rating;
use App\CustomPlan;
use App\SimpleCustomPlan;
use App\Commission;


class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin.auth');
    }

    public function index()
    {

        $foodies=Foodie::all()->orderBy('created_at', 'desc');
        $chefs=Chef::all();
        $orders = Order::all();
        $plans = Plan::all();
        $commissions = Commission::all();

        dd($foodies);

//        dd("Hello!");

        return view("admin.dashboard")->with([
            'foodies'=>$foodies,
            'chefs'=>$chefs,
            'orders'=>$orders,
            'plans'=>$plans,
            'commissions'=>$commissions,
        ]);
    }
}
