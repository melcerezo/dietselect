<?php

namespace App\Http\Controllers\Chef;

use App\Http\Controllers\Chef\Auth\VerifiesEmail;
use App\Http\Controllers\Chef\Auth\VerifiesSms;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ChefController extends Controller
{
    use VerifiesSms;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('chef.auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('chef.dashboard')->with([
            'sms_unverified' => $this->mobileNumberExists(),
            'chef' => Auth::guard('chef')->user(),
        ]);
    }
}
