<?php

namespace App\Http\Controllers\rcpadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\rcpadmin\ActiveProperties;
use App\Helpers\GeneralHelper;
use Excel;

class ActivePropertiesController extends Controller
{
    public function index()
    {
        $leads = [];
        /*if (!empty($_POST['landlord_id'])){
            $landlord_id  = $_POST['landlord_id'];
            $date_from  = isset($_POST['date_from']) ? $_POST['date_from']: date("Y-m-d", strtotime("-1 week"));;
            $date_to  = isset($_POST['date_to']) ? $_POST['date_to']: date("Y-m-d");

            $leads['leads'] = LandlordSiteLeads::filter_leads($landlord_id,$date_from,$date_to);
        }else{
            $leads['leads'] = LandlordSiteLeads::leads();
        }*/

        $leads['campuses'] = GeneralHelper::getColumn('campus', 'title');
        //$leads['leads'] = LandlordSiteLeads::leads();
        return view('rcpadmin.active-properites', compact('leads'));
    }

    public function exportList()
    {
        if (!empty($_POST['campus_id'])) {
            $date_from = strtotime($_POST['date_from']);
            $date_to = strtotime($_POST['date_to']);
            $campus_id = $_POST['campus_id'];
            /*            $list[] = array('Property ID', 'Landlord Username', 'Campus', 'Property Address', 'Beds', 'Baths', 'Rent', 'Subscription Date', 'Expiry Date');*/

            $lead[] = ['Property ID', 'Property Address', 'Landlord Username', 'Campus','Subscription Date', 'Expiry Date'];
            if (true) {
                $expData = ActiveProperties::lead_export($date_from, $date_to, $campus_id);

                foreach ($expData as $data) {
                    $lead[] = array(
                        'Property ID' => $data->pid,
                        'Property Address' => $data->address,
                        'Landlord Username' => $data->email,
                        'Campus' => $data->campus_title,
                        'Subscription Date' => $data->start_date,
                        'Expiry Date' => $data->expiry_date,
                    );
                }
            }
            $sheetName = date('d-m-y his');
            return Excel::create($sheetName, function ($excel) use ($lead) {
                $excel->setTitle('Active Properites');
                $excel->sheet('active=properites', function ($sheet) use ($lead) {
                    $sheet->fromArray($lead, null, 'A1', false, false);
                });
            })->download('csv');
        }

    }
}
