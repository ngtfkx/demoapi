<?php

namespace App\Http\Requests\Users;

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
         * @var User $object
         */
        $object = $request->route()->parameter('user');

        return $user->id === $object->id;
    }

    public function rules()
    {
        return [
            //
        ];
    }
}
