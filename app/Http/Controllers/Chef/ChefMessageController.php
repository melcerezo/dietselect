<?php

namespace App\Http\Controllers\Chef;

use App\Foodie;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Chef\Auth\VerifiesSms;
use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChefMessageController extends Controller
{
    use VerifiesSms;

    /**
     * Check for chef authentication
     *
     * @return void
     */
    public function __construct()
    {
            $this->middleware('chef.auth');
    }


    public function index(){
        $foodies = Foodie::all();
        $messages= '';
        $chef= Auth::guard('chef')->user();


        $messageCount= Message::where('receiver_id','=',$chef->id)->get()->count();
        if($messageCount>0){
            $messages= Message::where('receiver_id','=',$chef->id);
        }
        return view('chef.messaging.chefMessages')->with([
            'sms_unverified' => $this->mobileNumberExists(),
            'foodies'=>$foodies,
            'chef'=>$chef,
            'messageCount'=>$messageCount,
            'messages'=>$messages
        ]);

    }

    public function send(Request $request){

        $this->validate($request, [
            'chefMessage' => 'required|max:255',
        ]);

        $message = new Message();
        $message->message =$request['chefMessage'];
        $message->sender_id= Auth::guard('chef')->user()->id;
        $message->receiver_id= $request['chefMessageSelect'];
        $message->receiver_type='f';
        $message->save();

        return back();
    }
}
