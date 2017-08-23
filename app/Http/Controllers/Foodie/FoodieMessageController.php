<?php

namespace App\Http\Controllers\Foodie;


use App\Chat;
use App\Notification;
use App\Chef;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Foodie\Auth\VerifiesSms;
use App\Message;
use Carbon\Carbon;
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


    public function index(){

        $foodie=Auth::guard('foodie')->user();
        $chefs = Chef::all();
        $chats= Chat::where('foodie_id','=',$foodie->id)->where('foodie_can_see','=',1)->latest($column = 'updated_at')->get();
        $messages = Message::where('receiver_id', '=', $foodie->id)
            ->where('receiver_type', '=', 'f')
            ->where('is_read','=',0)->where('foodie_can_see','=',1)->get();
//        $aMessages = Message::where('receiver_id', '=', $foodie->id)->where('receiver_type', '=', 'f')->where('is_read','=',0)->get();
//        dd($id);
        $notifications=Notification::where('receiver_id','=',$foodie->id)->where('receiver_type','=','f')->get();
        $unreadNotifications=Notification::where('receiver_id','=',$foodie)->where('receiver_type','=','f')->where('is_read','=',0)->count();
        return view('foodie.messaging.foodieMessages')->with([
            'sms_unverified' => $this->smsIsUnverified(),
            'foodie'=>$foodie,
            'chefs'=>$chefs,
            'chats' => $chats,
            'notifications'=>$notifications,
            'unreadNotifications'=>$unreadNotifications,
            'messages' => $messages,
            'chatId' => ''
        ]);
    }

    public function message($id){

        $foodie=Auth::guard('foodie')->user();
        $chefs = Chef::all();
        $chats= Chat::where('foodie_id','=',$foodie->id)->where('foodie_can_see', '=', 1)->latest($column = 'updated_at')->get();
        $selectedChat= $chats->where('id', $id)->first();


            foreach($selectedChat->message()->where('receiver_type','f')->latest()->get() as $message){
                if($message->is_read==0){
                    $message->is_read=1;
                    $message->save();
                }
            }

        $messages = Message::where('receiver_id', '=', $foodie->id)->where('foodie_can_see', '=', 1)->where('receiver_type', '=', 'f')->where('is_read','=',0)->get();
//        $aMessages = Message::where('receiver_id', '=', $foodie->id)->where('receiver_type', '=', 'f')->where('is_read','=',0)->get();
//        dd($id);
        $notifications=Notification::where('receiver_id','=',$foodie->id)->where('receiver_type','=','f')->get();
        $unreadNotifications=Notification::where('receiver_id','=',$foodie)->where('receiver_type','=','f')->where('is_read','=',0)->count();
        return view('foodie.messaging.foodieMessages')->with([
            'sms_unverified' => $this->smsIsUnverified(),
            'foodie'=>$foodie,
            'chefs'=>$chefs,
            'chats' => $chats,
            'messages'=>$messages,
            'notifications'=>$notifications,
            'unreadNotifications'=>$unreadNotifications,
            'chatId' => $id
        ]);

    }

    public function send(Request $request){

        $this->validate($request, [
            'foodieMessage' => 'required|max:255',
        ]);
//        dd('Hello');
        $chat = new Chat();
        $chat->foodie_id = Auth::guard('foodie')->user()->id;
        $chat->chef_id = $request['foodieMessageSelect'];
        $chat->save();

        $chtId=$chat->id;

        $message = new Message();
        $message->subject =$request['foodieSubject'];
        $message->message =$request['foodieMessage'];
        $message->sender_id= Auth::guard('foodie')->user()->id;
        $message->receiver_id= $request['foodieMessageSelect'];
        $message->chat_id = $chtId;
        $message->receiver_type='c';
        $message->save();

        return redirect()->route('foodie.message.message', compact('chtId'))->with([
            'status'=>'Successfully sent the message!'
        ]);

    }

    public function reply(Request $request){
        $this->validate($request, [
            'replySubject' => 'required|max:255',
            'replyMessage' => 'required|max:255',
        ]);
//        dd($request['replyMessage']);
        $chtId = $request['chtId'];

        $replyChat = Chat::where('id','=',$chtId)->first();
        $replyChat->updated_at= Carbon::now();
        $replyChat->save();

        $message = new Message();
        $message->subject=$request['replySubject'];
        $message->message =$request['replyMessage'];
        $message->sender_id= Auth::guard('foodie')->user()->id;
        $message->receiver_id=$request['replyRec'];
        $message->chat_id=$chtId;
        $message->receiver_type='c';
        $message->save();

        return redirect()->route('foodie.message.message', compact('chtId'))->with(['status'=>'Successfully sent the message!']);



    }

    public function deleteChat($id){
        $chat = Chat::where('id','=', $id)->first();
        $messages= $chat->message()->get();
        foreach($messages as $message){
            $message->foodie_can_see=0;
            $message->save();
        }
        $chat->foodie_can_see=0;
        $chat->save();

        return redirect()->route('foodie.message.index')->with(['status'=>'Deleted Chat']);
    }


    public function delete(Message $message){
//        dd($message->id);
        $message->delete();

        return redirect($this->redirectTo)->with(['status'=>'Successfully deleted the message!']);
    }

}
