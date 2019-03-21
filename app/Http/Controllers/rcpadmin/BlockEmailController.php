<?php

namespace App\Http\Controllers\rcpadmin;

use App\BlockEmailModel;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Request;

class BlockEmailController extends Controller
{
  public function index()
  {
    $emails = BlockEmailModel::all()->toArray();
    return view('rcpadmin.block-email', compact('emails'));
  }

  public function create()
  {
    return view('rcpadmin.block-email.add');
  }

  public function store(Requests\BlockEmailRequest $request)
  {

    $input = Request::all();


    BlockEmailModel::create($input);

    return redirect('rcpadmin/block_email');

  }

  public function show($id)
  {
    $email = BlockEmailModel::find($id);

    return view('rcpadmin.block-email.edit', compact('email'));
  }

  public function update($id, Requests\BlockEmailRequest $request)
  {
    $input = Request::all();
    $email = BlockEmailModel::find($id);

    $email->update($input);
    return redirect('rcpadmin/block_email');
  }

  public function destroy()
  {
    $input = Request::all();

    $id = $input['id'];

    $email = BlockEmailModel::find($id);

    if ($email) {
      BlockEmailModel::destroy($id);
    }
    return 'true';
    // return redirect('rcpadmin/admin_users');
  }
}
