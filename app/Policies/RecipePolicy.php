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
        //Var atjaunināt, ja lietotaja id ir receptes lietotāja id vai ari vai lietotajs ir admins
    }

    public function delete(User $user, Recipe $recipe)
    {
        return $user->id === $recipe->user_id || $user->role === 'admin';
        //Var dzēst, ja lietotaja id ir receptes lietotāja id vai ari vai lietotajs ir admins
    }


    //Visi var apskatīt receptes
    public function viewAny(User $user = null)
    {
        return true; 
    }

    public function view(User $user = null, Recipe $recipe)
    {

        return true;

    }

    // Ja lietotājs nav kā viesis, tad var pievienot recepti
    public function create(User $user)
    {
        return $user->role !== 'guest'; 
    }



    // Neviens nevar atjaunot dzēstās receptas un arī darīt forsēto dzēšanu
    public function restore(User $user, Recipe $recipe)
    {
        return false;

    }

    public function forceDelete(User $user, Recipe $recipe)
    {
        return false; 
    }
}