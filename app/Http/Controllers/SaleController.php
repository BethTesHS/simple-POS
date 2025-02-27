<?php

namespace App\Http\Controllers;

use App\Models\PartialPayment;
use App\Models\Sale;
use App\Models\SaleDetail;
use App\Models\Stock;
use App\Models\Product;
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
            $sale->user_id= auth()->user()->id;

            $sale->save();

            foreach ($request->products as $productId => $productSale) {

                $product = Product::where('id', $productId)->first();

                SaleDetail::insert([
                    'sale_id' => $sale->id,
                    'product_id' => $productId,
                    'productName' => $productSale['productName'],
                    'price' => $productSale['price'],
                    'quantity' => $productSale['quantity'],
                ]);


                Stock::insert([
                    'product_id' => $productId,
                    'productName' => $productSale['productName'],
                    'purchaseType' => 'Sell',
                    'quantity' => -$productSale['quantity'],
                    'totalQuantity' => ($product->stockQuantity)-($productSale['quantity']),
                    'user_id' => auth()->user()->id,
                    'buyingPrice' => 0,
                    'date' => now(),
                    'created_at' => now(),
                    'updated_at' => now()
                ]);



                $quantity = intval($productSale['quantity']);
                $currentStock = intval($product['stockQuantity']);
                // $newStock = $currentStock - $quantity;

                Product::where('id', $productId)->update([
                    // $currentStock = 'stockQuantity',
                    'stockQuantity' => intval($currentStock) - $quantity,
                ]);
            }

            return redirect()->route('pos')->with('success', 'Product added successfully!');

        } catch (ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator) // Store validation errors
                ->with('error_alert', true); // Store session flag for alert
        }
    }

    public function storePartialSale(Request $request)
    {
        try{
            $validated = $request->validate([
                'totalQuantity' => 'required|integer',
                'totalPrice' => 'required|decimal:0,2',
                'payMethod' => 'required|string',
                'payNow' => 'required|decimal:0,2',
            ]);

            $sale = new Sale();

            $sale->totalQuantity = $validated['totalQuantity'];
            $sale->totalPrice = $validated['totalPrice'];
            $sale->payMethod = $validated['payMethod'];
            $sale->user_id= auth()->user()->id;

            $sale->save();

            PartialPayment::insert([
                'sale_id' => $sale->id,
                'paid' => $validated['payNow'],
                'toPay' => ($validated['totalPrice']) - ($validated['payNow']),
                'total' => $validated['totalPrice']
            ]);

            foreach ($request->products as $productId => $productSale) {

                $product = Product::where('id', $productId)->first();

                SaleDetail::insert([
                    'sale_id' => $sale->id,
                    'product_id' => $productId,
                    'productName' => $productSale['productName'],
                    'price' => $productSale['price'],
                    'quantity' => $productSale['quantity'],
                ]);


                Stock::insert([
                    'product_id' => $productId,
                    'productName' => $productSale['productName'],
                    'purchaseType' => 'Sell',
                    'quantity' => -$productSale['quantity'],
                    'totalQuantity' => ($product->stockQuantity)-($productSale['quantity']),
                    'user_id' => auth()->user()->id,
                    'buyingPrice' => 0,
                    'date' => now(),
                    'created_at' => now(),
                    'updated_at' => now()
                ]);



                $quantity = intval($productSale['quantity']);
                $currentStock = intval($product['stockQuantity']);
                // $newStock = $currentStock - $quantity;

                Product::where('id', $productId)->update([
                    // $currentStock = 'stockQuantity',
                    'stockQuantity' => intval($currentStock) - $quantity,
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
