<?php

namespace App\Http\Controllers;

use App\Models\Sale;
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

        return redirect()->route('pos')->with('success', 'Product added successfully!');
    }
}
