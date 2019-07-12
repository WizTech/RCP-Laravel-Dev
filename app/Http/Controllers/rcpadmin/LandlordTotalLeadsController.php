<?php

namespace App\Http\Controllers\rcpadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\LandlordDetails;
#use App\rcpadmin\LandlordTotalLeads;
use App\Helpers\GeneralHelper;
use Excel;

class LandlordTotalLeadsController extends Controller
{
    public function index()
    {
        $landlords = User::landlords();
        return view('rcpadmin.landlord-total-leads', compact('landlords'));
    }
}
