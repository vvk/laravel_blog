<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;

class BannerRequest extends Request
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
            'rank'    =>  'integer|between:0,255',
            'image'   =>  'required',
            'url'     =>  'url',

        ];
    }

    public function messages()
    {
        return [
            'id.required' => trans('error.system_error'),
            'name.required' => trans('error.banner_name_not_empty'),
            'rank.integer' => trans('error.rank_format'),
            'rank.between' => trans('error.rank_between'),
            'image.required' => trans('error.banner_image_not_empty'),
            'url.url' => trans('error.banner_invalid_rul'),

        ];
    }
}
