<?php

namespace App\Http\Controllers\rcpadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardControllerNew extends Controller
{
    public function index()
    {
        return view('rcpadmin.dashboard');
    }
}
