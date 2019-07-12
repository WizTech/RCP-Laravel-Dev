<?php

namespace App\Http\Controllers\rcpadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\rcpadmin\PropertiesCount;
use App\Helpers\GeneralHelper;
use Excel;

class PropertiesCountController extends Controller
{
  public function index()
  {
    $leads = [];


    $data = PropertiesCount::free_paid();

    $leads['count'] = $data;


    return view('rcpadmin.properties-count', compact('leads'));
  }

  public function export()
  {

    $lead[] = ['Campus', 'Free Users', 'Paid Users'];

    $userData = PropertiesCount::free_paid();

    if (count($userData) > 0) {
      foreach ($userData as $data) {

        $lead[] = array(
          'Campus' => $data->name,
          'Free Users' => $data->campus_free,
          'Paid Users' => $data->campus_paid
        );
      }


    }
    $sheetName = date('d-m-y his');
    return Excel::create($sheetName, function ($excel) use ($lead) {
      $excel->setTitle('Properites Count');
      $excel->sheet('properites-count', function ($sheet) use ($lead) {
        $sheet->fromArray($lead, null, 'A1', false, false);
      });
    })->download('csv');


  }
}
