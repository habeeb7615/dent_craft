<?php

namespace App\Http\Requests\Images;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'page_three_image' => 'image',
        ];
    }

    public function messages()
    {
        return [
            'page_three_image.image' => 'Uploaded file must be an image'
        ];
    }
}
