<?php

namespace App\Http\Requests\Products;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
    public function authorize(Request $request)
    {
        /**
         * @var User $user
         */
        $user = $request->user();

        /**
         * @var Product $object
         */
        $object = $request->route()->parameter('product');

        return $user->id === $object->user_id;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'photo' => 'sometimes|image',
            'photo_desc' => 'required_with:photo',
            'category_id' => [
                'required',
                Rule::exists('categories', 'id'),
            ],
        ];
    }
}
