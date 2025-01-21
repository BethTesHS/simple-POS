<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\Product;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function store(Request $request)
    {
        $sale = Sale::create(['total' => $request->total]);
        
        foreach ($request->items as $item) {
            $product = Product::find($item['product_id']);
            SaleItem::create([
                'sale_id' => $sale->id,
                'product_id' => $product->id,
                'quantity' => $item['quantity'],
                'price' => $product->price
            ]);
        }

        return response()->json($sale, 201);
    }

    public function index()
    {
        $sales = Sale::with('items')->get();
        return response()->json($sales);
    }
}
