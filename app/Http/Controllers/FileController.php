<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use Session;

class FileController extends Controller
{
  public function multifileupload()
  {
    return view('dropzoneJs');
  }

  public function store(Request $request)
  {

    $image = $request->file('file');
    $imageName = time() . $image->getClientOriginalName();
    $upload_success = $image->move(public_path('images'), $imageName);

    if ($upload_success) {
      return response()->json($upload_success, 200);
    } // Else, return error 400
    else {
      return response()->json('error', 400);
    }
  }
}
