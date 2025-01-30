<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CategoryController extends Controller
{

    public function show()
    {
        $categories = Category::all();
        return response()->json($categories); // Pass the data to the view
    }
    public function store(Request $request)
    {
        try {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $categories = new Category();
        $categories->name = $validated['name'];
        $categories->save();
        

        return redirect()->route('products')->with('success', 'Product added successfully!');
    
        } catch (ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator) // Store validation errors
                ->with('error_alert', true); // Store session flag for alert
        }
    }

}
