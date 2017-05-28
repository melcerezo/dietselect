<?php

namespace App\Http\Controllers\Chef;

use App\Chat;
use App\Foodie;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Chef\Auth\VerifiesSms;
use App\Message;
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

        return view('chef.messaging.chefMessages')->with([
            'sms_unverified' => $this->mobileNumberExists(),
            'chef'=>$chef,
            'foodies'=>$foodies,
            'chats' => $chats,
            'messages'=>$messages,
            'chatId' => ''
        ]);

    }

    public function message($id){

        $chef=Auth::guard('chef')->user();
        $foodies = Foodie::all();
        $chats= Chat::where('chef_id','=',$chef->id)->latest($column = 'updated_at')->get();
        $selectedChat= $chats->where('id', $id)->first();


        foreach($selectedChat->message()->latest()->get() as $message){
            if($message->is_read==0){
                $message->is_read=1;
                $message->save();
            }
        }

        $messages = Message::where('receiver_id', '=', $chef->id)->where('receiver_type', '=', 'c')->where('is_read','=',0)->get();
        return view('chef.messaging.chefMessages')->with([
            'sms_unverified' => $this->mobileNumberExists(),
            'chef'=>$chef,
            'foodies'=>$foodies,
            'chats' => $chats,
            'messages'=>$messages,
            'chatId' => $id
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

        $message = new Message();
        $message->chat_id = $chat->id;
        $message->subject = $request['chefSubject'];
        $message->message = $request['chefMessage'];
        $message->sender_id = Auth::guard('chef')->user()->id;
        $message->receiver_id = $request['chefMessageSelect'];
        $message->receiver_type = 'f';
        $message->save();

        return redirect($this->redirectTo)->with(['status'=>'Successfully sent the message!']);
    }

    public function reply(Request $request, $id){
        $this->validate($request, [
            'replyMessage' => 'required|max:255',
        ]);

        $message = new Message();
        $message->message = $request['replyMessage'];
        $message->sender_id = Auth::guard('chef')->user()->id;
        $message->receiver_id = $id;
        $message->receiver_type = 'f';
        $message->save();

        return redirect($this->redirectTo)->with(['status'=>'Successfully sent the message!']);
    }

    public function delete(Message $message){
        $message->delete();

        return redirect($this->redirectTo)->with(['status'=>'Successfully deleted the message!']);
    }
}
