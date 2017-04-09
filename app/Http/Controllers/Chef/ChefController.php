<?php

namespace App\Http\Controllers\Chef;

use App\Chef;
use App\Http\Controllers\Chef\Auth\VerifiesEmail;
use App\Http\Controllers\Chef\Auth\VerifiesSms;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Order;
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

        $orders='';
        $ordersCount=Order::where('chef_id', '=', Auth::guard('chef')->user()->id)->where('is_paid','=',0)->get()->count();

        if($ordersCount >0){
            $orders = Order::where('chef_id', '=', Auth::guard('chef')->user()->id)->where('is_paid','=',0)->get();
        }
        $messages= Message::where('receiver_id','=',Auth::guard('chef')->user()->id)->where('receiver_type','=','c')->get();
//        dd($messageCount);

        return view('chef.dashboard')->with([
            'sms_unverified' => $this->mobileNumberExists(),
            'chef' => Auth::guard('chef')->user(),
            'ordersCount' => $ordersCount,
            'orders' => $orders,
            'messages'=>$messages
        ]);
    }

    public function profile()
    {
        $chef= Chef::where('id','=',Auth::guard('chef')->user()->id)->first();
        $messages = Message::where('receiver_id', '=', Auth::guard('chef')->user()->id)->where('receiver_type', '=', 'f')->get();
        return view('chef.profile')->with([
            'chef'=>$chef,
            'sms_unverified' => $this->mobileNumberExists(),
            'messages'=>$messages
        ]);
    }

    public function saveProfileBasic(Request $request)
    {
        Validator::make($request->all(), [
            'company_name' => 'required|max:100',
            'mobile_number' => 'required|max:100',
            'email' =>'required|email|max:50',
            'website' =>'required|url|max:50'
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
