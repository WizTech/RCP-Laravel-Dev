<?php

namespace App\rcpadmin;

use Illuminate\Database\Eloquent\Model;
use DB;

class PhoneLeads extends Model
{
    protected $connection = "mysql2";
    protected $table = "phone_leads";

    static function phone_leads()
    {
        $phoneLeads = DB::table(env('DB_DATABASE2') . '.phone_leads AS phoneLeads')
            ->join('property', 'phoneLeads.property_id', '=', 'property.id')
            ->join('users', 'users.id', '=', 'property.landlord_id')
            ->join('campus', 'property.campus_id', '=', 'campus.id')
            ->OrderBy('phoneLeads.id', 'desc')
            ->select('phoneLeads.id','phoneLeads.name As sender_name','phoneLeads.email As sender_email','phoneLeads.user_from','phoneLeads.phone','phoneLeads.id', 'property.title', 'property.address', 'property.campus_id', 'campus.title as campus_title', 'users.name', 'phoneLeads.date_created')
            ->paginate(10);
        return $phoneLeads;
    }
}
