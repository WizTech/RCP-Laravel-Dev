<?php

namespace App\rcpadmin;

use Illuminate\Database\Eloquent\Model;
use DB;

class AppLead extends Model
{
    protected $connection = "mysql2";
    protected $table = "app_leads";
    static function app_leads(){
        $appLeads = DB::table(env('DB_DATABASE2').'.app_leads AS appLeads')
            ->leftJoin('users', 'appLeads.user_id', '=', 'users.id')
            ->leftJoin('user_details', 'appLeads.user_id', '=', 'user_details.user_id')
            ->leftJoin('property', 'appLeads.property_id', '=', 'property.id')
            ->leftJoin('campus', 'property.campus_id', '=', 'campus.id')
            ->select('appLeads.id','users.name as username', 'users.email', 'user_details.phone_no', 'appLeads.type as lead_type','property.campus_id', 'campus.title as campus_title', 'appLeads.date')
            ->paginate(10);
        return $appLeads;
    }

    static function filter_leads($lead_type,$campus_id){
        if (!empty($lead_type) && $lead_type != 'All'){
            $appLeads = DB::table(env('DB_DATABASE2').'.app_leads AS appLeads')
                ->leftJoin('users', 'appLeads.user_id', '=', 'users.id')
                ->leftJoin('user_details', 'appLeads.user_id', '=', 'user_details.user_id')
                ->leftJoin('property', 'appLeads.property_id', '=', 'property.id')
                ->leftJoin('campus', 'property.campus_id', '=', 'campus.id')
                ->where('type',$lead_type)
                ->select('appLeads.id','users.name as username', 'users.email', 'user_details.phone_no', 'appLeads.type as lead_type','property.campus_id', 'campus.title as campus_title', 'appLeads.date')
                ->paginate(10)
                ->appends('type', $lead_type);
        }elseif(!empty($lead_type) && $lead_type == 'All'){
            $appLeads = DB::table(env('DB_DATABASE2').'.app_leads AS appLeads')
                ->leftJoin('users', 'appLeads.user_id', '=', 'users.id')
                ->leftJoin('user_details', 'appLeads.user_id', '=', 'user_details.user_id')
                ->leftJoin('property', 'appLeads.property_id', '=', 'property.id')
                ->leftJoin('campus', 'property.campus_id', '=', 'campus.id')
                ->select('appLeads.id','users.name as username', 'users.email', 'user_details.phone_no', 'appLeads.type as lead_type','property.campus_id', 'campus.title as campus_title', 'appLeads.date')
                ->paginate(10)
                ->appends('type', $lead_type);
        }elseif(!empty($campus_id) && $campus_id != 'All'){
            $appLeads = DB::table(env('DB_DATABASE2').'.app_leads AS appLeads')
                ->leftJoin('users', 'appLeads.user_id', '=', 'users.id')
                ->leftJoin('user_details', 'appLeads.user_id', '=', 'user_details.user_id')
                ->leftJoin('property', 'appLeads.property_id', '=', 'property.id')
                ->leftJoin('campus', 'property.campus_id', '=', 'campus.id')
                ->where('property.campus_id',$campus_id)
                ->select('appLeads.id','users.name as username', 'users.email', 'user_details.phone_no', 'appLeads.type as lead_type','property.campus_id', 'campus.title as campus_title', 'appLeads.date')
                ->paginate(10)
                ->appends('campus_id', $campus_id);
        }elseif(!empty($campus_id) && $campus_id == 'All'){
            $appLeads = DB::table(env('DB_DATABASE2').'.app_leads AS appLeads')
                ->leftJoin('users', 'appLeads.user_id', '=', 'users.id')
                ->leftJoin('user_details', 'appLeads.user_id', '=', 'user_details.user_id')
                ->leftJoin('property', 'appLeads.property_id', '=', 'property.id')
                ->leftJoin('campus', 'property.campus_id', '=', 'campus.id')
                ->select('appLeads.id','users.name as username', 'users.email', 'user_details.phone_no', 'appLeads.type as lead_type','property.campus_id', 'campus.title as campus_title', 'appLeads.date')
                ->paginate(10)
                ->appends('campus_id', $campus_id);
        }
        return $appLeads;
    }


    static function lead_export($date_from, $date_to, $campus_id, $lead_type){
        if ($campus_id !== 'All' && $lead_type !== 'All'){
            $appLeads =DB::table(env('DB_DATABASE2').'.app_leads AS appLeads')
                ->leftJoin('users', 'appLeads.user_id', '=', 'users.id')
                ->leftJoin('user_details', 'appLeads.user_id', '=', 'user_details.user_id')
                ->leftJoin('property', 'appLeads.property_id', '=', 'property.id')
                ->leftJoin('campus', 'property.campus_id', '=', 'campus.id')
                ->where('campus.id', $campus_id)
                ->where('type',$lead_type)
                ->whereBetween('date', [$date_from, $date_to])
                ->select('appLeads.id','users.name as username', 'users.email', 'user_details.phone_no', 'appLeads.type as lead_type','property.campus_id', 'campus.title as campus_title', 'appLeads.date')
                ->get();
            return $appLeads;
        }elseif($campus_id != 'All' && $lead_type == 'All'){
            $appLeads = DB::table(env('DB_DATABASE2').'.app_leads AS appLeads')
                ->leftJoin('users', 'appLeads.user_id', '=', 'users.id')
                ->leftJoin('user_details', 'appLeads.user_id', '=', 'user_details.user_id')
                ->leftJoin('property', 'appLeads.property_id', '=', 'property.id')
                ->leftJoin('campus', 'property.campus_id', '=', 'campus.id')
                ->where('campus.id', $campus_id)
                ->orWhere('type',$lead_type)
                ->whereBetween('date', [$date_from, $date_to])
                ->select('appLeads.id','users.name as username', 'users.email', 'user_details.phone_no', 'appLeads.type as lead_type','property.campus_id', 'campus.title as campus_title', 'appLeads.date')
                ->get();
            return $appLeads;
        }elseif ($campus_id == 'All' && $lead_type != 'All'){
            $appLeads = DB::table(env('DB_DATABASE2').'.app_leads AS appLeads')
                ->leftJoin('users', 'appLeads.user_id', '=', 'users.id')
                ->leftJoin('user_details', 'appLeads.user_id', '=', 'user_details.user_id')
                ->leftJoin('property', 'appLeads.property_id', '=', 'property.id')
                ->leftJoin('campus', 'property.campus_id', '=', 'campus.id')
                ->where('type',$lead_type)
                ->orWhere('campus.id',$campus_id)
                ->whereBetween('date', [$date_from, $date_to])
                ->select('appLeads.id','users.name as username', 'users.email', 'user_details.phone_no', 'appLeads.type as lead_type','property.campus_id', 'campus.title as campus_title', 'appLeads.date')
                ->get();
            return $appLeads;
        }else{
            $appLeads = DB::table(env('DB_DATABASE2').'.app_leads AS appLeads')
                ->leftJoin('users', 'appLeads.user_id', '=', 'users.id')
                ->leftJoin('user_details', 'appLeads.user_id', '=', 'user_details.user_id')
                ->leftJoin('property', 'appLeads.property_id', '=', 'property.id')
                ->leftJoin('campus', 'property.campus_id', '=', 'campus.id')
                ->whereBetween('date', [$date_from, $date_to])
                ->select('appLeads.id','users.name as username', 'users.email', 'user_details.phone_no', 'appLeads.type as lead_type','property.campus_id', 'campus.title as campus_title', 'appLeads.date')
                ->get();
            return $appLeads;
        }
    }
}
