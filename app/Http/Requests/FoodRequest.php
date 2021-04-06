<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FoodRequest extends FormRequest
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
            'name' => 'required|max:1000',
            'price' => 'required|max:50',
            'description' => 'required',
            'shop_id' => 'required',
            'images' => $this->method() == 'POST' ? 'required': '','image|dimensions:max_width=1920,max_height=1080|max:2048'
        ];
    }
}
