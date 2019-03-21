<?php

namespace App\Http\Controllers\rcpadmin;

/*use Illuminate\Http\Request;*/
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\UserCampuses;
use App\CampusModel;
use App\LandlordDetails;
use App\UserDetails;
use Request;


class UsersController extends Controller
{
  public function index()
  {
    $webUsers = User::with('role')->get()->toArray();


    return view('rcpadmin.users', compact('webUsers'));
  }

  public function create()
  {
    $campuses = CampusModel::all('id', 'title')->toArray();

    $campusSelect = [];

    $campusSelect[''] = 'Campus (es)';
    foreach ($campuses as $campus) {
      $campusSelect[$campus['id']] = $campus['title'];
    }
    return view('rcpadmin.users.add', compact('campusSelect'));
  }

  public function show($id)
  {
    $user = User::getUserDetail($id);
    $user_campuses = UserCampuses::where('user_id', '=', $id)->get()->pluck('campus_id')->toArray();

    $campuses = CampusModel::all('id', 'title')->toArray();



    $campusSelect = [];

    //$campusSelect[''] = 'Campus (es)';
    foreach ($campuses as $campus) {
      $campusSelect[$campus['id']] = $campus['title'];
    }
   // echo '<pre>';print_r($user_campuses );echo '</pre>';
    //echo '<pre>';print_r($campusSelect );echo '</pre>';die('Call');
    return view('rcpadmin.users.edit', compact('user', 'campusSelect', 'user_campuses'));

  }

  public function store(Requests\UserRequest $request)
  {
    $input = Request::all();
    $user = User::create($input);

    if ($user && !empty($input['first_name'])) {
      
      UserDetails::create(['user_id' => $user->id, 'first_name' => $input['first_name'], 'last_name' => $input['last_name'], 'address' => $input['address'], 'phone_no' => $input['phone_no']]);
    }

    if ($user && !empty($input['role_id'] == 3)) {
      LandlordDetails::create(['user_id' => $user->id, 'company' => $input['company'], 'fax' => $input['fax'], 'h1' => $input['h1'], 'h2' => $input['h2'], 'meta_title' => $input['meta_title'], 'about_details' => $input['about_details'], 'meta_description' => $input['meta_description'], 'activate_twilio' => $input['activate_twilio'], 'seo_block' => $input['seo_block'], 'twilio_number' => $input['twilio_number'], 'email_leads' => $input['email_leads'], 'landlord_dashboard_status' => $input['landlord_dashboard_status'], 'website' => $input['website'], 'free_trial' => $input['free_trial'], 'type' => $input['type'], 'activate_twilio' => $input['activate_twilio'], 'activate_twilio' => $input['activate_twilio'], 'is_entrata' => $input['is_entrata'], 'is_yardi' => $input['is_yardi']]);
    }


    if ($user && !empty($input['campus_id'])) {

      $campusIds = $input['campus_id'];
      foreach ($campusIds as $campId) {
        if ($campId):
          UserCampuses::create(['user_id' => $user->id, 'campus_id' => $campId]);
        endif;
      }


    }
    return redirect('rcpadmin/users');

  }

  public function update($id, Requests\UserRequest $request)
  {



    $user = User::find($id);


    $user_details = UserDetails::where('user_id', '=', $id);

    $landlord_details = LandlordDetails::where('user_id', '=', $id);


    $input = Request::all();
//    echo '<pre>';print_r($input );echo '</pre>';die('Call');
    $input['password'] = bcrypt($input['password']);

    $user->update($input);

    if ($user_details && !empty($input['first_name'])) {
      $user_details->update(['first_name' => $input['first_name'], 'last_name' => $input['last_name'], 'address' => $input['address'], 'phone_no' => $input['phone_no']]);
    }
    if ($landlord_details && $input['role_id'] == 3) {
      $landlord_details->update(['h1' => $input['h1'], 'h2' => $input['h2'], 'meta_title' => $input['meta_title'], 'about_details' => $input['about_details'], 'meta_description' => $input['meta_description'], 'activate_twilio' => $input['activate_twilio'], 'seo_block' => $input['seo_block'], 'twilio_number' => $input['twilio_number'], 'email_leads' => $input['email_leads'], 'landlord_dashboard_status' => $input['landlord_dashboard_status']]);
    }


    if (!empty($input['campus_id'])) {

      $user_campuses = UserCampuses::where('user_id', '=', $id)->first();

      if (!empty($user_campuses)) {
        $user->campuses()->detach();
      }

      $campusIds = $input['campus_id'];
      foreach ($campusIds as $campId) {
        UserCampuses::create(['user_id' => $user->id, 'campus_id' => $campId]);
      }
    }

    return redirect('rcpadmin/users');
  }

  public function destroy()
  {

    $input = Request::all();

    $id = $input['id'];

    $user = User::find($id);

    if ($user) {
      User::destroy($id);
    }
    return 'true';
    // return redirect('rcpadmin/admin_users');
  }
}
