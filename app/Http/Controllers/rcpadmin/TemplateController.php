<?php

namespace App\Http\Controllers\rcpadmin;

/*use Illuminate\Http\Request;*/

use App\TemplateModel;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Request;
use Validator;


class TemplateController extends Controller
{
<<<<<<< HEAD
    public function index()
    {
        $templates = TemplateModel::paginate(10);
        return view('rcpadmin.template', compact('templates'));
    }
=======
  public function index()
  {
    $templates = TemplateModel::paginate(10);
    return view('rcpadmin.template', compact('templates'));
  }
>>>>>>> master

    public function create()
    {
        return view('rcpadmin.template.add');
    }

    public function store(Requests\TemplateRequest $request)
    {

        $input = Request::all();


        TemplateModel::create($input);

        return redirect('rcpadmin/template');

    }

    public function show($id)
    {
        $template = TemplateModel::find($id);

        return view('rcpadmin.template.edit', compact('template'));
    }

    public function update($id, Requests\TemplateRequest $request)
    {
        $input = Request::all();
        $price = TemplateModel::find($id);

        $price->update($input);
        return redirect('rcpadmin/template');
    }

<<<<<<< HEAD
    public function destroy()
    {
        $input = Request::all();

        $id = $input['id'];
=======
  public function destroy($id)
  {
>>>>>>> master

        $price = TemplateModel::find($id);

        if ($price) {
            TemplateModel::destroy($id);
        }
        return 'true';
        // return redirect('rcpadmin/admin_users');
    }
<<<<<<< HEAD
=======
    return redirect('rcpadmin/template');
  }
>>>>>>> master
}
