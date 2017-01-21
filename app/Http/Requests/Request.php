<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class Request extends FormRequest
{

    protected function formatErrors(Validator $validator)
    {

        return array('status'=>422, 'msg'=>implode(',', $validator->errors()->all()));
//        return $validator->errors()->all();
    }

}
