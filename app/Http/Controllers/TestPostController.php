<?php

namespace App\Http\Controllers;

use App\Models\TestPost;
use App\Models\Category;
use Illuminate\Http\Request;

class TestPostController extends Controller
{

    public function filterPosts(Request $request)
    {
        $categoryId = $request->input('category_id');
        // $categoryId = 3;

        
        $posts = TestPost::where('category_id', $categoryId)->get();

        return response()->json($posts); 
        // return $this->show();

    }

    public function show()
    {
        $categories = Category::all();
        return view('testPost', compact('categories'));
    }

}