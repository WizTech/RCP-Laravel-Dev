<?php

namespace App\rcpadmin;

use Illuminate\Database\Eloquent\Model;
use DB;

class LandlordSiteLeads extends Model
{
    protected $connection = "mysql2";
    protected $table = "landlord_site_stats";

    static function leads()
    {

        $date_from = date("Y-m-d", strtotime("-1 week"));

        $date_to = date("Y-m-d");
        $leads = DB::table(env('DB_DATABASE2') . '.landlord_site_stats')
            ->select('landlord_site_stats.*', DB::raw("count(landlord_site_stats.id) as visits"), 'user.name as username', 'user_details.first_name', 'user_details.last_name', 'user.email', 'user_details.phone_no')
            ->Join('users As user', 'landlord_site_stats.landlord_id', '=', 'user.id')
            ->Join('user_details', 'user.id', '=', 'user_details.user_id')
            ->whereBetween('landlord_site_stats.date_created', [$date_from, $date_to])
            ->groupBy('user.id')
            ->paginate(10);
        return $leads;
    }

    static function filter_leads($landlord_id,$date_from,$date_to)
    {
//echo $landlord_id.' -- '.$date_from.' -- '.$date_to;die('Call');
        if (!empty($landlord_id) && $landlord_id != 'All') {
            $leads = DB::table(env('DB_DATABASE2') . '.landlord_site_stats')
                ->select('landlord_site_stats.*', DB::raw("count(landlord_site_stats.id) as visits"), 'user.name as username', 'user_details.first_name', 'user_details.last_name', 'user.email', 'user_details.phone_no')
                ->Join('users As user', 'landlord_site_stats.landlord_id', '=', 'user.id')
                ->Join('user_details', 'user.id', '=', 'user_details.user_id')
                ->where('user.id', $landlord_id)
                ->whereBetween('landlord_site_stats.date_created', [$date_from, $date_to])
                ->groupBy('user.id')
                ->paginate(10);

        } elseif (!empty($landlord_id) && $landlord_id == 'All') {
            $leads = DB::table(env('DB_DATABASE2') . '.landlord_site_stats')
                ->select('landlord_site_stats.*', DB::raw("count(landlord_site_stats.id) as visits"), 'user.name as username', 'user_details.first_name', 'user_details.last_name', 'user.email', 'user_details.phone_no')
                ->Join('users As user', 'landlord_site_stats.landlord_id', '=', 'user.id')
                ->Join('user_details', 'user.id', '=', 'user_details.user_id')
                ->whereBetween('landlord_site_stats.date_created', [$date_from, $date_to])
                ->groupBy('user.id')
                ->paginate(10);

//echo '<pre>';print_r($leads );echo '</pre>';die('Call');

        }
        return $leads;
    }
}
