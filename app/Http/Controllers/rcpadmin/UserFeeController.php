<?php

namespace App\Http\Controllers\rcpadmin;

use App\UserFee;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Request;

class UserFeeController extends Controller
{
  public function index()
  {
    $fees = UserFee::paginate(10);
    return view('rcpadmin.fee', compact('fees'));
  }

  public function create()
  {
    return view('rcpadmin.fee.add');
  }

  public function store(Requests\UserFeeRequest $request)
  {

    $input = Request::all();


    UserFee::create($input);

    return redirect('rcpadmin/user-fee');

  }

  public function show($id)
  {
    $fee = UserFee::find($id);

    return view('rcpadmin.fee.edit', compact('fee'));
  }

  public function update($id, Requests\UserFeeRequest $request)
  {
    $input = Request::all();
    $category = UserFee::find($id);

    $category->update($input);
    return redirect('rcpadmin/user-fee');
  }

  public function destroy($id)
    {
      $category = UserFee::find($id);
      $category->delete();
      return redirect('rcpadmin/user-fee');
    }
}
