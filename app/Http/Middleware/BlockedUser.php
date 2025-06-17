<?php

namespace App\Http\Middleware;

use Closure; //lai padotu nakamajam
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;

class BlockedUser
{
    public function handle(Request $request, Closure $next): Response|RedirectResponse
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->blocked && ($user->role ?? 'user') !== 'admin') {
                Auth::logout();
                $request->session()->invalidate(); //dzēš sesijas datus
                $request->session()->regenerateToken(); //atjauno csrf 

                return redirect('/login')->with('error', 'Jūsu konts ir bloķēts.');
            }
        }

        return $next($request); //padod nakamajam middlewere
    }
}
