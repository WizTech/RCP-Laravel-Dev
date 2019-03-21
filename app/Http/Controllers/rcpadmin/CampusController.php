<?php

namespace App\Http\Controllers\rcpadmin;

use App\CampusGuideModel;
use App\CampusNeighborhood;
use App\CampusRentingQuestion;
use App\CampusDestination;
use App\CampusModel;
use App\User;
use App\LinkedCampusModel;
use Illuminate\Http\File;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Request;

class CampusController extends Controller
{
  public function index()
  {

    $campuses = CampusModel::all()->toArray();

    return view('rcpadmin.campus', compact('campuses'));
  }

  public function create()
  {
    $campuses = CampusModel::all('id', 'title')->toArray();
    $campusSelect = [];
    $usersSelect = [];

    $campusSelect[''] = 'Campus (es)';
    foreach ($campuses as $campus) {
      $campusSelect[$campus['id']] = $campus['title'];
    }
    $users = User::landlords('id', 'name')->toArray();
    $usersSelect[''] = 'Featured Landlord';
    foreach ($users as $user) {
      $usersSelect[$user['id']] = $user['name'];
    }
    return view('rcpadmin.campus.add', compact('campusSelect', 'usersSelect'));
  }

  public function store(Requests\CampusRequest $request)
  {

    $input = Request::all();
    $Coordinates = $this->getCoordinates($input['address']);
    if ($Coordinates) {
      $coordinates_array = explode(',', $Coordinates);

      if (isset($coordinates_array[0]) && isset($coordinates_array[1])) {
        $input['lat'] = $coordinates_array[0];
        $input['lng'] = $coordinates_array[1];
      }
      $campus = CampusModel::create($input);
      if ($campus && !empty($input['campus_linked'])) {

        $campusIds = $input['campus_linked'];
        foreach ($campusIds as $campId) {
          if ($campId):
            LinkedCampusModel::create(['campus_id' => $campus->id, 'linked_campus_id' => $campId]);
          endif;
        }


      }
    }


    return redirect('rcpadmin/campus');

  }

  public function show($id)
  {
    $campus = CampusModel::find($id);

    $campuses = CampusModel::all('id', 'title')->toArray();
    $linked_campuses = LinkedCampusModel::where('campus_id', '=', $id)->get()->pluck('linked_campus_id')->toArray();

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


    return view('rcpadmin.campus.edit', compact('campus', 'campusSelect', 'usersSelect', 'linked_campuses'));
  }

  public function update($id, Requests\CampusRequest $request)
  {
    $input = Request::all();
    $campus = CampusModel::find($id);


    if (trim($campus->address) != $input['address']) {
      $Coordinates = $this->getCoordinates($campus->address);

      if ($Coordinates) {
        $coordinates_array = explode(',', $Coordinates);

        if (isset($coordinates_array[0]) && isset($coordinates_array[1])) {
          $input['lat'] = $coordinates_array[0];
          $input['lng'] = $coordinates_array[1];
        }
      }
    }
    $campus->update($input);


    if (!empty($input['campus_linked'])) {

      LinkedCampusModel::where('campus_id', '=', $id)->delete();

      /*
            if (!empty($linked_campuses)) {
              $campus->linked_campuses()->detach();
            }*/

      $campusIds = $input['campus_linked'];
      foreach ($campusIds as $campId) {
        LinkedCampusModel::create(['campus_id' => $id, 'linked_campus_id' => $campId]);
      }
    }
    return redirect('rcpadmin/campus');
  }

  public function destroy()
  {
    $input = Request::all();

    $id = $input['id'];

    $campus = CampusModel::find($id);

    if ($campus) {
      CampusModel::destroy($id);
    }
    return 'true';
    // return redirect('rcpadmin/admin_users');
  }

  function getCoordinates($address)
  {

    $address = str_replace(" ", "+", $address); // replace all the white space with "+" sign to match with google search pattern

    $url = "https://maps.google.com/maps/api/geocode/json?sensor=false&address=$address&key=" . env('MAP_API_KEY');
    $response = file_get_contents($url);

    $json = json_decode($response, TRUE); //generate array object from the response from the web
    if (isset($json['results'][0]['geometry']['location']['lat']) && isset($json['results'][0]['geometry']['location']['lng'])) {
      return ($json['results'][0]['geometry']['location']['lat'] . "," . $json['results'][0]['geometry']['location']['lng']);
    }
    return false;
  }

  public function map($id)
  {
    $campus = CampusModel::getCampusDetail($id);
    return view('rcpadmin.campus.map', compact('campus'));
  }

  public function renting($id)
  {
    $campusData = CampusModel::find($id)->toArray();
    $campus = CampusModel::getRentingDetail($id);
    return view('rcpadmin.campus.renting', compact('campus', 'campusData'));
  }

  public function neighborhood($id)
  {
    $campusData = CampusModel::find($id)->toArray();
    $campus = CampusModel::getNeighborhoodDetail($id);
    return view('rcpadmin.campus.neighborhood', compact('campus', 'campusData'));
  }

