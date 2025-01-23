<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function show()
    {
        $categories = Category::all();
        return response()->json($categories); // Pass the data to the view
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $categories = new Category();
        $categories->name = $validated['name'];
        $categories->save();

        return redirect()->route('pos')->with('success', 'Product added successfully!');
    }

}
