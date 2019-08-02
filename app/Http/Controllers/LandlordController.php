<?php
/**
 * Created by PhpStorm.
 * User: Tariq-pc
 * Date: 7/30/2019
 * Time: 4:46 PM
 */
namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Routing\Controller as BaseController;
use App\CampusModel;
use App\CategoryModel;
use App\User;
use App\Property;
use App\FloorplanModel;
use App\PropertyFeatureModel;
use App\PropertyImage;
use App\Upload;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Response;
use Intervention\Image\Facades\Image;
use App\UserDetails;
use App\rcpadmin\CampusInsight;
use App\Http\Requests\CampusInsightRequest;
use App\landlord\Sublease;
use App\landlord\Application;
use Request;

class LandlordController extends BaseController
{
  private $photos_path;


  public function __construct()
  {
    $this->photos_path = storage_path('/app/public/uploads/property_images');
    $this->middleware('auth:landlord')->except('logout');
  }


  public function index()
  {
    $user = auth()->guard('landlord')->user();
    $id = $user['id'];
    $user = User::getUserDetail($id);


    return view('landlord.profile', compact('user'));
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
    $users = User::all_landlords('id', 'name');
    $usersSelect[''] = 'Featured Landlord';
    foreach ($users as $user) {
      $usersSelect[$user->id] = $user->name;
    }
    $categorySelect[''] = 'Category';
    foreach ($categories as $category) {
      $categorySelect[$category['id']] = $category['name'];
    }

    return view('landlord.property.edit', compact('property', 'campusSelect', 'usersSelect', 'categorySelect'));
  }

  public function update()
  {
    $input = Request::all();

    unset($input['_token']);
    $id = $input['id'];
    $user = User::find($id);
    unset($input['email']);
    unset($input['name']);
    $user_details = UserDetails::where('user_id', '=', $id)->first();

    $user->update($input);
    if ($user_details):
      $user_details->update($input);
    else:
      $input['user_id'] = $id;
      UserDetails::create($input);
    endif;

    return redirect('landlord');
  }

  public function updateProperty(Request $request, $id)
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

