<?php

namespace App\Http\Controllers\Chef;

use App\Chat;
use App\Foodie;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Chef\Auth\VerifiesSms;
use App\Message;
use App\Notification;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChefMessageController extends Controller{
    use VerifiesSms;
    protected $redirectTo = '/chef/message/index';
    /**
     * Check for chef authentication
     *
     * @return void
     */
    public function __construct(){
        $this->middleware('chef.auth');
    }

    public function index(){
        $foodies = Foodie::all();
        $chef = Auth::guard('chef')->user();
        $chats = Chat::where('chef_id', '=', $chef->id)->get();

        $messages = Message::where('receiver_id', '=', $chef->id)->where('receiver_type', '=', 'c')->where('is_read','=',0)->get();
        $notifications=Notification::where('receiver_id','=',$chef->id)->where('receiver_type','=','c')->get();

        return view('chef.messaging.chefMessages')->with([
            'sms_unverified' => $this->mobileNumberExists(),
            'chef'=>$chef,
            'foodies'=>$foodies,
            'chats' => $chats,
            'messages'=>$messages,
            'chatId' => '',
            'notifications'=>$notifications
        ]);

    }

    public function message($id){

        $chef=Auth::guard('chef')->user();
        $foodies = Foodie::all();
        $chats= Chat::where('chef_id','=',$chef->id)->latest($column = 'updated_at')->get();
        $selectedChat= $chats->where('id', $id)->first();


        foreach($selectedChat->message()->where('receiver_type','c')->latest()->get() as $message){
            if($message->is_read==0){
                $message->is_read=1;
                $message->save();
            }
        }

        $messages = Message::where('receiver_id', '=', $chef->id)->where('receiver_type', '=', 'c')->where('is_read','=',0)->get();
        $notifications=Notification::where('receiver_id','=',$chef->id)->where('receiver_type','=','c')->get();
//        dd($notifications);
        return view('chef.messaging.chefMessages')->with([
            'sms_unverified' => $this->mobileNumberExists(),
            'chef'=>$chef,
            'foodies'=>$foodies,
            'chats' => $chats,
            'messages'=>$messages,
            'chatId' => $id,
            'notifications' => $notifications
        ]);

    }

    public function readMessage(Message $message){
        $message->is_read = 1;
        $message->save();
        return back();
    }

    public function send(Request $request){

        $this->validate($request, [
            'chefSubject' => 'required|max:255',
            'chefMessage' => 'required|max:255',
        ]);

        $chat = new Chat();
        $chat->foodie_id = $request['chefMessageSelect'];
        $chat->chef_id = Auth::guard('chef')->user()->id;
        $chat->save();

        $chtId=$chat->id;

        $message = new Message();
        $message->chat_id = $chtId;
        $message->subject = $request['chefSubject'];
        $message->message = $request['chefMessage'];
        $message->sender_id = Auth::guard('chef')->user()->id;
        $message->receiver_id = $request['chefMessageSelect'];
        $message->receiver_type = 'f';
        $message->save();

        return redirect()->route('chef.message.message', compact('chtId'))->with([
            'status'=>'Successfully sent the message!'
        ]);

    }

    public function reply(Request $request){
        $this->validate($request, [
            'replyMessage' => 'required|max:255',
        ]);

        $chtId = $request['chtId'];

        $replyChat = Chat::where('id','=',$chtId)->first();
        $replyChat->updated_at= Carbon::now();
        $replyChat->save();

        $message = new Message();
        $message->subject = $request['replySubject'];
        $message->message = $request['replyMessage'];
        $message->sender_id = Auth::guard('chef')->user()->id;
        $message->receiver_id=$request['replyRec'];
        $message->chat_id=$chtId;
        $message->receiver_type = 'f';
        $message->save();

        return redirect()->route('chef.message.message', compact('chtId'))->with(['status'=>'Successfully sent the message!']);
    }

    public function delete(Message $message){
        $message->delete();

        return redirect($this->redirectTo)->with(['status'=>'Successfully deleted the message!']);
    }
}
