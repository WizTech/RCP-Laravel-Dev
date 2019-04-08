<?php

namespace App\rcpadmin;

use Illuminate\Database\Eloquent\Model;
use DB;

class AppLead extends Model
{
    protected $connection = "mysql2";
    protected $table = "app_leads";

    static function app_leads(){
        $appLeads = DB::table('rentcoll_stats.app_leads')
            ->leftJoin('users', 'app_leads.user_id', '=', 'users.id')
            ->leftJoin('user_details', 'app_leads.user_id', '=', 'user_details.user_id')
            ->leftJoin('property', 'app_leads.property_id', '=', 'property.id')
            ->leftJoin('campus', 'property.campus_id', '=', 'campus.id')
            ->select('app_leads.id','users.name as username', 'users.email', 'user_details.phone_no', 'app_leads.type as lead_type','property.campus_id', 'campus.title as campus_title', 'app_leads.date')
            ->get();
        return $appLeads;
    }
}
