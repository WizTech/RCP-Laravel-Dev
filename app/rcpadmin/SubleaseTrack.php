<?php

namespace App\rcpadmin;

use Illuminate\Database\Eloquent\Model;
use DB;

class SubleaseTrack extends Model
{
  protected $connection = "mysql2";
  protected $table = "sublease_track";

  static function sublease_track()
  {
    $subleaseTrack = DB::table(env('DB_DATABASE2') . '.sublease_track')->paginate(10);
    return $subleaseTrack;
  }
}
