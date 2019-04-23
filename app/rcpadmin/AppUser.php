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
            $data = DB::table(env('DB_DATABASE2').'.app_users AS appUsers')
                ->paginate(10)
                ->appends('device_type', $deviceType);
        }else{
            $data = $data = DB::table(env('DB_DATABASE2').'.app_users AS appUsers')
                ->where('device_type', $deviceType)
                ->paginate(10)
                ->appends('device_type', $deviceType);
        }
        return $data;
    }

}
