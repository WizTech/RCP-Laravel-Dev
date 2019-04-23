<?php

namespace App\rcpadmin;

use Illuminate\Database\Eloquent\Model;
use DB;

class AppView extends Model
{
    protected $connection = "mysql2";
    protected $table = "app_views";

    static function app_views()
    {
        $appLeads = DB::table(env('DB_DATABASE2').'.app_views AS appViews')
            ->leftJoin('users', 'appViews.user_id', '=', 'users.id')
            ->leftJoin('user_details', 'appViews.user_id', '=', 'user_details.user_id')
            ->leftJoin('campus', 'appViews.campus_id', '=', 'campus.id')
            ->select('users.name as username', 'users.email', 'user_details.phone_no', 'campus.title as campus_title', 'appViews.page_type', 'appViews.date')
            ->paginate(10);
        return $appLeads;
    }

    static function filter_visits($page_type,$campus_id){
        if (!empty($page_type) && $page_type != 'All'){
            $appLeads = DB::table(env('DB_DATABASE2').'.app_views AS appViews')
                ->leftJoin('users', 'appViews.user_id', '=', 'users.id')
                ->leftJoin('user_details', 'appViews.user_id', '=', 'user_details.user_id')
                ->leftJoin('campus', 'appViews.campus_id', '=', 'campus.id')
                ->where('page_type', $page_type)
                ->select('users.name as username', 'users.email', 'user_details.phone_no', 'campus.title as campus_title', 'appViews.page_type', 'appViews.date')
                ->paginate(10)
                ->appends('page_type', $page_type);
            return $appLeads;
        }elseif(!empty($page_type) && $page_type == 'All'){
            $appLeads = DB::table(env('DB_DATABASE2').'.app_views AS appViews')
                ->leftJoin('users', 'appViews.user_id', '=', 'users.id')
                ->leftJoin('user_details', 'appViews.user_id', '=', 'user_details.user_id')
                ->leftJoin('campus', 'appViews.campus_id', '=', 'campus.id')
                ->select('users.name as username', 'users.email', 'user_details.phone_no', 'campus.title as campus_title', 'appViews.page_type', 'appViews.date')
                ->paginate(10)
                ->appends('page_type', $page_type);
            return $appLeads;
        }elseif(!empty($campus_id) && $campus_id != 'All'){
            $appLeads = DB::table(env('DB_DATABASE2').'.app_views AS appViews')
                ->leftJoin('users', 'appViews.user_id', '=', 'users.id')
                ->leftJoin('user_details', 'appViews.user_id', '=', 'user_details.user_id')
                ->leftJoin('campus', 'appViews.campus_id', '=', 'campus.id')
                ->where('campus_id', $campus_id)
                ->select('users.name as username', 'users.email', 'user_details.phone_no', 'campus.title as campus_title', 'appViews.page_type', 'appViews.date')
                ->paginate(10)
                ->appends('campus_id', $campus_id);
            return $appLeads;
        }elseif(!empty($campus_id) && $campus_id == 'All'){
            $appLeads = DB::table(env('DB_DATABASE2').'.app_views AS appViews')
                ->leftJoin('users', 'appViews.user_id', '=', 'users.id')
                ->leftJoin('user_details', 'appViews.user_id', '=', 'user_details.user_id')
                ->leftJoin('campus', 'appViews.campus_id', '=', 'campus.id')
                ->select('users.name as username', 'users.email', 'user_details.phone_no', 'campus.title as campus_title', 'appViews.page_type', 'appViews.date')
                ->paginate(10)
                ->appends('campus_id', $campus_id);
            return $appLeads;
        }
    }

    static function visitExport($date_from, $date_to, $campus_id, $page_type)
    {
        if ($campus_id != 'All' && $page_type == 'All'){

            $appLeads = DB::table(env('DB_DATABASE2').'.app_views AS appViews')
                ->leftJoin('users', 'appViews.user_id', '=', 'users.id')
                ->leftJoin('user_details', 'appViews.user_id', '=', 'user_details.user_id')
                ->leftJoin('campus', 'appViews.campus_id', '=', 'campus.id')
                ->where('campus_id', $campus_id)
                ->whereBetween('date', [$date_from, $date_to])
                ->select('users.name as username', 'users.email', 'user_details.phone_no', 'campus.title as campus_title', 'appViews.page_type', 'appViews.date')
                ->get();
            return $appLeads;
        }elseif ($campus_id == 'All' && $page_type != 'All'){
            $appLeads = DB::table(env('DB_DATABASE2').'.app_views AS appViews')
                ->leftJoin('users', 'appViews.user_id', '=', 'users.id')
                ->leftJoin('user_details', 'appViews.user_id', '=', 'user_details.user_id')
                ->leftJoin('campus', 'appViews.campus_id', '=', 'campus.id')
                ->where('page_type', $page_type)
                ->whereBetween('date', [$date_from, $date_to])
                ->select('users.name as username', 'users.email', 'user_details.phone_no', 'campus.title as campus_title', 'appViews.page_type', 'appViews.date')
                ->get();
            return $appLeads;
        }elseif ($campus_id != 'All' && $page_type != 'All'){
            $appLeads = DB::table(env('DB_DATABASE2').'.app_views AS appViews')
                ->leftJoin('users', 'appViews.user_id', '=', 'users.id')
                ->leftJoin('user_details', 'appViews.user_id', '=', 'user_details.user_id')
                ->leftJoin('campus', 'appViews.campus_id', '=', 'campus.id')
                ->where('campus_id', $campus_id)
                ->where('page_type', $page_type)
                ->whereBetween('date', [$date_from, $date_to])
                ->select('users.name as username', 'users.email', 'user_details.phone_no', 'campus.title as campus_title', 'appViews.page_type', 'appViews.date')
                ->get();
            return $appLeads;
        }else{
            $appLeads = DB::table(env('DB_DATABASE2').'.app_views AS appViews')
                ->leftJoin('users', 'appViews.user_id', '=', 'users.id')
                ->leftJoin('user_details', 'appViews.user_id', '=', 'user_details.user_id')
                ->leftJoin('campus', 'appViews.campus_id', '=', 'campus.id')
                ->whereBetween('date', [$date_from, $date_to])
                ->select('users.name as username', 'users.email', 'user_details.phone_no', 'campus.title as campus_title', 'appViews.page_type', 'appViews.date')
                ->get();
            return $appLeads;
        }
    }


}
