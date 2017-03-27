<?php

namespace App\Http\Controllers\Foodie;


use App\Chef;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Foodie\Auth\VerifiesSms;
use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FoodieMessageController extends Controller
{
    use VerifiesSms;

    /**
     * foodie authentication
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('foodie.auth');
    }


    public function index(){
        $foodie=Auth::guard('foodie')->user();
        $chefs = Chef::all();
        $messages='';
//        retrieving messages
        $messageCount= Message::where('receiver_id','=',$foodie->id)->get()->count();

        if($messageCount>0){
            $messages= Message::where('receiver_id','=',$foodie->id);
        }
        return view('foodie.messaging.foodieMessages')->with([
            'sms_unverified' => $this->smsIsUnverified(),
            'foodie'=>$foodie,
            'chefs'=>$chefs,
            'messageCount'=>$messageCount,
            'messages'=>$messages
        ]);
    }

    public function send(Request $request){

        $this->validate($request, [
            'foodieMessage' => 'required|max:255',
        ]);
//        dd('Hello');

        $message = new Message();
        $message->message =$request['foodieMessage'];
        $message->sender_id= Auth::guard('foodie')->user()->id;
        $message->receiver_id= $request['foodieMessageSelect'];
        $message->receiver_type='c';
        $message->save();

        return back();
    }
}
