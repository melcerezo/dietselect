<?php

namespace App\Http\Controllers\Foodie\Auth;

use App\Http\Controllers\Controller;

class VerificationController extends Controller
{
    use VerifiesSms;

    /*************************************
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('foodie.auth');
    }
}
