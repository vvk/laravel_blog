<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;

class LinkRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id'      =>  'required',
            'name'    =>  'required',
            'url'     =>  'required|url',
            'rank'    =>  'integer|between:0,255',


        ];
    }

    public function messages()
    {
        return [
            'id.required' => trans('error.system_error'),
            'name.required' => trans('error.link_name_not_empty'),
            'url.required' => trans('error.link_url_not_empty'),
            'url.url' => trans('error.link_url_invalid'),
            'rank.integer' => trans('error.rank_format'),
            'rank.between' => trans('error.rank_between'),


        ];
    }
}
