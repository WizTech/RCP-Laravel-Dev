<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Property extends FormRequest
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
          'title' => 'required|unique:property|min:3',///**/
          'address' => 'required|unique:property',
          'category_id' => 'required',
          'campus_id' => 'required',
          'landlord_id' => 'required',
          'category_id' => 'required',
          'description' => 'required',
          'property_expiry_date' => 'required'

        ];
      }
      case 'PUT':
      case 'PATCH': {
        return [
          'status' => 'required',
         /* 'title' => 'min:3|unique:property,name,' . $this->id,*/
          'address' => 'required|unique:property,address,' . $this->id,
          'campus_id' => 'required',
          'category_id' => 'required',
          'landlord_id' => 'required',
          'category_id' => 'required',
          'description' => 'required',
          'property_expiry_date' => 'required'
        ];
      }
      default:
        break;
    }
  }
}
