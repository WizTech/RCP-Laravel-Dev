<?php

namespace App\rcpadmin;

use Illuminate\Database\Eloquent\Model;
use DB;

class EmailTrack extends Model
{
    protected $connection = "mysql2";
    protected $table = "email_track";

    static function email_leads()
    {
        $emailLeads = DB::table(env('DB_DATABASE2') . '.email_track AS emailLeads')
            ->join('property', 'emailLeads.property_id', '=', 'property.id')
            ->join('users', 'users.id', '=', 'property.landlord_id')
            ->join('campus', 'property.campus_id', '=', 'campus.id')
            ->OrderBy('emailLeads.id', 'desc')
            ->select('emailLeads.id', 'emailLeads.sender_name', 'emailLeads.sender_email', 'emailLeads.user_from', 'emailLeads.sender_contact', 'emailLeads.id', 'property.title', 'property.address', 'property.campus_id', 'campus.title as campus_title', 'users.name', 'emailLeads.date_created')
            ->paginate(10);
        return $emailLeads;
    }

    static function export_list()
    {

        $dateFrom = date("Y-m-d", strtotime("-1 month"));

        $dateTo = date("Y-m-d");

        $sql = " SELECT 
                 p.title,
                 us.first_name,
                 us.last_name,
                 u.name,
                 e.property_id,
                e.sender_name,
                e.sender_email,
                e.sender_contact,
                e.sender_message,
                e.date_created AS datecreated,
                p.address AS address 
                FROM
                ".env('DB_DATABASE2').". `email_track` e 
                INNER JOIN `property` p 
                ON e.`property_id` = p.`id` 
                JOIN `users` u 
                ON u.`id` = e.`user_id`
                JOIN `user_details` us 
                ON u.`id` = us.`user_id` 
                AND e.`date_created` BETWEEN '$dateFrom'  AND '$dateTo' 
                GROUP BY e.`id` 
                ORDER BY u.`name` ASC 
                ";

        $leads = DB::select($sql);
        return $leads;
    }
}
