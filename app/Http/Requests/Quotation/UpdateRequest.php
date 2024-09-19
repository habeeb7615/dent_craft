<?php

namespace App\Http\Requests\Quotation;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'cust_name' => 'required',
            'contact_br' => 'required',
            'quote_tech' => 'required',
            'maker' => 'required',
            'car_id' => 'required',
            'insurance' => 'required',
            'modal' => 'required',
            'vin' => 'required',
            'reg_no' => 'required',
            'claim' => 'required',
            'color' => 'required',
            'sunroof' => 'required',
            'discount' => 'required',
            'note' => 'required',
        ];
    }
}
