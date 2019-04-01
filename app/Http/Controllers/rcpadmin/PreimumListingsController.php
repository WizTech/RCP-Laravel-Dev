<?php

namespace App\Http\Controllers\rcpadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Property;

class PreimumListingsController extends Controller
{
  public function index()
  {

    $listings = Property::premium_listings();
    return view('rcpadmin.premium-listings', compact('listings'));
  }
}
