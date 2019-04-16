<?php

namespace App\Http\Controllers\rcpadmin;

use App\rcpadmin\AppUser;
use App\Http\Controllers\Controller;

class AppUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $appUsers = AppUser::paginate(10);
        if (isset($_GET['device_type'])){
            $ldeviceType  = $_GET['device_type'];
            $appUsers = AppUser::filter_device($ldeviceType);
        }
        return view('rcpadmin/app-users', compact('appUsers'));
    }
}
