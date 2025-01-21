<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function store(Request $request)
    {
        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price
        ]);
        return response()->json($product, 201);
    }

    public function index()
    {
        $products = Product::all();
        return response()->json($products);
    }
}
