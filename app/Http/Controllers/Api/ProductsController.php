<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Products\DestroyRequest;
use App\Http\Requests\Products\StoreRequest;
use App\Http\Requests\Products\UpdateRequest;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->only('store', 'update', 'destroy');
    }

    public function index(Request $request)
    {
        // TODO: pagination

        $query = Product::query();

        if ($request->has('category')) {
            // можно указывать несколько значений через запятую
            $categoryIds = explode(',', $request->input('category'));

            $query->whereIn('category_id', $categoryIds);
        }

        if ($request->has('user')) {
            // можно указывать несколько значений через запятую
            $userIds = explode(',', $request->input('user'));

            $query->whereIn('user_id', $userIds);
        }

        if ($request->has('min')) {
            $query->where('price', '>=', $request->input('min'));
        }

        if ($request->has('max')) {
            $query->where('price', '<=', $request->input('max'));
        }

        if ($request->has('tag')) {
            $tag = $request->input('tag');

            $query->whereHas('tags', function (Builder $query) use ($tag) {
                $query->where('name', 'like', '%' . $tag . '%');
            });
        }

        $limit = $request->input('limit', 10);

        $items = $query->limit($limit)->get();

        $items->load('user', 'category', 'tags');

        return api_success(['data' => $items]);
    }

    public function store(StoreRequest $request)
    {
        $params = $request->only('name', 'description', 'price', 'category_id');

        /**
         * @var User $user
         */
        $user = $request->user();

        $product = $user->products()->save(Product::make($params));

        if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
            $filename = $user->id . '.' . $request->file('photo')->extension();

            $request->file('photo')->storeAs('public/products', $filename);

            $product->photo = $filename;
        }

        return api_success(['data' => $product], 201);
    }

    public function show(Product $product)
    {
        return api_success(['data' => $product]);
    }

    public function update(UpdateRequest $request, Product $product)
    {
        $params = $request->only('name', 'description', 'price');

        $product->update($params);

        $product->load('user', 'category', 'tags');

        return api_success(['data' => $product]);
    }

    public function destroy(DestroyRequest $request, Product $product)
    {
        $product->delete();

        return api_success();
    }
}
