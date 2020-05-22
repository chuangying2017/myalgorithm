<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class BaseRequest extends FormRequest
{
    public function failedValidation(Validator $validator)
    {
        header("HTTP/1.0 401 Unauthorized");
        exit(json_encode([
            'msg'   => implode(',', $validator->errors()->all())
        ]));
    }
}
