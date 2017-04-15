<?php

namespace App\Http\Controllers\Chef;

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
        $messages = Message::where('receiver_id', '=', $chef->id)->where('receiver_type', '=', 'c')->get();;

        return view('chef.messaging.chefMessages')->with([
            'sms_unverified' => $this->mobileNumberExists(),
            'foodies' => $foodies,
            'chef' => $chef,
            'messages' => $messages,
        ]);

    }

    public function readMessage(Message $message){
        $message->is_read = 1;
        $message->save();
        return back();
    }

    public function send(Request $request){

        $this->validate($request, [
            'chefMessage' => 'required|max:255',
        ]);

        $message = new Message();
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
