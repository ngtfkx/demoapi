<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tags\DestroyRequest;
use App\Http\Requests\Tags\StoreRequest;
use App\Http\Requests\Tags\UpdateRequest;
use App\Models\Tag;

class TagsController extends Controller
{
    public function index()
    {
        // TODO: pagination

        $items = Tag::all();

        return api_success(['data' => $items]);
    }

    public function store(StoreRequest $request)
    {
        $params = $request->only('name');

        $tag = Tag::create($params);

        return api_success(['data' => $tag]);
    }

    public function show(Tag $tag)
    {
        return api_success(['data' => $tag]);
    }

    public function update(UpdateRequest $request, Tag $tag)
    {
        $params = $request->only('name');

        $tag->update($params);

        return api_success(['data' => $tag]);
    }

    public function destroy(DestroyRequest $request, Tag $tag)
    {
        $tag->delete();

        return api_success();
    }
}
