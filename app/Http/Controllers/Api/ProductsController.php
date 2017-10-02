<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Products\DestroyRequest;
use App\Http\Requests\Products\StoreRequest;
use App\Http\Requests\Products\UpdateRequest;
use App\Models\Product;

class ProductsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->only('store', 'update', 'destroy');
    }

    public function index()
    {
        // TODO: pagination

        $items = Product::all();

        return api_success(['data' => $items]);
    }

    public function store(StoreRequest $request)
    {
        $params = $request->only('name', 'description', 'price');

        $product = Product::create($params);

        return api_success(['data' => $product]);
    }

    public function show(Product $product)
    {
        return api_success(['data' => $product]);
    }

    public function update(UpdateRequest $request, Product $product)
    {
        $params = $request->only('name', 'description', 'price');

        $product->update($params);

        return api_success(['data' => $product]);
    }

    public function destroy(DestroyRequest $request, Product $product)
    {
        $product->delete();

        return api_success();
    }
}
