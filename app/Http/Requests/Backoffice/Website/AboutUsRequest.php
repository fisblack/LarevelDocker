<?php

namespace SenseBook\Http\Requests\BackOffice\Website;

use Illuminate\Foundation\Http\FormRequest;

class AboutUsRequest extends FormRequest
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
            'image_head' => 'required',
            'image_1' => 'required',
            'image_2' => 'required',
            'title' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'image_head.required' => 'กรุณากรอก path ของรูป',
            'image_1.required' => 'กรุณากรอก path ของรูป',
            'image_2.required' => 'กรุณากรอก path ของรูป',
            'title.required' => 'กรุณากรอกข้อความ',
        ];
    }
}
