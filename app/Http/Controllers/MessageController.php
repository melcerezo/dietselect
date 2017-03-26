<?php

namespace App\Http\Controllers;

use App\Chef;
use App\Foodie;
use App\Http\Controllers\Chef\Auth\VerifiesSms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    use VerifiesSms;

    /**
     * Check for chef authentication
     *
     * @return void
     */
    public function __construct()
    {
//        if (Auth::guard('chef')->user()) {
            $this->middleware('chef.auth');
//        } else {
//            $this->middleware('foodie.auth');
//        }
    }


    public function index(){

        $foodies = Foodie::all();
        $chefs = Chef::all();

        return view('messaging.index');

    }

    public function send(Request $request){

        $this->validate($request, [
            'message' => 'required|max:255',
        ]);

        $foodie = Auth::guard('foodie')->user();

    }
}
