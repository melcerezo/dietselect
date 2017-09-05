<?php

namespace App\Http\Controllers;

class PagesController extends Controller
{
    public function welcome()
    {
        return view('welcome', ['from' => 'welcome']);
    }

    public function faq()
    {
        return view('faq');
    }
    public function disclaimer()
    {
        return view('disclaimer');
    }
}
