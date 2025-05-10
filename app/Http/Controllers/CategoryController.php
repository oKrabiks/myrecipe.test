<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show(Category $category)
    {
        $recipes = $category->recipes()->with(['user', 'category', 'keywords'])->latest()->paginate(10);
        $categories = Category::all();
        return view('categories.show', compact('category', 'recipes', 'categories'));
    }
}