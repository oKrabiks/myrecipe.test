<?php

namespace App\Http\Controllers;

use App\Models\Keyword;
use Illuminate\Http\Request;

class KeywordController extends Controller
{
    public function show(Keyword $keyword)
    {
        $recipes = $keyword->recipes()->with(['user', 'category', 'keywords'])->latest()->paginate(10);
        $categories = Category::all();
        return view('keywords.show', compact('keyword', 'recipes', 'categories'));
    }
}