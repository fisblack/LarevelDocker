<?php

namespace SenseBook\Http\Requests\BackOffice\Setting;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name' => 'required',
            'page_count' => 'required|integer',
            'isbn' => 'numeric',
            'suggested_retail_price' => 'required',
            'height' => 'numeric',
            'weight' => 'numeric',
            'width' => 'numeric',
            'depth' => 'numeric',
            'cost' => 'numeric',
            'reward_points' => 'integer',
            'point_redemption_for_free_gift' => 'integer',
        ];
    }
}
