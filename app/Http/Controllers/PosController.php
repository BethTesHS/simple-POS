<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class PosController extends Controller
{

    public function index()
    {
        // $products = Product::all();
        $categories = Category::all();

        return view('pos', compact('categories'),);  // Pass the data to the view
    }
}