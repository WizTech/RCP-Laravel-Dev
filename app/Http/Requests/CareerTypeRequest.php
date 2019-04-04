<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\rcpadmin\CareerType;

class CareerTypeRequest extends FormRequest
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
            'careers_type'=>'required'
        ];
    }

    public function saveRequest(){
        $careertypeAdd = CareerType::create(['careers_type' => $this->careers_type]);
        $careertypeAdd->save();
    }

    public function updateRequest($id){
        $careertype = CareerType::find($id);
        $careertype->careers_type = $this->careers_type;
        $careertype->save();
    }
}
