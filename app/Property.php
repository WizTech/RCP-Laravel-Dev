<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\CampusModel;
use App\CategoryModel;
use App\FloorplanModel;
use App\FeatureModel;
//use App\PropertyFeatureModel;

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

    public function category()
    {
        return $this->belongsTo('App\CategoryModel');
    }

    public function floorplans()
    {
        return $this->belongsToMany('App\FloorplanModel', 'floorplan', 'property_id');
    }

    public static function getFloorplans($id)
    {
        $floorplans = FloorplanModel::where('property_id', '=', $id)->get()->toArray();
        return $floorplans;
    }
    public static function getFeatures($id)
    {
        $features = FeatureModel::all()->toArray();
        //$floorplans = FloorplanModel::where('property_id', '=', $id)->get()->toArray();
        return $features;
    }
}
