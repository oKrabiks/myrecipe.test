<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Policies\RecipePolicy;
use App\Models\Recipe;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [

        Recipe::class => RecipePolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();

    }
}