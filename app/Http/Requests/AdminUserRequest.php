<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminUserRequest extends FormRequest
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
    /*return [
       'username' => 'required|min:3|unique:admin_users',
       'email' => 'required||unique:admin_users',
    ];*/

    switch ($this->method()) {
      case 'POST': {
        return [
          'export_all_leads' => 'required',
          'status' => 'required',
          'role_id' => 'required',
          'name' => 'required',
          'username' => 'required|min:3|unique:admin_users',
          'email' => 'required|unique:admin_users',
          'password' => 'required'
        ];
      }
      case 'PUT':
      case 'PATCH': {
        return [
          'role_id' => 'required',
          'export_all_leads' => 'required',
          'status' => 'required',
          'name' => 'required',
          'username' => 'unique:admin_users,username,'.$this->id,
         // 'email' => 'unique:admin_users,email,'.$this->id
        ];
      }
      default:
        break;
    }
  }
}
