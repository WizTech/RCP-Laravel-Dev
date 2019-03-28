<?php

namespace App\Http\Controllers\rcpadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Property;

class ExpiredPropertyController extends Controller
{
  public function index()
  {

    $properties = Property::expired();
    return view('rcpadmin.expired-property', compact('properties'));
  }
}
