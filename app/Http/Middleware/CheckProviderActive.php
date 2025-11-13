<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\ServiceProvider;

class CheckProviderActive
{
    public function handle(Request $request, Closure $next)
    {
        // Get provider ID from route
        $providerId = $request->route('id') ?? $request->route('providerId');
        
        if ($providerId) {
            $provider = ServiceProvider::find($providerId);
            
            // If provider is deleted or inactive, redirect to home
            if (!$provider || !$provider->is_active || $provider->deleted_at) {
                return redirect('/')->with('error', 'This service provider is no longer available.');
            }
        }

        return $next($request);
    }
}