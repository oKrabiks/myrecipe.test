<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
   
    protected $middleware = [

    ];

    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            \App\Http\Middleware\BlockedUser::class, 
        ],

        'api' => [
            \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
            \Illuminate\Routing\Middleware\Throttle::class . ':api',
            \Illuminate\Routing\Middleware\ValidateSignature::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

   
    protected $routeMiddleware = [
        
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
        'throttle' => \Illuminate\Routing\Middleware\Throttle::class,
    ];

    protected $middlewareAliases = [
        'auth' => \App\Http\Middleware\Authenticate::class, 
        'auth.basic' => \Illuminate\Auth\Middleware\Authenticate::class . ':basic',
        'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
        'throttle' => \Illuminate\Routing\Middleware\Throttle::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
        'blocked' => \App\Http\Middleware\BlockedUser::class, 
    ];
}
