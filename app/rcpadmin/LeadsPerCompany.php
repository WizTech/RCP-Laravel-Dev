<?php

namespace App\rcpadmin;

use Illuminate\Database\Eloquent\Model;
use DB;

class LeadsPerCompany extends Model
{
  static function views($pids = '', $from = "", $to = "")
  {
    if (empty($from) === false && empty($to) === false) {
      $QueryRange = " AND `date` BETWEEN '$from' AND '$to'";
    } else {
      $QueryRange = "";
    }
    $query = "SELECT SUM(`views`) as totalViews FROM track_views Where property_id IN (" . $pids . ") $QueryRange";/*$QueryRangeProperty*/
    $data = DB::select($query);

    return $data;
  }

  static function leads($pIds = 0, $landlordId = 0, $from = "", $to = "")
  {

    if (empty($from) === false && empty($to) === false) {
      $QueryRange = " AND `date` BETWEEN '$from' AND '$to'";
    } else {
      $QueryRange = "";
    }
    $email_leads_sql = "Select SUM(leads) as email_leads from " . env('DB_DATABASE2') . ".email_leads Where property_id IN (" . $pIds . ") $QueryRange";

    $email_leads = DB::select($email_leads_sql);


    $phone_leads_sql = "Select count(id) as phone_leads from " . env('DB_DATABASE2') . ".phone_leads
        
                                            Where property_id IN (" . $pIds . ") $QueryRange";


    $phone_leads = DB::select($phone_leads_sql);

    /* $twilio_leads_sql = "Select count(id) as twilio_leads from " . env('DB_DATABASE2') . ".twilio_leads

                                             Where landlord_id IN (" . $landlordId . ")";

     $twilio_leads = DB::select($twilio_leads_sql);*/

    return [
      'email_leads' => $email_leads[0]->email_leads,
      'phone_leads' => $phone_leads[0]->phone_leads,
    ];


  }
}
