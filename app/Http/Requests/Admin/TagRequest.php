<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;

class TagRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id'    =>  'required',
            'name'  =>  'required',
        ];
    }

    public function messages()
    {
        return [
            'id.required' => trans('error.system_error'),
            'name.required' => trans('error.tag_not_empty'),
        ];
    }
}