  public function destination($id)
  {
    $campusData = CampusModel::find($id)->toArray();
    $campus = CampusModel::getDestinationDetail($id);

    return view('rcpadmin.campus.destination', compact('campus', 'campusData'));
  }

  public function map_update($id, Requests\CampusGuideRequest $request)
  {
    $input = Request::all();
    $image = $request->file('image');
    if (isset($image)) {
      $companyPath = storage_path('app/public/guide/');
      $image->move($companyPath, $image->getClientOriginalName());


      $imageName = $image->getClientOriginalName();
      $input['image'] = $imageName;
    }


    $campus_guide = CampusGuideModel::where('campus_id', '=', $id)->first();

    if ($campus_guide) {
      $campus_guide->update($input);
    } else {
      CampusGuideModel::create($input);
    }


    return redirect('rcpadmin/campus');
  }


  public function destination_update($id, Requests\CampusDestination $request)
  {
    $input = Request::all();
    $campus = CampusModel::find($id);
    if ($input) {
      $destinations = CampusDestination::where('campus_id', '=', $id)->first();

      if (!empty($destinations)) {
        $campus->destination()->detach();
      }
    }


    $index = 0;
    foreach ($input['name'] as $name) {
      if ($name):
        $address = $input['address'][$index];
        $lat = $input['lat'][$index];
        $lng = $input['lng'][$index];
        CampusDestination::create(['campus_id' => $id, 'name' => $name, 'address' => $address, 'lat' => $lat, 'lng' => $lng]);
        $index++;
      endif;
    }

    return redirect('rcpadmin/campus');
  }

  public function neighborhood_update($id, Requests\CampusNeighborhood $request)
  {

    $input = Request::all();

    $campus = CampusModel::find($id);
    if ($input) {
      $neighborhood = CampusNeighborhood::where('campus_id', '=', $id)->first();

      if (!empty($neighborhood)) {
        $campus->neighborhood()->detach();
      }
    }

    $index = 0;
    foreach ($input['title'] as $title) {
      $alt = $input['alt'][$index];
      if (isset($input['photo'][$index])) {
        $photo = $input['photo'][$index];
      }

      $image = $request->file('image');
      if (isset($image[$index])) {
        $companyPath = storage_path('app/public/neighborhood/');
        $image[$index]->move($companyPath, $image[$index]->getClientOriginalName());


        $imageName = $image[$index]->getClientOriginalName();
      } else {
        $imageName = $photo;
      }


      $description = $input['description'][$index];


      CampusNeighborhood::create(['campus_id' => $id, 'title' => $title, 'image' => $imageName, 'alt' => $alt, 'description' => $description]);

      $index++;
    }

    return redirect('rcpadmin/campus');
  }

  public function renting_update($id, Requests\CampusNeighborhood $request)
  {

    $input = Request::all();

    $campus = CampusModel::find($id);
    if ($input) {
      $renting = CampusRentingQuestion::where('campus_id', '=', $id)->first();

      if (!empty($renting)) {
        $campus->renting()->detach();
      }
    }

    $index = 0;
    foreach ($input['title'] as $title) {
      $alt = $input['alt'][$index];
      if (isset($input['photo'][$index])) {
        $photo = $input['photo'][$index];
      }

      $image = $request->file('image');
      if (isset($image[$index])) {
        $companyPath = storage_path('app/public/renting/');
        $image[$index]->move($companyPath, $image[$index]->getClientOriginalName());


        $imageName = $image[$index]->getClientOriginalName();
      } else {
        $imageName = $photo;
      }


      $description = $input['description'][$index];


      CampusRentingQuestion::create(['campus_id' => $id, 'title' => $title, 'image' => $imageName, 'alt' => $alt, 'description' => $description]);

      $index++;
    }

    return redirect('rcpadmin/campus');
  }

  public function addDestination()

  {

    ?>

    <div class="form-row">
      <div class="col-md-6 mb-6">
        <label for="Name" class="col-form-label">Name</label>
        <input class="form-control" name="name[]" type="text" value="">
        <input class="lat" name="lat[]" type="hidden" value="">
        <input class="lng" name="lng[]" type="hidden" value="">
      </div>
      <div class="col-md-6 mb-6">
        <label for="Address" class="col-form-label">Address</label>
        <input class="form-control address" name="address[]" type="text"
               value="">
      </div>
    </div>
    <?php


  }

  public function addNeighborhood()

  {

    ?>

    <div class="form-row">
      <div class="col-md-6 mb-6">
        <input name="image[]" type="file">

        <img style="float: right;" height="60" width="60"
             src="">

      </div>
      <div class="col-md-6 mb-6">
        <label for="Image Alt" class="col-form-label">Image Alt</label>
        <input class="form-control" name="alt[]" type="text" value="">
      </div>
      <div class="col-md-6 mb-6">
        <label for="Title" class="col-form-label">Title</label>
        <input class="form-control" name="title[]" type="text" value="">
      </div>
      <div class="col-md-6 mb-6">
        <label for="Description" class="col-form-label">Description</label>
        <input class="form-control" name="description[]" type="text"
               value="">
      </div>

    </div>
    <?php


  }
}
