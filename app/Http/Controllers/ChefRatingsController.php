<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Chef\Auth\VerifiesSms;
use App\Message;
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
        $messages = Message::where('receiver_id', '=', Auth::guard('chef')->user()->id)->where('receiver_type', '=', 'c')->get();

        return view('chef.ratings', compact('ratings', 'messages', 'chef'))->with([
            'sms_unverified' => $this->mobileNumberExists(),
            'messages'=>$messages,
        ]);
    }
}
