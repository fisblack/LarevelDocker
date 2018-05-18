<?php

namespace SenseBook\Http\Requests\BackOffice\Setting;

use Illuminate\Foundation\Http\FormRequest;
use Session;

class BankUpdateRequest extends FormRequest
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
            'account_no'=> 'required|digits_between:1,13|numeric'
        ];
    }
}
