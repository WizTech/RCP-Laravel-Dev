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
    $emails = BlockEmailModel::paginate(10);
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

  public function destroy($id)
  {

    $email = BlockEmailModel::find($id);

    if ($email) {
      BlockEmailModel::destroy($id);
    }
    return redirect('rcpadmin/block_email');
  }
}
