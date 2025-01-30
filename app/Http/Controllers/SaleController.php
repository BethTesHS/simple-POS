<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\SaleDetail;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SaleController extends Controller
{
    public function storeSale(Request $request)
    {
        try{
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
        
        } catch (ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator) // Store validation errors
                ->with('error_alert', true); // Store session flag for alert
        }
    }
}
