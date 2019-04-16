<?php

namespace App\Http\Controllers\rcpadmin;

use App\rcpadmin\TimeOnApp;
use App\Http\Controllers\Controller;

class TimeOnAppController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = TimeOnApp::all()->toArray();
        if (!empty($data)){
            $times = TimeOnApp::appTime();
            return view('rcpadmin/time-on-app', compact('times'));
        }else{
            return view('rcpadmin/time-on-app');
        }
    }

}
