<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;
use App\Models\Option;

class OptionRequest extends Request
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

    public function rules()
    {
        return [
            'name'        =>  'bail|required|string|max:100',
            'title'       =>  'bail|required|string|max:100|regex:/^[\da-z\_]+$/i',
            'form_type'   =>  'bail|required|integer|in:'.implode(',', array_keys(Option::FORM_TYPE_LIST)),
            'form_option' =>  'bail|nullable|string|json|required_if:form_type,'.implode(',', Option::MUST_FORM_OPTION_FORM_OPTION),
            'order'       =>  'required|integer|between:0,255',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => trans('error.option_name_required'),
            'name.max' => trans('error.option_name_too_long'),
            'title.required' => trans('error.option_title_required'),
            'title.regex' => trans('error.option_title_regex'),
            'title.max' => trans('error.option_title_too_long'),
            'form_type.in' => trans('error.option_form_type_invalid'),
            'form_option.json' => trans('error.option_form_option_invalid'),
            'form_option.required_if' => trans('error.option_form_option_required'),
            'order.between' => trans('error.between'),
        ];
    }

    /**
     * @return array
     */
    public function attributes()
    {
        return [
            'form_type' => '表单类型',
            'name' => '显示名称',
            'title' => '配置字段',
            'placeholder' => 'placeholder',
            'form_class' => 'form class',
            'form_option' => '配置项',
            'order' => '排序值',
        ];
    }
}
