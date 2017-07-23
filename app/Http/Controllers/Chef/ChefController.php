<?php

namespace App\Http\Controllers\Chef;

use App\Chat;
use App\Chef;
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

        $chef= Auth::guard('chef')->user();
        $foodies=Foodie::all();
        $plans= Plan::where('chef_id','=',$chef->id)->latest($column = 'updated_at')->get();
        $chats= Chat::where('chef_id','=',$chef->id)->latest($column = 'updated_at')->get();

        $orderItems=DB::table('order_items')->join('orders','orders.id','=','order_items.order_id')
            ->join('plans','plans.id','=','order_items.plan_id')
            ->where('plans.chef_id','=',$chef->id)
            ->select('order_items.id','plans.plan_name','order_items.quantity','orders.foodie_id','orders.address_id','orders.is_paid',
            'orders.is_cancelled','order_items.order_type','order_items.created_at','order_items.updated_at')
            ->get();
//            ->join('plans', function($join){
//            $join->on('plans.id','=','order_items.plan_id')
//                ->where('plans.chef_id','=',Auth::guard('chef')->user()->id);
//        })->select('plans.plan_name','orders.foodie_id','orders.address_id','order_items.id','order_items.order_type','order_items.quantity')->get();

        dd($orderItems);




        $messages = Message::where('receiver_id', '=', $chef->id)->where('receiver_type', '=', 'c')->where('is_read','=',0)->get();
//        dd($messageCount);

        $notifications=Notification::where('receiver_id','=',$chef->id)->where('receiver_type','=','c')->get();

//        dd($notifications);
        return view('chef.dashboard')->with([
            'sms_unverified' => $this->mobileNumberExists(),
            'chef' => Auth::guard('chef')->user(),
            'foodies' => $foodies,
            'plans' =>$plans,
            'orders' => $orders,
            'messages'=>$messages,
            'chats'=>$chats,
            'notifications'=>$notifications
        ]);
    }

    public function profile()
    {
        $foodies=Foodie::all();
        $chef= Auth::guard('chef')->user();
        $chats= Chat::where('chef_id','=',$chef->id)->latest($column = 'updated_at')->get();
        $messages = Message::where('receiver_id', '=', $chef->id)->where('receiver_type', '=', 'c')->where('is_read','=',0)->get();
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
            'website' =>'url|max:50'
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
                $notifJson.='{ "id":"'.$note->id.'", "notification":"'.$note->notification.'", "is_read":"'.$note->is_read.'", "created_at":"'.$note->created_at->format('d F,  H:ia').'"},';
            }else{
                $notifJson.='{ "id":"'.$note->id.'", "notification":"'.$note->notification.'", "is_read":"'.$note->is_read.'", "created_at":"'.$note->created_at->format('d F,  H:ia').'"} ';
            }
        }
        $notifJson .= ']';

        return $notifJson;
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
