<?php

namespace App\Http\Requests\Products;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'category_id' => [
                'required',
                Rule::exists('categories', 'id'),
            ],
            'photo' => 'sometimes|image',
            'photo_desc' => 'required_with:photo'
        ];
    }
}
