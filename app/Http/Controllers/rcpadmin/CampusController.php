<?php

namespace App\Http\Controllers\rcpadmin;

use App\CampusGuideModel;
use App\CampusZipCode;
use App\CampusNeighborhood;
use App\CampusRentingQuestion;
use App\CampusDestination;
use App\CampusModel;
use App\CampusApartment;
use App\User;
/*use App\LinkedCampusModel;*/
use App\CampusLinkedModel;
use Illuminate\Http\File;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Request;

class CampusController extends Controller
{
  public function index()
  {

    $campuses = CampusModel::paginate(10);

    return view('rcpadmin.campus', compact('campuses'));
  }

  public function search()
  {
    $q = $_REQUEST['q'];
    if ($q != "") {

      $campuses = CampusModel::where('name', 'LIKE', '%' . $q . '%')->orWhere('title', 'LIKE', '%' . $q . '%')->orWhere('address', 'LIKE', '%' . $q . '%')->paginate(10)->setPath('');
      //echo '<pre>';print_r($webUsers );echo '</pre>';die('Call');
      $pagination = $campuses->appends(array(
        'q' => $q
      ));
      if (count($campuses) > 0) {

        return view('rcpadmin.campus', compact('campuses'))->withQuery($q);
      }
      //return view('rcpadmin.users', compact('webUsers'));
    }
    //$campuses = CampusModel::paginate(10);

    // return view('rcpadmin.campus', compact('campuses'));
  }

