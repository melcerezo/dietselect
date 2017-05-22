<?php

namespace App\Http\Controllers\Foodie;


use App\Chat;
use App\Chef;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Foodie\Auth\VerifiesSms;
use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FoodieMessageController extends Controller
{
    use VerifiesSms;
    protected $redirectTo = '/foodie/message/index';

    /**
     * foodie authentication
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('foodie.auth');
    }


    public function index($id){
        $foodie=Auth::guard('foodie')->user();
        $chefs = Chef::all();
        $chats= Chat::where('foodie_id','=',$foodie->id)->get();
//        $messages = Message::where('receiver_id', '=', $foodie->id)->where('receiver_type', '=', 'f')->where('is_read','=',0)->get();
//        $aMessages = Message::where('receiver_id', '=', $foodie->id)->where('receiver_type', '=', 'f')->where('is_read','=',0)->get();
//        dd($id);
        return view('foodie.messaging.foodieMessages')->with([
            'sms_unverified' => $this->smsIsUnverified(),
            'foodie'=>$foodie,
            'chefs'=>$chefs,
            'chats' => $chats,
            'chatId' => $id
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

        return redirect($this->redirectTo)->with(['status'=>'Successfully sent the message!']);

    }

    public function reply(Request $request, $id){
        $this->validate($request, [
            'replyMessage' => 'required|max:255',
        ]);

        $message = new Message();
        $message->message =$request['replyMessage'];
        $message->sender_id= Auth::guard('foodie')->user()->id;
        $message->receiver_id= $id;
        $message->receiver_type='c';
        $message->save();

        return redirect($this->redirectTo)->with(['status'=>'Successfully sent the message!']);

    }
    public function delete(Message $message){
//        dd($message->id);
        $message->delete();

        return redirect($this->redirectTo)->with(['status'=>'Successfully deleted the message!']);
    }

}
