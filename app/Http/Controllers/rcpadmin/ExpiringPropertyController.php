<?php

namespace App\Http\Controllers\rcpadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\rcpadmin\ExpiringProperty;

class ExpiringPropertyController extends Controller
{
  public function index()
  {
    $listings = ExpiringProperty::expiring_listings();
    return view('rcpadmin.expiring-listings', compact('listings'));
  }
}
