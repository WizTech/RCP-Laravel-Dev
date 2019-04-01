<?php

namespace App\Http\Controllers\rcpadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\LandlordDetails;


class PreimumLandlordController extends Controller
{
  public function index()
  {

    $landlords = User::premium_lanlords();
    return view('rcpadmin.premium-landlord', compact('landlords'));
  }
}
