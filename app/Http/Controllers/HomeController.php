<?php

namespace App\Http\Controllers;

use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $builder = Product::query();

        $products = $builder->get();

        $data = [
            'products' => $products,
        ];

        return view('home', $data);
    }
}
