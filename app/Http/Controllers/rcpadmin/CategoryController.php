<?php

namespace App\Http\Controllers\rcpadmin;

use App\CategoryModel;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Request;

class CategoryController extends Controller
{
  public function index()
  {
    $categories = CategoryModel::paginate(10);
    return view('rcpadmin.category', compact('categories'));
  }

  public function create()
  {
    return view('rcpadmin.category.add');
  }

  public function store(Requests\CategoryRequest $request)
  {

    $input = Request::all();


    CategoryModel::create($input);

    return redirect('rcpadmin/category');

  }

  public function show($id)
  {
    $category = CategoryModel::find($id);

    return view('rcpadmin.category.edit', compact('category'));
  }

  public function update($id, Requests\CategoryRequest $request)
  {
    $input = Request::all();
    $category = CategoryModel::find($id);

    $category->update($input);
    return redirect('rcpadmin/category');
  }

  public function destroy()
  {
    $input = Request::all();

    $id = $input['id'];

    $category = CategoryModel::find($id);

    if ($category) {
      CategoryModel::destroy($id);
    }
    return 'true';
    // return redirect('rcpadmin/admin_users');
  }
}
