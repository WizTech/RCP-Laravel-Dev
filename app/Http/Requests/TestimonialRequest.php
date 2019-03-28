<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\rcpadmin\Testimonial;


class TestimonialRequest extends FormRequest
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
            'person_name' => 'required',
            'title' => 'required',
            'company' => 'required',
            'market' => 'required',
            'text' => 'required',
            'photo' => 'required|mimes:jpeg,jpg,png,gif|max:10000'
        ];
    }

    public function saveRequest()
    {

        $imageName = "";
        if (!empty($this->file())) {
            $image = $this->file('photo');
            if (isset($image)) {
                $imagePath = storage_path('uploads/testimonials/');
                $image->move($imagePath, $image->getClientOriginalName());
                $imageName = $image->getClientOriginalName();
            }
        }
        $testimonial = Testimonial::create([
            'person_name' => $this->person_name,
            'title' => $this->title,
            'company' => $this->company,
            'market' => $this->market,
            'text' => $this->text,
            'photo' => $imageName,
        ]);

        $testimonial->save();

    }

    public function updateRequest($id)
    {
        $imageName = "";
        if (!empty($this->file())) {
            $image = $this->file('photo');
            if (isset($image)) {
                $image = $this->file('photo');
                $imagePath = storage_path('uploads/testimonials/');
                $image->move($imagePath, $image->getClientOriginalName());
                $imageName = $image->getClientOriginalName();
            }
        }

        $testimonial = Testimonial::find($id);
        $testimonial->person_name = $this->person_name;
        $testimonial->title = $this->title;
        $testimonial->company = $this->company;
        $testimonial->market = $this->market;
        $testimonial->text = $this->text;
        $testimonial->photo = $imageName;

        $testimonial->save();
    }
}
