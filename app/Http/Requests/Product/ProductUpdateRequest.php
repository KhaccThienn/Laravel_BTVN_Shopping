<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
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
            "name" => "bail|required|min:5|max:100",
            "price" => "bail|required|numeric|gte:1",
            "sale_price" => "bail|numeric|gte:0|lte:price",
            "image" => "bail|mimes:png,jpg,jpeg,jfif,webp"
        ];
    }
}
