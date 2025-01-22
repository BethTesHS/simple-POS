<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function show()
    {
        $products = Product::all();
        return response()->json($products);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'productName' => 'required|string|max:255',
            'price' => 'required|decimal:0,0',
            'productType' => 'required|string|max:255',
            'productBrand' => 'required|string|max:255',
        ]);

        $product = new Product();

        $product->productName = $validated['productName'];
        $product->price = $validated['price'];
        $product->productType = $validated['productType'];
        $product->productBrand = $validated['productBrand'];
        
        $product->save();

        // echo '<text> productName: '. $validated['productName'] .'<br> price: '. $validated['price'] .'<br> productType: '. $validated['productType'] .'</text>';
        
        return redirect()->route('pos')->with('success', 'Product added successfully!');
    }

    public function update(Request $request) {

        $validated = $request->validate([
            'productName' => 'required|string|max:255',
            'price' => 'required|decimal:0,0',
            'productType' => 'required|string|max:255',
            'productBrand' => 'required|string|max:255',
        ]);

        $product = Product::findOrFail( $validated['id']);
        
        $product->productName = $validated['productName'];
        $product->price = $validated['price'];
        $product->productType = $validated['productType'];
        $product->productBrand = $validated['productBrand'];
        
        
        $product->save(); // Save to the database

        return redirect()->route('members')->with('success', 'Member added successfully!');
    }

    public function delete(Request $request) {
        $validated = $request->validate([
            'id' => 'required|string|max:10',
        ]);

        $product = Product::findOrFail( $validated['id']);

        $product->delete();

        return redirect()->route('members')->with('success', 'Member deleted successfully');
    }
}
