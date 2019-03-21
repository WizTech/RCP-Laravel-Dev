<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
          'phone_no' => 'required',
          'twilio_number' => (isset($_REQUEST['role_id']) && $_REQUEST['role_id'] == 3)?'required|unique:landlord_details':'',
          'activate_twilio' => (isset($_REQUEST['role_id']) && $_REQUEST['role_id'] == 3)?'required':'',
          'email_leads' => (isset($_REQUEST['role_id']) && $_REQUEST['role_id'] == 3)?'required':'',
          'landlord_dashboard_status' => (isset($_REQUEST['role_id']) && $_REQUEST['role_id'] == 3)?'required':'',
          'free_trial' => (isset($_REQUEST['role_id']) && $_REQUEST['role_id'] == 3)?'required':'',
          'type' => (isset($_REQUEST['role_id']) && $_REQUEST['role_id'] == 3)?'required':'',
          'role_id' => 'required',
          'address' => 'required|unique:user_details|min:3',
          'name' => 'required|unique:users|min:3',
          'last_name' => 'required',
          'first_name' => 'required',
          'is_entrata' => 'required',
          'is_yardi' => 'required',
          'email' => 'required|unique:users',
          'password' => 'required'
        ];
      }
      case 'PUT':
      case 'PATCH': {
        return [
          'role_id' => 'required',
          'twilio_number' => 'required|unique:landlord_details,user_id,' . $this->id,
          'phone_no' => 'required',
          'status' => 'required',
          'last_name' => 'required',
          'first_name' => 'required',
          'is_entrata' => 'required',
                    'is_yardi' => 'required',
          'address' => 'required|unique:user_details,user_id,' . $this->id,
          'name' => 'required|unique:users,name,' . $this->id,
          'email' => 'unique:users,email,' . $this->id
        ];
      }
      default:
        break;
    }
  }
}
