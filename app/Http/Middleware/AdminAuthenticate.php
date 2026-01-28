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
            if ($request->expectsJson()) {
                return response()->json(['error' => 'You cannot access admin while impersonating a user.'], 403);
            }
            return redirect('/dashboard')->with('error', 'You cannot access admin while impersonating a user.');
        }

        if (Auth::guard('admin')->guest()) {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Admin authentication required'], 401);
            }
            return redirect()->route('admin.login')->with('error', 'Admin authentication required');
        }

        return $next($request);
    }
}