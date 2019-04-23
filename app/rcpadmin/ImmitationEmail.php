<?php

namespace App\rcpadmin;

use Illuminate\Database\Eloquent\Model;
use DB;

class ImmitationEmail extends Model
{
  protected $connection = "mysql2";
  protected $table = "imitation_leads_track";

  static function imitation_leads()
  {
    $imitationLeads = DB::table(env('DB_DATABASE2') . '.imitation_leads_track AS imitation_lead')
      ->leftJoin('property', 'imitation_lead.property_id', '=', 'property_listing.id')
      ->leftJoin('campus', 'imitation_lead.campus_id', '=', 'campus.id')
      ->leftJoin('users As user', 'imitation_lead.user_id', '=', 'user.id')
      ->leftJoin('user_details', 'imitation_lead.user_id', '=', 'user_details.user_id')
      ->select('imitation_lead.*', 'campus.title as campus_title', 'property.title as property_title', 'user.name as username', 'user.email', 'user_details.phone_no')
      ->paginate(10);
    return $imitationLeads;
  }
}
