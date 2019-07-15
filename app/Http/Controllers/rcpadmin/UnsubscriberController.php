<?php

namespace App\Http\Controllers\rcpadmin;

use App\UnsubscriberModel;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Request;

class UnsubscriberController extends Controller
{
  public function index()
  {
    $emails = UnsubscriberModel::paginate(10);
    return view('rcpadmin.unsubscribers', compact('emails'));
  }

    public function create()
    {
        return view('rcpadmin.unsubcribers.add');
    }

    public function store(Requests\BlockEmailRequest $request)
    {

        $input = Request::all();


        UnsubscriberModel::create($input);

        return redirect('rcpadmin/unsubcribers');

    }

    public function show($id)
    {
        $email = UnsubscriberModel::find($id);

        return view('rcpadmin.unsubcribers.edit', compact('email'));
    }

    public function update($id, Requests\BlockEmailRequest $request)
    {
        $input = Request::all();
        $email = UnsubscriberModel::find($id);

        $email->update($input);
        return redirect('rcpadmin/unsubcribers');
    }


  public function destroy($id)
  {
        $email = UnsubscriberModel::find($id);

        if ($email) {
            UnsubscriberModel::destroy($id);
        }
        return 'true';
         return redirect('rcpadmin/admin_users');
    }

}
