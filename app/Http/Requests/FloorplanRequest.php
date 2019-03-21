<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FloorplanRequest extends FormRequest
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
            'title' => 'required',
            'bed' => 'required',
            'bath' => 'required',
            'price' => 'required',
            'sq_footage' => 'required',
            'available_date' => 'required'
        ];
    }
}
