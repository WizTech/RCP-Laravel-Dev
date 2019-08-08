<?php

namespace App\Http\Controllers\rcpadmin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\CampusModel;

use Illuminate\Support\Facades\Response;
use Intervention\Image\Facades\Image;

use Request;

class LandingPageController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */


  public function index()
  {
    $campuses = CampusModel::paginate(10);

    return view('rcpadmin.landing-page-campus-list', compact('campuses'));
  }

  public function edit($id)
  {
    $campus = CampusModel::find($id);
    $landing_content = json_decode($campus->landing_content);
    return view('rcpadmin.landing-page.edit', compact('campus','landing_content'));
  }

  public function update($id, Requests\LandingPageRequest $request)
  {
    $input = Request::all();


    $title_tag = $_POST['landing_title'];
    $meta_description = $_POST['landing_meta_description'];
    $landing_content = array(
      'student_title' => $_POST['student_title'],
      'student_description' => htmlspecialchars($_POST['student_description']),
      'international_title' => $_POST['international_title'],
      'international_description' => htmlspecialchars($_POST['international_description']),
      'resouces_title' => $_POST['resouces_title'],
      'resouces_description' => htmlspecialchars($_POST['resouces_description']),
      'landord_title' => $_POST['landord_title'],
      'landord_description' => htmlspecialchars($_POST['landord_description']),
      'contact_title' => $_POST['contact_title'],
      'contact_description' => htmlentities($_POST['contact_description'])
    );
    $landing_page = CampusModel::where('id', '=', $id)->first();
    if (empty($title_tag) === false) {
      $data_array = array(
        'landing_title' => $title_tag,
        'landing_meta_description' => addslashes($meta_description),
        'landing_content' => json_encode($landing_content)
      );
      if ($landing_page) {
        $landing_page->update($data_array);
      }
    }


    return redirect('rcpadmin/landing-page');
  }

}
