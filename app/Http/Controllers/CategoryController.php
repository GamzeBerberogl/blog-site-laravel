<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function show($id)
    {
        $category = Category::findOrFail($id);
        $posts = Post::where('category_id', $id)->paginate(10);
        return view('categories.show', compact('category', 'posts'));
    }


}
