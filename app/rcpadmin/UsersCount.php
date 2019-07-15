<?php

namespace App\rcpadmin;

use Illuminate\Database\Eloquent\Model;
use DB;

class UsersCount extends Model
{


  static function free_trial()
  {

    $query = "
    
           SELECT
               
                        (SELECT
               
                          COUNT(us.id)
               
                        FROM
               
                          `landlord_details` us
               
                        WHERE us.`free_trial` = 'ACTIVE' ) AS free_count,
               
                        (SELECT
               
                          COUNT(ust.id)
               
                        FROM
               
                          `landlord_details` ust
               
                        WHERE ust.`free_trial` = 'INACTIVE' ) AS paid_count,
               
                        (
               
                         SELECT COUNT(ucf.id)
               
                         FROM `property` pl
               
                          INNER JOIN `landlord_details` ucf ON ucf.`id` = pl.`landlord_id` AND ucf.`free_trial` = 'ACTIVE'
               
                          WHERE c.`id` = pl.`campus_id` 
               
                          GROUP BY ucf.`id` LIMIT 1
               
                        ) as campus_free,
               
                        (
               
                         SELECT COUNT(ucp.id)
               
                         FROM `property` p
               
                          INNER JOIN `landlord_details` ucp ON ucp.`id` = p.`landlord_id` AND ucp.`free_trial` = 'INACTIVE'
               
                          WHERE c.`id` = p.`campus_id` 
               
                          GROUP BY ucp.`id` LIMIT 1
               
                        ) as campus_paid, c.`name`,c.`id`
               
                      FROM
               
                      `campus` c
               
                      GROUP BY c.`id`
    
            ";

    $data = DB::select($query);

    return $data;
  }


}
