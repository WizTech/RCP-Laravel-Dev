<?php

namespace App\Http\Controllers\rcpadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Property;
use App\Helpers\GeneralHelper;
use Excel;

class ExpiredPropertyController extends Controller
{
  public function index()
  {
    $campuses = GeneralHelper::getColumn('campus', 'title');
    $properties = Property::expired()->paginate(10);

    return view('rcpadmin.expired-property', compact('properties', 'campuses'));
  }


  function leadExport()
  {
    if (!empty($_GET)) {
      $date_from = $_GET['date_from'];
      $date_to = $_GET['date_to'];
      $campus_id = $_GET['campus_id'];
      $properties = Property::expired()->paginate(10);
      $lead[] = ['PID','Listing Title','User Name', 'Email', 'Campus', 'Expired On'];
      if (!empty($properties)) {

        $expiredProperties = Property::lead_export($date_from, $date_to, $campus_id);
        if($expiredProperties){
          foreach ($expiredProperties as $expired) {
                    $lead[] = array(
                      'PID' => $expired->id,
                      'Listing Title' => $expired->title,
                      'User Name' => $expired->username ? $expired->username : '',
                      'Email' => $expired->email ? $expired->email : '',
                      'Campus' => $expired->campus_title ? $expired->campus_title : '',
                      'Expired On' => $expired->property_expiry_date ? $expired->property_expiry_date : '',
                    );
                  }
        }

      }
      $sheetName = date('d-m-y his');
      return Excel::create($sheetName, function ($excel) use ($lead) {
        $excel->setTitle('Expired Property');
        $excel->sheet('expired', function ($sheet) use ($lead) {
          $sheet->fromArray($lead, null, 'A1', false, false);
        });
      })->download('csv');
    }
  }
}
