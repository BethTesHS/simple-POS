<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function storeSale(Request $request)
    {
        $validated = $request->validate([
            'itemNo' => 'required|integer',
            'totalPrice' => 'required|decimal:0,2',
        ]);

        $sale = new Sale();

        $sale->itemNo = $validated['itemNo'];
        $sale->totalPrice = $validated['totalPrice'];
        
        $sale->save();

        return redirect()->route('pos')->with('success', 'Product added successfully!');
    }
}
