<?php

namespace App\rcpadmin;

use Illuminate\Database\Eloquent\Model;
use DB;

class PropertyFeeds extends Model
{
  static function feeds()
  {
    $data = DB::table(env('DB_DATABASE2') . '.listing_views_tracking_for_feeds AS s')
      ->join('campus', 'campus.id', '=', 's.campus_id')
      ->where('s.date_created_str', '>=', date("Y-m-d", strtotime('-2 days')))
      ->orderBy('s.id', 'DESC')
      ->select('campus.title', 's.*')
      ->paginate(10);

    return $data;
  }

  static function export_list()
  {

    $fDate = date("Y-m-d", strtotime("-1 month"));
    $eDate = date("Y-m-d");

    $offset = 0;
    $limit = 20000;

    $sql = " 
           
                       SELECT s.listing_id,
                       s.listing_name,
                       s.final_url,
                       s.image_url,
                       s.city_name,
                       s.description,
                       s.price,
                       s.property_type,
                       s.listing_type,
                       s.contextual_keywords,
                       s.address,
                       s.ip_address,
                       s.tracking_template,
                       s.destination_url,
                       '----' AS cnt,
                       '----' AS campus_title
           
                       FROM " . env('DB_DATABASE2') . ".`listing_views_tracking_for_feeds` s
                       WHERE s.`date_created_str` BETWEEN '$fDate' AND '$eDate'   GROUP BY s.`listing_id` ORDER BY s.`id` DESC
                       LIMIT $offset,$limit
                       ";


    $leads = DB::select($sql);
    return $leads;
  }
}
