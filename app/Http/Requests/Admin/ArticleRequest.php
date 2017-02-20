<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;

class ArticleRequest extends Request
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
            'category_id'    =>  'required',
            'content' =>  'required',
            'tag'     =>  'required',
            'type'    =>  'required',
        ];
    }

    public function messages()
    {
        return [
            'id.required' => trans('error.system_error'),
            'name.required' => trans('error.article_name_not_empty'),
            'category_id.required' => trans('error.article_category_not_empty'),
            'content.required' => trans('error.article_content_not_empty'),
            'tag.required' => trans('error.article_tag_not_empty'),
            'save_fail.required' => trans('error.system_error'),
        ];
    }
}
