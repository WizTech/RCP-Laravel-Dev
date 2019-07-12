<?php

namespace App\rcpadmin;

use Illuminate\Database\Eloquent\Model;
use DB;

class TopsSpots extends Model
{


    static function listings()
    {
        $listings = DB::table(env('DB_DATABASE') . '.property AS p')
            ->join('campus', 'p.campus_id', '=', 'campus.id')
            ->where([['p.double_featured', '=', 1],['p.double_featured_ord', '<>', 0]])
            ->select('campus.id', 'campus.title',DB::raw('count(p.id ) as cnt'))
            ->groupBy('p.campus_id')
            ->paginate(10);
        return $listings;
    }

    static function listingData($id)
    {


        $listings = DB::table(env('DB_DATABASE') . '.property AS p')
            ->join('campus', 'p.campus_id', '=', 'campus.id')
            ->join('users', 'users.id', '=', 'p.landlord_id')
            ->where([['p.campus_id', '=', $id],['p.double_featured', '=', 1],['p.double_featured_ord', '<>', 0]])
            ->select('campus.title AS campus_title', 'p.id', 'p.title', 'p.address', 'users.name', 'p.topspot_paid', 'p.double_featured_ord', 'p.double_feature_expiry_date')
            ->paginate(10);
        return $listings;
    }


}