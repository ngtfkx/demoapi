<?php

namespace App\Http\Requests\Products;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class DestroyRequest extends FormRequest
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
            //
        ];
    }
}
