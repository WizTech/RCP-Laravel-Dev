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

    static function filter_leads($lead_type,$campus_id){
        if (!empty($lead_type) && $lead_type != 'All'){
            $appLeads = DB::table('rentcoll_stats.app_leads')
                ->leftJoin('users', 'app_leads.user_id', '=', 'users.id')
                ->leftJoin('user_details', 'app_leads.user_id', '=', 'user_details.user_id')
                ->leftJoin('property', 'app_leads.property_id', '=', 'property.id')
                ->leftJoin('campus', 'property.campus_id', '=', 'campus.id')
                ->where('type',$lead_type)
                ->select('app_leads.id','users.name as username', 'users.email', 'user_details.phone_no', 'app_leads.type as lead_type','property.campus_id', 'campus.title as campus_title', 'app_leads.date')
                ->get();
        }elseif(!empty($campus_id) && $campus_id != 'All'){
            $appLeads = DB::table('rentcoll_stats.app_leads')
                ->leftJoin('users', 'app_leads.user_id', '=', 'users.id')
                ->leftJoin('user_details', 'app_leads.user_id', '=', 'user_details.user_id')
                ->leftJoin('property', 'app_leads.property_id', '=', 'property.id')
                ->leftJoin('campus', 'property.campus_id', '=', 'campus.id')
                ->where('property.campus_id',$campus_id)
                ->select('app_leads.id','users.name as username', 'users.email', 'user_details.phone_no', 'app_leads.type as lead_type','property.campus_id', 'campus.title as campus_title', 'app_leads.date')
                ->get();
        }

        return $appLeads;
    }


    static function lead_export($date_from, $date_to, $campus_id, $lead_type){
        if ($campus_id !== 'All' && $lead_type !== 'All'){
            $appLeads = DB::table('rentcoll_stats.app_leads')
                ->leftJoin('users', 'app_leads.user_id', '=', 'users.id')
                ->leftJoin('user_details', 'app_leads.user_id', '=', 'user_details.user_id')
                ->leftJoin('property', 'app_leads.property_id', '=', 'property.id')
                ->leftJoin('campus', 'property.campus_id', '=', 'campus.id')
                ->where('campus.id', $campus_id)
                ->where('type',$lead_type)
                ->whereBetween('date', [$date_from, $date_to])
                ->select('app_leads.id','users.name as username', 'users.email', 'user_details.phone_no', 'app_leads.type as lead_type','property.campus_id', 'campus.title as campus_title', 'app_leads.date')
                ->get();
            return $appLeads;
        }elseif($campus_id != 'All' && $lead_type == 'All'){
            $appLeads = DB::table('rentcoll_stats.app_leads')
                ->leftJoin('users', 'app_leads.user_id', '=', 'users.id')
                ->leftJoin('user_details', 'app_leads.user_id', '=', 'user_details.user_id')
                ->leftJoin('property', 'app_leads.property_id', '=', 'property.id')
                ->leftJoin('campus', 'property.campus_id', '=', 'campus.id')
                ->where('campus.id', $campus_id)
                ->orWhere('type',$lead_type)
                ->whereBetween('date', [$date_from, $date_to])
                ->select('app_leads.id','users.name as username', 'users.email', 'user_details.phone_no', 'app_leads.type as lead_type','property.campus_id', 'campus.title as campus_title', 'app_leads.date')
                ->get();
            return $appLeads;
        }elseif ($campus_id == 'All' && $lead_type != 'All'){
            $appLeads = DB::table('rentcoll_stats.app_leads')
                ->leftJoin('users', 'app_leads.user_id', '=', 'users.id')
                ->leftJoin('user_details', 'app_leads.user_id', '=', 'user_details.user_id')
                ->leftJoin('property', 'app_leads.property_id', '=', 'property.id')
                ->leftJoin('campus', 'property.campus_id', '=', 'campus.id')
                ->where('type',$lead_type)
                ->orWhere('campus.id',$campus_id)
                ->whereBetween('date', [$date_from, $date_to])
                ->select('app_leads.id','users.name as username', 'users.email', 'user_details.phone_no', 'app_leads.type as lead_type','property.campus_id', 'campus.title as campus_title', 'app_leads.date')
                ->get();
            return $appLeads;
        }else{
            $appLeads = DB::table('rentcoll_stats.app_leads')
                ->leftJoin('users', 'app_leads.user_id', '=', 'users.id')
                ->leftJoin('user_details', 'app_leads.user_id', '=', 'user_details.user_id')
                ->leftJoin('property', 'app_leads.property_id', '=', 'property.id')
                ->leftJoin('campus', 'property.campus_id', '=', 'campus.id')
                ->whereBetween('date', [$date_from, $date_to])
                ->select('app_leads.id','users.name as username', 'users.email', 'user_details.phone_no', 'app_leads.type as lead_type','property.campus_id', 'campus.title as campus_title', 'app_leads.date')
                ->get();
            return $appLeads;
        }
    }
}
