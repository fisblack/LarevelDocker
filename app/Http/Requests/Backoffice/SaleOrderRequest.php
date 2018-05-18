<?php

namespace SenseBook\Http\Requests\Backoffice;

use Illuminate\Foundation\Http\FormRequest;

class SaleOrderRequest extends FormRequest
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
            'full_name' => 'required|string',
            'billing_address_line_1' => 'required|string',
            'billing_address_line_2' => 'required|string',
            'billing_sub_district_id' => 'required|integer',
            'billing_district_id' => 'required|integer',
            'billing_province_id' => 'required|integer',
            'billing_postcode_id' => 'required|integer',
            'shipping_address_line_1' => 'required',
            'shipping_address_line_2' => 'required',
            'shipping_sub_district_id' => 'required|integer',
            'shipping_district_id' => 'required|integer',
            'shipping_province_id' => 'required|integer',
            'shipping_postcode_id' => 'required|integer',
            'shipping_method_id' => 'required|integer',
            'payment_method' =>'required',
        ];
    }
}
