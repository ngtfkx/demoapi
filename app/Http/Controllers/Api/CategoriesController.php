<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Categories\DestroyRequest;
use App\Http\Requests\Categories\StoreRequest;
use App\Http\Requests\Categories\UpdateRequest;
use App\Models\Category;

class CategoriesController extends Controller
{
    public function index()
    {
        // TODO: pagination

        $items = Category::all();

        return api_success(['data' => $items]);
    }

    public function store(StoreRequest $request)
    {
        $params = $request->only('name', 'description');

        $category = Category::create($params);

        return api_success(['data' => $category]);
    }

    public function show(Category $category)
    {
        return api_success(['data' => $category]);
    }

    public function update(UpdateRequest $request, Category $category)
    {
        $params = $request->only('name', 'description');

        $category->update($params);

        return api_success(['data' => $category]);
    }

    public function destroy(DestroyRequest $request, Category $category)
    {
        $category->delete();

        return api_success();
    }
}
