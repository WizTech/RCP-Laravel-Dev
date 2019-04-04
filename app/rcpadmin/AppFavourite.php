<?php

namespace App\rcpadmin;

use Illuminate\Database\Eloquent\Model;
use DB;

class AppFavourite extends Model
{
    protected $connection = "mysql2";
    protected $table = "app_favourites";

    static function app_favourite(){

        $leads = DB::table('rentcp_stats_laravel.app_favorites')->get();
        foreach ($leads as $lead){
            $data = DB::table('rentcp_stats_laravel.app_leads')
                ->leftJoin('users', 'app_favorites.user_id', '=', 'users.id')
                ->leftJoin('user_details', 'app_favorites.user_id', '=', 'user_details.user_id')
                ->leftJoin('property', 'app_favorites.property_id', '=', 'property.id')
                ->leftJoin('campus', 'property.campus_id', '=', 'campus.id')
                ->select('users.name', 'users.email', 'user_details.phone_no', 'app_leads.type','property.title', 'campus.title', 'app_leads.date')
                ->where('app_leads.user_id', $lead->user_id)
                ->where('app_leads.property_id',$lead->property_id)
                ->get();
            $appLeads[] = json_decode(json_encode($data), True);
        }
        return $appLeads;
    }


}
