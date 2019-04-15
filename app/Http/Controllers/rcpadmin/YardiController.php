<?php

namespace App\Http\Controllers\rcpadmin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\LandlordDetails;
use App\UserDetails;
use Request;

class YardiController extends Controller
{
  public function index()
  {
    
    $webUsers = User::yardi_landlords()->paginate(10);

    return view('rcpadmin.yardi', compact('webUsers'));
  }
}
