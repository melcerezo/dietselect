<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashController extends Controller
{
    public function loadInfo()
    {
        return view('testMaterializeTemplates.testDashboard');
    }
    public function loadMessage()
    {
        return view('testMaterializeTemplates.testMessage');
    }
    public function loadMealPlanner(){
        return view('testMaterializeTemplates.testMealPlanner');
    }
}
