<?php

namespace App\Http\Controllers\Chef\Auth;

use App\Http\Controllers\Controller;

class VerificationController extends Controller
{
    use VerifiesSms;
    use VerifiesEmail;

    /*************************************
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('chef.guest');
    }
}
