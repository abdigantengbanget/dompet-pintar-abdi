<?php
// app/Http/Middleware/EnsureProfileIsComplete.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureProfileIsComplete
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if ($user && (!$user->job || $user->monthly_income == 0) &&
            !$request->routeIs('profile.setup') &&
            !$request->routeIs('profile.store') &&
            !$request->routeIs('logout'))
        {
            return redirect()->route('profile.setup')->with('warning', 'Mohon lengkapi profil Anda untuk melanjutkan.');
        }

        return $next($request);
    }
}