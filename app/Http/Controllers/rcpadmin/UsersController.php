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
    $webUsers = User::where('user_deleted', '=', 0)->with('role')->paginate(10);


    return view('rcpadmin.users', compact('webUsers'));
  }

  public function trash()
  {
    $webUsers = User::where('user_deleted', '=', 1)->with('role')->paginate(10);


    return view('rcpadmin.trash-users', compact('webUsers'));
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

    if ($user && !empty($input['role'] == 3)) {
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

    $input['password'] = bcrypt($input['password']);

    $user->update($input);

    if ($user_details && !empty($input['first_name'])) {
      $user_details->update(['first_name' => $input['first_name'], 'last_name' => $input['last_name'], 'address' => $input['address'], 'phone_no' => $input['phone_no']]);
    }
    if ($landlord_details && $input['role'] == 3) {
      $landlordData = array('h1' => $input['h1'], 'h2' => $input['h2'], 'meta_title' => $input['meta_title'],
        'about_details' => $input['about_details'], 'meta_description' => $input['meta_description'],
        'activate_twilio' => $input['activate_twilio'], 'seo_block' => $input['seo_block'], 'domain_name' => $input['domain_name'],
        'twilio_number' => $input['twilio_number'], 'activate_twilio' => $input['activate_twilio'], 'is_yardi' => $input['is_yardi'], 'is_entrata' => $input['is_entrata'],
        'email_leads' => $input['email_leads'], 'landlord_dashboard_status' => $input['landlord_dashboard_status']);


      $landlord_details->update($landlordData);
    }


    /*if (!empty($input['campus_id'])) {

      $user_campuses = UserCampuses::where('user_id', '=', $id)->first();

      if (!empty($user_campuses)) {
        $user->campuses()->detach();
      }

      $campusIds = $input['campus_id'];
      foreach ($campusIds as $campId) {
        UserCampuses::create(['user_id' => $user->id, 'campus_id' => $campId]);
      }
    }*/

    return redirect('rcpadmin/users');
  }

  public function search()
  {
//    echo '<pre>';print_r($_REQUEST );echo '</pre>';
    $q = $_REQUEST['q'];
    if ($q != "") {

      $webUsers = User::where('name', 'LIKE', '%' . $q . '%')->orWhere('email', 'LIKE', '%' . $q . '%')->with('role')->paginate(10)->setPath('');
      //echo '<pre>';print_r($webUsers );echo '</pre>';die('Call');
      $pagination = $webUsers->appends(array(
        'q' => $q
      ));


      if (count($webUsers) > 0) {

        return view('rcpadmin.users', compact('webUsers'))->withQuery($q);
      }
      //return view('rcpadmin.users', compact('webUsers'));
    }
  }

  public function search_ajax()
  {
    $q = $_REQUEST['q'];


    if ($q != "") {
      if (isset($_REQUEST['page']) && $_REQUEST['page'] == 'trash') {
        //$webUsers = User::where('user_deleted', 1)->where('name', 'LIKE', '%' . $q . '%')->orWhere('email', 'LIKE', '%' . $q . '%')->with('role')->paginate(20)->setPath('');
        $webUsers = User::where('user_deleted', 1)->where(function ($sql) use ($q) {
          $sql->where('name', 'LIKE', '%' . $q . '%')
            ->orWhere('email', 'LIKE', '%' . $q . '%')
            ->orWhere('email', 'LIKE', '%' . $q . '%');
                             })->with('role')->paginate(20)->setPath('');
      } else {
        $webUsers = User::where('user_deleted', 0)->where('name', 'LIKE', '%' . $q . '%')->orWhere('email', 'LIKE', '%' . $q . '%')->with('role')->paginate(20)->setPath('');
      }

      $pagination = $webUsers->appends(array(
        'q' => $q
      ));

      if (count($webUsers) > 0):
        foreach ($webUsers as $user): ?>
          <tr>
            <td> <?php echo $user['id'] ?></td>
            <td> <?php echo $user['role'] == '3' ? 'Landlord' : 'Student' ?> </td>
            <td> <?php echo $user['name'] ?> </td>
            <td> <?php echo $user['email'] ?> </td>
            <td> <?php echo $user['status'] ?> </td>
            <td>
              <ul class="d-flex justify-content-center">
                <li class="mr-3"><a target="_blank" href="<?php echo url('rcpadmin/users/' . $user['id']) ?>"
                                    class="text-secondary"><i
                      class="fa fa-edit"></i></a></li>
                <li>
                  <form method="POST" action="users/<?php echo $user['id'] ?>">
                    <?php echo csrf_field() ?>
                    <?php echo method_field('DELETE') ?>
                    <div class="form-group">
                      <input type="submit" class="btn btn-danger btn-xs delete"
                             value="Delete">
                    </div>
                  </form>
                  </a>
                </li>
              </ul>
            </td>
          </tr>
        <?php endforeach;
      endif ?>
      <?php
    }
  }


  public function delete($id)
  {
    $user = User::find($id);
    $user->update(['user_deleted' => 1]);
    return redirect('rcpadmin/users');
  }

  public function destroy($id)
  {
    $admin_users = User::find($id);
    $admin_users->delete();
    return redirect('rcpadmin/users');
  }

  public function restoreUser($id)
  {
//    echo '<pre>';print_r($_REQUEST );echo '</pre>';
    $user = User::find($id);
    $user->update(['user_deleted' => '0']);

    return redirect('rcpadmin/users');
  }
}
