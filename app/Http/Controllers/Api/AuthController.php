<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $login = $request->input('login');

        $password = $request->input('password');

        $asLogin = [
            'password' => $password,
            'login' => $login,
        ];

        $asEmail = [
            'password' => $password,
            'email' => $login,
        ];

        if (Auth::once($asLogin) || Auth::once($asEmail)) {
            $user = User::where('login', '=', $login)->orWhere('email', '=', $login)->first();

            $data = [
                'api_token' => $user->api_token,
            ];

            return api_success($data);
        }

        return api_error([
            'message' => 'Wrong login or password',
        ]);
    }
}
