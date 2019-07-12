<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\CampusModel;
use App\CategoryModel;
use App\FloorplanModel;
use App\FeatureModel;
use App\FeatureType;
use App\PropertyImage;

use App\PropertyFeatureModel;
use App\User;
use DB;

class Property extends Model
{
    protected $table = 'property';
    protected $fillable = [
        'title', 'address', 'campus_id', 'category_id', 'landlord_id', 'status', 'twilio_number', 'free_trial', 'street_address_short', 'description', 'meta_title', 'meta_description', 'email', 'phone', 'spcial', 'property_expiry_date', 'lat', 'lng'
    ];


    public function campus()
    {
        return $this->belongsTo('App\CampusModel');
    }

    public function landlord()
    {
        return $this->belongsTo('App\User');
    }

    public function category()
    {
        return $this->belongsTo('App\CategoryModel');
    }

    public function floorplans()
    {
        return $this->belongsToMany('App\FloorplanModel', 'floorplan', 'property_id');
    }

    public function features()
    {
        return $this->belongsToMany('App\PropertyFeatureModel', 'property_features', 'property_id');
    }

    public static function getFloorplans($id)
    {
        $floorplans = FloorplanModel::where('property_id', '=', $id)->get()->toArray();
        return $floorplans;
    }

    public static function getImages($id)
    {
        $images = PropertyImage::where('property_id', '=', $id)->get()->toArray();
        return $images;
    }

    public static function getsPropertyFeatures($id)
    {
        $features = PropertyFeatureModel::select('feature_id')->where('property_id', '=', $id)->get()->toArray();
        $featureData = [];
        foreach ($features as $feature) {
            $featureData[] = $feature['feature_id'];
        }
        return $featureData;
    }

    public static function getFeatures()
    {
        $features = FeatureModel::with('type')->get()->groupBy('type')->toArray();


        return $features;
    }

    public static function expired()
    {
        $currentDate = date('Y-m-d H:i:s');
        $properties = Property::where('property_expiry_date', '>', $currentDate)->with('campus')->with('landlord');
        return $properties;
    }

    public static function premium_listings()
    {

        $properties = Property::where('domain_name', '>', '')->with('campus')->with('landlord')->get()->toArray();
        return $properties;
    }

    static function lead_export($date_from, $date_to, $campus_id)
    {
        if ($campus_id !== 'All') {
            $expiredListings = DB::table(env('DB_DATABASE') . '.property AS p')
                ->leftJoin('campus', 'p.campus_id', '=', 'campus.id')
                ->leftJoin('users', 'p.landlord_id', '=', 'users.id')
                ->where('campus.id', $campus_id)
                ->whereBetween('p.property_expiry_date', [$date_from, $date_to])
                ->select('p.id', 'users.name as username', 'users.email', 'p.title', 'p.address', 'campus.title as campus_title', 'p.property_expiry_date')
                ->get();
            return $expiredListings;
        }else{
            $expiredListings = DB::table(env('DB_DATABASE') . '.property AS p')
              ->leftJoin('campus', 'p.campus_id', '=', 'campus.id')
              ->leftJoin('users', 'p.landlord_id', '=', 'users.id')
              /*->where('campus.id', $campus_id)*/
              ->whereBetween('p.property_expiry_date', [$date_from, $date_to])
              ->select('p.id', 'users.name as username', 'users.email', 'p.title', 'p.address', 'campus.title as campus_title', 'p.property_expiry_date')
              ->get();
            return $expiredListings;
        }
    }

    static function landlord_lisitngs($landlord_id)
    {
        $query = "SELECT GROUP_CONCAT(id) AS ids FROM property WHERE  landlord_id = '$landlord_id' ";
        $data = DB::select($query);

        return $data;
    }
}
