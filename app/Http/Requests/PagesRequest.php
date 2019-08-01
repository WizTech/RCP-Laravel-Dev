<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\rcpadmin\Pages;

class PagesRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {
    return [
      'content' => 'required',

    ];
  }

  public function saveRequest()
  {


    $page = Pages::create([
      'content' => $this->content

    ]);

    $page->save();
  }

  public function updateRequest($id)
  {


    $page = Pages::find($id);
    $page->content = $_REQUEST['content'];

    $page->save();
  }
}
