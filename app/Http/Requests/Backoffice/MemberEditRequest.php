<?php

namespace SenseBook\Http\Requests\BackOffice;

use Illuminate\Foundation\Http\FormRequest;

class MemberEditRequest extends FormRequest
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
            'phone' => 'required|numeric',
            'type' => 'required',
            'dob' => 'required|date',
        ];
    }
}
