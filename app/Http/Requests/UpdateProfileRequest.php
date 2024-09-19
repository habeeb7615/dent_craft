<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.auth()->user()->id,
            'img' => 'image|max:2048'
        ];
    }

    public function messages()
    {
        return [
            'img.image' => 'Uploaded file must be of type image.',
            'img.max' => 'Uploaded file should be below 2 mb.'
        ];
    }
}
