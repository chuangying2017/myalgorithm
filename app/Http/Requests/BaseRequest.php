<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class BaseRequest extends FormRequest
{
    public function failedValidation(Validator $validator)
    {
        exit(json_encode([
            'status' => 500,
            'msg'   => implode(',', $validator->errors()->all())
        ]));
    }
}
