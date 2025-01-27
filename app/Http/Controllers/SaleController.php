<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\SaleDetail;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function storeSale(Request $request)
    {
        $validated = $request->validate([
            'totalQuantity' => 'required|integer',
            'totalPrice' => 'required|decimal:0,2',
            'payMethod' => 'required|string',
        ]);

        $sale = new Sale();

        $sale->totalQuantity = $validated['totalQuantity'];
        $sale->totalPrice = $validated['totalPrice'];
        $sale->payMethod = $validated['payMethod'];
        
        $sale->save();
        
        foreach ($request->products as $productId => $product) {
            saleDetail::insert([
                'sale_id' => $sale->id,
                'product_id' => $productId,
                'productName' => $product['productName'],
                'price' => $product['price'],
                'quantity' => $product['quantity'],
            ]);
        }

        return redirect()->route('pos')->with('success', 'Product added successfully!');
    }
}
