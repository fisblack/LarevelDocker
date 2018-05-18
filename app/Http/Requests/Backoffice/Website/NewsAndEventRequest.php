<?php

namespace SenseBook\Http\Requests\BackOffice\Website;

use Illuminate\Foundation\Http\FormRequest;

class NewsAndEventRequest extends FormRequest
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
        switch ($this->method()) {
            case 'POST':
                return [
                    'title_th' => 'required',
                    'title_en' => 'required',
                    'short_description_th' => 'required',
                    'short_description_en' => 'required',
                    'description_th' => 'required',
                    'description_en' => 'required',
                    'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                    'banner' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                    'news_events_date' => 'required'
                ];
            case 'PUT':
                return [
                    'title_th' => 'required',
                    'title_en' => 'required',
                    'short_description_th' => 'required',
                    'short_description_en' => 'required',
                    'description_th' => 'required',
                    'description_en' => 'required',
                    'image' => 'image|mimes:jpeg,png,jpg|max:2048',
                    'banner' => 'image|mimes:jpeg,png,jpg|max:2048',
                    'news_events_date' => 'required'
                ];
            default:
                break;
        }
    }

    public function messages()
    {
        return [
            'title_th.required' => 'กรุณาระบุชื่ข่าวอภาษาไทย',
            'title_en.required' => 'กรุณาระบุชื่อข่าวภาษาอังกฤษ',
            'short_description_th.required' => 'กรุณาระบุรายละเอียดข่าวย่อภาษาไทย',
            'short_description_en.required' => 'กรุณาระบุรายละเอียดข่าวย่อภาษาอังกฤษ',
            'description_th.required' => 'กรุณาระบุรายละเอียดข่าวภาษาไทย',
            'description_en.required' => 'กรุณาระบุรายละเอียดข่าวภาษาอังกฤษ',
            'image.required' => 'กรุณาใส่รูปภาพข่าวและกิจกรรม',
            'banner.required' => 'กรุณาใส่รูปภาพแบนเนอร์ข่าว',
            'news_events_date.required' => 'กรุณาระบุวันที่กิจกรรม'
        ];
    }
}
