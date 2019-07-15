<?php

namespace App\Http\Controllers\rcpadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\rcpadmin\ActiveProperties;
use App\Helpers\GeneralHelper;
use Excel;

class LandlordActivePropertiesController extends Controller
{

  public function index()
  {

    $lead[] = ['Landlord', 'Total Active Leads'];

    $landlords = User::all_landlords();

    if (count($landlords) > 0) {
      foreach ($landlords as $landlord) {
        $listings = ActiveProperties::landlord($landlord->id);

        $lead[] = array(
          'Landlord' => $landlord->name,
          'Total Active Leads' => count($listings)
        );
      }


    }
    $sheetName = date('d-m-y his');
    return Excel::create($sheetName, function ($excel) use ($lead) {
      $excel->setTitle('Landlord Active Properites');
      $excel->sheet('landlord-active-properites', function ($sheet) use ($lead) {
        $sheet->fromArray($lead, null, 'A1', false, false);
      });
    })->download('csv');


  }
}
