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
use App\User;
use App\UserDetails;
use App\student\Sublease;
use App\student\Application;
use Request;

class StudentController extends BaseController
{
  public function __construct()
  {
    $this->middleware('auth:student')->except('logout');
  }


  public function index()
  {
    $user = auth()->guard('student')->user();
    $id = $user['id'];
    $user = User::getUserDetail($id);


    return view('student.profile', compact('user'));
  }

  public function show($id)
  {

    $sublease = Sublease::where('id', '=', $id)->first();
    $campuses = CampusModel::all('id', 'title')->toArray();

    $campusSelect = [];

    $campusSelect[''] = 'Campus (es)';
    foreach ($campuses as $campus) {
      $campusSelect[$campus['id']] = $campus['title'];
    }
    return view('student.sublease-edit', compact('sublease', 'id', 'campusSelect'));

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

    return redirect('student');
  }

  public function addSublease()
  {
    $campuses = CampusModel::all('id', 'title')->toArray();

    $campusSelect = [];

    $campusSelect[''] = 'Campus (es)';
    foreach ($campuses as $campus) {
      $campusSelect[$campus['id']] = $campus['title'];
    }
    $user = auth()->guard('student')->user();
    $id = $user['id'];
    return view('student.add-sublease', compact('id', 'user', 'campusSelect'));
  }

  public function editSublease()
  {
    $user = auth()->guard('student')->user();
    $id = $user['id'];
    $subleases = Sublease::where('student_id', '=', $id)->paginate(10);
    return view('student.edit-sublease', compact('subleases'));
  }

  public function saveSublease()
  {
    $input = Request::all();
    $input['added_on'] = NOW();
    $input['updated_on'] = NOW();
    $student_id = $input['student_id'];

    Sublease::create($input);
    return redirect('student/edit-sublease');
  }

  public function updateSublease()
  {
    $input = Request::all();
    $input['updated_on'] = NOW();
    $id = $input['id'];
    $student_id = $input['student_id'];
    $sublease = Sublease::find($id);
    $sublease->update($input);
    return redirect('student/edit-sublease');
  }

  public function changePassword()
  {
    $user = auth()->guard('student')->user();
    $id = $user['id'];
    $user = User::getUserDetail($id);


    return view('student.change-password', compact('user'));
  }

  public function application()
  {
    $user = auth()->guard('student')->user();
    $id = $user['id'];
    $applications = Application::where('user_id', '=', $id)->paginate(10);
    return view('student.application', compact('applications'));
  }

  public function updatePassword(Requests\PasswordRequest $request)
  {

    $input = Request::all();

    $input['password'] = md5($input['password']);

    $id = $input['id'];


    $user = User::find($id);
    $user->update($input);
    return redirect('student');
  }

}