<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CampusRequest extends FormRequest
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
    switch ($this->method()) {
      case 'POST': {
        return [

          'status' => 'required',
          'name' => 'required|unique:campus|min:3',
          'address' => 'required|unique:campus',
          'title' => 'required',
          'h1' => 'required',
          'h2' => 'required',
          'meta_title' => 'required',
          'meta_description' => 'required',
          'premium_banner' => 'required',
          'live' => 'required',
          'rating' => 'required',
          'seo_block' => 'required'
        ];
      }
      case 'PUT':
      case 'PATCH': {
        return [
          'status' => 'required',
          'name' => 'required|min:3|unique:campus,name,' . $this->id,
          'address' => 'required|unique:campus,address,' . $this->id,
          'title' => 'required',
          'h1' => 'required',
          'h2' => 'required',
          'premium_banner' => 'required',
          'live' => 'required',
          'rating' => 'required',
          'meta_title' => 'required',
          'meta_description' => 'required',
          'seo_block' => 'required'
        ];
      }
      default:
        break;
    }
  }
}
