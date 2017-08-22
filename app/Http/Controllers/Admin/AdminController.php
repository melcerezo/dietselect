<?php

namespace App\Http\Controllers\Admin;

use App\Allergy;
use App\ChefBankAccount;
use App\FoodiePreference;
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
use DB;


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
        $orderPlanNames=[];

        $orderItems= OrderItem::where('chef_id','=',$chef->id)->orderBy('created_at','desc')->take(5)->get();
        $commissions = Commission::where('chef_id','=',$chef->id)->orderBy('created_at','desc')->take(5)->get();
        $plans = Plan::where('chef_id','=',$chef->id)->take(5)->get();
//        dd($plans[0]->created_at->format('F d, Y'));
        foreach($orderItems as $orderItem){
            if($orderItem->order_type==0){
                $orderPlan = Plan::where('id','=',$orderItem->plan_id)->first();
                $orderPlanNames[] = array('id'=>$orderItem->id,'plan_name'=>$orderPlan->plan_name,'price'=>$orderPlan->price,'quantity'=>$orderItem->quantity,
                    'type'=>'Standard','is_paid'=>$orderItem->order->is_paid,'is_cancelled'=>$orderItem->order->is_cancelled,'date'=>$orderItem->created_at->format('F d, Y'));
            }elseif($orderItem->order_type==1){
                $orderPlan= CustomPlan::where('id','=',$orderItem->plan_id)->first();
                $orderPlanNames[] = array('id'=>$orderItem->id,'plan_name'=>$orderPlan->plan->plan_name,'price'=>$orderPlan->plan->price,'quantity'=>$orderItem->quantity,
                    'type'=>'Customized','is_paid'=>$orderItem->order->is_paid,'is_cancelled'=>$orderItem->order->is_cancelled,'date'=>$orderItem->created_at->format('F d, Y'));
            }elseif($orderItem->order_type==2){
                $orderPlan= SimpleCustomPlan::where('id','=',$orderItem->plan_id)->first();
                $orderPlanNames[] = array('id'=>$orderItem->id,'plan_name'=>$orderPlan->plan->plan_name,'price'=>$orderPlan->plan->price,'quantity'=>$orderItem->quantity,
                    'type'=>'Customized','is_paid'=>$orderItem->order->is_paid,'is_cancelled'=>$orderItem->order->is_cancelled,'date'=>$orderItem->created_at->format('F d, Y'));
            }
        }
        $bank_account= ChefBankAccount::where('chef_id','=',$chef->id)->get();

        return view('admin.chef')->with([
            'chef'=>$chef,
            'orderPlanNames'=>$orderPlanNames,
            'plans'=>$plans,
            'commissions'=>$commissions,
            'bank_account'=>$bank_account,
        ]);
    }


    public function foodies()
    {
        $foodies = Foodie::all();

        return view('admin.foodies')->with([
            'foodies'=>$foodies,
        ]);
    }

    public function foodie(Foodie $foodie)
    {
        $orders=Order::where('foodie_id','=',$foodie->id)->orderBy('created_at','desc')->take(5)->get();
        $foodieAddresses = DB::table('foodie_address')->where('foodie_id', '=', $foodie->id)->get();
        $foodieAllergy = Allergy::where('foodie_id','=',$foodie->id)->get();
        $foodiePreference = FoodiePreference::where('foodie_id','=',$foodie->id)->first();

        return view('admin.foodie')->with([
            'foodie'=>$foodie,
            'orders'=>$orders,
            'foodieAddresses'=>$foodieAddresses,
            'foodieAllergy'=>$foodieAllergy,
            'foodiePreference'=>$foodiePreference
        ]);

    }

    public function plans()
    {
        $plans = Plan::all();

        return view('admin.plans')->with([
            'plans'=>$plans,
        ]);
    }

    public function plan(Plan $plan)
    {

    }
}
