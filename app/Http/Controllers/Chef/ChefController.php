<?php

namespace App\Http\Controllers\Chef;

use App\Chat;
use App\Chef;
use App\ChefBankAccount;
use App\CustomPlan;
use App\SimpleCustomPlan;
use Carbon\Carbon;
use App\Foodie;
use App\Http\Controllers\Chef\Auth\VerifiesEmail;
use App\Http\Controllers\Chef\Auth\VerifiesSms;
use App\Http\Controllers\Controller;
use App\Notification;
use App\OrderItem;
use App\Plan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Order;
use App\Rating;
use Validator;
use App\Message;
//use GuzzleHttp\Message\Request;

class ChefController extends Controller
{
    use VerifiesSms;

    protected $redirectTo = '/chef/profile';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('chef.auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $lastTwoWeeks = Carbon::parse("previous week Saturday 15:00:00")->subDays(7)->format('Y-m-d H:i:s');
        $lastSaturday = Carbon::parse("last saturday 15:01:00")->format('Y-m-d H:i:s');
        $dt = Carbon::now();

        $chef= Auth::guard('chef')->user();
        $foodies=Foodie::all();
        $prevPlans = Plan::where('chef_id','=',$chef->id)
                ->where('created_at','<=',$lastTwoWeeks)
                ->latest($column = 'created_at')
                ->take(3)->get();
        $plans= Plan::where('chef_id','=',$chef->id)
            ->where('created_at','>=',$lastTwoWeeks)
            ->where('created_at','<=',$lastSaturday)
            ->latest($column = 'created_at')->take(3)->get();
        $pendPlans = Plan::where('chef_id','=',$chef->id)
            ->where('created_at','>=',$lastSaturday)
            ->latest($column = 'created_at')->take(3)->get();
        $chats= Chat::where('chef_id','=',$chef->id)->where('chef_can_see', '=', 1)->latest($column = 'created_at')->get();

        $ratings = Rating::where('chef_id','=',$chef->id)->where('is_rated','=',1)->latest($column = 'updated_at')->take(3)->get();

//        dd($chats->count());


        $pendingOrderItems = OrderItem::where('chef_id','=',$chef->id)->orderBy('created_at','desc')->take(5)->get();

        $pendingOrders = [];

        $paidOrders = [];


//        dd($pendingOrderItems);

        foreach($pendingOrderItems as $orderItem){
            if($orderItem->order->is_paid == 0 && $orderItem->order->is_cancelled!=1){

                $planName="";
                $type="";
                if($orderItem->order_type==0){
                    $plan = Plan::where('id','=',$orderItem->plan_id)->first();
                    $planName = $plan->plan_name;
                    $type = "Standard";
                }elseif($orderItem->order_type==1){
                    $plan = CustomPlan::where('id','=',$orderItem->plan_id)->first();
                    $planName = $plan->plan->plan_name;
                    $type = "Customized";
                }elseif($orderItem->order_type==2){
                    $plan = SimpleCustomPlan::where('id','=',$orderItem->plan_id)->first();
                    $planName = $plan->plan->plan_name;
                    $type = "Customized";
                }

                $pendingOrders[]=array('id'=>$orderItem->id,'name'=> $planName,
                    'quantity'=>$orderItem->quantity,'foodie_id'=>$orderItem->order->foodie_id,
                    'address_id'=>$orderItem->order->address_id,'type'=>$type);
            }else if($orderItem->order->is_paid == 1 && $orderItem->order->is_cancelled!=1){

                $planName="";
                $type="";
                if($orderItem->order_type==0){
                    $plan = Plan::where('id','=',$orderItem->plan_id)->first();
                    $planName = $plan->plan_name;
                    $type = "Standard";
                }elseif($orderItem->order_type==1){
                    $plan = CustomPlan::where('id','=',$orderItem->plan_id)->first();
                    $planName = $plan->plan->plan_name;
                    $type = "Customized";
                }elseif($orderItem->order_type==2){
                    $plan = SimpleCustomPlan::where('id','=',$orderItem->plan_id)->first();
                    $planName = $plan->plan->plan_name;
                    $type = "Customized";
                }

                $paidOrders[]=array('id'=>$orderItem->id,'name'=> $planName,
                    'quantity'=>$orderItem->quantity,'foodie_id'=>$orderItem->order->foodie_id,
                    'address_id'=>$orderItem->order->address_id,'type'=>$type);
            }
        }
//        dd($pendingOrders);



//        $pendingOrderItems=DB::table('order_items')->join('orders','orders.id','=','order_items.order_id')
//            ->join('plans','plans.id','=','order_items.plan_id')
//            ->where('plans.chef_id','=',$chef->id)
//            ->where('orders.is_paid','=',1)
//            ->where('orders.is_cancelled','=',0)
//            ->where('orders.created_at','>',$lastSaturday)
//            ->select('order_items.id','plans.plan_name','order_items.quantity','orders.foodie_id','orders.address_id',
//                'order_items.order_type','order_items.created_at','order_items.updated_at')
//            ->get();
//
//        dd($lastSaturday);

        $messages = Message::where('receiver_id', '=', $chef->id)->where('chef_can_see', '=', 1)->where('receiver_type', '=', 'c')->where('is_read','=',0)->get();
//        dd($messageCount);

        $notifications=Notification::where('receiver_id','=',$chef->id)->where('receiver_type','=','c')->get();

//        dd($notifications);
        return view('chef.dashboard')->with([
            'sms_unverified' => $this->mobileNumberExists(),
            'chef' => Auth::guard('chef')->user(),
            'foodies' => $foodies,
            'prevPlans'=>$prevPlans,
            'plans' =>$plans,
            'pendPlans'=>$pendPlans,
            'pendingOrders' => $pendingOrders,
            'paidOrders'=>$paidOrders,
            'messages'=>$messages,
            'chats'=>$chats,
            'notifications'=>$notifications,
            'ratings'=>$ratings
        ]);
    }

