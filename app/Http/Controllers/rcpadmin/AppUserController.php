<?php

namespace App\Http\Controllers\rcpadmin;

use App\rcpadmin\AppUser;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
        if (!empty($_GET['device_type'])){
            $ldeviceType  = $_GET['device_type'];
            $appUsers = AppUser::filter_device($ldeviceType);
        }
        return view('rcpadmin/app-users', compact('appUsers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\rcpadmin\AppUser  $appUser
     * @return \Illuminate\Http\Response
     */
    public function show(AppUser $appUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\rcpadmin\AppUser  $appUser
     * @return \Illuminate\Http\Response
     */
    public function edit(AppUser $appUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\rcpadmin\AppUser  $appUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AppUser $appUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\rcpadmin\AppUser  $appUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(AppUser $appUser)
    {
        //
    }
}
