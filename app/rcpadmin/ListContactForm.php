<?php

namespace App\rcpadmin;

use Illuminate\Database\Eloquent\Model;
use DB;
class ListContactForm extends Model
{
  protected $table = 'contact_us';

  static function lead_export($date_from, $date_to)
  {
    $contactInfo = DB::table(env('DB_DATABASE') . '.contact_us AS c')
      ->whereBetween('c.add_date', [$date_from, $date_to])
      ->select('c.name', 'c.email', 'c.phone', 'c.company', 'c.address', 'c.fax', 'c.message','c.add_date')
      ->get();
    return $contactInfo;

  }
}
