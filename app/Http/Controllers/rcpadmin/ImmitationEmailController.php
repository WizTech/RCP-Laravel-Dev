<?php

namespace App\Http\Controllers\rcpadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\rcpadmin\ImmitationEmail;

class ImmitationEmailController extends Controller
{
  public function index()
  {
    $immitationEmail = ImmitationEmail::imitation_leads();
echo '<pre>';print_r($immitationEmail );echo '</pre>';die('Call');
    return view('rcpadmin.immitation-email', compact('immitationEmail'));
  }
}
