<?php

use App\Http\Controllers\RecipeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\KeywordController;
use Illuminate\Support\Facades\Route;



// Galvenā lapa 
Route::get('/', [RecipeController::class, 'index'])->name('home');

// Receptes
Route::get('/recipes', [RecipeController::class, 'index'])->name('recipes.index');
Route::get('/recipes/create', [RecipeController::class, 'create'])->name('recipes.create');
Route::post('/recipes', [RecipeController::class, 'store'])->name('recipes.store');
Route::get('/recipes/{recipe}', [RecipeController::class, 'show'])->name('recipes.show');
Route::get('/recipes/{recipe}/edit', [RecipeController::class, 'edit'])->name('recipes.edit');
Route::put('/recipes/{recipe}', [RecipeController::class, 'update'])->name('recipes.update');
Route::delete('/recipes/{recipe}', [RecipeController::class, 'destroy'])->name('recipes.destroy');

// Kategorijas
Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');

// Atslēgvārdi
Route::get('/keywords/{keyword}', [KeywordController::class, 'show'])->name('keywords.show');

