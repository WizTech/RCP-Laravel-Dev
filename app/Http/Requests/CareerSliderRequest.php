<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\rcpadmin\CareerSlider;

class CareerSliderRequest extends FormRequest
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
            'slider_image'=>'required|mimes:jpeg,jpg,png,gif|max:100000',
            'slider_type'=>'required',
            'slider_heading_one'=>'required',
            'slider_heading_two'=>'required',
            'slider_minute'=>'required',
            'status'=>'required'
        ];
    }

    public function saveRequest(){
        $image = $this->file('slider_image');
        if (isset($image)) {
            $imagePath = storage_path('uploads/careerSlider/');
            $image->move($imagePath, $image->getClientOriginalName());
            $imageName = $image->getClientOriginalName();
        }

        $career_slider = CareerSlider::create([
            'slider_image' => $imageName,
            'slider_type' => $this->slider_type,
            'slider_heading_one' => $this->slider_heading_one,
            'slider_heading_two' => $this->slider_heading_two,
            'slider_minute' => $this->slider_minute,
            'status' => $this->status
        ]);

        $career_slider->save();
    }

    public function updateRequest($id){
        $imageName = "";
        if (!empty($this->file())){
            $image = $this->file('slider_image');
            if (isset($image)) {
                $image = $this->file('slider_image');
                $imagePath = storage_path('uploads/careerSlider/');
                $image->move($imagePath, $image->getClientOriginalName());
                $imageName = $image->getClientOriginalName();
            }
        }

        $careerSlider = CareerSlider::find($id);
        $careerSlider->slider_image = $imageName;
        $careerSlider->slider_type = $this->slider_type;
        $careerSlider->slider_heading_one = $this->slider_heading_one;
        $careerSlider->slider_heading_two = $this->slider_heading_two;
        $careerSlider->slider_minute = $this->slider_minute;
        $careerSlider->status = $this->status;

        $careerSlider->save();
    }

}
