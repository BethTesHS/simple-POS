<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    // public function show()
    // {
    //     $products = Product::all();
    //     return response()->json($products);
    // }

    public function show()
    {
        $products = Product::all();
        return response()->json($products); // Pass the data to the view
    }

    public function showProduct(Request $request) {
        $productId = $request->input('id');
        
        // $product = Product::find($productId);
        $product = Product::where('id', $productId)->get();
        return response()->json($product);
    }

    public function filterProduct(Request $request)
    {
        $categoryId = $request->input('category_id');
        
        if($categoryId == 0){
            $products = Product::all();
        } else {
            $products = Product::where('category_id', $categoryId)->get();
        }

        return response()->json($products);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'productName' => 'required|string|max:255',
            'price' => 'required|decimal:0,0',
            'category_id' => 'required|integer|max:10',
            // 'brand_id' => 'required|integer|max:255',
        ]);

        $product = new Product();

        $product->productName = $validated['productName'];
        $product->price = $validated['price'];
        $product->category_id = $validated['category_id'];
        // $product->brand_id = $validated['brand_id'];
        
        $product->save();

        // echo '<text> productName: '. $validated['productName'] .'<br> price: '. $validated['price'] .'<br> productType: '. $validated['productType'] .'</text>';
        
        return redirect()->route('pos')->with('success', 'Product added successfully!');
    }

    public function update(Request $request) {

        $validated = $request->validate([
            'productName' => 'required|string|max:255',
            'price' => 'required|decimal:0,0',
            'productType' => 'required|integer|max:255',
            // 'productBrand' => 'required|integer|max:255',
        ]);

        $product = Product::findOrFail( $validated['id']);
        
        $product->productName = $validated['productName'];
        $product->price = $validated['price'];
        $product->category_id = $validated['productType'];
        // $product->brand_id = $validated['productBrand'];
        
        
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
