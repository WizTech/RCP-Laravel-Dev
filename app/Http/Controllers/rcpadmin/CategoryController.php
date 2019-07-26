<?php

namespace App\Http\Controllers\rcpadmin;

use App\CategoryModel;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Helpers\GeneralHelper;
use Request;

class CategoryController extends Controller
{

    protected $module;
    public function __construct()
    {
        $this->module = GeneralHelper::module_data('CategoryController');
    }

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
        $insert = CategoryModel::create($input);
        /* Activity Log Begin */
        $module = $this->module;
        $insertedData = CategoryModel::find($insert->id);
        $logs = "New Category '". $insertedData->name . "' Created in ".$module->title;
        GeneralHelper::EditLogFile($module->id, $logs);
        /* Activity Log End */

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

        /* Activity Log Begin */
        $module = $this->module;
        $updated_columns = $category->getChanges();
        $afterUpdate = json_encode($updated_columns);
        $newCategoryName = GeneralHelper::getNameById('category', 'name', $id);
        $logs = $newCategoryName . ' Updated in '.$module->title;
        GeneralHelper::EditLogFile($module->id, $logs, '', $afterUpdate);
        /* Activity Log Begin */

        return redirect('rcpadmin/category');
    }

    public function destroy($id)
    {
        $category = CategoryModel::find($id);

        $module = $this->module;
        $category_name = GeneralHelper::getNameById('category', 'name', $id);
        $logs = $category_name . ' Deleted in '.$module->title;
        $category->delete();
        GeneralHelper::EditLogFile($module->id, $logs);

        return redirect('rcpadmin/category');
    }

}
