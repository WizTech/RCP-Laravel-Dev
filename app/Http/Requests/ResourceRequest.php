<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResourceRequest extends FormRequest
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
            'campus_id'=>'required',
            'title'=>'required',
            'link'=>'required',
            'image'=>'required',
            'description'=>'required'
        ];
    }

    public function saveRequest(){

    }

    public function updateRequest(){

    }
}
