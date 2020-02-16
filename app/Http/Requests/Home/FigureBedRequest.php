<?php

namespace App\Http\Requests\Home;

use App\Http\Requests\Request;

class FigureBedRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'file'      =>  'required|image',
        ];
    }

    public function messages()
    {
        return [
            'file.required' => trans('error.figure_bed_valid'),
            'file.image' => trans('error.upload_file_not_image'),
        ];
    }
}
