<?php

namespace SenseBook\Http\Requests\BackOffice;

use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
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
            'address_line_1' => 'required',
            'address_line_2' => 'nullable',
            'sub_district_id' => 'required',
            'district_id' => 'required',
            'province_id' => 'required',
            'postal_code_id' => 'required',
        ];
    }
}