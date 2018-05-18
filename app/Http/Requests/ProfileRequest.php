<?php

namespace SenseBook\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'full_name' => 'required',
            'phone' => 'required',
            'new_password' => 'nullable|confirmed',
            'old_password' => 'nullable',
            'billing_address_id' => 'required',
            'shipping_address_id' => 'required',
            'profile_image' => 'nullable',
            'email' => 'nullable|email|unique:dim_users',
            'dob' => 'nullable|date|before:today'
        ];
    }
}
