<?php

namespace App\Http\Controllers\rcpadmin;

use App\rcpadmin\AppLead;
use App\Http\Controllers\Controller;
use App\Helpers\GeneralHelper;
use Excel;

class AppLeadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $leads = AppLead::all()->toArray();
        $appLeads['campuses'] = GeneralHelper::getColumn('campus', 'title');
        if (!empty($_POST)){
            if (!empty($_POST['lead_type']) && $_POST['campus_id'] == 'All'){
                $leadType  = $_POST['lead_type'];
                $appLeads['leads'] = AppLead::filter_leads($leadType, '');
                return view('rcpadmin/app-leads', compact('appLeads'));
            }
            if (!empty($_POST['campus_id']) && $_POST['lead_type'] == 'All'){
                $campusId  = $_POST['campus_id'];
                $appLeads['leads'] = AppLead::filter_leads('',$campusId);
                return view('rcpadmin/app-leads', compact('appLeads'));
            }
        }elseif (!empty($leads)){
                $appLeads['leads'] = AppLead::app_leads();
        }

        return view('rcpadmin/app-leads', compact('appLeads'));
    }

    /*
     *  Export App Leads According to requirements
     * */

    function leadExport(){
        if (!empty($_GET)) {
            $date_from = $_GET['date_from'];
            $date_to = $_GET['date_to'];
            $lead_type = $_GET['lead_type'];
            $campus_id = $_GET['campus_id'];
            $leads = AppLead::all()->toArray();
            $lead[] = ['User Name', 'Email', 'Phone', 'Campus', 'Lead Type', 'Date'];
            if (!empty($leads)) {
                $appLeads = AppLead::lead_export($date_from, $date_to, $campus_id, $lead_type);
            foreach ($appLeads as $appLead) {
                $lead[] = array(
                    'User Name' => $appLead->username ?  $appLead->username : '',
                    'Email' => $appLead->email ? $appLead->email : '',
                    'Phone' => $appLead->phone_no ? $appLead->phone_no : '',
                    'Campus' => $appLead->campus_title ? $appLead->campus_title : '',
                    'Lead Type' => $appLead->lead_type ? $appLead->lead_type : '',
                    'Date' => $appLead->date ? $appLead->date : '',
                );
            }
            }
            $sheetName  = date('d-m-y his');
            return Excel::create($sheetName, function ($excel) use ($lead) {
                $excel->setTitle('fav');
                $excel->sheet('fav', function ($sheet) use ($lead) {
                    $sheet->fromArray($lead, null, 'A1', false, false);
                });
            })->download('csv');
        }
    }

}
