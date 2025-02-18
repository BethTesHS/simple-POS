<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
class StockController extends Controller
{

    public function update(Request $request) {

        try{
            $validated = $request->validate([
                'product' => 'required|string',
                'buyingPrice' => 'required|integer',
                'quantity' => 'required|integer',
            ]);

            $stock = new Stock();
            
            $productDetail = json_decode($validated['product']);
            
            $product = Product::where('id', $productDetail[0])->first();

            $stock->product_id = $productDetail[0];
            $stock->productName = $productDetail[1];
            $stock->purchaseType = 'Buy';
            $stock->buyingPrice = $validated['buyingPrice'];
            $stock->quantity = $validated['quantity'];
            $stock->totalQuantity = ($product->stockQuantity)+($validated['quantity']);

            $product->stockQuantity = ($product->stockQuantity)+($validated['quantity']);



            $stock->save();
            $product->save();

            return redirect()->route('stocks')->with('success', 'Success!');
        } catch (ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator) // Store validation errors
                ->with('error_alert', true); // Store session flag for alert
        }
    }
}