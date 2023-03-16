<?php

namespace App\Http\Requests;

use App\Http\Controllers\Api\ResponseController;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;

class StoreUserRequest extends FormRequest
{
    
    public function __construct(){
        $this->response = new ResponseController;
    }

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'orcid' => 'required|unique:users',
            'name' => 'required',
            'lastname' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'orcid.required' => 'The orcid is required.',
            'orcid.unique' => 'The orcid is already registered.',
            'name.required' => 'The name is required.',
            'lastname.required' => 'The lastname is required.',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->response->sendError($validator->errors(), 406));
    }
}
