<?php

namespace App\Http\Controllers\rcpadmin;

use App\Http\Requests;

use App\Http\Controllers\Controller;
use App\rcpadmin\Team;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Input;
use Request;


class TeamController extends Controller
{
  public function index()
  {
    $users = Team::all()->toArray();


    return view('rcpadmin.team', compact('users'));
  }

  public function create()
  {
    return view('rcpadmin.team.add');
  }

  public function store(Requests\TeamMember $request)
  {
    $input = Request::all();
    $image = $request->file('photo');
    if (isset($image)) {
      $companyPath = storage_path('app/public/team/');
      $image->move($companyPath, $image->getClientOriginalName());


      $imageName = $image->getClientOriginalName();
      $input['photo'] = $imageName;
    }


    Team::create($input);


    return redirect('rcpadmin/team-member');
  }

  public function show($id)
  {
    $user = Team::find($id);

    return view('rcpadmin.team.edit', compact('user'));

  }

  public function update($id, Requests\TeamMember $request)
  {
    $input = Request::all();
    $image = $request->file('photo');
    if (isset($image)) {
      $companyPath = storage_path('app/public/team/');
      $image->move($companyPath, $image->getClientOriginalName());


      $imageName = $image->getClientOriginalName();
      $input['photo'] = $imageName;
    }

    $team = Team::where('id', '=', $id)->first();

    if ($team) {
      $team->update($input);
    }

    return redirect('rcpadmin/team-member');
  }
}
