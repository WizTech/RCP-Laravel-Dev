<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\rcpadmin\CampusInsight;
use App\CampusModel;

class CampusInsightRequest extends FormRequest
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
            'campus_id'=>'required',
            'pdf_file'=>'required|mimes:pdf|max:10000'
        ];
    }

    public function saveRequest(){

        $pdf_file = $this->file('pdf_file');

        if (isset($pdf_file)) {
            $filePath = storage_path('uploads/campusinsight/');
            $pdf_file->move($filePath, $pdf_file->getClientOriginalName());
            $fileName= $pdf_file->getClientOriginalName();
        }


        $news = CampusInsight::create([
            'title' => $this->title,
            'campus_id' => $this->campus_id,
            'pdf_file' => $fileName,
            'link' => $this->link,
            'status' => $this->status,
        ]);

        $news->save();
    }

    public function updateRequest($id){
        $fileName = "";
        if (!empty($this->file())){
            $pdf_file = $this->file('pdf_file');
            if (isset($pdf_file)) {
                $filePath = storage_path('uploads/campusinsight/');
                $pdf_file->move($filePath, $pdf_file->getClientOriginalName());
                $fileName = $pdf_file->getClientOriginalName();
            }
        }

        $campus = CampusInsight::find($id);
        $campus->title = $this->title;
        $campus->campus_id = $this->campus_id;
        $campus->pdf_file = $fileName;
        $campus->link = $this->link;
        $campus->status = $this->status;
        $campus->save();
    }
}
