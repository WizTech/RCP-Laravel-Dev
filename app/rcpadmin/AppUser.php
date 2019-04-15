<?php

namespace App\rcpadmin;

use Illuminate\Database\Eloquent\Model;
use DB;

class AppUser extends Model
{
    protected $connection = "mysql2";

    protected $table  = "app_users";

    static function filter_device($deviceType){
        $data = DB::table('rentcoll_stats.app_users')
            ->where('device_type', $deviceType)
            ->paginate(10);
        return $data;
    }

}
