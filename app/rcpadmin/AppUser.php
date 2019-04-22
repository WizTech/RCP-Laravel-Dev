<?php

namespace App\rcpadmin;

use Illuminate\Database\Eloquent\Model;
use Config;
use DB;

class AppUser extends Model
{
    protected $connection = "mysql2";

    protected $table = "app_users";

    static function filter_device($deviceType)
    {
        if ($deviceType == 'All'){
            $data = DB::connection(config::get("constants.STATE_DB"))->table(config::get("constants.DB2.APP_USERS"))
                ->paginate(10)
                ->appends('device_type', $deviceType);
        }else{
            $data = DB::connection(config::get("constants.STATE_DB"))->table(config::get("constants.DB2.APP_USERS"))
                ->where('device_type', $deviceType)
                ->paginate(10)
                ->appends('device_type', $deviceType);
        }
        return $data;
    }

}
