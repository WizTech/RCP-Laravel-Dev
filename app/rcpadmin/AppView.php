<?php

namespace App\rcpadmin;

use Illuminate\Database\Eloquent\Model;
use DB;

class AppView extends Model
{
    protected $connection = "mysql2";
    protected $table = "app_views";

    static function app_views()
    {
        $appLeads = DB::table('rentcoll_stats.app_views')
            ->leftJoin('users', 'app_views.user_id', '=', 'users.id')
            ->leftJoin('user_details', 'app_views.user_id', '=', 'user_details.user_id')
            ->leftJoin('campus', 'app_views.campus_id', '=', 'campus.id')
            ->select('users.name as username', 'users.email', 'user_details.phone_no', 'campus.title as campus_title', 'app_views.page_type', 'app_views.date')
            ->get();
        return $appLeads;
    }
}
