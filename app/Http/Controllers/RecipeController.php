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
            'description' => 'nullable|string|max:2000',
            'ingredients' => 'required',
            'steps' => 'required',
            'category_id' => 'required|exists:categories,id',
            'keyword_id' => 'nullable|exists:keywords,id',
            'photo' => 'nullable|image|max:2048',
        ]);

        $recipe = new Recipe();
        $recipe->title = $request->title;
        $recipe->description = $request->description;
        $recipe->ingredients = $request->ingredients;
        $recipe->steps = $request->steps;
        $recipe->category_id = $request->category_id;
        $recipe->user_id = Auth::id();
        
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('recipes', 'public');
            $recipe->photo = basename($path);
        }

        $recipe->save();

        $recipe->keywords()->sync($request->keyword_id ? [$request->keyword_id] : []);
        

        return redirect()->route('recipes.index')->with('success', 'Recepte veiksmīgi izveidota!');
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
            'description' => 'nullable|string|max:2000',
            'ingredients' => 'required',
            'steps' => 'required',
            'category_id' => 'required|exists:categories,id',
            'keyword_id' => 'nullable|exists:keywords,id',
            'photo' => 'nullable|image|max:2048',
        ]);

        $recipe->title = $request->title;
        $recipe->description = $request->description;
        $recipe->ingredients = $request->ingredients;
        $recipe->steps = $request->steps;
        $recipe->category_id = $request->category_id;
        
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('recipes');
            $recipe->photo = basename($path);
        }

        $recipe->save();

        if ($request->keyword_id) {
            $recipe->keywords()->sync([$request->keyword_id]);
        } else {
            $recipe->keywords()->detach(); 
        }

        return redirect()->route('recipes.my')->with('success', 'Recepte veiksmīgi atjaunināta!');
    }

    public function destroy(Recipe $recipe)
    {
        $recipe->delete();
        return redirect()->route('recipes.index')->with('success', 'Recepte veiksmīgi izdzēsta!');
    }

    public function myRecipes()
    {
        if (Auth::user()->role === 'admin') {
            $recipes = Recipe::latest()->paginate(10); 
        } else {
            $recipes = Recipe::where('user_id', Auth::id())->latest()->paginate(10);
        }
        $categories = Category::all();
        return view('recipes.my', compact('recipes', 'categories'));
    }


    public function search(Request $request)
    {
        $query = $request->input('query', '');

        $keyword = $request->input('keyword', '');
        $selectedCategory = $request->input('category_id', 0); 
        $selectedKeywordId = $request->input('selected_keyword_id', 0); 


        $recipes = Recipe::query();

        if ($query) {
            $recipes->where(function($q) use ($query) {
                $q->where('title', 'like', '%' . $query . '%')
                  ->orWhere('ingredients', 'like', '%' . $query . '%')
                  ->orWhere('steps', 'like', '%' . $query . '%');
            });
        }

        if ($keyword) {
            $recipes->where(function($q) use ($keyword) {
                $q->where('title', 'like', '%' . $keyword . '%')
                  ->orWhere('ingredients', 'like', '%' . $keyword . '%')
                  ->orWhere('steps', 'like', '%' . $keyword . '%');
            });
        }

        if ($selectedCategory != 0) { 
            $recipes->where('category_id', $selectedCategory);
        }

        if ($selectedKeywordId != 0) {
            $recipes->whereHas('keywords', function ($q) use ($selectedKeywordId) {
                $q->where('keywords.id', $selectedKeywordId);
            });
        }

        $recipes = $recipes->with(['user', 'category', 'keywords'])
                           ->latest()
                           ->paginate(10);

        $categories = Category::all();
        $keywords = Keyword::all();

        return view('recipes.search', compact(
            'recipes',
            'categories',
            'keywords',
            'query',
            'keyword',
            'selectedCategory',
            'selectedKeywordId'
        ));
    }

}