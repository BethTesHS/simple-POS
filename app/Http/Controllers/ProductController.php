<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
class ProductController extends Controller
{

    public function showProducts()
    {
        $products = Product::all();
        return response()->json($products); // Pass the data to the view
    }

    public function searchTest(Request $request)
    {
        $query = $request->get('search');

        $products = Product::when($query, function ($queryBuilder) use ($query) {
            return $queryBuilder->where('productName', 'like', '%' . $query . '%');
        })->get();

        return view('search', compact('products', 'query'));
    }

    public function showProduct(Request $request) {
        $productId = $request->input('id');

        $product = Product::where('id', $productId)->get();
        return response()->json($product);
    }

    public function searchProducts(Request $request)
    {
        $query = $request->input('search_query');
        $categoryId = $request->input('category_id');

        if($categoryId == 0){
            $products = Product::where('productName', 'like', '%' . $query . '%')
                                ->get();
        } else {
            $products = Product::where('productName', 'like', '%' . $query . '%')
                                ->where('category_id', $categoryId)->get();
        }

        return response()->json($products);
    }

    public function filterProduct(Request $request)
    {
        $categoryId = $request->input('category_id');

        if($categoryId == 0){
            $products = Product::with('category')->get();
        } else {
            $products = Product::where('category_id', $categoryId)->with('category')->get();
        }

        return response()->json($products);
    }

    public function store(Request $request)
    {
        try{
            $validated = $request->validate([
                'productName' => 'required|string|max:255',
                'stockQuantity' => 'required|integer',
                'price' => 'required|decimal:0,2',
                'category_id' => 'required|integer|max:10',
            ]);

            $product = new Product();

            $product->productName = $validated['productName'];
            $product->stockQuantity = $validated['stockQuantity'];
            $product->price = $validated['price'];
            $product->category_id = $validated['category_id'];

            $product->save();


            return redirect()->route('products')->with('success', 'Product added successfully!');
        } catch (ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator) // Store validation errors
                ->with('error_alert', true); // Store session flag for alert
        }
    }

    public function update(Request $request) {

        try{
            $validated = $request->validate([
                'id' => 'required|string',
                'productName' => 'required|string|max:255',
                'stockQuantity' => 'required|integer',
                'price' => 'required|decimal:0,2',
                'category_id' => 'required|integer|max:10',
            ]);

            $product = Product::findOrFail( str_replace("P_", "", $validated['id']));

            $product->productName = $validated['productName'];
            $product->stockQuantity = $validated['stockQuantity'];
            $product->price = $validated['price'];
            $product->category_id = $validated['category_id'];

            $product->save();

            return redirect()->route('products')->with('success', 'Success!');
        } catch (ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator) // Store validation errors
                ->with('error_alert', true); // Store session flag for alert
        }
    }

    public function delete(Request $request) {
        try{
            $validated = $request->validate([
                'id' => 'required|string|max:10',
            ]);

            $product = Product::findOrFail( $validated['id']);

            $product->delete();

            return redirect()->route('products')->with('success', 'Success!');
        } catch (ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator) // Store validation errors
                ->with('error_alert', true); // Store session flag for alert
        }
    }
}
