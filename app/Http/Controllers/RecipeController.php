<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Models\Category;
use App\Models\Keyword;
use Illuminate\Support\Facades\Auth;

class RecipeController extends Controller
{
    public function index()
    {
        $recipes = Recipe::with(['user', 'category', 'keywords'])->latest()->paginate(10);
        $categories = Category::all();
        return view('recipes.index', compact('recipes', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        $keywords = Keyword::all();
        return view('recipes.create', compact('categories', 'keywords'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'ingredients' => 'required',
            'steps' => 'required',
            'category_id' => 'required|exists:categories,id',
            'keyword_id' => 'nullable|exists:keywords,id',
            'photo' => 'nullable|image|max:2048',
        ]);

        $recipe = new Recipe();
        $recipe->title = $request->title;
        $recipe->ingredients = $request->ingredients;
        $recipe->steps = $request->steps;
        $recipe->category_id = $request->category_id;
        $recipe->user_id = Auth::id();
        
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('recipes', 'public');
            $recipe->photo = basename($path);
        }

        $recipe->save();

        if ($request->keyword_id) {
            $recipe->keywords()->attach($request->keyword_id);
        }

        return redirect()->route('recipes.index')->with('success', 'Recipe created successfully!');
    }

    public function show(Recipe $recipe)
    {
        $categories = Category::all();
        return view('recipes.show', compact('recipe','categories'));
    }

    public function edit(Recipe $recipe)
    {
        $categories = Category::all();
        $keywords = Keyword::all();
        return view('recipes.edit', compact('recipe', 'categories', 'keywords'));
    }

    public function update(Request $request, Recipe $recipe)
    {
        $request->validate([
            'title' => 'required',
            'ingredients' => 'required',
            'steps' => 'required',
            'category_id' => 'required|exists:categories,id',
            'keyword_id' => 'nullable|exists:keywords,id',
            'photo' => 'nullable|image|max:2048',
        ]);

        $recipe->title = $request->title;
        $recipe->ingredients = $request->ingredients;
        $recipe->steps = $request->steps;
        $recipe->category_id = $request->category_id;
        
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('recipes');
            $recipe->photo = basename($path);
        }

        $recipe->save();

        if ($request->keyword_id) {
            $recipe->keywords()->sync($request->keyword_id);
        }

        return redirect()->route('recipes.my')->with('success', 'Recipe updated successfully!');
    }

    public function destroy(Recipe $recipe)
    {
        $recipe->delete();
        return redirect()->route('recipes.index')->with('success', 'Recipe deleted successfully!');
    }

}