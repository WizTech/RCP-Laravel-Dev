<?php

namespace App\rcpadmin;

use Illuminate\Database\Eloquent\Model;
use Config;
use DB;

class TimeOnApp extends Model
{
    protected $connection = "mysql2";
    protected $table = "app_views";

    static function appTime(){
        $timeOnApp = DB::connection(config::get("constants.STATE_DB"))->table(config::get("constants.DB2.APP_VIEWS"))
            ->leftJoin('users', 'app_views.user_id', '=', 'users.id')
            ->select('users.name as username', 'app_views.date', 'app_views.date_created')
            ->paginate(10);
        return $timeOnApp;

    }

}
