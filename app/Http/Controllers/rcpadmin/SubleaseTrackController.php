<?php

namespace App\Http\Controllers\rcpadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\rcpadmin\SubleaseTrack;

class SubleaseTrackController extends Controller
{
  public function index()
  {
    $subleseTrack = SubleaseTrack::paginate(10);

    return view('rcpadmin.sublease-track', compact('subleseTrack'));
  }
}
