<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\SaleDetail;
use App\Models\Stock;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class PosController extends Controller
{
    public function index(Request $request)
    {

        // $products = Product::all();
        $products = Product::where('stockQuantity', '!=', 0)->get();
        $sale = Sale::orderBy('id', 'desc')->first();
        if ($sale == null) {
            $saleDetails = null;
        }
        else {
            $saleDetails = SaleDetail::where('sale_id', $sale->id)->get();
        }
        $categories = Category::all();

        return view('pos', compact('products', 'sale', 'saleDetails', 'categories'),);  // Pass the data to the view
    }

    public function sales()
    {
        $products = Product::all();
        $salesPage = Sale::paginate(9);
        $sales = Sale::with('user')->get();
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

    public function stocks()
    {
        $products = Product::all();
        $sales = Sale::all();
        $stocks = Stock::latest()->with('user')->get();
        $categories = Category::all();

        $stockDates = Stock::select('date')
            ->distinct()
            ->orderBy('date', 'asc')
            ->pluck('date');
        $stocksPerDate = Stock::selectRaw('date, SUM(quantity) OVER (ORDER BY date ASC) as total_quantity')
            ->distinct()
            ->pluck('total_quantity');


        return view('stocks', compact('products', 'sales', 'categories', 'stocks', 'stockDates', 'stocksPerDate'),);  // Pass the data to the view
    }

    public function analysis()
    {
        $products = Product::all();
        $sales = Sale::all();
        $stocks = Stock::all();
        $categories = Category::all();

        $stockDates = Stock::select('date')
            ->distinct()
            ->orderBy('date', 'asc')
            ->pluck('date');
        $stocksPerDate = Stock::selectRaw('date, SUM(quantity) OVER (ORDER BY date ASC) as total_quantity')
            ->distinct()
            ->pluck('total_quantity');


        return view('analysis', compact('products', 'sales', 'categories', 'stocks', 'stockDates', 'stocksPerDate'),);  // Pass the data to the view
    }
}
