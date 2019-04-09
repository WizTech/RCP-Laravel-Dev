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
        $appFavorites = DB::table('rentcp_stats_laravel.app_favorites')
            ->leftJoin('users', 'app_favorites.user_id', '=', 'users.id')
            ->leftJoin('user_details', 'app_favorites.user_id', '=', 'user_details.user_id')
            ->leftJoin('property', 'app_favorites.property_id', '=', 'property.id')
            ->leftJoin('campus', 'property.campus_id', '=', 'campus.id')
            ->select('campus.title as campus_title', 'property.title as property_title', 'users.name as username', 'users.email', 'user_details.phone_no')
            ->get();
        return $appFavorites;
    }


}
