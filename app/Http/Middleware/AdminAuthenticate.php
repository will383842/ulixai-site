<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminAuthenticate
{
    public function handle($request, Closure $next, ...$guards)
    {
        // Prevent access to admin if impersonating as user
        if (session('is_impersonating')) {
            return redirect('/dashboard')->with('error', 'You cannot access admin while impersonating a user.');
        }

        if (Auth::guard('admin')->guest()) {
            return redirect()->route('admin.login')->with('error', 'Admin authentication required');
        }

        return $next($request);
    }
}