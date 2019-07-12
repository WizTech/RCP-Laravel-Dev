<?php

namespace App\rcpadmin;

use Illuminate\Database\Eloquent\Model;
use DB;

class PropertiesCount extends Model
{


  static function free_paid()
  {


    $query = "
   
           SELECT
   
             (SELECT
   
               COUNT(pl.id)
   
             FROM
   
               `property` pl
   
             WHERE c.`id` = pl.`campus_id` AND pl.`free_trial` = 'Active'
   
             ) AS campus_free,
   
             (
   
             SELECT
   
               COUNT(p.id)
   
             FROM
   
               `property` p
   
             WHERE c.`id` = p.`campus_id` AND p.`payment_success` = 'Active'
   
             ) AS campus_paid,
   
             (
   
             SELECT
   
               COUNT(t1.id)
   
             FROM
   
               `property` t1
   
   
   
             WHERE t1.status = 'Active'
   
               AND (t1.campus_id = c.id)
   
               AND (
   
                 t1.payment_success = 'Active' OR t1.free_trial = 'Active'
   
               )
   
               AND t1.property_expiry_date >= '" . date('Y-m-d H:i:s') . "'
   
              
               AND t1.`id` IN (SELECT property_id FROM floorplan WHERE property_id = t1.id AND STATUS = 'active')
   
               ) AS active_props,
   
             c.`name`
   
             FROM campus c
      
          GROUP BY c.`id`
   
           ";

    $data = DB::select($query);

    return $data;
  }


}
