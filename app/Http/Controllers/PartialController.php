<?php

namespace App\Http\Controllers;

use App\Models\PartialPayment;
use App\Models\Sale;
use App\Models\SaleDetail;
use App\Models\Stock;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class PartialController extends Controller
{
    public function store(Request $request)
    {
        try{
            $validated = $request->validate([
                'totalPay' => 'required|decimal:0,2',
                'totPaid' => 'required|decimal:0,2',
                'toPay' => 'required|decimal:0,2',
                'payNow' => 'required|decimal:0,2',
                'sale_id' => 'required|integer',
                'customer_id' => 'required|integer',
                'partial_id' => 'required|integer',
            ]);

            $partials = new PartialPayment();

            $partials->sale_id = $validated['sale_id'];
            $partials->customer_id = $validated['customer_id'];
            $partials->paid = $validated['totPaid'] + $validated['payNow'];
            $partials->toPay = $validated['toPay'] - $validated['payNow'];
            $partials->total = $validated['totalPay'];

            $partial = PartialPayment::where('id', $validated['partial_id'])->first();
            $partial->latest = 0;


            $partials->save();
            $partial->save();


            return redirect()->route('partial')->with('success', 'Product added successfully!');

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
                'customer' => 'required|string|not_in:0',
            ]);

            $sale = new Sale();

            $sale->totalQuantity = $validated['totalQuantity'];
            $sale->totalPrice = $validated['totalPrice'];
            $sale->payMethod = $validated['payMethod'];
            $sale->user_id= auth()->user()->id;

            $sale->save();

            PartialPayment::insert([
                'sale_id' => $sale->id,
                'customer_id' => $validated['customer'],
                'paid' => $validated['payNow'],
                'toPay' => ($validated['totalPrice']) - ($validated['payNow']),
                'total' => $validated['totalPrice'],
                'created_at' => now(),
                'updated_at' => now()
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
