<?php

namespace App\rcpadmin;

use Illuminate\Database\Eloquent\Model;
use DB;

class ActiveProperties extends Model
{
  protected $connection = "mysql2";
  protected $table = "app_leads";

  static function lead_export($date_from, $date_to, $campus_id)
  {
    if ($campus_id != 'All') {
      $data = DB::table(env('DB_DATABASE2') . '.landlords_active_properties AS lap')
        ->join('property', 'lap.property_id', '=', 'property.id')
        ->join('campus', 'property.campus_id', '=', 'campus.id')
        ->join('users', 'lap.user_id', '=', 'users.id')
        ->leftJoin('user_details', 'lap.user_id', '=', 'user_details.user_id')
        ->where('campus.id', $campus_id)
        ->whereBetween('lap.start_date', [$date_from, $date_to])
        ->orwherebetween('lap.expiry_date', [$date_from, $date_to])//p.listing_title,p.address,p.id as propID,c.campus_title,u.username,u.company,u.first_name,u.last_name,ap.start_date,ap.expiry_date
        ->select('lap.start_date', 'lap.expiry_date', 'users.name as username', 'users.email', 'user_details.phone_no', 'property.id AS pid', 'property.campus_id', 'property.title', 'property.address', 'campus.title as campus_title')
        ->get();
      return $data;
    }
  }

  static function landlord($id)
  {
    $data = DB::select("SELECT t1.`id` FROM property AS t1 WHERE  t1.`landlord_id` = '$id'
                        AND t1.status = 'Active' 
                      
                        AND t1.property_expiry_date >= '" . date('Y-m-d H:i:s') . "'
                       
                        AND t1.`id` IN (SELECT property_id FROM floorplan 
                        WHERE property_id = t1.id AND `status` = 'Active')");
    return $data;
  }


}
