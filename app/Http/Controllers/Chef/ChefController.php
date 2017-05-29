<?php

namespace App\Http\Controllers\Chef;

use App\Chat;
use App\Chef;
use App\Foodie;
use App\Http\Controllers\Chef\Auth\VerifiesEmail;
use App\Http\Controllers\Chef\Auth\VerifiesSms;
use App\Http\Controllers\Controller;
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
        $orders='';
        $ordersCount=Order::where('chef_id', '=', Auth::guard('chef')->user()->id)->where('is_paid','=',0)->get()->count();

        if($ordersCount >0){
            $orders = Order::where('chef_id', '=', Auth::guard('chef')->user()->id)
                ->where('is_paid','=',0)
                ->orderBy('created_at', 'desc')->get();
        }
        $messages = Message::where('receiver_id', '=', $chef->id)->where('receiver_type', '=', 'c')->where('is_read','=',0)->get();
//        dd($messageCount);


        return view('chef.dashboard')->with([
            'sms_unverified' => $this->mobileNumberExists(),
            'chef' => Auth::guard('chef')->user(),
            'foodies' => $foodies,
            'plans' =>$plans,
            'ordersCount' => $ordersCount,
            'orders' => $orders,
            'messages'=>$messages,
            'chats'=>$chats
        ]);
    }

    public function profile()
    {
        $foodies=Foodie::all();
        $chef= Chef::where('id','=',Auth::guard('chef')->user()->id)->first();
        $chats= Chat::where('chef_id','=',$chef->id)->latest($column = 'updated_at')->get();
        $messages = Message::where('receiver_id', '=', $chef->id)->where('receiver_type', '=', 'c')->where('is_read','=',0)->get();
        return view('chef.profile')->with([
            'chef'=>$chef,
            'sms_unverified' => $this->mobileNumberExists(),
            'messages'=>$messages,
            'chats'=>$chats,
            'foodies' => $foodies,
        ]);
    }

    public function saveProfileBasic(Request $request)
    {
        Validator::make($request->all(), [
            'company_name' => 'required|max:100',
            'mobile_number' => 'required|max:100',
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
        $chef->mobile_number=$request['mobile_number'];
        $chef->website=$request['website'];
        $chef->save();

        return redirect($this->redirectTo)->with(['status'=>'Successfully updated the info!']);

    }
}
