<?php

namespace App\Http\Requests;

use App\Exceptions\ValidatorErrorException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class BaseRequest extends FormRequest
{
    public function failedValidation(Validator $validator)
    {
        if ($this->ajax() || $this->isJson())
        {
            throw new ValidatorErrorException($validator->errors()->first());
        }

        parent::failedValidation($validator);
    }
}
