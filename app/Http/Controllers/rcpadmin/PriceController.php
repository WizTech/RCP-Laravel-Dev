<?php

namespace App\Http\Controllers\rcpadmin;

/*use Illuminate\Http\Request;*/
use App\PriceModel;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Request;
use Validator;

class PriceController extends Controller
{
  public function index()
  {
    $price = PriceModel::paginate(10);
    return view('rcpadmin.price', compact('price'));
  }

  public function create()
  {
    return view('rcpadmin.price.add');
  }

  public function store(Requests\PriceRequest $request)
  {

    $input = Request::all();


    PriceModel::create($input);

    return redirect('rcpadmin/price');

  }

  public function show($id)
  {
    $price = PriceModel::find($id);

    return view('rcpadmin.price.edit', compact('price'));
  }

  public function update($id, Requests\PriceRequest $request)
  {
    $input = Request::all();
    $price = PriceModel::find($id);

    $price->update($input);
    return redirect('rcpadmin/price');
  }

  public function destroy($id)
  {
    $price = PriceModel::find($id);
    $price->delete();
    return redirect('rcpadmin/price');
  }
}
