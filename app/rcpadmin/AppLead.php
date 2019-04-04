<?php

namespace App\rcpadmin;

use Illuminate\Database\Eloquent\Model;
use DB;

class AppLead extends Model
{
    protected $connection = "mysql2";
    protected $table = "app_leads";

    static function app_leads(){

        $users = DB::table('rentcp_stats_laravel.app_leads')->get();
        foreach ($users as $user){
            $data = DB::table('rentcp_stats_laravel.app_leads')
                ->leftJoin('users', 'app_leads.user_id', '=', 'users.id')
                ->leftJoin('user_details', 'app_leads.user_id', '=', 'user_details.user_id')
                ->leftJoin('property', 'app_leads.property_id', '=', 'property.id')
                ->leftJoin('campus', 'property.campus_id', '=', 'campus.id')
                ->select('users.name', 'users.email', 'user_details.phone_no', 'app_leads.type','property.campus_id', 'campus.title', 'app_leads.date')
                ->where('app_leads.user_id', $user->user_id)
                ->where('app_leads.property_id',$user->property_id)
                ->get();
            $appLeads[] = json_decode(json_encode($data), True);
        }
        return $appLeads;
    }
}
