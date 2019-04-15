<?php

namespace App\Http\Controllers\rcpadmin;

use App\BlockIPModel;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Request;


class BlockIPController extends Controller
{
  public function index()
  {
    $ips = BlockIPModel::paginate(10);
    return view('rcpadmin.block-ip', compact('ips'));
  }

  public function create()
  {
    return view('rcpadmin.block-ip.add');
  }

  public function store(Requests\BlockIPRequest $request)
  {

    $input = Request::all();


    BlockIPModel::create($input);

    return redirect('rcpadmin/block_ip');

  }

  public function show($id)
  {
    $ip = BlockIPModel::find($id);

    return view('rcpadmin.block-ip.edit', compact('ip'));
  }

  public function update($id, Requests\BlockIPRequest $request)
  {
    $input = Request::all();
    $ip = BlockIPModel::find($id);

    $ip->update($input);
    return redirect('rcpadmin/block_ip');
  }

  public function destroy()
  {
    $input = Request::all();

    $id = $input['id'];

    $ip = BlockIPModel::find($id);

    if ($ip) {
      BlockIPModel::destroy($id);
    }
    return 'true';
    // return redirect('rcpadmin/admin_users');
  }
}
