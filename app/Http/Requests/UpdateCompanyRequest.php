<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCompanyRequest extends FormRequest
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
            'cname' => 'required|max:50',
            'abn' => 'required|digits:11|numeric',
            'phone' => 'required|numeric|min:0',
            'email' => 'required|email|regex:/[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}/i',
            'pobox' => 'required|max:255',
            'gst' => 'required|between:0,100',
            'img2' => 'image|max:2048'
        ];
    }

    public function messages()
    {
        return [
            'cname.required' => 'Company Name field is required.',
            'cname.max' => 'Company Name field must not be greater than 50 characters.',
            'abn.required' => 'ABN field is required.',
            'abn.digits' => 'ABN field must be 11 digits long.',
            'abn.numeric' => 'ABN field must be numeric.',
            'phone.required' => 'Mobile Number field is required.',
            'phone.numeric' => 'Mobile Number field must be numeric.',
            'phone.min' => 'Mobile Number field must be positive.',
            'img2.image' => 'Uploaded file must be of type image.',
            'img2.max' => 'Uploaded file must be below 2 mb.'
        ];
    }
}
