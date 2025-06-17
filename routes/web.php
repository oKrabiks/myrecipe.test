<?php

use App\Http\Controllers\RecipeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\KeywordController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\AdminController;
use App\Http\Middleware\BlockedUser;


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

Route::get('/my-recipes', [RecipeController::class, 'myRecipes'])->name('recipes.my');

// Autentifikācija
Auth::routes();

Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Meklēšana
Route::get('/search', [RecipeController::class, 'search'])->name('search');


// Autentificējoties jāiziet caur blocked user pārbaudi
Route::middleware(['auth', BlockedUser::class])->group(function () {
    Route::get('/', function () {
        return redirect()->route('recipes.index'); 
    })->name('home'); 
});

// Administratora maršruti
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
    Route::put('/admin/users/{user}/toggle-block', [AdminController::class, 'toggleBlock'])->name('admin.users.toggleBlock');
});

