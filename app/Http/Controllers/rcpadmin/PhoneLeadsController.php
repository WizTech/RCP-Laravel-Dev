<?php

namespace App\Http\Controllers\rcpadmin;

use App\rcpadmin\PhoneLeads;
use App\Http\Controllers\Controller;
use App\Helpers\GeneralHelper;
use Excel;


class PhoneLeadsController extends Controller
{
    public function index()
    {
        $phoneLeads = [];
        $phoneLeads['leads'] = PhoneLeads::phone_leads();
        $phoneLeads['campuses'] = GeneralHelper::getColumn('campus', 'title');

        return view('rcpadmin/phone-lead', compact('phoneLeads'));
    }
}