    public function profile()
    {
        $foodies=Foodie::all();
        $chef= Auth::guard('chef')->user();
        $chats= Chat::where('chef_id','=',$chef->id)->where('chef_can_see', '=', 1)->latest($column = 'updated_at')->get();
        $messages = Message::where('receiver_id', '=', $chef->id)->where('chef_can_see', '=', 1)->where('receiver_type', '=', 'c')->where('is_read','=',0)->get();
        $notifications=Notification::where('receiver_id','=',$chef->id)->where('receiver_type','=','c')->get();

        return view('chef.profile')->with([
            'chef'=>$chef,
            'sms_unverified' => $this->mobileNumberExists(),
            'messages'=>$messages,
            'chats'=>$chats,
            'foodies' => $foodies,
            'notifications'=>$notifications
        ]);
    }

    public function saveProfileCoverPhoto(Request $request)
    {
//        dd($request->file('cover'));
//        dd($request->hasFile('cover'));
        Validator::make($request->all(), [
            'cover' => 'required'
        ])->validate();

        $chef=Auth::guard('chef')->user();
        if($request->hasFile('cover')){
            $avatar = $request->file('cover');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            // Change Directory HERE
            Image::make($avatar)->resize(500, 500)->save(public_path('img/' . $filename));
            $chef->cover=$filename;
//            dd($foodie->cover);
            $chef->save();

            return back()->with(['status'=>'Successfully updated the cover photo']);
        }
            return back()->with(['status'=>'File Format is not supported! Please try another photo!']);
    }

    public function saveProfileBasic(Request $request)
    {
        Validator::make($request->all(), [
            'company_name' => 'required|max:100',
//            'mobile_number' => 'required|max:100',
            'email' =>'required|email|max:50',
            'website' =>'url|max:50',
            'bank' =>'required',
            'account'=>'required|numeric'
        ])->validate();

        $chef= Auth::guard('chef')->user();
        $chef->name=$request['company_name'];
        $chef->email=$request['email'];
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            // Change Directory HERE
            Image::make($avatar)->resize(500, 500)->save(public_path('img/' . $filename));
            $chef->avatar = $filename;
        }
//        $chef->mobile_number=$request['mobile_number'];
        $chef->website=$request['website'];
        $chef->save();

        if($chef->bank_account==null){
            $bank = new ChefBankAccount();
            $bank->chef_id=$chef->id;
            $bank->bank = $request['bank'];
            $bank->account = $request['account'];
            $bank->save();
        }else{
            $bank = $chef->bank_account;
            $bank->bank=$request['bank'];
            $bank->account = $request['account'];
            $bank->save();
        }

        return redirect($this->redirectTo)->with(['status'=>'Successfully updated the info!']);

    }

    public function getNotif()
    {
        $i=0;
        $chef = Auth::guard('chef')->user()->id;
        $notification = Notification::where('receiver_id','=', $chef)->where('receiver_type','=','c')->latest($column='created_at')->take(5)->get();
        $notifJson = '[';
        foreach($notification as $note){
            if(++$i<$notification->count()){
                $notifJson.='{ "id":"'.$note->id.'", "notification":"'.$note->notification.'", "is_read":"'.$note->is_read.'", "notification_type":"'.$note->notification_type.'", "created_at":"'.$note->created_at->format('d F,  H:ia').'"},';
            }else{
                $notifJson.='{ "id":"'.$note->id.'", "notification":"'.$note->notification.'", "is_read":"'.$note->is_read.'", "notification_type":"'.$note->notification_type.'", "created_at":"'.$note->created_at->format('d F,  H:ia').'"} ';
            }
        }
        $notifJson .= ']';

        return $notifJson;
    }

    public function clearNotifAll()
    {
        $chef = Auth::guard('chef')->user()->id;
        $notifications = Notification::where('receiver_id','=', $chef)->where('receiver_type','=','c')->latest($column='created_at')->take(5)->get();
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
