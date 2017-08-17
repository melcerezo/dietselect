<?php

namespace App\Http\Controllers\Admin;

use App\ChefBankAccount;
use App\Http\Controllers\Controller;
use App\Message;
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

        $foodies=Foodie::orderBy('created_at', 'desc')->get();
        $chefs=Chef::orderBy('created_at', 'desc')->get();
        $orders = Order::orderBy('created_at', 'desc')->get();
        $plans = Plan::orderBy('created_at', 'desc')->get();
        $commissions = Commission::where('paid','=',0)->orderBy('created_at', 'desc')->get();
        $paidCommissions = Commission::where('paid','=',1)->orderBy('created_at', 'desc')->get();

        return view("admin.dashboard")->with([
            'foodies'=>$foodies,
            'chefs'=>$chefs,
            'orders'=>$orders,
            'plans'=>$plans,
            'commissions'=>$commissions,
            'paidCommissions'=>$paidCommissions,
        ]);
    }



    public function commissions()
    {
        $chefs=Chef::orderBy('created_at', 'desc')->get();
        $commissions = Commission::orderBy('created_at', 'desc')->get();

        return view("admin.commissions")->with([
            'chefs'=>$chefs,
            'commissions'=>$commissions,
        ]);
    }

    public function payCommission(Commission $commission)
    {
        $commission->paid=1;
        $commission->save();

        return back()->with(['status'=>'Paid commission!']);
    }

    public function payCommissionAll()
    {
        $commissions = Commission::where('paid','=',0)->get();

        foreach($commissions as $commission){
            $commission->paid=1;
            $commission->save();
        }

        return back()->with(['status'=>'Paid all unpaid commissions!']);
    }

    public function chefs()
    {
        $chefs = Chef::all();

        return view('admin.chefs')->with([
            'chefs'=>$chefs,
        ]);
    }

    public function chef(Chef $chef)
    {
        $orderItems= OrderItem::where('chef_id','=',$chef->id)->orderBy('created_at','desc')->get();
        $commissions = Commission::where('chef_id','=',$chef->id)->orderBy('created_at','desc')->get();
        $plans = Plan::where('chef_id','=',$chef->id)->orderBy('created_at','desc')->get();
        $bank_account= ChefBankAccount::where('chef_id','=',$chef->id)->get();

        return view('admin.chef')->with([
            'chef'=>$chef,
            'orderItems'=>$orderItems,
            'commissions'=>$commissions,
            'plans'=>$plans,
            'bank_account'=>$bank_account,
        ]);
    }

}
