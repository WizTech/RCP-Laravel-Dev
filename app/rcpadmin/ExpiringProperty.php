<?php

namespace App\rcpadmin;

use Illuminate\Database\Eloquent\Model;
use DB;

class ExpiringProperty extends Model
{

  static function expiring_listings()
  {

    $date_from = date("Y-m-d");

    $date_to = date("Y-m-d", strtotime("+1 week"));
    $listings = DB::table(env('DB_DATABASE') . '.property AS property')
      ->Join('campus', 'property.campus_id', '=', 'campus.id')
      ->Join('users As user', 'property.landlord_id', '=', 'user.id')
      ->Join('user_details', 'property.landlord_id', '=', 'user_details.user_id')
      ->whereBetween('property.property_expiry_date', [$date_from, $date_to])
      ->select('campus.title as campus_title', 'property.id', 'property.title', 'property.property_expiry_date', 'property.address', 'user.name as username', 'user_details.first_name', 'user_details.last_name', 'user.email', 'user_details.phone_no')
      ->paginate(10);
    return $listings;
  }
}
