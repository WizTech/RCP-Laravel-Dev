<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\rcpadmin\Career;

class CareerRequest extends FormRequest
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
            'title'=>'required',
            'career_type'=>'required',
            'location'=>'required',
            'hours'=>'required',
            'status'=>'required',
            'description'=>'required'
        ];
    }

    public function saveRequest(){
        $input = $this->all();
        Career::create($input);
    }

    public function updateRequest($id){
        $input = $this->all();
        $career = Career::find($id);
        $career->update($input);
    }
}
