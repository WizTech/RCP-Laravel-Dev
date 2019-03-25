<?php

namespace App\Http\Controllers\rcpadmin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Property;
use App\CampusModel;
use App\User;
use App\CategoryModel;
use App\FloorplanModel;
use App\PropertyFeatureModel;
use App\PropertyImage;
use Request;

class PropertyController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    //
    $properties = Property::with('category')->get()->toArray();
    return view('rcpadmin.property', compact('properties'));
  }

  public function create()
  {
    $campuses = CampusModel::all('id', 'title')->toArray();
    $categories = CategoryModel::all('id', 'name')->toArray();
    $campusSelect = [];
    $usersSelect = [];

    $campusSelect[''] = 'Campus';
    foreach ($campuses as $campus) {
      $campusSelect[$campus['id']] = $campus['title'];
    }

    $categorySelect[''] = 'Category';
    foreach ($categories as $category) {
      $categorySelect[$category['id']] = $category['name'];
    }
    $users = User::landlords('id', 'name')->toArray();
    $usersSelect[''] = 'Landlord';
    foreach ($users as $user) {
      $usersSelect[$user['id']] = $user['name'];
    }
    return view('rcpadmin.property.add', compact('campusSelect', 'usersSelect', 'categorySelect'));
  }

  public function store(Requests\Property $request)
  {
    $input = Request::all();

    $Coordinates = $this->getCoordinates($input['address']);
    if ($Coordinates) {
      $coordinates_array = explode(',', $Coordinates);

      if (isset($coordinates_array[0]) && isset($coordinates_array[1])) {
        $input['lat'] = $coordinates_array[0];
        $input['lng'] = $coordinates_array[1];
      }

    }
    Property::create($input);

    return redirect('rcpadmin/property');
  }

  public function show($id)
  {
    $property = Property::find($id);
    $categories = CategoryModel::all('id', 'name')->toArray();
    $campuses = CampusModel::all('id', 'title')->toArray();

    $campusSelect = [];
    $usersSelect = [];

    $campusSelect[''] = 'Campus (es)';
    foreach ($campuses as $campus2) {
      $campusSelect[$campus2['id']] = $campus2['title'];
    }
    $users = User::landlords('id', 'name')->toArray();
    $usersSelect[''] = 'Featured Landlord';
    foreach ($users as $user) {
      $usersSelect[$user['id']] = $user['name'];
    }
    $categorySelect[''] = 'Category';
    foreach ($categories as $category) {
      $categorySelect[$category['id']] = $category['name'];
    }

    return view('rcpadmin.property.edit', compact('property', 'campusSelect', 'usersSelect', 'categorySelect'));
  }

  public function update(Requests\Property $request, $id)
  {
    $input = Request::all();
    $property = Property::find($id);


    if (trim($property->address) != $input['address']) {
      $Coordinates = $this->getCoordinates($property->address);

      if ($Coordinates) {
        $coordinates_array = explode(',', $Coordinates);

        if (isset($coordinates_array[0]) && isset($coordinates_array[1])) {
          $input['lat'] = $coordinates_array[0];
          $input['lng'] = $coordinates_array[1];
        }
      }
    }
    $property->update($input);

    return redirect('rcpadmin/property');
  }

  public function destroy($id)
  {
    $input = Request::all();

    $id = $input['id'];

    $data = Property::find($id);

    if ($data) {
      Property::destroy($id);
    }
    return 'true';
  }

  function getCoordinates($address)
  {

    $address = str_replace(" ", "+", $address);

    $url = "https://maps.google.com/maps/api/geocode/json?sensor=false&address=$address&key=" . env('MAP_API_KEY');
    $response = file_get_contents($url);

    $json = json_decode($response, TRUE); //generate array object from the response from the web
    if (isset($json['results'][0]['geometry']['location']['lat']) && isset($json['results'][0]['geometry']['location']['lng'])) {
      return ($json['results'][0]['geometry']['location']['lat'] . "," . $json['results'][0]['geometry']['location']['lng']);
    }
    return false;
  }

  public function floorplan($id)
  {
    $propertyData = Property::find($id)->toArray();
    $floorplans = Property::getFloorplans($id);
    return view('rcpadmin.property.floorplan', compact('floorplans', 'propertyData'));
  }

  public function floorplan_update(Requests\FloorplanRequest $request, $id)
  {
    $input = Request::all();
    $property = Property::find($id);
    if ($input) {
      $floorplans = FloorplanModel::where('property_id', '=', $id)->first();

      if (!empty($floorplans)) {
        $property->floorplans()->detach();
      }
    }


    $index = 0;
    foreach ($input['title'] as $name) {
      if ($name):
        $bed = $input['bed'][$index];
        $bath = $input['bath'][$index];
        $price = $input['price'][$index];
        $sq_footage = $input['sq_footage'][$index];
        $available_date = $input['available_date'][$index];
        FloorplanModel::create(['property_id' => $id, 'title' => $name, 'price' => $price, 'bed' => $bed, 'bath' => $bath, 'sq_footage' => $sq_footage, 'available_date' => $available_date]);
        $index++;
      endif;
    }

    return redirect('rcpadmin/property');
  }

  public function feature($id)
  {
    $propertyData = Property::find($id)->toArray();
    $features = Property::getFeatures($id);
    $property_features = Property::getsPropertyFeatures($id);

    return view('rcpadmin.property.feature', compact('features', 'propertyData', 'property_features'));
  }

  public function feature_update(Requests\PropertyFeatureRequest $request, $id)
  {
    $input = Request::all();
    $property = Property::find($id);
    if ($input) {
      $features = PropertyFeatureModel::where('property_id', '=', $id)->first();

      if (!empty($features)) {
        $property->features()->detach();
      }
    }


    $index = 0;
    foreach ($input['feature_id'] as $feature_id) {
      if ($feature_id):

        PropertyFeatureModel::create(['property_id' => $id, 'feature_id' => $feature_id]);
        $index++;
      endif;
    }

    return redirect('rcpadmin/property');
  }

  public function addFloorplan()
  {
    ?>
    <div class="form-row">
      <div class="col-md-2 mb-2">
        <label for="Title" class="col-form-label">Title</label>
        <input class="form-control" name="title[]" type="text" value="">

      </div>
      <div class="col-md-2 mb-2">
        <label for="Bed" class="col-form-label">Bedroom</label>
        <input class="form-control bed" name="bed[]" type="text"
               value="">
      </div>
      <div class="col-md-2 mb-2">
        <label for="Bathroom" class="col-form-label">Bathroom</label>
        <input class="form-control bath" name="bath[]" type="text"
               value="">
      </div>
      <div class="col-md-2 mb-2">
        <label for="Rent" class="col-form-label">Rent</label>
        <input class="form-control rent" name="price[]" type="text"
               value="">
      </div>
      <div class="col-md-2 mb-2">
        <label for="Sq Footage" class="col-form-label">Square Footage</label>
        <input class="form-control sq_footage" name="sq_footage[]" type="text"
               value="">
      </div>
      <div class="col-md-2 mb-2">
        <label for="Available Date" class="col-form-label">Available Date</label>
        <input class="form-control " name="available_date[]" type="text"
               value="">
      </div>
    </div>
    <?php
  }

  public function images($id)
  {
    $propertyData = Property::find($id)->toArray();
    $images = Property::getImages($id);

    return view('rcpadmin.property.image', compact('images', 'propertyData'));
  }
}
