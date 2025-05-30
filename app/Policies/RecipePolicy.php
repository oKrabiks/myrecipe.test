<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Recipe;
use Illuminate\Auth\Access\HandlesAuthorization;

class RecipePolicy
{
    use HandlesAuthorization;

    public function update(User $user, Recipe $recipe)
    {
        return $user->id === $recipe->user_id || $user->role === 'admin';
    }

    public function delete(User $user, Recipe $recipe)
    {
        return $user->id === $recipe->user_id || $user->role === 'admin';
    }

    public function viewAny(User $user = null)
    {
        return true;
    }

    public function view(User $user = null, Recipe $recipe)
    {
        return true; 
    }

    public function create(User $user)
    {
        return $user->role !== 'guest'; 
    }


    public function restore(User $user, Recipe $recipe)
    {
        return false; 
    }

    public function forceDelete(User $user, Recipe $recipe)
    {
        return false; 
    }
}