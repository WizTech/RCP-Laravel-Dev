<?php

namespace App\Http\Controllers\rcpadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\rcpadmin\ListContactForm;


class ListContactFormController extends Controller
{
  public function index()
  {
    $data = ListContactForm::all();
    return view('rcpadmin.list-contact-form', compact('data'));
  }
}
