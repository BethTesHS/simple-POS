<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class PosController extends Controller
{

    public function index()
    {
        // $products = Product::all();
        $categories = Category::all();

        return view('pos', compact('categories'),);  // Pass the data to the view
    }

    public function sales()
    {
        $sales = Sale::all();
        return view('sales', compact('sales'),);  // Pass the data to the view
    }

    public function products()
    {
        $products = Product::all();
        return view('products', compact('products'),);  // Pass the data to the view
    }
}