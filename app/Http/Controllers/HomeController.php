<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\Filter;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $builder = Product::query();

        // Можно и не задавать параметры поименно, а взять все скопом внутри фильтра
        $params = $request->all('price_from', 'price_till', 'calorific', 'is_top', 'is_new', 'query');

        $filter = (new Filter($builder, $params))->make()->getBuilder();

        $products = $filter->get();

        $data = [
            'products' => $products,
            'sql' => $filter->toSql(),
        ];

        return view('home', $data);
    }
}
