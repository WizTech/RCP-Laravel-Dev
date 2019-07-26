<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\rcpadmin\News;

class NewsRequest extends FormRequest
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
            'heading'=>'required',
            'link'=>'required',
            /*'image'=>'required|mimes:jpeg,jpg,png,gif|max:10000',*/
            'description'=>'required'
        ];
    }
    
    public function saveRequest(){
        $image = $this->file('image');
        if (isset($image)) {
            $imagePath = storage_path('uploads/news/');
            $image->move($imagePath, $image->getClientOriginalName());
            $imageName = $image->getClientOriginalName();
            $input['image'] = $imageName;
        }

        $news = news::create([
            'heading' => $this->heading,
            'link' => $this->link,
            'image' => isset($input['image']) ? $input['image'] : '',
            'description' => strip_tags($this->description)
        ]);
        $news->save();
        $insertId = $news->id;
        return $insertId;
    }

    public function updateRequest($id){
        $imageName = "";
        if (!empty($this->file())){
            $image = $this->file('image');
            if (isset($image)) {
                $image = $this->file('image');
                $imagePath = storage_path('uploads/news/');
                $image->move($imagePath, $image->getClientOriginalName());
                $imageName = $image->getClientOriginalName();
            }
        }

        $news = News::find($id);
        $news->heading = $this->heading;
        $news->link = $this->link;
        $news->image = isset($imageName) ? $imageName : '';
        $news->description = strip_tags($this->description);
        $news =  $news->save();
        return $news;
    }
}