  public function search_ajax()
  {
    $q = $_REQUEST['q'];
    if ($q != "") {


      $campuses = CampusModel::where('name', 'LIKE', '%' . $q . '%')->orWhere('title', 'LIKE', '%' . $q . '%')->orWhere('address', 'LIKE', '%' . $q . '%')->paginate(20)->setPath('');
      //echo '<pre>';print_r($webUsers );echo '</pre>';die('Call');
      $pagination = $campuses->appends(array(
        'q' => $q
      ));
      if (count($campuses) > 0):
        foreach ($campuses as $campus): ?>
          <tr>
            <td> <?php echo $campus['id'] ?></td>
            <td> <?php echo $campus['name'] ?></td>
            <td> <?php echo $campus['title'] ?> </td>
            <td> <?php echo $campus['status'] ?> </td>
            <td>
              <ul class="d-flex justify-content-center">
                <?php if (isset($_REQUEST['page']) && $_REQUEST['page'] == 'property'): ?>
                  <li class="mr-3"><a href="<?php echo url('rcpadmin/property/' . $campus['id'] . '/listing') ?>"
                                      class="text-secondary" target="_blank"><i
                        class="fa fa-edit" title="Detail"></i></a></li>

                  <?php elseif(isset($_REQUEST['page']) && $_REQUEST['page'] == 'landing'): ?>
                  <li class="mr-3"><a href="<?php echo url('rcpadmin/landing-page/' . $campus['id'] . '/edit') ?>"
                                      class="text-secondary" target="_blank"><i
                        class="fa fa-edit" title="Detail"></i></a></li>
                <?php else: ?>

                  <li class="mr-3"><a href="<?php echo url('rcpadmin/campus/' . $campus['id']) ?>"
                                      class="text-secondary" target="_blank"><i
                        class="fa fa-edit" title="Detail"></i></a></li>
                  <li class="mr-3"><a
                      href="<?php echo url('rcpadmin/campus/' . $campus['id'] . '/map') ?>"
                      class="text-secondary" title="Map" target="_blank"><i
                        class="fa fa-map"></i></a></li>
                  <li class="mr-3"><a
                      href="<?php echo url('rcpadmin/campus/' . $campus['id'] . '/apartment') ?>"
                      class="text-secondary" title="Apartment" target="_blank"><i
                        class="fa fa-building"></i></a></li>
                  <li class="mr-3"><a
                      href="<?php echo url('rcpadmin/campus/' . $campus['id'] . '/renting') ?>"
                      class="text-secondary" title="Renting Question" target="_blank"><i
                        class="fa fa-question-circle"></i></a></li>
                  <li class="mr-3"><a
                      href="<?php echo url('rcpadmin/campus/' . $campus['id'] . '/neighborhood') ?>"
                      class="text-secondary" title="Neighborhoods" target="_blank"><i
                        class="fa fa-home"></i></a></li>
                  <li class="mr-3"><a
                      href="<?php echo url('rcpadmin/campus/' . $campus['id'] . '/destination') ?>"
                      class="text-secondary" title="Destinaion" target="_blank"><i
                        class="fa fa-map-marker"></i></a></li>
                  <li><a data-admin-id="<?php echo $campus['id'] ?>" href="javascript:void(0)"
                         data-method="delete" class="text-danger jquery-postback"><i
                        class="ti-trash"></i></a>
                  </li>

                <?php endif; ?>
              </ul>
            </td>
          </tr>
        <?php endforeach;
      endif ?>
      <?php
    }
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
    $users = User::all_landlords('id', 'name');
    $usersSelect[''] = 'Featured Landlord';
    foreach ($users as $user) {
      $usersSelect[$user->id] = $user->name;
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
            CampusLinkedModel::create(['campus_id' => $campus->id, 'campus_linked' => $campId]);
          endif;
        }


      }
    }


    return redirect('rcpadmin/campus');

  }

  public function show($id)
  {
    $campus = CampusModel::find($id);

    $abbrDataArray = array();
    $zipDataArray = array();


    $campusAbbrData = explode(',', $campus['campus_abbrevation']);
    foreach ($campusAbbrData as $abbr) {
      echo '<pre>';
      print_r($abbr);
      echo '</pre>';
      $abbrDataArray[] = $abbr;
    }
    $campusZipCodes = explode(',', $campus['zip_codes']);
    foreach ($campusZipCodes as $zip) {
      $zipDataArray[] = $zip;
    }
    $campuses = CampusModel::all('id', 'title')->toArray();

    $linked_campuses_data = CampusLinkedModel::where('campus_id', '=', $id)->get()->pluck('campus_linked')->toArray();

    $campusSelect = [];
    $usersSelect = [];

    $campusSelect[''] = 'Campus (es)';
    foreach ($campuses as $campus2) {
      $campusSelect[$campus2['id']] = $campus2['title'];
    }

    $linked_campuses = [];
    foreach ($linked_campuses_data as $linked_campus) {
      $linked_campuses[$linked_campus] = $linked_campus;
    }
    $users = User::all_landlords('id', 'name');
    $usersSelect[''] = 'Featured Landlord';
    foreach ($users as $user) {
      $usersSelect[$user->id] = $user->name;
    }

    return view('rcpadmin.campus.edit', compact('campus', 'campusSelect', 'usersSelect', 'linked_campuses', 'abbrDataArray', 'zipDataArray'));
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

      CampusLinkedModel::where('campus_id', '=', $id)->delete();

      /*
            if (!empty($linked_campuses)) {
              $campus->linked_campuses()->detach();
            }*/

      $campusIds = $input['campus_linked'];
      foreach ($campusIds as $campId) {
        CampusLinkedModel::create(['campus_id' => $id, 'campus_linked' => $campId]);
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

  public function apartment($id)
  {
    $campus = CampusModel::getCampusApartmentDetail($id);

    return view('rcpadmin.campus.apartment', compact('campus'));
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

  public function apartment_update($id, Requests\ApartmentRequest $request)
  {
    $input = Request::all();

    $campus_apartment = CampusApartment::where('campus_id', '=', $id)->first();

    if ($campus_apartment) {
      $campus_apartment->update($input);
    } else {
      CampusApartment::create($input);
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

  function saveZipcode()


  {
    $campus_id = $_POST['campus_id'];
    $zipCodes = implode(',', $_POST['zip']);
    $campus = CampusModel::where('id', '=', $campus_id)->first();
    $campus->update(['zip_codes' => $zipCodes]);


  }

  function saveAbbr()


  {
    $campus_id = $_POST['campus_id'];
    $abbr = implode(',', $_POST['abbr']);
    $campus = CampusModel::where('id', '=', $campus_id)->first();
    $campus->update(['campus_abbrevation' => $abbr]);


  }
}
