<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmpRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'employer' => 'required',
            'position' => 'required',
            'employer_addrs' => 'required',
            'employer_email' => 'nullable|email',
        ];
    }

    public function messages()
    {
        return [
            'employer.required' => 'Please Enter Company name',
        ];
    }
}
