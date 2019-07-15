<?php

namespace App\Http\Controllers\rcpadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\rcpadmin\ImitationEmail;
use Excel;

class ImitationEmailController extends Controller
{
  public function index()
  {
    $imitationEmail = ImitationEmail::imitation_leads();
    return view('rcpadmin.imitation-email', compact('imitationEmail'));
  }

  public function export_list()
  {

    $date_from = isset($_POST['date_from']) ? $_POST['date_from'] : date("Y-m-d", strtotime("-1 week"));;
    $date_to = isset($_POST['date_to']) ? $_POST['date_to'] : date("Y-m-d");


    $leads = ImitationEmail::export_list($date_from, $date_to);

    $lead[] = array('Campus', 'Property Name', 'Landlord Name', 'Landlord Username', 'Sender Name', 'Sender Email', 'Sender Contact', 'Message', 'Sender IP', 'User From', 'Bedrooms', 'Category', 'Lead Type', 'Banner Lead', 'Email Status', 'Created Date', 'Open Time', 'Open Time in Minutes', 'Subscribed');
    if (count($leads) > 0) {
      foreach ($leads as $data) {
        $lead[] = array(

          "Campus" => $data->campus_title,

          "Property Name" => $data->property_title,

          "Landlord Name" => $data->username,

          "Sender Name" => $data->first_name . ' ' . $data->last_name,

          "Sender Email" => $data->email,
          "Sender Contact" => $data->phone_no
        );
      }


    }

    //  echo '<pre>';print_r($lead );echo '</pre>';die('Call');
    $sheetName = date('d-m-y his');
    return Excel::create($sheetName, function ($excel) use ($lead) {
      $excel->setTitle('Feeds Export List');
      $excel->sheet('feeds-export-list', function ($sheet) use ($lead) {
        $sheet->fromArray($lead, null, 'A1', false, false);
      });
    })->download('csv');
  }
}
