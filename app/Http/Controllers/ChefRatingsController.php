<?php

namespace App\Http\Controllers;

use App\Chat;
use App\Http\Controllers\Chef\Auth\VerifiesSms;
use App\Message;
use App\Notification;
use App\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChefRatingsController extends Controller
{
    // View Chef Ratings
    use VerifiesSms;

    public function viewRatings()
    {
        $chef = Auth::guard('chef')->user();
        $ratings = Rating::where('chef_id', '=', $chef->id)->get();
        $chats= Chat::where('chef_id','=',$chef->id)->where('chef_can_see', '=', 1)->latest($column = 'updated_at')->get();
        $messages = Message::where('receiver_id', '=', $chef->id)->where('chef_can_see', '=', 1)->where('receiver_type', '=', 'c')->where('is_read','=',0)->get();
        $notifications=Notification::where('receiver_id','=',$chef->id)->where('receiver_type','=','c')->get();

        return view('chef.ratings', compact('ratings', 'messages', 'chef'))->with([
            'sms_unverified' => $this->mobileNumberExists(),
            'chats'=>$chats,
            'messages'=>$messages,
            'notifications'=>$notifications
        ]);
    }
}
