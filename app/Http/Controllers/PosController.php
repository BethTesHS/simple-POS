<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class PosController extends Controller
{

    public function show()
    {
        $products = Product::all();
        return view('pos', compact('products'));  // Pass the data to the view
    }
}