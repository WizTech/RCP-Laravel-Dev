<?php

namespace App\Http\Controllers\rcpadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\rcpadmin\TopsSpots;
use App\Helpers\GeneralHelper;
use Excel;

class TopsSpotsController extends Controller
{
  public function index()
  {
    $leads = [];


    $data = TopsSpots::listings();

    $leads['listings'] = $data;


    return view('rcpadmin.topspots', compact('leads'));
  }

  public function campus($id)
  {
    $data = TopsSpots::listingData($id);
    return view('rcpadmin.topspots-single', compact('data'));

  }

}
