<?php

namespace App\Http\Controllers\Admin;

use App\Allergy;
use App\ChefBankAccount;
use App\FoodiePreference;
use App\Http\Controllers\Controller;
use App\Mail\ChefFreeze;
use App\Mail\FreezeMail;
use App\Message;
use Carbon\Carbon;
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
use Illuminate\Mail as mailer;


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
        $firstCom = Commission::first();
        $lastCom = Commission::latest()->first();
//        dd($lastCom);

        $totalCommissions = 0;
        $pendCommissions = 0;
        $paidCommissions = 0;

        foreach($commissions as $commission){
            $totalCommissions+=$commission->amount;
        }
        foreach($commissions->where('paid','=',0) as $commission){
            $pendCommissions+= $commission->amount;
        }
        foreach($commissions->where('paid','=',1) as $commission){
            $paidCommissions+= $commission->amount;
        }

        $thisDay = Carbon::today();
        $dw = Carbon::now();
        $startOfTheWeek=$dw->startOfWeek();
        $de = Carbon::now();
        $endOfWeek = $de->endOfWeek();

        $ds = Carbon::now();
        $startOfMonth=$ds->startOfMonth();
        $dr = Carbon::now();
        $endOfMonth = $dr->endOfMonth();


        $dt = Carbon::now();
        $startOfYear=$dt->startOfYear();
        $dm = Carbon::now();
        $endOfYear = $dm->endOfYear();

        return view("admin.commissions")->with([
            'chefs'=>$chefs,
            'commissions'=>$commissions,
            'totalCommissions'=>$totalCommissions,
            'pendCommissions'=>$pendCommissions,
            'paidCommissions'=>$paidCommissions,
            'thisDay'=>$thisDay,
            'startOfTheWeek'=>$startOfTheWeek,
            'endOfWeek'=>$endOfWeek,
            'startOfMonth'=>$startOfMonth,
            'endOfMonth'=>$endOfMonth,
            'startOfYear'=>$startOfYear,
            'endOfYear'=>$endOfYear,
            'firstCom'=>$firstCom,
            'lastCom'=>$lastCom

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

    public function chefFreeze(Chef $chef, mailer\Mailer $mailer)
    {
        $chef->active=0;
        $chef->save();

        $plans = Plan::where('chef_id','=',$chef->id)->get();
        foreach($plans as $plan){
            $plan->lockPlan=0;
            $plan->save();
        }

        $mailer->to($chef->email)
            ->send(new ChefFreeze($chef));

        return back()->with(['status'=>'Successfully froze user account']);
    }

    public function chefUnfreeze(Chef $chef)
    {
        $chef->active=1;
        $chef->save();

        return back()->with(['status'=>'Successfully unfroze user account']);
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

    public function foodieFreeze(Foodie $foodie, mailer\Mailer $mailer)
    {
//        dd($foodie->email);
        $foodie->active=0;
        $foodie->save();

        $mailer->to($foodie->email)
            ->send(new FreezeMail($foodie));

        return back()->with(['status'=>'Successfully froze user account']);
    }

    public function foodieUnfreeze(Foodie $foodie)
    {
        $foodie->active=1;
        $foodie->save();

        return back()->with(['status'=>'Successfully unfroze user account']);
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
        $mealPlans = $plan->mealplans()
            ->orderByRaw('FIELD(meal_type,"Breakfast","MorningSnack","Lunch","AfternoonSnack","Dinner")')
            ->get();

        $saMeals = $mealPlans->where('day','=','SA')->count();
        $moSnaMeals = $mealPlans->where('meal_type','=','MorningSnack')->count();
        $aftSnaMeals = $mealPlans->where('meal_type','=','AfternoonSnack')->count();

        $mealPhotos = DB::table('meal_image')
            ->join('chef_customized_meals','chef_customized_meals.meal_id','=','meal_image.meal_id')
            ->join('meal_plans','meal_plans.id','=','chef_customized_meals.mealplan_id')
            ->join('plans','plans.id','=','meal_plans.plan_id')
//            ->join('meals','meal_image.meal_id','=','meals.id')
            ->where('plans.id','=',$plan->id)
            ->select('chef_customized_meals.meal_id','meal_plans.plan_id','chef_customized_meals.description','meal_image.image')->get();

//        dd($mealPhotos);

        return view('admin.plan')->with([
            'mealPlans' => $mealPlans,
            'mealPhotos'=>$mealPhotos,
            'saMeals'=>$saMeals,
            'moSnaMeals'=>$moSnaMeals,
            'aftSnaMeals'=>$aftSnaMeals,
            'plan' => $plan,
        ]);
    }

    public function planBan(Plan $plan)
    {
        $plan->is_banned=1;
        $plan->save();

        return back()->with(['status'=>'Banned Plan']);
    }

    public function planUnban(Plan $plan)
    {
        $plan->is_banned=0;
        $plan->save();

        return back()->with(['status'=>'Unbanned Plan']);
    }

    public function orders()
    {
        $orders = Order::orderBy('created_at', 'desc')->get();
        $firstOrd = Order::first();
        $lastOrd = Order::latest()->first();

        $totalPaid = 0;

        foreach($orders->where('is_paid','=',1)->where('is_cancelled','=',0) as $order){
            $totalPaid+=$order->total;
        }

        $totalPend = 0;

        foreach($orders->where('is_paid','=',0)->where('is_cancelled','=',0) as $order){
            $totalPend+=$order->total;
        }

        $thisDay = Carbon::today();
        $dw = Carbon::now();
        $startOfTheWeek=$dw->startOfWeek();
        $de = Carbon::now();
        $endOfWeek = $de->endOfWeek();

        $ds = Carbon::now();
        $startOfMonth=$ds->startOfMonth();
        $dr = Carbon::now();
        $endOfMonth = $dr->endOfMonth();


        $dt = Carbon::now();
        $startOfYear=$dt->startOfYear();
        $dm = Carbon::now();
        $endOfYear = $dm->endOfYear();


        return view('admin.orders')->with([
            'orders'=>$orders,
            'firstOrd'=>$firstOrd,
            'lastOrd'=>$lastOrd,
            'thisDay'=>$thisDay,
            'startOfTheWeek'=>$startOfTheWeek,
            'endOfWeek'=>$endOfWeek,
            'startOfMonth'=>$startOfMonth,
            'endOfMonth'=>$endOfMonth,
            'startOfYear'=>$startOfYear,
            'endOfYear'=>$endOfYear,
            'totalPaid'=>$totalPaid,
            'totalPend'=>$totalPend
        ]);
    }

    public function order(Order $order)
    {

        $foodieAddress = DB::table('foodie_address')->where('id','=',$order->address_id)->select('id','city','unit','street','brgy','bldg','type')->first();
        $orderItems = $order->order_item()->get();
        $orderItemArray = [];


        if($foodieAddress!=null){

            $orderAddress = $foodieAddress->unit;
            if($foodieAddress->bldg!=''){
                $orderAddress.=' '.$foodieAddress->bldg.', ';
            }
            $orderAddress.= ' '.$foodieAddress->street;
            $orderAddress.= ', '.$foodieAddress->brgy;
            $orderAddress.= ' '.$foodieAddress->city;
        }else{
            $orderAddress="none";
        }

        foreach($orderItems as $orderItem){
            $orderPlan = "";
            $planPic="";
            $planName = "";
            $chefName = "";
            $orderType="";
            if($orderItem->order_type==0){
                $orderPlan = Plan::where('id','=',$orderItem->plan_id)->first();
                $planPic=$orderPlan->picture;
                $planName = $orderPlan->plan_name;
                $chefName = $orderPlan->chef->name;
                $orderType = "Standard";
            }elseif($orderItem->order_type==1 || $orderItem->order_type==2){
                if($orderItem->order_type==1 ){
                    $orderPlan = CustomPlan::where('id','=',$orderItem->plan_id)->first();
                }elseif($orderItem->order_type==2){
                    $orderPlan = SimpleCustomPlan::where('id','=',$orderItem->plan_id)->first();
                }
                $planPic=$orderPlan->plan->picture;
                $planName = $orderPlan->plan->plan_name;
                $chefName = $orderPlan->plan->chef->name;
                $orderType = "Customized";
            }

            $orderItemArray[]= array('id'=>$orderItem->id,'order_id'=>$orderItem->order_id,
                'plan'=>$planName,'planPic'=>$planPic,'chef'=>$chefName,'type'=>$orderType,'quantity'=>$orderItem->quantity,'price'=>'PHP '.number_format($orderItem->price,2,'.',','));
        }

        return view('admin.order')->with([
            'order'=>$order,
            'orderItems'=>$orderItems,
            'orderItemArray'=>$orderItemArray,
            'orderAddress'=>$orderAddress
        ]);
    }

    public function orderCancel(Order $order)
    {
        $order->is_cancelled=1;
        $order->save();

        return back()->with(['status'=>'Cancelled Order']);
    }

    public function orderChange($type)
    {
        $thisDay = Carbon::today();
//        $orderArray[] = array('id'=>$order->id,'address'=>$orderAddress,'total'=>number_format($order->total,2,'.',','),
//            'is_paid'=>$is_paid,'is_cancelled'=>$order->is_cancelled,'week'=>$startOfWeek,'created_at'=>$order->created_at);
       $

        $thisInput = null;
        if($type==2){
            $i = 0;
            $orders = Order::where('created_at', '>', $startOfTheWeek)
                ->where('created_at', '<', $endOfWeek)->where('is_cancelled','=',0)->orderBy('is_paid','ASC')
                ->latest()->get();
              if ($orders->count() > 0) {
                  $thisInput = '[';
                  foreach ($orders as $order) {
                      $thisInput .= '{';
                      $thisInput .= '"id":' . $order->id . ', ';
                      $thisInput .= '"total":"PHP ' . number_format($order->total, 2, '.', ',') . '", ';
                      $is_paid = "";
                      if ($order->is_paid == 0) {
                          $is_paid = "Pending";
                      } elseif ($order->is_paid == 1) {
                          $is_paid = "Paid";
                      }
                      $thisInput .= '"is_paid":"' . $is_paid . '", ';
                      $thisInput .= '"is_cancelled":' . $order->is_cancelled . ', ';
                      $thisInput .= '"created_at":"' . $order->created_at . '", ';
                      if (++$i < $orders->count()) {
                          $thisInput .= '},';
                      } else {
                          $thisInput .= '}';
                      }
                  }
                  $thisInput .= ']';
              }
            return $thisInput;
        }else if($type==3){
            $i = 0;
            $orders = Order::where('created_at', '>', $startOfMonth)
                ->where('created_at', '<', $endOfMonth)->where('is_cancelled','=',0)->orderBy('is_paid','ASC')
                ->latest()->get();
              if ($orders->count() > 0) {
                  $thisInput = '[';
                  foreach ($orders as $order) {
                      $thisInput .= '{';
                      $thisInput .= '"id":' . $order->id . ', ';
                      $thisInput .= '"total":"PHP ' . number_format($order->total, 2, '.', ',') . '", ';
                      $is_paid = "";
                      if ($order->is_paid == 0) {
                          $is_paid = "Pending";
                      } elseif ($order->is_paid == 1) {
                          $is_paid = "Paid";
                      }
                      $thisInput .= '"is_paid":"' . $is_paid . '", ';
                      $thisInput .= '"is_cancelled":' . $order->is_cancelled . ', ';
                      $thisInput .= '"created_at":"' . $order->created_at . '", ';
                      if (++$i < $orders->count()) {
                          $thisInput .= '},';
                      } else {
                          $thisInput .= '}';
                      }
                  }
                  $thisInput .= ']';
              }
                return $thisInput;
        }else if($type==4) {
                  $i = 0;
                  $orders = Order::where('created_at', '>', $startOfYear)
                      ->where('created_at', '<', $endOfYear)->where('is_cancelled', '=', 0)->orderBy('is_paid', 'ASC')
                      ->latest()->get();
                  if ($orders->count() > 0) {
                      $thisInput = '[';
                      foreach ($orders as $order) {
                          $thisInput .= '{';
                          $thisInput .= '"id":' . $order->id . ', ';
                          $thisInput .= '"total":"PHP ' . number_format($order->total, 2, '.', ',') . '", ';
                          $is_paid = "";
                          if ($order->is_paid == 0) {
                              $is_paid = "Pending";
                          } elseif ($order->is_paid == 1) {
                              $is_paid = "Paid";
                          }
                          $thisInput .= '"is_paid":"' . $is_paid . '", ';
                          $thisInput .= '"is_cancelled":' . $order->is_cancelled . ', ';
                          $thisInput .= '"created_at":"' . $order->created_at . '", ';
                          if (++$i < $orders->count()) {
                              $thisInput .= '},';
                          } else {
                              $thisInput .= '}';
                          }
                      }
                      $thisInput .= ']';
                  }
                      return $thisInput;
        }
        return $thisInput;
    }

}
