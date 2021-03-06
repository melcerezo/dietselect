<?php

namespace App\Http\Controllers\Admin;

use App\Allergy;
use App\ChefBankAccount;
use App\FoodiePreference;
use App\Http\Controllers\Controller;
use App\Mail\AdminCancelFoodie;
use App\Mail\ChefCommission;
use App\Mail\ChefFreeze;
use App\Mail\FreezeMail;
use App\Mail\RefundSuccessFoodie;
use App\Message;
use App\Notification;
use App\Refund;
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
use Intervention\Image\Facades\Image;


class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin.auth');
    }

    public function index()
    {
//        dd(Auth::guard('admin')->user());
        $admin = Auth::guard('admin')->user()->id;
        $notification = Notification::where('receiver_id','=', $admin)->where('receiver_type','=','a')->latest($column='created_at')->take(5)->get();
        $foodies=Foodie::orderBy('created_at', 'desc')->get();
        $chefs=Chef::orderBy('created_at', 'desc')->get();
        $orders = Order::orderBy('created_at', 'desc')->get();
        $plans = Plan::orderBy('created_at', 'desc')->get();
        $commissions = Commission::where('paid','=',0)->orderBy('created_at', 'desc')->get();
        $paidCommissions = Commission::where('paid','=',1)->orderBy('created_at', 'desc')->get();
        $refunds = Refund::where('is_paid','=',0)->orderBy('created_at','desc')->get();

        return view("admin.dashboard")->with([
            'foodies'=>$foodies,
            'chefs'=>$chefs,
            'orders'=>$orders,
            'plans'=>$plans,
            'commissions'=>$commissions,
            'refunds'=>$refunds,
            'paidCommissions'=>$paidCommissions,
            'notifications'=>$notification
        ]);
    }



    public function commissions()
    {

        $admin = Auth::guard('admin')->user()->id;
        $notification = Notification::where('receiver_id','=', $admin)->where('receiver_type','=','a')->latest($column='created_at')->take(5)->get();
        $chefs=Chef::orderBy('created_at', 'desc')->get();
        $commissions = Commission::orderBy('created_at', 'desc')->get();
        $firstCom = Commission::first();
        $lastCom = Commission::latest()->first();

//        $current = Carbon::now();
//        $currentMonth = $current->copy()->month;
//        $commissions = Commission::orderBy('created_at', 'desc')->get();
//        $months = [];
//        $months[]=array('current'=>1,'month'=>$currentMonth);
//        foreach($commissions as $commission){
//            if($commission->created_at->copy()->month < $currentMonth){
//                $months[]=array('current'=>0,'month'=>$commission->created_at->copy()->month);
//            }
////            $months[]=
////                array('month'=>$commission->created_at->copy()->format('m'),
////                'start'=>$commission->created_at->copy()->startOfMonth(),
////                'end'=>$commission->created_at->copy()->endOfMonth());
//        }
//
//        $months = array_intersect_key($months, array_unique(array_map('serialize', $months)));
//        $monthJson = json_encode($months);
//
////        $uniqueMonths = array_unique($months);
//        dd($monthJson);



        $totalCommissions = 0;
        $pendCommissions = 0;
        $paidCommissions = 0;

        $comChefs =[];

        foreach($commissions as $commission){
            $totalCommissions+=$commission->amount;
            $comChefs[]=$commission->chef_id;
        }
        $uniqueComChefs = array_unique($comChefs);

        $uniqueComArray =[];

        foreach($uniqueComChefs as $uniqueComChef){
            $comTotal = 0;
            $comPend = 0;
            $comPaid = 0;
            foreach($commissions->where('chef_id','=',$uniqueComChef) as $commission){
                $comTotal += $commission->amount;
            }
            foreach($commissions->where('chef_id','=',$uniqueComChef)->where('paid','=',0) as $commission){
                $comPend += $commission->amount;
            }
            foreach($commissions->where('chef_id','=',$uniqueComChef)->where('paid','=',1) as $commission){
                $comPaid += $commission->amount;
            }

            $uniqueComArray[]= array('id'=>$uniqueComChef,'total'=>$comTotal,'pend'=>$comPend,'paid'=>$comPaid);
        };

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
            'uniqueComChefs'=>$uniqueComChefs,
            'totalCommissions'=>$totalCommissions,
            'pendCommissions'=>$pendCommissions,
            'paidCommissions'=>$paidCommissions,
            'thisDay'=>$thisDay,
            'startWeek'=>$startOfTheWeek,
            'endWeek'=>$endOfWeek,
            'startMonth'=>$startOfMonth,
            'endMonth'=>$endOfMonth,
            'startYear'=>$startOfYear,
            'endYear'=>$endOfYear,
            'firstCom'=>$firstCom,
            'lastCom'=>$lastCom,
            'uniqueComArray'=>$uniqueComArray,
            'notifications'=>$notification

        ]);
    }

    public function payCommission(Order $order, mailer\Mailer $mailer)
    {
        $orderItems = $order->order_item()->get();

        foreach($orderItems as $orderItem){

            if($orderItem->is_cancelled==0){

                $commission= $orderItem->commission;

                $chef = $commission->chef;

                $planName = '';
                if($orderItem->order_type == 0){
                    $orderPlan = Plan::where('id','=',$orderItem->plan_id)->first();
                    $planName = $orderPlan->plan_name;
                }else if($orderItem->order_type == 2){
                    $orderPlan = SimpleCustomPlan::where('id','=',$orderItem->plan_id)->first();
                    $planName = $orderPlan->plan->plan_name;
                }

                $message = 'Greetings from DietSelect! Your commission for the order of '.$planName.' has been updated to paid on: ';
                $message .= Carbon::now()->format('F d, Y g:i A').'. Please check your commissions page to check the commission status';
                $message .= '.';
                $chefPhoneNumber = '0' . $chef->mobile_number;
                $url = 'https://www.itexmo.com/php_api/api.php';
                $itexmo = array('1' => $chefPhoneNumber, '2' => $message, '3' => 'PR-DIETS656642_VBVIA');
                $param = array(
                    'http' => array(
                        'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                        'method' => 'POST',
                        'content' => http_build_query($itexmo),
                    ),
                    "ssl" => array(
                        "verify_peer" => false,
                        "verify_peer_name" => false,
                    ),
                );
                $context = stream_context_create($param);
                file_get_contents($url, false, $context);
                $commission->paid=1;
                $commission->save();

                $chefnotif = new Notification();
                $chefnotif->sender_id = 0;
                $chefnotif->receiver_id = $chef->id;
                $chefnotif->receiver_type = 'c';
                $chefnotif->notification = 'Your commission for '.$planName.' has been paid on '.Carbon::now()->format('F d, Y h:i A').'. Please view the commissions page for more details.';
                $chefnotif->notification_type = 4;
                $chefnotif->save();

                $time = Carbon::now()->format('F d, Y g:i A');

                $mailer->to($chef->email)
                    ->send(new ChefCommission(
                        $planName,
                        $time));

            }
        }


        return back()->with(['status'=>'Paid commissions for this order!']);
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

    public function refundPage()
    {
        $admin = Auth::guard('admin')->user()->id;
        $notification = Notification::where('receiver_id','=', $admin)->where('receiver_type','=','a')->latest($column='created_at')->take(5)->get();
        $foodies = Foodie::orderBy('created_at', 'desc')->get();
        $refunds = Refund::orderBy('created_at','desc')->get();
        $firstRefund = Refund::first();
        $lastRefund = Refund::latest()->first();

        $totalRefunds = 0;
        $pendRefunds = 0;
        $paidRefunds = 0;


        $refundFoodies = [];
        $uniqueRefundArray = [];
        foreach($refunds as $refund){
            $orderItem = $refund->order_item;
            $totalRefunds+= ($orderItem->price * $orderItem->quantity);
            $refFoodie = $refund->foodie->id;
            if(!(in_array($refFoodie,$refundFoodies))){
                $refundFoodies[] = $refFoodie;
            }
        }

        foreach($refunds->where('is_paid','=',0) as $refund){
            $orderItem = $refund->order_item;
            $pendRefunds+= ($orderItem->price * $orderItem->quantity);
        }
        foreach($refunds->where('is_paid','=',1) as $refund){
            $orderItem = $refund->order_item;
            $paidRefunds+= ($orderItem->price * $orderItem->quantity);
        }

        foreach($refundFoodies as $refundFoodie){
            $refundTotal = 0;
            $refundPend = 0;
            $refundPaid = 0;
            foreach($refunds->where('foodie_id','=',$refundFoodie) as $item){
                $orderItem = $item->order_item;
                $refundTotal += ($orderItem->price * $orderItem->quantity);
            }
            foreach($refunds->where('foodie_id','=',$refundFoodie)->where('is_paid','=',0) as $item){
                $orderItem = $item->order_item;
                $refundPend += ($orderItem->price * $orderItem->quantity);
            }
            foreach($refunds->where('foodie_id','=',$refundFoodie)->where('is_paid','=',1) as $item){
                $orderItem = $item->order_item;
                $refundPaid += ($orderItem->price * $orderItem->quantity);
            }

            $uniqueRefundArray[]= array('id'=>$refundFoodie,'total'=>$refundTotal,'pend'=>$refundPend,'paid'=>$refundPaid);
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

        return view("admin.adminRefund")->with([
            'foodies'=>$foodies,
            'refunds'=>$refunds,
            'refundFoodies'=>$refundFoodies,
            'totalRefunds'=>$totalRefunds,
            'pendRefunds'=>$pendRefunds,
            'paidRefunds'=>$paidRefunds,
            'thisDay'=>$thisDay,
            'startOfTheWeek'=>$startOfTheWeek,
            'endOfWeek'=>$endOfWeek,
            'startOfMonth'=>$startOfMonth,
            'endOfMonth'=>$endOfMonth,
            'startOfYear'=>$startOfYear,
            'endOfYear'=>$endOfYear,
            'firstRefund'=>$firstRefund,
            'lastRefund'=>$lastRefund,
            'uniqueRefundArray'=>$uniqueRefundArray,
            'notifications'=>$notification
        ]);
    }

    public function refund(Request $request, mailer\Mailer $mailer)
    {
        $id = $request['refund-id'];
        $refund = Refund::where('id','=',$id)->first();

//        dd($request['refundPic']);
        if($request->hasFile('refundPic')) {
            $avatar = $request->file('refundPic');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            // Change Directory HERE
            Image::make($avatar)->resize(500, 500)->save(public_path('img/refunds/' . $filename));
            $refund->refund_pic = $filename;
            $refund->transfer_number = $request['code'];
            $refund->is_paid = 1;
            $refund->save();
        }

        $foodie = $refund->foodie;
        $orderItem = $refund->order_item;

        $planName = '';
        $chefName = '';
        if($orderItem->order_type == 0){
            $orderPlan = Plan::where('id','=',$orderItem->plan_id)->first();
            $planName = $orderPlan->plan_name;
            $chefName = $orderPlan->chef->name;
        }else if($orderItem->order_type == 2){
            $orderPlan = SimpleCustomPlan::where('id','=',$orderItem->plan_id)->first();
            $planName = $orderPlan->plan->plan_name;
            $chefName = $orderPlan->plan->chef->name;
        }

        $foodnotif = new Notification();
        $foodnotif->sender_id = 0;
        $foodnotif->receiver_id = $foodie->id;
        $foodnotif->receiver_type = 'f';
        $foodnotif->notification = 'Your refund for your order of '.$planName.' has been paid on '.Carbon::now()->format('F d, Y h:i A').', please view the refunds tab on your orders page for more details.';
        $foodnotif->notification_type = 4;
        $foodnotif->save();

        $message = 'Greetings from DietSelect! Your refund for the chef: '.$chefName.'\'s cancellation of your order of '.$planName.' on '.$orderItem->created_at->format('F d, Y').' has been paid on: ';
        $message .= Carbon::now()->format('F d, Y g:i A');
        $message .= '. Please see the refunds tab of your orders page for more details.';
        $foodiePhoneNumber = '0' . $foodie->mobile_number;
        $url = 'https://www.itexmo.com/php_api/api.php';
        $itexmo = array('1' => $foodiePhoneNumber, '2' => $message, '3' => 'PR-DIETS656642_VBVIA');
        $param = array(
            'http' => array(
                'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                'method' => 'POST',
                'content' => http_build_query($itexmo),
            ),
            "ssl" => array(
                "verify_peer" => false,
                "verify_peer_name" => false,
            ),
        );
        $context = stream_context_create($param);
        file_get_contents($url, false, $context);

//        $foodieName = $foodie->first_name.' '.$foodie->last_name;
        $time = $orderItem->created_at->format('F d, Y h:i A');
        $mailer->to($foodie->email)
            ->send(new RefundSuccessFoodie(
//                $foodieName,
                $planName,
                $time
            ));

        return redirect()->route('admin.adminRefund')->with(['status'=>'Refund successfully paid!']);
    }

    public function chefs()
    {

        $admin = Auth::guard('admin')->user()->id;
        $notification = Notification::where('receiver_id','=', $admin)->where('receiver_type','=','a')->latest($column='created_at')->take(5)->get();
        $chefs = Chef::all();

        return view('admin.chefs')->with([
            'chefs'=>$chefs,
            'notifications'=>$notification
        ]);
    }

    public function chef(Chef $chef)
    {

        $admin = Auth::guard('admin')->user()->id;
        $notification = Notification::where('receiver_id','=', $admin)->where('receiver_type','=','a')->latest($column='created_at')->take(5)->get();
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
            'notifications'=>$notification
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
        $admin = Auth::guard('admin')->user()->id;
        $notification = Notification::where('receiver_id','=', $admin)->where('receiver_type','=','a')->latest($column='created_at')->take(5)->get();
        $foodies = Foodie::all();

        return view('admin.foodies')->with([
            'foodies'=>$foodies,
            'notifications'=>$notification
        ]);
    }

    public function foodie(Foodie $foodie)
    {
        $admin = Auth::guard('admin')->user()->id;
        $notification = Notification::where('receiver_id','=', $admin)->where('receiver_type','=','a')->latest($column='created_at')->take(5)->get();
        $orders=Order::where('foodie_id','=',$foodie->id)->orderBy('created_at','desc')->take(5)->get();
        $foodieAddresses = DB::table('foodie_address')->where('foodie_id', '=', $foodie->id)->get();
        $foodieAllergy = Allergy::where('foodie_id','=',$foodie->id)->get();
        $foodiePreference = FoodiePreference::where('foodie_id','=',$foodie->id)->first();

        return view('admin.foodie')->with([
            'foodie'=>$foodie,
            'orders'=>$orders,
            'foodieAddresses'=>$foodieAddresses,
            'foodieAllergy'=>$foodieAllergy,
            'foodiePreference'=>$foodiePreference,
            'notifications'=>$notification
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
        $admin = Auth::guard('admin')->user()->id;
        $notification = Notification::where('receiver_id','=', $admin)->where('receiver_type','=','a')->latest($column='created_at')->take(5)->get();
        $plans = Plan::all();

        return view('admin.plans')->with([
            'plans'=>$plans,
            'notifications'=>$notification
        ]);
    }

    public function plan(Plan $plan)
    {
        $admin = Auth::guard('admin')->user()->id;
        $notification = Notification::where('receiver_id','=', $admin)->where('receiver_type','=','a')->latest($column='created_at')->take(5)->get();
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
            'notifications'=>$notification
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
        $admin = Auth::guard('admin')->user()->id;
        $notification = Notification::where('receiver_id','=', $admin)->where('receiver_type','=','a')->latest($column='created_at')->take(5)->get();
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
            'totalPend'=>$totalPend,
            'notifications'=>$notification
        ]);
    }

    public function order(Order $order)
    {
        $admin = Auth::guard('admin')->user()->id;
        $notification = Notification::where('receiver_id','=', $admin)->where('receiver_type','=','a')->latest($column='created_at')->take(5)->get();
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
        $comCount = 0;
        $pendComCount = false;
        foreach($orderItems as $orderItem){
            $com = Commission::where('order_item_id','=',$orderItem->id)->first();
            if($com!=null){
                $pendComCount = true;
                if($com->paid == 1){
                    $comCount += 1;
                }
            }
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
                'plan'=>$planName,'planPic'=>$planPic,'chef'=>$chefName,'type'=>$orderType,'quantity'=>$orderItem->quantity,'is_delivered'=>$orderItem->is_delivered,
                'is_cancelled'=>$orderItem->is_cancelled,'cancelled_reason'=>$orderItem->cancelled_reason,'price'=>'PHP '.number_format($orderItem->price,2,'.',','));
        }

//        dd($orderItemArray);

        return view('admin.order')->with([
            'order'=>$order,
            'orderItems'=>$orderItems,
            'orderItemArray'=>$orderItemArray,
            'orderAddress'=>$orderAddress,
            'notifications'=>$notification,
            'comCount'=>$comCount,
            'pendComCount'=>$pendComCount
        ]);
    }

    public function orderCancel(Order $order, Request $request, mailer\Mailer $mailer)
    {
        $reason = $request['cancelReason'];
        $orderItems = $order->order_item()->get();

        $foodie = $order->foodie;

        $order->is_cancelled=1;
        if($reason==0){
            $order->cancelled_reason = "Fraudulent Payment Method.";
        }else if($reason==4){
            $order->cancelled_reason = $request['otherReason'];
        }
        $order->save();

        foreach ($orderItems as $orderItem){
            $orderItem->is_cancelled =1;
            if($reason == 0){
                $orderItem->cancelled_reason = "Fraudulent Payment Method.";
            }else if($reason == 4){
                $orderItem->cancelled_reason = $request['otherReason'];
            }
            $orderItem->save();
        }


        $message = 'Greetings from DietSelect! Your order on '.$order->created_at->format('F d, Y h:i A').' has been cancelled by the admin on: ';
        $message .= Carbon::now()->format('F d, Y g:i A');
        $message .= 'due to: ';
        if($reason==0){
            $message .= "Fraudulent Payment Method.";
        }else if($reason==4){
            $message .= $request['otherReason'];
        }
        $foodiePhoneNumber = '0' . $foodie->mobile_number;
        $url = 'https://www.itexmo.com/php_api/api.php';
        $itexmo = array('1' => $foodiePhoneNumber, '2' => $message, '3' => 'PR-DIETS656642_VBVIA');
        $param = array(
            'http' => array(
                'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                'method' => 'POST',
                'content' => http_build_query($itexmo),
            ),
            "ssl" => array(
                "verify_peer" => false,
                "verify_peer_name" => false,
            ),
        );
        $context = stream_context_create($param);
        file_get_contents($url, false, $context);

        $foodieName = $foodie->first_name.' '.$foodie->last_name;
        $time = Carbon::now()->format('F d, Y h:i A');
        $mailMess ='';
        if($reason == 0){
            $mailMess .= "Fraudulent Payment Method.";
        }else if($reason == 4){
            $mailMess .= $request['otherReason'];
        }
        $mailer->to($foodie->email)
            ->send(new AdminCancelFoodie(
                $foodieName,
                $time,
                $mailMess
            ));


        return back()->with(['status'=>'Cancelled Order']);
    }

    public function orderChange($type)
    {
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


//        $orderArray[] = array('id'=>$order->id,'address'=>$orderAddress,'total'=>number_format($order->total,2,'.',','),
//            'is_paid'=>$is_paid,'is_cancelled'=>$order->is_cancelled,'week'=>$startOfWeek,'created_at'=>$order->created_at);


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

    public function getCom($type){
        $thisInput=null;

        if($type==0){
            $commissions = Commission::orderBy('created_at', 'desc')->get();
            $i=0;
            if($commissions->count()){
                $thisInput ='[';
                foreach($commissions as $commission){
                    $thisInput.='{';
                    $thisInput.='"id":'.$commission->id.', ';
                    $thisInput.='"name":"'.$commission->chef->name.'", ';
                    $thisInput.='"created_at":"'.$commission->created_at->format('F d, Y h:i A').'", ';
                    $thisInput.='"amount":"'.'PHP '.number_format($commission->amount,2,'.',',').'", ';
                    $paid ="";
                    if($commission->paid==0){
                        $paid="Pending";
                    }else if($commission->paid==1){
                        $paid="Paid";

                    }

                    $thisInput.='"is_paid":"'.$paid.'"';
                    if (++$i < $commissions->count()) {
                        $thisInput .= '},';
                    } else {
                        $thisInput .= '}';
                    }
                }
                $thisInput .=']';
            }
        }else{
            $id=$type;
            $commissions = Commission::where('chef_id','=',$id)->orderBy('created_at', 'desc')->get();
            $i = 0;
            if($commissions->count()){
                $thisInput ='[';
                foreach($commissions as $commission){
                       $thisInput.='{';
                       $thisInput.='"id":'.$commission->id.', ';
                       $thisInput.='"name":"'.$commission->chefs->name.'", ';
                       $thisInput.='"created_at":'.$commission->created_at->format('F d, Y h:i A').', ';
                       $thisInput.='"amount":"'.'PHP '.number_format($commission->amount,2,'.',',').'", ';
                       $thisInput.='"is_paid":"'.$commission->is_paid.'"';
                        if (++$i < $commissions->count()) {
                            $thisInput .= '},';
                        } else {
                            $thisInput .= '}';
                        }
                }
                $thisInput .=']';
            }
        }
        return $thisInput;
    }

    public function getYears(){
        $current = Carbon::now();
        $currentYear = $current->copy()->year;
        $commissions = Commission::orderBy('created_at', 'desc')->get();
        $years = [];
        $years[]=array('current'=>1,'year'=>$currentYear,'yearText'=>$current->format('Y'));
        foreach($commissions as $commission){
            if($commission->created_at->copy()->year < $currentYear){
                $years[]=array('current'=>0,'year'=>$commission->created_at->copy()->year,'yearText'=>$commission->created_at->copy()->format('Y'));
            }
//            $months[]=
//                array('month'=>$commission->created_at->copy()->format('m'),
//                'start'=>$commission->created_at->copy()->startOfMonth(),
//                'end'=>$commission->created_at->copy()->endOfMonth());
        }

        $years = array_intersect_key($years, array_unique(array_map('serialize', $years)));

//        $monthJson = json_encode($months);
        $i=0;
        $yearJson = '[';
        foreach($years as $year){
            $yearJson .='{';
            $yearJson .= '"current":'.$year['current'].', ';
            $yearJson .= '"year":'.$year['year'].', ';
            $yearJson .= '"yearText":"'.$year['yearText'].'"';
            if (++$i < count($years)) {
                $yearJson .= '},';
            } else {
                $yearJson .= '}';
            }
        }
        $yearJson .=']';

        return $yearJson;
    }

    public function getMonths($val)
    {
        $current = Carbon::now();
        $currentMonth = $current->copy()->month;
        $commissions = Commission::orderBy('created_at', 'desc')->get();
        if($val<$current->copy()->year){
            $current = Carbon::create($val, 12, 31, 0, 0 ,0);

            $months = [];
            $months[]=array('current'=>0,'month'=>$current->copy()->month,'monthText'=>$current->format('F'));
            foreach($commissions as $commission){
                if($commission->created_at < $current){
                    $months[]=array('current'=>0,'month'=>$commission->created_at->copy()->month,'monthText'=>$commission->created_at->copy()->format('F'));
                }
                //            $months[]=
                //                array('month'=>$commission->created_at->copy()->format('m'),
                //                'start'=>$commission->created_at->copy()->startOfMonth(),
                //                'end'=>$commission->created_at->copy()->endOfMonth());
            }
        }else{
            $months = [];
            $months[]=array('current'=>1,'month'=>$currentMonth,'monthText'=>$current->format('F'));
            foreach($commissions as $commission){
                if($commission->created_at->copy()->month < $currentMonth){
                    $months[]=array('current'=>0,'month'=>$commission->created_at->copy()->month,'monthText'=>$commission->created_at->copy()->format('F'));
                }
    //            $months[]=
    //                array('month'=>$commission->created_at->copy()->format('m'),
    //                'start'=>$commission->created_at->copy()->startOfMonth(),
    //                'end'=>$commission->created_at->copy()->endOfMonth());
            }

        }

        $months = array_intersect_key($months, array_unique(array_map('serialize', $months)));

//        $monthJson = json_encode($months);
        $i=0;
        $monthJson = '[';
        foreach($months as $month){
            $monthJson .='{';
            $monthJson .= '"current":'.$month['current'].', ';
            $monthJson .= '"month":'.$month['month'].', ';
            $monthJson .= '"monthText":"'.$month['monthText'].'"';
            if (++$i < count($months)) {
                $monthJson .= '},';
            } else {
                $monthJson .= '}';
            }
        }
        $monthJson .=']';

        return $monthJson;
    }

    public function monthChange($chefId,$yearType,$monthType)
    {
        $year = $yearType;
        $month = $monthType;

        $commissions = Commission::where('chef_id','=',$chefId)->latest()->get();

        $monthComJson ='';
        if($commissions->count()){
            $comArray = [];
            foreach($commissions as $commission){
                if($commission->created_at->copy()->year == $year && $commission->created_at->copy()->month == $month){
                       $comArray[]= array(
                           'id'=>$commission->id,
                           'name'=>$commission->chef->name,
                           'created_at'=>$commission->created_at->format('F d, Y'),
                           'amount'=>$commission->amount,
                           'chefAmount'=>($commission->amount * 0.9),
                           'dietAmount'=>($commission->amount * 0.1),
                           'paid'=>$commission->paid,
                           'status'=>$commission->order_item->is_cancelled
                       );
                }
            }
            $i=0;
            $monthComJson ='[';
            foreach($comArray as $item){
                $monthComJson .='{';
                $monthComJson .='"id":'.$item['id'].', ';
                $monthComJson .='"name":"'.$item['name'].'", ';
                $monthComJson .='"created_at":"'.$item['created_at'].'", ';
                $monthComJson .='"amount":'.$item['amount'].', ';
                $monthComJson .='"chefAmount":'.$item['chefAmount'].', ';
                $monthComJson .='"dietAmount":'.$item['dietAmount'].', ';
                $monthComJson .='"paid":'.$item['paid'].', ';
                $monthComJson .='"status":'.$item['status'].'';
                if (++$i < count($comArray)) {
                    $monthComJson .= '},';
                } else {
                    $monthComJson .= '}';
                }
            }
            $monthComJson .= ']';
        }

        return $monthComJson;
    }




    public function getComChef()
    {
        $comChefs = Commission::orderBy('chef_id','ASC')->groupBy('chef_id')->select('chef_id')->get();
        $chefs = Chef::all();
//        dd($comChefs->count());
        $thisInput = '';
        if($comChefs->count()){
            $i=0;
            $thisInput = '[';
            foreach($comChefs as $comChef){
                $thisInput .= '{';
                foreach ($chefs as $chef){
                    if($chef->id == $comChef->chef_id){
                        $thisInput .= '"id":'. $chef->id.', ' ;
                        $thisInput .= '"name":"'. $chef->name.'"' ;
                    }
                }
                if (++$i < $comChefs->count()) {
                    $thisInput .= '},';
                } else {
                    $thisInput .= '}';
                }
            }
            $thisInput .= ']';
        }
//        dd($thisInput);
        return $thisInput;
    }

    public function getRefFoodie()
    {
        $refFoodies = Refund::orderBy('foodie_id','ASC')->groupBy('foodie_id')->select('foodie_id')->get();
        $foodies = Foodie::all();
    //        dd($comChefs->count());
        $thisInput = '';
        if($refFoodies->count()){
            $i=0;
            $thisInput = '[';
            foreach($refFoodies as $refFoodie){
                $thisInput .= '{';
                foreach ($foodies as $foodie){
                    if($foodie->id == $refFoodie->foodie_id){
                        $thisInput .= '"id":'. $foodie->id.', ' ;
                        $thisInput .= '"name":"'. $foodie->first_name.' '.$foodie->last_name.'"' ;
                    }
                }
                if (++$i < $refFoodies->count()) {
                    $thisInput .= '},';
                } else {
                    $thisInput .= '}';
                }
            }
            $thisInput .= ']';
        }
    //        dd($thisInput);
        return $thisInput;
    }

    public function getRefInfo($id)
    {
        $refund = Refund::where('id','=',$id)->first();
        $foodie = Foodie::where('id','=',$refund->foodie_id)->first();
        //        dd($comChefs->count());
        $thisInput = '';
        if($refund->count()){
            $orderItem = $refund->order_item;
            if ($orderItem->order_type == 0) {
                $orderPlan = Plan::where('id', '=', $orderItem->plan_id)->first();
                //                    dd($orderPlan->picture);
                $planPic = $orderPlan->picture;
                $planName = $orderPlan->plan_name;
                $chefName = $orderPlan->chef->name;
                $orderType = "Standard";
            } elseif ($orderItem->order_type == 1 || $orderItem->order_type == 2) {
                if ($orderItem->order_type == 1) {
                    $orderPlan = CustomPlan::where('id', '=', $orderItem->plan_id)->first();
                } elseif ($orderItem->order_type == 2) {
                    $orderPlan = SimpleCustomPlan::where('id', '=', $orderItem->plan_id)->first();
                }
                if ($orderPlan != null) {
                    $planPic = $orderPlan->plan->picture;
                    $planName = $orderPlan->plan->plan_name;
                    $chefName = $orderPlan->plan->chef->name;
                    $orderType = "Customized";
                }
            }
                $thisInput .= '{';
                    $thisInput .= '"id":'. $foodie->id.', ' ;
                    $thisInput .= '"name":"'. $foodie->first_name.' '.$foodie->last_name.'",' ;
                    $thisInput .= '"plan":"'. $planName.'", ' ;
                    $thisInput .= '"chef":"'. $chefName.'", ' ;
                    $thisInput .= '"method":'. $refund->method.', ' ;
                    if($refund->method == 0){
                        $thisInput .= '"bank_type":'. $refund->bank_type.', ' ;
                        $thisInput .= '"bank_account":'. $refund->bank_account.' ' ;
                    }else if($refund->method == 1){
                        $thisInput .= '"transfer_company":'. $refund->bank_account.' ' ;
                    }

                $thisInput .= '}';
        }
        //        dd($thisInput);
        return $thisInput;
    }

    public function getNotif()
    {
        $i=0;
        $admin = Auth::guard('admin')->user()->id;
        $notification = Notification::where('receiver_id','=', $admin)->where('receiver_type','=','a')->latest($column='created_at')->take(5)->get();
        $notifJson = '[';
        foreach($notification as $note){
            if(++$i<$notification->count()){
                $notifJson.='{ "id":"'.$note->id.'","sender_id":'.$note->sender_id.' ,"notification":"'.$note->notification.'", "is_read":"'.$note->is_read.'", "notification_type":"'.$note->notification_type.'", "created_at":"'.$note->created_at->format('d F,  H:ia').'"},';
            }else{
                $notifJson.='{ "id":"'.$note->id.'","sender_id":'.$note->sender_id.' ,"notification":"'.$note->notification.'", "is_read":"'.$note->is_read.'", "notification_type":"'.$note->notification_type.'", "created_at":"'.$note->created_at->format('d F,  H:ia').'"} ';
            }
        }
        $notifJson .= ']';

        return $notifJson;
    }

    public function clearNotifAll()
    {
        $admin = Auth::guard('admin')->user()->id;
        $notifications = Notification::where('receiver_id','=', $admin)->where('receiver_type','=','a')->latest($column='created_at')->take(5)->get();
        foreach($notifications as $notification){
            $notification->is_read=1;
            $notification->save();
        }
        return null;
    }

    public function clearNotif()
    {
        $clearId = $_GET['id'];
        $clearNotif= Notification::where('id','=',$clearId)->first();
        $clearNotif->is_read=1;
        $clearNotif->save();

        return null;
    }
}



