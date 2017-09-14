<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class FileRequest extends FormRequest
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
            'file' => 'required|max:5120',
            'title' => 'required',
            'pubDate' => 'required|date',
        ];
    }

    public function messages()
    {
        return [
            'file.max' => 'The file may not be greater than 5MB',
            'file.required' => 'File is Required.',
            'title.required' => 'Title is Required.',
        ];
    }
}
