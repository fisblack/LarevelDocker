<?php

namespace SenseBook\Http\Requests\BackOffice\Website;

use Illuminate\Foundation\Http\FormRequest;

class ContactUsRequest extends FormRequest
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
            'title_th' => 'required',
            'title_en' => 'required',
            'subtitle_th' => 'required',
            'subtitle_en' => 'required',
            'address_th' => 'required',
            'address_en' => 'required',
            'email' => 'required',
            'phone' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'title_th.required' => 'กรุณากรอกหัวข้อภาษาไทย',
            'title_en.required' => 'กรุณากรอกหัวข้อภาษาอังกฤษ',
            'subtitle_th.required' => 'กรุณากรอกหัวข้อย่อยภาษาไทย',
            'subtitle_en.required' => 'กรุณากรอกหัวข้อย่อยภาษาอังกฤษ',
            'address_th.required' => 'กรุณากรอกที่อยู่ภาษาไทย',
            'address_en.required' => 'กรุณากรอกที่อยู่ภาษาอังกฤษ',
            'email.required' => 'กรุณากรอกอีเมล์',
            'phone.required' => 'กรุณากรอกเบอร์โทรศัพท์'
        ];
    }
}
