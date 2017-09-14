<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class NewsRequest extends FormRequest
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
            'title' => 'required',
            'slug' => 'required|unique:news',
            'keywords' => 'required',
            'desc' => 'required',
            'contents' => 'required',
            'pubDate' => 'required:date',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Title is Required.',
            'slug.required' => 'Url is Required.',
            'slug.unique' => 'This Url Already Exist, Please edit this Url.',
            'keywords.required' => 'SEO Keywords is Required.',
            'desc.required' => 'SEO Description is Required.',
            'contents.required' => 'Content is Required.',
        ];
    }
}
