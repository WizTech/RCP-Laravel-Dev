<?php

namespace App\Http\Controllers\rcpadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\rcpadmin\UsersCount;
use App\Helpers\GeneralHelper;
use Excel;

class UsersCountController extends Controller
{
  public function index()
  {
    $leads = [];


    $userData = UsersCount::free_trial();

    $leads['leads'] = $userData;


    return view('rcpadmin.users-count', compact('leads'));
  }

  public function export()
  {

    $lead[] = ['Campus', 'Free Users', 'Paid Users'];

    $userData = UsersCount::free_trial();

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
      $excel->setTitle('Users Count');
      $excel->sheet('users-count', function ($sheet) use ($lead) {
        $sheet->fromArray($lead, null, 'A1', false, false);
      });
    })->download('csv');


  }
}
