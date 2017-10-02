<?php

namespace App\Http\Requests\Users;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UpdateRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'login' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|max:255',
        ];
    }
}
