<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Gate; 

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); 
        $this->middleware(function ($request, $next) {
            if (Auth::check() && Auth::user()->role === 'admin') {
                return $next($request);
            }
            return redirect('/')->with('error', 'Piekļuve liegta!');
        })->except(['index']); 
    }

    public function users()
    {
        $users = User::where('id', '!=', Auth::id())->paginate(10);
        return view('admin.users', compact('users'));
    }

    public function toggleBlock(User $user)
    {
        if ($user->id === Auth::id()) {
            return redirect()->back()->with('error', 'Jūs nevarat bloķēt sevi.');
        }

        $user->blocked = !$user->blocked;
        $user->save();

        $status = $user->blocked ? 'bloķēts' : 'atbloķēts';
        return redirect()->back()->with('success', 'Lietotājs ' . $user->name . ' veiksmīgi ' . $status . '.');
    }
}