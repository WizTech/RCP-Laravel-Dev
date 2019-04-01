<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\rcpadmin\Resource;

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
            'campus_id' => 'required',
            'title' => 'required',
            'link' => 'required',
            'image' => 'required',
            'description' => 'required'
        ];
    }

    public function saveRequest()
    {
        $image = $this->file('image');
        if (isset($image)) {
            $imagePath = storage_path('uploads/resources/');
            $image->move($imagePath, $image->getClientOriginalName());
            $imageName = $image->getClientOriginalName();
            $input['image'] = $imageName;
        }

        $news = Resource::create([
            'campus_id' => $this->campus_id,
            'title' => $this->title,
            'link' => $this->link,
            'image' => $input['image'],
            'description' => $this->description
        ]);

        $news->save();
    }

    public function updateRequest($id)
    {
        $imageName = "";
        if (!empty($this->file())) {
            $image = $this->file('image');
            if (isset($image)) {
                $image = $this->file('image');
                $imagePath = storage_path('uploads/resources/');
                $image->move($imagePath, $image->getClientOriginalName());
                $imageName = $image->getClientOriginalName();
            }
        }

        $news = Resource::find($id);
        $news->title = $this->title;
        $news->link = $this->link;
        $news->image = $imageName;
        $news->description = $this->description;
        $news->save();
    }
}
