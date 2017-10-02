<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\DestroyRequest;
use App\Http\Requests\Users\StoreRequest;
use App\Http\Requests\Users\UpdateRequest;
use App\Models\User;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->only('store', 'update', 'destroy');
    }

    public function index()
    {
        // TODO: pagination

        $items = User::all();

        return api_success(['data' => $items]);
    }

    public function store(StoreRequest $request)
    {
        $user = new User;

        $user->name = $request->input('name');

        $user->login = $request->input('login');

        $user->password = $request->input('password');

        $user->email = $request->input('email');

        $user->password = bcrypt($request->input('password'));

        $user->api_token = str_random(64); // TODO: тут надо проверять уникаьность

        $user->save();

        $data = [
            'api_token' => $user->api_token,
        ];

        return api_success($data, 201);
    }

    public function show(User $user)
    {
        return api_success(['data' => $user]);
    }

    public function update(UpdateRequest $request, User $user)
    {
        $params = $request->only('name');

        $user->update($params);

        return api_success(['data' => $user]);
    }

    public function destroy(DestroyRequest $request, User $user)
    {
        $user->delete();

        return api_success();
    }
}