    return redirect('landlord/listing');
  }

  public function changePassword()
  {
    $user = auth()->guard('landlord')->user();
    $id = $user['id'];
    $user = User::getUserDetail($id);


    return view('landlord.change-password', compact('user'));
  }

  public function updatePassword(Requests\PasswordRequest $request)
  {

    $input = Request::all();

    $input['password'] = md5($input['password']);

    $id = $input['id'];


    $user = User::find($id);
    $user->update($input);
    return redirect('landlord');
  }

  public function listing()
  {
    $user = auth()->guard('landlord')->user();
    $id = $user['id'];
    $properties = Property::where([['landlord_id', '=', $id], ['deleted', '=', 'Inactive']])->with('category')->paginate(10);

    return view('landlord.listing', compact('properties'));
  }

  public function deleted_listing()
  {
    $user = auth()->guard('landlord')->user();
    $id = $user['id'];
    $properties = Property::where([['landlord_id', '=', $id], ['deleted', '=', 'Active']])->with('category')->paginate(10);
    $module = 'deleted';
    return view('landlord.listing', compact('properties', 'module'));
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
    $users = User::all_landlords('id', 'name');
    $usersSelect[''] = 'Featured Landlord';
    foreach ($users as $user) {
      $usersSelect[$user->id] = $user->name;
    }
    return view('landlord.property.add', compact('campusSelect', 'usersSelect', 'categorySelect'));
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

    return redirect('landlord/listing');
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
    return view('landlord.property.floorplan', compact('floorplans', 'propertyData'));
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

    return redirect('landlord/listing');
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

  public function feature($id)
  {
    $propertyData = Property::find($id)->toArray();
    $features = Property::getFeatures($id);
    $property_features = Property::getsPropertyFeatures($id);

    return view('landlord.property.feature', compact('features', 'propertyData', 'property_features'));
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

    return redirect('landlord/listing');
  }

  public function images($id)
  {
    $propertyData = Property::find($id)->toArray();
    $images = Property::getImages($id);

    return view('landlord.property.image', compact('images', 'propertyData'));
  }

  public function store_images($id, Requests\UploadImage $request)
  {
    $photos = $request->file('file');

    if (!is_array($photos)) {
      $photos = [$photos];
    }

    if (!is_dir($this->photos_path)) {
      mkdir($this->photos_path, 0777);
    }

    if (!is_dir($this->photos_path . '/thumbs')) {
      mkdir($this->photos_path . '/thumbs', 0777);
    }

    if (!is_dir($this->photos_path . '/mid_thumb')) {
      mkdir($this->photos_path . '/mid_thumb', 0777);
    }

    if (!is_dir($this->photos_path . '/slider_images')) {
      mkdir($this->photos_path . '/slider_images', 0777);
    }

    for ($i = 0; $i < count($photos); $i++) {
      $photo = $photos[$i];
      $name = sha1(date('YmdHis') . str_random(30));
      $save_name = $name . '.' . $photo->getClientOriginalExtension();
      $resize_name = $name . str_random(2) . '.' . $photo->getClientOriginalExtension();
      //create small thumbnail
      $smallthumbnailpath = $this->photos_path . '/thumbs/' . $resize_name;
      $this->createThumbnail($photo, $smallthumbnailpath, 150, 93);


      //create medium thumbnail
      $mediumthumbnailpath = $this->photos_path . '/mid_thumb/' . $resize_name;
      $this->createThumbnail($photo, $mediumthumbnailpath, 300, 185);

      //create large thumbnail
      $largethumbnailpath = $this->photos_path . '/slider_images/' . $resize_name;;
      $this->createThumbnail($photo, $largethumbnailpath, 550, 340);

      $photo->move($this->photos_path, $resize_name);

      $upload = new PropertyImage();
      $upload->property_id = $id;
      $upload->image = $resize_name;
      $upload->original_name = basename($photo->getClientOriginalName());
      $upload->date = date('Y-m-d');
      $upload->save();
    }
    return Response::json([
      'message' => 'Image saved Successfully'
    ], 200);
  }

  public function destroy_images()
  {
    $request = Request::all();
    $filename = $request['id'];
    $uploaded_image = PropertyImage::where('original_name', basename($filename))->first();

    if (empty($uploaded_image)) {
      return Response::json(['message' => 'Sorry file does not exist'], 400);
    }

    $orignal_image = $this->photos_path . '/' . $uploaded_image->image;;
    $slider_images = $this->photos_path . '/slider_images/' . $uploaded_image->image;;
    $midthumb_images = $this->photos_path . '/mid_thumb/' . $uploaded_image->image;;
    $thumb_images = $this->photos_path . '/thumbs/' . $uploaded_image->image;;

    if (file_exists($orignal_image)) {
      unlink($orignal_image);
    }

    if (file_exists($slider_images)) {
      unlink($slider_images);
    }

    if (file_exists($midthumb_images)) {
      unlink($midthumb_images);
    }

    if (file_exists($thumb_images)) {
      unlink($thumb_images);
    }

    if (!empty($uploaded_image)) {
      $uploaded_image->delete();
    }

    return Response::json(['message' => 'File successfully delete'], 200);
  }

  public function delete_images($id)
  {

    $uploaded_image = PropertyImage::where('id', $id)->first();

    if (empty($uploaded_image)) {
      return Response::json(['message' => 'Sorry file does not exist'], 400);
    }

    $orignal_image = $this->photos_path . '/' . $uploaded_image->image;;
    $slider_images = $this->photos_path . '/slider_images/' . $uploaded_image->image;;
    $midthumb_images = $this->photos_path . '/mid_thumb/' . $uploaded_image->image;;
    $thumb_images = $this->photos_path . '/thumbs/' . $uploaded_image->image;;

    if (file_exists($orignal_image)) {
      unlink($orignal_image);
    }

    if (file_exists($slider_images)) {
      unlink($slider_images);
    }

    if (file_exists($midthumb_images)) {
      unlink($midthumb_images);
    }

    if (file_exists($thumb_images)) {
      unlink($thumb_images);
    }

    if (!empty($uploaded_image)) {
      $uploaded_image->delete();
    }

    return redirect('rcpadmin/property/' . $uploaded_image->property_id . '/images');

  }


  public function createThumbnail($photo, $path, $width, $height)
  {
    Image::make($photo)
      ->resize($width, $height, function ($constraints) {
        $constraints->aspectRatio();
      })
      ->save($path);
  }

  public function activeProperty()
  {
    $input = Request::all();
    $id = $input['id'];
    $property = Property::find($id);
    $data = [];
    $data['deleted'] = 'Inactive';
    $property->update($data);
    echo 'done';
  }

  public function campusInsight()
  {
    $user = auth()->guard('landlord')->user();
    $id = $user['id'];
    $user = User::getUserDetail($id);
    $campus = CampusInsight::where('campus_id', '=', $user['campus_id'])->paginate(10);
    return view('landlord.campus_insight', compact('campus'));
  }
}