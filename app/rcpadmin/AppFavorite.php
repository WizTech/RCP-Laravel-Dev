<?php

namespace App\rcpadmin;

use Illuminate\Database\Eloquent\Model;
use DB;

class AppFavorite extends Model
{
    protected $connection = "mysql2";
    protected $table = "app_favorites";

    static function app_favourite()
    {
        $appFavorites = DB::table(env('DB_DATABASE2').'.app_favorites AS app_fav')
                 ->leftJoin('users', 'app_fav.user_id', '=', 'users.id')
                 ->leftJoin('user_details', 'app_fav.user_id', '=', 'user_details.user_id')
                 ->leftJoin('property', 'app_fav.property_id', '=', 'property.id')
                 ->leftJoin('campus', 'property.campus_id', '=', 'campus.id')
                 ->select('campus.title as campus_title', 'property.title as property_title', 'users.name as username', 'users.email', 'user_details.phone_no')
                 ->paginate(10);
        return $appFavorites;
    }

    static function fav_export($date_from, $date_to, $campus_id)
    {
        if ($campus_id === 'All') {
            $appFavorites = DB::table(env('DB_DATABASE2').'.app_favorites AS app_fav')
                ->leftJoin('users', 'app_fav.user_id', '=', 'users.id')
                ->leftJoin('user_details', 'app_fav.user_id', '=', 'user_details.user_id')
                ->leftJoin('property', 'app_fav.property_id', '=', 'property.id')
                ->leftJoin('campus', 'property.campus_id', '=', 'campus.id')
                ->whereBetween('date_created', [$date_from, $date_to])
                ->select('campus.title as campus_title', 'property.title as property_title', 'users.name as username', 'users.email', 'user_details.phone_no')
                ->get();
        } else {
            $appFavorites =DB::table(env('DB_DATABASE2').'.app_favorites AS app_fav')
                ->leftJoin('users', 'app_fav.user_id', '=', 'users.id')
                ->leftJoin('user_details', 'app_fav.user_id', '=', 'user_details.user_id')
                ->leftJoin('property', 'app_fav.property_id', '=', 'property.id')
                ->leftJoin('campus', 'property.campus_id', '=', 'campus.id')
                ->where('campus.id', $campus_id)
                ->whereBetween('date_created', [$date_from, $date_to])
                ->select('campus.title as campus_title', 'property.title as property_title', 'users.name as username', 'users.email', 'user_details.phone_no')
                ->get();
        }

        return $appFavorites;

    }


}
