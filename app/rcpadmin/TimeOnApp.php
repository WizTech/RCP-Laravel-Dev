<?php

namespace App\rcpadmin;

use Illuminate\Database\Eloquent\Model;
use DB;

class TimeOnApp extends Model
{
    protected $connection = "mysql2";
    protected $table = "app_views";

    static function appTime(){
        $timeOnApp = DB::table('rentcoll_stats.app_views')
            ->leftJoin('users', 'app_views.user_id', '=', 'users.id')
            ->select('users.name as username', 'app_views.date', 'app_views.date_created')
            ->get();
        return $timeOnApp;



    }

}
