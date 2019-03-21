<?php

namespace App\Http\Controllers\rcpadmin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\LandlordDetails;
use App\UserDetails;
use Request;

class EntrataController extends Controller
{
  public function index()
  {
    
    $webUsers = User::entrata_landlords()->get()->toArray();

    return view('rcpadmin.entrata', compact('webUsers'));
  }
}
