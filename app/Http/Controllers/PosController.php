<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\SaleDetail;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class PosController extends Controller
{
    

    public function index(Request $request)
    {

        $products = Product::all();
        $sale = Sale::orderBy('id', 'desc')->first();
        $saleDetails = SaleDetail::where('sale_id', $sale->id)->get();
        $categories = Category::all();

        return view('pos', compact('products', 'sale', 'saleDetails', 'categories'),);  // Pass the data to the view
    }

    public function sales()
    {
        $products = Product::all();
        $salesPage = Sale::paginate(9);
        $sales = Sale::all();
        $categories = Category::all();

        return view('sales', compact('products', 'sales', 'salesPage', 'categories'),);  // Pass the data to the view
    }

    public function products()
    {
        $products = Product::all();
        $sales = Sale::all();
        $categories = Category::all();
        
        return view('products', compact('products', 'sales', 'categories'),);  // Pass the data to the view
    }
}