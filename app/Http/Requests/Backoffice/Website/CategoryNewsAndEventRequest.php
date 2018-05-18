<?php

namespace SenseBook\Http\Requests\BackOffice\Website;

use Illuminate\Foundation\Http\FormRequest;

class CategoryNewsAndEventRequest extends FormRequest
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
            'name_th' => 'required',
            'name_en' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name_th.required' => 'กรุณาระบุชื่อภาษาไทย',
            'name_en.required' => 'กรุณาระบุชื่อภาษาอังกฤษ'
        ];
    }
}
