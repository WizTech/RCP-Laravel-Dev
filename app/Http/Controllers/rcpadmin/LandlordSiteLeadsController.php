<?php

namespace App\Http\Controllers\rcpadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\rcpadmin\LandlordSiteLeads;
use App\Helpers\GeneralHelper;
use Excel;

class LandlordSiteLeadsController extends Controller
{
    public function index()
    {
        $leads = [];
        if (!empty($_POST['landlord_id'])){
            $landlord_id  = $_POST['landlord_id'];
            $date_from  = isset($_POST['date_from']) ? $_POST['date_from']: date("Y-m-d", strtotime("-1 week"));;
            $date_to  = isset($_POST['date_to']) ? $_POST['date_to']: date("Y-m-d");

            $leads['leads'] = LandlordSiteLeads::filter_leads($landlord_id,$date_from,$date_to);
        }else{
            $leads['leads'] = LandlordSiteLeads::leads();
        }

        $landlords = User::all_landlords();
        $leads['landlords'] = $landlords;
        //$leads['leads'] = LandlordSiteLeads::leads();
        return view('rcpadmin.landlord-site-leads', compact('leads'));
    }
}
