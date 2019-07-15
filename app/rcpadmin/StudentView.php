<?php

namespace App\rcpadmin;

use Illuminate\Database\Eloquent\Model;
use DB;

class StudentView extends Model
{
  protected $connection = "mysql2";
  protected $table = "student_views";

  static function student_views()
  {
    $emailLeads = DB::table(env('DB_DATABASE2') . '.student_views AS studentViews')
      ->Join('property', 'studentViews.property_id', '=', 'property.id')
      ->Join('users', 'studentViews.student_id', '=', 'users.id')
      ->leftJoin('campus', 'property.campus_id', '=', 'campus.id')
      ->select('studentViews.id', 'users.name', 'users.email', 'property.title', 'property.address', 'property.campus_id', 'campus.title as campus_title', 'studentViews.ip','studentViews.date_created')
      ->paginate(10);
    return $emailLeads;
  }
}
